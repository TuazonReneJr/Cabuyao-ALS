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
    include "../../includes/loading-screen.html";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../../assets/css/styles.css">
	<script src="../../assets/js/common/scripts.js"></script>
	<script src="../../assets/js/common/modal.js"></script>
	<script src="../../assets/js/admin/assessment.js"></script>

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
					<h1>Assessments</h1>
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

            <div class="no-data-container" id="no-data">
				<h4 class="no-data-text"> No Assessment available </h4>
			</div>

			<div class="table-data" id="table-data-container">
				<div class="order">
					<div class="head">
						<h3>All FLT</h3>
						<i class='bx bx-search'></i>
						<i class='bx bx-filter'></i>
					</div>
					<div class="table-wrapper">
						<table>
							<thead>
								<tr>
									<th><input type="checkbox" id="selectAll"></th> <!-- Checkbox for Select All -->
									<th>Last Name</th>
									<th>First Name</th>
									<th>Middle Name</th>
									<th>ALS Level</th>
									<th>Assessment Date</th>
									<th>Action</th> <!-- Action Column -->
								</tr>
							</thead>
							<tbody id="assessment-table">
								
							</tbody>
						</table>
					</div>
				</div>
			</div>

		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	
</body>
</html>