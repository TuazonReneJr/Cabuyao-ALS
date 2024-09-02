<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../assets/phpmailer/src/Exception.php';
require '../../assets/phpmailer/src/PHPMailer.php';
require '../../assets/phpmailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["email"]) && isset($_POST["subject"]) && isset($_POST["message"])) {

    try {
        $mail = new PHPMailer(true);

        //$mail->SMTPDebug = 2;
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';                        // Specify main SMTP server (e.g., Gmail)
        $mail->SMTPAuth   = true;                                    // Enable SMTP authentication
        $mail->Username   = 'cabuyao.als.test@gmail.com';                  // Your email address
        $mail->Password   = 'jglxfgbifqdimtts';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;          // Enable TLS encryption
        $mail->Port       = 465;          
        
        // Recipients
        $mail->setFrom('cabuyao.als.test@gmail.com', 'Cabuyao ALS');
        $mail->addAddress($_POST["email"]); // Add a recipient

        // Content
        $mail->isHTML(true);
        $mail->Subject = $_POST["subject"];
        $mail->Body    = $_POST["message"];

        $mail->send(); // Send the email

        echo json_encode(["success" => true]);

    }
    catch (Exception $e) {
        echo json_encode(["success" => false, "error" => $e->getMessage()]);
    }  
} else {
    echo json_encode(["success" => false, "error" => "Invalid request"]);
}
