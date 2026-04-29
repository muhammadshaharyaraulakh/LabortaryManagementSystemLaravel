document.addEventListener("DOMContentLoaded", () => {
    /* ==========================================================================
       1. GLOBAL VARIABLES & INITIALIZATION
       ========================================================================== */
    const csrfToken =
        document.querySelector('meta[name="csrf-token"]')?.content || "";
    const tableBody = document.getElementById("inventory-table-body");
    const searchInput = document.getElementById("inventory-search");

    let searchTimeout = null;
    let currentView = "active";
    let currentFetchUrl = "/inventory";

    /* ==========================================================================
       2. MODAL HELPERS & ERROR HANDLING
       ========================================================================== */
    function openInvModal(backdropId, modalId) {
        const backdrop = document.getElementById(backdropId);
        const modal = document.getElementById(modalId);
        backdrop.classList.remove("hidden");
        backdrop.classList.add("flex");
        setTimeout(() => {
            backdrop.classList.remove("opacity-0");
            backdrop.classList.add("opacity-100");
            modal.classList.remove("scale-95");
            modal.classList.add("scale-100");
        }, 10);
    }

    function closeInvModal(backdropId, modalId, formId, prefix) {
        const backdrop = document.getElementById(backdropId);
        const modal = document.getElementById(modalId);
        backdrop.classList.remove("opacity-100");
        backdrop.classList.add("opacity-0");
        modal.classList.remove("scale-100");
        modal.classList.add("scale-95");
        setTimeout(() => {
            backdrop.classList.add("hidden");
            backdrop.classList.remove("flex");
            if (formId) {
                document.getElementById(formId).reset();
                if (prefix) clearInvErrors(prefix);
            }
        }, 300);
    }

    function clearInvErrors(prefix) {
        document.querySelectorAll(`[id^="error${prefix}"]`).forEach((el) => {
            el.classList.add("hidden");
            el.innerText = "";
        });
        document
            .querySelectorAll(
                `[id^="${prefix.charAt(0).toLowerCase() + prefix.slice(1)}"]`
            )
            .forEach((el) => {
                if (el.tagName === "INPUT")
                    el.classList.remove("border-red-500", "focus:ring-red-200");
            });
    }

    function showInvErrors(errors, prefix) {
        clearInvErrors(prefix);
        for (const [field, messages] of Object.entries(errors)) {
            let fieldMap = field;
            if (field === "initial_stock" || field === "stock")
                fieldMap = "Stock";
            if (field === "action") fieldMap = "Reason";
            if (field === "name") fieldMap = "Name";
            if (field === "unit") fieldMap = "Unit";
            if (field === "alert") fieldMap = "Alert";

            let inputId, errorId;
            if (prefix === "ModifyStock") {
                inputId = `modifyStock${
                    fieldMap === "Stock" ? "Qty" : fieldMap
                }`;
                errorId = `errorModifyStock${
                    fieldMap === "Stock" ? "Qty" : fieldMap
                }`;
            } else {
                inputId = `${
                    prefix.charAt(0).toLowerCase() + prefix.slice(1)
                }${fieldMap}`;
                errorId = `error${prefix}${fieldMap}`;
            }

            const inputEl = document.getElementById(inputId);
            const errorEl = document.getElementById(errorId);

            if (errorEl) {
                errorEl.innerText = messages[0];
                errorEl.classList.remove("hidden");
            }
            if (inputEl) {
                inputEl.classList.add("border-red-500", "focus:ring-red-200");
            }
        }
    }

    /* ==========================================================================
       3. NAVIGATION & DATA FETCHING (LAZY LOAD & STATE PRESERVATION)
       ========================================================================== */
    const stockNavLink = document.querySelector(
        '.nav-link[data-target="section-stock"]'
    );
    if (stockNavLink) {
        stockNavLink.addEventListener("click", () => {
            if (tableBody) {
                tableBody.innerHTML = `<tr><td colspan="4" class="px-6 py-8 text-center text-gray-500 font-medium"><i class="ph-bold ph-spinner animate-spin text-2xl mb-2 text-orange-500 block"></i> Loading inventory...</td></tr>`;
            }
            // Fetch default view when tab is clicked
            fetchInventory(
                currentView === "trashed" ? "/inventory/trashed" : "/inventory"
            );
        });
    }

    async function fetchInventory(url = null) {
        const paginationContainer = document.getElementById(
            "inventory-pagination"
        );

        if (!url) url = currentFetchUrl;
        currentFetchUrl = url;

        try {
            const response = await fetch(url, {
                headers: { Accept: "application/json" },
            });
            const result = await response.json();

            if (response.ok) {
                let itemsArray = [];
                let paginationData = null;
                if (Array.isArray(result)) {
                    itemsArray = result;
                } else if (result.data && Array.isArray(result.data)) {
                    itemsArray = result.data;
                } else if (
                    result.data &&
                    result.data.data &&
                    Array.isArray(result.data.data)
                ) {
                    itemsArray = result.data.data;
                    paginationData = result.data;
                } else if (
                    result.data === undefined &&
                    result.current_page !== undefined &&
                    Array.isArray(result.data)
                ) {
                    itemsArray = result.data;
                    paginationData = result;
                }

                renderInventoryTable(itemsArray);

                if (
                    paginationData &&
                    (paginationData.next_page_url ||
                        paginationData.prev_page_url)
                ) {
                    renderPagination(paginationData);
                    if (paginationContainer)
                        paginationContainer.classList.remove("hidden");
                } else {
                    if (paginationContainer) {
                        paginationContainer.innerHTML = "";
                        paginationContainer.classList.add("hidden");
                    }
                }
            } else {
                renderEmptyTable(
                    `No ${
                        currentView === "trashed" ? "trashed " : ""
                    }items found.`
                );
                if (paginationContainer)
                    paginationContainer.classList.add("hidden");
            }
        } catch (error) {
            console.error("Inventory Fetch Error:", error);
            renderEmptyTable("Error fetching data. Please try again.");
            if (paginationContainer)
                paginationContainer.classList.add("hidden");
        }
    }

    /* ==========================================================================
       4. UI RENDERING (TABLE, LOGS & PAGINATION)
       ========================================================================== */
    function renderPagination(paginationData) {
        const container = document.getElementById("inventory-pagination");
        if (!container) return;

        const prevUrl = paginationData.prev_page_url;
        const nextUrl = paginationData.next_page_url;
        const from = paginationData.from || 0;
        const to = paginationData.to || 0;

        container.innerHTML = `
            <div class="text-xs font-bold text-gray-500 uppercase tracking-wider">
                Showing ${from} to ${to}
            </div>
            <div class="flex gap-2">
                <button id="prev-page" ${!prevUrl ? "disabled" : ""} 
                    class="px-4 py-2 rounded-xl text-xs font-bold transition-all border ${
                        !prevUrl
                            ? "text-gray-300 border-gray-100 cursor-not-allowed"
                            : "text-gray-700 border-gray-200 hover:bg-white hover:shadow-sm cursor-pointer"
                    }"
                    data-url="${prevUrl || ""}">
                    <i class="ph ph-caret-left mr-1"></i> Previous
                </button>
                <button id="next-page" ${!nextUrl ? "disabled" : ""} 
                    class="px-4 py-2 rounded-xl text-xs font-bold transition-all border ${
                        !nextUrl
                            ? "text-gray-300 border-gray-100 cursor-not-allowed"
                            : "text-gray-700 border-gray-200 hover:bg-white hover:shadow-sm cursor-pointer"
                    }"
                    data-url="${nextUrl || ""}">
                    Next <i class="ph ph-caret-right ml-1"></i>
                </button>
            </div>
        `;

        document.getElementById("prev-page")?.addEventListener("click", () => {
            if (prevUrl) fetchInventory(prevUrl);
        });

        document.getElementById("next-page")?.addEventListener("click", () => {
            if (nextUrl) fetchInventory(nextUrl);
        });
    }

    function renderEmptyTable(message) {
        tableBody.innerHTML = `<tr><td colspan="4" class="px-6 py-8 text-center text-gray-500 font-medium">${message}</td></tr>`;
    }

    function renderLogsTable(logs) {
        const tbody = document.getElementById("logs-table-body");
        if (!logs || logs.length === 0) {
            tbody.innerHTML =
                '<tr><td colspan="4" class="px-6 py-8 text-center text-gray-500 font-medium">No history found for this item.</td></tr>';
            return;
        }

        tbody.innerHTML = logs
            .map((log) => {
                // Adjust coloring based on log type
                const typeClass =
                    log.type === "In"
                        ? "text-green-600 bg-green-50"
                        : "text-red-600 bg-red-50";

                // Format Date safely
                const dateStr = log.created_at
                    ? new Date(log.created_at).toLocaleString()
                    : "-";

                return `
            <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors">
                <td class="px-6 py-4"><span class="px-2.5 py-1 rounded-md text-xs font-bold ${typeClass}">${
                    log.type || "-"
                }</span></td>
                <td class="px-6 py-4 font-bold text-gray-800">${
                    log.quantity || "-"
                }</td>
                <td class="px-6 py-4 text-gray-600 font-medium">${
                    log.action || "-"
                }</td>
                <td class="px-6 py-4 text-gray-400 text-xs">${dateStr}</td>
            </tr>
            `;
            })
            .join("");
    }

    function renderInventoryTable(items) {
        tableBody.innerHTML = "";
        if (!items || items.length === 0) {
            renderEmptyTable(
                `No ${currentView === "trashed" ? "trashed " : ""}items found.`
            );
            return;
        }

        items.forEach((item) => {
            const isLow =
                parseFloat(item.current_stock) <= parseFloat(item.alert);
            const badgeClass =
                currentView === "trashed"
                    ? "bg-gray-100 text-gray-500"
                    : isLow
                    ? "bg-red-50 text-red-600"
                    : "bg-gray-100 text-gray-800";
            const rowClass =
                currentView === "trashed"
                    ? "opacity-75 bg-gray-50/50"
                    : "bg-white hover:bg-gray-50";

            let stockDisplay = "";
            let actionButtons = "";

            if (currentView === "active") {
                stockDisplay = `
                    <div class="flex items-center gap-2">
                        <button class="btn-deduct-stock w-7 h-7 flex items-center justify-center bg-red-100 text-red-600 rounded-full hover:bg-red-200 transition-colors cursor-pointer font-bold text-lg leading-none" data-id="${item.id}">-</button>
                        <span class="px-3 py-1 rounded-full text-xs font-bold ${badgeClass} min-w-10 text-center">${item.current_stock}</span>
                        <button class="btn-add-stock w-7 h-7 flex items-center justify-center bg-green-100 text-green-600 rounded-full hover:bg-green-200 transition-colors cursor-pointer font-bold text-lg leading-none" data-id="${item.id}">+</button>
                    </div>
                `;

                actionButtons = `
                    <button class="btn-logs text-blue-600 bg-blue-50 hover:bg-blue-100 px-3 py-1.5 rounded-lg text-xs font-bold transition-colors cursor-pointer mr-1.5" data-id="${item.id}">Logs</button>
                    <button class="btn-edit text-teal-700 bg-teal-50 hover:bg-teal-100 px-3 py-1.5 rounded-lg text-xs font-bold transition-colors cursor-pointer mr-1.5" data-id="${item.id}">Edit</button>
                    <button class="btn-delete text-red-600 bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-lg text-xs font-bold transition-colors cursor-pointer" data-id="${item.id}">Trash</button>
                `;
            } else {
                stockDisplay = `<span class="px-3 py-1 rounded-full text-xs font-bold ${badgeClass}">${item.current_stock}</span>`;

                actionButtons = `
                    <button class="btn-restore text-green-700 bg-green-50 hover:bg-green-100 px-3 py-1.5 rounded-lg text-xs font-bold transition-colors cursor-pointer mr-2" data-id="${item.id}">Restore</button>
                    <button class="btn-force-delete text-white bg-red-500 hover:bg-red-600 px-3 py-1.5 rounded-lg text-xs font-bold transition-colors cursor-pointer" data-id="${item.id}">Delete</button>
                `;
            }

            const tr = document.createElement("tr");
            tr.className = `border-b border-gray-100 transition-colors text-gray-800 font-medium ${rowClass}`;
            tr.innerHTML = `
                <td class="px-6 py-4">${
                    item.name || item.item_name
                } <span class="text-xs text-gray-400 ml-1">(${
                item.unit
            })</span></td>
                <td class="px-6 py-4">${stockDisplay}</td>
                <td class="px-6 py-4 text-gray-500">${
                    item.alert || item.alert_level
                }</td>
                <td class="px-6 py-4 text-right flex justify-end gap-2">${actionButtons}</td>
            `;
            tableBody.appendChild(tr);
        });
        bindTableEvents();
    }

    /* ==========================================================================
       5. TAB & GLOBAL ACTION LISTENERS
       ========================================================================== */
    function switchTab(view) {
        currentView = view;
        if (view === "active") {
            document.getElementById("TabActiveItems").className =
                "flex-1 md:w-32 py-1.5 px-3 rounded-lg bg-white shadow-sm text-sm font-bold text-gray-800 transition-all cursor-pointer";
            document.getElementById("TabTrashedItems").className =
                "flex-1 md:w-32 py-1.5 px-3 rounded-lg text-sm font-medium text-gray-500 hover:text-gray-700 transition-all cursor-pointer";
            fetchInventory("/inventory");
        } else {
            document.getElementById("TabTrashedItems").className =
                "flex-1 md:w-32 py-1.5 px-3 rounded-lg bg-white shadow-sm text-sm font-bold text-gray-800 transition-all cursor-pointer";
            document.getElementById("TabActiveItems").className =
                "flex-1 md:w-32 py-1.5 px-3 rounded-lg text-sm font-medium text-gray-500 hover:text-gray-700 transition-all cursor-pointer";
            fetchInventory("/inventory/trashed");
        }
    }

    document
        .getElementById("TabActiveItems")
        ?.addEventListener("click", () => switchTab("active"));
    document
        .getElementById("TabTrashedItems")
        ?.addEventListener("click", () => switchTab("trashed"));

    if (searchInput) {
        searchInput.addEventListener("keyup", (e) => {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                const q = e.target.value.trim();
                fetchInventory(
                    q
                        ? `/inventory/search/${q}`
                        : currentView === "trashed"
                        ? "/inventory/trashed"
                        : "/inventory"
                );
            }, 300);
        });
    }

    document.getElementById("BtnFetchAlerts")?.addEventListener("click", () => {
        switchTab("active");
        fetchInventory("/inventory/alerts");
    });

    document.getElementById("BtnExportPdf")?.addEventListener("click", () => {
        window.open("/inventory/export-pdf", "_blank");
    });

    document
        .getElementById("BtnOpenAddInventory")
        ?.addEventListener("click", () => {
            openInvModal("AddInventoryModalBackdrop", "AddInventoryModal");
        });

    /* ==========================================================================
       6. MODAL FORM SUBMISSIONS (PRESERVES PAGINATION)
       ========================================================================== */
    document
        .getElementById("SaveInventoryBtn")
        ?.addEventListener("click", async (e) => {
            const btn = e.target;
            btn.disabled = true;
            btn.innerText = "Saving...";

            const payload = {
                name: document.getElementById("addInvName").value,
                unit: document.getElementById("addInvUnit").value,
                initial_stock: document.getElementById("addInvStock").value,
                alert: document.getElementById("addInvAlert").value,
            };

            try {
                const res = await fetch("/inventory/add", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        Accept: "application/json",
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    body: JSON.stringify(payload),
                });
                const result = await res.json();
                if (res.ok) {
                    closeInvModal(
                        "AddInventoryModalBackdrop",
                        "AddInventoryModal",
                        "AddInventoryForm",
                        "AddInv"
                    );
                    fetchInventory(currentFetchUrl); // Refresh current view
                } else if (res.status === 422) {
                    showInvErrors(result.errors, "AddInv");
                }
            } finally {
                btn.disabled = false;
                btn.innerText = "Save Item";
            }
        });

    document
        .getElementById("UpdateInventoryBtn")
        ?.addEventListener("click", async (e) => {
            const id = document.getElementById("editInvId").value;
            const btn = e.target;
            btn.disabled = true;
            btn.innerText = "Updating...";

            const payload = {
                name: document.getElementById("editInvName").value,
                unit: document.getElementById("editInvUnit").value,
                alert: document.getElementById("editInvAlert").value,
                _method: "PUT",
            };

            try {
                const res = await fetch(`/inventory/${id}/edit`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        Accept: "application/json",
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    body: JSON.stringify(payload),
                });
                const result = await res.json();
                if (res.ok) {
                    closeInvModal(
                        "EditInventoryModalBackdrop",
                        "EditInventoryModal",
                        "EditInventoryForm",
                        "EditInv"
                    );
                    fetchInventory(currentFetchUrl); // Refresh current view
                } else if (res.status === 422) {
                    showInvErrors(result.errors, "EditInv");
                }
            } finally {
                btn.disabled = false;
                btn.innerText = "Update Item";
            }
        });

    document
        .getElementById("SubmitModifyStockBtn")
        ?.addEventListener("click", async (e) => {
            const id = document.getElementById("modifyStockId").value;
            const type = document.getElementById("modifyStockType").value;
            const btn = e.target;
            btn.disabled = true;
            btn.innerText = "Processing...";

            const payload = {
                stock: document.getElementById("modifyStockQty").value,
                action: document.getElementById("modifyStockReason").value,
                _method: "PUT",
            };

            const endpoint =
                type === "add"
                    ? `/inventory/${id}/add-stock`
                    : `/inventory/${id}/deduct-stock`;

            try {
                const res = await fetch(endpoint, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        Accept: "application/json",
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    body: JSON.stringify(payload),
                });
                const result = await res.json();
                if (res.ok) {
                    closeInvModal(
                        "ModifyStockModalBackdrop",
                        "ModifyStockModal",
                        "ModifyStockForm",
                        "ModifyStock"
                    );
                    fetchInventory(currentFetchUrl); // Refresh current view
                } else if (res.status === 422) {
                    showInvErrors(result.errors, "ModifyStock");
                }
            } finally {
                btn.disabled = false;
                btn.innerText = "Confirm";
            }
        });

    /* ==========================================================================
       7. TABLE ROW ACTION EVENTS (LOGS, EDIT, ADD, DEDUCT, TRASH)
       ========================================================================== */
    function bindTableEvents() {
        // Logs Handler
        document.querySelectorAll(".btn-logs").forEach((btn) => {
            btn.addEventListener("click", async () => {
                const id = btn.getAttribute("data-id");

                openInvModal(
                    "InventoryLogsModalBackdrop",
                    "InventoryLogsModal"
                );
                document.getElementById("logs-table-body").innerHTML =
                    '<tr><td colspan="4" class="px-6 py-8 text-center text-gray-500"><i class="ph-bold ph-spinner animate-spin text-2xl mb-2 text-blue-500 block"></i> Loading history...</td></tr>';

                try {
                    const res = await fetch(`/inventory/${id}/logs`, {
                        headers: { Accept: "application/json" },
                    });
                    const result = await res.json();

                    if (res.ok) {
                        const logs = result.data || result;
                        renderLogsTable(logs);
                    } else {
                        document.getElementById("logs-table-body").innerHTML =
                            '<tr><td colspan="4" class="px-6 py-6 text-center text-red-500">Failed to load history.</td></tr>';
                    }
                } catch (e) {
                    console.error("Error fetching logs:", e);
                    document.getElementById("logs-table-body").innerHTML =
                        '<tr><td colspan="4" class="px-6 py-6 text-center text-red-500">Error loading data.</td></tr>';
                }
            });
        });

        // Edit Handler
        document.querySelectorAll(".btn-edit").forEach((btn) => {
            btn.addEventListener("click", async () => {
                const id = btn.getAttribute("data-id");
                try {
                    const res = await fetch(`/inventory/${id}`, {
                        headers: { Accept: "application/json" },
                    });
                    const result = await res.json();

                    if (res.ok) {
                        const item = result.data || result;
                        document.getElementById("editInvId").value = item.id;
                        document.getElementById("editInvName").value =
                            item.name || item.item_name;
                        document.getElementById("editInvUnit").value =
                            item.unit;
                        document.getElementById("editInvStock").value =
                            item.current_stock;
                        document.getElementById("editInvAlert").value =
                            item.alert || item.alert_level;

                        openInvModal(
                            "EditInventoryModalBackdrop",
                            "EditInventoryModal"
                        );
                    }
                } catch (e) {
                    console.error("Error fetching item to edit:", e);
                }
            });
        });

        // Stock Modify Handlers
        document.querySelectorAll(".btn-add-stock").forEach((btn) => {
            btn.addEventListener("click", () =>
                setupModifyStockModal(btn.getAttribute("data-id"), "add")
            );
        });

        document.querySelectorAll(".btn-deduct-stock").forEach((btn) => {
            btn.addEventListener("click", () =>
                setupModifyStockModal(btn.getAttribute("data-id"), "deduct")
            );
        });

        // Delete/Trash Handler
        document.querySelectorAll(".btn-delete").forEach((btn) => {
            btn.addEventListener("click", async function () {
                const id = btn.getAttribute("data-id");
                if (!btn.classList.contains("confirming")) {
                    const originalText = btn.innerText;
                    btn.innerText = `Sure?`;
                    btn.classList.add("confirming", "bg-red-600", "text-white");
                    setTimeout(() => {
                        if (document.body.contains(btn)) {
                            btn.innerText = originalText;
                            btn.classList.remove(
                                "confirming",
                                "bg-red-600",
                                "text-white"
                            );
                        }
                    }, 3000);
                    return;
                }
                try {
                    const res = await fetch(`/inventory/${id}`, {
                        method: "DELETE",
                        headers: {
                            Accept: "application/json",
                            "X-CSRF-TOKEN": csrfToken,
                        },
                    });
                    if (res.ok) fetchInventory(currentFetchUrl);
                } catch (e) {}
            });
        });

        // Restore Handler
        document.querySelectorAll(".btn-restore").forEach((btn) => {
            btn.addEventListener("click", async function () {
                const id = btn.getAttribute("data-id");
                try {
                    const res = await fetch(`/inventory/${id}/restore`, {
                        method: "POST",
                        headers: {
                            Accept: "application/json",
                            "X-CSRF-TOKEN": csrfToken,
                        },
                    });
                    if (res.ok) fetchInventory(currentFetchUrl);
                } catch (e) {}
            });
        });

        // Force Delete Handler
        document.querySelectorAll(".btn-force-delete").forEach((btn) => {
            btn.addEventListener("click", async function () {
                const id = btn.getAttribute("data-id");
                if (!btn.classList.contains("confirming")) {
                    const originalText = btn.innerText;
                    btn.innerText = `Sure?`;
                    btn.classList.add("confirming", "bg-red-800", "text-white");
                    setTimeout(() => {
                        if (document.body.contains(btn)) {
                            btn.innerText = originalText;
                            btn.classList.remove(
                                "confirming",
                                "bg-red-800",
                                "text-white"
                            );
                        }
                    }, 3000);
                    return;
                }
                try {
                    const res = await fetch(`/inventory/${id}/force`, {
                        method: "DELETE",
                        headers: {
                            Accept: "application/json",
                            "X-CSRF-TOKEN": csrfToken,
                        },
                    });
                    if (res.ok) fetchInventory(currentFetchUrl);
                } catch (e) {}
            });
        });
    }

    function setupModifyStockModal(id, type) {
        document.getElementById("modifyStockId").value = id;
        document.getElementById("modifyStockType").value = type;

        const title = document.getElementById("ModifyStockTitle");
        const submitBtn = document.getElementById("SubmitModifyStockBtn");

        if (type === "add") {
            title.innerText = "Add Incoming Stock";
            submitBtn.className =
                "bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg text-sm font-bold transition-colors cursor-pointer";
            document.getElementById("modifyStockReason").placeholder =
                "e.g. Received shipment";
        } else {
            title.innerText = "Deduct Stock";
            submitBtn.className =
                "bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-lg text-sm font-bold transition-colors cursor-pointer";
            document.getElementById("modifyStockReason").placeholder =
                "e.g. Expired, consumed";
        }

        openInvModal("ModifyStockModalBackdrop", "ModifyStockModal");
    }

    /* ==========================================================================
       8. CLOSE MODAL TRIGGERS
       ========================================================================== */
    const closeTriggers = [
        {
            btn: "CloseAddInventoryX",
            back: "AddInventoryModalBackdrop",
            mod: "AddInventoryModal",
            form: "AddInventoryForm",
            pref: "AddInv",
        },
        {
            btn: "CloseAddInventoryBtn",
            back: "AddInventoryModalBackdrop",
            mod: "AddInventoryModal",
            form: "AddInventoryForm",
            pref: "AddInv",
        },
        {
            btn: "CloseEditInventoryX",
            back: "EditInventoryModalBackdrop",
            mod: "EditInventoryModal",
            form: "EditInventoryForm",
            pref: "EditInv",
        },
        {
            btn: "CloseEditInventoryBtn",
            back: "EditInventoryModalBackdrop",
            mod: "EditInventoryModal",
            form: "EditInventoryForm",
            pref: "EditInv",
        },
        {
            btn: "CloseModifyStockX",
            back: "ModifyStockModalBackdrop",
            mod: "ModifyStockModal",
            form: "ModifyStockForm",
            pref: "ModifyStock",
        },
        {
            btn: "CloseModifyStockBtn",
            back: "ModifyStockModalBackdrop",
            mod: "ModifyStockModal",
            form: "ModifyStockForm",
            pref: "ModifyStock",
        },
        {
            btn: "CloseLogsX",
            back: "InventoryLogsModalBackdrop",
            mod: "InventoryLogsModal",
            form: null,
            pref: null,
        },
    ];

    closeTriggers.forEach((t) => {
        document
            .getElementById(t.btn)
            ?.addEventListener("click", () =>
                closeInvModal(t.back, t.mod, t.form, t.pref)
            );
    });
});
