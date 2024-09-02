<?php
    if (session_status() === PHP_SESSION_NONE) {
        // Session has not been started yet
        session_start();
    }

    header('Content-Type: application/json');

    // Retrieve specific session keys from the request
    $request_keys = isset($_GET['keys']) ? explode(',', $_GET['keys']) : [];

    // Prepare the response array
    $response = [];

    // Populate the response array with session values
    foreach ($request_keys as $key) {
        if (isset($_SESSION[$key])) {
            $response[$key] = $_SESSION[$key];
        } else {
            $response[$key] = null; // Or handle the case where the session key doesn't exist
        }
    }

    // Send the JSON response
    echo json_encode($response);
