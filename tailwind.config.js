import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import typography from "@tailwindcss/typography";

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: "class",

    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Inter", ...defaultTheme.fontFamily.sans],
            },
            // =================================================================
            // INI ADALAH PERBAIKAN UTAMA
            // Sekarang kita memberitahu Tailwind untuk MENGGUNAKAN CSS Variables
            // yang kita definisikan di dalam plugin di bawah.
            // Sintaks `hsl(var(...) / <alpha-value>)` memastikan opacity
            // seperti `bg-primary/50` tetap berfungsi.
            // =================================================================
            colors: {
                primary: "hsl(var(--primary) / <alpha-value>)",
                secondary: "hsl(var(--secondary) / <alpha-value>)",
                accent: "hsl(var(--accent) / <alpha-value>)",
                neutral: "hsl(var(--neutral) / <alpha-value>)",
                "base-100": "hsl(var(--base-100) / <alpha-value>)",
                "base-200": "hsl(var(--base-200) / <alpha-value>)",
                "base-300": "hsl(var(--base-300) / <alpha-value>)",

                info: "hsl(var(--info) / <alpha-value>)",
                success: "hsl(var(--success) / <alpha-value>)",
                warning: "hsl(var(--warning) / <alpha-value>)",
                error: "hsl(var(--error) / <alpha-value>)",
            },
        },
    },

    plugins: [
        forms,
        typography,
        // Plugin ini MENDEFINISIKAN nilai variabel untuk setiap tema
        function ({ addBase, theme }) {
            addBase({
                ":root": {
                    // Definisi Warna untuk Light Mode (Default)
                    "--primary": "255 69% 65%", // #7F5AF0
                    "--secondary": "35 100% 70%", // #FFB86B
                    "--accent": "163 60% 72%", // #72DEC2
                    "--neutral": "225 33% 21%", // #232946
                    "--base-100": "0 0% 100%", // #FFFFFF
                    "--base-200": "240 5% 96%", // #F4F4F5
                    "--base-300": "240 5% 90%", // #E4E4E7

                    "--info": "199 98% 58%", // #3ABFF8
                    "--success": "145 63% 49%", // #2ECC71
                    "--warning": "36 90% 55%", // #F39C12
                    "--error": "354 79% 59%", // #E74C3C
                },
                ".dark": {
                    // Definisi Warna untuk Dark Mode
                    "--primary": "252 94% 85%", // #C4B5FD
                    "--secondary": "30 100% 87%", // #FFDABF
                    "--accent": "151 58% 77%", // #9EEBCF
                    "--neutral": "0 0% 88%", // #E0E0E0
                    "--base-100": "222 47% 11%", // #111827
                    "--base-200": "215 28% 17%", // #1F2937
                    "--base-300": "217 19% 27%", // #374151
                },
            });
        },
    ],
};
