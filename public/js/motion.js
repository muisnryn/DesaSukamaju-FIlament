(() => {
    const targets = document.querySelectorAll([
        'main > section',
        'main > .page-header',
        'main > .page-header-umkm',
        'main .infografis-header',
        'main .card',
        'main .stat-card',
        'main .dashboard-card',
        'main .index-card',
        'main .map-column',
        'main .listing-column',
        'main .location-item',
    ].join(','));

    if (
        !targets.length ||
        !('IntersectionObserver' in window) ||
        window.matchMedia('(prefers-reduced-motion: reduce)').matches
    ) {
        return;
    }

    const observer = new IntersectionObserver((entries, currentObserver) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) {
                return;
            }

            entry.target.classList.add('is-visible');
            currentObserver.unobserve(entry.target);
        });
    }, {
        rootMargin: '0px 0px -40px 0px',
        threshold: 0.01,
    });

    targets.forEach((target) => {
        target.classList.add('motion-reveal');
        observer.observe(target);
    });
})();
