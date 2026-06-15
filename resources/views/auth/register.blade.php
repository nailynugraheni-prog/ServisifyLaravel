<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar — Servisify</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/servisify.css') }}">
  <style>
    body { background: var(--gradient-hero); min-height:100vh; display:flex; align-items:center; justify-content:center; padding:2rem 0; }
    .auth-card { background:white; border-radius:var(--radius-xl); box-shadow:var(--shadow-lg); padding:2.5rem; width:100%; max-width:460px; }
    .auth-brand { font-family:'Cormorant Garamond',serif; font-size:2rem; font-weight:700; background:var(--gradient-gold); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; text-align:center; }
  </style>
</head>
<body>
  <div class="auth-card page-fade-in">
    <div class="auth-brand">✦ Servisify</div>
    <p style="text-align:center;color:var(--text-light);font-size:0.85rem;margin-bottom:2rem;">Buat akun baru</p>

    @if(session('error'))
      <div class="alert-servisify error mb-3">{{ session('error') }}</div>
    @endif

    <form action="{{ route('register') }}" method="POST" class="form-servisify">
      @csrf
      <div class="mb-3">
        <label class="form-label">Nama Lengkap</label>
        <input type="text" name="name" class="form-control" placeholder="Nama kamu" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" placeholder="Email aktif" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Nomor HP</label>
        <input type="text" name="phone" class="form-control" placeholder="08xx-xxxx-xxxx">
      </div>
      <div class="mb-4">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" placeholder="Min. 6 karakter" required>
      </div>
      <button type="submit" class="btn-rg w-100 justify-content-center">Daftar Sekarang</button>
    </form>

    <p style="text-align:center;margin-top:1.5rem;font-size:0.85rem;color:var(--text-light);">
      Sudah punya akun? <a href="{{ route('login') }}" style="color:var(--gold-dark);font-weight:600;">Masuk</a>
    </p>
  </div>
  <script src="{{ asset('js/servisify.js') }}"></script>
</body>
</html>