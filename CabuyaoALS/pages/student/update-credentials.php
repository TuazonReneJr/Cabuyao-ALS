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
	<script src="../../assets/js/student/update-credentials.js"></script>

	<title>Update Credentials</title>
</head>
<body>
    <?php include '../../includes/sidebar-initial.html'; ?>

	<!-- CONTENT -->
	<section id="content">
		<?php include '../../includes/navbar.html'; ?>

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Update Credentials</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Profile</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Change Credentials</a>
						</li>
					</ul>
				</div>
			</div>

            <div class="initial-update-profile-header">
                <h3> Welcome to ALS Program, <?php echo htmlspecialchars($currentUsername); ?>! </h3>
                <div class="initial-update-profile-info">
                    <i class="bi bi-shield-fill-exclamation"></i> 
                    <p>Before you proceed, please update your temporary username and password to ensure the security of your account and facilitate personalized access. This step is essential for protecting your information and maintaining a secure connection to the ALS Program resources.</p>
                </div>
            </div>

            <div class="card-container update-credentials">
                <form id="change-password-form" method="POST" action="../../php/student/update_credentials.php">
                    <div class="card-content">
                            <div class="row">
                                <label for="username" class="form-label">Username</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($currentUsername); ?>" required>
                                    <button type="button" class="btn btn-outline-secondary" id="check-username">Check</button>
                                </div>
                                <div id="username-status" class="form-text"></div>
                            </div> <br>
                            <div class="row">
                                <label for="password" class="form-label">New Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password" required>
                                    
                                </div>
                                <div id="password-indicator" class="password-strength">
                                    <ul>
                                        <li id="length-status" class="invalid">At least 12 characters</li>
                                        <li id="lowercase-status" class="invalid">Contains lowercase letter</li>
                                        <li id="uppercase-status" class="invalid">Contains uppercase letter</li>
                                        <li id="number-status" class="invalid">Contains a number</li>
                                        <li id="special-status" class="invalid">Contains a special character</li>
                                    </ul>
                                </div>
                            </div> <br>
                            <div class="row">
                                <label for="confirm_password" class="form-label">Confirm Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                    
                                </div>
                                <div id="confirm-password-status" class="form-text"></div>
                            </div>
                            <button class="btn btn-primary" id="update_credentials" disabled>Update Credentials</button>
                    
                    </div>
                </form>
            </div>

		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	
</body>
</html>