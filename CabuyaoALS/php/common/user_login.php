<?php
    include '../config/db.php';

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {

        function fetchStudentDetails($conn, $userId) {
            // Fetch additional student details
            $sql = $conn->prepare("SELECT first_name, last_name, flt_type FROM students_db WHERE student_id = ?");
            $sql->bind_param("i", $userId);
            $sql->execute();
            $result = $sql->get_result();

            if ($result->num_rows == 1) {
                $studentDetails = $result->fetch_assoc();
                $_SESSION['first_name'] = $studentDetails['first_name'];
                $_SESSION['last_name'] = $studentDetails['last_name'];
                $_SESSION['als_level'] = $studentDetails['flt_type'];
            }

            $sql->close();
        }

        if (!empty($_POST['username']) && !empty($_POST['password'])) {
            $username = $_POST['username'];
            $user_password = $_POST['password'];

            // Check admin/teacher
            $sql = $conn->prepare("SELECT user_id, username, user_password, user_role FROM admin_db WHERE username = ?");
            $sql->bind_param("s", $username);
            $sql->execute();
            $result = $sql->get_result();

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $hashedPassword = $row['user_password'];
                $userRole = $row['user_role'];
                $userId = $row['user_id'];

                if (password_verify($user_password, $hashedPassword)) {
                    $_SESSION['username'] = $username;
                    $_SESSION['user_role'] = $userRole;
                    $_SESSION['user_id'] = $userId;
                    $_SESSION['user_default'] = 0;
                    $_SESSION['user_assessment'] = 1;

                    header("Location: ../../pages/admin/dashboard.php");
                    exit();
                } else {
                    $_SESSION['error'] = "Incorrect password.";
                }
            } else {
                // Check student
                $sql = $conn->prepare("SELECT student_id, student_username, student_password, is_default_password, assessment_completed FROM student_accounts_db WHERE student_username = ?");
                $sql->bind_param("s", $username);
                $sql->execute();
                $result = $sql->get_result();

                if ($result->num_rows == 1) {
                    $row = $result->fetch_assoc();
                    $hashedPassword = $row['student_password'];
                    $userId = $row['student_id'];
                    $userDefault = $row['is_default_password'];
                    $userAssessment = $row['assessment_completed'];

                    if ($userDefault === 1) {
                        if ($user_password === $hashedPassword) {
                            $_SESSION['username'] = $username;
                            $_SESSION['user_role'] = 'student';
                            $_SESSION['user_id'] = $userId;
                            $_SESSION['user_default'] = $userDefault;
                            $_SESSION['user_assessment'] = $userAssessment;

                            fetchStudentDetails($conn, $userId);

                            header("Location: ../../pages/student/update-credentials.php");
                            exit();
                        } else {
                            $_SESSION['error'] = "Incorrect password.";
                        }
                    } else {
                        if (password_verify($user_password, $hashedPassword)) {
                            $_SESSION['username'] = $username;
                            $_SESSION['user_role'] = 'student';
                            $_SESSION['user_id'] = $userId;
                            $_SESSION['user_default'] = $userDefault;
                            $_SESSION['user_assessment'] = $userAssessment;

                            fetchStudentDetails($conn, $userId);

                            header("Location: ../../pages/student/my-dashboard.php");
                            exit();
                        } else {
                            $_SESSION['error'] = "Incorrect password.";
                        }
                    }
                } else {
                    $_SESSION['error'] = "Invalid username or password.";
                }
            }

            $sql->close();
        } else {
            $_SESSION['error'] = "Please enter both username and password.";
        }

        $conn->close();
        header("Location: ../../index.php");
        exit();
    } else {
        echo "Form not submitted correctly.";
    }
