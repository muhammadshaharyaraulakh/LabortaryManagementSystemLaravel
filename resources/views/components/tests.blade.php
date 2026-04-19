<div id="section-tests" class="content-section hidden animate-fade-in w-full max-w-7xl mx-auto">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-500 flex items-center justify-center">
                <i class="ph-duotone ph-flask text-2xl"></i>
            </div>
            <div>
                <h2 class="text-2xl font-extrabold text-gray-800">Laboratory Tests</h2>
                <p class="text-sm text-gray-500 font-medium">Manage available tests and configurations</p>
            </div>
        </div>
    </div>

    <div
        class="bg-white rounded-[1.25rem] shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-50 overflow-hidden w-full">
        <div class="p-4 border-b border-gray-100 flex flex-col sm:flex-row justify-between gap-4">
            <div class="relative w-full sm:w-96">
                <i class="ph ph-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-lg"></i>
                <input type="text" id="searchTestsDir" placeholder="Search Test name, Code, or Department"
                    class="w-full pl-11 pr-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-purple-100 bg-gray-50/50 focus:bg-white transition-colors text-sm font-medium">
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="text-xs text-gray-700 font-bold bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4">Test Code</th>
                        <th class="px-6 py-4">Test Name</th>
                        <th class="px-6 py-4">Department</th>
                        <th class="px-6 py-4">Price</th>
                        <th class="px-6 py-4">Time Required</th>
                        <th class="px-6 py-4 text-right">Action</th>
                    </tr>
                </thead>
                <tbody id="testDirectoryTableBody">
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="TestDetailsModalBackdrop"
    class="fixed inset-0 bg-black/50 z-60 hidden items-center justify-center p-4 opacity-0 transition-opacity duration-300">
    <div id="TestDetailsModal"
        class="bg-white w-full max-w-lg rounded-[1.25rem] shadow-xl transform scale-95 transition-all duration-300 flex flex-col">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-purple-50 text-purple-600 flex items-center justify-center ">
                    <i class="ph-duotone ph-info text-xl"></i>
                </div>
                <h3 class="text-lg font-extrabold text-gray-800">Test Details</h3>
            </div>
            <button class="close-modal-btn text-gray-400 hover:text-gray-800 transition-colors p-1 cursor-pointer"
                data-modal="TestDetailsModalBackdrop"><i class="ph ph-x text-xl"></i></button>
        </div>
        <div class="p-6">
        </div>
        <div class="px-6 py-4 border-t border-gray-100 flex justify-end">
            <button
                class="close-modal-btn px-5 py-2.5 rounded-xl text-sm font-bold text-gray-600 hover:bg-gray-200 transition-colors cursor-pointer"
                data-modal="TestDetailsModalBackdrop">Close</button>
        </div>
    </div>
</div>

<script>
    let directoryTests = [];
    const testDirectoryTableBody = document.getElementById('testDirectoryTableBody');
    const searchTestsDir = document.getElementById('searchTestsDir');

    async function fetchDirectoryTests() {
        if (!testDirectoryTableBody) return;
        testDirectoryTableBody.innerHTML = `<tr><td colspan="6" class="px-6 py-8 text-center"><i class="ph-bold ph-spinner animate-spin text-2xl text-purple-600"></i><p class="text-sm text-gray-500 mt-2">Loading tests...</p></td></tr>`;

        try {
            const response = await fetch('/tests', { headers: typeof fetchHeaders !== 'undefined' ? fetchHeaders : { 'Accept': 'application/json' } });
            const result = await response.json();

            if (result.status === 200) {
                directoryTests = result.data;
                renderDirectoryTests(directoryTests);
            } else {
                testDirectoryTableBody.innerHTML = `<tr><td colspan="6" class="px-6 py-4 text-center text-red-500">${result.message || 'No tests found.'}</td></tr>`;
            }
        } catch (error) {
            testDirectoryTableBody.innerHTML = `<tr><td colspan="6" class="px-6 py-4 text-center text-red-500">Failed to load tests.</td></tr>`;
        }
    }

    function renderDirectoryTests(tests) {
        if (!testDirectoryTableBody) return;
        testDirectoryTableBody.innerHTML = '';

        if (!tests || tests.length === 0) {
            testDirectoryTableBody.innerHTML = `<tr><td colspan="6" class="px-6 py-8 text-center text-gray-500 font-medium">No tests found matching your search.</td></tr>`;
            return;
        }

        tests.forEach(test => {
            const code = test.testCode || test.test_code || test.code || 'N/A';
            const name = test.testName || test.test_name || test.name || 'Unnamed Test';
            const department = test.department?.name || test.department || 'General';
            const price = test.price || 0;
            const time = test.timeRequired || test.time_required || 'Standard';

            testDirectoryTableBody.innerHTML += `
            <tr class="bg-white border-b border-gray-100 hover:bg-gray-50 transition-colors text-gray-800 font-medium animate-fade-in">
                <td class="px-6 py-4 text-gray-500">${code}</td>
                <td class="px-6 py-4">${name}</td>
                <td class="px-6 py-4">
                    <span class="bg-purple-50 text-purple-700 px-2.5 py-1 rounded-md text-xs font-bold">${department}</span>
                </td>
                <td class="px-6 py-4">Rs. ${price}</td>
                <td class="px-6 py-4">${time}</td>
                <td class="px-6 py-4 text-right">
                    <button data-id="${test.id}" class="btn-view-test text-purple-600 hover:text-purple-800 font-bold px-3 py-1.5 rounded-lg border border-purple-200 hover:bg-purple-50 transition-colors cursor-pointer">
                        View Details
                    </button>
                </td>
            </tr>
        `;
        });
    }

    if (searchTestsDir) {
        searchTestsDir.addEventListener('input', (e) => {
            const query = e.target.value.toLowerCase().trim();
            const filtered = directoryTests.filter(test => {
                const code = (test.testCode || test.test_code || test.code || '').toLowerCase();
                const name = (test.testName || test.test_name || test.name || '').toLowerCase();
                const department = (test.department?.name || test.department || '').toLowerCase();
                return name.includes(query) || code.includes(query) || department.includes(query);
            });
            renderDirectoryTests(filtered);
        });
    }

    async function fetchTestDetails(id) {
        const modalContent = document.querySelector('#TestDetailsModal .p-6');
        if (!modalContent) return;

        modalContent.innerHTML = `<div class="flex flex-col items-center justify-center py-10"><i class="ph-bold ph-spinner animate-spin text-3xl text-purple-600 mb-2"></i><p class="text-sm text-gray-500">Fetching details...</p></div>`;
        openModal('TestDetailsModalBackdrop');

        try {
            const response = await fetch(`/tests/${id}`, { headers: typeof fetchHeaders !== 'undefined' ? fetchHeaders : { 'Accept': 'application/json' } });
            const result = await response.json();

            if (result.status === 200) {
                const test = result.data;
                const code = test.testCode || test.test_code || test.code || 'N/A';
                const name = test.testName || test.test_name || test.name || 'Unnamed Test';
                const department = test.department?.name || test.department || 'General';

                let requirementsHtml = '';
                if (test.instructions) {
                    requirementsHtml = `
                    <div class="bg-orange-50 rounded-lg p-4 border border-orange-100 mb-4">
                        <span class="text-xs font-bold text-orange-800 uppercase tracking-wider block mb-1">Pre-Test Instructions</span>
                        <p class="text-sm text-orange-700">${test.instructions}</p>
                    </div>
                `;
                }

                let parametersHtml = '';
                if (test.parameters && test.parameters.length > 0) {
                    const paramList = test.parameters.map(param =>
                        `<li><span class="font-bold text-gray-700">${param.parameterName}</span> <span class="text-xs text-gray-500 ml-1">(Normal: ${param.normalRange} ${param.unit})</span></li>`
                    ).join('');

                    parametersHtml = `
                    <h5 class="font-bold text-sm text-gray-700 mb-2">Parameters Checked:</h5>
                    <ul class="text-sm text-gray-600 list-disc list-inside pl-4 space-y-2">
                        ${paramList}
                    </ul>
                `;
                } else {
                    parametersHtml = `<p class="text-sm text-gray-500 italic">No specific parameters listed for this test.</p>`;
                }

                modalContent.innerHTML = `
                <div class="flex justify-between items-start mb-1">
                    <h4 class="text-xl font-bold text-gray-900">${name}</h4>
                    <span class="bg-purple-50 text-purple-700 px-2.5 py-1 rounded-md text-xs font-bold">${department}</span>
                </div>
                <p class="text-sm text-gray-500 mb-4">Code: ${code} | Price: Rs. ${test.price}</p>
                ${requirementsHtml}
                ${parametersHtml}
            `;
            } else {
                modalContent.innerHTML = `<div class="py-8 text-center text-red-500 font-bold">${result.message || 'Failed to load test details.'}</div>`;
            }
        } catch (error) {
            modalContent.innerHTML = `<div class="py-8 text-center text-red-500 font-bold">Network error occurred.</div>`;
        }
    }

    function openModal(modalId) {
        const backdrop = document.getElementById(modalId);
        if (!backdrop) return;
        backdrop.classList.remove('hidden');
        backdrop.classList.add('flex');
        requestAnimationFrame(() => {
            backdrop.classList.remove('opacity-0');
            const modalContent = backdrop.firstElementChild;
            modalContent.classList.remove('scale-95');
            modalContent.classList.add('scale-100');
        });
    }

    function closeModal(modalId) {
        const backdrop = document.getElementById(modalId);
        if (!backdrop) return;
        backdrop.classList.add('opacity-0');
        const modalContent = backdrop.firstElementChild;
        modalContent.classList.remove('scale-100');
        modalContent.classList.add('scale-95');
        setTimeout(() => {
            backdrop.classList.remove('flex');
            backdrop.classList.add('hidden');
        }, 300);
    }

    fetchDirectoryTests();

    document.addEventListener('click', async (e) => {
        const viewTestBtn = e.target.closest('.btn-view-test');
        if (viewTestBtn) {
            const testId = viewTestBtn.getAttribute('data-id');
            if (testId) {
                fetchTestDetails(testId);
            } else {
                openModal('TestDetailsModalBackdrop');
            }
        }

        if (e.target.closest('.close-modal-btn')) {
            closeModal(e.target.closest('.close-modal-btn').getAttribute('data-modal'));
        }
    });
</script>