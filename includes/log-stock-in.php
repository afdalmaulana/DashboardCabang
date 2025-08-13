<?php
require 'db_connect.php';

// PROSES HAPUS (ditangani sebelum output HTML)
$successMessage = '';
$errorMessage = '';

$query = "SELECT * FROM barang_masuk ORDER BY tanggal DESC";
$result = $conn->query($query)
?>

<div class="dashboard-mailin">
    <div class="mail-in">
        <div class="sub-menu">
            <h4>Log Barang Masuk</h4>
            <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Cari ... " class="list-input">
        </div>

        <div class="table-container">
            <table id="dataTable" style="width:100%; border-collapse:collapse;">
                <thead>
                    <tr>
                        <th>Nomor Nota</th>
                        <th>Tanggal Input</th>
                        <th>Tanggal Nota</th>
                        <th>Nama Barang</th>
                        <th>Harga Barang Satuan</th>
                        <th>Jumlah</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['nomor_nota']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['tanggal']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['tanggal_nota']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['nama_barang']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['harga_barang']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['jumlah']) . "</td>";
                            echo "<td></td>"; // kolom kosong terakhir
                            echo "</tr>";
                        }
                    } else {
                        echo '<tr><td colspan="5" style="text-align:center;">Belum ada data barang masuk</td></tr>';
                    }
                    ?>
                </tbody>
        </div>