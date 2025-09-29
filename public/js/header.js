document.addEventListener("DOMContentLoaded", () => {
    const header = document.getElementById("header");

    // گوش دادن به تغییر سایدبار
    window.addEventListener("sidebarToggled", (e) => {
        const { collapsed } = e.detail;
        if (collapsed) {
            header.classList.add("sidebar-collapsed");
        } else {
            header.classList.remove("sidebar-collapsed");
        }
    });
});
