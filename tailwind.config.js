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

      container: {
        screens: {
          xl: "1284px",
        },
        center:true,
      },
      fontFamily: {
        "neuton" : "neuton",
        "poppins" : "Poppins",
      }
    },
    },
    plugins: [],
};
