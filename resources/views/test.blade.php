<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mikrolab Landing Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #ffffff;
            overflow-x: hidden;
        }

        .text-brand {
            color: #E0353A;
        }

        .bg-brand {
            background-color: #E0353A;
        }
    </style>
</head>

<body class="antialiased text-gray-800">

    <section class="relative min-h-screen flex flex-col overflow-hidden">

        <div class="absolute inset-0 z-0 pointer-events-none">
            <img src="{{ asset('images/Gemini_Generated_Image_7hisot7hisot7his.png') }}" alt="DNA Background"
                class="w-full h-full object-cover object-center" />
        </div>

        <div class="absolute inset-0 bg-black/40 z-0"></div>

        <header
            class="relative z-20 w-full px-4 sm:px-8 lg:px-16 py-6 flex justify-between items-center bg-transparent">

            <div class="flex items-center gap-2">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <circle cx="6" cy="6" r="2.5" fill="#E0353A" />
                    <circle cx="18" cy="6" r="2.5" fill="#E0353A" />
                    <circle cx="12" cy="12" r="2.5" fill="#E0353A" />
                    <circle cx="6" cy="18" r="2.5" fill="#E0353A" />
                    <circle cx="18" cy="18" r="2.5" fill="#E0353A" />
                </svg>
                <span class="text-xl font-bold tracking-tight text-white">MIKROLAB</span>
            </div>

            <nav class="hidden lg:flex items-center gap-8 font-medium text-sm text-white">
                <a href="#" class="text-white">Home</a>
                <a href="#" class="hover:text-gray-300 transition">About</a>
                <a href="#" class="hover:text-gray-300 transition">Service</a>
                <a href="#" class="hover:text-gray-300 transition">Contact</a>
            </nav>

            <div class="hidden lg:block">
                <a href="#"
                    class="px-6 py-2.5 border border-white rounded-full text-sm font-medium text-white hover:bg-white hover:text-black transition">
                    Make an Appointment
                </a>
            </div>

            <button class="lg:hidden text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
            </button>
        </header>

        <main class="relative z-10 grow flex flex-col justify-center px-4 sm:px-8 lg:px-16 pt-12 pb-24">

            <div class="max-w-2xl text-white">
                <h1 class="text-[32px] sm:text-5xl lg:text-[64px] font-semibold leading-tight tracking-tight">
                    Advancing Medical Research,<br class="hidden lg:block" />
                    Empowering Public Health
                </h1>

                <p class="mt-6 text-gray-200 text-sm sm:text-base lg:text-lg leading-relaxed max-w-lg">
                    Reliable laboratory services and cutting-edge medical research, making healthcare accessible and
                    trustworthy for everyone.
                </p>

                <div class="mt-10 flex items-center gap-3">
                    <a href="#"
                        class="bg-white text-black px-8 py-3.5 rounded-full text-sm font-medium hover:bg-gray-200 transition">
                        Book Your Test
                    </a>

                    <a href="#"
                        class="flex items-center justify-center w-12 h-12 bg-white text-black rounded-full hover:bg-gray-200 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <div
                class="mt-16 lg:mt-0 lg:absolute lg:bottom-16 lg:right-16 max-w-xs bg-white/80 backdrop-blur-md p-4 rounded-2xl">

                <h3 class="text-sm font-medium text-gray-800 mb-3">Trusted by Leading Doctors</h3>

                <div class="flex items-center mb-3">
                    <div class="flex -space-x-3">
                        <img class="w-10 h-10 rounded-full border-2 border-white object-cover"
                            src="https://i.pravatar.cc/100?img=33">
                        <img class="w-10 h-10 rounded-full border-2 border-white object-cover"
                            src="https://i.pravatar.cc/100?img=47">
                        <img class="w-10 h-10 rounded-full border-2 border-white object-cover"
                            src="https://i.pravatar.cc/100?img=12">
                    </div>

                    <div class="ml-4 bg-white rounded-full px-3 py-1 text-sm font-semibold text-brand">
                        40+
                    </div>
                </div>

                <p class="text-xs text-gray-500">
                    Expert physicians partnering with Mikrolab for accurate and timely diagnostics.
                </p>
            </div>

        </main>
    </section>

    <section class="py-16 lg:py-24 px-4 sm:px-8 lg:px-16 bg-white">

        <div class="flex flex-col lg:flex-row lg:items-end justify-between mb-12 lg:mb-16 gap-6">
            <h2 class="text-3xl sm:text-4xl lg:text-[42px] font-semibold text-[#1A1A1A]">
                What Makes Us Stand Out
            </h2>
            <p class="text-gray-400 text-sm sm:text-base max-w-sm lg:text-right">
                We combine expertise, technology, and care to deliver the best outcomes.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            <div class="bg-[#F8F9FA] rounded-[28px] p-8 flex flex-col min-h-[300px]">
                <div class="border-b border-gray-200 pb-4 mb-5">
                    <h3 class="text-lg font-medium text-gray-900">Accurate & Reliable</h3>
                </div>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Our results are trusted by doctors and hospitals nationwide.
                </p>
                <div class="mt-auto flex justify-end pt-8">
                    <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-sm">
                        <svg class="w-5 h-5 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-[#F8F9FA] rounded-[28px] p-8 flex flex-col min-h-[300px]">
                <div class="border-b border-gray-200 pb-4 mb-5">
                    <h3 class="text-lg font-medium text-gray-900">Cutting-Edge Tech</h3>
                </div>
                <p class="text-gray-500 text-sm leading-relaxed">
                    State-of-the-art equipment ensures fast, precise diagnostics.
                </p>
                <div class="mt-auto flex justify-end pt-8">
                    <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-sm">
                        <svg class="w-5 h-5 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14.017 18L14.017 21M14.017 18L13.517 18M14.017 18L16.517 18M9.98299 18L9.98299 21M9.98299 18L10.483 18M9.98299 18L7.48299 18M11.999 15C13.6559 15 14.999 13.6569 14.999 12C14.999 10.3431 13.6559 9 11.999 9C10.3421 9 8.99902 10.3431 8.99902 12C8.99902 13.6569 10.3421 15 11.999 15ZM12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2Z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-[#F8F9FA] rounded-[28px] p-8 flex flex-col min-h-[300px]">
                <div class="border-b border-gray-200 pb-4 mb-5">
                    <h3 class="text-lg font-medium text-gray-900">Tech-Driven Services</h3>
                </div>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Advanced tools ensuring consistent quality and accessibility.
                </p>
                <div class="mt-auto flex justify-end pt-8">
                    <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-sm">
                        <svg class="w-5 h-5 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-[#F8F9FA] rounded-[28px] p-8 flex flex-col min-h-[300px]">
                <div class="border-b border-gray-200 pb-4 mb-5">
                    <h3 class="text-lg font-medium text-gray-900">Elite Medical Team</h3>
                </div>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Specialists leveraging data and tech for accurate results.
                </p>
                <div class="mt-auto flex justify-end pt-8">
                    <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-sm">
                        <svg class="w-5 h-5 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

        </div>
    </section>

</body>

</html>