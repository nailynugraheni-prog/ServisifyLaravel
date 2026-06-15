@php $cart = \App\Helpers\DataHelper::getCart(); @endphp
<nav class="navbar-servisify">
  <div class="container">
    <nav class="navbar navbar-expand-lg py-2" style="background:transparent;">
      <a class="navbar-brand" href="{{ route('user.katalog.index') }}">✦ Servisify</a>
      <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="mainNav">
        <ul class="navbar-nav mx-auto gap-1">
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('user.katalog*') ? 'active' : '' }}" href="{{ route('user.katalog.index') }}">Katalog</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('user.artikel*') ? 'active' : '' }}" href="{{ route('user.artikel.index') }}">Artikel</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('user.history*') ? 'active' : '' }}" href="{{ route('user.history.index') }}">Histori</a>
          </li>
        </ul>
        <div class="d-flex align-items-center gap-3">
          <!-- Ikon Keranjang Menggunakan SVG dengan Warna Rose Gold -->
          <a class="position-relative d-inline-flex align-items-center" href="{{ route('user.keranjang.index') }}" style="text-decoration: none; margin-right: 0.25rem;">
            <!-- fill="#b76e79" adalah warna Rose Gold -->
            <svg xmlns="http://w3.org" width="22" height="22" fill="#b76e79" class="bi bi-cart3" viewBox="0 0 16 16">
              <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l.84 4.479 9.144-.459L13.89 4zM5 12a1 1 0 1 0 0 2 1 1 0 0 0 0-2m7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2"/>
            </svg>
            @if(count($cart) > 0)
              <!-- Mengganti bg-danger ke style manual background-color Rose Gold agar serasi -->
              <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill" style="font-size: 0.6rem; padding: 0.2rem 0.35rem; margin-top: -2px; margin-left: -2px; background-color: #b76e79; color: white;">
                {{ count($cart) }}
              </span>
            @endif
          </a>

          <span style="font-size:0.85rem;color:var(--text-mid)">Halo, <strong>{{ session('user')['name'] }}</strong></span>

          <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button class="btn-rg-outline" style="padding:0.4rem 1rem;font-size:0.82rem;" type="submit">Keluar</button>
          </form>
        </div>
      </div>
    </nav>
  </div>
</nav>
<div class="promo-bar">
  <div class="promo-track">
    <span>Selamat datang di Servisify — nikmati promo khusus pelanggan baru, transaksi pertama kali langsung dapat diskon 30% untuk layanan pilihan terbaik, harga lebih hemat, proses cepat, dan hasil servis yang tetap berkualitas.</span>
    <span>Selamat datang di Servisify — nikmati promo khusus pelanggan baru, transaksi pertama kali langsung dapat diskon 30% untuk layanan pilihan terbaik, harga lebih hemat, proses cepat, dan hasil servis yang tetap berkualitas.</span>
    <span>Selamat datang di Servisify — nikmati promo khusus pelanggan baru, transaksi pertama kali langsung dapat diskon 30% untuk layanan pilihan terbaik, harga lebih hemat, proses cepat, dan hasil servis yang tetap berkualitas.</span>
  </div>
</div>
