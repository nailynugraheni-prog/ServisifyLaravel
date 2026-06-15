@extends('layouts.admin')
@section('title', 'Kelola Pengguna')

@section('page-title')
<!-- Judul Halaman dengan Ikon SVG Rose Gold -->
<svg xmlns="http://w3.org" width="20" height="20" fill="#b76e79" class="bi bi-people-fill me-2" viewBox="0 0 16 16" style="vertical-align: -3px;">
  <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
</svg> Kelola Pengguna
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <p style="color:var(--text-light);font-size:0.9rem;">Total: <strong>{{ count($users) }}</strong> pengguna</p>
  <a href="{{ route('admin.pengguna.create') }}" class="btn-rg">+ Tambah Pengguna</a>
</div>
<div style="overflow-x:auto;">
  <table class="table-servisify">
    <thead>
      <tr><th>Nama</th><th>Email</th><th>No. HP</th><th>Role</th><th>Bergabung</th><th>Aksi</th></tr>
    </thead>
    <tbody>
      @forelse($users as $u)
        <tr>
          <td>
            <div class="d-flex align-items-center gap-2">
              <div style="width:34px;height:34px;border-radius:50%;background:var(--gradient-gold);display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:0.85rem;flex-shrink:0;">{{ strtoupper(substr($u['name'],0,1)) }}</div>
              <strong>{{ $u['name'] }}</strong>
            </div>
          </td>
          <td style="font-size:0.85rem;">{{ $u['email'] }}</td>
          <td style="font-size:0.85rem;">{{ $u['phone'] ?: '-' }}</td>
          <td><span class="badge-status badge-{{ $u['role'] }}">{{ ucfirst($u['role']) }}</span></td>
          <td style="font-size:0.82rem;">{{ $u['created_at'] }}</td>
          <td>
            <div class="d-flex gap-2">
              <a href="{{ route('admin.pengguna.edit', $u['id']) }}" class="btn-rg-outline" style="font-size:0.78rem;padding:0.35rem 0.75rem;">Edit</a>
              @if($u['id'] !== session('user')['id'])
                <form action="{{ route('admin.pengguna.destroy', $u['id']) }}" method="POST" class="d-inline">
                  @csrf @method('DELETE')
                  <button type="submit" class="btn-danger-soft" data-confirm="Hapus pengguna {{ $u['name'] }}?">Hapus</button>
                </form>
              @endif
            </div>
          </td>
        </tr>
      @empty
        <tr><td colspan="6" style="text-align:center;padding:3rem;color:var(--text-light);">Belum ada pengguna.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
