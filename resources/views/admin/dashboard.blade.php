<x-header />

<body class="font-sans antialiased bg-mainBg text-gray-800 flex h-screen overflow-hidden">

    <div id="sidebar-backdrop"
        class="fixed inset-0 bg-black/50 z-40 hidden transition-opacity md:hidden cursor-pointer"></div>

    <aside id="sidebar"
        class="bg-sidebarBg text-white w-64 shrink-0 transition-all duration-300 flex flex-col fixed inset-y-0 left-0 z-50 md:relative transform -translate-x-full md:translate-x-0">
        <div class="h-20 flex items-center justify-between px-6 pt-2">
            <span id="brand-text"
                class="text-white text-xl font-bold whitespace-nowrap tracking-wide">Administrator</span>
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
                data-target="section-department" data-title="Departments">
                <i
                    class="ph-duotone ph-buildings text-2xl w-7 text-center text-gray-400 group-hover:text-white transition-colors nav-icon"></i>
                <span class="ml-3 nav-text whitespace-nowrap">Departments</span>
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
                data-target="section-doctor" data-title="Doctor">
                <i
                    class="ph-duotone ph-stethoscope text-2xl w-7 text-center text-gray-400 group-hover:text-white transition-colors nav-icon"></i>
                <span class="ml-3 nav-text whitespace-nowrap">Pathologist</span>
            </a>

            <a href="#"
                class="nav-link flex items-center px-6 py-3 text-gray-300 hover:bg-white/10 hover:text-white transition-colors group cursor-pointer"
                data-target="section-sample-collector" data-title="Sample Collector">
                <i
                    class="ph-duotone ph-syringe text-2xl w-7 text-center text-gray-400 group-hover:text-white transition-colors nav-icon"></i>
                <span class="ml-3 nav-text whitespace-nowrap">Sample Collector</span>
            </a>

            <a href="#"
                class="nav-link flex items-center px-6 py-3 text-gray-300 hover:bg-white/10 hover:text-white transition-colors group cursor-pointer"
                data-target="section-technician" data-title="Technicians">
                <i
                    class="ph-duotone ph-desktop text-2xl w-7 text-center text-gray-400 group-hover:text-white transition-colors nav-icon"></i>
                <span class="ml-3 nav-text whitespace-nowrap">Technician</span>
            </a>

            <a href="#"
                class="nav-link flex items-center px-6 py-3 text-gray-300 hover:bg-white/10 hover:text-white transition-colors group cursor-pointer"
                data-target="section-specialist" data-title="Specialist Doctors">
                <i
                    class="ph-duotone ph-clipboard-text text-2xl w-7 text-center text-gray-400 group-hover:text-white transition-colors nav-icon"></i>
                <span class="ml-3 nav-text whitespace-nowrap">Specialist Doctor</span>
            </a>

            <a href="#"
                class="nav-link flex items-center px-6 py-3 text-gray-300 hover:bg-white/10 hover:text-white transition-colors group cursor-pointer"
                data-target="section-receptionist" data-title="Receptionist">
                <i
                    class="ph-duotone ph-headset text-2xl w-7 text-center text-gray-400 group-hover:text-white transition-colors nav-icon"></i>
                <span class="ml-3 nav-text whitespace-nowrap">Receptionist</span>
            </a>

            <a href="#"
                class="nav-link flex items-center px-6 py-3 text-gray-300 hover:bg-white/10 hover:text-white transition-colors group cursor-pointer"
                data-target="section-stock" data-title="Stock Management">
                <i
                    class="ph-duotone ph-package text-2xl w-7 text-center text-gray-400 group-hover:text-white transition-colors nav-icon"></i>
                <span class="ml-3 nav-text whitespace-nowrap">Stock Management</span>
            </a>
            <a href="#"
                class="nav-link flex items-center px-6 py-3 text-gray-300 hover:bg-white/10 hover:text-white transition-colors group cursor-pointer"
                data-target="section-performance" data-title="Performance">
                <i
                    class="ph-duotone ph-trend-up text-2xl w-7 text-center text-gray-400 group-hover:text-white transition-colors nav-icon"></i>
                <span class="ml-3 nav-text whitespace-nowrap">Performance</span>
            </a>
            <a href="#"
                class="nav-link flex items-center px-6 py-3 text-gray-300 hover:bg-white/10 hover:text-white transition-colors group cursor-pointer"
                data-target="section-settings" data-title="Settings">
                <i
                    class="ph-duotone ph-gear-six text-2xl w-7 text-center text-gray-400 group-hover:text-white transition-colors nav-icon"></i>
                <span class="ml-3 nav-text whitespace-nowrap">Settings</span>
            </a>

            <div class="pt-4 mt-2 border-t border-gray-700/50">
                <a href="{{ Route('logout') }}"
                    class="flex items-center px-6 py-3 text-gray-300 hover:bg-white/10 hover:text-white transition-colors group cursor-pointer">
                    <i
                        class="ph-duotone ph-sign-out text-2xl w-7 text-center text-gray-400 group-hover:text-white transition-colors"></i>
                    <span class="ml-3 nav-text whitespace-nowrap">Logout</span>
                </a>
            </div>
        </nav>
    </aside>

    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
        <header class="h-20 px-4 md:px-10 flex items-center justify-between z-20 sticky top-0 bg-mainBg">
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

            <div class="flex items-center space-x-6">
                <div class="relative hidden sm:flex items-center">
                    <input type="text" placeholder="Search"
                        class="bg-white border border-gray-200 rounded-full py-1.5 pl-4 pr-10 text-sm focus:outline-none focus:ring-2 focus:ring-gray-200 w-48 lg:w-64 shadow-sm">
                </div>

                <div class="relative">
                    <button id="profile-btn"
                        class="text-gray-700 hover:text-black transition-colors focus:outline-none flex items-center gap-2 cursor-pointer">
                        <i class="ph-duotone ph-user-circle text-3xl md:text-4xl"></i>
                    </button>

                    <div id="profile-menu"
                        class="absolute right-0 mt-3 w-56 bg-white rounded-xl shadow-[0_10px_40px_rgba(0,0,0,0.08)] border border-gray-100 hidden z-50 transform origin-top-right dropdown-enter">
                        <div class="px-5 py-4 border-b border-gray-100 bg-gray-50/50 rounded-t-xl">
                            <p class="text-sm font-bold text-gray-900">Administrator</p>
                            <p class="text-xs text-gray-500 font-medium mt-0.5">Shaharyar</p>
                        </div>
                        <div class="py-2">
                            <a href="#"
                                class="px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-black transition-colors flex items-center gap-3 cursor-pointer">
                                Profile
                            </a>
                            <a href="#"
                                class="px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-black transition-colors flex items-center gap-3 cursor-pointer">
                                Settings
                            </a>
                            <x-logout />
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-4 md:p-10 pt-2 relative">
            <div id="section-dashboard" class="content-section block animate-fade-in w-full max-w-7xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 w-full max-w-7xl mx-auto">
                    <div class="bg-white rounded-[1.25rem] shadow-[0_4px_20px_rgba(0,0,0,0.03)] p-6">
                        <div
                            class="w-12 h-12 rounded-lg bg-blue-50 text-blue-500 flex items-center justify-center mb-4">
                            <i class="ph-duotone ph-shopping-cart text-2xl"></i>
                        </div>
                        <h3 class="text-3xl font-extrabold text-black mb-1" id="stat-orders-today">0</h3>
                        <p class="text-gray-500 font-medium">Monthly Orders</p>
                    </div>

                    <div class="bg-white rounded-[1.25rem] shadow-[0_4px_20px_rgba(0,0,0,0.03)] p-6">
                        <div
                            class="w-12 h-12 rounded-lg bg-green-50 text-green-600 flex items-center justify-center mb-4">
                            <i class="ph-duotone ph-check-circle text-2xl"></i>
                        </div>
                        <h3 class="text-3xl font-extrabold text-black mb-1" id="stat-completed-today">0</h3>
                        <p class="text-gray-500 font-medium">Completed Tests</p>
                    </div>

                    <div class="bg-white rounded-[1.25rem] shadow-[0_4px_20px_rgba(0,0,0,0.03)] p-6">
                        <div
                            class="w-12 h-12 rounded-lg bg-orange-50 text-orange-500 flex items-center justify-center mb-4">
                            <i class="ph-duotone ph-clock text-2xl"></i>
                        </div>
                        <h3 class="text-3xl font-extrabold text-black mb-1" id="stat-pending-today">0</h3>
                        <p class="text-gray-500 font-medium">Pending Tests</p>
                    </div>

                    <div class="bg-white rounded-[1.25rem] shadow-[0_4px_20px_rgba(0,0,0,0.03)] p-6">
                        <div
                            class="w-12 h-12 rounded-lg bg-emerald-50 text-emerald-500 flex items-center justify-center mb-4">
                            <i class="ph-duotone ph-money text-2xl"></i>
                        </div>
                        <h3 class="text-3xl font-extrabold text-black mb-1" id="stat-money-today">Rs. 0</h3>
                        <p class="text-gray-500 font-medium">Monthly Revenue</p>
                    </div>

                    <div class="bg-white rounded-[1.25rem] shadow-[0_4px_20px_rgba(0,0,0,0.03)] p-6">
                        <div
                            class="w-12 h-12 rounded-lg bg-purple-50 text-purple-500 flex items-center justify-center mb-4">
                            <i class="ph-duotone ph-receipt text-2xl"></i>
                        </div>
                        <h3 class="text-3xl font-extrabold text-black mb-1" id="stat-tax-today">Rs. 0</h3>
                        <p class="text-gray-500 font-medium">Total Tax</p>
                    </div>

                    <div class="bg-white rounded-[1.25rem] shadow-[0_4px_20px_rgba(0,0,0,0.03)] p-6">
                        <div class="w-12 h-12 rounded-lg bg-red-50 text-red-500 flex items-center justify-center mb-4">
                            <i class="ph-duotone ph-trash text-2xl"></i>
                        </div>
                        <h3 class="text-3xl font-extrabold text-black mb-1" id="stat-deleted-today">0</h3>
                        <p class="text-gray-500 font-medium">Deleted Orders</p>
                    </div>
                </div>

                <div
                    class="bg-white rounded-[1.25rem] shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-50 overflow-hidden w-full">
                    <div
                        class="p-5 border-b border-gray-100 flex flex-col lg:flex-row justify-between gap-4 items-start lg:items-center bg-gray-50/50">
                        <div class="flex flex-col">
                            <div class="flex items-center gap-2">
                                <i class="ph-duotone ph-calendar-blank text-xl text-gray-500"></i>
                                <h3 class="text-base font-bold text-gray-800">Custom Date Statistics</h3>
                            </div>
                            <p id="dateErrorMsg" class="text-sm font-bold text-red-500 mt-1 hidden"></p>
                        </div>

                        <form id="DashboardDateFilterForm"
                            class="flex flex-col sm:flex-row items-center gap-3 w-full lg:w-auto">
                            <div class="relative w-full sm:w-auto">
                                <input type="text" id="filterStartDate" placeholder="Start Date"
                                    class="w-full sm:w-40 pl-4 pr-4 py-2 bg-white border border-gray-200 rounded-xl text-sm font-medium focus:outline-none focus:border-blue-500">
                            </div>
                            <div class="relative w-full sm:w-auto">
                                <input type="text" id="filterEndDate" placeholder="End Date"
                                    class="w-full sm:w-40 pl-4 pr-4 py-2 bg-white border border-gray-200 rounded-xl text-sm font-medium focus:outline-none focus:border-blue-500">
                            </div>
                            <button type="submit"
                                class="bg-gray-900 hover:bg-gray-800 text-white px-6 py-2 cursor-pointer rounded-xl text-sm font-bold flex items-center justify-center gap-2 w-full sm:w-auto transition-colors">
                                <i class="ph-bold ph-magnifying-glass"></i> Search
                            </button>
                        </form>
                    </div>

                    <div id="DashboardReportResults" class="p-6 md:p-8 bg-gray-50/30">
                        <div id="reportEmptyState" class="text-center py-8">
                            <i class="ph-duotone ph-calendar-check text-5xl mb-3 text-gray-300 block"></i>
                            <p class="text-gray-500 font-medium">Select a date range to view statistics.</p>
                        </div>

                        <div id="reportLoadingState" class="hidden text-center py-8">
                            <i class="ph-bold ph-spinner animate-spin text-4xl mb-3 text-blue-500 block"></i>
                            <p class="text-gray-500 font-medium">Calculating Statistics</p>
                        </div>

                        <div id="reportDataState" class="hidden grid grid-cols-1 md:grid-cols-3 gap-6 animate-fade-in">
                            <div
                                class="bg-white rounded-[1.25rem] shadow-[0_4px_20px_rgba(0,0,0,0.03)] p-6 border border-gray-50">
                                <div
                                    class="w-12 h-12 rounded-lg bg-blue-50 text-blue-500 flex items-center justify-center mb-4">
                                    <i class="ph-duotone ph-shopping-cart text-2xl"></i>
                                </div>
                                <h3 class="text-3xl font-extrabold text-black mb-1" id="res-orders">0</h3>
                                <p class="text-gray-500 font-medium">Orders</p>
                            </div>

                            <div
                                class="bg-white rounded-[1.25rem] shadow-[0_4px_20px_rgba(0,0,0,0.03)] p-6 border border-gray-50">
                                <div
                                    class="w-12 h-12 rounded-lg bg-green-50 text-green-600 flex items-center justify-center mb-4">
                                    <i class="ph-duotone ph-check-circle text-2xl"></i>
                                </div>
                                <h3 class="text-3xl font-extrabold text-black mb-1" id="res-completed">0</h3>
                                <p class="text-gray-500 font-medium">Completed</p>
                            </div>

                            <div
                                class="bg-white rounded-[1.25rem] shadow-[0_4px_20px_rgba(0,0,0,0.03)] p-6 border border-gray-50">
                                <div
                                    class="w-12 h-12 rounded-lg bg-orange-50 text-orange-500 flex items-center justify-center mb-4">
                                    <i class="ph-duotone ph-clock text-2xl"></i>
                                </div>
                                <h3 class="text-3xl font-extrabold text-black mb-1" id="res-pending">0</h3>
                                <p class="text-gray-500 font-medium">Pending</p>
                            </div>

                            <div
                                class="bg-white rounded-[1.25rem] shadow-[0_4px_20px_rgba(0,0,0,0.03)] p-6 border border-gray-50">
                                <div
                                    class="w-12 h-12 rounded-lg bg-emerald-50 text-emerald-500 flex items-center justify-center mb-4">
                                    <i class="ph-duotone ph-money text-2xl"></i>
                                </div>
                                <h3 class="text-3xl font-extrabold text-black mb-1" id="res-money">Rs. 0</h3>
                                <p class="text-gray-500 font-medium">Revenue</p>
                            </div>

                            <div
                                class="bg-white rounded-[1.25rem] shadow-[0_4px_20px_rgba(0,0,0,0.03)] p-6 border border-gray-50">
                                <div
                                    class="w-12 h-12 rounded-lg bg-purple-50 text-purple-500 flex items-center justify-center mb-4">
                                    <i class="ph-duotone ph-receipt text-2xl"></i>
                                </div>
                                <h3 class="text-3xl font-extrabold text-black mb-1" id="res-tax">Rs. 0</h3>
                                <p class="text-gray-500 font-medium">Tax</p>
                            </div>

                            <div
                                class="bg-white rounded-[1.25rem] shadow-[0_4px_20px_rgba(0,0,0,0.03)] p-6 border border-gray-50">
                                <div
                                    class="w-12 h-12 rounded-lg bg-red-50 text-red-500 flex items-center justify-center mb-4">
                                    <i class="ph-duotone ph-trash text-2xl"></i>
                                </div>
                                <h3 class="text-3xl font-extrabold text-black mb-1" id="res-deleted">0</h3>
                                <p class="text-gray-500 font-medium">Deleted</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="section-doctor" class="content-section hidden animate-fade-in w-full max-w-7xl mx-auto">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-500 flex items-center justify-center">
                            <i class="ph-duotone ph-stethoscope text-2xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-extrabold text-gray-800">Pathologists</h2>
                            <p class="text-sm text-gray-500 font-medium">Manage pathologist profiles and schedules</p>
                        </div>
                    </div>
                    <button data-role="Pathologist"
                        class="open-user-modal-btn bg-sidebarBg hover:bg-gray-800 text-white px-5 py-2.5 rounded-xl text-sm font-bold transition-colors flex items-center gap-2 cursor-pointer shadow-sm">
                        <i class="ph ph-plus font-bold text-lg"></i> Add Pathologist
                    </button>
                </div>
                <div id="grid-pathologist" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                </div>
            </div>
            <div id="section-department" class="content-section hidden animate-fade-in w-full max-w-7xl mx-auto pb-12">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-orange-50 text-orange-500 flex items-center justify-center">
                            <i class="ph-duotone ph-buildings text-2xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-extrabold text-gray-800">Departments</h2>
                            <p class="text-sm text-gray-500 font-medium">Manage hospital departments and wards</p>
                        </div>
                    </div>
                    <button id="open-department-modal"
                        class="bg-gray-900 hover:bg-gray-800 text-white px-5 py-2.5 rounded-xl text-sm font-bold transition-colors flex items-center gap-2 cursor-pointer shadow-sm">
                        <i class="ph-bold ph-plus text-lg"></i> Add Department
                    </button>
                </div>

                <div id="grid-department"
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-12">
                </div>

                <div class="flex items-center gap-3 mb-6 mt-8 pt-8 border-t border-gray-200">
                    <div class="w-10 h-10 rounded-xl bg-red-50 text-red-500 flex items-center justify-center">
                        <i class="ph-duotone ph-trash text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-extrabold text-gray-800">Deleted Departments</h3>
                    </div>
                </div>

                <div id="grid-deleted-department"
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                </div>
            </div>
            <x-tests />

            <div id="section-sample-collector" class="content-section hidden animate-fade-in w-full max-w-7xl mx-auto">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-red-50 text-red-500 flex items-center justify-center">
                            <i class="ph-duotone ph-syringe text-2xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-extrabold text-gray-800">Sample Collectors</h2>
                            <p class="text-sm text-gray-500 font-medium">Track and manage sample collection personnel
                            </p>
                        </div>
                    </div>
                    <button data-role="SampleCollector"
                        class="open-user-modal-btn bg-sidebarBg hover:bg-gray-800 text-white px-5 py-2.5 rounded-xl text-sm font-bold transition-colors flex items-center gap-2 cursor-pointer shadow-sm">
                        <i class="ph ph-plus font-bold text-lg"></i> Add Collector
                    </button>
                </div>
                <div id="grid-sample-collector"
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6"></div>
            </div>
            <div id="section-technician" class="content-section hidden animate-fade-in w-full max-w-7xl mx-auto">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-cyan-50 text-cyan-500 flex items-center justify-center">
                            <i class="ph-duotone ph-desktop text-2xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-extrabold text-gray-800">Technicians</h2>
                            <p class="text-sm text-gray-500 font-medium">Manage machine operators (X-Ray, MRI, ECG)</p>
                        </div>
                    </div>
                    <button data-role="Technician"
                        class="open-user-modal-btn bg-sidebarBg hover:bg-gray-800 text-white px-5 py-2.5 rounded-xl text-sm font-bold transition-colors flex items-center gap-2 cursor-pointer shadow-sm">
                        <i class="ph ph-plus font-bold text-lg"></i> Add Technician
                    </button>
                </div>
                <div id="grid-technician" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                </div>
            </div>
            <div id="section-specialist" class="content-section hidden animate-fade-in w-full max-w-7xl mx-auto">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-teal-50 text-teal-500 flex items-center justify-center">
                            <i class="ph-duotone ph-clipboard-text text-2xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-extrabold text-gray-800">Specialist Doctors</h2>
                            <p class="text-sm text-gray-500 font-medium">Manage reporting doctors (Radiologists,
                                Cardiologists)</p>
                        </div>
                    </div>
                    <button data-role="SpecialistDoctor"
                        class="open-user-modal-btn bg-sidebarBg hover:bg-gray-800 text-white px-5 py-2.5 rounded-xl text-sm font-bold transition-colors flex items-center gap-2 cursor-pointer shadow-sm">
                        <i class="ph ph-plus font-bold text-lg"></i> Add Specialist
                    </button>
                </div>
                <div id="grid-specialist" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                </div>
            </div>
            <div id="section-receptionist" class="content-section hidden animate-fade-in w-full max-w-7xl mx-auto">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-yellow-50 text-yellow-600 flex items-center justify-center">
                            <i class="ph-duotone ph-headset text-2xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-extrabold text-gray-800">Reception Staff</h2>
                            <p class="text-sm text-gray-500 font-medium">Manage front desk operations and personnel</p>
                        </div>
                    </div>
                    <button data-role="Receptionist"
                        class="open-user-modal-btn bg-sidebarBg hover:bg-gray-800 text-white px-5 py-2.5 rounded-xl text-sm font-bold transition-colors flex items-center gap-2 cursor-pointer shadow-sm">
                        <i class="ph ph-plus font-bold text-lg"></i> Add Receptionist
                    </button>
                </div>
                <div id="grid-receptionist" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                </div>
            </div>
            <div id="section-performance" class="content-section hidden animate-fade-in">
                <div
                    class="bg-white rounded-[1.25rem] shadow-[0_4px_20px_rgba(0,0,0,0.03)] p-6 md:p-12 w-full flex flex-col items-center justify-center min-h-[400px] border border-gray-50">
                    <i class="ph-duotone ph-trend-up text-[5rem] text-green-400 mb-4"></i>
                    <h2 class="text-2xl font-bold text-gray-800">Performance Metrics</h2>
                    <p class="text-gray-500 mt-2">Lab performance and analytical data will appear here.</p>
                </div>
            </div>
            <div id="section-stock" class="content-section hidden animate-fade-in w-full max-w-7xl mx-auto p-4 sm:p-6">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-orange-50 text-orange-500 flex items-center justify-center">
                            <i class="ph-duotone ph-package text-2xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-extrabold text-gray-800">Inventory Management</h2>
                            <p class="text-sm text-gray-500 font-medium">Manage lab stock, view alerts, and track usage
                            </p>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-2 w-full sm:w-auto">
                        <button id="BtnExportPdf"
                            class="bg-white border cursor-pointer border-gray-200 hover:bg-gray-50 text-gray-700 px-4 py-2.5 rounded-xl text-sm font-bold transition-colors flex items-center gap-2 shadow-sm">
                            Export PDF
                        </button>
                        <button id="BtnGlobalHistory"
                            class="bg-white border cursor-pointer border-gray-200 hover:bg-gray-50 text-gray-700 px-4 py-2.5 rounded-xl text-sm font-bold transition-colors flex items-center gap-2 shadow-sm">
                            History
                        </button>
                        <button id="BtnOpenAddInventory"
                            class="bg-gray-800 cursor-pointer hover:bg-gray-900 text-white px-4 py-2.5 rounded-xl text-sm font-bold transition-colors flex items-center gap-2 shadow-sm">
                            Register Item
                        </button>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden w-full">
                    <div
                        class="p-4 border-b border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4 bg-gray-50/50">
                        <div class="flex bg-gray-200/60 p-1 rounded-xl w-full md:w-auto">
                            <button id="TabActiveItems"
                                class="flex-1 md:w-32 py-1.5 px-3 rounded-lg bg-white shadow-sm text-sm font-bold text-gray-800 transition-all cursor-pointer">Active</button>
                            <button id="TabTrashedItems"
                                class="flex-1 md:w-32 py-1.5 px-3 rounded-lg text-sm font-medium text-gray-500 hover:text-gray-700 transition-all cursor-pointer">Trash
                                Bin</button>
                        </div>
                        <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto flex-1 md:justify-end">
                            <div class="relative w-full sm:w-72">
                                <i
                                    class="ph-duotone ph-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-lg"></i>
                                <input type="text" id="inventory-search" placeholder="Search inventory"
                                    class="w-full pl-11 pr-4 py-2 rounded-xl border border-gray-200 focus:ring-2 focus:ring-orange-100 bg-white transition-colors text-sm font-medium">
                            </div>
                            <button id="BtnFetchAlerts"
                                class="w-full sm:w-auto bg-red-50 text-red-600 hover:bg-red-100 px-4 py-2 rounded-xl text-sm font-bold transition-colors flex items-center justify-center gap-2 cursor-pointer">
                                Alerts
                            </button>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm whitespace-nowrap">
                            <thead
                                class="text-xs text-gray-500 uppercase font-bold bg-gray-50/50 border-b border-gray-100">
                                <tr>
                                    <th class="px-6 py-4">Item Name</th>
                                    <th class="px-6 py-4">Stock Quantity</th>
                                    <th class="px-6 py-4">Alert Limit</th>
                                    <th class="px-6 py-4 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="inventory-table-body"></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div id="section-settings" class="content-section hidden animate-fade-in">
                <div
                    class="bg-white rounded-[1.25rem] shadow-[0_4px_20px_rgba(0,0,0,0.03)] p-6 md:p-12 w-full flex flex-col items-center justify-center min-h-[400px] border border-gray-50">
                    <i class="ph-duotone ph-gear-six text-[5rem] text-gray-400 mb-4"></i>
                    <h2 class="text-2xl font-bold text-gray-800">System Settings</h2>
                    <p class="text-gray-500 mt-2">Configure application preferences and settings.</p>
                </div>
            </div>


        </main>
    </div>
    <div id="AddUserModalBackdrop"
        class="fixed inset-0 bg-black/50 z-60 hidden items-center justify-center p-4 opacity-0 transition-opacity duration-300">
        <div id="AddUserModal"
            class="bg-white w-full max-w-lg rounded-[1.25rem] shadow-[0_10px_40px_rgba(0,0,0,0.1)] transform scale-95 transition-all duration-300 flex flex-col max-h-[90vh]">

            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-blue-50 text-blue-500 flex items-center justify-center">
                        <i class="ph-duotone ph-user-plus text-xl"></i>
                    </div>
                    <h3 class="text-lg font-extrabold text-gray-800">Add Staff Member</h3>
                </div>
                <button id="CloseAddUserX"
                    class="text-gray-400 hover:text-gray-800 transition-colors cursor-pointer p-1">
                    <i class="ph ph-x text-xl"></i>
                </button>
            </div>

            <div class="p-6 overflow-y-auto custom-scrollbar">
                <form id="AddUserForm" class="space-y-4" enctype="multipart/form-data">

                    <div class="flex flex-col items-center mb-2">
                        <div id="addUserImageCircle"
                            class="w-20 h-20 rounded-full bg-gray-100 border border-gray-200 flex items-center justify-center overflow-hidden mb-2 relative group cursor-pointer">
                            <img id="addUserImagePreview" src="#" alt="Preview"
                                class="w-full h-full object-cover hidden">
                            <i id="addUserCameraIcon"
                                class="ph-duotone ph-camera text-2xl text-gray-400 group-hover:text-gray-600 transition-colors absolute"></i>
                        </div>
                        <label class="text-sm font-bold text-blue-600 cursor-pointer hover:underline">

                            <input type="file" id="addUserImage" name="image" accept="image/*" class="hidden">
                        </label>
                        <p id="errorAddUserImage" class="text-red-500 text-xs font-medium mt-1 hidden"></p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="addUserName" class="block text-sm font-bold text-gray-700 mb-1">Full Name <span
                                    class="text-red-500">*</span></label>
                            <input type="text" id="addUserName" name="name" placeholder="John Doe"
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-100 bg-gray-50/50 focus:bg-white transition-colors">
                            <p id="errorAddUserName" class="text-red-500 text-xs font-medium mt-1 hidden"></p>
                        </div>

                        <div>
                            <label for="addUserEmail" class="block text-sm font-bold text-gray-700 mb-1">Email <span
                                    class="text-red-500">*</span></label>
                            <input type="email" id="addUserEmail" name="email" placeholder="john@example.com"
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-100 bg-gray-50/50 focus:bg-white transition-colors">
                            <p id="errorAddUserEmail" class="text-red-500 text-xs font-medium mt-1 hidden"></p>
                        </div>
                    </div>

                    <div>
                        <label for="addUserPassword" class="block text-sm font-bold text-gray-700 mb-1">Password <span
                                class="text-red-500">*</span></label>
                        <div class="relative">
                            <input type="password" id="addUserPassword" name="password" placeholder="••••••••"
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 pr-10 text-sm focus:outline-none focus:ring-2 focus:ring-blue-100 bg-gray-50/50 focus:bg-white transition-colors">
                            <button type="button" id="addUserPasswordToggle"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 cursor-pointer">
                                <i id="addUserEyeIcon" class="ph ph-eye text-lg"></i>
                            </button>
                        </div>
                        <p id="errorAddUserPassword" class="text-red-500 text-xs font-medium mt-1 hidden"></p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="addUserRole" class="block text-sm font-bold text-gray-700 mb-1">Role <span
                                    class="text-red-500">*</span></label>
                            <select id="addUserRole" name="role"
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-100 bg-gray-50/50 focus:bg-white transition-colors appearance-none cursor-pointer">
                                <option value="" disabled selected>Select Role</option>
                                <option value="Receptionist">Receptionist</option>
                                <option value="SampleCollector">Sample Collector</option>
                                <option value="Pathologist">Pathologist</option>
                                <option value="Technician">Technician</option>
                                <option value="SpecialistDoctor">Specialist Doctor</option>
                            </select>
                            <p id="errorAddUserRole" class="text-red-500 text-xs font-medium mt-1 hidden"></p>
                        </div>

                        <div>
                            <label for="addUserDepartment" class="block text-sm font-bold text-gray-700 mb-1">Department
                                <span class="text-gray-400 font-normal">(Optional)</span></label>
                            <select id="addUserDepartment" name="department_id"
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-100 bg-gray-50/50 focus:bg-white transition-colors appearance-none cursor-pointer">
                            </select>
                            <p id="errorAddUserDepartment" class="text-red-500 text-xs font-medium mt-1 hidden"></p>
                        </div>
                    </div>
                </form>
            </div>

            <div
                class="px-6 py-4 border-t border-gray-100 bg-gray-50/50 rounded-b-[1.25rem] flex items-center justify-end gap-3">
                <button id="CloseAddUserBtn" type="button"
                    class="px-5 py-2.5 rounded-xl text-sm font-bold text-gray-600 hover:bg-gray-200 transition-colors cursor-pointer">
                    Cancel
                </button>
                <button id="SaveUserBtn" type="button"
                    class="bg-sidebarBg hover:bg-gray-800 text-white px-6 py-2.5 rounded-xl text-sm font-bold transition-colors shadow-sm cursor-pointer">
                    Save Staff
                </button>
            </div>
        </div>
    </div>
    <div id="UpdateUserModalBackdrop"
        class="fixed inset-0 bg-black/50 z-60 hidden items-center justify-center p-4 opacity-0 transition-opacity duration-300">
        <div id="UpdateUserModal"
            class="bg-white w-full max-w-lg rounded-[1.25rem] shadow-[0_10px_40px_rgba(0,0,0,0.1)] transform scale-95 transition-all duration-300 flex flex-col max-h-[90vh]">

            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-teal-50 text-teal-600 flex items-center justify-center">
                        <i class="ph-duotone ph-pencil-line text-xl"></i>
                    </div>
                    <h3 class="text-lg font-extrabold text-gray-800">Update Staff Member</h3>
                </div>
                <button id="CloseUpdateUserX"
                    class="text-gray-400 hover:text-gray-800 transition-colors cursor-pointer p-1">
                    <i class="ph ph-x text-xl"></i>
                </button>
            </div>

            <div class="p-6 overflow-y-auto custom-scrollbar">
                <form id="UpdateUserForm" class="space-y-4" enctype="multipart/form-data">
                    <input type="hidden" id="updateUserId" name="id">

                    <div class="flex flex-col items-center mb-2">
                        <div id="updateUserImageCircle"
                            class="w-20 h-20 rounded-full bg-gray-100 border border-gray-200 flex items-center justify-center overflow-hidden mb-2 relative group cursor-pointer">
                            <img id="updateUserImagePreview" src="#" alt="Preview"
                                class="w-full h-full object-cover hidden">
                            <i id="updateUserCameraIcon"
                                class="ph-duotone ph-camera text-2xl text-gray-400 group-hover:text-gray-600 transition-colors absolute"></i>
                        </div>
                        <label class="text-sm font-bold text-teal-600 cursor-pointer hover:underline">

                            <input type="file" id="updateUserImage" name="image" accept="image/*" class="hidden">
                        </label>
                        <p id="errorUpdateUserImage" class="text-red-500 text-xs font-medium mt-1 hidden"></p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="updateUserName" class="block text-sm font-bold text-gray-700 mb-1">Full Name
                                <span class="text-red-500">*</span></label>
                            <input type="text" id="updateUserName" name="name"
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-teal-100 bg-gray-50/50 focus:bg-white transition-colors">
                            <p id="errorUpdateUserName" class="text-red-500 text-xs font-medium mt-1 hidden"></p>
                        </div>

                        <div>
                            <label for="updateUserEmail" class="block text-sm font-bold text-gray-700 mb-1">Email <span
                                    class="text-red-500">*</span></label>
                            <input type="email" id="updateUserEmail" name="email"
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-teal-100 bg-gray-50/50 focus:bg-white transition-colors">
                            <p id="errorUpdateUserEmail" class="text-red-500 text-xs font-medium mt-1 hidden"></p>
                        </div>
                    </div>

                    <div>
                        <label for="updateUserPassword" class="block text-sm font-bold text-gray-700 mb-1">Password
                            <span class="text-gray-400 font-normal">(Leave blank to keep)</span></label>
                        <div class="relative">
                            <input type="password" id="updateUserPassword" name="password" placeholder="••••••••"
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 pr-10 text-sm focus:outline-none focus:ring-2 focus:ring-teal-100 bg-gray-50/50 focus:bg-white transition-colors">
                            <button type="button" id="updateUserPasswordToggle"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 cursor-pointer">
                                <i id="updateUserEyeIcon" class="ph ph-eye text-lg"></i>
                            </button>
                        </div>
                        <p id="errorUpdateUserPassword" class="text-red-500 text-xs font-medium mt-1 hidden"></p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="updateUserRole" class="block text-sm font-bold text-gray-700 mb-1">Role <span
                                    class="text-red-500">*</span></label>
                            <select id="updateUserRole" name="role"
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-teal-100 bg-gray-50/50 focus:bg-white transition-colors appearance-none cursor-pointer">
                                <option value="" disabled>Select Role</option>
                                <option value="Receptionist">Receptionist</option>
                                <option value="SampleCollector">Sample Collector</option>
                                <option value="Pathologist">Pathologist</option>
                                <option value="Technician">Technician</option>
                                <option value="SpecialistDoctor">Specialist Doctor</option>
                            </select>
                            <p id="errorUpdateUserRole" class="text-red-500 text-xs font-medium mt-1 hidden"></p>
                        </div>

                        <div>
                            <label for="updateUserDepartment"
                                class="block text-sm font-bold text-gray-700 mb-1">Department <span
                                    class="text-gray-400 font-normal">(Optional)</span></label>
                            <select id="updateUserDepartment" name="department_id"
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-teal-100 bg-gray-50/50 focus:bg-white transition-colors appearance-none cursor-pointer">
                            </select>
                            <p id="errorUpdateUserDepartment" class="text-red-500 text-xs font-medium mt-1 hidden"></p>
                        </div>
                    </div>
                </form>
            </div>

            <div
                class="px-6 py-4 border-t border-gray-100 bg-gray-50/50 rounded-b-[1.25rem] flex items-center justify-end gap-3">
                <button id="CloseUpdateUserBtn" type="button"
                    class="px-5 py-2.5 rounded-xl text-sm font-bold text-gray-600 hover:bg-gray-200 transition-colors cursor-pointer">
                    Cancel
                </button>
                <button id="UpdateUserBtn" type="button"
                    class="bg-sidebarBg hover:bg-gray-800 text-white px-6 py-2.5 rounded-xl text-sm font-bold transition-colors shadow-sm cursor-pointer">
                    Update Staff
                </button>
            </div>
        </div>
    </div>
    <div id="AddDepartmentModalBackdrop"
        class="fixed inset-0 bg-black/50 z-60 hidden items-center justify-center p-4 opacity-0 transition-opacity duration-300">
        <div id="AddDepartmentModal"
            class="bg-white w-full max-w-lg rounded-[1.25rem] shadow-[0_10px_40px_rgba(0,0,0,0.1)] transform scale-95 transition-all duration-300 flex flex-col max-h-[90vh]">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-blue-50 text-blue-500 flex items-center justify-center">
                        <i class="ph-duotone ph-buildings text-xl"></i>
                    </div>
                    <h3 class="text-lg font-extrabold text-gray-800">Add Department</h3>
                </div>
                <button id="CloseAddDepartmentX"
                    class="text-gray-400 hover:text-gray-800 transition-colors cursor-pointer p-1">
                    <i class="ph ph-x text-xl"></i>
                </button>
            </div>
            <div class="p-6 overflow-y-auto custom-scrollbar">
                <form id="AddDepartmentForm" class="space-y-4">
                    <div>
                        <label for="addDepartmentName" class="block text-sm font-bold text-gray-700 mb-1">Department
                            Name <span class="text-red-500">*</span></label>
                        <input type="text" id="addDepartmentName" name="name"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-100 bg-gray-50/50 focus:bg-white transition-colors">
                        <p id="errorAddDepartmentName" class="text-red-500 text-xs font-medium mt-1 hidden"></p>
                    </div>
                    <div>
                        <label for="addDepartmentType" class="block text-sm font-bold text-gray-700 mb-1">Type <span
                                class="text-red-500">*</span></label>
                        <select id="addDepartmentType" name="type"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-100 bg-gray-50/50 focus:bg-white transition-colors appearance-none cursor-pointer">
                            <option value="" disabled selected>Select Type</option>
                            <option value="sample_based">Sample Based</option>
                            <option value="human_based">Human Based</option>
                        </select>
                        <p id="errorAddDepartmentType" class="text-red-500 text-xs font-medium mt-1 hidden"></p>
                    </div>
                    <div class="pt-2">
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" id="addDepartmentIsActive" name="is_active" class="peer sr-only"
                                checked>
                            <div
                                class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-blue-600 relative after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white transition-colors">
                            </div>
                            <span class="text-sm font-bold text-gray-700">Department is Active</span>
                        </label>
                    </div>
                </form>
            </div>
            <div
                class="px-6 py-4 border-t border-gray-100 bg-gray-50/50 rounded-b-[1.25rem] flex items-center justify-end gap-3">
                <button id="CloseAddDepartmentBtn" type="button"
                    class="px-5 py-2.5 rounded-xl text-sm font-bold text-gray-600 hover:bg-gray-200 transition-colors cursor-pointer">Cancel</button>
                <button id="SaveDepartmentBtn" type="button"
                    class="bg-sidebarBg hover:bg-gray-800 text-white px-6 py-2.5 rounded-xl text-sm font-bold transition-colors shadow-sm cursor-pointer">Save
                    Department</button>
            </div>
        </div>
    </div>
    <div id="UpdateDepartmentModalBackdrop"
        class="fixed inset-0 bg-black/50 z-60 hidden items-center justify-center p-4 opacity-0 transition-opacity duration-300">
        <div id="UpdateDepartmentModal"
            class="bg-white w-full max-w-lg rounded-[1.25rem] shadow-[0_10px_40px_rgba(0,0,0,0.1)] transform scale-95 transition-all duration-300 flex flex-col max-h-[90vh]">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-teal-50 text-teal-600 flex items-center justify-center">
                        <i class="ph-duotone ph-pencil-line text-xl"></i>
                    </div>
                    <h3 class="text-lg font-extrabold text-gray-800">Update Department</h3>
                </div>
                <button id="CloseUpdateDepartmentX"
                    class="text-gray-400 hover:text-gray-800 transition-colors cursor-pointer p-1">
                    <i class="ph ph-x text-xl"></i>
                </button>
            </div>
            <div class="p-6 overflow-y-auto custom-scrollbar">
                <form id="UpdateDepartmentForm" class="space-y-4">
                    <input type="hidden" id="updateDepartmentId" name="id">
                    <div>
                        <label for="updateDepartmentName" class="block text-sm font-bold text-gray-700 mb-1">Department
                            Name <span class="text-red-500">*</span></label>
                        <input type="text" id="updateDepartmentName" name="name"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-teal-100 bg-gray-50/50 focus:bg-white transition-colors">
                        <p id="errorUpdateDepartmentName" class="text-red-500 text-xs font-medium mt-1 hidden"></p>
                    </div>
                    <div>
                        <label for="updateDepartmentType" class="block text-sm font-bold text-gray-700 mb-1">Type <span
                                class="text-red-500">*</span></label>
                        <select id="updateDepartmentType" name="type"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-teal-100 bg-gray-50/50 focus:bg-white transition-colors appearance-none cursor-pointer">
                            <option value="" disabled selected>Select Type</option>
                            <option value="sample_based">Sample Based</option>
                            <option value="human_based">Human Based</option>
                        </select>
                        <p id="errorUpdateDepartmentType" class="text-red-500 text-xs font-medium mt-1 hidden"></p>
                    </div>
                    <div class="pt-2">
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" id="updateDepartmentIsActive" name="is_active" class="peer sr-only">
                            <div
                                class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-sidebarBg relative after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white transition-colors">
                            </div>
                            <span class="text-sm font-bold text-gray-700">Department is Active</span>
                        </label>
                    </div>
                </form>
            </div>
            <div
                class="px-6 py-4 border-t border-gray-100 bg-gray-50/50 rounded-b-[1.25rem] flex items-center justify-end gap-3">
                <button id="CloseUpdateDepartmentBtn" type="button"
                    class="px-5 py-2.5 rounded-xl text-sm font-bold text-gray-600 hover:bg-gray-200 transition-colors cursor-pointer">Cancel</button>
                <button id="UpdateDepartmentBtn" type="button"
                    class="bg-sidebarBg hover:bg-gray-800 text-white px-6 py-2.5 rounded-xl text-sm font-bold transition-colors shadow-sm cursor-pointer">Update
                    Department</button>
            </div>
        </div>
    </div>
    <div id="AddInventoryModalBackdrop"
        class="fixed inset-0 bg-gray-900/40 backdrop-blur-sm z-50 hidden items-center justify-center p-4 transition-opacity duration-300 opacity-0">
        <div id="AddInventoryModal"
            class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden transform scale-95 transition-transform duration-300">
            <div class="p-5 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                <h3 class="font-bold text-gray-800 flex items-center gap-2">Register New Item</h3>
                <button id="CloseAddInventoryX"
                    class="text-gray-400 hover:text-gray-700 transition-colors cursor-pointer"><i
                        class="ph-bold ph-x text-lg"></i></button>
            </div>
            <form id="AddInventoryForm" class="p-5 space-y-4">
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Item Name</label>
                    <input type="text" id="addInvName"
                        class="w-full border border-gray-200 rounded-lg p-2 text-sm focus:ring-2 focus:ring-orange-100 outline-none">
                    <p id="errorAddInvName" class="text-red-500 text-xs mt-1 hidden"></p>
                </div>
                <div class="flex gap-4">
                    <div class="flex-1">
                        <label class="block text-xs font-bold text-gray-700 mb-1">Unit (e.g., pcs, kg, ml)</label>
                        <input type="text" id="addInvUnit"
                            class="w-full border border-gray-200 rounded-lg p-2 text-sm focus:ring-2 focus:ring-orange-100 outline-none">
                        <p id="errorAddInvUnit" class="text-red-500 text-xs mt-1 hidden"></p>
                    </div>
                    <div class="flex-1">
                        <label class="block text-xs font-bold text-gray-700 mb-1">Initial Stock</label>
                        <input type="number" id="addInvStock"
                            class="w-full border border-gray-200 rounded-lg p-2 text-sm focus:ring-2 focus:ring-orange-100 outline-none"
                            min="0">
                        <p id="errorAddInvStock" class="text-red-500 text-xs mt-1 hidden"></p>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Low Stock Alert Limit</label>
                    <input type="number" id="addInvAlert"
                        class="w-full border border-gray-200 rounded-lg p-2 text-sm focus:ring-2 focus:ring-orange-100 outline-none"
                        min="0">
                    <p id="errorAddInvAlert" class="text-red-500 text-xs mt-1 hidden"></p>
                </div>
                <div class="flex justify-end gap-2 pt-4 border-t border-gray-100">
                    <button type="button" id="CloseAddInventoryBtn"
                        class="px-4 py-2 text-sm font-bold text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors cursor-pointer">Cancel</button>
                    <button type="button" id="SaveInventoryBtn"
                        class="px-4 py-2 text-sm font-bold text-white bg-gray-800 hover:bg-gray-900 rounded-lg transition-colors cursor-pointer">Save
                        Item</button>
                </div>
            </form>
        </div>
    </div>

    <div id="EditInventoryModalBackdrop"
        class="fixed inset-0 bg-gray-900/40 backdrop-blur-sm z-50 hidden items-center justify-center p-4 transition-opacity duration-300 opacity-0">
        <div id="EditInventoryModal"
            class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden transform scale-95 transition-transform duration-300">
            <div class="p-5 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                <h3 class="font-bold text-gray-800 flex items-center gap-2">Edit Item</h3>
                <button id="CloseEditInventoryX"
                    class="text-gray-400 hover:text-gray-700 transition-colors cursor-pointer"><i
                        class="ph-bold ph-x text-lg"></i></button>
            </div>
            <form id="EditInventoryForm" class="p-5 space-y-4">
                <input type="hidden" id="editInvId">
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Item Name</label>
                    <input type="text" id="editInvName"
                        class="w-full border border-gray-200 rounded-lg p-2 text-sm focus:ring-2 focus:ring-teal-100 outline-none">
                    <p id="errorEditInvName" class="text-red-500 text-xs mt-1 hidden"></p>
                </div>
                <div class="flex gap-4">
                    <div class="flex-1">
                        <label class="block text-xs font-bold text-gray-700 mb-1">Unit</label>
                        <input type="text" id="editInvUnit"
                            class="w-full border border-gray-200 rounded-lg p-2 text-sm focus:ring-2 focus:ring-teal-100 outline-none">
                        <p id="errorEditInvUnit" class="text-red-500 text-xs mt-1 hidden"></p>
                    </div>
                    <div class="flex-1">
                        <label class="block text-xs font-bold text-gray-700 mb-1">Current Stock</label>
                        <input type="number" id="editInvStock"
                            class="w-full border border-gray-200 rounded-lg p-2 text-sm focus:ring-2 focus:ring-teal-100 outline-none"
                            readonly>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Alert Limit</label>
                    <input type="number" id="editInvAlert"
                        class="w-full border border-gray-200 rounded-lg p-2 text-sm focus:ring-2 focus:ring-teal-100 outline-none">
                    <p id="errorEditInvAlert" class="text-red-500 text-xs mt-1 hidden"></p>
                </div>
                <div class="flex justify-end gap-2 pt-4 border-t border-gray-100">
                    <button type="button" id="CloseEditInventoryBtn"
                        class="px-4 py-2 text-sm font-bold text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors cursor-pointer">Cancel</button>
                    <button type="button" id="UpdateInventoryBtn"
                        class="px-4 py-2 text-sm font-bold text-white bg-teal-600 hover:bg-teal-700 rounded-lg transition-colors cursor-pointer">Update
                        Item</button>
                </div>
            </form>
        </div>
    </div>

    <div id="ModifyStockModalBackdrop"
        class="fixed inset-0 bg-gray-900/40 backdrop-blur-sm z-50 hidden items-center justify-center p-4 transition-opacity duration-300 opacity-0">
        <div id="ModifyStockModal"
            class="bg-white rounded-2xl shadow-xl w-full max-w-sm overflow-hidden transform scale-95 transition-transform duration-300">
            <div class="p-5 border-b border-gray-100 flex justify-between items-center">
                <h3 id="ModifyStockTitle" class="font-bold text-gray-800">Modify Stock</h3>
                <button id="CloseModifyStockX"
                    class="text-gray-400 hover:text-gray-700 transition-colors cursor-pointer"><i
                        class="ph-bold ph-x text-lg"></i></button>
            </div>
            <form id="ModifyStockForm" class="p-5 space-y-4">
                <input type="hidden" id="modifyStockId">
                <input type="hidden" id="modifyStockType">
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Quantity</label>
                    <input type="number" id="modifyStockQty"
                        class="w-full border border-gray-200 rounded-lg p-2 text-sm focus:ring-2 outline-none" min="1">
                    <p id="errorModifyStockQty" class="text-red-500 text-xs mt-1 hidden"></p>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Reason / Action</label>
                    <input type="text" id="modifyStockReason"
                        class="w-full border border-gray-200 rounded-lg p-2 text-sm focus:ring-2 outline-none">
                    <p id="errorModifyStockReason" class="text-red-500 text-xs mt-1 hidden"></p>
                </div>
                <div class="flex justify-end gap-2 pt-4 border-t border-gray-100">
                    <button type="button" id="CloseModifyStockBtn"
                        class="px-4 py-2 text-sm font-bold text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors cursor-pointer">Cancel</button>
                    <button type="button" id="SubmitModifyStockBtn"
                        class="px-4 py-2 text-sm font-bold text-white rounded-lg transition-colors cursor-pointer">Confirm</button>
                </div>
            </form>
        </div>
    </div>

    <div id="InventoryLogsModalBackdrop"
        class="fixed inset-0 bg-gray-900/40 backdrop-blur-sm z-50 hidden items-center justify-center p-4 transition-opacity duration-300 opacity-0">
        <div id="InventoryLogsModal"
            class="bg-white rounded-2xl shadow-xl w-full max-w-2xl overflow-hidden transform scale-95 transition-transform duration-300 flex flex-col max-h-[80vh]">
            <div class="p-5 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                <h3 id="LogsModalTitle" class="font-bold text-gray-800 flex items-center gap-2">History</h3>
                <button id="CloseLogsX" class="text-gray-400 hover:text-gray-700 transition-colors cursor-pointer"><i
                        class="ph-bold ph-x text-lg"></i></button>
            </div>
            <div class="overflow-y-auto p-0">
                <table class="w-full text-left text-sm whitespace-nowrap">
                    <thead
                        class="text-xs text-gray-500 uppercase font-bold bg-white sticky top-0 border-b border-gray-100 shadow-sm">
                        <tr>
                            <th class="px-6 py-3">Type</th>
                            <th class="px-6 py-3">Qty</th>
                            <th class="px-6 py-3">Action</th>
                            <th class="px-6 py-3">Date</th>
                        </tr>
                    </thead>
                    <tbody id="logs-table-body"></tbody>
                </table>
            </div>
        </div>
    </div>



</body>

</html>