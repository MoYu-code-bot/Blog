(() => {
    const intro = document.querySelector('#moyu-intro');
    if (!intro) return;

    const key = 'moyu-glass-intro-seen';
    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    let seen = false;

    try {
        seen = sessionStorage.getItem(key) === '1';
    } catch (error) {
        seen = false;
    }

    if (seen || reducedMotion) {
        intro.remove();
        return;
    }

    let finished = false;
    const onKeydown = (event) => {
        if (event.key === 'Escape') finish();
    };
    const finish = () => {
        if (finished) return;
        finished = true;

        try {
            sessionStorage.setItem(key, '1');
        } catch (error) {
            // Private browsing can block storage; the animation still closes normally.
        }

        intro.classList.add('is-leaving');
        document.documentElement.classList.remove('moyu-intro-enabled');
        document.body.classList.remove('moyu-intro-lock');
        document.removeEventListener('keydown', onKeydown);
        window.setTimeout(() => intro.remove(), 520);
    };

    document.body.classList.add('moyu-intro-lock');
    requestAnimationFrame(() => intro.classList.add('is-playing'));
    intro.querySelector('.moyu-intro-skip')?.addEventListener('click', finish);
    document.addEventListener('keydown', onKeydown);
    window.setTimeout(finish, 2400);
})();
