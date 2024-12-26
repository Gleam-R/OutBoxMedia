import './bootstrap';
import '../css/app.css';

document.addEventListener("DOMContentLoaded", () => {
    const hamburger = document.getElementById('hamburger');
    const sidebar = document.getElementById('sidebar');

    // Check if elements exist
    if (hamburger && sidebar) {
        hamburger.addEventListener('click', () => {
            // Toggle 'open' class for both the sidebar and the hamburger menu
            sidebar.classList.toggle('open');
            hamburger.classList.toggle('open');
        });
    } else {
        console.error('Elements not found in the DOM');
    }
});

// Search functionality
const searchInput = document.getElementById('search');

searchInput.addEventListener('input', (event) => {
    const query = event.target.value.toLowerCase();
    console.log("Searching for: " + query);
});

// Logout Button (Placeholder)
const logoutBtn = document.getElementById('logoutBtn');
if (logoutBtn) {
    logoutBtn.addEventListener('click', () => {
        window.location.href = '/logout';  // Ganti dengan URL logout Anda
    });
}
