import "./bootstrap";
import Alpine from "alpinejs";

window.Alpine = Alpine;
Alpine.start();

// --- Theme Toggle Logic ---
document.addEventListener("DOMContentLoaded", () => {
    const themeToggleBtn = document.getElementById("theme-toggle");
    if (!themeToggleBtn) {
        return;
    }

    const themeToggleDarkIcon = document.getElementById(
        "theme-toggle-dark-icon"
    );
    const themeToggleLightIcon = document.getElementById(
        "theme-toggle-light-icon"
    );

    const updateIcon = () => {
        if (document.documentElement.classList.contains("dark")) {
            themeToggleDarkIcon.classList.remove("hidden");
            themeToggleLightIcon.classList.add("hidden");
        } else {
            themeToggleDarkIcon.classList.add("hidden");
            themeToggleLightIcon.classList.remove("hidden");
        }
    };

    themeToggleBtn.addEventListener("click", () => {
        const isDark = document.documentElement.classList.toggle("dark");
        localStorage.setItem("color-theme", isDark ? "dark" : "light");
        updateIcon();
    });

    // Set initial icon state on page load
    updateIcon();
});
