<?php
require 'db_connect.php';

// Ambil data form
$tanggal = $_POST['tanggal'] ?? '';
$nomor_register = $_POST['nomor_register'] ?? '';
$nama_barang = $_POST['nama_barang'] ?? '';
$jumlah = intval($_POST['jumlah'] ?? 0); // pastikan jumlah angka

// Validasi sederhana
if (!$tanggal || !$nomor_register || !$nama_barang || $jumlah <= 0) {
    die("Data tidak lengkap, mohon isi semua field!");
}

// Simpan ke tabel barang_masuk
$sql = "INSERT INTO barang_masuk (tanggal, nomor_register, nama_barang, jumlah) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssi", $tanggal, $nomor_register, $nama_barang, $jumlah);

if ($stmt->execute()) {

    // ==== ✅ Update stok_barang ====
    $cek = $conn->prepare("SELECT jumlah FROM stok_barang WHERE nama_barang = ?");
    $cek->bind_param("s", $nama_barang);
    $cek->execute();
    $cek->store_result();

    if ($cek->num_rows > 0) {
        // Barang sudah ada → update jumlah
        $update = $conn->prepare("UPDATE stok_barang SET jumlah = jumlah + ? WHERE nama_barang = ?");
        $update->bind_param("is", $jumlah, $nama_barang);
        $update->execute();
    } else {
        // Barang belum ada → insert baru
        $insert = $conn->prepare("INSERT INTO stok_barang (nama_barang, jumlah) VALUES (?, ?)");
        $insert->bind_param("si", $nama_barang, $jumlah);
        $insert->execute();
    }
    // ==== END update stok_barang ====

    // Tampilkan pesan sukses
    echo '
    <div class="alert alert-success" style="padding:15px;background-color:#4CAF50;color:white;border-radius:5px;">
        Data berhasil disimpan dan stok terupdate! Mengarahkan dalam 3 detik...
    </div>
    <script>
        setTimeout(function() {
            window.location.href = "index.php?page=logLogisticIn";
        }, 3000);
    </script>
    ';
} else {
    echo '
    <div class="alert alert-error" style="padding:15px;background-color:#f44336;color:white;border-radius:5px;">
        Error: ' . htmlspecialchars($stmt->error) . '
    </div>';
}

$stmt->close();
$conn->close();
