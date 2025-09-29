document.addEventListener("DOMContentLoaded", () => {
    const sidebar = document.getElementById("sidebar");
    const mainContent = document.getElementById("main-content");
    const mainNav = document.getElementById("main-nav");
    const toggleBtn = document.getElementById("sidebarToggle");
    const overlay = document.getElementById("overlay");
    const toggleIcon = toggleBtn ? toggleBtn.querySelector("i") : null;

    // بررسی وجود عناصر
    if (!sidebar || !mainContent || !mainNav || !toggleBtn || !overlay) {
        console.error("یکی از عناصر اصلی پیدا نشد:", { sidebar, mainContent, mainNav, toggleBtn, overlay });
        return;
    }

    if (!toggleIcon) {
        console.warn("آیکون دکمه پیدا نشد، از فال‌بک استفاده می‌شود");
        const fallbackIcon = document.createElement("i");
        fallbackIcon.setAttribute("data-lucide", "menu");
        fallbackIcon.className = "w-6 h-6";
        toggleBtn.appendChild(fallbackIcon);
    }

    let isSidebarOpen = window.innerWidth >= 768; // دسکتاپ: باز، موبایل: بسته

    const updateSidebar = () => {
        console.log("به‌روزرسانی سایدبار، وضعیت:", isSidebarOpen);
        sidebar.classList.remove("translate-x-0", "-translate-x-full");
        if (isSidebarOpen) {
            sidebar.style.transform = "translateX(0)";
            sidebar.classList.add("translate-x-0");
            mainContent.classList.add("md:ml-64");
            mainNav.classList.add("md:ml-64");
            overlay.classList.toggle("hidden", window.innerWidth >= 768);
            if (toggleIcon) toggleIcon.setAttribute("data-lucide", "x");
        } else {
            sidebar.style.transform = "translateX(-100%)";
            sidebar.classList.add("-translate-x-full");
            mainContent.classList.remove("md:ml-64");
            mainNav.classList.remove("md:ml-64");
            overlay.classList.add("hidden");
            if (toggleIcon) toggleIcon.setAttribute("data-lucide", "menu");
        }
        try {
            lucide.createIcons();
        } catch (error) {
            console.error("خطا در lucide.createIcons:", error);
        }
        console.log("استایل فعلی سایدبار:", sidebar.className, getComputedStyle(sidebar).transform);
    };

    // تنظیم اولیه
    updateSidebar();

    // رویداد کلیک برای دکمه
    toggleBtn.addEventListener("click", (e) => {
        e.preventDefault();
        isSidebarOpen = !isSidebarOpen;
        console.log("دکمه کلیک شد، وضعیت جدید سایدبار:", isSidebarOpen);
        updateSidebar();
    });

    // رویداد کلیک برای overlay
    overlay.addEventListener("click", () => {
        isSidebarOpen = false;
        console.log("overlay کلیک شد، سایدبار بسته می‌شود");
        updateSidebar();
    });

    // مدیریت تغییر اندازه صفحه
    window.addEventListener("resize", () => {
        const wasOpen = isSidebarOpen;
        isSidebarOpen = window.innerWidth >= 768;
        if (wasOpen !== isSidebarOpen) {
            console.log("تغییر اندازه صفحه، وضعیت سایدبار:", isSidebarOpen);
            updateSidebar();
        }
    });
});