/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./*.{html,js,php}"],
  theme: {
    fontFamily: {
      'poppins': ['Poppins', 'sans-serif'],
    },
    extend: {
      backgroundImage: {
        'main-bg': "url('./src/images/bg.webp')",
      }
    },
  },
  plugins: [],
}

