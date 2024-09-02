// Initialize fields onload of Page
document.addEventListener("DOMContentLoaded", async function() {

    await retrieveStudents();
    //initializeEvents();
});

async function retrieveStudents() {
    try {
        const response = await fetch('../../php/admin/fetch_students.php');

        // Check if the response is ok
        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }

        const data = await response.json();
        const tableBody = document.getElementById('students-table');
        
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

        data.forEach(student => {
            const row = document.createElement('tr');

            // Determine the class based on the student.status value
            let statusClass = '';
            if (student.status === 'Approved') {
                statusClass = 'status approved'; // Add your desired class name for accepted status
            } else if (student.status === 'Rejected') {
                statusClass = 'status rejected'; // Add your desired class name for rejected status
            } else if (student.status === 'Pending') {
                statusClass = 'status pending'; // Add your desired class name for pending status
            } else {
                statusClass = 'status'; // Default class for other statuses
            }
            
            row.innerHTML = `
                <td data-label="Select"><input type="checkbox" class="selectRow"></td>
                <td data-label="Last Name">${student.last_name}</td>
                <td data-label="First Name">${student.first_name}</td>
                <td data-label="Middle Name">${student.middle_name}</td>
                <td data-label="Gender">${student.gender}</td>
                <td data-label="Enrollment Date">${student.enrollment_date}</td>
                <td data-label="Status"><span class="${statusClass}"> ${student.status} </span> </td>
                <td><button class="view-btn" data-id="${student.student_id}">View</button></td>
            `;

                //<td><i class="fas fa-eye view-icon" data-id="${student.student_id}" style="cursor: pointer;"></i></td>
            tableBody.appendChild(row);
        });

        // Add event listener for view buttons
        tableBody.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('view-btn')) {
                const studentId = e.target.getAttribute('data-id');
                viewStudent(studentId);
            }
        });

    } catch (error) {
        console.error('Error fetching data:', error);
    }
};

// Function to handle view button click
async function viewStudent(id) {
    // Implement the logic to view student details
    // Example: redirect to a detail page
    await saveSession("student_id", id);
    window.location.href = `student-details.php`;
    //window.location.href = `student-details.php?id=${id}`; // Adjust the URL as needed
    //alert("View: " + id);
};
