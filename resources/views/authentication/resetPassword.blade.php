<x-header />

<body class="font-sans antialiased bg-mainBg text-gray-800 flex min-h-screen">

    <div class="hidden lg:flex lg:w-1/2 relative bg-sidebarBg items-center justify-center overflow-hidden">
        <img src="https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&q=80&w=1200"
            alt="Lab Background" class="absolute inset-0 w-full h-full object-cover opacity-30 mix-blend-overlay">

        <div class="relative z-10 px-12 text-center">
            <h1 class="text-white text-5xl font-extrabold tracking-tight mb-6">My Lab</h1>
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
                <h2 class="text-3xl font-extrabold text-black tracking-tight mb-2">Create new password</h2>
                <p class="text-gray-500 font-medium text-sm">Your new password must be different from previous used
                    passwords.</p>
            </div>

            <form id="reset-password-form" method="POST" action="{{ route('resetPassword') }}" class="space-y-6">



                <div class="flex flex-col space-y-2 relative">
                    <label for="password" class="font-bold text-black text-sm">New Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="ph-duotone ph-lock-key text-xl text-gray-400"></i>
                        </div>
                        <input type="password" id="password" name="password" required autofocus
                            class="bg-inputBg border border-transparent rounded-lg pl-12 pr-12 py-3.5 text-gray-800 font-medium placeholder-gray-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-gray-300 focus:border-transparent w-full transition-all"
                            placeholder="Must be at least 8 characters">

                        <button type="button"
                            class="toggle-password absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none"
                            data-target="password">
                            <i class="ph-duotone ph-eye text-xl"></i>
                        </button>
                    </div>
                    <p class="text-red-500 text-xs font-semibold mt-1 hidden" id="error-password">
                        The password must be at least 8 characters.
                    </p>
                </div>

                <div class="flex flex-col space-y-2 relative">
                    <label for="password_confirmation" class="font-bold text-black text-sm">Confirm Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="ph-duotone ph-lock-key text-xl text-gray-400"></i>
                        </div>
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                            class="bg-inputBg border border-transparent rounded-lg pl-12 pr-12 py-3.5 text-gray-800 font-medium placeholder-gray-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-gray-300 focus:border-transparent w-full transition-all"
                            placeholder="Both passwords must match">

                        <button type="button"
                            class="toggle-password absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none"
                            data-target="password_confirmation">
                            <i class="ph-duotone ph-eye text-xl"></i>
                        </button>
                    </div>
                </div>

                <button type="submit"
                    class="w-full py-3.5 bg-black text-white rounded-lg font-semibold hover:bg-gray-800 focus:ring-4 focus:ring-gray-200 transition-all flex justify-center items-center gap-2">
                    Reset Password

                </button>
            </form>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // --- Password Visibility Toggle Logic ---
            const toggleButtons = document.querySelectorAll('.toggle-password');

            toggleButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const targetId = this.getAttribute('data-target');
                    const passwordInput = document.getElementById(targetId);

                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);

                    const icon = this.querySelector('i');
                    icon.classList.toggle('ph-eye');
                    icon.classList.toggle('ph-eye-slash');
                });
            });

            // --- Form Submission & API Logic ---
            const resetForm = document.getElementById('reset-password-form');
            const errorPassword = document.getElementById('error-password');
            const submitBtn = resetForm.querySelector('button[type="submit"]');

            resetForm.addEventListener('submit', async (e) => {
                e.preventDefault();

                // 1. Reset previous errors
                errorPassword.textContent = '';
                errorPassword.classList.add('hidden');

                // 2. Set button to loading state
                const originalBtnHtml = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="ph-bold ph-spinner animate-spin text-xl"></i> Processing...';
                submitBtn.disabled = true;

                const formData = new FormData(resetForm);

                try {
                    const response = await fetch(resetForm.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        },
                        body: formData
                    });

                    const data = await response.json();

                    if (!response.ok) {
                        // 3. Handle Laravel Validation Errors (e.g., passwords don't match, or < 8 chars)
                        if (response.status === 422 && data.errors) {
                            if (data.errors.password) {
                                errorPassword.textContent = data.errors.password[0];
                                errorPassword.classList.remove('hidden');
                            }
                        }
                        // Handle general backend errors (e.g., Unauthorized/Session Expired)
                        else if (data.message) {
                            errorPassword.textContent = data.message;
                            errorPassword.classList.remove('hidden');
                        }

                        // Restore button state on error
                        submitBtn.innerHTML = originalBtnHtml;
                        submitBtn.disabled = false;
                    } else {
                        // 4. Success! Show a quick success state on the button
                        submitBtn.innerHTML = 'Password Reset Successful! <i class="ph-bold ph-check-circle text-lg"></i>';
                        submitBtn.classList.replace('bg-black', 'bg-green-600');
                        submitBtn.classList.replace('hover:bg-gray-800', 'hover:bg-green-500');

                        // Give the user 1 second to see the success message, then redirect
                        setTimeout(() => {
                            window.location.replace(data.redirect_url);
                        }, 1000);
                    }
                } catch (err) {
                    console.error('Password reset failed:', err);
                    alert('Something went wrong. Please check your connection and try again.');

                    submitBtn.innerHTML = originalBtnHtml;
                    submitBtn.disabled = false;
                }
            });
        });
    </script>
</body>

</html>