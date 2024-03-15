/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./src/**/*.{js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      backgroundColor: {
        'red-dark': 'rgb(119, 45, 47)',
        'white-transparent': 'rgba(255, 255, 255, 0.3)',
      },
    },
  },
  plugins: [],
};


