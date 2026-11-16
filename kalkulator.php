<?php
$judul = 'Kalkulator';
$scripts = ['assets/kalkulator.js'];
require 'header.php';
?>
<h1 class="h3 mb-3">Kalkulator Kompos</h1>
<div class="row g-3">
    <div class="col-md-5">
        <div class="card"><div class="card-body">
            <div class="mb-3">
                <label for="hijau" class="form-label">Bahan hijau (liter)</label>
                <input type="number" id="hijau" class="form-control" min="0" step="any" placeholder="mis. 5">
                <div class="form-text">Sisa sayur, kulit buah, ampas kopi.</div>
            </div>
            <div class="mb-3">
                <label for="coklat" class="form-label">Bahan coklat (liter)</label>
                <input type="number" id="coklat" class="form-control" min="0" step="any" placeholder="mis. 10">
                <div class="form-text">Daun kering, kardus, serbuk gergaji.</div>
            </div>
            <div class="form-text">Ukur dengan ember atau wadah yang volumenya Anda tahu.</div>
        </div></div>
    </div>
    <div class="col-md-7">
        <div id="hasil" class="alert alert-secondary">Isi kedua kolom untuk melihat hasil.</div>
        <p class="small text-muted">
            Patokan umum: 2 sampai 3 bagian bahan coklat untuk 1 bagian bahan hijau (volume).
            Ini perkiraan praktis, bukan pengukuran rasio C/N di laboratorium.
        </p>
    </div>
</div>
<?php require 'footer.php'; ?>
