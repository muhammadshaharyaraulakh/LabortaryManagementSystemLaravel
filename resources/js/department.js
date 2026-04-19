document.addEventListener('DOMContentLoaded', () => {
    const addDepartmentBackdrop = document.getElementById('AddDepartmentModalBackdrop');
    const addDepartmentModal = document.getElementById('AddDepartmentModal');
    const updateDepartmentBackdrop = document.getElementById('UpdateDepartmentModalBackdrop');
    const updateDepartmentModal = document.getElementById('UpdateDepartmentModal');
    const gridContainer = document.getElementById('grid-department');
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

    document.getElementById('CloseAddDepartmentX').addEventListener('click', () => closeModal(addDepartmentBackdrop, addDepartmentModal, 'AddDepartmentForm'));
    document.getElementById('CloseAddDepartmentBtn').addEventListener('click', () => closeModal(addDepartmentBackdrop, addDepartmentModal, 'AddDepartmentForm'));
    document.getElementById('CloseUpdateDepartmentX').addEventListener('click', () => closeModal(updateDepartmentBackdrop, updateDepartmentModal, 'UpdateDepartmentForm'));
    document.getElementById('CloseUpdateDepartmentBtn').addEventListener('click', () => closeModal(updateDepartmentBackdrop, updateDepartmentModal, 'UpdateDepartmentForm'));

    async function fetchDepartments() {
        try {
            const response = await fetch('/departments', { headers: { 'Accept': 'application/json' } });
            const result = await response.json();
            if (response.ok && result.status === 'success') {
                renderDepartments(result.data || result.departments || result.tests); 
            } else {
                gridContainer.innerHTML = `<div class="col-span-full text-center text-gray-500 py-8 font-medium">No departments found.</div>`;
            }
        } catch (error) {}
    }

    function renderDepartments(departments) {
        gridContainer.innerHTML = '';
        if (!departments || departments.length === 0) {
            gridContainer.innerHTML = `<div class="col-span-full text-center text-gray-500 py-8 font-medium">No departments found.</div>`;
            return;
        }

        departments.forEach(dept => {
            const isActive = dept.is_active == 1;
            const statusColor = isActive ? 'text-blue-600 bg-blue-50' : 'text-red-600 bg-red-50';
            const statusText = isActive ? 'Active' : 'Inactive';
            const typeFormatted = dept.type === 'sample_based' ? 'Sample Based' : 'Human Based';

            const card = `
            <div class="dept-card bg-white shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-100 rounded-[1.25rem] flex flex-col overflow-hidden text-center hover:shadow-lg transition-all duration-300">
                <div class="h-24 bg-sidebarBg w-full"></div>
                <div class="mx-auto -mt-12 w-24 h-24 rounded-full border-4 border-white bg-gray-100 text-gray-500 flex items-center justify-center font-bold overflow-hidden shadow-sm relative z-10">
                    <i class="ph-duotone ph-buildings text-4xl"></i>
                </div>
                <div class="p-5 grow flex flex-col items-center">
                    <h4 class="font-black text-gray-900 text-lg truncate w-full" title="${dept.name}">${dept.name}</h4>
                    <p class="text-sm font-medium text-gray-500 truncate w-full mb-1">${typeFormatted}</p>
                    <span class="inline-block mt-2 text-[10px] uppercase font-bold px-3 py-1 rounded-full tracking-wide ${statusColor}">${statusText}</span>
                </div>
                <div class="flex items-center border-t border-gray-100 mt-auto">
                    <button class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-800 py-3.5 rounded-none text-sm font-bold transition-colors cursor-pointer" onclick="editDepartment(${dept.id})">Edit</button>
                    <button class="flex-1 bg-sidebarBg hover:bg-gray-800 text-white py-3.5 rounded-none text-sm font-bold transition-colors cursor-pointer" onclick="deleteDepartment(${dept.id}, this)">Delete</button>
                </div>
            </div>`;
            gridContainer.insertAdjacentHTML('beforeend', card);
        });
    }

    document.getElementById('SaveDepartmentBtn').addEventListener('click', async () => {
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
            
            if (response.ok && result.status === 'success') {
                const dept = result.data || result.department;
                document.getElementById('updateDepartmentId').value = dept.id;
                document.getElementById('updateDepartmentName').value = dept.name;
                document.getElementById('updateDepartmentType').value = dept.type;
                document.getElementById('updateDepartmentIsActive').checked = dept.is_active == 1;
                
                openModal(updateDepartmentBackdrop, updateDepartmentModal);
            }
        } catch (error) {}
    };

    document.getElementById('UpdateDepartmentBtn').addEventListener('click', async () => {
        const id = document.getElementById('updateDepartmentId').value;
        const payload = {
            name: document.getElementById('updateDepartmentName').value,
            type: document.getElementById('updateDepartmentType').value,
            is_active: document.getElementById('updateDepartmentIsActive').checked ? 1 : 0,
            _method: 'PUT'
        };

        const updateBtn = document.getElementById('UpdateDepartmentBtn');
        updateBtn.disabled = true;
        updateBtn.innerText = 'Updating...';

        try {
            const response = await fetch(`/departments/${id}`, {
                method: 'POST',
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

    window.deleteDepartment = async function(id, btnElement) {
        if (!btnElement.classList.contains('confirming-delete')) {
            const originalBg = btnElement.className;
            btnElement.innerText = 'Sure?';
            btnElement.classList.add('confirming-delete', 'bg-red-600', 'hover:bg-red-700');
            btnElement.classList.remove('bg-sidebarBg', 'hover:bg-gray-800');
            
            setTimeout(() => {
                if (document.body.contains(btnElement)) {
                    btnElement.innerText = 'Delete';
                    btnElement.className = originalBg;
                    btnElement.classList.remove('confirming-delete');
                }
            }, 3000);
            return;
        }

        const card = btnElement.closest('.dept-card');

        try {
            const response = await fetch(`/departments/${id}`, {
                method: 'DELETE',
                headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': csrfToken }
            });
            
            if (response.ok) {
                if (card) {
                    card.classList.add('opacity-0', 'scale-90');
                    setTimeout(() => fetchDepartments(), 300);
                } else {
                    fetchDepartments();
                }
            }
        } catch (error) {}
    };

    fetchDepartments();
});