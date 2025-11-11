document.addEventListener("DOMContentLoaded", () => {
    const header = document.getElementById("header");
    window.addEventListener("sidebarToggled", (e) => {
        const { collapsed } = e.detail;
        if (collapsed) {
            header.classList.add("sidebar-collapsed");
        } else {
            header.classList.remove("sidebar-collapsed");
        }
    });
});
