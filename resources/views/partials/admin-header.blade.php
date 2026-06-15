<div class="admin-topbar">
  <div class="d-flex align-items-center gap-3">
    <button class="d-lg-none btn p-1" id="sidebar-toggle" style="background:none;border:none;font-size:1.3rem;">☰</button>
    <span class="admin-topbar-title">@yield('page-title', 'Dashboard')</span>
  </div>
  <div class="d-flex align-items-center gap-3">
    <div style="text-align:right;">
      <div style="font-size:0.85rem;font-weight:600;color:var(--text-dark)">{{ session('user')['name'] }}</div>
      <div style="font-size:0.72rem;color:var(--text-light)">Administrator</div>
    </div>
    <div style="width:36px;height:36px;border-radius:50%;background:var(--gradient-gold);display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:0.9rem;">
      {{ strtoupper(substr(session('user')['name'], 0, 1)) }}
    </div>
    <form action="{{ route('logout') }}" method="POST">
      @csrf
      <button class="btn-danger-soft" type="submit" style="font-size:0.78rem;">Keluar</button>
    </form>
  </div>
</div>