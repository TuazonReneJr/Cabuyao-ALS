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
					<h1>Functional Literacy Test: Elementary Level</h1>
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
							<a class="active" href="#">Elementary Level FLT</a>
						</li>
					</ul>
				</div>
			</div>

            <!-- Multi-Step Form -->
            <form id="assessment-flt-form" action="" method="post">
                <!-- Step 1: Multiple Choice Questions -->
                <div class="form-step" id="step-1">
                    <div class="card-container flt-card-container">
                        <div class='card-header assessment-header-color'> <h5>Personal Information Form </h5></div>
                        <div class="flt-instruction"> 
                            <p> A. Panuto: Sagutan ang mga sumusunod na tanong.</p>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">1.) &nbsp; Ano ang iyong kumpletong pangalan?</label>
                            <div class="flt-content-flex">
                                <input type="text" class="form-control custom-border" id="pis-first_name" name="pis-first_name" placeholder="Unang Pangalan">
                                <input type="text" class="form-control custom-border" id="pis-middle_name" name="pis-middle_name" placeholder="Gitnang Pangalan">
                                <input type="text" class="form-control custom-border" id="pis-last_name" name="pis-last_name" placeholder="Apelyido">
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">2.) &nbsp; Ano ang kasarian? Lagyan ng (✔) ang tamang kahon.</label>
                            <div class="flt-content-flex input-checkbox">
                                <div class="radio-option">
                                    <input type="radio" id="pis-lalaki" name="pis-gender" value="Lalaki">
                                    <label for="pis-lalaki">Lalaki</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="pis-babae" name="pis-gender" value="Babae">
                                    <label for="pis-babae">Babae</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">3.) &nbsp; Kailan ka isinilang o ipinanganak?</label>
                            <div class="flt-content-flex">
                                <input type="text" class="form-control custom-border" id="pis-birth_month" name="pis-birth_month" placeholder="Buwan">
                                <input type="text" class="form-control custom-border" id="pis-birth_day" name="pis-birth_day" placeholder="Araw">
                                <input type="text" class="form-control custom-border" id="pis-birth_year" name="pis-birth_year" placeholder="Taon">
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">4.) &nbsp; Saan ka nakatira?</label>
                            <div class="flt-content-flex">
                                <input type="text" class="form-control custom-border" id="pis-houseNo_street" name="pis-houseNo_street" placeholder="Numero ng bahay/Kalye">
                                <input type="text" class="form-control custom-border" id="pis-barangay" name="pis-barangay" placeholder="Barangay">
                                <input type="text" class="form-control custom-border" id="pis-city" name="pis-city" placeholder="Lungsod/Bayan">
                                <input type="text" class="form-control custom-border" id="pis-province" name="pis-province" placeholder="Probinsya">
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">5.) &nbsp; Ano ang iyong relihiyon?</label>
                            <div class="flt-content-flex">
                                <input type="text" class="form-control custom-border" id="pis-religion" name="pis-religion" placeholder="">
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">6.) &nbsp; Ano ang estado mo sa buhay? Lagyan ng (✔) ang tamang kahon.</label>
                            <div class="flt-content-flex input-checkbox">
                                <div class="radio-option">
                                    <input type="radio" id="pis-walangasawa" name="pis-status" value="Walang Asawa">
                                    <label for="pis-walangasawa">Walang asawa</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="pis-mayasawa" name="pis-status" value="May asawa">
                                    <label for="pis-mayasawa">May asawa</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="pis-biyudo" name="pis-status" value="Biyudo/Biyuda">
                                    <label for="pis-biyudo">Biyudo/Biyuda</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="pis-hiwalaysaasawa" name="pis-status" value="Hiwalay sa asawa">
                                    <label for="pis-hiwalaysaasawa">Hiwalay sa asawa</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">7.) &nbsp; Ano ang hanabuhay/trabaho mo?</label>
                            <div class="flt-content-flex">
                                <input type="text" class="form-control custom-border" id="pis-occupation" name="pis-occupation" placeholder="">
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">8.) &nbsp; Ano ang pinakamataas na antas na natapos mo sa pag-aaral?</label>
                            <div class="flt-content-flex">
                                <input type="text" class="form-control custom-border" id="pis-grade-level-completed" name="pis-grade-level-completed" placeholder="">
                            </div>
                        </div>

                        <div class="card-content flt-card">
                            <label class="flt-questions"><b>B. Sumulat ng isang talata na binubuo ng dalawa hanggang tatlong pangungusap tungkol sa iyong sarili, gayundin ang mga ambisyon mo.</b></label> <br><br>
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
                                1.) &nbsp; <u>GREEN</u> light in the traffic sign means 
                                <span class="underline"></span>.
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="eng-comm-one-a" name="eng-comm-one" value="A">
                                    <label for="eng-comm-one-a">Go</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="eng-comm-one-b" name="eng-comm-one" value="B">
                                    <label for="eng-comm-one-b">Ready</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="eng-comm-one-c" name="eng-comm-one" value="B">
                                    <label for="eng-comm-one-c">Stop</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="eng-comm-one-d" name="eng-comm-one" value="D">
                                    <label for="eng-comm-one-d">Slow Down</label>
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
                                4.) &nbsp; Fill in the blank with the correct word from the options below that will make the statement POSITIVE. Choose the letter of the correct answer.
                            </label>
                            <div class="flt-question-box short-box">
                                I will <span class="underline"></span> eat that vegetable. It's delicious!
                            </div>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="eng-comm-four-a" name="eng-comm-four" value="A">
                                    <label for="eng-comm-four-a">definitely</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="eng-comm-four-b" name="eng-comm-four" value="B">
                                    <label for="eng-comm-four-b">hardly</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="eng-comm-four-c" name="eng-comm-four" value="C">
                                    <label for="eng-comm-four-c">never</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="eng-comm-four-d" name="eng-comm-four" value="D">
                                    <label for="eng-comm-four-d">not</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                5.) &nbsp; What is the main idea of the given paragraph?
                            </label>
                            <div class="flt-question-box">
                                All living things are made up of cells. Since humans are alive, we are also made of cells. Our body tissues are made up of cells. Tissue makes our body organs. Organs make our body systems. Cells are the building blocks of our bodies.
                            </div>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="eng-comm-five-a" name="eng-comm-five" value="A">
                                    <label for="eng-comm-five-a">Cells are building blocks of our bodies.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="eng-comm-five-b" name="eng-comm-five" value="B">
                                    <label for="eng-comm-five-b">Body tissues are made up of cells.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="eng-comm-five-c" name="eng-comm-five" value="C">
                                    <label for="eng-comm-five-c">Body organs are made up of tissue.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="eng-comm-five-d" name="eng-comm-five" value="D">
                                    <label for="eng-comm-five-d">Living things are made up of cells.</label>
                                </div>
                            </div>
                        </div>

                        <div class="flt-instruction"> 
                            <p class="flt-part"> Part II: Writing</p>
                            <p> Directions: Read the item below. Write your answer on the blank provided below.</p>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                6.) &nbsp; Choose one (1) member of your family and write a simple sentence to describe him/her.
                            </label>
                            <div class="flt-content-flex content-column">
                                <textarea class="form-control custom-border" id="eng-writing-six" name="eng-writing-six" placeholder="" rows="5"></textarea>
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

                        <div class="flt-instruction"> 
                            <p class="flt-part"> Part II: Pagsulat</p>
                            <p> Panuto: Basahin ang aytem. Isulat ang sagot sa sagutang papel.</p>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                4.) &nbsp; Isulat sa patlang ang baybay sa Filipino ng salitang hiram na "computer".
                            </label>
                            <div class="flt-content-flex content-column">
                                <textarea class="form-control custom-border" id="tag-writing-four" name="tag-writing-four" placeholder="" rows="5"></textarea>
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
                                1.) &nbsp; Which solid waste management process is involved in collecting materials and converting it into new items?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="science-one-a" name="science-one" value="A">
                                    <label for="science-one-a">Recovering</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="science-one-b" name="science-one" value="B">
                                    <label for="science-one-b">Recycling</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="science-one-c" name="science-one" value="C">
                                    <label for="science-one-c">Reducing</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="science-one-d" name="science-one" value="D">
                                    <label for="science-one-d">Reusing</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                2.) &nbsp; The following are some of the activities that can be done during summer <b>EXCEPT</b>
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="science-two-a" name="science-two" value="A">
                                    <label for="science-two-a">Playing at the park</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="science-two-b" name="science-two" value="B">
                                    <label for="science-two-b">Swimming at the beach</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="science-two-c" name="science-two" value="C">
                                    <label for="science-two-c">Planting crops in the field</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="science-two-d" name="science-two" value="D">
                                    <label for="science-two-d">Selling halo-halo at the front yard</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                3.) &nbsp; Which of the following shows the correct way of handling flammable materials at home?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="science-three-a" name="science-three" value="A">
                                    <label for="science-three-a">Leaving the stove unattended when cooking.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="science-three-b" name="science-three" value="B">
                                    <label for="science-three-b">Flammable liquid not properly labelled and stored.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="science-three-c" name="science-three" value="C">
                                    <label for="science-three-c">Keeping lighters and matches out of reach of children.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="science-three-d" name="science-three" value="D">
                                    <label for="science-three-d">Candle left burning when everyone in the house is asleep.</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                4.) &nbsp; What electrical energy can be transformed when we switch on the electric bulb?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="science-four-a" name="science-four" value="A">
                                    <label for="science-four-a">Sound energy</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="science-four-b" name="science-four" value="B">
                                    <label for="science-four-b">Light and heat energy</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="science-four-c" name="science-four" value="C">
                                    <label for="science-four-c">Light and sound energy</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="science-four-d" name="science-four" value="D">
                                    <label for="science-four-d">Chemical and sound energy</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                5.) &nbsp; Which of the following <b>DOES NOT</b> contribute to the greenhouse effect that causes climate change?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="science-five-a" name="science-five" value="A">
                                    <label for="science-five-a">Combustion of fuel</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="science-five-b" name="science-five" value="B">
                                    <label for="science-five-b">Use of aerosol sprays</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="science-five-c" name="science-five" value="C">
                                    <label for="science-five-c">Dust from volcanic eruptions</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="science-five-d" name="science-five" value="D">
                                    <label for="science-five-d">Use of solar powered jeepney</label>
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
                                1.) &nbsp; What is the difference between the numbers of hearts inside the boxes?
                            </label>
                            <div class="flt-question-box short-box">
                                <img src="../../assets/img/FLT_Math_Question_1.jpg" alt="Descriptive text" style="max-width: 100%; height: auto;">
                            </div>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="math-one-a" name="math-one" value="A">
                                    <label for="math-one-a">17</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-one-b" name="math-one" value="B">
                                    <label for="math-one-b">13</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-one-c" name="math-one" value="C">
                                    <label for="math-one-c">10</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-one-d" name="math-one" value="D">
                                    <label for="math-one-d">5</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                2.) &nbsp; Which of the following symbols must be placed in the box?
                            </label>
                            <div class="flt-question-box short-box">
                                <img src="../../assets/img/FLT_Math_Question_2.jpg" alt="Descriptive text" style="max-width: 100%; height: auto;">
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
                                3.) &nbsp; The residents of Barangay San Pedro planted 1,655 mahogany trees and 2,340 mango trees in their barangay. How many trees did they plant altogether?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="math-three-a" name="math-three" value="A">
                                    <label for="math-three-a">2,795</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-three-b" name="math-three" value="B">
                                    <label for="math-three-b">3,995</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-three-c" name="math-three" value="C">
                                    <label for="math-three-c">4,895</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-three-d" name="math-three" value="D">
                                    <label for="math-three-d">5,985</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                4.) &nbsp; (250 x 40) ÷ (50 x 8) =
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="math-four-a" name="math-four" value="A">
                                    <label for="math-four-a">15</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-four-b" name="math-four" value="B">
                                    <label for="math-four-b">25</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-four-c" name="math-four" value="C">
                                    <label for="math-four-c">35</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-four-d" name="math-four" value="SD">
                                    <label for="math-four-d">45</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                5.) &nbsp; Of the twelve classes of DRT High School, each class donated 45 boxes of toothpaste to an orphanage. How many boxes of toothpaste were donated in all?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="math-five-a" name="math-five" value="A">
                                    <label for="math-five-a">540</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-five-b" name="math-five" value="B">
                                    <label for="math-five-b">541</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-five-c" name="math-five" value="C">
                                    <label for="math-five-c">542</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-five-d" name="math-five" value="D">
                                    <label for="math-five-d">543</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                6.) &nbsp; Jack is planning to treat his 6 friends on his birthday. He decided to buy 3 boxes of pizza with 8 slices per box. How many slices of pizza can each of his friends have?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="math-six-a" name="math-six" value="A">
                                    <label for="math-six-a">4</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-six-b" name="math-six" value="B">
                                    <label for="math-six-b">5</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-six-c" name="math-six" value="C">
                                    <label for="math-six-c">6</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-six-d" name="math-six" value="D">
                                    <label for="math-six-d">7</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                7.) &nbsp; Marco bought four items from a sari-sari store. He bought the following: cooking oil at ₱35.75, canned tuna at ₱28.15, tomato sauce at ₱19.50 and powdered milk at ₱123.65. How much did he pay for all the items?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="math-seven-a" name="math-seven" value="A">
                                    <label for="math-seven-a">₱ 237.75</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-seven-b" name="math-seven" value="B">
                                    <label for="math-seven-b">₱ 227.50</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-seven-c" name="math-seven" value="C">
                                    <label for="math-seven-c">₱ 217.15</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-seven-d" name="math-seven" value="D">
                                    <label for="math-seven-d">₱ 207.05</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                8.) &nbsp; In a fruit stand, the ratio of mangoes to oranges is 4:3. How many oranges are there if there are 16 mangoes?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="math-eight-a" name="math-eight" value="A">
                                    <label for="math-eight-a">16</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-eight-b" name="math-eight" value="B">
                                    <label for="math-eight-b">14</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-eight-c" name="math-eight" value="C">
                                    <label for="math-eight-c">12</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="math-eight-d" name="math-eight" value="D">
                                    <label for="math-eight-d">10</label>
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
                                1.) &nbsp; Gusto ni Nelia na madagdagan pa ang kanyang kaalaman at kasanayan sa pagluluto. Ano ang pinakamainam niyang gawin?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="life-one-a" name="life-one" value="A">
                                    <label for="life-one-a">Magsanay sa pagluluto nang mag-isa</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="life-one-b" name="life-one" value="B">
                                    <label for="life-one-b">Magpaturo ng pagluluto sa kaibigan.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="life-one-c" name="life-one" value="C">
                                    <label for="life-one-c">Sumali sa pagsananay tungkol sa pagluluto</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="life-one-d" name="life-one" value="D">
                                    <label for="life-one-d">Magsaliksik sa internet tungkol sa pagluluto</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                2.) &nbsp; Si Dexter ay marunong gumawa ng iba’t ibang <i>home-made</i> na tinapay. Anong trabaho ang maaari niyang pagkakitaan?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="life-two-a" name="life-two" value="A">
                                    <label for="life-two-a"> Panadero </label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="life-two-b" name="life-two" value="B">
                                    <label for="life-two-b"> Sorbetero </label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="life-two-c" name="life-two" value="C">
                                    <label for="life-two-c"> Serbidor </label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="life-two-d" name="life-two" value="D">
                                    <label for="life-two-d"> Kusinero </label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                3.) &nbsp; Maagang binubuksan ni Mang Roldan ang pinapasukang <i>Auto Repair Shop</i>. Tumatanggap siya ng mga mamimili kahit lampas na sa oras at sinisigurado niyang maayos ang kanyang trabaho. Ano ang magandang katangiang ipinapakita niya bilang isang empleyado?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="life-three-a" name="life-three" value="A">
                                    <label for="life-three-a">Masayahin</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="life-three-b" name="life-three" value="B">
                                    <label for="life-three-b">Masipag</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="life-three-c" name="life-three" value="C">
                                    <label for="life-three-c">Mahusay</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="life-three-d" name="life-three" value="D">
                                    <label for="life-three-d">Mapagbigay</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                4.) &nbsp; Ano ang dapat gamitin ng mga mananahi ng <i>ASAS Dress Shop</i> sa paglilinis ng mga makina sa pagtatahi?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="life-four-a" name="life-four" value="A">
                                    <label for="life-four-a">Basang tisyu</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="life-four-b" name="life-four" value="B">
                                    <label for="life-four-b">Mamasa-masang tela</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="life-four-c" name="life-four" value="C">
                                    <label for="life-four-c">Magaspang na tela</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="life-four-d" name="life-four" value="D">
                                    <label for="life-four-d">Malambot at tuyong tela</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                5.) &nbsp; Si Junjun ay isang construction worker sa <i>White Forth Company</i>. Alin sa mga sumusunod ang dapat ihanda at suotin ni Junjun bago pumasok?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="life-five-a" name="life-five" value="A">
                                    <label for="life-five-a"><i>leather shoes</i> at barong tagalog</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="life-five-b" name="life-five" value="B">
                                    <label for="life-five-b">sombrero, salamin at panyo</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="life-five-c" name="life-five" value="C">
                                    <label for="life-five-c"><i>helmet</i>, bota, <i>mask</i> at <i>gloves</i></label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="life-five-d" name="life-five" value="D">
                                    <label for="life-five-d"><i>rubber shoes</i>, <i>shades</i> at <i>jacket</i></label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                6.) &nbsp; Alin sa mga sumusunod ang nagpapakita na ang may-ari ng negosyo ay nagbibigay ng maayos na serbisyo sa kaniyang mamimili?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="life-six-a" name="life-six" value="A">
                                    <label for="life-six-a">Pinapalitan ang mga depektibong gamit</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="life-six-b" name="life-six" value="B">
                                    <label for="life-six-b">Walang pakialam ang <i>security guard</i> sa mga mamimili.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="life-six-c" name="life-six" value="C">
                                    <label for="life-six-c">Walang <i>priority lane</i></label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="life-six-d" name="life-six" value="D">
                                    <label for="life-six-d">Hindi pinapansin ng mga <i>sales lady</i> ang kailangan ng mamimili.</label>
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
                                1.) &nbsp; Which of the following describes a computer?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="digital-one-a" name="digital-one" value="A">
                                    <label for="digital-one-a">It produces many errors.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="digital-one-b" name="digital-one" value="B">
                                    <label for="digital-one-b">It takes a long time to operate.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="digital-one-c" name="digital-one" value="C">
                                    <label for="digital-one-c">It takes a long time to operate.</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="digital-one-d" name="digital-one" value="D">
                                    <label for="digital-one-d">It works fast and performs multiple functions.</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                2.) &nbsp; Which is the correct order of steps in turning off a computer?
                            </label>
                            <div class="flt-question-box short-box  pre-class">1. Click the start button.
                                2. Save and Close all the applications
                                3. Click the Shutdown button.
                            </div>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="digital-two-a" name="digital-two" value="A">
                                    <label for="digital-two-a"> 3, 2, 1 </label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="digital-two-b" name="digital-two" value="B">
                                    <label for="digital-two-b"> 1, 2, 3 </label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="digital-two-c" name="digital-two" value="C">
                                    <label for="digital-two-c"> 2, 1, 3 </label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="digital-two-d" name="digital-two" value="D">
                                    <label for="digital-two-d"> 2, 3, 1 </label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                3.) &nbsp; Which of the following statements about microcomputer is correct?
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
                                4.) &nbsp; Which of the following computer device is used to make copies of reports, photographs and other documents?
                            </label>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="digital-four-a" name="digital-four" value="A">
                                    <label for="digital-four-a">Mouse</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="digital-four-b" name="digital-four" value="B">
                                    <label for="digital-four-b">Microphone</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="digital-four-c" name="digital-four" value="C">
                                    <label for="digital-four-c">Printer</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="digital-four-d" name="digital-four" value="D">
                                    <label for="digital-four-d">Speaker</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                5.) &nbsp; Jaf needs to scan his ID picture. What is the correct order of steps that he should follow?
                            </label>
                            <div class="flt-question-box short-box pre-class">1. Connect the scanner to the computer.
                                2. Place the picture to the scanner.
                                3. Press on the power button of the scanner.
                                4. Click the scan button.
                            </div>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="digital-five-a" name="digital-five" value="A">
                                    <label for="digital-five-a">1, 3, 2, 4</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="digital-five-b" name="digital-five" value="B">
                                    <label for="digital-five-b">3, 2, 1, 4</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="digital-five-c" name="digital-five" value="C">
                                    <label for="digital-five-c">4, 3, 2, 1</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="digital-five-d" name="digital-five" value="D">
                                    <label for="digital-five-d">2, 1, 3, 4</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                6.) &nbsp; Jaime wants to save his project into a USB flash drive. What is the correct order of steps to save it?
                            </label>
                            <div class="flt-question-box short-box pre-class">1. Click File
                                2. Choose Save As
                                3. Name the file and click save
                                4. Insert the flash drive to USB slot
                            </div>
                            <div class="flt-content-flex content-column">
                                <div class="radio-option">
                                    <input type="radio" id="digital-six-a" name="digital-six" value="A">
                                    <label for="digital-six-a">3, 4, 2, 1</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="digital-six-b" name="digital-six" value="B">
                                    <label for="digital-six-b">2, 3, 1, 4</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="digital-six-c" name="digital-six" value="C">
                                    <label for="digital-six-c">1, 2, 3, 4</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="digital-six-d" name="digital-six" value="D">
                                    <label for="digital-six-d">4, 1, 2, 3</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 8: Listening Speaking English -->
                <div class="form-step" id="step-5">
                    <div class="card-container flt-card-container">
                        <div class='card-header assessment-header-color'> <h5>LS 1: Listening Skills (English) </h5></div>
                        <div class="flt-instruction"> 
                            <p> Directions: Listen carefully. Write the answers on the blank.</p>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                7.) &nbsp; Play the audio recording below:
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
                                8.) &nbsp; An article will be read below. Listen carefully and try to understand what it means. Then explain what you understand, using at least one (1) complete sentence. Play the audio recording below:
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
                    </div>
                </div>

                <!-- Step 8: Listening Speaking Tagalog -->
                <div class="form-step" id="step-5">
                    <div class="card-container flt-card-container">
                        <div class='card-header assessment-header-color'> <h5>LS 1: Pakikinig (Filipino) </h5></div>
                        <div class="flt-instruction"> 
                            <p> Panuto: Makinig ng mabuti. Isulat ang sagot sa patalang sa ibaba.</p>
                        </div>
                        <div class="card-content flt-card">
                            <label class="flt-questions">
                                7.) &nbsp; Pakinggan ang isasalaysay na sitwasyon at sagutin nang malinaw ang kasunod na tanong. Pakinggan ang <i>audio recording</i>:
                            </label>
                            <div class="flt-audio">
                                <audio id="audioPlayer" controls>
                                    <source src="../../assets/sounds/Tagalog_Listening_Question.mp3" type="audio/mp3">
                                    Your browser does not support the audio element.
                                </audio>
                            </div>
                            <label class="flt-questions">
                                &nbsp; &nbsp; Isulat ang sagot sa patlang:
                            </label>
                            <div class="flt-content-flex content-column">
                                <textarea class="form-control custom-border" id="tag-listening-one" name="tag-listening-one" placeholder="" rows="5"></textarea>
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