document.addEventListener("DOMContentLoaded", function () {
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
                if (result.status === 200) {
                    const data = result.data;
                    // Update the top Monthly cards
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
            errorMsg.classList.add("hidden");
            errorMsg.innerText = "";
            emptyState.classList.add("hidden");
            dataState.classList.add("hidden");
            loadingState.classList.remove("hidden");
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
                    loadingState.classList.add("hidden");
                    emptyState.classList.remove("hidden");
                    const errors = result.errors;
                    const firstError = Object.values(errors)[0][0];
                    errorMsg.innerText = firstError;
                    errorMsg.classList.remove("hidden");
                    return;
                }
                if (response.ok && result.status === 200) {
                    const data = result.data;
                    document.getElementById("res-orders").innerText =
                        data.activeOrders || 0;
                    document.getElementById("res-completed").innerText =
                        data.completedTests || 0;
                    document.getElementById("res-pending").innerText =
                        data.pendingTests || 0;
                    document.getElementById("res-money").innerText = `Rs. ${(
                        data.totalRevenue || 0
                    ).toLocaleString()}`;
                    document.getElementById("res-tax").innerText = `Rs. ${(
                        data.totalTax || 0
                    ).toLocaleString()}`;
                    document.getElementById("res-deleted").innerText =
                        data.deletedOrders || 0;
                    loadingState.classList.add("hidden");
                    dataState.classList.remove("hidden");
                } else {
                    throw new Error(
                        result.message || "An error occurred on the server."
                    );
                }
            } catch (error) {
                loadingState.classList.add("hidden");
                emptyState.classList.remove("hidden");
                errorMsg.innerText =
                    error.message ||
                    "A network error occurred. Please try again.";
                errorMsg.classList.remove("hidden");
            }
        });
    }
});
