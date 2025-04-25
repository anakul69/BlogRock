document.addEventListener('DOMContentLoaded', () => {
    const $      = sel => document.querySelector(sel);
    const html   = document.documentElement;
    const ovl    = $('#overlay');
    const sBtn   = $('#mSearchToggle');
    const mBtn   = $('#mMenuToggle');
    const sPane  = $('#mobileSearch');
    const mPane  = $('#mobileMenu');
    const header = document.querySelector('header');

    const ACTIVE_CLASSES = ['bg-gray-lighten', 'text-accent'];

    function toggleIcon(button, isOpen) {
        const svg = button?.querySelector('svg');
        if (!svg) return;

        svg.innerHTML = isOpen
            ? '<path d="M6 6l12 12M6 18L18 6" stroke-linecap="round" stroke-linejoin="round"/>'
            : button.id === 'mSearchToggle'
                ? '<circle cx="11" cy="11" r="8"/><path d="M21 21 16.65 16.65"/>'
                : '<path d="M4 6h16M4 12h16M4 18h16" stroke-linecap="round" stroke-linejoin="round"/>';
    }

    function openPane(button, pane) {
        closeAll();

        const headerHeight = header?.offsetHeight || 0;
        if (pane) {
            pane.style.top = headerHeight + 'px';
            pane.classList.remove('hidden');
        }

        button?.classList.add(...ACTIVE_CLASSES);
        ovl?.classList.remove('hidden');
        html.classList.add('overflow-hidden');
        toggleIcon(button, true);
    }

    function closeAll() {
        [sBtn, mBtn].forEach(button => {
            button?.classList.remove(...ACTIVE_CLASSES);
            toggleIcon(button, false);
        });

        [sPane, mPane].forEach(pane => {
            if (pane) {
                pane.classList.add('hidden');
                pane.style.top = null;
            }
        });

        ovl?.classList.add('hidden');
        html.classList.remove('overflow-hidden');
    }

    sBtn?.addEventListener('click', () =>
        sPane.classList.contains('hidden')
            ? openPane(sBtn, sPane)
            : closeAll()
    );

    mBtn?.addEventListener('click', () =>
        mPane.classList.contains('hidden')
            ? openPane(mBtn, mPane)
            : closeAll()
    );

    ovl?.addEventListener('click', closeAll);
});
