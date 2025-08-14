<?php
require 'db_connect.php';

$query = "SELECT * FROM pengajuan ORDER BY kode_pengajuan DESC";
$result = $conn->query($query);

$queryPending = "SELECT * FROM pengajuan WHERE status = 'Pending'";
$resultPendingPengajuan = $conn->query($queryPending);

$queryPending = "SELECT * FROM pengajuan WHERE status = 'Approved'";
$approvedPengajuan = $conn->query($queryPending);

$queryPending = "SELECT * FROM pengajuan WHERE status = 'Rejected'";
$rejectedPengajuan = $conn->query($queryPending);

$query = "SELECT * FROM surat_keluar ORDER BY pengirim DESC";
$resultSuratKeluar = $conn->query($query);

$query = "SELECT * FROM stok_barang ORDER BY nama_barang ASC";
$stocks = $conn->query($query);

$query = "SELECT * FROM barang_keluar ORDER BY nama_barang ASC";
$outstocks = $conn->query($query)
?>
<div class="dashboard-menu">
    <div id="dashmenu-item">
        <div class="dash-list-inmail">
            <div class="inmail">
                <div style="font-size: 32px;"><?php echo $approvedPengajuan->num_rows; ?></div>
                <div><i class="fa fa-envelope-open-o" style="font-size: 48px; padding-right: 32px; padding-top: 6px;"></i></div>
            </div>
            <div class="list-mailinvent">Pengajuan Approved</div>
            <a href="index.php?page=submission-out" class="button-list">Lihat Semua</a>
            <!-- <button class="button-list">Lihat Semua </button> -->
        </div>
        <div class="dash-list-outmail">
            <div class="outmail">
                <div style="font-size: 32px;"><?php echo $resultPendingPengajuan->num_rows; ?></div>
                <div><i class="fa fa-bell-o" style="font-size: 48px; padding-right: 32px; padding-top: 6px; color:orange"></i></div>
            </div>
            <div class="list-mailinvent">Jumlah Pengajuan Masuk</div>
            <a href="index.php?page=mail-out" class="button-list">Lihat Semua</a>
            <!-- <button class="button-list">Lihat Semua</button> -->
        </div>

        <div class="dash-list-outlogistic">
            <div class="stocks">
                <div style="font-size: 32px;"><?php echo $rejectedPengajuan->num_rows; ?></div>
                <div><i class="fa fa-minus-circle" style="font-size: 48px; padding-right: 32px; padding-top: 6px; color:red"></i></div>
            </div>
            <div class="list-mailinvent">Pengajuan Rejected</div>
            <a href="index.php?page=submission-out" class="button-list">Lihat Semua</a>
            <!-- <button class="button-list">Lihat Semua</button> -->
        </div>
        <div class="dash-list-inlogistic">
            <div class="stocks">
                <div style="font-size: 32px;"><?php echo $stocks->num_rows; ?></div>
                <div><i class="fa fa-archive" style="font-size: 48px; padding-right: 32px; padding-top: 6px;"></i></div>
            </div>
            <div class="list-mailinvent">Jumlah Stok Barang</div>
            <a href="index.php?page=stocks" class="button-list">Lihat Semua</a>
            <!-- <button class="button-list">Lihat Semua</button> -->
        </div>
    </div>

</div>