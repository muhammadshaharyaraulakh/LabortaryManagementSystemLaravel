document.addEventListener("DOMContentLoaded", () => {
    // ==========================================
    // 1. GLOBAL VARIABLES & INITIALIZATION
    // ==========================================
    const addUserBackdrop = document.getElementById("AddUserModalBackdrop");
    const addUserModal = document.getElementById("AddUserModal");
    const updateUserBackdrop = document.getElementById(
        "UpdateUserModalBackdrop"
    );
    const updateUserModal = document.getElementById("UpdateUserModal");
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    // ==========================================
    // 2. DYNAMIC LOADING & NAVIGATION STATE
    // ==========================================
    // Track current view to refresh grids after adding/editing/deleting
    let currentActiveRole = null;
    let currentActiveGrid = null;

    const roleSectionMap = {
        "section-doctor": { role: "Pathologist", gridId: "grid-pathologist" },
        "section-sample-collector": {
            role: "SampleCollector",
            gridId: "grid-sample-collector",
        },
        "section-technician": { role: "Technician", gridId: "grid-technician" },
        "section-specialist": {
            role: "SpecialistDoctor",
            gridId: "grid-specialist",
        },
        "section-receptionist": {
            role: "Receptionist",
            gridId: "grid-receptionist",
        },
    };

    // Listen for clicks on the inner navigation (Staff Hub cards) to trigger data fetch
    document.querySelectorAll(".inner-nav-link").forEach((link) => {
        link.addEventListener("click", (e) => {
            const targetId = link.getAttribute("data-target");

            if (roleSectionMap[targetId]) {
                currentActiveRole = roleSectionMap[targetId].role;
                currentActiveGrid = roleSectionMap[targetId].gridId;
                fetchUsersByRole(currentActiveRole, currentActiveGrid);
            } else if (targetId === "section-deleted-users") {
                currentActiveRole = "deleted";
                currentActiveGrid = "grid-deleted-users";
                fetchAndPopulateDeletedUsers();
            } else {
                // If navigating back to main hub, clear tracking
                currentActiveRole = null;
                currentActiveGrid = null;
            }
        });
    });

    // Fetch specific role
    function fetchUsersByRole(role, containerId) {
        const container = document.getElementById(containerId);
        if (!container) return;

        // Show a loading spinner before data arrives
        container.innerHTML = `
            <div class="col-span-full flex flex-col items-center justify-center p-10 bg-white rounded-[1.25rem] border border-dashed border-gray-200">
                <i class="ph-bold ph-spinner animate-spin text-4xl text-blue-500 mb-2"></i>
                <p class="text-gray-500 font-medium">Loading...</p>
            </div>`;

        fetch(`/users/${role}`, { headers: { Accept: "application/json" } })
            .then((response) => response.json())
            .then((data) => {
                if (data.status === "success" && data.users) {
                    renderUserGrid(containerId, data.users);
                } else {
                    renderUserGrid(containerId, []);
                }
            })
            .catch(() => {
                renderUserGrid(containerId, []);
            });
    }

    // Helper to refresh the grid you are currently looking at after a CRUD operation
    function refreshCurrentGrid() {
        if (currentActiveRole === "deleted") {
            fetchAndPopulateDeletedUsers();
        } else if (currentActiveRole) {
            fetchUsersByRole(currentActiveRole, currentActiveGrid);
        }
    }

    // ==========================================
    // 3. MODAL & ERROR HANDLING
    // ==========================================
    function openModal(backdrop, modal) {
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
        backdrop.classList.remove("opacity-100");
        backdrop.classList.add("opacity-0");
        modal.classList.remove("scale-100");
        modal.classList.add("scale-95");
        setTimeout(() => {
            backdrop.classList.add("hidden");
            backdrop.classList.remove("flex");
            if (formId) {
                document.getElementById(formId).reset();
                clearUserErrors(formId === "AddUserForm" ? "add" : "update");

                if (formId === "AddUserForm") {
                    document
                        .getElementById("addUserImagePreview")
                        .classList.add("hidden");
                    document.getElementById("addUserImagePreview").src = "#";
                    document
                        .getElementById("addUserCameraIcon")
                        .classList.remove("hidden");
                }
            }
        }, 300);
    }

    function clearUserErrors(prefix) {
        document
            .querySelectorAll(
                `[id^="error${prefix === "add" ? "Add" : "Update"}User"]`
            )
            .forEach((el) => {
                el.classList.add("hidden");
                el.innerText = "";
            });
        document
            .querySelectorAll(
                `#${prefix === "add" ? "Add" : "Update"}UserForm input, #${
                    prefix === "add" ? "Add" : "Update"
                }UserForm select`
            )
            .forEach((el) => {
                el.classList.remove("border-red-500", "focus:ring-red-200");
            });
    }

    function showUserErrors(errors, prefix) {
        clearUserErrors(prefix);
        const fieldMap = {
            name: `${prefix}UserName`,
            email: `${prefix}UserEmail`,
            password: `${prefix}UserPassword`,
            role: `${prefix}UserRole`,
            department_id: `${prefix}UserDepartment`,
            image: `${prefix}UserImage`,
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
            if (inputEl && inputEl.type !== "file") {
                inputEl.classList.add("border-red-500", "focus:ring-red-200");
            }
        }
    }

    // Modal Trigger Listeners
    document.querySelectorAll(".open-user-modal-btn").forEach((btn) => {
        btn.addEventListener("click", () => {
            const role = btn.getAttribute("data-role");
            if (role) {
                document.getElementById("addUserRole").value = role;
            }
            openModal(addUserBackdrop, addUserModal);
        });
    });

    document
        .getElementById("CloseAddUserX")
        .addEventListener("click", () =>
            closeModal(addUserBackdrop, addUserModal, "AddUserForm")
        );
    document
        .getElementById("CloseAddUserBtn")
        .addEventListener("click", () =>
            closeModal(addUserBackdrop, addUserModal, "AddUserForm")
        );
    document
        .getElementById("CloseUpdateUserX")
        .addEventListener("click", () =>
            closeModal(updateUserBackdrop, updateUserModal, "UpdateUserForm")
        );
    document
        .getElementById("CloseUpdateUserBtn")
        .addEventListener("click", () =>
            closeModal(updateUserBackdrop, updateUserModal, "UpdateUserForm")
        );



    function renderUserGrid(containerId, users) {
        const container = document.getElementById(containerId);
        if (!container) return;

        if (users.length === 0) {
            container.innerHTML = `
                <div class="col-span-full flex flex-col items-center justify-center p-10 bg-white rounded-[1.25rem] border border-dashed border-gray-200">
                    <i class="ph-duotone ph-users text-4xl text-gray-300 mb-2"></i>
                    <p class="text-gray-500 font-medium">No staff members found.</p>
                </div>`;
            return;
        }

        container.innerHTML = users
            .map((user) => {
                // Updated to point directly to the public folder
                const imgTag = user.image
                    ? `<img src="/${user.image}" class="w-full h-full object-cover">`
                    : `<span class="text-2xl">${user.name
                          .charAt(0)
                          .toUpperCase()}</span>`;

                const deptName = user.department
                    ? user.department.name
                    : "General";

                return `
                <div class="user-card bg-white shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-100 rounded-[1.25rem] flex flex-col overflow-hidden text-center hover:shadow-lg transition-all duration-300">
                    <div class="h-24 bg-sidebarBg w-full"></div>
                    <div class="mx-auto -mt-12 w-24 h-24 rounded-full border-4 border-sidebarBg bg-gray-100 text-gray-500 flex items-center justify-center font-bold overflow-hidden shadow-sm relative z-10">
                        ${imgTag}
                    </div>
                    <div class="p-5 grow flex flex-col items-center">
                        <h4 class="font-black text-gray-900 text-lg truncate w-full" title="${user.name}">${user.name}</h4>
                        <p class="text-sm font-medium text-gray-500 truncate w-full mb-1" title="${user.email}">${user.email}</p>
                        <span class="inline-block mt-2 text-[10px] uppercase font-bold text-blue-600 bg-blue-50 px-3 py-1 rounded-full tracking-wide">
                            ${deptName}
                        </span>
                    </div>
                    <div class="flex items-center border-t border-gray-100 mt-auto">
                        <button class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-800 py-3.5 rounded-none text-sm font-bold transition-colors cursor-pointer" onclick="editUser(${user.id})">Edit</button>
                        <button class="flex-1 bg-sidebarBg hover:bg-gray-800 text-white py-3.5 rounded-none text-sm font-bold transition-colors cursor-pointer" onclick="deleteUser(${user.id}, this)">Delete</button>
                    </div>
                </div>
            `;
            })
            .join("");
    }

    function fetchAndPopulateDeletedUsers() {
        const container = document.getElementById("grid-deleted-users");
        if (container) {
            container.innerHTML = `
                <div class="col-span-full flex flex-col items-center justify-center p-10 bg-white rounded-[1.25rem] border border-dashed border-gray-200">
                    <i class="ph-bold ph-spinner animate-spin text-4xl text-red-500 mb-2"></i>
                    <p class="text-gray-500 font-medium">Loading deleted staff...</p>
                </div>`;
        }

        fetch("/deletedusers", { headers: { Accept: "application/json" } })
            .then((response) => response.json())
            .then((data) => {
                if (data.status === "success") {
                    renderDeletedUserGrid("grid-deleted-users", data.users);
                } else {
                    renderDeletedUserGrid("grid-deleted-users", []);
                }
            })
            .catch((err) => {
                renderDeletedUserGrid("grid-deleted-users", []);
            });
    }

    function renderDeletedUserGrid(containerId, users) {
        const container = document.getElementById(containerId);
        if (!container) return;

        if (users.length === 0) {
            container.innerHTML = `
                <div class="col-span-full flex flex-col items-center justify-center p-10 bg-white rounded-[1.25rem] border border-dashed border-gray-200">
                    <i class="ph-duotone ph-users text-4xl text-gray-300 mb-2"></i>
                    <p class="text-gray-500 font-medium">No deleted staff members found.</p>
                </div>`;
            return;
        }

        container.innerHTML = users
            .map((user) => {
                // Updated to point directly to the public folder
                const imgTag = user.image
                    ? `<img src="/${user.image}" class="w-full h-full object-cover grayscale">`
                    : `<span class="text-2xl">${user.name
                          .charAt(0)
                          .toUpperCase()}</span>`;

                const deptName = user.department
                    ? user.department.name
                    : "General";

                return `
                <div class="user-card bg-gray-50 opacity-90 shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-200 rounded-[1.25rem] flex flex-col overflow-hidden text-center hover:shadow-lg transition-all duration-300">
                    <div class="h-24 bg-red-100 w-full flex items-center justify-center">
                        <span class="text-red-500 font-bold uppercase tracking-wider text-xs border border-red-500 px-2 py-1 rounded">Deleted</span>
                    </div>
                    <div class="mx-auto -mt-12 w-24 h-24 rounded-full border-4 border-white bg-gray-200 text-gray-500 flex items-center justify-center font-bold overflow-hidden shadow-sm relative z-10">
                        ${imgTag}
                    </div>
                    <div class="p-5 grow flex flex-col items-center">
                        <h4 class="font-black text-gray-700 text-lg truncate w-full" title="${user.name}">${user.name}</h4>
                        <p class="text-sm font-medium text-gray-500 truncate w-full mb-1" title="${user.email}">${user.email}</p>
                        <span class="inline-block mt-2 text-[10px] uppercase font-bold text-gray-500 bg-gray-200 px-3 py-1 rounded-full tracking-wide">
                            ${user.role} - ${deptName}
                        </span>
                    </div>
                    <div class="flex items-center border-t border-gray-200 mt-auto">
                        <button class="flex-1 bg-green-50 hover:bg-green-100 text-green-700 py-3.5 rounded-none text-sm font-bold transition-colors cursor-pointer" onclick="restoreUser(${user.id}, this)">Restore</button>
                        <button class="flex-1 bg-red-50 hover:bg-red-600 hover:text-white text-red-600 py-3.5 rounded-none text-sm font-bold transition-colors cursor-pointer" onclick="forceDeleteUser(${user.id}, this)">Delete</button>
                    </div>
                </div>
            `;
            })
            .join("");
    }

    // ==========================================
    // 5. CRUD OPERATIONS
    // ==========================================

    // Add User
    document
        .getElementById("SaveUserBtn")
        .addEventListener("click", async () => {
            const form = document.getElementById("AddUserForm");
            const formData = new FormData(form);
            const saveBtn = document.getElementById("SaveUserBtn");

            saveBtn.disabled = true;
            saveBtn.innerText = "Saving";

            try {
                const response = await fetch("/adduser", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                        Accept: "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                    },
                    body: formData,
                });
                const result = await response.json();

                if (response.status === 201) {
                    closeModal(addUserBackdrop, addUserModal, "AddUserForm");
                    refreshCurrentGrid(); // Re-fetch the currently viewed grid
                } else if (response.status === 422) {
                    showUserErrors(result.errors, "add");
                }
            } finally {
                saveBtn.disabled = false;
                saveBtn.innerText = "Save Staff";
            }
        });

    // Edit User (Fetch data to fill form)
    window.editUser = async function (id) {
        try {
            const response = await fetch(`/user/${id}`, {
                headers: { Accept: "application/json" },
            });
            const data = await response.json();

            if (data.status === "success") {
                const user = data.user;
                document.getElementById("updateUserId").value = user.id;
                document.getElementById("updateUserName").value = user.name;
                document.getElementById("updateUserEmail").value = user.email;
                document.getElementById("updateUserRole").value = user.role;
                document.getElementById("updateUserDepartment").value =
                    user.department_id || "";
                document.getElementById("updateUserPassword").value = "";

                const previewEl = document.getElementById(
                    "updateUserImagePreview"
                );
                const iconEl = document.getElementById("updateUserCameraIcon");

                if (user.image) {
                    previewEl.src = "/" + user.image; // Updated to point directly to the public folder
                    previewEl.classList.remove("hidden");
                    iconEl.classList.add("hidden");
                } else {
                    previewEl.src = "#";
                    previewEl.classList.add("hidden");
                    iconEl.classList.remove("hidden");
                }

                openModal(updateUserBackdrop, updateUserModal);
            }
        } catch (err) {}
    };

    // Update User
    document
        .getElementById("UpdateUserBtn")
        .addEventListener("click", async () => {
            const id = document.getElementById("updateUserId").value;
            const form = document.getElementById("UpdateUserForm");
            const formData = new FormData(form);
            formData.append("_method", "PUT");
            const updateBtn = document.getElementById("UpdateUserBtn");

            updateBtn.disabled = true;
            updateBtn.innerText = "Updating";

            try {
                const response = await fetch(`/edit/${id}`, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                        Accept: "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                    },
                    body: formData,
                });
                const result = await response.json();

                if (response.ok) {
                    closeModal(
                        updateUserBackdrop,
                        updateUserModal,
                        "UpdateUserForm"
                    );
                    refreshCurrentGrid(); // Re-fetch the currently viewed grid
                } else if (response.status === 422) {
                    showUserErrors(result.errors, "update");
                }
            } finally {
                updateBtn.disabled = false;
                updateBtn.innerText = "Update Staff";
            }
        });

    // Soft Delete User
    window.deleteUser = async function (id, btnElement) {
        if (!btnElement.classList.contains("confirming-delete")) {
            const originalBg = btnElement.className;

            btnElement.innerText = "Sure?";
            btnElement.classList.add(
                "confirming-delete",
                "bg-red-600",
                "hover:bg-red-700"
            );
            btnElement.classList.remove("bg-sidebarBg", "hover:bg-gray-800");

            setTimeout(() => {
                if (document.body.contains(btnElement)) {
                    btnElement.innerText = "Delete";
                    btnElement.className = originalBg;
                    btnElement.classList.remove("confirming-delete");
                }
            }, 3000);
            return;
        }

        const card = btnElement.closest(".user-card");

        try {
            const response = await fetch(`/delete/${id}`, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                    Accept: "application/json",
                },
            });

            if (response.ok) {
                if (card) {
                    card.classList.add("opacity-0", "scale-90");
                    setTimeout(() => refreshCurrentGrid(), 300);
                } else {
                    refreshCurrentGrid();
                }
            }
        } catch (err) {}
    };

    // Restore User
    window.restoreUser = async function (id, btnElement) {
        const originalText = btnElement.innerText;
        btnElement.innerText = "Restoring";
        btnElement.disabled = true;

        try {
            const response = await fetch(`/restoreuser/${id}`, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                    Accept: "application/json",
                },
            });

            if (response.ok) {
                refreshCurrentGrid();
            } else {
                btnElement.innerText = originalText;
                btnElement.disabled = false;
            }
        } catch (err) {
            btnElement.innerText = originalText;
            btnElement.disabled = false;
        }
    };

    // Force Delete User
    window.forceDeleteUser = async function (id, btnElement) {
        if (!btnElement.classList.contains("confirming-delete")) {
            const originalClasses = btnElement.className;

            btnElement.innerText = "Sure?";
            btnElement.classList.add(
                "confirming-delete",
                "bg-red-700",
                "text-white"
            );
            btnElement.classList.remove("bg-red-50", "text-red-600");

            setTimeout(() => {
                if (document.body.contains(btnElement)) {
                    btnElement.innerText = "Delete";
                    btnElement.className = originalClasses;
                    btnElement.classList.remove("confirming-delete");
                }
            }, 3000);
            return;
        }

        const card = btnElement.closest(".user-card");

        try {
            const response = await fetch(`/forcedeleteuser/${id}`, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                    Accept: "application/json",
                },
            });

            if (response.ok) {
                if (card) {
                    card.classList.add("opacity-0", "scale-90");
                    setTimeout(() => refreshCurrentGrid(), 300);
                } else {
                    refreshCurrentGrid();
                }
            }
        } catch (err) {}
    };

    // ==========================================
    // 6. FORM UI LOGIC (Images & Passwords)
    // ==========================================
    const addImageCircle = document.getElementById("addUserImageCircle");
    const addImageInput = document.getElementById("addUserImage");
    const addImagePreview = document.getElementById("addUserImagePreview");
    const addCameraIcon = document.getElementById("addUserCameraIcon");

    const updateImageCircle = document.getElementById("updateUserImageCircle");
    const updateImageInput = document.getElementById("updateUserImage");
    const updateImagePreview = document.getElementById(
        "updateUserImagePreview"
    );
    const updateCameraIcon = document.getElementById("updateUserCameraIcon");

    const addPasswordInput = document.getElementById("addUserPassword");
    const addPasswordToggle = document.getElementById("addUserPasswordToggle");
    const addEyeIcon = document.getElementById("addUserEyeIcon");

    const updatePasswordInput = document.getElementById("updateUserPassword");
    const updatePasswordToggle = document.getElementById(
        "updateUserPasswordToggle"
    );
    const updateEyeIcon = document.getElementById("updateUserEyeIcon");

    if (addImageCircle) {
        addImageCircle.addEventListener("click", () => addImageInput.click());
    }

    if (updateImageCircle) {
        updateImageCircle.addEventListener("click", () =>
            updateImageInput.click()
        );
    }

    function handleImagePreview(input, preview, icon) {
        input.addEventListener("change", function () {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.classList.remove("hidden");
                    if (icon) icon.classList.add("hidden");
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
    }

    if (addImageInput)
        handleImagePreview(addImageInput, addImagePreview, addCameraIcon);
    if (updateImageInput)
        handleImagePreview(
            updateImageInput,
            updateImagePreview,
            updateCameraIcon
        );

    function handlePasswordToggle(toggleBtn, input, icon) {
        toggleBtn.addEventListener("click", () => {
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("ph-eye");
                icon.classList.add("ph-eye-slash");
            } else {
                input.type = "password";
                icon.classList.remove("ph-eye-slash");
                icon.classList.add("ph-eye");
            }
        });
    }

    if (addPasswordToggle)
        handlePasswordToggle(addPasswordToggle, addPasswordInput, addEyeIcon);
    if (updatePasswordToggle)
        handlePasswordToggle(
            updatePasswordToggle,
            updatePasswordInput,
            updateEyeIcon
        );


});
