document.addEventListener('DOMContentLoaded', () => {
    const addDepartmentBackdrop = document.getElementById('AddDepartmentModalBackdrop');
    const addDepartmentModal = document.getElementById('AddDepartmentModal');
    const updateDepartmentBackdrop = document.getElementById('UpdateDepartmentModalBackdrop');
    const updateDepartmentModal = document.getElementById('UpdateDepartmentModal');
    const gridContainer = document.getElementById('grid-department');
    const deletedGridContainer = document.getElementById('grid-deleted-department');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    function openModal(backdrop, modal) {
        backdrop.classList.remove('hidden');
        backdrop.classList.add('flex');
        setTimeout(() => {
            backdrop.classList.remove('opacity-0');
            backdrop.classList.add('opacity-100');
            modal.classList.remove('scale-95');
            modal.classList.add('scale-100');
        }, 10);
    }

    function closeModal(backdrop, modal, formId) {
        backdrop.classList.remove('opacity-100');
        backdrop.classList.add('opacity-0');
        modal.classList.remove('scale-100');
        modal.classList.add('scale-95');
        setTimeout(() => {
            backdrop.classList.add('hidden');
            backdrop.classList.remove('flex');
            if (formId) {
                document.getElementById(formId).reset();
                clearDepartmentErrors(formId === 'AddDepartmentForm' ? 'add' : 'update');
            }
        }, 300);
    }

    function clearDepartmentErrors(prefix) {
        document.querySelectorAll(`[id^="error${prefix === 'add' ? 'Add' : 'Update'}Department"]`).forEach(el => {
            el.classList.add('hidden');
            el.innerText = '';
        });
        document.querySelectorAll(`#${prefix === 'add' ? 'Add' : 'Update'}DepartmentForm input, #${prefix === 'add' ? 'Add' : 'Update'}DepartmentForm select`).forEach(el => {
            el.classList.remove('border-red-500', 'focus:ring-red-200');
        });
    }

    function showDepartmentErrors(errors, prefix) {
        clearDepartmentErrors(prefix);
        const fieldMap = {
            'name': `${prefix}DepartmentName`,
            'type': `${prefix}DepartmentType`,
            'is_active': `${prefix}DepartmentIsActive`
        };

        for (const [field, messages] of Object.entries(errors)) {
            const inputId = fieldMap[field];
            const errorId = `error${inputId.charAt(0).toUpperCase() + inputId.slice(1)}`;
            const inputEl = document.getElementById(inputId);
            const errorEl = document.getElementById(errorId);

            if (errorEl) {
                errorEl.innerText = messages[0];
                errorEl.classList.remove('hidden');
            }
            if (inputEl && inputEl.type !== 'checkbox') {
                inputEl.classList.add('border-red-500', 'focus:ring-red-200');
            }
        }
    }

    const openAddDepartmentBtn = document.getElementById('open-department-modal');
    if (openAddDepartmentBtn) {
        openAddDepartmentBtn.addEventListener('click', () => {
            openModal(addDepartmentBackdrop, addDepartmentModal);
        });
    }

    document.getElementById('CloseAddDepartmentX')?.addEventListener('click', () => closeModal(addDepartmentBackdrop, addDepartmentModal, 'AddDepartmentForm'));
    document.getElementById('CloseAddDepartmentBtn')?.addEventListener('click', () => closeModal(addDepartmentBackdrop, addDepartmentModal, 'AddDepartmentForm'));
    document.getElementById('CloseUpdateDepartmentX')?.addEventListener('click', () => closeModal(updateDepartmentBackdrop, updateDepartmentModal, 'UpdateDepartmentForm'));
    document.getElementById('CloseUpdateDepartmentBtn')?.addEventListener('click', () => closeModal(updateDepartmentBackdrop, updateDepartmentModal, 'UpdateDepartmentForm'));

    async function fetchDepartments() {
        try {
            const response = await fetch('/departments', { headers: { 'Accept': 'application/json' } });
            const result = await response.json();
            if (response.ok && (result.status === 'success' || result.status === 200)) {
                renderDepartments(result.data); 
            } else {
                gridContainer.innerHTML = `<div class="col-span-full text-center text-gray-500 py-8 font-medium">No departments found.</div>`;
            }
        } catch (error) {
            gridContainer.innerHTML = `<div class="col-span-full text-center text-red-500 py-8 font-medium">Error loading data.</div>`;
        }
    }

    async function fetchDeletedDepartments() {
        try {
            const response = await fetch('/departments/trashed', { headers: { 'Accept': 'application/json' } });
            const result = await response.json();
            if (response.ok && (result.status === 'success' || result.status === 200)) {
                renderDeletedDepartments(result.data); 
            } else {
                deletedGridContainer.innerHTML = `<div class="col-span-full text-center text-gray-500 py-8 font-medium">No deleted departments found.</div>`;
            }
        } catch (error) {
            deletedGridContainer.innerHTML = `<div class="col-span-full text-center text-red-500 py-8 font-medium">Error loading data.</div>`;
        }
    }

    function renderDepartments(departments) {
        gridContainer.innerHTML = '';
        if (!departments || departments.length === 0) {
            gridContainer.innerHTML = `<div class="col-span-full text-center text-gray-500 py-8 font-medium bg-white rounded-2xl border border-gray-100 shadow-sm">No active departments found.</div>`;
            return;
        }

        departments.forEach(dept => {
            const isActive = dept.is_active == 1;
            const statusColor = isActive ? 'text-green-600 bg-green-50 border-green-100' : 'text-red-600 bg-red-50 border-red-100';
            const statusText = isActive ? 'Active' : 'Inactive';
            const typeFormatted = dept.type === 'sample_based' ? 'Sample Based' : 'Human Based';
            const testsCount = dept.tests_count || 0;
            const usersCount = dept.users_count || 0;

            const card = `
            <div class="bg-white shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-100 rounded-[1.25rem] flex flex-col overflow-hidden hover:shadow-lg transition-all duration-300">
                <div class="h-20 bg-[#2d374d] w-full relative">
                    <span class="absolute top-3 right-3 text-[9px] uppercase font-bold px-2.5 py-1 rounded-md border ${statusColor} tracking-wide">${statusText}</span>
                </div>
                <div class="mx-auto -mt-10 w-20 h-20 rounded-full border-4 border-[#2d374d] bg-gray-50 text-gray-600 flex items-center justify-center shadow-sm relative z-10">
                    <i class="ph-duotone ph-buildings text-3xl"></i>
                </div>
                <div class="p-5 grow flex flex-col items-center text-center">
                    <h4 class="font-extrabold text-gray-900 text-lg truncate w-full mb-4" title="${dept.name}">${dept.name}</h4>
                    
                    <div class="w-full flex justify-center gap-5 text-sm mb-2">
                        <div class="flex flex-col items-center">
                            <span class="text-gray-400 font-medium text-[11px] uppercase tracking-wide mb-0.5">Type</span>
                            <span class="text-gray-800 font-bold text-xs bg-gray-50 px-2 py-1 rounded-md">${typeFormatted}</span>
                        </div>
                        <div class="w-px bg-gray-100"></div>
                        <div class="flex flex-col items-center">
                            <span class="text-gray-400 font-medium text-[11px] uppercase tracking-wide mb-0.5">Tests</span>
                            <span class="text-gray-800 font-extrabold">${testsCount}</span>
                        </div>
                        <div class="w-px bg-gray-100"></div>
                        <div class="flex flex-col items-center">
                            <span class="text-gray-400 font-medium text-[11px] uppercase tracking-wide mb-0.5">Users</span>
                            <span class="text-gray-800 font-extrabold">${usersCount}</span>
                        </div>
                    </div>
                </div>
                <div class="flex items-center border-t border-gray-100 mt-auto bg-gray-50/50">
                    <button class="flex-1 text-blue-600 hover:bg-blue-50 py-3.5 rounded-bl-[1.25rem] text-sm font-bold transition-colors cursor-pointer border-r border-gray-100" onclick="editDepartment(${dept.id})">Edit</button>
                    <button class="flex-1 text-red-600 hover:bg-red-50 py-3.5 rounded-br-[1.25rem] text-sm font-bold transition-colors cursor-pointer" onclick="deleteDepartment(${dept.id})">Delete</button>
                </div>
            </div>`;
            gridContainer.insertAdjacentHTML('beforeend', card);
        });
    }

    function renderDeletedDepartments(departments) {
        deletedGridContainer.innerHTML = '';
        if (!departments || departments.length === 0) {
            deletedGridContainer.innerHTML = `<div class="col-span-full text-center text-gray-500 py-8 font-medium bg-white rounded-2xl border border-gray-100 shadow-sm">No deleted departments found.</div>`;
            return;
        }

        departments.forEach(dept => {
            const typeFormatted = dept.type === 'sample_based' ? 'Sample Based' : 'Human Based';
            
            const card = `
            <div class="bg-white shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-100 rounded-[1.25rem] flex flex-col overflow-hidden opacity-75 hover:opacity-100 transition-all duration-300">
                <div class="h-16 bg-red-50 w-full border-b border-red-100"></div>
                <div class="mx-auto -mt-8 w-16 h-16 rounded-full border-4 border-white bg-white text-red-400 flex items-center justify-center shadow-sm relative z-10">
                    <i class="ph-duotone ph-trash text-2xl"></i>
                </div>
                <div class="p-5 grow flex flex-col items-center text-center">
                    <h4 class="font-extrabold text-gray-900 text-base truncate w-full mb-1" title="${dept.name}">${dept.name}</h4>
                    <span class="text-xs font-bold text-gray-500 bg-gray-50 px-2 py-1 rounded-md mt-1">${typeFormatted}</span>
                </div>
                <div class="flex items-center border-t border-gray-100 mt-auto">
                    <button class="w-full bg-green-50 hover:bg-green-100 text-green-700 py-3.5 rounded-b-[1.25rem] text-sm font-bold transition-colors cursor-pointer flex items-center justify-center gap-2" onclick="restoreDepartment(${dept.id})">
                        Restore
                    </button>
                </div>
            </div>`;
            deletedGridContainer.insertAdjacentHTML('beforeend', card);
        });
    }

    document.getElementById('SaveDepartmentBtn')?.addEventListener('click', async () => {
        const payload = {
            name: document.getElementById('addDepartmentName').value,
            type: document.getElementById('addDepartmentType').value,
            is_active: document.getElementById('addDepartmentIsActive').checked ? 1 : 0
        };

        const saveBtn = document.getElementById('SaveDepartmentBtn');
        saveBtn.disabled = true;
        saveBtn.innerText = 'Saving...';

        try {
            const response = await fetch('/departments', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                body: JSON.stringify(payload)
            });
            const result = await response.json();

            if (response.ok) {
                closeModal(addDepartmentBackdrop, addDepartmentModal, 'AddDepartmentForm');
                fetchDepartments();
                fetchDeletedDepartments();
            } else if (response.status === 422) {
                showDepartmentErrors(result.errors, 'add');
            }
        } finally {
            saveBtn.disabled = false;
            saveBtn.innerText = 'Save Department';
        }
    });

    window.editDepartment = async function(id) {
        try {
            const response = await fetch(`/departments/${id}`, { headers: { 'Accept': 'application/json' } });
            const result = await response.json();
            
            if (response.ok && (result.status === 'success' || result.status === 200)) {
                const dept = result.data || result.department;
                document.getElementById('updateDepartmentId').value = dept.id;
                document.getElementById('updateDepartmentName').value = dept.name;
                document.getElementById('updateDepartmentType').value = dept.type;
                document.getElementById('updateDepartmentIsActive').checked = dept.is_active == 1;
                
                openModal(updateDepartmentBackdrop, updateDepartmentModal);
            }
        } catch (error) {}
    };

    document.getElementById('UpdateDepartmentBtn')?.addEventListener('click', async () => {
        const id = document.getElementById('updateDepartmentId').value;
        const payload = {
            name: document.getElementById('updateDepartmentName').value,
            type: document.getElementById('updateDepartmentType').value,
            is_active: document.getElementById('updateDepartmentIsActive').checked ? 1 : 0
        };

        const updateBtn = document.getElementById('UpdateDepartmentBtn');
        updateBtn.disabled = true;
        updateBtn.innerText = 'Updating...';

        try {
            const response = await fetch(`/departments/${id}`, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                body: JSON.stringify(payload)
            });
            const result = await response.json();

            if (response.ok) {
                closeModal(updateDepartmentBackdrop, updateDepartmentModal, 'UpdateDepartmentForm');
                fetchDepartments();
            } else if (response.status === 422) {
                showDepartmentErrors(result.errors, 'update');
            }
        } finally {
            updateBtn.disabled = false;
            updateBtn.innerText = 'Update Department';
        }
    });

    window.deleteDepartment = async function(id) {
        try {
            const response = await fetch(`/departments/${id}`, {
                method: 'DELETE',
                headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': csrfToken }
            });
            
            if (response.ok) {
                fetchDepartments();
                fetchDeletedDepartments();
            }
        } catch (error) {}
    };

    window.restoreDepartment = async function(id) {
        try {
            const response = await fetch(`/departments/${id}/restore`, {
                method: 'PUT',
                headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': csrfToken }
            });
            
            if (response.ok) {
                fetchDeletedDepartments();
                fetchDepartments();
            }
        } catch (error) {}
    };

    fetchDepartments();
    fetchDeletedDepartments();
});