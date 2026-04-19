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

                <h2 class="text-3xl font-extrabold text-black tracking-tight mb-2">Forgot Password?</h2>
                <p class="text-gray-500 font-medium text-sm">No worries, we'll send you reset instructions. Enter the
                    email associated with your account.</p>
            </div>

            <form id="forgot-password-form" method="POST" action="{{ route('forgotpassword') }}" class="space-y-6">


                <div class="flex flex-col space-y-2 relative">
                    <label for="email" class="font-bold text-black text-sm">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="ph-duotone ph-envelope text-xl text-gray-400"></i>
                        </div>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                            class="bg-inputBg border border-transparent rounded-lg pl-12 pr-4 py-3.5 text-gray-800 font-medium placeholder-gray-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-gray-300 focus:border-transparent w-full transition-all"
                            placeholder="Enter your email">
                    </div>
                    <p class="text-red-500 text-xs font-semibold mt-1 hidden" id="error-email">
                        We can't find a user with that email address.
                    </p>
                </div>

                <button type="submit"
                    class="w-full py-3.5 bg-black text-white rounded-lg font-semibold hover:bg-gray-800 focus:ring-4 focus:ring-gray-200 transition-all flex justify-center items-center gap-2">
                    Send Verfication Code

                </button>
            </form>

            <div class="mt-8 text-center">
                <a href="/login"
                    class="text-sm font-semibold text-gray-500 hover:text-black transition-colors flex items-center justify-center gap-2">
                    <i class="ph-bold ph-arrow-left text-base"></i>
                    Back to log in
                </a>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const forgotForm = document.getElementById('forgot-password-form');
            const errorEmail = document.getElementById('error-email');
            const submitBtn = forgotForm.querySelector('button[type="submit"]');

            forgotForm.addEventListener('submit', async (e) => {
                e.preventDefault();

                // 1. Reset previous errors
                errorEmail.textContent = '';
                errorEmail.classList.add('hidden');

                // 2. Set button to loading state
                const originalBtnHtml = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="ph-bold ph-spinner animate-spin text-xl"></i> Sending Code...';
                submitBtn.disabled = true;

                const formData = new FormData(forgotForm);

                try {
                    const response = await fetch(forgotForm.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        },
                        body: formData
                    });

                    const data = await response.json();

                    if (!response.ok) {
                        // 3. Handle Laravel Validation Errors (e.g., empty or invalid email)
                        if (response.status === 422 && data.errors) {
                            if (data.errors.email) {
                                errorEmail.textContent = data.errors.email[0];
                                errorEmail.classList.remove('hidden');
                            }
                        }
                        // Handle backend logic errors (e.g., user not found in DB)
                        else if (data.message) {
                            errorEmail.textContent = data.message;
                            errorEmail.classList.remove('hidden');
                        }

                        // Restore button state
                        submitBtn.innerHTML = originalBtnHtml;
                        submitBtn.disabled = false;
                    } else {
                        // 4. Success! Redirect to the single verification page
                        window.location.href = data.redirect_url;
                    }
                } catch (err) {
                    console.error('Request failed:', err);
                    alert('Something went wrong. Please check your connection and try again.');

                    submitBtn.innerHTML = originalBtnHtml;
                    submitBtn.disabled = false;
                }
            });
        });
    </script>
</body>

</html>