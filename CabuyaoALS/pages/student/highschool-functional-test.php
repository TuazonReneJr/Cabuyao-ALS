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
	<script src="../../assets/js/student/flt-auto-checker.js" defer></script>
    <!--<script src="../../assets/js/admin/flt-answer-keys.js" defer></script>-->

	<title>Assesments</title>
</head>
<body>
	<?php include '../../includes/sidebar-student.html'; ?>

	<!-- CONTENT -->
	<section id="content">
		<?php include '../../includes/navbar.html'; ?>

		<!-- MAIN -->
		<main id="main-content">
			<div class="head-title">
				<div class="left">
					<h1>Functional Literacy Test: Junior High School Level</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Assessments</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="inactive" href="my-assessment.php">List of Assessments</a>
						</li>
                        <li><i class='bx bx-chevron-right' ></i></li>
                        <li>
							<a class="active" href="#">Junior High School Level FLT</a>
						</li>
					</ul>
				</div>
			</div>

            <!-- Multi-Step Form -->
            <form id="assessment-flt-form" action="" method="post">
                <!-- Step 1: Multiple Choice Questions -->
                <div class="form-step" id="step-1">
                    <div class="card-container flt-card-container">
                        <div class='card-header assessment-header-color'> <h5>Personal Information Sheet </h5></div>
                        <div class="flt-instruction"> 
                            <p> A. Answer the following questions. </p>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions" >1.) &nbsp; What is your complete name?</label>
                            <div class="flt-content-flex">
                                <input type="text" class="form-control custom-border" id="pis-first_name" name="pis-first_name" placeholder="First Name">
                                <input type="text" class="form-control custom-border" id="pis-middle_name" name="pis-middle_name" placeholder="Middle Name">
                                <input type="text" class="form-control custom-border" id="pis-last_name" name="pis-last_name" placeholder="Last Name">
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">2.) &nbsp; What is your sex? Check (✔) the corresponding box.</label>
                            <div class="flt-content-flex input-checkbox">
                                <div class="radio-option">
                                    <input type="radio" id="pis-male" name="pis-gender" value="Male">
                                    <label for="pis-male">Male</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="pis-female" name="pis-gender" value="Female">
                                    <label for="pis-female">Female</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">3.) &nbsp; When is your date of birth?</label>
                            <div class="flt-content-flex">
                                <input type="text" class="form-control custom-border" id="pis-birth_month" name="pis-birth_month" placeholder="Month">
                                <input type="text" class="form-control custom-border" id="pis-birth_day" name="pis-birth_day" placeholder="Day">
                                <input type="text" class="form-control custom-border" id="pis-birth_year" name="pis-birth_year" placeholder="Year">
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">4.) &nbsp; Where do you live?</label>
                            <div class="flt-content-flex">
                                <input type="text" class="form-control custom-border" id="houseNo_street" name="houseNo_street" placeholder="House number/Street">
                                <input type="text" class="form-control custom-border" id="pis-barangay" name="pis-barangay" placeholder="Barangay">
                                <input type="text" class="form-control custom-border" id="pis-city" name="pis-city" placeholder="City/Town">
                                <input type="text" class="form-control custom-border" id="pis-province" name="pis-province" placeholder="Province">
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">5.) &nbsp; What is your religion?</label>
                            <div class="flt-content-flex">
                                <input type="text" class="form-control custom-border" id="pis-religion" name="pis-religion" placeholder="">
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">6.) &nbsp; What is your marital status? Check (✔) the corresponding box.</label>
                            <div class="flt-content-flex input-checkbox">
                                <div class="radio-option">
                                    <input type="radio" id="pis-single" name="pis-status" value="Single">
                                    <label for="pis-single">Single</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="pis-married" name="pis-status" value="Married">
                                    <label for="pis-married">Married</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="pis-widow" name="pis-status" value="Widow/Widower">
                                    <label for="pis-widow">Widow/Widower</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="pis-divorced" name="pis-status" value="Separated/Divorced">
                                    <label for="pis-divorced">Separated/Divorced</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">7.) &nbsp; What is your job/occupation?</label>
                            <div class="flt-content-flex">
                                <input type="text" class="form-control custom-border" id="pis-occupation" name="pis-occupation" placeholder="">
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">8.) &nbsp; What is your highest educational attainment?</label>
                            <div class="flt-content-flex">
                                <input type="text" class="form-control custom-border" id="pis-grade-level-completed" name="pis-grade-level-completed" placeholder="">
                            </div>
                        </div>

                        <div class="card-content flt-card">
                            <label class="flt-questions"><b>B. Write a paragraph composed of two (2) to three (3) sentences about
                            yourself, including your interests and ambition.</b></label> <br><br>
                            <div class="flt-content-flex">
                                <textarea class="form-control custom-border" id="pis-self-description" name="pis-self-description" placeholder="" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 2: LS1 Questions -->
                <div class="form-step" id="step-2">
                    <div class="card-container flt-card-container">
                        <div class='card-header assessment-header-color'> <h5>LS 1: Communication Skills (ENGLISH) </h5></div>
                        <div class="flt-instruction"> 
                            <p class="flt-part"> Part I: Reading</p>
                            <p> Directions: Read each item. Choose the letter of the correct answer.</p>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                1.) &nbsp; Which of the following signs means "<b>NO SMOKING</b>"?
                            </label>
                            <div class="flt-content-flex content-row">
                                <div class="radio-option">
                                    <input type="radio" id="eng-comm-one-a" name="eng-comm-one" value="A">
                                    <img src="../../assets/img/FLT_Eng_Question_1_A.jpg" alt="Descriptive text">
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="eng-comm-one-b" name="eng-comm-one" value="B">
                                    <img src="../../assets/img/FLT_Eng_Question_1_B.jpg" alt="Descriptive text">
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="eng-comm-one-c" name="eng-comm-one" value="B">
                                    <img src="../../assets/img/FLT_Eng_Question_1_C.jpg" alt="Descriptive text">
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="eng-comm-one-d" name="eng-comm-one" value="D">
                                    <img src="../../assets/img/FLT_Eng_Question_1_D.jpg" alt="Descriptive text">
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                2.) &nbsp; Identify the type of sentence according to use.
                            </label>
                            <div class="flt-question-box short-box">
                                I won the lottery!
                            </div>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="eng-comm-two-a" name="eng-comm-two" value="A">
                                    <label for="eng-comm-two-a">Imperative</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="eng-comm-two-b" name="eng-comm-two" value="B">
                                    <label for="eng-comm-two-b">Exclamatory</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="eng-comm-two-c" name="eng-comm-two" value="C">
                                    <label for="eng-comm-two-c">Declarative</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="eng-comm-two-d" name="eng-comm-two" value="D">
                                    <label for="eng-comm-two-d">Interrogative</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                3.) &nbsp; What is the main idea of the given paragraph? 
                            </label>
                            <div class="flt-question-box">
                                The Sun is very important. Without it, there would be only darkness and our planet would be very cold and be without liquid water. Our planet would also be without people, animals, and plants because these things need sunlight and water to live.
                                <i>(Excerpt from “The Sun and The Stars, by Sue Peterson)</i>
                            </div>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="eng-comm-three-a" name="eng-comm-three" value="A">
                                    <label for="eng-comm-three-a">Things need sunlight to live.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="eng-comm-three-b" name="eng-comm-three" value="B">
                                    <label for="eng-comm-three-b">There would be darkness in our planet.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="eng-comm-three-c" name="eng-comm-three" value="C">
                                    <label for="eng-comm-three-c">It would be very cold on Earth.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="eng-comm-three-d" name="eng-comm-three" value="D">
                                    <label for="eng-comm-three-d">The importance of the Sun.</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                4.) &nbsp; Based from the above directions for the use of fertilizer, what is the rate
                                to be applied for Pop-Up Starter?
                            </label>
                            <div class="flt-question-box pre-class"><b>General Use Directions</b>

                                <b>Pop-Up Starter:</b> Apply in the row on the seed with starter fertilizer. Apply at a rate of 1/2 gallon per acre.

                                <b>Foliar:</b> Apply at a rate of a 1/2 gallon per acre as needed. Can be mixed and applied with other fertilizers and chemicals. Always jar test before using.

                                <b>For Best Results:</b>
                                Apply 1/2 gallon in a 3-10 gallon mix per acre.
                            </div>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="eng-comm-four-a" name="eng-comm-four" value="A">
                                    <label for="eng-comm-four-a">1/2 gallon in a 3-10 gallon tank</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="eng-comm-four-b" name="eng-comm-four" value="B">
                                    <label for="eng-comm-four-b">1/2 gallon per acre</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="eng-comm-four-c" name="eng-comm-four" value="C">
                                    <label for="eng-comm-four-c">1/2 gallon per acre as needed</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="eng-comm-four-d" name="eng-comm-four" value="D">
                                    <label for="eng-comm-four-d">1/2 gallon per jar</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                5.) &nbsp; What would be the correct sequence of events in the situation below?
                            </label>
                            <div class="flt-question-box pre-class short-box"><b><u>Dino and the Basketball</u></b>

                            1 - He found a basketball in the garage and started dribbling it.
                            2 - Dino went outside on a bright sunny day.
                            3 - He dribbled it down the driveway and turned toward the net, and threw the ball into the air.
                            4 - Dino jumped excitedly as the ball went through the hoop.
                            </div>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="eng-comm-five-a" name="eng-comm-five" value="A">
                                    <label for="eng-comm-five-a">1,2,3,4</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="eng-comm-five-b" name="eng-comm-five" value="B">
                                    <label for="eng-comm-five-b">2,1,3 4</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="eng-comm-five-c" name="eng-comm-five" value="C">
                                    <label for="eng-comm-five-c">4,1,2,3</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="eng-comm-five-d" name="eng-comm-five" value="D">
                                    <label for="eng-comm-five-d">3,4,1,2</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                6.) &nbsp; Fill in the blank with the correct word from the options below that will make the statement <b>POSITIVE</b>. Choose the letter of the correct answer.
                            </label>
                            <div class="flt-question-box short-box">
                                I will <span class="underline"></span> eat that vegetable. It's delicious!
                            </div>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="eng-comm-six-a" name="eng-comm-six" value="A">
                                    <label for="eng-comm-six-a">definitely</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="eng-comm-six-b" name="eng-comm-six" value="B">
                                    <label for="eng-comm-six-b">hardly</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="eng-comm-six-c" name="eng-comm-six" value="C">
                                    <label for="eng-comm-six-c">never</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="eng-comm-six-d" name="eng-comm-six" value="D">
                                    <label for="eng-comm-six-d">not</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                7.) &nbsp; Which of the following is the correct verb tense to fill in the blank space.
                            </label>
                            <div class="flt-question-box short-box">
                                Humans <span class="underline"></span> applying knowledge of genetics in prehistory with the domestication and breeding of plants and animals.
                            </div>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="eng-comm-seven-a" name="eng-comm-seven" value="A">
                                    <label for="eng-comm-seven-a">begin</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="eng-comm-seven-b" name="eng-comm-seven" value="B">
                                    <label for="eng-comm-seven-b">will begin</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="eng-comm-seven-c" name="eng-comm-seven" value="C">
                                    <label for="eng-comm-seven-c">began</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="eng-comm-seven-d" name="eng-comm-seven" value="D">
                                    <label for="eng-comm-seven-d">are beginning</label>
                                </div>
                            </div>
                        </div>

                        <div class="flt-instruction"> 
                            <p class="flt-part"> Part II: Writing</p>
                            <p> Directions: Read each item below. Write your answer on the spaces provided.</p>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                8.) &nbsp; Choose one (1) member of your family and write a simple sentence to describe him/her.
                            </label>
                            <div class="flt-content-flex content-column">
                                <textarea class="form-control custom-border" id="eng-writing-eight" name="eng-writing-eight" placeholder="" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                9.) &nbsp; Write your opinion in 3 paragraphs about the given issue below:
                            </label>
                            <div class="flt-content-flex content-column">
                                <label class="flt-questions">
                                    &nbsp; <b>How does education contribute to community development?</b>
                                </label>
                                <textarea class="form-control custom-border" id="eng-writing-nine" name="eng-writing-nine" placeholder="" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 3: Picture Questions with Sentence Answers -->
                <div class="form-step" id="step-3">
                    <div class="card-container flt-card-container">
                        <div class='card-header assessment-header-color'> <h5>LS 1: Communication Skills (FILIPINO) </h5></div>
                        <div class="flt-instruction"> 
                            <p class="flt-part"> Part I: Pagbasa</p>
                            <p> Panuto: Basahin ang bawat aytem. Piliin ang tamang sagot.</p>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                1.) &nbsp; Basahin ang sitwasyon at piliin ang tamang sagot na nagpapakita ng magalang na pananalita.
                            </label>
                            <div class="flt-question-box">
                                Nais mong pumasok sa learning center ngunit ang iyong guro at ang kanyang kausap ay nasa pintuan. Ano ang iyong sasabihin sa kanila?
                            </div>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="tag-comm-one-a" name="tag-comm-one" value="A">
                                    <label for="tag-comm-one-a">Tumabi po kayo.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="tag-comm-one-b" name="tag-comm-one" value="B">
                                    <label for="tag-comm-one-b">Dadaan po ako. Umalis po kayo.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="tag-comm-one-c" name="tag-comm-one" value="C">
                                    <label for="tag-comm-one-c">Makikiraan po.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="tag-comm-one-d" name="tag-comm-one" value="D">
                                    <label for="tag-comm-one-d">Pwede bang dumaan?</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                2.) &nbsp; Alin sa mga sumusunod na pangungusap ang may tamang bantas?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="tag-comm-two-a" name="tag-comm-two" value="A">
                                    <label for="tag-comm-two-a">Ang Araw ng Kalayaan ay ipinagdiriwang tuwing Hunyo 12?</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="tag-comm-two-b" name="tag-comm-two" value="B">
                                    <label for="tag-comm-two-b">Dadalo ka ba sa pagpupulong ngayong Huwebes.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="tag-comm-two-c" name="tag-comm-two" value="C">
                                    <label for="tag-comm-two-c">Naku, may sunog!</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="tag-comm-two-d" name="tag-comm-two" value="D">
                                    <label for="tag-comm-two-d">“Ang mga bata ay masayang naglalaro,”</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                3.) &nbsp; Basahin ang pangungusap at piliin ang pares ng mga salitang magkasalungat ang kahulugan.
                            </label>
                            <div class="flt-question-box">
                                Nakalulungkot isipin na sa mata ng batas, nakalalamang ang mayamang may pantustos sa mga tagapagtanggol kaysa sa maralitang kahit pangkain ay wala.
                            </div>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="tag-comm-three-a" name="tag-comm-three" value="A">
                                    <label for="tag-comm-three-a">Nakalalamang - Nakalulungkot</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="tag-comm-three-b" name="tag-comm-three" value="B">
                                    <label for="tag-comm-three-b">Tagapagtanggol - Batas</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="tag-comm-three-c" name="tag-comm-three" value="C">
                                    <label for="tag-comm-three-c">Pantustos - Pangkain</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="tag-comm-three-d" name="tag-comm-three" value="D">
                                    <label for="tag-comm-three-d">Mayaman - Maralita</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                4.) &nbsp; Basahin ang pangungusap at piliin ang kasingkahulugan ng salitang may
                                salungguhit.
                            </label>
                            <div class="flt-question-box">
                                Sa kasalukuyan, marami ang nagiging <u>balakid</u> sa pagtatagumpay ng mga kabataan.
                            </div>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="tag-comm-four-a" name="tag-comm-four" value="A">
                                    <label for="tag-comm-four-a">Pagpipighati</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="tag-comm-four-b" name="tag-comm-four" value="B">
                                    <label for="tag-comm-four-b">Gabay</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="tag-comm-four-c" name="tag-comm-four" value="C">
                                    <label for="tag-comm-four-c">Hadlang</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="tag-comm-four-d" name="tag-comm-four" value="D">
                                    <label for="tag-comm-four-d">Kaluwagan</label>
                                </div>
                            </div>
                        </div>

                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                Para sa aytem 5 – 6, basahin ang talata at piliin ang salitang dapat isulat sa patlang.
                            </label>
                            <div class="flt-question-box">
                                Isinilang si Jose Rizal sa Calamba, Laguna. Ang ina niyang si Teodora Alonzo ang unang guro niya. Matiyaga siyang magturo. Sadyang matalino si Jose Rizal kaya madali niyang natutuhan ang mga leksyon.
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                5.) &nbsp; Madaling matuto si Jose Rizal sapagkat siya ay <span class="underline"></span>.
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="tag-comm-five-a" name="tag-comm-five" value="A">
                                    <label for="tag-comm-five-a">masakitin</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="tag-comm-five-b" name="tag-comm-five" value="B">
                                    <label for="tag-comm-five-b">matiyaga</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="tag-comm-five-c" name="tag-comm-five" value="C">
                                    <label for="tag-comm-five-c">matalino</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="tag-comm-five-d" name="tag-comm-five" value="D">
                                    <label for="tag-comm-five-d">matapang</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                6.) &nbsp; Bilang guro, ang ina niyang si Teodora Alonzo ay kilala sa pagiging <span class="underline"></span>.
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="tag-comm-six-a" name="tag-comm-six" value="A">
                                    <label for="tag-comm-six-a">matiyaga</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="tag-comm-six-b" name="tag-comm-six" value="B">
                                    <label for="tag-comm-six-b">mapagtiis</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="tag-comm-six-c" name="tag-comm-six" value="C">
                                    <label for="tag-comm-six-c">mabait</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="tag-comm-six-d" name="tag-comm-six" value="D">
                                    <label for="tag-comm-six-d">mapagbigay</label>
                                </div>
                            </div>
                        </div>

                        <div class="flt-instruction"> 
                            <p class="flt-part"> Part II: Pagsulat</p>
                            <p> Panuto: Basahin ang aytem. Isulat ang sagot sa sagutang papel.</p>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                7.) &nbsp; Isulat sa patlang ang baybay sa Filipino ng salitang hiram na "<u>computer</u>".
                            </label>
                            <div class="flt-content-flex content-column">
                                <textarea class="form-control custom-border" id="tag-writing-seven" name="tag-writing-seven" placeholder="" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                8.) &nbsp; Sumulat ng isang talata na binubuo ng tatlo hanggang apat na pangungusap
                                tungkol sa mabuting dulot ng pagkakaroon ng trabaho.
                            </label>
                            <div class="flt-content-flex content-column">
                                <textarea class="form-control custom-border" id="tag-writing-eight" name="tag-writing-eight" placeholder="" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                9.) &nbsp; Isa sa mga suliraning kinahaharap natin ay ang pagkalulong sa masasamang bisyo. Kamakailan ay naisabatas sa Pilipinas ang “Nationwide Smoking Ban.” Ibigay ang iyong saloobin hinggil sa nasabing batas sa pamamagitan ng pagsulat ng sanaysay na binubuo ng dalawang talata na may tatlo o apat na pangungusap.
                            </label>
                            <div class="flt-content-flex content-column">
                                <textarea class="form-control custom-border" id="tag-writing-nine" name="tag-writing-nine" placeholder="" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 4: SCIENTIFIC LITERACY AND CRITICAL THINKING SKILLS -->
                <div class="form-step" id="step-4">
                    <div class="card-container flt-card-container">
                        <div class='card-header assessment-header-color'> <h5>LS 2: Scientific Literacy And Critical Thinking Skills </h5></div>
                        <div class="flt-instruction"> 
                            <p> Directions: Read each item. Choose the correct answer.</p>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                1.) &nbsp; Segregation of waste is very evident in schools and in the community. What is the best reason for this?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="science-one-a" name="science-one" value="A">
                                    <label for="science-one-a">It helps prevent pollution.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="science-one-b" name="science-one" value="B">
                                    <label for="science-one-b">It helps in the 5R process.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="science-one-c" name="science-one" value="C">
                                    <label for="science-one-c">It helps lessen health problems.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="science-one-d" name="science-one" value="D">
                                    <label for="science-one-d">All of the above</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                2.) &nbsp; Which of the following shows the correct way of handling flammable materials at home?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="science-two-a" name="science-two" value="A">
                                    <label for="science-two-a">Leaving the stove unattended when cooking.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="science-two-b" name="science-two" value="B">
                                    <label for="science-two-b">Flammable liquid not properly labelled and stored.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="science-two-c" name="science-two" value="C">
                                    <label for="science-two-c">Keeping lighters and matches out of reach of children.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="science-two-d" name="science-two" value="D">
                                    <label for="science-two-d">Candle left burning when everyone in the house is asleep.</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                3.) &nbsp; What electrical energy can be transformed when we switch on the electrical bulb?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="science-three-a" name="science-three" value="A">
                                    <label for="science-three-a">Sound energy</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="science-three-b" name="science-three" value="B">
                                    <label for="science-three-b">Light and heat energy</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="science-three-c" name="science-three" value="C">
                                    <label for="science-three-c">Light and sound energy</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="science-three-d" name="science-three" value="D">
                                    <label for="science-three-d">Chemical and sound energy</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                4.) &nbsp; Which of the following <b>DOES NOT</b> contribute to the greenhouse effect that
                                causes climate change?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="science-four-a" name="science-four" value="A">
                                    <label for="science-four-a">Combustion of fuel</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="science-four-b" name="science-four" value="B">
                                    <label for="science-four-b">Use of aerosol sprays</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="science-four-c" name="science-four" value="C">
                                    <label for="science-four-c">Dust from volcanic eruptions</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="science-four-d" name="science-four" value="D">
                                    <label for="science-four-d">Use of solar powered jeepney</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                5.) &nbsp; Which of the following situations demonstrate the use of simple machines?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="science-five-a" name="science-five" value="A">
                                    <label for="science-five-a">A girl eats a sandwich.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="science-five-b" name="science-five" value="B">
                                    <label for="science-five-b">A boy runs across a football field.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="science-five-c" name="science-five" value="C">
                                    <label for="science-five-c">A father drives a car to the office.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="science-five-d" name="science-five" value="D">
                                    <label for="science-five-d">A mother pushes stroller up a ramp.</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                6.) &nbsp; Which of the following <b>DOES NOT</b> describe the inner core of the earth?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="science-six-a" name="science-six" value="A">
                                    <label for="science-six-a">It is solid.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="science-six-b" name="science-six" value="B">
                                    <label for="science-six-b">It is liquid.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="science-six-c" name="science-six" value="C">
                                    <label for="science-six-c">It is the hottest part of the earth.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="science-six-d" name="science-six" value="D">
                                    <label for="science-six-d">It is composed of nickel and iron.</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                7.) &nbsp; What causes mushrooms to grow and multiply after lightning?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="science-seven-a" name="science-seven" value="A">
                                    <label for="science-seven-a">Mushrooms increase their number of fruiting bodies after lightning.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="science-seven-b" name="science-seven" value="B">
                                    <label for="science-seven-b">Mushrooms react when exposed to a burst of high-voltage electricity.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="science-seven-c" name="science-seven" value="C">
                                    <label for="science-seven-c">Through lightning, mushrooms are given themselves a reproductive boost.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="science-seven-d" name="science-seven" value="D">
                                    <label for="science-seven-d">All of the above</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                8.) &nbsp; What makes pure substance different from mixture?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="science-eight-a" name="science-eight" value="A">
                                    <label for="science-eight-a">Pure substance has different properties while mixture has constant properties.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="science-eight-b" name="science-eight" value="B">
                                    <label for="science-eight-b">Pure substance has combination of substances while mixture has no combination.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="science-eight-c" name="science-eight" value="C">
                                    <label for="science-eight-c">Pure substance contains two or more molecules while mixture contains one kind of molecule.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="science-eight-d" name="science-eight" value="D">
                                    <label for="science-eight-d">Pure substance cannot be separated into any other kind while mixture is a combination of substances.</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                9.) &nbsp; A snake eats a chick that has eaten a worm that has fed on a plant. What trophic level does the plant belong to?
                            </label>
                            <div class="flt-question-box short-box">
                                <img src="../../assets/img/FLT_Science_Question_9.jpg" alt="Descriptive text" style="max-width: 100%; height: auto;">
                            </div>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="science-nine-a" name="science-nine" value="A">
                                    <label for="science-nine-a">Primary consumer</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="science-nine-b" name="science-nine" value="B">
                                    <label for="science-nine-b">Producer</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="science-nine-c" name="science-nine" value="C">
                                    <label for="science-nine-c">Secondary consumer</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="science-nine-d" name="science-nine" value="D">
                                    <label for="science-nine-d">tertiary consumer</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                10.) &nbsp; Modern Medicine is one of the outstanding contributions of Science especially nowadays that various ailments have surfaced. Which one below is a good example of this?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="science-ten-a" name="science-ten" value="A">
                                    <label for="science-ten-a">Discovery of a bluetooth speaker</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="science-ten-b" name="science-ten" value="B">
                                    <label for="science-ten-b">Discovery of computers and cellphones</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="science-ten-c" name="science-ten" value="C">
                                    <label for="science-ten-c">Production of various hand washing solutions</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="science-ten-d" name="science-ten" value="D">
                                    <label for="science-ten-d">Discovery of vaccines for contagious diseases</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                11.) &nbsp; If you want to join a car race, the type of car you should use must have <span class="underline"></span>
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="science-eleven-a" name="science-eleven" value="A">
                                    <label for="science-eleven-a">a small engine and heavy body.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="science-eleven-b" name="science-eleven" value="B">
                                    <label for="science-eleven-b">large engine and heavy body.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="science-eleven-c" name="science-eleven" value="C">
                                    <label for="science-eleven-c">a small engine and light weight body.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="science-eleven-d" name="science-eleven" value="D">
                                    <label for="science-eleven-d">a large engine and light weight body.</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                12.) &nbsp; A patient, in comatose state with a life support system, is showing signs of survival. His low-income earner family is having a hard time with the situation. If you happen to be a member of the family, what is the wise step to do?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="science-twelve-a" name="science-twelve" value="A">
                                    <label for="science-twelve-a">Call the doctor and yell at him.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="science-twelve-b" name="science-twelve" value="B">
                                    <label for="science-twelve-b">Instruct the doctor to remove the life support.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="science-twelve-c" name="science-twelve" value="C">
                                    <label for="science-twelve-c">Blame your parents for not being good providers.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="science-twelve-d" name="science-twelve" value="D">
                                    <label for="science-twelve-d">Ask assistance from DSWD for financial support.</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                13.) &nbsp; The statements given are the steps in the process of fertilization. Which of the following gives the correct order of the steps?
                            </label>
                            <div class="flt-question-box short-box pre-class"> 1 - Fertilization occurs.
                            2 - Ovary releases the eggs.
                            3 - Sperm penetrates the mature egg.
                            4 - Sperm cells and egg cell meet in the fallopian tubes.
                            </div>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="science-thirteen-a" name="science-thirteen" value="A">
                                    <label for="science-thirteen-a">1, 2, 3, 4</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="science-thirteen-b" name="science-thirteen" value="B">
                                    <label for="science-thirteen-b">2, 4, 3, 1</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="science-thirteen-c" name="science-thirteen" value="C">
                                    <label for="science-thirteen-c">3, 4, 2, 1</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="science-thirteen-d" name="science-thirteen" value="D">
                                    <label for="science-thirteen-d">4, 2, 3, 1</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




                <!-- Step 5: MATHEMATICAL AND PROBLEM SOLVING SKILLS -->
                <div class="form-step" id="step-5">
                    <div class="card-container flt-card-container">
                        <div class='card-header assessment-header-color'> <h5>LS 3: Mathetical and Problem Solving Skills </h5></div>
                        <div class="flt-instruction"> 
                            <p> Directions: Read each item. Choose the correct answer.</p>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                1.) &nbsp; What is the sum of the stars inside the box?
                            </label>
                            <div class="flt-question-box short-box">
                                <img src="../../assets/img/FLT_HSMath_Question_1.jpg" alt="Descriptive text" style="max-width: 100%; height: auto;">
                            </div>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="math-one-a" name="math-one" value="A">
                                    <label for="math-one-a">10</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-one-b" name="math-one" value="B">
                                    <label for="math-one-b">11</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-one-c" name="math-one" value="C">
                                    <label for="math-one-c">12</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-one-d" name="math-one" value="D">
                                    <label for="math-one-d">13</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                2.) &nbsp; Which of the following symbols must be placed in the box?
                            </label>
                            <div class="flt-question-box short-box">
                                <img src="../../assets/img/FLT_HSMath_Question_2.jpg" alt="Descriptive text" style="max-width: 100%; height: auto;">
                            </div>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="math-two-a" name="math-two" value="A">
                                    <label for="math-two-a"> > </label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-two-b" name="math-two" value="B">
                                    <label for="math-two-b"> < </label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-two-c" name="math-two" value="C">
                                    <label for="math-two-c"> = </label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-two-d" name="math-two" value="D">
                                    <label for="math-two-d"> ≠ </label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                3.) &nbsp; Jia wants to buy an appliance that costs ₱ 4,950.00. If she already has ₱ 2,100.00 for it, how much more does she need?
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="math-three-a" name="math-three" value="A">
                                    <label for="math-three-a">₱ 2,050.00</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-three-b" name="math-three" value="B">
                                    <label for="math-three-b">₱ 2,350.00</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-three-c" name="math-three" value="C">
                                    <label for="math-three-c">₱ 2,580.00</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-three-d" name="math-three" value="D">
                                    <label for="math-three-d">₱ 2,850.00</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                4.) &nbsp; The product of 59,736 and 600 is
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="math-four-a" name="math-four" value="A">
                                    <label for="math-four-a">29,868,000</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-four-b" name="math-four" value="B">
                                    <label for="math-four-b">34,761,600</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-four-c" name="math-four" value="C">
                                    <label for="math-four-c">35,625,600</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-four-d" name="math-four" value="SD">
                                    <label for="math-four-d">35,841,600</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                5.) &nbsp; Mildred needs to save money to purchase a washing machine worth ₱7,500.00. If she plans to buy it at the end of 6 months, how much should she save every month?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="math-five-a" name="math-five" value="A">
                                    <label for="math-five-a">₱1,000.00</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-five-b" name="math-five" value="B">
                                    <label for="math-five-b">₱1,250.00</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-five-c" name="math-five" value="C">
                                    <label for="math-five-c">₱1,500.00</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-five-d" name="math-five" value="D">
                                    <label for="math-five-d">₱1,750.00</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                6.) &nbsp; Karding is a member of a cooperative with a shared capital of ₱5,500.00. Last Monday, he deposited ₱3,250.00. On the following day, he borrowed ₱2,000.00 for his poultry construction. How much is left in his total share?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="math-six-a" name="math-six" value="A">
                                    <label for="math-six-a">₱6,450.00</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-six-b" name="math-six" value="B">
                                    <label for="math-six-b">₱6,550.00</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-six-c" name="math-six" value="C">
                                    <label for="math-six-c">₱6,650.00</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-six-d" name="math-six" value="D">
                                    <label for="math-six-d">₱6,750.00</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                7.) &nbsp; Aling Sela cleans bottles for a local junkshop in their barangay. If the pay is ₱ 1.75 per bottle, how many bottles must she clean to earn ₱ 1,050.00?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="math-seven-a" name="math-seven" value="A">
                                    <label for="math-seven-a">300</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-seven-b" name="math-seven" value="B">
                                    <label for="math-seven-b">400</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-seven-c" name="math-seven" value="C">
                                    <label for="math-seven-c">500</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-seven-d" name="math-seven" value="D">
                                    <label for="math-seven-d">600</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                8.) &nbsp; In Mrs. Clarito's farm, the ratio of goat to cow is 5:6. If there are 25 goats, how many cows does she have?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="math-eight-a" name="math-eight" value="A">
                                    <label for="math-eight-a">10</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-eight-b" name="math-eight" value="B">
                                    <label for="math-eight-b">20</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-eight-c" name="math-eight" value="C">
                                    <label for="math-eight-c">30</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-eight-d" name="math-eight" value="D">
                                    <label for="math-eight-d">40</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                9.) &nbsp; Six years from now, Marc will be four times his age today. What is the correct equation in terms of Marc's present age?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="math-nine-a" name="math-nine" value="A">
                                    <label for="math-nine-a"> x + 6 = 4x </label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-nine-b" name="math-nine" value="B">
                                    <label for="math-nine-b"> x = 4x + 6 </label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-nine-c" name="math-nine" value="C">
                                    <label for="math-nine-c"> 4x = x – 6 </label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-nine-d" name="math-nine" value="D">
                                    <label for="math-nine-d"> x = 6 + 4x </label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                10.) &nbsp; Find the perimeter of the regular pentagon below.
                            </label>
                            <div class="flt-question-box short-box">
                                <img src="../../assets/img/FLT_HSMath_Question_10.jpg" alt="Descriptive text" style="max-width: 100%; height: auto;">
                            </div>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="math-ten-a" name="math-ten" value="A">
                                    <label for="math-ten-a">21 cm.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-ten-b" name="math-ten" value="B">
                                    <label for="math-ten-b">28 cm.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-ten-c" name="math-ten" value="C">
                                    <label for="math-ten-c">35 cm.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-ten-d" name="math-ten" value="D">
                                    <label for="math-ten-d">42 cm.</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                11.) &nbsp; The Leonin family used 90 kWh for their electric consumption for the month of August. If the power consumption costs ₱9.7514 per kWh, how much is their electric bill?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="math-eleven-a" name="math-eleven" value="A">
                                    <label for="math-eleven-a">₱870.63</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-eleven-b" name="math-eleven" value="B">
                                    <label for="math-eleven-b">₱875.63</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-eleven-c" name="math-eleven" value="C">
                                    <label for="math-eleven-c">₱876.63</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-eleven-d" name="math-eleven" value="D">
                                    <label for="math-eleven-d">₱877.63</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                12.) &nbsp; Mrs. Aguilar is at the 25th floor of a building. She went 4 floors up to submit her reports. Then she went 6 floors down to attend a meeting. At which floor is the meeting?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="math-twelve-a" name="math-twelve" value="A">
                                    <label for="math-twelve-a">15th</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-twelve-b" name="math-twelve" value="B">
                                    <label for="math-twelve-b">23rd</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-twelve-c" name="math-twelve" value="C">
                                    <label for="math-twelve-c">29th</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-twelve-d" name="math-twelve" value="D">
                                    <label for="math-twelve-d">35th</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                13.) &nbsp; In a recent Barangay election, Mr. Reyes won as Barangay Chairman with 3,074 votes. If there are 5,800 voters in the barangay, what percentage voted for Mr.Reyes?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="math-thirteen-a" name="math-thirteen" value="A">
                                    <label for="math-thirteen-a">12%</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-thirteen-b" name="math-thirteen" value="B">
                                    <label for="math-thirteen-b">47%</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-thirteen-c" name="math-thirteen" value="C">
                                    <label for="math-thirteen-c">53%</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-thirteen-d" name="math-thirteen" value="D">
                                    <label for="math-thirteen-d">88%</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                14.) &nbsp; The bar graph shows the enrolment of ALS Community Learning Center in Barangay Esperanza for calendar years 2014-2018. What year has the least number of enrollees?
                            </label>
                            <div class="flt-question-box short-box">
                                <img src="../../assets/img/FLT_HSMath_Question_14.jpg" alt="Descriptive text" style="max-width: 100%; height: auto;">
                            </div>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="math-fourteen-a" name="math-fourteen" value="A">
                                    <label for="math-fourteen-a">2014</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-fourteen-b" name="math-fourteen" value="B">
                                    <label for="math-fourteen-b">2015</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-fourteen-c" name="math-fourteen" value="C">
                                    <label for="math-fourteen-c">2016</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-fourteen-d" name="math-fourteen" value="D">
                                    <label for="math-fourteen-d">2017</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                15.) &nbsp; Rey wants to move the sofa to the truck using a ramp. Based on the figure, find the length of the ramp.
                            </label>
                            <div class="flt-question-box short-box">
                                <img src="../../assets/img/FLT_HSMath_Question_15.jpg" alt="Descriptive text" style="max-width: 100%; height: auto;">
                            </div>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="math-fifteen-a" name="math-fifteen" value="A">
                                    <label for="math-fifteen-a">5 ft.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-fifteen-b" name="math-fifteen" value="B">
                                    <label for="math-fifteen-b">9 ft.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-fifteen-c" name="math-fifteen" value="C">
                                    <label for="math-fifteen-c">16 ft.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-fifteen-d" name="math-fifteen" value="D">
                                    <label for="math-fifteen-d">25 ft.</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 6: LIFE AND CAREER SKILLS -->
                <div class="form-step" id="step-5">
                    <div class="card-container flt-card-container">
                        <div class='card-header assessment-header-color'> <h5>LS 4: Life and Career Skills </h5></div>
                        <div class="flt-instruction"> 
                            <p> Panuto: Basahin ang bawat aytem. Piliin ang tamang sagot.</p>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                1.) &nbsp; Gumagawa ng mga hair accessories si Susan subalit nahihirapan siyang ibenta ito. Anong ahensya ng gobyerno ang maaari niyang lapitan para lumago ang negosyo niya?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="life-one-a" name="life-one" value="A">
                                    <label for="life-one-a"><i>Department of Agriculture (DA)</i></label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="life-one-b" name="life-one" value="B">
                                    <label for="life-one-b"><i>Department of Trade and Industry (DTI)</i></label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="life-one-c" name="life-one" value="C">
                                    <label for="life-one-c"><i>Department of Environment and Natural Resources (DENR)</i></label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="life-one-d" name="life-one" value="D">
                                    <label for="life-one-d"><i>Department of Tourism (DOT)</i></label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                2.) &nbsp; Si Melanie ay gumawa ng mashed camote with milk dahil ang ibinebenta lang sa kantina ay nilagang kamote. Bilang entreprenyur, ano ang katangiang ipinamalas niya?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="life-two-a" name="life-two" value="A">
                                    <label for="life-two-a"> May tiwala sa sarili </label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="life-two-b" name="life-two" value="B">
                                    <label for="life-two-b"> Malikhain </label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="life-two-c" name="life-two" value="C">
                                    <label for="life-two-c"> Masinop </label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="life-two-d" name="life-two" value="D">
                                    <label for="life-two-d"> Masipag </label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                3.) &nbsp; Nagsanay si Maldo sa <i>Technical Education Skills and Development Authority (TESDA)</i> ng electronics. Saan siya pwedeng mag-apply ng trabaho pagkatapos magsanay?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="life-three-a" name="life-three" value="A">
                                    <label for="life-three-a"><i>Welding Shop</i></label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="life-three-b" name="life-three" value="B">
                                    <label for="life-three-b"><i>Car Wash Shop</i></label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="life-three-c" name="life-three" value="C">
                                    <label for="life-three-c"><i>Vulcanizing Shop</i></label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="life-three-d" name="life-three" value="D">
                                    <label for="life-three-d"><i>Computer Repair Shop</i></label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                4.) &nbsp; Maagang binubuksan ni Mang Roldan ang pinapasukang Auto Repair Shop. Tumatanggap siya ng mga mamimili kahit lampas na sa oras at sinisigurado niyang maayos ang kanyang trabaho. Ano ang magandang katangiang ipinapakita niya bilang isang empleyado?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="life-four-a" name="life-four" value="A">
                                    <label for="life-four-a">Masayahin</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="life-four-b" name="life-four" value="B">
                                    <label for="life-four-b">Masipag</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="life-four-c" name="life-four" value="C">
                                    <label for="life-four-c">Mahusay</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="life-four-d" name="life-four" value="D">
                                    <label for="life-four-d">Mapagbigay</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                5.) &nbsp; Ano ang tamang pagkakasunod-sunod ng mga hakbang na dapat gawin sa mga kagamitang panluto pagkatapos gamitin?
                            </label>
                            <div class="flt-question-box short-box pre-class"> 1 - Hugasan ang mga kasangkapang panluto.
                            2 - Punasan ang mga kasangkapang panluto.
                            3 - Ihiwalay ang mga kasangkapang ginamit na babasagin.
                            4 - Ilagay sa tamang lalagyan ang mga kasangkapang panluto.
                            </div>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="life-five-a" name="life-five" value="A">
                                    <label for="life-five-a">1, 3, 4, 2</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="life-five-b" name="life-five" value="B">
                                    <label for="life-five-b">3, 1, 2, 4</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="life-five-c" name="life-five" value="C">
                                    <label for="life-five-c">2, 3, 4, 1</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="life-five-d" name="life-five" value="D">
                                    <label for="life-five-d">4, 1, 2, 3</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                6.) &nbsp; Alin sa mga pangungusap ang <b>HINDI</b> nagpapakita ng pagsasaalang-alang sa kaligtasan ng isang manggagawa?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="life-six-a" name="life-six" value="A">
                                    <label for="life-six-a">Pagsusuot ng <i>mask</i> o salamin habang nagwewelding at nagkukumpuni ng sasakyan.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="life-six-b" name="life-six" value="B">
                                    <label for="life-six-b">Pagsusuot ng matigas na sombrero o <i>helmet</i> sa lugar ng konstruksiyon.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="life-six-c" name="life-six" value="C">
                                    <label for="life-six-c">Pagsusuot ng gomang guwantes sa pagputol ng kable o kawad ng kuryente.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="life-six-d" name="life-six" value="D">
                                    <label for="life-six-d">Pagsusuot ng sando habang nagtatanim sa ilalim ng sikat ng araw.</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                7.) &nbsp; Alin ang <b>HINDI</b> mabisang pamamaraan upang dumami ang mamimili ng isang tindahan?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="life-seven-a" name="life-seven" value="A">
                                    <label for="life-seven-a">Tugunan ang pangangailangan ng mamimili.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="life-seven-b" name="life-seven" value="B">
                                    <label for="life-seven-b">Igalang ang desisyon ng mamimili.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="life-seven-c" name="life-seven" value="C">
                                    <label for="life-seven-c">Magbigay ng mura ngunit walang kalidad na serbisyo o produkto.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="life-seven-d" name="life-seven" value="D">
                                    <label for="life-seven-d">Siguraduhing maganda at mataas ang kalidad ng serbisyo o produkto.</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                8.) &nbsp; Magtatayo ka ng maliit na negosyo ng puto at kutsinta. Isang hotel ang nagnais na sila ay suplayan ng isang libong piraso kada araw. Ano ang iyong gagawin?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="life-eight-a" name="life-eight" value="A">
                                    <label for="life-eight-a">Magdagdag ng tauhan</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="life-eight-b" name="life-eight" value="B">
                                    <label for="life-eight-b">Bawasan ng gata para makatipid</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="life-eight-c" name="life-eight" value="C">
                                    <label for="life-eight-c">Kumuha na ng buong bayad upang maging kapital</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="life-eight-d" name="life-eight" value="D">
                                    <label for="life-eight-d">Dagdagan ng yeast para lumaki ang puto at kutsinta</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                9.) &nbsp; Ipinapakita sa pie chart ang buwanang budget ni Nanay Lucing para sa kanyang pamilya. Ano ang nararapat niyang gawin para matugunan ang badyet sa pagkain?
                            </label>
                            <div class="flt-question-box short-box">
                                <img src="../../assets/img/FLT_Life_Question_9.jpg" alt="Descriptive text" style="max-width: 100%; height: auto;">
                            </div>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="life-nine-a" name="life-nine" value="A">
                                    <label for="life-nine-a">Sundin ang nakalaang badyet para sa pagkain</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="life-nine-b" name="life-nine" value="B">
                                    <label for="life-nine-b">Humiram ng pera para matugunan ang pangangailangan sa pagkain</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="life-nine-c" name="life-nine" value="C">
                                    <label for="life-nine-c">Bawasan ang ipon at idagdag sa badyet para sa pagkain</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="life-nine-d" name="life-nine" value="D">
                                    <label for="life-nine-d">Bumili ng kagamitang pangkusina galing sa badyet ng pagkain</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                10.) &nbsp; Si Mario ay pinagkalooban ng bangko na pautangin ng isang daang libong piso (P100,000.00). Alin ang dapat niyang gawin?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="life-ten-a" name="life-ten" value="A">
                                    <label for="life-ten-a">Bumili ng kulang na kasangkapan sa bahay</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="life-ten-b" name="life-ten" value="B">
                                    <label for="life-ten-b">Magbakasyon sa ibang bansa</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="life-ten-c" name="life-ten" value="C">
                                    <label for="life-ten-c">Ipahiram ang perang nakuha sa kaibigan</i></label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="life-ten-d" name="life-ten" value="D">
                                    <label for="life-ten-d">Kumonsulta sa may alam sa negosyo</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Step 7: UNDERSTANDING THE SELF AND SOCIETY -->
                <div class="form-step" id="step-5">
                    <div class="card-container flt-card-container">
                        <div class='card-header assessment-header-color'> <h5>LS 5: Understanding the Self and Society </h5></div>
                        <div class="flt-instruction"> 
                            <p> Panuto: Basahin ang bawat aytem. Piliin ang tamang sagot.</p>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                1.) &nbsp; Ano ang pinakatamang gawin kapag inabutan ka ng lindol sa learning center?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="society-one-a" name="society-one" value="A">
                                    <label for="society-one-a">Ligpitin ang mahahalagang bagay.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="society-one-b" name="society-one" value="B">
                                    <label for="society-one-b">Tumakbo nang mabilis palabas.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="society-one-c" name="society-one" value="C">
                                    <label for="society-one-c">Sumandal sa mataas na pader.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="society-one-d" name="society-one" value="D">
                                    <label for="society-one-d">Magtago sa ilalim ng matibay na mesa.</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                2.) &nbsp; Batay sa larawan, alin ang tamang pagkakasunod-sunod ng mga kaganapan sa buhay ng isang tao?
                            </label>
                            <div class="flt-question-box short-box">
                                <img src="../../assets/img/FLT_Self_Society_Question_2.jpg" alt="Descriptive text" style="max-width: 100%; height: auto;">
                            </div>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="society-two-a" name="society-two" value="A">
                                    <label for="society-two-a"> 3 – 2 – 4 – 1 </label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="society-two-b" name="society-two" value="B">
                                    <label for="society-two-b"> 4 – 3 – 2 – 1 </label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="society-two-c" name="society-two" value="C">
                                    <label for="society-two-c"> 1 – 4 – 2 – 3 </label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="society-two-d" name="society-two" value="D">
                                    <label for="society-two-d"> 2 – 3 – 4 – 1 </label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                3.) &nbsp; Napansin mong alas dose na ng gabi ngunit malakas pa rin ang tugtog at boses ng iyong kapitbahay. Hindi makatulog ang pamilya mo. Ano ang dapat mong gawin?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="society-three-a" name="society-three" value="A">
                                    <label for="society-three-a">Kausapin siya nang mahinahon.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="society-three-b" name="society-three" value="B">
                                    <label for="society-three-b">Igalang ang karapatan niya.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="society-three-c" name="society-three" value="C">
                                    <label for="society-three-c">Tumawag agad ng pulis.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="society-three-d" name="society-three" value="D">
                                    <label for="society-three-d">Tiisin na lang ang ingay.</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                4.) &nbsp; Maagang nag-asawa sina Celso at Jade. Nagkaanak agad sila ngunit naging iresponsable si Celso. Humantong ito sa kanilang paghihiwalay. May karapatan bang humingi si Jade ng suportang pinansyal kay Celso para sa kanilang anak?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="society-four-a" name="society-four" value="A">
                                    <label for="society-four-a">Hindi, dahil hiwalay na sila.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="society-four-b" name="society-four" value="B">
                                    <label for="society-four-b">Hindi, dahil sandali lang naman silang nagsama.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="society-four-c" name="society-four" value="C">
                                    <label for="society-four-c">Oo, may pananagutan si Celso sa bata.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="society-four-d" name="society-four" value="D">
                                    <label for="society-four-d">Oo, dahil may trabaho naman si Celso.</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                5.) &nbsp; Nakita ni Luis ang isang matandang babae na balak tumawid sa "pedestrian lane." Nilapitan niya ang matanda at inalalayan sa pagtawid. Ano ang katangiang taglay niya?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="society-five-a" name="society-five" value="A">
                                    <label for="society-five-a">Matiyaga</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="society-five-b" name="society-five" value="B">
                                    <label for="society-five-b">Matulungin</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="society-five-c" name="society-five" value="C">
                                    <label for="society-five-c">Mapag-aruga</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="society-five-d" name="society-five" value="D">
                                    <label for="society-five-d">Magalang</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                6.) &nbsp; Tuwing Mahal na Araw ay nag-aayuno ang mga Katoliko. Iniiwasan nila mula Miyerkules ng Abo o Ash Wednesday hanggang Biyernes Santo ang pagkain ng karne ngunit higit sa lahat sinisikap nilang baguhin ang masasamang gawi. Anong paniniwala ang katulad nito sa mga kapatid nating Muslim?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="society-six-a" name="society-six" value="A">
                                    <label for="society-six-a">Eid’l Adha</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="society-six-b" name="society-six" value="B">
                                    <label for="society-six-b">Ramadan</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="society-six-c" name="society-six" value="C">
                                    <label for="society-six-c">Hajj o Pamamanata</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="society-six-d" name="society-six" value="D">
                                    <label for="society-six-d">Eid'l Fit'r</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                7.) &nbsp; Aling serbisyo sa kanilang barangay ang mas mapapakinabangan ni Mang Arman na may sakit na Tuberkulosis?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="society-seven-a" name="society-seven" value="A">
                                    <label for="society-seven-a">Pagkakaroon ng pribadong botika sa kanilang barangay.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="society-seven-b" name="society-seven" value="B">
                                    <label for="society-seven-b">Libreng gamutan sa Barangay Health Center.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="society-seven-c" name="society-seven" value="C">
                                    <label for="society-seven-c">Nakahandang paunang lunas sa barangay hall.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="society-seven-d" name="society-seven" value="D">
                                    <label for="society-seven-d">Pagkakaroon ng pribadong pagamutan sa barangay.</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                8.) &nbsp; Nangangailangan ng tubero ang Water District ng Malabon. Sino sa mga aplikante ang dapat tanggapin?
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="society-eight-a" name="society-eight" value="A">
                                    <label for="society-eight-a">Si Roel na isang Inhinyerong Sibil</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="society-eight-b" name="society-eight" value="B">
                                    <label for="society-eight-b">Si Perla na may sertipiko sa pagtutubero.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="society-eight-c" name="society-eight" value="C">
                                    <label for="society-eight-c">Si Agnes na nagbebenta ng tubo.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="society-eight-d" name="society-eight" value="D">
                                    <label for="society-eight-d">Si Anton na may sertipiko sa pagmemekaniko.</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                9.) &nbsp; Ang kapatid ni Ara ay may polio. Sinamahan niya ito sa opisina ng <i>Person With Disability (PWD)</i> para mag-apply ng ID. Ang mga sumusunod ay mga benepisyo ng isang PWD MALIBAN sa <span class="underline"></span>.
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="society-nine-a" name="society-nine" value="A">
                                    <label for="society-nine-a">diskwento sa gamot</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="society-nine-b" name="society-nine" value="B">
                                    <label for="society-nine-b">diskwento sa pagkain</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="society-nine-c" name="society-nine" value="C">
                                    <label for="society-nine-c">diskwento sa pamasahe</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="society-nine-d" name="society-nine" value="D">
                                    <label for="society-nine-d">diskwento sa cellphone load</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                10.) &nbsp; 10.Ang isang barangay ay may ilang ektaryang lupa na may maraming punongkahoy. Ipinagbili ng may-ari ang lupa. Kahit may kamahalan ang halaga nito ay agad itong binili ng isang milyonaryo upang gawing subdibisyon. Ano ang magiging epekto nito sa kapaligiran?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="society-ten-a" name="society-ten" value="A">
                                    <label for="society-ten-a">Mawawalan ng likas na pananggalang sa baha.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="society-ten-b" name="society-ten" value="B">
                                    <label for="society-ten-b">Magdudulot ito ng magandang klima.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="society-ten-c" name="society-ten" value="C">
                                    <label for="society-ten-c">Magiging maaliwalas ang kapaligiran.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="society-ten-d" name="society-ten" value="D">
                                    <label for="society-ten-d">Madali nang linisin ang paligid dahil sementado na ito.</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 8: DIGITAL CITIZENSHIP -->
                <div class="form-step" id="step-5">
                    <div class="card-container flt-card-container">
                        <div class='card-header assessment-header-color'> <h5>LS 6: Digital Society </h5></div>
                        <div class="flt-instruction"> 
                            <p> Directions: Read each item. Choose the correct answer.</p>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                1.) &nbsp; Donna wants to save personal files on her computer. Which characteristic of the
                                computer is most useful for her?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="digital-one-a" name="digital-one" value="A">
                                    <label for="digital-one-a">Speed</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="digital-one-b" name="digital-one" value="B">
                                    <label for="digital-one-b">Accuracy</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="digital-one-c" name="digital-one" value="C">
                                    <label for="digital-one-c">Display</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="digital-one-d" name="digital-one" value="D">
                                    <label for="digital-one-d">Storage</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                2.) &nbsp; Mario wants to use his computer. What is the first thing he needs to do?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="digital-two-a" name="digital-two" value="A">
                                    <label for="digital-two-a" >Click Stand By </label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="digital-two-b" name="digital-two" value="B">
                                    <label for="digital-two-b"> Turn on the WiFi </label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="digital-two-c" name="digital-two" value="C">
                                    <label for="digital-two-c"> Click on Restart </label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="digital-two-d" name="digital-two" value="D">
                                    <label for="digital-two-d"> Press Power Button </label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                3.) &nbsp; Which of the following statements about microcomputers is correct?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="digital-three-a" name="digital-three" value="A">
                                    <label for="digital-three-a">Calculator captures images.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="digital-three-b" name="digital-three" value="B">
                                    <label for="digital-three-b">Tablet PC is bigger than laptop.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="digital-three-c" name="digital-three" value="C">
                                    <label for="digital-three-c">Desktop computer is portable.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="digital-three-d" name="digital-three" value="D">
                                    <label for="digital-three-d">Smartphone is used for calls and text messages.</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                4.) &nbsp; What is the basic function of a computer mouse?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="digital-four-a" name="digital-four" value="A">
                                    <label for="digital-four-a">Displays video</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="digital-four-b" name="digital-four" value="B">
                                    <label for="digital-four-b">Prints documents</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="digital-four-c" name="digital-four" value="C">
                                    <label for="digital-four-c">Selects menu commands</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="digital-four-d" name="digital-four" value="D">
                                    <label for="digital-four-d">Performs basic computation</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                5.) &nbsp; What software application is more appropriate in writing an excuse letter?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="digital-five-a" name="digital-five" value="A">
                                    <label for="digital-five-a">Spreadsheet</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="digital-five-b" name="digital-five" value="B">
                                    <label for="digital-five-b">Word Processing</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="digital-five-c" name="digital-five" value="C">
                                    <label for="digital-five-c">Desktop Publishing</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="digital-five-d" name="digital-five" value="D">
                                    <label for="digital-five-d">Powerpoint Presentation</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                6.) &nbsp; Mr. Ramos wants to copy his research work on his flash drive. What is the correct order of steps?
                            </label>
                            <div class="flt-question-box short-box pre-class">1. Select open folder to view.
                                2. Get a menu of option for using the drive.
                                3. Insert the flash drive in the USB port.
                                4. Bring up a window showing the flash drive.
                            </div>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="digital-six-a" name="digital-six" value="A">
                                    <label for="digital-six-a">1, 2, 3, 4</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="digital-six-b" name="digital-six" value="B">
                                    <label for="digital-six-b">2, 3, 4, 1</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="digital-six-c" name="digital-six" value="C">
                                    <label for="digital-six-c">3, 4, 2, 1</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="digital-six-d" name="digital-six" value="D">
                                    <label for="digital-six-d">4, 1, 2, 3</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                7.) &nbsp; Jaime wants to save his project into a USB flash drive. What is the correct order
                                of steps to save it?
                            </label>
                            <div class="flt-question-box short-box pre-class">1. Click File.
                                2. Choose Save As.
                                3. Name the file and click save.
                                4. Insert the flash drive to USB slot.
                            </div>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="digital-seven-a" name="digital-seven" value="A">
                                    <label for="digital-seven-a">3, 4, 2, 1</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="digital-seven-b" name="digital-seven" value="B">
                                    <label for="digital-seven-b">2, 3, 1, 4</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="digital-seven-c" name="digital-seven" value="C">
                                    <label for="digital-seven-c">1, 2, 3, 4</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="digital-seven-d" name="digital-seven" value="D">
                                    <label for="digital-seven-d">4, 1, 2, 3</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                8.) &nbsp; Nellie wants to increase the font size of her resume. After selecting all the text, which icon should she click?
                            </label>
                            <div class="flt-content-flex content-row">
                                <div class="radio-option">
                                    <input type="radio" id="digital-eight-a" name="digital-eight" value="A">
                                    <img src="../../assets/img/FLT_Digital_Question_8_A.jpg" alt="Descriptive text">
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="digital-eight-b" name="digital-eight" value="B">
                                    <img src="../../assets/img/FLT_Digital_Question_8_B.jpg" alt="Descriptive text">
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="digital-eight-c" name="digital-eight" value="B">
                                    <img src="../../assets/img/FLT_Digital_Question_8_C.jpg" alt="Descriptive text">
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="digital-eight-d" name="digital-eight" value="D">
                                    <img src="../../assets/img/FLT_Digital_Question_8_D.jpg" alt="Descriptive text">
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                9.) &nbsp; Linda wants to put slide effects on her presentation for their family reunion. Which tab should she select?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="digital-nine-a" name="digital-nine" value="A">
                                    <label for="digital-nine-a">Design</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="digital-nine-b" name="digital-nine" value="B">
                                    <label for="digital-nine-b">Format</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="digital-nine-c" name="digital-nine" value="C">
                                    <label for="digital-nine-c">Home</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="digital-nine-d" name="digital-nine" value="D">
                                    <label for="digital-nine-d">Transition</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                10.) &nbsp; 10.Nona is chatting with a friend. Which of the following should she avoid?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="digital-ten-a" name="digital-ten" value="A">
                                    <label for="digital-ten-a">Gossiping</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="digital-ten-b" name="digital-ten" value="B">
                                    <label for="digital-ten-b">Politeness</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="digital-ten-c" name="digital-ten" value="C">
                                    <label for="digital-ten-c">Respect one's opinion</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="digital-ten-d" name="digital-ten" value="D">
                                    <label for="digital-ten-d">End conversation properly</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 8: Listening Speaking English -->
                <div class="form-step" id="step-5">
                    <div class="card-container flt-card-container">
                        <div class='card-header assessment-header-color'> <h5>LS 1: ENGLISH </h5></div>
                        <div class="flt-instruction"> 
                            <p class="flt-part"> Part III: Listening/Speaking</p>
                            <p> Directions: Listen/Read carefully. Write the answers on the blank.</p>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                10.) &nbsp; Play the audio recording below:
                            </label>
                            <div class="flt-audio">
                                <audio id="audioPlayer" controls>
                                    <source src="../../assets/sounds/English_Listening_Question_1.mp3" type="audio/mp3">
                                    Your browser does not support the audio element.
                                </audio>
                            </div>
                            <div class="flt-question-box short-box">
                                <img src="../../assets/img/FLT_Listening_Question_1.jpg" alt="Descriptive text" style="max-width: 100%; height: auto;">
                            </div>
                            <label class="flt-questions">
                                &nbsp; &nbsp; Write you answer below:
                            </label>
                            <div class="flt-content-flex content-column">
                                <textarea class="form-control custom-border" id="eng-listening-one" name="eng-listening-one" placeholder="" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                11.) &nbsp; An article will be read below. Listen carefully and try to understand what it means. Then explain what you understand, using at least one (1) complete sentence. Play the audio recording below:
                            </label>
                            <div class="flt-audio">
                                <audio id="audioPlayer" controls>
                                    <source src="../../assets/sounds/English_Listening_Question_2.mp3" type="audio/mp3">
                                    Your browser does not support the audio element.
                                </audio>
                            </div>
                            <label class="flt-questions">
                                &nbsp; &nbsp; Write you answer below:
                            </label>
                            <div class="flt-content-flex content-column">
                                <textarea class="form-control custom-border" id="eng-listening-two" name="eng-listening-two" placeholder="" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                12.) &nbsp; Express your opinion in one (1) sentence regarding disaster preparedness. Start your sentence with any of the following phrases:
                            </label>
                            <div class="flt-question-box short-box pre-class"> • I think...
                                • I believe...
                            </div>
                            <div class="flt-content-flex content-column">
                                <textarea class="form-control custom-border" id="eng-listening-three" name="eng-listening-three" placeholder="" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                13.) &nbsp; Direction: Read the news article and answer the question below:
                            </label>
                            <div class="flt-question-box pre-class"> <b>‘Family planning to mitigate effects of inflation’</b>

                                <b>“The size of the family really affects the basic needs if the prices continue to rise up,”</b> Popcom Deputy Executive Director Lolito Tocardon said on the sidelines of the Regional Population Management Congress held Wednesday in this city.

                                Based on the July 2018 study of the Philippine Statistics Authority (PSA), about half of the average Filipino family’s monthly income is spent on food.“Having a big family will be vulnerable to poverty because their needs also increase while their income cannot answer their needs,” Tocardon said.

                                <b>Question</b>: Based on the article, what are the negative effects of high economic inflation to a big family?
                            </div>
                            <div class="flt-content-flex content-column">
                                <textarea class="form-control custom-border" id="eng-listening-four" name="eng-listening-four" placeholder="" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 8: Listening Speaking Tagalog -->
                <div class="form-step" id="step-5">
                    <div class="card-container flt-card-container">
                        <div class='card-header assessment-header-color'> <h5>LS 1: FILIPINO </h5></div>
                        <div class="flt-instruction"> 
                            <p class="flt-part"> Part III: Pakikinig/Pagsasalita</p>
                            <p> Panuto: Makinig ng mabuti. Isulat ang sagot sa patalang sa ibaba.</p>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                10.) &nbsp; Magsalaysay ng isang personal na karanasan. Gumamit ng dalawang (2)
                                pangungusap na may mga salitang kilos o pandiwa. (2 puntos)
                            </label>
                            <div class="flt-content-flex content-column">
                                <textarea class="form-control custom-border" id="tag-listening-one" name="tag-listening-one" placeholder="" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                11.) &nbsp; May pangungusap na nakasulat sa ibabang kahon. Basahin mo ang pangungusap at tukuyin ang salitang hiram na ginamit dito. Pagkatapos ay ibigay ang kahulugan ng salitang ito. Nakahanda ka na ba?
                            </label>
                            <div class="flt-question-box short-box"> 
                                <b>Pinagmasdan ni Arnold ang traysikel na nasa tapat ng tindahan.</b>
                            </div>
                            <div class="flt-content-flex content-column">
                                <textarea class="form-control custom-border" id="tag-listening-two" name="tag-listening-two" placeholder="" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-navigation">
                      <button type="button" id="back" class="btn btn-secondary">Back</button>
                      <button type="button" id="next" class="btn btn-primary">Next</button>
                      <button type="submit" id="submit" class="btn btn-success">Submit</button>
                </div>
            </form>


            
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
</body>
</html>