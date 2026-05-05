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

    let isCollapsed = false;
    if (toggleDesktopBtn) {
        toggleDesktopBtn.addEventListener("click", () => {
            isCollapsed = !isCollapsed;
            if (isCollapsed) {
                if (sidebar) {
                    sidebar.classList.remove("w-64");
                    sidebar.classList.add("w-20");
                }
                if (brandText) brandText.classList.add("hidden");
                navTexts.forEach((text) => text.classList.add("hidden"));
                if (desktopToggleIcon) {
                    desktopToggleIcon.classList.remove("ph-caret-double-left");
                    desktopToggleIcon.classList.add("ph-caret-double-right");
                }
            } else {
                if (sidebar) {
                    sidebar.classList.remove("w-20");
                    sidebar.classList.add("w-64");
                }
                setTimeout(() => {
                    if (brandText) brandText.classList.remove("hidden");
                    navTexts.forEach((text) => text.classList.remove("hidden"));
                }, 150);
                if (desktopToggleIcon) {
                    desktopToggleIcon.classList.remove("ph-caret-double-right");
                    desktopToggleIcon.classList.add("ph-caret-double-left");
                }
            }
        });
    }

    function openMobileSidebar() {
        isCollapsed = false;
        if (sidebar) {
            sidebar.classList.remove("w-20");
            sidebar.classList.add("w-64");
            sidebar.classList.remove("-translate-x-full");
        }
        if (brandText) brandText.classList.remove("hidden");
        navTexts.forEach((text) => text.classList.remove("hidden"));
        if (desktopToggleIcon) {
            desktopToggleIcon.classList.remove("ph-caret-double-right");
            desktopToggleIcon.classList.add("ph-caret-double-left");
        }
        if (sidebarBackdrop) {
            sidebarBackdrop.classList.remove("hidden");
            setTimeout(() => sidebarBackdrop.classList.add("opacity-100"), 10);
        }
    }

    function closeMobileSidebar() {
        if (sidebar) sidebar.classList.add("-translate-x-full");
        if (sidebarBackdrop) {
            sidebarBackdrop.classList.remove("opacity-100");
            setTimeout(() => sidebarBackdrop.classList.add("hidden"), 300);
        }
    }

    if (openMobileBtn)
        openMobileBtn.addEventListener("click", openMobileSidebar);
    if (closeMobileBtn)
        closeMobileBtn.addEventListener("click", closeMobileSidebar);
    if (sidebarBackdrop)
        sidebarBackdrop.addEventListener("click", closeMobileSidebar);

    flatpickr("#filterStartDate", {
        dateFormat: "Y-m-d",
        disableMobile: "true",
    });
    flatpickr("#filterEndDate", {
        dateFormat: "Y-m-d",
        disableMobile: "true",
    });

    const fetchMonthlyStats = async () => {
        try {
            const response = await fetch("/stats/monthly", {
                headers: { Accept: "application/json" },
            });

            if (response.ok) {
                const result = await response.json();
                if (result.data) {
                    const data = result.data;
                    document.getElementById("stat-orders-today").innerText =
                        data.activeOrders || 0;
                    document.getElementById("stat-completed-today").innerText =
                        data.completedTests || 0;
                    document.getElementById("stat-pending-today").innerText =
                        data.pendingTests || 0;
                    document.getElementById(
                        "stat-money-today"
                    ).innerText = `Rs. ${(
                        data.totalRevenue || 0
                    ).toLocaleString()}`;
                    document.getElementById(
                        "stat-tax-today"
                    ).innerText = `Rs. ${(
                        data.totalTax || 0
                    ).toLocaleString()}`;
                    document.getElementById("stat-deleted-today").innerText =
                        data.deletedOrders || 0;
                }
            }
        } catch (error) {
            console.error("Error fetching monthly stats:", error);
        }
    };

    const filterForm = document.getElementById("DashboardDateFilterForm");

    if (filterForm) {
        filterForm.addEventListener("submit", async (e) => {
            e.preventDefault();
            const errorMsg = document.getElementById("dateErrorMsg");
            const emptyState = document.getElementById("reportEmptyState");
            const loadingState = document.getElementById("reportLoadingState");
            const dataState = document.getElementById("reportDataState");
            if (errorMsg) {
                errorMsg.classList.add("hidden");
                errorMsg.innerText = "";
            }
            if (emptyState) emptyState.classList.add("hidden");
            if (dataState) dataState.classList.add("hidden");
            if (loadingState) loadingState.classList.remove("hidden");

            const startDate = document.getElementById("filterStartDate").value;
            const endDate = document.getElementById("filterEndDate").value;
            const csrfToken = document.querySelector(
                'meta[name="csrf-token"]'
            ).content;

            try {
                const response = await fetch("/stats/search", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        Accept: "application/json",
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    body: JSON.stringify({ startDate, endDate }),
                });

                const result = await response.json();

                if (response.status === 422) {
                    if (loadingState) loadingState.classList.add("hidden");
                    if (emptyState) emptyState.classList.remove("hidden");
                    const errors = result.errors;
                    const firstError = Object.values(errors)[0][0];
                    if (errorMsg) {
                        errorMsg.innerText = firstError;
                        errorMsg.classList.remove("hidden");
                    }
                    return;
                }

                if (response.ok && result.data) {
                    const data = result.data;

                    const rOrders = document.getElementById("res-orders");
                    if (rOrders) rOrders.innerText = data.activeOrders || 0;

                    const rCompleted = document.getElementById("res-completed");
                    if (rCompleted)
                        rCompleted.innerText = data.completedTests || 0;

                    const rPending = document.getElementById("res-pending");
                    if (rPending) rPending.innerText = data.pendingTests || 0;

                    const rMoney = document.getElementById("res-money");
                    if (rMoney)
                        rMoney.innerText = `Rs. ${(
                            data.totalRevenue || 0
                        ).toLocaleString()}`;

                    const rTax = document.getElementById("res-tax");
                    if (rTax)
                        rTax.innerText = `Rs. ${(
                            data.totalTax || 0
                        ).toLocaleString()}`;

                    const rDeleted = document.getElementById("res-deleted");
                    if (rDeleted) rDeleted.innerText = data.deletedOrders || 0;
                    if (loadingState) loadingState.classList.add("hidden");
                    if (emptyState) emptyState.classList.add("hidden");
                    if (dataState) dataState.classList.remove("hidden");
                } else {
                    throw new Error(
                        result.message || "An error occurred on the server."
                    );
                }
            } catch (error) {
                if (loadingState) loadingState.classList.add("hidden");
                if (emptyState) emptyState.classList.remove("hidden");
                if (errorMsg) {
                    errorMsg.innerText =
                        error.message ||
                        "A network error occurred. Please try again.";
                    errorMsg.classList.remove("hidden");
                }
            }
        });
    }

    fetchMonthlyStats();
});
