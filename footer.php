</main>
<footer class="text-center text-muted small py-4">
    Proyek PIB Universitas Jember &middot; Pemanfaatan Sampah Organik Rumah Tangga
</footer>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<?php if (!empty($scripts)) foreach ($scripts as $s): ?>
<script src="<?= e($s) ?>"></script>
<?php endforeach; ?>
</body>
</html>
