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
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../../assets/css/styles.css">
	<script src="../../assets/js/common/scripts.js"></script>
	<script src="../../assets/js/admin/enrollment-admin.js"></script>
	<script src="../../assets/js/common/modal.js"></script>

	<title>Modules</title>
</head>
<body>
	<?php include '../../includes/sidebar-admin.html'; ?>

	<!-- CONTENT -->
	<section id="content">
		<?php include '../../includes/navbar.html'; ?>

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Modules</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Modules</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">List of Modules</a>
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