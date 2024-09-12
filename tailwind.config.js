/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                'inter': ['Inter', 'sans-serif'],
                'lato': ['Lato', 'sans-serif'],
                'poppins': ['Poppins', 'sans-serif'],
                'roboto': ['Roboto', 'sans-serif'],
            },
            colors: {
                'hitam': '#2C3E50',
                'emas': '#F39C12',
                'abu-muda': '#BDC3C7',
                'abu-gelap': '#7F8C8D',
            }
        },
    },
    plugins: [],
}

