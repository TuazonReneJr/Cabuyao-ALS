<?php
    include '../config/db.php'; // Include your database configuration file

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    header('Content-Type: application/json');

    // Retrieve JSON data from the POST request
    $jsonData = file_get_contents('php://input');
    $data = json_decode($jsonData, true);

    // Validate the received data
    if (!isset($data['table'], $data['columns'], $data['conditions'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid data']);
        exit;
    }

    // Extract data
    $table = $data['table'];
    $columns = $data['columns']; // Associative array of column => value
    $conditions = $data['conditions']; // Associative array of condition column => value

    // Build the SQL statement dynamically
    $setPart = [];
    $bindParams = [];
    $types = '';

    foreach ($columns as $column => $value) {
        if (is_bool($value)) {
            $value = $value ? 1 : 0; // Convert boolean to 1 or 0
            $types .= 'i'; // Boolean stored as integer
        } else {
            $types .= is_int($value) ? 'i' : 's'; // Determine the type
        }
        $setPart[] = "$column = ?";
        $bindParams[] = $value;
    }

    $wherePart = [];
    foreach ($conditions as $column => $value) {
        $wherePart[] = "$column = ?";
        $bindParams[] = $value;
        $types .= is_int($value) ? 'i' : 's';
    }

    $setPart = implode(', ', $setPart);
    $wherePart = implode(' AND ', $wherePart);

    $sql = "UPDATE $table SET $setPart WHERE $wherePart";

    // Debug: Output or log the SQL query
    error_log("Generated SQL: " . $sql);

    // Prepare and execute the statement
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        echo json_encode(['error' => $conn->error]);
        exit;
    }

    $stmt->bind_param($types, ...$bindParams);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => $stmt->error]);
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
