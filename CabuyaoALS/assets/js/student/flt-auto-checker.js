// Initialize fields onload of Page
document.addEventListener("DOMContentLoaded", async function() {
    /* add events/functions for initializing the page*/
 
    addEventListeners();
 });


 function addEventListeners() {
    try {
        document.getElementById("submit").addEventListener("click", submitFLTAssessment);
        
    } catch (error) {
        throw error.message;
    }
 };

 async function submitFLTAssessment(event) {
    try {
        event.preventDefault(); 

        debugger;

        const sessionData = await getSessionData(['user_id', 'first_name', 'last_name']);
        const studentId = sessionData.user_id;
        const first_name = sessionData.first_name;
        const last_name = sessionData.last_name;
        

        // Show confirmation modal
        showModal(
            'Submit Assessment',
            'Are you sure you want to submit your answers',
            'If you want to check first your answers, please click "No". If you want to proceed on submitting, Please click "Yes".',
            'confirm-question',
            () => {
                saveAnswers(studentId);
            },
            null, 
            null
        );


    } catch (error) {
        console.error('Error:', error.message);
    }
};

async function autoCheckFLTAnswers(studentId, answerData, answerId) {
    try {
        showLoadingScreen();

        let answerKeyname = "";
        let data = {};
        let als_level = "";

        if (checkURLContains("elementary-functional-test")) {
            answerKeyname = "Elementary FLT";
            als_level = "Elementary";
        } else if (checkURLContains("highschool-functional-test")) {
            answerKeyname = "Junior High School FLT";
            als_level = "High School";
        } else {
            return;
        }

        // Prepare data for submission
        const postData = {
            student_id: studentId, // Use the fetched student ID,
            answer_id: answerId,
            als_level: als_level, // Replace with your method to get ALS level
            flt_test: "Pre", // Replace with your method to get FLT test type
            scores: answerData
        };

        // Hide loading screen
        hideLoadingScreen();


        storeScores(postData);
        
    } catch (error) {
        // Hide loading screen
        hideLoadingScreen();
        console.error('Error:', error.message);
    }
};

async function storeScores(postData) {
    try {
        showLoadingScreen();

        const sessionData = await getSessionData(['user_id', 'first_name', 'last_name']);
        const studentId = sessionData.user_id;
        const first_name = sessionData.first_name;
        const last_name = sessionData.last_name;

        const response = await fetch('../../php/student/insert_flt_score.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(postData)
        });

        const text = await response.text(); // Get raw response text
        console.log('Raw response:', text); // Log the raw response

        const result = JSON.parse(text); // Parse the JSON manually

        hideLoadingScreen();
        
        if (result.success) {

            const placeholders = {
                studentFirstName: first_name,
                studentLastName: last_name
            };
            await createNotifications('flt_submission', placeholders, null , studentId, null);

            showModal(
                'FLT submitted successfully.',
                'Thank you for taking your assessment',
                'An email will be sent to you once FLT is assessed.',
                'success',
                async () => {
                    await updateRecord();
                    window.location.href = "my-assessment.php"; // Reload the page to reflect changes
                }, null, null
            );
        } else {
            showModal(
                'FLT submitted failed',
                'There is an error in the submission.',
                'Please contact your admin for this issue.',
                'error',
                () => {
                    location.reload(); // Reload the page to reflect changes
                }, null, null
            );
        }
    } catch (error) {
        hideLoadingScreen();
        console.error('Error:', error);
    }
};

async function saveAnswers(student_id) {
    try {
        debugger;
        showLoadingScreen("Please wait while saving your answers...");

        var form = document.getElementById("assessment-flt-form");
        const formArray = [];

        const questions = document.querySelectorAll('.flt-card'); // Select all question containers

        questions.forEach((question) => {
            let questionLabel = question.querySelector('.flt-questions').innerText;
            questionLabel = questionLabel.replace(/\s+/g, ' ').trim(); // Remove extra spaces and line breaks
            
            const questionBoxElement = question.querySelector('.flt-question-box');
            let questionBox = questionBoxElement ? questionBoxElement.innerText : null;
            if (questionBox) {
                questionBox = questionBox.replace(/\s+/g, ' ').trim(); // Remove extra spaces and line breaks
            }

            const inputElements = question.querySelectorAll('input, textarea');

            const questionObject = {};
            questionObject["flt-questions"] = questionLabel;

            if (questionBox) {
                questionObject["flt-question-box"] = questionBox;
            }

            inputElements.forEach(input => {
                if (input.type === "checkbox" && input.checked) {
                    questionObject[input.name] = input.value;
                } else if (input.type === "radio" && input.checked) {
                    questionObject[input.name] = input.value;
                } else if (input.type === "text" || input.tagName.toLowerCase() === "textarea") {
                    questionObject[input.name] = input.value;
                }
            });

            formArray.push(questionObject);
        });

        let responseData = await checkAnswers(formArray);

        console.log(responseData);

        const postData = {
            "student_info": {
                student_id: student_id
            }, 
            "student_answers": responseData.formArray
        };

        console.log(JSON.stringify(postData));

        // Send the answer keys as JSON to the server
        const response = await fetch('../../php/student/store_flt_answers.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(postData)  // Convert JavaScript object to JSON string
        });

        // Check if the response status is OK (status code 200-299)
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }

        // Parse the response as text or JSON
        const data = await response.text(); // Change to response.json() if expecting JSON
        const result = JSON.parse(data); // Parse the JSON manually

        // Log the success data
        console.log('Success:', result);

        if (result.success) {
            await autoCheckFLTAnswers(student_id, responseData.scores, result.id);
        }

        hideLoadingScreen();

        // Return the response data if needed
        return result;

    } catch (error) {
        hideLoadingScreen();
        console.error('Error:', error);
    }
};

async function retrieveFLTAnswers() {
    try {
        showLoadingScreen();

        let answerKeyname = "";
        let data = {};
        let als_level = "";

        if (checkURLContains("elementary-functional-test")) {
            answerKeyname = "Elementary FLT";
            als_level = "Elementary";
        } else if (checkURLContains("highschool-functional-test")) {
            answerKeyname = "Junior High School FLT";
            als_level = "High School";
        } else {
            return;
        }

        // Fetch the answer keys from the server using await
        const response = await fetch(`../../php/student/retrieve_answer_keys.php?answerKeyname=${encodeURIComponent(answerKeyname)}`);

        // Check if the request was successful
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        
        const correctAnswers = await response.json();

        // Hide loading screen
        hideLoadingScreen();

        return correctAnswers;
        
    } catch (error) {
        
    }
};

async function checkAnswers(formArray) {
    try {

        let correctAnswers = await retrieveFLTAnswers();

        // Group answers by prefix
        const groupedAnswers = correctAnswers.reduce((acc, answer) => {
            const prefix = answer.name.split('-')[0]; // Use prefix as key
            if (!acc[prefix]) {
                acc[prefix] = [];
            }
            acc[prefix].push(answer);
            return acc;
        }, {});

        // Calculate scores for each prefix
        const scores = {};
        // Step 2: Iterate over formArray to calculate scores and add isCorrect property
        formArray.forEach(item => {
            for (const [key, value] of Object.entries(item)) {
                if (key.startsWith("eng") || key.startsWith("tag") || key.startsWith("science") || key.startsWith("math") || key.startsWith("life") || key.startsWith("society") || key.startsWith("digital")) {
                    const suffix = key.split('-')[0];
                    if (groupedAnswers[suffix]) {
                        const correctAnswer = groupedAnswers[suffix].find(ans => ans.name === key);
                        if (correctAnswer) {
                            // Check if the value matches the correct answer
                            const isCorrect = value === correctAnswer.correct_answer;

                            // Add isCorrect property to the item
                            if (!item.isCorrect) {
                                item.isCorrect = {};
                            }
                            item.isCorrect = isCorrect;

                            // Update scores
                            if (isCorrect) {
                                if (!scores[suffix]) {
                                    scores[suffix] = 0;
                                }
                                scores[suffix]++;
                            }
                        }
                    }
                }
            }
        });

        console.log('Updated Form Array:', formArray);
        console.log('Scores:', scores);
        return { formArray, scores };
        
    } catch (error) {
        
    }
};


async function updateRecord() {
    try {
        showLoadingScreen();

        const sessionData = await getSessionData(['user_id']);
        const studentId = sessionData.user_id;

        const postData = {
            table: 'student_accounts_db',
            columns: {
                assessment_completed: true
            },
            conditions: {
                student_id: studentId
            }
        }

        const response = await fetch('../../php/common/update_table.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(postData)
        });

        const result = await response.json();
        if (result.success) {
            const sessionData = {
                user_assessment: 1
            };

            await updateSession(sessionData);
        } else {
            //console.error('Error updating record:', result.error);
        }

        hideLoadingScreen();
        
    } catch (error) {
        hideLoadingScreen();
        console.error('Error:', error);
    }
};
/*
async function createNotifications(type, placeholders, createdBy = null, studentId = null, adminId = null) {
    try {
        debugger;
        // Fetch the message constants
        const messagesResponse = await fetch('../../data/message-constants.json'); // Adjust the path if necessary
        const messages = await messagesResponse.json();

        // Check if the type exists in the messages
        if (!messages[type]) {
            throw new Error('Notification type not found');
        }

        // Get the subject and messageBody from the messages
        const notificationData = messages[type];
        let notificationsToSend = [];

        // Process notifications for student
        if (notificationData.student) {
            let { subject, messageBody } = notificationData.student;

            // Replace placeholders in messageBody
            for (const [key, value] of Object.entries(placeholders)) {
                const placeholder = `{${key}}`;
                subject = subject.replace(new RegExp(placeholder, 'g'), value);
                messageBody = messageBody.replace(new RegExp(placeholder, 'g'), value);
            }

            notificationsToSend.push({
                subject: subject,
                messageBody: messageBody,
                created_by: createdBy,
                student_id: studentId,
                admin_id: null,
                user_applicable: 'student'
            });
        }

        // Process notifications for admin
        if (notificationData.admin) {
            let { subject, messageBody } = notificationData.admin;

            // Replace placeholders in messageBody
            for (const [key, value] of Object.entries(placeholders)) {
                const placeholder = `{${key}}`;
                subject = subject.replace(new RegExp(placeholder, 'g'), value);
                messageBody = messageBody.replace(new RegExp(placeholder, 'g'), value);
            }

            notificationsToSend.push({
                subject: subject,
                messageBody: messageBody,
                created_by: createdBy,
                student_id: null,
                admin_id: null,
                user_applicable: 'teacher/admin'
            });
        }

        // Send the notifications to PHP script
        const response = await fetch('../../php/common/store_notification.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ notifications: notificationsToSend })
        });

        const result = await response.json();
        if (result.success) {
            console.log('Notifications stored successfully');
        } else {
            console.error('Error storing notifications:', result.error);
        }

    } catch (error) {
        console.error('Error creating notifications:', error);
    }
};*/
