document.addEventListener('DOMContentLoaded', function() {
    const toggle = document.querySelector('.menu-toggle');
    const nav = document.querySelector('#primary-menu');
    const navContainer = document.querySelector('.site-header__nav');

    if (!toggle || !nav) return;

    toggle.addEventListener('click', function() {
        const isExpanded = this.getAttribute('aria-expanded') === 'true';
        this.setAttribute('aria-expanded', !isExpanded);
        this.classList.toggle('is-active');
        nav.classList.toggle('is-open');
        if (navContainer) navContainer.classList.toggle('is-open');
    });
});