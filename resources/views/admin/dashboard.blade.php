@extends('layouts.admin')
@section('title', 'Dashboard')

@section('page-title')
<svg xmlns="http://w3.org" width="20" height="20" fill="#b76e79" class="bi bi-bar-chart-line-fill me-2" viewBox="0 0 16 16" style="vertical-align: -3px;">
  <path d="M11 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h1V7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7h1zm1 12h2V2h-2zm-4 0h2V7H8zm-4 0h2v-3H4z"/>
</svg> Dashboard
@endsection

@section('content')

<div class="row g-4 mb-4">
  @php
  $statItems = [
    [
      'icon' => '<svg xmlns="http://w3.org" width="22" height="22" fill="#b76e79" class="bi bi-bag-fill" viewBox="0 0 16 16"><path d="M8 1a2 2 0 0 1 2 2v2H6V3a2 2 0 0 1 2-2m3 4V3a3 3 0 1 0-6 0v2H2a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2z"/></svg>',
      'num' => $stats['total_produk'],
      'label' => 'Total Produk',
      'color' => '#f9c8c0'
    ],
    [
      'icon' => '<svg xmlns="http://w3.org" width="22" height="22" fill="#b76e79" class="bi bi-people-fill" viewBox="0 0 16 16"><path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/></svg>',
      'num' => $stats['total_pengguna'],
      'label' => 'Total Pengguna',
      'color' => '#bbdefb'
    ],
    [
      'icon' => '<svg xmlns="http://w3.org" width="22" height="22" fill="#b76e79" class="bi bi-credit-card-2-back-fill" viewBox="0 0 16 16"><path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v5H0zm16 6H0v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zm-3 1a1 1 0 1 1-2 0 1 1 0 0 1 2 0m-4 1a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5"/></svg>',
      'num' => $stats['total_transaksi'],
      'label' => 'Total Transaksi',
      'color' => '#f3e5f5'
    ],
  ];
  @endphp
  @foreach($statItems as $s)
    <div class="col-sm-6 col-xl-3 page-fade-in">
      <div class="stat-card">
        <div class="stat-icon" style="background:{{ $s['color'] }}; display: flex; align-items: center; justify-content: center;">
          {!! $s['icon'] !!}
        </div>
        <div class="stat-number">{{ $s['num'] }}</div>
        <div class="stat-label">{{ $s['label'] }}</div>
      </div>
    </div>
  @endforeach
</div>

<div class="row g-4 mb-4">
  <div class="col-md-4">
    <div class="stat-card" style="background:linear-gradient(135deg,#fff8e1,#fffde7);">
      <div class="stat-icon" style="background:#fde68a; display: flex; align-items: center; justify-content: center;">
        <svg xmlns="http://w3.org" width="20" height="20" fill="#b76e79" class="bi bi-hourglass-split" viewBox="0 0 16 16">
          <path d="M2.5 15a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1zm2-12v1c0 .537.12 1.045.337 1.5h6.326c.216-.455.337-.963.337-1.5V3zm3 6.35c0 .701-.478 1.236-1.011 1.492A3.5 3.5 0 0 0 4.5 14h7a3.5 3.5 0 0 0-2.011-3.158C8.978 10.586 8.5 10.051 8.5 9.351z"/>
        </svg>
      </div>
      <div class="stat-number" style="color:#f59e0b;">{{ $stats['pending'] }}</div>
      <div class="stat-label">Transaksi Pending</div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="stat-card" style="background:linear-gradient(135deg,#e3f2fd,#f3f9ff);">
      <div class="stat-icon" style="background:#bbdefb; display: flex; align-items: center; justify-content: center;">
        <svg xmlns="http://w3.org" width="20" height="20" fill="#b76e79" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
          <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-7.1 2h-3.932a.25.25 0 0 1-.192-.41l1.966-2.36a.25.25 0 0 1 .384 0l1.966 2.36a.25.25 0 0 1-.192.41z"/>
          <path d="M9.05 1.22A6 6 0 1 1 4.93 3.313l-.58-.58a7 7 0 1 0 1.56-1.683l.58.58c-.429.414-.822.886-1.173 1.41a5 5 0 1 0 5.48-2.32z"/>
        </svg>
      </div>
      <div class="stat-number" style="color:#1976d2;">{{ $stats['proses'] }}</div>
      <div class="stat-label">Sedang Diproses</div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="stat-card" style="background:linear-gradient(135deg,#e8f5e9,#f1f8f2);">
      <div class="stat-icon" style="background:#c8e6c9; display: flex; align-items: center; justify-content: center;">
        <svg xmlns="http://w3.org" width="20" height="20" fill="#b76e79" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
          <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
        </svg>
      </div>
      <div class="stat-number" style="color:#388e3c;">{{ $stats['selesai'] }}</div>
      <div class="stat-label">Selesai · Pendapatan: <strong>{{ \App\Helpers\DataHelper::formatRupiah($stats['total_pendapatan']) }}</strong></div>
    </div>
  </div>
</div>

<div style="background:white;border-radius:var(--radius-lg);box-shadow:var(--shadow-sm);border:1px solid var(--border);overflow:hidden;">
  <div style="padding:1.25rem 1.5rem;border-bottom:1px solid var(--border);background:var(--gradient-rg);display:flex;justify-content:space-between;align-items:center;">
    <h3 style="font-family:'Cormorant Garamond',serif;font-size:1.2rem;font-weight:600;margin:0;">Transaksi Terbaru</h3>
    <a href="{{ route('admin.transaksi.index') }}" style="color:var(--gold-dark);font-size:0.82rem;font-weight:600;">Lihat Semua →</a>
  </div>
  <div style="overflow-x:auto;">
    <table class="table-servisify">
      <thead>
        <tr>
          <th>ID</th><th>Pelanggan</th><th>Layanan</th><th>Total</th><th>Status</th><th>Tanggal</th>
        </tr>
      </thead>
      <tbody>
        @foreach($recentTrx as $trx)
          <tr>
            <td><strong style="color:var(--gold-dark);">{{ $trx['id'] }}</strong></td>
            <td>{{ $trx['user_name'] }}</td>
            <td style="max-width:200px;">{{ Str::limit(implode(', ', array_column($trx['items'],'product_name')), 40) }}</td>
            <td><strong>{{ \App\Helpers\DataHelper::formatRupiah($trx['total']) }}</strong></td>
            <td><span class="badge-status badge-{{ $trx['status'] }}">{{ ucfirst($trx['status']) }}</span></td>
            <td>{{ $trx['created_at'] }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
