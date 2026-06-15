<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Masuk — Servisify</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/servisify.css') }}">
  <style>
    body { background: var(--gradient-hero); min-height: 100vh; display:flex; align-items:center; justify-content:center; }
    .auth-card { background:white; border-radius:var(--radius-xl); box-shadow:var(--shadow-lg); padding:2.5rem; width:100%; max-width:420px; }
    .auth-brand { font-family:'Cormorant Garamond',serif; font-size:2rem; font-weight:700; background:var(--gradient-gold); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; text-align:center; margin-bottom:0.25rem; }
  </style>
</head>
<body>
  <div class="auth-card page-fade-in">
    <div class="auth-brand">✦ Servisify</div>
    <p style="text-align:center;color:var(--text-light);font-size:0.85rem;margin-bottom:2rem;">Jasa Profesional Terpercaya</p>

    @if(session('success'))
      <div class="alert-servisify success mb-3">{{ session('success') }}</div>
    @endif
    @if(session('error'))
      <div class="alert-servisify error mb-3">{{ session('error') }}</div>
    @endif

    <form action="/login" method="POST" class="form-servisify">
      @csrf
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" placeholder="Masukkan email" required value="{{ old('email') }}">
      </div>
      <div class="mb-4">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
      </div>
      <button type="submit" class="btn-rg w-100 justify-content-center">Masuk</button>
    </form>

    <p style="text-align:center;margin-top:1.5rem;font-size:0.85rem;color:var(--text-light);">
      Belum punya akun? <a href="{{ route('register') }}" style="color:var(--gold-dark);font-weight:600;">Daftar sekarang</a>
    </p>
  </div>
  <script src="{{ asset('js/servisify.js') }}"></script>
</body>
</html>