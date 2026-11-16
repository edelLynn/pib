<?php
$judul = 'Panduan';
require 'header.php';
?>
<div class="p-4 mb-4 bg-white rounded shadow-sm">
    <h1 class="h3">Ubah sampah dapur jadi kompos</h1>
    <p class="mb-3">Sisa makanan, kulit buah, sayuran, dan daun kering bisa jadi pupuk untuk tanaman pekarangan maupun lahan pertanian.
        Mulai dari memilah di rumah.</p>
    <a href="kalkulator.php" class="btn btn-success me-2">Hitung campuran</a>
    <a href="tracker.php" class="btn btn-outline-success">Catat kompos saya</a>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="card h-100"><div class="card-body">
            <h2 class="h5 text-success">Bahan hijau (kaya nitrogen)</h2>
            <p class="small text-muted">Basah, cepat busuk.</p>
            <ul class="mb-0">
                <li>Sisa sayur dan kulit buah</li>
                <li>Ampas kopi dan teh</li>
                <li>Sisa nasi (sedikit saja)</li>
                <li>Rumput segar</li>
            </ul>
        </div></div>
    </div>
    <div class="col-md-6">
        <div class="card h-100"><div class="card-body">
            <h2 class="h5 text-warning">Bahan coklat (kaya karbon)</h2>
            <p class="small text-muted">Kering, menyerap air dan menjaga udara.</p>
            <ul class="mb-0">
                <li>Daun kering</li>
                <li>Serbuk gergaji, sekam</li>
                <li>Kardus atau kertas sobekan</li>
                <li>Jerami</li>
            </ul>
        </div></div>
    </div>
</div>

<div class="card mb-4"><div class="card-body">
    <h2 class="h5">Langkah membuat kompos</h2>
    <ol class="mb-0">
        <li class="mb-2"><strong>Pilah.</strong> Siapkan wadah khusus sampah organik, pisah dari plastik, kaca, dan kaleng.</li>
        <li class="mb-2"><strong>Cacah.</strong> Potong bahan kecil-kecil supaya cepat terurai.</li>
        <li class="mb-2"><strong>Campur.</strong> Susun lapisan bahan coklat dan hijau. Cek perbandingannya di <a href="kalkulator.php">Kalkulator</a>.</li>
        <li class="mb-2"><strong>Jaga lembap.</strong> Seperti spons yang diperas: lembap, tidak menetes. Siram bila kering.</li>
        <li class="mb-2"><strong>Balik.</strong> Aduk tumpukan tiap sekitar 7 hari agar ada udara dan tidak bau.</li>
        <li><strong>Panen.</strong> Kompos matang berwarna gelap, remah, dan berbau tanah. Biasanya 4 sampai 8 minggu.</li>
    </ol>
</div></div>

<div class="card mb-4"><div class="card-body">
    <h2 class="h5">Masalah umum</h2>
    <table class="table table-sm mb-0">
        <thead><tr><th>Gejala</th><th>Penyebab</th><th>Solusi</th></tr></thead>
        <tbody>
            <tr><td>Bau busuk</td><td>Terlalu basah / kurang udara</td><td>Tambah bahan coklat, balik tumpukan</td></tr>
            <tr><td>Tidak panas, lambat</td><td>Terlalu kering atau kurang hijau</td><td>Siram, tambah bahan hijau</td></tr>
            <tr><td>Banyak lalat</td><td>Sisa makanan terbuka</td><td>Tutup dengan lapisan daun kering</td></tr>
        </tbody>
    </table>
</div></div>

<div class="alert alert-success">
    <strong>Tahukah Anda?</strong> Pengomposan termasuk bentuk pengolahan sampah dalam Perda Kabupaten Jember No. 2 Tahun 2023
    tentang Pengelolaan Sampah, dan pemilahan dilakukan oleh setiap orang pada sumbernya.
</div>
<?php require 'footer.php'; ?>
