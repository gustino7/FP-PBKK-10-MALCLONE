import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'mal-blue': '#2F52A2',
                'link-blue': '#007BFF',
            },
            maxWidth: {
                'custom': '75.5rem', // 86rem is 528px, which is in between 6xl and 7xl
            },
            statusCircle: {
                width: '12px',
                height: '12px',
                display: 'inline-block',
                borderRadius: '50%',
                marginRight: '5px',
            },
        },
    },

    plugins: [forms],
};
