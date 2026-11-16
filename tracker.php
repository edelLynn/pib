<?php
require "src/Batch.php";

if (!preg_match('/^[a-f0-9]{32}$/', $_COOKIE["owner"] ?? "")) {
    $_COOKIE["owner"] = bin2hex(random_bytes(16));
    setcookie("owner", $_COOKIE["owner"], [
        "expires" => time() + 31536000,
        "path" => "/",
        "httponly" => true,
        "samesite" => "Lax",
    ]);
}
$owner = $_COOKIE["owner"];
$batch = new Batch(require "config.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $aksi = $_POST["aksi"] ?? "";
    $id = (int) ($_POST["id"] ?? 0);

    if ($aksi === "tambah") {
        $nama = trim($_POST["nama"] ?? "");
        $mulai = $_POST["mulai"] ?? "";
        $d = DateTime::createFromFormat("Y-m-d", $mulai);
        if (
            $nama !== "" &&
            mb_strlen($nama) <= 100 &&
            $d &&
            $d->format("Y-m-d") === $mulai
        ) {
            $batch->add($owner, $nama, $mulai);
        }
    } elseif ($aksi === "balik") {
        $batch->mark($owner, $id, "terakhir_dibalik");
    } elseif ($aksi === "cek") {
        $batch->mark($owner, $id, "terakhir_dicek");
    } elseif ($aksi === "hapus") {
        $batch->delete($owner, $id);
    }
    header("Location: tracker.php");
    exit();
}

$hari = date("Y-m-d");
$daftar = $batch->all($owner);

function label(int $n, string $kerja): array
{
    if ($n < 0) {
        return ["danger", "$kerja terlambat " . -$n . " hari"];
    }
    if ($n === 0) {
        return ["warning", "$kerja hari ini"];
    }
    return ["secondary", "$kerja $n hari lagi"];
}

$judul = "Tracker";
require "header.php";
?>
<h1 class="h3 mb-3">Tracker Kompos</h1>

<div class="card mb-4"><div class="card-body">
    <form method="post" class="row g-2 align-items-end">
        <input type="hidden" name="aksi" value="tambah">
        <div class="col-md-5">
            <label class="form-label" for="nama">Nama tumpukan</label>
            <input class="form-control" id="nama" name="nama" maxlength="100" required placeholder="mis. Komposter belakang rumah">
        </div>
        <div class="col-md-4">
            <label class="form-label" for="mulai">Tanggal mulai</label>
            <input class="form-control" type="date" id="mulai" name="mulai" value="<?= $hari ?>" required>
        </div>
        <div class="col-md-3 d-grid">
            <button class="btn btn-success">Tambah</button>
        </div>
    </form>
</div></div>

<?php if (!$daftar): ?>
    <p class="text-muted">Belum ada catatan. Tambahkan tumpukan kompos pertama Anda.</p>
<?php endif; ?>

<?php foreach ($daftar as $row):

    $s = Batch::status($row, $hari);
    [$kb, $tb] = label($s["balik_in"], "Balik");
    [$kc, $tc] = label($s["cek_in"], "Cek kelembapan");
    $matang = $s["matang_in"] <= 0;
    ?>
    <div class="card mb-3"><div class="card-body">
        <div class="d-flex justify-content-between">
            <h2 class="h5 mb-1"><?= e($row["nama"]) ?></h2>
            <form method="post" onsubmit="return confirm('Hapus catatan ini?')">
                <input type="hidden" name="aksi" value="hapus">
                <input type="hidden" name="id" value="<?= (int) $row["id"] ?>">
                <button class="btn btn-sm btn-outline-danger">Hapus</button>
            </form>
        </div>
        <p class="text-muted small">Mulai <?= e(
            $row["mulai_tanggal"],
        ) ?> &middot; umur <?= $s["umur"] ?> hari</p>

        <div class="mb-3">
            <span class="badge text-bg-<?= $kb ?>"><?= e($tb) ?></span>
            <span class="badge text-bg-<?= $kc ?>"><?= e($tc) ?></span>
            <span class="badge text-bg-<?= $matang ? "success" : "light" ?>">
                <?= $matang
                    ? "Perkiraan sudah matang, cek warna dan bau"
                    : "Perkiraan matang " . $s["matang_in"] . " hari lagi" ?>
            </span>
        </div>

        <div class="d-flex gap-2">
            <?php foreach (
                ["balik" => "Sudah dibalik", "cek" => "Sudah dicek/disiram"]
                as $aksi => $teks
            ): ?>
                <form method="post">
                    <input type="hidden" name="aksi" value="<?= $aksi ?>">
                    <input type="hidden" name="id" value="<?= (int) $row[
                        "id"
                    ] ?>">
                    <button class="btn btn-sm btn-outline-success"><?= $teks ?></button>
                </form>
            <?php endforeach; ?>
        </div>
    </div></div>
<?php
endforeach; ?>

<p class="small text-muted">
    Catatan disimpan per perangkat/browser. Jadwal: balik tiap <?= Batch::BALIK_HARI ?> hari,
    cek kelembapan tiap <?= Batch::CEK_HARI ?> hari, perkiraan matang <?= Batch::MATANG_HARI ?> hari.
    Buka halaman ini secara rutin untuk melihat pengingat.
</p>
<?php require "footer.php"; ?>
