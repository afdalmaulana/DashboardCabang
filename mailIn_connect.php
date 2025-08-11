<?php
require 'db_connect.php';

// Buat folder uploads jika belum ada
$upload_dir = 'uploads/';
if (!is_dir($upload_dir)) {
    if (!mkdir($upload_dir, 0755, true)) {
        die("Gagal membuat folder uploads.");
    }
}

// Ambil data form
$tanggal = $_POST['tanggal'] ?? '';
$pengirim = $_POST['pengirim'] ?? '';
$tujuan_surat = $_POST['tujuan_surat'] ?? '';
$perihal = $_POST['perihal'] ?? '';

// Validasi sederhana
if (!$tanggal || !$pengirim || !$tujuan_surat || !$perihal) {
    header("Location: index.php?page=form-mail-in&status=incomplete");
    exit;
}

// Proses upload gambar
$nama_gambar = null;
if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
    $file_tmp = $_FILES['gambar']['tmp_name'];
    $file_name = basename($_FILES['gambar']['name']);
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    $allowed = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($file_ext, $allowed)) {
        header("Location: index.php?page=form-mail-in&status=invalidfile");
        exit;
    }

    $nama_gambar = uniqid('img_') . '.' . $file_ext;
    if (!move_uploaded_file($file_tmp, $upload_dir . $nama_gambar)) {
        header("Location: index.php?page=form-mail-in&status=uploadfail");
        exit;
    }
}

// Simpan ke database
$sql = "INSERT INTO surat_masuk (tanggal, pengirim, tujuan_surat, gambar_surat, perihal) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $tanggal, $pengirim, $tujuan_surat, $nama_gambar, $perihal);

if ($stmt->execute()) {
    header("Location: index.php?page=form-mail-in&status=success");
} else {
    header("Location: index.php?page=form-mail-in&status=error");
}

$stmt->close();
$conn->close();
exit;
