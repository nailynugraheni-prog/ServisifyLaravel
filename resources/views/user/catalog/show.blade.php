@extends('layouts.user')
@section('title', $product['name'])
@section('content')
<div class="container" style="padding-top:2.5rem;padding-bottom:4rem;">
  <nav style="font-size:0.82rem;color:var(--text-light);margin-bottom:2rem;">
    <a href="{{ route('user.katalog.index') }}" style="color:var(--gold-dark);text-decoration:none;">Katalog</a>
    <span style="margin:0 0.5rem;">›</span>
    <a href="{{ route('user.katalog.index', ['kategori' => $product['category']]) }}" style="color:var(--gold-dark);text-decoration:none;">{{ $product['category'] }}</a>
    <span style="margin:0 0.5rem;">›</span>
    {{ $product['name'] }}
  </nav>

  <div class="row g-5 align-items-start">
    <div class="col-lg-6">
      <div class="product-detail-img">
        @if($product['image'])
          <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}">
        @else
          @php $icons = ['Kebersihan' => '🧹', 'Perbaikan' => '🔧', 'Kecantikan' => '💆']; @endphp
          <div style="display:flex;flex-direction:column;align-items:center;gap:1rem;color:var(--gold-dark);">
            <span style="font-size:5rem;">{{ $icons[$product['category']] ?? '🛍️' }}</span>
            <span style="font-size:1rem;font-weight:600;color:var(--text-mid);">{{ $product['name'] }}</span>
          </div>
        @endif
      </div>
    </div>

    <div class="col-lg-6">
      <div class="card-category-badge mb-3">{{ $product['category'] }}</div>
      <h1 style="font-family:'Cormorant Garamond',serif;font-size:2.2rem;font-weight:700;color:var(--text-dark);line-height:1.2;margin-bottom:0.75rem;">{{ $product['name'] }}</h1>

      <div class="d-flex align-items-center gap-3 mb-3">
        <span style="color:var(--text-light);font-size:0.85rem;">⏱ {{ $product['duration'] }}</span>
      </div>

      <div class="card-price" style="font-size:1.8rem;margin-bottom:1.25rem;">{{ \App\Helpers\DataHelper::formatRupiah($product['price']) }}</div>

      <p style="color:var(--text-mid);line-height:1.7;margin-bottom:2rem;font-size:0.95rem;">{{ $product['description'] }}</p>

      <div style="background:var(--rg-50);border-radius:var(--radius-md);padding:1rem 1.25rem;margin-bottom:1.75rem;border:1px solid var(--border);">
        <p style="font-size:0.82rem;font-weight:700;color:var(--gold-dark);text-transform:uppercase;letter-spacing:0.5px;margin-bottom:0.5rem;">Termasuk dalam layanan</p>
        <ul style="font-size:0.85rem;color:var(--text-mid);margin:0;padding-left:1.2rem;line-height:2;">
          <li>Teknisi / tenaga profesional berpengalaman</li>
          <li>Peralatan & perlengkapan lengkap</li>
          <li>Garansi kepuasan layanan</li>
          <li>Konsultasi gratis setelah layanan</li>
        </ul>
      </div>

      <form action="{{ route('user.keranjang.add') }}" method="POST">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product['id'] }}">
        <button type="submit" class="btn-rg" style="padding:0.8rem 2rem;font-size:1rem;">
          🛒 Tambah ke Keranjang
        </button>
      </form>
    </div>
  </div>

  @if(count($related) > 0)
    <div class="mt-5 pt-4">
      <div class="section-header" style="text-align:left;">
        <div class="section-eyebrow">Layanan Serupa</div>
        <h2 class="section-title" style="font-size:1.6rem;">Mungkin Kamu Suka</h2>
      </div>
      <div class="row g-4">
        @foreach($related as $rel)
          @include('user.catalog._card', ['product' => $rel])
        @endforeach
      </div>
    </div>
  @endif
</div>
@endsection