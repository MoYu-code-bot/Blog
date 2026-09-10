(() => {
    const page = document.querySelector('.moyu-home');
    const disabled = window.matchMedia('(pointer: coarse), (prefers-reduced-motion: reduce)').matches;
    if (!page || disabled) return;

    const canvas = document.createElement('canvas');
    const context = canvas.getContext('2d');
    const trail = [];
    const goldDust = [];
    const lifetime = 620;
    const dustLifetime = 1300;
    let pointer;
    canvas.className = 'moyu-water-canvas';
    document.body.appendChild(canvas);

    const resize = () => {
        const ratio = Math.min(window.devicePixelRatio || 1, 2);
        canvas.width = innerWidth * ratio;
        canvas.height = innerHeight * ratio;
        canvas.style.width = `${innerWidth}px`;
        canvas.style.height = `${innerHeight}px`;
        context.setTransform(ratio, 0, 0, ratio, 0, 0);
    };
    resize();
    window.addEventListener('resize', resize, { passive: true });

    window.addEventListener('pointermove', (event) => {
        const now = performance.now();
        const next = { x: event.clientX, y: event.clientY, born: now };

        if (pointer) {
            const deltaX = next.x - pointer.x;
            const deltaY = next.y - pointer.y;
            const distance = Math.hypot(deltaX, deltaY);
            const normalX = distance ? -deltaY / distance : 0;
            const normalY = distance ? deltaX / distance : 0;
            const steps = Math.min(12, Math.max(1, Math.ceil(distance / 7)));
            for (let step = 1; step <= steps; step += 1) {
                const progress = step / steps;
                const side = step % 2 ? 1 : -1;
                trail.push({
                    x: pointer.x + deltaX * progress,
                    y: pointer.y + deltaY * progress,
                    born: now - (steps - step) * 4,
                    normalX,
                    normalY,
                    spread: side * (3 + (step % 4) * 2.2),
                });
                if (step % 3 === 0) {
                    goldDust.push({
                        x: pointer.x + deltaX * progress + normalX * side * 5,
                        y: pointer.y + deltaY * progress + normalY * side * 5,
                        born: now,
                        velocityX: (Math.random() - .5) * .035,
                        velocityY: .012 + Math.random() * .025,
                        size: .7 + Math.random() * 1.4,
                    });
                }
            }
        } else {
            trail.push(next);
        }

        pointer = next;
        if (trail.length > 96) trail.splice(0, trail.length - 96);
        if (goldDust.length > 90) goldDust.splice(0, goldDust.length - 90);
    }, { passive: true });

    const drawMeteor = (now) => {
        if (trail.length < 2) return;

        for (let index = 1; index < trail.length; index += 1) {
            const previous = trail[index - 1];
            const point = trail[index];
            const position = index / (trail.length - 1);
            const age = Math.min(1, (now - point.born) / lifetime);
            const strength = (1 - age) * position;
            if (strength <= 0) continue;

            context.beginPath();
            context.moveTo(previous.x, previous.y);
            context.lineTo(point.x, point.y);
            context.lineCap = 'round';
            context.lineWidth = .35 + 6.5 * position * position;
            const color = position < .32 ? '169,120,145' : position < .68 ? '217,130,122' : '234,182,168';
            context.strokeStyle = `rgba(${color},${.72 * strength})`;
            context.shadowColor = 'rgba(234,182,168,.82)';
            context.shadowBlur = 5 + 9 * position;
            context.stroke();
        }

        const head = trail[trail.length - 1];
        const headAge = Math.min(1, (now - head.born) / 150);
        const glow = context.createRadialGradient(head.x, head.y, 0, head.x, head.y, 13);
        glow.addColorStop(0, `rgba(255,248,242,${1 - headAge})`);
        glow.addColorStop(.2, `rgba(234,182,168,${.9 * (1 - headAge)})`);
        glow.addColorStop(1, 'rgba(169,120,145,0)');
        context.shadowBlur = 0;
        context.fillStyle = glow;
        context.beginPath();
        context.arc(head.x, head.y, 13, 0, Math.PI * 2);
        context.fill();

        trail.forEach((point, index) => {
            if (index % 4 !== 0 || !point.spread) return;
            const age = Math.min(1, (now - point.born) / lifetime);
            const drift = point.spread * (1 + age * 1.8);
            const sparkleX = point.x + point.normalX * drift;
            const sparkleY = point.y + point.normalY * drift + age * 5;
            const sparkleSize = .7 + (index % 3) * .45;
            const sparkleColor = index % 8 === 0 ? '255,248,242' : index % 3 === 0 ? '169,120,145' : '217,130,122';
            context.shadowColor = 'rgba(234,182,168,.76)';
            context.shadowBlur = 4;
            context.fillStyle = `rgba(${sparkleColor},${.58 * (1 - age)})`;
            context.beginPath();
            context.arc(sparkleX, sparkleY, sparkleSize, 0, Math.PI * 2);
            context.fill();
        });
        context.shadowBlur = 0;
    };

    const drawGoldDust = (now) => {
        goldDust.forEach((particle, index) => {
            const elapsed = now - particle.born;
            const age = Math.min(1, elapsed / dustLifetime);
            const x = particle.x + particle.velocityX * elapsed;
            const y = particle.y + particle.velocityY * elapsed + .000025 * elapsed * elapsed;
            const alpha = .7 * Math.pow(1 - age, 1.7);
            context.shadowColor = 'rgba(255,211,126,.82)';
            context.shadowBlur = 3 + particle.size * 2;
            context.fillStyle = `rgba(${index % 3 ? '232,181,91' : '255,239,190'},${alpha})`;
            context.beginPath();
            context.arc(x, y, particle.size * (1 - age * .35), 0, Math.PI * 2);
            context.fill();
        });
        context.shadowBlur = 0;
    };

    const animate = (now) => {
        while (trail[0] && now - trail[0].born > lifetime) trail.shift();
        while (goldDust[0] && now - goldDust[0].born > dustLifetime) goldDust.shift();
        context.clearRect(0, 0, innerWidth, innerHeight);
        drawMeteor(now);
        drawGoldDust(now);
        requestAnimationFrame(animate);
    };
    requestAnimationFrame(animate);
})();
