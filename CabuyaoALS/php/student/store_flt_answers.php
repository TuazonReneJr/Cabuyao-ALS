<?php
    include '../config/db.php';

    header('Content-Type: application/json'); // Set the response type to JSON

   // Retrieve JSON data from the POST request
    $jsonData = file_get_contents('php://input');
    if (!$jsonData) {
        die('No JSON data received.');
    }

    $data = json_decode($jsonData, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        die('JSON decode error: ' . json_last_error_msg());
    }

    // Extract data
    $studentId = $data['student_info']['student_id'];
    $studentAnswers = $data['student_answers'];

    // Convert student_answers to JSON
    $answerText = json_encode($studentAnswers);

    // Prepare SQL statement to insert data
    $stmt = $conn->prepare("
    INSERT INTO flt_learner_answer_db (student_id, answer)
    VALUES (?, ?)
    ");

    // Bind parameters
    $stmt->bind_param("is", $studentId, $answerText);

    // Execute statement
    if ($stmt->execute()) {
        // Retrieve the ID of the last inserted record
        $lastId = $conn->insert_id;

        echo json_encode(['success' => true, 'id' => $lastId]);
    } else {
        echo json_encode(['error' => $stmt->error]);
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
