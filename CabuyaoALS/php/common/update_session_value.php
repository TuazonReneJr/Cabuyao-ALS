<?php
    if (session_status() === PHP_SESSION_NONE) {
        // Session has not been started yet
        session_start();
    }

    header('Content-Type: application/json');

    // Retrieve JSON data from the POST request
    $jsonData = file_get_contents('php://input');
    $data = json_decode($jsonData, true);

    if (is_array($data)) {
        foreach ($data as $key => $value) {
            $_SESSION[$key] = $value;
        }
        echo json_encode(['success' => true, 'message' => 'Session updated']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid data']);
    }

