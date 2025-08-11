<?php
require 'db_connect.php'; // Pastikan file ini berisi $conn = koneksi

$tanggal = $_POST['tanggal'] ?? '';
$jumlah_surat = intval($_POST['jumlah_surat'] ?? 0);
$pengirim = $_POST['pengirim'] ?? '';
$tujuan_surat = $_POST['tujuan_surat'] ?? '';
$perihal = $_POST['perihal'] ?? '';

// Validasi input
if (!$tanggal || !$jumlah_surat || !$pengirim || !$tujuan_surat || !$perihal) {
    header("Location: index.php?page=form-mail-out&status=incomplete");
    exit;
}

// Siapkan query
$sql = "INSERT INTO surat_keluar (tanggal, pengirim, tujuan_surat, perihal) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    header("Location: index.php?page=form-mail-out&status=stmt_error");
    exit;
}

// Bind parameter
$stmt->bind_param("ssss", $tanggal, $pengirim, $tujuan_surat, $perihal);

// Jalankan insert sebanyak jumlah_surat
for ($i = 0; $i < $jumlah_surat; $i++) {
    if (!$stmt->execute()) {
        $stmt->close();
        $conn->close();
        header("Location: index.php?page=form-mail-out&status=error_execute");
        exit;
    }
}

$stmt->close();
$conn->close();

// Redirect sukses dengan jumlah
header("Location: index.php?page=form-mail-out&status=success&jumlah=$jumlah_surat");
exit;
