const defaultTheme = require('tailwindcss/defaultTheme');

const customColors = require('./tailwind/config/colors');
const spacing      = require('./tailwind/config/spacing');
const fontSizes    = require('./tailwind/config/fontSizes');
const typography   = require('./tailwind/config/typography');

module.exports = {
    content: [
        './**/*.php',
        './blocks/**/*.php',
        './layout/**/*.php',
        './assets/js/**/*.js',
        './blocks/**/*.js',
    ],

    theme: {
        colors: {
            transparent : 'transparent',
            current     : 'currentColor',
            white       : '#ffffff',
            black       : '#000000',
            ...customColors,
        },

        spacing,

        extend: {
            fontFamily: {
                heading: ['"League Spartan"', ...defaultTheme.fontFamily.sans],
                body   : ['"Mulish"',         ...defaultTheme.fontFamily.sans],
            },

            fontSize: fontSizes,
        },
    },

    plugins: [
        typography,
        require('./tailwind/components/buttons'),
        require('./tailwind/utilities/animations'),
    ],
};
