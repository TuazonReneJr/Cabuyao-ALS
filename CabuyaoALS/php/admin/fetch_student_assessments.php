<?php
    include '../config/db.php';

    $sql = "SELECT s.student_id, s.first_name, s.last_name, s.middle_name, f.als_level, f.pre_assessment_date, f.id, f.learner_answer_id, a.id, a.answer
        FROM students_db s
        INNER JOIN flt_learner_score_db f ON s.student_id = f.student_id
        INNER JOIN flt_learner_answer_db a ON s.student_id = a.student_id";
    $result = $conn->query($sql);

    // Use the long array syntax
    $assessment_details = array();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            // Add each row to the $assessment_details array
            $assessment_details[] = $row;
        }
    }

    // Encode the array as JSON and send it back to the client
    echo json_encode($assessment_details);

    $conn->close();
