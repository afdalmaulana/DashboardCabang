<?php
require 'db_connect.php';

$tanggal = $_POST['tanggal'] ?? '';
$jumlah_surat = intval($_POST['jumlah_surat'] ?? 0);
$pengirim = $_POST['pengirim'] ?? '';
$tujuan_surat = $_POST['tujuan_surat'] ?? '';
$perihal = $_POST['perihal'] ?? '';

// Validasi sederhana
if (!$tanggal || !$jumlah_surat || !$pengirim || !$tujuan_surat || !$perihal) {
    header("Location: index.php?page=formOutMail&status=incomplete");
    exit;
}

// Simpan sebanyak jumlah_surat
$sql = "INSERT INTO surat_keluar (tanggal, pengirim, tujuan_surat, perihal) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    header("Location: index.php?page=formOutMail&status=stmt_error");
    exit;
}

for ($i = 0; $i < $jumlah_surat; $i++) {
    $stmt->bind_param("ssss", $tanggal, $pengirim, $tujuan_surat, $perihal);
    $stmt->execute();
}

$stmt->close();
$conn->close();

echo '
<div class="alert alert-success" style="
    padding: 15px; 
    background-color: #4CAF50; 
    color: white; 
    margin-bottom: 15px; 
    border-radius: 5px;
    font-weight: bold;
">
    Data berhasil disimpan sebanyak ' . $jumlah_surat . ' surat! Mohon tunggu ...
</div>
<script>
    setTimeout(function() {
        window.location.href = "index.php?page=outMail";
    }, 3000);
</script>
';
