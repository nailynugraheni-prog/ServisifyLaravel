<div class="admin-sidebar" id="admin-sidebar">
  <div class="sidebar-brand">
    <div class="sidebar-brand-name">✦ Servisify</div>
    <div class="sidebar-brand-sub">Admin Panel</div>
  </div>
  <nav class="sidebar-nav">
    <div class="sidebar-section-label">Utama</div>
    <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
      <div class="icon">
        <!-- Ikon Dashboard (Graph) -->
        <svg xmlns="http://w3.org" width="18" height="18" fill="#b76e79" class="bi bi-bar-chart-line-fill" viewBox="0 0 16 16">
          <path d="M11 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h1V7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7h1zm1 12h2V2h-2zm-4 0h2V7H8zm-4 0h2v-3H4z"/>
        </svg>
      </div> Dashboard
    </a>

    <div class="sidebar-section-label" style="margin-top:0.5rem;">Konten</div>
    <a href="{{ route('admin.produk.index') }}" class="sidebar-link {{ request()->routeIs('admin.produk*') ? 'active' : '' }}">
      <div class="icon">
        <!-- Ikon Kelola Produk (Tas Belanja) -->
        <svg xmlns="http://w3.org" width="18" height="18" fill="#b76e79" class="bi bi-bag-fill" viewBox="0 0 16 16">
          <path d="M8 1a2 2 0 0 1 2 2v2H6V3a2 2 0 0 1 2-2m3 4V3a3 3 0 1 0-6 0v2H2a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2z"/>
        </svg>
      </div> Kelola Produk
    </a>

    <a href="{{ route('admin.artikel.index') }}" class="sidebar-link {{ request()->routeIs('admin.artikel*') ? 'active' : '' }}">
      <div class="icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#b76e79" class="bi bi-journal-text" viewBox="0 0 16 16">
          <path d="M5 10.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5"/>
          <path d="M3 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1H3zm0 1h9v13H3a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1"/>
        </svg>
      </div>
      Kelola Artikel
    </a>

    <div class="sidebar-section-label" style="margin-top:0.5rem;">Manajemen</div>
    <a href="{{ route('admin.pengguna.index') }}" class="sidebar-link {{ request()->routeIs('admin.pengguna*') ? 'active' : '' }}">
      <div class="icon">
        <!-- Ikon Kelola Pengguna (People/Grup) -->
        <svg xmlns="http://w3.org" width="18" height="18" fill="#b76e79" class="bi bi-people-fill" viewBox="0 0 16 16">
          <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
        </svg>
      </div> Kelola Pengguna
    </a>
    <a href="{{ route('admin.transaksi.index') }}" class="sidebar-link {{ request()->routeIs('admin.transaksi*') ? 'active' : '' }}">
      <div class="icon">
        <!-- Ikon Kelola Transaksi (Kartu Kredit) -->
        <svg xmlns="http://w3.org" width="18" height="18" fill="#b76e79" class="bi bi-credit-card-2-back-fill" viewBox="0 0 16 16">
          <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v5H0zm16 6H0v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zm-3 1a1 1 0 1 1-2 0 1 1 0 0 1 2 0m-4 1a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5"/>
        </svg>
      </div> Kelola Transaksi
    </a>
  </nav>
</div>
