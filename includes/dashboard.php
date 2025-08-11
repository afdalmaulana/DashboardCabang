<?php
require 'db_connect.php';

$query = "SELECT * FROM surat_masuk ORDER BY tanggal DESC";
$result = $conn->query($query);

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
                <div style="font-size: 32px;"><?php echo $result->num_rows; ?></div>
                <div><i class="fa fa-envelope-open-o" style="font-size: 48px; padding-right: 32px; padding-top: 6px;"></i></div>
            </div>
            <div class="list-mailinvent">Jumlah Surat Masuk</div>
            <a href="index.php?page=inMail" class="button-list">Lihat Semua</a>
            <!-- <button class="button-list">Lihat Semua </button> -->
        </div>
        <div class="dash-list-outmail">
            <div class="outmail">
                <div style="font-size: 32px;"><?php echo $resultSuratKeluar->num_rows; ?></div>
                <div><i class="fa fa-envelope-o" style="font-size: 48px; padding-right: 32px; padding-top: 6px;"></i></div>
            </div>
            <div class="list-mailinvent">Jumlah Surat Keluar</div>
            <a href="index.php?page=outMail" class="button-list">Lihat Semua</a>
            <!-- <button class="button-list">Lihat Semua</button> -->
        </div>
        <div class="dash-list-outlogistic">
            <div class="stocks">
                <div style="font-size: 32px;"><?php echo $outstocks->num_rows; ?></div>
                <div><i class="fa fa-archive" style="font-size: 48px; padding-right: 32px; padding-top: 6px;"></i></div>
            </div>
            <div class="list-mailinvent">Jumlah Barang Keluar</div>
            <a href="index.php?page=logLogisticOut" class="button-list">Lihat Semua</a>
            <!-- <button class="button-list">Lihat Semua</button> -->
        </div>
        <div class="dash-list-inlogistic">
            <div class="stocks">
                <div style="font-size: 32px;"><?php echo $stocks->num_rows; ?></div>
                <div><i class="fa fa-archive" style="font-size: 48px; padding-right: 32px; padding-top: 6px;"></i></div>
            </div>
            <div class="list-mailinvent">Jumlah Stok Barang</div>
            <a href="index.php?page=stock" class="button-list">Lihat Semua</a>
            <!-- <button class="button-list">Lihat Semua</button> -->
        </div>
    </div>

</div>