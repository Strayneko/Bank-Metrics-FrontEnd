/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        container: {
            screens: {
                xl: "1240px",
            },
            center: true,
        },
        extend: {
            fontFamily: {
                neuton: ["neuton", "sans-serif"],
                poppins: ["Poppins", "sans-serif"],
            },
            colors: {
                orange: {
                    1: "#FCC997",
                    2: "#FF5927",
                },
                navy: "#0F0742",
                gray: {
                    1: "#E0E0E0",
                    2: "#989898",
                    3: "#BDBDBD",
                },
            },
            keyframes: {
                spinLeft: {
                    from: { transform: "rotate(360deg)" },
                    to: { transform: "rotate(0deg)" },
                },
                loading: {
                    "50%": {
                        width: "60px",
                        height: "60px",
                        transform: "rotate(180deg)",
                    },
                    "100%": {
                        transform: "rotate(360deg)",
                    },
                },
            },
            animation: {
                spinLeft: "spinLeft 4.5s linear infinite",
                loading: "loading 1.5s infinite cubic-bezier(0.3, 1, 0, 1)",
            },
        },
    },
    plugins: [],
};
