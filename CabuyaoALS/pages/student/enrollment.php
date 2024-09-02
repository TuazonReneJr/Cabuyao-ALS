<?php
    include "../../assets/vendor/bootstrap.html";
    include "../../php/config/db.php";

    // To check if database is connected successfully
    /*if ($conn->connect_error) {
        echo "Failed to connect to the database.";
        die("Connection failed: {$conn->connect_error}");
    } else {
        echo "Connected successfully to the database.";
    }*/
?>

<html>
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="../../assets/css/enrollment.css">

      <script src="../../assets/js/student/enrollment.js"></script>
      <script src="../../assets/js/common/modal.js"></script>
      <script src="../../assets/js/common/scripts.js"></script>
      <title>Multi-Step Form</title>
  </head>
  <body>
      <div class="container my-3 enrollment">
        <a href="../../index.php" class="btn" style="margin-bottom: 10px; padding: 0px;"> <i class="fas fa-arrow-left"></i> <i class="bi bi-house-door icon-large"> </i>Main Page </i> </a>
          <div class="form-container card shadow">
              <div class="header">
                  <img src="../../assets/img/DepEd_form_logo.png" alt="Left Logo" class="img-fluid" style="max-height: 100px;">
                  <div class="center-text">
                      <p>Republic of the Philippines</p>
                      <p>Department of Education</p>
                      <p>ALTERNATIVE LEARNING SYSTEM</p>
                      <p>MODIFIED ALS ENROLLMENT FORM</p>
                      <p>(AF2) Learner's Basic Profile</p>
                  </div>
                  <img src="../../assets/img/ALS_logo.png" alt="Right Logo" class="img-fluid" style="max-height: 100px;">
              </div>
              <div class="progress">
                  <div class="progress-bar bg-primary" id="progressBar"></div>
              </div>
              <form id="enrollment_multistep_form" method="POST" action="../../php/student/submit_enrollment.php">
                  <div class="step active" id="step1">
                      <h5 class="text-center mb-4">Part I of III</h5>
                      <div class="section-title">Personal Information </div>
                      <hr class="section-divider">
                      <div class="mb-3 row">
                          <div class="col">
                          <label for="last_name" class="form-label">Last Name</label>
                          <input type="text" class="form-control custom-border" id="last_name" name="last_name">
                          </div>
                          <div class="col">
                          <label for="first_name" class="form-label">First Name</label>
                          <input type="text" class="form-control custom-border" id="first_name" name="first_name">
                          </div>
                          <div class="col">
                          <label for="middle_name" class="form-label">Middle Name</label>
                          <input type="text" class="form-control custom-border" id="middle_name" name="middle_name" placeholder="">
                          </div>
                          <div class="col">
                          <label for="name_extension" class="form-label">Name Extension</label>
                          <input type="text" class="form-control custom-border" id="name_extension" name="name_extension" placeholder="">
                          </div>
                      </div>
                      <div class="sub-section">
                          <div class="sub-section-title">Current Address</div>
                          <div class="mb-3 row">
                          <div class="col">
                              <label for="current_houseNo" class="form-label">House No./Street/Sitio</label>
                              <input type="text" class="form-control custom-border" id="current_houseNo" name="current_houseNo" placeholder="">
                          </div>
                          <div class="col">
                              <label for="current_brgy" class="form-label">Barangay</label>
                              <input type="text" class="form-control custom-border" id="current_brgy" name="current_brgy">
                          </div>
                          <div class="col">
                              <label for="current_municipality" class="form-label">Municipality</label>
                              <input type="text" class="form-control custom-border" id="current_municipality" name="current_municipality">
                          </div>
                          <div class="col">
                              <label for="current_province" class="form-label">Province</label>
                              <input type="text" class="form-control custom-border" id="current_province" name="current_province">
                          </div>
                          </div>
                      </div>
                      <div class="sub-section">
                          <div class="sub-section-title">Permanent Address</div>
                          <div class="mb-3 row">
                              <div class="col">
                                  <input type="checkbox" class="form-check-input custom-border" id="same_current_address" name="same_current_address" value="yes">
                                  <label for="same_current_address" class="form-check-label"> Same with your Current Address?</label>
                              </div>
                          </div>
                          <div class="mb-3 row">
                          <div class="col">
                              <label for="permanent_houseNo" class="form-label">House No./Street/Sitio</label>
                              <input type="text" class="form-control custom-border" id="permanent_houseNo" name="permanent_houseNo" placeholder="">
                          </div>
                          <div class="col">
                              <label for="permanent_brgy" class="form-label">Barangay</label>
                              <input type="text" class="form-control custom-border" id="permanent_brgy" name="permanent_brgy" placeholder="">
                          </div>
                          <div class="col">
                              <label for="permanent_municipality" class="form-label">Municipality</label>
                              <input type="text" class="form-control custom-border" id="permanent_municipality" name="permanent_municipality" placeholder="">
                          </div>
                          <div class="col">
                              <label for="permanent_province" class="form-label">Province</label>
                              <input type="text" class="form-control custom-border" id="permanent_province" name="permanent_province" placeholder="">
                          </div>
                          </div>
                          <div class="mb-3 row">
                          <div class="col">
                              <input type="hidden" id="permanent_hidden_houseNo" name="permanent_hidden_houseNo" placeholder="">
                          </div>
                          <div class="col">
                              <input type="hidden" id="permanent_hidden_brgy" name="permanent_hidden_brgy" placeholder="">
                          </div>
                          <div class="col">
                              <input type="hidden" id="permanent_hidden_municipality" name="permanent_hidden_municipality" placeholder="">
                          </div>
                          <div class="col">
                              <input type="hidden" id="permanent_hidden_province" name="permanent_hidden_province" placeholder="">
                          </div>
                          </div>
                      </div>
                      <br>
                      <div class="mb-3 row">
                          <div class="col">
                          <label for="birth_date" class="form-label">Birthdate</label>
                          <input type="date" class="form-control custom-border" id="birth_date" name="birth_date">
                          </div>
                          <div class="col">
                          <label for="gender" class="form-label d-block">Gender</label>
                          <div class="form-check form-check-inline">
                              <input class="form-check-input custom-border" type="radio" name="gender" id="male" value="male">
                              <label class="form-check-label" for="male">Male</label>
                          </div>
                          <div class="form-check form-check-inline">
                              <input class="form-check-input custom-border" type="radio" name="gender" id="female" value="female">
                              <label class="form-check-label" for="female">Female</label>
                          </div>
                          </div>
                          <div class="col">
                              <label for="birth_place" class="form-label">Place of Birth (Municipality/City)</label>
                              <input type="text" class="form-control custom-border" id="birth_place" name="birth_place" placeholder="">
                          </div>
                          <div class="col">
                              <label for="civil_status" class="form-label">Civil Status</label>
                              <select class="form-select custom-border" id="civil_status" name="civil_status">
                                  <option selected disabled>Select...</option>
                                  <option value="Single">Single</option>
                                  <option value="Married">Married</option>
                                  <option value="Divorced">Separated</option>
                                  <option value="Widowed">Widow/er</option>
                                  <option value="Solo Parent">Solo Parent</option>
                              </select>
                          </div>
                      </div>
                      <div class="mb-3 row">
                          <div class="col">
                              <label for="religion" class="form-label">Religion</label>
                              <input type="text" class="form-control custom-border" id="religion" name="religion" placeholder="">
                          </div>
                          <div class="col">
                              <label for="ethnic_group" class="form-label">IP (Specify ethnic group)</label>
                              <input type="text" class="form-control custom-border" id="ethnic_group" name="ethnic_group" placeholder="">
                          </div>
                          <div class="col">
                              <label for="mother_tongue" class="form-label">Mother Tongue</label>
                              <input type="text" class="form-control custom-border" id="mother_tongue" name="mother_tongue" placeholder="">
                          </div>
                          <div class="col">
                              <label for="contact_number" class="form-label">Contact Number/s</label>
                              <input type="text" class="form-control custom-border" id="contact_number" name="contact_number">
                          </div>
                      </div>
                      <div class="sub-section" id="disability_div">
                          <div class="mb-3 row">
                          <div class="col">
                              <label for="pwd" class="form-label" style="padding-right:20px;">PWD</label>
                              <div class="form-check form-check-inline">
                              <input class="form-check-input custom-border" type="radio" name="pwd" id="pwd_yes" value="yes">
                              <label class="form-check-label" for="pwd_yes">Yes</label>
                              </div>
                              <div class="form-check form-check-inline">
                              <input class="form-check-input custom-border" type="radio" name="pwd" id="pwd_no" value="no">
                              <label class="form-check-label" for="pwd_no">No</label>
                              </div>
                          </div>
                          </div>
                          <div class="mb-3 row" id="disabilityTypeDiv" style="display: none;">
                              <div class="col">
                                  <label for="disability" class="form-label d-block">If Yes, specify the type of disability:</label>
                                  <div class="form-check form-check-inline">
                                  <input class="form-check-input custom-border" type="radio" name="disability" id="disability_autism" value="Autism Spectrum Disorder">
                                  <label class="form-check-label" for="disability_autism">Autism Spectrum Disorder</label>
                              </div>
                              <div class="form-check form-check-inline">
                                  <input class="form-check-input custom-border" type="radio" name="disability" id="disability_hearing" value="Hearing Impairment">
                                  <label class="form-check-label" for="disability_hearing">Hearing Impairment</label>
                              </div>
                              <div class="form-check form-check-inline">
                                  <input class="form-check-input custom-border" type="radio" name="disability" id="disability_learning" value="Learning Disability">
                                  <label class="form-check-label" for="disability_learning">Learning Disability</label>
                              </div>
                              <div class="form-check form-check-inline">
                                  <input class="form-check-input custom-border" type="radio" name="disability" id="disability_physical" value="Physical Disability">
                                  <label class="form-check-label" for="disability_physical">Physical Disability</label>
                              </div>
                              <div class="form-check form-check-inline">
                                  <input class="form-check-input custom-border" type="radio" name="disability" id="disability_intellectual" value="Intellectual Disability">
                                  <label class="form-check-label" for="disability_intellectual">Intellectual Disability</label>
                              </div>
                              <div class="form-check form-check-inline">
                                  <input class="form-check-input custom-border" type="radio" name="disability" id="disability_visual" value="Visual Impairment">
                                  <label class="form-check-label" for="disability_visual">Visual Impairment</label>
                              </div>
                              <div class="form-check form-check-inline">
                                  <input class="form-check-input custom-border" type="radio" name="disability" id="disability-multiple" value="Multiple Disabilities">
                                  <label class="form-check-label" for="disability_multiple">Multiple Disabilities</label>
                              </div>
                              <div class="form-check form-check-inline">
                                  <input class="form-check-input custom-border" type="radio" name="disability" id="disability_other" value="Others">
                                  <label class="form-check-label" for="disability_other">Others</label>
                              </div>
                          </div>
                          </div>
                          <div class="mb-3 row">
                              <div class="col">
                                  <div id="disability_feedback" class="invalid-feedback"></div>
                              </div>
                          </div>
                      </div>
                      <div class="sub-section">
                          <div class="mb-3 row fourPs-container">
                          <div class="col">
                              <label for="fourPs" class="form-label" style="padding-right:20px;">Is your family a beneficiary of 4Ps?</label>
                              <div class="form-check form-check-inline">
                              <input class="form-check-input custom-border" type="radio" name="fourPs" id="fourPs_yes" value="yes">
                              <label class="form-check-label" for="fourPs_yes">Yes</label>
                              </div>
                              <div class="form-check form-check-inline">
                              <input class="form-check-input custom-border" type="radio" name="fourPs" id="fourPs_no" value="no">
                              <label class="form-check-label" for="fourPs_no">No</label>
                              </div>
                          </div>
                          </div>
                          <div class="mb-3 row" id="fourPsIDnumberDiv" style="display: none;">
                              <div class="col">
                                  <label for="fourPs_idNumber" class="form-label">If Yes, write the 4Ps Household ID Number below:</label>
                                  <input type="text" class="form-control custom-border" id="fourPs_idNumber" name="fourPs_idNumber" placeholder="" maxlength="20" pattern="\d{20}">
                                  <div id="fourPsID_feedback" class="invalid-feedback"></div>
                              </div>
                          </div>
                      </div>
                      <div class="sub-section">
                          <div class="sub-section-title">Name of Father/Legal Guardian</div>
                          <div class="mb-3 row">
                          <div class="col">
                              <label for="father_lastName" class="form-label">Last Name</label>
                              <input type="text" class="form-control custom-border" id="father_lastName" name="father_lastName" placeholder="">
                          </div>
                          <div class="col">
                              <label for="father_firstName" class="form-label">First Name</label>
                              <input type="text" class="form-control custom-border" id="father_firstName" name="father_firstName" placeholder="">
                          </div>
                          <div class="col">
                              <label for="father_middleName" class="form-label">Middle Name</label>
                              <input type="text" class="form-control custom-border" id="father_middleName" name="father_middleName" placeholder="">
                          </div>
                          <div class="col">
                              <label for="father_occupation" class="form-label">Occupation</label>
                              <input type="text" class="form-control custom-border" id="father_occupation" name="father_occupation" placeholder="">
                          </div>
                          </div>
                      </div>

                      <div class="sub-section">
                          <div class="sub-section-title">Mother's Maiden Name</div>
                          <div class="mb-3 row">
                          <div class="col">
                              <label for="mother_lastName" class="form-label">Last Name</label>
                              <input type="text" class="form-control custom-border" id="mother_lastName" name="mother_lastName" placeholder="">
                          </div>
                          <div class="col">
                              <label for="mother_firstName" class="form-label">First Name</label>
                              <input type="text" class="form-control custom-border" id="mother_firstName" name="mother_firstName" placeholder="">
                          </div>
                          <div class="col">
                              <label for="mother_middleName" class="form-label">Middle Name</label>
                              <input type="text" class="form-control custom-border" id="mother_middleName" name="mother_middleName" placeholder="">
                          </div>
                          <div class="col">
                              <label for="mother_occupation" class="form-label">Occupation</label>
                              <input type="text" class="form-control custom-border" id="mother_occupation" name="mother_occupation" placeholder="">
                          </div>
                          </div>
                      </div>
                  </div>

                  <div class="step" id="step2">
                      <h5 class="text-center mb-4">Part II of III</h5>
                      <div class="section-title"> Educational Information </div>
                      <hr class="section-divider">
                      <div class="sub-section">
                          <div class="sub-section-title">Last Grade Level Completed (Check only if applicable)</div>
                          <div class="mb-3 row">
                          <div class="col">
                                  <label class="form-label" style="font-weight: bold;">Elementary: </label>
                                  <div class="form-check">
                                      <input type="checkbox" class="form-check-input" id="kinder" name="gradelevel[]" value="Kinder">
                                      <label for="interest1" class="form-check-label">Kinder</label>
                                  </div>
                                  <div class="form-check">
                                      <input type="checkbox" class="form-check-input" id="grade_one" name="gradelevel[]" value="Grade 1">
                                      <label for="grade_one" class="form-check-label">Grade 1</label>
                                  </div>
                                  <div class="form-check">
                                      <input type="checkbox" class="form-check-input" id="grade_two" name="gradelevel[]" value="Grade 2">
                                      <label for="grade_two" class="form-check-label">Grade 2</label>
                                  </div>
                                  <div class="form-check">
                                      <input type="checkbox" class="form-check-input" id="grade_three" name="gradelevel[]" value="Grade 3">
                                      <label for="grade_three" class="form-check-label">Grade 3</label>
                                  </div>
                                  <div class="form-check">
                                      <input type="checkbox" class="form-check-input" id="grade_four" name="gradelevel[]" value="Grade 4">
                                      <label for="grade_four" class="form-check-label">Grade 4</label>
                                  </div>
                                  <div class="form-check">
                                      <input type="checkbox" class="form-check-input" id="grade_five" name="gradelevel[]" value="Grade 5">
                                      <label for="grade_five" class="form-check-label">Grade 5</label>
                                  </div>
                                  <div class="form-check">
                                      <input type="checkbox" class="form-check-input" id="grade_six" name="gradelevel[]" value="Grade 6">
                                      <label for="grade_six" class="form-check-label">Grade 6</label>
                                  </div>
                          </div>
                          <div class="col">
                                  <label class="form-label" style="font-weight: bold;">Junior High School: </label>
                                  <div class="form-check">
                                      <input type="checkbox" class="form-check-input" id="grade_seven" name="gradelevel[]" value="Grade 7">
                                      <label for="grade_seven" class="form-check-label">Grade 7</label>
                                  </div>
                                  <div class="form-check">
                                      <input type="checkbox" class="form-check-input" id="grade_eight" name="gradelevel[]" value="Grade 8">
                                      <label for="grade_eight" class="form-check-label">Grade 8</label>
                                  </div>
                                  <div class="form-check">
                                      <input type="checkbox" class="form-check-input" id="grade_nine" name="gradelevel[]" value="Grade 9">
                                      <label for="grade_nine" class="form-check-label">Grade 9</label>
                                  </div>
                                  <div class="form-check">
                                      <input type="checkbox" class="form-check-input" id="grade_ten" name="gradelevel[]" value="Grade 10">
                                      <label for="grade_ten" class="form-check-label">Grade 10</label>
                                  </div>
                          </div>
                          <div class="col">
                                  <label class="form-label" style="font-weight: bold;">Senior High School: </label>
                                  <div class="form-check">
                                      <input type="checkbox" class="form-check-input" id="grade_eleven" name="gradelevel[]" value="Grade 11">
                                      <label for="grade_eleven" class="form-check-label">Grade 11</label>
                                  </div>
                          </div>
                          </div>
                      </div>
                      <div class="sub-section">
                          <div class="mb-3 row">
                              <div class="col">
                                      <label class="form-label" style="font-weight: bold;">Why did you not attended/complete schooling? (For Outh Of School Youth only) </label>
                                      <div class="form-check">
                                          <input type="checkbox" class="form-check-input" id="no_school_brgy" name="no_school[]" value="No school in Barangay">
                                          <label for="no_school_brgy" class="form-check-label">No school in Barangay</label>
                                      </div>
                                      <div class="form-check">
                                          <input type="checkbox" class="form-check-input" id="school_far" name="no_school[]" value="School too far from home">
                                          <label for="school_far" class="form-check-label">School too far from home</label>
                                      </div>
                                      <div class="form-check">
                                          <input type="checkbox" class="form-check-input" id="family_needs" name="no_school[]" value="Needed to help family">
                                          <label for="family_needs" class="form-check-label">Needed to help family</label>
                                      </div>
                                      <div class="form-check">
                                          <input type="checkbox" class="form-check-input" id="unable_pay" name="no_school[]" value="Unable to pay for miscellaneous and other expenses">
                                          <label for="unable_pay" class="form-check-label">Unable to pay for miscellaneous and other expenses</label>
                                      </div>
                                      <div>
                                          <label for="other_reason" class="form-label">Others:</label>
                                          <input type="text" class="form-control" id="other_reason" name="other_reason" placeholder="">
                                      </div>
                              </div>
                          </div>
                      </div>
                      <div class="sub-section">
                          <div class="mb-3 row">
                              <div class="col">
                                  <label for="als" class="form-label" style="padding-right:20px;">Have you attended ALS learning sessions before?</label>
                                  <div class="form-check form-check-inline">
                                      <input class="form-check-input" type="radio" name="als" id="als_yes" value="yes">
                                      <label class="form-check-label" for="als_yes">Yes</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                      <input class="form-check-input" type="radio" name="als" id="als_no" value="no">
                                      <label class="form-check-label" for="als_no">No</label>
                                  </div>
                              </div>
                          </div>
                          <div class="mb-3 row" id="alsProgramDiv" style="display: none;">
                              <div class="col">
                                  <label class="form-label d-block">If Yes, check the appropriate program: </label>
                                  <div class="form-check form-check-inline">
                                      <input type="checkbox" class="form-check-input" id="basic_literacy" name="als_program[]" value="Basic Literacy">
                                      <label for="basic_literacy" class="form-check-label">Basic Literacy</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                      <input type="checkbox" class="form-check-input" id="ae_elementary" name="als_program[]" value="A&E Elementary">
                                      <label for="ae_elementary" class="form-check-label">A&E Elementary</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                      <input type="checkbox" class="form-check-input" id="ae_secondary" name="als_program[]" value="A&E Secondary">
                                      <label for="ae_secondary" class="form-check-label">A&E Secondary</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                      <input type="checkbox" class="form-check-input" id="als_shs" name="als_program[]" value="ALS SHS">
                                      <label for="als_shs" class="form-check-label">ALS SHS</label>
                                  </div>
                              </div>
                          </div>
                          <div class="mb-3 row" id="alsCompleteDiv" style="display: none;">
                              <div class="col" style="padding-top: 10px;">
                                  <label for="complete_als" class="form-label" style="padding-right:20px;">Have you completed the program?</label>
                                  <div class="form-check form-check-inline">
                                      <input class="form-check-input" type="radio" name="complete_als" id="complete_yes" value="yes">
                                      <label class="form-check-label" for="complete_yes">Yes</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                      <input class="form-check-input" type="radio" name="complete_als" id="complete_no" value="no">
                                      <label class="form-check-label" for="complete_no">No</label>
                                  </div>
                              </div>
                          </div>
                          <div class="mb-3 row" id="alsReasonDiv" style="display: none;">
                              <div class="col">
                                  <label for="als_reason" class="form-label">If No, state the reason:</label>
                                  <input type="text" class="form-control" id="als_reason" name ="als_reason" placeholder="">
                              </div>
                          </div>
                      </div>
                      <br>
                      
                      <div class="mb-3 row">
                          <div class="col">
                                  <label class="form-label" style="font-weight: bold;">What learning Modality/ies do you prefer? Choose all that apply.</label>
                                  <div class="form-check">
                                      <input type="checkbox" class="form-check-input" id="modular_print" name="modalities[]" value="Modular (Print)">
                                      <label for="modular_print" class="form-check-label">Modular (Print)</label>
                                  </div>
                                  <div class="form-check">
                                      <input type="checkbox" class="form-check-input" id="modular_digital" name="modalities[]" value="Modular (Digital)">
                                      <label for="modular_digital" class="form-check-label">Modular (Digital)</label>
                                  </div>
                                  <div class="form-check">
                                      <input type="checkbox" class="form-check-input" id="online" name="modalities[]" value="Online">
                                      <label for="online" class="form-check-label">Online</label>
                                  </div>
                                  <div class="form-check">
                                      <input type="checkbox" class="form-check-input" id="educational_tv" name="modalities[]" value="Educational TV">
                                      <label for="educational_tv" class="form-check-label">Educational TV</label>
                                  </div>
                                  <div class="form-check">
                                      <input type="checkbox" class="form-check-input" id="radio_based" name="modalities[]" value="Radio-based Instruction">
                                      <label for="radio_based" class="form-check-label">Radio-based Instruction</label>
                                  </div>
                                  <div class="form-check">
                                      <input type="checkbox" class="form-check-input" id="blended" name="modalities[]" value="Blended">
                                      <label for="blended" class="form-check-label">Blended</label>
                                  </div>
                                  <div class="form-check">
                                      <input type="checkbox" class="form-check-input" id="face_to_face" name="modalities[]" value="Face to Face">
                                      <label for="face_to_face" class="form-check-label">Face to Face</label>
                                  </div>
                          </div>
                      </div>
                  </div>

                  <div class="step" id="step3">
                      <h5 class="text-center mb-4">Part III of III</h5>
                      <div class="section-title"> Accessibility and Availability of CLC </div>
                      <hr class="section-divider">
                      <div class="mb-3 row">
                          <div class="col">
                              <label for="learningcenter_distance" class="form-label">How far is it from your home to your Learning Center?</label>
                          </div>
                          <div class="col mobile-inline" id="distance-km-container">
                              <label for="distance_kms" class="form-label">in kms</label>
                              <input type="text" class="form-control" id="distance_kms" name="distance_kms" placeholder="">
                          </div>
                          <div class="col mobile-inline" id="distance-hrs-container">
                              <label for="distance_hrs" class="form-label">in hours and mins</label>
                              <input type="text" class="form-control" id="distance_hrs" name="distance_hrs" placeholder="">
                          </div>
                      </div>
                      <div class="mb-3 row">
                          <div class="col">
                          <label for="mode_transpo" class="form-label" style="padding-right:20px;">How do you get from your home to your Learning Center?</label>
                          <div class="form-check">
                              <input class="form-check-input" type="radio" name="mode_transpo" id="mode_walking" value="Walking">
                              <label class="form-check-label" for="mode_walking">Walking</label>
                          </div>
                          <div class="form-check">
                              <input class="form-check-input" type="radio" name="mode_transpo" id="mode_motorcycle" value="Motorcycle">
                              <label class="form-check-label" for="mode_motorcycle">Motorcycle</label>
                          </div>
                          <div class="form-check">
                              <input class="form-check-input" type="radio" name="mode_transpo" id="mode_bicycle" value="Bicycle">
                              <label class="form-check-label" for="mode_bicycle">Bicycle</label>
                          </div>
                          <div class="form-check">
                              <input class="form-check-input" type="radio" name="mode_transpo" id="mode_others" value="Others">
                              <label class="form-check-label" for="mode_others">Others (Pls specify)</label>
                          </div>
                          <div class="col">
                              <input type="text" class="form-control" id="other_mode" name="other_mode" placeholder="">
                          </div>
                          </div>
                      </div>
                      <div class="mb-3 row">
                          <div class="col">
                                  <label class="form-label" style="font-weight: bold;"> When can you attend your Learning Session? And what specific time can you be at your Learning Center?</label>
                          </div>
                      </div>
                      <div class="mb-3 row" id="timeFields">
                          <div class="col">
                              <div class="row">
                                  <div class="col">
                                      <label>Monday</label>
                                      <input type="time" class="form-control" placeholder="Enter time" name="monday_time" id="monday_time">
                                  </div>
                                  <div class="col">
                                      <label>Tuesday</label>
                                      <input type="time" class="form-control" placeholder="Enter time" name="tuesday_time" id="tuesday_time">
                                  </div>
                                  <div class="col">
                                      <label>Wednesday</label>
                                      <input type="time" class="form-control" placeholder="Enter time" name="wednesday_time" id="wednesday_time">
                                  </div>
                                  <div class="col">
                                      <label>Thursday</label>
                                      <input type="time" class="form-control" placeholder="Enter time" name="thursday_time" id="thursday_time">
                                  </div>
                                  <div class="col">
                                      <label>Friday</label>
                                      <input type="time" class="form-control" placeholder="Enter time" name="friday_time" id="friday_time">
                                  </div>
                                  <div class="col">
                                      <label>Saturday</label>
                                      <input type="time" class="form-control" placeholder="Enter time" name="saturday_time" id="saturday_time">
                                  </div>
                                  <div class="col">
                                      <label>Sunday</label>
                                      <input type="time" class="form-control" placeholder="Enter time" name="sunday_time" id="sunday_time">
                                  </div>
                              </div>
                          </div>
                      </div>
                      <br>
                      <div class="sub-section" id="upload-container">
                          <div class="sub-section-title">Upload Documents</div>
                          <div class="mb-3 row">
                          <div class="col">
                              <label for="enrollment_file" class="form-label">Select file:</label>
                              <small class="form-text text-muted" style="font-style: italic; font-size: 0.875rem;">Only PDF and JPEG/JPG file is accepted</small>
                              <input type="file" class="form-control" name="enrollment_file" id="enrollment_file">
                          </div>
                          <div class="col">
                              <label for="document_type" class="form-label">Document Type:</label>
                              <select class="form-select" name="document_type" id="document_type">
                                  <option value="" disabled selected>Select type</option>
                                  <option value="Birth Certificate">Birth Certificate</option>
                                  <option value="Brgy. Clearance">Brgy. Clearance</option>
                                  <option value="Other">Other</option>
                              </select>
                          </div>
                          </div>
                      </div>
                      <br>
                      <div class="mb-3 row">
                          <div class="col">
                                  <div class="form-check">
                                      <input type="checkbox" class="form-check-input" id="declaration" name="declaration" value="yes">
                                      <label for="declaration" class="form-check-label">I hereby certify that the above information given are true and correct to the best of my knowledge and I allow Department of Education to use my child's details to create and/or update his/her learner profile in the Learner Information System. The information herein shall be treated as confidential in compliance with the Data Privacy Act of 2012.</label>
                                  </div> <br>
                                  <div class="col" id="email-container" style="display: none;">
                                        <label for="student_email" class="form-label">Email Address: </label>
                                        <small class="form-text text-muted" style="font-style: italic; font-size: 0.875rem;">Required for receiving notifications</small>
                                        <input type="text" class="form-control" id="student_email" name="student_email" placeholder="">
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
          </div>
      </div>
      
  </body>
</html>