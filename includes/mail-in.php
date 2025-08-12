<?php
require 'db_connect.php'; // Koneksi database

// if ($_SERVER["REQUEST_METHOD"] === "POST") {
//     $id = intval($_POST['id']);
//     $pengirim = $_POST['pengirim'];
//     $tujuan = $_POST['tujuan_surat'];
//     $perihal = $_POST['perihal'];

//     $stmt = $conn->prepare("UPDATE surat_masuk SET pengirim = ?, tujuan_surat = ?, perihal = ? WHERE id = ?");
//     $stmt->bind_param("sssi", $pengirim, $tujuan, $perihal, $id);

//     if ($stmt->execute()) {
//         echo '
//         <div class="alert alert-success">Surat berhasil dikembalikan.</div>
//         ';
//         echo '
//             <script>
//                 setTimeout(function() {
//                     window.location.href = "index.php?page=mail-in";
//                 }, 3000);
//             </script>
//             ';
//     } else {
//         echo "error: " . $stmt->error;
//     }

//     $stmt->close();
//     $conn->close();
// } else {
//     // echo "Invalid request";
// }
include 'includes/header.php';

// Ambil data dari database
$query = "SELECT * FROM surat_masuk ORDER BY tanggal DESC";
$result = $conn->query($query);
?>

<div class="dashboard-mailin">
    <div class="mail-count">
        <div><?php echo $result->num_rows; ?></div>
        <div>Jumlah Semua Surat</div>
    </div>

    <div class="mail-in">
        <h4>Surat Masuk</h4>
        <div class="sub-menu" style="display: flex; flex-direction: row; justify-content: space-between;">
            <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Cari surat..." class="list-input">

            <!-- <a href="index.php?page=garbage" class="button-ryc">
                <i class="fa fa-trash-o" aria-hidden="true"></i> Lihat Tempat Sampah
            </a> -->
        </div>

        <div class="table-container">
            <table id="dataTable" style="width:100%; border-collapse:collapse;">
                <thead>
                    <tr>
                        <th>Nomor Surat</th>
                        <th>Tanggal</th>
                        <th>Pengirim</th>
                        <th>Tujuan Surat</th>
                        <th>Perihal</th>
                        <th>Gambar</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['id']) ?></td>
                                <td><?= htmlspecialchars($row['tanggal']) ?></td>
                                <!-- <td><?= htmlspecialchars($row['nomor_surat']) ?></td> -->
                                <td><?= htmlspecialchars($row['pengirim']) ?></td>
                                <td><?= htmlspecialchars($row['tujuan_surat']) ?></td>
                                <td><?= htmlspecialchars($row['perihal']) ?></td>
                                <td>
                                    <a href="uploads/<?= urlencode($row['gambar_surat']) ?>" target="_blank" class="button-lihat">
                                        Lihat <i class="fa fa-search-plus"></i>
                                    </a>
                                </td>
                                <td>
                                    <button class="button-trash" onclick="editRowInline(this, <?= intval($row['id']) ?>)">
                                        Edit <i class="fa fa-pencil-square-o"></i>
                                    </button>

                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" style="text-align:center;">Belum ada Surat Masuk</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
                <?php $conn->close(); ?>
            </table>
        </div>
    </div>
</div>