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
    include '../../php/config/db.php';
    include "../../assets/vendor/bootstrap.html";
    include "../../includes/loading-screen.html";

    //$studentId = isset($_GET['id']) ? intval($_GET['id']) : 0;

    // Fetch the current username from session
    $studentId = $_SESSION['student_id'];

    if ($studentId > 0) {
        // Prepare SQL query to fetch student details
        $sql = "
            SELECT students_db.*, 
                address_db.*, 
                availability_db.*, 
                documents_db.document_id, 
                documents_db.document_name, 
                documents_db.document_tag 
            FROM students_db 
            LEFT JOIN address_db ON students_db.student_id = address_db.student_id
            LEFT JOIN availability_db ON students_db.student_id = availability_db.student_id
            LEFT JOIN documents_db ON students_db.student_id = documents_db.student_id 
            WHERE students_db.student_id = ?
        ";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $studentId);
        $stmt->execute();
        $result = $stmt->get_result();
        $student = $result->fetch_assoc();
        $stmt->close();
    } else {
        // Handle case where ID is not provided or invalid
        echo "Invalid student ID.";
        exit();
    }

    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <script src="../../assets/js/common/scripts.js" defer></script>
    <script src="../../assets/js/common/modal.js"></script>
    <script src="../../assets/js/common/loading-screen.js"></script>
    <script src="../../assets/js/admin/student-details.js" defer></script>

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
                    <h1><i class='bx bxs-user'></i> <?php echo htmlspecialchars($student['first_name'] . ' ' . $student['last_name']); ?></h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">Enrollment</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a class="inactive" href="enrollment.php">List of Enrollees</a>
                        </li>
                        <li><i class='bx bx-chevron-right' ></i></li>
                        <li>
                            <a class="active" href="#">Student Details</a>
                        </li>
                    </ul>
                </div>
                <div class="right">
                    <ul class="info-crumbs">
                        <li><i class="bi bi-person-vcard" data-id="1" data-bs-toggle="tooltip" title="Student Details"></i></li>
                        <li><i class="bi bi-folder" data-id="2" data-bs-toggle="tooltip" title="FLT Answer"></i></li>
                        <li><i class="bi bi-paperclip" data-id="3" data-bs-toggle="tooltip" title="Attachments"></i></li>
                    </ul>
                </div>
            </div>

            <?php 
                // Determine the class based on the student's status
                $statusClass = '';

                if ($student['status'] === 'Approved') {
                    $statusClass = 'status-approved';
                } else if ($student['status'] === 'Pending') {
                    $statusClass = 'status-pending';
                } else if ($student['status'] === 'Rejected') {
                    $statusClass = 'status-rejected';
                }
            ?>
            <div id="content-1" class="icon-content active">
                <!-- Personal Information-->
                <div class="card-container">
                    <?php echo "<div class='card-header $statusClass'> <h5>Personal Information</h5></div>"; ?>
                    <div class="card-content">
                        <div class="row">
                            <div class="col-md-6">
                                    <p id="student_lastname"><strong>Last Name:</strong> <?php echo htmlspecialchars(!empty($student['last_name']) ? $student['last_name'] : '-'); ?> </p>
                                    <p id="student_firstname"><strong>First Name:</strong> <?php echo htmlspecialchars(!empty($student['first_name']) ? $student['first_name'] : '-'); ?> </p>
                                    <p><strong>Middle Name:</strong> <?php echo htmlspecialchars(!empty($student['middle_name']) ? $student['middle_name'] : '-'); ?> </p>
                                    <p><strong>Name Extension:</strong> <?php echo htmlspecialchars(!empty($student['name_extension']) ? $student['name_extension'] : '-'); ?> </p>
                                    <p><strong>Gender:</strong> <?php echo htmlspecialchars(!empty($student['gender']) ? $student['gender'] : '-'); ?> </p>
                                    <p><strong>Civil Status:</strong> <?php echo htmlspecialchars(!empty($student['civil_status']) ? $student['civil_status'] : '-'); ?></p>
                            </div>
                            <div class="col-md-6">
                                    <p><strong>Birthdate:</strong> <?php echo htmlspecialchars(!empty($student['birth_date']) ? $student['birth_date'] : '-'); ?></p>
                                    <p><strong>Place of Birth:</strong> <?php echo htmlspecialchars(!empty($student['birth_place']) ? $student['birth_place'] : '-'); ?> </p>
                                    <p><strong>Religion:</strong> <?php echo htmlspecialchars(!empty($student['religion']) ? $student['religion'] : '-'); ?></p>
                                    <p id="student_email"><strong>Email Address:</strong> <?php echo htmlspecialchars(!empty($student['student_email']) ? $student['student_email'] : '-'); ?> </p>
                                    <p><strong>Contact Number/s:</strong> <?php echo htmlspecialchars(!empty($student['contact_number']) ? $student['contact_number'] : '-'); ?> </p>
                                    <p><strong>Mother Tongue:</strong> <?php echo htmlspecialchars(!empty($student['mother_tongue']) ? $student['mother_tongue'] : '-'); ?></p>
                                    <p><strong>IP (Ethnic Group):</strong> <?php echo htmlspecialchars(!empty($student['ethnic_group']) ? $student['ethnic_group'] : '-'); ?> </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Other Information Card -->
                <div class="card-container">
                    <div class="card-content">
                            <p><strong>Person With Disability (PWD)? </strong> <?php echo htmlspecialchars($student['is_pwd'] == 1 ? 'Yes' : 'No'); ?> </p>
                            <p><strong>Disablity/ies: </strong> <?php echo htmlspecialchars(!empty($student['disability']) ? $student['disability'] : '-'); ?> </p>
                            <p><strong>Is your family a beneficiary of 4Ps?</strong> <?php echo htmlspecialchars($student['is_fourps'] == 1 ? 'Yes' : 'No'); ?> </p>
                            <p><strong>4Ps Household ID:</strong> <?php echo htmlspecialchars(!empty($student['fourps_household_id']) ? $student['fourps_household_id'] : '-'); ?> </p>
                    </div>
                </div>

                <!-- Address Information Card -->
                <div class="card-container">
                    <?php echo "<div class='card-header $statusClass'> <h5>Address Information</h5></div>"; ?>
                    <div class="card-content">
                            <p><strong>Current Address:</strong> <?php echo htmlspecialchars($student['current_home_num_st'] . ', ' . $student['current_barangay'] . ', ' . $student['current_municipality'] . ', ' . $student['current_province']); ?> </p>
                            <p><strong>Permanent Address:</strong> <?php echo htmlspecialchars($student['permanent_home_num_st'] . ', ' . $student['permanent_barangay'] . ', ' . $student['permanent_municipality'] . ', ' . $student['permanent_province']); ?> </p>
                    </div>
                </div>

                <!-- Guardian Information Card -->
                <div class="card-container">
                    <?php echo "<div class='card-header $statusClass'> <h5>Guardian Information</h5></div>"; ?>
                    <div class="card-content">
                            <p><strong>Father Full Name:</strong> <?php echo htmlspecialchars($student['father_last_name'] . ', ' . $student['father_first_name'] . ' ' . $student['father_middle_name']); ?> </p>
                            <p><strong>Father Occupation:</strong> <?php echo htmlspecialchars(!empty($student['father_occupation']) ? $student['father_occupation'] : '-'); ?> </p>
                            <p><strong>Mother Full Maiden Name:</strong> <?php echo htmlspecialchars($student['mother_last_name'] . ', ' . $student['mother_first_name'] . ' ' . $student['mother_middle_name']); ?> </p>
                            <p><strong>Mother Occupation:</strong> <?php echo htmlspecialchars(!empty($student['mother_occupation']) ? $student['mother_occupation'] : '-'); ?> </p>
                    </div>
                </div>

                <!-- Educational Information Card -->
                <div class="card-container">
                    <?php echo "<div class='card-header $statusClass'> <h5>Educational Information</h5></div>"; ?>
                    <div class="card-content">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Last Grade Level Completed:</strong></p>
                                <ul id="student-grade-level-completed">
                                    <?php 
                                        // Check if the field is not empty
                                        if (!empty($student['grade_level_completed'])) {
                                            // Split the string by comma
                                            $gradeLevels = explode(',', $student['grade_level_completed']);
                                            
                                            // Loop through each grade level and display it as a list item
                                            foreach ($gradeLevels as $level) {
                                                echo '<li>' . htmlspecialchars(trim($level)) . '</li>';
                                            }
                                        } else {
                                            // Display a hyphen if the field is empty
                                            echo '<li> None </li>';
                                        }
                                    ?>
                                </ul>
                            </div>
                            <div class="col-md-6">               
                                <p><strong>Reason why not attended/complete schooling <br> (For Out Of School Youth only)</strong></p>
                                    <ul>
                                        <?php 
                                            // Check if the field is not empty
                                            if (!empty($student['reason_not_schooling'])) {
                                                // Split the string by comma
                                                $reasons = explode(',', $student['reason_not_schooling']);
                                                
                                                // Loop through each reasons and display it as a list item
                                                foreach ($reasons as $student_reason) {
                                                    echo '<li>' . htmlspecialchars(trim($student_reason)) . '</li>';
                                                }
                                            } else {
                                                // Display a hyphen if the field is empty
                                                echo '<li> None </li>';
                                            }

                                            if (!empty($student['reason_not_schooling_other'])) {
                                                echo '<li>' . htmlspecialchars($student['reason_not_schooling_other']) . '</li>';
                                            }
                                        ?>
                                    </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ALS Information Card -->
                <div class="card-container">
                    <div class="card-content">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Attended ALS before?</strong> <?php echo htmlspecialchars($student['attended_als'] == 1 ? 'Yes' : 'No'); ?></p>
                                <p><strong>ALS Programs Attended: </strong></p>
                                <ul>
                                    <?php 
                                        // Check if the field is not empty
                                        if (!empty($student['als_program_completed'])) {
                                            // Split the string by comma
                                            $alsprogram = explode(',', $student['als_program_completed']);
                                            
                                            // Loop through each als program and display it as a list item
                                            foreach ($alsprogram as $program) {
                                                echo '<li>' . htmlspecialchars(trim($program)) . '</li>';
                                            }
                                        } else {
                                            // Display a hyphen if the field is empty
                                            echo '<li> None </li>';
                                        }
                                    ?>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                    <p><strong>Completed ALS: </strong> <?php echo htmlspecialchars($student['completed_als'] == 1 ? 'Yes' : 'No'); ?></p>
                                    <p><strong>Preferred Modalities: </strong></p>
                                    <ul>
                                        <?php 
                                            // Check if the field is not empty
                                            if (!empty($student['preferred_modalities'])) {
                                                // Split the string by comma
                                                $alsmodalities = explode(',', $student['preferred_modalities']);
                                                
                                                // Loop through each als program and display it as a list item
                                                foreach ($alsmodalities as $modalities) {
                                                    echo '<li>' . htmlspecialchars(trim($modalities)) . '</li>';
                                                }
                                            } else {
                                                // Display a hyphen if the field is empty
                                                echo '<li> None </li>';
                                            }
                                        ?>
                                    </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Accessibility and Availability of CLC Card -->
                <div class="card-container">
                    <?php echo "<div class='card-header $statusClass'> <h5>Accessibility and Availability of CLC</h5></div>"; ?>
                    <div class="card-content">
                            <p><strong>Distance from home to Learning Center: </strong></p>
                                <ul>
                                    <?php 
                                        // Check if the field is not empty
                                        if (!empty($student['distance_from_home_km'])) {
                                            echo '<li> By km: ' . htmlspecialchars($student['distance_from_home_km']) . "</li>";
                                        } 

                                        if (!empty($student['distance_from_home_hours'])) {
                                            echo '<li> By hours and mins: ' . htmlspecialchars($student['distance_from_home_hours']). "</li>";
                                        } 
                                        
                                        if (empty($student['distance_from_home_km']) && empty($student['distance_from_home_hours'])) {
                                            // Display a hyphen if the field is empty
                                            echo '<li> Not mentioned </li>';
                                        }
                                    ?>
                                </ul>
                            <p><strong>Mode of Transportation from Home to Learning Center: </strong>
                                <?php 
                                    // Check if the field is not empty
                                    if (!empty($student['mode_of_transportation'])) {
                                        // Check if the value is "others"
                                        if ($student['mode_of_transportation'] !== 'Others') {
                                            echo htmlspecialchars($student['mode_of_transportation']);
                                        }
                                        else {
                                            if (!empty($student['mode_of_transportation_other'])) {
                                                echo htmlspecialchars($student['mode_of_transportation_other']);
                                            }
                                            else {
                                                echo '-';
                                            }
                                        }
                                    } else {
                                        echo '-';
                                    }
                                ?>
                            </p>
                            <p><strong>Preferred Schedule for Learning Sessions:</strong></p>
                                <div class="table-container">
                                    <table class="table table-bordered table-sm">
                                        <thead>
                                            <tr>
                                                <th>Day</th>
                                                <th>Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                                                
                                                foreach ($days as $day) {
                                                    $field = $day . '_Avail_Time';
                                                    
                                                    if (!empty($student[$field])) {
                                                        // Create a DateTime object from the 24-hour time string
                                                        $dateTime = DateTime::createFromFormat('H:i:s', $student[$field]);
                                                        
                                                        // Check if the time is exactly midnight
                                                        if ($dateTime->format('H:i:s') === '00:00:00') {
                                                            $formattedTime = '-';
                                                        } else {
                                                            // Format the DateTime object to 12-hour format with AM/PM
                                                            $formattedTime = $dateTime->format('g:i A');
                                                        }
                                                        echo '<tr><td>' . htmlspecialchars($day) . '</td><td>' . htmlspecialchars($formattedTime) . '</td></tr>';
                                                    } else {
                                                        echo '<tr><td>' . htmlspecialchars($day) . '</td><td>-</td></tr>';
                                                    }
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                    </div>
                </div>

                <!-- Attachments Card -->
                <div class="card-container">
                    <?php echo "<div class='card-header $statusClass'> <h5>Attachments</h5></div>"; ?>
                    <div class="card-content">
                        <p><strong>Submitted Document: </strong> <?php echo htmlspecialchars(!empty($student['document_tag']) ? $student['document_tag'] : '-'); ?> </p>
                            <!-- Display document button if available -->
                            <?php if ($student['document_id']): ?>
                                <button type="button" class="custom-button" data-bs-toggle="modal" data-bs-target="#documentModal" data-id="<?php echo htmlspecialchars($student['document_id']); ?>" onclick="showDocumentId(this)">
                                    <?php echo htmlspecialchars(!empty($student['document_name']) ? $student['document_name'] : '-'); ?>
                                </button>
                            <?php else: ?>
                                <p>No document available for this student.</p>
                            <?php endif; ?>
                    </div>
                </div>

                <div class="text-end">
                    <?php 
                        // Check status of student
                        if ($student['status'] === 'Pending') {
                            echo '<button class="custom-button btn-2 status-approved" id="approveButton">Approve</button>';
                            echo '<button class="custom-button btn-2 status-reject" id="rejectButton">Reject</button>';
                        } 
                    ?>
                </div> 

            </div>

            <!-- FLT -->
            <div id="content-2" class="icon-content">
                <div class="card-container">
                    <?php echo "<div class='card-header $statusClass'> <h5> FLT - " . $student['flt_type'] . " Level Answer Sheet </h5></div>"; ?>
                    <div class="card-content">
                        <div class="row">
                            <div class="col-md-6">
                                <p><b>STRANDS</b></p>
                            </div>
                            <div class="col-md-3 d-flex justify-content-center">
                                <p><b>SCORE</b></p>
                            </div>
                            <div class="col-md-3 d-flex justify-content-center">
                                <p><b>LEVEL FOR INTERVENTION</b></p>
                            </div>
                        </div>

                        <!-- PIS -->
                        <div class="row">
                            <div class="col-md-6">
                                <p id="toggle-flt-header" class="toggle-flt-header" data-target="toggle-pis">
                                    <i class='bx bx-plus' id="toggle-flt-icon" data-id="1" data-bs-toggle="tooltip" title="View Answer"></i> &nbsp; <b>Physical Information Sheet (PIS)</b>
                                </p>
                            </div>
                            <div class="col-md-3 d-flex justify-content-center align-items-baseline">
                                <input type="text" class="form-control custom-border input-flt-score" id="pis_score" name="pis_score" placeholder="" disabled>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control custom-border" id="lfv_pis_score" name="lfv_pis_score" placeholder="">
                            </div>
                        </div>

                        <!-- PIS Answers -->
                        <div class="row toggle-flt-content flt-answer-content" id="toggle-pis-content"> </div>
                        <div class="divider-flt-score"></div>

                        <!-- ENGLISH -->
                        <div class="row">
                            <div class="col-md-6">
                                <p> &nbsp; <b>LS 1 Communication Skills - English</b></p>
                            </div>
                            <div class="col-md-3 d-flex justify-content-center">
                                <input type="text" class="form-control custom-border input-flt-score" id="eng_comm_total" name="eng_comm_total" placeholder="" disabled>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control custom-border" id="lfv_eng_comm_total" name="lfv_eng_comm_total" placeholder="">
                            </div>
                        </div>
                        <div class="row flt-score-margin">
                            <div class="col-md-6 d-flex align-items-center">
                                <p id="toggle-flt-header" class="toggle-flt-header flt-label-score" data-target="toggle-engmc">
                                    <i class='bx bx-plus' id="toggle-flt-icon" data-id="2" data-bs-toggle="tooltip" title="View Answer"></i> &nbsp; Multiple Choice 
                                </p>
                                <input type="text" class="form-control custom-border input-flt-score ms-5" id="eng_comm_multiple" name="eng_comm_multiple" placeholder="" disabled>
                            </div>
                        </div>
                        <!-- ENG MC Answers -->
                        <div class="row toggle-flt-content flt-answer-content" id="toggle-engmc-content"> </div>

                        <div class="row flt-score-margin">
                            <div class="col-md-6 d-flex align-items-center">
                                <p id="toggle-flt-header" class="toggle-flt-header flt-label-score" data-target="toggle-engwriting"> 
                                    <i class='bx bx-plus' id="toggle-flt-icon" data-id="3" data-bs-toggle="tooltip" title="View Answer"></i> &nbsp; Writing 
                                </p>
                                <input type="text" class="form-control custom-border input-flt-score ms-5" id="eng_comm_writing" name="eng_comm_writing" placeholder="" disabled>
                            </div>
                        </div>
                        <!-- ENG writing Answers -->
                        <div class="row toggle-flt-content flt-answer-content" id="toggle-engwriting-content"> </div>

                        <div class="row flt-score-margin">
                            <div class="col-md-6 d-flex align-items-center">
                                <p id="toggle-flt-header" class="toggle-flt-header flt-label-score" data-target="toggle-englistening"> 
                                    <i class='bx bx-plus' id="toggle-flt-icon" data-id="4" data-bs-toggle="tooltip" title="View Answer"></i> &nbsp; Listening/Speaking 
                                </p>
                                <input type="text" class="form-control custom-border input-flt-score ms-5" id="eng_comm_listening" name="eng_comm_listening" placeholder="" disabled>
                            </div>
                        </div>
                        <!-- ENG writing Answers -->
                        <div class="row toggle-flt-content flt-answer-content" id="toggle-englistening-content"> </div>

                        <div class="divider-flt-score"></div>

                        <!-- FILIPINO -->
                        <div class="row">
                            <div class="col-md-6">
                                <p> &nbsp; <b>LS 1 Communication Skills - Filipino</b></p>
                            </div>
                            <div class="col-md-3 d-flex justify-content-center">
                                <input type="text" class="form-control custom-border input-flt-score" id="tag_comm_total" name="tag_comm_total" placeholder="" disabled>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control custom-border" id="lfv_tag_comm_total" name="lfv_tag_comm_total" placeholder="">
                            </div>
                        </div>
                        <div class="row flt-score-margin">
                            <div class="col-md-6 d-flex align-items-center">
                                <p id="toggle-flt-header" class="toggle-flt-header flt-label-score" data-target="toggle-tagmc"> <i class='bx bx-plus' id="toggle-flt-icon" data-id="5" data-bs-toggle="tooltip" title="View Answer"></i> &nbsp; Multiple Choice </p>
                                <input type="text" class="form-control custom-border input-flt-score ms-5" id="tag_comm_multiple" name="tag_comm_multiple" placeholder="" disabled>
                            </div>
                        </div>
                        <!-- FIL Multiple Choice Answers -->
                        <div class="row toggle-flt-content flt-answer-content" id="toggle-tagmc-content"> </div>

                        <div class="row flt-score-margin">
                            <div class="col-md-6 d-flex align-items-center">
                                <p id="toggle-flt-header" class="toggle-flt-header flt-label-score" data-target="toggle-tagwriting"> <i class='bx bx-plus' id="toggle-flt-icon" data-id="6" data-bs-toggle="tooltip" title="View Answer"></i> &nbsp; Pagsulat </p>
                                <input type="text" class="form-control custom-border input-flt-score ms-5" id="tag_comm_writing" name="tag_comm_writing" placeholder="" disabled>
                            </div>
                        </div>
                        <!-- FIL writing Answers -->
                        <div class="row toggle-flt-content flt-answer-content" id="toggle-tagwriting-content"> </div>

                        <div class="row flt-score-margin">
                            <div class="col-md-6 d-flex align-items-center">
                                <p id="toggle-flt-header" class="toggle-flt-header flt-label-score" data-target="toggle-taglistening"> <i class='bx bx-plus' id="toggle-flt-icon" data-id="7" data-bs-toggle="tooltip" title="View Answer"></i> &nbsp; Pakikinig/Pagsusulat </p>
                                <input type="text" class="form-control custom-border input-flt-score ms-5" id="tag_comm_listening" name="tag_comm_listening" placeholder="" disabled>
                            </div>
                        </div>
                        <!-- FIL writing Answers -->
                        <div class="row toggle-flt-content flt-answer-content" id="toggle-taglistening-content"> </div>

                        <div class="divider-flt-score"></div>

                        <!-- Science -->
                        <div class="row">
                            <div class="col-md-6">
                                <p id="toggle-flt-header" class="toggle-flt-header" data-target="toggle-science"><i class='bx bx-plus' id="toggle-flt-icon" data-id="8" data-bs-toggle="tooltip" title="View Answer"></i> &nbsp; <b>LS 2 Scientific Literacy and Critical Thinking Skills</b></p>
                            </div>
                            <div class="col-md-3 d-flex justify-content-center">
                                <input type="text" class="form-control custom-border input-flt-score" id="science_total" name="science_total" placeholder="" disabled>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control custom-border" id="lfv_science_total" name="lfv_science_total" placeholder="">
                            </div>
                        </div>
                        <!-- Science Answers -->
                        <div class="row toggle-flt-content flt-answer-content" id="toggle-science-content"> </div>

                        <div class="divider-flt-score"></div>

                        <!-- Math -->
                        <div class="row">
                            <div class="col-md-6">
                                <p id="toggle-flt-header" class="toggle-flt-header" data-target="toggle-math"><i class='bx bx-plus' id="toggle-flt-icon" data-id="9" data-bs-toggle="tooltip" title="View Answer"></i> &nbsp; <b>LS 3 Mathematical and Problem Solving Skills</b></p>
                            </div>
                            <div class="col-md-3 d-flex justify-content-center">
                                <input type="text" class="form-control custom-border input-flt-score" id="math_total" name="math_total" placeholder="" disabled>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control custom-border" id="lfv_math_total" name="lfv_math_total" placeholder="">
                            </div>
                        </div>
                        <!-- Math Answers -->
                        <div class="row toggle-flt-content flt-answer-content" id="toggle-math-content"> </div>

                        <div class="divider-flt-score"></div>

                        <!-- Life Career -->
                        <div class="row">
                            <div class="col-md-6">
                                <p id="toggle-flt-header" class="toggle-flt-header" data-target="toggle-life"><i class='bx bx-plus' id="toggle-flt-icon" data-id="10" data-bs-toggle="tooltip" title="View Answer"></i> &nbsp; <b>LS 4 Life & Career Skills</b></p>
                            </div>
                            <div class="col-md-3 d-flex justify-content-center">
                                <input type="text" class="form-control custom-border input-flt-score" id="life_total" name="life_total" placeholder="" disabled>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control custom-border" id="lfv_life_total" name="lfv_life_total" placeholder="">
                            </div>
                        </div>
                        <!-- Life Answers -->
                        <div class="row toggle-flt-content flt-answer-content" id="toggle-life-content"> </div>

                        <div class="divider-flt-score"></div>

                        <!-- Self Society -->
                        <div class="row">
                            <div class="col-md-6">
                                <p id="toggle-flt-header" class="toggle-flt-header" data-target="toggle-society"><i class='bx bx-plus' id="toggle-flt-icon" data-id="11" data-bs-toggle="tooltip" title="View Answer"></i> &nbsp; <b>LS 5 Understanding the Self & Society</b></p>
                            </div>
                            <div class="col-md-3 d-flex justify-content-center">
                                <input type="text" class="form-control custom-border input-flt-score" id="society_total" name="society_total" placeholder="" disabled>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control custom-border" id="lfv_society_total" name="lfv_society_total" placeholder="">
                            </div>
                        </div>
                        <!-- Society Answers -->
                        <div class="row toggle-flt-content flt-answer-content" id="toggle-society-content"> </div>

                        <div class="divider-flt-score"></div>

                        <!-- Digital -->
                        <div class="row">
                            <div class="col-md-6">
                                <p id="toggle-flt-header" class="toggle-flt-header" data-target="toggle-digital"><i class='bx bx-plus' id="toggle-flt-icon" data-id="12" data-bs-toggle="tooltip" title="View Answer"></i> &nbsp; <b>LS 6 Digital Citizenship</b></p>
                            </div>
                            <div class="col-md-3 d-flex justify-content-center">
                                <input type="text" class="form-control custom-border input-flt-score" id="digital_total" name="digital_total" placeholder="" disabled>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control custom-border" id="lfv_digital_total" name="lfv_digital_total" placeholder="">
                            </div>
                        </div>
                        <!-- FIL writing Answers -->
                        <div class="row toggle-flt-content flt-answer-content" id="toggle-digital-content"> </div>

                        <div class="divider-flt-score"></div>

                        <!-- Overall Score -->
                        <div class="row">
                            <div class="col-md-6">
                                <p></i> &nbsp; <b>OVERALL SCORE</b></p>
                            </div>
                            <div class="col-md-3 d-flex justify-content-center">
                                <input type="text" class="form-control custom-border input-flt-score" id="overall_score" name="overall_score" placeholder="" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-end">
                    <button class="custom-button btn-2 status-approved" id="saveButton">Save Changes</button>
                </div> 
            </div>

            <!-- Attachments-->
            <div id="content-3" class="icon-content">Content for Icon 3</div>
            

            <!-- Modal -->
            <div class="modal fade" id="documentModal" tabindex="-1" aria-labelledby="documentModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="documentModalLabel">Document Preview</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Document will be loaded here -->
                        </div>
                    </div>
                </div>
            </div>

        </main>
        <!-- MAIN -->
    </section>

    <script>
       /* document.addEventListener('DOMContentLoaded', () => {
            
        });*/
    </script>


</body>
</html>
