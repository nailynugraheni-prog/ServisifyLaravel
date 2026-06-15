@extends('layouts.admin')
@section('title', 'Tambah Artikel')

@section('page-title')
<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#b76e79" class="bi bi-journal-plus me-2" viewBox="0 0 16 16" style="vertical-align: -3px;">
  <path d="M8 16a5 5 0 1 0 0-10 5 5 0 0 0 0 10m0-9a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V8H6a.5.5 0 0 1 0-1h1.5V7.5A.5.5 0 0 1 8 7z"/>
  <path d="M3 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a6 6 0 0 1-1-1H3a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h7v4h4v1.1a6.1 6.1 0 0 1 1 1V4.5L10.5 0H3z"/>
</svg>
Kelola Artikel
@endsection

@section('content')
<div style="max-width:780px;">
  <div style="background:white;border-radius:var(--radius-lg);box-shadow:var(--shadow-sm);border:1px solid var(--border);overflow:hidden;">
    <div style="padding:1.25rem 1.5rem;border-bottom:1px solid var(--border);background:var(--gradient-rg);">
      <h3 style="font-family:'Cormorant Garamond',serif;font-size:1.2rem;font-weight:600;margin:0;">Form Artikel Baru</h3>
    </div>

    <form action="{{ route('admin.artikel.store') }}" method="POST" enctype="multipart/form-data" class="form-servisify p-4">
      @csrf

      <div class="row g-3">
        <div class="col-12">
          <label class="form-label">Judul Artikel *</label>
          <input type="text" name="title" class="form-control" required placeholder="Masukkan judul artikel">
        </div>

        <div class="col-md-4">
          <label class="form-label">Kategori *</label>
          <select name="category" class="form-select" required>
            <option value="">-- Pilih --</option>
            @foreach($categories as $cat)
              <option value="{{ $cat }}">{{ $cat }}</option>
            @endforeach
          </select>
        </div>

        <div class="col-md-4">
          <label class="form-label">Status *</label>
          <select name="status" class="form-select" required>
            <option value="draft">Draft</option>
            <option value="published" selected>Published</option>
          </select>
        </div>

        <div class="col-12">
          <label class="form-label">Ringkasan *</label>
          <textarea name="excerpt" class="form-control" rows="3" required placeholder="Ringkasan singkat artikel..."></textarea>
        </div>

        <div class="col-12">
          <label class="form-label">Isi Artikel *</label>
          <textarea name="content" class="form-control" rows="8" required placeholder="Tulis isi artikel di sini..."></textarea>
        </div>

        <div class="col-12">
          <label class="form-label">Foto Artikel</label>
          <input type="file" name="image" class="form-control" accept="image/*" data-preview="img-preview">
          <img id="img-preview" style="display:none;margin-top:0.5rem;" class="img-upload-preview">
        </div>
      </div>

      <div class="d-flex gap-3 mt-4">
        <button type="submit" class="btn-rg">💾 Simpan Artikel</button>
        <a href="{{ route('admin.artikel.index') }}" class="btn-rg-outline">Batal</a>
      </div>
    </form>
  </div>
</div>
@endsection