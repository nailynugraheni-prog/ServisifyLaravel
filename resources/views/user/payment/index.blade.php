@extends('layouts.user')
@section('title', 'Pembayaran')

@section('content')
<div class="page-header">
  <div class="container" style="position:relative;z-index:1;">
    <h1 class="page-header-title d-flex align-items-center gap-2">
      <svg xmlns="http://w3.org" width="32" height="32" fill="#b76e79" class="bi bi-credit-card-2-front" viewBox="0 0 16 16">
        <path d="M14 3a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1zM2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2z"/>
        <path d="M2 5.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5zm0 4a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z"/>
      </svg>
      Pembayaran
    </h1>
  </div>
</div>

<div class="container" style="padding-bottom:4rem;">
  <div class="row g-4">
    <div class="col-lg-7">
      <div style="background:white;border-radius:var(--radius-lg);box-shadow:var(--shadow-sm);border:1px solid var(--border);overflow:hidden;">
        <div style="padding:1.25rem 1.5rem;border-bottom:1px solid var(--border);background:var(--gradient-rg);">
          <h3 style="font-family:'Cormorant Garamond',serif;font-size:1.2rem;font-weight:600;margin:0;">Detail Pemesanan</h3>
        </div>

        <form action="{{ route('user.pembayaran.proses') }}" method="POST" class="form-servisify p-4">
          @csrf

          <div class="mb-3">
            <label class="form-label">Alamat Layanan <span style="color:red">*</span></label>
            <textarea name="address" class="form-control" rows="3" placeholder="Masukkan alamat lengkap tempat layanan akan dilakukan..." required></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">Metode Pembayaran <span style="color:red">*</span></label>
            <div class="d-flex gap-3 flex-wrap">
              @php
                $payment_methods = [
                  'transfer' => [
                    'label' => 'Transfer Bank',
                    'svg' => '<svg xmlns="http://w3.org" width="24" height="24" fill="#b76e79" class="bi bi-bank" viewBox="0 0 16 16"><path d="M8 .95 1.545 4h12.91L8 .95ZM1.5 5a.5.5 0 0 0-.5.5v2h14v-2a.5.5 0 0 0-.5-.5H1.5ZM2 8.5v5h1v-5H2Zm3 0v5h1v-5H5Zm3 0v5h1v-5H8Zm3 0v5h1v-5h-1Zm3 0v5h1v-5h-1ZM.5 14a.5.5 0 0 0 0 1h15a.5.5 0 0 0 0-1H.5Z"/></svg>'
                  ],
                  'cod' => [
                    'label' => 'Bayar di Tempat',
                    'svg' => '<svg xmlns="http://w3.org" width="24" height="24" fill="#b76e79" class="bi bi-cash-stack" viewBox="0 0 16 16"><path d="M1 3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1H1zm7 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/><path d="M0 5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V5zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V7a2 2 0 0 1-2-2H3z"/></svg>'
                  ],
                  'ewallet' => [
                    'label' => 'E-Wallet',
                    'svg' => '<svg xmlns="http://w3.org" width="24" height="24" fill="#b76e79" class="bi bi-phone" viewBox="0 0 16 16"><path d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h6zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H5z"/><path d="M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/></svg>'
                  ]
                ];
              @endphp

              @foreach($payment_methods as $val => $info)
                <label style="flex:1;min-width:120px;cursor:pointer;">
                  <input type="radio" name="payment_method" value="{{ $val }}" required style="display:none;" class="payment-radio" id="pm_{{ $val }}">
                  <div class="payment-option" style="border:2px solid var(--border);border-radius:var(--radius-md);padding:0.75rem;text-align:center;transition:all 0.2s;font-size:0.85rem;font-weight:500;">
                    <div style="margin-bottom:0.4rem; display: flex; justify-content: center; align-items: center;">
                      {!! $info['svg'] !!}
                    </div>
                    {{ $info['label'] }}
                  </div>
                </label>
              @endforeach
            </div>
          </div>

          <div class="mb-4">
            <label class="form-label">Catatan (opsional)</label>
            <input type="text" name="notes" class="form-control" placeholder="Misal: Pagi hari setelah jam 9...">
          </div>

          <button type="submit" class="btn-rg w-100 justify-content-center d-flex align-items-center gap-2" style="padding:0.8rem;">
            <svg xmlns="http://w3.org" width="18" height="18" fill="#b76e79" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
              <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
            </svg>
            Konfirmasi Pesanan
          </button>
        </form>
      </div>
    </div>

    <div class="col-lg-5">
      <div style="background:white;border-radius:var(--radius-lg);box-shadow:var(--shadow-sm);border:1px solid var(--border);overflow:hidden;position:sticky;top:80px;">
        <div style="padding:1.25rem 1.5rem;border-bottom:1px solid var(--border);background:var(--gradient-rg);">
          <h3 style="font-family:'Cormorant Garamond',serif;font-size:1.2rem;font-weight:600;margin:0;">Ringkasan Pesanan</h3>
        </div>

        <div style="padding:1.5rem;">
          @if($isFirstTransaction && $discountAmount > 0)
            <div style="background:#fff5f5;border:1px solid #f4c7c7;color:#b23a3a;border-radius:var(--radius-md);padding:0.85rem 1rem;margin-bottom:1rem;">
              <div style="font-size:0.82rem;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;margin-bottom:0.25rem;">
                Promo Pelanggan Baru
              </div>
              <div style="font-size:0.9rem;">
                Kamu mendapatkan diskon <strong>30%</strong> untuk transaksi pertama.
              </div>
            </div>
          @endif

          @foreach($cart as $item)
            @php
              $image = $item['image'] ?? '';
              $imageSrc = '';

              if (!empty($image)) {
                if (preg_match('#^https?://#', $image)) {
                  $imageSrc = $image;
                } elseif (str_starts_with($image, 'storage/')) {
                  $imageSrc = asset($image);
                } else {
                  $imageSrc = asset($image);
                }
              }
            @endphp

            <div class="d-flex gap-2 mb-3 align-items-start">
              <div style="width:54px;height:54px;border-radius:var(--radius-sm);overflow:hidden;background:#f8f8f8;display:flex;align-items:center;justify-content:center;flex-shrink:0;border:1px solid var(--border);">
                @if(!empty($imageSrc))
                  <img
                    src="{{ $imageSrc }}"
                    alt="{{ $item['product_name'] }}"
                    style="width:100%;height:100%;object-fit:cover;display:block;"
                  >
                @else
                  <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:#999;font-size:0.72rem;">
                    No Image
                  </div>
                @endif
              </div>

              <div class="flex-grow-1">
                <div style="font-size:0.85rem;font-weight:600;color:var(--text-dark);">{{ $item['product_name'] }}</div>
                <div style="font-size:0.78rem;color:var(--text-light);">×{{ $item['qty'] }}</div>
              </div>

              <div style="font-size:0.88rem;font-weight:600;color:var(--gold-deep);">
                {{ \App\Helpers\DataHelper::formatRupiah($item['price'] * $item['qty']) }}
              </div>
            </div>
          @endforeach

          <hr style="border-color:var(--border);">

          <div class="d-flex justify-content-between mb-2">
            <span style="color:var(--text-mid);">Subtotal</span>
            @if($isFirstTransaction && $discountAmount > 0)
              <span style="text-decoration: line-through; color: var(--text-light);">
                {{ \App\Helpers\DataHelper::formatRupiah($subtotal) }}
              </span>
            @else
              <span style="color:var(--text-dark);">
                {{ \App\Helpers\DataHelper::formatRupiah($subtotal) }}
              </span>
            @endif
          </div>

          @if($isFirstTransaction && $discountAmount > 0)
            <div class="d-flex justify-content-between mb-2" style="color:#c0392b;">
              <span>Diskon transaksi pertama (30%)</span>
              <span>-{{ \App\Helpers\DataHelper::formatRupiah($discountAmount) }}</span>
            </div>

            <div style="font-size:0.82rem;color:var(--text-light);margin-bottom:0.9rem;">
              Potongan otomatis untuk pelanggan baru.
            </div>
          @endif

          <hr style="border-color:var(--border);">

          <div class="d-flex justify-content-between align-items-center">
            <strong style="font-size:1rem;">Total Pembayaran</strong>
            <strong class="card-price" style="font-size:1.3rem;">
              {{ \App\Helpers\DataHelper::formatRupiah($total) }}
            </strong>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
document.querySelectorAll('.payment-radio').forEach(radio => {
  radio.addEventListener('change', function() {
    document.querySelectorAll('.payment-option').forEach(el => {
      el.style.borderColor = 'var(--border)';
      el.style.background  = 'white';
      el.style.color       = 'var(--text-dark)';
    });

    this.nextElementSibling.style.borderColor = 'var(--gold-mid)';
    this.nextElementSibling.style.background   = 'var(--rg-50)';
    this.nextElementSibling.style.color        = 'var(--gold-deep)';
  });
});
</script>
@endpush
@endsection