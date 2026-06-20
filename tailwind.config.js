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
                sapphire: {
                    DEFAULT: '#3C507D',
                    light: '#526899',
                    dark: '#2A3C61',
                },
                royal: {
                    DEFAULT: '#112250',
                    light: '#1B316D',
                    dark: '#08122D',
                },
                quicksand: {
                    DEFAULT: '#E0C58F',
                    light: '#EDDAB4',
                    dark: '#C7A76D',
                },
                swan: {
                    DEFAULT: '#F5F0E9',
                    light: '#FAF7F4',
                    dark: '#EBE2D7',
                },
                shellstone: {
                    DEFAULT: '#D9CBC2',
                    light: '#E6DDD7',
                    dark: '#C0AF6E', // Or similar
                }
            }
        },
    },

    plugins: [forms],
};

