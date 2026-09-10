document.addEventListener("DOMContentLoaded", () => {
    const getUserId = () => {
        return (
            document
                .querySelector('meta[name="user-id"]')
                ?.getAttribute("content") || ""
        );
    };

    const getCsrfToken = () => {
        return (
            document
                .querySelector('meta[name="csrf-token"]')
                ?.getAttribute("content") || ""
        );
    };

    const getFetchHeaders = () => ({
        Accept: "application/json",
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": getCsrfToken(),
    });

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

        if (isError) {
            inputElement.classList.remove("border-green-500", "border-gray-400");
            inputElement.classList.add("border-red-500");
        } else {
            inputElement.classList.remove("border-red-500", "border-gray-400");
            inputElement.classList.add("border-green-500");
        }

        parent.appendChild(msgEl);
        setTimeout(() => {
            if (msgEl && msgEl.parentNode) msgEl.remove();
            inputElement.classList.remove("border-red-500", "border-green-500");
            inputElement.classList.add("border-gray-400");
        }, 3000);
    }

    function showTemporaryFormErrors(form, errors) {
        for (const [key, messages] of Object.entries(errors)) {
            const input = form.querySelector(`[name="${key}"]`);
            if (input) displayTemporaryMessage(input, messages[0], true);
        }
    }

    document
        .querySelectorAll(
            "#section-settings .toggle-password, #UpdatePasswordForm .toggle-password"
        )
        .forEach((icon) => {
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

    const emailForm = document.getElementById("UpdateEmailForm");
    emailForm?.addEventListener("submit", async (e) => {
        e.preventDefault();
        const form = e.target;
        const btn = document.getElementById("btnSaveEmail");
        const originalHtml = btn.innerHTML;
        btn.innerHTML = `<i class="ph-bold ph-spinner animate-spin mr-1"></i> Saving`;
        btn.disabled = true;

        const emailInput = form.querySelector('input[name="email"]');
        const payload = {
            email: emailInput.value,
        };

        const currentUserId = getUserId();
        if (!currentUserId) {
            displayTemporaryMessage(emailInput, "User not authenticated.", true);
            btn.innerHTML = originalHtml;
            btn.disabled = false;
            return;
        }

        try {
            const response = await fetch(`/user/${currentUserId}/email`, {
                method: "PUT",
                headers: getFetchHeaders(),
                body: JSON.stringify(payload),
            });
            const result = await response.json();

            if (response.status === 422) {
                showTemporaryFormErrors(form, result.errors || {});
            } else if (
                response.ok &&
                (result.success === true ||
                    result.status === 200 ||
                    result.status === true)
            ) {
                displayTemporaryMessage(
                    emailInput,
                    result.message || "Email updated successfully!",
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
            displayTemporaryMessage(
                emailInput,
                "Network error occurred.",
                true
            );
        } finally {
            btn.innerHTML = originalHtml;
            btn.disabled = false;
        }
    });

    const passwordForm = document.getElementById("UpdatePasswordForm");
    passwordForm?.addEventListener("submit", async (e) => {
        e.preventDefault();
        const form = e.target;
        const btn = document.getElementById("btnSavePassword");
        const originalHtml = btn.innerHTML;
        btn.innerHTML = `<i class="ph-bold ph-spinner animate-spin mr-1"></i> Updating`;
        btn.disabled = true;

        const currentPassInput = form.querySelector('input[name="password"]');
        const newPassInput = form.querySelector('input[name="newPassword"]');
        const payload = {
            password: currentPassInput.value,
            newPassword: newPassInput.value,
        };

        const currentUserId = getUserId();
        if (!currentUserId) {
            displayTemporaryMessage(newPassInput, "User not authenticated.", true);
            btn.innerHTML = originalHtml;
            btn.disabled = false;
            return;
        }

        try {
            const response = await fetch(`/user/${currentUserId}/password`, {
                method: "PUT",
                headers: getFetchHeaders(),
                body: JSON.stringify(payload),
            });
            const result = await response.json();

            if (response.status === 422) {
                showTemporaryFormErrors(form, result.errors || {});
            } else if (
                response.status === 400 ||
                result.status === 400 ||
                (result.success === false && result.message)
            ) {
                displayTemporaryMessage(
                    currentPassInput,
                    result.message || "Current password does not match",
                    true
                );
            } else if (
                response.ok &&
                (result.success === true ||
                    result.status === 200 ||
                    result.status === true)
            ) {
                displayTemporaryMessage(
                    newPassInput,
                    result.message || "Password updated successfully!",
                    false
                );
                form.reset();
            } else {
                displayTemporaryMessage(
                    newPassInput,
                    result.message || "Failed to update password.",
                    true
                );
            }
        } catch (error) {
            displayTemporaryMessage(
                newPassInput,
                "Network error occurred.",
                true
            );
        } finally {
            btn.innerHTML = originalHtml;
            btn.disabled = false;
        }
    });
});
