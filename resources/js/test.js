document.addEventListener('DOMContentLoaded', function () {
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
});