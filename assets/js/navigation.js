(() => {
    const menus = document.querySelectorAll('.moyu-category-menu details');
    if (!menus.length) return;

    document.addEventListener('click', (event) => {
        menus.forEach((menu) => {
            if (menu.open && !menu.contains(event.target)) menu.open = false;
        });
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') menus.forEach((menu) => { menu.open = false; });
    });
})();
