// Initialize fields onload of Page
document.addEventListener("DOMContentLoaded", async function() {
    /* add events/functions for initializing the page*/
 
    addEventListeners();
 });


 function addEventListeners() {
    try {
        document.getElementById("submit").addEventListener("click", submitAnswerKeys);
        
    } catch (error) {
        throw error.message;
    }
 };

 function submitAnswerKeys(event) {
    debugger;
    event.preventDefault();

    const formElements = document.getElementById('assessment-flt-form').elements;
    let answerKeys = [];
    let answerKeyname = "";

    let currentURL = window.location.href;

	if (currentURL.includes("elementary-functional-test")) {
		answerKeyname = "Elementary FLT";
	} else if (currentURL.includes("highschool-functional-test")) {
        answerKeyname = "Junior High School FLT";
    } else {
        return;
    }

    // Loop through form elements and collect selected values
    for (let i = 0; i < formElements.length; i++) {
        if (formElements[i].type === "radio" && formElements[i].checked) {
            answerKeys.push({
                name: formElements[i].name,
                correct_answer: formElements[i].value
            });
        }
    }

    const postData = {
        answerKeys: answerKeys,
        answerKeyname: answerKeyname
    };

    console.log(JSON.stringify(postData));

    // Send the answer keys as JSON to the server
    fetch('../../php/admin/store_answer_keys.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(postData)
    })
    .then(response => response.text())
    .then(data => {
        console.log('Success:', data);
    })
    .catch((error) => {
        console.error('Error:', error);
    });
};
