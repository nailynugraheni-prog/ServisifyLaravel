@extends('layouts.admin')
@section('title', 'Tambah Pengguna')
@section('page-title')
<!-- Judul Halaman dengan Ikon SVG Rose Gold -->
<svg xmlns="http://w3.org" width="20" height="20" fill="#b76e79" class="bi bi-people-fill me-2" viewBox="0 0 16 16" style="vertical-align: -3px;">
  <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
</svg> Kelola Pengguna
@endsection
@section('content')
<div style="max-width:560px;">
  <div style="background:white;border-radius:var(--radius-lg);box-shadow:var(--shadow-sm);border:1px solid var(--border);overflow:hidden;">
    <div style="padding:1.25rem 1.5rem;border-bottom:1px solid var(--border);background:var(--gradient-rg);">
      <h3 style="font-family:'Cormorant Garamond',serif;font-size:1.2rem;font-weight:600;margin:0;">Form Pengguna Baru</h3>
    </div>
    <form action="{{ route('admin.pengguna.store') }}" method="POST" class="form-servisify p-4">
      @csrf
      @if(session('error'))<div class="alert-servisify error mb-3">{{ session('error') }}</div>@endif
      <div class="row g-3">
        <div class="col-12">
          <label class="form-label">Nama Lengkap *</label>
          <input type="text" name="name" class="form-control" required placeholder="Nama lengkap pengguna">
        </div>
        <div class="col-12">
          <label class="form-label">Email *</label>
          <input type="email" name="email" class="form-control" required placeholder="email@contoh.com">
        </div>
        <div class="col-md-6">
          <label class="form-label">No. HP</label>
          <input type="text" name="phone" class="form-control" placeholder="08xx-xxxx-xxxx">
        </div>
        <div class="col-md-6">
          <label class="form-label">Role *</label>
          <select name="role" class="form-select" required>
            <option value="user">User</option>
            <option value="admin">Admin</option>
          </select>
        </div>
        <div class="col-12">
          <label class="form-label">Password *</label>
          <input type="password" name="password" class="form-control" required placeholder="Password...">
        </div>
      </div>
      <div class="d-flex gap-3 mt-4">
        <button type="submit" class="btn-rg">💾 Simpan Pengguna</button>
        <a href="{{ route('admin.pengguna.index') }}" class="btn-rg-outline">Batal</a>
      </div>
    </form>
  </div>
</div>
@endsection