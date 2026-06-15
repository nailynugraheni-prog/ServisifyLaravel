@extends('layouts.user')
@section('title', 'Detail Artikel')

@section('content')
<div class="container" style="max-width:900px;padding-top:2.5rem;padding-bottom:4rem;">
  <a href="{{ route('user.artikel.index') }}" style="color:var(--gold-dark);text-decoration:none;font-size:0.85rem;font-weight:600;">
    ← Kembali ke Artikel
  </a>

  <div style="background:white;border-radius:var(--radius-xl);box-shadow:var(--shadow-md);border:1px solid var(--border);overflow:hidden;margin-top:1.5rem;">
    <div style="background:var(--gradient-rg);padding:1.75rem 2rem;">
      <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
        <div>
          <span class="card-category-badge">{{ $article['category'] }}</span>
          <div style="font-family:'Cormorant Garamond',serif;font-size:1.8rem;font-weight:700;color:var(--text-dark);line-height:1.2;margin-top:0.5rem;">
            {{ $article['title'] }}
          </div>
          <div style="font-size:0.82rem;color:var(--text-mid);margin-top:0.4rem;">
            {{ $article['author_name'] ?? 'Admin Servisify' }} · {{ \Carbon\Carbon::parse($article['created_at'])->format('d F Y') }}
          </div>
        </div>
      </div>
    </div>

    @if(!empty($article['image']))
      <div class="product-detail-img" style="min-height:auto;">
        <img src="{{ asset($article['image']) }}" alt="{{ $article['title'] }}">
      </div>
    @endif

    <div style="padding:2rem;">
      <div style="font-size:1rem;color:var(--text-dark);line-height:1.85;">
        {!! nl2br(e($article['content'])) !!}
      </div>
    </div>
  </div>
</div>
@endsection