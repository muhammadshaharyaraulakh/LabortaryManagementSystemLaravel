<x-header />

<body class="font-sans antialiased bg-mainBg text-gray-800 flex h-screen overflow-hidden">

    <div id="sidebar-backdrop"
        class="fixed inset-0 bg-black/50 z-40 hidden transition-opacity md:hidden cursor-pointer"></div>

    <aside id="sidebar"
        class="bg-sidebarBg text-white w-64 shrink-0 transition-all duration-300 flex flex-col fixed inset-y-0 left-0 z-50 md:relative transform -translate-x-full md:translate-x-0">
        <div class="h-20 flex items-center justify-between px-6 pt-2">
            <span id="brand-text"
                class="text-white text-xl font-bold whitespace-nowrap tracking-wide">Receptionist</span>
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
                data-target="section-tests" data-title="Available Tests">
                <i
                    class="ph-duotone ph-microscope text-2xl w-7 text-center text-gray-400 group-hover:text-white transition-colors nav-icon"></i>
                <span class="ml-3 nav-text whitespace-nowrap">Available Tests</span>
            </a>

            <a href="#"
                class="nav-link flex items-center px-6 py-3 text-gray-300 hover:bg-white/10 hover:text-white transition-colors group cursor-pointer"
                data-target="section-create-order" data-title="Create Order">
                <i
                    class="ph-duotone ph-shopping-cart text-2xl w-7 text-center text-gray-400 group-hover:text-white transition-colors nav-icon"></i>
                <span class="ml-3 nav-text whitespace-nowrap">Create Order</span>
            </a>

            <a href="#"
                class="nav-link flex items-center px-6 py-3 text-gray-300 hover:bg-white/10 hover:text-white transition-colors group cursor-pointer"
                data-target="section-manage-orders" data-title="Manage Orders">
                <i
                    class="ph-duotone ph-files text-2xl w-7 text-center text-gray-400 group-hover:text-white transition-colors nav-icon"></i>
                <span class="ml-3 nav-text whitespace-nowrap">Manage Orders</span>
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
                    <i class="ph ph-sign-out text-2xl w-7 text-center  group-hover:text-white transition-colors"></i>
                    <span class="ml-3 nav-text whitespace-nowrap">Logout</span>
                </a>
            </div>
        </nav>
    </aside>

    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
        <header class="h-20 px-4 md:px-10 z-20 sticky top-0 bg-mainBg">
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

        </header>

        <main class="flex-1 overflow-y-auto p-4 md:p-10 pt-2 relative">

            <div id="section-dashboard" class="content-section block animate-fade-in w-full max-w-7xl mx-auto">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 rounded-xl  bg-gray-200 text-gray-700 flex items-center justify-center">
                        <i class="ph-duotone ph-squares-four text-2xl"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-extrabold text-gray-800">Reception Overview</h2>
                        <p class="text-sm text-gray-500 font-medium">Today's collection and order statistics</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 w-full">
                    <div
                        class="bg-white rounded-[1.25rem] shadow-[0_4px_20px_rgba(0,0,0,0.03)] p-6 border border-gray-50 relative overflow-hidden">
                        <div
                            class="w-12 h-12 rounded-lg bg-blue-50 text-blue-500 flex items-center justify-center mb-4">
                            <i class="ph-duotone ph-shopping-cart text-2xl"></i>
                        </div>
                        <h3 class="text-3xl font-extrabold text-black mb-1" id="stat-orders-today">0</h3>
                        <p class="text-gray-500 font-medium">Orders Created (Today)</p>
                    </div>

                    <div
                        class="bg-white rounded-[1.25rem] shadow-[0_4px_20px_rgba(0,0,0,0.03)] p-6 border border-gray-50 relative overflow-hidden">
                        <div
                            class="w-12 h-12 rounded-lg bg-green-50 text-green-500 flex items-center justify-center mb-4">
                            <i class="ph-duotone ph-money text-2xl"></i>
                        </div>
                        <h3 class="text-3xl font-extrabold text-black mb-1" id="stat-money-today">Rs. 0</h3>
                        <p class="text-gray-500 font-medium">Money Collected (Today)</p>
                    </div>

                    <div
                        class="bg-white rounded-[1.25rem] shadow-[0_4px_20px_rgba(0,0,0,0.03)] p-6 border border-gray-50 relative overflow-hidden">
                        <div class="w-12 h-12 rounded-lg bg-red-50 text-red-500 flex items-center justify-center mb-4">
                            <i class="ph-duotone ph-trash text-2xl"></i>
                        </div>
                        <h3 class="text-3xl font-extrabold text-black mb-1" id="stat-deleted-today">0</h3>
                        <p class="text-gray-500 font-medium">Deleted Orders (Today)</p>
                    </div>
                </div>

                <div
                    class="bg-white rounded-[1.25rem] shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-50 overflow-hidden w-full">
                    <div
                        class="p-5 border-b border-gray-100 flex flex-col lg:flex-row justify-between gap-4 items-start lg:items-center bg-gray-50/50">
                        <div class="flex items-center gap-2">
                            <i class="ph-duotone ph-calendar-blank text-xl text-gray-500"></i>
                            <h2 class="text-2xl font-bold text-gray-800"> Statistics</h2>
                        </div>

                        <form id="DashboardDateFilterForm"
                            class="flex flex-col sm:flex-row items-center gap-3 w-full lg:w-auto">
                            <div class="flex items-center gap-2 w-full sm:w-auto">
                                <span class="text-sm font-bold text-gray-600">From</span>
                                <div class="relative w-full sm:w-auto">
                                    <i
                                        class="ph-duotone ph-calendar-blank absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-lg pointer-events-none"></i>
                                    <input type="text" required id="filterStartDate" placeholder="Start Date"
                                        class="w-full sm:w-40 pl-10 pr-4 py-2 bg-white border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-100 font-medium text-gray-700 cursor-pointer transition-colors shadow-sm">
                                </div>
                            </div>
                            <div class="flex items-center gap-2 w-full sm:w-auto">
                                <span class="text-sm font-bold text-gray-600">To</span>
                                <div class="relative w-full sm:w-auto">
                                    <i
                                        class="ph-duotone ph-calendar-blank absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-lg pointer-events-none"></i>
                                    <input type="text" required id="filterEndDate" placeholder="End Date"
                                        class="w-full sm:w-40 pl-10 pr-4 py-2 bg-white border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-100 font-medium text-gray-700 cursor-pointer transition-colors shadow-sm">
                                </div>
                            </div>
                            <button type="submit"
                                class="bg-sidebarBg hover:bg-gray-800 cursor-pointer text-white px-5 py-2 rounded-xl text-sm font-bold transition-colors shadow-sm w-full sm:w-auto flex items-center justify-center gap-2">
                                <i class="ph-bold ph-magnifying-glass"></i> Search
                            </button>
                        </form>
                    </div>

                    <div id="DashboardReportResults" class="p-6 md:p-8">
                        <div id="reportEmptyState" class="text-center py-8">
                            <i class="ph-duotone ph-calendar-check text-5xl mb-3 text-gray-300 block"></i>
                            <p class="text-gray-500 font-medium">Select a date range to view statistics.</p>
                        </div>

                        <div id="reportLoadingState" class="hidden text-center py-8">
                            <i class="ph-bold ph-spinner animate-spin text-4xl mb-3 text-blue-500 block"></i>
                            <p class="text-gray-500 font-medium">Calculating Statistics</p>
                        </div>

                        <div id="reportDataState" class="hidden grid-cols-1 md:grid-cols-3 gap-4 animate-fade-in">
                            <div class="bg-gray-50 rounded-xl p-5 border border-gray-100 text-center">
                                <p class="text-sm font-bold text-gray-500 mb-1">Orders Created</p>
                                <h4 class="text-2xl font-black text-blue-600" id="res-orders">0</h4>
                            </div>
                            <div class="bg-gray-50 rounded-xl p-5 border border-gray-100 text-center">
                                <p class="text-sm font-bold text-gray-500 mb-1">Money Collected</p>
                                <h4 class="text-2xl font-black text-green-600" id="res-money">Rs. 0</h4>
                            </div>
                            <div class="bg-gray-50 rounded-xl p-5 border border-gray-100 text-center">
                                <p class="text-sm font-bold text-gray-500 mb-1">Deleted Orders</p>
                                <h4 class="text-2xl font-black text-red-500" id="res-deleted">0</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <x-tests />

            <div id="section-create-order" class="content-section hidden animate-fade-in w-full max-w-5xl mx-auto">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 rounded-xl  bg-gray-200 text-gray-700 flex items-center justify-center">
                        <i class="ph-duotone ph-shopping-cart text-2xl"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-extrabold text-gray-800">Create New Order</h2>
                        <p class="text-sm text-gray-500 font-medium">Register patient, select multiple tests, and
                            generate FIA tax receipt</p>
                    </div>
                </div>

                <div class="overflow-hidden w-full p-6 md:p-8 mb-8">
                    <form id="CreateOrderForm" class="space-y-6">
                        <div class="border-b border-gray-100 pb-4 mb-4">
                            <h3 class="text-lg font-bold text-gray-800">Patient Information</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Patient Name <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="patient_name" placeholder="e.g. Ali Khan"
                                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-green-100 outline-none bg-gray-50/50">
                                <p class="text-xs font-bold text-red-500 mt-1 hidden" id="error-patient_name"></p>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Phone Number <span
                                        class="text-red-500">*</span></label>
                                <input type="tel" name="phone" placeholder="0300-1234567"
                                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-green-100 outline-none bg-gray-50/50">
                                <p class="text-xs font-bold text-red-500 mt-1 hidden" id="error-phone"></p>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Age <span
                                        class="text-red-500">*</span></label>
                                <input type="number" name="age" placeholder="e.g. 35"
                                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-green-100 outline-none bg-gray-50/50">
                                <p class="text-xs font-bold text-red-500 mt-1 hidden" id="error-age"></p>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Email <span
                                        class="text-red-500">*</span></label>
                                <input type="email" name="email" placeholder="patient@example.com"
                                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-green-100 outline-none bg-gray-50/50">
                                <p class="text-xs font-bold text-red-500 mt-1 hidden" id="error-email"></p>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Gender <span
                                        class="text-red-500">*</span></label>
                                <select name="gender"
                                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-green-100 outline-none bg-gray-50/50 cursor-pointer">
                                    <option value="" disabled selected>Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                                <p class="text-xs font-bold text-red-500 mt-1 hidden" id="error-gender"></p>
                            </div>
                        </div>

                        <div class="border-b border-gray-100 pb-4 mb-4 mt-8 pt-4">
                            <h3 class="text-lg font-bold text-gray-800">Search and Add Tests</h3>
                        </div>

                        <div class="relative w-full mb-6">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Search Test Name or Code</label>
                            <div class="relative">
                                <i class="ph ph-magnifying-glass absolute left-4 top-3.5 text-gray-400 text-lg"></i>
                                <input type="text" id="orderTestSearch" placeholder="Start typing to search"
                                    autocomplete="off"
                                    class="w-full pl-11 pr-4 py-3 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-green-100 outline-none bg-gray-50/50">
                                <div id="testSearchResults"
                                    class="absolute z-50 w-full mt-1 bg-white border border-gray-200 rounded-xl shadow-lg hidden max-h-60 overflow-y-auto">
                                </div>
                            </div>
                            <p class="text-xs font-bold text-red-500 mt-1 hidden" id="error-tests"></p>
                        </div>

                        <div class="border border-gray-200 rounded-xl overflow-hidden mb-6">
                            <table class="w-full text-left text-sm">
                                <thead class="bg-gray-50 border-b border-gray-200 text-xs text-gray-700 font-bold">
                                    <tr>
                                        <th class="px-4 py-3">Code</th>
                                        <th class="px-4 py-3">Test Name</th>
                                        <th class="px-4 py-3 text-right">Price</th>
                                        <th class="px-4 py-3 text-center w-16">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="orderTestsTable" class="divide-y divide-gray-100">
                                    <tr>
                                        <td colspan="4" class="px-4 py-8 text-center text-gray-400 font-medium">No tests
                                            added yet. Search and select tests above.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="bg-gray-50 rounded-xl p-6 border border-gray-100 mt-6">
                            <div class="flex justify-between items-center mb-3">
                                <span class="text-sm font-bold text-gray-600">Subtotal:</span>
                                <span class="text-sm font-bold text-gray-900">Rs. <span
                                        id="calcSubtotal">0</span></span>
                            </div>

                            <div class="flex justify-between items-start mb-3">
                                <span class="text-sm font-bold text-gray-600 mt-2">Discount (Rs.):</span>
                                <div class="flex flex-col items-end">
                                    <input type="number" id="calcDiscount" name="discount" value="0" min="0"
                                        class="w-32 text-right border border-gray-200 rounded-lg px-3 py-1.5 text-sm focus:ring-2 focus:ring-green-100 outline-none">
                                    <p class="text-xs font-bold text-red-500 mt-1 hidden" id="error-discount"></p>
                                </div>
                            </div>

                            <div class="flex justify-between items-center mb-4 pb-4 border-b border-gray-200">
                                <div>
                                    <span class="text-sm font-bold text-gray-600">FIA Gov Tax (5%):</span>
                                    <p class="text-[10px] text-gray-600"><i class="ph-fill ph-info"></i> Auto-synced via
                                        API</p>
                                </div>
                                <span class="text-sm font-bold text-red-500">+ Rs. <span id="calcTax">0</span></span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-black text-gray-800">Grand Total:</span>
                                <span class="text-2xl font-black text-green-600">Rs. <span
                                        id="calcTotal">0</span></span>
                            </div>
                        </div>

                        <div class="flex justify-end pt-6 mt-6 border-t border-gray-100">
                            <button type="submit"
                                class="bg-sidebarBg hover:bg-gray-800 text-white px-8 py-3 rounded-xl text-sm font-bold transition-colors shadow-sm cursor-pointer flex items-center gap-2">
                                Create Order
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div id="section-manage-orders" class="content-section hidden animate-fade-in w-full max-w-7xl mx-auto">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-gray-700 flex items-center justify-center">
                        <i class="ph-duotone ph-files text-2xl"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-extrabold text-gray-800">Manage Orders</h2>
                        <p class="text-sm text-gray-500 font-medium">View, print, or delete patient orders</p>
                    </div>
                </div>

                <div
                    class="bg-white rounded-[1.25rem] shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-50 overflow-hidden w-full">
                    <div class="p-4 border-b border-gray-100 flex flex-col sm:flex-row justify-between gap-4">
                        <div class="relative w-full sm:w-96">
                            <i class="ph ph-magnifying-glass absolute left-4 top-3.5 text-gray-400 text-lg"></i>
                            <input type="text" id="searchManageOrdersInput"
                                placeholder="Search by Order ID (e.g., ORD-1234)"
                                class="w-full pl-11 pr-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus: bg-gray-50/50 focus:bg-white transition-colors text-sm font-medium">
                            <p class="text-xs font-bold text-red-500 mt-1 hidden" id="error-searchManageOrders"></p>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead class="text-xs text-gray-700 font-bold bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th class="px-6 py-4">Order ID</th>
                                    <th class="px-6 py-4">Patient Name</th>
                                    <th class="px-6 py-4">Date</th>
                                    <th class="px-6 py-4">Amount</th>
                                    <th class="px-6 py-4 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="manageOrdersTableBody" class="divide-y divide-gray-100">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div id="section-order-preview" class="content-section hidden animate-fade-in w-full max-w-5xl mx-auto">
                <div class="flex items-center gap-4 mb-6">
                    <button id="btn-back-to-orders"
                        class="flex items-center justify-center w-11 h-11 rounded-xl bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 hover:text-purple-600 transition-colors shadow-sm cursor-pointer">
                        <i class="ph-bold ph-arrow-left text-xl"></i>
                    </button>
                    <div>
                        <h2 class="text-2xl font-extrabold text-gray-800">Order Preview</h2>
                        <p class="text-sm text-gray-500 font-medium">Review order details and print receipt</p>
                    </div>
                    <div class="ml-auto">
                        <button id="btn-print-preview"
                            class="bg-sidebarBg hover:bg-gray-800 text-white px-6 py-2.5 rounded-xl text-sm font-bold transition-colors shadow-sm flex items-center gap-2 cursor-pointer">
                            Print Receipt
                        </button>
                    </div>
                </div>

                <div class="bg-gray-50 p-6 md:p-10 rounded-[1.25rem] border border-gray-100 flex justify-center w-full">
                    <div id="order-preview-content"
                        class="bg-white shadow-sm border border-gray-200 w-full max-w-2xl p-8 rounded-sm text-sm min-h-[500px]">
                    </div>
                </div>
            </div>
            <x-settings />
            <div id="global-notification"
                class="fixed top-5 right-5 z-9999 hidden px-6 py-4 rounded-xl shadow-lg text-white font-bold text-sm transition-all duration-300 opacity-0 translate-y-[-20px]">
            </div>


        </main>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const userId = document.querySelector('meta[name="user-id"]')?.getAttribute('content');
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

            const fetchHeaders = {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            };

            if (typeof flatpickr !== 'undefined') {
                const dateConfig = { dateFormat: "Y-m-d", altInput: true, altFormat: "F j, Y", allowInput: false, disableMobile: "true" };
                flatpickr("#filterStartDate", dateConfig);
                flatpickr("#filterEndDate", dateConfig);
            }

            function displayTemporaryMessage(inputElement, message, isError = true) {
                if (!inputElement) return;
                const parent = inputElement.parentElement;
                const existingMsg = parent.querySelector('.temp-msg');
                if (existingMsg) existingMsg.remove();
                const msgEl = document.createElement('p');
                msgEl.className = `temp-msg text-xs mt-1 font-bold animate-fade-in ${isError ? 'text-red-500' : 'text-green-500'}`;
                msgEl.innerText = message;
                if (isError) inputElement.classList.add('border-red-500');
                parent.appendChild(msgEl);
                setTimeout(() => {
                    if (msgEl && msgEl.parentNode) msgEl.remove();
                    if (isError) inputElement.classList.remove('border-red-500');
                }, 3000);
            }

            function timeSince(dateString) {
                const date = new Date(dateString);
                const seconds = Math.floor((new Date() - date) / 1000);
                let interval = seconds / 31536000;
                if (interval > 1) return Math.floor(interval) + " years ago";
                interval = seconds / 2592000;
                if (interval > 1) return Math.floor(interval) + " months ago";
                interval = seconds / 86400;
                if (interval > 1) return Math.floor(interval) + " days ago";
                interval = seconds / 3600;
                if (interval > 1) return Math.floor(interval) + " hours ago";
                interval = seconds / 60;
                if (interval > 1) return Math.floor(interval) + " minutes ago";
                return "Just now";
            }

            const sections = document.querySelectorAll('.content-section');
            const headerTitle = document.getElementById('header-title');

            function switchSection(targetId, title) {
                sections.forEach(sec => {
                    sec.classList.add('hidden');
                    sec.classList.remove('block');
                });
                const targetSection = document.getElementById(targetId);
                if (targetSection) {
                    targetSection.classList.remove('hidden');
                    targetSection.classList.add('block');
                }
                if (title && headerTitle) headerTitle.innerText = title;
                if (targetId === 'section-manage-orders') {
                    if (typeof searchManageOrdersInput !== 'undefined' && searchManageOrdersInput) searchManageOrdersInput.value = '';
                    fetchUserOrders();
                }
                if (targetId === 'section-dashboard') fetchDashboardTodayStats();
                if (targetId === 'section-create-order' && allAvailableTests.length === 0) {
                    loadAllTestsForSearch();
                }
            }

            document.querySelectorAll('#sidebar-nav .nav-link').forEach(link => {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    document.querySelectorAll('#sidebar-nav .nav-link').forEach(nav => {
                        nav.classList.remove('bg-white/10', 'text-white', 'active-nav');
                        nav.classList.add('text-gray-300');
                        const icon = nav.querySelector('.nav-icon');
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
                sidebar?.classList.toggle('-translate-x-full');
                sidebarBackdrop?.classList.toggle('hidden');
            }
            document.getElementById('open-mobile-sidebar')?.addEventListener('click', toggleSidebar);
            document.getElementById('close-mobile-sidebar')?.addEventListener('click', toggleSidebar);
            sidebarBackdrop?.addEventListener('click', toggleSidebar);

            let allAvailableTests = [];
            let orderCart = [];
            const searchInput = document.getElementById('orderTestSearch');
            const searchResults = document.getElementById('testSearchResults');
            const tableBody = document.getElementById('orderTestsTable');
            const discountInput = document.getElementById('calcDiscount');

            async function loadAllTestsForSearch() {
                if (!searchInput) return;
                try {
                    searchInput.placeholder = "Loading available tests...";
                    searchInput.disabled = true;
                    const response = await fetch('/tests', { headers: fetchHeaders });
                    const result = await response.json();
                    if (result.status === true || result.status === 200) {
                        allAvailableTests = result.data;
                    }
                } catch (error) {
                    searchInput.placeholder = "Failed to load tests. Refresh page.";
                } finally {
                    searchInput.placeholder = "Start typing to search";
                    searchInput.disabled = false;
                }
            }

            if (searchInput) {
                searchInput.addEventListener('input', function (e) {
                    const query = e.target.value.toLowerCase().trim();
                    searchResults.innerHTML = '';
                    if (query.length === 0) {
                        searchResults.classList.add('hidden');
                        return;
                    }
                    const filtered = allAvailableTests.filter(test => {
                        const name = (test.testName || test.test_name || test.name || '').toLowerCase();
                        const code = (test.testCode || test.test_code || test.code || '').toLowerCase();
                        return name.includes(query) || code.includes(query);
                    });
                    if (filtered.length > 0) {
                        filtered.forEach(test => {
                            const testName = test.testName || test.test_name || test.name || 'Unnamed Test';
                            const testCode = test.testCode || test.test_code || test.code || 'N/A';
                            const testPrice = test.price || 0;
                            const item = document.createElement('div');
                            item.className = 'px-4 py-3 hover:bg-green-50 cursor-pointer border-b border-gray-100 last:border-0 flex justify-between items-center transition-colors';
                            item.innerHTML = `
                        <div>
                            <p class="text-sm font-bold text-gray-800">${testName}</p>
                            <p class="text-xs text-gray-500">${testCode}</p>
                        </div>
                        <span class="text-sm font-bold text-green-600">Rs. ${testPrice}</span>
                    `;
                            item.addEventListener('click', () => {
                                fetchAndAddTestToCart(test.id);
                                searchInput.value = '';
                                searchResults.classList.add('hidden');
                            });
                            searchResults.appendChild(item);
                        });
                    } else {
                        searchResults.innerHTML = `<div class="px-4 py-3 text-sm text-gray-500 text-center">No tests found.</div>`;
                    }
                    searchResults.classList.remove('hidden');
                });
                document.addEventListener('click', (e) => {
                    if (searchInput && searchResults && !searchInput.contains(e.target) && !searchResults.contains(e.target)) {
                        searchResults.classList.add('hidden');
                    }
                });
            }

            async function fetchAndAddTestToCart(testId) {
                try {
                    const response = await fetch(`/tests/${testId}`, { headers: fetchHeaders });
                    const result = await response.json();
                    if (result.status === true || result.status === 200) {
                        const freshTest = result.data || result.test;
                        if (orderCart.find(t => t.id === freshTest.id)) {
                            displayTemporaryMessage(searchInput, 'This test is already added.', true);
                            return;
                        }
                        orderCart.push(freshTest);
                        renderCart();
                    }
                } catch (error) { }
            }

            window.removeTestFromCart = function (testId) {
                orderCart = orderCart.filter(t => t.id !== testId);
                renderCart();
            };

            function renderCart() {
                if (orderCart.length === 0) {
                    tableBody.innerHTML = `<tr><td colspan="4" class="px-4 py-8 text-center text-gray-400 font-medium">No tests added yet.</td></tr>`;
                } else {
                    tableBody.innerHTML = '';
                    orderCart.forEach(test => {
                        const testName = test.testName || test.test_name || test.name || 'Unnamed Test';
                        const testCode = test.testCode || test.test_code || test.code || 'N/A';
                        const testPrice = test.price || 0;
                        tableBody.innerHTML += `
                    <tr class="bg-white hover:bg-gray-50 transition-colors animate-fade-in">
                        <td class="px-4 py-3 text-gray-500 font-medium text-xs">${testCode}</td>
                        <td class="px-4 py-3 font-bold text-gray-800">${testName}</td>
                        <td class="px-4 py-3 text-right font-bold text-gray-700">Rs. ${testPrice}</td>
                        <td class="px-4 py-3 text-center">
                            <button type="button" onclick="removeTestFromCart(${test.id})" class="text-red-400 hover:text-red-600 transition-colors p-1 cursor-pointer">
                                <i class="ph-bold ph-trash text-lg"></i>
                            </button>
                        </td>
                    </tr>
                `;
                    });
                }
                calculateTotals();
            }

            function calculateTotals() {
                let subtotal = orderCart.reduce((sum, test) => sum + (parseFloat(test.price) || 0), 0);
                let discount = parseFloat(discountInput?.value) || 0;
                if (discount > subtotal) discount = subtotal;
                let amountAfterDiscount = subtotal - discount;
                let tax = amountAfterDiscount * 0.05;
                let grandTotal = amountAfterDiscount + tax;
                document.getElementById('calcSubtotal').innerText = subtotal.toFixed(2);
                document.getElementById('calcTax').innerText = tax.toFixed(2);
                document.getElementById('calcTotal').innerText = grandTotal.toFixed(2);
            }

            discountInput?.addEventListener('input', calculateTotals);

            document.getElementById('CreateOrderForm')?.addEventListener('submit', async (e) => {
                e.preventDefault();
                const btn = e.submitter;
                const originalHtml = btn.innerHTML;
                btn.innerHTML = `<i class="ph-bold ph-spinner animate-spin text-lg"></i>`;
                btn.disabled = true;

                const formData = new FormData(e.target);
                let cleanPhone = (formData.get('phone') || '').replace(/[^0-9]/g, '');
                const payload = {
                    name: formData.get('patient_name'), phone: cleanPhone, age: formData.get('age'),
                    gender: formData.get('gender'), email: formData.get('email'),
                    discount: discountInput.value || 0, tests: orderCart.map(test => test.id)
                };

                try {
                    const response = await fetch('/orders', { method: 'POST', headers: fetchHeaders, body: JSON.stringify(payload) });
                    const result = await response.json();
                    if (response.status === 422) {
                        for (const field in result.errors) {
                            let errorSpanId = field === 'name' ? 'error-patient_name' : `error-${field}`;
                            const errorEl = document.getElementById(errorSpanId);
                            if (errorEl) {
                                errorEl.innerText = result.errors[field][0];
                                errorEl.classList.remove('hidden');
                                setTimeout(() => { errorEl.classList.add('hidden'); }, 3000);
                            }
                        }
                    } else if (response.ok && result.status === true) {
                        e.target.reset();
                        orderCart = [];
                        renderCart();
                        fetchDashboardTodayStats();
                        fetchUserOrders();
                        loadOrderPreview(result.tracking_id);
                    }
                } catch (error) {
                } finally {
                    btn.innerHTML = originalHtml;
                    btn.disabled = false;
                }
            });

            const manageOrdersTableBody = document.querySelector('#section-manage-orders tbody');
            const searchManageOrdersInput = document.getElementById('searchManageOrdersInput');
            let searchDebounceTimer;

            async function fetchUserOrders() {
                if (!manageOrdersTableBody) return;
                manageOrdersTableBody.innerHTML = `<tr><td colspan="5" class="px-6 py-8 text-center"><i class="ph-bold ph-spinner animate-spin text-2xl text-blue-600"></i></td></tr>`;
                try {
                    const response = await fetch('/orders', { headers: fetchHeaders });
                    const result = await response.json();
                    if (result.status === 200) renderManageOrders(result.data);
                } catch (error) { }
            }

            function renderManageOrders(orders) {
                if (!manageOrdersTableBody) return;
                manageOrdersTableBody.innerHTML = '';
                if (!orders || orders.length === 0) {
                    manageOrdersTableBody.innerHTML = `<tr><td colspan="5" class="px-6 py-8 text-center text-gray-500 font-medium">No orders found.</td></tr>`;
                    return;
                }
                orders.forEach(order => {
                    const timeAgoText = timeSince(order.created_at);
                    const isDeleted = order.deleted_at !== null;
                    let actionHtml = `<button data-tracking="${order.trackingId}" class="btn-view-order text-blue-600 hover:text-blue-800 font-bold px-3 py-1.5 rounded-lg border border-blue-200 hover:bg-blue-50 transition-colors cursor-pointer mr-1">View</button>`;
                    if (!isDeleted && (new Date() - new Date(order.created_at)) < 3600000) {
                        actionHtml += `<button data-id="${order.id}" class="btn-delete-order text-red-600 hover:text-red-800 font-bold px-3 py-1.5 rounded-lg border border-red-200 hover:bg-red-50 transition-colors cursor-pointer">Delete</button>`;
                    }
                    const rowClass = isDeleted ? "bg-red-50/40 text-red-500 font-medium" : "bg-white hover:bg-gray-50 text-gray-800 font-medium";
                    const textClass = isDeleted ? "line-through opacity-70" : "";
                    manageOrdersTableBody.innerHTML += `
                <tr class="border-b border-gray-100 ${rowClass}">
                    <td class="px-6 py-4 font-bold ${textClass}">${order.trackingId}</td>
                    <td class="px-6 py-4 ${textClass}">${order.name}</td>
                    <td class="px-6 py-4 text-xs font-bold">${timeAgoText}</td>
                    <td class="px-6 py-4 font-bold ${textClass}">Rs. ${order.grandTotal}</td>
                    <td class="px-6 py-4 text-right flex justify-end">${actionHtml}</td>
                </tr>
            `;
                });
            }

            if (searchManageOrdersInput) {
                searchManageOrdersInput.addEventListener('input', (e) => {
                    clearTimeout(searchDebounceTimer);
                    const query = e.target.value.trim();
                    if (query === '') return fetchUserOrders();
                    searchDebounceTimer = setTimeout(async () => {
                        manageOrdersTableBody.innerHTML = `<tr><td colspan="5" class="px-6 py-8 text-center"><i class="ph-bold ph-spinner animate-spin text-2xl text-blue-600"></i></td></tr>`;
                        try {
                            const response = await fetch(`/orders/search/${encodeURIComponent(query)}`, { headers: fetchHeaders });
                            const result = await response.json();
                            if (result.status === true) {
                                let foundData = result.orders || result.order || result.data || [];
                                renderManageOrders(Array.isArray(foundData) ? foundData : [foundData]);
                            } else {
                                manageOrdersTableBody.innerHTML = `<tr><td colspan="5" class="px-6 py-8 text-center text-gray-500 font-medium">No results found</td></tr>`;
                            }
                        } catch (error) { }
                    }, 500);
                });
            }

            const btnBackToOrders = document.getElementById('btn-back-to-orders');
            const orderPreviewContent = document.getElementById('order-preview-content');
            const btnPrintPreview = document.getElementById('btn-print-preview');
            let currentPreviewTrackingId = null;

            if (btnBackToOrders) {
                btnBackToOrders.addEventListener('click', () => switchSection('section-manage-orders', 'Manage Orders'));
            }


            async function loadOrderPreview(trackingId) {
                switchSection('section-order-preview', 'Order Preview');
                orderPreviewContent.innerHTML = `<div class="flex items-center justify-center h-full py-20"><i class="ph-bold ph-spinner animate-spin text-4xl text-blue-600"></i></div>`;
                currentPreviewTrackingId = trackingId;
                try {
                    const response = await fetch(`/orders/${trackingId}/summary`, { headers: fetchHeaders });
                    const result = await response.json();
                    if (result.status === true) {
                        const order = result.orders;
                        const orderDate = new Date(order.created_at).toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });
                        let testsHtml = '';
                        let barcodesHtml = '';
                        order.tests.forEach(test => {
                            const testName = test.name || test.testName || 'Lab Test';
                            testsHtml += `
                        <tr class="border-b border-gray-100">
                            <td class="py-3">${testName}</td>
                            <td class="py-3 text-right">Rs. ${test.pivot.priceAtOrder || test.price}</td>
                        </tr>
                    `;
                            barcodesHtml += `
                        <div class="text-center border border-gray-200 p-4 rounded-xl break-inside-avoid w-full max-w-md mx-auto">
                            <p class="font-bold text-xs mb-3 text-gray-800 uppercase tracking-wide truncate">${testName}</p>
                            <div class="flex flex-col items-center justify-center [&>svg]:h-12 [&>svg]:w-auto [&>svg]:max-w-full">
                                ${test.backend_barcode}
                            </div>
                        </div>
                    `;
                        });
                        orderPreviewContent.innerHTML = `
                    <div class="text-center mb-6 pb-6 border-b-2 border-gray-800">
                        <h1 class="text-2xl font-black ">Laboratory Management System Receipt</h1>
                        <p class="text-gray-500 font-bold">Tracking ID:${order.trackingId}</p>
                    </div>
                    
                    <div class="grid grid-cols-2 md:grid-cols-2 gap-4 mb-6 bg-gray-50 p-4 rounded-xl">
                        <div>
                            <p class="text-xs text-gray-500 font-bold uppercase tracking-wider mb-1">Patient Name</p>
                            <p class="text-sm font-bold text-gray-900">${order.name}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-bold uppercase tracking-wider mb-1">Age / Gender</p>
                            <p class="text-sm font-bold text-gray-900">${order.age} yrs / ${order.gender}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-bold uppercase tracking-wider mb-1">Phone</p>
                            <p class="text-sm font-bold text-gray-900">${order.phone}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-bold uppercase tracking-wider mb-1">Email</p>
                            <p class="text-sm font-bold text-gray-900 truncate" title="${order.email}">${order.email || 'N/A'}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-bold uppercase tracking-wider mb-1">Date</p>
                            <p class="text-sm font-bold text-gray-900">${orderDate}</p>
                        </div>
                    </div>

                    <table class="w-full text-left border-collapse mb-6">
                        <thead>
                            <tr class="border-b border-gray-300 text-xs uppercase tracking-wider text-gray-500 bg-gray-50">
                                <th class="py-3 px-2">Description</th>
                                <th class="py-3 px-2 text-right">Amount</th>
                            </tr>
                        </thead>
                        <tbody>${testsHtml}</tbody>
                    </table>
                    <div class="flex flex-col items-end gap-2 text-right">
                        <div class="w-64 flex justify-between text-gray-600 font-bold"><span>Subtotal:</span> <span>Rs. ${order.subtotal}</span></div>
                        <div class="w-64 flex justify-between text-gray-600 font-bold"><span>Discount:</span> <span>- Rs. ${order.discount}</span></div>
                        <div class="w-64 flex justify-between text-gray-600 font-bold"><span>Gov Tax (5%):</span> <span>Rs. ${order.tax}</span></div>
                        <div class="w-64 flex justify-between font-black text-xl border-t border-gray-300 pt-3 mt-3 text-gray-900">
                            <span>Total:</span> <span>Rs. ${order.grandTotal}</span>
                        </div>
                    </div>
                    <div class="mt-12 pt-6 border-t-2 border-gray-800 border-dashed">
                        <h3 class="text-center font-black text-gray-900 mb-6 uppercase tracking-widest text-sm bg-gray-100 py-2 rounded-lg"> For Laboratory Use Only</h3>
                        <div class="flex flex-col items-center justify-center gap-6">
                            <div class="grid grid-cols-1 gap-4 items-center justify-center">${barcodesHtml}</div>
                        </div>
                    </div>
                `;
                    } else {
                        orderPreviewContent.innerHTML = `<div class="text-center py-20 text-red-500 font-bold">Order not found.</div>`;
                    }
                } catch (error) {
                    orderPreviewContent.innerHTML = `<div class="text-center py-20 text-red-500 font-bold">Failed to load preview.</div>`;
                }
            }

            if (btnPrintPreview) {
                btnPrintPreview.addEventListener('click', () => {
                    if (!currentPreviewTrackingId) return;

                    window.location.href = `/orders/${currentPreviewTrackingId}/receipt/pdf`;
                });
            }
            function showNotification(message, isError = true) {
                let notif = document.getElementById('global-notification');

                if (!notif) {
                    notif = document.createElement('div');
                    notif.id = 'global-notification';
                    document.body.appendChild(notif);
                }

                notif.className = 'fixed top-10 left-1/2 transform -translate-x-1/2 px-6 py-4 rounded-xl shadow-2xl z-[100] font-bold text-sm flex items-center gap-3 transition-all duration-300 opacity-0 translate-y-[-20px]';
                if (isError) {
                    notif.classList.add('bg-red-50', 'text-red-700', 'border', 'border-red-200');
                    notif.innerHTML = `<i class="ph-bold ph-warning-circle text-xl"></i> <span>${message}</span>`;
                } else {
                    notif.classList.add('bg-green-50', 'text-green-700', 'border', 'border-green-200');
                    notif.innerHTML = `<i class="ph-bold ph-check-circle text-xl"></i> <span>${message}</span>`;
                }

                setTimeout(() => {
                    notif.classList.remove('opacity-0', 'translate-y-[-20px]');
                    notif.classList.add('opacity-100', 'translate-y-0');
                }, 10);

                setTimeout(() => {
                    notif.classList.remove('opacity-100', 'translate-y-0');
                    notif.classList.add('opacity-0', 'translate-y-[-20px]');

                    setTimeout(() => {
                        notif.remove();
                    }, 300);
                }, 2000);
            }


            // Global Click Listener
            document.addEventListener('click', async (e) => {
                // 1. View Order Logic
                const viewOrderBtn = e.target.closest('.btn-view-order');
                if (viewOrderBtn) {
                    loadOrderPreview(viewOrderBtn.getAttribute('data-tracking'));
                }

                // 2. Delete Order Logic
                const deleteBtn = e.target.closest('.btn-delete-order');
                if (deleteBtn) {
                    const orderId = deleteBtn.getAttribute('data-id');
                    const row = deleteBtn.closest('tr');
                    const originalHtml = deleteBtn.innerHTML;

                    deleteBtn.innerHTML = `<i class="ph-bold ph-spinner animate-spin"></i>`;
                    deleteBtn.disabled = true;

                    try {
                        const response = await fetch(`/orders/${orderId}`, {
                            method: 'DELETE',
                            headers: fetchHeaders
                        });

                        const result = await response.json();

                        // FIX: Check for 200 OR true
                        if (response.ok && (result.status === 200 || result.status === true)) {
                            row.classList.add('opacity-0');

                            setTimeout(() => {
                                row.remove();
                                fetchUserOrders();
                                fetchDashboardTodayStats();
                            }, 300);

                            showNotification("Order deleted successfully", false);

                        } else {
                            showNotification(result.message || "Unable to delete order", true);
                            deleteBtn.innerHTML = originalHtml;
                            deleteBtn.disabled = false;
                        }

                    } catch (error) {
                        showNotification("Network error occurred", true);
                        deleteBtn.innerHTML = originalHtml;
                        deleteBtn.disabled = false;
                    }
                }
            });
            const dateFilterForm = document.getElementById('DashboardDateFilterForm');

            async function fetchDashboardTodayStats() {
                try {
                    const response = await fetch('/stats', { headers: fetchHeaders });
                    const result = await response.json();
                    if (result.success === true) {
                        document.getElementById('stat-orders-today').innerText = result.data.orderCreatedToday;
                        document.getElementById('stat-money-today').innerText = `Rs. ${Number(result.data.moneyCollectedToday).toLocaleString()}`;
                        document.getElementById('stat-deleted-today').innerText = result.data.deletedOrders;
                    } else {
                        document.getElementById('stat-orders-today').innerText = "0";
                        document.getElementById('stat-money-today').innerText = "Rs. 0";
                        document.getElementById('stat-deleted-today').innerText = "0";
                    }
                } catch (error) { }
            }

            fetchDashboardTodayStats();
            if (dateFilterForm) {
                dateFilterForm.addEventListener('submit', async (e) => {
                    e.preventDefault();
                    const startInput = document.getElementById('filterStartDate');
                    const endInput = document.getElementById('filterEndDate');
                    const reportEmptyState = document.getElementById('reportEmptyState');
                    const reportLoadingState = document.getElementById('reportLoadingState');
                    const reportDataState = document.getElementById('reportDataState');
                    const reportContainer = document.getElementById('DashboardReportResults');

                    // Helper function to display errors in the center
                    function showCenterError(message) {
                        reportEmptyState.classList.add('hidden');
                        reportLoadingState.classList.add('hidden');
                        reportDataState.classList.add('hidden');

                        let errState = document.getElementById('reportErrorState');
                        if (!errState) {
                            errState = document.createElement('div');
                            errState.id = 'reportErrorState';
                            errState.className = 'text-center py-8 text-red-500 font-bold animate-fade-in';
                            reportContainer.appendChild(errState);
                        }

                        errState.innerHTML = `<i class="ph-duotone ph-warning-circle text-5xl mb-3 block"></i><p>${message}</p>`;
                        errState.classList.remove('hidden');

                        setTimeout(() => {
                            errState.classList.add('hidden');
                            reportEmptyState.classList.remove('hidden');
                        }, 3000);
                    }

                    if (!startInput.value || !endInput.value) {
                        showCenterError("Please select both Start and End dates.");
                        return;
                    }

                    const start = new Date(startInput.value);
                    const end = new Date(endInput.value);

                    if (end < start) {
                        showCenterError("End date cannot be earlier than start date.");
                        return;
                    }

                    const btn = e.submitter;
                    const originalHtml = btn.innerHTML;
                    btn.innerHTML = `<i class="ph-bold ph-spinner animate-spin"></i>`;

                    reportEmptyState.classList.add('hidden');
                    reportDataState.classList.add('hidden');
                    reportDataState.classList.remove('grid');
                    reportLoadingState.classList.remove('hidden');

                    let errState = document.getElementById('reportErrorState');
                    if (errState) errState.classList.add('hidden');

                    try {
                        const response = await fetch('/search', {
                            method: 'POST',
                            headers: fetchHeaders,
                            body: JSON.stringify({ startDate: startInput.value, endDate: endInput.value })
                        });

                        const result = await response.json();
                        if (response.status === 422) {
                            let backendError = "Validation failed.";
                            if (result.errors) {
                                // Grab the very first error message Laravel sent back
                                const firstKey = Object.keys(result.errors)[0];
                                backendError = result.errors[firstKey][0];
                            }
                            showCenterError(backendError);
                            return;
                        }

                        if (result.success === true) {
                            document.getElementById('res-orders').innerText = result.data.orderCreated;
                            document.getElementById('res-money').innerText = `Rs. ${Number(result.data.moneyCollected).toLocaleString()}`;
                            document.getElementById('res-deleted').innerText = result.data.deletedOrders;

                            reportLoadingState.classList.add('hidden');
                            reportDataState.classList.remove('hidden');
                            reportDataState.classList.add('grid');
                        } else {
                            document.getElementById('res-orders').innerText = "0";
                            document.getElementById('res-money').innerText = "Rs. 0";
                            document.getElementById('res-deleted').innerText = "0";

                            reportLoadingState.classList.add('hidden');
                            reportDataState.classList.remove('hidden');
                            reportDataState.classList.add('grid');
                        }

                    } catch (error) {
                        showCenterError("A network error occurred.");
                    } finally {
                        btn.innerHTML = originalHtml;
                    }
                });
            }
        });
    </script>
</body>