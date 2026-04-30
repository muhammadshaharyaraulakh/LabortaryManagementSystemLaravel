<div id="section-settings" class="content-section hidden animate-fade-in w-full max-w-2xl mx-auto px-4 py-6">
    <div class="flex items-center gap-3 mb-10">
        <div class="w-12 h-12 shrink-0 rounded-xl bg-gray-200 text-gray-700 flex items-center justify-center">
            <i class="ph-duotone ph-gear-six text-2xl"></i>
        </div>
        <div>
            <h2 class="text-2xl font-extrabold text-gray-800">Settings</h2>
            <p class="text-sm text-gray-500 font-medium">Manage email and password</p>
        </div>
    </div>

    <div class="flex flex-col w-full gap-10">
        <div class="flex flex-col gap-4 border-b border-gray-300 pb-10">
            <div class="flex items-center gap-2">
                <span
                    class="bg-gray-200 text-gray-700 w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold">1</span>
                <h3 class="text-lg font-bold text-gray-800">Update Email</h3>
            </div>
            <form id="UpdateEmailForm" class="flex flex-col gap-2">
                <div class="w-full">
                    <label class="text-sm font-bold text-gray-700 block mb-2">Email Address</label>
                    <div class="relative w-full">
                        <input type="email" name="email" id="userEmailInput" value="{{ auth()->user()->email ?? '' }}"
                            placeholder="dr.smith@gmail.com"
                            class="w-full border border-gray-400 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-400 outline-none bg-transparent transition-colors placeholder:text-gray-400">
                    </div>
                </div>
                <button type="submit" id="btnSaveEmail"
                    class="self-start cursor-pointer bg-sidebarBg hover:bg-gray-800 text-white px-6 py-2.5 rounded-xl text-sm font-bold transition-colors shadow-sm mt-2">
                    Save Email
                </button>
            </form>
        </div>

        <div class="flex flex-col gap-4 pb-10">
            <div class="flex items-center gap-2">
                <span
                    class="bg-gray-200 text-gray-700 w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold">2</span>
                <h3 class="text-lg font-bold text-gray-800">Update Password</h3>
            </div>
            <form id="UpdatePasswordForm" class="flex flex-col gap-4">
                <div class="flex flex-col gap-2">
                    <label class="text-sm font-bold text-gray-700">Current Password</label>
                    <div class="relative w-full">
                        <input type="password" name="password" placeholder="••••••••"
                            class="w-full border border-gray-400 rounded-xl px-4 py-3 pr-10 text-sm focus:ring-2 focus:ring-blue-400 outline-none bg-transparent transition-colors">
                        <i
                            class="ph ph-eye absolute right-4 top-3.5 text-lg cursor-pointer text-gray-500 hover:text-gray-800 transition-colors toggle-password"></i>
                    </div>
                </div>
                <div class="flex flex-col gap-2">
                    <label class="text-sm font-bold text-gray-700">New Password</label>
                    <div class="relative w-full">
                        <input type="password" name="newPassword" placeholder="••••••••"
                            class="w-full border border-gray-400 rounded-xl px-4 py-3 pr-10 text-sm focus:ring-2 focus:ring-blue-400 outline-none bg-transparent transition-colors">
                        <i
                            class="ph ph-eye absolute right-4 top-3.5 text-lg cursor-pointer text-gray-500 hover:text-gray-800 transition-colors toggle-password"></i>
                    </div>
                </div>
                <button type="submit" id="btnSavePassword"
                    class="self-start cursor-pointer bg-sidebarBg hover:bg-gray-800 text-white px-6 py-2.5 rounded-xl text-sm font-bold transition-colors shadow-sm mt-2">
                    Update Password
                </button>
            </form>
        </div>
    </div>
</div>