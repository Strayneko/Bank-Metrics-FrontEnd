/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        container: {
            center: true,
        },
        extend: {
            fontFamily: {
                poppins: ["Poppins", "sans-serif"],
            },
            colors: {
                orange: "#FF5927",
                navy: "#0F0742",
                gray: {
                    1: "#E0E0E0",
                    2: "#989898",
                    3: "#BDBDBD"
                }
            },
        },
    },
    plugins: [],
};
