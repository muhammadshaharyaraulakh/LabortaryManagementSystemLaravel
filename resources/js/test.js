document.addEventListener("DOMContentLoaded", function () {
    let directoryTests = [];
    let testsLoaded = false;
    let currentTestPage = 1;
    let lastTestPage = 1;
    let currentTestSearch = "";

    const testsListView = document.getElementById("tests-list-view");
    const testDirectoryTableBody = document.getElementById(
        "testDirectoryTableBody"
    );
    const testsPaginationContainer = document.getElementById(
        "tests-pagination-container"
    );
    const searchTestsDir = document.getElementById("searchTestsDir");
    const testDetailsView = document.getElementById("test-details-view");
    const testDetailsContent = document.getElementById("test-details-content");
    const btnBackToTests = document.getElementById("btn-back-to-tests");

    function showListView() {
        testDetailsView.classList.add("hidden");
        testsListView.classList.remove("hidden");
    }

    function showDetailsView() {
        testsListView.classList.add("hidden");
        testDetailsView.classList.remove("hidden");
    }

    if (btnBackToTests) {
        btnBackToTests.addEventListener("click", showListView);
    }

    function getPaginationRange(current, last) {
        if (last <= 7) {
            return Array.from({ length: last }, (_, i) => i + 1);
        }
        const delta = 1;
        const range = [];
        for (
            let i = Math.max(2, current - delta);
            i <= Math.min(last - 1, current + delta);
            i++
        ) {
            range.push(i);
        }
        if (current - delta > 2) range.unshift("...");
        if (current + delta < last - 1) range.push("...");
        range.unshift(1);
        range.push(last);
        return range;
    }

    function renderTestPagination(pagination) {
        if (!testsPaginationContainer) return;
        if (!pagination || pagination.total === 0) {
            testsPaginationContainer.innerHTML = "";
            return;
        }

        const { current_page, last_page, total, from, to } = pagination;

        let pagesHtml = "";
        const pages = getPaginationRange(current_page, last_page);
        pages.forEach((p) => {
            if (p === "...") {
                pagesHtml += `<span class="w-8 h-8 flex items-center justify-center text-gray-400 text-xs font-bold">...</span>`;
            } else if (p === current_page) {
                pagesHtml += `<button class="w-8 h-8 rounded-lg bg-purple-600 text-white text-xs sm:text-sm font-bold shadow-sm cursor-default" data-test-page="${p}">${p}</button>`;
            } else {
                pagesHtml += `<button class="w-8 h-8 rounded-lg border border-gray-200 hover:bg-gray-50 text-gray-700 text-xs sm:text-sm font-semibold transition-colors cursor-pointer" data-test-page="${p}">${p}</button>`;
            }
        });

        testsPaginationContainer.innerHTML = `
            <div>
                <p class="text-xs sm:text-sm text-gray-500 font-medium">
                    Showing <span class="font-bold text-gray-800">${from}</span> to <span class="font-bold text-gray-800">${to}</span> of <span class="font-bold text-gray-800">${total}</span> tests
                </p>
            </div>
            <div class="flex items-center gap-1.5 flex-wrap">
                <button class="px-3 py-1.5 rounded-lg border border-gray-200 text-xs sm:text-sm font-semibold text-gray-600 hover:bg-gray-100 disabled:opacity-40 disabled:cursor-not-allowed transition-colors cursor-pointer flex items-center gap-1"
                    ${current_page <= 1 ? "disabled" : ""} data-test-page="${current_page - 1}">
                    <i class="ph-bold ph-caret-left"></i> Prev
                </button>
                ${pagesHtml}
                <button class="px-3 py-1.5 rounded-lg border border-gray-200 text-xs sm:text-sm font-semibold text-gray-600 hover:bg-gray-100 disabled:opacity-40 disabled:cursor-not-allowed transition-colors cursor-pointer flex items-center gap-1"
                    ${current_page >= last_page ? "disabled" : ""} data-test-page="${current_page + 1}">
                    Next <i class="ph-bold ph-caret-right"></i>
                </button>
            </div>
        `;
    }

    testsPaginationContainer?.addEventListener("click", (e) => {
        const btn = e.target.closest("button[data-test-page]");
        if (btn && !btn.disabled) {
            const page = parseInt(btn.getAttribute("data-test-page"));
            if (
                !isNaN(page) &&
                page >= 1 &&
                page <= lastTestPage &&
                page !== currentTestPage
            ) {
                fetchDirectoryTests(page, currentTestSearch);
            }
        }
    });

    async function fetchDirectoryTests(page = 1, search = "") {
        if (!testDirectoryTableBody) return;
        currentTestPage = page;
        currentTestSearch = search;

        testDirectoryTableBody.innerHTML = `<tr><td colspan="6" class="px-6 py-8 text-center"><i class="ph-bold ph-spinner animate-spin text-2xl text-purple-600"></i><p class="text-sm text-gray-500 mt-2">Loading tests...</p></td></tr>`;

        try {
            const params = new URLSearchParams();
            params.append("page", page);
            if (search) params.append("search", search);

            const response = await fetch(`/tests?${params.toString()}`, {
                headers:
                    typeof fetchHeaders !== "undefined"
                        ? fetchHeaders
                        : { Accept: "application/json" },
            });
            const result = await response.json();

            if (result.status === true) {
                directoryTests = result.data || [];
                renderDirectoryTests(directoryTests);
                if (result.pagination) {
                    lastTestPage = result.pagination.last_page;
                    renderTestPagination(result.pagination);
                } else if (testsPaginationContainer) {
                    testsPaginationContainer.innerHTML = "";
                }
            } else {
                testDirectoryTableBody.innerHTML = `<tr><td colspan="6" class="px-6 py-4 text-center text-red-500">${
                    result.message || "No tests found."
                }</td></tr>`;
                if (testsPaginationContainer) {
                    testsPaginationContainer.innerHTML = "";
                }
            }
        } catch (error) {
            testDirectoryTableBody.innerHTML = `<tr><td colspan="6" class="px-6 py-4 text-center text-red-500">Failed to load tests.</td></tr>`;
            if (testsPaginationContainer) {
                testsPaginationContainer.innerHTML = "";
            }
        }
    }

    function renderDirectoryTests(tests) {
        if (!testDirectoryTableBody) return;
        testDirectoryTableBody.innerHTML = "";

        if (!tests || tests.length === 0) {
            testDirectoryTableBody.innerHTML = `<tr><td colspan="6" class="px-6 py-8 text-center text-gray-500 font-medium">No tests found matching your search.</td></tr>`;
            return;
        }

        tests.forEach((test) => {
            const code = test.testCode || test.test_code || test.code || "N/A";
            const name =
                test.testName || test.test_name || test.name || "Unnamed Test";
            const department =
                test.department?.name || test.department || "General";
            const price = test.price || 0;
            const time = test.resultHours
                ? `${test.resultHours} Hrs`
                : test.timeRequired || "Standard";

            testDirectoryTableBody.innerHTML += `
            <tr class="bg-white border-b border-gray-100 hover:bg-gray-50 transition-colors text-gray-800 font-medium animate-fade-in">
                <td class="px-6 py-4 text-gray-500 hidden md:table-cell">${code}</td>
                <td class="px-6 py-4">${name}</td>
                <td class="px-6 py-4 hidden md:table-cell">
                    <span class="bg-purple-50 text-purple-700 px-2.5 py-1 rounded-md text-xs font-bold">${department}</span>
                </td>
                <td class="px-6 py-4 hidden md:table-cell">Rs. ${price}</td>
                <td class="px-6 py-4 hidden md:table-cell">${time}</td>
                <td class="px-6 py-4 text-right">
                    <button data-id="${test.id}" class="btn-view-test text-purple-600 hover:text-purple-800 font-bold px-3 py-1.5 rounded-lg border border-purple-200 hover:bg-purple-50 transition-colors cursor-pointer">
                         Details
                    </button>
                </td>
            </tr>
        `;
        });
    }

    if (searchTestsDir) {
        let searchTimeout = null;
        searchTestsDir.addEventListener("input", (e) => {
            clearTimeout(searchTimeout);
            const query = e.target.value.trim();
            searchTimeout = setTimeout(() => {
                fetchDirectoryTests(1, query);
            }, 300);
        });
    }

    async function fetchTestDetails(id) {
        if (!testDetailsContent) return;
        testDetailsContent.innerHTML = `<div class="flex flex-col items-center justify-center py-16"><i class="ph-bold ph-spinner animate-spin text-4xl text-purple-600 mb-3"></i><p class="text-sm text-gray-500 font-medium">Fetching details...</p></div>`;
        showDetailsView();

        try {
            const response = await fetch(`/tests/${id}`, {
                headers:
                    typeof fetchHeaders !== "undefined"
                        ? fetchHeaders
                        : { Accept: "application/json" },
            });
            const result = await response.json();

            if (result.status === true) {
                const test = result.data;
                const code =
                    test.testCode || test.test_code || test.code || "N/A";
                const name =
                    test.testName ||
                    test.test_name ||
                    test.name ||
                    "Unnamed Test";
                const department =
                    test.department?.name || test.department || "General";

                const sampleType = test.sampleType || "N/A";
                const resultHours = test.resultHours || "N/A";
                const techInstructions =
                    test.instructions_sample_collector ||
                    test["Instructions(SampleCollector)"] ||
                    test.instructionsForTechnicianAndSampleCollector ||
                    "";

                let patientRequirementsHtml = "";
                if (test.instructions) {
                    patientRequirementsHtml = `
                    <div class="bg-orange-50 rounded-xl p-5 border border-orange-100 mb-4">
                        <span class="text-sm font-bold text-orange-800  mb-2 flex items-center gap-2">
                            <i class="ph-fill ph-warning-circle text-orange-500"></i> Patient Instructions
                        </span>
                        <p class="text-sm text-orange-700 leading-relaxed whitespace-pre-line">${test.instructions}</p>
                    </div>
                `;
                }

                let techRequirementsHtml = "";
                if (techInstructions) {
                    techRequirementsHtml = `
                    <div class="bg-blue-50 rounded-xl p-5 border border-blue-100 mb-6">
                        <span class="text-sm font-bold text-blue-800  mb-2 flex items-center gap-2">
                            <i class="ph-fill ph-info text-blue-500"></i> Technician & Sample Collector Protocol
                        </span>
                        <p class="text-sm text-blue-700 leading-relaxed whitespace-pre-line">${techInstructions}</p>
                    </div>
                `;
                }

                let parametersHtml = "";
                if (test.parameters && test.parameters.length > 0) {
                    const paramList = test.parameters
                        .map((param) => {
                            let paramDetails = "";
                            const type =
                                param.inputType ||
                                param.parameterType ||
                                "Quantitative";

                            if (type === "Quantitative") {
                                paramDetails = `<span class="text-xs font-medium bg-gray-100 text-gray-600 px-2.5 py-1 rounded-md">Normal: ${
                                    param.normalRange || "N/A"
                                } ${param.unit || ""}</span>`;
                            } else if (type === "Qualitative") {
                                const opts = Array.isArray(param.options)
                                    ? param.options.join(", ")
                                    : param.options || "N/A";
                                paramDetails = `<span class="text-xs font-medium bg-gray-100 text-gray-600 px-2.5 py-1 rounded-md">Options: ${opts}</span>`;
                            } else {
                                paramDetails = `<span class="text-xs font-medium bg-gray-100 text-gray-600 px-2.5 py-1 rounded-md">Type: ${type}</span>`;
                            }

                            return `
                                <li class="py-3 border-b border-gray-50 last:border-0 flex justify-between items-center gap-4">
                                    <div class="flex flex-col">
                                        <span class="font-bold text-gray-700">${param.parameterName}</span>
                                        <span class="text-[10px] text-gray-400 uppercase tracking-wider font-bold mt-0.5">${type}</span>
                                    </div>
                                    <div class="text-right">${paramDetails}</div>
                                </li>`;
                        })
                        .join("");

                    parametersHtml = `
                    <h5 class="font-bold text-base text-gray-800 mb-3 border-b border-gray-100 pb-2">Medical Parameters</h5>
                    <ul class="text-sm text-gray-600 w-full mb-4">
                        ${paramList}
                    </ul>
                `;
                } else {
                    parametersHtml = `<div class="bg-gray-50 rounded-lg p-4 text-center"><p class="text-sm text-gray-500 italic">No specific parameters listed for this test.</p></div>`;
                }

                testDetailsContent.innerHTML = `
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4 border-b border-gray-100 pb-6">
                    <div>
                        <h4 class="text-2xl font-black text-gray-900 mb-2">${name}</h4>
                        <div class="flex flex-wrap items-center gap-2 text-sm font-medium mt-2">
                            <span class="text-gray-500 bg-gray-100 px-2.5 py-1 rounded border border-gray-200">Code: <span class="text-gray-800 font-bold">${code}</span></span>
                            <span class="text-gray-500 bg-gray-100 px-2.5 py-1 rounded border border-gray-200">Sample: <span class="text-gray-800 font-bold">${sampleType}</span></span>
                            <span class="text-gray-500 bg-gray-100 px-2.5 py-1 rounded border border-gray-200">Results In: <span class="text-gray-800 font-bold">${resultHours} Hrs</span></span>
                        </div>
                    </div>
                    <div class="text-right flex flex-col md:items-end gap-2">
                        <span class="bg-purple-50 text-purple-700 px-3 py-1.5 rounded-lg text-sm font-bold inline-block">${department} Department</span>
                        <span class="text-2xl font-black text-gray-800">Rs. ${test.price}</span>
                    </div>
                </div>
                ${patientRequirementsHtml}
                ${techRequirementsHtml}
                ${parametersHtml}
            `;
            } else {
                testDetailsContent.innerHTML = `<div class="py-12 text-center flex flex-col items-center"><i class="ph-duotone ph-warning text-4xl text-red-500 mb-2"></i><p class="text-red-600 font-bold">${
                    result.message || "Failed to load test details."
                }</p></div>`;
            }
        } catch (error) {
            console.error(error);
            testDetailsContent.innerHTML = `<div class="py-12 text-center flex flex-col items-center"><i class="ph-duotone ph-wifi-x text-4xl text-red-500 mb-2"></i><p class="text-red-600 font-bold">Network error occurred.</p></div>`;
        }
    }

    const testNavLinks = document.querySelectorAll(
        'a[data-target="section-tests"]'
    );

    testNavLinks.forEach((link) => {
        link.addEventListener("click", () => {
            if (!testsLoaded) {
                fetchDirectoryTests();
                testsLoaded = true;
            }
            showListView();
        });
    });

    document.addEventListener("click", async (e) => {
        const viewTestBtn = e.target.closest(".btn-view-test");
        if (viewTestBtn) {
            const testId = viewTestBtn.getAttribute("data-id");
            if (testId) {
                fetchTestDetails(testId);
            }
        }
    });
});
