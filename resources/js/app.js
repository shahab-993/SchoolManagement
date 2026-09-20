

import 'bootstrap';

const sidebarToggle = document.getElementById('sidebarToggle');
const sidebar = document.getElementById('sidebar');

function checkScreenSize() {

    if (window.innerWidth >= 992) {
        sidebar.classList.add('show');
    } else {
        sidebar.classList.remove('show');
    }

}

checkScreenSize();

sidebarToggle.addEventListener('click', function () {

    sidebar.classList.toggle('show');

});

window.addEventListener('resize', checkScreenSize);