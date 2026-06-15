@extends('layouts.admin')
@section('title', 'Kelola Produk')

@section('page-title')
<svg xmlns="http://w3.org" width="20" height="20" fill="#b76e79" class="bi bi-bag-fill me-2" viewBox="0 0 16 16" style="vertical-align: -3px;">
  <path d="M8 1a2 2 0 0 1 2 2v2H6V3a2 2 0 0 1 2-2m3 4V3a3 3 0 1 0-6 0v2H2a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2z"/>
</svg> Kelola Produk
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <p style="color:var(--text-light);font-size:0.9rem;">
    Total: <strong>{{ count($products) }}</strong> produk dalam <strong>{{ count($categories) }}</strong> kategori
  </p>
  <a href="{{ route('admin.produk.create') }}" class="btn-rg">+ Tambah Produk</a>
</div>

<div style="overflow-x:auto;">
  <table class="table-servisify">
    <thead>
      <tr>
        <th>Nama Produk</th>
        <th>Kategori</th>
        <th>Harga</th>
        <th>Durasi</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @forelse($products as $p)
        <tr>
          <td>
            <div class="d-flex align-items-center gap-2">
              <div style="width:36px;height:36px;border-radius:var(--radius-sm);background:var(--gradient-rg);display:flex;align-items:center;justify-content:center;flex-shrink:0;overflow:hidden;">
                @if(!empty($p['image']))
                  <img
                    src="{{ asset($p['image']) }}"
                    alt="{{ $p['name'] }}"
                    style="width:100%;height:100%;object-fit:cover;"
                  >
                @else
                  @if(($p['category'] ?? '') == 'Kebersihan')
                    <svg xmlns="http://w3.org" width="18" height="18" fill="#b76e79" class="bi bi-broom" viewBox="0 0 16 16">
                      <path d="M11.233.155a.5.5 0 0 1 .644.25l.443.886 1.405-.281a.5.5 0 0 1 .533.68l-.833 1.666 1.341.447a.5.5 0 0 1 .31.644l-.667 2a.5.5 0 0 1-.644.31l-1.341-.447-.833 1.666a.5.5 0 0 1-.68.233l-1.405-.703-.443.886a.5.5 0 0 1-.722.176l-8-6a.5.5 0 0 1-.133-.674l.5-.75a.5.5 0 0 1 .632-.144l.872.482L5.05 3.01l-.736-.368a.5.5 0 0 1-.223-.644l.5-1a.5.5 0 0 1 .644-.223l.736.368L7.157.945a.5.5 0 0 1 .674.133l.5.75a.5.5 0 0 1-.051.621l-.644.515 2.19 1.46 1.406-.703-.443-.886a.5.5 0 0 1 .25-.644zm-1.8 3.6 1.705.852.417-.834-1.705-.852-.417.834zM7.222 4.11l1.341.67-.416.834-1.342-.67.417-.834zm-1.606-.8L6.957 3.98l-.417.833-1.342-.67.417-.834zm-1.637-.82 1.342.67-.417.833-1.341-.67.416-.834zm-.897 2.127 7.747 5.81.417-.833-7.747-5.81-.417.833zm11.396 6.305a.5.5 0 0 0-.447-.282H1.5a.5.5 0 0 0-.447.724l2 4A.5.5 0 0 0 3.5 16h9a.5.5 0 0 0 .447-.276l2-4z"/>
                    </svg>
                  @elseif(($p['category'] ?? '') == 'Perbaikan')
                    <svg xmlns="http://w3.org" width="18" height="18" fill="#b76e79" class="bi bi-wrench-adjustable" viewBox="0 0 16 16">
                      <path d="M16 4.5a4.5 4.5 0 0 1-1.703 3.526L13 10l-1.25.25L11 11l-.429 3.428a.5.5 0 0 1-.317.415l-1.25.417a.5.5 0 0 1-.518-.104l-2-2a.5.5 0 0 1-.104-.518l.417-1.25a.5.5 0 0 1 .415-.317L7 11l.75-.75.25-1.25 1.974-1.297A4.5 4.5 0 1 1 16 4.5m-4.5 0a3.5 3.5 0 1 0-7 0 3.5 3.5 0 0 0 7 0"/>
                    </svg>
                  @elseif(($p['category'] ?? '') == 'Kecantikan')
                    <svg xmlns="http://w3.org" width="18" height="18" fill="#b76e79" class="bi bi-sparkles" viewBox="0 0 16 16">
                      <path d="M5.5 0a.5.5 0 0 1 .5.5v2.75l2.25.75a.5.5 0 0 1 0 .95l-2.25.75V8.5a.5.5 0 0 1-1 0V5.7l-2.25-.75a.5.5 0 0 1 0-.95l2.25-.75V.5a.5.5 0 0 1 .5-.5M12 4a.5.5 0 0 1 .5.5v1.2l1.2.4a.5.5 0 0 1 0 .95l-1.2.4v1.2a.5.5 0 0 1-1 0V7.45l-1.2-.4a.5.5 0 0 1 0-.95l1.2-.4V4.5a.5.5 0 0 1 .5-.5m-3 6a.5.5 0 0 1 .5.5v1.2l1.2.4a.5.5 0 0 1 0 .95l-1.2.4v1.2a.5.5 0 0 1-1 0v-1.2l-1.2-.4a.5.5 0 0 1 0-.95l1.2-.4v-1.2a.5.5 0 0 1 .5-.5"/>
                    </svg>
                  @else
                    <svg xmlns="http://w3.org" width="18" height="18" fill="#b76e79" class="bi bi-bag-fill" viewBox="0 0 16 16">
                      <path d="M8 1a2 2 0 0 1 2 2v2H6V3a2 2 0 0 1 2-2m3 4V3a3 3 0 1 0-6 0v2H2a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2z"/>
                    </svg>
                  @endif
                @endif
              </div>
              <strong>{{ $p['name'] }}</strong>
            </div>
          </td>

          <td><span class="card-category-badge">{{ $p['category'] }}</span></td>
          <td><strong style="color:var(--gold-deep);">{{ \App\Helpers\DataHelper::formatRupiah($p['price']) }}</strong></td>
          <td style="font-size:0.85rem;">{{ $p['duration'] }}</td>
          <td><span class="badge-status {{ $p['is_active'] ? 'badge-selesai' : 'badge-batal' }}">{{ $p['is_active'] ? 'Aktif' : 'Nonaktif' }}</span></td>
          <td>
            <div class="d-flex gap-2">
              <a href="{{ route('admin.produk.edit', $p['id']) }}" class="btn-rg-outline" style="font-size:0.78rem;padding:0.35rem 0.75rem;">Edit</a>
              <form action="{{ route('admin.produk.destroy', $p['id']) }}" method="POST" class="d-inline">
                @csrf @method('DELETE')
                <button type="submit" class="btn-danger-soft" data-confirm="Hapus produk ini?">Hapus</button>
              </form>
            </div>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="6" style="text-align:center;padding:3rem;color:var(--text-light);">Belum ada produk.</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection