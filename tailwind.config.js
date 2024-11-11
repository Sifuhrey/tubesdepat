import defaultTheme from "tailwindcss/defaultTheme";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
        },
    },
    plugins: [],

    theme: {
        extend: {
            colors: {
                "custom-coklat": "#cdb77f",
            },
        },
    },
    extend: {
        fontFamily: {
            abeezee: ["ABeeZee", "sans-serif"],
        },
    },
    extend: {
        borderRadius: {
            half: "50%"
        },
    },
};
