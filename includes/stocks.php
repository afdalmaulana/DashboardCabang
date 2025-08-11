<?php
require 'db_connect.php';

$query = "SELECT * FROM stok_barang ORDER BY nama_barang ASC";
$result = $conn->query($query);
?>

<div class="dashboard-mailin">
    <div class="mail-count">
        <div> <?php echo $result->num_rows ?> </div>
        <div class="">Jenis Barang</div>
    </div>

    <div class="mail-in">
        <h4>Daftar Stok Barang</h4>
        <div class="table-container">
            <table id="dataTable" style="width:100%; border-collapse:collapse;">
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['nama_barang']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['jumlah']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo '<tr><td colspan="2" style="text-align:center;">Belum ada data stok barang</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>