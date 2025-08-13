<?php
require 'db_connect.php'; // Koneksi database

// PROSES HAPUS (ditangani sebelum output HTML)
$successMessage = '';
$errorMessage = '';

if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    $stmt = $conn->prepare("DELETE FROM surat_masuk WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $successMessage = "Data berhasil dihapus! Mohon di tunggu ...";
        echo '<script>
            setTimeout(function() {
                window.location.href = "index.php?page=inMail";
            }, 3000);
        </script>';
    } else {
        $errorMessage = "Gagal menghapus data: " . htmlspecialchars($stmt->error);
    }

    $stmt->close();
}

include 'includes/header.php'; // HTML dimulai setelah proses PHP selesai

// Ambil data dari database
$query = "SELECT * FROM surat_keluar ORDER BY pengirim DESC";
$result = $conn->query($query);
?>

<div class="dashboard-mailin">
    <div class="mail-count">
        <div><?php echo $result->num_rows; ?></div>
        <div>Jumlah Semua Surat</div>
    </div>
    <div class="mail-out">
        <h4>Surat Keluar</h4>
        <div class="sub-menu" style="display: flex; flex-direction:row; justify-content:space-between;">
            <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Cari surat..." class="list-input">
            <!-- <button class="button-ryc" onclick="window.location.href='index.php?page=garbage'">
                <i class="fa fa-trash-o" aria-hidden="true"></i> Lihat Tempat Sampah
            </button> -->

        </div>
        <div class="table-container">
            <table id="dataTable" style="width:100%; border-collapse:collapse;">
                <thead>
                    <tr>
                        <th>Nomor Surat</th>
                        <th>Tanggal</th>
                        <!-- <th>Nomor Surat</th> -->
                        <th>Pengirim</th>
                        <th>Tujuan Surat</th>
                        <th>Perihal</th>
                        <!-- <th></th> -->
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
                                <!-- <td>
                                    <button class='button-trash' onclick="deleteRow(this, <?= intval($row['id']) ?>)">
                                        <i class='fa fa-trash-o'></i>
                                    </button>
                                </td> -->
                                <td>
                                    <button class=" button-trash" onclick="editRowInline(this, <?= intval($row['id']) ?>)">
                                        Edit <i class="fa fa-pencil-square-o"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" style="text-align:center;">Belum ada data surat keluar</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <!-- Konten surat keluar bisa ditambahkan di sini -->
    </div>
</div>