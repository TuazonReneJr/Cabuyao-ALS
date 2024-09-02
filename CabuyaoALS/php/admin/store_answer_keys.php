<?php
    include '../config/db.php';

    header('Content-Type: application/json'); // Set the response type to JSON

   // Retrieve JSON data from the POST request
    $jsonData = file_get_contents('php://input');
    if (!$jsonData) {
        die('No JSON data received.');
    }

    echo "Raw JSON Data: $jsonData\n";

    $data = json_decode($jsonData, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        die('JSON decode error: ' . json_last_error_msg());
    }

    // Extract answerKeys and answerKeyname from the decoded data
    $answerKeys = $data['answerKeys'] ?? null;
    $answerKeyname = $data['answerKeyname'] ?? null;

    // Debug: Check if data was extracted correctly
    if ($answerKeys === null || $answerKeyname === null) {
        die('Missing answerKeys or answerKeyname in the JSON data.');
    }

    // Example: You might store both in the database, or process them as needed
    $stmt = $conn->prepare("INSERT INTO answerkeys_db (answerkey_name, answer_data) VALUES (?, ?)");
    $answerKeysJson = json_encode($answerKeys);
    $stmt->bind_param("ss", $answerKeyname, $answerKeysJson);

    if ($stmt->execute()) {
        echo "Answer keys and name stored successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
