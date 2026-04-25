<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Lab - Premium Diagnostics</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        sidebarBg: '#1b2033',
                        mainBg: '#f4f6f9',
                        inputBg: '#f3f4f6',
                        brandAccent: '#3b82f6',
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'fade-in-up': 'fadeInUp 0.8s ease-out forwards',
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-20px)' },
                        },
                        fadeInUp: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .delay-100 {
            animation-delay: 100ms;
        }

        .delay-200 {
            animation-delay: 200ms;
        }

        .delay-300 {
            animation-delay: 300ms;
        }

        .opacity-0-initial {
            opacity: 0;
        }
    </style>
</head>

<body class="font-sans antialiased bg-mainBg text-gray-800 overflow-x-hidden">

    <nav class="fixed w-full z-50 bg-white/90 backdrop-blur-md shadow-sm transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="shrink-0 flex items-center gap-2 cursor-pointer">
                    <div class="w-10 h-10 bg-sidebarBg rounded-lg flex items-center justify-center text-white">
                        <i class="ph-duotone ph-microscope text-2xl"></i>
                    </div>
                    <span class="text-2xl font-extrabold text-sidebarBg tracking-tight">My Lab</span>
                </div>

                <div class="hidden md:flex space-x-8 items-center">
                    <a href="#home" class="text-gray-600 hover:text-sidebarBg font-semibold transition-colors">Home</a>
                    <a href="#about"
                        class="text-gray-600 hover:text-sidebarBg font-semibold transition-colors">About</a>
                    <a href="#services"
                        class="text-gray-600 hover:text-sidebarBg font-semibold transition-colors">Services</a>
                    <a href="#track-report"
                        class="text-gray-600 hover:text-sidebarBg font-semibold transition-colors">Track Report</a>
                </div>

                <div class="md:hidden flex items-center">
                    <button class="text-gray-600 hover:text-sidebarBg focus:outline-none text-3xl">
                        <i class="ph ph-list"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <section id="home"
        class="relative h-screen w-full flex items-center justify-center overflow-hidden bg-cover bg-center bg-no-repeat"
        style="background-image: url('https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&q=80&w=2000');">

        <div class="absolute inset-0 bg-sidebarBg/85 backdrop-blur-[2px]"></div>

        <div class="relative z-10 text-center px-4 max-w-4xl mx-auto animate-fade-in-up">

            <div
                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-500/20 text-blue-200 border border-blue-500/30 font-semibold text-sm mb-6">
                <i class="ph-fill ph-sparkle"></i> Smart results powered by AI
            </div>

            <h1 class="text-5xl lg:text-7xl font-extrabold text-white tracking-tight leading-tight mb-6">
                Your Health,<br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-brandAccent to-purple-400">Clearly
                    Understood.</span>
            </h1>

            <p class="text-lg md:text-xl text-gray-300 mb-10 max-w-2xl mx-auto">
                Access your lab results instantly, track your health history, and decode complex medical reports using
                our advanced AI analysis tool.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#track-report"
                    class="px-8 py-4 bg-brandAccent text-white rounded-xl font-bold text-lg hover:bg-blue-600 transition-all shadow-lg hover:shadow-brandAccent/30 flex items-center justify-center gap-2">
                    Track Your Report <i class="ph-bold ph-arrow-right"></i>
                </a>
                <a href="#services"
                    class="px-8 py-4 bg-white/10 text-white border border-white/20 hover:bg-white/20 rounded-xl font-bold text-lg transition-all shadow-sm flex items-center justify-center gap-2 backdrop-blur-md">
                    Explore Services
                </a>
            </div>

        </div>
    </section>

    <section id="about" class="py-24 bg-white overflow-hidden flex items-center justify-center">
        <div class="max-w-5xl mx-auto px-6 lg:px-8 text-center animate-fade-in-up opacity-0-initial">

            <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-6 leading-tight">
                Committed to Accuracy,<br> Driven by Innovation.
            </h2>

            <p class="text-lg text-gray-500 font-light mb-16 leading-relaxed max-w-3xl mx-auto">
                At My Lab, we believe that understanding your health shouldn't require a medical degree. We combine
                state-of-the-art laboratory equipment with proprietary AI technology to give you clarity and peace of
                mind.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12 text-center">
                <div class="p-8 bg-gray-50 rounded-2xl border border-gray-100 hover:shadow-md transition-shadow">
                    <h4 class="text-xl font-bold text-gray-900 mb-3">ISO Certified</h4>
                    <p class="text-gray-500 font-light text-sm leading-relaxed">Adhering to strict, internationally
                        recognized standards for laboratory testing and quality control.</p>
                </div>

                <div class="p-8 bg-gray-50 rounded-2xl border border-gray-100 hover:shadow-md transition-shadow">
                    <h4 class="text-xl font-bold text-gray-900 mb-3">Instant Reporting</h4>
                    <p class="text-gray-500 font-light text-sm leading-relaxed">Access your diagnostic results securely
                        and instantly the very moment they are verified.</p>
                </div>

                <div class="p-8 bg-gray-50 rounded-2xl border border-gray-100 hover:shadow-md transition-shadow">
                    <h4 class="text-xl font-bold text-gray-900 mb-3">AI-Powered Clarity</h4>
                    <p class="text-gray-500 font-light text-sm leading-relaxed">Complex medical data and terminology
                        automatically translated into plain, understandable English.</p>
                </div>
            </div>

        </div>
    </section>

    <section id="services" class="py-24 bg-mainBg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-fade-in-up opacity-0-initial">
                <h2 class="text-3xl md:text-4xl font-extrabold text-sidebarBg mb-4">Our Services</h2>
                <p class="text-gray-600 max-w-2xl mx-auto font-medium">We provide comprehensive, state-of-the-art
                    diagnostic testing with rapid turnaround times.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                <div
                    class="bg-white p-8 rounded-[1.5rem] shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 animate-fade-in-up opacity-0-initial">
                    <div class="w-14 h-14 bg-red-50 text-red-500 rounded-xl flex items-center justify-center mb-6">
                        <i class="ph-duotone ph-drop text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-sidebarBg mb-3">Blood Pathology</h3>
                    <p class="text-gray-500 font-medium leading-relaxed">Complete blood count, lipid profiles, and
                        comprehensive metabolic panels analyzed with precision.</p>
                </div>

                <div
                    class="bg-white p-8 rounded-[1.5rem] shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 animate-fade-in-up opacity-0-initial delay-100">
                    <div class="w-14 h-14 bg-blue-50 text-blue-500 rounded-xl flex items-center justify-center mb-6">
                        <i class="ph-duotone ph-dna text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-sidebarBg mb-3">Genetics & DNA</h3>
                    <p class="text-gray-500 font-medium leading-relaxed">Advanced genetic screening and molecular
                        diagnostics to help predict and prevent conditions.</p>
                </div>

                <div
                    class="bg-white p-8 rounded-[1.5rem] shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 animate-fade-in-up opacity-0-initial delay-200">
                    <div
                        class="w-14 h-14 bg-yellow-50 text-yellow-600 rounded-xl flex items-center justify-center mb-6">
                        <i class="ph-duotone ph-flask text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-sidebarBg mb-3">Biochemistry</h3>
                    <p class="text-gray-500 font-medium leading-relaxed">Detailed analysis of bodily fluids to evaluate
                        organ function and detect underlying diseases.</p>
                </div>

                <div
                    class="bg-white p-8 rounded-[1.5rem] shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 animate-fade-in-up opacity-0-initial">
                    <div class="w-14 h-14 bg-green-50 text-green-500 rounded-xl flex items-center justify-center mb-6">
                        <i class="ph-duotone ph-virus text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-sidebarBg mb-3">Microbiology</h3>
                    <p class="text-gray-500 font-medium leading-relaxed">Culturing and identifying bacteria, fungi, and
                        viruses to accurately diagnose infections.</p>
                </div>

                <div
                    class="bg-white p-8 rounded-[1.5rem] shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 animate-fade-in-up opacity-0-initial delay-100">
                    <div
                        class="w-14 h-14 bg-purple-50 text-purple-500 rounded-xl flex items-center justify-center mb-6">
                        <i class="ph-duotone ph-activity text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-sidebarBg mb-3">Hormonal Assays</h3>
                    <p class="text-gray-500 font-medium leading-relaxed">Precise measurements of thyroid, reproductive,
                        and metabolic hormones to monitor endocrine health.</p>
                </div>

                <div
                    class="bg-white p-8 rounded-[1.5rem] shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 animate-fade-in-up opacity-0-initial delay-200">
                    <div
                        class="w-14 h-14 bg-orange-50 text-orange-500 rounded-xl flex items-center justify-center mb-6">
                        <i class="ph-duotone ph-shield-plus text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-sidebarBg mb-3">Immunology</h3>
                    <p class="text-gray-500 font-medium leading-relaxed">Testing immune system function to detect
                        autoimmune disorders, allergies, and specific antibodies.</p>
                </div>

            </div>
        </div>
    </section>

    <section id="track-report" class="py-24 bg-sidebarBg relative overflow-hidden">
        <div class="absolute inset-0 opacity-5"
            style="background-image: radial-gradient(#ffffff 2px, transparent 2px); background-size: 30px 30px;"></div>

        <div class="max-w-4xl w-full mx-auto px-4 sm:px-6 lg:px-8 relative z-10 animate-fade-in-up opacity-0-initial">

            <div class="text-center mb-10">
                <h2 class="text-4xl md:text-5xl font-extrabold text-white mb-4">View Your Report</h2>
                <p class="text-gray-400 font-medium text-lg">Enter your tracking ID below to instantly access your
                    results.</p>
            </div>

            <div class="bg-white rounded-[1.5rem] p-6 md:p-10 shadow-2xl">
                <form id="tracking-form" class="flex flex-col md:flex-row gap-4 mb-4">
                    <div class="flex-1">
                        <input type="text" id="tracking-id-input" placeholder="Enter Tracking ID (e.g., ORD-20260424-ABCD)"
                            class="w-full bg-inputBg border border-gray-200 rounded-xl px-6 py-4 text-gray-800 font-bold placeholder-gray-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-brandAccent transition-all text-lg">
                    </div>

                    <button type="submit" id="track-report-btn"
                        class="px-8 py-4 bg-sidebarBg text-white rounded-xl font-bold hover:bg-gray-800 transition-all shadow-lg whitespace-nowrap flex items-center justify-center gap-2">
                        <span id="btn-text">View Report</span>
                        <i id="btn-spinner" class="ph-bold ph-spinner animate-spin hidden"></i>
                    </button>
                </form>

                <div id="tracking-results-container" class="mt-8 hidden">
                    <!-- Results will be injected here -->
                </div>

                <div class="flex justify-end pt-4 border-t border-gray-100 mt-4">
                    <button type="button"
                        class="text-brandAccent font-bold text-sm hover:text-blue-700 flex items-center gap-1 transition-colors">
                        <i class="ph-bold ph-sparkle"></i> Analyze with AI
                    </button>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-white pt-16 pb-8 border-t border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">

                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center gap-2 mb-6">
                        <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center text-brandAccent">
                            <i class="ph-duotone ph-microscope text-2xl"></i>
                        </div>
                        <span class="text-2xl font-extrabold text-sidebarBg tracking-tight">My Lab</span>
                    </div>
                    <p class="text-gray-600 font-medium max-w-sm leading-relaxed">
                        Empowering patients with AI-driven diagnostics, seamless access to medical records, and clear,
                        understandable health data.
                    </p>
                </div>

                <div>
                    <h4 class="text-sidebarBg font-bold mb-6 tracking-wide uppercase text-sm">Quick Links</h4>
                    <ul class="space-y-4">
                        <li><a href="#home" class="text-gray-600 hover:text-brandAccent transition-colors">Home</a></li>
                        <li><a href="#about" class="text-gray-600 hover:text-brandAccent transition-colors">About Us</a>
                        </li>
                        <li><a href="#services"
                                class="text-gray-600 hover:text-brandAccent transition-colors">Services</a></li>
                        <li><a href="#track-report" class="text-gray-600 hover:text-brandAccent transition-colors">Track
                                Report</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-sidebarBg font-bold mb-6 tracking-wide uppercase text-sm">Contact Support</h4>
                    <ul class="space-y-4">
                        <li
                            class="flex items-center gap-3 text-gray-600 hover:text-brandAccent transition-colors cursor-pointer">
                            <i class="ph-fill ph-envelope-simple text-xl text-brandAccent"></i> support@mylab.com
                        </li>
                        <li
                            class="flex items-center gap-3 text-gray-600 hover:text-brandAccent transition-colors cursor-pointer">
                            <i class="ph-fill ph-phone text-xl text-brandAccent"></i> +1 (800) 123-4567
                        </li>
                    </ul>
                </div>

            </div>

            <div class="border-t border-gray-200 pt-8 flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-gray-500 text-sm">© 2026 My Lab Diagnostics. All rights reserved.</p>
                <div class="flex gap-4 text-gray-400">
                    <a href="#" class="hover:text-brandAccent transition-transform hover:scale-110"><i
                            class="ph-fill ph-twitter-logo text-2xl"></i></a>
                    <a href="#" class="hover:text-brandAccent transition-transform hover:scale-110"><i
                            class="ph-fill ph-linkedin-logo text-2xl"></i></a>
                    <a href="#" class="hover:text-brandAccent transition-transform hover:scale-110"><i
                            class="ph-fill ph-facebook-logo text-2xl"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const observerOptions = {
                root: null,
                rootMargin: '0px',
                threshold: 0.15
            };

            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.remove('opacity-0-initial');
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            const animatedElements = document.querySelectorAll('.animate-fade-in-up');
            animatedElements.forEach(el => observer.observe(el));

            const trackingForm = document.getElementById('tracking-form');
            const trackingInput = document.getElementById('tracking-id-input');
            const resultsContainer = document.getElementById('tracking-results-container');
            const trackBtn = document.getElementById('track-report-btn');
            const btnText = document.getElementById('btn-text');
            const btnSpinner = document.getElementById('btn-spinner');

            trackingForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                const trackingId = trackingInput.value.trim();

                if (!trackingId) {
                    alert('Please enter a Tracking ID');
                    return;
                }

                // Show loading state
                trackBtn.disabled = true;
                btnText.textContent = 'Searching...';
                btnSpinner.classList.remove('hidden');
                resultsContainer.classList.add('hidden');

                try {
                    const response = await fetch(`/orders/search/${trackingId}`);
                    const result = await response.json();

                    if (response.ok && result.status === 200) {
                        const order = result.orders[0];
                        renderResults(order);
                    } else {
                        resultsContainer.innerHTML = `
                            <div class="p-6 bg-red-50 border border-red-100 rounded-2xl text-center text-red-600 font-bold">
                                <i class="ph-bold ph-warning-circle text-3xl mb-2 block"></i>
                                ${result.message || 'No record found with this Tracking ID.'}
                            </div>
                        `;
                        resultsContainer.classList.remove('hidden');
                    }
                } catch (error) {
                    console.error('Error fetching report:', error);
                    alert('An error occurred while fetching your report. Please try again.');
                } finally {
                    trackBtn.disabled = false;
                    btnText.textContent = 'View Report';
                    btnSpinner.classList.add('hidden');
                }
            });

            function renderResults(order) {
                let html = `
                    <div class="p-6 bg-gray-50 rounded-2xl border border-gray-100 mb-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-xl font-bold text-sidebarBg">${order.name}</h3>
                                <p class="text-sm text-gray-500 font-medium">Tracking ID: ${order.trackingId}</p>
                            </div>
                            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-bold uppercase tracking-wider">Order Found</span>
                        </div>
                        <div class="space-y-4">
                `;

                order.tests.forEach(test => {
                    const status = test.pivot.status;
                    const isCompleted = status === 'Completed';
                    const statusClass = isCompleted ? 'bg-green-100 text-green-700' : 'bg-orange-100 text-orange-700';
                    
                    html += `
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between p-4 bg-white rounded-xl border border-gray-100 gap-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-gray-50 flex items-center justify-center text-gray-400">
                                    <i class="ph-bold ph-test-tube"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-800">${test.name}</h4>
                                    <span class="inline-block px-2 py-0.5 ${statusClass} rounded text-[10px] font-bold uppercase tracking-tighter">${status}</span>
                                </div>
                            </div>
                            
                            ${isCompleted ? `
                                <a href="/orders/${order.trackingId}/test/${test.id}/report" 
                                   class="px-5 py-2 bg-brandAccent text-white rounded-lg text-sm font-bold hover:bg-blue-600 transition-colors flex items-center justify-center gap-2">
                                    <i class="ph-bold ph-download-simple"></i> Download Report
                                </a>
                            ` : `
                                <div class="text-xs text-gray-400 font-medium italic flex items-center gap-1">
                                    <i class="ph ph-clock"></i> Result pending verification
                                </div>
                            `}
                        </div>
                    `;
                });

                html += `
                        </div>
                    </div>
                `;

                resultsContainer.innerHTML = html;
                resultsContainer.classList.remove('hidden');
                
                // Scroll to results
                resultsContainer.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }
        });
    </script>
</body>

</html>