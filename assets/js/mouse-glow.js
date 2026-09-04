(() => {
    const page = document.querySelector('.moyu-home');
    const disabled = window.matchMedia('(pointer: coarse), (prefers-reduced-motion: reduce)').matches;
    if (!page || disabled) return;

    let frame = 0;
    window.addEventListener('pointermove', (event) => {
        if (frame) return;
        frame = window.requestAnimationFrame(() => {
            page.style.setProperty('--glow-x', `${event.clientX}px`);
            page.style.setProperty('--glow-y', `${event.clientY}px`);
            page.classList.add('has-pointer-glow');
            frame = 0;
        });
    }, { passive: true });

    document.addEventListener('mouseleave', () => page.classList.remove('has-pointer-glow'));
})();
