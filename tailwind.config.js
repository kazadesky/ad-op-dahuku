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
                'hitam': '#1e1f1e',
                'white-text': '#f6f6f6',
                'elf-green': '#098666',
                'dark-elf': '#076c53',
                'flush-mahogany': '#c83c3a',
                'dark-flush': '#a33230',
                'background': '#f0ffff',
                'dark-blue': '#111439',
                'neon-blue': '#2272ff',
            }
        },
    },
    plugins: [],
}

