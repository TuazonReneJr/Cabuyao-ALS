//Global variables

let rejectReason = '';
let assessmentType = '';
let counter = 1;

// Initialize fields onload of Page
document.addEventListener("DOMContentLoaded", async function() {
   /* add events/functions for initializing the page*/

   addEventListeners();
   iconTabs();
});

function showDocumentId(button) {
    // Get the document ID from the button's data-id attribute
    var documentId = button.getAttribute('data-id');
    
    // Display the document ID in an alert
    const modalBody = document.querySelector('#documentModal .modal-body');
    const documentUrl = `../../php/admin/fetch_student_document.php?document_id=${documentId}`;

    fetch(documentUrl)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok.');
            }
            return response.blob(); // Handle binary data as a Blob
        })
        .then(blob => {
            const fileExtension = blob.type.split('/')[1];
            const objectURL = URL.createObjectURL(blob);
            if (['jpeg', 'jpg', 'png'].includes(fileExtension)) {
                modalBody.innerHTML = `<img src="${objectURL}" alt="Document" style="max-width: 100%;   height: auto;">`;
            } else if (fileExtension === 'pdf') {
                modalBody.innerHTML = `<embed src="${objectURL}" type="application/pdf" width="100%"    height="600px">`;
            } else {
                modalBody.innerHTML = `<p>Document type not supported for preview.</p>`;
            }
        })
        .catch(error => {
            modalBody.innerHTML = `<p>Error fetching document: ${error.message}</p>`;
            console.error('Error:', error);
        });
};

async function addEventListeners() {
    try {

        if (document.getElementById('approveButton') && document.getElementById('rejectButton')) {
            const sessionData = await getSessionData(['student_id']);
            const studentId = sessionData.student_id;
            assessmentType = await evaluateFLTofStudent();

            // Add event listener to the approve button
            document.getElementById('approveButton').addEventListener('click', () => {
                showModal(
                    'Approval Required',
                    'Are you sure you want to approve this request?',
                    'By approving, you accept that the student is enrolled in the ALS Program and will take the FLT listed below to assess their skills. Click Yes to confirm.',
                    'confirm-question',
                    async () => {
                        await updateStudentStatus(studentId, 'Approved');
                    }, null,
                    `<div class='mb-3'>
                        <label for='fltType' class='form-label'>FLT Type:</label>
                        <select class='form-control' id='fltType' name='fltType'>
                            <option value='Elementary'>Elementary FLT</option>
                            <option value='Highschool'>Highschool FLT</option>
                            <option value='Other'>Other: Cannot Be Assessed</option>
                        </select>
                    </div>`
                );

                // Set the dropdown value after the modal is shown
                setTimeout(() => {
                        document.getElementById('fltType').value = assessmentType;

                        if (assessmentType !== "Other") {
                            document.getElementById('fltType').disabled = true;
                        }
                    }, 100);
            });

            // Add event listener to the reject button
            document.getElementById('rejectButton').addEventListener('click', () => {
                showModal(
                    'Confirm Reject',
                    'Are you sure you want to reject this request?',
                    'By rejecting means that the student is rejected on taking this LMS Program. Please provide a reason of rejection. Click Yes to confirm.',
                    'error-question',
                    async () => {
                        await updateStudentStatus(studentId, 'Rejected');
                    },
                    null,
                    '<div class="mb-3"><label for="rejectReason" class="form-label">Reject Reason</label><input type="text" class="form-control" id="rejectReason" placeholder="Enter reason here"></div>'
                );
            });
        }
        
        // Add event listener to the flt icon button
        /*document.getElementById('toggle-flt-header').addEventListener('click', function() {
            var icon = document.getElementById('toggle-flt-icon');
            var content = document.getElementById('toggle-flt-content');
        
            if (content.classList.contains('show')) {
                content.classList.remove('show');
                icon.classList.remove('bx-minus');
                icon.classList.add('bx-plus');
            } else {
                content.classList.add('show');
                icon.classList.remove('bx-plus');
                icon.classList.add('bx-minus');
            }
        });*/

        document.querySelectorAll('.toggle-flt-header').forEach(function(header) {
            header.addEventListener('click', toggleContent);
        });
        

    } catch (error) {
        console.error(error.message);
    }
};

async function updateStudentStatus(studentId, status) {
    try {
        debugger;
        showLoadingScreen("Please wait while processing...");

        let bodyParams = `studentId=${studentId}&status=${status}`;

        if (status === 'Rejected') {
            rejectReason = document.getElementById('rejectReason').value;
            bodyParams += `&rejectReason=${encodeURIComponent(rejectReason)}`;
        } else if (status === 'Approved') {
            let studentFirstname = document.getElementById("student_firstname").innerText.split(": ")[1].trim();
            let studentLastname = document.getElementById("student_lastname").innerText.split(": ")[1].trim();
            assessmentType = document.getElementById('fltType').value;
            bodyParams += `&studentFirstname=${encodeURIComponent(studentFirstname)}&studentLastname=${encodeURIComponent(studentLastname)}&assessmentType=${encodeURIComponent(assessmentType)}`;
        }

        const response = await fetch('../../php/admin/update_enroll_details.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: bodyParams
        });

        const data = await response.json();

        if (data.success) {
            const studentEmail = document.getElementById("student_email").innerText.split(": ")[1].trim();

            const messagesResponse = await fetch('../../data/message-constants.json'); // Adjust the path to your JSON file
            const messages = await messagesResponse.json();

            let subject = '';
            let messageBody = '';

            debugger;

            if (status === 'Approved') {
                subject = messages.approved_enrollment.approved_subject;
                messageBody = messages.approved_enrollment.approved_messageBody
                    .replace('{tempUsername}', data.username)
                    .replace('{tempPassword}', data.password);
            } else if (status === 'Rejected') {
                subject = messages.rejected_enrollment.rejected_subject;
                messageBody = messages.rejected_enrollment.rejected_messageBody.replace('{reason}', rejectReason);
            }

            hideLoadingScreen();

            await sendEmail(studentEmail, subject, messageBody, status);
            displayUpdateResult(true, status);
        } else {
            hideLoadingScreen();
            displayUpdateResult(false, status);
        }
    } catch (error) {
        hideLoadingScreen();
        throw error.message;
    }
};

async function sendEmail(studentEmail, subject, messageBody, status) {
    try {

        showLoadingScreen("Please wait while processing...");

        const response = await fetch('../../php/common/send_email.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `email=${encodeURIComponent(studentEmail)}&subject=${encodeURIComponent(subject)}&message=${encodeURIComponent(messageBody)}`
        });

        const data = await response.json();

        if (data.success) {
            hideLoadingScreen();
            displayUpdateResult(true, status);
            //return { success: true };
        } else {
            //return { success: false, error: data.error };
            hideLoadingScreen();
            displayUpdateResult(false, status);
        }
    } catch (error) {
        hideLoadingScreen();
        throw error.message;
    }
};

function displayUpdateResult(isSuccess, status) {
    try {
        if(isSuccess) {
            if (status === "Approved") {
                showModal(
                    'Success',
                    'Enrollment Approved',
                    'The student\'s enrollment has been successfully approved. The student will receive a confirmation email with further details.',
                    'success',
                    () => {
                        location.reload(); // Reload the page to reflect changes
                    }, null, null
                );
            }
            else {
                showModal(
                    'Rejected',
                    'Enrollment Rejected',
                    'The student\'s enrollment has been rejected. The student will receive an email with the reason for rejection.',
                    'success',
                    () => {
                        location.reload(); // Reload the page to reflect changes
                    }, null, ''
                );
            }
        }
        else {
            showModal(
                'Error',
                'Error Encountered in Database',
                'Contact your Admin.',
                'error',
                () => {
                    location.reload(); // Reload the page to reflect changes
                }, null, null
            );
        }
        
    } catch (error) {
        throw error.message;
    }
};

async function evaluateFLTofStudent() {
    try {
        let FLTType = null;

        const elemValues = ['Kinder', 'Grade 1', 'Grade 2', 'Grade 3', 'Grade 4', 'Grade 5', 'Grade 6'];
        const highSchoolValues = ['Grade 7', 'Grade 8', 'Grade 9', 'Grade 10', 'Grade 11'];

        const ulElement = document.getElementById('student-grade-level-completed');

        // Get all <li> elements under the <ul>
        const liElements = ulElement.querySelectorAll('li');

        // Extract the text content of each <li>
        const completedGrades = Array.from(liElements).map(li => li.textContent.trim());

        // Check if all elementary grades are completed
        const isElementaryGraduate = elemValues.every(grade => completedGrades.includes(grade));
        
        // Check if all high school grades are completed
        const isHighSchoolGraduate = highSchoolValues.every(grade => completedGrades.includes(grade));

        if (isElementaryGraduate && isHighSchoolGraduate) {
            // Student has completed both elementary and high school
            FLTType = "Other";
        } else if (isElementaryGraduate) {
            // Student is an elementary graduate but not a high school graduate
            FLTType = "Highschool";
        } else if (completedGrades.some(grade => elemValues.includes(grade))) {
            // Student has completed some elementary grades but not all
            FLTType = "Elementary";
        } else {
            // Student has not completed enough grades to be considered an elementary or high school graduate
            FLTType = "Other";
        }

        return FLTType;
    } catch (error) {
        throw new Error('Error in evaluateFLTofStudent: ' + error.message);
    }
};

function iconTabs() {
    try {
        const icons = document.querySelectorAll('.right i');
        const contents = document.querySelectorAll('.icon-content');

        // Function to handle icon clicks
        const handleClick = (icon) => {
            // Remove 'active' class from all icons
            icons.forEach(i => i.classList.remove('active'));

            // Hide all content divs
            contents.forEach(content => content.classList.remove('active'));

            // Add 'active' class to the clicked icon
            icon.classList.add('active');

            // Show the corresponding content div
            const id = icon.getAttribute('data-id');
            const contentToShow = document.getElementById(`content-${id}`);
            if (contentToShow) {
                contentToShow.classList.add('active');

                if (id === "2") { // FLT
                    retrieveFLTAnswer();
                }
            }

            // Save the active icon id to localStorage
            localStorage.setItem('activeIconId', id);
        };

        // Load the active icon from localStorage
        const activeId = localStorage.getItem('activeIconId');
        if (activeId) {
            const activeIcon = document.querySelector(`.right i[data-id="${activeId}"]`);
            if (activeIcon) {
                handleClick(activeIcon);
            }
        }

        // Add click event listener to each icon
        icons.forEach(icon => {
            icon.addEventListener('click', () => handleClick(icon));
        });
    } catch (error) {
        throw new Error('Error in iconTabs: ' + error.message);
    }
};

// Function to toggle content and icon
function toggleContent(event) {
    var target = event.currentTarget.getAttribute('data-target');
    var icon = event.currentTarget.querySelector('#toggle-flt-icon');
    var content = document.getElementById(`${target}-content`);

    if (content.classList.contains('show')) {
        content.classList.remove('show');
        icon.classList.remove('bx-minus');
        icon.setAttribute('title', 'View Answer');
        icon.classList.add('bx-plus');
    } else {
        content.classList.add('show');
        icon.classList.remove('bx-plus');
        icon.setAttribute('title', 'Hide Answer');
        icon.classList.add('bx-minus');
    }
};

async function retrieveFLTAnswer() {
    try {
        const sessionData = await getSessionData(['student_id']);
        const studentId = sessionData.student_id;

        // Send a GET request to the PHP script with the student_id as a query parameter
        const response = await fetch(`../../php/admin/fetch_flt_student_answer.php?student_id=${studentId}`);

        // Check if the request was successful
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }

        // Parse the JSON response
        const data = await response.json();

        console.log("Data: ", data);

        const responseArray = JSON.parse(data[0].answer);

        await initializeScores(data);

        await builtHTMLAnswers(responseArray);

    } catch (error) {
        console.error('Error fetching data:', error);
    }
};

async function initializeScores(responseScores) {
    try {
        document.getElementById("eng_comm_multiple").value = responseScores[0].eng_comm_multiple !== null ? strToInt(responseScores[0].eng_comm_multiple) : 0;
        document.getElementById("tag_comm_multiple").value = responseScores[0].fil_comm_multiple !== null ? strToInt(responseScores[0].fil_comm_multiple) : 0;
        document.getElementById("science_total").value = responseScores[0].science_total !== null ? strToInt(responseScores[0].science_total) : 0;
        document.getElementById("math_total").value = responseScores[0].math_total !== null ? strToInt(responseScores[0].math_total) : 0;
        document.getElementById("life_total").value = responseScores[0].life_total !== null ? strToInt(responseScores[0].life_total) : 0;
        document.getElementById("society_total").value = responseScores[0].society_total !== null ? strToInt(responseScores[0].society_total) : 0;
        document.getElementById("digital_total").value = responseScores[0].digital_total !== null ? strToInt(responseScores[0].digital_total) : 0;
        document.getElementById("pis_score").value = responseScores[0].pis_score !== null ? strToInt(responseScores[0].pis_score) : 0;
        document.getElementById("eng_comm_writing").value = responseScores[0].eng_comm_writing !== null ? strToInt(responseScores[0].eng_comm_writing) : 0;
        document.getElementById("eng_comm_listening").value = responseScores[0].eng_comm_listening !== null ? strToInt(responseScores[0].eng_comm_listening) : 0;
        document.getElementById("eng_comm_total").value = responseScores[0].eng_comm_total !== null ? strToInt(responseScores[0].eng_comm_total) : 0;
        document.getElementById("tag_comm_writing").value = responseScores[0].fil_comm_writing !== null ? strToInt(responseScores[0].fil_comm_writing) : 0;
        document.getElementById("tag_comm_listening").value = responseScores[0].fil_comm_listening !== null ? strToInt(responseScores[0].fil_comm_listening) : 0;
        document.getElementById("tag_comm_total").value = responseScores[0].fil_comm_total !== null ? strToInt(responseScores[0].fil_comm_total) : 0;

        calculateTotalEnglish();
        calculateTotalFilipino();
        calculateoverallScore();

    } catch (error) {
        console.error('Error initializing score data:', error);
    }
};

function calculateoverallScore() {
    try {
        let pisScore = strToInt(document.getElementById("pis_score").value);
        let eng_comm_total = strToInt(document.getElementById("eng_comm_total").value);
        let tag_comm_total = strToInt(document.getElementById("tag_comm_total").value);
        let science_total = strToInt(document.getElementById("science_total").value);
        let math_total = strToInt(document.getElementById("math_total").value);
        let life_total = strToInt(document.getElementById("life_total").value);
        let society_total = strToInt(document.getElementById("society_total").value);
        let digital_total = strToInt(document.getElementById("digital_total").value);

        document.getElementById("overall_score").value = pisScore + eng_comm_total + tag_comm_total + science_total + math_total + life_total + society_total + digital_total;

        
    } catch (error) {
        console.error('Error computing overall score data:', error);
    }
};

function calculateTotalEnglish() {
    try {
        let eng_comm_multiple = strToInt(document.getElementById("eng_comm_multiple").value);
        let eng_comm_writing = strToInt(document.getElementById("eng_comm_writing").value);
        let eng_comm_listening = strToInt(document.getElementById("eng_comm_listening").value);

        document.getElementById("eng_comm_total").value = eng_comm_multiple + eng_comm_writing + eng_comm_listening;
    } catch (error) {
        console.error('Error computing total english score data:', error);
    }
};

function calculateTotalFilipino() {
    try {
        let tag_comm_multiple = strToInt(document.getElementById("tag_comm_multiple").value);
        let tag_comm_writing = strToInt(document.getElementById("tag_comm_writing").value);
        let tag_comm_listening = strToInt(document.getElementById("tag_comm_listening").value);

        document.getElementById("tag_comm_total").value = tag_comm_multiple + tag_comm_writing + tag_comm_listening;
    } catch (error) {
        console.error('Error computing total english score data:', error);
    }
};

async function builtHTMLAnswers(responseData) {
    try {
        debugger;

        // Group each by suffix
        let checkSuffix = ['pis-', 'eng-','tag-','science-','math-','life-','society-','digital-'];

        // Group items based on suffixes
        responseData.forEach(item => {
            let addedToGroup = false;

            // Check each suffix to see if the item contains it
            checkSuffix.forEach(suffix => {
                if (Object.keys(item).some(key => key.includes(suffix))) {
                    addedToGroup = true;
                    createFLTElements(suffix.replace("-",""), item);
                }
            });

            if (!addedToGroup) {
                createFLTElements(null, item);
            }
        });

         // Add event listeners to all pis fields
        document.querySelectorAll('[id^="pis-"]').forEach(input => {
            input.addEventListener('input', updatePisScore);
        });

         // Add event listeners to all pis fields
         document.querySelectorAll('[id^="eng-"]').forEach(input => {
            input.addEventListener('input', updateEngScore);
        });

         // Add event listeners to all pis fields
         document.querySelectorAll('[id^="tag-"]').forEach(input => {
            input.addEventListener('input', updateFilScore);
        });

        return;
    } catch (error) {
        console.error('Error grouping data:', error);
    }
};

async function createFLTElements(suffix, item) {
    try {
        // Containers
        let pisContent = document.getElementById("toggle-pis-content");
        let engMultipleChoice = document.getElementById("toggle-engmc-content");
        let engWritingChoice = document.getElementById("toggle-engwriting-content");
        let engListeningChoice = document.getElementById("toggle-englistening-content");
        let filMultipleChoice = document.getElementById("toggle-tagmc-content");
        let filWritingChoice = document.getElementById("toggle-tagwriting-content");
        let filListeningChoice = document.getElementById("toggle-taglistening-content");
        let scienceMultipleChoice = document.getElementById("toggle-science-content");
        let mathMultipleChoice = document.getElementById("toggle-math-content");
        let lifeMultipleChoice = document.getElementById("toggle-life-content");
        let societyMultipleChoice = document.getElementById("toggle-society-content");
        let digitalMultipleChoice = document.getElementById("toggle-digital-content");

        let flag ="";
        let isCorrect;

        if (Object.keys(item).some(key => key.includes("eng")) || Object.keys(item).some(key => key.includes("tag"))) {
            if (Object.keys(item).some(key => key.includes("listening"))) {
                flag = "listening";
            }
            else if (Object.keys(item).some(key => key.includes("writing"))) {
                flag = "writing";
            }
            else {
                flag = "multiple-choice";
            }
        } else if (!suffix){
            suffix = "tag"
            flag = "multiple-choice";
        } else if (Object.keys(item).some(key => key.includes("pis"))){
            flag = "writing";
        } else {
            flag = "multiple-choice";
        }

        const div = document.createElement('div');
        div.classList.add("flt-group");

        const answerDiv = document.createElement('div');
        answerDiv.classList.add(`flt-answer-sheet-${flag}`);

        let htmlContent = ``;
        let answerContent = `<p class='flt-answer-sheet-label'> <b> Answer: </b> </p>`;
            
        // Loop through the keys of the object
        for (const [key, value] of Object.entries(item)) {
          // Append key and value to HTML content
            if (key.includes('flt-questions') || key.includes('flt-question-box')) {
                if (flag !== "multiple-choice") {
                    htmlContent += `<div class="group-score d-flex align-items-center">
                                <input type="text" class="form-control custom-border input-flt-score-sheet" placeholder="" id='${suffix}-${counter}'>
                                <p class='${key}'>${value}</p>
                            </div>`;
                    counter++;
                }
                else {
                    if (Object.keys(item).some(key => key.includes("isCorrect")) && key.includes('flt-questions')) {
                        if (item["isCorrect"] === true) {
                            htmlContent += `<div class="group-score d-flex align-items-center">
                                <p> <i class='bx bx-check'></i> </p>
                                <p class='${key}'>${value}</p>
                            </div>`;
                        }
                        else {
                            htmlContent += `<div class="group-score d-flex align-items-center">
                                <p> <i class='bx bx-x'></i> </p>
                                <p class='${key}'>${value}</p>
                            </div>`;
                        }
                    }
                    else {
                        htmlContent += `<div class="group-score d-flex align-items-center">
                                <p class='${key}'>${value}</p>
                            </div>`;
                    }
                }
            }
            else if (!key.includes('isCorrect')) {
                answerContent += `<p class='${key} flt-answer'> ${value}</p>`;
            }
        }
        
        // Set the HTML content to the newly created div
        div.innerHTML = htmlContent;

        answerDiv.innerHTML = answerContent;
        
        switch(suffix) {
            case 'eng':
                // Append the div to the container
                if (flag === "multiple-choice") {
                    engMultipleChoice.appendChild(div);
                    engMultipleChoice.appendChild(answerDiv);
                } else if (flag === "writing") {
                    engWritingChoice.appendChild(div);
                    engWritingChoice.appendChild(answerDiv);
                } else if (flag === "listening") {
                    engListeningChoice.appendChild(div);
                    engListeningChoice.appendChild(answerDiv);
                }
                break;
            case 'tag':
                // Append the div to the container
                if (flag === "multiple-choice") {
                    filMultipleChoice.appendChild(div);
                    filMultipleChoice.appendChild(answerDiv);
                } else if (flag === "writing") {
                    filWritingChoice.appendChild(div);
                    filWritingChoice.appendChild(answerDiv);
                } else if (flag === "listening") {
                    filListeningChoice.appendChild(div);
                    filListeningChoice.appendChild(answerDiv);
                }
                break;
            case 'science':
                // Append the div to the container
                scienceMultipleChoice.appendChild(div);
                scienceMultipleChoice.appendChild(answerDiv);
                break;
            case 'math':
                // Append the div to the container
                mathMultipleChoice.appendChild(div);
                mathMultipleChoice.appendChild(answerDiv);
                break;
            case 'life':
                // Append the div to the container
                lifeMultipleChoice.appendChild(div);
                lifeMultipleChoice.appendChild(answerDiv);
                break;
            case 'society':
                // Append the div to the container
                societyMultipleChoice.appendChild(div);
                societyMultipleChoice.appendChild(answerDiv);
                break;
            case 'digital':
                // Append the div to the container
                digitalMultipleChoice.appendChild(div);
                digitalMultipleChoice.appendChild(answerDiv);
                break;
            default:
                // Append the div to the container
                pisContent.appendChild(div);
                pisContent.appendChild(answerDiv);
                break;
        }

        return;
        
    } catch (error) {
        console.error('Error creating elements:', error);
    }
};

// Function to update pis_score
function updatePisScore() {
    let sum = 0;

    // Select all elements with an ID that starts with "pis-"
    document.querySelectorAll('[id^="pis-"]').forEach(input => {
        const value = strToInt(input.value) || 0;
        sum += value;
    });

    // Update the pis_score field with the sum
    document.getElementById('pis_score').value = sum;

    calculateoverallScore();
};

// Function to update pis_score
function updateEngScore() {
    let sum = 0;

    // Select all elements with an ID that starts with "pis-"
    document.querySelectorAll('[id^="eng-"]').forEach(input => {
        const value = strToInt(input.value) || 0;
        sum += value;
    });

    // Update the pis_score field with the sum
    document.getElementById('eng_comm_total').value = sum + strToInt(document.getElementById('eng_comm_multiple').value);

    calculateoverallScore();
};

// Function to update pis_score
function updateFilScore() {
    let sum = 0;

    // Select all elements with an ID that starts with "pis-"
    document.querySelectorAll('[id^="tag-"]').forEach(input => {
        const value = strToInt(input.value) || 0;
        sum += value;
    });

    // Update the pis_score field with the sum
    document.getElementById('tag_comm_total').value = sum + strToInt(document.getElementById('tag_comm_multiple').value);

    calculateoverallScore();
};


