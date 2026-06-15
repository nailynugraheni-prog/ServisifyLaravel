@extends('layouts.user')
@section('title', 'Histori Transaksi')
@section('content')
<div class="page-header">
  <div class="container" style="position:relative;z-index:1;">
    <h1 class="page-header-title d-flex align-items-center justify-content-center justify-content-md-start">
      <!-- Ikon Histori / Clipboard Text -->
      <svg xmlns="http://w3.org" width="32" height="32" fill="#b76e79" class="bi bi-clipboard2-data-fill me-3" viewBox="0 0 16 16">
        <path d="M10 .5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5.5.5 0 0 1-.5.5.5.5 0 0 0-.5.5V2a.5.5 0 0 0 .5.5h5A.5.5 0 0 0 11 2v-.5a.5.5 0 0 0-.5-.5.5.5 0 0 1-.5-.5"/>
        <path d="M4.085 1H3.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1h-.585q.084.234.085.5V2a1.5 1.5 0 0 1-1.5 1.5h-5A1.5 1.5 0 0 1 4 2v-.5q0-.266.085-.5M10 7a1 1 0 1 1-2 0 1 1 0 0 1 2 0M5.5 10.5A.5.5 0 0 1 6 10h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5"/>
      </svg>
      Histori Transaksi
    </h1>
  </div>
</div>
<div class="container" style="padding-bottom:4rem;">
  @if(empty($myTrx))
    <div class="empty-state">
      <div class="icon mb-3" style="display: inline-flex; align-items: center; justify-content: center;">
        <!-- Ikon Histori Kosong -->
        <svg xmlns="http://w3.org" width="48" height="48" fill="#b76e79" class="bi bi-clipboard2-x-fill" viewBox="0 0 16 16">
          <path d="M10 .5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5.5.5 0 0 1-.5.5.5.5 0 0 0-.5.5V2a.5.5 0 0 0 .5.5h5A.5.5 0 0 0 11 2v-.5a.5.5 0 0 0-.5-.5.5.5 0 0 1-.5-.5"/>
          <path d="M4.085 1H3.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1h-.585q.084.234.085.5V2a1.5 1.5 0 0 1-1.5 1.5h-5A1.5 1.5 0 0 1 4 2v-.5q0-.266.085-.5M6.854 7.146 8 8.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 9l1.147 1.146a.5.5 0 0 1-.708.708L8 9.707l-1.146 1.147a.5.5 0 0 1-.708-.708L7.293 9 6.146 7.854a.5.5 0 1 1 .708-.708"/>
        </svg>
      </div>
      <h4>Belum ada transaksi</h4>
      <p style="margin-bottom:1.5rem;">Yuk pesan layanan pertamamu!</p>
      <a href="{{ route('user.katalog.index') }}" class="btn-rg">Jelajahi Katalog</a>
    </div>
  @else
    <div class="row g-3">
      @foreach($myTrx as $trx)
        <div class="col-12 page-fade-in">
          <div class="card-servisify" style="border-radius:var(--radius-lg);">
            <div class="card-body-servisify">
              <div class="d-flex align-items-start justify-content-between flex-wrap gap-2">
                <div>
                  <div style="font-size:0.78rem;color:var(--text-light);margin-bottom:0.25rem;">{{ $trx['id'] }} · {{ \Carbon\Carbon::parse($trx['created_at'])->format('d M Y') }}</div>
                  <div style="font-weight:600;font-size:0.95rem;color:var(--text-dark);">
                    {{ implode(', ', array_map(fn($i) => $i['product_name'], $trx['items'])) }}
                  </div>
                  <!-- Ikon Peta / Lokasi (Geo-alt) -->
                  <div class="d-inline-flex align-items-center gap-1" style="font-size:0.82rem;color:var(--text-light);margin-top:0.25rem;">
                    <svg xmlns="http://w3.org" width="12" height="12" fill="#b76e79" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                      <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6"/>
                    </svg>
                    {{ Str::limit($trx['address'], 50) }}
                  </div>
                </div>
                <div style="text-align:right;">
                  <span class="badge-status badge-{{ $trx['status'] }}">{{ ucfirst($trx['status']) }}</span>
                  <div class="card-price mt-1">{{ \App\Helpers\DataHelper::formatRupiah($trx['total']) }}</div>
                </div>
              </div>
              <div class="d-flex gap-2 mt-3">
                <a href="{{ route('user.history.show', $trx['id']) }}" class="btn-rg-outline" style="font-size:0.82rem;padding:0.4rem 1rem;">Lihat Detail</a>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @endif
</div>
@endsection
