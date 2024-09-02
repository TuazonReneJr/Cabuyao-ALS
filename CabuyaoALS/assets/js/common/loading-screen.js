// Function to show the loading screen with a dynamic message
function showLoadingScreen(message) {
    const loadingScreen = document.getElementById('loadingScreen');
    const loadingMessage = document.getElementById('loadingMessage');
    
    loadingMessage.textContent = message; // Set the dynamic message
    loadingScreen.style.display = 'flex';
}

function hideLoadingScreen() {
    document.getElementById('loadingScreen').style.display = 'none';
}