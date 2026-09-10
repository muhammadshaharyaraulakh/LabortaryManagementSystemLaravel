<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratory Managemnet System</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="alternate icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-nbg text-black min-h-screen flex flex-col p-4 md:p-8">

    <header class="w-full max-w-5xl mx-auto flex justify-between items-center bg-white border-4 border-black neo-shadow p-4 mb-12">
        <div class="flex items-center gap-3">
            <span class="text-3xl font-black uppercase tracking-tighter">Laboratory Management System</span>
        </div>
        <div class="hidden sm:block text-xl font-bold uppercase">
            Download Reports
        </div>
    </header>

    <main class="flex-1 w-full max-w-3xl mx-auto flex flex-col items-center justify-center">
        
        <div class="w-full bg-white border-4 border-black neo-shadow p-8 md:p-12 text-center mb-12">
            <h1 class="text-5xl md:text-6xl font-black uppercase tracking-tighter mb-6 bg-npink inline-block px-4 border-4 border-black -rotate-2">
                Track Report
            </h1>
            <p class="text-xl font-bold mb-8 uppercase">Enter your Tracking ID below</p>

            <form id="tracking-form" class="flex flex-col md:flex-row gap-4 mb-4">
                <input type="text" id="tracking-id-input" placeholder="e.g. ORD-20260424-ABCD"
                    class="flex-1 bg-white border-4 border-black p-4 text-xl font-bold uppercase placeholder-gray-400 focus:outline-none focus:bg-yellow-50 neo-shadow-sm focus:translate-y-1 transition-transform">
                
                <button type="submit" id="track-report-btn"
                    class="bg-nbrand text-white border-4 cursor-pointer border-black px-8 py-4 text-2xl font-black uppercase neo-shadow neo-hover neo-active transition-all flex items-center justify-center gap-2">
                    <span id="btn-text">Search</span>
                    <i id="btn-spinner" class="ph-bold ph-spinner animate-spin hidden"></i>
                </button>
            </form>
        </div>

        <div id="tracking-results-container" class="w-full max-w-4xl mx-auto hidden flex-col gap-8 mb-12">
        </div>

    </main>

    <footer class="w-full max-w-5xl mx-auto bg-white border-4 border-black p-6 mt-auto neo-shadow text-center font-bold uppercase text-lg">
        © 2026 LABORATORY MANAGEMENT SYSTEM.
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const trackingForm = document.getElementById('tracking-form');
            const trackingInput = document.getElementById('tracking-id-input');
            const resultsContainer = document.getElementById('tracking-results-container');
            const trackBtn = document.getElementById('track-report-btn');
            const btnText = document.getElementById('btn-text');
            const btnSpinner = document.getElementById('btn-spinner');

            trackingForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                const rawInput = trackingInput.value.trim();
                const trackingId = rawInput.replace(/^[#\s]+/, '');

                if (!trackingId) {
                    resultsContainer.innerHTML = `
                        <div class="bg-nbg border-4 border-black neo-shadow p-8 text-center">
                            <i class="ph-bold ph-warning-circle text-6xl mb-4 block"></i>
                            <h2 class="text-3xl font-black uppercase">Input Required</h2>
                            <p class="text-xl font-bold mt-2 uppercase">Please enter a Tracking ID!</p>
                        </div>
                    `;
                    resultsContainer.classList.remove('hidden');
                    return;
                }

                trackBtn.disabled = true;
                btnText.textContent = 'SEARCHING';
                btnSpinner.classList.remove('hidden');
                resultsContainer.classList.add('hidden');

                try {
                    const response = await fetch(`/public/track-report/${encodeURIComponent(trackingId)}`);
                    const result = await response.json();

                    if (response.ok && result.status === 200) {
                        renderResults(result.orders[0]);
                    } else {
                        resultsContainer.innerHTML = `
                            <div class="bg-nbrand text-white border-4 border-black neo-shadow p-8 text-center">
                                <i class="ph-bold ph-warning-circle text-6xl mb-4 block"></i>
                                <h2 class="text-3xl font-black uppercase">Not Found</h2>
                                <p class="text-xl font-bold mt-2 uppercase">${result.message || 'NO RECORD FOUND'}</p>
                            </div>
                        `;
                        resultsContainer.classList.remove('hidden');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    resultsContainer.innerHTML = `
                        <div class="bg-npink border-4 border-black neo-shadow p-8 text-center">
                            <i class="ph-bold ph-x-circle text-6xl mb-4 block"></i>
                            <h2 class="text-3xl font-black uppercase">Network Error</h2>
                            <p class="text-xl font-bold mt-2 uppercase">Failed to fetch report. Please try again.</p>
                        </div>
                    `;
                    resultsContainer.classList.remove('hidden');
                } finally {
                    trackBtn.disabled = false;
                    btnText.textContent = 'Search';
                    btnSpinner.classList.add('hidden');
                }
            });

            function renderResults(order) {
                let html = `
                    <div class="bg-white border-4 border-black neo-shadow p-6 md:p-8">
                        <div class="border-b-4 border-black pb-6 mb-6 flex flex-col sm:flex-row sm:items-center gap-4">
                            <h3 class="text-4xl font-black uppercase bg-npink inline-block px-2 border-4 border-black break-all sm:break-normal">${order.name}</h3>
                            <span class="inline-block bg-nblue text-white px-3 py-1 font-black text-lg uppercase border-4 border-black">ID: ${order.trackingId}</span>
                        </div>
                        
                        <div class="flex flex-col gap-8">
                `;

                order.tests.forEach(test => {
                    const status = test.pivot.status;
                    const isCompleted = status === 'Completed';
                    const results = test.results || [];

                    html += `
                        <div class="border-4 border-black bg-gray-100 neo-shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center p-4 gap-4">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-nbg border-4 border-black flex items-center justify-center">
                                    <i class="ph-bold ph-test-tube text-2xl"></i>
                                </div>
                                <div class="flex flex-col items-start gap-1">
                                    <h4 class="font-black text-2xl uppercase leading-none">${test.name}</h4>
                                    <div class="font-bold uppercase text-sm px-2 py-0.5 inline-block border-2 border-black ${isCompleted ? 'bg-[#00ff00]' : 'bg-[#ff9900]'}">
                                        ${status} - ${test.sampleType || 'STANDARD'}
                                    </div>
                                </div>
                            </div>
                            ${isCompleted ? `
                                <a href="/orders/${order.trackingId}/test/${test.id}/report" 
                                   class="bg-nbrand text-white border-4 border-black px-6 py-2 font-black uppercase hover:bg-black transition-colors neo-shadow-sm neo-active flex items-center gap-2 text-lg">
                                    <i class="ph-bold ph-download-simple"></i> PDF
                                </a>
                            ` : ''}
                        </div>
                    `;
                });

                html += `
                        </div>
                    </div>
                `;

                resultsContainer.innerHTML = html;
                resultsContainer.classList.remove('hidden');
                resultsContainer.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }
        });
    </script>
</body>
</html>