<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin — @yield('title', 'Dashboard') | Servisify</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/servisify.css') }}">
</head>
<body style="background:var(--surface);">

  <div class="admin-wrapper">
    @include('partials.admin-sidebar')

    <div class="admin-content">
      @include('partials.admin-header')

      @if(session('success'))
        <div class="mx-4 mt-3">
          <div class="alert-servisify success">✅ {{ session('success') }}</div>
        </div>
      @endif
      @if(session('error'))
        <div class="mx-4 mt-3">
          <div class="alert-servisify error">❌ {{ session('error') }}</div>
        </div>
      @endif

      <div class="admin-main">
        @yield('content')
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('js/servisify.js') }}"></script>
  @stack('scripts')
</body>
</html>