<x-header />

<body class="font-sans antialiased bg-mainBg text-gray-800 flex min-h-screen">

    <div class="hidden lg:flex lg:w-1/2 relative bg-sidebarBg items-center justify-center overflow-hidden">
        <img src="{{ asset('images/login.avif') }}" alt="Lab Background"
            class="absolute inset-0 w-full h-full object-cover opacity-30 mix-blend-overlay">

        <div class="relative z-10 px-12 text-center">
            <h1 class="text-white text-5xl font-extrabold tracking-tight mb-6">Laboratory Management System</h1>
            <p class="text-gray-300 text-lg font-medium max-w-md mx-auto">
                Securely access your dashboard to manage patients, test results, and laboratory logistics.
            </p>
        </div>

        <div
            class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-blue-500 rounded-full mix-blend-multiply filter blur-[128px] opacity-40 animate-pulse">
        </div>
    </div>

    <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12 relative z-10">
        <div class="w-full max-w-md p-4 sm:p-8">

            <div class="mb-8">
                <h2 class="text-3xl font-extrabold text-black tracking-tight mb-2">Welcome back</h2>
                <p class="text-gray-500 font-medium text-sm">Please enter your details to log in.</p>
            </div>

            <form id="login-form" method="POST" action="{{ route('login') }}">

                <div class="flex flex-col space-y-2 relative mb-4">
                    <label for="email" class="font-bold text-black text-sm">Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="ph-duotone ph-envelope text-xl text-gray-400"></i>
                        </div>
                        <input type="text" id="email" name="email" value="{{ old('email') }}"
                            class="text-lg bg-inputBg border border-transparent rounded-lg pl-12 pr-4 py-3.5 text-gray-800 font-medium placeholder-gray-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-gray-300 focus:border-transparent w-full transition-all"
                            placeholder="Enter your email">
                    </div>
                    <p class="text-red-500 text-xs font-semibold mt-1 hidden" id="error-email"></p>
                </div>

                <div class="flex flex-col space-y-2 mb-6">
                    <div class="flex justify-between items-center">
                        <label for="password" class="font-bold text-black text-sm">Password</label>
                        <a href="{{ route('forgetPassword') }}"
                            class="cursor-pointer text-xs font-semibold text-gray-500 hover:text-black transition-colors">Forgot
                            password?</a>
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="ph-duotone ph-lock-key text-xl text-gray-400"></i>
                        </div>
                        <input type="password" id="password" name="password"
                            class="text-lg bg-inputBg border border-transparent rounded-lg pl-12 pr-12 py-3.5 text-gray-800 font-medium placeholder-gray-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-gray-300 focus:border-transparent w-full transition-all"
                            placeholder="••••••••">

                        <button type="button" id="toggle-password"
                            class="cursor-pointer absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none">
                            <i class="ph-duotone ph-eye text-xl"></i>
                        </button>
                    </div>
                    <p class="text-red-500 text-xs font-semibold mt-1 hidden" id="error-password"></p>
                </div>

                <button type="submit" id="submit-btn"
                    class="cursor-pointer w-full py-3.5 bg-black text-white rounded-lg font-semibold hover:bg-gray-800 focus:ring-4 focus:ring-gray-200 transition-all flex justify-center items-center gap-2">
                    <span>Log In</span>
                    <i class="ph-bold ph-arrow-right text-lg"></i>
                </button>
            </form>

            <div class="mt-8 flex items-center justify-center">
                <div class="border-t border-gray-300 grow"></div>
                <span class="px-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Or continue with</span>
                <div class="border-t border-gray-300 grow"></div>
            </div>

            <div class="mt-6 grid grid-cols-3 gap-4">

                <a href="{{ route('google.redirect') }}"
                    class="cursor-pointer flex justify-center items-center py-2.5 border border-gray-300 rounded-lg hover:bg-gray-100 hover:border-gray-400 transition-colors">

                    <img src="{{ asset('images/google.png') }}" alt="Google" class="w-6 h-6">
                </a>

                <a href="{{ route('github.redirect') }}"
                    class="cursor-pointer flex justify-center items-center py-2.5 border border-gray-300 rounded-lg hover:bg-gray-100 hover:border-gray-400 transition-colors text-black">

                    <img src="{{ asset('images/github.png') }}" alt="Github" class="w-6 h-6">
                </a>

            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const loginForm = document.getElementById('login-form');
            const errorEmail = document.getElementById('error-email');
            const errorPassword = document.getElementById('error-password');
            const togglePassword = document.getElementById('toggle-password');
            const passwordInput = document.getElementById('password');
            const submitBtn = document.getElementById('submit-btn');

            togglePassword.addEventListener('click', () => {
                const type = passwordInput.type === 'password' ? 'text' : 'password';
                passwordInput.type = type;
                togglePassword.querySelector('i').classList.toggle('ph-eye');
                togglePassword.querySelector('i').classList.toggle('ph-eye-slash');
            });

            loginForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                errorEmail.textContent = '';
                errorEmail.classList.add('hidden');
                errorPassword.textContent = '';
                errorPassword.classList.add('hidden');
                const originalBtnHtml = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="ph-bold ph-spinner animate-spin text-xl"></i> Sending Code';
                submitBtn.disabled = true;

                const formData = new FormData(loginForm);

                try {
                    const response = await fetch(loginForm.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        },
                        body: formData
                    });

                    const data = await response.json();

                    if (!response.ok) {
                        if (response.status === 422 && data.errors) {
                            if (data.errors.email) {
                                errorEmail.textContent = data.errors.email[0];
                                errorEmail.classList.remove('hidden');
                            }
                            if (data.errors.password) {
                                errorPassword.textContent = data.errors.password[0];
                                errorPassword.classList.remove('hidden');
                            }
                        } else if (data.message) {
                            errorEmail.textContent = data.message;
                            errorEmail.classList.remove('hidden');
                        }
                    } else {
                        window.location.href = data.redirect_url;
                    }
                } catch (err) {
                    console.error('Login failed:', err);
                    alert('Something went wrong. Please try again later.');
                } finally {
                    submitBtn.innerHTML = originalBtnHtml;
                    submitBtn.disabled = false;
                }
            });
        });
    </script>
</body>