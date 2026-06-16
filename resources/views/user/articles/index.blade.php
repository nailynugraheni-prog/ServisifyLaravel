@extends('layouts.user')
@section('title', 'Artikel')

@section('content')

{{-- Page Header --}}
<div class="page-header">
  <div class="container" style="position:relative;z-index:1;">
    <h1 class="page-header-title d-flex align-items-center justify-content-center justify-content-md-start">
      <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#b76e79" class="bi bi-journal-text me-3" viewBox="0 0 16 16">
        <path d="M5 10.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5"/>
        <path d="M3 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1H3zm0 1h9v13H3a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1"/>
      </svg>
      Artikel
    </h1>
  </div>
</div>

<div class="container" style="padding-bottom:4rem;">

  @if(empty($articles))
    <div class="empty-state">
      <div class="icon mb-3" style="display:inline-flex;align-items:center;justify-content:center;">
        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="#b76e79" class="bi bi-journal-x" viewBox="0 0 16 16">
          <path d="M6.146 6.146a.5.5 0 0 1 .708 0L8 7.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 8l1.147 1.146a.5.5 0 0 1-.708.708L8 8.707l-1.146 1.147a.5.5 0 0 1-.708-.708L7.293 8 6.146 6.854a.5.5 0 0 1 0-.708z"/>
          <path d="M3 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1H3zm0 1h9v13H3a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1"/>
        </svg>
      </div>
      <h4>Belum ada artikel</h4>
      <p style="margin-bottom:1.5rem;">Artikel akan segera hadir, pantau terus ya!</p>
      <a href="{{ route('user.katalog.index') }}" class="btn-rg">Jelajahi Katalog</a>
    </div>

  @else
    <div class="row g-4 mt-1">
      @foreach($articles as $article)
        <div class="col-12 col-md-6 col-lg-4 page-fade-in">
          <a href="{{ route('user.artikel.show', $article['slug']) }}" style="text-decoration:none;">
            <div class="card-servisify h-100" style="border-radius:var(--radius-xl);overflow:hidden;transition:transform 0.2s,box-shadow 0.2s;" onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='var(--shadow-lg)'" onmouseout="this.style.transform='';this.style.boxShadow=''">

              {{-- Thumbnail --}}
              <div style="width:100%;height:180px;background:var(--gradient-rg);overflow:hidden;display:flex;align-items:center;justify-content:center;">
                @if(!empty($article['image']))
                  <img src="{{ asset($article['image']) }}" alt="{{ $article['title'] }}"
                       style="width:100%;height:100%;object-fit:cover;">
                @else
                  <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="#b76e79" opacity="0.5" viewBox="0 0 16 16">
                    <path d="M5 10.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5"/>
                    <path d="M3 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1H3zm0 1h9v13H3a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1"/>
                  </svg>
                @endif
              </div>

              {{-- Body --}}
              <div class="card-body-servisify" style="padding:1.25rem 1.4rem 1.5rem;">
                <span class="card-category-badge" style="margin-bottom:0.6rem;display:inline-block;">
                  {{ $article['category'] }}
                </span>

                <div style="font-family:'Cormorant Garamond',serif;font-size:1.15rem;font-weight:700;color:var(--text-dark);line-height:1.35;margin-bottom:0.5rem;">
                  {{ $article['title'] }}
                </div>

                <p style="font-size:0.85rem;color:var(--text-mid);line-height:1.6;margin-bottom:0.85rem;">
                  {{ \Illuminate\Support\Str::limit($article['excerpt'], 90) }}
                </p>

                <div style="font-size:0.78rem;color:var(--text-light);display:flex;align-items:center;gap:0.4rem;">
                  <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="#b76e79" viewBox="0 0 16 16">
                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"/>
                  </svg>
                  {{ \Carbon\Carbon::parse($article['created_at'])->format('d M Y') }}
                  <span style="margin:0 0.2rem;">·</span>
                  {{ $article['author_name'] ?? 'Admin Servisify' }}
                </div>
              </div>

            </div>
          </a>
        </div>
      @endforeach
    </div>
  @endif

</div>
@endsection