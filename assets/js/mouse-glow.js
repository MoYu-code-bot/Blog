(() => {
    const page = document.querySelector('.moyu-home');
    const disabled = window.matchMedia('(pointer: coarse), (prefers-reduced-motion: reduce)').matches;
    if (!page || disabled) return;

    let frame = 0;
    let lastX = 0;
    let lastY = 0;
    let lastTime = performance.now();
    window.addEventListener('pointermove', (event) => {
        if (frame) return;
        frame = window.requestAnimationFrame(() => {
            const now = performance.now();
            const deltaX = event.clientX - lastX;
            const deltaY = event.clientY - lastY;
            const speed = Math.hypot(deltaX, deltaY) / Math.max(16, now - lastTime);
            page.style.setProperty('--glow-x', `${event.clientX}px`);
            page.style.setProperty('--glow-y', `${event.clientY}px`);
            page.style.setProperty('--glow-energy', Math.min(1, speed / 2).toFixed(2));
            if (deltaX || deltaY) page.style.setProperty('--glow-angle', `${Math.atan2(deltaY, deltaX)}rad`);
            page.classList.add('has-pointer-glow');
            lastX = event.clientX;
            lastY = event.clientY;
            lastTime = now;
            frame = 0;
        });
    }, { passive: true });

    document.addEventListener('mouseleave', () => page.classList.remove('has-pointer-glow'));
})();
