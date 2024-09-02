let passwordFlag = false;
let usernameFlag = true;
let confirmPasswordFlag = false;
let currentUsername;

document.addEventListener("DOMContentLoaded", function() {

    currentUsername = document.getElementById("username").value;

    initializeEvents();
    
});


// Function to validate password strength
function validatePassword(password) {
    let strength = 0;
    const minLength = 12;
    const lengthStatus = document.getElementById('length-status');
    const lowercaseStatus = document.getElementById('lowercase-status');
    const uppercaseStatus = document.getElementById('uppercase-status');
    const numberStatus = document.getElementById('number-status');
    const specialStatus = document.getElementById('special-status');
    // Check criteria
    const lengthCriteria = password.length >= minLength;
    const lowerCriteria = /[a-z]/.test(password);
    const upperCriteria = /[A-Z]/.test(password);
    const numberCriteria = /\d/.test(password);
    const specialCriteria = /[^a-zA-Z\d]/.test(password);
    // Update criteria status
    lengthStatus.className = lengthCriteria ? 'valid' : 'invalid';
    lowercaseStatus.className = lowerCriteria ? 'valid' : 'invalid';
    uppercaseStatus.className = upperCriteria ? 'valid' : 'invalid';
    numberStatus.className = numberCriteria ? 'valid' : 'invalid';
    specialStatus.className = specialCriteria ? 'valid' : 'invalid';
    // Calculate strength
    if (lengthCriteria) strength += 20;
    if (lowerCriteria) strength += 20;
    if (upperCriteria) strength += 20;
    if (numberCriteria) strength += 20;
    if (specialCriteria) strength += 20;

    return strength === 100;
};

function initializeEvents() {
    try {
        // Pass the PHP session username to JavaScript
        const checkButton = document.getElementById('check-username').disabled = true;
        const passwordIndicator = document.getElementById('password-indicator').style.display = "none";
        const confirmPasswordIndicator = document.getElementById('confirm-password-status').style.display = "none";

        // Event listener for password input
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            if (!password) {
                document.getElementById('password-indicator').style.display = "none";
            }
            else {
                document.getElementById('password-indicator').style.display = "block";
            }
            const isPasswordStrong = validatePassword(password);
            if (isPasswordStrong) {
                passwordFlag = true;
                document.getElementById('password-indicator').style.display = "none";
            }
            document.getElementById('update_credentials').disabled = (passwordFlag && usernameFlag && confirmPasswordFlag) ? false : true;
        });

        // Event listener for username input
        document.getElementById('username').addEventListener('input', function() {
            const username = this.value;
            const checkButton = document.getElementById('check-username');
            const statusElement = document.getElementById('username-status');

            if (!username) {
                statusElement.textContent = 'Please enter a username.';
                statusElement.className = 'form-text text-danger';
                statusElement.style.display = "block";
                usernameFlag = false;
            } else {
                statusElement.style.display = "none";
            }

            // Enable or disable the check button based on username value
            if (username === currentUsername) {
                checkButton.disabled = true; // Disable button
                statusElement.style.display = "none";
                usernameFlag = true;
            } else {
                checkButton.disabled = false; // Enable button
                usernameFlag = false;
            }

            document.getElementById('update_credentials').disabled = (passwordFlag && usernameFlag && confirmPasswordFlag) ? false : true;
        });

        // Event listener for password input
        document.getElementById('confirm_password').addEventListener('input', function() {
            const confirm_password = this.value;
            const password = document.getElementById('password').value;
            const passIndicator =  document.getElementById('confirm-password-status');

            if (!confirm_password) {
                passIndicator.style.display = "none";
                confirmPasswordFlag = false;
            }

            if (confirm_password === password) {
                passIndicator.style.display = "none";
                confirmPasswordFlag = true;
            }
            else if (confirm_password && confirm_password !== password) {
                passIndicator.style.display = "block";
                passIndicator.textContent = 'Password is not the same.';
                passIndicator.className = 'form-text text-danger';
                confirmPasswordFlag = false;
            }

            document.getElementById('update_credentials').disabled = (passwordFlag && usernameFlag && confirmPasswordFlag) ? false : true;
        });

        // Check username availability
        document.getElementById('check-username').addEventListener('click', function() {
            //debugger;
            const username = document.getElementById('username').value;

            // Perform fetch request to check username availability
            fetch('../../php/student/check_username.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({
                    'username': username
                })
            })
            .then(response => response.json())
            .then(data => {
                const statusElement = document.getElementById('username-status');
                if (data.available) {
                    statusElement.style.display = "block";
                    statusElement.textContent = 'Username is available';
                    statusElement.className = 'form-text text-success';
                    usernameFlag = true;
                } else {
                    statusElement.style.display = "block";
                    statusElement.textContent = 'Username is taken';
                    statusElement.className = 'form-text text-danger';
                    usernameFlag = false;
                }

                document.getElementById('update_credentials').disabled = (passwordFlag && usernameFlag && confirmPasswordFlag) ? false : true;
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });

        // Update Credentials
        document.getElementById('update_credentials').addEventListener('click', function(event) {
            // Prevent default form submission
            event.preventDefault();

            // Get the form element and form data
            const form = document.getElementById('change-password-form');
            
            // Debug: Check if the form is found
            if (!form) {
                console.error('Form not found');
                return;
            }

            const formData = new FormData(form);

            // Debug: Check if formData is empty
            if (!formData.entries().next().done) {
                console.log('FormData is populated');
            } else {
                console.error('FormData is empty');
                return;
            }


            // Show confirmation modal
            showModal(
                'Update credentials',
                'Are you sure you want to change your user credentials?',
                '',
                'confirm-question',
                async () => {
                    // Call updateCredentials function and pass the form action URL and form data
                    let data = await updateCredentials(form.action, formData);

                    // Handle response
                    if (data.success) {
                        showModal(
                            'Credentials successfully updated',
                            'Thank you for updating your credentials.',
                            'Please take note of your new credentials. This will be your new credentials to log in.',
                            'success',
                            () => {
                                window.location.href = "my-dashboard.php"; // Reload the page to reflect changes
                            }, null, null
                        );
                    } else {
                        showModal(
                            'Failed update',
                            'Credentials Not Updated',
                            data.message,
                            'error',
                            () => {
                                location.reload(); // Reload the page to reflect changes
                            }, null, null
                        );
                    }
                },
                null, 
                null
            );
        });
        
    } catch (error) {
        
    }
};

// Function to update credentials using Fetch API
async function updateCredentials(url, formData) {
    try {
        // Show loading screen
        showLoadingScreen();

        // Debug: Check if formData is empty and log its content
        if (!formData.entries().next().done) {
            console.log('FormData is populated:');
            for (const [key, value] of formData.entries()) {
                console.log(`FormData Entry: ${key} = ${value}`);
            }
        } else {
            console.error('FormData is empty');
            return;
        }

        // Make the POST request to the server
        const response = await fetch(url, {
            method: 'POST',
            body: formData
        });

        // Debug: Log response status and headers
        console.log('Response Status:', response.status);
        console.log('Response Headers:', [...response.headers.entries()]);

        // Check if the response is not OK (e.g., 404, 500)
        if (!response.ok) {
            throw new Error(`Network response was not ok. Status: ${response.status}`);
        }

        // Get raw response text and try parsing as JSON
        const text = await response.text();
        console.log('Response Text:', text);

        // Try parsing the response as JSON
        let data;
        try {
            data = JSON.parse(text);
            console.log('Parsed JSON Data:', data);
        } catch (e) {
            console.error('Failed to parse JSON:', e);
            // Return an error response
            return { success: false, message: 'Failed to parse server response as JSON.' };
        }

        // Hide loading screen
        hideLoadingScreen();

        // Return the parsed JSON data
        return data;

    } catch (error) {
        // Hide loading screen and log the error
        hideLoadingScreen();
        console.error('Error:', error);

        // Return an error response
        return { success: false, message: 'An error occurred while updating credentials.' };
    }
};