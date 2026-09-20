import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
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

            keyframes: {
                fadeInUp: {
                    '0%':   { opacity: '0', transform: 'translateY(24px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                fadeIn: {
                    '0%':   { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                float: {
                    '0%, 100%': { transform: 'translateY(0px)' },
                    '50%':      { transform: 'translateY(-10px)' },
                },
                floatSlow: {
                    '0%, 100%': { transform: 'translateY(0px) rotate(-2deg)' },
                    '50%':      { transform: 'translateY(-14px) rotate(2deg)' },
                },
                floatDelay: {
                    '0%, 100%': { transform: 'translateY(0px)' },
                    '50%':      { transform: 'translateY(-8px)' },
                },
                shimmer: {
                    '0%':   { backgroundPosition: '-200% 0' },
                    '100%': { backgroundPosition: '200% 0' },
                },
                scaleIn: {
                    '0%':   { opacity: '0', transform: 'scale(0.92)' },
                    '100%': { opacity: '1', transform: 'scale(1)' },
                },
                slideInLeft: {
                    '0%':   { opacity: '0', transform: 'translateX(-24px)' },
                    '100%': { opacity: '1', transform: 'translateX(0)' },
                },
                slideInRight: {
                    '0%':   { opacity: '0', transform: 'translateX(24px)' },
                    '100%': { opacity: '1', transform: 'translateX(0)' },
                },
                pulseGold: {
                    '0%, 100%': { boxShadow: '0 0 6px rgba(251,191,36,0.3)' },
                    '50%':      { boxShadow: '0 0 22px rgba(251,191,36,0.7)' },
                },
                wiggle: {
                    '0%, 100%': { transform: 'rotate(-4deg)' },
                    '50%':      { transform: 'rotate(4deg)' },
                },
                bounceIn: {
                    '0%':   { opacity: '0', transform: 'scale(0.5)' },
                    '60%':  { opacity: '1', transform: 'scale(1.08)' },
                    '80%':  { transform: 'scale(0.96)' },
                    '100%': { transform: 'scale(1)' },
                },
            },

            animation: {
                /* Fade-in-up with staggered delays */
                'fade-in-up':       'fadeInUp 0.7s ease-out both',
                'fade-in-up-100':   'fadeInUp 0.7s ease-out 0.1s both',
                'fade-in-up-200':   'fadeInUp 0.7s ease-out 0.2s both',
                'fade-in-up-400':   'fadeInUp 0.7s ease-out 0.4s both',
                'fade-in-up-600':   'fadeInUp 0.7s ease-out 0.6s both',
                'fade-in-up-800':   'fadeInUp 0.7s ease-out 0.8s both',
                /* Fade-in */
                'fade-in':          'fadeIn 0.6s ease-out both',
                /* Float (for decorative elements) */
                'float':            'float 3.2s ease-in-out infinite',
                'float-slow':       'floatSlow 5s ease-in-out infinite',
                'float-delay':      'floatDelay 3.2s ease-in-out 1.0s infinite',
                'float-delay-2':    'floatDelay 3.2s ease-in-out 2.1s infinite',
                /* Misc */
                'scale-in':         'scaleIn 0.5s ease-out both',
                'slide-left':       'slideInLeft 0.6s ease-out both',
                'slide-right':      'slideInRight 0.6s ease-out both',
                'pulse-gold':       'pulseGold 2.5s ease-in-out infinite',
                'wiggle':           'wiggle 0.6s ease-in-out',
                'bounce-in':        'bounceIn 0.7s ease-out both',
            },
        },
    },

    plugins: [forms],
};
