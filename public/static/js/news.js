const filterIcon = document.getElementById('filter-icon');
const sidebar = document.getElementById('sidebar');

filterIcon.addEventListener('click', function () {
    sidebar.classList.toggle('show');
});

// document.querySelectorAll('.toggle-submenu').forEach(function (menu) {
//     menu.addEventListener('click', function (e) {
//         e.preventDefault();
//         const submenu = this.nextElementSibling;
//         submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
//     });
// });

const backgroundSidebar = document.querySelector('.background-sidebar');
backgroundSidebar.addEventListener('click', function(){
    sidebar.classList.toggle('show');
});

