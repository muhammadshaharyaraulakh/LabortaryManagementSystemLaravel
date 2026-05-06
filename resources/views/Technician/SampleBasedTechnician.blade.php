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
                    Dashboard</h1>
            </div>
            <div class="flex items-center gap-4">
                <div class="hidden md:flex flex-col items-end mr-4">
                    <span class="text-sm font-bold text-gray-800">{{ auth()->user()->name }}</span>
                    <span class="text-xs text-blue-500 font-bold">Technician</span>
                </div>
                <div
                    class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold border border-blue-200 uppercase">
                    {{ substr(auth()->user()->name, 0, 2) }}
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
                                    <th class="px-6 py-4">Tracking ID</th>
                                    <th class="px-6 py-4">Test Name</th>
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
        class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-4 opacity-0 transition-opacity duration-300">
        <div id="ResultEntryModal"
            class="bg-white w-full max-w-4xl rounded-3xl shadow-2xl transform scale-95 transition-all duration-300 flex flex-col max-h-[90vh]">
            <div class="px-8 py-6 border-b border-gray-100 flex items-center justify-between bg-gray-50/50 rounded-t-3xl">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center">
                        <i class="ph ph-flask text-2xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-black text-gray-900 tracking-tight" id="resultModalTestName">Result Entry</h3>
                        <p class="text-gray-500 text-sm font-bold mt-0.5" id="resultModalPatientName">Patient: -</p>
                    </div>
                </div>
                <button onclick="closeModal('ResultEntryModalBackdrop')"
                    class="text-gray-400 hover:text-gray-900 transition-colors cursor-pointer p-2 hover:bg-gray-100 rounded-xl">
                    <i class="ph ph-x text-2xl"></i>
                </button>
            </div>

            <div class="p-8 overflow-y-auto custom-scrollbar flex-1">
                <form id="resultForm" class="space-y-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8" id="parametersContainer">
                    </div>
                </form>
            </div>

            <div class="px-8 py-6 border-t border-gray-100 bg-gray-50/50 rounded-b-3xl flex justify-end gap-4">
                <button onclick="closeModal('ResultEntryModalBackdrop')"
                    class="px-8 py-3 rounded-2xl font-bold text-gray-600 hover:bg-gray-200 transition-all active:scale-95 cursor-pointer">
                    Cancel
                </button>
                <button id="saveResultsBtn"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-10 py-3 rounded-2xl font-bold transition-all shadow-lg shadow-blue-200 active:scale-95 flex items-center gap-2 cursor-pointer">
                    <i class="ph ph-check-circle text-lg"></i> Complete Test
                </button>
            </div>
        </div>
    </div>

    <!-- Sample Confirmation Modal -->
    <div id="SampleConfirmationModalBackdrop"
        class="fixed inset-0 bg-black/50 z-[60] hidden items-center justify-center p-4 opacity-0 transition-opacity duration-300">
        <div id="SampleConfirmationModal"
            class="bg-white w-full max-w-md rounded-3xl shadow-2xl transform scale-95 transition-all duration-300 flex flex-col">
            <div class="px-8 py-6 border-b border-gray-100 flex items-center justify-between bg-gray-50/50 rounded-t-3xl">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center">
                        <i class="ph-duotone ph-scan text-xl"></i>
                    </div>
                    <h3 class="text-lg font-black text-gray-900 tracking-tight">Sample Received</h3>
                </div>
                <button onclick="closeModal('SampleConfirmationModalBackdrop')"
                    class="text-gray-400 hover:text-gray-900 transition-colors cursor-pointer p-1">
                    <i class="ph ph-x text-xl"></i>
                </button>
            </div>
            <div class="p-8 space-y-4">
                <div class="bg-indigo-50 border border-indigo-100 rounded-2xl p-4">
                    <p class="text-xs text-indigo-400 font-black uppercase tracking-widest mb-1">Patient Details</p>
                    <h4 class="text-lg font-black text-indigo-900" id="confPatientName">-</h4>
                    <p class="text-sm text-indigo-700 font-bold" id="confTestName">-</p>
                </div>
                <p class="text-sm text-gray-500 font-bold leading-relaxed text-center">
                    Please confirm if you want to accept this sample for testing or reject it due to quality issues.
                </p>
            </div>
            <div class="px-8 py-6 border-t border-gray-100 bg-gray-50/50 rounded-b-3xl grid grid-cols-2 gap-4">
                <button id="btnRejectInConf"
                    class="flex items-center justify-center gap-2 bg-white border-2 border-red-100 text-red-600 px-6 py-3 rounded-2xl font-bold hover:bg-red-50 transition-all active:scale-95 cursor-pointer">
                    <i class="ph ph-x-circle text-lg"></i> Reject
                </button>
                <button id="btnAcceptInConf"
                    class="flex items-center justify-center gap-2 bg-indigo-600 text-white px-6 py-3 rounded-2xl font-bold hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-200 active:scale-95 cursor-pointer">
                    <i class="ph ph-check-circle text-lg"></i> Accept
                </button>
            </div>
        </div>
    </div>

    <!-- Reject Sample Modal -->
    <div id="RejectSampleModalBackdrop"
        class="fixed inset-0 bg-black/50 z-[70] hidden items-center justify-center p-4 opacity-0 transition-opacity duration-300">
        <div id="RejectSampleModal"
            class="bg-white w-full max-w-md rounded-3xl shadow-2xl transform scale-95 transition-all duration-300 flex flex-col">
            <div class="px-8 py-6 border-b border-gray-100 flex items-center justify-between bg-gray-50/50 rounded-t-3xl">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-red-50 text-red-600 rounded-xl flex items-center justify-center">
                        <i class="ph-duotone ph-warning-circle text-xl"></i>
                    </div>
                    <h3 class="text-lg font-black text-gray-900 tracking-tight">Rejection Reason</h3>
                </div>
                <button onclick="closeModal('RejectSampleModalBackdrop')"
                    class="text-gray-400 hover:text-gray-900 transition-colors p-1 cursor-pointer">
                    <i class="ph ph-x text-xl"></i>
                </button>
            </div>
            <div class="p-8">
                <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Reason for Rejection <span class="text-red-500">*</span></label>
                <select id="rejectionReasonSelect"
                    class="w-full border-2 border-gray-100 rounded-2xl px-4 py-3 text-sm font-bold focus:border-red-400 focus:ring-0 outline-none bg-gray-50/50 mb-4 cursor-pointer transition-all">
                    <option disabled selected>Select a reason...</option>
                    <option>Hemolyzed Sample</option>
                    <option>Insufficient Quantity</option>
                    <option>Clotted Sample</option>
                    <option>Wrong Container/Tube</option>
                    <option>Other (Specify below)</option>
                </select>
                <textarea id="rejectionReasonText" rows="3"
                    class="w-full border-2 border-gray-100 rounded-2xl px-4 py-3 text-sm font-bold focus:border-red-400 focus:ring-0 outline-none bg-gray-50/50 resize-none transition-all"
                    placeholder="Additional details..."></textarea>
            </div>
            <div class="px-8 py-6 border-t border-gray-100 bg-gray-50/50 rounded-b-3xl flex items-center justify-end gap-3">
                <button onclick="closeModal('RejectSampleModalBackdrop')"
                    class="px-6 py-3 rounded-2xl font-bold text-gray-600 hover:bg-gray-200 transition-all active:scale-95 cursor-pointer">Cancel</button>
                <button id="ConfirmRejectBtn"
                    class="bg-red-600 hover:bg-red-700 text-white px-8 py-3 rounded-2xl font-bold transition-all shadow-lg shadow-red-200 active:scale-95 cursor-pointer">Confirm Rejection</button>
            </div>
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

                    const target = link.getAttribute('data-target');
                    const title = link.getAttribute('data-title');
                    switchSection(target, title);

                    if (target === 'section-dashboard') fetchStats();
                    if (target === 'section-worklist') fetchWorklist();
                    if (target === 'section-completed') fetchPendingVerifications();

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

            function openModal(backdropId, modalId) {
                const backdrop = document.getElementById(backdropId);
                const modal = document.getElementById(modalId || backdropId.replace('Backdrop', ''));
                if (!backdrop || !modal) return;
                backdrop.classList.remove('hidden');
                backdrop.classList.add('flex');
                requestAnimationFrame(() => {
                    backdrop.classList.remove('opacity-0');
                    modal.classList.remove('scale-95');
                    modal.classList.add('scale-100');
                });
            }

            function closeModal(backdropId) {
                const backdrop = document.getElementById(backdropId);
                if (!backdrop) return;
                const modal = backdrop.firstElementChild;
                backdrop.classList.add('opacity-0');
                if (modal) {
                    modal.classList.remove('scale-100');
                    modal.classList.add('scale-95');
                }
                setTimeout(() => {
                    backdrop.classList.remove('flex');
                    backdrop.classList.add('hidden');
                }, 300);
            }

            window.closeModal = closeModal;

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
                    console.error(error);
                }
            }

            async function fetchWorklist() {
                try {
                    const response = await fetch('/TechnicianWorklist');
                    if (response.ok) {
                        const result = await response.json();
                        if (result.status === true) {
                            renderWorklist(result.data);
                        }
                    }
                } catch (error) {
                    console.error(error);
                }
            }

            function renderWorklist(orders) {
                const tbody = document.getElementById('worklistTableBody');
                const badge = document.getElementById('worklist-count-badge');
                tbody.innerHTML = '';
                let testCount = 0;

                if (!orders || orders.length === 0) {
                    tbody.innerHTML = `
                        <tr>
                            <td colspan="4" class="px-6 py-20 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-20 h-20 bg-blue-50 rounded-full flex items-center justify-center mb-4">
                                        <i class="ph-duotone ph-flask text-4xl text-blue-400"></i>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-900">Your Worklist is Empty</h3>
                                    <p class="text-gray-500 text-sm mt-1 max-w-xs mx-auto">Scan a sample barcode on the dashboard to start a test.</p>
                                </div>
                            </td>
                        </tr>`;
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
                                        data-order-test-id="${test.pivot.id}"
                                        data-tracking-id="${order.trackingId}"
                                        data-test="${test.name}"
                                        data-patient="${order.name}">
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

            const barcodeInput = document.getElementById('barcodeScannerInput');
            let currentSampleBarcode = null;
            let currentOrderTestId = null;

            barcodeInput.addEventListener('keypress', async (e) => {
                if (e.key === 'Enter') {
                    const barcode = barcodeInput.value.trim();
                    if (!barcode) return;
                    currentSampleBarcode = barcode;
                    try {
                        const response = await fetch('/getSampleInfo', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({ BarcodeNumber: barcode })
                        });

                        const resData = await response.json();
                        if (response.ok && resData.status === true) {
                            currentOrderTestId = resData.data.orderTestId;
                            document.getElementById('confPatientName').innerText = resData.data.patientName;
                            document.getElementById('confTestName').innerText = resData.data.testName;
                            
                            if(resData.data.status !== 'Collected'){
                                alert('This sample is already ' + resData.data.status);
                                barcodeInput.value = '';
                                return;
                            }

                            openModal('SampleConfirmationModalBackdrop', 'SampleConfirmationModal');
                            barcodeInput.value = '';
                        }
                    } catch (error) {
                        console.error(error);
                    }
                }
            });

            document.getElementById('btnAcceptInConf').addEventListener('click', async () => {
                const btn = document.getElementById('btnAcceptInConf');
                const originalHtml = btn.innerHTML;
                btn.innerHTML = '<i class="ph ph-spinner animate-spin"></i> Processing...';
                btn.disabled = true;

                try {
                    const response = await fetch('/ReceiveSample', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ BarcodeNumber: currentSampleBarcode })
                    });

                    const resData = await response.json();
                    if (response.ok && resData.status === true) {
                        closeModal('SampleConfirmationModalBackdrop');
                        fetchWorklist();
                        fetchStats();
                    } else {
                        alert(resData.message || 'Failed to receive sample.');
                    }
                } catch (error) {
                    alert('Network Error.');
                } finally {
                    btn.innerHTML = originalHtml;
                    btn.disabled = false;
                }
            });

            document.getElementById('btnRejectInConf').addEventListener('click', () => {
                closeModal('SampleConfirmationModalBackdrop');
                setTimeout(() => {
                    openModal('RejectSampleModalBackdrop', 'RejectSampleModal');
                }, 300);
            });

            document.getElementById('ConfirmRejectBtn').addEventListener('click', async () => {
                const reasonSelect = document.getElementById('rejectionReasonSelect');
                const reasonText = document.getElementById('rejectionReasonText');
                const reason = reasonSelect.value === 'Other (Specify below)' ? reasonText.value : reasonSelect.value;

                if (!reason || reason === 'Select a reason...') {
                    alert('Please select or specify a reason.');
                    return;
                }

                const btn = document.getElementById('ConfirmRejectBtn');
                const originalHtml = btn.innerHTML;
                btn.innerHTML = '<i class="ph ph-spinner animate-spin"></i> Processing...';
                btn.disabled = true;

                try {
                    const response = await fetch('/rejectSample', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ orderTestId: currentOrderTestId, reason: reason })
                    });

                    const resData = await response.json();
                    if (response.ok && resData.status === 200) {
                        closeModal('RejectSampleModalBackdrop');
                        fetchStats();
                        const msgEl = document.createElement('div');
                        msgEl.className = 'fixed top-5 right-5 bg-red-500 text-white px-6 py-3 rounded-xl shadow-lg z-50 animate-fade-in font-bold text-sm flex items-center gap-2';
                        msgEl.innerHTML = `<i class="ph-fill ph-warning-circle text-lg"></i> Sample Rejected.`;
                        document.body.appendChild(msgEl);
                        setTimeout(() => {
                            msgEl.style.opacity = '0';
                            msgEl.style.transition = 'opacity 0.3s ease';
                            setTimeout(() => msgEl.remove(), 300);
                        }, 3000);
                    } else {
                        alert(resData.message || 'Failed to reject sample.');
                    }
                } catch (error) {
                    alert('Network Error.');
                } finally {
                    btn.innerHTML = originalHtml;
                    btn.disabled = false;
                }
            });

            document.addEventListener('click', async (e) => {
                const enterBtn = e.target.closest('.btn-enter-results');
                if (enterBtn) {
                    const orderTestId = enterBtn.getAttribute('data-order-test-id');
                    const trackingId = enterBtn.getAttribute('data-tracking-id');
                    const testName = enterBtn.getAttribute('data-test');
                    const patientName = enterBtn.getAttribute('data-patient');

                    document.getElementById('resultModalTestName').innerText = testName;
                    document.getElementById('resultModalPatientName').innerText = `Patient: ${patientName}`;
                    
                    const parametersContainer = document.getElementById('parametersContainer');
                    parametersContainer.innerHTML = `<div class="col-span-full text-center py-12"><i class="ph-bold ph-spinner animate-spin text-4xl text-blue-500 mb-4"></i><p class="text-gray-500 font-bold">Loading parameters...</p></div>`;

                    openModal('ResultEntryModalBackdrop');

                    try {
                        const res = await fetch(`/getOrderTestParameters/${orderTestId}`, {
                            headers: {
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            }
                        });

                        const result = await res.json();
                        if (!res.ok || result.status !== true) throw new Error(result.message || 'Failed to load parameters.');

                        const parameters = result.data.parameters;
                        parametersContainer.innerHTML = '';

                        parameters.forEach(param => {
                            const type = (param.inputType || param.type || 'quantitative').toLowerCase().trim();
                            let inputHtml = '';

                            if (type === 'quantitative') {
                                inputHtml = `<div class="space-y-2">
                                    <div class="flex justify-between items-center mb-1">
                                        <label class="text-sm font-black text-gray-700">${param.parameterName}</label>
                                        <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest bg-gray-50 px-2 py-0.5 rounded-md border border-gray-100">${param.unit || 'No Unit'}</span>
                                    </div>
                                    <input type="number" step="0.01" required data-param-id="${param.id}" 
                                        class="result-input w-full border-2 border-gray-100 rounded-2xl px-5 py-3.5 focus:border-blue-400 focus:ring-0 outline-none font-bold text-gray-900 bg-gray-50/30 transition-all" 
                                        placeholder="Enter value...">
                                    <div class="flex justify-between items-center mt-1.5 px-1">
                                        <span class="text-[10px] font-bold text-gray-400">Range: ${param.normalRange || 'N/A'}</span>
                                        <div class="flag-indicator"></div>
                                    </div>
                                </div>`;
                            } else if (type === 'qualitative') {
                                let options = (param.options || 'Positive,Negative').split(',');
                                let optionsHtml = options.map(o => `<option value="${o.trim()}">${o.trim()}</option>`).join('');
                                inputHtml = `<div class="space-y-2">
                                    <label class="text-sm font-black text-gray-700 block mb-1">${param.parameterName}</label>
                                    <select required data-param-id="${param.id}" class="result-input w-full border-2 border-gray-100 rounded-2xl px-5 py-3.5 focus:border-blue-400 focus:ring-0 outline-none font-bold text-gray-900 bg-gray-50/30 transition-all cursor-pointer">
                                        <option value="" disabled selected>Select result...</option>
                                        ${optionsHtml}
                                    </select>
                                </div>`;
                            } else if (type === 'observational') {
                                inputHtml = `<div class="col-span-full space-y-2">
                                    <label class="text-sm font-black text-gray-700 block mb-1">${param.parameterName}</label>
                                    <textarea required data-param-id="${param.id}" rows="3" class="result-input w-full border-2 border-gray-100 rounded-2xl px-5 py-3.5 focus:border-blue-400 focus:ring-0 outline-none font-bold text-gray-900 bg-gray-50/30 transition-all resize-none" placeholder="Enter detailed observations..."></textarea>
                                </div>`;
                            } else if (type === 'image') {
                                inputHtml = `<div class="col-span-full space-y-2 bg-gray-50 p-6 rounded-2xl border-2 border-dashed border-gray-200">
                                    <label class="text-sm font-black text-gray-700 block mb-1">${param.parameterName}</label>
                                    <input type="file" multiple accept="image/*" class="param-image-upload hidden" id="file-${param.id}">
                                    <label for="file-${param.id}" class="flex flex-col items-center justify-center gap-3 cursor-pointer p-4 hover:bg-gray-100 rounded-xl transition-all">
                                        <i class="ph ph-cloud-arrow-up text-3xl text-blue-500"></i>
                                        <span class="text-sm font-bold text-gray-500">Click to upload diagnostic images</span>
                                    </label>
                                    <input type="hidden" required data-param-id="${param.id}" class="result-input">
                                    <div class="upload-status text-xs font-bold text-center mt-2"></div>
                                </div>`;
                            }

                            parametersContainer.insertAdjacentHTML('beforeend', inputHtml);
                        });

                        // Re-attach image upload logic for new inputs
                        document.querySelectorAll('.param-image-upload').forEach(input => {
                            input.addEventListener('change', async (e) => {
                                const files = e.target.files;
                                if (!files.length) return;
                                const status = e.target.parentElement.querySelector('.upload-status');
                                const hidden = e.target.parentElement.querySelector('.result-input');
                                const formData = new FormData();
                                for (let f of files) formData.append('files[]', f);
                                
                                status.innerText = 'Uploading...';
                                status.className = 'upload-status text-xs font-bold text-center mt-2 text-blue-500';
                                
                                try {
                                    const up = await fetch('/uploadHumanResultFile', {
                                        method: 'POST',
                                        headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') },
                                        body: formData
                                    });
                                    const data = await up.json();
                                    if (data.status) {
                                        hidden.value = JSON.stringify(data.data.paths);
                                        status.innerText = `${files.length} images uploaded successfully`;
                                        status.className = 'upload-status text-xs font-bold text-center mt-2 text-green-500';
                                    }
                                } catch (err) {
                                    status.innerText = 'Upload failed';
                                    status.className = 'upload-status text-xs font-bold text-center mt-2 text-red-500';
                                }
                            });
                        });

                        // Add resultForm submit listener
                        document.getElementById('saveResultsBtn').onclick = async () => {
                            const btn = document.getElementById('saveResultsBtn');
                            const originalHtml = btn.innerHTML;
                            btn.innerHTML = '<i class="ph ph-spinner animate-spin"></i> Saving...';
                            btn.disabled = true;

                            const inputs = document.querySelectorAll('.result-input');
                            const resultsArray = [];
                            inputs.forEach(input => {
                                resultsArray.push({
                                    testParameterId: input.getAttribute('data-param-id'),
                                    resultValue: input.value,
                                    statusFlag: 'Normal' // Simple flag for now
                                });
                            });

                            try {
                                const response = await fetch('/addResult', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'Accept': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                    },
                                    body: JSON.stringify({
                                        orderTestId: orderTestId,
                                        trackingId: trackingId,
                                        results: resultsArray
                                    })
                                });

                                const resData = await response.json();
                                if (response.ok && resData.status === 200) {
                                    closeModal('ResultEntryModalBackdrop');
                                    fetchWorklist();
                                    fetchStats();
                                } else {
                                    alert(resData.message || 'Failed to save results.');
                                }
                            } catch (err) {
                                alert('Network Error.');
                            } finally {
                                btn.innerHTML = originalHtml;
                                btn.disabled = false;
                            }
                        };

                    } catch (err) {
                        console.error(err);
                        alert('Failed to load test parameters.');
                    }
                }
            });

            async function fetchPendingVerifications() {
                try {
                    const response = await fetch('/getPendingVerifications');
                    if (response.ok) {
                        const result = await response.json();
                        if (result.status === true) renderPendingVerifications(result.data);
                    }
                } catch (error) {
                    console.error(error);
                }
            }

            function renderPendingVerifications(orders) {
                const tbody = document.getElementById('completedTableBody');
                tbody.innerHTML = '';

                if (!orders || orders.length === 0) {
                    tbody.innerHTML = `<tr><td colspan="3" class="px-6 py-20 text-center"><div class="flex flex-col items-center justify-center"><div class="w-20 h-20 bg-purple-50 rounded-full flex items-center justify-center mb-4"><i class="ph-duotone ph-clipboard-text text-4xl text-purple-400"></i></div><h3 class="text-lg font-bold text-gray-900">No Pending Verifications</h3><p class="text-gray-500 text-sm mt-1 max-w-xs mx-auto">Tests you complete will appear here until the pathologist verifies them.</p></div></td></tr>`;
                    return;
                }

                orders.forEach(order => {
                    if (order.tests) {
                        order.tests.forEach(test => {
                            const tr = document.createElement('tr');
                            tr.className = 'hover:bg-gray-50 transition-colors animate-fade-in';
                            tr.innerHTML = `<td class="px-6 py-4 font-mono text-sm text-gray-700">${order.trackingId}</td><td class="px-6 py-4 font-bold text-gray-700">${test.name}</td><td class="px-6 py-4"><span class="bg-yellow-50 text-yellow-600 px-3 py-1 rounded-full text-xs font-bold border border-yellow-100">Pending</span></td>`;
                            tbody.appendChild(tr);
                        });
                    }
                });
            }

            fetchStats();
        });
    </script>
</body>

</html>