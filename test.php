<?php

require __DIR__ . "/src/Batch.php";

$row = [
    "mulai_tanggal" => "2026-01-01",
    "terakhir_dibalik" => null,
    "terakhir_dicek" => "2026-01-04",
];

$s = Batch::status($row, "2026-01-04");
assert($s["umur"] === 3);
assert($s["balik_in"] === 4);
assert($s["cek_in"] === 3);
assert($s["matang_in"] === 53);

$s = Batch::status($row, "2026-01-10");
assert($s["balik_in"] === -2);
assert($s["cek_in"] === -3);

echo "OK\n";
