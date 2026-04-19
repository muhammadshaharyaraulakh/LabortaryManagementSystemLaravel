document.addEventListener('DOMContentLoaded', () => {
    // --- Sidebar & Navigation Logic ---
    const sidebar = document.getElementById('sidebar');
    const toggleDesktopBtn = document.getElementById('toggle-desktop-sidebar');
    const desktopToggleIcon = document.getElementById('desktop-toggle-icon');
    const sidebarBackdrop = document.getElementById('sidebar-backdrop');
    const navTexts = document.querySelectorAll('.nav-text');
    const brandText = document.getElementById('brand-text');
    const navLinks = document.querySelectorAll('.nav-link');

    const openMobileBtn = document.getElementById('open-mobile-sidebar');
    const closeMobileBtn = document.getElementById('close-mobile-sidebar');
    const headerTitle = document.getElementById('header-title');
    const profileBtn = document.getElementById('profile-btn');
    const profileMenu = document.getElementById('profile-menu');

    // Navigation Tabs
    navLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const targetId = link.getAttribute('data-target');
            const targetTitle = link.getAttribute('data-title');

            if (headerTitle) headerTitle.textContent = targetTitle;

            document.querySelectorAll('.content-section').forEach(section => {
                section.classList.add('hidden');
                section.classList.remove('block');
            });

            const activeSection = document.getElementById(targetId);
            if (activeSection) {
                activeSection.classList.remove('hidden');
                activeSection.classList.add('block');
            }

            navLinks.forEach(nav => {
                nav.classList.remove('bg-white/10', 'text-white', 'active-nav');
                nav.classList.add('text-gray-300');
                const icon = nav.querySelector('.nav-icon');
                if (icon) {
                    icon.classList.remove('text-white');
                    icon.classList.add('text-gray-400');
                }
            });

            link.classList.remove('text-gray-300');
            link.classList.add('bg-white/10', 'text-white', 'active-nav');
            const activeIcon = link.querySelector('.nav-icon');
            if (activeIcon) {
                activeIcon.classList.remove('text-gray-400');
                activeIcon.classList.add('text-white');
            }

            if (window.innerWidth < 768) closeMobileSidebar();
        });
    });

    // --- Profile Dropdown Logic ---
    if (profileBtn && profileMenu) {
        profileBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            if (profileMenu.classList.contains('hidden')) {
                profileMenu.classList.remove('hidden');
                setTimeout(() => {
                    profileMenu.classList.remove('dropdown-enter');
                    profileMenu.classList.add('dropdown-enter-active');
                }, 10);
            } else {
                closeDropdown();
            }
        });

        function closeDropdown() {
            profileMenu.classList.remove('dropdown-enter-active');
            profileMenu.classList.add('dropdown-leave-active');
            setTimeout(() => {
                profileMenu.classList.add('hidden');
                profileMenu.classList.remove('dropdown-leave-active');
                profileMenu.classList.add('dropdown-enter');
            }, 150);
        }

        document.addEventListener('click', (e) => {
            if (!profileBtn.contains(e.target) && !profileMenu.contains(e.target) && !profileMenu.classList.contains('hidden')) {
                closeDropdown();
            }
        });
    }

    // --- Sidebar Toggle Logic ---
    let isCollapsed = false;
    if (toggleDesktopBtn) {
        toggleDesktopBtn.addEventListener('click', () => {
            isCollapsed = !isCollapsed;
            if (isCollapsed) {
                sidebar.classList.remove('w-64');
                sidebar.classList.add('w-20');
                brandText.classList.add('hidden');
                navTexts.forEach(text => text.classList.add('hidden'));
                desktopToggleIcon.classList.remove('ph-caret-double-left');
                desktopToggleIcon.classList.add('ph-caret-double-right');
            } else {
                sidebar.classList.remove('w-20');
                sidebar.classList.add('w-64');
                setTimeout(() => {
                    brandText.classList.remove('hidden');
                    navTexts.forEach(text => text.classList.remove('hidden'));
                }, 150);
                desktopToggleIcon.classList.remove('ph-caret-double-right');
                desktopToggleIcon.classList.add('ph-caret-double-left');
            }
        });
    }

    function openMobileSidebar() {
        isCollapsed = false;
        sidebar.classList.remove('w-20');
        sidebar.classList.add('w-64');
        brandText.classList.remove('hidden');
        navTexts.forEach(text => text.classList.remove('hidden'));
        if (desktopToggleIcon) {
            desktopToggleIcon.classList.remove('ph-caret-double-right');
            desktopToggleIcon.classList.add('ph-caret-double-left');
        }
        sidebar.classList.remove('-translate-x-full');
        sidebarBackdrop.classList.remove('hidden');
        setTimeout(() => sidebarBackdrop.classList.add('opacity-100'), 10);
    }

    function closeMobileSidebar() {
        sidebar.classList.add('-translate-x-full');
        sidebarBackdrop.classList.remove('opacity-100');
        setTimeout(() => sidebarBackdrop.classList.add('hidden'), 300);
    }

    if (openMobileBtn) openMobileBtn.addEventListener('click', openMobileSidebar);
    if (closeMobileBtn) closeMobileBtn.addEventListener('click', closeMobileSidebar);
    if (sidebarBackdrop) sidebarBackdrop.addEventListener('click', closeMobileSidebar);

    // --- Chart Logic ---
    const lineCtxEl = document.getElementById('lineChart');
    if (lineCtxEl) {
        const lineCtx = lineCtxEl.getContext('2d');
        new Chart(lineCtx, {
            type: 'line',
            data: {
                labels: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'],
                datasets: [
                    { label: 'Dataset 1', data: [300, 600, 250, 150, 850, 0, 150, 850, 1000, 250], borderColor: '#b24a96', backgroundColor: 'transparent', borderWidth: 1.5, pointBackgroundColor: '#ffffff', pointBorderColor: '#b24a96', pointBorderWidth: 2, pointRadius: 4, tension: 0 },
                    { label: 'Dataset 2', data: [800, 800, 450, 400, 700, 250, 100, 600, 0, 300], borderColor: '#72c8b7', backgroundColor: 'transparent', borderWidth: 1.5, pointBackgroundColor: '#ffffff', pointBorderColor: '#72c8b7', pointBorderWidth: 2, pointRadius: 4, tension: 0 }
                ]
            },
            options: {
                responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true, max: 1000, ticks: { stepSize: 250, color: '#9ca3af', font: { size: 10 } }, grid: { color: '#f3f4f6' }, border: { display: false } }, x: { ticks: { color: '#9ca3af', font: { size: 10 } }, grid: { display: false }, border: { color: '#e5e7eb' } } }
            }
        });
    }

    const doughnutCtxEl = document.getElementById('doughnutChart');
    if (doughnutCtxEl) {
        const doughnutCtx = doughnutCtxEl.getContext('2d');
        new Chart(doughnutCtx, {
            type: 'doughnut',
            data: {
                labels: ['1000', '200', '300', '500'],
                datasets: [{ data: [50, 10, 15, 25], backgroundColor: ['#a8d124', '#e29b20', '#e8278f', '#b824a4'], borderWidth: 0, hoverOffset: 4 }]
            },
            options: {
                responsive: true, maintainAspectRatio: false, cutout: '65%', plugins: { legend: { position: 'right', labels: { usePointStyle: true, boxWidth: 8, padding: 20, font: { family: 'Inter', size: 11, weight: 'bold' } } }, tooltip: { callbacks: { label: function (context) { return ` ${context.raw}%`; } } } }
            }
        });
    }
});