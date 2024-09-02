<?php
    include '../config/db.php';

    if (session_status() === PHP_SESSION_NONE) {
        // Session has not been started yet
        session_start();
    } 

    header('Content-Type: application/json'); // Set the response type to JSON
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get POST data
        $username = $_POST['username'];

        $stmt = $conn->prepare("SELECT COUNT(*) FROM student_accounts_db WHERE student_username = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        // Return a JSON response
        $response = ['available' => $count == 0];
        echo json_encode($response);

        $conn->close();
    }