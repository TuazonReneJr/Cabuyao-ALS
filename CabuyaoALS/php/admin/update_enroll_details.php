<?php
    include '../config/db.php'; // Ensure you include your database connection file

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $studentId = $_POST['studentId'];
        $status = $_POST['status'];
        $rejectReason = $_POST["rejectReason"] ?? null; // Use null if rejectReason is not provided
        $studentFirstname = $_POST["studentFirstname"] ?? null;
        $studentLastname = $_POST["studentLastname"] ?? null;
        $assessmentType = $_POST["assessmentType"] ?? null;

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
        function generateUsername($first_name, $last_name) {
            // Create a base username
            $baseUsername = strtolower($first_name . $last_name);
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
            $stmt = $conn->prepare("SELECT COUNT(*) FROM student_accounts_db WHERE student_username = ?");
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $stmt->bind_result($count);
            $stmt->fetch();
            $stmt->close();
            return $count > 0;
        }

        if (isset($studentId, $status)) {
            $conn->begin_transaction();

            try {
                // 1. Update the students_db table
                $sql = "UPDATE students_db SET status = ?, reject_reason = ?, flt_type = ? WHERE student_id = ?";
                if ($stmt = $conn->prepare($sql)) {
                    $stmt->bind_param("sssi", $status, $rejectReason, $assessmentType, $studentId);
                    $stmt->execute();
                    $stmt->close();
                } else {
                    throw new Exception("Failed to prepare update statement");
                }

                // 2. Insert into students_accounts_db only if the status is 'Approved'
                if ($status === 'Approved') {
                    $studentUsername = generateUsername($studentFirstname, $studentLastname);
                    $studentPassword = generateStrongPassword();

                    $sql = "INSERT INTO student_accounts_db (student_id, student_username, student_password) VALUES (?, ?, ?)";
                    if ($stmt = $conn->prepare($sql)) {
                        $stmt->bind_param("iss", $studentId, $studentUsername, $studentPassword);
                        $stmt->execute();
                        $stmt->close();
                    } else {
                        throw new Exception("Failed to prepare insert statement");
                    }
                }

                // Commit the transaction
                $conn->commit();

                // Return a success message
                if ($status === 'Approved') {
                    echo json_encode(["success" => true, "username" => $studentUsername, "password" => $studentPassword]);
                } else {
                    echo json_encode(["success" => true]);
                }
            }
            catch (Exception $e) {
                // Rollback the transaction in case of any error
                $conn->rollback();
                echo json_encode(["success" => false, "error" => $e->getMessage()]);
            }
            $conn->close();
        } else {
            echo json_encode(["success" => false, "error" => "Student ID and status are required"]);
        } 
    } else {
        echo json_encode(["success" => false, "error" => "Invalid request method"]);
    }
