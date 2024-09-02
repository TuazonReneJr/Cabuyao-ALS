<?php
    include '../config/db.php';
    //include "utilities.php";

    header('Content-Type: application/json');

    // Check if the request method is POST
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        // Set timezone to Philippine time
        date_default_timezone_set('Asia/Manila');
        
        // Load the field mapping JSON file
        $mappingFile = '../../data/enrollment-field-mapping.json';
        if (!file_exists($mappingFile)) {
            echo json_encode(['status' => 'error', 'message' => 'Mapping file not found.']);
            exit;
        }

        $fieldMappingJson = file_get_contents($mappingFile);
        if ($fieldMappingJson === false) {
            echo json_encode(['status' => 'error', 'message' => 'Could not read mapping file.']);
            exit;
        }

        $fieldMapping = json_decode($fieldMappingJson, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            echo json_encode(['status' => 'error', 'message' => 'JSON decoding failed: ' . json_last_error_msg()]);
            exit;
        }

        // Function to generate a strong password
        function generateStrongPassword($length = 20) {
            $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_=+[]{}|;:,.<>?';
            $password = '';
            for ($i = 0; $i < $length; $i++) {
                $password .= $chars[random_int(0, strlen($chars) - 1)];
            }
            return $password;
        }

        // Function to generate a unique username
        function generateUsername($firstName, $lastName) {
            // Create a base username
            $baseUsername = strtolower($firstName . $lastName);
            $username = $baseUsername;
            $suffix = 1;

            // Check if the username already exists
            while (usernameExists($username)) {
                $username = $baseUsername . $suffix;
                $suffix++;
            }

            return $username;
        }

        // Function to check if the username already exists in the database
        function usernameExists($username) {
            global $conn;
            $stmt = $conn->prepare("SELECT COUNT(*) FROM students_db WHERE student_username = ?");
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $stmt->bind_result($count);
            $stmt->fetch();
            $stmt->close();
            return $count > 0;
        }

        // Function to sanitize and fetch form data
        function getFormData($key) {
            if (!isset($_POST[$key])) {
                return null; // Return null if key does not exist
            }

            $value = $_POST[$key];
            
            if (is_array($value)) {
                return array_map(function($item) {
                    return htmlspecialchars(trim($item ?? ''), ENT_QUOTES, 'UTF-8');
                }, $value);
            }
            
            return htmlspecialchars(trim($value ?? ''), ENT_QUOTES, 'UTF-8');
        }

        // Function to handle yes or no value
        function handleYesOrNo($key) {
            return isset($_POST[$key]) && $_POST[$key] === 'yes' ? 1 : 0;
        }

        // Function to handle file upload and return file data and name
        function handleFileUpload($fileKey) {
            if (isset($_FILES[$fileKey]) && $_FILES[$fileKey]['error'] === UPLOAD_ERR_OK) {
                $fileData = file_get_contents($_FILES[$fileKey]['tmp_name']);
                $fileName = $_FILES[$fileKey]['name'];
                return ['data' => $fileData, 'name' => $fileName];
            }
            return ['data' => null, 'name' => null];
        }

        // Function to dynamically prepare and execute insert statements
        function insertData($conn, $tableName, $data) {
            // Filter out null values
            $data = array_filter($data, function($value) {
                return $value !== null; // Filter out null values
            });

            if (empty($data)) {
                return; // No data to insert
            }

            $columns = implode(", ", array_keys($data));
            $placeholders = implode(", ", array_fill(0, count($data), '?'));
            $stmt = $conn->prepare("INSERT INTO $tableName ($columns) VALUES ($placeholders)");

            $types = str_repeat("s", count($data)); // Assuming all fields are strings
            $stmt->bind_param($types, ...array_values($data));

            if (!$stmt->execute()) {
                echo json_encode(['status' => 'error', 'message' => "Error: " . $stmt->error]);
                exit;
            }
            return $conn->insert_id; // Return the last inserted ID
        }

        try {
            // Prepare and insert students data
            $studentsData = [];
            foreach ($fieldMapping['students_db'] as $formField => $dbColumn) {
                if ($formField === 'gradelevel' || $formField === 'als_program' || $formField === 'modalities' || $formField === 'no_school') {
                    // Handle the checkbox array as a comma-separated string
                    $checkboxValues = getFormData($formField);
                    if (is_array($checkboxValues)) {
                        $studentsData[$dbColumn] = implode(', ', $checkboxValues);
                    } else {
                        $studentsData[$dbColumn] = '';
                    }
                } else if ($formField === 'pwd' || $formField === 'fourPs' || $formField === 'als' || $formField === 'complete_als' || $formField === 'declaration') {
                    $studentsData[$dbColumn] = handleYesOrNo($formField);
                } else {
                    $studentsData[$dbColumn] = getFormData($formField);
                }
            }

            // Add the current date to the students data
            $studentsData['enrollment_date'] = date('Y-m-d'); // Set current date in 'Y-m-d' format
            $studentsData['status'] = 'Pending';
            // Generate username and password
           // $firstName = getFormData('first_name');
           // $lastName = getFormData('last_name');
           //$studentsData['student_username'] = generateUsername($firstName, $lastName);
           // $studentsData['student_password'] = generateStrongPassword(); // Temporary password

            $studentId = insertData($conn, 'students_db', $studentsData);

            // Collect and insert address data
            $addressData = ['student_id' => $studentId];
            foreach ($fieldMapping['address_db'] as $formField => $dbColumn) {
                if ($formField === 'same_current_address') {
                    $addressData[$dbColumn] = handleYesOrNo($formField);
                } else {
                    $addressData[$dbColumn] = getFormData($formField);
                }
            }
            insertData($conn, 'address_db', $addressData);

            // Collect and insert availability data
            $availabilityData = ['student_id' => $studentId];
            foreach ($fieldMapping['availability_db'] as $formField => $dbColumn) {
                $availabilityData[$dbColumn] = getFormData($formField);
            }
            insertData($conn, 'availability_db', $availabilityData);

            // Handle file upload
            $fileUpload = handleFileUpload('enrollment_file');
            $documentFile = $fileUpload['data'];
            $documentName = $fileUpload['name'];
            
            // Prepare and insert documents data
            if ($documentFile !== null && $documentName !== null) {
                $documentsData = ['student_id' => $studentId];
                foreach ($fieldMapping['documents_db'] as $formField => $dbColumn) {
                    if ($formField === 'enrollment_file') {
                        $documentsData[$dbColumn] = $documentFile; // Store file data
                    } else if ($formField === 'document_type') {
                        $documentsData[$dbColumn] = getFormData($formField);
                    }
                }
                // Add document name to the data
                $documentsData['document_name'] = $documentName;
                
                // Insert document data
                insertData($conn, 'documents_db', $documentsData);
            }

            // If all goes well, send a success response
            echo json_encode(['status' => 'success', 'message' => 'Data submitted successfully']);
        } catch (Exception $e) {
            // If an error occurs, send an error response
            echo json_encode(['status' => 'error', 'message' => 'An error occurred: ' . $e->getMessage()]);
        }

    } else {
        // If request method is not POST, send an error response
        echo json_encode(['status' => 'error', 'message' => 'Invalid request method. Only POST requests are allowed.']);
    }
