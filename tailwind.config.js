import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                brand: {
                    navy: '#001B3D',
                    green: '#43C900',
                    lime: '#9BE600',
                    'deep-green': '#00A52A',
                    white: '#FFFFFF',
                    'green-light': '#F3FFE8',
                    'green-soft': '#E8FFD3',
                },
            },
            backgroundImage: {
                'brand-gradient': 'linear-gradient(135deg, #9BE600 0%, #43C900 50%, #00A52A 100%)',
                'brand-navy-gradient': 'linear-gradient(135deg, #001B3D 0%, #002C55 100%)',
            },
            boxShadow: {
                'brand-green': '0 10px 25px -5px rgba(67, 201, 0, 0.35)',
            },
        },
    },

    plugins: [forms],
};
