<div id="section-tests" class="content-section hidden animate-fade-in w-full max-w-7xl mx-auto">

    <div id="tests-list-view" class="w-full animate-fade-in">
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
                    <i
                        class="ph ph-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-lg"></i>
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

    <div id="test-details-view" class="w-full hidden animate-fade-in">
        <div class="flex items-center gap-4 mb-6">
            <button id="btn-back-to-tests"
                class="flex items-center justify-center w-11 h-11 rounded-xl bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 hover:text-purple-600 transition-colors shadow-sm cursor-pointer">
                <i class="ph-bold ph-arrow-left text-xl"></i>
            </button>
            <div>
                <h2 class="text-2xl font-extrabold text-gray-800">Test Details</h2>
                <p class="text-sm text-gray-500 font-medium">Comprehensive view of parameters and instructions</p>
            </div>
        </div>

        <div
            class="bg-white rounded-[1.25rem] shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-50 overflow-hidden w-full p-6 sm:p-8">
            <div id="test-details-content"></div>
        </div>
    </div>

</div>