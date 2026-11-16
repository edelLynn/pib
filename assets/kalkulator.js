$(function () {
  var MIN = 2,
    MAX = 3;

  function fmt(n) {
    return (Math.round(n * 10) / 10).toString().replace(".", ",");
  }

  function hitung() {
    var h = parseFloat($("#hijau").val());
    var c = parseFloat($("#coklat").val());
    var $out = $("#hasil");

    if (isNaN(h) || isNaN(c) || h < 0 || c < 0) {
      $out
        .attr("class", "alert alert-secondary")
        .text("Isi kedua kolom untuk melihat hasil.");
      return;
    }
    if (h === 0) {
      $out
        .attr("class", "alert alert-warning")
        .text(
          "Tanpa bahan hijau, tumpukan tidak akan terurai dengan baik. Tambahkan bahan hijau.",
        );
      return;
    }

    var rasio = c / h;
    var teks =
      "Perbandingan Anda: " + fmt(rasio) + " bagian coklat : 1 bagian hijau. ";

    if (rasio < MIN) {
      $out
        .attr("class", "alert alert-warning")
        .text(
          teks +
            "Terlalu banyak bahan hijau (risiko bau dan becek). Tambahkan " +
            fmt(MIN * h - c) +
            " sampai " +
            fmt(MAX * h - c) +
            " liter bahan coklat.",
        );
    } else if (rasio > MAX) {
      $out
        .attr("class", "alert alert-warning")
        .text(
          teks +
            "Terlalu banyak bahan coklat (proses lambat). Tambahkan " +
            fmt(c / MAX - h) +
            " sampai " +
            fmt(c / MIN - h) +
            " liter bahan hijau.",
        );
    } else {
      $out
        .attr("class", "alert alert-success")
        .text(teks + "Campuran sudah ideal. Aduk rata dan jaga kelembapan.");
    }
  }

  $("#hijau, #coklat").on("input", hitung);
});
