/* =============================================
   SERVISIFY — Main JavaScript
   ============================================= */

document.addEventListener('DOMContentLoaded', function () {

  // ---- Auto-dismiss alerts ----
  const alerts = document.querySelectorAll('.alert-servisify');
  alerts.forEach(alert => {
    setTimeout(() => {
      alert.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
      alert.style.opacity = '0';
      alert.style.transform = 'translateY(-10px)';
      setTimeout(() => alert.remove(), 500);
    }, 4000);
  });

  // ---- Image upload preview ----
  document.querySelectorAll('input[type="file"][data-preview]').forEach(input => {
    input.addEventListener('change', function () {
      const previewId = this.dataset.preview;
      const preview   = document.getElementById(previewId);
      if (!preview) return;
      if (this.files && this.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
          preview.src = e.target.result;
          preview.style.display = 'block';
        };
        reader.readAsDataURL(this.files[0]);
      }
    });
  });

  // ---- Qty controls ----
  document.querySelectorAll('.qty-control').forEach(control => {
    const input  = control.querySelector('.qty-input');
    const minus  = control.querySelector('[data-action="minus"]');
    const plus   = control.querySelector('[data-action="plus"]');
    if (!input) return;
    if (minus) minus.addEventListener('click', () => {
      const val = parseInt(input.value) || 1;
      if (val > 1) input.value = val - 1;
    });
    if (plus) plus.addEventListener('click', () => {
      const val = parseInt(input.value) || 1;
      input.value = val + 1;
    });
  });

  // ---- Cart total update ----
  function updateCartTotal() {
    let total = 0;
    document.querySelectorAll('.cart-row').forEach(row => {
      const price = parseInt(row.dataset.price) || 0;
      const qty   = parseInt(row.querySelector('.qty-input')?.value) || 1;
      total += price * qty;
      const subtotalEl = row.querySelector('.subtotal');
      if (subtotalEl) subtotalEl.textContent = 'Rp ' + price * qty.toLocaleString('id-ID');
    });
    const totalEl = document.getElementById('cart-total');
    if (totalEl) totalEl.textContent = 'Rp ' + total.toLocaleString('id-ID');
  }

  document.querySelectorAll('.cart-row .qty-input').forEach(input => {
    input.addEventListener('input', updateCartTotal);
  });

  // ---- Confirm delete ----
  document.querySelectorAll('[data-confirm]').forEach(btn => {
    btn.addEventListener('click', function (e) {
      if (!confirm(this.dataset.confirm || 'Yakin ingin menghapus?')) {
        e.preventDefault();
      }
    });
  });

  // ---- Rupiah formatter for price inputs ----
  document.querySelectorAll('input[data-rupiah]').forEach(input => {
    input.addEventListener('input', function () {
      let value = this.value.replace(/[^0-9]/g, '');
      this.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    });
  });

  // ---- Admin sidebar mobile toggle ----
  const sidebarToggle = document.getElementById('sidebar-toggle');
  const sidebar       = document.getElementById('admin-sidebar');
  if (sidebarToggle && sidebar) {
    sidebarToggle.addEventListener('click', () => sidebar.classList.toggle('open'));
    document.addEventListener('click', e => {
      if (!sidebar.contains(e.target) && e.target !== sidebarToggle) {
        sidebar.classList.remove('open');
      }
    });
  }

  // ---- Page fade in ----
  document.querySelectorAll('.page-fade-in').forEach((el, i) => {
    el.style.animationDelay = `${i * 0.08}s`;
  });

  // ---- Active nav highlight ----
  const currentPath = window.location.pathname;
  document.querySelectorAll('.nav-link, .sidebar-link').forEach(link => {
    if (link.getAttribute('href') === currentPath) link.classList.add('active');
  });

});