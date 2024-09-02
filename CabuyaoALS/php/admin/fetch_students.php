<?php
    include '../config/db.php';

    $sql = "SELECT student_id, first_name, last_name, middle_name, birth_date, enrollment_date, gender, status FROM students_db";
    $result = $conn->query($sql);

    // Use the long array syntax
    $students = array();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            // Add each row to the $students array
            $students[] = $row;
        }
    }

    // Encode the array as JSON and send it back to the client
    echo json_encode($students);

    $conn->close();
