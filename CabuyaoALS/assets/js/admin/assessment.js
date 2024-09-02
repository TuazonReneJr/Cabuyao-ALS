// Initialize fields onload of Page
document.addEventListener("DOMContentLoaded", async function() {

    await retrieveAssessments();
});

async function retrieveAssessments() {
    try {
        debugger;
        const response = await fetch('../../php/admin/fetch_student_assessments.php');

        // Check if the response is ok
        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }

        const data = await response.json();
        const tableBody = document.getElementById('assessment-table');
        
        if (data.length === 0) {
            document.getElementById('table-data-container').style.display = "none";
            document.getElementById('no-data').style.display = "flex";
            return;
        }
        else {
            document.getElementById('no-data').style.display = "none";
            document.getElementById('table-data-container').style.display = "flex";
        }

        // Clear any existing rows in the table
        tableBody.innerHTML = '';

        data.forEach(assessment => {
            const row = document.createElement('tr');

            row.innerHTML = `
                <td data-label="Select"><input type="checkbox" class="selectRow"></td>
                <td data-label="Last Name">${assessment.last_name}</td>
                <td data-label="First Name">${assessment.first_name}</td>
                <td data-label="Middle Name">${assessment.middle_name}</td>
                <td data-label="ALS Level">${assessment.als_level}</td>
                <td data-label="Assessment Date">${assessment.pre_assessment_date}</td>
                <td><button class="view-btn" data-id="${assessment.student_id}">View</button></td>
            `;

                //<td><i class="fas fa-eye view-icon" data-id="${student.student_id}" style="cursor: pointer;"></i></td>
            tableBody.appendChild(row);
        });

        // Add event listener for view buttons
        tableBody.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('view-btn')) {
                const studentId = e.target.getAttribute('data-id');
                viewFLT(studentId);
            }
        });

    } catch (error) {
        console.error('Error fetching data:', error);
    }
};

// Function to handle view button click
async function viewFLT(id) {
    // Implement the logic to view student details
    // Example: redirect to a detail page
    await saveSession("student_id", id);
    localStorage.setItem('activeIconId', "2");
    window.location.href = `student-details.php`; // Adjust the URL as needed
    //alert("View: " + id);
};
