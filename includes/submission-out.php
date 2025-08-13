<?php
require 'db_connect.php';

// PROSES HAPUS (ditangani sebelum output HTML)
$successMessage = '';
$errorMessage = '';

$query = "SELECT * FROM pengajuan ORDER BY kode_pengajuan DESC";
$result = $conn->query($query)
?>
<div class="dashboard-mailin">
    <div class="mail-in">
        <div class="sub-menu">
            <h4>Log Pengajuan</h4>
            <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Cari ... " class="list-input">
        </div>

        <div class="table-container">
            <table id="dataTable" style="width:100%;">
                <thead>
                    <tr>
                        <th>Kode Pengajuan</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Perihal</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            // Tentukan kelas CSS sesuai status
                            $status = strtolower($row['status']);
                            $class = '';
                            if ($status === 'pending') {
                                $class = 'status-pending';
                            } elseif ($status === 'approved') {
                                $class = 'status-approved';
                            } elseif ($status === 'rejected') {
                                $class = 'status-rejected';
                            }
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['kode_pengajuan']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['tanggal_pengajuan']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['perihal']) . "</td>";
                            echo "<td class='$class'>" . htmlspecialchars($row['status']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo '<tr><td colspan="4" style="text-align:center;">Belum ada Pengajuan</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>