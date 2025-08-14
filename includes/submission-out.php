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
                        <!-- <th>Aksi</th> -->
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <?php
                            $status = strtolower($row['status']);
                            $class = match ($status) {
                                'pending' => 'status-pending',
                                'approved' => 'status-approved',
                                'rejected' => 'status-rejected',
                                default => '',
                            };
                            ?>
                            <tr>
                                <td><?= htmlspecialchars($row['kode_pengajuan']) ?></td>
                                <td><?= htmlspecialchars($row['tanggal_pengajuan']) ?></td>
                                <td><?= htmlspecialchars($row['perihal']) ?></td>
                                <td class="<?= $class ?>"><?= htmlspecialchars($row['status']) ?></td>
                                <?php if (!((isset($_SESSION['role']) && $_SESSION['role'] === 'admin') || (isset($_SESSION['kode_uker']) && $_SESSION['kode_uker'] === '0050'))): ?>
                                    <?php if ($row['status'] === 'Pending'): ?>
                                        <td>
                                            <button class="button-trash" data-kode="<?= htmlspecialchars($row['kode_pengajuan']) ?>">
                                                Hapus <i class="fa fa-trash-o"></i>
                                            </button>
                                        </td>
                                    <?php else: ?>
                                        <td>
                                            <div>Pengajuan di kirim ke Kanwil</div>
                                        </td>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <?php if ((isset($_SESSION['role']) && $_SESSION['role'] === 'admin') || (isset($_SESSION['kode_uker']) && $_SESSION['kode_uker'] === '0050')): ?>
                                    <?php if ($row['status'] === 'Pending'): ?>
                                        <td>
                                            <div class="actions">
                                                <button class="button-approve" data-kode="<?= $row['kode_pengajuan'] ?>" data-status="approved">
                                                    Approve
                                                </button>
                                                <button class="button-reject" data-kode="<?= $row['kode_pengajuan'] ?>" data-status="rejected">
                                                    Reject
                                                </button>
                                            </div>
                                        </td>
                                    <?php else: ?>
                                        <td></td>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" style="text-align:center;">Belum ada Pengajuan</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>