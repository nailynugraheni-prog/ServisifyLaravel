<footer class="footer-servisify">
  <div class="container">
    <div class="row g-4">
      <div class="col-md-4">
        <div class="footer-brand mb-2">✦ Servisify</div>
        <p style="font-size:0.85rem;color:rgba(255,255,255,0.55);line-height:1.7;">
          Platform jasa profesional terpercaya untuk kebutuhan kebersihan, perbaikan, dan kecantikan rumah Anda.
        </p>
      </div>
      <div class="col-md-2">
        <p style="font-weight:600;font-size:0.85rem;color:rgba(255,255,255,0.8);margin-bottom:0.75rem;">Layanan</p>
        <a class="footer-link" href="{{ route('user.katalog.index', ['kategori' => 'Kebersihan']) }}">Kebersihan</a>
        <a class="footer-link" href="{{ route('user.katalog.index', ['kategori' => 'Perbaikan']) }}">Perbaikan</a>
        <a class="footer-link" href="{{ route('user.katalog.index', ['kategori' => 'Kecantikan']) }}">Kecantikan</a>
      </div>
      <div class="col-md-2">
        <p style="font-weight:600;font-size:0.85rem;color:rgba(255,255,255,0.8);margin-bottom:0.75rem;">Menu</p>
        <a class="footer-link" href="{{ route('user.history.index') }}">Histori</a>
      </div>
      <div class="col-md-4">
        <p style="font-weight:600;font-size:0.85rem;color:rgba(255,255,255,0.8);margin-bottom:0.75rem;">Kontak</p>
        <p style="font-size:0.85rem;color:rgba(255,255,255,0.55)">📧 hello@servisify.id</p>
        <p style="font-size:0.85rem;color:rgba(255,255,255,0.55)">📱 0811-SERVISIFY</p>
        <p style="font-size:0.85rem;color:rgba(255,255,255,0.55)">📍 Surabaya, Jawa Timur</p>
      </div>
    </div>
    <hr class="footer-divider">
    <p style="text-align:center;font-size:0.8rem;color:rgba(255,255,255,0.4);">© {{ date('Y') }} Servisify. Semua hak dilindungi.</p>
  </div>
</footer>