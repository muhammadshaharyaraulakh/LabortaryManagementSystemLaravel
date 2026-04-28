document.addEventListener("DOMContentLoaded", () => {
    const userId = document
        .querySelector('meta[name="user-id"]')
        ?.getAttribute("content");
    const csrfToken =
        document
            .querySelector('meta[name="csrf-token"]')
            ?.getAttribute("content") || "";
    const fetchHeaders = {
        Accept: "application/json",
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": csrfToken,
    };

    function displayTemporaryMessage(inputElement, message, isError = true) {
        if (!inputElement) return;
        const parent = inputElement.parentElement;
        const existingMsg = parent.querySelector(".temp-msg");
        if (existingMsg) existingMsg.remove();
        const msgEl = document.createElement("p");
        msgEl.className = `temp-msg text-xs mt-1 font-bold animate-fade-in ${
            isError ? "text-red-500" : "text-green-500"
        }`;
        msgEl.innerText = message;
        if (isError) inputElement.classList.add("border-red-500");
        parent.appendChild(msgEl);
        setTimeout(() => {
            if (msgEl && msgEl.parentNode) msgEl.remove();
            if (isError) inputElement.classList.remove("border-red-500");
        }, 3000);
    }

    function showTemporaryFormErrors(form, errors) {
        for (const [key, messages] of Object.entries(errors)) {
            const input = form.querySelector(`[name="${key}"]`);
            if (input) displayTemporaryMessage(input, messages[0], true);
        }
    }

    document.querySelectorAll(".toggle-password").forEach((icon) => {
        icon.addEventListener("click", function () {
            const input = this.previousElementSibling;
            if (input.type === "password") {
                input.type = "text";
                this.classList.replace("ph-eye", "ph-eye-slash");
                this.classList.add("text-blue-500");
            } else {
                input.type = "password";
                this.classList.replace("ph-eye-slash", "ph-eye");
                this.classList.remove("text-blue-500");
            }
        });
    });

    if (userId) {
        document
            .getElementById("UpdateEmailForm")
            ?.addEventListener("submit", async (e) => {
                e.preventDefault();
                const form = e.target;
                const btn = document.getElementById("btnSaveEmail");
                const originalText = btn.innerText;
                btn.innerHTML = `<i class="ph-bold ph-spinner animate-spin mr-1"></i> Saving`;
                btn.disabled = true;
                const payload = {
                    email: form.querySelector('input[name="email"]').value,
                };
                try {
                    const response = await fetch(`/user/${userId}/email`, {
                        method: "PUT",
                        headers: fetchHeaders,
                        body: JSON.stringify(payload),
                    });
                    const result = await response.json();
                    const emailInput = form.querySelector(
                        'input[name="email"]'
                    );
                    if (response.status === 422) {
                        showTemporaryFormErrors(form, result.errors);
                    } else if (response.ok && result.status === 200) {
                        displayTemporaryMessage(
                            emailInput,
                            "Email updated successfully!",
                            false
                        );
                    } else {
                        displayTemporaryMessage(
                            emailInput,
                            result.message || "Failed to update email.",
                            true
                        );
                    }
                } catch (error) {
                    const emailInput = form.querySelector(
                        'input[name="email"]'
                    );
                    displayTemporaryMessage(
                        emailInput,
                        "Network error occurred.",
                        true
                    );
                } finally {
                    btn.innerText = originalText;
                    btn.disabled = false;
                }
            });

        document
            .getElementById("UpdatePasswordForm")
            ?.addEventListener("submit", async (e) => {
                e.preventDefault();
                const form = e.target;
                const btn = document.getElementById("btnSavePassword");
                const originalText = btn.innerText;
                btn.innerHTML = `<i class="ph-bold ph-spinner animate-spin mr-1"></i> Updating`;
                btn.disabled = true;
                const payload = {
                    password: form.querySelector('input[name="password"]')
                        .value,
                    newPassword: form.querySelector('input[name="newPassword"]')
                        .value,
                };
                try {
                    const response = await fetch(`/user/${userId}/password`, {
                        method: "PUT",
                        headers: fetchHeaders,
                        body: JSON.stringify(payload),
                    });
                    const result = await response.json();
                    if (response.status === 422) {
                        showTemporaryFormErrors(form, result.errors);
                    } else if (result.status === 400) {
                        const currentPassInput = form.querySelector(
                            'input[name="password"]'
                        );
                        displayTemporaryMessage(
                            currentPassInput,
                            result.message,
                            true
                        );
                    } else if (response.ok && result.status === 200) {
                        const newPassInput = form.querySelector(
                            'input[name="newPassword"]'
                        );
                        displayTemporaryMessage(
                            newPassInput,
                            "Password updated successfully!",
                            false
                        );
                        form.reset();
                    } else {
                        const newPassInput = form.querySelector(
                            'input[name="newPassword"]'
                        );
                        displayTemporaryMessage(
                            newPassInput,
                            "Failed to update password.",
                            true
                        );
                    }
                } catch (error) {
                    const newPassInput = form.querySelector(
                        'input[name="newPassword"]'
                    );
                    displayTemporaryMessage(
                        newPassInput,
                        "Network error occurred.",
                        true
                    );
                } finally {
                    btn.innerText = originalText;
                    btn.disabled = false;
                }
            });
    }
});
