<?php
    include '../config/db.php';

    // Assuming you want to retrieve data for a specific answerKeyname
    $answerKeyname = $_GET['answerKeyname'] ?? '';

    if (empty($answerKeyname)) {
        die('Missing answerKeyname parameter');
    }

    // Prepare and execute the query to fetch answer_data
    $stmt = $conn->prepare("SELECT answer_data FROM answerkeys_db WHERE answerkey_name = ?");
    $stmt->bind_param("s", $answerKeyname);

    if ($stmt->execute()) {
        $stmt->bind_result($answerDataJson);
        $stmt->fetch();
        echo $answerDataJson; // Echo the JSON data directly
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

