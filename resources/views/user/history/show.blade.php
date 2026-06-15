@extends('layouts.user')
@section('title', 'Detail Transaksi')
@section('content')
<div class="container" style="max-width:720px;padding-top:2.5rem;padding-bottom:4rem;">
  <a href="{{ route('user.history.index') }}" style="color:var(--gold-dark);text-decoration:none;font-size:0.85rem;font-weight:600;">← Kembali ke Histori</a>

  <div style="background:white;border-radius:var(--radius-xl);box-shadow:var(--shadow-md);border:1px solid var(--border);overflow:hidden;margin-top:1.5rem;">
    <div style="background:var(--gradient-rg);padding:1.75rem 2rem;">
      <div class="d-flex justify-content-between align-items-start">
        <div>
          <div style="font-family:'Cormorant Garamond',serif;font-size:1.5rem;font-weight:700;color:var(--text-dark);">{{ $trx['id'] }}</div>
          <div style="font-size:0.82rem;color:var(--text-mid);">{{ \Carbon\Carbon::parse($trx['created_at'])->format('d F Y') }}</div>
        </div>
        <span class="badge-status badge-{{ $trx['status'] }}" style="font-size:0.85rem;padding:6px 16px;">{{ ucfirst($trx['status']) }}</span>
      </div>
    </div>

    <div style="padding:2rem;">
      <h3 style="font-family:'Cormorant Garamond',serif;font-size:1.1rem;font-weight:700;color:var(--text-dark);margin-bottom:1rem;">Layanan Dipesan</h3>
      @foreach($trx['items'] as $item)
        <div class="d-flex justify-content-between align-items-center py-2" style="border-bottom:1px solid var(--rg-50);">
          <span style="font-size:0.9rem;color:var(--text-dark);">{{ $item['product_name'] }} ×{{ $item['qty'] }}</span>
          <span style="font-weight:600;color:var(--gold-deep);">{{ \App\Helpers\DataHelper::formatRupiah($item['price'] * $item['qty']) }}</span>
        </div>
      @endforeach
      <div class="d-flex justify-content-between align-items-center mt-3">
        <strong>Total</strong>
        <strong class="card-price" style="font-size:1.2rem;">{{ \App\Helpers\DataHelper::formatRupiah($trx['total']) }}</strong>
      </div>

      <hr style="border-color:var(--border);margin:1.5rem 0;">

      <div class="row g-3">
        <div class="col-sm-6">
          <div style="font-size:0.75rem;color:var(--text-light);font-weight:600;text-transform:uppercase;letter-spacing:0.5px;margin-bottom:0.25rem;">Metode Pembayaran</div>
          <div style="font-size:0.9rem;font-weight:600;color:var(--text-dark);">{{ ucfirst($trx['payment_method']) }}</div>
        </div>
        <div class="col-sm-6">
          <div style="font-size:0.75rem;color:var(--text-light);font-weight:600;text-transform:uppercase;letter-spacing:0.5px;margin-bottom:0.25rem;">Alamat Layanan</div>
          <div style="font-size:0.9rem;color:var(--text-dark);">{{ $trx['address'] }}</div>
        </div>
        @if($trx['notes'])
        <div class="col-12">
          <div style="font-size:0.75rem;color:var(--text-light);font-weight:600;text-transform:uppercase;letter-spacing:0.5px;margin-bottom:0.25rem;">Catatan</div>
          <div style="font-size:0.9rem;color:var(--text-dark);">{{ $trx['notes'] }}</div>
        </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection