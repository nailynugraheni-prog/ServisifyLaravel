@extends('layouts.admin')
@section('title', 'Tambah Produk')
@section('page-title')
<svg xmlns="http://w3.org" width="20" height="20" fill="#b76e79" class="bi bi-bag-fill me-2" viewBox="0 0 16 16" style="vertical-align: -3px;">
  <path d="M8 1a2 2 0 0 1 2 2v2H6V3a2 2 0 0 1 2-2m3 4V3a3 3 0 1 0-6 0v2H2a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2z"/>
</svg> Kelola Produk
@endsection
@section('content')
<div style="max-width:680px;">
  <div style="background:white;border-radius:var(--radius-lg);box-shadow:var(--shadow-sm);border:1px solid var(--border);overflow:hidden;">
    <div style="padding:1.25rem 1.5rem;border-bottom:1px solid var(--border);background:var(--gradient-rg);">
      <h3 style="font-family:'Cormorant Garamond',serif;font-size:1.2rem;font-weight:600;margin:0;">Form Produk Baru</h3>
    </div>
    <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data" class="form-servisify p-4">
      @csrf
      <div class="row g-3">
        <div class="col-md-8">
          <label class="form-label">Nama Layanan *</label>
          <input type="text" name="name" class="form-control" required placeholder="Nama layanan...">
        </div>
        <div class="col-md-4">
          <label class="form-label">Kategori *</label>
          <select name="category" class="form-select" required>
            <option value="">-- Pilih --</option>
            @foreach($categories as $cat)<option value="{{ $cat }}">{{ $cat }}</option>@endforeach
          </select>
        </div>
        <div class="col-md-6">
          <label class="form-label">Harga (Rp) *</label>
          <input type="text" name="price" class="form-control" required placeholder="150.000" data-rupiah>
        </div>
        <div class="col-md-6">
          <label class="form-label">Durasi *</label>
          <input type="text" name="duration" class="form-control" required placeholder="1-2 jam">
        </div>
        <div class="col-12">
          <label class="form-label">Deskripsi *</label>
          <textarea name="description" class="form-control" rows="4" required placeholder="Deskripsikan layanan ini..."></textarea>
        </div>
        <div class="col-12">
          <label class="form-label">Foto Layanan</label>
          <input type="file" name="image" class="form-control" accept="image/*" data-preview="img-preview">
          <img id="img-preview" style="display:none;margin-top:0.5rem;" class="img-upload-preview">
        </div>
        <div class="col-12">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" checked>
            <label class="form-check-label" for="is_active" style="font-size:0.88rem;color:var(--text-mid);">Aktifkan Produk</label>
          </div>
        </div>
      </div>
      <div class="d-flex gap-3 mt-4">
        <button type="submit" class="btn-rg">💾 Simpan Produk</button>
        <a href="{{ route('admin.produk.index') }}" class="btn-rg-outline">Batal</a>
      </div>
    </form>
  </div>
</div>
@endsection