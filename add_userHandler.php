<?php
session_start();
include 'db_connect.php';

$username = $_POST['username'] ?? '';
$kode_uker = $_POST['kode_uker'] ?? '';
$password = $_POST['password'] ?? '';
$role = $_POST['role'] ?? '';

if (empty($username) || empty($kode_uker) || empty($password) || empty($role)) {
    header("Location: index.php?page=add-user&status=incomplete");
    exit;
}

// Ambil nama_uker dari kode_uker
$stmt2 = $conn->prepare("SELECT nama_uker FROM unit_kerja WHERE kode_uker = ?");
$stmt2->bind_param("s", $kode_uker);
$stmt2->execute();
$result2 = $stmt2->get_result();
if ($result2->num_rows === 0) {
    // Kode uker tidak ditemukan
    header("Location: index.php?page=add-user&status=error");
    exit;
}
$row = $result2->fetch_assoc();
$nama_uker = $row['nama_uker'];
$stmt2->close();

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (username, nama_uker, password, role, kode_uker) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $username, $nama_uker, $hashed_password, $role, $kode_uker);

if ($stmt->execute()) {
    header("Location: index.php?page=add-user&status=success");
} else {
    header("Location: index.php?page=add-user&status=error");
}

$stmt->close();
$conn->close();
exit;
