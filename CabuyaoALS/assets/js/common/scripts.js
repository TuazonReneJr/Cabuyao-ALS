/* scripts.js */

document.addEventListener("DOMContentLoaded", async function() {

	if (checkURLContains('index')) {
		const lastActivePage = localStorage.getItem('activePage') || 'home'; // Default to 'home' if no active page is stored
		document.querySelector(`[data-page="${lastActivePage}"]`).classList.add('active');
		loadContent(lastActivePage); // Load the last active content

        displayCurrentTime();
		initializeIndexEventListeners();
    }
	else if (!checkURLContains('student/enrollment.php')){
		setActiveMode();
		setActiveToggleMode();
		initializeSideBarEvents();
		await fetchNotifications();

	}

	if (checkURLContains('elementary-functional-test') || checkURLContains('highschool-functional-test')) {
		multiStepFormEventListener();
	}

	showTooltip();
});

function checkURLContains(substring) {
    return window.location.href.includes(substring);
};


/* Initialize Sidebar and Navbar events */
function initializeSideBarEvents() {
	try {
		
		//debugger;
		/*const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

		allSideMenu.forEach(item=> {
			const li = item.parentElement;

			item.addEventListener('click', function () {
				allSideMenu.forEach(i=> {
					i.parentElement.classList.remove('active');
				})
				li.classList.add('active');
			})
		});*/

		const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

		// Function to set the active sidebar item based on the URL
		function setActiveSidebarItem() {
			let currentURL = window.location.href;

			if (currentURL.includes("admin/student-details")) {
				currentURL = "admin/enrollment.php";
			}

			if (currentURL.includes("student/elementary-functional-test.php") || currentURL.includes("student/highschool-functional-test.php")) {
				currentURL = "student/my-assessment.php";
			}
			
			allSideMenu.forEach(item => {
				const li = item.parentElement;
				// Check if the link matches the current URL or page identifier
				if (currentURL.includes(item.getAttribute('href'))) {
					li.classList.add('active');
				} else {
					li.classList.remove('active');
				}
			});
		}

		// Call function to set the active item on page load
		setActiveSidebarItem();

		// Add event listeners to sidebar items
		allSideMenu.forEach(item => {
			const li = item.parentElement;
			item.addEventListener('click', function () {
				allSideMenu.forEach(i => {
					i.parentElement.classList.remove('active');
				});
				li.classList.add('active');
			});
		});


		// TOGGLE SIDEBAR
		const menuBar = document.querySelector('#content nav .bx.bx-menu');
		const sidebar = document.getElementById('sidebar');

		menuBar.addEventListener('click', function () {
			sidebar.classList.toggle('hide');

			if (sidebar.classList.contains('hide')) {
				localStorage.setItem('toggleMode', 'hidden');
			}
			else {
				localStorage.setItem('toggleMode', 'displayed');
			}
		});


		/*const searchButton = document.querySelector('#content nav form .form-input button');
		const searchButtonIcon = document.querySelector('#content nav form .form-input button .bx');
		const searchForm = document.querySelector('#content nav form');

		searchButton.addEventListener('click', function (e) {
			if(window.innerWidth < 576) {
				e.preventDefault();
				searchForm.classList.toggle('show');
				if(searchForm.classList.contains('show')) {
					searchButtonIcon.classList.replace('bx-search', 'bx-x');
				} else {
					searchButtonIcon.classList.replace('bx-x', 'bx-search');
				}
			}
		})


		if(window.innerWidth < 768) {
			sidebar.classList.add('hide');
		} else if(window.innerWidth > 576) {
			searchButtonIcon.classList.replace('bx-x', 'bx-search');
			searchForm.classList.remove('show');
		}


		window.addEventListener('resize', function () {
			if(this.innerWidth > 576) {
				searchButtonIcon.classList.replace('bx-x', 'bx-search');
				searchForm.classList.remove('show');
			}
		})*/


		const switchMode = document.getElementById('switch-mode');

		switchMode.addEventListener('change', function () {
			if(this.checked) {
				document.body.classList.add('dark');
				localStorage.setItem('activeMode', 'dark');
			} else {
				document.body.classList.remove('dark');
				localStorage.setItem('activeMode', 'light');
			}
		})

		const settingsDropdown = document.getElementById('settingsDropdown');
		const profileDropdown = document.getElementById('profileDropdown');
		const notificationDropdown = document.getElementById('notificationDropdown');

		function closeAllDropdowns() {
			document.querySelectorAll('.dropdown-content').forEach(function (dropdown) {
				dropdown.classList.remove('show');
			});
		}

		// Toggle settings dropdown
		settingsDropdown.addEventListener('click', function (e) {
			e.preventDefault();
			const dropdownContent = this.nextElementSibling;
			if (!dropdownContent.classList.contains('show')) {
				closeAllDropdowns();  // Close other dropdowns
			}
			dropdownContent.classList.toggle('show');
		});

		// Toggle profile dropdown
		profileDropdown.addEventListener('click', function (e) {
			e.preventDefault();
			const dropdownContent = this.nextElementSibling;
			if (!dropdownContent.classList.contains('show')) {
				closeAllDropdowns();  // Close other dropdowns
			}
			dropdownContent.classList.toggle('show');
		});

		// Toggle profile dropdown
		notificationDropdown.addEventListener('click', function (e) {
			e.preventDefault();
			const dropdownContent = this.nextElementSibling;
			if (!dropdownContent.classList.contains('show')) {
				closeAllDropdowns();  // Close other dropdowns
			}
			dropdownContent.classList.toggle('show');
		});

		// Close the dropdowns if the user clicks outside
		document.addEventListener('click', function (e) {
			if (!settingsDropdown.contains(e.target) && !profileDropdown.contains(e.target) && !notificationDropdown.contains(e.target)) {
				closeAllDropdowns();
			}
		});
		
	} catch (error) {
		throw error.message;
	}
};

function initializeIndexEventListeners() {
	try {
		// Add event listeners to nav links
		document.querySelectorAll('.nav-item').forEach(function (navItem) {
			navItem.addEventListener('click', handleNavClick);
		});
		
	} catch (error) {
		
	}
};

function displayCurrentTime() {
	try {
		// Update time every second
		setInterval(updateTime, 1000);
		// Initialize time display
		updateTime();
	} catch (error) {
		throw error.message;
	}
};

function updateTime() {
	const options = {
		weekday: 'long',
		year: 'numeric',
		month: 'long',
		day: 'numeric',
		hour: 'numeric',
		minute: 'numeric',
		second: 'numeric',
		timeZoneName: 'short'
	};
	const now = new Date();
	document.getElementById('datetime').textContent = now.toLocaleString('en-US', options);
};

// Function to handle navigation link clicks
function handleNavClick(event) {
    event.preventDefault();

    // Remove 'active' class from all nav items
    document.querySelectorAll('.nav-item').forEach(function (navItem) {
        navItem.classList.remove('active');
    });

    // Add 'active' class to the clicked nav item
    const clickedNavItem = event.target;
    clickedNavItem.classList.add('active');

    // Update the content based on the clicked nav item
    const page = clickedNavItem.getAttribute('data-page');

	// Store the active page in localStorage
    localStorage.setItem('activePage', page);
	
    loadContent(page);
}

// Function to load content dynamically
function loadContent(page) {
    // Get all divs with a data-page attribute
    const allDivs = document.querySelectorAll('div[data-page]');

    // Loop through each div and check the data-page value
    allDivs.forEach(div => {
        if (div.getAttribute('data-page') === page) {
            // Show the div if it matches the pageValue
            div.style.display = 'block';
        } else {
            // Hide the div if it does not match the pageValue
            div.style.display = 'none';
        }
    });

}

function getQueryParam(param) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(param);
};

function setActiveMode() {
	try {
		const lastActiveMode = localStorage.getItem('activeMode') || 'light';
		if (lastActiveMode === "dark") {
			document.getElementById('switch-mode').checked = true;
			document.body.classList.add('dark');
		}
		else {
			document.getElementById('switch-mode').checked = false;
			document.body.classList.remove('dark');
		}
	} catch (error) {
		throw error.message;
	}
};

function setActiveToggleMode() {
	try {
		const lastActiveToggle = localStorage.getItem('toggleMode') || 'displayed';
		if (lastActiveToggle === "hidden") {
			document.getElementById('sidebar').classList.add('hide');
		}
		else {
			document.getElementById('sidebar').classList.remove('hide');
		}
	} catch (error) {
		throw error.message;
	}
};

function multiStepFormEventListener() {
	try {
		const steps = document.querySelectorAll(".form-step");
        const nextButton = document.getElementById("next");
        const backButton = document.getElementById("back");
        const submitButton = document.getElementById("submit");
        let currentStep = 0;

        function showStep(step) {
            steps.forEach((stepDiv, index) => {
                stepDiv.classList.toggle("active", index === step);
            });
            backButton.style.display = step === 0 ? "none" : "inline-block";
            nextButton.style.display = step === steps.length - 1 ? "none" : "inline-block";
            submitButton.style.display = step === steps.length - 1 ? "inline-block" : "none";
            
            //window.scrollTo(0, 0); // Scroll to the top of the page
            //document.getElementById('multi-step-form').scrollIntoView({ behavior: 'smooth', block: 'start' });
        }

        nextButton.addEventListener("click", function() {
            if (currentStep < steps.length - 1) {
                currentStep++;
                showStep(currentStep);
            }
            else {
                //window.scrollTo(0, 0); // Scroll to the top of the page
                //document.getElementById('multi-step-form').scrollIntoView({ behavior: 'smooth', block: 'start' });
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

function speakText(idName) {
	const text = document.getElementById(idName).value();
	const utterance = new SpeechSynthesisUtterance(text);
	speechSynthesis.speak(utterance);
};

async function getSessionData(keys) {
    try {
        // Convert keys array to comma-separated string
        const queryString = keys.join(',');

        // Fetch session data from the server
        const response = await fetch(`../../php/common/get_session_values.php?keys=${encodeURIComponent(queryString)}`);
        const data = await response.json();

        return data;
    } catch (error) {
        console.error('Error fetching session data:', error);
        return null;
    }
};

async function updateSession(sessionData) {
    try {
        const response = await fetch('../../php/common/update_session_value.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(sessionData)
        });

        const result = await response.json();
        
		return result;
    } catch (error) {
        console.error('Error:', error);
    }
};

async function saveSession(key, value) {
	try {
		const response = await fetch('../../php/common/save_session.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ key: key, value: value })
        });

        if (response.ok) {
            const text = await response.text();
            console.log(text); // "Session value saved."
        } else {
            console.error("Failed to save session value.");
        }
		
	} catch (error) {
        console.error('Error:', error);
	}
};

async function fetchNotifications() {
    try {
        const response = await fetch('../../php/common/get_notifications.php'); // Adjust path to your PHP script
        const notifications = await response.json();

        const dropdown = document.querySelector('.notification-content');
        dropdown.innerHTML = ''; // Clear previous notifications

        // Create and append notification elements
        notifications.forEach(notification => {
            // Create the notification element
            const notificationElement = document.createElement('a');
            notificationElement.href = '#'; // Adjust href or add click event
            
            // Create an icon element
            const icon = document.createElement('i');
			icon.style.marginRight = "10px";
            icon.className = 'bx bxs-envelope'; // Set the icon class
            
            // Create a text element
            const text = document.createElement('span');
            text.textContent = notification.message; // Adjust as needed

			// Create an icon element
            const iconTime = document.createElement('i');
			iconTime.style.marginRight = "5px";
            iconTime.className = 'bx bx-time'; // Set the icon class

			// Create a text element
            const time = document.createElement('span');
			time.style.display = "block";
			time.style.fontSize = "small";
			time.style.textAlign = "end";
            time.textContent = notification.created_at; // Adjust as needed
			
			time.appendChild(iconTime);
            
            // Append the icon and text to the notification element
            notificationElement.appendChild(icon);
            notificationElement.appendChild(text);
            notificationElement.appendChild(time);
            
            // Append the notification element to the dropdown
            dropdown.appendChild(notificationElement);
        });

		const numSpan = document.querySelector('.notification .num');

        // Update the notification count
		if (notifications.length > 0){
			numSpan.textContent = notifications.length;
			numSpan.style.display = "flex";
		}
		else {
			numSpan.style.display = "none";

			const notificationElement = document.createElement('a');
            notificationElement.href = '#'; 

			// Create a text element
            const text = document.createElement('span');
            text.textContent = "No notifications"; // Adjust as needed
            notificationElement.appendChild(text);
			dropdown.appendChild(notificationElement);
		}

    } catch (error) {
        console.error('Error fetching notifications:', error);
    }
};

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
                admin_id: adminId,
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
                admin_id: adminId,
                user_applicable: 'teacher/admin'
            });
        }

		// Process notifications for admin
        if (notificationData.all) {
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
                admin_id: adminId,
                user_applicable: 'all'
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
};

function showTooltip() {
	try {
		var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
	} catch (error) {
        console.error('Error tooltip:', error);
	}
};

function strToInt(strVal) {
	try {
        const intVal = Math.floor(Number(strVal));
		return intVal;
	} catch (error) {
        console.error('Error string to integer:', error);
	}
};