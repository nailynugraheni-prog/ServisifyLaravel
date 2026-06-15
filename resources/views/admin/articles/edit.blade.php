@extends('layouts.admin')
@section('title', 'Edit Artikel')

@section('page-title')
<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#b76e79" class="bi bi-journal-text me-2" viewBox="0 0 16 16" style="vertical-align: -3px;">
  <path d="M5 10.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5"/>
  <path d="M3 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1H3zm0 1h9v13H3a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1"/>
</svg>
Kelola Artikel
@endsection

@section('content')
<div style="max-width:780px;">
  <div style="background:white;border-radius:var(--radius-lg);box-shadow:var(--shadow-sm);border:1px solid var(--border);overflow:hidden;">
    <div style="padding:1.25rem 1.5rem;border-bottom:1px solid var(--border);background:var(--gradient-rg);">
      <h3 style="font-family:'Cormorant Garamond',serif;font-size:1.2rem;font-weight:600;margin:0;">Edit: {{ $article['title'] }}</h3>
    </div>

    <form action="{{ route('admin.artikel.update', $article['id']) }}" method="POST" enctype="multipart/form-data" class="form-servisify p-4">
      @csrf
      @method('PUT')

      <div class="row g-3">
        <div class="col-12">
          <label class="form-label">Judul Artikel *</label>
          <input type="text" name="title" class="form-control" required value="{{ $article['title'] }}">
        </div>

        <div class="col-md-4">
          <label class="form-label">Kategori *</label>
          <select name="category" class="form-select" required>
            @foreach($categories as $cat)
              <option value="{{ $cat }}" {{ ($article['category'] ?? '') === $cat ? 'selected' : '' }}>
                {{ $cat }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="col-md-4">
          <label class="form-label">Status *</label>
          <select name="status" class="form-select" required>
            <option value="draft" {{ ($article['status'] ?? 'draft') === 'draft' ? 'selected' : '' }}>Draft</option>
            <option value="published" {{ ($article['status'] ?? 'draft') === 'published' ? 'selected' : '' }}>Published</option>
          </select>
        </div>

        <div class="col-12">
          <label class="form-label">Ringkasan *</label>
          <textarea name="excerpt" class="form-control" rows="3" required>{{ $article['excerpt'] }}</textarea>
        </div>

        <div class="col-12">
          <label class="form-label">Isi Artikel *</label>
          <textarea name="content" class="form-control" rows="8" required>{{ $article['content'] }}</textarea>
        </div>

        <div class="col-12">
          <label class="form-label">Ganti Foto</label>
          @if(!empty($article['image']))
            <img src="{{ asset($article['image']) }}" class="img-upload-preview mb-2" id="img-preview">
          @else
            <img id="img-preview" style="display:none;" class="img-upload-preview mb-2">
          @endif
          <input type="file" name="image" class="form-control" accept="image/*" data-preview="img-preview">
        </div>
      </div>

      <div class="d-flex gap-3 mt-4">
        <button type="submit" class="btn-rg">💾 Perbarui Artikel</button>
        <a href="{{ route('admin.artikel.index') }}" class="btn-rg-outline">Batal</a>
      </div>
    </form>
  </div>
</div>
@endsection