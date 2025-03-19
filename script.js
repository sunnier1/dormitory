const sidebar = document.getElementById('sidebar');
const toggleSidebar = document.getElementById('toggle-sidebar');

toggleSidebar.addEventListener('click', () => {
    sidebar.classList.toggle('active');
});

sidebar.addEventListener('click', (e) => {
    if (e.target.classList.contains('menu-icon')) {
        sidebar.classList.toggle('active');
    }
});