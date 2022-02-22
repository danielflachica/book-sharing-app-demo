const colors = require('tailwindcss/colors');

module.exports = {
    purge: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    darkMode: false, // or 'media' or 'class'
    theme: {
        extend: {},
        borderRadius: {
            'none': '0',
            DEFAULT: '0px',
            'full': '9999px',
        },
        colors: {
            transparent: 'transparent',
            current: 'currentColor',
            black: colors.black,
            white: colors.white,
            gray: colors.gray,
            blue: colors.blue,
            red: colors.red,
            green: colors.green,
            orange: colors.orange,
            yellow: colors.yellow,
            indigo: colors.indigo,
            primary: {
                light: '#334756',
                DEFAULT: '#334756',
                dark: '#334756',
            },
            secondary: {
                lighter: '#374045',
                light: '#374045',
                DEFAULT: '#374045',
            }
        },
    },

    variants: {
        extend: {
            backgroundColor: ['active'],
            borderColor: ['active'],
            borderWidth: ['hover', 'focus'],
            opacity: ['disabled'],
            textColor: ['active'],
            scale: ['hover', 'focus', 'focus-within'],
        },
    },
    plugins: [],
}
