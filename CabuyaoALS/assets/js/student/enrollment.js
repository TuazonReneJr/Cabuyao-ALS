var errorValidation = [];

// Initialize fields onload of Page
document.addEventListener("DOMContentLoaded", function() {

    initializeRequiredFields();
    addElementEventListeners();
    formStep();
});

function formStep() {
    try {
        const steps = document.querySelectorAll(".step");
        const nextButton = document.getElementById("next");
        const backButton = document.getElementById("back");
        const submitButton = document.getElementById("submit");
        const progressBar = document.getElementById("progressBar");
        let currentStep = 0;

        function showStep(step) {
            steps.forEach((stepDiv, index) => {
                stepDiv.classList.toggle("active", index === step);
            });
            backButton.style.display = step === 0 ? "none" : "inline-block";
            nextButton.style.display = step === steps.length - 1 ? "none" : "inline-block";
            submitButton.style.display = step === steps.length - 1 ? "inline-block" : "none";
            progressBar.style.width = ((step + 1) / steps.length) * 100 + "%";

            if (step === steps.length - 1) {
                progressBar.classList.add("complete");
            } else {
                progressBar.classList.remove("complete");
            }

            window.scrollTo(0, 0); // Scroll to the top of the page
        }

        nextButton.addEventListener("click", function() {
            if (currentStep < steps.length - 1 && validateStep(currentStep)) {
                currentStep++;
                showStep(currentStep);
            }
            else {
                window.scrollTo(0, 0); // Scroll to the top of the page
            }
        });

        backButton.addEventListener("click", function() {
            if (currentStep > 0) {
                currentStep--;
                showStep(currentStep);
            }
        });

        // Show the initial step
        showStep(currentStep);

    } catch (error) {
        throw error.message;
    }
};

function initializeRequiredFields() {
    try {
        fetch('../../data/enrollment-required-fields.json')
        .then(response => response.json())
        .then(data => {
            data.forEach(field => {
                //debugger;
                let inputElement = document.getElementById(field.fieldId);
                if (inputElement) {
                    inputElement.setAttribute('required', 'required');
                    //inputElement.setAttribute('aria-required', 'true');

                    // Optionally add custom validation message
                    let inputValidation = document.createElement('div');
                    inputValidation.classList.add('invalid-feedback');
                    inputValidation.innerText = field.message;

                    inputElement.insertAdjacentElement("afterend", inputValidation);

                    // Add event listener to remove the custom validity on change
                    inputElement.addEventListener('change', function() {
                        if (inputElement.checkValidity()) {
                            if (inputValidation) {
                                inputValidation.innerText = '';
                                inputElement.classList.remove('is-invalid');
                            }
                        }
                    });
                }
            });
        })
        .catch(error => console.error('Error fetching the required fields:', error));
    } catch (error) {
        throw error.message;
    }
};

function validateStep(step) {
    const stepElement = document.querySelectorAll('.step')[step];
    const inputs = stepElement.querySelectorAll('input[required], select[required], textarea[required]');
    let isValid = true;

    inputs.forEach(input => {
        if (input.tagName === 'INPUT' && input.type !== 'radio' && input.type !== 'checkbox') {
            if (!input.checkValidity()) {
                isValid = false;
                input.classList.add('is-invalid');
            } else {
                input.classList.remove('is-invalid');
            }
        } else if (input.tagName === 'SELECT') {
            const selectedOption = input.options[input.selectedIndex];
            if (!selectedOption.value) {
                isValid = false;
                input.classList.add('is-invalid');
            } else {
                input.classList.remove('is-invalid');
            }
        }
    });

    return isValid;
}

function addElementEventListeners() {
    try {
        var activeStep = getActiveDivID();

        //if (activeStep === "step1") {
            // Show/hide fields
            var pwdYes = document.getElementById("pwd_yes");
            var pwdNo = document.getElementById("pwd_no");
            var fourPsYes = document.getElementById("fourPs_yes");
            var fourPsNo = document.getElementById("fourPs_no");
            var disabilityTypeDiv = document.getElementById("disabilityTypeDiv");
            var fourPsIDnumberDiv = document.getElementById("fourPsIDnumberDiv");

            // Add event listener to show/hide disability type field
            pwdYes.addEventListener("change", function() {
                if (pwdYes.checked) {
                    disabilityTypeDiv.style.display = "block";
                }
            });

            // Add event listener to show/hide disability type field
            pwdNo.addEventListener("change", function() {
                if (pwdNo.checked) {
                    disabilityTypeDiv.style.display = "none";
                } 
            });

            // Add event listener to show/hide disability type field
            fourPsYes.addEventListener("change", function() {
                if (fourPsYes.checked) {
                    fourPsIDnumberDiv.style.display = "block";
                } 
            });

            // Add event listener to show/hide disability type field
            fourPsNo.addEventListener("change", function() {
                if (fourPsNo.checked) {
                    fourPsIDnumberDiv.style.display = "none";
                } 
            });

            // Add Event Listeners
            document.getElementById("same_current_address").addEventListener("change",toggleSameCurrentAddress);
            document.getElementById("declaration").addEventListener("change",toggleDeclaration);
            //document.getElementById("birth_date").addEventListener("change", validateBirthDate);
       // }
       // else if (activeStep === "step2") {
            var alsYes = document.getElementById("als_yes");
            var alsNo = document.getElementById("als_no");
            var alsProgramDiv = document.getElementById("alsProgramDiv");
            var completeYes = document.getElementById("complete_yes");
            var completeNo = document.getElementById("complete_no");
            var alsReasonDiv = document.getElementById("alsReasonDiv");
            var alsCompleteDiv = document.getElementById("alsCompleteDiv");

            // Add event listener to show/hide disability type field
            alsYes.addEventListener("change", function() {
                if (alsYes.checked) {
                    alsProgramDiv.style.display = "block";
                    alsCompleteDiv.style.display = "block";
                }
            });

            // Add event listener to show/hide disability type field
            alsNo.addEventListener("change", function() {
                if (alsNo.checked) {
                    alsProgramDiv.style.display = "none";
                    alsCompleteDiv.style.display = "none";
                } 
            });

            // Add event listener to show/hide disability type field
            completeYes.addEventListener("change", function() {
                if (completeYes.checked) {
                    alsReasonDiv.style.display = "none";
                }
            });

            // Add event listener to show/hide disability type field
            completeNo.addEventListener("change", function() {
                if (completeNo.checked) {
                    alsReasonDiv.style.display = "block";
                } 
            });
       // }
        
        document.getElementById("next").addEventListener("click", validateForm);
        document.getElementById("submit").addEventListener("click", submitForm);

    } catch (error) {
        throw error.message;
    }
};

function toggleSameCurrentAddress() {
    try {
        var sameAddressCheckBox = document.getElementById("same_current_address");
        var current_houseNo = document.getElementById("current_houseNo");
        var current_brgy = document.getElementById("current_brgy");
        var current_municipality = document.getElementById("current_municipality");
        var current_province = document.getElementById("current_province");
        var permanent_houseNo = document.getElementById("permanent_houseNo");
        var permanent_brgy = document.getElementById("permanent_brgy");
        var permanent_municipality = document.getElementById("permanent_municipality");
        var permanent_province = document.getElementById("permanent_province");

        if(sameAddressCheckBox.checked) {
            //alert("same address");
            permanent_houseNo.value = current_houseNo.value;
            permanent_brgy.value = current_brgy.value;
            permanent_municipality.value = current_municipality.value;
            permanent_province.value = current_province.value;
            permanent_houseNo.disabled = true;
            permanent_brgy.disabled = true;
            permanent_municipality.disabled = true;
            permanent_province.disabled = true;
        }
        else {
            //alert("different address");
            permanent_houseNo.value = null;
            permanent_brgy.value = null;
            permanent_municipality.value = null;
            permanent_province.value = null;
            permanent_houseNo.disabled = false;
            permanent_brgy.disabled = false;
            permanent_municipality.disabled = false;
            permanent_province.disabled = false;
        }
    } catch (error) {
        throw error.message;
    }
};

function toggleDeclaration() {
    try {
        var declaration = document.getElementById("declaration");
        var email = document.getElementById("email-container");

        if (declaration.checked) {
            email.style.display = "block";
        }
        else {
            email.style.display = "none";
        }
    } catch (error) {
        throw error.message;
    }
};

async function populateTheHiddenAddressFieldsOnSubmit() {
    try {
        var permanent_houseNo = document.getElementById("permanent_houseNo");
        var permanent_brgy = document.getElementById("permanent_brgy");
        var permanent_municipality = document.getElementById("permanent_municipality");
        var permanent_province = document.getElementById("permanent_province");

        var permanent_hidden_houseNo = document.getElementById("permanent_hidden_houseNo");
        var permanent_hidden_brgy = document.getElementById("permanent_hidden_brgy");
        var permanent_hidden_municipality = document.getElementById("permanent_hidden_municipality");
        var permanent_hidden_province = document.getElementById("permanent_hidden_province");

        permanent_hidden_houseNo.value = permanent_houseNo.value;
        permanent_hidden_brgy.value = permanent_brgy.value;
        permanent_hidden_municipality.value = permanent_municipality.value;
        permanent_hidden_province.value = permanent_province.value;
        
    } catch (error) {
        throw error.message;
    }
};

function validateBirthDate() {
    try {
        var birthdateInput = document.getElementById('birth_date');
        var selectedDate = new Date(birthdateInput.value);

        // Check if birthdate is empty
        if (!birthdateInput.value) {
            birthdateInput.classList.add('is-invalid'); // Add invalid class for styling
            document.getElementById('birthdate_feedback').style.display = 'block'; // Show error message
            document.getElementById('birthdate_feedback').innerText ="Please select a birthdate.";
            return; // Exit the function
        }

        var currentDate = new Date();
        currentDate.setHours(0, 0, 0, 0);  // Set time to midnight to compare only dates

        var ageLimitDate = new Date();
        ageLimitDate.setFullYear(currentDate.getFullYear() - 13);

        // Check if the selected date is in the future or today
        if (selectedDate >= currentDate) {
            addErrorFeedback("birth_date", "text", "birthdate_feedback","Birthdate cannot be a future date.", "birth_date");
        } /*else if (selectedDate >= ageLimitDate) {
            birthdateInput.classList.add('is-invalid'); // Remove invalid class
            document.getElementById('birthdate_feedback').style.display = 'block'; // Hide error message
            document.getElementById('birthdate_feedback').innerText ="You must be at least 13 years old.";
        }*/
        else {
            removeErrorFeedback("birth_date", "text", "birthdate_feedback", "birth_date");
        }
    } catch (error) {
        throw error.message;
    }
};


// Get Active Step
function getActiveDivID() {
    try {
        var divs = document.querySelectorAll('div');
        var activeDivId = null;

        divs.forEach(function(div) {
            if (div.classList.contains('active')) {
                activeDivId = div.id;
            }
        });

        return activeDivId;
        
    } catch (error) {
        throw error.message;
    }
};

function validateForm() {
    try {
        var activeStep = getActiveDivID();

        if (activeStep === "step1") {
           // verifyPWD();
            // verify4Ps();
        }

    } catch (error) {
        throw error.message;
    }
};

function verifyPWD() {
    try {
        var pwdYes = document.getElementById("pwd_yes");

        if (pwdYes.checked) {
            var disabilityChecked = document.querySelector('input[name="disability"]:checked');

            if (!disabilityChecked) {
                addErrorFeedback("disability_div", "div", "disability_feedback","Please select disability.", "pwd_yes");
            }
            else {
                removeErrorFeedback("disability_div", "div", "disability_feedback", "pwd_yes");
            }
        }
    } catch (error) {
        throw error.message;
    }
};

function verify4Ps() {
    try {
        var fourPsYes = document.getElementById("fourPs_yes");

        if (fourPsYes.checked) {
            var fourPsIDNumber = document.getElementById("fourPs_idNumber");

            if (fourPsIDNumber.value) {
                removeErrorFeedback("fourPs_idNumber", "text", "fourPsID_feedback", "fourPs_yes");
            }
            else {
                addErrorFeedback("fourPs_idNumber", "text", "fourPsID_feedback","Please enter a valid 4Ps ID.", "fourPs_yes");
            }
        }
    } catch (error) {
        throw error.message;
    }
};

function addErrorFeedback(highlightElementId, highlightElementType, feedbackID, errorText, errorLabel) {
    try {
        if (highlightElementType === "div") {
            document.getElementById(highlightElementId).classList.add('div-invalid'); // Add invalid class for styling
        }
        else if (highlightElementType === "text") {
            document.getElementById(highlightElementId).classList.add('is-invalid'); // Add invalid class for styling
        }
        
        document.getElementById(feedbackID).style.display = 'block'; // Show error message
        document.getElementById(feedbackID).innerText = errorText;
        errorValidation.push(document.getElementById(errorLabel).id);
    } catch (error) {
        throw error.message;
    }
};

function removeErrorFeedback(highlightElementId, highlightElementType, feedbackID, errorLabel) {
    try {
        let index = errorValidation.indexOf(document.getElementById(errorLabel).id);
        if (index !== -1) {
            errorValidation.splice(index, 1);
        }

        if (highlightElementType === "div") {
            document.getElementById(highlightElementId).classList.remove('div-invalid'); // Add invalid class for styling
        }
        else if (highlightElementType === "text") {
            document.getElementById(highlightElementId).classList.remove('is-invalid'); // Add invalid class for styling
        }

        document.getElementById(feedbackID).style.display = 'none'; // Show error message

    } catch (error) {
        throw error.message;
    }
};

/*
async function submitForm(event) {
    try {

        await populateTheHiddenAddressFieldsOnSubmit();

        event.preventDefault();

        // Validate form steps or conditions before submission
        if (!validateStep(2)) {
            alert("Error: Validation failed. Please check your inputs.");
            showModal(
                'Error submitting form',
                'Error: Validation failed. Please check your inputs.',
                '',
                'error',
                null, null, null
            );
            return;
        }

        // Collect form data
        var form = document.getElementById("enrollment_multistep_form");
        var formData = new FormData(form);

        debugger;

        console.log(formData);

        // Debugging: Log formData entries to check the values
        for (let [key, value] of formData.entries()) {
            console.log(`${key}: ${value}`);
        }

        // Send formValues as JSON via fetch API to enrollment_submit.php
        fetch('../../php/student/submit_enrollment.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            if (data.status === 'success') {
                //alert('Form submitted successfully: ' + data.message);
                // Optionally reset form or navigate to next step
                const placeholders = {
                    studentFirstName: document.getElementById("first_name").value,
                    studentLastName: document.getElementById("last_name").value
                };
                await createNotifications('submit_enrollment', placeholders, null , studentId, null);

                showModal(
                    'Enrollment Form submitted successfully',
                    'We have received your enrollment form.',
                    'Your enrollment form will be thoroughly reviewed by our assessment team. Upon completion of this review process, you will receive an official email notification detailing the outcome of your application. This notification will inform you whether your enrollment has been approved or rejected. Thank you for your patience as we complete this assessment.',
                    'success',
                    () => {
                       window.location.href = '../../index.php'; // Reload the page to reflect changes
                    }, null, null
                );
            } else {
                //alert('Error: ' + data.message);
                showModal(
                    'Enrollment Form failed submission',
                    'Please check below for the error.',
                    data.message,
                    'error',
                    null, null, null
                );
            }
        })
        .catch(error => {
            //alert('Error submitting form: ' + error.message);
            showModal(
                'Error submitting form',
                'Please check below for the error and contact your Administrator for this error.',
                error.message,
                'error',
                null, null, null
            );
            console.error('Error submitting form:', error);
        });

    } catch (error) {
        console.error('Error in submitForm():', error);
        showModal(
            'Error in submitForm():',
            'Please check below for the error and contact your Administrator for this error.',
            error,
            'error',
            null, null, null
        );
        //alert('Error in submitForm(): ' + error.message);
    }
}*/

async function submitForm(event) {
    event.preventDefault(); // Prevent default form submission

    try {
        await populateTheHiddenAddressFieldsOnSubmit();

        // Validate form steps or conditions before submission
        if (!validateStep(2)) {
            alert("Error: Validation failed. Please check your inputs.");
            showModal(
                'Error submitting form',
                'Error: Validation failed. Please check your inputs.',
                '',
                'error',
                null, null, null
            );
            return;
        }

        // Collect form data
        var form = document.getElementById("enrollment_multistep_form");
        var formData = new FormData(form);

        console.log(formData);

        // Debugging: Log formData entries to check the values
        for (let [key, value] of formData.entries()) {
            console.log(`${key}: ${value}`);
        }

        // Send formValues as JSON via fetch API to enrollment_submit.php
        const response = await fetch('../../php/student/submit_enrollment.php', {
            method: 'POST',
            body: formData
        });

        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }

        const data = await response.json();

        if (data.status === 'success') {
            const placeholders = {
                studentFirstName: document.getElementById("first_name").value,
                studentLastName: document.getElementById("last_name").value
            };

            // Assuming studentId is declared and defined somewhere
            await createNotifications('submit_enrollment', placeholders, null, null, null);

            showModal(
                'Enrollment Form submitted successfully',
                'We have received your enrollment form.',
                'Your enrollment form will be thoroughly reviewed by our assessment team. Upon completion of this review process, you will receive an official email notification detailing the outcome of your application. This notification will inform you whether your enrollment has been approved or rejected. Thank you for your patience as we complete this assessment.',
                'success',
                () => {
                    window.location.href = '../../index.php'; // Reload the page to reflect changes
                }, null, null
            );
        } else {
            showModal(
                'Enrollment Form failed submission',
                'Please check below for the error.',
                data.message,
                'error',
                null, null, null
            );
        }
    } catch (error) {
        console.error('Error submitting form:', error);
        showModal(
            'Error submitting form',
            'Please check below for the error and contact your Administrator for this error.',
            error.message,
            'error',
            null, null, null
        );
    }
}
