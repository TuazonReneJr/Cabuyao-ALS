<?php
    include '../config/db.php'; // Include your database configuration file

    // Set the timezone to Manila
    date_default_timezone_set('Asia/Manila');

    // Retrieve JSON data from the POST request
    $jsonData = file_get_contents('php://input');
    $data = json_decode($jsonData, true);

    // Validate input data
    if (!$data || !isset($data['student_id'], $data['als_level'], $data['flt_test'], $data['scores'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid data']);
        exit;
    }

    // Extract data
    $studentId = $data['student_id'];
    $alsLevel = $data['als_level'];
    $fltTest = $data['flt_test'];
    $answerId = $data['answer_id'];
    $scores = $data['scores'];

    // Default values for scores
    $engCommTotal = $scores['eng'] ?? 0;
    $filCommMultiple = $scores['tag'] ?? 0;
    $scienceTotal = $scores['science'] ?? 0;
    $mathTotal = $scores['math'] ?? 0;
    $lifeTotal = $scores['life'] ?? 0;
    $societyTotal = $scores['society'] ?? 0;
    $digitalTotal = $scores['digital'] ?? 0;

    // Prepare SQL statement
    $stmt = $conn->prepare("
        INSERT INTO flt_learner_score_db (
            student_id, als_level, flt_test, 
            eng_comm_multiple, fil_comm_multiple, science_total, 
            math_total, life_total, society_total, 
            digital_total, pre_assessment_completed, 
            pre_assessment_date, learner_answer_id
        ) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, true, ?, ?)
    ");

    // Get today's date in Manila time
    $preAssessmentDate = date('Y-m-d'); // Format: YYYY-MM-DD

    // Bind parameters
    $stmt->bind_param(
        "issiiiiiiisi", 
        $studentId, 
        $alsLevel, 
        $fltTest, 
        $engCommTotal, 
        $filCommMultiple, 
        $scienceTotal, 
        $mathTotal, 
        $lifeTotal, 
        $societyTotal, 
        $digitalTotal,
        $preAssessmentDate,
        $answerId
    );

    // Execute statement
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => $stmt->error]);
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();

