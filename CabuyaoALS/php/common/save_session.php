<?php
    if (session_status() === PHP_SESSION_NONE) {
        // Session has not been started yet
        session_start();
    }

    // Get the raw POST data
    $jsonData = file_get_contents('php://input');
    
    // Decode the JSON data into a PHP array
    $data = json_decode($jsonData, true);
    
    if (isset($data['key']) && isset($data['value'])) {
        $_SESSION[$data['key']] = $data['value'];
        echo "Session value saved.";
    } else {
        echo "Invalid input.";
    }