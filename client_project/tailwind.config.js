import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    darkMode : 'class',
    theme: {
        container: {
            center : true,
        },
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors : {
                primary : "#3b82f6",
                first : "#395886",
                second : "#628ECB",
                third : "#8AAEE0",
                fourth : "#B1C9EF",
                fifth : "#D5DEEF",
                sixth : "#F0F3FA",
                first_dark : "#006DA4",
                second_dark : "#006494",
                third_dark : "#004D74",
                fourth_dark : "#003554",
                fifth_dark : "#022B42",
                sixth_dark : "#032030",
              },
        },
    },
};
