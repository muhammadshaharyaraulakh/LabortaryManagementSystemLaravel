<x-header />

<body class="font-sans antialiased bg-mainBg text-gray-800 flex h-screen overflow-hidden">

    <div id="sidebar-backdrop"
        class="fixed inset-0 bg-black/50 z-40 hidden transition-opacity md:hidden cursor-pointer"></div>

    <aside id="sidebar"
        class="bg-sidebarBg text-white w-64 shrink-0 transition-all duration-300 flex flex-col fixed inset-y-0 left-0 z-50 md:relative transform -translate-x-full md:translate-x-0">
        <div class="h-20 flex items-center justify-between px-6 pt-2">
            <span id="brand-text"
                class="text-white text-xl font-bold whitespace-nowrap tracking-wide">Pathologist</span>
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
                data-target="section-archived-tests" data-title="Archived Tests">
                <i
                    class="ph-duotone ph-trash text-2xl w-7 text-center text-gray-400 group-hover:text-white transition-colors nav-icon"></i>
                <span class="ml-3 nav-text whitespace-nowrap">Archived Tests</span>
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
                        class="ph ph-sign-out text-2xl w-7 text-center text-gray-400 group-hover:text-white transition-colors"></i>
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
                    Dashboard {{ auth()->user()->department->name }}
                </h1>
            </div>

        </header>

        <main class="flex-1 overflow-y-auto p-4 md:p-10 pt-2 relative">
            <div id="globalNotification" class="fixed top-24 right-10 z-70 hidden p-4 rounded-xl shadow-lg border animate-fade-in max-w-sm pointer-events-none"></div>

            <div id="section-dashboard" class="content-section block animate-fade-in">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-orange-50 text-orange-500 flex items-center justify-center">
                            <i class="ph-duotone ph-flask text-2xl"></i>
                        </div>
                        <div>

                            <p class="text-sm text-gray-500 font-medium mt-1">Review and verify pending results for your
                                department</p>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white rounded-[1.25rem] shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-50 overflow-hidden w-full">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead class="text-xs text-gray-700 font-bold bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th scope="col" class="px-6 py-4"><b>Receipt</b> ID</th>
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


                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead class="text-xs text-gray-700 font-bold bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th scope="col" class="px-6 py-4 text-gray-400 font-medium"><b>Receipt</b> ID</th>
                                    <th scope="col" class="px-6 py-4">Patient Name</th>
                                    <th scope="col" class="px-6 py-4">Tests Count</th>
                                    <th scope="col" class="px-6 py-4 text-right">Completion Status</th>
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
                            <input type="text" id="test-search-input" placeholder="Search test name or code..."
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
                        <div
                            class="form-general-error hidden bg-red-50 text-red-600 p-4 rounded-xl border border-red-100 mb-6 font-bold text-sm">
                        </div>

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
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Instructions for SampleCollector
                                and Technician</label>
                            <textarea name="instructionsForTechnicianAndSampleCollector" rows="3"
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-purple-100 outline-none bg-gray-50/50 resize-none transition-colors"
                                placeholder="e.g. Use Red Test Tube for Collecting Blood"></textarea>
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

                        <div class="parameter-error-summary"></div>

                        <div id="add-parameters-container" class="space-y-4">
                            <div
                                class="flex gap-4 items-start bg-gray-50 p-4 rounded-xl border border-gray-100 parameter-row">
                                <div class="w-36">
                                    <label class="block text-xs font-bold text-gray-600 mb-1">Test Type *</label>
                                    <select name="parameter_type[]"
                                        class="parameter-type-select w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-purple-100 outline-none bg-white cursor-pointer">
                                        <option value="Quantitative">Quantitative </option>
                                        <option value="Qualitative">Qualitative</option>
                                        <option value="Observational">Observational </option>
                                        <option value="Image">Image</option>
                                    </select>
                                </div>

                                <div class="flex-1">
                                    <label class="block text-xs font-bold text-gray-600 mb-1">Parameter Name *</label>
                                    <input type="text" placeholder="e.g. Hemoglobin or Result" name="parameter_name[]"
                                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-purple-100 outline-none bg-white">
                                </div>

                                <div class="w-24 param-number-fields">
                                    <label class="block text-xs font-bold text-gray-600 mb-1">Unit</label>
                                    <input type="text" placeholder="g/dL" name="parameter_unit[]"
                                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-purple-100 outline-none bg-white">
                                </div>

                                <div class="flex-1 param-number-fields">
                                    <label class="block text-xs font-bold text-gray-600 mb-1">Normal Range</label>
                                    <input type="text" placeholder="13.8 - 17.2" name="parameter_range[]"
                                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-purple-100 outline-none bg-white">
                                </div>

                                <div class="flex-1 param-dropdown-fields hidden">
                                    <label class="block text-xs font-bold text-gray-600 mb-1">Options (Comma
                                        separated)</label>
                                    <input type="text" placeholder="e.g. Positive, Negative" name="parameter_options[]"
                                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-purple-100 outline-none bg-white">
                                </div>

                                <div class="pt-6">

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

                        <div class="inventory-error-summary"></div>

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
                        <div
                            class="form-general-error hidden bg-red-50 text-red-600 p-4 rounded-xl border border-red-100 mb-6 font-bold text-sm">
                        </div>
                        <div class="border-b border-gray-100 pb-4 mb-4">
                            <h3 class="text-lg font-bold text-gray-800">
                                <i class="ph-duotone ph-info text-teal-600 mr-2"></i>1. Basic Information
                            </h3>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Test Name <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="name" placeholder="e.g. Complete Blood Count"
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-teal-100 outline-none bg-gray-50/50 transition-colors">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Test Code <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="code" placeholder="CBC-01"
                                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-teal-100 outline-none bg-gray-50/50 transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Price (Rs.) <span
                                        class="text-red-500">*</span></label>
                                <input type="number" step="0.01" name="price" placeholder="800"
                                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-teal-100 outline-none bg-gray-50/50 transition-colors">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Sample Type</label>
                                <input type="text" name="type" placeholder="e.g. Blood, Urine"
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
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-teal-100 outline-none bg-gray-50/50 resize-none transition-colors"
                                placeholder="e.g. Fasting required for 12 hours"></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Instructions for SampleCollector
                                and Technician</label>
                            <textarea name="instructionsForTechnicianAndSampleCollector" rows="3"
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-purple-100 outline-none bg-gray-50/50 resize-none transition-colors"
                                placeholder="e.g. Use Red Test Tube for Collecting Blood"></textarea>
                        </div>

                        <div class="pt-2">
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="checkbox" name="is_active" class="peer sr-only" checked>
                                <div
                                    class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-teal-500 relative after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white transition-colors">
                                </div>
                                <span class="text-sm font-bold text-gray-700">Test is Active (Visible to
                                    Reception)</span>
                            </label>
                        </div>


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
                            <p class="text-xs text-gray-500 mt-1">Define the values to be checked within this test.</p>
                        </div>

                        <div class="parameter-error-summary"></div>

                        <div id="update-parameters-container" class="space-y-4">

                        </div>


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
                            <p class="text-xs text-gray-500 mt-1">Select items to be deducted from stock when this test
                                is performed.</p>
                        </div>

                        <div class="inventory-error-summary"></div>

                        <div id="update-requirements-container" class="space-y-4">

                        </div>


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
            <div id="section-archived-tests" class="content-section hidden animate-fade-in w-full max-w-7xl mx-auto">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-red-50 text-red-500 flex items-center justify-center">
                            <i class="ph-duotone ph-trash text-2xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-extrabold text-gray-800">Archived Tests</h2>
                            <p class="text-sm text-gray-500 font-medium">Restore previously deleted tests</p>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white rounded-[1.25rem] shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-50 overflow-hidden w-full">
                    <div class="overflow-x-auto min-h-[250px]">
                        <table class="w-full text-left text-sm">
                            <thead class="text-xs text-gray-700 font-bold bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th scope="col" class="px-6 py-4">Test Name</th>
                                    <th scope="col" class="px-6 py-4">Code</th>
                                    <th scope="col" class="px-6 py-4">Status</th>
                                    <th scope="col" class="px-6 py-4 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="archived-tests-table">
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center text-gray-500 font-medium">
                                        <i class="ph-duotone ph-spinner animate-spin text-4xl mb-2 text-gray-400"></i>
                                        <p>Loading archived Tests.</p>
                                    </td>
                                </tr>
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
                        <p class="text-sm text-gray-500 font-medium">Manage email, password, and signature</p>
                    </div>
                </div>

                <div class="flex flex-col w-full gap-10">

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
                                            value="{{ auth()->user()->email ?? '' }}" placeholder="dr.smith@gmail.com"
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
                    <div class="flex flex-col gap-4 border-b border-gray-300 pb-10">
                        <div class="flex items-center gap-2">
                            <span
                                class="bg-gray-200 text-gray-700 w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold">3</span>
                            <h3 class="text-lg font-bold text-gray-800">Update Signature</h3>
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
                                        class="text-xs text-gray-800 font-bold mt-2">{{ auth()->user()->name ?? 'Dr. Smith' }}</span>
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
                        <p class="text-xs text-gray-500 font-medium" id="verifyModalSubtitle">Patient: Ali Khan | Test:
                            CBC</p>
                    </div>
                </div>
                <button id="CloseVerifyTestX"
                    class="text-gray-400 hover:text-gray-800 transition-colors cursor-pointer p-1"><i
                        class="ph ph-x text-xl"></i></button>
            </div>
            <div class="p-6 overflow-y-auto custom-scrollbar">
                <div id="verifyNotification" class="hidden mb-4 p-4 rounded-xl text-sm font-bold animate-fade-in"></div>
                <form id="VerifyTestForm" class="space-y-6">
                    <div class="border border-gray-200 rounded-xl overflow-hidden">
                        <table class="w-full text-sm text-left">
                            <thead id="verifyParametersTableHead" class="bg-gray-50 border-b border-gray-200 text-xs text-gray-700 font-bold">
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
                class="px-6 py-4 border-t border-gray-100 bg-gray-50/50 rounded-b-[1.25rem] flex items-center justify-end">
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


    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const userId = document.querySelector('meta[name="user-id"]')?.getAttribute('content');
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
            const fetchHeaders = {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            };

            let inventoryItemsList = [];
            let allTests = [];
            let hasSignature = false;
            function clearValidationErrors(form) {
                form.querySelectorAll('.validation-error').forEach(el => el.remove());
                form.querySelectorAll('.border-red-500').forEach(el => el.classList.remove('border-red-500'));
                const formAlert = form.querySelector('.form-general-error');
                if (formAlert) {
                    formAlert.classList.add('hidden');
                    formAlert.innerHTML = '';
                }
            }

            function displayValidationErrors(form, errors) {
                clearValidationErrors(form);

                const paramEntries = [];
                const inventoryEntries = [];
                const generalMessages = [];
                const paramSummary = form.querySelector('.parameter-error-summary');
                const inventorySummary = form.querySelector('.inventory-error-summary');
                const formAlert = form.querySelector('.form-general-error');

                for (const [key, messages] of Object.entries(errors)) {
                    let inputElement = null;

                    if (key.includes('.')) {
                        const [fieldName, index] = key.split('.');
                        const inputs = form.querySelectorAll(`[name="${fieldName}[]"]`);
                        if (inputs[index]) inputElement = inputs[index];
                    } else {
                        inputElement = form.querySelector(`[name="${key}"]`);
                    }

                    if (key.startsWith('parameter_')) {
                        messages.forEach(msg => {
                            paramEntries.push({ element: inputElement, message: msg, key: key });
                        });
                        if (inputElement) inputElement.classList.add('border-red-500');
                    } else if (key.startsWith('inventory_')) {
                        messages.forEach(msg => {
                            inventoryEntries.push({ element: inputElement, message: msg, key: key });
                        });
                        if (inputElement) inputElement.classList.add('border-red-500');
                    } else {
                        if (inputElement) {
                            inputElement.classList.add('border-red-500');
                            messages.forEach(msg => {
                                const errorText = document.createElement('p');
                                errorText.className = 'text-red-500 text-xs mt-1 font-bold validation-error animate-fade-in';
                                errorText.innerText = msg;
                                inputElement.parentNode.appendChild(errorText);
                            });
                        } else {
                            messages.forEach(msg => generalMessages.push(msg));
                        }
                    }
                }

                const sortEntries = (entries) => {
                    return entries.sort((a, b) => {
                        if (!a.element) return -1;
                        if (!b.element) return 1;
                        return a.element.compareDocumentPosition(b.element) & Node.DOCUMENT_POSITION_FOLLOWING ? -1 : 1;
                    });
                };

                const cleanMsg = (msg, key) => {
                    if (key.includes('.')) {
                        const [field, index] = key.split('.');
                        const rowNum = parseInt(index) + 1;
                        const readableField = field.replace('parameter_', '').replace('inventory_', '').replace('_', ' ');
                        const rawField = `${field}.${index}`;
                        let newMsg = msg.replace(rawField, readableField).replace(field, readableField);
                        return `Row ${rowNum}: ${newMsg}`;
                    }
                    return msg;
                };
                if (paramEntries.length > 0 && paramSummary) {
                    sortEntries(paramEntries);
                    const p = document.createElement('p');
                    p.className = 'text-red-500 text-sm font-bold validation-error animate-fade-in mb-4 bg-red-50 p-3 rounded-xl border border-red-100';
                    p.innerHTML = paramEntries.map(e => `• ${cleanMsg(e.message, e.key)}`).join('<br>');
                    paramSummary.appendChild(p);
                    setTimeout(() => {
                        if (p.parentNode) p.classList.add('opacity-0');
                        setTimeout(() => { if (p.parentNode) p.remove(); }, 300);
                    }, 3000);
                }
                if (inventoryEntries.length > 0 && inventorySummary) {
                    sortEntries(inventoryEntries);
                    const p = document.createElement('p');
                    p.className = 'text-red-500 text-sm font-bold validation-error animate-fade-in mb-4 bg-red-50 p-3 rounded-xl border border-red-100';
                    p.innerHTML = inventoryEntries.map(e => `• ${cleanMsg(e.message, e.key)}`).join('<br>');
                    inventorySummary.appendChild(p);
                    setTimeout(() => {
                        if (p.parentNode) p.classList.add('opacity-0');
                        setTimeout(() => { if (p.parentNode) p.remove(); }, 300);
                    }, 3000);
                }

                if (generalMessages.length > 0 && formAlert) {
                    formAlert.classList.remove('hidden');
                    formAlert.innerHTML = generalMessages.map(msg => `• ${msg}`).join('<br>');
                }
            }
            function getInventoryOptionsHTML() {
                if (inventoryItemsList.length === 0) {
                    return '<option value="" disabled selected>No inventory items found...</option>';
                }

                let html = '<option value="" disabled selected>Select an item...</option>';
                inventoryItemsList.forEach(item => {
                    const itemName = item.name || item.item_name || item.itemName || 'Unnamed Item';
                    html += `<option value="${item.id}">${itemName}</option>`;
                });
                return html;
            }

            async function loadInventoryItems() {
                if (inventoryItemsList.length > 0) return;

                try {
                    const response = await fetch('/InventoryItems', { headers: fetchHeaders });
                    const result = await response.json();

                    if (result.success === true) {
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
            async function fetchTests() {
                try {
                    const response = await fetch('/deprtmentTests', { headers: fetchHeaders });
                    const result = await response.json();

                    const tbody = document.getElementById('department-tests-table');
                    if (!tbody) return;

                    if (response.ok && result.status === true && result.data) {
                        allTests = result.data;
                        renderTestsTable(allTests);
                    } else {
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

                if (tests.length === 0) {
                    tbody.innerHTML = `
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500 font-medium">
                                <i class="ph-duotone ph-magnifying-glass text-4xl mb-2 text-gray-400"></i>
                                <p>No matching tests found.</p>
                            </td>
                        </tr>
                    `;
                    return;
                }

                tests.forEach(test => {
                    const statusBadge = test.isActive
                        ? '<span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs font-bold">Active</span>'
                        : '<span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-xs font-bold">Inactive</span>';

                    const row = `
                <tr class="bg-white border-b border-gray-100 hover:bg-gray-50 transition-colors text-gray-800 font-medium animate-fade-in">
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
            document.getElementById('test-search-input')?.addEventListener('input', (e) => {
                const query = e.target.value.toLowerCase().trim();

                const filteredTests = allTests.filter(test =>
                    (test.name && test.name.toLowerCase().includes(query)) ||
                    (test.code && test.code.toLowerCase().includes(query))
                );

                renderTestsTable(filteredTests);
            });
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

                    const targetId = link.getAttribute('data-target');
                    switchSection(targetId, link.getAttribute('data-title'));
                    if (targetId === 'section-dashboard') {
                        fetchPendingResults();
                    } else if (targetId === 'section-completed-reports') {
                        fetchCompletedReports();
                    } else if (targetId === 'section-manage-tests') {
                        fetchTests();
                    } else if (targetId === 'section-archived-tests') {
                        fetchArchivedTests();
                    } else if (targetId === 'section-add-test') {
                        loadInventoryItems();
                    } else if (targetId === 'section-settings') {
                        loadSignature();
                    }

                    if (window.innerWidth < 768) toggleSidebar();
                });
            });
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

            function showVerifyNotification(message, type = 'success') {
                const notify = document.getElementById('verifyNotification');
                if (!notify) return;
                
                notify.innerText = message;
                notify.classList.remove('hidden', 'bg-green-50', 'text-green-700', 'border-green-100', 'bg-red-50', 'text-red-700', 'border-red-100');
                
                if (type === 'success') {
                    notify.classList.add('bg-green-50', 'text-green-700', 'border', 'border-green-100');
                } else {
                    notify.classList.add('bg-red-50', 'text-red-700', 'border', 'border-red-100');
                }
                
                notify.classList.remove('hidden');
                setTimeout(() => notify.classList.add('hidden'), 5000);
            }

            function attachVerifyValidationListeners() {
                const inputs = document.querySelectorAll('#verifyResultsTbody .result-input[type="number"], #verifyResultsTbody .result-input[type="text"].quantitative-input');
                inputs.forEach(input => {
                    input.addEventListener('input', function () {
                        const tr = this.closest('tr');
                        const min = parseFloat(this.dataset.min);
                        const max = parseFloat(this.dataset.max);
                        const flagCell = tr.querySelector('.flag-cell');
                        if (!flagCell) return;

                        const val = parseFloat(this.value);
                        this.classList.remove('border-red-500', 'border-yellow-500', 'bg-red-50', 'bg-yellow-50');

                        if (isNaN(val)) {
                            this.dataset.flag = 'Normal';
                            flagCell.innerHTML = '<span class="text-gray-300 text-xs font-bold">—</span>';
                            return;
                        }

                        if (val < min) {
                            this.dataset.flag = 'Low';
                            this.classList.add('border-yellow-500', 'bg-yellow-50');
                            flagCell.innerHTML = '<span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded font-black text-xs border border-yellow-200">L</span>';
                        } else if (val > max) {
                            this.dataset.flag = 'High';
                            this.classList.add('border-red-500', 'bg-red-50');
                            flagCell.innerHTML = '<span class="bg-red-100 text-red-700 px-2 py-1 rounded font-black text-xs border border-red-200">H</span>';
                        } else {
                            this.dataset.flag = 'Normal';
                            flagCell.innerHTML = '<span class="text-green-500 text-xs font-bold"><i class="ph-bold ph-check"></i></span>';
                        }
                    });
                    // Trigger input to initial flag
                    input.dispatchEvent(new Event('input'));
                });
            }

            function showGlobalNotification(message, type = 'success') {
                const notify = document.getElementById('globalNotification');
                if (!notify) return;
                
                notify.innerText = message;
                notify.classList.remove('hidden', 'bg-green-50', 'text-green-700', 'border-green-100', 'bg-red-50', 'text-red-700', 'border-red-100');
                
                if (type === 'success') {
                    notify.classList.add('bg-green-50', 'text-green-700', 'border', 'border-green-100');
                } else {
                    notify.classList.add('bg-red-50', 'text-red-700', 'border', 'border-red-100');
                }
                
                notify.classList.remove('hidden');
                setTimeout(() => notify.classList.add('hidden'), 5000);
            }

            document.addEventListener('click', async (e) => {
                if (e.target.closest('.btn-open-verify')) {
                    const btn = e.target.closest('.btn-open-verify');
                    const orderTestId = btn.dataset.orderTestId;
                    const patientName = btn.dataset.patientName;
                    const testName = btn.dataset.testName;

                    document.getElementById('verifyModalSubtitle').innerText = `Patient: ${patientName} | Test: ${testName}`;
                    const tbody = document.getElementById('verifyResultsTbody');
                    const thead = document.getElementById('verifyParametersTableHead');
                    
                    tbody.innerHTML = '<tr><td colspan="5" class="px-4 py-4 text-center text-gray-500">Loading results...</td></tr>';
                    thead.innerHTML = '';
                    document.getElementById('VerifyTestForm').dataset.orderTestId = orderTestId;

                    openModal('VerifyTestModalBackdrop', 'VerifyTestModal');

                    try {
                        const res = await fetch(`/getResultsByOrderTestId/${orderTestId}`, { headers: fetchHeaders });
                        const result = await res.json();
                        if (result.status === 200 && Array.isArray(result.data)) {
                            tbody.innerHTML = '';
                            
                            if (result.data.length > 0) {
                                // Check if any parameter is quantitative to decide on the Flag column
                                const hasQuantitative = result.data.some(item => {
                                    const type = (item.parameter?.inputType || item.parameter?.type || '').toLowerCase().trim();
                                    return type === 'quantitative' || type === ''; // Default is quantitative
                                });
                                
                                if (hasQuantitative) {
                                    thead.innerHTML = `
                                        <tr>
                                            <th class="px-4 py-3">Parameter</th>
                                            <th class="px-4 py-3">Result Value</th>
                                            <th class="px-4 py-3">Unit</th>
                                            <th class="px-4 py-3">Normal Range</th>
                                            <th class="px-4 py-3 text-center">Flag</th>
                                        </tr>`;
                                } else {
                                    thead.innerHTML = `
                                        <tr>
                                            <th class="px-4 py-3">Parameter</th>
                                            <th class="px-4 py-3">Result Value</th>
                                            <th class="px-4 py-3">Unit</th>
                                            <th class="px-4 py-3">Normal Range</th>
                                        </tr>`;
                                }

                                result.data.forEach(item => {
                                    const type = (item.parameter?.inputType || item.parameter?.type || 'quantitative').toLowerCase().trim();
                                    const paramName = item.parameter?.parameterName || 'N/A';
                                    const unit = item.parameter?.unit || '';
                                    const range = item.parameter?.normalRange || '';
                                    const val = item.resultValue || '';
                                    const currentFlag = item.statusFlag || 'Normal';

                                    let inputHtml = '';
                                    let flagCellHtml = '';

                                    if (type === 'quantitative') {
                                        let min = null, max = null;
                                        if (range && range.includes('-')) {
                                            const parts = range.split('-');
                                            min = parseFloat(parts[0]);
                                            max = parseFloat(parts[1]);
                                        }
                                        inputHtml = `<input type="number" step="0.01" value="${val}" 
                                            data-min="${min}" data-max="${max}" data-flag="${currentFlag}"
                                            class="result-input quantitative-input w-24 border border-gray-200 rounded-md px-2 py-1 text-sm focus:ring-2 focus:ring-blue-100 outline-none font-bold">`;
                                        flagCellHtml = `<td class="px-4 py-3 text-center flag-cell align-top pt-4"></td>`;

                                    } else if (type === 'qualitative') {
                                        let optionsList = item.parameter?.options ? item.parameter.options : 'Positive,Negative';
                                        let optionsHtml = `<option value="">Select Result...</option>`;
                                        let finalOptions = Array.isArray(optionsList) ? optionsList : (typeof optionsList === 'string' ? optionsList.split(',') : []);

                                        finalOptions.forEach(opt => {
                                            const o = typeof opt === 'string' ? opt.trim() : opt;
                                            if (o) {
                                                const selected = (val == o) ? 'selected' : '';
                                                optionsHtml += `<option value="${o}" ${selected}>${o}</option>`;
                                            }
                                        });
                                        inputHtml = `<select class="result-input w-full border border-gray-200 rounded-md px-2 py-1 text-sm focus:ring-2 focus:ring-blue-100 outline-none bg-white font-bold">${optionsHtml}</select>`;

                                    } else if (type === 'observational') {
                                        inputHtml = `<textarea class="result-input w-full border border-gray-200 rounded-md px-2 py-1 text-sm focus:ring-2 focus:ring-blue-100 outline-none custom-scrollbar font-bold" rows="2">${val}</textarea>`;

                                    } else if (type === 'image') {
                                        let imagesHtml = '';
                                        try {
                                            const paths = typeof val === 'string' && val.startsWith('[') ? JSON.parse(val) : val;
                                            if (Array.isArray(paths)) {
                                                paths.forEach(path => {
                                                    imagesHtml += `<a href="/${path.replace(/^\//, '')}" target="_blank" class="bg-blue-50 text-blue-600 px-3 py-1 rounded-md text-xs font-bold border border-blue-200 hover:bg-blue-100 transition-colors inline-block mr-2 mt-1"><i class="ph-bold ph-image"></i> View Image</a>`;
                                                });
                                            }
                                        } catch (e) {
                                            imagesHtml = `<span class="text-xs text-gray-400">No images attached</span>`;
                                        }

                                        inputHtml = `
                                            <div class="flex flex-wrap gap-2">${imagesHtml}</div>
                                            <input type="hidden" value='${val}' class="result-input">`;
                                    } else {
                                        inputHtml = `<input type="text" value="${val}" class="result-input w-24 border border-gray-200 rounded-md px-2 py-1 text-sm font-bold">`;
                                    }

                                    const row = `
                                        <tr data-result-id="${item.id}">
                                            <td class="px-4 py-3 font-bold align-top pt-4 text-gray-800">${paramName}</td>
                                            <td class="px-4 py-3 align-top">${inputHtml}</td>
                                            <td class="px-4 py-3 text-gray-500 align-top pt-4 font-medium">${unit}</td>
                                            <td class="px-4 py-3 text-gray-500 align-top pt-4 font-medium">${range}</td>
                                            ${flagCellHtml}
                                        </tr>`;
                                    tbody.insertAdjacentHTML('beforeend', row);
                                });
                                attachVerifyValidationListeners();
                            } else {
                                tbody.innerHTML = '<tr><td colspan="5" class="px-4 py-4 text-center text-gray-500 font-bold">No results found for this test.</td></tr>';
                            }
                        } else {
                            tbody.innerHTML = '<tr><td colspan="5" class="px-4 py-4 text-center text-red-500 font-bold">Failed to load results.</td></tr>';
                        }
                    } catch (err) {
                        console.error(err);
                        tbody.innerHTML = '<tr><td colspan="5" class="px-4 py-4 text-center text-red-500">Error loading results.</td></tr>';
                    }
                }
            });

            document.getElementById('clinicalRemarksTemplate')?.addEventListener('change', function () {
                document.getElementById('verifyRemarks').value = this.value;
            });

            document.getElementById('BtnVerifyAndSign')?.addEventListener('click', async function () {
                const form = document.getElementById('VerifyTestForm');
                const orderTestId = form.dataset.orderTestId;
                const rows = document.querySelectorAll('#verifyResultsTbody tr[data-result-id]');
                const results = [];

                rows.forEach(row => {
                    const input = row.querySelector('.result-input');
                    results.push({
                        id: row.dataset.resultId,
                        resultValue: input ? input.value : null,
                        statusFlag: input ? (input.dataset.flag || 'Normal') : 'Normal'
                    });
                });

                const payload = {
                    orderTestId: orderTestId,
                    results: results,
                    remarks: document.getElementById('verifyRemarks').value,
                    alertPatient: document.getElementById('criticalFlag').checked
                };

                const originalText = this.innerText;
                this.innerHTML = '<i class="ph ph-spinner animate-spin"></i> Verifying...';
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
                        showVerifyNotification('Verified successfully!', 'success');
                        setTimeout(() => {
                            closeModal('VerifyTestModalBackdrop', 'VerifyTestModal');
                            fetchPendingResults();
                            fetchCompletedReports();
                        }, 1000);
                    } else {
                        showVerifyNotification(res.message || 'Verification failed', 'error');
                    }
                } catch (err) {
                    console.error(err);
                    showVerifyNotification('An error occurred during verification.', 'error');
                } finally {
                    this.innerText = originalText;
                    this.disabled = false;
                }
            });

            document.getElementById('CloseVerifyTestX')?.addEventListener('click', () => closeModal('VerifyTestModalBackdrop', 'VerifyTestModal'));
            document.getElementById('CloseVerifyTestBtn')?.addEventListener('click', () => closeModal('VerifyTestModalBackdrop', 'VerifyTestModal'));
            
            document.querySelectorAll('.btn-view-report').forEach(btn => btn.addEventListener('click', () => openModal('ViewReportModalBackdrop', 'ViewReportModal')));
            document.getElementById('CloseViewReportX')?.addEventListener('click', () => closeModal('ViewReportModalBackdrop', 'ViewReportModal'));
            document.getElementById('CloseViewReportBtn')?.addEventListener('click', () => closeModal('ViewReportModalBackdrop', 'ViewReportModal'));
            function setupDynamicFields(containerId, addBtnId, isUpdate) {
                const container = document.getElementById(containerId);
                const addBtn = document.getElementById(addBtnId);
                if (!container || !addBtn) return;

                const focusColor = isUpdate ? 'teal' : 'purple';
                const isParameter = containerId.includes('parameters');

                addBtn.addEventListener('click', () => {
                    if (isParameter) {
                        const firstSelect = container.querySelector('.parameter-type-select');
                        const currentType = firstSelect ? firstSelect.value : 'Quantitative';

                        const numberHidden = currentType === 'Quantitative' ? '' : 'hidden';
                        const dropdownHidden = currentType === 'Qualitative' ? '' : 'hidden';

                        const templateHTML = `
                        <div class="flex gap-4 items-start bg-gray-50 p-4 rounded-xl border border-gray-100 parameter-row animate-fade-in">
                            <div class="w-36">
                                <label class="block text-xs font-bold text-gray-600 mb-1">Test Type *</label>
                                <select class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm bg-gray-100 cursor-not-allowed text-gray-500" disabled>
                                    <option value="${currentType}">${currentType}</option>
                                </select>
                                <input type="hidden" name="parameter_type[]" value="${currentType}">
                            </div>
                            <div class="flex-1">
                                <label class="block text-xs font-bold text-gray-600 mb-1">Parameter Name *</label>
                                <input type="text" name="parameter_name[]" placeholder="e.g. Parameter" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-${focusColor}-100 outline-none bg-white">
                            </div>
                            <div class="w-24 param-number-fields ${numberHidden}">
                                <label class="block text-xs font-bold text-gray-600 mb-1">Unit</label>
                                <input type="text" name="parameter_unit[]" placeholder="unit" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-${focusColor}-100 outline-none bg-white">
                            </div>
                            <div class="flex-1 param-number-fields ${numberHidden}">
                                <label class="block text-xs font-bold text-gray-600 mb-1">Normal Range</label>
                                <input type="text" name="parameter_range[]" placeholder="range" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-${focusColor}-100 outline-none bg-white">
                            </div>
                            <div class="flex-1 param-dropdown-fields ${dropdownHidden}">
                                <label class="block text-xs font-bold text-gray-600 mb-1">Options (Comma separated)</label>
                                <input type="text" placeholder="e.g. Positive, Negative" name="parameter_options[]"
                                    class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-${focusColor}-100 outline-none bg-white">
                            </div>
                            <div class="pt-6">
                                <button type="button" class="text-red-400 hover:text-red-600 p-2 btn-remove-row"><i class="ph-bold ph-trash"></i></button>
                            </div>
                        </div>`;
                        container.insertAdjacentHTML('beforeend', templateHTML);
                    } else {
                        const templateHTML = `
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
                    }
                });

                container.addEventListener('click', (e) => {
                    const removeBtn = e.target.closest('.btn-remove-row');
                    if (removeBtn) {
                        const row = removeBtn.closest('.parameter-row, .requirement-row');
                        if (row) row.remove();
                    }
                });

                container.addEventListener('focusin', (e) => {
                    if (e.target.classList.contains('parameter-type-select')) {
                        e.target.dataset.prev = e.target.value;
                    }
                });

                container.addEventListener('change', (e) => {
                    if (e.target.classList.contains('parameter-type-select')) {
                        const allRows = container.querySelectorAll('.parameter-row');

                        if (allRows.length > 1) {
                            if (!confirm('Changing the Test Type will delete all other parameters. Continue?')) {
                                e.target.value = e.target.dataset.prev;
                                return;
                            }
                            for (let i = 1; i < allRows.length; i++) {
                                allRows[i].remove();
                            }
                        }

                        e.target.dataset.prev = e.target.value;
                        const row = e.target.closest('.parameter-row');
                        const val = e.target.value;

                        const numberFields = row.querySelectorAll('.param-number-fields');
                        const dropdownFields = row.querySelector('.param-dropdown-fields');

                        if (val === 'Quantitative') {
                            numberFields.forEach(f => f.classList.remove('hidden'));
                            if (dropdownFields) dropdownFields.classList.add('hidden');
                        } else if (val === 'Qualitative') {
                            numberFields.forEach(f => f.classList.add('hidden'));
                            if (dropdownFields) dropdownFields.classList.remove('hidden');
                        } else if (val === 'Observational' || val === 'Image') {
                            numberFields.forEach(f => f.classList.add('hidden'));
                            if (dropdownFields) dropdownFields.classList.add('hidden');
                        }
                    }
                });
            }

            setupDynamicFields('add-parameters-container', 'btn-add-parameter', false);
            setupDynamicFields('add-requirements-container', 'btn-add-item', false);
            setupDynamicFields('update-parameters-container', 'btn-update-add-parameter', true);
            setupDynamicFields('update-requirements-container', 'btn-update-add-item', true);
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

            const btnSaveTest = document.querySelector('#AddTestFormSection button.bg-sidebarBg');

            if (btnSaveTest) {
                btnSaveTest.addEventListener('click', async () => {
                    const form = document.getElementById('AddTestFormSection');
                    const formData = new FormData(form);

                    clearValidationErrors(form);
                    const paramRows = form.querySelectorAll('.parameter-row');
                    const invRows = form.querySelectorAll('.requirement-row');
                    const validationErrors = {};

                    if (paramRows.length === 0) {
                        validationErrors['parameter_general'] = ['At least one medical parameter is required.'];
                    } else {
                        paramRows.forEach((row, i) => {
                            const nameInput = row.querySelector('input[name="parameter_name[]"]');
                            if (!nameInput.value.trim()) {
                                validationErrors[`parameter_name.${i}`] = ['Parameter name is required.'];
                            }
                        });
                    }

                    if (invRows.length === 0) {
                        validationErrors['inventory_general'] = ['At least one inventory item is required.'];
                    } else {
                        invRows.forEach((row, i) => {
                            const itemSelect = row.querySelector('select[name="inventory_item[]"]');
                            const qtyInput = row.querySelector('input[name="inventory_quantity[]"]');
                            if (!itemSelect.value || !qtyInput.value || qtyInput.value <= 0) {
                                validationErrors[`inventory_row.${i}`] = ['Please select an item and enter a valid quantity.'];
                            }
                        });
                    }

                    if (Object.keys(validationErrors).length > 0) {
                        displayValidationErrors(form, validationErrors);
                        return;
                    }

                    const originalText = btnSaveTest.innerText;
                    btnSaveTest.innerHTML = '<i class="ph ph-spinner animate-spin text-lg"></i> Saving...';
                    btnSaveTest.disabled = true;

                    try {
                        const response = await fetch('/tests/add', {
                            method: 'POST',
                            headers: fetchHeaders,
                            body: formData
                        });

                        const result = await response.json();

                        if (response.status === 422) {
                            displayValidationErrors(form, result.errors);
                            const firstError = form.querySelector('.border-red-500');
                            if (firstError) {
                                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                            }
                        }
                        else if (response.ok && (result.status === true || response.status === 201)) {
                            backToTestsList();
                            fetchTests();
                        }
                        else {
                            displayValidationErrors(form, { general: [result.message || 'A server error occurred. Please try again.'] });
                        }
                    } catch (error) {
                        console.error('Error in Add API Call:', error);
                    } finally {
                        btnSaveTest.innerText = originalText;
                        btnSaveTest.disabled = false;
                    }
                });
            }
            document.getElementById('department-tests-table')?.addEventListener('click', async (e) => {
                if (e.target.closest('.btn-edit-test')) {
                    const testId = e.target.closest('.btn-edit-test').dataset.id;
                    const form = document.getElementById('UpdateTestFormSection');
                    form.dataset.testId = testId;
                    clearValidationErrors(form);

                    await loadInventoryItems();

                    try {
                        const response = await fetch(`/tests/${testId}`, { headers: fetchHeaders });
                        const result = await response.json();

                        if (result.status === true) {
                            const test = result.data;
                            form.querySelector('input[name="name"]').value = test.name || '';
                            form.querySelector('input[name="code"]').value = test.code || '';
                            form.querySelector('input[name="price"]').value = test.price || '';
                            form.querySelector('input[name="type"]').value = test.sampleType || '';
                            form.querySelector('input[name="time"]').value = test.resultHours || '';
                            form.querySelector('textarea[name="instructions"]').value = test.instructions || '';
                            form.querySelector('textarea[name="instructionsForTechnicianAndSampleCollector"]').value = test.instructions_sample_collector || test['Instructions(SampleCollector)'] || test.instructionsForTechnicianAndSampleCollector || '';

                            form.querySelector('input[name="is_active"]').checked = test.isActive;

                            const paramsContainer = document.getElementById('update-parameters-container');
                            paramsContainer.innerHTML = '';
                            if (test.parameters?.length) {
                                test.parameters.forEach((param, index) => {
                                    const type = param.inputType || 'Quantitative';
                                    const numberHidden = type === 'Quantitative' ? '' : 'hidden';
                                    const dropdownHidden = type === 'Qualitative' ? '' : 'hidden';

                                    const typeSelectHTML = index === 0
                                        ? `<select name="parameter_type[]" class="parameter-type-select w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-teal-100 outline-none bg-white cursor-pointer">
                                            <option value="Quantitative" ${type === 'Quantitative' ? 'selected' : ''}>Quantitative</option>
                                            <option value="Qualitative" ${type === 'Qualitative' ? 'selected' : ''}>Qualitative</option>
                                            <option value="Observational" ${type === 'Observational' ? 'selected' : ''}>Observational</option>
                                            <option value="Image" ${type === 'Image' ? 'selected' : ''}>Image</option>
                                          </select>`
                                        : `<select class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm bg-gray-100 cursor-not-allowed text-gray-500" disabled>
                                            <option value="${type}">${type}</option>
                                          </select>
                                          <input type="hidden" name="parameter_type[]" value="${type}">`;

                                    paramsContainer.insertAdjacentHTML('beforeend', `
                                    <div class="flex gap-4 items-start bg-gray-50 p-4 rounded-xl border border-gray-100 parameter-row animate-fade-in">
                                        <div class="w-36">
                                            <label class="block text-xs font-bold text-gray-600 mb-1">Test Type *</label>
                                            ${typeSelectHTML}
                                        </div>
                                        <div class="flex-1">
                                            <label class="block text-xs font-bold text-gray-600 mb-1">Parameter Name *</label>
                                            <input type="text" name="parameter_name[]" value="${param.parameterName}" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-teal-100 outline-none bg-white">
                                        </div>
                                        <div class="w-24 param-number-fields ${numberHidden}">
                                            <label class="block text-xs font-bold text-gray-600 mb-1">Unit</label>
                                            <input type="text" name="parameter_unit[]" value="${param.unit || ''}" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-teal-100 outline-none bg-white">
                                        </div>
                                        <div class="flex-1 param-number-fields ${numberHidden}">
                                            <label class="block text-xs font-bold text-gray-600 mb-1">Normal Range</label>
                                            <input type="text" name="parameter_range[]" value="${param.normalRange || ''}" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-teal-100 outline-none bg-white">
                                        </div>
                                        <div class="flex-1 param-dropdown-fields ${dropdownHidden}">
                                            <label class="block text-xs font-bold text-gray-600 mb-1">Options (Comma separated)</label>
                                            <input type="text" name="parameter_options[]" value="${param.options || ''}" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-teal-100 outline-none bg-white">
                                        </div>
                                        <div class="pt-6">
                                            <button type="button" class="text-red-400 hover:text-red-600 p-2 btn-remove-row"><i class="ph-bold ph-trash"></i></button>
                                        </div>
                                    </div>`);
                                });
                            }

                            const reqContainer = document.getElementById('update-requirements-container');
                            reqContainer.innerHTML = '';
                            if (test.requirements?.length) {
                                test.requirements.forEach(req => {
                                    const cleanQty = Math.round(parseFloat(req.quantityUsed)) || 1;

                                    reqContainer.insertAdjacentHTML('beforeend', `
                                    <div class="flex gap-4 items-end bg-gray-50 p-4 rounded-xl border border-gray-100 requirement-row animate-fade-in">
                                        <div class="flex-1">
                                            <label class="block text-xs font-bold text-gray-600 mb-1">Inventory Item *</label>
                                            <select name="inventory_item[]" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-teal-100 outline-none bg-white cursor-pointer" data-selected="${req.inventoryId}">
                                                ${getInventoryOptionsHTML()}
                                            </select>
                                        </div>
                                        <div class="w-32">
                                            <label class="block text-xs font-bold text-gray-600 mb-1">Qty Used *</label>
                                            <input type="number" name="inventory_quantity[]" value="${cleanQty}" min="1" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-teal-100 outline-none bg-white">
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
                            console.error('Fetch Error:', result.message);
                        }
                    } catch (error) {
                        console.error('Error fetching test:', error);
                    }
                }

                if (e.target.closest('.btn-delete-test')) {
                    const btn = e.target.closest('.btn-delete-test');
                    const testId = btn.dataset.id;
                    const row = btn.closest('tr');

                    try {
                        const response = await fetch(`/tests/${testId}`, { method: 'DELETE', headers: fetchHeaders });
                        const result = await response.json();
                        if (result.status === true) {
                            allTests = allTests.filter(t => t.id != testId);
                            row.classList.add('opacity-0', 'scale-95', 'transition-all', 'duration-300');
                            setTimeout(() => row.remove(), 300);
                        }
                    } catch (error) {
                        console.error('Error deleting test:', error);
                    }
                }
            });
            const btnUpdateSubmit = document.querySelector('#UpdateTestFormSection button.bg-teal-600');
            if (btnUpdateSubmit) {
                btnUpdateSubmit.addEventListener('click', async () => {
                    const form = document.getElementById('UpdateTestFormSection');
                    const testId = form.dataset.testId;
                    if (!testId) return;

                    const formData = new FormData(form);
                    formData.append('_method', 'PUT');
                    clearValidationErrors(form);
                    const paramRows = form.querySelectorAll('.parameter-row');
                    const invRows = form.querySelectorAll('.requirement-row');
                    const validationErrors = {};

                    if (paramRows.length === 0) {
                        validationErrors['parameter_general'] = ['At least one medical parameter is required.'];
                    } else {
                        paramRows.forEach((row, i) => {
                            const nameInput = row.querySelector('input[name="parameter_name[]"]');
                            if (!nameInput.value.trim()) {
                                validationErrors[`parameter_name.${i}`] = ['Parameter name is required.'];
                            }
                        });
                    }

                    if (invRows.length === 0) {
                        validationErrors['inventory_general'] = ['At least one inventory item is required.'];
                    } else {
                        invRows.forEach((row, i) => {
                            const itemSelect = row.querySelector('select[name="inventory_item[]"]');
                            const qtyInput = row.querySelector('input[name="inventory_quantity[]"]');
                            if (!itemSelect.value || !qtyInput.value || qtyInput.value <= 0) {
                                validationErrors[`inventory_row.${i}`] = ['Please select an item and enter a valid quantity.'];
                            }
                        });
                    }

                    if (Object.keys(validationErrors).length > 0) {
                        displayValidationErrors(form, validationErrors);
                        return;
                    }

                    const originalText = btnUpdateSubmit.innerText;
                    btnUpdateSubmit.innerHTML = '<i class="ph ph-spinner animate-spin text-lg"></i> Updating...';
                    btnUpdateSubmit.disabled = true;

                    try {
                        const response = await fetch(`/tests/${testId}`, {
                            method: 'POST',
                            headers: fetchHeaders,
                            body: formData
                        });
                        const result = await response.json();

                        if (response.status === 422) {
                            displayValidationErrors(form, result.errors);
                            const firstError = form.querySelector('.border-red-500');
                            if (firstError) {
                                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                            }
                        }
                        else if (response.ok && result.status === true) {
                            backToTestsList();
                            fetchTests();
                        } else {
                            displayValidationErrors(form, { general: [result.message || 'A server error occurred. Please try again.'] });
                        }
                    } catch (error) {
                        console.error('Error updating test:', error);
                        displayValidationErrors(form, { general: ['A network error occurred. Please check your connection.'] });
                    } finally {
                        btnUpdateSubmit.innerText = originalText;
                        btnUpdateSubmit.disabled = false;
                    }
                });
            }
            async function fetchPendingResults() {
                try {
                    const response = await fetch('/getPendingResultList', { headers: fetchHeaders });
                    const result = await response.json();
                    const tbody = document.getElementById('pending-results-table');
                    if (!tbody) return;

                    tbody.innerHTML = '';

                    if (response.ok && result.status === true && result.data && result.data.length > 0) {
                        result.data.forEach(order => {
                            order.tests.forEach(test => {
                                const row = `
                                    <tr class="bg-white border-b border-gray-100 hover:bg-gray-50 transition-colors text-gray-800 font-medium animate-fade-in">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-2">
                                                <span class="w-2 h-2 rounded-full bg-orange-400"></span>
                                                <span class="text-xs text-gray-400"><b class="text-gray-600">Receipt</b>-${test.pivot.id}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">${order.name}</td>
                                        <td class="px-6 py-4 font-bold text-gray-900">${test.name}</td>
                                        <td class="px-6 py-4">
                                            <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-[10px] font-bold uppercase tracking-wider">${test.sampleType || 'N/A'}</span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <button data-order-test-id="${test.pivot.id}"
                                                data-patient-name="${order.name}"
                                                data-test-name="${test.name}"
                                                class="btn-open-verify bg-sidebarBg hover:bg-gray-800 text-white px-4 py-2 rounded-lg text-xs font-bold transition-all hover:shadow-md cursor-pointer active:scale-95">
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
                                <td colspan="5" class="px-6 py-20 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-20 h-20 bg-orange-50 rounded-full flex items-center justify-center mb-4">
                                            <i class="ph-duotone ph-flask text-4xl text-orange-400 animate-pulse"></i>
                                        </div>
                                        <h3 class="text-lg font-bold text-gray-900">No Pending Tests</h3>
                                        <p class="text-gray-500 text-sm mt-1 max-w-xs mx-auto">There are currently no tests awaiting your review. Great job!</p>
                                    </div>
                                </td>
                            </tr>
                        `;
                    }
                } catch (error) {
                    console.error('Error fetching pending results:', error);
                }
            }

            async function fetchCompletedReports() {
                try {
                    const response = await fetch('/getCompletedReports', { headers: fetchHeaders });
                    const result = await response.json();
                    const tbody = document.getElementById('completed-reports-table');
                    if (!tbody) return;

                    tbody.innerHTML = '';

                    if (response.ok && result.status === true && result.data && result.data.length > 0) {
                        result.data.forEach(order => {
                            const testsCount = order.tests ? order.tests.length : 0;
                            const row = `
                                <tr class="bg-white border-b border-gray-100 hover:bg-gray-50 transition-colors text-gray-800 font-medium animate-fade-in">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <span class="w-2 h-2 rounded-full bg-green-400"></span>
                                            <span class="text-xs text-gray-400"><b class="text-gray-600">Receipt</b>-${order.id}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">${order.name}</td>
                                    <td class="px-6 py-4">
                                        <span class="font-bold text-gray-700">${testsCount}</span>
                                        <span class="text-xs text-gray-400 ml-1">Tests</span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <span class="bg-green-50 text-green-600 px-3 py-1 rounded-full text-xs font-bold border border-green-100">
                                            Completed
                                        </span>
                                    </td>
                                </tr>`;
                            tbody.insertAdjacentHTML('beforeend', row);
                        });
                    } else {
                        tbody.innerHTML = `
                            <tr>
                                <td colspan="4" class="px-6 py-20 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-20 h-20 bg-green-50 rounded-full flex items-center justify-center mb-4">
                                            <i class="ph-duotone ph-check-circle text-4xl text-green-500"></i>
                                        </div>
                                        <h3 class="text-lg font-bold text-gray-900">No Completed Reports</h3>
                                        <p class="text-gray-500 text-sm mt-1 max-w-xs mx-auto">You haven't completed any reports today. Once you verify tests, they will appear here.</p>
                                    </div>
                                </td>
                            </tr>
                        `;
                    }
                } catch (error) {
                    console.error('Error fetching completed reports:', error);
                }
            }

            fetchPendingResults();
            function displaySignatureMessage(message, isError = false) {
                let msgContainer = document.getElementById('signature-message');

                if (!msgContainer) {
                    msgContainer = document.createElement('div');
                    msgContainer.id = 'signature-message';
                    const sigUploadSection = document.getElementById('sigUploadState').parentElement;
                    sigUploadSection.insertBefore(msgContainer, sigUploadSection.firstChild);
                }

                msgContainer.className = 'w-full mb-4 px-4 py-2 rounded-lg text-sm font-bold text-center animate-fade-in';

                if (isError) {
                    msgContainer.classList.add('bg-red-50', 'text-red-600', 'border', 'border-red-200');
                } else {
                    msgContainer.classList.add('bg-green-50', 'text-green-600', 'border', 'border-green-200');
                }

                msgContainer.innerText = message;
                msgContainer.style.display = 'block';

                setTimeout(() => {
                    msgContainer.style.display = 'none';
                }, 5000);
            }

            const sigUploadState = document.getElementById('sigUploadState');
            const sigPreviewState = document.getElementById('sigPreviewState');
            const sigPreviewImage = document.getElementById('sigPreviewImage');
            const signatureFileInput = document.getElementById('signatureFileInput');

            async function loadSignature() {
                try {
                    const res = await fetch(`/user/${userId}/signature`, {
                        headers: { 'Accept': 'application/json' }
                    });
                    const responseData = await res.json();

                    if (responseData.success && responseData.data && responseData.data.signature) {
                        hasSignature = true;
                        sigPreviewImage.src = '/' + responseData.data.signature.replace(/^\//, '');
                        sigUploadState.classList.add('hidden');
                        sigPreviewState.classList.remove('hidden');
                        sigPreviewState.classList.add('flex');
                    } else {
                        hasSignature = false;
                        sigUploadState.classList.remove('hidden');
                        sigPreviewState.classList.add('hidden');
                        sigPreviewState.classList.remove('flex');
                    }
                } catch (e) {
                    console.error('Error loading signature:', e);
                    displaySignatureMessage('Failed to connect to the server to load signature.', true);
                }
            }

            document.getElementById('btnUploadNewSig')?.addEventListener('click', () => signatureFileInput.click());
            document.getElementById('btnChangeSig')?.addEventListener('click', () => signatureFileInput.click());

            signatureFileInput?.addEventListener('change', async (e) => {
                const file = e.target.files[0];
                if (!file) return;

                const formData = new FormData();
                formData.append('signature', file);

                const btn = document.getElementById('btnUploadNewSig');
                const originalText = btn ? btn.innerText : 'Upload';
                if (btn) btn.innerText = 'Uploading...';

                const msgContainer = document.getElementById('signature-message');
                if (msgContainer) msgContainer.style.display = 'none';

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

                    if (response.status === 422) {
                        displaySignatureMessage(result.errors.signature[0], true);
                    }
                    else if (response.ok && result.success) {
                        displaySignatureMessage(result.message || 'Signature updated successfully!', false);
                        loadSignature();
                    }
                    else {
                        displaySignatureMessage(result.message || 'Error uploading signature.', true);
                    }
                } catch (error) {
                    console.error('Upload Error:', error);
                    displaySignatureMessage('A network error occurred while uploading.', true);
                } finally {
                    if (btn) btn.innerText = originalText;
                    signatureFileInput.value = '';
                }
            });

            document.getElementById('btnDeleteSig')?.addEventListener('click', async () => {
                try {
                    const response = await fetch(`/user/${userId}/signature`, {
                        method: 'DELETE',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        }
                    });

                    const result = await response.json();

                    if (response.ok && result.success) {
                        displaySignatureMessage(result.message || 'Signature deleted successfully.', false);
                        sigPreviewImage.src = '';
                        sigPreviewState.classList.add('hidden');
                        sigPreviewState.classList.remove('flex');
                        sigUploadState.classList.remove('hidden');
                        hasSignature = false;
                    } else {
                        displaySignatureMessage(result.message || 'Failed to delete signature.', true);
                    }
                } catch (e) {
                    console.error('Delete Error:', e);
                    displaySignatureMessage('A network error occurred while deleting.', true);
                }
            });
            async function fetchArchivedTests() {
                try {
                    const response = await fetch('/tests/trashed', { headers: fetchHeaders });
                    const result = await response.json();

                    const tbody = document.getElementById('archived-tests-table');
                    if (!tbody) return;
                    tbody.innerHTML = '';

                    if (response.ok && result.status === true && result.data && result.data.length > 0) {
                        result.data.forEach(test => {
                            const row = `
                                <tr class="bg-white border-b border-gray-100 hover:bg-gray-50 text-gray-800 font-medium animate-fade-in">
                                    <td class="px-6 py-4">${test.name}</td>
                                    <td class="px-6 py-4 text-gray-500">${test.code}</td>
                                    <td class="px-6 py-4">
                                        <span class="bg-red-50 text-red-600 px-3 py-1 rounded-full text-xs font-bold border border-red-100">Archived</span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <button data-id="${test.id}" class="btn-restore-test bg-green-50 hover:bg-green-100 text-green-700 px-4 py-2 rounded-lg text-xs font-bold transition-colors cursor-pointer border border-green-200 shadow-sm flex items-center justify-center gap-1 ml-auto">
                                             Restore
                                        </button>
                                    </td>
                                </tr>`;
                            tbody.insertAdjacentHTML('beforeend', row);
                        });
                    } else {
                        tbody.innerHTML = `
                            <tr>
                                <td colspan="4" class="px-6 py-16 text-center text-gray-500 font-medium">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                            <i class="ph-duotone ph-folder-dashed text-4xl text-gray-400"></i>
                                        </div>
                                        <h3 class="text-lg font-bold text-gray-800">No archived or deleted tests found</h3>
                                        <p class="text-gray-400 text-sm mt-1 max-w-xs mx-auto">Any tests you delete from the Manage Tests tab will appear here.</p>
                                    </div>
                                </td>
                            </tr>`;
                    }
                } catch (error) {
                    console.error('Error fetching archived tests:', error);
                }
            }
            document.addEventListener('click', async (e) => {
                if (e.target.closest('.btn-restore-test')) {
                    const btn = e.target.closest('.btn-restore-test');
                    const testId = btn.dataset.id;
                    const row = btn.closest('tr');

                    const originalText = btn.innerHTML;
                    btn.innerHTML = '<i class="ph ph-spinner animate-spin"></i>';
                    btn.disabled = true;

                    try {
                        const response = await fetch(`/tests/${testId}/restore`, {
                            method: 'POST',
                            headers: fetchHeaders
                        });
                        const result = await response.json();

                        if (result.status === true) {
                            showGlobalNotification('Test restored successfully.', 'success');
                            row.classList.add('opacity-0', 'scale-95', 'transition-all', 'duration-300');
                            setTimeout(() => row.remove(), 300);

                            fetchTests();
                        } else {
                            showGlobalNotification(result.message || 'Failed to restore test.', 'error');
                            btn.innerHTML = originalText;
                            btn.disabled = false;
                        }
                    } catch (error) {
                        console.error('Error restoring test:', error);
                        btn.innerHTML = originalText;
                        btn.disabled = false;
                    }
                }
            });

        }); 
    </script>

</body>

</html>