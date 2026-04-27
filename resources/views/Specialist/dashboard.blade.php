<x-header />

<body class="font-sans antialiased bg-mainBg text-gray-800 flex h-screen overflow-hidden">

    <div id="sidebar-backdrop"
        class="fixed inset-0 bg-black/50 z-40 hidden transition-opacity md:hidden cursor-pointer"></div>

    <aside id="sidebar"
        class="bg-sidebarBg text-white w-64 shrink-0 transition-all duration-300 flex flex-col fixed inset-y-0 left-0 z-50 md:relative transform -translate-x-full md:translate-x-0">
        <div class="h-20 flex items-center justify-between px-6 pt-2">
            <span id="brand-text"
                class="text-white text-xl font-bold whitespace-nowrap tracking-wide">Specialist Doctor</span>
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
                data-target="section-pending-tests" data-title="Pending Tests">
                <i
                    class="ph-duotone ph-flask text-2xl w-7 text-center text-gray-400 group-hover:text-white transition-colors nav-icon"></i>
                <span class="ml-3 nav-text whitespace-nowrap">Pending Tests</span>
            </a>

            <a href="#"
                class="nav-link flex items-center px-6 py-3 text-gray-300 hover:bg-white/10 hover:text-white transition-colors group cursor-pointer"
                data-target="section-completed-reports" data-title="Completed Reports">
                <i
                    class="ph-duotone ph-check-circle text-2xl w-7 text-center text-gray-400 group-hover:text-white transition-colors nav-icon"></i>
                <span class="ml-3 nav-text whitespace-nowrap">Completed Reports</span>
            </a>

            <a href="#"
                class="nav-link flex items-center px-6 py-3 text-gray-300 hover:bg-white/10 hover:text-white transition-colors group cursor-pointer"
                data-target="section-manage-tests" data-title="Manage Tests">
                <i
                    class="ph-duotone ph-microscope text-2xl w-7 text-center text-gray-400 group-hover:text-white transition-colors nav-icon"></i>
                <span class="ml-3 nav-text whitespace-nowrap">Manage Tests</span>
            </a>

            <a href="#"
                class="nav-link flex items-center px-6 py-3 text-gray-300 hover:bg-white/10 hover:text-white transition-colors group cursor-pointer"
                data-target="section-add-test" data-title="Add New Test">
                <i
                    class="ph-duotone ph-plus-circle text-2xl w-7 text-center text-gray-400 group-hover:text-white transition-colors nav-icon"></i>
                <span class="ml-3 nav-text whitespace-nowrap">Add Test</span>
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
                    <input type="text" placeholder="Search Patient/Test ID"
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
                            <p class="text-sm font-bold text-gray-900">Dr. Smith</p>
                            <p class="text-xs text-gray-500 font-medium mt-0.5">Head of Hematology</p>
                        </div>
                        <div class="py-2">
                            <a href="#"
                                class="px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-black transition-colors flex items-center gap-3 cursor-pointer">
                                Profile
                            </a>
                            <x-logout />
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-4 md:p-10 pt-2 relative">

            <div id="section-dashboard" class="content-section block animate-fade-in">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 w-full max-w-7xl mx-auto">
                    <div
                        class="bg-white rounded-[1.25rem] shadow-[0_4px_20px_rgba(0,0,0,0.03)] p-6 border border-gray-50">
                        <div
                            class="w-12 h-12 rounded-lg bg-orange-50 text-orange-500 flex items-center justify-center mb-4">
                            <i class="ph-duotone ph-hourglass text-2xl"></i>
                        </div>
                        <h3 id="pending-approvals-count" class="text-3xl font-extrabold text-black mb-1">0</h3>
                        <p class="text-gray-500 font-medium">Pending Approvals</p>
                    </div>

                    <div
                        class="bg-white rounded-[1.25rem] shadow-[0_4px_20px_rgba(0,0,0,0.03)] p-6 border border-gray-50">
                        <div
                            class="w-12 h-12 rounded-lg bg-green-50 text-green-500 flex items-center justify-center mb-4">
                            <i class="ph-duotone ph-check-circle text-2xl"></i>
                        </div>
                        <h3 id="completed-today-count" class="text-3xl font-extrabold text-black mb-1">0</h3>
                        <p class="text-gray-500 font-medium">Reports Completed (Today)</p>
                    </div>

                    <div
                        class="bg-white rounded-[1.25rem] shadow-[0_4px_20px_rgba(0,0,0,0.03)] p-6 border border-gray-50">
                        <div class="w-12 h-12 rounded-lg bg-red-50 text-red-500 flex items-center justify-center mb-4">
                            <i class="ph-duotone ph-warning-circle text-2xl"></i>
                        </div>
                        <h3 id="critical-results-count" class="text-3xl font-extrabold text-black mb-1">0</h3>
                        <p class="text-gray-500 font-medium">Critical/Abnormal Results</p>
                    </div>
                </div>
            </div>

            <div id="section-pending-tests" class="content-section hidden animate-fade-in w-full max-w-7xl mx-auto">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-orange-50 text-orange-500 flex items-center justify-center">
                            <i class="ph-duotone ph-flask text-2xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-extrabold text-gray-800">Pending Tests</h2>
                            <p class="text-sm text-gray-500 font-medium">Review, edit, and verify results entered by
                                technicians</p>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white rounded-[1.25rem] shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-50 overflow-hidden w-full">
                    <div class="p-4 border-b border-gray-100 flex flex-col sm:flex-row justify-between gap-4">
                        <div class="relative w-full sm:w-96">
                            <i
                                class="ph ph-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-lg"></i>
                            <input type="text" placeholder="Search by Patient ID or Test Name..."
                                class="w-full pl-11 pr-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-100 bg-gray-50/50 focus:bg-white transition-colors text-sm font-medium">
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead class="text-xs text-gray-700 font-bold bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th scope="col" class="px-6 py-4">Test ID</th>
                                    <th scope="col" class="px-6 py-4">Patient Name</th>
                                    <th scope="col" class="px-6 py-4">Test Name</th>
                                    <th scope="col" class="px-6 py-4">Sample Type</th>
                                    <th scope="col" class="px-6 py-4 text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody id="pending-results-table">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div id="section-completed-reports" class="content-section hidden animate-fade-in w-full max-w-7xl mx-auto">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-green-50 text-green-600 flex items-center justify-center">
                            <i class="ph-duotone ph-check-circle text-2xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-extrabold text-gray-800">Completed Reports</h2>
                            <p class="text-sm text-gray-500 font-medium">View and print approved test results</p>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white rounded-[1.25rem] shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-50 overflow-hidden w-full">
                    <div class="p-4 border-b border-gray-100 flex flex-col sm:flex-row items-center gap-4">
                        <div class="flex items-center gap-2">
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">From</label>
                            <input type="date" id="reportStartDate"
                                class="border border-gray-200 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-100 bg-white transition-colors font-medium text-gray-700">
                        </div>
                        <div class="flex items-center gap-2">
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">To</label>
                            <input type="date" id="reportEndDate"
                                class="border border-gray-200 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-100 bg-white transition-colors font-medium text-gray-700">
                        </div>
                        <button id="btnFilterReports" class="ml-auto bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-xl text-sm font-bold transition-colors cursor-pointer">
                            Filter Reports
                        </button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead class="text-xs text-gray-700 font-bold bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th scope="col" class="px-6 py-4">Report ID</th>
                                    <th scope="col" class="px-6 py-4">Patient Name</th>
                                    <th scope="col" class="px-6 py-4">Test Name</th>
                                    <th scope="col" class="px-6 py-4">Completion Date</th>
                                    <th scope="col" class="px-6 py-4 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="completed-reports-table">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div id="section-manage-tests" class="content-section hidden animate-fade-in w-full max-w-7xl mx-auto">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-500 flex items-center justify-center">
                            <i class="ph-duotone ph-microscope text-2xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-extrabold text-gray-800">Manage Department Tests</h2>
                            <p class="text-sm text-gray-500 font-medium">Add, update, or configure tests for your
                                department</p>
                        </div>
                    </div>
                    <button id="btn-go-to-add-test"
                        class="bg-sidebarBg hover:bg-gray-800 text-white px-5 py-2.5 rounded-xl text-sm font-bold transition-colors flex items-center gap-2 cursor-pointer shadow-sm">
                        <i class="ph ph-plus font-bold text-lg"></i> Add New Test
                    </button>
                </div>

                <div
                    class="bg-white rounded-[1.25rem] shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-50 overflow-hidden w-full">
                    <div class="p-4 border-b border-gray-100 flex flex-col sm:flex-row justify-between gap-4">
                        <div class="relative w-full sm:w-96">
                            <i
                                class="ph ph-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-lg"></i>
                            <input type="text" placeholder="Search test name or code..."
                                class="w-full pl-11 pr-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-purple-100 bg-gray-50/50 focus:bg-white transition-colors text-sm font-medium">
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead class="text-xs text-gray-700 font-bold bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th scope="col" class="px-6 py-4">Test Name</th>
                                    <th scope="col" class="px-6 py-4">Code</th>
                                    <th scope="col" class="px-6 py-4">Price</th>
                                    <th scope="col" class="px-6 py-4">Sample Type</th>
                                    <th scope="col" class="px-6 py-4">Status</th>
                                    <th scope="col" class="px-6 py-4 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="department-tests-table">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div id="section-add-test" class="content-section hidden animate-fade-in w-full max-w-5xl mx-auto">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-500 flex items-center justify-center">
                            <i class="ph-duotone ph-plus-circle text-2xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-extrabold text-gray-800">Add New Test</h2>
                            <p class="text-sm text-gray-500 font-medium">Create a new laboratory test configuration</p>
                        </div>
                    </div>
                    <button id="btn-back-to-tests-from-add"
                        class="bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 px-5 py-2.5 rounded-xl text-sm font-bold transition-colors flex items-center gap-2 cursor-pointer shadow-sm">
                        <i class="ph ph-arrow-left font-bold text-lg"></i> Back to List
                    </button>
                </div>

                <div
                    class="bg-white rounded-[1.25rem] shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-50 overflow-hidden w-full p-6 md:p-8 mb-8">
                    <form id="AddTestFormSection" class="space-y-6">

                        <div class="border-b border-gray-100 pb-4 mb-4">
                            <h3 class="text-lg font-bold text-gray-800"><i
                                    class="ph-duotone ph-info text-purple-500 mr-2"></i>1. Basic Information</h3>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Test Name <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="name" placeholder="e.g. Complete Blood Count"
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-purple-100 outline-none bg-gray-50/50 transition-colors">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Test Code <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="code" placeholder="CBC-01"
                                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-purple-100 outline-none bg-gray-50/50 transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Price (Rs.) <span
                                        class="text-red-500">*</span></label>
                                <input type="number" step="0.01" name="price" placeholder="800"
                                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-purple-100 outline-none bg-gray-50/50 transition-colors">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Sample Type</label>
                                <input type="text" name="type" placeholder="e.g. Blood, Urine"
                                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-purple-100 outline-none bg-gray-50/50 transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Result Hours <span
                                        class="text-red-500">*</span></label>
                                <input type="number" name="time" value="24"
                                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-purple-100 outline-none bg-gray-50/50 transition-colors">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Instructions for User</label>
                            <textarea name="instructions" rows="3"
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-purple-100 outline-none bg-gray-50/50 resize-none transition-colors"
                                placeholder="e.g. Fasting required for 12 hours"></textarea>
                        </div>

                        <div class="pt-2">
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="checkbox" name="is_active" class="peer sr-only" checked>
                                <div
                                    class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-purple-500 relative after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white transition-colors">
                                </div>
                                <span class="text-sm font-bold text-gray-700">Test is Active (Visible to
                                    Reception)</span>
                            </label>
                        </div>

                        <div class="border-b border-gray-100 pb-4 mb-4 mt-8 pt-4">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-bold text-gray-800"><i
                                        class="ph-duotone ph-list-numbers text-purple-500 mr-2"></i>2. Medical
                                    Parameters</h3>
                                <button type="button" id="btn-add-parameter"
                                    class="text-sm font-bold text-purple-600 hover:text-purple-800 transition-colors flex items-center gap-1 cursor-pointer">
                                    <i class="ph-bold ph-plus"></i> Add Parameter
                                </button>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Define the values to be checked within this test.</p>
                        </div>

                        <div id="add-parameters-container" class="space-y-4">
                            <div
                                class="flex gap-4 items-end bg-gray-50 p-4 rounded-xl border border-gray-100 parameter-row">
                                <div class="flex-1">
                                    <label class="block text-xs font-bold text-gray-600 mb-1">Parameter Name *</label>
                                    <input type="text" placeholder="e.g. Hemoglobin" name="parameter_name[]"
                                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-purple-100 outline-none bg-white">
                                </div>
                                <div class="w-24">
                                    <label class="block text-xs font-bold text-gray-600 mb-1">Unit</label>
                                    <input type="text" placeholder="g/dL" name="parameter_unit[]"
                                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-purple-100 outline-none bg-white">
                                </div>
                                <div class="flex-1">
                                    <label class="block text-xs font-bold text-gray-600 mb-1">Normal Range</label>
                                    <input type="text" placeholder="13.8 - 17.2" name="parameter_range[]"
                                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-purple-100 outline-none bg-white">
                                </div>
                                <div>
                                    <button type="button" class="text-red-400 hover:text-red-600 p-2 btn-remove-row"
                                        title="Remove Parameter"><i class="ph-bold ph-trash"></i></button>
                                </div>
                            </div>
                        </div>

                        <div class="border-b border-gray-100 pb-4 mb-4 mt-8 pt-4">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-bold text-gray-800"><i
                                        class="ph-duotone ph-package text-purple-500 mr-2"></i>3. Inventory Requirements
                                </h3>
                                <button type="button" id="btn-add-item"
                                    class="text-sm font-bold text-purple-600 hover:text-purple-800 transition-colors flex items-center gap-1 cursor-pointer">
                                    <i class="ph-bold ph-plus"></i> Add Item
                                </button>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Select items to be deducted from stock when this test
                                is performed.</p>
                        </div>

                        <div id="add-requirements-container" class="space-y-4">
                            <div
                                class="flex gap-4 items-end bg-gray-50 p-4 rounded-xl border border-gray-100 requirement-row">
                                <div class="flex-1">
                                    <label class="block text-xs font-bold text-gray-600 mb-1">Inventory Item *</label>
                                    <select name="inventory_item[]"
                                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-purple-100 outline-none bg-white cursor-pointer">
                                        <option disabled selected>Select an item</option>
                                        <option>5cc Syringe</option>
                                        <option>EDTA Tube</option>
                                        <option>CBC Reagent (ml)</option>
                                    </select>
                                </div>
                                <div class="w-32">
                                    <label class="block text-xs font-bold text-gray-600 mb-1">Qty Used *</label>
                                    <input type="number" value="1" name='inventory_quantity[]'
                                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-purple-100 outline-none bg-white">
                                </div>
                                <div>
                                    <button type="button" class="text-red-400 hover:text-red-600 p-2 btn-remove-row"
                                        title="Remove Item"><i class="ph-bold ph-trash"></i></button>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end gap-3 pt-6 mt-6 border-t border-gray-100">
                            <button id="btn-cancel-add-test-bottom" type="button"
                                class="px-6 py-3 rounded-xl text-sm font-bold text-gray-600 hover:bg-gray-100 transition-colors cursor-pointer">Cancel</button>
                            <button type="button"
                                class="bg-sidebarBg hover:bg-gray-800 text-white px-8 py-3 rounded-xl text-sm font-bold transition-colors shadow-sm cursor-pointer">Save
                                Complete Test</button>
                        </div>
                    </form>
                </div>
            </div>

            <div id="section-update-test" class="content-section hidden animate-fade-in w-full max-w-5xl mx-auto">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center">
                            <i class="ph-duotone ph-pencil-simple text-2xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-extrabold text-gray-800">Update Test</h2>
                            <p class="text-sm text-gray-500 font-medium">Modify existing test configuration</p>
                        </div>
                    </div>
                    <button id="btn-back-to-tests-from-update"
                        class="bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 px-5 py-2.5 rounded-xl text-sm font-bold transition-colors flex items-center gap-2 cursor-pointer shadow-sm">
                        <i class="ph ph-arrow-left font-bold text-lg"></i> Back to List
                    </button>
                </div>

                <div
                    class="bg-white rounded-[1.25rem] shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-50 overflow-hidden w-full p-6 md:p-8 mb-8">
                    <form id="UpdateTestFormSection" class="space-y-6">
                        <div class="border-b border-gray-100 pb-4 mb-4">
                            <h3 class="text-lg font-bold text-gray-800">
                                <i class="ph-duotone ph-info text-teal-600 mr-2"></i>1. Basic Information
                            </h3>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Test Name <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="name" value="Complete Blood Count (CBC)"
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-teal-100 outline-none bg-gray-50/50 transition-colors">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Test Code <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="code" value="HEM-001"
                                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-teal-100 outline-none bg-gray-50/50 transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Price (Rs.) <span
                                        class="text-red-500">*</span></label>
                                <input type="number" step="0.01" name="price" value="800"
                                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-teal-100 outline-none bg-gray-50/50 transition-colors">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Sample Type</label>
                                <input type="text" name="type" value="Blood (EDTA)"
                                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-teal-100 outline-none bg-gray-50/50 transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Result Hours <span
                                        class="text-red-500">*</span></label>
                                <input type="number" name="time" value="24"
                                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-teal-100 outline-none bg-gray-50/50 transition-colors">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Instructions for User</label>
                            <textarea name="instructions" rows="3"
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-teal-100 outline-none bg-gray-50/50 resize-none transition-colors"></textarea>
                        </div>

                        <div class="pt-2">
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="checkbox" name="is_active" class="peer sr-only" checked>
                                <div
                                    class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-teal-500 relative after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white transition-colors">
                                </div>
                                <span class="text-sm font-bold text-gray-700">Test is Active</span>
                            </label>
                        </div>

                        <!-- Parameters -->
                        <div class="border-b border-gray-100 pb-4 mb-4 mt-8 pt-4">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-bold text-gray-800">
                                    <i class="ph-duotone ph-list-numbers text-teal-600 mr-2"></i>2. Medical Parameters
                                </h3>
                                <button type="button" id="btn-update-add-parameter"
                                    class="text-sm font-bold text-teal-600 hover:text-teal-800 transition-colors flex items-center gap-1 cursor-pointer">
                                    <i class="ph-bold ph-plus"></i> Add Parameter
                                </button>
                            </div>
                        </div>

                        <div id="update-parameters-container" class="space-y-4">
                            <div
                                class="flex gap-4 items-end bg-gray-50 p-4 rounded-xl border border-gray-100 parameter-row">

                                <div class="flex-1">
                                    <label class="block text-xs font-bold text-gray-600 mb-1">Parameter Name *</label>
                                    <input type="text" name="parameter_name[]" value="Hemoglobin"
                                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-teal-100 outline-none bg-white">
                                </div>

                                <div class="w-24">
                                    <label class="block text-xs font-bold text-gray-600 mb-1">Unit</label>
                                    <input type="text" name="parameter_unit[]" value="g/dL"
                                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-teal-100 outline-none bg-white">
                                </div>

                                <div class="flex-1">
                                    <label class="block text-xs font-bold text-gray-600 mb-1">Normal Range</label>
                                    <input type="text" name="parameter_range[]" value="13.8 - 17.2"
                                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-teal-100 outline-none bg-white">
                                </div>

                                <div>
                                    <button type="button" class="text-red-400 hover:text-red-600 p-2 btn-remove-row">
                                        <i class="ph-bold ph-trash"></i>
                                    </button>
                                </div>

                            </div>
                        </div>

                        <!-- Inventory -->
                        <div class="border-b border-gray-100 pb-4 mb-4 mt-8 pt-4">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-bold text-gray-800">
                                    <i class="ph-duotone ph-package text-teal-600 mr-2"></i>3. Inventory Requirements
                                </h3>
                                <button type="button" id="btn-update-add-item"
                                    class="text-sm font-bold text-teal-600 hover:text-teal-800 transition-colors flex items-center gap-1 cursor-pointer">
                                    <i class="ph-bold ph-plus"></i> Add Item
                                </button>
                            </div>
                        </div>

                        <div id="update-requirements-container" class="space-y-4">
                            <div
                                class="flex gap-4 items-end bg-gray-50 p-4 rounded-xl border border-gray-100 requirement-row">

                                <div class="flex-1">
                                    <label class="block text-xs font-bold text-gray-600 mb-1">Inventory Item *</label>
                                    <select name="inventory_item[]"
                                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-teal-100 outline-none bg-white cursor-pointer">
                                        <option>5cc Syringe</option>
                                        <option selected>EDTA Tube</option>
                                    </select>
                                </div>

                                <div class="w-32">
                                    <label class="block text-xs font-bold text-gray-600 mb-1">Qty Used *</label>
                                    <input type="number" name="inventory_quantity[]" value="1"
                                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-teal-100 outline-none bg-white">
                                </div>

                                <div>
                                    <button type="button" class="text-red-400 hover:text-red-600 p-2 btn-remove-row">
                                        <i class="ph-bold ph-trash"></i>
                                    </button>
                                </div>

                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="flex justify-end gap-3 pt-6 mt-6 border-t border-gray-100">
                            <button id="btn-cancel-update-test-bottom" type="button"
                                class="px-6 py-3 rounded-xl text-sm font-bold text-gray-600 hover:bg-gray-100 transition-colors cursor-pointer">
                                Cancel
                            </button>

                            <button type="button"
                                class="bg-teal-600 hover:bg-teal-700 text-white px-8 py-3 rounded-xl text-sm font-bold transition-colors shadow-sm cursor-pointer">
                                Update Test
                            </button>
                        </div>

                    </form>
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
                        <p class="text-sm text-gray-500 font-medium">Manage signature, email, and password</p>
                    </div>
                </div>

                <div class="flex flex-col w-full gap-10">
                    <div class="flex flex-col gap-4 border-b border-gray-300 pb-10">
                        <div class="flex items-center gap-2">
                            <span
                                class="bg-gray-200 text-gray-700 w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold">1</span>
                            <h3 class="text-lg font-bold text-gray-800">Upload & Display Signature</h3>
                        </div>
                        <p class="text-xs sm:text-sm text-gray-500">This signature will be stamped on verified lab
                            reports.</p>

                        <div
                            class="relative border-2 border-dashed border-gray-300 rounded-xl p-6 flex flex-col items-center justify-center bg-gray-50 min-h-[200px] w-full">

                            <div id="sigUploadState" class="flex flex-col items-center justify-center">
                                <i class="ph-duotone ph-signature text-5xl text-gray-400 mb-3"></i>
                                <button type="button" id="btnUploadNewSig"
                                    class="bg-gray-900 hover:bg-black text-white px-6 py-2.5 rounded-lg text-sm font-bold transition-colors shadow-sm cursor-pointer">
                                    Upload Signature
                                </button>
                                <span class="text-xs text-gray-500 mt-3">PNG or JPG (Max 2MB)</span>
                            </div>

                            <div id="sigPreviewState" class="hidden w-full flex-col items-center justify-center">
                                <span class="text-xs text-gray-400 mb-3 font-bold uppercase tracking-wider">Current
                                    Signature</span>
                                <div
                                    class="bg-white border border-gray-200 shadow-sm p-4 rounded-lg flex flex-col items-center justify-end h-32 relative w-full max-w-[250px] mb-4">
                                    <img id="sigPreviewImage" class="max-h-16 object-contain z-10 mb-[-10px]"
                                        alt="Signature Preview" />
                                    <div class="w-4/5 border-b-2 border-gray-800 z-0"></div>
                                    <span
                                        class="text-xs text-gray-800 font-bold mt-2">{{ Auth::user()->name ?? 'Dr. Smith' }}</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <button type="button" id="btnChangeSig"
                                        class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg text-sm font-bold transition-colors cursor-pointer">
                                        Change
                                    </button>
                                    <button type="button" id="btnDeleteSig"
                                        class="bg-red-50 hover:bg-red-100 text-red-600 border border-red-200 px-4 py-2 rounded-lg text-sm font-bold transition-colors cursor-pointer">
                                        Delete
                                    </button>
                                </div>
                            </div>

                            <input type="file" class="hidden" id="signatureFileInput" name="signature"
                                accept="image/png, image/jpeg">
                        </div>
                    </div>

                    <div class="flex flex-col gap-4 border-b border-gray-300 pb-10">
                        <div class="flex items-center gap-2">
                            <span
                                class="bg-gray-200 text-gray-700 w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold">2</span>
                            <h3 class="text-lg font-bold text-gray-800">Update Email</h3>
                        </div>
                        <form id="UpdateEmailForm" class="flex flex-col gap-2">
                            <label class="text-sm font-bold text-gray-700">Email Address</label>
                            <input type="email" name="email" id="userEmailInput" value="{{ Auth::user()->email ?? '' }}"
                                placeholder="dr.smith@gmail.com"
                                class="w-full border border-gray-400 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-400 outline-none bg-transparent transition-colors placeholder:text-gray-400">
                            <button type="submit" id="btnSaveEmail"
                                class="self-start bg-sidebarBg hover:bg-gray-800 text-white px-6 py-2.5 rounded-xl text-sm font-bold transition-colors shadow-sm mt-2">
                                Save Email
                            </button>
                        </form>
                    </div>

                    <div class="flex flex-col gap-4 pb-10">
                        <div class="flex items-center gap-2">
                            <span
                                class="bg-gray-200 text-gray-700 w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold">3</span>
                            <h3 class="text-lg font-bold text-gray-800">Update Password</h3>
                        </div>
                        <form id="UpdatePasswordForm" class="flex flex-col gap-4">
                            <div class="flex flex-col gap-2">
                                <label class="text-sm font-bold text-gray-700">Current Password</label>
                                <div class="relative">
                                    <input type="password" name="password" placeholder="••••••••"
                                        class="w-full border border-gray-400 rounded-xl px-4 py-3 pr-10 text-sm focus:ring-2 focus:ring-blue-400 outline-none bg-transparent transition-colors">
                                    <i
                                        class="ph ph-eye absolute right-4 top-3.5 text-lg cursor-pointer text-gray-500 hover:text-gray-800 transition-colors toggle-password"></i>
                                </div>
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="text-sm font-bold text-gray-700">New Password</label>
                                <div class="relative">
                                    <input type="password" name="newPassword" placeholder="••••••••"
                                        class="w-full border border-gray-400 rounded-xl px-4 py-3 pr-10 text-sm focus:ring-2 focus:ring-blue-400 outline-none bg-transparent transition-colors">
                                    <i
                                        class="ph ph-eye absolute right-4 top-3.5 text-lg cursor-pointer text-gray-500 hover:text-gray-800 transition-colors toggle-password"></i>
                                </div>
                            </div>
                            <button type="submit" id="btnSavePassword"
                                class="self-start bg-sidebarBg hover:bg-gray-800 text-white px-6 py-2.5 rounded-xl text-sm font-bold transition-colors shadow-sm mt-2">
                                Update Password
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </main>
    </div>

    <div id="VerifyTestModalBackdrop"
        class="fixed inset-0 bg-black/50 z-60 hidden items-center justify-center p-4 opacity-0 transition-opacity duration-300">
        <div id="VerifyTestModal"
            class="bg-white w-full max-w-2xl rounded-[1.25rem] shadow-xl transform scale-95 transition-all duration-300 flex flex-col max-h-[90vh]">
            <div
                class="flex items-center justify-between px-6 py-4 border-b border-gray-100 bg-gray-50/50 rounded-t-[1.25rem]">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center">
                        <i class="ph-duotone ph-microscope text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-extrabold text-gray-800">Verify Test Results</h3>
                        <p class="text-xs text-gray-500 font-medium" id="verifyModalSubtitle">Patient: Ali Khan | Test: CBC</p>
                    </div>
                </div>
                <button id="CloseVerifyTestX"
                    class="text-gray-400 hover:text-gray-800 transition-colors cursor-pointer p-1"><i
                        class="ph ph-x text-xl"></i></button>
            </div>
            <div class="p-6 overflow-y-auto custom-scrollbar">
                <form id="VerifyTestForm" class="space-y-6">
                    <div class="border border-gray-200 rounded-xl overflow-hidden">
                        <table class="w-full text-sm text-left">
                            <thead class="bg-gray-50 border-b border-gray-200 text-xs text-gray-700 font-bold">
                                <tr>
                                    <th class="px-4 py-3">Parameter</th>
                                    <th class="px-4 py-3">Result Value</th>
                                    <th class="px-4 py-3">Unit</th>
                                    <th class="px-4 py-3">Normal Range</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100" id="verifyResultsTbody">
                            </tbody>
                        </table>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Clinical Remarks / Expert
                            Opinion</label>
                        <select id="clinicalRemarksTemplate"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-blue-100 outline-none bg-gray-50/50 mb-2 cursor-pointer text-gray-600">
                            <option disabled selected>Select a pre-defined template...</option>
                            <option>Patient has mild anemia, recommend iron supplements.</option>
                            <option>Results are within normal limits.</option>
                            <option>Critical values observed, immediate clinical correlation required.</option>
                        </select>
                        <textarea id="verifyRemarks" rows="3"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-100 outline-none bg-gray-50/50 transition-colors resize-none"
                            placeholder="Or enter custom diagnostic notes here..."></textarea>
                    </div>
                    <div class="flex items-center gap-3 bg-red-50 p-4 rounded-xl border border-red-100">
                        <input type="checkbox" id="criticalFlag"
                            class="w-5 h-5 text-red-600 rounded border-red-300 focus:ring-red-500 cursor-pointer">
                        <div>
                            <label for="criticalFlag" class="text-sm font-bold text-red-700 cursor-pointer">Flag as
                                Critical / Urgent</label>
                            <p class="text-xs text-red-500">Reception will be alerted to immediately contact the
                                patient/doctor.</p>
                        </div>
                    </div>
                </form>
            </div>
            <div
                class="px-6 py-4 border-t border-gray-100 bg-gray-50/50 rounded-b-[1.25rem] flex items-center justify-between">
                <button id="BtnRejectSample" type="button"
                    class="text-red-600 hover:bg-red-50 px-4 py-2 rounded-xl text-sm font-bold transition-colors flex items-center gap-2">
                    <i class="ph-bold ph-warning-circle"></i> Reject Sample
                </button>
                <div class="flex gap-3">
                    <button id="CloseVerifyTestBtn" type="button"
                        class="px-5 py-2.5 rounded-xl text-sm font-bold text-gray-600 hover:bg-gray-200 transition-colors">Cancel</button>
                    <button id="BtnVerifyAndSign" type="button"
                        class="bg-sidebarBg hover:bg-gray-800 text-white px-6 py-2.5 rounded-xl text-sm font-bold transition-colors shadow-sm flex items-center gap-2">
                        <i class="ph-bold ph-check-circle"></i> Verify & Sign
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="RejectSampleModalBackdrop"
        class="fixed inset-0 bg-black/50 z-70 hidden items-center justify-center p-4 opacity-0 transition-opacity duration-300">
        <div id="RejectSampleModal"
            class="bg-white w-full max-w-md rounded-[1.25rem] shadow-xl transform scale-95 transition-all duration-300 flex flex-col">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-red-50 text-red-600 flex items-center justify-center">
                        <i class="ph-duotone ph-warning-circle text-xl"></i>
                    </div>
                    <h3 class="text-lg font-extrabold text-gray-800">Reject Sample</h3>
                </div>
                <button id="CloseRejectSampleX" class="text-gray-400 hover:text-gray-800 transition-colors p-1"><i
                        class="ph ph-x text-xl"></i></button>
            </div>
            <div class="p-6">
                <label class="block text-sm font-bold text-gray-700 mb-2">Reason for Rejection <span
                        class="text-red-500">*</span></label>
                <select
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-red-100 outline-none bg-gray-50/50 mb-4 cursor-pointer">
                    <option disabled selected>Select a reason...</option>
                    <option>Hemolyzed Sample</option>
                    <option>Insufficient Quantity</option>
                    <option>Clotted Sample</option>
                    <option>Wrong Container/Tube</option>
                    <option>Other (Specify below)</option>
                </select>
                <textarea rows="2"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-red-100 outline-none bg-gray-50/50 resize-none"
                    placeholder="Additional details..."></textarea>
            </div>
            <div
                class="px-6 py-4 border-t border-gray-100 bg-gray-50/50 rounded-b-[1.25rem] flex items-center justify-end gap-3">
                <button id="CloseRejectSampleBtn" type="button"
                    class="px-5 py-2.5 rounded-xl text-sm font-bold text-gray-600 hover:bg-gray-200 transition-colors">Cancel</button>
                <button type="button"
                    class="bg-red-600 hover:bg-red-700 text-white px-6 py-2.5 rounded-xl text-sm font-bold transition-colors shadow-sm">Confirm
                    Rejection</button>
            </div>
        </div>
    </div>

    <div id="ViewReportModalBackdrop"
        class="fixed inset-0 bg-black/50 z-60 hidden items-center justify-center p-4 opacity-0 transition-opacity duration-300">
        <div id="ViewReportModal"
            class="bg-white w-full max-w-3xl rounded-[1.25rem] shadow-xl transform scale-95 transition-all duration-300 flex flex-col max-h-[95vh]">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-green-50 text-green-600 flex items-center justify-center">
                        <i class="ph-duotone ph-file-text text-xl"></i>
                    </div>
                    <h3 class="text-lg font-extrabold text-gray-800">Laboratory Report Preview</h3>
                </div>
                <button id="CloseViewReportX" class="text-gray-400 hover:text-gray-800 transition-colors p-1"><i
                        class="ph ph-x text-xl"></i></button>
            </div>
            <div class="p-8 overflow-y-auto bg-gray-50 flex justify-center custom-scrollbar">
                <div class="bg-white shadow-sm border border-gray-200 w-full max-w-2xl p-8 rounded-sm min-h-[600px]">
                    <div class="border-b-2 border-gray-800 pb-4 mb-6 text-center">
                        <h1 class="text-2xl font-black text-gray-900 uppercase tracking-widest">Medical Laboratory
                            Report</h1>
                    </div>
                    <div class="grid grid-cols-2 text-sm mb-8 gap-4">
                        <div><span class="font-bold">Patient Name:</span> Sara Ahmed</div>
                        <div><span class="font-bold">Report ID:</span> REP-2204</div>
                        <div><span class="font-bold">Test:</span> Liver Function Test</div>
                        <div><span class="font-bold">Date:</span> Oct 24, 2023</div>
                    </div>
                    <p class="text-gray-400 text-center mt-20">[Report Data & Parameters View]</p>
                </div>
            </div>
            <div class="px-6 py-4 border-t border-gray-100 flex items-center justify-end gap-3">
                <button id="CloseViewReportBtn"
                    class="px-5 py-2.5 rounded-xl text-sm font-bold text-gray-600 hover:bg-gray-200 transition-colors">Close</button>
                <button
                    class="bg-sidebarBg hover:bg-gray-800 text-white px-6 py-2.5 rounded-xl text-sm font-bold transition-colors shadow-sm flex items-center gap-2"><i
                        class="ph-bold ph-printer"></i> Print PDF</button>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // ==========================================
            // 1. GLOBAL SETUP & HEADERS
            // ==========================================
            const userId = document.querySelector('meta[name="user-id"]')?.getAttribute('content');
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
            const fetchHeaders = {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            };

            let inventoryItemsList = [];
            let hasSignature = false;

            // ==========================================
            // 2. ERROR HANDLING HELPERS
            // ==========================================
            function clearValidationErrors(form) {
                form.querySelectorAll('.validation-error').forEach(el => el.remove());
                form.querySelectorAll('.border-red-500').forEach(el => el.classList.remove('border-red-500'));
            }

            function displayValidationErrors(form, errors) {
                clearValidationErrors(form);

                for (const [key, messages] of Object.entries(errors)) {
                    let inputElement = null;

                    if (key.includes('.')) {
                        const [fieldName, index] = key.split('.');
                        const inputs = form.querySelectorAll(`[name="${fieldName}[]"]`);
                        if (inputs[index]) inputElement = inputs[index];
                    } else {
                        inputElement = form.querySelector(`[name="${key}"]`);
                    }

                    if (inputElement) {
                        inputElement.classList.add('border-red-500');
                        const errorText = document.createElement('p');
                        errorText.className = 'text-red-500 text-xs mt-1 font-bold validation-error animate-fade-in';
                        errorText.innerText = messages[0];
                        inputElement.parentNode.appendChild(errorText);
                    } else {
                        console.warn(`Validation error for field not in DOM: ${key}`, messages);
                    }
                }
            }

            // ==========================================
            // 3. INVENTORY HELPERS
            // ==========================================
            function getInventoryOptionsHTML() {
                if (inventoryItemsList.length === 0) {
                    return '<option value="" disabled selected>No inventory items found...</option>';
                }
                // IMPORTANT FIX: Added value="" to the default option
                let html = '<option value="" disabled selected>Select an item...</option>';
                inventoryItemsList.forEach(item => {
                    const itemName = item.name || item.item_name || item.itemName || 'Unnamed Item';
                    html += `<option value="${item.id}">${itemName}</option>`;
                });
                return html;
            }

            async function loadInventoryItems() {
                try {
                    const response = await fetch('/inventory', { headers: fetchHeaders });
                    const result = await response.json();

                    if (result.status === 'success' || result.status === 200) {
                        inventoryItemsList = result.data || [];
                        const html = getInventoryOptionsHTML();

                        document.querySelectorAll('select[name="inventory_item[]"]').forEach(select => {
                            const currentVal = select.value;
                            select.innerHTML = html;
                            if (currentVal && currentVal !== '') select.value = currentVal;
                        });
                    }
                } catch (error) {
                    console.error('Error loading inventory:', error);
                }
            }

            // ==========================================
            // 4. FETCH & RENDER TESTS (READ ALL)
            // ==========================================
            // ==========================================
            // 4. FETCH & RENDER TESTS (READ ALL)
            // ==========================================
            async function fetchTests() {
                try {
                    const response = await fetch('/tests', { headers: fetchHeaders });
                    const result = await response.json();

                    const tbody = document.getElementById('department-tests-table');
                    if (!tbody) return;

                    if (response.ok && result.status === 200 && result.data && result.data.length > 0) {
                        // Tests found, render them
                        renderTestsTable(result.data);
                    } else {
                        // No tests found in the database, show an empty state message
                        tbody.innerHTML = `
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500 font-medium">
                            <i class="ph-duotone ph-folder-open text-4xl mb-2 text-gray-400"></i>
                            <p>No tests found in the database.</p>
                            <p class="text-xs mt-1">Click "Add New Test" to create one.</p>
                        </td>
                    </tr>
                `;
                    }
                } catch (error) {
                    console.error('Error fetching tests:', error);
                }
            }
            function renderTestsTable(tests) {
                const tbody = document.getElementById('department-tests-table');
                if (!tbody) return;
                tbody.innerHTML = '';

                tests.forEach(test => {
                    const statusBadge = test.isActive
                        ? '<span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs font-bold">Active</span>'
                        : '<span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-xs font-bold">Inactive</span>';

                    const row = `
                <tr class="bg-white border-b border-gray-100 hover:bg-gray-50 transition-colors text-gray-800 font-medium">
                    <td class="px-6 py-4">${test.name}</td>
                    <td class="px-6 py-4 text-gray-500">${test.code}</td>
                    <td class="px-6 py-4">Rs. ${test.price}</td>
                    <td class="px-6 py-4">${test.sampleType || 'N/A'}</td>
                    <td class="px-6 py-4">${statusBadge}</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-end gap-2">
                            <button data-id="${test.id}" class="btn-edit-test bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-1.5 rounded-lg text-xs font-bold transition-colors cursor-pointer border border-gray-200 shadow-sm">Edit</button>
                            <button data-id="${test.id}" class="btn-delete-test bg-red-50 hover:bg-red-100 text-red-600 px-3 py-1.5 rounded-lg text-xs font-bold transition-colors cursor-pointer border border-red-100 shadow-sm">Delete</button>
                        </div>
                    </td>
                </tr>`;
                    tbody.insertAdjacentHTML('beforeend', row);
                });
            }

            // ==========================================
            // 5. UI NAVIGATION & SIDEBAR
            // ==========================================
            const sections = document.querySelectorAll('.content-section');
            const headerTitle = document.getElementById('header-title');

            function switchSection(targetId, title = null) {
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
                    if (link.getAttribute('data-target') === 'section-completed-reports') {
                        fetchSpecialistCompletedReports();
                    }
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

            // ==========================================
            // 6. MODALS
            // ==========================================
            function openModal(backdropId, modalId) {
                const backdrop = document.getElementById(backdropId);
                const modal = document.getElementById(modalId);
                if (!backdrop || !modal) return;
                backdrop.classList.remove('hidden');
                backdrop.classList.add('flex');
                requestAnimationFrame(() => {
                    backdrop.classList.remove('opacity-0');
                    modal.classList.remove('scale-95');
                    modal.classList.add('scale-100');
                });
            }

            function closeModal(backdropId, modalId) {
                const backdrop = document.getElementById(backdropId);
                const modal = document.getElementById(modalId);
                if (!backdrop || !modal) return;
                backdrop.classList.add('opacity-0');
                modal.classList.remove('scale-100');
                modal.classList.add('scale-95');
                setTimeout(() => {
                    backdrop.classList.remove('flex');
                    backdrop.classList.add('hidden');
                }, 300);
            }


            document.addEventListener('click', async (e) => {
                if (e.target.closest('.btn-open-verify')) {
                    const btn = e.target.closest('.btn-open-verify');
                    const orderTestId = btn.dataset.orderTestId;
                    const patientName = btn.dataset.patientName;
                    const testName = btn.dataset.testName;

                    if (!hasSignature) {
                        alert('Please upload your signature in Settings before verifying results.');
                        switchSection('section-settings', 'Settings');
                        return;
                    }

                    document.getElementById('verifyModalSubtitle').innerText = `Patient: ${patientName} | Test: ${testName}`;
                    const tbody = document.getElementById('verifyResultsTbody');
                    tbody.innerHTML = '<tr><td colspan="4" class="px-4 py-4 text-center text-gray-500">Loading results...</td></tr>';
                    document.getElementById('VerifyTestForm').dataset.orderTestId = orderTestId;

                    openModal('VerifyTestModalBackdrop', 'VerifyTestModal');

                    try {
                        const res = await fetch(`/getResultsByOrderTestId/${orderTestId}`, { headers: fetchHeaders });
                        const result = await res.json();

                        if (result.status === 200) {
                            tbody.innerHTML = '';
                            if (result.data && result.data.length > 0) {
                                // For human based tests, there might be NO parameters, just remarks and attachments.
                                // We check if the first item has no parameter ID.
                                if(!result.data[0].parameter && !result.data[0].resultValue) {
                                    const item = result.data[0];
                                    let attachmentHtml = '';
                                    if(item.attachmentPaths) {
                                        try {
                                            const paths = JSON.parse(item.attachmentPaths);
                                            if(paths && paths.length > 0) {
                                                attachmentHtml = `<a href="/${paths[0]}" target="_blank" class="text-blue-500 hover:underline"><i class="ph-bold ph-link"></i> View Attachment</a>`;
                                            }
                                        } catch(e) {}
                                    }
                                    const row = `
                                        <tr data-result-id="${item.id}">
                                            <td colspan="4" class="px-4 py-4">
                                                <div class="mb-4">
                                                    <span class="font-bold text-gray-700">Technician Remarks:</span><br>
                                                    <p class="text-gray-600 bg-gray-50 p-3 rounded-lg mt-1">${item.remarks || 'No remarks provided.'}</p>
                                                </div>
                                                ${attachmentHtml ? '<div class="mb-2 font-bold text-gray-700">Attachments: ' + attachmentHtml + '</div>' : ''}
                                            </td>
                                        </tr>
                                    `;
                                    tbody.insertAdjacentHTML('beforeend', row);
                                } else {
                                    result.data.forEach(item => {
                                        const row = `
                                            <tr data-result-id="${item.id}">
                                                <td class="px-4 py-3 font-medium">${item.parameter?.parameterName || 'N/A'}</td>
                                                <td class="px-4 py-3">
                                                    <input type="text" value="${item.resultValue || ''}" 
                                                        class="result-input w-24 border border-gray-200 rounded-md px-2 py-1 text-sm focus:ring-2 focus:ring-blue-100 outline-none">
                                                </td>
                                                <td class="px-4 py-3 text-gray-500">${item.parameter?.unit || ''}</td>
                                                <td class="px-4 py-3 text-gray-500">${item.parameter?.normalRange || ''}</td>
                                            </tr>
                                        `;
                                        tbody.insertAdjacentHTML('beforeend', row);
                                    });
                                }
                            } else {
                                tbody.innerHTML = '<tr><td colspan="4" class="px-4 py-4 text-center text-gray-500">No data found.</td></tr>';
                            }
                        }
                    } catch (err) {
                        console.error(err);
                        tbody.innerHTML = '<tr><td colspan="4" class="px-4 py-4 text-center text-red-500">Error loading results.</td></tr>';
                    }
                }
            });

            document.getElementById('clinicalRemarksTemplate')?.addEventListener('change', function() {
                document.getElementById('verifyRemarks').value = this.value;
            });

            document.getElementById('BtnVerifyAndSign')?.addEventListener('click', async function() {
                const form = document.getElementById('VerifyTestForm');
                const orderTestId = form.dataset.orderTestId;
                const rows = document.querySelectorAll('#verifyResultsTbody tr[data-result-id]');
                const results = [];

                rows.forEach(row => {
                    const input = row.querySelector('.result-input');
                    results.push({
                        id: row.dataset.resultId,
                        resultValue: input ? input.value : null
                    });
                });

                const payload = {
                    orderTestId: orderTestId,
                    results: results,
                    remarks: document.getElementById('verifyRemarks').value,
                    alertPatient: document.getElementById('criticalFlag').checked
                };

                const originalText = this.innerText;
                this.innerText = 'Verifying...';
                this.disabled = true;

                try {
                    const response = await fetch('/verifyResult', {
                        method: 'POST',
                        headers: {
                            ...fetchHeaders,
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(payload)
                    });

                    const res = await response.json();
                    if (res.status === 200) {
                        alert('Verified successfully!');
                        closeModal('VerifyTestModalBackdrop', 'VerifyTestModal');
                        fetchSpecialistPendingList();
                        fetchSpecialistStats();
                        fetchSpecialistCompletedReports();
                    } else {
                        alert(res.message || 'Verification failed');
                    }
                } catch (err) {
                    console.error(err);
                    alert('An error occurred during verification.');
                } finally {
                    this.innerText = originalText;
                    this.disabled = false;
                }
            });
            document.getElementById('CloseVerifyTestX')?.addEventListener('click', () => closeModal('VerifyTestModalBackdrop', 'VerifyTestModal'));
            document.getElementById('CloseVerifyTestBtn')?.addEventListener('click', () => closeModal('VerifyTestModalBackdrop', 'VerifyTestModal'));
            document.getElementById('BtnRejectSample')?.addEventListener('click', () => openModal('RejectSampleModalBackdrop', 'RejectSampleModal'));
            document.getElementById('CloseRejectSampleX')?.addEventListener('click', () => closeModal('RejectSampleModalBackdrop', 'RejectSampleModal'));
            document.getElementById('CloseRejectSampleBtn')?.addEventListener('click', () => closeModal('RejectSampleModalBackdrop', 'RejectSampleModal'));
            document.querySelectorAll('.btn-view-report').forEach(btn => btn.addEventListener('click', () => openModal('ViewReportModalBackdrop', 'ViewReportModal')));
            document.getElementById('CloseViewReportX')?.addEventListener('click', () => closeModal('ViewReportModalBackdrop', 'ViewReportModal'));
            document.getElementById('CloseViewReportBtn')?.addEventListener('click', () => closeModal('ViewReportModalBackdrop', 'ViewReportModal'));

            // ==========================================
            // 7. DYNAMIC FORM FIELDS
            // ==========================================
            function setupDynamicFields(containerId, addBtnId, isUpdate) {
                const container = document.getElementById(containerId);
                const addBtn = document.getElementById(addBtnId);
                if (!container || !addBtn) return;

                const focusColor = isUpdate ? 'teal' : 'purple';
                const isParameter = containerId.includes('parameters');

                addBtn.addEventListener('click', () => {
                    const templateHTML = isParameter ? `
                <div class="flex gap-4 items-end bg-gray-50 p-4 rounded-xl border border-gray-100 parameter-row animate-fade-in">
                    <div class="flex-1">
                        <label class="block text-xs font-bold text-gray-600 mb-1">Parameter Name *</label>
                        <input type="text" name="parameter_name[]" placeholder="e.g. Test" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-${focusColor}-100 outline-none bg-white">
                    </div>
                    <div class="w-24">
                        <label class="block text-xs font-bold text-gray-600 mb-1">Unit</label>
                        <input type="text" name="parameter_unit[]" placeholder="unit" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-${focusColor}-100 outline-none bg-white">
                    </div>
                    <div class="flex-1">
                        <label class="block text-xs font-bold text-gray-600 mb-1">Normal Range</label>
                        <input type="text" name="parameter_range[]" placeholder="range" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-${focusColor}-100 outline-none bg-white">
                    </div>
                    <div>
                        <button type="button" class="text-red-400 hover:text-red-600 p-2 btn-remove-row"><i class="ph-bold ph-trash"></i></button>
                    </div>
                </div>` : `
                <div class="flex gap-4 items-end bg-gray-50 p-4 rounded-xl border border-gray-100 requirement-row animate-fade-in">
                    <div class="flex-1">
                        <label class="block text-xs font-bold text-gray-600 mb-1">Inventory Item *</label>
                        <select name="inventory_item[]" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-${focusColor}-100 outline-none bg-white cursor-pointer">
                            ${getInventoryOptionsHTML()} 
                        </select>
                    </div>
                    <div class="w-32">
                        <label class="block text-xs font-bold text-gray-600 mb-1">Qty Used *</label>
                        <input type="number" name="inventory_quantity[]" value="1" min="1" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-${focusColor}-100 outline-none bg-white">
                    </div>
                    <div>
                        <button type="button" class="text-red-400 hover:text-red-600 p-2 btn-remove-row"><i class="ph-bold ph-trash"></i></button>
                    </div>
                </div>`;
                    container.insertAdjacentHTML('beforeend', templateHTML);
                });

                container.addEventListener('click', (e) => {
                    const removeBtn = e.target.closest('.btn-remove-row');
                    if (removeBtn) {
                        const row = removeBtn.closest('.parameter-row, .requirement-row');
                        if (row) row.remove();
                    }
                });
            }

            setupDynamicFields('add-parameters-container', 'btn-add-parameter', false);
            setupDynamicFields('add-requirements-container', 'btn-add-item', false);
            setupDynamicFields('update-parameters-container', 'btn-update-add-parameter', true);
            setupDynamicFields('update-requirements-container', 'btn-update-add-item', true);

            // ==========================================
            // 8. FORM BUTTON ACTIONS
            // ==========================================
            const backToTestsList = () => {
                switchSection('section-manage-tests', 'Manage Tests');
                ['AddTestFormSection', 'UpdateTestFormSection'].forEach(id => {
                    const form = document.getElementById(id);
                    if (form) {
                        form.reset();
                        clearValidationErrors(form);
                    }
                });
            };

            document.getElementById('btn-go-to-add-test')?.addEventListener('click', () => switchSection('section-add-test', 'Add New Test'));
            document.getElementById('btn-back-to-tests-from-add')?.addEventListener('click', backToTestsList);
            document.getElementById('btn-cancel-add-test-bottom')?.addEventListener('click', backToTestsList);
            document.getElementById('btn-back-to-tests-from-update')?.addEventListener('click', backToTestsList);
            document.getElementById('btn-cancel-update-test-bottom')?.addEventListener('click', backToTestsList);

            // ==========================================
            // 9. CRUD OPERATIONS
            // ==========================================

            // --- CREATE ---
            const btnSaveTest = document.querySelector('#AddTestFormSection button.bg-sidebarBg');
            if (btnSaveTest) {
                btnSaveTest.addEventListener('click', async () => {
                    const form = document.getElementById('AddTestFormSection');
                    const formData = new FormData(form);
                    clearValidationErrors(form);

                    try {
                        const response = await fetch('/tests/add', {
                            method: 'POST',
                            headers: fetchHeaders,
                            body: formData
                        });
                        const result = await response.json();

                        if (response.status === 422) {
                            displayValidationErrors(form, result.errors);
                            return;
                        }

                        if (response.ok && result.status === 200) {
                            alert('Test added successfully!');
                            backToTestsList();
                            fetchTests();
                        } else {
                            alert(result.message || 'Error adding test.');
                        }
                    } catch (error) {
                        console.error('Error in Add:', error);
                    }
                });
            }

            // --- READ (EDIT) & DELETE ---
            document.getElementById('department-tests-table')?.addEventListener('click', async (e) => {
                // EDIT
                if (e.target.closest('.btn-edit-test')) {
                    const testId = e.target.closest('.btn-edit-test').dataset.id;
                    const form = document.getElementById('UpdateTestFormSection');
                    form.dataset.testId = testId;
                    clearValidationErrors(form);

                    try {
                        const response = await fetch(`/tests/${testId}`, { headers: fetchHeaders });
                        const result = await response.json();

                        if (result.status === 200) {
                            const test = result.data;
                            form.querySelector('input[name="name"]').value = test.name || '';
                            form.querySelector('input[name="code"]').value = test.code || '';
                            form.querySelector('input[name="price"]').value = test.price || '';
                            form.querySelector('input[name="type"]').value = test.sampleType || '';
                            form.querySelector('input[name="time"]').value = test.resultHours || '';
                            form.querySelector('textarea[name="instructions"]').value = test.instructions || '';
                            form.querySelector('input[name="is_active"]').checked = test.isActive;

                            const paramsContainer = document.getElementById('update-parameters-container');
                            paramsContainer.innerHTML = '';
                            if (test.parameters?.length) {
                                test.parameters.forEach(param => {
                                    paramsContainer.insertAdjacentHTML('beforeend', `
                            <div class="flex gap-4 items-end bg-gray-50 p-4 rounded-xl border border-gray-100 parameter-row">
                                <div class="flex-1">
                                    <label class="block text-xs font-bold text-gray-600 mb-1">Parameter Name *</label>
                                    <input type="text" name="parameter_name[]" value="${param.parameterName}" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-teal-100 outline-none bg-white">
                                </div>
                                <div class="w-24">
                                    <label class="block text-xs font-bold text-gray-600 mb-1">Unit</label>
                                    <input type="text" name="parameter_unit[]" value="${param.unit || ''}" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-teal-100 outline-none bg-white">
                                </div>
                                <div class="flex-1">
                                    <label class="block text-xs font-bold text-gray-600 mb-1">Normal Range</label>
                                    <input type="text" name="parameter_range[]" value="${param.normalRange || ''}" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-teal-100 outline-none bg-white">
                                </div>
                                <div><button type="button" class="text-red-400 hover:text-red-600 p-2 btn-remove-row"><i class="ph-bold ph-trash"></i></button></div>
                            </div>`);
                                });
                            }

                            const reqContainer = document.getElementById('update-requirements-container');
                            reqContainer.innerHTML = '';
                            if (test.requirements?.length) {
                                test.requirements.forEach(req => {
                                    reqContainer.insertAdjacentHTML('beforeend', `
                            <div class="flex gap-4 items-end bg-gray-50 p-4 rounded-xl border border-gray-100 requirement-row">
                                <div class="flex-1">
                                    <label class="block text-xs font-bold text-gray-600 mb-1">Inventory Item *</label>
                                    <select name="inventory_item[]" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-teal-100 outline-none bg-white cursor-pointer" data-selected="${req.inventoryId}">
                                        ${getInventoryOptionsHTML()}
                                    </select>
                                </div>
                                <div class="w-32">
                                    <label class="block text-xs font-bold text-gray-600 mb-1">Qty Used *</label>
                                    <input type="number" name="inventory_quantity[]" value="${req.quantityUsed}" min="1" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-teal-100 outline-none bg-white">
                                </div>
                                <div><button type="button" class="text-red-400 hover:text-red-600 p-2 btn-remove-row"><i class="ph-bold ph-trash"></i></button></div>
                            </div>`);
                                });
                                reqContainer.querySelectorAll('select').forEach(select => {
                                    if (select.dataset.selected) select.value = select.dataset.selected;
                                });
                            }
                            switchSection('section-update-test', 'Update Test');
                        } else {
                            alert('Failed to fetch test details.');
                        }
                    } catch (error) {
                        console.error('Error fetching test:', error);
                    }
                }

                // DELETE
                if (e.target.closest('.btn-delete-test')) {
                    const testId = e.target.closest('.btn-delete-test').dataset.id;
                    if (confirm('Are you sure you want to delete this test?')) {
                        try {
                            const response = await fetch(`/tests/${testId}`, { method: 'DELETE', headers: fetchHeaders });
                            if ((await response.json()).status === 200) fetchTests();
                            else alert('Failed to delete test.');
                        } catch (error) {
                            console.error('Error deleting test:', error);
                        }
                    }
                }
            });

            // --- UPDATE ---
            const btnUpdateSubmit = document.querySelector('#UpdateTestFormSection button.bg-teal-600');
            if (btnUpdateSubmit) {
                btnUpdateSubmit.addEventListener('click', async () => {
                    const form = document.getElementById('UpdateTestFormSection');
                    const testId = form.dataset.testId;
                    if (!testId) return alert('No Test ID found.');

                    const formData = new FormData(form);
                    formData.append('_method', 'PUT'); // Spoof PUT 
                    clearValidationErrors(form);

                    try {
                        const response = await fetch(`/tests/${testId}`, {
                            method: 'POST',
                            headers: fetchHeaders,
                            body: formData
                        });
                        const result = await response.json();

                        if (response.status === 422) {
                            displayValidationErrors(form, result.errors);
                            return;
                        }

                        if (response.ok && (result.status === 200 || result.status === 'success')) {
                            alert('Test updated successfully!');
                            backToTestsList();
                            fetchTests();
                        } else {
                            alert(result.message || 'Error updating test.');
                        }
                    } catch (error) {
                        console.error('Error updating test:', error);
                    }
                });
            }

            async function fetchSpecialistPendingList() {
                try {
                    const response = await fetch('/getSpecialistPendingList', { headers: fetchHeaders });
                    const result = await response.json();
                    const tbody = document.getElementById('pending-results-table');
                    if (!tbody) return;

                    tbody.innerHTML = '';

                    if (response.ok && result.status === 200 && result.data && result.data.length > 0) {
                        result.data.forEach(order => {
                            order.tests.forEach(test => {
                                const row = `
                                    <tr class="bg-white border-b border-gray-100 hover:bg-gray-50 transition-colors text-gray-800 font-medium">
                                        <td class="px-6 py-4">TST-${test.pivot.id}</td>
                                        <td class="px-6 py-4">${order.name}</td>
                                        <td class="px-6 py-4">${test.name}</td>
                                        <td class="px-6 py-4">${test.sampleType || 'N/A'}</td>
                                        <td class="px-6 py-4 text-right">
                                            <button data-order-test-id="${test.pivot.id}"
                                                data-patient-name="${order.name}"
                                                data-test-name="${test.name}"
                                                class="btn-open-verify bg-sidebarBg hover:bg-gray-800 text-white px-4 py-2 rounded-lg text-xs font-bold transition-colors shadow-sm cursor-pointer">
                                                Verify Results
                                            </button>
                                        </td>
                                    </tr>`;
                                tbody.insertAdjacentHTML('beforeend', row);
                            });
                        });
                    } else {
                        tbody.innerHTML = `
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500 font-medium">
                                    <i class="ph-duotone ph-checks text-4xl mb-2 text-gray-400"></i>
                                    <p>No pending results found.</p>
                                </td>
                            </tr>
                        `;
                    }
                } catch (error) {
                    console.error('Error fetching pending results:', error);
                }
            }

            async function fetchSpecialistStats() {
                try {
                    const response = await fetch('/getSpecialistStats', { headers: fetchHeaders });
                    const stats = await response.json();
                    
                    document.getElementById('pending-approvals-count').innerText = stats.pendingApprovals || 0;
                    document.getElementById('completed-today-count').innerText = stats.completedToday || 0;
                    document.getElementById('critical-results-count').innerText = stats.criticalResults || 0;
                } catch (error) {
                    console.error('Error fetching stats:', error);
                }
            }

            async function fetchSpecialistCompletedReports() {
                const startDate = document.getElementById('reportStartDate').value;
                const endDate = document.getElementById('reportEndDate').value;
                
                try {
                    const url = new URL('/getSpecialistCompletedReports', window.location.origin);
                    if (startDate) url.searchParams.append('startDate', startDate);
                    if (endDate) url.searchParams.append('endDate', endDate);

                    const response = await fetch(url, { headers: fetchHeaders });
                    const result = await response.json();
                    const tbody = document.getElementById('completed-reports-table');
                    if (!tbody) return;

                    tbody.innerHTML = '';

                    if (response.ok && result.status === 200 && result.data && result.data.length > 0) {
                        result.data.forEach(report => {
                            const date = new Date(report.completionDate).toLocaleDateString('en-US', {
                                month: 'short', day: 'numeric', year: 'numeric'
                            });
                            const row = `
                                <tr class="bg-white border-b border-gray-100 hover:bg-gray-50 transition-colors text-gray-800 font-medium">
                                    <td class="px-6 py-4">REP-${report.id}</td>
                                    <td class="px-6 py-4">${report.patientName}</td>
                                    <td class="px-6 py-4">${report.testName}</td>
                                    <td class="px-6 py-4">${date}</td>
                                    <td class="px-6 py-4 text-right">
                                        <button data-order-test-id="${report.id}"
                                            class="btn-view-report text-blue-500 hover:text-blue-700 p-1 transition-colors mr-2 cursor-pointer">
                                            <i class="ph-duotone ph-eye text-xl"></i>
                                        </button>
                                        <button class="text-gray-500 hover:text-gray-800 p-1 transition-colors cursor-pointer">
                                            <i class="ph-duotone ph-printer text-xl"></i>
                                        </button>
                                    </td>
                                </tr>`;
                            tbody.insertAdjacentHTML('beforeend', row);
                        });
                    } else {
                        tbody.innerHTML = `
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500 font-medium">
                                    <i class="ph-duotone ph-file-dashed text-4xl mb-2 text-gray-400"></i>
                                    <p>No completed reports found.</p>
                                </td>
                            </tr>
                        `;
                    }
                } catch (error) {
                    console.error('Error fetching reports:', error);
                }
            }

            document.getElementById('btnFilterReports')?.addEventListener('click', fetchSpecialistCompletedReports);

            // ==========================================
            // 10. INITIALIZATION CALLS
            // ==========================================
            loadInventoryItems();
            fetchTests();
            fetchSpecialistPendingList();
            fetchSpecialistStats();
            fetchSpecialistCompletedReports();
            // ==========================================
            // 11. SETTINGS & PROFILE MANAGEMENT
            // ==========================================
            
            // Self-contained error helper specifically for these forms
            function showFormErrors(form, errors) {
                // Clear previous errors
                form.querySelectorAll('.text-red-500').forEach(el => el.remove());
                form.querySelectorAll('.border-red-500').forEach(el => el.classList.remove('border-red-500'));

                for (const [key, messages] of Object.entries(errors)) {
                    const input = form.querySelector(`[name="${key}"]`);
                    if (input) {
                        input.classList.add('border-red-500');
                        const err = document.createElement('p');
                        err.className = 'text-red-500 text-xs mt-1 font-bold animate-fade-in';
                        err.innerText = messages[0];

                        // Append exactly after the input wrapper
                        input.parentElement.appendChild(err);
                    }
                }
            }

            // --- 1. Toggle Password Visibility ---
            document.querySelectorAll('.toggle-password').forEach(icon => {
                icon.addEventListener('click', function () {
                    const input = this.previousElementSibling;
                    if (input.type === 'password') {
                        input.type = 'text';
                        this.classList.replace('ph-eye', 'ph-eye-slash');
                    } else {
                        input.type = 'password';
                        this.classList.replace('ph-eye-slash', 'ph-eye');
                    }
                });
            });

            if (!userId) {
                console.warn('User ID meta tag not found. Settings page features will not work.');
                return; // Stop execution to prevent errors if not logged in
            }

            // --- 2. Signature Management ---
            const sigUploadState = document.getElementById('sigUploadState');
            const sigPreviewState = document.getElementById('sigPreviewState');
            const sigPreviewImage = document.getElementById('sigPreviewImage');
            const signatureFileInput = document.getElementById('signatureFileInput');

            // Fetch and display existing signature
            async function loadSignature() {
                try {
                    const res = await fetch(`/user/${userId}/signature`, {
                        headers: { 'Accept': 'application/json' }
                    });
                    const data = await res.json();
                    
                    hasSignature = !!(data.status === 200 && data.signature);

                    if (data.status === 200 && data.signature) {
                        // Prevent broken image paths by ensuring leading slash
                        sigPreviewImage.src = '/' + data.signature.replace(/^\//, '');
                        sigUploadState.classList.add('hidden');
                        sigPreviewState.classList.remove('hidden');
                        sigPreviewState.classList.add('flex');
                    } else {
                        // Ensure upload state is shown if no signature exists
                        sigUploadState.classList.remove('hidden');
                        sigPreviewState.classList.add('hidden');
                        sigPreviewState.classList.remove('flex');
                    }
                } catch (e) {
                    console.error('Error loading signature:', e);
                }
            }

            // Initial Load
            loadSignature();

            // Bind Upload Buttons
            document.getElementById('btnUploadNewSig')?.addEventListener('click', () => signatureFileInput.click());
            document.getElementById('btnChangeSig')?.addEventListener('click', () => signatureFileInput.click());

            // Handle File Selection & Upload
            signatureFileInput?.addEventListener('change', async (e) => {
                const file = e.target.files[0];
                if (!file) return;

                const formData = new FormData();
                formData.append('signature', file);

                const btn = document.getElementById('btnUploadNewSig');
                const originalText = btn ? btn.innerText : 'Upload';
                if (btn) btn.innerText = 'Uploading...';

                try {
                    const response = await fetch(`/user/${userId}/signature`, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: formData
                    });

                    const result = await response.json();
                    if (response.ok && result.status === 200) {
                        loadSignature(); // Refresh the image preview automatically
                    } else {
                        alert(result.message || 'Error uploading signature.');
                    }
                } catch (error) {
                    console.error('Upload Error:', error);
                    alert('A network error occurred while uploading.');
                } finally {
                    if (btn) btn.innerText = originalText;
                    signatureFileInput.value = ''; // Reset input to allow re-uploading the same file if needed
                }
            });

            // Handle Delete Signature
            document.getElementById('btnDeleteSig')?.addEventListener('click', async () => {
                if (!confirm('Are you sure you want to permanently delete your signature?')) return;

                try {
                    const response = await fetch(`/user/${userId}/signature`, {
                        method: 'DELETE',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        }
                    });

                    if (response.ok) {
                        sigPreviewImage.src = '';
                        sigPreviewState.classList.add('hidden');
                        sigPreviewState.classList.remove('flex');
                        sigUploadState.classList.remove('hidden');
                    } else {
                        alert('Failed to delete signature.');
                    }
                } catch (e) {
                    console.error('Delete Error:', e);
                }
            });

            // --- 3. Update Email ---
            document.getElementById('UpdateEmailForm')?.addEventListener('submit', async (e) => {
                e.preventDefault();
                const form = e.target;
                const btn = document.getElementById('btnSaveEmail');
                const originalText = btn.innerText;

                // UI Loading State
                btn.innerText = 'Saving...';
                btn.disabled = true;

                const formData = new FormData(form);
                formData.append('_method', 'PUT');

                try {
                    const response = await fetch(`/user/${userId}/email`, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: formData
                    });

                    const result = await response.json();

                    if (response.status === 422) {
                        showFormErrors(form, result.errors);
                    } else if (response.ok && result.status === 200) {
                        // Clear errors on success
                        form.querySelectorAll('.text-red-500').forEach(el => el.remove());
                        form.querySelectorAll('.border-red-500').forEach(el => el.classList.remove('border-red-500'));
                        alert('Email updated successfully!');
                    } else {
                        alert(result.message || 'Failed to update email.');
                    }
                } catch (error) {
                    console.error(error);
                    alert('A network error occurred.');
                } finally {
                    // Restore UI
                    btn.innerText = originalText;
                    btn.disabled = false;
                }
            });

            // --- 4. Update Password ---
            document.getElementById('UpdatePasswordForm')?.addEventListener('submit', async (e) => {
                e.preventDefault();
                const form = e.target;
                const btn = document.getElementById('btnSavePassword');
                const originalText = btn.innerText;

                // UI Loading State
                btn.innerText = 'Updating...';
                btn.disabled = true;

                const formData = new FormData(form);
                formData.append('_method', 'PUT');

                try {
                    const response = await fetch(`/user/${userId}/password`, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: formData
                    });

                    const result = await response.json();

                    if (response.status === 422) {
                        showFormErrors(form, result.errors);
                    } else if (result.status === 400) {
                        // Manual error mapping for incorrect current password matching our backend logic
                        showFormErrors(form, { 'password': [result.message] });
                    } else if (response.ok && result.status === 200) {
                        // Clear errors and reset fields
                        form.querySelectorAll('.text-red-500').forEach(el => el.remove());
                        form.querySelectorAll('.border-red-500').forEach(el => el.classList.remove('border-red-500'));
                        form.reset(); // Empty the password fields
                        alert('Password updated successfully!');
                    } else {
                        alert(result.message || 'Failed to update password.');
                    }
                } catch (error) {
                    console.error(error);
                    alert('A network error occurred.');
                } finally {
                    // Restore UI
                    btn.innerText = originalText;
                    btn.disabled = false;
                }
            });
        });
    </script>
</body>