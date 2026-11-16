<?php

class Batch
{
    const BALIK_HARI = 7;
    const CEK_HARI = 3;
    const MATANG_HARI = 56;

    const KOLOM_TANDA = ["terakhir_dibalik", "terakhir_dicek"];

    private PDO $db;

    public function __construct(array $cfg)
    {
        $this->db = new PDO(
            "mysql:host={$cfg["host"]};dbname={$cfg["db"]};charset=utf8mb4",
            $cfg["user"],
            $cfg["pass"],
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ],
        );
    }

    public function all(string $owner): array
    {
        $st = $this->db->prepare(
            "SELECT * FROM batches WHERE owner = ? ORDER BY mulai_tanggal DESC",
        );
        $st->execute([$owner]);
        return $st->fetchAll();
    }

    public function add(string $owner, string $nama, string $mulai): void
    {
        $this->db
            ->prepare(
                "INSERT INTO batches (owner, nama, mulai_tanggal) VALUES (?, ?, ?)",
            )
            ->execute([$owner, $nama, $mulai]);
    }

    public function mark(string $owner, int $id, string $kolom): void
    {
        if (!in_array($kolom, self::KOLOM_TANDA, true)) {
            return;
        }
        $this->db
            ->prepare(
                "UPDATE batches SET $kolom = CURDATE() WHERE id = ? AND owner = ?",
            )
            ->execute([$id, $owner]);
    }

    public function delete(string $owner, int $id): void
    {
        $this->db
            ->prepare("DELETE FROM batches WHERE id = ? AND owner = ?")
            ->execute([$id, $owner]);
    }

    public static function status(array $row, string $today): array
    {
        $t = new DateTimeImmutable($today);
        $mulai = $row["mulai_tanggal"];
        $sisa = fn(string $dasar, int $interval) => (int) $t
            ->diff(new DateTimeImmutable($dasar)->modify("+$interval days"))
            ->format("%r%a");

        return [
            "umur" => (int) new DateTimeImmutable($mulai)
                ->diff($t)
                ->format("%r%a"),
            "balik_in" => $sisa(
                $row["terakhir_dibalik"] ?? $mulai,
                self::BALIK_HARI,
            ),
            "cek_in" => $sisa($row["terakhir_dicek"] ?? $mulai, self::CEK_HARI),
            "matang_in" => $sisa($mulai, self::MATANG_HARI),
        ];
    }
}
