// Function to show modal with dynamic content
function showModal(title, mainMessage, subMessage, iconType, okBtnCallback, cancelBtnCallback, extraFields = '') {
   // debugger;
    const existingModals = document.querySelectorAll('#customModal');
    existingModals.forEach(modal => modal.remove());

    // Fetch the modal HTML
    fetch('../../includes/modal.html')
        .then(response => response.text())
        .then(data => {
            // Create a container for the modal
            const modalContainer = document.createElement('div');
            modalContainer.innerHTML = data;
            document.body.insertAdjacentElement('beforeend', modalContainer);

            // Initialize Bootstrap modal
            const customModal = new bootstrap.Modal(document.getElementById('customModal'));


            // Set dynamic message and icon
            const modalLabel = document.getElementById('modalLabel');
            const modalIcon = document.getElementById('modalIcon');
            const modalMessage = document.getElementById('modalMessage');
            const modalSubMessage = document.getElementById('modalSubMessage');
            const okButton = document.getElementById('okButton');
            const cancelButton = document.getElementById('cancelButton');

            
            modalLabel.textContent = title;
            modalMessage.textContent = mainMessage;
            modalSubMessage.textContent = subMessage;
            modalFields.innerHTML = extraFields; // Add extra fields to the modal

            switch(iconType) {
                case 'success':
                    modalIcon.innerHTML = '<i class="bi bi-check2-circle fa-5x text-success"></i>'; // Green checkmark
                    okButton.innerText = "OK";
                    cancelButton.style.display = "none";
                    break;
                case 'error':
                    modalIcon.innerHTML = '<i class="bi bi-exclamation-circle fa-5x text-danger"></i>'; // Red X mark
                    okButton.innerText = "OK";
                    cancelButton.style.display = "none";
                    break;
                case 'confirm-question':
                    modalIcon.innerHTML ='<i class="bi bi-question-circle fa-5x text-primary"></i>'; // Question mark icon
                    okButton.innerText = "Yes";
                    cancelButton.innerText= "No";
                    break;
                case 'error-question':
                    modalIcon.innerHTML ='<i class="bi bi-exclamation-circle fa-5x text-danger"></i>'; // Question mark icon
                    okButton.innerText = "Yes";
                    cancelButton.innerText= "No";
                    break;
                case 'warning':
                    modalIcon.innerHTML = '<i class="bi bi-exclamation-triangle fa-5x text-warning"></i>'; // warning icon
                    okButton.innerText = "OK";
                    cancelButton.style.display = "none";
                    break;
                default:
                    break;
            }

            okButton.onclick = () => {
                if (okBtnCallback) {
                    okBtnCallback(); // Call the provided callback function
                }
                else {
                    customModal.hide();
                }
            };

            cancelButton.onclick = () => {
                //debugger;
                if (cancelBtnCallback) {
                    cancelBtnCallback(); // Call the provided callback function
                }
                else {
                    customModal.hide();
                }
            };

            // Show the modal
            customModal.show();

            // Clean up after modal is hidden
            customModal._element.addEventListener('hidden.bs.modal', () => {
                modalContainer.remove(); // Remove modal from the DOM
            });
        })
        .catch(error => console.error('Error loading modal:', error));
}