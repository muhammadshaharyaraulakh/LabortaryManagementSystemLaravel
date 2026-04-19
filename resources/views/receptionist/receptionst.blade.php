<x-header />

<body class="font-sans antialiased bg-mainBg text-gray-800 flex h-screen overflow-hidden">

    <div id="sidebar-backdrop"
        class="fixed inset-0 bg-black/50 z-40 hidden transition-opacity md:hidden cursor-pointer"></div>

    <aside id="sidebar"
        class="bg-sidebarBg text-white w-64 shrink-0 transition-all duration-300 flex flex-col fixed inset-y-0 left-0 z-50 md:relative transform -translate-x-full md:translate-x-0">
        <div class="h-20 flex items-center justify-between px-6 pt-2">
            <span id="brand-text" class="text-white text-xl font-bold whitespace-nowrap tracking-wide">Reception</span>
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
                    <i
                        class="ph-duotone ph-sign-out text-2xl w-7 text-center  group-hover:text-white transition-colors"></i>
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
                            <h3 class="text-base font-bold text-gray-800"> Statistics</h3>
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

                        <div id="reportDataState" class="hidden grid grid-cols-1 md:grid-cols-3 gap-4 animate-fade-in">
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

            <div id="section-tests" class="content-section hidden animate-fade-in w-full max-w-7xl mx-auto">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 rounded-xl  bg-gray-200 text-gray-700 flex items-center justify-center">
                        <i class="ph-duotone ph-microscope text-2xl"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-extrabold text-gray-800">Test Directory</h2>
                        <p class="text-sm text-gray-500 font-medium">Search and view available lab tests and prices</p>
                    </div>
                </div>

                <div
                    class="bg-white rounded-[1.25rem] shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-50 overflow-hidden w-full">
                    <div class="p-4 border-b border-gray-100 flex flex-col sm:flex-row justify-between gap-4">
                        <div class="relative w-full sm:w-96">
                            <i
                                class="ph ph-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-lg"></i>
                            <input type="text" id="searchTestsDir" placeholder="Search Test name or Code"
                                class="w-full pl-11 pr-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-purple-100 bg-gray-50/50 focus:bg-white transition-colors text-sm font-medium">
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead class="text-xs text-gray-700 font-bold bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th class="px-6 py-4">Test Code</th>
                                    <th class="px-6 py-4">Test Name</th>
                                    <th class="px-6 py-4">Price</th>
                                    <th class="px-6 py-4">Time Required</th>
                                    <th class="px-6 py-4 text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    class="bg-white border-b border-gray-100 hover:bg-gray-50 transition-colors text-gray-800 font-medium">
                                    <td class="px-6 py-4 text-gray-500">HEM-001</td>
                                    <td class="px-6 py-4">Complete Blood Count (CBC)</td>
                                    <td class="px-6 py-4">Rs. 800</td>
                                    <td class="px-6 py-4">24 Hours</td>
                                    <td class="px-6 py-4 text-right">
                                        <button
                                            class="btn-view-test text-purple-600 hover:text-purple-800 font-bold px-3 py-1.5 rounded-lg border border-purple-200 hover:bg-purple-50 transition-colors cursor-pointer">
                                            View Details
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

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

            <div id="section-settings"
                class="content-section hidden animate-fade-in w-full max-w-2xl mx-auto px-4 py-6">
                <div class="flex items-center gap-3 mb-10">
                    <div
                        class="w-12 h-12 shrink-0 rounded-xl bg-gray-200 text-gray-700 flex items-center justify-center">
                        <i class="ph-duotone ph-gear-six text-2xl"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-extrabold text-gray-800">Settings</h2>
                        <p class="text-sm text-gray-500 font-medium">Manage email and password</p>
                    </div>
                </div>

                <div class="flex flex-col w-full gap-10">
                    <div class="flex flex-col gap-4 border-b border-gray-300 pb-10">
                        <div class="flex items-center gap-2">
                            <span
                                class="bg-gray-200 text-gray-700 w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold">1</span>
                            <h3 class="text-lg font-bold text-gray-800">Update Email</h3>
                        </div>
                        <form id="UpdateEmailForm" class="flex flex-col gap-2">
                            <div class="w-full">
                                <label class="text-sm font-bold text-gray-700 block mb-2">Email Address</label>
                                <div class="relative w-full">
                                    <input type="email" name="email" id="userEmailInput"
                                        value="{{ Auth::user()->email ?? '' }}" placeholder="dr.smith@gmail.com"
                                        class="w-full border border-gray-400 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-400 outline-none bg-transparent transition-colors placeholder:text-gray-400">
                                </div>
                            </div>
                            <button type="submit" id="btnSaveEmail"
                                class="self-start cursor-pointer bg-sidebarBg hover:bg-gray-800 text-white px-6 py-2.5 rounded-xl text-sm font-bold transition-colors shadow-sm mt-2">
                                Save Email
                            </button>
                        </form>
                    </div>

                    <div class="flex flex-col gap-4 pb-10">
                        <div class="flex items-center gap-2">
                            <span
                                class="bg-gray-200 text-gray-700 w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold">2</span>
                            <h3 class="text-lg font-bold text-gray-800">Update Password</h3>
                        </div>
                        <form id="UpdatePasswordForm" class="flex flex-col gap-4">
                            <div class="flex flex-col gap-2">
                                <label class="text-sm font-bold text-gray-700">Current Password</label>
                                <div class="relative w-full">
                                    <input type="password" name="password" placeholder="••••••••"
                                        class="w-full border border-gray-400 rounded-xl px-4 py-3 pr-10 text-sm focus:ring-2 focus:ring-blue-400 outline-none bg-transparent transition-colors">
                                    <i
                                        class="ph ph-eye absolute right-4 top-3.5 text-lg cursor-pointer text-gray-500 hover:text-gray-800 transition-colors toggle-password"></i>
                                </div>
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="text-sm font-bold text-gray-700">New Password</label>
                                <div class="relative w-full">
                                    <input type="password" name="newPassword" placeholder="••••••••"
                                        class="w-full border border-gray-400 rounded-xl px-4 py-3 pr-10 text-sm focus:ring-2 focus:ring-blue-400 outline-none bg-transparent transition-colors">
                                    <i
                                        class="ph ph-eye absolute right-4 top-3.5 text-lg cursor-pointer text-gray-500 hover:text-gray-800 transition-colors toggle-password"></i>
                                </div>
                            </div>
                            <button type="submit" id="btnSavePassword"
                                class="self-start cursor-pointer bg-sidebarBg hover:bg-gray-800 text-white px-6 py-2.5 rounded-xl text-sm font-bold transition-colors shadow-sm mt-2">
                                Update Password
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </main>
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
                <h4 class="text-xl font-bold text-gray-900 mb-1"></h4>
                <p class="text-sm text-gray-500 mb-4"></p>
                <div class="bg-orange-50 rounded-lg p-4 border border-orange-100 mb-4">
                    <span
                        class="text-xs font-bold text-orange-800 uppercase tracking-wider block mb-1">Instructions</span>
                    <p class="text-sm text-orange-700"></p>
                </div>
                <h5 class="font-bold text-sm text-gray-700 mb-2">Parameters Checked:</h5>
                <ul class="text-sm text-gray-600 list-disc list-inside pl-4 space-y-1">
                    <li></li>
                </ul>
            </div>
            <div class="px-6 py-4 border-t border-gray-100 flex justify-end">
                <button
                    class="close-modal-btn px-5 py-2.5 rounded-xl text-sm font-bold text-gray-600 hover:bg-gray-200 transition-colors cursor-pointer"
                    data-modal="TestDetailsModalBackdrop">Close</button>
            </div>
        </div>
    </div>

    <div id="OrderPreviewModalBackdrop"
        class="fixed inset-0 bg-black/50 z-60 hidden items-center justify-center p-4 opacity-0 transition-opacity duration-300">
        <div id="OrderPreviewModal"
            class="bg-white w-full max-w-2xl rounded-[1.25rem] shadow-xl transform scale-95 transition-all duration-300 flex flex-col max-h-[90vh]">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <h3 class="text-lg font-extrabold text-gray-800">Order Print Preview</h3>
                <button class="close-modal-btn text-gray-400 hover:text-gray-800 transition-colors p-1"
                    data-modal="OrderPreviewModalBackdrop"><i class="ph ph-x text-xl"></i></button>
            </div>
            <div class="p-8 overflow-y-auto bg-gray-50 flex justify-center custom-scrollbar">
                <div class="bg-white shadow-sm border border-gray-200 w-full p-8 rounded-sm text-sm">
                    <div class="text-center mb-6 pb-6 border-b-2 border-gray-800">
                        <h1 class="text-2xl font-black uppercase tracking-widest">Medical Order Receipt</h1>
                        <p class="text-gray-500">ORD-1004 | FIA Synced</p>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div><span class="font-bold">Patient Name:</span> Sara Ahmed</div>
                        <div class="text-right"><span class="font-bold">Date:</span> Oct 24, 2023</div>
                    </div>
                    <table class="w-full text-left border-collapse mb-6">
                        <thead>
                            <tr class="border-b border-gray-300">
                                <th class="py-2">Description</th>
                                <th class="py-2 text-right">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-gray-100">
                                <td class="py-3">Complete Blood Count (CBC)</td>
                                <td class="py-3 text-right">Rs. 800</td>
                            </tr>
                            <tr class="border-b border-gray-100">
                                <td class="py-3">Liver Function Test (LFT)</td>
                                <td class="py-3 text-right">Rs. 1200</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="flex flex-col items-end gap-2 text-right">
                        <div class="w-48 flex justify-between"><span>Subtotal:</span> <span>Rs. 2000</span></div>
                        <div class="w-48 flex justify-between"><span>Discount:</span> <span>- Rs. 0</span></div>
                        <div class="w-48 flex justify-between"><span>Gov Tax (5%):</span> <span>Rs. 100</span></div>
                        <div class="w-48 flex justify-between font-bold text-lg border-t border-gray-300 pt-2 mt-2">
                            <span>Total:</span> <span>Rs. 2100</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-6 py-4 border-t border-gray-100 flex items-center justify-end gap-3">
                <button
                    class="close-modal-btn px-5 py-2.5 rounded-xl text-sm font-bold text-gray-600 hover:bg-gray-200 transition-colors"
                    data-modal="OrderPreviewModalBackdrop">Close</button>
                <button
                    class="bg-sidebarBg hover:bg-gray-800 text-white px-6 py-2.5 rounded-xl text-sm font-bold transition-colors shadow-sm flex items-center gap-2"><i
                        class="ph-bold ph-printer"></i> Print</button>
            </div>
        </div>
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
                const dateConfig = {
                    dateFormat: "Y-m-d",
                    altInput: true,
                    altFormat: "F j, Y",
                    allowInput: false,
                    disableMobile: "true"
                };
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


            function showTemporaryFormErrors(form, errors) {
                for (const [key, messages] of Object.entries(errors)) {
                    const input = form.querySelector(`[name="${key}"]`);
                    if (input) displayTemporaryMessage(input, messages[0], true);
                }
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


            const manageOrdersTableBody = document.querySelector('#section-manage-orders tbody');

            async function fetchUserOrders() {
                if (!manageOrdersTableBody) return;

                manageOrdersTableBody.innerHTML = `<tr><td colspan="5" class="px-6 py-8 text-center"><i class="ph-bold ph-spinner animate-spin text-2xl text-blue-600"></i><p class="text-sm text-gray-500 mt-2">Loading your orders...</p></td></tr>`;

                try {
                    const response = await fetch('/orders', { headers: fetchHeaders });
                    const result = await response.json();

                    if (result.status === 200) {
                        renderManageOrders(result.data);
                    } else {
                        manageOrdersTableBody.innerHTML = `<tr><td colspan="5" class="px-6 py-4 text-center text-red-500">Failed to load orders.</td></tr>`;
                    }
                } catch (error) {
                    manageOrdersTableBody.innerHTML = `<tr><td colspan="5" class="px-6 py-4 text-center text-red-500">Network error occurred.</td></tr>`;
                }
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
                    const orderDate = new Date(order.created_at);
                    const now = new Date();
                    const diffInMs = now - orderDate;
                    const isLessThanOneHour = diffInMs < (60 * 60 * 1000);
                    const isDeleted = order.deleted_at !== null;

                    let actionHtml = `<button onclick="window.open('/orders/${order.trackingId}/summary', '_blank')" class="text-blue-600 hover:text-blue-800 font-bold px-3 py-1.5 rounded-lg border border-blue-200 hover:bg-blue-50 transition-colors cursor-pointer mr-1">View</button>`;

                    if (!isDeleted && isLessThanOneHour) {
                        actionHtml += `<button data-id="${order.id}" class="btn-delete-order text-red-600 hover:text-red-800 font-bold px-3 py-1.5 rounded-lg border border-red-200 hover:bg-red-50 transition-colors cursor-pointer">Delete</button>`;
                    }

                    const rowClass = isDeleted ? "bg-red-50/40 border-b border-red-100 transition-colors text-red-500 font-medium animate-fade-in" : "bg-white border-b border-gray-100 hover:bg-gray-50 transition-colors text-gray-800 font-medium animate-fade-in";
                    const textClass = isDeleted ? "line-through opacity-70" : "";

                    manageOrdersTableBody.innerHTML += `
            <tr class="${rowClass}">
                <td class="px-6 py-4 font-bold ${isDeleted ? 'text-red-400' : 'text-gray-600'} ${textClass}">${order.trackingId}</td>
                <td class="px-6 py-4 ${textClass}">${order.name}</td>
                <td class="px-6 py-4 text-blue-500 text-xs font-bold">${timeAgoText}</td>
                <td class="px-6 py-4 ${isDeleted ? 'text-red-500' : 'text-green-600'} font-bold ${textClass}">Rs. ${order.grandTotal}</td>
                <td class="px-6 py-4 text-right flex justify-end">
                    ${actionHtml}
                </td>
            </tr>
            `;
                });
            }


            const searchManageOrdersInput = document.getElementById('searchManageOrdersInput');
            const searchManageOrdersError = document.getElementById('error-searchManageOrders');
            let searchDebounceTimer;

            if (searchManageOrdersInput) {
                searchManageOrdersInput.addEventListener('input', (e) => {
                    clearTimeout(searchDebounceTimer);
                    const query = e.target.value.trim();

                    if (searchManageOrdersError) {
                        searchManageOrdersError.classList.add('hidden');
                        searchManageOrdersError.innerText = '';
                    }

                    if (query === '') {
                        fetchUserOrders();
                        return;
                    }

                    searchDebounceTimer = setTimeout(async () => {
                        if (!manageOrdersTableBody) return;
                        manageOrdersTableBody.innerHTML = `<tr><td colspan="5" class="px-6 py-8 text-center"><i class="ph-bold ph-spinner animate-spin text-2xl text-blue-600"></i><p class="text-sm text-gray-500 mt-2">Searching...</p></td></tr>`;

                        try {
                            const response = await fetch(`/orders/search/${encodeURIComponent(query)}`, { headers: fetchHeaders });
                            const responseText = await response.text();

                            let result;
                            try {
                                result = JSON.parse(responseText);
                            } catch (parseError) {
                                throw new Error("Backend crashed");
                            }

                            if (response.ok && result.status === 200) {
                                let foundData = result.orders || result.order || result.data;
                                if (!Array.isArray(foundData)) foundData = [foundData];
                                renderManageOrders(foundData);
                            } else if (response.status === 404 || result.status === 404) {
                                if (searchManageOrdersError) {
                                    searchManageOrdersError.innerText = result.message || "Order not found.";
                                    searchManageOrdersError.classList.remove('hidden');
                                }
                                manageOrdersTableBody.innerHTML = `<tr><td colspan="5" class="px-6 py-8 text-center text-gray-500 font-medium">No results found for "${query}"</td></tr>`;
                            } else {
                                if (searchManageOrdersError) {
                                    searchManageOrdersError.innerText = result.message || "An error occurred.";
                                    searchManageOrdersError.classList.remove('hidden');
                                }
                                manageOrdersTableBody.innerHTML = `<tr><td colspan="5" class="px-6 py-8 text-center text-red-500 font-medium">Search failed.</td></tr>`;
                            }
                        } catch (error) {
                            if (searchManageOrdersError) {
                                searchManageOrdersError.innerText = "Error parsing search result.";
                                searchManageOrdersError.classList.remove('hidden');
                            }
                            manageOrdersTableBody.innerHTML = `<tr><td colspan="5" class="px-6 py-8 text-center text-red-500 font-medium">An error occurred.</td></tr>`;
                        }
                    }, 500);
                });
            }


            const dateFilterForm = document.getElementById('DashboardDateFilterForm');
            const reportEmptyState = document.getElementById('reportEmptyState');
            const reportLoadingState = document.getElementById('reportLoadingState');
            const reportDataState = document.getElementById('reportDataState');

            const resOrders = document.getElementById('res-orders');
            const resMoney = document.getElementById('res-money');
            const resDeleted = document.getElementById('res-deleted');
            const errorDashboardDate = document.getElementById('error-dashboard-date');


            async function fetchDashboardTodayStats() {
                const statOrders = document.getElementById('stat-orders-today');
                const statMoney = document.getElementById('stat-money-today');
                const statDeleted = document.getElementById('stat-deleted-today');

                if (!statOrders) return;

                const today = new Date().toISOString().split('T')[0];

                try {
                    const response = await fetch('/dashboard/stats', {
                        method: 'POST',
                        headers: fetchHeaders,
                        body: JSON.stringify({ startDate: today, endDate: today })
                    });

                    const result = await response.json();

                    if (response.ok && result.status === 200) {
                        statOrders.innerText = result.data.orders_created;
                        statMoney.innerText = `Rs. ${Number(result.data.money_collected).toLocaleString()}`;
                        statDeleted.innerText = result.data.deleted_orders;
                    }
                } catch (error) {
                }
            }

            fetchDashboardTodayStats();


            if (dateFilterForm) {
                dateFilterForm.addEventListener('submit', async (e) => {
                    e.preventDefault();

                    const startInput = document.getElementById('filterStartDate');
                    const endInput = document.getElementById('filterEndDate');
                    const startDate = startInput.value;
                    const endDate = endInput.value;

                    if (new Date(startDate) > new Date(endDate)) {
                        displayTemporaryMessage(startInput, "Start date cannot be greater than End date.", true);
                        return;
                    }

                    const btn = e.submitter;
                    const originalHtml = btn.innerHTML;
                    btn.innerHTML = `<i class="ph-bold ph-spinner animate-spin"></i> Searching...`;
                    btn.disabled = true;

                    reportEmptyState.classList.add('hidden');
                    reportDataState.classList.add('hidden');
                    reportLoadingState.classList.remove('hidden');

                    try {
                        const response = await fetch('/dashboard/stats', {
                            method: 'POST',
                            headers: fetchHeaders,
                            body: JSON.stringify({ startDate: startDate, endDate: endDate })
                        });

                        const responseText = await response.text();
                        let result;

                        try {
                            result = JSON.parse(responseText);
                        } catch (parseError) {
                            throw new Error("Backend crashed");
                        }

                        if (response.ok && result.status === 200) {
                            resOrders.innerText = result.data.orders_created;
                            resMoney.innerText = `Rs. ${Number(result.data.money_collected).toLocaleString()}`;
                            resDeleted.innerText = result.data.deleted_orders;

                            reportLoadingState.classList.add('hidden');
                            reportDataState.classList.remove('hidden');
                        } else if (response.status === 422) {
                            displayTemporaryMessage(startInput, "Invalid date format selected.", true);
                            reportLoadingState.classList.add('hidden');
                            reportEmptyState.classList.remove('hidden');
                        } else {
                            if (errorDashboardDate) {
                                errorDashboardDate.innerText = result.message || "Failed to fetch statistics.";
                                errorDashboardDate.classList.remove('hidden');
                                setTimeout(() => {
                                    errorDashboardDate.classList.add('hidden');
                                    errorDashboardDate.innerText = '';
                                }, 3000);
                            }
                            reportLoadingState.classList.add('hidden');
                            reportEmptyState.classList.remove('hidden');
                        }

                    } catch (error) {
                        if (errorDashboardDate) {
                            errorDashboardDate.innerText = "Network error occurred.";
                            errorDashboardDate.classList.remove('hidden');
                            setTimeout(() => {
                                errorDashboardDate.classList.add('hidden');
                                errorDashboardDate.innerText = '';
                            }, 3000);
                        }
                        reportLoadingState.classList.add('hidden');
                        reportEmptyState.classList.remove('hidden');
                    } finally {
                        btn.innerHTML = originalHtml;
                        btn.disabled = false;
                    }
                });
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

                if (title && headerTitle) {
                    headerTitle.innerText = title;
                }

                if (targetId === 'section-manage-orders') {
                    if (searchManageOrdersInput) searchManageOrdersInput.value = '';
                    if (searchManageOrdersError) searchManageOrdersError.classList.add('hidden');
                    fetchUserOrders();
                }

                if (targetId === 'section-dashboard') {
                    fetchDashboardTodayStats();
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


            const profileBtn = document.getElementById('profile-btn');
            const profileMenu = document.getElementById('profile-menu');

            if (profileBtn && profileMenu) {
                profileBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    profileMenu.classList.toggle('hidden');
                });

                document.addEventListener('click', (e) => {
                    if (!profileMenu.contains(e.target) && !profileBtn.contains(e.target)) {
                        profileMenu.classList.add('hidden');
                    }
                });
            }


            let directoryTests = [];
            const testDirectoryTableBody = document.querySelector('#section-tests tbody');
            const searchTestsDir = document.getElementById('searchTestsDir');

            async function fetchDirectoryTests() {
                if (!testDirectoryTableBody) return;
                testDirectoryTableBody.innerHTML = `<tr><td colspan="5" class="px-6 py-8 text-center"><i class="ph-bold ph-spinner animate-spin text-2xl text-purple-600"></i><p class="text-sm text-gray-500 mt-2">Loading tests...</p></td></tr>`;

                try {
                    const response = await fetch('/tests', { headers: fetchHeaders });
                    const result = await response.json();

                    if (result.status === 200) {
                        directoryTests = result.data;
                        renderDirectoryTests(directoryTests);
                    } else {
                        testDirectoryTableBody.innerHTML = `<tr><td colspan="5" class="px-6 py-4 text-center text-red-500">${result.message || 'No tests found.'}</td></tr>`;
                    }
                } catch (error) {
                    testDirectoryTableBody.innerHTML = `<tr><td colspan="5" class="px-6 py-4 text-center text-red-500">Failed to load tests.</td></tr>`;
                }
            }


            function renderDirectoryTests(tests) {
                if (!testDirectoryTableBody) return;
                testDirectoryTableBody.innerHTML = '';

                if (!tests || tests.length === 0) {
                    testDirectoryTableBody.innerHTML = `<tr><td colspan="5" class="px-6 py-8 text-center text-gray-500 font-medium">No tests found matching your search.</td></tr>`;
                    return;
                }

                tests.forEach(test => {
                    const code = test.testCode || test.test_code || test.code || 'N/A';
                    const name = test.testName || test.test_name || test.name || 'Unnamed Test';
                    const price = test.price || 0;
                    const time = test.timeRequired || test.time_required || 'Standard';

                    testDirectoryTableBody.innerHTML += `
            <tr class="bg-white border-b border-gray-100 hover:bg-gray-50 transition-colors text-gray-800 font-medium animate-fade-in">
                <td class="px-6 py-4 text-gray-500">${code}</td>
                <td class="px-6 py-4">${name}</td>
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
                        return name.includes(query) || code.includes(query);
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
                    const response = await fetch(`/tests/${id}`, { headers: fetchHeaders });
                    const result = await response.json();

                    if (result.status === 200) {
                        const test = result.data;
                        const code = test.testCode || test.test_code || test.code || 'N/A';
                        const name = test.testName || test.test_name || test.name || 'Unnamed Test';

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
                <h4 class="text-xl font-bold text-gray-900 mb-1">${name}</h4>
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


            fetchDirectoryTests();


            let orderCart = [];

            const searchInput = document.getElementById('orderTestSearch');
            const searchResults = document.getElementById('testSearchResults');
            const tableBody = document.getElementById('orderTestsTable');
            const discountInput = document.getElementById('calcDiscount');
            const elSubtotal = document.getElementById('calcSubtotal');
            const elTax = document.getElementById('calcTax');
            const elTotal = document.getElementById('calcTotal');


            if (searchInput) {
                searchInput.addEventListener('input', function (e) {
                    const query = e.target.value.toLowerCase().trim();
                    searchResults.innerHTML = '';

                    if (query.length === 0) {
                        searchResults.classList.add('hidden');
                        return;
                    }

                    const filtered = directoryTests.filter(test => {
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
                                addTestToCart(test);
                                searchInput.value = '';
                                searchResults.classList.add('hidden');
                            });
                            searchResults.appendChild(item);
                        });
                    } else {
                        searchResults.innerHTML = `<div class="px-4 py-3 text-sm text-gray-500 text-center">No tests found matching "${query}"</div>`;
                    }
                    searchResults.classList.remove('hidden');
                });

                document.addEventListener('click', (e) => {
                    if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
                        searchResults.classList.add('hidden');
                    }
                });
            }


            function addTestToCart(test) {
                if (orderCart.find(t => t.id === test.id)) {
                    displayTemporaryMessage(searchInput, 'This test is already added to the order.', true);
                    return;
                }
                orderCart.push(test);
                renderCart();
            }


            window.removeTestFromCart = function (testId) {
                orderCart = orderCart.filter(t => t.id !== testId);
                renderCart();
            };


            function renderCart() {
                if (orderCart.length === 0) {
                    tableBody.innerHTML = `<tr><td colspan="4" class="px-4 py-8 text-center text-gray-400 font-medium">No tests added yet. Search and select tests above.</td></tr>`;
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

                if (elSubtotal) elSubtotal.innerText = subtotal.toFixed(2);
                if (elTax) elTax.innerText = tax.toFixed(2);
                if (elTotal) elTotal.innerText = grandTotal.toFixed(2);
            }


            discountInput?.addEventListener('input', calculateTotals);


            document.getElementById('CreateOrderForm')?.addEventListener('submit', async (e) => {
                e.preventDefault();

                document.querySelectorAll('[id^="error-"]').forEach(el => {
                    el.innerText = '';
                    el.classList.add('hidden');
                });

                const btn = e.submitter;
                const originalHtml = btn.innerHTML;
                btn.innerHTML = `<i class="ph-bold ph-spinner animate-spin text-lg"></i> Processing...`;
                btn.disabled = true;

                const formData = new FormData(e.target);
                let rawPhone = formData.get('phone') || '';
                let cleanPhone = rawPhone.replace(/[^0-9]/g, '');

                const payload = {
                    name: formData.get('patient_name'),
                    phone: cleanPhone,
                    age: formData.get('age'),
                    gender: formData.get('gender'),
                    email: formData.get('email'),
                    discount: document.getElementById('calcDiscount').value || 0,
                    tests: orderCart.map(test => test.id)
                };

                try {
                    const response = await fetch('/orders', {
                        method: 'POST',
                        headers: fetchHeaders,
                        body: JSON.stringify(payload)
                    });

                    const responseText = await response.text();
                    let result;
                    try {
                        result = JSON.parse(responseText);
                    } catch (parseError) {
                        throw new Error("Backend crashed");
                    }

                    if (response.status === 422) {
                        const hasBasicErrors = Object.keys(result.errors).some(field => field !== 'tests');

                        for (const field in result.errors) {
                            if (field === 'tests' && hasBasicErrors) continue;

                            let errorSpanId = field === 'name' ? 'error-patient_name' : `error-${field}`;
                            const errorEl = document.getElementById(errorSpanId);

                            if (errorEl) {
                                errorEl.innerText = result.errors[field][0];
                                errorEl.classList.remove('hidden');

                                setTimeout(() => {
                                    errorEl.classList.add('hidden');
                                    errorEl.innerText = '';
                                }, 3000);
                            }
                        }
                    } else if (response.ok && (result.status === 200 || result.status === 'success')) {
                        let successMsg = document.getElementById('order-success-msg');
                        if (!successMsg) {
                            successMsg = document.createElement('p');
                            successMsg.id = 'order-success-msg';
                            successMsg.className = 'text-green-600 font-bold text-sm mb-4 text-right animate-fade-in';
                            const submitContainer = btn.parentElement;
                            submitContainer.parentNode.insertBefore(successMsg, submitContainer);
                        }
                        successMsg.innerText = `Order Successfully Generated!`;
                        successMsg.classList.remove('hidden');

                        setTimeout(() => {
                            successMsg.classList.add('hidden');
                            window.open(`/orders/${result.tracking_id}/summary`, '_blank');
                            e.target.reset();
                            orderCart = [];
                            renderCart();
                            fetchDashboardTodayStats();
                            switchSection('section-manage-orders', 'Manage Orders');
                        }, 2000);
                    } else {
                        let errorMsg = document.getElementById('order-error-msg');
                        if (!errorMsg) {
                            errorMsg = document.createElement('p');
                            errorMsg.id = 'order-error-msg';
                            errorMsg.className = 'text-red-600 font-bold text-sm mb-4 text-right animate-fade-in';
                            const submitContainer = btn.parentElement;
                            submitContainer.parentNode.insertBefore(errorMsg, submitContainer);
                        }
                        errorMsg.innerText = result.message || 'An error occurred.';
                        errorMsg.classList.remove('hidden');
                        setTimeout(() => {
                            errorMsg.classList.add('hidden');
                        }, 3000);
                    }

                } catch (error) {
                } finally {
                    btn.innerHTML = originalHtml;
                    btn.disabled = false;
                }
            });


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

                if (e.target.closest('.btn-view-order')) openModal('OrderPreviewModalBackdrop');

                if (e.target.closest('.close-modal-btn')) {
                    closeModal(e.target.closest('.close-modal-btn').getAttribute('data-modal'));
                }

                if (e.target.closest('.btn-delete-order')) {
                    const deleteBtn = e.target.closest('.btn-delete-order');
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

                        if (response.ok && result.status === 200) {
                            row.classList.add('opacity-0', 'transition-opacity', 'duration-300');
                            setTimeout(() => {
                                fetchUserOrders();
                                fetchDashboardTodayStats();
                            }, 300);
                        } else {
                            console.error(result.message || 'Failed to delete order.');
                            deleteBtn.innerHTML = originalHtml;
                            deleteBtn.disabled = false;
                        }
                    } catch (error) {
                        console.error('Delete Error:', error);
                        deleteBtn.innerHTML = originalHtml;
                        deleteBtn.disabled = false;
                    }
                }
            });


            document.querySelectorAll('.toggle-password').forEach(icon => {
                icon.addEventListener('click', function () {
                    const input = this.previousElementSibling;
                    if (input.type === 'password') {
                        input.type = 'text';
                        this.classList.replace('ph-eye', 'ph-eye-slash');
                        this.classList.add('text-blue-500');
                    } else {
                        input.type = 'password';
                        this.classList.replace('ph-eye-slash', 'ph-eye');
                        this.classList.remove('text-blue-500');
                    }
                });
            });


            if (userId) {
                document.getElementById('UpdateEmailForm')?.addEventListener('submit', async (e) => {
                    e.preventDefault();
                    const form = e.target;
                    const btn = document.getElementById('btnSaveEmail');
                    const originalText = btn.innerText;

                    btn.innerHTML = `<i class="ph-bold ph-spinner animate-spin mr-1"></i> Saving...`;
                    btn.disabled = true;

                    const payload = {
                        email: form.querySelector('input[name="email"]').value
                    };

                    try {
                        const response = await fetch(`/user/${userId}/email`, {
                            method: 'PUT',
                            headers: fetchHeaders,
                            body: JSON.stringify(payload)
                        });
                        const result = await response.json();
                        const emailInput = form.querySelector('input[name="email"]');

                        if (response.status === 422) {
                            showTemporaryFormErrors(form, result.errors);
                        } else if (response.ok && result.status === 200) {
                            displayTemporaryMessage(emailInput, 'Email updated successfully!', false);
                        } else {
                            displayTemporaryMessage(emailInput, result.message || 'Failed to update email.', true);
                        }
                    } catch (error) {
                        const emailInput = form.querySelector('input[name="email"]');
                        displayTemporaryMessage(emailInput, 'Network error occurred.', true);
                    } finally {
                        btn.innerText = originalText;
                        btn.disabled = false;
                    }
                });


                document.getElementById('UpdatePasswordForm')?.addEventListener('submit', async (e) => {
                    e.preventDefault();
                    const form = e.target;
                    const btn = document.getElementById('btnSavePassword');
                    const originalText = btn.innerText;

                    btn.innerHTML = `<i class="ph-bold ph-spinner animate-spin mr-1"></i> Updating...`;
                    btn.disabled = true;

                    const payload = {
                        password: form.querySelector('input[name="password"]').value,
                        newPassword: form.querySelector('input[name="newPassword"]').value
                    };

                    try {
                        const response = await fetch(`/user/${userId}/password`, {
                            method: 'PUT',
                            headers: fetchHeaders,
                            body: JSON.stringify(payload)
                        });
                        const result = await response.json();

                        if (response.status === 422) {
                            showTemporaryFormErrors(form, result.errors);
                        } else if (result.status === 400) {
                            const currentPassInput = form.querySelector('input[name="password"]');
                            displayTemporaryMessage(currentPassInput, result.message, true);
                        } else if (response.ok && result.status === 200) {
                            const newPassInput = form.querySelector('input[name="newPassword"]');
                            displayTemporaryMessage(newPassInput, 'Password updated successfully!', false);
                            form.reset();
                        } else {
                            const newPassInput = form.querySelector('input[name="newPassword"]');
                            displayTemporaryMessage(newPassInput, 'Failed to update password.', true);
                        }
                    } catch (error) {
                        const newPassInput = form.querySelector('input[name="newPassword"]');
                        displayTemporaryMessage(newPassInput, 'Network error occurred.', true);
                    } finally {
                        btn.innerText = originalText;
                        btn.disabled = false;
                    }
                });
            }

        });
    </script>
</body>