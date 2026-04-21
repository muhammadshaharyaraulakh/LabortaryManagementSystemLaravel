<x-header />

<body class="font-sans antialiased bg-mainBg text-gray-800 flex h-screen overflow-hidden">

    <div id="sidebar-backdrop"
        class="fixed inset-0 bg-black/50 z-40 hidden transition-opacity md:hidden cursor-pointer"></div>

    <aside id="sidebar"
        class="bg-sidebarBg text-white w-64 shrink-0 transition-all duration-300 flex flex-col fixed inset-y-0 left-0 z-50 md:relative transform -translate-x-full md:translate-x-0">
        <div class="h-20 flex items-center justify-between px-6 pt-2">
            <span id="brand-text" class="text-white text-xl font-bold whitespace-nowrap tracking-wide">Collector</span>
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
                data-target="section-pending" data-title="Pending Collections">
                <i class="ph-duotone ph-needle text-2xl w-7 text-center text-white transition-colors nav-icon"></i>
                <span class="ml-3 nav-text whitespace-nowrap">Pending Collections</span>
            </a>



            <a href="#"
                class="nav-link flex items-center px-6 py-3 text-gray-300 hover:bg-white/10 hover:text-white transition-colors group cursor-pointer"
                data-target="section-tests" data-title="Tests">
                <i
                    class="ph-duotone ph-flask text-2xl w-7 text-center text-gray-400 group-hover:text-white transition-colors nav-icon"></i>
                <span class="ml-3 nav-text whitespace-nowrap">Tests</span>
            </a>

            <a href="#"
                class="nav-link flex items-center px-6 py-3 text-gray-300 hover:bg-white/10 hover:text-white transition-colors group cursor-pointer"
                data-target="section-history" data-title="Collection History">
                <i
                    class="ph-duotone ph-clock-counter-clockwise text-2xl w-7 text-center text-gray-400 group-hover:text-white transition-colors nav-icon"></i>
                <span class="ml-3 nav-text whitespace-nowrap">My History</span>
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
                    Pending Collections
                </h1>
            </div>
            <button
                class="bg-gray-100 hover:bg-gray-200 p-2 rounded-full transition-colors cursor-pointer text-gray-600">
                <i class="ph-bold ph-bell text-xl"></i>
            </button>
        </header>

        <main class="flex-1 overflow-y-auto p-4 md:p-10 pt-2 relative">

            <div id="section-pending" class="content-section block animate-fade-in w-full max-w-7xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white rounded-2xl shadow-[0_4px_20px_rgba(0,0,0,0.03)] p-6 border border-gray-50">
                        <div
                            class="w-12 h-12 rounded-lg bg-orange-50 text-orange-500 flex items-center justify-center mb-4">
                            <i class="ph-duotone ph-users text-2xl"></i>
                        </div>
                        <h3 class="text-3xl font-black text-black mb-1" id="stat-waiting">0</h3>
                        <p class="text-gray-500 font-medium">Waiting Patients</p>
                    </div>
                </div>

                <div
                    class="bg-white rounded-[1.25rem] shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-50 overflow-hidden w-full">
                    <div
                        class="p-5 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-gray-50/50">
                        <h3 class="text-base font-bold text-gray-800">Queue List</h3>
                        <div class="relative w-full sm:w-72">
                            <input type="text" id="searchQueue" placeholder="Search Order ID or Patient..."
                                class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-orange-100 bg-white">
                            <i class="ph ph-magnifying-glass absolute left-3 top-2.5 text-gray-400"></i>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm whitespace-nowrap">
                            <thead class="bg-gray-50 text-gray-700 font-bold border-b border-gray-100">
                                <tr>
                                    <th class="px-6 py-4">Order ID</th>
                                    <th class="px-6 py-4">Patient Details</th>
                                    <th class="px-6 py-4">Total Tests</th>
                                    <th class="px-6 py-4 text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody id="pendingQueueTableBody" class="divide-y divide-gray-50">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div id="section-order-details" class="content-section hidden animate-fade-in w-full max-w-7xl mx-auto">
                <button
                    class="btn-back-queue mb-6 flex items-center gap-2 text-gray-500 hover:text-orange-600 font-bold text-sm transition-colors cursor-pointer">
                    <i class="ph-bold ph-arrow-left text-lg"></i> Back to Queue
                </button>

                <div
                    class="bg-white rounded-[1.25rem] shadow-sm border border-gray-50 p-6 mb-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div>
                        <h2 class="text-2xl font-black text-gray-800" id="detail-patient-name"></h2>
                        <p class="text-gray-500 font-medium text-sm mt-1" id="detail-patient-info"></p>
                    </div>
                    <div class="text-left md:text-right">
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Order Tracking ID</p>
                        <h3 class="text-xl font-black text-blue-600" id="detail-order-id"></h3>
                    </div>
                </div>

                <div
                    class="bg-white rounded-[1.25rem] shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-50 overflow-hidden w-full">
                    <div class="p-5 border-b border-gray-100 bg-gray-50/50">
                        <h3 class="text-base font-bold text-gray-800">Required Samples for this Order</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm whitespace-nowrap">
                            <thead class="bg-gray-50 text-gray-700 font-bold border-b border-gray-100">
                                <tr>
                                    <th class="px-6 py-4">Test Code</th>
                                    <th class="px-6 py-4">Test Name</th>
                                    <th class="px-6 py-4">Department</th>
                                    <th class="px-6 py-4 text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody id="orderDetailsTableBody" class="divide-y divide-gray-50">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <x-tests />
            <x-settings />

        </main>
    </div>

    <div id="CollectModalBackdrop"
        class="fixed inset-0 bg-black/60 z-60 hidden items-center justify-center p-4 opacity-0 transition-opacity duration-300">
        <div id="CollectModal"
            class="bg-white w-full max-w-md rounded-[1.25rem] shadow-2xl transform scale-95 transition-all duration-300 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-orange-50/30">
                <h3 class="font-bold text-gray-800 flex items-center gap-2">Collection for <span id="modalPatientName"
                        class="text-orange-600"></span>
                </h3>
                <button class="close-modal-btn text-gray-400 hover:text-gray-800 transition-colors cursor-pointer"
                    data-modal="CollectModalBackdrop">
                    <i class="ph ph-x text-lg"></i>
                </button>
            </div>
            <form id="SampleCollectionForm" class="p-6 space-y-5">
                <input type="hidden" id="modalOrderId" value="" name="order_id">
                <input type="hidden" id="modalTestId" value="" name="test_id">

                <div>
                    <label class="block text-xs font-black text-gray-500 uppercase mb-2">Assign Vial / Container
                        ID</label>
                    <div class="relative">
                        <i class="ph ph-barcode absolute left-4 top-3.5 text-gray-400 text-lg"></i>
                        <input type="text" id="vialIdInput" name="vial_number" placeholder="Scanned Barcode Number"
                            class="w-full pl-11 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-100 outline-none bg-gray-50/50 font-mono text-sm transition-all">
                    </div>
                </div>

                <div class="bg-blue-50 rounded-xl p-4 border border-blue-100">
                    <p class="text-xs text-blue-700 font-medium leading-relaxed">
                        <i class="ph-fill ph-info mr-1"></i> Ensure patient identity is verified against the Order ID
                        before sample extraction.
                    </p>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="button"
                        class="close-modal-btn flex-1 py-3 text-sm font-bold text-gray-600 bg-gray-100 rounded-xl hover:bg-gray-200 transition-colors cursor-pointer"
                        data-modal="CollectModalBackdrop">Cancel</button>
                    <button type="submit" id="submitCollectionBtn"
                        class="flex-1 py-3 text-sm font-bold text-white bg-sidebarBg rounded-xl hover:bg-gray-800 shadow-lg shadow-gray-200 transition-all cursor-pointer flex justify-center items-center gap-2">
                        Submit to Lab
                    </button>
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
            const openSidebarBtn = document.getElementById('open-mobile-sidebar');
            const closeSidebarBtn = document.getElementById('close-mobile-sidebar');

            function toggleSidebar() {
                if (sidebar) sidebar.classList.toggle('-translate-x-full');
                if (sidebarBackdrop) sidebarBackdrop.classList.toggle('hidden');
            }

            if (openSidebarBtn) openSidebarBtn.addEventListener('click', toggleSidebar);
            if (closeSidebarBtn) closeSidebarBtn.addEventListener('click', toggleSidebar);
            if (sidebarBackdrop) sidebarBackdrop.addEventListener('click', toggleSidebar);

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

            const pendingQueueTableBody = document.getElementById('pendingQueueTableBody');
            const orderDetailsTableBody = document.getElementById('orderDetailsTableBody');
            const searchQueueInput = document.getElementById('searchQueue');
            let allPendingOrders = [];

            async function fetchPendingOrders() {
                if (!pendingQueueTableBody) return;
                pendingQueueTableBody.innerHTML = `<tr><td colspan="4" class="px-6 py-8 text-center"><i class="ph-bold ph-spinner animate-spin text-2xl text-orange-500"></i><p class="text-sm text-gray-500 mt-2">Loading queue...</p></td></tr>`;

                try {
                    const response = await fetch('/PendingOrders', {
                        headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
                    });
                    const result = await response.json();

                    if (response.ok && result.status === 200) {
                        allPendingOrders = result.data;
                        renderPendingOrders(allPendingOrders);
                        updateDashboardStats(allPendingOrders.length);
                    } else {
                        pendingQueueTableBody.innerHTML = `<tr><td colspan="4" class="px-6 py-8 text-center text-gray-500 font-medium">${result.message || 'No pending collections found.'}</td></tr>`;
                        updateDashboardStats(0);
                    }
                } catch (error) {
                    pendingQueueTableBody.innerHTML = `<tr><td colspan="4" class="px-6 py-8 text-center text-red-500 font-medium">Network error.</td></tr>`;
                }
            }

            function renderPendingOrders(orders) {
                if (!pendingQueueTableBody) return;
                pendingQueueTableBody.innerHTML = '';

                if (orders.length === 0) {
                    pendingQueueTableBody.innerHTML = `<tr><td colspan="4" class="px-6 py-8 text-center text-gray-500 font-medium">No patients waiting in queue.</td></tr>`;
                    return;
                }

                orders.forEach(order => {
                    const row = `
                <tr class="hover:bg-gray-50 transition-colors animate-fade-in">
                    <td class="px-6 py-4 font-bold text-blue-600">${order.trackingId}</td>
                    <td class="px-6 py-4">
                        <p class="font-bold text-gray-800">${order.name}</p>
                        <p class="text-xs text-gray-500">${order.gender}, ${order.age}y | ${order.phone}</p>
                    </td>
                    <td class="px-6 py-4 font-bold text-gray-700">
                        <span class="bg-gray-100 px-3 py-1 rounded-full">${order.tests.length} Tests</span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <button class="btn-view-details bg-white border border-purple-200 text-purple-600 px-5 py-2 rounded-lg text-sm font-bold cursor-pointer" data-id="${order.id}">
                            View Details
                        </button>
                    </td>
                </tr>
            `;
                    pendingQueueTableBody.innerHTML += row;
                });
            }

            document.addEventListener('click', (e) => {
                const viewBtn = e.target.closest('.btn-view-details');
                if (viewBtn) {
                    const orderId = parseInt(viewBtn.getAttribute('data-id'));
                    openOrderDetails(orderId);
                }

                const backBtn = e.target.closest('.btn-back-queue');
                if (backBtn) {
                    switchSection('section-pending', 'Pending Collections');
                }

                const collectBtn = e.target.closest('.btn-collect-test');
                if (collectBtn) {
                    const orderId = collectBtn.getAttribute('data-order-id');
                    const testId = collectBtn.getAttribute('data-test-id');
                    const testName = collectBtn.getAttribute('data-test-name');
                    const patientName = collectBtn.getAttribute('data-patient-name');

                    document.getElementById('modalPatientName').innerText = `${patientName} (${testName})`;
                    document.getElementById('modalOrderId').value = orderId;
                    document.getElementById('modalTestId').value = testId;

                    const vialInput = document.getElementById('vialIdInput');
                    vialInput.value = '';
                    vialInput.classList.remove('border-red-500', 'focus:ring-red-100');
                    vialInput.classList.add('border-gray-200', 'focus:ring-orange-100');

                    const existingError = document.getElementById('vial-error');
                    if (existingError) existingError.remove();

                    const existingGeneralError = document.getElementById('general-error');
                    if (existingGeneralError) existingGeneralError.remove();

                    openModal('CollectModalBackdrop');
                }

                const closeBtn = e.target.closest('.close-modal-btn');
                if (closeBtn) {
                    closeModal(closeBtn.getAttribute('data-modal'));
                }
            });

            function openOrderDetails(orderId) {
                const order = allPendingOrders.find(o => o.id === orderId);
                if (!order) return;

                document.getElementById('detail-patient-name').innerText = order.name;
                document.getElementById('detail-patient-info').innerText = `${order.gender}, ${order.age}y | ${order.phone}`;
                document.getElementById('detail-order-id').innerText = order.trackingId;

                orderDetailsTableBody.innerHTML = '';
                order.tests.forEach(test => {
                    const deptName = test.department ? test.department.name : 'Unknown';
                    const isCollected = test.pivot && test.pivot.status === 'Collected';

                    let actionHtml = '';
                    if (isCollected) {
                        actionHtml = `<span class="text-green-600 font-bold text-xs"><i class="ph-fill ph-check-circle text-lg align-middle mr-1"></i> Collected</span>`;
                    } else {
                        actionHtml = `<button class="btn-collect-test bg-sidebarBg text-white px-4 py-2 rounded-xl text-xs font-bold shadow-md hover:bg-gray-800 transition-all cursor-pointer" data-order-id="${order.id}" data-test-id="${test.id}" data-test-name="${test.name}" data-patient-name="${order.name}">Assign Barcode</button>`;
                    }

                    const row = `
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 font-mono text-xs text-gray-500">${test.code}</td>
                    <td class="px-6 py-4 font-bold text-gray-800">${test.name}</td>
                    <td class="px-6 py-4">
                        <span class="bg-orange-50 text-orange-600 px-2 py-0.5 rounded text-[10px] font-bold border border-orange-100">${deptName}</span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        ${actionHtml}
                    </td>
                </tr>
            `;
                    orderDetailsTableBody.innerHTML += row;
                });

                switchSection('section-order-details', 'Order Details');
            }

            if (searchQueueInput) {
                searchQueueInput.addEventListener('input', (e) => {
                    const query = e.target.value.toLowerCase().trim();
                    const filteredOrders = allPendingOrders.filter(order => {
                        return order.name.toLowerCase().includes(query) ||
                            order.trackingId.toLowerCase().includes(query) ||
                            order.phone.includes(query);
                    });
                    renderPendingOrders(filteredOrders);
                });
            }

            function updateDashboardStats(count) {
                const waitingStatEl = document.getElementById('stat-waiting');
                if (waitingStatEl) waitingStatEl.innerText = count;
            }

            function showGeneralError(message) {
                const btnContainer = document.getElementById('submitCollectionBtn').parentElement;
                const existingGeneralError = document.getElementById('general-error');
                if (existingGeneralError) existingGeneralError.remove();

                const errorMsg = document.createElement('p');
                errorMsg.id = 'general-error';
                errorMsg.className = 'text-xs font-bold text-red-500 mb-4 w-full text-center animate-fade-in block';
                errorMsg.innerText = message;
                btnContainer.parentNode.insertBefore(errorMsg, btnContainer);
            }

            const collectionForm = document.getElementById('SampleCollectionForm');
            if (collectionForm) {
                collectionForm.addEventListener('submit', async (e) => {
                    e.preventDefault();

                    const btn = document.getElementById('submitCollectionBtn');
                    const originalHtml = btn.innerHTML;

                    const vialInput = document.getElementById('vialIdInput');
                    const orderId = document.getElementById('modalOrderId').value;
                    const testId = document.getElementById('modalTestId').value;
                    const vialNumber = vialInput.value.trim();

                    const existingError = document.getElementById('vial-error');
                    if (existingError) existingError.remove();

                    const existingGeneralError = document.getElementById('general-error');
                    if (existingGeneralError) existingGeneralError.remove();

                    vialInput.classList.remove('border-red-500', 'focus:ring-red-100');
                    vialInput.classList.add('border-gray-200', 'focus:ring-orange-100');

                    btn.innerHTML = `<i class="ph-bold ph-spinner animate-spin"></i> Processing...`;
                    btn.disabled = true;

                    try {
                        const response = await fetch('/CollectSample', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                            },
                            body: JSON.stringify({
                                order_id: orderId,
                                test_id: testId,
                                vial_number: vialNumber
                            })
                        });

                        const result = await response.json();

                        if (response.status === 422) {
                            if (result.errors && result.errors.vial_number) {
                                vialInput.classList.remove('border-gray-200', 'focus:ring-orange-100');
                                vialInput.classList.add('border-red-500', 'focus:ring-red-100');

                                const errorMsg = document.createElement('p');
                                errorMsg.id = 'vial-error';
                                errorMsg.className = 'text-xs font-bold text-red-500 mt-2 animate-fade-in block';
                                errorMsg.innerText = result.errors.vial_number[0];

                                vialInput.parentElement.parentElement.appendChild(errorMsg);
                            } else if (result.message) {
                                showGeneralError(result.message);
                            }
                        }
                        else if (response.ok && result.status === 200) {
                            closeModal('CollectModalBackdrop');

                            const msgEl = document.createElement('div');
                            msgEl.className = 'fixed top-5 right-5 bg-green-500 text-white px-6 py-3 rounded-xl shadow-lg z-50 animate-fade-in font-bold text-sm flex items-center gap-2';
                            msgEl.innerHTML = `<i class="ph-fill ph-check-circle text-lg"></i> ${result.message}`;
                            document.body.appendChild(msgEl);

                            setTimeout(() => {
                                msgEl.style.opacity = '0';
                                msgEl.style.transition = 'opacity 0.3s ease';
                                setTimeout(() => msgEl.remove(), 300);
                            }, 3000);

                            await fetchPendingOrders();

                            setTimeout(() => {
                                openOrderDetails(parseInt(orderId));
                            }, 100);
                        }
                        else {
                            showGeneralError(result.message || 'An error occurred while saving the sample.');
                        }

                    } catch (error) {
                        showGeneralError('A network error occurred. Please try again.');
                    } finally {
                        btn.innerHTML = originalHtml;
                        btn.disabled = false;
                    }
                });
            }

            fetchPendingOrders();
        });
    </script>
</body>