<div class="col-md-6 col-lg-4 page-fade-in">
  <div class="card-servisify h-100">
    <div class="card-img-wrap">
      @if($product['image'])
        <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}">
      @else
        <div class="card-img-placeholder">
          @php $icons = ['Kebersihan' => '🧹', 'Perbaikan' => '🔧', 'Kecantikan' => '💆']; @endphp
          <span>{{ $icons[$product['category']] ?? '🛍️' }}</span>
          <span>{{ $product['category'] }}</span>
        </div>
      @endif
    </div>
    <div class="card-body-servisify">
      <div class="card-category-badge">{{ $product['category'] }}</div>
      <h3 class="card-title-servisify">{{ $product['name'] }}</h3>
      <p style="font-size:0.83rem;color:var(--text-light);margin-bottom:0.75rem;line-height:1.5;">
        {{ Str::limit($product['description'], 80) }}
      </p>
      <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
          <div class="card-price">{{ \App\Helpers\DataHelper::formatRupiah($product['price']) }}</div>
          <div style="font-size:0.75rem;color:var(--text-light);">⏱ {{ $product['duration'] }}</div>
        </div>
      </div>
      <a href="{{ route('user.katalog.show', $product['id']) }}" class="btn-rg w-100 justify-content-center">Lihat Detail</a>
    </div>
  </div>
</div>