document.addEventListener('DOMContentLoaded', () => {
    const addTestBackdrop = document.getElementById('AddTestModalBackdrop');
    const addTestModal = document.getElementById('AddTestModal');
    const updateTestBackdrop = document.getElementById('UpdateTestModalBackdrop');
    const updateTestModal = document.getElementById('UpdateTestModal');
    const gridContainer = document.getElementById('grid-tests');
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
                clearTestErrors(formId === 'AddTestForm' ? 'add' : 'update');
            }
        }, 300);
    }

    function clearTestErrors(prefix) {
        document.querySelectorAll(`[id^="error${prefix === 'add' ? 'Add' : 'Update'}Test"]`).forEach(el => {
            el.classList.add('hidden');
            el.innerText = '';
        });
        document.querySelectorAll(`#${prefix === 'add' ? 'Add' : 'Update'}TestForm input, #${prefix === 'add' ? 'Add' : 'Update'}TestForm select, #${prefix === 'add' ? 'Add' : 'Update'}TestForm textarea`).forEach(el => {
            el.classList.remove('border-red-500', 'focus:ring-red-200');
        });
    }

    function showTestErrors(errors, prefix) {
        clearTestErrors(prefix);
        const fieldMap = {
            'name': `${prefix}TestName`,
            'code': `${prefix}TestCode`,
            'price': `${prefix}TestPrice`,
            'department_id': `${prefix}TestDepartment`,
            'sample_type': `${prefix}TestSampleType`,
            'result_hours': `${prefix}TestResultHours`,
            'instructions': `${prefix}TestInstructions`
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
            if (inputEl) {
                inputEl.classList.add('border-red-500', 'focus:ring-red-200');
            }
        }
    }

    const openAddTestBtn = document.getElementById('open-test-modal');
    if (openAddTestBtn) {
        openAddTestBtn.addEventListener('click', () => {
            openModal(addTestBackdrop, addTestModal);
        });
    }

    document.getElementById('CloseAddTestX').addEventListener('click', () => closeModal(addTestBackdrop, addTestModal, 'AddTestForm'));
    document.getElementById('CloseAddTestBtn').addEventListener('click', () => closeModal(addTestBackdrop, addTestModal, 'AddTestForm'));
    document.getElementById('CloseUpdateTestX').addEventListener('click', () => closeModal(updateTestBackdrop, updateTestModal, 'UpdateTestForm'));
    document.getElementById('CloseUpdateTestBtn').addEventListener('click', () => closeModal(updateTestBackdrop, updateTestModal, 'UpdateTestForm'));

    async function fetchDepartments() {
        try {
            const response = await fetch('/departments', { headers: { 'Accept': 'application/json' } });
            const result = await response.json();
            if (response.ok && result.status === 'success') {
                const depts = result.data || result.departments || result.tests;
                const addSelect = document.getElementById('addTestDepartment');
                const updateSelect = document.getElementById('updateTestDepartment');
                addSelect.innerHTML = '<option value="" disabled selected>Select Department</option>';
                updateSelect.innerHTML = '<option value="" disabled selected>Select Department</option>';
                
                depts.forEach(dept => {
                    const opt = `<option value="${dept.id}">${dept.name}</option>`;
                    addSelect.insertAdjacentHTML('beforeend', opt);
                    updateSelect.insertAdjacentHTML('beforeend', opt);
                });
            }
        } catch (error) {}
    }

    async function fetchTests() {
        try {
            const response = await fetch('/tests', { headers: { 'Accept': 'application/json' } });
            const result = await response.json();
            if (response.ok && result.status === 'success') {
                renderTests(result.tests);
            } else {
                gridContainer.innerHTML = `<div class="col-span-full text-center text-gray-500 py-8 font-medium">No tests found.</div>`;
            }
        } catch (error) {}
    }

    function renderTests(tests) {
        gridContainer.innerHTML = '';
        if (!tests || tests.length === 0) {
            gridContainer.innerHTML = `<div class="col-span-full text-center text-gray-500 py-8 font-medium">No tests found.</div>`;
            return;
        }

        tests.forEach(test => {
            const isActive = test.is_active == 1;
            const statusColor = isActive ? 'text-green-600 bg-green-50' : 'text-red-600 bg-red-50';
            const statusText = isActive ? 'Active' : 'Inactive';
            const deptName = test.department ? test.department.name : 'No Department';
            const sampleType = test.sample_type || 'N/A';

            const card = `
            <div class="test-card bg-white shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-100 rounded-[1.25rem] flex flex-col overflow-hidden hover:shadow-lg transition-all duration-300">
                <div class="p-6 grow flex flex-col">
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 rounded-[0.85rem] bg-purple-50 text-purple-600 flex items-center justify-center text-2xl shadow-sm">
                                <i class="ph-duotone ph-flask"></i>
                            </div>
                            <div>
                                <h4 class="font-black text-gray-900 text-xl tracking-tight leading-tight">${test.name}</h4>
                                <p class="text-xs font-bold text-gray-400 mt-0.5 uppercase tracking-wider">${test.code}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-y-4 gap-x-2 mt-2 mb-5">
                        <div class="bg-gray-50/50 p-3 rounded-xl border border-gray-100/50">
                            <span class="block text-[10px] uppercase font-bold text-gray-400 mb-1">Price</span>
                            <span class="block text-sm font-extrabold text-gray-800">Rs. ${parseFloat(test.price).toLocaleString()}</span>
                        </div>
                        <div class="bg-gray-50/50 p-3 rounded-xl border border-gray-100/50">
                            <span class="block text-[10px] uppercase font-bold text-gray-400 mb-1">Result Time</span>
                            <span class="block text-sm font-extrabold text-gray-800">${test.result_hours} Hours</span>
                        </div>
                        <div class="col-span-2 bg-gray-50/50 p-3 rounded-xl border border-gray-100/50 flex justify-between items-center">
                            <div>
                                <span class="block text-[10px] uppercase font-bold text-gray-400 mb-1">Department</span>
                                <span class="block text-sm font-extrabold text-purple-600">${deptName}</span>
                            </div>
                            <div class="text-right">
                                <span class="block text-[10px] uppercase font-bold text-gray-400 mb-1">Sample</span>
                                <span class="block text-sm font-extrabold text-gray-700">${sampleType}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-auto flex justify-between items-center pt-2">
                        <span class="inline-block text-[10px] uppercase font-bold px-3 py-1 rounded-full tracking-wide ${statusColor}">${statusText}</span>
                    </div>
                </div>
                <div class="flex items-center border-t border-gray-100">
                    <button class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-800 py-3.5 rounded-none text-sm font-bold transition-colors cursor-pointer" onclick="editTest(${test.id})">Edit</button>
                    <button class="flex-1 bg-sidebarBg hover:bg-gray-800 text-white py-3.5 rounded-none text-sm font-bold transition-colors cursor-pointer" onclick="deleteTest(${test.id}, this)">Delete</button>
                </div>
            </div>`;
            gridContainer.insertAdjacentHTML('beforeend', card);
        });
    }

    document.getElementById('SaveTestBtn').addEventListener('click', async () => {
        const payload = {
            name: document.getElementById('addTestName').value,
            code: document.getElementById('addTestCode').value,
            price: document.getElementById('addTestPrice').value,
            department_id: document.getElementById('addTestDepartment').value,
            sample_type: document.getElementById('addTestSampleType').value,
            result_hours: document.getElementById('addTestResultHours').value,
            instructions: document.getElementById('addTestInstructions').value,
            is_active: document.getElementById('addTestIsActive').checked ? 1 : 0
        };

        const saveBtn = document.getElementById('SaveTestBtn');
        saveBtn.disabled = true;
        saveBtn.innerText = 'Saving...';

        try {
            const response = await fetch('/tests', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                body: JSON.stringify(payload)
            });
            const result = await response.json();

            if (response.status === 201) {
                closeModal(addTestBackdrop, addTestModal, 'AddTestForm');
                fetchTests();
            } else if (response.status === 422) {
                showTestErrors(result.errors, 'add');
            }
        } finally {
            saveBtn.disabled = false;
            saveBtn.innerText = 'Save Test';
        }
    });

    window.editTest = async function(id) {
        try {
            const response = await fetch(`/tests/${id}`, { headers: { 'Accept': 'application/json' } });
            const result = await response.json();
            
            if (response.ok && result.status === 'success') {
                const test = result.test;
                document.getElementById('updateTestId').value = test.id;
                document.getElementById('updateTestName').value = test.name;
                document.getElementById('updateTestCode').value = test.code;
                document.getElementById('updateTestPrice').value = test.price;
                document.getElementById('updateTestDepartment').value = test.department_id;
                document.getElementById('updateTestSampleType').value = test.sample_type || '';
                document.getElementById('updateTestResultHours').value = test.result_hours;
                document.getElementById('updateTestInstructions').value = test.instructions || '';
                document.getElementById('updateTestIsActive').checked = test.is_active == 1;
                
                openModal(updateTestBackdrop, updateTestModal);
            }
        } catch (error) {}
    };

    document.getElementById('UpdateTestBtn').addEventListener('click', async () => {
        const id = document.getElementById('updateTestId').value;
        const payload = {
            name: document.getElementById('updateTestName').value,
            code: document.getElementById('updateTestCode').value,
            price: document.getElementById('updateTestPrice').value,
            department_id: document.getElementById('updateTestDepartment').value,
            sample_type: document.getElementById('updateTestSampleType').value,
            result_hours: document.getElementById('updateTestResultHours').value,
            instructions: document.getElementById('updateTestInstructions').value,
            is_active: document.getElementById('updateTestIsActive').checked ? 1 : 0,
            _method: 'PUT'
        };

        const updateBtn = document.getElementById('UpdateTestBtn');
        updateBtn.disabled = true;
        updateBtn.innerText = 'Updating...';

        try {
            const response = await fetch(`/tests/${id}`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                body: JSON.stringify(payload)
            });
            const result = await response.json();

            if (response.ok) {
                closeModal(updateTestBackdrop, updateTestModal, 'UpdateTestForm');
                fetchTests();
            } else if (response.status === 422) {
                showTestErrors(result.errors, 'update');
            }
        } finally {
            updateBtn.disabled = false;
            updateBtn.innerText = 'Update Test';
        }
    });

    window.deleteTest = async function(id, btnElement) {
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

        const card = btnElement.closest('.test-card');

        try {
            const response = await fetch(`/tests/${id}`, {
                method: 'DELETE',
                headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': csrfToken }
            });
            
            if (response.ok) {
                if (card) {
                    card.classList.add('opacity-0', 'scale-90');
                    setTimeout(() => fetchTests(), 300);
                } else {
                    fetchTests();
                }
            }
        } catch (error) {}
    };

    fetchDepartments();
    fetchTests();
});