<?php
    if (session_status() === PHP_SESSION_NONE) {
        // Session has not been started yet
        session_start();
    }

    include '../config/db.php';

    // Retrieve the student_id from GET or POST request
    $student_id = isset($_GET['student_id']) ? intval($_GET['student_id']) : (isset($_POST['student_id']) ? intval($_POST['student_id']) : null);

    if ($student_id) {
        // Prepare the SQL statement with a placeholder
        $sql = "SELECT 
                    a.*, 
                    s.*
                FROM 
                    flt_learner_answer_db a
                INNER JOIN 
                    flt_learner_score_db s 
                ON 
                    a.student_id = s.student_id
                WHERE 
                    a.student_id = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            // Bind the student_id parameter to the SQL statement
            $stmt->bind_param('i', $student_id);

            // Execute the statement
            $stmt->execute();

            // Get the result set from the executed statement
            $result = $stmt->get_result();

            // Initialize an array to hold the fetched data
            $answer = array();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Add each row to the $answer array
                    $answer[] = $row;
                }
            }

            // Free result set and close statement
            $result->free();
            $stmt->close();
        } else {
            echo json_encode(['error' => 'Failed to prepare the SQL statement.']);
            exit();
        }
    } else {
        echo json_encode(['error' => 'No student_id provided.']);
        exit();
    }

    // Close the database connection
    $conn->close();

    // Encode the array as JSON and send it back to the client
    echo json_encode($answer);
