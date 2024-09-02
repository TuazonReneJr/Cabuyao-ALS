<?php
    // update_credentials.php
    include '../config/db.php';

    header('Content-Type: application/json');

    if (session_status() === PHP_SESSION_NONE) {
        // Session has not been started yet
        session_start();
    }

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Check if the request method is POST
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Get form data
        $username = $_POST['username'] ?? null;
        $password = $_POST['password'] ?? null;
        $confirm_password = $_POST['confirm_password'] ?? null;

        // Validate required fields
        if (!$username || !$password || !$confirm_password) {
            echo json_encode(['success' => false, 'message' => 'All fields are required.']);
            exit();
        }

        // Validate passwords
        if ($password !== $confirm_password) {
            echo json_encode(['success' => false, 'message' => 'Passwords do not match.']);
            exit();
        }

        // Set timezone to Philippine time
        date_default_timezone_set('Asia/Manila');

        // Hash the new password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Update the student_accounts_db table
        $sql = "UPDATE student_accounts_db SET student_username = ?, student_password = ?, change_password_date = ?, is_default_password = ? WHERE student_id = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            // Assume student_id is retrieved from session or passed as a hidden input field
            $student_id = $_SESSION['user_id']; // or $_POST['student_id']
            $enrollment_date = date('Y-m-d'); // Current Date
            $default_password = 0; // Boolean

            // Bind parameters and execute the query
            $stmt->bind_param('sssii', $username, $hashed_password, $enrollment_date, $default_password, $student_id);

            if ($stmt->execute()) {
                $_SESSION['user_default'] = 0;
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to update credentials.']);
            }
            $stmt->close();
        } else {
            echo json_encode(['success' => false, 'message' => 'Database query failed.']);
        }
        $conn->close();
    }
    else {
        // If request method is not POST, send an error response
        echo json_encode(['status' => 'error', 'message' => 'Invalid request method. Only POST requests are allowed.']);
    }
