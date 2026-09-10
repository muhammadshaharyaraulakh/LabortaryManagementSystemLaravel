@php
    $redirectUrl = route('login');
    $destinationName = 'Login';
    $roleName = null;

    if (auth()->check()) {
        $roleName = ucfirst(auth()->user()->role ?? '');
        $role = strtolower(trim(auth()->user()->role ?? ''));
        switch ($role) {
            case 'admin':
                $redirectUrl = route('admin.adminstrator');
                $destinationName = 'Admin Dashboard';
                break;
            case 'receptionist':
                $redirectUrl = route('receptionist');
                $destinationName = 'Receptionist Dashboard';
                break;
            case 'samplecollector':
                $redirectUrl = route('samplecollector.dashboard');
                $destinationName = 'Collector Dashboard';
                break;
            case 'technician':
                $redirectUrl = route('SampleBasedTechnician');
                $destinationName = 'Technician Dashboard';
                break;
            case 'pathologist':
                $redirectUrl = route('pathologist.dashboard');
                $destinationName = 'Pathologist Dashboard';
                break;
            default:
                $redirectUrl = url('/');
                $destinationName = 'Home';
                break;
        }
    }

    $errorMessage = (isset($exception) && $exception->getMessage())
        ? $exception->getMessage()
        : "The page or resource you requested could not be found. It may have been moved, renamed, or is temporarily unavailable.";
@endphp
<x-header title="404 - Page Not Found | Laboratory Management System" />

<body class="font-sans antialiased bg-mainBg text-gray-800 flex items-center justify-center min-h-screen p-4 sm:p-6 relative overflow-hidden selection:bg-blue-600 selection:text-white">

    <!-- Ambient background glowing orbs -->
    <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-blue-500 rounded-full mix-blend-multiply filter blur-[128px] opacity-20 animate-pulse"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-96 h-96 bg-indigo-500 rounded-full mix-blend-multiply filter blur-[128px] opacity-20 animate-pulse" style="animation-delay: 2s;"></div>

    <div class="w-full max-w-lg bg-white/90 backdrop-blur-xl border border-gray-200/80 rounded-3xl p-6 sm:p-10 shadow-xl relative z-10 text-center transition-all">

        <!-- Status Badge -->
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-50 border border-blue-200 text-blue-600 text-xs font-bold tracking-wider uppercase mb-6">
            <span class="w-2 h-2 rounded-full bg-blue-500 animate-ping"></span>
            <span>HTTP 404 • Page Not Found</span>
        </div>

        <!-- Visual Icon Badge -->
        <div class="relative w-24 h-24 mx-auto mb-6 flex items-center justify-center">
            <div class="absolute inset-0 rounded-2xl bg-blue-500/10 border border-blue-500/20 -rotate-6 transition-transform hover:rotate-0 duration-300"></div>
            <div class="relative w-20 h-20 bg-blue-600 text-white rounded-2xl shadow-lg flex items-center justify-center neo-shadow-sm">
                <i class="ph-duotone ph-compass text-4xl"></i>
            </div>
        </div>

        <!-- Title and Description -->
        <h1 class="text-6xl sm:text-7xl font-black text-gray-900 tracking-tight mb-2">404</h1>
        <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight mb-3">Lost in the Lab?</h2>
        <p class="text-gray-600 font-medium text-sm sm:text-base mb-6 leading-relaxed max-w-md mx-auto">
            {{ $errorMessage }}
        </p>

        <!-- Authenticated Role Pill -->
        @if(auth()->check())
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-xl bg-gray-100 border border-gray-200 text-xs text-gray-700 font-medium mb-6">
                <i class="ph-duotone ph-user-circle text-base text-gray-500"></i>
                <span>Signed in as: <strong class="text-gray-900 font-bold">{{ auth()->user()->name ?? auth()->user()->email }}</strong> ({{ $roleName }})</span>
            </div>
        @endif

        <!-- Auto-redirect Status Box -->
        <div class="bg-gray-50 border border-gray-200/80 rounded-2xl p-4 mb-6 text-left shadow-2xs">
            <div class="flex items-center justify-between text-xs font-semibold text-gray-600 mb-2">
                <span class="flex items-center gap-2">
                    <i class="ph-duotone ph-arrows-clockwise text-base text-blue-500 animate-spin" style="animation-duration: 3s;"></i>
                    <span>Redirecting to <strong class="text-gray-900">{{ $destinationName }}</strong> in</span>
                </span>
                <span class="font-mono text-gray-900 bg-white px-2 py-0.5 rounded-md border border-gray-200 text-xs font-bold shadow-2xs">
                    <span id="countdown-seconds">6</span>s
                </span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-1.5 overflow-hidden">
                <div id="countdown-bar" class="bg-blue-600 h-1.5 rounded-full transition-all duration-1000 ease-linear" style="width: 100%;"></div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-3 items-center justify-center">
            <a href="{{ $redirectUrl }}" id="btn-redirect-now"
                class="cursor-pointer w-full sm:w-auto flex-1 inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-black hover:bg-gray-800 text-white text-sm font-bold rounded-xl shadow-md transition-all neo-hover active:scale-95">
                <i class="ph-bold ph-house-line text-lg"></i>
                <span>Go to {{ $destinationName }}</span>
            </a>

            <button type="button" onclick="window.history.length > 1 ? window.history.back() : window.location.href='{{ $redirectUrl }}'"
                class="cursor-pointer w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-3.5 bg-white hover:bg-gray-50 border border-gray-200 text-gray-700 text-sm font-semibold rounded-xl shadow-2xs transition-all active:scale-95">
                <i class="ph-bold ph-arrow-left text-base"></i>
                <span>Go Back</span>
            </button>

            <button type="button" id="toggle-countdown-btn" title="Pause or Resume Auto-Redirect"
                class="cursor-pointer w-full sm:w-auto inline-flex items-center justify-center gap-1.5 px-3 py-3.5 bg-white hover:bg-gray-50 border border-gray-200 text-gray-500 hover:text-gray-800 text-xs font-medium rounded-xl shadow-2xs transition-all">
                <i id="pause-icon" class="ph-bold ph-pause text-base"></i>
                <span id="pause-text" class="sm:hidden">Pause</span>
            </button>
        </div>

        <div class="mt-8 pt-6 border-t border-gray-100 text-center">
            <a href="{{ url('/') }}" class="cursor-pointer text-xs font-semibold text-gray-400 hover:text-gray-700 transition-colors inline-flex items-center gap-1.5">
                <i class="ph-bold ph-flask text-sm"></i>
                <span>Laboratory Management System</span>
            </a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const totalDuration = 6;
            let remainingSeconds = totalDuration;
            let isPaused = false;
            const targetUrl = "{{ $redirectUrl }}";
            const countdownEl = document.getElementById('countdown-seconds');
            const countdownBar = document.getElementById('countdown-bar');
            const toggleBtn = document.getElementById('toggle-countdown-btn');
            const pauseIcon = document.getElementById('pause-icon');
            const pauseText = document.getElementById('pause-text');

            const timer = setInterval(() => {
                if (isPaused) return;

                remainingSeconds--;
                if (countdownEl) countdownEl.textContent = remainingSeconds;

                if (countdownBar) {
                    const percentage = Math.max(0, (remainingSeconds / totalDuration) * 100);
                    countdownBar.style.width = percentage + '%';
                }

                if (remainingSeconds <= 0) {
                    clearInterval(timer);
                    window.location.href = targetUrl;
                }
            }, 1000);

            if (toggleBtn) {
                toggleBtn.addEventListener('click', () => {
                    isPaused = !isPaused;
                    if (isPaused) {
                        if (pauseIcon) pauseIcon.className = "ph-bold ph-play text-base text-blue-600";
                        if (pauseText) pauseText.textContent = "Resume";
                        toggleBtn.classList.add('border-blue-300', 'bg-blue-50');
                    } else {
                        if (pauseIcon) pauseIcon.className = "ph-bold ph-pause text-base text-gray-500";
                        if (pauseText) pauseText.textContent = "Pause";
                        toggleBtn.classList.remove('border-blue-300', 'bg-blue-50');
                    }
                });
            }
        });
    </script>
</body>
</html>
