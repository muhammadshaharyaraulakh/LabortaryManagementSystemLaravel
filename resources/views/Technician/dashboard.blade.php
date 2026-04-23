<x-header />

<body class="font-sans antialiased bg-mainBg text-gray-800 flex h-screen overflow-hidden">
    <div id="sidebar-backdrop"
        class="fixed inset-0 bg-black/50 z-40 hidden transition-opacity md:hidden cursor-pointer"></div>
    <aside id="sidebar"
        class="bg-sidebarBg text-white w-64 shrink-0 transition-all duration-300 flex flex-col fixed inset-y-0 left-0 z-50 md:relative transform -translate-x-full md:translate-x-0">
        <div class="h-20 flex items-center justify-between px-6 pt-2">
            <span id="brand-text" class="text-white text-xl font-bold whitespace-nowrap tracking-wide">Technician</span>
            <button id="toggle-desktop-sidebar"
                class="text-gray-300 hover:text-white transition-colors hidden md:block cursor-pointer">
                <i class="ph ph-caret-double-left text-xl" id="desktop-toggle-icon"></i>
            </button>
            <button id="close-mobile-sidebar"
                class="text-gray-300 hover:text-white transition-colors md:hidden text-2xl cursor-pointer">
                <i class="ph ph-x"></i>
            </button>
        </div>

        <nav class="flex-1 overflow-y-auto py-4 space-y-1 custom-scrollbar text-sm font-medium" id="sidebar-nav">
            <a href="#"
                class="nav-link flex items-center px-6 py-3 text-white bg-white/10 transition-colors group active-nav cursor-pointer"
                data-target="section-dashboard" data-title="Dashboard">
                <i
                    class="ph-duotone ph-squares-four text-2xl w-7 text-center text-white transition-colors nav-icon"></i>
                <span class="ml-3 nav-text whitespace-nowrap">Dashboard</span>
            </a>
            <a href="#"
                class="nav-link flex items-center px-6 py-3 text-gray-300 hover:bg-white/10 hover:text-white transition-colors group cursor-pointer"
                data-target="section-worklist" data-title="Active Worklist">
                <i
                    class="ph-duotone ph-flask text-2xl w-7 text-center text-gray-400 group-hover:text-white transition-colors nav-icon"></i>
                <span class="ml-3 nav-text whitespace-nowrap">My Active Worklist</span>
            </a>
            <a href="#"
                class="nav-link flex items-center px-6 py-3 text-gray-300 hover:bg-white/10 hover:text-white transition-colors group cursor-pointer"
                data-target="section-completed" data-title="Pending Verification">
                <i
                    class="ph-duotone ph-check-circle text-2xl w-7 text-center text-gray-400 group-hover:text-white transition-colors nav-icon"></i>
                <span class="ml-3 nav-text whitespace-nowrap">Pending Verification</span>
            </a>
            <a href="#"
                class="nav-link flex items-center px-6 py-3 text-gray-300 hover:bg-white/10 hover:text-white transition-colors group cursor-pointer"
                data-target="section-settings" data-title="Settings">
                <i
                    class="ph-duotone ph-gear-six text-2xl w-7 text-center text-gray-400 group-hover:text-white transition-colors nav-icon"></i>
                <span class="ml-3 nav-text whitespace-nowrap">Settings</span>
            </a>

            <div class="pt-4 mt-2 border-t border-gray-700/50">
                <a href="{{ route('logout') }}"
                    class="flex items-center px-6 py-3 text-gray-300 hover:bg-white/10 hover:text-white transition-colors group cursor-pointer">
                    <i
                        class="ph-duotone ph-sign-out text-2xl w-7 text-center group-hover:text-white transition-colors"></i>
                    <span class="ml-3 nav-text whitespace-nowrap">Logout</span>
                </a>
            </div>
        </nav>
    </aside>

    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
        <header class="h-20 px-4 md:px-10 z-20 sticky top-0 bg-mainBg flex items-center justify-between">
            <div class="flex items-center">
                <button id="open-mobile-sidebar"
                    class="mr-4 text-gray-800 md:hidden p-2 rounded-md hover:bg-gray-200 transition-colors cursor-pointer">
                    <i class="ph ph-list text-2xl"></i>
                </button>
                <h1 id="header-title"
                    class="text-2xl md:text-4xl font-extrabold text-black tracking-tight transition-all duration-200">
                    Dashboard
                </h1>
            </div>
            <div class="flex items-center gap-4">
                <div class="hidden md:flex flex-col items-end mr-4">
                    <span class="text-sm font-bold text-gray-800">{{ Auth::user()->name }}</span>
                    <span class="text-xs text-blue-500 font-bold">Technician</span>
                </div>
                <div
                    class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold border border-blue-200 uppercase">
                    {{ substr(Auth::user()->name, 0, 2) }}
                </div>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-4 md:p-10 pt-2 relative">
            <div id="section-dashboard" class="content-section block animate-fade-in w-full max-w-7xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8 w-full">
                    <div
                        class="bg-white rounded-[1.25rem] shadow-[0_4px_20px_rgba(0,0,0,0.03)] p-6 border border-gray-50">
                        <div
                            class="w-12 h-12 rounded-lg bg-orange-50 text-orange-500 flex items-center justify-center mb-4">
                            <i class="ph-duotone ph-barcode text-2xl"></i>
                        </div>
                        <h3 id="stat-samples-receive" class="text-3xl font-extrabold text-black mb-1">0</h3>
                        <p class="text-gray-500 font-medium text-sm">Samples to Receive</p>
                    </div>

                    <div
                        class="bg-white rounded-[1.25rem] shadow-[0_4px_20px_rgba(0,0,0,0.03)] p-6 border border-gray-50">
                        <div
                            class="w-12 h-12 rounded-lg bg-blue-50 text-blue-500 flex items-center justify-center mb-4">
                            <i class="ph-duotone ph-flask text-2xl"></i>
                        </div>
                        <h3 id="stat-tests-progress" class="text-3xl font-extrabold text-black mb-1">0</h3>
                        <p class="text-gray-500 font-medium text-sm">Tests In Progress</p>
                    </div>

                    <div
                        class="bg-white rounded-[1.25rem] shadow-[0_4px_20px_rgba(0,0,0,0.03)] p-6 border border-gray-50">
                        <div
                            class="w-12 h-12 rounded-lg bg-purple-50 text-purple-500 flex items-center justify-center mb-4">
                            <i class="ph-duotone ph-clipboard-text text-2xl"></i>
                        </div>
                        <h3 id="stat-pending-verif" class="text-3xl font-extrabold text-black mb-1">0</h3>
                        <p class="text-gray-500 font-medium text-sm">Pending Verification</p>
                    </div>

                    <div
                        class="bg-white rounded-[1.25rem] shadow-[0_4px_20px_rgba(0,0,0,0.03)] p-6 border border-gray-50">
                        <div
                            class="w-12 h-12 rounded-lg bg-green-50 text-green-500 flex items-center justify-center mb-4">
                            <i class="ph-duotone ph-check-circle text-2xl"></i>
                        </div>
                        <h3 id="stat-completed-today" class="text-3xl font-extrabold text-black mb-1">0</h3>
                        <p class="text-gray-500 font-medium text-sm">Completed Today</p>
                    </div>
                </div>

                <div
                    class="bg-white rounded-[1.25rem] shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-50 p-8 mb-8 relative overflow-hidden">
                    <div
                        class="absolute top-0 right-0 w-64 h-64 bg-gray-50 rounded-full blur-3xl opacity-50 -mr-20 -mt-20 pointer-events-none">
                    </div>
                    <div class="relative z-10 max-w-4xl mx-auto text-center">
                        <div
                            class="w-20 h-20 mx-auto rounded-2xl bg-orange-50 text-orange-500 flex items-center justify-center mb-6">
                            <i class="ph-duotone ph-barcode text-5xl"></i>
                        </div>
                        <h2 class="text-3xl font-black text-gray-800 mb-2">Scan Sample Barcode</h2>
                        <p class="text-gray-500 font-medium mb-8">Enter the barcode number to update the test status and
                            move it to your Active Worklist for testing.</p>
                        <form id="ReceiveSampleForm" class="relative max-w-md mx-auto">
                            <input type="text" id="barcodeScannerInput" placeholder="Enter the Barcode" autofocus
                                autocomplete="off"
                                class="w-full pl-6 pr-16 py-5 text-xl font-mono text-center tracking-widest border border-gray-200 bg-gray-50/50 rounded-2xl focus:border-gray-400 focus:ring-4 focus:ring-gray-100 outline-none transition-all shadow-inner text-gray-800">
                            <button type="submit" id="btn-receive-submit"
                                class="absolute right-3 top-3 bottom-3 bg-sidebarBg hover:bg-gray-800 text-white px-6 rounded-xl font-bold transition-colors cursor-pointer flex items-center justify-center shadow-md">
                                <i class="ph-bold ph-arrow-right text-xl"></i>
                            </button>
                        </form>
                        <p id="receiveSuccessMsg" class="mt-4 text-green-600 font-bold text-sm hidden animate-fade-in">
                        </p>
                        <p id="receiveErrorMsg" class="mt-4 text-red-500 font-bold text-sm hidden animate-fade-in"></p>
                    </div>
                </div>

            </div>

            <div id="section-worklist" class="content-section hidden animate-fade-in w-full max-w-7xl mx-auto">
                <div
                    class="bg-white rounded-[1.25rem] shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-50 overflow-hidden w-full">
                    <div
                        class="p-5 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-gray-50/50">
                        <div class="flex items-center gap-2">
                            <h3 class="text-base font-bold text-gray-800">Active Worklist</h3>
                            <span id="worklist-count-badge"
                                class="bg-gray-200 text-gray-700 px-2 py-0.5 rounded-md text-xs font-bold">0
                                Tests</span>
                        </div>
                        <div class="relative w-full sm:w-72">
                            <input type="text" id="searchWorklist" placeholder="Search Barcode or Patient..."
                                class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-blue-100 bg-white">
                            <i class="ph ph-magnifying-glass absolute left-3 top-2.5 text-gray-400"></i>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm whitespace-nowrap">
                            <thead class="bg-gray-50 text-gray-700 font-bold border-b border-gray-100">
                                <tr>

                                    <th class="px-6 py-4">Patient Info</th>
                                    <th class="px-6 py-4">Test Assigned</th>
                                    <th class="px-6 py-4">Status</th>
                                    <th class="px-6 py-4 text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody id="worklistTableBody" class="divide-y divide-gray-50">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div id="section-completed" class="content-section hidden animate-fade-in w-full max-w-7xl mx-auto">
                <div
                    class="bg-white rounded-[1.25rem] shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-50 overflow-hidden w-full">
                    <div
                        class="p-5 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-gray-50/50">
                        <h3 class="text-base font-bold text-gray-800">Pending Verification by Pathologist</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm whitespace-nowrap">
                            <thead class="bg-gray-50 text-gray-700 font-bold border-b border-gray-100">
                                <tr>
                                    <th class="px-6 py-4">Vial ID</th>
                                    <th class="px-6 py-4">Test Name</th>
                                    <th class="px-6 py-4">Completed At</th>
                                    <th class="px-6 py-4">Status</th>
                                </tr>
                            </thead>
                            <tbody id="completedTableBody" class="divide-y divide-gray-50">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <x-settings />
        </main>
    </div>

    <div id="ResultEntryModalBackdrop"
        class="fixed inset-0 bg-black/60 z-60 hidden items-center justify-center p-4 opacity-0 transition-opacity duration-300">
        <div id="ResultEntryModal"
            class="bg-white w-full max-w-4xl rounded-[1.25rem] shadow-2xl transform scale-95 transition-all duration-300 flex flex-col max-h-[95vh] overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-sidebarBg text-white">
                <div>
                    <h3 class="font-black text-lg flex items-center gap-2">
                        <i class="ph-bold ph-flask"></i> <span id="modalTestNameTitle">Test Name</span>
                    </h3>
                    <p class="text-xs text-gray-300 font-medium mt-1"><span id="modalVialIdText"
                            class="font-mono text-white"></span> | Patient <span id="modalPatientNameText"></span></p>
                </div>
                <button class="close-modal-btn text-gray-300 hover:text-white transition-colors cursor-pointer"
                    data-modal="ResultEntryModalBackdrop">
                    <i class="ph ph-x text-2xl"></i>
                </button>
            </div>

            <form id="ResultEntryForm" class="flex flex-col flex-1 overflow-hidden">
                <input type="hidden" id="entryVialId">
                <div class="flex-1 overflow-y-auto bg-gray-50 p-6 custom-scrollbar">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <table class="w-full text-left text-sm">
                            <thead class="bg-gray-100 text-gray-700 font-bold border-b border-gray-200">
                                <tr>
                                    <th class="px-4 py-3 w-1/3">Parameter</th>
                                    <th class="px-4 py-3 w-1/4">Result Value</th>
                                    <th class="px-4 py-3 w-1/6">Unit</th>
                                    <th class="px-4 py-3 w-1/4">Reference Range</th>
                                    <th class="px-4 py-3 text-center">Flag</th>
                                </tr>
                            </thead>
                            <tbody id="parametersTableBody" class="divide-y divide-gray-100">
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="px-6 py-4 border-t border-gray-200 bg-white flex items-center justify-between">
                    <p class="text-xs font-bold text-gray-500"><i class="ph-fill ph-info text-blue-500"></i> Values
                        outside normal range will automatically flag.</p>
                    <div class="flex gap-3">
                        <button type="button"
                            class="close-modal-btn px-6 py-3 text-sm font-bold text-gray-600 bg-gray-100 rounded-xl hover:bg-gray-200 transition-colors cursor-pointer"
                            data-modal="ResultEntryModalBackdrop">Cancel</button>
                        <button type="submit" id="submitResultsBtn"
                            class="px-6 py-3 text-sm font-bold text-white bg-green-600 rounded-xl hover:bg-green-700 shadow-lg shadow-green-200 transition-all cursor-pointer flex items-center gap-2">
                            <i class="ph-bold ph-check-circle"></i> Save & Submit
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sections = document.querySelectorAll('.content-section');
            const headerTitle = document.getElementById('header-title');
            const navLinks = document.querySelectorAll('#sidebar-nav .nav-link');

            function switchSection(targetId, title) {
                sections.forEach(sec => {
                    sec.classList.add('hidden');
                    sec.classList.remove('block');
                });

                const target = document.getElementById(targetId);
                if (target) {
                    target.classList.remove('hidden');
                    target.classList.add('block');
                }
                if (headerTitle && title) {
                    headerTitle.innerText = title;
                }
            }

            navLinks.forEach(link => {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    navLinks.forEach(l => {
                        l.classList.remove('bg-white/10', 'text-white', 'active-nav');
                        l.classList.add('text-gray-300');
                        const icon = l.querySelector('.nav-icon');
                        if (icon) icon.classList.replace('text-white', 'text-gray-400');
                    });

                    link.classList.add('bg-white/10', 'text-white', 'active-nav');
                    link.classList.remove('text-gray-300');
                    const activeIcon = link.querySelector('.nav-icon');
                    if (activeIcon) activeIcon.classList.replace('text-gray-400', 'text-white');

                    switchSection(link.getAttribute('data-target'), link.getAttribute('data-title'));
                    if (window.innerWidth < 768) toggleSidebar();
                });
            });

            const sidebar = document.getElementById('sidebar');
            const sidebarBackdrop = document.getElementById('sidebar-backdrop');

            function toggleSidebar() {
                if (sidebar) sidebar.classList.toggle('-translate-x-full');
                if (sidebarBackdrop) sidebarBackdrop.classList.toggle('hidden');
            }

            document.getElementById('open-mobile-sidebar')?.addEventListener('click', toggleSidebar);
            document.getElementById('close-mobile-sidebar')?.addEventListener('click', toggleSidebar);
            sidebarBackdrop?.addEventListener('click', toggleSidebar);

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

            async function fetchStats() {
                try {
                    const response = await fetch('/TechnicianStats');
                    if (response.ok) {
                        const data = await response.json();
                        document.getElementById('stat-samples-receive').innerText = data.samplesToReceive || 0;
                        document.getElementById('stat-tests-progress').innerText = data.testsInProgress || 0;
                        document.getElementById('stat-pending-verif').innerText = data.pendingVerification || 0;
                        document.getElementById('stat-completed-today').innerText = data.completedToday || 0;
                    }
                } catch (error) {
                    console.error('Failed to fetch stats', error);
                }
            }

            async function fetchWorklist() {
                try {
                    const response = await fetch('/TechnicianWorklist');
                    if (response.ok) {
                        const result = await response.json();
                        if (result.status === 200) {
                            renderWorklist(result.data);
                        }
                    }
                } catch (error) {
                    console.error('Failed to fetch worklist', error);
                }
            }

            function renderWorklist(orders) {
                const tbody = document.getElementById('worklistTableBody');
                const badge = document.getElementById('worklist-count-badge');
                tbody.innerHTML = '';
                let testCount = 0;

                if (!orders || orders.length === 0) {
                    tbody.innerHTML = `<tr><td colspan="5" class="px-6 py-8 text-center text-gray-500 font-medium">No samples in active worklist.</td></tr>`;
                    badge.innerText = `0 Tests`;
                    return;
                }

                orders.forEach(order => {
                    if (order.tests && order.tests.length > 0) {
                        order.tests.forEach(test => {
                            testCount++;
                            const tr = document.createElement('tr');
                            tr.className = 'hover:bg-gray-50 transition-colors animate-fade-in';
                            tr.innerHTML = `
                              
                                <td class="px-6 py-4">
                                    <p class="font-bold text-gray-800">${order.name}</p>
                                    <p class="text-xs text-gray-500">${order.gender}, ${order.age}y</p>
                                </td>
                                <td class="px-6 py-4 font-bold text-gray-700">${test.name}</td>
                                <td class="px-6 py-4">
                                    <span class="bg-blue-50 text-blue-600 px-3 py-1 rounded-full text-xs font-bold border border-blue-100">${test.pivot.status}</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button
                                        class="btn-enter-results bg-sidebarBg text-white px-5 py-2 rounded-xl text-xs font-bold shadow-md hover:bg-gray-800 transition-all cursor-pointer"
                                        data-vial="${test.pivot.vialBarcode}" data-test="${test.name}" data-patient="${order.name}" data-parameters='${JSON.stringify(test.parameters)}'>
                                        Enter Results
                                    </button>
                                </td>
                            `;
                            tbody.appendChild(tr);
                        });
                    }
                });
                badge.innerText = `${testCount} Tests`;
            }

            const receiveForm = document.getElementById('ReceiveSampleForm');
            if (receiveForm) {
                receiveForm.addEventListener('submit', async (e) => {
                    e.preventDefault();
                    const input = document.getElementById('barcodeScannerInput');
                    const btn = document.getElementById('btn-receive-submit');
                    const barcode = input.value.trim();
                    const successMsg = document.getElementById('receiveSuccessMsg');
                    const errorMsg = document.getElementById('receiveErrorMsg');

                    successMsg.classList.add('hidden');
                    errorMsg.classList.add('hidden');

                    if (!barcode) return;

                    const originalHtml = btn.innerHTML;
                    btn.innerHTML = '<i class="ph-bold ph-spinner animate-spin text-xl"></i>';
                    btn.disabled = true;

                    try {
                        const response = await fetch('/ReceiveSample', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({ BarcodeNumber: barcode })
                        });

                        const result = await response.json();

                        if (response.ok && result.status === 200) {
                            successMsg.innerText = result.message;
                            successMsg.classList.remove('hidden');
                            input.value = '';
                            fetchStats();
                            fetchWorklist();
                            setTimeout(() => successMsg.classList.add('hidden'), 3000);
                        } else {
                            errorMsg.innerText = result.message || 'Failed to process barcode.';
                            errorMsg.classList.remove('hidden');
                            setTimeout(() => errorMsg.classList.add('hidden'), 5000);
                        }
                    } catch (error) {
                        errorMsg.innerText = 'Network Error. Try again.';
                        errorMsg.classList.remove('hidden');
                    } finally {
                        btn.innerHTML = originalHtml;
                        btn.disabled = false;
                        input.focus();
                    }
                });
            }

            document.addEventListener('click', (e) => {
                const enterBtn = e.target.closest('.btn-enter-results');
                if (enterBtn) {
                    const vialId = enterBtn.getAttribute('data-vial');
                    const testName = enterBtn.getAttribute('data-test');
                    const patientName = enterBtn.getAttribute('data-patient');
                    const parametersStr = enterBtn.getAttribute('data-parameters');

                    document.getElementById('modalTestNameTitle').innerText = testName;
                    document.getElementById('modalVialIdText').innerText = vialId;
                    document.getElementById('modalPatientNameText').innerText = patientName;
                    document.getElementById('entryVialId').value = vialId;

                    const paramTableBody = document.getElementById('parametersTableBody');
                    paramTableBody.innerHTML = '';

                    try {
                        const parameters = JSON.parse(parametersStr);
                        if (parameters && parameters.length > 0) {
                            parameters.forEach(param => {
                                const rangeText = param.normalRange ? param.normalRange : 'N/A';
                                const unitText = param.unit ? param.unit : '';

                                let min = null, max = null;
                                if (param.normalRange && param.normalRange.includes('-')) {
                                    const parts = param.normalRange.split('-');
                                    min = parseFloat(parts[0]);
                                    max = parseFloat(parts[1]);
                                }

                                const row = document.createElement('tr');
                                row.className = 'hover:bg-blue-50/30 transition-colors group';
                                row.innerHTML = `
                                    <td class="px-4 py-4 font-bold text-gray-800 border-r border-gray-100">${param.parameterName}</td>
                                    <td class="px-4 py-3 border-r border-gray-100 relative">
                                        <input type="${param.inputType === 'number' ? 'number' : 'text'}" 
                                               step="0.01" 
                                               required 
                                               ${min !== null ? `data-min="${min}"` : ''} 
                                               ${max !== null ? `data-max="${max}"` : ''} 
                                               class="result-input w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-200 outline-none font-bold text-gray-900 transition-colors" 
                                               placeholder="Enter value">
                                    </td>
                                    <td class="px-4 py-4 text-gray-500 text-xs border-r border-gray-100">${unitText}</td>
                                    <td class="px-4 py-4 text-gray-600 text-xs border-r border-gray-100">${rangeText}</td>
                                    <td class="px-4 py-4 text-center flag-cell">
                                        <span class="text-gray-300 text-xs font-bold">-</span>
                                    </td>
                                `;
                                paramTableBody.appendChild(row);
                            });
                            attachValidationListeners();
                        } else {
                            paramTableBody.innerHTML = `<tr><td colspan="5" class="text-center py-4 text-gray-500">No parameters defined for this test.</td></tr>`;
                        }
                    } catch (error) {
                        console.error('Error parsing parameters', error);
                        paramTableBody.innerHTML = `<tr><td colspan="5" class="text-center py-4 text-red-500">Error loading parameters.</td></tr>`;
                    }

                    openModal('ResultEntryModalBackdrop');
                }

                if (e.target.closest('.close-modal-btn')) {
                    closeModal(e.target.closest('.close-modal-btn').getAttribute('data-modal'));
                }
            });

            function attachValidationListeners() {
                const inputs = document.querySelectorAll('.result-input[type="number"]');
                inputs.forEach(input => {
                    input.addEventListener('input', function () {
                        if (!this.hasAttribute('data-min') || !this.hasAttribute('data-max')) return;

                        const val = parseFloat(this.value);
                        const min = parseFloat(this.getAttribute('data-min'));
                        const max = parseFloat(this.getAttribute('data-max'));
                        const flagCell = this.closest('tr').querySelector('.flag-cell');

                        this.classList.remove('border-gray-300', 'border-red-500', 'border-yellow-500', 'bg-red-50', 'bg-yellow-50');

                        if (isNaN(val)) {
                            this.classList.add('border-gray-300');
                            flagCell.innerHTML = '<span class="text-gray-300 text-xs font-bold">-</span>';
                            return;
                        }

                        if (val < min) {
                            this.classList.add('border-yellow-500', 'bg-yellow-50');
                            flagCell.innerHTML = '<span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded font-black text-xs border border-yellow-200">L</span>';
                        } else if (val > max) {
                            this.classList.add('border-red-500', 'bg-red-50');
                            flagCell.innerHTML = '<span class="bg-red-100 text-red-700 px-2 py-1 rounded font-black text-xs border border-red-200">H</span>';
                        } else {
                            this.classList.add('border-gray-300');
                            flagCell.innerHTML = '<span class="text-green-500 text-xs font-bold"><i class="ph-bold ph-check"></i></span>';
                        }
                    });
                });
            }

            const searchInput = document.getElementById('searchWorklist');
            if (searchInput) {
                searchInput.addEventListener('input', function () {
                    const query = this.value.toLowerCase();
                    const rows = document.querySelectorAll('#worklistTableBody tr');
                    rows.forEach(row => {
                        const text = row.innerText.toLowerCase();
                        row.style.display = text.includes(query) ? '' : 'none';
                    });
                });
            }

            fetchStats();
            fetchWorklist();
        });
    </script>
</body>