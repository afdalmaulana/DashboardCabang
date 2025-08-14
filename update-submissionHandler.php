<?php
require 'db_connect.php';

$kode_pengajuan = $_POST['kode_pengajuan'] ?? '';
$status = $_POST['status'] ?? '';


if (!$kode_pengajuan) {
    http_response_code(400);
    echo "Kode pengajuan tidak valid.";
    exit;
}

if ($status === 'delete') {
    $stmt = $conn->prepare("DELETE FROM pengajuan WHERE kode_pengajuan = ?");
    $stmt->bind_param("s", $kode_pengajuan);
    if ($stmt->execute()) {
        echo "Pengajuan berhasil dihapus.";
    } else {
        http_response_code(500);
        echo "Gagal menghapus pengajuan.";
    }
    $stmt->close();
    $conn->close();
    exit;
}
// Validasi input
if (!$kode_pengajuan || !in_array($status, ['approved', 'rejected'])) {
    http_response_code(400);
    echo "Permintaan tidak valid.";
    exit;
}

// Update status
$stmt = $conn->prepare("UPDATE pengajuan SET status = ? WHERE kode_pengajuan = ?");
$stmt->bind_param("ss", $status, $kode_pengajuan);

if ($stmt->execute()) {
    echo "Status berhasil diperbarui.";
} else {
    http_response_code(500);
    echo "Gagal memperbarui status.";
}

$stmt->close();
$conn->close();
