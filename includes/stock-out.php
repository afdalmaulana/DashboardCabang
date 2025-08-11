<?php
require 'db_connect.php';

$stokQuery = "SELECT nama_barang FROM stok_barang ORDER BY nama_barang ASC";
$stokResult = $conn->query($stokQuery);
?>


<form action="connect_barangKeluar.php" method="POST">
    <div class="dashboard-mailin">
        <div class="form-input">
            <div style="display: flex; flex-direction:row; justify-content:space-between;">
                <div style="font-size: 32px; margin-top: 12px; font-weight:700">Formulir Barang Keluar</div>
                <a href="index.php?page=logLogisticOut" class="button-ryc">
                    <i class="fa fa-trash-o" aria-hidden="true"></i> Lihat Log
                </a>
            </div>
            <p>Masukkan sesuai dengan ketentuan yang berlaku</p>
            <div class="input-mail">
                <input type="date" name="tanggal" class="list-input" placeholder="Tanggal" style="border-radius: 10px;" required>

                <select name="nama_barang" class="list-input" required style="border-radius: 10px;">
                    <option value="" disabled selected hidden>Pilih Nama Barang</option>
                    <?php
                    if ($stokResult->num_rows > 0) {
                        while ($row = $stokResult->fetch_assoc()) {
                            echo '<option value="' . htmlspecialchars($row['nama_barang']) . '">' . htmlspecialchars($row['nama_barang']) . '</option>';
                        }
                    } else {
                        echo '<option value="" disabled>Belum ada barang tersedia</option>';
                    }
                    ?>
                </select>

                <input type="number" name="jumlah" class="list-input" placeholder="Jumlah" style="border-radius: 10px;" required>
                <select name="divisi" class="list-input" required style="border-radius: 10px;">
                    <option value="" disabled selected hidden>Pilih Divisi</option>
                    <option value="OPS">Operasional</option>
                    <option value="HC">Human Capital</option>
                    <option value="LOG">Logistik</option>
                    <option value="ADK">Administrasi Keuangan</option>
                    <option value="RMFT">RMFT</option>
                </select>

                <div>
                    <button type="submit" id="submitBtn" class="button-send">Kirim</button>
                </div>
            </div>
        </div>
    </div>
</form>