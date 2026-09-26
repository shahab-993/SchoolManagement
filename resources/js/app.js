import 'bootstrap';


// ===============================
// Sidebar
// ===============================

const sidebarToggle = document.getElementById('sidebarToggle');
const sidebar = document.getElementById('sidebar');

function checkScreenSize() {

    if (!sidebar) {
        return;
    }

    if (window.innerWidth >= 992) {

        sidebar.classList.add('show');

    } else {

        sidebar.classList.remove('show');

    }

}

checkScreenSize();

if (sidebarToggle && sidebar) {

    sidebarToggle.addEventListener('click', function () {

        sidebar.classList.toggle('show');

    });

}

window.addEventListener('resize', checkScreenSize);


// ===============================
// Subject Selector Search
// Create / Edit
// ===============================

const subjectSearch = document.getElementById('subjectSearch');
const subjectItems = document.querySelectorAll('.subject-item');

if (subjectSearch && subjectItems.length > 0) {

    subjectSearch.addEventListener('input', function () {

        const searchValue = this.value
            .trim()
            .toLowerCase();

        subjectItems.forEach(function (item) {

            const label = item.querySelector('.form-check-label');

            if (!label) {
                return;
            }

            const subjectText = label.textContent
                .trim()
                .toLowerCase();

            item.style.display =
                subjectText.includes(searchValue)
                    ? ''
                    : 'none';

        });

    });

}


// ===============================
// Database Live Search Helper
// ===============================

// ===============================
// Database Live Search Helper
// ===============================

function setupLiveSearch(searchId) {

    const searchInput = document.getElementById(searchId);

    if (!searchInput) {
        return;
    }

    // Keep focus on search box after page reload
    searchInput.focus();

    // Put cursor at the end
    const length = searchInput.value.length;
    searchInput.setSelectionRange(length, length);

    let timer;

    searchInput.addEventListener('input', function () {

        clearTimeout(timer);

        const searchValue = this.value.trim();

        timer = setTimeout(function () {

            const url = new URL(window.location.href);

            if (searchValue !== '') {

                url.searchParams.set('search', searchValue);

            } else {

                url.searchParams.delete('search');

            }

            // Return to first page
            url.searchParams.delete('page');

            window.location.href = url.toString();

        }, 700);

    });

}


// ===============================
// Listing Page Searches
// ===============================

setupLiveSearch('classSearch');

setupLiveSearch('studentSearch');

setupLiveSearch('teacherSearch');

setupLiveSearch('subjectListSearch');

setupLiveSearch('assignmentSearch');