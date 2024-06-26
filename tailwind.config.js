/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './storage/framework/vuews/*.php',
    './resources/views/**/*.blade.php',
    './resources/js/**/*.vue',
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require('@tailwindcss/forms')
  ],
}

