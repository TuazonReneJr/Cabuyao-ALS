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

	<style>
	</style>

	<title>Cabuyao ALS</title>
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
					<h1>Enrollment</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Enrollment</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">List of Enrollees</a>
						</li>
					</ul>
				</div>
			</div>

			<div class="no-data-container" id="no-data">
				<h4 class="no-data-text"> No students available </h4>
			</div>

			<div class="table-data" id="table-data-container">
				<div class="order">
					<div class="head">
						<h3>All Enrollees</h3>
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
									<th>Gender</th>
									<th>Enrollment Date</th>
									<th>Status</th>
									<th>Action</th> <!-- Action Column -->
								</tr>
							</thead>
							<tbody id="students-table">
								<!-- Data will be inserted here -->

								<!--<tr>
									<td><input type="checkbox" class="selectRow"></td> 
									<td>
										<img src="img/people.png">
										<p>John Doe</p>
									</td>
									<td>01-10-2021</td>
									<td><span class="status completed">Completed</span></td>
									<td><button class="view-btn">View</button></td>
								</tr>
								<tr>
									<td><input type="checkbox" class="selectRow"></td>
									<td>
										<img src="img/people.png">
										<p>John Doe</p>
									</td>
									<td>01-10-2021</td>
									<td><span class="status pending">Pending</span></td>
									<td><button class="view-btn">View</button></td>
								</tr>
								<tr>
									<td><input type="checkbox" class="selectRow"></td>
									<td>
										<img src="img/people.png">
										<p>John Doe</p>
									</td>
									<td>01-10-2021</td>
									<td><span class="status process">Process</span></td>
									<td><button class="view-btn">View</button></td>
								</tr> -->
								
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