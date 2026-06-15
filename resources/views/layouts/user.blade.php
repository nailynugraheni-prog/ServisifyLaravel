<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Servisify') — Jasa Profesional</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/servisify.css') }}">
</head>
<body>

  @include('partials.header')

  @if(session('success'))
    <div class="container mt-3">
      <div class="alert-servisify success">✅ {{ session('success') }}</div>
    </div>
  @endif
  @if(session('error'))
    <div class="container mt-3">
      <div class="alert-servisify error">❌ {{ session('error') }}</div>
    </div>
  @endif

  <main>
    @yield('content')
  </main>

  @include('partials.footer')

  @php $cart = \App\Helpers\DataHelper::getCart(); @endphp
  @if(count($cart) > 0 && !request()->routeIs('user.keranjang*'))
    <a href="{{ route('user.keranjang.index') }}" class="floating-cart">
      🛒
      <span class="count">{{ count($cart) }}</span>
    </a>
  @endif

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('js/servisify.js') }}"></script>
  @stack('scripts')
</body>
</html>