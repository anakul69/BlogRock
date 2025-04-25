const plugin = require('tailwindcss/plugin');

module.exports = plugin(({ addUtilities, theme }) => {
    const family = (name) => {
        const f = theme(`fontFamily.${name}`);
        return Array.isArray(f) ? f.join(', ') : f;
    };

    const base     = theme('colors.text-base');
    const link     = theme('colors.text-link', base);
    const headingF = family('heading');
    const bodyF    = family('body');

    const fonts = [
        // headings
        ['font-h1',  96, 128,  0.8, 700, headingF, base],
        ['font-h2',  60,  88,  0.7, 700, headingF, base],
        ['font-h3',  40,  56,  0.4, 700, headingF, base],
        ['font-h4',  30,  44,  0.35,700, headingF, base],
        ['font-h5',  24,  34,  0,   700, headingF, base],
        ['font-h6',  20,  34,  0,   700, headingF, base],

        // body / caption
        ['font-body-large-bold', 20, 34, 0, 700, bodyF, base],
        ['font-body-bold',       16, 28, 0, 700, bodyF, base],
        ['font-caption-bold',    14, 24, 0, 700, bodyF, base],
        ['font-tiny-bold',       10, 16, 0.3,700, bodyF, base],

        ['font-body-huge',       24, 36, 0, 400, bodyF, base],
        ['font-body-large',      22, 28, 0, 400, bodyF, base],
        ['font-body',            18, 28, 0, 400, bodyF, base],
        ['font-caption',         14, 24, 0, 400, bodyF, base],
        ['font-small',           12, 21, 0, 400, bodyF, base],
        ['font-tiny',            10, 16, 0.3,400, bodyF, base],

        // links
        ['font-link-large-heading', 40, 48, -0.4,700, headingF, link],
        ['font-link-medium-heading',24, 34, 0,   700, headingF, base],
        ['font-link-small-heading', 20, 28, 0,   700, headingF, base],
        ['font-link-large',         22, 28, 0,   400, bodyF,    link],
        ['font-link-regular',       18, 28, 0,   400, bodyF,    link],

        ['font-menu',       17, 30, 1,   600, headingF,    base],
    ];

    const utils = Object.fromEntries(
        fonts.map(([cls, fs, lh, ls, fw, ff, col]) => [
            `.${cls}`,
            {
                fontSize: `${fs}px`,
                lineHeight: `${lh}px`,
                ...(ls ? { letterSpacing: `${ls}px` } : {}),
                fontWeight: fw.toString(),
                fontFamily: ff,
                color: col,

            },
        ])
    );

    addUtilities(utils, { variants: ['responsive'] });
});
