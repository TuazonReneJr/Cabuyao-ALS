<?php

    if (session_status() === PHP_SESSION_NONE) {
        // Session has not been started yet
        session_start();
    } 

    if (!isset($_SESSION['user_id'])) {
        header('Location: ../../index.php');
        exit();
    }

    // Fetch the current username from session
    $currentUsername = $_SESSION['username'];
    $currentUserRole = $_SESSION['user_role'];
    $userCurrentAssessment = $_SESSION['user_assessment'];
    
    include "../../assets/vendor/boxicon.html";
    include "../../php/config/session_manager.php";
    include "../../assets/vendor/bootstrap.html";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../../assets/css/styles.css">
	<script src="../../assets/js/common/scripts.js"></script>
	<script src="../../assets/js/common/modal.js"></script>

	<title>Modules</title>
</head>
<body>
	<?php include '../../includes/sidebar-student.html'; ?>

	<!-- CONTENT -->
	<section id="content">
		<?php include '../../includes/navbar.html'; ?>

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Dashboard</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Home</a>
						</li>
					</ul>
				</div>
			</div>

            <div class="announcement-header" >
                <h5><i class="bx bxs-megaphone"></i>
                Announcements</h5>
            </div>

            <!-- For NEW Students -->
            <?php 
                // Check status of student
                if ($userCurrentAssessment === 0) {
                    echo '
                        <div class="card-container assessment-reminder-container">
                            <div class="card-content assessment-reminder">
                                <h5 class="card-title text-danger">
                                    <i class="bi bi-exclamation-circle-fill"></i> <!-- Exclamation icon -->
                                        Important Notice: Mandatory Assessment for New Students
                                </h5>
                                <p class="card-text sub-text">Posted by ALS Team</p>
                                <p class="card-text">All new students are required to complete an assessment before accessing any modules. This assessment is mandatory and must be taken prior to engaging in coursework. Your timely participation is essential to ensure a smooth start to your learning journey.</p>

                                <!-- Button to Assessment Page -->
                                <a href="my-assessment.php" class="btn btn-danger mt-3">
                                    <i class="bi bi-pencil-fill"></i> Take the Assessment
                                </a>
                            </div>
                        </div>
                    ';
                } 
            ?>

		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	
</body>
</html>