<?php
    if (session_status() === PHP_SESSION_NONE) {
        // Session has not been started yet
        session_start();
    }

    include '../config/db.php'; // Include your database configuration file

    header('Content-Type: application/json');

    // Retrieve user role and ID from session
    $userRole = isset($_SESSION['user_role']) ? strtolower($_SESSION['user_role']) : null; 
    $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    // Validate session variables
    if (!$userRole || !$userId) {
        http_response_code(400);
        echo json_encode(['error' => 'User role or ID not found in session']);
        exit;
    }

    // Set the SQL query based on user role
    if ($userRole === 'student') {
        $sql = "
            SELECT n.id, n.title, n.message, n.created_by, n.created_at 
            FROM notifications_db n
            LEFT JOIN notification_recipients_db nr ON n.id = nr.notification_id
            WHERE nr.student_id = ?
            AND (nr.user_applicable = 'student' OR nr.user_applicable = 'all')
        ";
    } else if ($userRole === 'teacher' || $userRole === 'admin') {
        $sql = "
            SELECT 
                n.id, 
                n.title, 
                n.message, 
                n.created_by, 
                n.created_at
            FROM notifications_db n
            LEFT JOIN notification_recipients_db nr ON n.id = nr.notification_id
            WHERE nr.admin_id = ?
            OR (nr.user_applicable = 'teacher/admin' OR nr.user_applicable = 'all')
        ";
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid user role']);
        exit;
    }

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare($sql);

    if ($userRole === 'student') {
        $stmt->bind_param('i', $userId);
    } else {
        $stmt->bind_param('i', $userId);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch the notifications
    $notifications = [];
    while ($row = $result->fetch_assoc()) {
        $notifications[] = $row;
    }

    // Return the notifications as JSON
    echo json_encode($notifications);

    // Close statement and connection
    $stmt->close();
    $conn->close();
