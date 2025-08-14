<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require 'db_connect.php';

// Cek role
$isAdminOrCabang = (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') ||
    (isset($_SESSION['kode_uker']) && $_SESSION['kode_uker'] === '0050');

if ($isAdminOrCabang) {
    // Admin atau Kanwil melihat semua data
    $whereClause = "1"; // tidak ada filter
} else {
    // Selain itu, hanya melihat data berdasarkan kode_uker
    $kode_uker = $conn->real_escape_string($_SESSION['kode_uker']);
    $whereClause = "kode_uker = '$kode_uker'";
}

// Gunakan $whereClause untuk semua query pengajuan
$queryAll = "SELECT * FROM pengajuan WHERE $whereClause ORDER BY kode_pengajuan DESC";
$tampung = $conn->query($queryAll);

$queryPending = "SELECT * FROM pengajuan WHERE $whereClause AND status = 'Pending'";
$resultPendingPengajuan = $conn->query($queryPending);

$queryApproved = "SELECT * FROM pengajuan WHERE $whereClause AND status = 'Approved'";
$approvedPengajuan = $conn->query($queryApproved);

$queryForward = "SELECT * FROM pengajuan WHERE $whereClause AND status = 'Forward'";
$forwardPengajuan = $conn->query($queryForward);

$queryRejected = "SELECT * FROM pengajuan WHERE $whereClause AND status = 'Rejected'";
$rejectedPengajuan = $conn->query($queryRejected);

// Query lainnya (surat keluar, stok) tidak perlu difilter
// $query = "SELECT * FROM surat_keluar ORDER BY pengirim DESC";
// $resultSuratKeluar = $conn->query($query);
$query = "SELECT * FROM stok_barang WHERE $whereClause ORDER BY nama_barang ASC";
$stocks = $conn->query($query);

$query = "SELECT * FROM barang_masuk WHERE $whereClause ORDER BY nama_barang ASC";
$instocks = $conn->query($query);

$query = "SELECT * FROM barang_keluar WHERE $whereClause ORDER BY nama_barang ASC";
$outstocks = $conn->query($query);
?>

<div class="dashboard-menu">
    <div id="dashmenu-item">
        <div class="dash-list-inlogistic">
            <div class="stocks">
                <div style="font-size: 32px;"><?php echo $tampung->num_rows; ?></div>
                <div><i class="fa fa-archive" style="font-size: 48px; padding-right: 32px; padding-top: 6px;"></i></div>
            </div>
            <div class="list-mailinvent">Semua Pengajuan</div>
            <a href="index.php?page=submission-out" class="button-list">Lihat Semua</a>
            <!-- <button class="button-list">Lihat Semua</button> -->
        </div>
        <div class="dash-list-inmail">
            <div class="inmail">
                <div style="font-size: 32px;"><?php echo $approvedPengajuan->num_rows; ?></div>
                <div><i class="fa fa-envelope-open-o" style="font-size: 48px; padding-right: 32px; padding-top: 6px;"></i></div>
            </div>
            <div class="list-mailinvent">Pengajuan Approved</div>
            <a href="index.php?page=submission-out" class="button-list">Lihat Semua</a>
            <!-- <button class="button-list">Lihat Semua </button> -->
        </div>
        <?php if ($isAdminOrCabang): ?>
            <div class="dash-list-outmail">
                <div class="outmail">
                    <div style="font-size: 32px;"><?php echo $resultPendingPengajuan->num_rows; ?></div>
                    <div><i class="fa fa-bell-o" style="font-size: 48px; padding-right: 32px; padding-top: 6px; color:orange"></i></div>
                </div>
                <div class="list-mailinvent">Jumlah Pengajuan Masuk</div>
                <a href="index.php?page=submission-out" class="button-list">Lihat Semua</a>
                <!-- <button class="button-list">Lihat Semua</button> -->
            </div>
        <?php else: ?>
            <div class="dash-list-outmail">
                <div class="outmail">
                    <div style="font-size: 32px;"><?php echo $resultPendingPengajuan->num_rows; ?></div>
                    <div><i class="fa fa-bell-o" style="font-size: 48px; padding-right: 32px; padding-top: 6px; color:orange"></i></div>
                </div>
                <div class="list-mailinvent">Pengajuan Terkirim</div>
                <a href="index.php?page=mail-out" class="button-list">Lihat Semua</a>
                <!-- <button class="button-list">Lihat Semua</button> -->
            </div>
        <?php endif; ?>

        <div class="dash-list-outlogistic">
            <div class="stocks">
                <div style="font-size: 32px;"><?php echo $rejectedPengajuan->num_rows; ?></div>
                <div><i class="fa fa-minus-circle" style="font-size: 48px; padding-right: 32px; padding-top: 6px; color:red"></i></div>
            </div>
            <div class="list-mailinvent">Pengajuan Rejected</div>
            <a href="index.php?page=submission-out" class="button-list">Lihat Semua</a>
            <!-- <button class="button-list">Lihat Semua</button> -->
        </div>
        <div class="dash-list-inmail">
            <div class="inmail">
                <div style="font-size: 32px;"><?php echo $forwardPengajuan->num_rows; ?></div>
                <div><i class="fa fa-envelope-open-o" style="font-size: 48px; padding-right: 32px; padding-top: 6px;"></i></div>
            </div>
            <div class="list-mailinvent">Pengajuan Forward</div>
            <a href="index.php?page=submission-out" class="button-list">Lihat Semua</a>
            <!-- <button class="button-list">Lihat Semua </button> -->
        </div>
        <div class="dash-list-inmail">
            <div class="inmail">
                <div style="font-size: 32px;"><?php echo $stocks->num_rows; ?></div>
                <div><i class="fa fa-envelope-open-o" style="font-size: 48px; padding-right: 32px; padding-top: 6px;"></i></div>
            </div>
            <div class="list-mailinvent">Stock Barang</div>
            <a href="index.php?page=submission-out" class="button-list">Lihat Semua</a>
            <!-- <button class="button-list">Lihat Semua </button> -->
        </div>
        <div class="dash-list-inmail">
            <div class="inmail">
                <div style="font-size: 32px;"><?php echo $outstocks->num_rows; ?></div>
                <div><i class="fa fa-envelope-open-o" style="font-size: 48px; padding-right: 32px; padding-top: 6px;"></i></div>
            </div>
            <div class="list-mailinvent">Barang Keluar</div>
            <a href="index.php?page=submission-out" class="button-list">Lihat Semua</a>
            <!-- <button class="button-list">Lihat Semua </button> -->
        </div>
        <div class="dash-list-inmail">
            <div class="inmail">
                <div style="font-size: 32px;"><?php echo $instocks->num_rows; ?></div>
                <div><i class="fa fa-envelope-open-o" style="font-size: 48px; padding-right: 32px; padding-top: 6px;"></i></div>
            </div>
            <div class="list-mailinvent">Barang Masuk</div>
            <a href="index.php?page=submission-out" class="button-list">Lihat Semua</a>
            <!-- <button class="button-list">Lihat Semua </button> -->
        </div>
    </div>

</div>