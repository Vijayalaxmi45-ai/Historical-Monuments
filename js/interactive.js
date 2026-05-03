document.addEventListener('DOMContentLoaded', () => {
  const boxes = document.querySelectorAll('.box');

  boxes.forEach(box => {
    const btn = box.querySelector('button');
    const img = box.querySelector('img');
    const title = box.querySelector('h5').textContent.trim();

    btn.addEventListener('click', (e) => {
      e.preventDefault();
      // try extract href from inline onclick (location.href='...')
      let onclick = btn.getAttribute('onclick') || '';
      let href = '';
      const m = onclick.match(/location\.href=['\"]([^'\"]+)['\"]/);
      if (m) href = m[1];
      if (!href && btn.dataset.link) href = btn.dataset.link;

      const modalImg = document.getElementById('modal-image');
      const modalTitle = document.getElementById('modal-title');
      const modalLink = document.getElementById('modal-link');

      if (modalImg) modalImg.src = img.src;
      if (modalTitle) modalTitle.textContent = title;
      if (modalLink) modalLink.href = href || '#';

      const modalEl = document.getElementById('detailModal');
      if (modalEl) {
        const modal = new bootstrap.Modal(modalEl);
        modal.show();
      } else if (href) {
        window.location.href = href;
      }
    });
  });

  // Search/filter
  const searchInput = document.getElementById('search-box');
  if (searchInput) {
    searchInput.addEventListener('input', () => {
      const q = searchInput.value.trim().toLowerCase();
      boxes.forEach(box => {
        const title = (box.querySelector('h5')?.textContent || '').toLowerCase();
        const alt = (box.querySelector('img')?.alt || '').toLowerCase();
        const col = box.closest('.col-md-3') || box.parentElement;
        if (!q || title.includes(q) || alt.includes(q)) {
          if (col) col.style.display = '';
        } else {
          if (col) col.style.display = 'none';
        }
      });
    });
  }
});
