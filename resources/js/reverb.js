// Echo removed

/**
 * Modern Toast Notification System
 */
function showToast(title, message, type = 'error') {
    let container = document.getElementById('toast-container');
    if (!container) {
        container = document.createElement('div');
        container.id = 'toast-container';
        container.className = 'fixed top-5 right-5 z-[9999] flex flex-col gap-3 pointer-events-none';
        document.body.appendChild(container);
    }

    const toast = document.createElement('div');
    toast.className = `pointer-events-auto bg-white/95 backdrop-blur-md border-l-4 ${type === 'error' ? 'border-red-500' : 'border-blue-500'} shadow-[0_10px_40px_rgba(0,0,0,0.1)] rounded-xl p-4 min-w-[320px] max-w-md animate-toast-slide-in flex items-start gap-4 group transition-all duration-300 hover:scale-[1.02]`;

    const icon = type === 'error' ? 'ph-warning-circle' : 'ph-info';
    const iconColor = type === 'error' ? 'text-red-500' : 'text-blue-500';

    toast.innerHTML = `
        <div class="flex-shrink-0 mt-1">
            <i class="ph-fill ${icon} ${iconColor} text-2xl"></i>
        </div>
        <div class="flex-1 min-w-0">
            <h4 class="text-sm font-bold text-gray-900 leading-tight">${title}</h4>
            <p class="text-xs text-gray-500 mt-1 font-medium leading-relaxed whitespace-pre-line">${message}</p>
        </div>
        <button class="flex-shrink-0 text-gray-400 hover:text-gray-600 transition-colors cursor-pointer p-1 rounded-lg hover:bg-gray-100">
            <i class="ph-bold ph-x text-sm"></i>
        </button>
        <div class="absolute bottom-0 left-0 h-1 ${type === 'error' ? 'bg-red-500/20' : 'bg-blue-500/20'} w-full rounded-b-xl overflow-hidden">
            <div class="h-full ${type === 'error' ? 'bg-red-500' : 'bg-blue-500'} transition-all duration-[10000ms] ease-linear" style="width: 100%;"></div>
        </div>
    `;

    const closeBtn = toast.querySelector('button');
    const progressBar = toast.querySelector('.absolute > div');

    const removeToast = () => {
        toast.style.opacity = '0';
        toast.style.transform = 'translateX(100%)';
        setTimeout(() => toast.remove(), 300);
    };

    closeBtn.onclick = removeToast;
    container.appendChild(toast);

    // Start progress bar animation (shrink)
    requestAnimationFrame(() => {
        progressBar.style.width = '0%';
    });


    // Auto remove after 10s
    setTimeout(() => {
        if (toast.parentElement) removeToast();
    }, 10000);
}