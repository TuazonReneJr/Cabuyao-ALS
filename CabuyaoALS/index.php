<?php
    if (session_status() === PHP_SESSION_NONE) {
        // Session has not been started yet
        session_start();
    } 

    $error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
    unset($_SESSION['error']);

    include "assets/vendor/boxicon.html";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="assets/css/styles.css">
	<script src="assets/js/common/scripts.js"></script>

	<title>Cabuyao ALS</title>
</head>
<body>
	<!-- CONTENT -->
	<section id="index-content">
		<?php include 'includes/index-navbar.html'; ?>

		<!-- MAIN -->
		<main>
		<!-- MAIN PAGE CONTENT -->
		 	<!-- Centered Content -->
			 <div class="index-container">
				<!-- Date and Time Display -->
				<div class="datetime-container">
					<div class="philippine-time" id="philippine-time">Philippine Standard Time:</div>
					<div class="datetime" id="datetime"></div>
				</div>

				<!-- Page Content -->
				<div class="content">
					<div class="home" data-page="home">
						<h1>Alternative Learning System (ALS)</h1>
						<p>
							The Alternative Learning System (ALS) is a free educational program introduced by the Department of Education (DepEd) in 1997. The primary goal of ALS, as emphasized in the Philippine Development Plan 2017-2022, is to extend educational opportunities to individuals who are not reached by the conventional schooling system, thereby allowing them to either complete their basic education or engage in lifelong learning. This initiative is specifically designed to accommodate those who face challenges within the traditional education framework, such as individuals with special needs, indigenous communities, out-of-school children and youth, and adults who wish to attain their elementary or junior high school qualifications. ALS offers a flexible and inclusive educational model, integrating formal, non-formal, and informal learning approaches to provide essential knowledge and skills to these diverse groups.
						</p>
						<br> <br>

						<h4>How does ALS work?</h4>
						<p>
							There are two major programs on ALS that are being implemented by the Department of Education, through the Bureau of Alternative Learning System (BALS). One is the Basic Literacy Program and the other is the Continuing Education Program – Accreditation and Equivalency (A&E). Both programs are modular and flexible. This means that learning can take place anytime and any place, depending on the convenience and availability of the learners.
						</p>

						<div class="container mt-5">
							<a href="https://www.deped.gov.ph/k-to-12/inclusive-education/about-alternative-learning-system/" class="btn btn-primary custom-button">
								Read more about ALS
								<i class='bx bx-chevron-right arrow'></i>
							</a>
						</div>
						<br> <br>

						<h4>What we offer:</h4>
						<p>
							Our Learning Management System is designed to offer the Department of Education's Alternative Learning System (ALS) in a flexible and accessible online format. The ALS program provides a viable pathway for out-of-school youth and adults to achieve educational equivalency. With our online platform, learners can easily access learning modules, participate in assessments, and communicate with educators from the comfort of their homes. This approach eliminates the need for daily commuting, making education more accessible, especially for those in remote areas.
						</p>

						<div class="container mt-5">
							<a href="pages/student/enrollment.php" class="btn btn-primary custom-button">
								Enroll in ALS
								<i class='bx bx-chevron-right arrow'></i>
							</a>
						</div>
					</div>

					<div class="about" data-page="about">
						<h1>About</h1>
					</div>

					<div class="login" data-page="login">
						<h1>Welcome to ALS Program</h1>
						<p>Please login using valid ALS account.</p>
                        <?php if (!empty($error)): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo htmlspecialchars($error); ?>
                            </div>
                        <?php endif; ?>
						<form id="loginForm" method="POST" action="php/common/user_login.php">
							<div class="form-group">
								<label for="username">Username:</label>
								<input type="text" id="username" name="username" required>
							</div>
							<div class="form-group">
								<label for="password">Password:</label>
								<div class="password-wrapper">
									<input type="password" id="password" name="password" required>
									<button type="button" id="togglePassword" class="toggle-password">
										<i class='bx bx-hide' id="toggleIcon"></i>
									</button>
								</div>
								
								<a href="#" class="forgot-password">Forgot Password?</a>
							</div>
							<button type="submit" name="login" class="login-btn">Login</button>
						</form>
						<div class="login-footer">
							<p>Don't have an account yet? <a href="pages/student/enrollment.php" class="enroll-now">Enroll now</a></p>
						</div>
					</div>

				</div>
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	
</body>
</html>