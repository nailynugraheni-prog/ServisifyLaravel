<?php

namespace App\Helpers;

class DataHelper
{
    // ==================== USERS ====================
    public static function getUsers(): array
    {
        return session('db_users', self::defaultUsers());
    }

    public static function defaultUsers(): array
    {
        return [
            ['id' => 1, 'name' => 'Admin Servisify', 'email' => 'admin@servisify.id', 'password' => 'admin123', 'role' => 'admin', 'phone' => '08111000001', 'avatar' => null, 'created_at' => '2024-01-01'],
            ['id' => 2, 'name' => 'Budi Santoso',    'email' => 'budi@gmail.com',    'password' => 'user123',  'role' => 'user',  'phone' => '08222000002', 'avatar' => null, 'created_at' => '2024-02-10'],
            ['id' => 3, 'name' => 'Siti Rahayu',     'email' => 'siti@gmail.com',    'password' => 'user123',  'role' => 'user',  'phone' => '08333000003', 'avatar' => null, 'created_at' => '2024-03-05'],
            ['id' => 4, 'name' => 'Rizky Pratama',   'email' => 'rizky@gmail.com',   'password' => 'user123',  'role' => 'user',  'phone' => '08444000004', 'avatar' => null, 'created_at' => '2024-04-12'],
        ];
    }

    public static function saveUsers(array $users): void
    {
        session(['db_users' => $users]);
    }

    // ==================== PRODUCTS ====================
    public static function getProducts(): array
    {
        return session('db_products', self::defaultProducts());
    }

    public static function defaultProducts(): array
    {
        return [
            ['id' => 1, 'category' => 'Kebersihan', 'name' => 'Deep Cleaning Rumah', 'slug' => 'deep-cleaning-rumah', 'description' => 'Layanan pembersihan menyeluruh seluruh ruangan rumah Anda. Tim profesional kami menggunakan peralatan modern dan bahan ramah lingkungan untuk hasil terbaik.', 'price' => 350000, 'duration' => '4-6 jam',  'image' => null, 'is_active' => true, 'created_at' => '2024-01-15'],
            ['id' => 2, 'category' => 'Kebersihan', 'name' => 'Cuci Sofa & Karpet', 'slug' => 'cuci-sofa-karpet', 'description' => 'Pembersihan sofa dan karpet dengan teknik steam cleaning yang efektif menghilangkan noda membandel, tungau, dan bau tidak sedap.', 'price' => 200000, 'duration' => '2-3 jam', 'image' => null, 'is_active' => true, 'created_at' => '2024-01-20'],
            ['id' => 3, 'category' => 'Kebersihan', 'name' => 'Pembersihan AC Split', 'slug' => 'pembersihan-ac-split', 'description' => 'Servis dan pembersihan AC split agar performa optimal, hemat listrik, dan udara lebih segar. Termasuk cek freon dan filter.', 'price' => 150000, 'duration' => '1-2 jam', 'image' => null, 'is_active' => true, 'created_at' => '2024-01-25'],
            ['id' => 4, 'category' => 'Perbaikan', 'name' => 'Servis Elektronik Rumah', 'slug' => 'servis-elektronik-rumah', 'description' => 'Perbaikan berbagai perangkat elektronik rumah tangga seperti kulkas, mesin cuci, TV, dan microwave oleh teknisi berpengalaman.', 'price' => 120000, 'duration' => '1-3 jam', 'image' => null, 'is_active' => true, 'created_at' => '2024-02-01'],
            ['id' => 5, 'category' => 'Perbaikan', 'name' => 'Instalasi Listrik', 'slug' => 'instalasi-listrik', 'description' => 'Layanan instalasi dan perbaikan listrik rumah oleh teknisi berlisensi. Aman, cepat, dan bergaransi. Meliputi pasang stop kontak, saklar, dan MCB.', 'price' => 180000, 'duration' => '2-4 jam', 'image' => null, 'is_active' => true, 'created_at' => '2024-02-10'],
            ['id' => 6, 'category' => 'Perbaikan', 'name' => 'Perbaikan Pipa & Sanitasi', 'slug' => 'perbaikan-pipa-sanitasi', 'description' => 'Atasi kebocoran pipa, mampet saluran air, dan masalah sanitasi lainnya dengan cepat. Tim kami siap 24 jam untuk keadaan darurat.', 'price' => 160000, 'duration' => '1-3 jam', 'image' => null, 'is_active' => true, 'created_at' => '2024-02-15'],
            ['id' => 7, 'category' => 'Kecantikan', 'name' => 'Perawatan Wajah Premium', 'slug' => 'perawatan-wajah-premium', 'description' => 'Facial treatment premium dengan teknologi terkini. Meliputi cleansing, exfoliating, masker, dan moisturizing untuk kulit glowing dan sehat.', 'price' => 280000, 'duration' => '90 menit', 'image' => null, 'is_active' => true, 'created_at' => '2024-03-01'],
            ['id' => 8, 'category' => 'Kecantikan', 'name' => 'Spa Relaksasi Total', 'slug' => 'spa-relaksasi-total', 'description' => 'Paket spa lengkap meliputi full body massage, lulur tradisional, dan perawatan rambut. Nikmati relaksasi total di rumah Anda sendiri.', 'price' => 450000, 'duration' => '3 jam', 'image' => null, 'is_active' => true, 'created_at' => '2024-03-10'],
            ['id' => 9, 'category' => 'Kecantikan', 'name' => 'Nail Art & Manicure', 'slug' => 'nail-art-manicure', 'description' => 'Layanan nail art, manicure, dan pedicure profesional. Tersedia berbagai pilihan desain dan cat kuku berkualitas yang tahan lama.', 'price' => 120000, 'duration' => '60-90 menit', 'image' => null, 'is_active' => true, 'created_at' => '2024-03-15'],
        ];
    }

    public static function saveProducts(array $products): void
    {
        session(['db_products' => $products]);
    }

    // ==================== ARTICLES ====================
    public static function getArticles(): array
    {
        return session('db_articles', self::defaultArticles());
    }

    public static function saveArticles(array $articles): void
    {
        session(['db_articles' => $articles]);
    }

    public static function defaultArticleCategories(): array
    {
        return ['Tips Servis', 'Panduan Layanan', 'Promo & Info'];
    }

    public static function defaultArticles(): array
    {
        return [
            [
                'id' => 1,
                'title' => '5 Tips Memilih Layanan Rumah yang Aman dan Terpercaya',
                'slug' => '5-tips-memilih-layanan-rumah-yang-aman-dan-terpercaya',
                'category' => 'Panduan Layanan',
                'excerpt' => 'Kenali cara sederhana memilih layanan rumah yang profesional, transparan, dan sesuai kebutuhan.',
                'content' => "Memilih layanan rumah tidak boleh asal murah. Pastikan kamu cek reputasi penyedia jasa, deskripsi layanan, estimasi biaya, dan apakah mereka memberi jaminan hasil kerja.\n\nLayanan yang baik biasanya punya komunikasi yang jelas, teknisi berpengalaman, dan pengerjaan yang rapi. Dengan begitu, kamu bisa merasa lebih aman dan puas dengan hasilnya.",
                'image' => null,
                'author_name' => 'Admin Servisify',
                'status' => 'published',
                'created_at' => '2024-06-01',
            ],
            [
                'id' => 2,
                'title' => 'Kapan AC Rumah Perlu Dibersihkan?',
                'slug' => 'kapan-ac-rumah-perlu-dibersihkan',
                'category' => 'Tips Servis',
                'excerpt' => 'AC yang dibersihkan secara rutin bisa bekerja lebih hemat listrik dan menghasilkan udara yang lebih segar.',
                'content' => "Idealnya AC dibersihkan setiap 2–3 bulan sekali, tergantung pemakaian dan kondisi ruangan.\n\nKalau AC mulai kurang dingin, keluar bau tidak sedap, atau tagihan listrik naik, itu tanda AC kamu perlu diservis. Membersihkan filter dan evaporator secara rutin bisa memperpanjang umur AC.",
                'image' => null,
                'author_name' => 'Admin Servisify',
                'status' => 'published',
                'created_at' => '2024-06-08',
            ],
            [
                'id' => 3,
                'title' => 'Promo Servis Rumah Bulan Ini',
                'slug' => 'promo-servis-rumah-bulan-ini',
                'category' => 'Promo & Info',
                'excerpt' => 'Cek layanan unggulan yang sedang promo dan hemat lebih banyak untuk kebutuhan rumahmu.',
                'content' => "Bulan ini ada promo menarik untuk beberapa layanan favorit seperti deep cleaning, cuci sofa, dan pembersihan AC.\n\nPromo ini cocok buat kamu yang ingin rumah tetap nyaman tanpa keluar biaya terlalu besar. Pantau terus artikel Servisify untuk update promo terbaru.",
                'image' => null,
                'author_name' => 'Admin Servisify',
                'status' => 'published',
                'created_at' => '2024-06-15',
            ],
        ];
    }

    // ==================== TRANSACTIONS ====================
    public static function getTransactions(): array
    {
        return session('db_transactions', self::defaultTransactions());
    }

    public static function defaultTransactions(): array
    {
        return [
            ['id' => 'TRX-001', 'user_id' => 2, 'user_name' => 'Budi Santoso', 'items' => [['product_id' => 1, 'product_name' => 'Deep Cleaning Rumah', 'price' => 350000, 'qty' => 1], ['product_id' => 3, 'product_name' => 'Pembersihan AC Split', 'price' => 150000, 'qty' => 2]], 'total' => 650000, 'status' => 'selesai', 'payment_method' => 'transfer', 'address' => 'Jl. Mawar No.12, Surabaya', 'notes' => 'Pagi hari lebih disukai', 'created_at' => '2024-06-01'],
            ['id' => 'TRX-002', 'user_id' => 3, 'user_name' => 'Siti Rahayu', 'items' => [['product_id' => 7, 'product_name' => 'Perawatan Wajah Premium', 'price' => 280000, 'qty' => 1]], 'total' => 280000, 'status' => 'proses', 'payment_method' => 'cod', 'address' => 'Jl. Melati No.5, Gresik', 'notes' => '', 'created_at' => '2024-06-10'],
            ['id' => 'TRX-003', 'user_id' => 4, 'user_name' => 'Rizky Pratama', 'items' => [['product_id' => 5, 'product_name' => 'Instalasi Listrik', 'price' => 180000, 'qty' => 1]], 'total' => 180000, 'status' => 'pending', 'payment_method' => 'transfer', 'address' => 'Jl. Kenanga No.8, Gresik', 'notes' => 'Sore hari', 'created_at' => '2024-06-12'],
        ];
    }

    public static function saveTransactions(array $transactions): void
    {
        session(['db_transactions' => $transactions]);
    }

    // ==================== CART ====================
    public static function getCart(): array
    {
        return session('cart', []);
    }

    public static function saveCart(array $cart): void
    {
        session(['cart' => $cart]);
    }

    // ==================== UTILITIES ====================
    public static function generateId(array $items): int
    {
        if (empty($items)) return 1;
        return max(array_column($items, 'id')) + 1;
    }

    public static function generateTransactionId(): string
    {
        $transactions = self::getTransactions();
        return 'TRX-' . str_pad(count($transactions) + 1, 3, '0', STR_PAD_LEFT);
    }

    public static function getCategories(): array
    {
        return ['Kebersihan', 'Perbaikan', 'Kecantikan'];
    }

    public static function formatRupiah(int $amount): string
    {
        return 'Rp ' . number_format($amount, 0, ',', '.');
    }
}