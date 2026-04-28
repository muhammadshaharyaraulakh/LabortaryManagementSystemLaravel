document.addEventListener("DOMContentLoaded", () => {
    // --- Sidebar & Navigation Logic ---
    const sidebar = document.getElementById("sidebar");
    const toggleDesktopBtn = document.getElementById("toggle-desktop-sidebar");
    const desktopToggleIcon = document.getElementById("desktop-toggle-icon");
    const sidebarBackdrop = document.getElementById("sidebar-backdrop");
    const navTexts = document.querySelectorAll(".nav-text");
    const brandText = document.getElementById("brand-text");
    const navLinks = document.querySelectorAll(".nav-link");

    const openMobileBtn = document.getElementById("open-mobile-sidebar");
    const closeMobileBtn = document.getElementById("close-mobile-sidebar");
    const headerTitle = document.getElementById("header-title");
    const profileBtn = document.getElementById("profile-btn");
    const profileMenu = document.getElementById("profile-menu");

    // Navigation Tabs
    navLinks.forEach((link) => {
        link.addEventListener("click", (e) => {
            e.preventDefault();
            const targetId = link.getAttribute("data-target");
            const targetTitle = link.getAttribute("data-title");

            if (headerTitle) headerTitle.textContent = targetTitle;

            document.querySelectorAll(".content-section").forEach((section) => {
                section.classList.add("hidden");
                section.classList.remove("block");
            });

            const activeSection = document.getElementById(targetId);
            if (activeSection) {
                activeSection.classList.remove("hidden");
                activeSection.classList.add("block");
            }

            navLinks.forEach((nav) => {
                nav.classList.remove("bg-white/10", "text-white", "active-nav");
                nav.classList.add("text-gray-300");
                const icon = nav.querySelector(".nav-icon");
                if (icon) {
                    icon.classList.remove("text-white");
                    icon.classList.add("text-gray-400");
                }
            });

            link.classList.remove("text-gray-300");
            link.classList.add("bg-white/10", "text-white", "active-nav");
            const activeIcon = link.querySelector(".nav-icon");
            if (activeIcon) {
                activeIcon.classList.remove("text-gray-400");
                activeIcon.classList.add("text-white");
            }

            if (window.innerWidth < 768) closeMobileSidebar();
        });
    });
    // Inner Navigation (Staff Hub Buttons)
    document.querySelectorAll(".inner-nav-link").forEach((link) => {
        link.addEventListener("click", (e) => {
            e.preventDefault();
            const targetId = link.getAttribute("data-target");
            const targetTitle = link.getAttribute("data-title");

            if (headerTitle) headerTitle.textContent = targetTitle;

            document.querySelectorAll(".content-section").forEach((section) => {
                section.classList.add("hidden");
                section.classList.remove("block");
            });

            const activeSection = document.getElementById(targetId);
            if (activeSection) {
                activeSection.classList.remove("hidden");
                activeSection.classList.add("block");
            }
        });
    });

    // --- Profile Dropdown Logic ---
    if (profileBtn && profileMenu) {
        profileBtn.addEventListener("click", (e) => {
            e.stopPropagation();
            if (profileMenu.classList.contains("hidden")) {
                profileMenu.classList.remove("hidden");
                setTimeout(() => {
                    profileMenu.classList.remove("dropdown-enter");
                    profileMenu.classList.add("dropdown-enter-active");
                }, 10);
            } else {
                closeDropdown();
            }
        });

        function closeDropdown() {
            profileMenu.classList.remove("dropdown-enter-active");
            profileMenu.classList.add("dropdown-leave-active");
            setTimeout(() => {
                profileMenu.classList.add("hidden");
                profileMenu.classList.remove("dropdown-leave-active");
                profileMenu.classList.add("dropdown-enter");
            }, 150);
        }

        document.addEventListener("click", (e) => {
            if (
                !profileBtn.contains(e.target) &&
                !profileMenu.contains(e.target) &&
                !profileMenu.classList.contains("hidden")
            ) {
                closeDropdown();
            }
        });
    }

    // --- Sidebar Toggle Logic ---
    let isCollapsed = false;
    if (toggleDesktopBtn) {
        toggleDesktopBtn.addEventListener("click", () => {
            isCollapsed = !isCollapsed;
            if (isCollapsed) {
                sidebar.classList.remove("w-64");
                sidebar.classList.add("w-20");
                brandText.classList.add("hidden");
                navTexts.forEach((text) => text.classList.add("hidden"));
                desktopToggleIcon.classList.remove("ph-caret-double-left");
                desktopToggleIcon.classList.add("ph-caret-double-right");
            } else {
                sidebar.classList.remove("w-20");
                sidebar.classList.add("w-64");
                setTimeout(() => {
                    brandText.classList.remove("hidden");
                    navTexts.forEach((text) => text.classList.remove("hidden"));
                }, 150);
                desktopToggleIcon.classList.remove("ph-caret-double-right");
                desktopToggleIcon.classList.add("ph-caret-double-left");
            }
        });
    }

    function openMobileSidebar() {
        isCollapsed = false;
        sidebar.classList.remove("w-20");
        sidebar.classList.add("w-64");
        brandText.classList.remove("hidden");
        navTexts.forEach((text) => text.classList.remove("hidden"));
        if (desktopToggleIcon) {
            desktopToggleIcon.classList.remove("ph-caret-double-right");
            desktopToggleIcon.classList.add("ph-caret-double-left");
        }
        sidebar.classList.remove("-translate-x-full");
        sidebarBackdrop.classList.remove("hidden");
        setTimeout(() => sidebarBackdrop.classList.add("opacity-100"), 10);
    }

    function closeMobileSidebar() {
        sidebar.classList.add("-translate-x-full");
        sidebarBackdrop.classList.remove("opacity-100");
        setTimeout(() => sidebarBackdrop.classList.add("hidden"), 300);
    }

    if (openMobileBtn)
        openMobileBtn.addEventListener("click", openMobileSidebar);
    if (closeMobileBtn)
        closeMobileBtn.addEventListener("click", closeMobileSidebar);
    if (sidebarBackdrop)
        sidebarBackdrop.addEventListener("click", closeMobileSidebar);
});
document.addEventListener("DOMContentLoaded", function () {
    flatpickr("#filterStartDate", { dateFormat: "Y-m-d" });
    flatpickr("#filterEndDate", { dateFormat: "Y-m-d" });

    const errorMsg = document.getElementById("dateErrorMsg");
    const emptyState = document.getElementById("reportEmptyState");
    const loadingState = document.getElementById("reportLoadingState");
    const dataState = document.getElementById("reportDataState");

    const updateMonthlyUI = (data) => {
        document.getElementById("stat-orders-today").innerText =
            data.activeOrders;
        document.getElementById("stat-completed-today").innerText =
            data.completedTests;
        document.getElementById("stat-pending-today").innerText =
            data.pendingTests;
        document.getElementById(
            "stat-money-today"
        ).innerText = `Rs. ${data.totalRevenue.toLocaleString()}`;
        document.getElementById(
            "stat-tax-today"
        ).innerText = `Rs. ${data.totalTax.toLocaleString()}`;
        document.getElementById("stat-deleted-today").innerText =
            data.deletedOrders;
    };

    const updateSearchUI = (data) => {
        document.getElementById("res-orders").innerText = data.activeOrders;
        document.getElementById("res-completed").innerText =
            data.completedTests;
        document.getElementById("res-pending").innerText = data.pendingTests;
        document.getElementById(
            "res-money"
        ).innerText = `Rs. ${data.totalRevenue.toLocaleString()}`;
        document.getElementById(
            "res-tax"
        ).innerText = `Rs. ${data.totalTax.toLocaleString()}`;
        document.getElementById("res-deleted").innerText = data.deletedOrders;
    };

    const fetchMonthlyStats = async () => {
        try {
            const response = await fetch("/stats/monthly");
            if (response.ok) {
                const result = await response.json();
                if (result.status === 200) updateMonthlyUI(result.data);
            }
        } catch (error) {
            console.error(error);
        }
    };

    document
        .getElementById("DashboardDateFilterForm")
        .addEventListener("submit", async (e) => {
            e.preventDefault();

            errorMsg.classList.add("hidden");
            errorMsg.innerText = "";
            emptyState.classList.add("hidden");
            dataState.classList.add("hidden");
            loadingState.classList.remove("hidden");

            const startDate = document.getElementById("filterStartDate").value;
            const endDate = document.getElementById("filterEndDate").value;

            if (!startDate || !endDate) {
                loadingState.classList.add("hidden");
                emptyState.classList.remove("hidden");
                errorMsg.innerText = "Please select both start and end dates.";
                errorMsg.classList.remove("hidden");
                return;
            }

            try {
                const response = await fetch("/stats/search", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        Accept: "application/json",
                        "X-CSRF-TOKEN": document.querySelector(
                            'meta[name="csrf-token"]'
                        ).content,
                    },
                    body: JSON.stringify({ startDate, endDate }),
                });

                const result = await response.json();

                if (response.status === 422) {
                    const errors = result.errors;
                    const firstError = Object.values(errors)[0][0];
                    throw new Error(firstError);
                }

                if (result.status === 200) {
                    updateSearchUI(result.data);
                    loadingState.classList.add("hidden");
                    dataState.classList.remove("hidden");
                } else {
                    throw new Error(result.message || "Something went wrong.");
                }
            } catch (error) {
                loadingState.classList.add("hidden");
                emptyState.classList.remove("hidden");
                errorMsg.innerText = error.message;
                errorMsg.classList.remove("hidden");
            }
        });

    fetchMonthlyStats();
});
