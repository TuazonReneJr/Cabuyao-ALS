<?php

    if (session_status() === PHP_SESSION_NONE) {
        // Session has not been started yet
        session_start();
    } 

    if (!isset($_SESSION['user_id'])) {
        header('Location: ../../index.php');
        exit();
    }
    
    $userCurrentAssessment = $_SESSION['user_assessment'];
	$userALSLevel = $_SESSION['als_level'];
    
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
	<script src="../../assets/js/student/my-assessment.js" defer></script>

	<title>Assesments</title>
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
					<h1>My Assessments</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Assessments</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">List of Assessments</a>
						</li>
					</ul>
				</div>
			</div>

			<?php
				if ($userALSLevel == "Elementary") {
					echo '<div class="card-container assessment-page-container" id="flt-container">
							<div class="card-content">
								<h5 class="card-title">
									<a href="elementary-functional-test.php" class="hover-link">
										<i class="bi bi-pencil-fill" id="flt-icon"></i> Functional Literacy Test: Elementary Level
									</a>
									<span class="status-box" id="flt-status"></span>
								</h5>
								<p class="card-text assessment-description">Description: The Functional Literacy Test (FLT) assesses readiness for the Alternative Learning System (ALS) curriculum by evaluating an individual\'s skills.</p>
							</div>
						</div>';
				} else if ($userALSLevel == "Highschool") {
					echo '<div class="card-container assessment-page-container" id="flt-container">
							<div class="card-content">
								<h5 class="card-title">
									<a href="highschool-functional-test.php" class="hover-link">
										<i class="bi bi-pencil-fill" id="flt-icon"></i> Functional Literacy Test: Junior High School Level
									</a>
									<span class="status-box" id="flt-status"></span>
								</h5>
								<p class="card-text assessment-description">Description: The Functional Literacy Test (FLT) assesses readiness for the Alternative Learning System (ALS) curriculum by evaluating an individual\'s skills.</p>
							</div>
						</div>';
				}
			?>


            

		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	
</body>
</html>