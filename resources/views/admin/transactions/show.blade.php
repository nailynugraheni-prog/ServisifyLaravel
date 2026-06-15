@extends('layouts.admin')
@section('title', 'Detail Transaksi')

@section('page-title')
<!-- Judul Halaman dengan Ikon SVG Rose Gold -->
<svg xmlns="http://w3.org" width="20" height="20" fill="#b76e79" class="bi bi-credit-card-2-back-fill me-2" viewBox="0 0 16 16" style="vertical-align: -3px;">
  <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v5H0zm16 6H0v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zm-3 1a1 1 0 1 1-2 0 1 1 0 0 1 2 0m-4 1a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5"/>
</svg> Detail Transaksi
@endsection

@section('content')
<div style="max-width:720px;">
  <a href="{{ route('admin.transaksi.index') }}" style="color:var(--gold-dark);text-decoration:none;font-size:0.85rem;font-weight:600;display:inline-block;margin-bottom:1.5rem;">← Kembali</a>

  <div style="background:white;border-radius:var(--radius-xl);box-shadow:var(--shadow-md);border:1px solid var(--border);overflow:hidden;">
    <div style="background:var(--gradient-rg);padding:1.75rem 2rem;display:flex;justify-content:space-between;align-items:start;">
      <div>
        <div style="font-family:'Cormorant Garamond',serif;font-size:1.5rem;font-weight:700;color:var(--text-dark);">{{ $trx['id'] }}</div>
        <div style="font-size:0.82rem;color:var(--text-mid);">{{ \Carbon\Carbon::parse($trx['created_at'])->format('d F Y') }}</div>
      </div>
      <form action="{{ route('admin.transaksi.update', $trx['id']) }}" method="POST" class="d-inline">
        @csrf @method('PUT')
        <div class="d-flex gap-2 align-items-center">
          <select name="status" class="form-select form-select-sm" style="font-size:0.82rem;">
            @foreach(['pending','proses','selesai','batal'] as $s)
              <option value="{{ $s }}" {{ $trx['status']===$s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
            @endforeach
          </select>
          <button type="submit" class="btn-rg" style="padding:0.4rem 0.8rem;font-size:0.8rem;">Update</button>
        </div>
      </form>
    </div>

    <div style="padding:2rem;">
      <div class="row g-3 mb-3">
        <div class="col-sm-6">
          <div style="font-size:0.75rem;color:var(--text-light);font-weight:700;text-transform:uppercase;letter-spacing:0.5px;margin-bottom:0.25rem;">Pelanggan</div>
          <div style="font-weight:600;color:var(--text-dark);">{{ $trx['user_name'] }}</div>
        </div>
        <div class="col-sm-6">
          <div style="font-size:0.75rem;color:var(--text-light);font-weight:700;text-transform:uppercase;letter-spacing:0.5px;margin-bottom:0.25rem;">Metode Bayar</div>
          <div style="font-weight:600;color:var(--text-dark);">{{ ucfirst($trx['payment_method']) }}</div>
        </div>
        <div class="col-12">
          <div style="font-size:0.75rem;color:var(--text-light);font-weight:700;text-transform:uppercase;letter-spacing:0.5px;margin-bottom:0.25rem;">Alamat</div>
          <div style="color:var(--text-dark);">{{ $trx['address'] }}</div>
        </div>
        @if($trx['notes'])
          <div class="col-12">
            <div style="font-size:0.75rem;color:var(--text-light);font-weight:700;text-transform:uppercase;letter-spacing:0.5px;margin-bottom:0.25rem;">Catatan</div>
            <div style="color:var(--text-dark);">{{ $trx['notes'] }}</div>
          </div>
        @endif
      </div>

      <hr style="border-color:var(--border);">
      <h4 style="font-family:'Cormorant Garamond',serif;font-size:1.1rem;font-weight:700;margin-bottom:1rem;">Layanan Dipesan</h4>
      @foreach($trx['items'] as $item)
        <div class="d-flex justify-content-between align-items-center py-2" style="border-bottom:1px solid var(--rg-50);">
          <span style="font-size:0.9rem;">{{ $item['product_name'] }} <span style="color:var(--text-light);">×{{ $item['qty'] }}</span></span>
          <span style="font-weight:600;color:var(--gold-deep);">{{ \App\Helpers\DataHelper::formatRupiah($item['price'] * $item['qty']) }}</span>
        </div>
      @endforeach
      <div class="d-flex justify-content-between align-items-center mt-3">
        <strong style="font-size:1rem;">Total</strong>
        <strong class="card-price" style="font-size:1.3rem;">{{ \App\Helpers\DataHelper::formatRupiah($trx['total']) }}</strong>
      </div>
    </div>
  </div>
</div>
@endsection
