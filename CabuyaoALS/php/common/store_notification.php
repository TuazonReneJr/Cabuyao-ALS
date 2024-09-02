<?php
    include '../config/db.php';

    if (session_status() === PHP_SESSION_NONE) {
        // Session has not been started yet
        session_start();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        header('Content-Type: application/json');

        // Set the timezone to Manila
        date_default_timezone_set('Asia/Manila');

        // Retrieve JSON data from the POST request
        $jsonData = file_get_contents('php://input');
        $data = json_decode($jsonData, true);

        // Debugging: Output the received JSON data
        file_put_contents('php://stderr', print_r($data, true));

        // Validate the received data
        if (!isset($data['notifications']) || !is_array($data['notifications'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid data']);
            exit;
        }

        $notifications = $data['notifications'];
        $conn->autocommit(FALSE); // Start transaction

        try {
            foreach ($notifications as $notification) {
                // Extract data
                $subject = $notification['subject'];
                $messageBody = $notification['messageBody'];
                $createdBy = isset($notification['created_by']) ? $notification['created_by'] : NULL;
                $studentId = isset($notification['student_id']) ? $notification['student_id'] : NULL;
                $adminId = isset($notification['admin_id']) ? $notification['admin_id'] : NULL;
                $userApplicable = isset($notification['user_applicable']) ? $notification['user_applicable'] : NULL;

                // Get the current timestamp in Manila time
                $createdAt = date('Y-m-d H:i:s');

                // Prepare SQL statement to insert data
                $sql = "INSERT INTO notifications_db (title, message, created_by, created_at) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);

                // Bind parameters
                $stmt->bind_param('ssss', $subject, $messageBody, $createdBy, $createdAt);
                $stmt->execute();

                $notificationId = $stmt->insert_id;
                $stmt->close();

                // Insert recipients
                if ($userApplicable === 'student') {
                    $stmt = $conn->prepare("INSERT INTO notification_recipients_db (notification_id, student_id, user_applicable) VALUES (?, ?, ?)");
                    $stmt->bind_param("iis", $notificationId, $studentId, $userApplicable);
                    $stmt->execute();
                    $stmt->close();
                }

                if ($userApplicable === "teacher/admin") {
                    $stmt = $conn->prepare("INSERT INTO notification_recipients_db (notification_id, admin_id, user_applicable) VALUES (?, ?, ?)");
                    $stmt->bind_param("iis", $notificationId, $adminId, $userApplicable);
                    $stmt->execute();
                    $stmt->close();
                }

                if ($userApplicable === "all") {
                    $stmt = $conn->prepare("INSERT INTO notification_recipients_db (notification_id, admin_id, student_id, user_applicable) VALUES (?, ?, ?, ?)");
                    $stmt->bind_param("iiis", $notificationId, $adminId, $studentId, $userApplicable);
                    $stmt->execute();
                    $stmt->close();
                }
            }

            $conn->commit(); // Commit transaction
            echo json_encode(['success' => true]);
        } catch (Exception $e) {
            $conn->rollback(); // Rollback transaction on error
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }

        $conn->close();
    }
