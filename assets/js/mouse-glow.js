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
        if (!previous || Math.hypot(event.clientX - previous.x, event.clientY - previous.y) > 3) {
            points.push({ x: event.clientX, y: event.clientY, born: performance.now() });
        }
    }, { passive: true });

    const drawWave = (now, offset, color, width, blur) => {
        if (points.length < 2) return;
        context.beginPath();
        points.forEach((point, index) => {
            const next = points[Math.min(index + 1, points.length - 1)];
            const angle = Math.atan2(next.y - point.y, next.x - point.x) + Math.PI / 2;
            const wave = Math.sin(now * .006 + index * .7) * offset;
            const x = point.x + Math.cos(angle) * wave;
            const y = point.y + Math.sin(angle) * wave;
            if (!index) context.moveTo(x, y);
            else context.quadraticCurveTo(point.x, point.y, x, y);
        });
        context.strokeStyle = color;
        context.lineWidth = width;
        context.lineCap = 'round';
        context.lineJoin = 'round';
        context.shadowBlur = blur;
        context.shadowColor = color;
        context.stroke();
    };

    const animate = (now) => {
        while (points[0] && now - points[0].born > 720) points.shift();
        context.clearRect(0, 0, innerWidth, innerHeight);
        const newest = points[points.length - 1];
        const alpha = newest ? Math.max(0, 1 - (now - newest.born) / 720) : 0;
        context.globalAlpha = alpha * .32;
        drawWave(now, 9, '#24cfff', 15, 24);
        context.globalAlpha = alpha * .5;
        drawWave(now, 5, '#e5a34f', 6, 16);
        context.globalAlpha = alpha * .75;
        drawWave(now, 2, '#fff0bd', 2, 10);
        requestAnimationFrame(animate);
    };
    requestAnimationFrame(animate);
})();
