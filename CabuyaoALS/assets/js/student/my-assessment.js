document.addEventListener("DOMContentLoaded", function() {
    initializeElements();
});

async function initializeElements() {
    try {
        const sessionData = await getSessionData(['user_assessment']);
        const assessmentDone = sessionData.user_assessment;

        if (assessmentDone === 1) {
            const statusBox = document.getElementById('flt-status');

            if (statusBox) {
                statusBox.style.display = 'flex';
                statusBox.textContent = "Done";
            }

            document.getElementById('flt-container').classList.add('disabled');
        }
        
    } catch (error) {
        console.error('Error:', error);
    }
};

