/** @type {import('tailwindcss').Config} */
module.exports = {
    darkMode: 'class', // Enables dark mode via a .dark class on <html> or <body>
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            colors: {
                sidebar: '#f0f4ff', // light mode sidebar
                'sidebar-dark': '#1f2937', // dark mode sidebar
            }
        },
    },
    plugins: [],
}
