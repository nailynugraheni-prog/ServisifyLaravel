@extends('layouts.admin')
@section('title', 'Kelola Transaksi')

@section('page-title')
<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#b76e79" class="bi bi-credit-card-2-back-fill me-2" viewBox="0 0 16 16" style="vertical-align: -3px;">
  <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v5H0zm16 6H0v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zm-3 1a1 1 0 1 1-2 0 1 1 0 0 1 2 0m-4 1a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5"/>
</svg>
Kelola Transaksi
@endsection

@section('content')
<div class="mb-4">
  <p style="color:var(--text-light);font-size:0.9rem;">Total: <strong>{{ count($transactions) }}</strong> transaksi</p>
</div>

<div style="overflow-x:auto;">
  <table class="table-servisify">
    <thead>
      <tr>
        <th>ID Transaksi</th>
        <th>Pelanggan</th>
        <th>Layanan</th>
        <th>Total</th>
        <th>Metode</th>
        <th>Status</th>
        <th>Tanggal</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @forelse($transactions as $trx)
        <tr>
          <td><strong style="color:var(--gold-dark);">{{ $trx['id'] }}</strong></td>

          <td style="font-size:0.88rem;">{{ $trx['user_name'] }}</td>

          <td style="font-size:0.82rem;max-width:180px;">
            {{ Str::limit(implode(', ', array_column($trx['items'], 'product_name')), 40) }}
          </td>

          <td><strong style="color:var(--gold-deep);">{{ \App\Helpers\DataHelper::formatRupiah($trx['total']) }}</strong></td>

          <td><span style="font-size:0.8rem;color:var(--text-mid);">{{ ucfirst($trx['payment_method']) }}</span></td>

          <td>
            <form action="{{ route('admin.transaksi.update', $trx['id']) }}" method="POST" class="m-0">
              @csrf
              @method('PUT')
              <select name="status" class="status-select" onchange="this.form.submit()">
                @foreach(['pending', 'proses', 'selesai', 'batal'] as $s)
                  <option value="{{ $s }}" {{ $trx['status'] === $s ? 'selected' : '' }}>
                    {{ ucfirst($s) }}
                  </option>
                @endforeach
              </select>
            </form>
          </td>

          <td style="font-size:0.82rem;">{{ $trx['created_at'] }}</td>

          <td>
            <div class="d-flex gap-2">
              <a href="{{ route('admin.transaksi.show', $trx['id']) }}" class="btn-rg-outline" style="font-size:0.78rem;padding:0.35rem 0.75rem;">Detail</a>
              <form action="{{ route('admin.transaksi.destroy', $trx['id']) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-danger-soft" data-confirm="Hapus transaksi ini?">Hapus</button>
              </form>
            </div>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="8" style="text-align:center;padding:3rem;color:var(--text-light);">
            Belum ada transaksi.
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection