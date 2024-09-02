<?php

    if (session_status() === PHP_SESSION_NONE) {
        // Session has not been started yet
        session_start();
    } 

    if (!isset($_SESSION['user_id'])) {
        header('Location: ../../index.php');
        exit();
    }
    
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

	<title>Grades</title>
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
					<h1>My Grades</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Grades</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">My Grades</a>
						</li>
					</ul>
				</div>
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	
</body>
</html>