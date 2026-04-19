<x-header />

<body
    class="font-sans antialiased bg-mainBg text-gray-800 flex items-center justify-center min-h-screen relative overflow-hidden">

    <div
        class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-blue-500 rounded-full mix-blend-multiply filter blur-[128px] opacity-20 animate-pulse">
    </div>
    <div class="absolute bottom-[-10%] right-[-10%] w-96 h-96 bg-gray-500 rounded-full mix-blend-multiply filter blur-[128px] opacity-20 animate-pulse"
        style="animation-delay: 2s;"></div>

    <div
        class="w-full max-w-md p-6 sm:p-10 relative z-10 bg-white/50 backdrop-blur-sm rounded-2xl shadow-sm border border-gray-100">

        <div class="mb-8 text-center">
            <div
                class="w-16 h-16 bg-black text-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                <i class="ph-duotone ph-shield-check text-3xl"></i>
            </div>
            <h2 class="text-3xl font-extrabold text-black tracking-tight mb-2">Two-Step Verification</h2>
            <p class="text-gray-500 font-medium text-sm px-4">
                We've sent an 8-digit security code to your email. Please enter it below to securely log in.
            </p>
        </div>

        <form id="verify-form" method="POST" action="{{ Route('VerifyCode') }}">

            <div class="flex flex-col space-y-2 mb-6">
                <label for="VerificationCode" class="font-bold text-black text-sm text-center">Security Code</label>
                <div class="relative">
                    <input type="text" id="VerificationCode" name="VerificationCode" maxlength="8"
                        autocomplete="one-time-code"
                        class="text-center tracking-[0.5em] sm:tracking-[0.75em] text-2xl font-mono bg-inputBg border border-transparent rounded-lg py-4 text-gray-800 font-bold placeholder-gray-300 focus:outline-none focus:bg-white focus:ring-2 focus:ring-gray-300 focus:border-transparent w-full transition-all"
                        placeholder="••••••••">
                </div>
                <p class="text-red-500 text-xs font-semibold mt-2 text-center hidden" id="error-code"></p>
            </div>

            <button type="submit" id="verify-btn"
                class="cursor-pointer w-full py-3.5 bg-black text-white rounded-lg font-semibold hover:bg-gray-800 focus:ring-4 focus:ring-gray-200 transition-all flex justify-center items-center gap-2">
                <span>Verify </span>

            </button>
        </form>

        <div class="mt-8 text-center">
            <p class="text-sm text-gray-500 font-medium">
                Didn't receive the code?
                <a href="route{{ 'login' }}"
                    class="text-black font-bold hover:underline transition-all cursor-pointer decoration-0">Go back to
                    Login</a>
            </p>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const verifyForm = document.getElementById('verify-form');
            const errorCode = document.getElementById('error-code');
            const verifyBtn = document.getElementById('verify-btn');
            const codeInput = document.getElementById('VerificationCode');
            codeInput.addEventListener('input', function (e) {
                this.value = this.value.replace(/[^0-9]/g, '');
            });

            verifyForm.addEventListener('submit', async (e) => {
                e.preventDefault();

                errorCode.textContent = '';
                errorCode.classList.add('hidden');

                const originalBtnHtml = verifyBtn.innerHTML;
                verifyBtn.innerHTML = '<i class="ph-bold ph-spinner animate-spin text-xl"></i> Verifying';
                verifyBtn.disabled = true;

                const formData = new FormData(verifyForm);

                try {
                    const response = await fetch(verifyForm.action, {
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
                            if (data.errors.VerificationCode) {
                                errorCode.textContent = data.errors.VerificationCode[0];
                                errorCode.classList.remove('hidden');
                            }
                        } else if (data.message) {
                            errorCode.textContent = data.message;
                            errorCode.classList.remove('hidden');
                        }
                    } else {
                        window.location.replace(data.redirect_url);
                    }
                } catch (err) {
                    console.error('Verification failed:', err);
                    alert('Something went wrong. Please try again later.');
                } finally {
                    verifyBtn.innerHTML = originalBtnHtml;
                    verifyBtn.disabled = false;
                }
            });
        });
    </script>
</body>