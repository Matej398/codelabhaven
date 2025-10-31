const cursor = document.getElementById('cursor');
document.addEventListener('mousemove', (e) => {
    // Constrain cursor to viewport to prevent horizontal scrolling
    const x = Math.min(Math.max(0, e.clientX - 200), window.innerWidth - 400);
    const y = Math.min(Math.max(0, e.clientY - 200), window.innerHeight - 400);
    cursor.style.left = x + 'px';
    cursor.style.top = y + 'px';
});
