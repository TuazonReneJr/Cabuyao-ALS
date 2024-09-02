<?php
// Include database connection
    include '../config/db.php';

    // Retrieve document ID from query parameter
    $documentId = isset($_GET['document_id']) ? intval($_GET['document_id']) : 0;

    if ($documentId > 0) {
        // Prepare SQL query to fetch document data
        $sql = "SELECT document_name, document_file FROM documents_db WHERE document_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $documentId);
        $stmt->execute();
        $stmt->store_result();
        
        // Check if the document exists
        if ($stmt->num_rows === 1) {
            $stmt->bind_result($documentName, $documentFile);
            $stmt->fetch();
            
            // Determine the file extension to set the content type
            $fileExtension = pathinfo($documentName, PATHINFO_EXTENSION);
            switch (strtolower($fileExtension)) {
                case 'pdf':
                    header('Content-Type: application/pdf');
                    break;
                case 'jpg':
                case 'jpeg':
                    header('Content-Type: image/jpeg');
                    break;
                case 'png':
                    header('Content-Type: image/png');
                    break;
                default:
                    header('Content-Type: application/octet-stream');
                    break;
            }
            
            // Set headers for file download
            header('Content-Disposition: inline; filename="' . htmlspecialchars($documentName) . '"');
            header('Content-Transfer-Encoding: binary');
            header('Content-Length: ' . strlen($documentFile));
            
            // Output the document file content
            echo $documentFile;
        } else {
            http_response_code(404);
            echo "Document not found.";
        }

        $stmt->close();
    } else {
        http_response_code(400);
        echo "Invalid document ID.";
    }

    $conn->close();
