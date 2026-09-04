(() => {
    const page = document.querySelector('.moyu-home');
    const disabled = window.matchMedia('(pointer: coarse), (prefers-reduced-motion: reduce)').matches;
    if (!page || disabled) return;

    const canvas = document.createElement('canvas');
    const context = canvas.getContext('2d');
    const points = [];
    canvas.className = 'moyu-water-canvas';
    document.body.appendChild(canvas);

    const resize = () => {
        const ratio = Math.min(window.devicePixelRatio || 1, 2);
        canvas.width = innerWidth * ratio;
        canvas.height = innerHeight * ratio;
        context.setTransform(ratio, 0, 0, ratio, 0, 0);
    };
    resize();
    window.addEventListener('resize', resize, { passive: true });

    window.addEventListener('pointermove', (event) => {
        const previous = points[points.length - 1];
        if (!previous || Math.hypot(event.clientX - previous.x, event.clientY - previous.y) > 6) {
            points.push({ x: event.clientX, y: event.clientY, born: performance.now() });
        }
    }, { passive: true });

    const drawWake = (now) => {
        points.forEach((point, index) => {
            if (index % 2) return;
            const age = Math.min(1, (now - point.born) / 520);
            const radius = 10 + age * 22;
            const wave = Math.sin(now * .004 + index * .55) * 3;
            const glow = context.createRadialGradient(point.x + wave, point.y, 0, point.x + wave, point.y, radius);
            glow.addColorStop(0, `rgba(255,236,190,${.12 * (1 - age)})`);
            glow.addColorStop(.38, `rgba(229,163,79,${.07 * (1 - age)})`);
            glow.addColorStop(.72, `rgba(36,207,255,${.035 * (1 - age)})`);
            glow.addColorStop(1, 'rgba(36,207,255,0)');
            context.fillStyle = glow;
            context.beginPath();
            context.ellipse(point.x + wave, point.y, radius * 1.7, radius * .55, 0, 0, Math.PI * 2);
            context.fill();
        });
    };

    const animate = (now) => {
        while (points[0] && now - points[0].born > 520) points.shift();
        context.clearRect(0, 0, innerWidth, innerHeight);
        drawWake(now);
        requestAnimationFrame(animate);
    };
    requestAnimationFrame(animate);
})();
