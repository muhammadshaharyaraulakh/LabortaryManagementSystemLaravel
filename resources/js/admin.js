document.addEventListener("DOMContentLoaded", () => {
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

    // --- Promotional Emails Logic ---
    const promotionalEmailForm = document.getElementById('PromotionalEmailForm');
    const batchProgressContainer = document.getElementById('batch-progress-container');
    const batchProgressBar = document.getElementById('batch-progress-bar');
    const batchStatusText = document.getElementById('batch-status-text');
    const batchPercentage = document.getElementById('batch-percentage');
    const btnSendPromotional = document.getElementById('btnSendPromotional');

    if (promotionalEmailForm) {
        promotionalEmailForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            // Reset errors
            document.querySelectorAll('[id^="errorPromotional"]').forEach(el => {
                el.classList.add('hidden');
                el.innerText = '';
            });

            const formData = new FormData(promotionalEmailForm);
            const data = Object.fromEntries(formData.entries());
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            btnSendPromotional.disabled = true;
            btnSendPromotional.innerHTML = '<i class="ph-duotone ph-spinner animate-spin"></i> Dispatched...';

            try {
                const response = await fetch('/admin/send-promotional-emails', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();

                if (response.status === 422) {
                    const errors = result.errors;
                    if (errors.subject) {
                        const errSub = document.getElementById('errorPromotionalSubject');
                        errSub.innerText = errors.subject[0];
                        errSub.classList.remove('hidden');
                    }
                    if (errors.content) {
                        const errCont = document.getElementById('errorPromotionalContent');
                        errCont.innerText = errors.content[0];
                        errCont.classList.remove('hidden');
                    }
                    btnSendPromotional.disabled = false;
                    btnSendPromotional.innerHTML = '<i class="ph-bold ph-paper-plane-tilt"></i> Send to All Customers';
                    return;
                }

                if (response.ok) {
                    batchProgressContainer.classList.remove('hidden');
                    pollBatchStatus(result.batchId);
                    promotionalEmailForm.reset();
                } else {
                    const errGen = document.getElementById('errorPromotionalGeneral');
                    errGen.innerText = result.message || 'Failed to dispatch batch.';
                    errGen.classList.remove('hidden');
                    btnSendPromotional.disabled = false;
                    btnSendPromotional.innerHTML = '<i class="ph-bold ph-paper-plane-tilt"></i> Send to All Customers';
                }
            } catch (error) {
                console.error('Error sending promotional emails:', error);
                const errGen = document.getElementById('errorPromotionalGeneral');
                errGen.innerText = 'A network error occurred. Please try again.';
                errGen.classList.remove('hidden');
                btnSendPromotional.disabled = false;
                btnSendPromotional.innerHTML = '<i class="ph-bold ph-paper-plane-tilt"></i> Send to All Customers';
            }
        });
    }

    function pollBatchStatus(batchId) {
        const interval = setInterval(async () => {
            try {
                const response = await fetch(`/admin/batch-status/${batchId}`);
                const result = await response.json();

                if (response.ok && result.data) {
                    const batch = result.data;
                    const progress = batch.progress;
                    batchProgressBar.style.width = `${progress}%`;
                    batchPercentage.innerText = `${progress}%`;
                    batchStatusText.innerText = batch.finished ? 'Completed!' : `Processing... (${batch.processedJobs}/${batch.totalJobs})`;

                    if (batch.finished || batch.cancelled) {
                        clearInterval(interval);
                        setTimeout(() => {
                            btnSendPromotional.disabled = false;
                            btnSendPromotional.innerHTML = '<i class="ph-bold ph-paper-plane-tilt"></i> Send to All Customers';
                            if (batch.failedJobs > 0) {
                                const errGen = document.getElementById('errorPromotionalGeneral');
                                errGen.innerText = `Batch finished with ${batch.failedJobs} failures. Check Failed Jobs section.`;
                                errGen.classList.remove('hidden');
                            }
                        }, 2000);
                    }
                }
            } catch (error) {
                console.error('Error polling batch status:', error);
                clearInterval(interval);
            }
        }, 2000);
    }

    // --- Failed Jobs Logic ---
    const failedJobsTable = document.getElementById('failed-jobs-table');
    const btnRetryAll = document.getElementById('btn-retry-all-jobs');
    const btnDeleteAll = document.getElementById('btn-delete-all-jobs');

    const showFailedJobsMessage = (msg, isError = false) => {
        const msgEl = document.getElementById('failed-jobs-inline-msg');
        if (!msgEl) return;
        msgEl.innerText = msg;
        msgEl.className = `mb-4 p-3 rounded-xl font-bold text-sm ${isError ? 'bg-red-50 text-red-600' : 'bg-green-50 text-green-600'}`;
        msgEl.classList.remove('hidden');
        setTimeout(() => msgEl.classList.add('hidden'), 5000);
    };

    async function fetchFailedJobs() {
        if (!failedJobsTable) return;
        
        try {
            const response = await fetch('/admin/failed-jobs');
            const result = await response.json();
            const jobs = result.data || [];

            if (jobs.length === 0) {
                failedJobsTable.innerHTML = `
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-500 font-medium">
                            <div class="flex flex-col items-center">
                                <i class="ph-duotone ph-check-circle text-4xl mb-2 text-green-400"></i>
                                <p>No failed jobs found. Everything is running smoothly!</p>
                            </div>
                        </td>
                    </tr>
                `;
                return;
            }

            failedJobsTable.innerHTML = jobs.map(job => `
                <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors" id="job-row-${job.id}">
                    <td class="px-6 py-4 font-bold text-gray-800">${job.job_name}</td>
                    <td class="px-6 py-4 text-gray-500"><span class="bg-gray-100 px-2 py-1 rounded-md text-xs font-bold uppercase">${job.queue}</span></td>
                    <td class="px-6 py-4 text-gray-500 text-xs">${job.failed_at}</td>
                    <td class="px-6 py-4 max-w-xs">
                        <p class="text-[10px] text-red-500 font-medium line-clamp-2" title="${job.exception}">${job.exception}</p>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end gap-2">
                            <button onclick="retryJob(${job.id})" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Retry">
                                <i class="ph-bold ph-arrows-counter-clockwise"></i>
                            </button>
                            <button onclick="deleteJob(${job.id})" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Delete">
                                <i class="ph-bold ph-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            `).join('');
        } catch (error) {
            console.error('Error fetching failed jobs:', error);
        }
    }

    window.retryJob = async (id) => {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        try {
            const response = await fetch(`/admin/failed-jobs/${id}/retry`, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' }
            });
            const result = await response.json();
            if (result.status === true) {
                document.getElementById(`job-row-${id}`)?.remove();
                showFailedJobsMessage(result.message || 'Job retried successfully.');
                if (failedJobsTable.children.length === 0) fetchFailedJobs();
            } else {
                showFailedJobsMessage(result.message || 'Failed to retry job.', true);
            }
        } catch (error) {
            console.error('Error retrying job:', error);
            showFailedJobsMessage('A network error occurred.', true);
        }
    };

    window.deleteJob = async (id) => {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        try {
            const response = await fetch(`/admin/failed-jobs/${id}`, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' }
            });
            const result = await response.json();
            if (result.status === true) {
                document.getElementById(`job-row-${id}`)?.remove();
                showFailedJobsMessage(result.message || 'Job deleted successfully.');
                if (failedJobsTable.children.length === 0) fetchFailedJobs();
            } else {
                showFailedJobsMessage(result.message || 'Failed to delete job.', true);
            }
        } catch (error) {
            console.error('Error deleting job:', error);
            showFailedJobsMessage('A network error occurred.', true);
        }
    };

    if (btnRetryAll) {
        btnRetryAll.addEventListener('click', async () => {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            btnRetryAll.disabled = true;
            try {
                const response = await fetch('/admin/failed-jobs/retry-all', {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' }
                });
                const result = await response.json();
                if (result.status === true) {
                    showFailedJobsMessage(result.message || 'All jobs have been queued for retry.');
                    fetchFailedJobs();
                } else {
                    showFailedJobsMessage(result.message || 'Failed to retry all jobs.', true);
                }
            } catch (error) {
                console.error('Error retrying all jobs:', error);
                showFailedJobsMessage('A network error occurred.', true);
            } finally {
                btnRetryAll.disabled = false;
            }
        });
    }

    if (btnDeleteAll) {
        btnDeleteAll.addEventListener('click', async () => {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            btnDeleteAll.disabled = true;
            try {
                const response = await fetch('/admin/failed-jobs/delete-all', {
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' }
                });
                const result = await response.json();
                if (result.status === true) {
                    showFailedJobsMessage(result.message || 'All failed jobs have been cleared.');
                    fetchFailedJobs();
                } else {
                    showFailedJobsMessage(result.message || 'Failed to delete all jobs.', true);
                }
            } catch (error) {
                console.error('Error deleting all jobs:', error);
                showFailedJobsMessage('A network error occurred.', true);
            } finally {
                btnDeleteAll.disabled = false;
            }
        });
    }

    // Initial load for failed jobs when section is shown
    document.querySelectorAll('[data-target="section-failed-jobs"]').forEach(link => {
        link.addEventListener('click', fetchFailedJobs);
    });
});
