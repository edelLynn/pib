<?php
function e($s) { return htmlspecialchars((string) $s, ENT_QUOTES, 'UTF-8'); }
$halaman = basename($_SERVER['SCRIPT_NAME']);
$menu = ['index.php' => 'Panduan', 'kalkulator.php' => 'Kalkulator', 'tracker.php' => 'Tracker'];
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($judul ?? 'Kompos Jember') ?> | Kompos Jember</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/style.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand navbar-dark bg-success">
    <div class="container">
        <a class="navbar-brand" href="index.php">Kompos Jember</a>
        <ul class="navbar-nav ms-auto">
            <?php foreach ($menu as $file => $label): ?>
                <li class="nav-item">
                    <a class="nav-link <?= $halaman === $file ? 'active fw-bold' : '' ?>" href="<?= $file ?>"><?= $label ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</nav>
<main class="container py-4">
