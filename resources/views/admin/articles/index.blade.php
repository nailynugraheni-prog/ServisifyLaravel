@extends('layouts.admin')
@section('title', 'Kelola Artikel')

@section('page-title')
<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#b76e79" class="bi bi-journal-text me-2" viewBox="0 0 16 16" style="vertical-align: -3px;">
  <path d="M5 10.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5"/>
  <path d="M3 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1H3zm0 1h9v13H3a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1"/>
</svg>
Kelola Artikel
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <p style="color:var(--text-light);font-size:0.9rem;">
    Total: <strong>{{ count($articles) }}</strong> artikel
  </p>
  <a href="{{ route('admin.artikel.create') }}" class="btn-rg">+ Tambah Artikel</a>
</div>

<div style="overflow-x:auto;">
  <table class="table-servisify">
    <thead>
      <tr>
        <th>Artikel</th>
        <th>Kategori</th>
        <th>Status</th>
        <th>Penulis</th>
        <th>Tanggal</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @forelse($articles as $article)
        <tr>
          <td>
            <div class="d-flex align-items-center gap-2">
              <div style="width:40px;height:40px;border-radius:var(--radius-sm);background:var(--gradient-rg);display:flex;align-items:center;justify-content:center;flex-shrink:0;overflow:hidden;">
                @if(!empty($article['image']))
                  <img src="{{ asset($article['image']) }}" alt="{{ $article['title'] }}" style="width:100%;height:100%;object-fit:cover;">
                @else
                  <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#b76e79" viewBox="0 0 16 16">
                    <path d="M14 4.5V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h6.5L14 4.5zM9 1.5V5h3.5L9 1.5z"/>
                  </svg>
                @endif
              </div>
              <div>
                <strong>{{ $article['title'] }}</strong><br>
                <small style="color:var(--text-light);">
                  {{ \Illuminate\Support\Str::limit($article['excerpt'], 60) }}
                </small>
              </div>
            </div>
          </td>

          <td>
            <span class="card-category-badge">{{ $article['category'] }}</span>
          </td>

          <td>
            <form action="{{ route('admin.artikel.status', $article['id']) }}" method="POST" class="m-0">
              @csrf
              @method('PATCH')
              <select name="status" class="status-select" onchange="this.form.submit()">
                <option value="draft" {{ ($article['status'] ?? 'draft') === 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="published" {{ ($article['status'] ?? 'draft') === 'published' ? 'selected' : '' }}>Published</option>
              </select>
            </form>
          </td>

          <td>{{ $article['author_name'] ?? 'Admin Servisify' }}</td>

          <td style="font-size:0.85rem;">
            {{ \Carbon\Carbon::parse($article['created_at'])->format('d M Y') }}
          </td>

          <td>
            <div class="d-flex gap-2">
              <a href="{{ route('admin.artikel.edit', $article['id']) }}" class="btn-rg-outline" style="font-size:0.78rem;padding:0.35rem 0.75rem;">Edit</a>
              <form action="{{ route('admin.artikel.destroy', $article['id']) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-danger-soft" data-confirm="Hapus artikel ini?">Hapus</button>
              </form>
            </div>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="6" style="text-align:center;padding:3rem;color:var(--text-light);">
            Belum ada artikel.
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection