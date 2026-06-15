@extends('layouts.user')
@section('title', 'Keranjang')

@section('content')
<div class="page-header">
  <div class="container" style="position:relative;z-index:1;">
    <h1 class="page-header-title d-flex align-items-center justify-content-center justify-content-md-start">
      <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#b76e79" class="bi bi-cart3 me-3" viewBox="0 0 16 16">
        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l.84 4.479 9.144-.459L13.89 4zM5 12a1 1 0 1 0 0 2 1 1 0 0 0 0-2m7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2"/>
      </svg>
      Keranjang Belanja
    </h1>
  </div>
</div>

<div class="container" style="padding-bottom:4rem;">
  @if(empty($cart))
    <div class="empty-state">
      <div class="icon mb-3" style="display: inline-flex; align-items: center; justify-content: center;">
        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="#b76e79" class="bi bi-cart-x" viewBox="0 0 16 16">
          <path d="M7.354 5.646a.5.5 0 1 0-.708.708L7.793 7.5 6.646 8.646a.5.5 0 1 0 .708.708L8.5 8.207l1.146 1.147a.5.5 0 0 0 .708-.708L9.207 7.5l1.147-1.146a.5.5 0 0 0-.708-.708L8.5 6.793z"/>
          <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
        </svg>
      </div>
      <h4>Keranjang masih kosong</h4>
      <p style="margin-bottom:1.5rem;">Yuk, pilih layanan yang kamu butuhkan!</p>
      <a href="{{ route('user.katalog.index') }}" class="btn-rg">Jelajahi Katalog</a>
    </div>
  @else
    <div class="row g-4">
      <div class="col-lg-8">
        <form action="{{ route('user.keranjang.update') }}" method="POST" id="cart-form">
          @csrf

          <div style="background:white;border-radius:var(--radius-lg);box-shadow:var(--shadow-sm);border:1px solid var(--border);overflow:hidden;">
            <div style="padding:1.25rem 1.5rem;border-bottom:1px solid var(--border);background:var(--gradient-rg);">
              <h3 style="font-family:'Cormorant Garamond',serif;font-size:1.2rem;font-weight:600;margin:0;">
                Item Layanan ({{ count($cart) }})
              </h3>
            </div>

            @foreach($cart as $item)
              @php
                $image = $item['image'] ?? '';
                $imageSrc = '';
                if (!empty($image)) {
                  $imageSrc = preg_match('#^https?://#', $image) ? $image : asset($image);
                }
              @endphp

              <div class="cart-row d-flex align-items-center gap-3 p-4" data-price="{{ $item['price'] }}" style="border-bottom:1px solid var(--rg-50);">
                <div style="width:70px;height:70px;border-radius:12px;overflow:hidden;border:1px solid #eee;flex-shrink:0;background:#fff;">
                  @if(!empty($imageSrc))
                    <img
                      src="{{ $imageSrc }}"
                      alt="{{ $item['product_name'] }}"
                      style="width:100%;height:100%;object-fit:cover;display:block;"
                    >
                  @else
                    <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:#f8f8f8;color:#999;font-size:12px;">
                      No Image
                    </div>
                  @endif
                </div>

                <div class="flex-grow-1">
                  <div style="font-weight:600;color:var(--text-dark);font-size:0.95rem;">
                    {{ $item['product_name'] }}
                  </div>
                  <div class="card-category-badge mt-1">{{ $item['category'] }}</div>
                  <div class="card-price" style="font-size:1rem;margin-top:0.25rem;">
                    {{ \App\Helpers\DataHelper::formatRupiah($item['price']) }}
                  </div>
                </div>

                <div class="qty-control">
                  <button type="button" class="qty-btn" data-action="minus">−</button>
                  <input
                    class="qty-input"
                    type="number"
                    name="qty_{{ $item['product_id'] }}"
                    value="{{ $item['qty'] }}"
                    min="1"
                    max="99"
                    style="width:40px;text-align:center;border:none;background:transparent;font-weight:600;"
                  >
                  <button type="button" class="qty-btn" data-action="plus">+</button>
                </div>

                <div style="min-width:100px;text-align:right;">
                  <div class="subtotal" style="font-weight:700;color:var(--gold-deep);">
                    {{ \App\Helpers\DataHelper::formatRupiah($item['price'] * $item['qty']) }}
                  </div>
                </div>

                <button
                  type="submit"
                  form="remove-form-{{ $item['product_id'] }}"
                  class="btn-danger-soft"
                  style="padding:0.4rem 0.75rem;font-size:0.9rem;"
                  title="Hapus item"
                  onclick="return confirm('Yakin hapus item ini dari keranjang?')"
                >
                  ✕
                </button>
              </div>
            @endforeach
          </div>

          <button type="submit" class="btn-rg-outline mt-3 d-inline-flex align-items-center gap-2" style="font-size:0.85rem;">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="#b76e79" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
              <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-7.1 2h-3.932a.25.25 0 0 1-.192-.41l1.966-2.36a.25.25 0 0 1 .384 0l1.966 2.36a.25.25 0 0 1-.192.41z"/>
              <path d="M9.05 1.22A6 6 0 1 1 4.93 3.313l-.58-.58a7 7 0 1 0 1.56-1.683l.58.58c-.429.414-.822.886-1.173 1.41a5 5 0 1 0 5.48-2.32z"/>
            </svg>
            Perbarui Keranjang
          </button>
        </form>

        @foreach($cart as $item)
          <form id="remove-form-{{ $item['product_id'] }}" action="{{ route('user.keranjang.remove', $item['product_id']) }}" method="POST" style="display:none;">
            @csrf
          </form>
        @endforeach
      </div>

      <div class="col-lg-4">
        <div style="background:white;border-radius:var(--radius-lg);box-shadow:var(--shadow-sm);border:1px solid var(--border);overflow:hidden;position:sticky;top:80px;">
          <div style="padding:1.25rem 1.5rem;border-bottom:1px solid var(--border);background:var(--gradient-rg);">
            <h3 style="font-family:'Cormorant Garamond',serif;font-size:1.2rem;font-weight:600;margin:0;">Ringkasan Pesanan</h3>
          </div>

          <div style="padding:1.5rem;">
            @foreach($cart as $item)
              <div class="d-flex justify-content-between mb-2" style="font-size:0.85rem;color:var(--text-mid);">
                <span>{{ \Illuminate\Support\Str::limit($item['product_name'], 25) }} ×{{ $item['qty'] }}</span>
                <span>{{ \App\Helpers\DataHelper::formatRupiah($item['price'] * $item['qty']) }}</span>
              </div>
            @endforeach

            <hr style="border-color:var(--border);">

            <div class="d-flex justify-content-between">
              <strong>Total</strong>
              <strong id="cart-total" class="card-price">{{ \App\Helpers\DataHelper::formatRupiah($total) }}</strong>
            </div>

            <a href="{{ route('user.pembayaran') }}" class="btn-rg w-100 justify-content-center mt-3" style="padding:0.75rem;">Lanjut Pembayaran →</a>
            <a href="{{ route('user.katalog.index') }}" class="btn-rg-outline w-100 justify-content-center mt-2" style="font-size:0.82rem;">← Tambah Layanan Lain</a>
          </div>
        </div>
      </div>
    </div>
  @endif
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  const cartForm = document.getElementById('cart-form');
  if (!cartForm) return;

  const rupiah = (num) => {
    const value = Number(num || 0);
    return new Intl.NumberFormat('id-ID', {
      style: 'currency',
      currency: 'IDR',
      minimumFractionDigits: 0
    }).format(value);
  };

  function recalculateCart() {
    let total = 0;

    document.querySelectorAll('.cart-row').forEach(row => {
      const price = parseFloat(row.dataset.price || 0);
      const qtyInput = row.querySelector('.qty-input');
      let qty = parseInt(qtyInput.value || 1, 10);

      if (isNaN(qty) || qty < 1) qty = 1;
      if (qty > 99) qty = 99;

      qtyInput.value = qty;

      const subtotal = price * qty;
      total += subtotal;

      const subtotalEl = row.querySelector('.subtotal');
      if (subtotalEl) subtotalEl.textContent = rupiah(subtotal);
    });

    const totalEl = document.getElementById('cart-total');
    if (totalEl) totalEl.textContent = rupiah(total);
  }

  document.querySelectorAll('.qty-btn').forEach(btn => {
    btn.addEventListener('click', function () {
      const action = this.dataset.action;
      const row = this.closest('.cart-row');
      const input = row.querySelector('.qty-input');

      let value = parseInt(input.value || 1, 10);

      if (action === 'plus') value++;
      if (action === 'minus') value--;

      if (value < 1) value = 1;
      if (value > 99) value = 99;

      input.value = value;
      recalculateCart();
    });
  });

  document.querySelectorAll('.qty-input').forEach(input => {
    input.addEventListener('input', recalculateCart);
    input.addEventListener('change', recalculateCart);
  });

  recalculateCart();
});
</script>
@endpush