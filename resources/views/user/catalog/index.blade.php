@extends('layouts.user')
@section('title', 'Katalog Layanan')
@section('content')

<div class="hero-section">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-7">
        <div class="section-eyebrow">Katalog Layanan</div>
        <h1 class="hero-title">Jasa Profesional <span class="highlight">Terpercaya</span> di Doorstep Anda</h1>
        <p style="color:var(--text-mid);margin:1rem 0 1.5rem;font-size:1rem;">Pilih dari 9 layanan unggulan kami — kebersihan, perbaikan, hingga kecantikan.</p>
        <form action="{{ route('user.katalog.index') }}" method="GET">
          <div class="search-bar" style="max-width:380px;">
            <span class="icon">
              <!-- Bootstrap Icon: search -->
              <svg xmlns="http://w3.org" width="16" height="16" fill="#b76e79" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
              </svg>
            </span>
            <input type="text" name="search" class="form-control" placeholder="Cari layanan..." value="{{ $search }}">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="container" style="padding-top:2rem;padding-bottom:4rem;">
  <div class="category-tabs mb-4">
    <a href="{{ route('user.katalog.index') }}" class="cat-tab {{ !$category ? 'active' : '' }}">
      <!-- Bootstrap Icon: sparkle -->
      <svg xmlns="http://w3.org" width="16" height="16" fill="#b76e79" class="bi bi-sparkle me-1" viewBox="0 0 16 16" style="vertical-align: text-bottom;">
        <path d="M9.6 0H6.4L6 4 2 4.4v3.2L6 8l.4 4H9.6l.4-4 4-.4V4.4L10 4zM7.25 1.5h1.5l.3 3h3.45v1l-3.45.3-.3 3.45h-1.5l-.3-3.45-3.45-.3v-1h3.45z"/>
      </svg>
      Semua
    </a>
    @foreach(\App\Helpers\DataHelper::getCategories() as $cat)
      @php 
        // Array SVG untuk tabs atas
        $icons = [
          'Kebersihan' => '<svg xmlns="http://w3.org" width="16" height="16" fill="#b76e79" class="bi bi-broom me-1" viewBox="0 0 16 16" style="vertical-align: text-bottom;"><path d="M11.23 2.311a.5.5 0 0 0-.707 0L1.758 11.076a4 4 0 0 0 5.657 5.656l8.764-8.765a.5.5 0 0 0 0-.707l-4.95-4.95zM7.14 16A3 3 0 0 1 2.464 11.76l4.243-4.242 4.242 4.242-4.242 4.243A2.99 2.99 0 0 1 7.14 16zm4.95-4.95-4.242-4.242 3.535-3.536 4.243 4.242z"/></svg>', 
          'Perbaikan' => '<svg xmlns="http://w3.org" width="16" height="16" fill="#b76e79" class="bi bi-wrench me-1" viewBox="0 0 16 16" style="vertical-align: text-bottom;"><path d="M.102 2.223A3.004 3.004 0 0 0 3.78 5.897l6.341 6.219a2.49 2.49 0 0 0 3.607-.048l1.702-1.67a2.5 2.5 0 0 0-.04-3.58L9.07 4.185A3.003 3.003 0 0 0 5.4 1.026a3.003 3.003 0 0 0-3.327.424L4.35 3.54c.231.226.244.595.033.826a.54.54 0 0 1-.806.012L1.517 2.146A3.003 3.003 0 0 0 .102 2.223M14 9.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/></svg>', 
          'Kecantikan' => '<svg xmlns="http://w3.org" width="16" height="16" fill="#b76e79" class="bi bi-flower1 me-1" viewBox="0 0 16 16" style="vertical-align: text-bottom;"><path d="M6.174 1.184a2 2 0 0 1 3.652 0A2 2 0 0 1 12.99 3.01a2 2 0 0 1 1.826 3.164 2 2 0 0 1 0 3.652 2 2 0 0 1-1.826 3.164 2 2 0 0 1-3.164 1.826 2 2 0 0 1-3.652 0A2 2 0 0 1 3.01 12.99a2 2 0 0 1-1.826-3.164 2 2 0 0 1 0-3.652A2 2 0 0 1 3.01 3.01a2 2 0 0 1 3.164-1.826zM8 1a1 1 0 0 0-.913.596 1 1 0 0 0 1.826 0A1 1 0 0 0 8 1M3.33 3.33a1 1 0 0 0-.077 1.411 1 1 0 0 0 1.412-.077 1 1 0 0 0-.077-1.412 1 1 0 0 0-1.412.078m1.114 9.34a1 1 0 0 0-.077-1.412 1 1 0 0 0-1.412.077 1 1 0 0 0 .077 1.412 1 1 0 0 0 1.412-.077m7.112.077a1 1 0 0 0 1.412-.077 1 1 0 0 0-.077-1.412 1 1 0 0 0-1.412.077 1 1 0 0 0 .077 1.412m1.114-9.34a1 1 0 0 0 1.412.077 1 1 0 0 0-.077-1.412 1 1 0 0 0-1.412.078 1 1 0 0 0 .077 1.411M8 15a1 1 0 0 0 .913-.596 1 1 0 0 0-1.826 0A1 1 0 0 0 8 15m0-4.5a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5m0-1a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3"/></svg>'
        ]; 
      @endphp
      <a href="{{ route('user.katalog.index', ['kategori' => $cat]) }}" class="cat-tab {{ $category === $cat ? 'active' : '' }}">
        {!! $icons[$cat] ?? '•' !!} {{ $cat }}
      </a>
    @endforeach
  </div>

  @if($category || $search)
    <div style="margin-bottom:1.5rem;">
      <p style="color:var(--text-mid);font-size:0.9rem;">
        Menampilkan <strong>{{ count($filtered) }}</strong> hasil
        @if($category) untuk kategori <strong>{{ $category }}</strong>@endif
        @if($search) dengan kata kunci "<strong>{{ $search }}</strong>"@endif
      </p>
    </div>
    <div class="row g-4">
      @forelse($filtered as $product)
        @include('user.catalog._card', ['product' => $product])
      @empty
        <div class="empty-state">
          <div class="icon">
            <!-- Bootstrap Icon: search -->
            <svg xmlns="http://w3.org" width="48" height="48" fill="#b76e79" class="bi bi-search mb-3" viewBox="0 0 16 16">
              <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
            </svg>
          </div>
          <h4>Layanan tidak ditemukan</h4>
          <p>Coba kata kunci lain atau hapus filter.</p>
        </div>
      @endforelse
    </div>
  @else
    @foreach(\App\Helpers\DataHelper::getCategories() as $cat)
      @php
        $catProducts = array_filter($grouped[$cat] ?? [], fn($p) => $p['is_active']);
        // Array SVG untuk judul section bagian bawah
        $catIcons = [
          'Kebersihan' => '<svg xmlns="http://w3.org" width="16" height="16" fill="#b76e79" class="bi bi-broom me-1" viewBox="0 0 16 16" style="vertical-align: middle;"><path d="M11.23 2.311a.5.5 0 0 0-.707 0L1.758 11.076a4 4 0 0 0 5.657 5.656l8.764-8.765a.5.5 0 0 0 0-.707l-4.95-4.95zM7.14 16A3 3 0 0 1 2.464 11.76l4.243-4.242 4.242 4.242-4.242 4.243A2.99 2.99 0 0 1 7.14 16zm4.95-4.95-4.242-4.242 3.535-3.536 4.243 4.242z"/></svg>', 
          'Perbaikan' => '<svg xmlns="http://w3.org" width="16" height="16" fill="#b76e79" class="bi bi-wrench me-1" viewBox="0 0 16 16" style="vertical-align: middle;"><path d="M.102 2.223A3.004 3.004 0 0 0 3.78 5.897l6.341 6.219a2.49 2.49 0 0 0 3.607-.048l1.702-1.67a2.5 2.5 0 0 0-.04-3.58L9.07 4.185A3.003 3.003 0 0 0 5.4 1.026a3.003 3.003 0 0 0-3.327.424L4.35 3.54c.231.226.244.595.033.826a.54.54 0 0 1-.806.012L1.517 2.146A3.003 3.003 0 0 0 .102 2.223M14 9.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/></svg>', 
          'Kecantikan' => '<svg xmlns="http://w3.org" width="16" height="16" fill="#b76e79" class="bi bi-flower1 me-1" viewBox="0 0 16 16" style="vertical-align: middle;"><path d="M6.174 1.184a2 2 0 0 1 3.652 0A2 2 0 0 1 12.99 3.01a2 2 0 0 1 1.826 3.164 2 2 0 0 1 0 3.652 2 2 0 0 1-1.826 3.164 2 2 0 0 1-3.164 1.826 2 2 0 0 1-3.652 0A2 2 0 0 1 3.01 12.99a2 2 0 0 1-1.826-3.164 2 2 0 0 1 0-3.652A2 2 0 0 1 3.01 3.01a2 2 0 0 1 3.164-1.826zM8 1a1 1 0 0 0-.913.596 1 1 0 0 0 1.826 0A1 1 0 0 0 8 1M3.33 3.33a1 1 0 0 0-.077 1.411 1 1 0 0 0 1.412-.077 1 1 0 0 0-.077-1.412 1 1 0 0 0-1.412.078m1.114 9.34a1 1 0 0 0-.077-1.412 1 1 0 0 0-1.412.077 1 1 0 0 0 .077 1.412 1 1 0 0 0 1.412-.077m7.112.077a1 1 0 0 0 1.412-.077 1 1 0 0 0-.077-1.412 1 1 0 0 0-1.412.077 1 1 0 0 0 .077 1.412m1.114-9.34a1 1 0 0 0 1.412.077 1 1 0 0 0-.077-1.412 1 1 0 0 0-1.412.078 1 1 0 0 0 .077 1.411M8 15a1 1 0 0 0 .913-.596 1 1 0 0 0-1.826 0A1 1 0 0 0 8 15m0-4.5a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5m0-1a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3"/></svg>'
        ];
      @endphp
      @if(count($catProducts) > 0)
        <div class="mb-5">
          <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
              <div class="section-eyebrow">{!! $catIcons[$cat] ?? '' !!} {{ $cat }}</div>
              <h2 style="font-family:'Cormorant Garamond',serif;font-size:1.8rem;font-weight:700;color:var(--text-dark);">Layanan {{ $cat }}</h2>
            </div>
            <a href="{{ route('user.katalog.index', ['kategori' => $cat]) }}" class="btn-rg-outline" style="font-size:0.82rem;">Lihat Semua</a>
          </div>
          <div class="row g-4">
            @foreach($catProducts as $product)
              @include('user.catalog._card', ['product' => $product])
            @endforeach
          </div>
        </div>
      @endif
    @endforeach
  @endif
</div>
@endsection
