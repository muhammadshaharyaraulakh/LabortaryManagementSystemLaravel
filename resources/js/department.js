document.addEventListener("DOMContentLoaded", () => {
    // ==========================================
    // 1. DOM ELEMENTS & INITIALIZATION
    // ==========================================
    const addDepartmentBackdrop = document.getElementById(
        "AddDepartmentModalBackdrop"
    );
    const addDepartmentModal = document.getElementById("AddDepartmentModal");
    const updateDepartmentBackdrop = document.getElementById(
        "UpdateDepartmentModalBackdrop"
    );
    const updateDepartmentModal = document.getElementById(
        "UpdateDepartmentModal"
    );

    const listContainer = document.getElementById("list-department");
    const deletedListContainer = document.getElementById(
        "list-deleted-department"
    );
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    const viewDeletedBtn = document.getElementById(
        "view-deleted-departments-btn"
    );
    const backToDeptBtn = document.getElementById("back-to-departments-btn");

    // ==========================================
    // 2. MODAL MANAGEMENT HELPERS
    // ==========================================
    function openModal(backdrop, modal) {
        if (!backdrop || !modal) return;
        backdrop.classList.remove("hidden");
        backdrop.classList.add("flex");
        setTimeout(() => {
            backdrop.classList.remove("opacity-0");
            backdrop.classList.add("opacity-100");
            modal.classList.remove("scale-95");
            modal.classList.add("scale-100");
        }, 10);
    }

    function closeModal(backdrop, modal, formId) {
        if (!backdrop || !modal) return;
        backdrop.classList.remove("opacity-100");
        backdrop.classList.add("opacity-0");
        modal.classList.remove("scale-100");
        modal.classList.add("scale-95");
        setTimeout(() => {
            backdrop.classList.add("hidden");
            backdrop.classList.remove("flex");
            if (formId) {
                const form = document.getElementById(formId);
                if (form) form.reset();
                clearDepartmentErrors(
                    formId === "AddDepartmentForm" ? "add" : "update"
                );
            }
        }, 300);
    }

    // ==========================================
    // 3. FORM ERROR HANDLING
    // ==========================================
    function clearDepartmentErrors(prefix) {
        document
            .querySelectorAll(
                `[id^="error${prefix === "add" ? "Add" : "Update"}Department"]`
            )
            .forEach((el) => {
                el.classList.add("hidden");
                el.innerText = "";
            });
        document
            .querySelectorAll(
                `#${
                    prefix === "add" ? "Add" : "Update"
                }DepartmentForm input, #${
                    prefix === "add" ? "Add" : "Update"
                }DepartmentForm select`
            )
            .forEach((el) => {
                el.classList.remove("border-red-500", "focus:ring-red-200");
            });
    }

    function showDepartmentErrors(errors, prefix) {
        clearDepartmentErrors(prefix);
        const fieldMap = {
            name: `${prefix}DepartmentName`,
            type: `${prefix}DepartmentType`,
            is_active: `${prefix}DepartmentIsActive`,
        };

        for (const [field, messages] of Object.entries(errors)) {
            const inputId = fieldMap[field];
            const errorId = `error${
                inputId.charAt(0).toUpperCase() + inputId.slice(1)
            }`;
            const inputEl = document.getElementById(inputId);
            const errorEl = document.getElementById(errorId);

            if (errorEl) {
                errorEl.innerText = messages[0];
                errorEl.classList.remove("hidden");
            }
            if (inputEl && inputEl.type !== "checkbox") {
                inputEl.classList.add("border-red-500", "focus:ring-red-200");
            }
        }
    }

    // ==========================================
    // 4. STATIC EVENT LISTENERS (Navigation & Modals)
    // ==========================================
    const openAddDepartmentBtn = document.getElementById(
        "open-department-modal"
    );
    if (openAddDepartmentBtn) {
        openAddDepartmentBtn.addEventListener("click", () => {
            openModal(addDepartmentBackdrop, addDepartmentModal);
        });
    }

    document
        .getElementById("CloseAddDepartmentX")
        ?.addEventListener("click", () =>
            closeModal(
                addDepartmentBackdrop,
                addDepartmentModal,
                "AddDepartmentForm"
            )
        );
    document
        .getElementById("CloseAddDepartmentBtn")
        ?.addEventListener("click", () =>
            closeModal(
                addDepartmentBackdrop,
                addDepartmentModal,
                "AddDepartmentForm"
            )
        );
    document
        .getElementById("CloseUpdateDepartmentX")
        ?.addEventListener("click", () =>
            closeModal(
                updateDepartmentBackdrop,
                updateDepartmentModal,
                "UpdateDepartmentForm"
            )
        );
    document
        .getElementById("CloseUpdateDepartmentBtn")
        ?.addEventListener("click", () =>
            closeModal(
                updateDepartmentBackdrop,
                updateDepartmentModal,
                "UpdateDepartmentForm"
            )
        );

    const departmentNavLink = document.querySelector(
        '.nav-link[data-target="section-department"]'
    );
    if (departmentNavLink) {
        departmentNavLink.addEventListener("click", () => {
            const secDeleted = document.getElementById("section-deleted-departments");
            const secDept = document.getElementById("section-department");
            if (secDeleted) {
                secDeleted.classList.add("hidden");
                secDeleted.classList.remove("block");
            }
            if (secDept) {
                secDept.classList.remove("hidden");
                secDept.classList.add("block");
            }

            if (listContainer) {
                listContainer.innerHTML = `<div class="text-center text-gray-500 py-4"><i class="ph ph-spinner animate-spin text-xl"></i> Loading...</div>`;
            }
            fetchDepartments();
        });
    }

    if (viewDeletedBtn) {
        viewDeletedBtn.addEventListener("click", () => {
            const secDeleted = document.getElementById("section-deleted-departments");
            const secDept = document.getElementById("section-department");
            if (secDept) {
                secDept.classList.add("hidden");
                secDept.classList.remove("block");
            }
            if (secDeleted) {
                secDeleted.classList.remove("hidden");
                secDeleted.classList.add("block");
            }

            if (deletedListContainer) {
                deletedListContainer.innerHTML = `<div class="text-center text-gray-500 py-4"><i class="ph ph-spinner animate-spin text-xl"></i> Loading...</div>`;
            }
            fetchDeletedDepartments();
        });
    }

    if (backToDeptBtn) {
        backToDeptBtn.addEventListener("click", () => {
            const secDeleted = document.getElementById("section-deleted-departments");
            const secDept = document.getElementById("section-department");
            if (secDeleted) {
                secDeleted.classList.add("hidden");
                secDeleted.classList.remove("block");
            }
            if (secDept) {
                secDept.classList.remove("hidden");
                secDept.classList.add("block");
            }

            fetchDepartments();
        });
    }

    // ==========================================
    // 5. API FETCH FUNCTIONS
    // ==========================================
    async function fetchDepartments() {
        try {
            const response = await fetch("/departments", {
                headers: { Accept: "application/json" },
            });
            const result = await response.json();

            if (response.ok) {
                const departmentsData = Array.isArray(result)
                    ? result
                    : result.data || [];
                renderDepartments(departmentsData);
            } else {
                listContainer.innerHTML = `<div class="w-full text-center text-gray-500 py-6 font-medium bg-white rounded-xl border border-gray-100">Failed to load departments.</div>`;
            }
        } catch (error) {
            console.error("Error fetching departments:", error);
            listContainer.innerHTML = `<div class="w-full text-center text-red-500 py-6 font-medium bg-white rounded-xl border border-gray-100">Error loading data.</div>`;
        }
    }

    async function fetchDeletedDepartments() {
        try {
            const response = await fetch("/departments/trashed", {
                headers: { Accept: "application/json" },
            });
            const result = await response.json();

            if (response.ok) {
                const deletedData = Array.isArray(result)
                    ? result
                    : result.data || [];
                renderDeletedDepartments(deletedData);
            } else {
                deletedListContainer.innerHTML = `<div class="w-full text-center text-gray-500 py-6 font-medium bg-white rounded-xl border border-gray-100">Failed to load deleted departments.</div>`;
            }
        } catch (error) {
            console.error("Error fetching deleted departments:", error);
            deletedListContainer.innerHTML = `<div class="w-full text-center text-red-500 py-6 font-medium bg-white rounded-xl border border-gray-100">Error loading data.</div>`;
        }
    }

    // ==========================================
    // 6. UI RENDERING FUNCTIONS
    // ==========================================
    function renderDepartments(departments) {
        listContainer.innerHTML = "";
        if (!departments || departments.length === 0) {
            listContainer.innerHTML = `<div class="w-full text-center text-gray-500 py-6 font-medium bg-white rounded-xl border border-gray-100 shadow-sm">No active departments found.</div>`;
            return;
        }

        departments.forEach((dept) => {
            const isActive = dept.is_active == 1;
            const statusColor = isActive
                ? "text-green-600 bg-green-50"
                : "text-red-600 bg-red-50";
            const statusText = isActive ? "Active" : "Inactive";
            const typeFormatted =
                dept.type === "sample_based" ? "Sample Based" : "Human Based";
            const testsCount = dept.tests_count || 0;
            const usersCount = dept.users_count || 0;

            const row = `
            <div class="w-full bg-white shadow-[0_2px_8px_rgba(0,0,0,0.02)] border border-gray-100 rounded-xl p-3 sm:p-4 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 hover:border-blue-100 transition-colors">
                
                <div class="flex items-center gap-4 w-full sm:w-auto">
                    <div class="w-10 h-10 rounded-lg bg-orange-50 border border-orange-50 text-orange-500 flex items-center justify-center shrink-0">
                        <i class="ph-duotone ph-buildings text-xl"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 text-[15px] leading-tight" title="${dept.name}">${dept.name}</h4>
                        <div class="flex flex-wrap items-center gap-2 mt-1.5">
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wide bg-gray-100 text-gray-600">${typeFormatted}</span>
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wide ${statusColor}">${statusText}</span>
                        </div>
                    </div>
                </div>
                
                <div class="flex items-center justify-between sm:justify-end gap-6 w-full sm:w-auto shrink-0">
                    <div class="flex gap-4 sm:gap-6 text-sm text-center">
                        <div class="flex flex-col items-center">
                            <span class="text-gray-400 text-[10px] font-bold uppercase tracking-wide">Tests</span>
                            <span class="font-bold text-gray-800">${testsCount}</span>
                        </div>
                        <div class="w-px bg-gray-200"></div>
                        <div class="flex flex-col items-center">
                            <span class="text-gray-400 text-[10px] font-bold uppercase tracking-wide">Users</span>
                            <span class="font-bold text-gray-800">${usersCount}</span>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-2 ml-2 sm:ml-4 border-l border-gray-100 pl-4 sm:pl-6">
                                       <button class="px-3 py-1.5 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 text-xs font-bold transition-colors cursor-pointer" onclick="editDepartment(${dept.id})" title="Edit">
    Edit
</button>

<button class="px-3 py-1.5 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 text-xs font-bold transition-colors cursor-pointer" onclick="deleteDepartment(${dept.id})" title="Delete">
    Delete
</button>
                    </div>
                </div>
            </div>`;
            listContainer.insertAdjacentHTML("beforeend", row);
        });
    }

    function renderDeletedDepartments(departments) {
        deletedListContainer.innerHTML = "";
        if (!departments || departments.length === 0) {
            deletedListContainer.innerHTML = `<div class="w-full text-center text-gray-500 py-6 font-medium bg-white rounded-xl border border-gray-100 shadow-sm">No deleted departments found.</div>`;
            return;
        }

        departments.forEach((dept) => {
            const typeFormatted =
                dept.type === "sample_based" ? "Sample Based" : "Human Based";

            const row = `
            <div class="w-full bg-red-50/30 border border-red-100 rounded-xl p-3 sm:p-4 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                
                <div class="flex items-center gap-4 w-full sm:w-auto">
                    <div class="w-10 h-10 rounded-lg bg-white border border-red-100 text-red-400 flex items-center justify-center shrink-0">
                        <i class="ph-duotone ph-trash text-xl"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-800 text-[15px] leading-tight  opacity-80" title="${dept.name}">${dept.name}</h4>
                        <div class="flex items-center gap-2 mt-1.5">
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wide bg-white border border-gray-200 text-gray-500">${typeFormatted}</span>
                        </div>
                    </div>
                </div>
                
                <div class="flex items-center justify-end w-full sm:w-auto shrink-0">
                    <button class="w-full sm:w-auto px-4 py-2 rounded-lg bg-green-50 text-green-700 hover:bg-green-100 text-sm font-bold flex items-center justify-center gap-2 transition-colors cursor-pointer" onclick="restoreDepartment(${dept.id})">
                        Restore
                    </button>
                </div>
            </div>`;
            deletedListContainer.insertAdjacentHTML("beforeend", row);
        });
    }

    // ==========================================
    // 7. CRUD ACTIONS & GLOBAL LISTENERS
    // ==========================================
    document
        .getElementById("SaveDepartmentBtn")
        ?.addEventListener("click", async () => {
            const payload = {
                name: document.getElementById("addDepartmentName").value,
                type: document.getElementById("addDepartmentType").value,
                is_active: document.getElementById("addDepartmentIsActive")
                    .checked
                    ? 1
                    : 0,
            };

            const saveBtn = document.getElementById("SaveDepartmentBtn");
            saveBtn.disabled = true;
            saveBtn.innerText = "Saving...";

            try {
                const response = await fetch("/departments", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        Accept: "application/json",
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    body: JSON.stringify(payload),
                });
                const result = await response.json();

                if (response.ok) {
                    closeModal(
                        addDepartmentBackdrop,
                        addDepartmentModal,
                        "AddDepartmentForm"
                    );
                    fetchDepartments();
                } else if (response.status === 422) {
                    showDepartmentErrors(result.errors, "add");
                }
            } finally {
                saveBtn.disabled = false;
                saveBtn.innerText = "Save Department";
            }
        });

    window.editDepartment = async function (id) {
        try {
            const response = await fetch(`/departments/${id}`, {
                headers: { Accept: "application/json" },
            });
            const result = await response.json();

            if (response.ok) {
                const dept = result.data || result.department || result;

                document.getElementById("updateDepartmentId").value = dept.id;
                document.getElementById("updateDepartmentName").value =
                    dept.name;
                document.getElementById("updateDepartmentType").value =
                    dept.type;
                document.getElementById("updateDepartmentIsActive").checked =
                    dept.is_active == 1 || dept.is_active === true;

                openModal(updateDepartmentBackdrop, updateDepartmentModal);
            } else {
                console.error(
                    "Failed to load department details. Status:",
                    response.status
                );
            }
        } catch (error) {
            console.error("Error fetching department for edit:", error);
        }
    };

    document
        .getElementById("UpdateDepartmentBtn")
        ?.addEventListener("click", async () => {
            const id = document.getElementById("updateDepartmentId").value;
            const payload = {
                name: document.getElementById("updateDepartmentName").value,
                type: document.getElementById("updateDepartmentType").value,
                is_active: document.getElementById("updateDepartmentIsActive")
                    .checked
                    ? 1
                    : 0,
            };

            const updateBtn = document.getElementById("UpdateDepartmentBtn");
            updateBtn.disabled = true;
            updateBtn.innerText = "Updating...";

            try {
                const response = await fetch(`/departments/${id}`, {
                    method: "PUT",
                    headers: {
                        "Content-Type": "application/json",
                        Accept: "application/json",
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    body: JSON.stringify(payload),
                });
                const result = await response.json();

                if (response.ok) {
                    closeModal(
                        updateDepartmentBackdrop,
                        updateDepartmentModal,
                        "UpdateDepartmentForm"
                    );
                    fetchDepartments();
                } else if (response.status === 422) {
                    showDepartmentErrors(result.errors, "update");
                }
            } finally {
                updateBtn.disabled = false;
                updateBtn.innerText = "Update Department";
            }
        });

    window.deleteDepartment = async function (id) {
        try {
            const response = await fetch(`/departments/${id}`, {
                method: "DELETE",
                headers: {
                    Accept: "application/json",
                    "X-CSRF-TOKEN": csrfToken,
                },
            });

            if (response.ok) {
                fetchDepartments();
            } else {
                alert("Failed to delete department.");
            }
        } catch (error) {
            console.error("Error deleting department:", error);
            alert("An error occurred while deleting the department.");
        }
    };

    window.restoreDepartment = async function (id) {
        try {
            const response = await fetch(`/departments/${id}/restore`, {
                method: "PUT",
                headers: {
                    Accept: "application/json",
                    "X-CSRF-TOKEN": csrfToken,
                },
            });

            if (response.ok) {
                fetchDeletedDepartments();
            } else {
                alert("Failed to restore department.");
            }
        } catch (error) {
            console.error("Error restoring department:", error);
            alert("An error occurred while restoring the department.");
        }
    };
});
