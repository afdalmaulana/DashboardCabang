<?php if (isset($_GET['status'])): ?>
    <script src="../js/sweetalert2.all.min.js"></script> <!-- Pastikan path dan nama file JS benar -->
    <script>
        <?php if ($_GET['status'] === 'success'): ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                // html: 'Data berhasil disimpan sebanyak <strong><?php echo htmlspecialchars($_GET["jumlah"] ?? '-'); ?></strong> surat.',
                timer: 3000,
            });
        <?php elseif ($_GET['status'] === 'incomplete'): ?>
            Swal.fire({
                icon: 'warning',
                title: 'Data tidak lengkap!',
                text: 'Mohon lengkapi semua data.',
            });
        <?php elseif ($_GET['status'] === 'stmt_error'): ?>
            Swal.fire({
                icon: 'error',
                title: 'Kesalahan Server!',
                text: 'Gagal menyiapkan query.',
            });
        <?php elseif ($_GET['status'] === 'error_execute'): ?>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Gagal menyimpan data ke database.',
            });
        <?php endif; ?>
    </script>
<?php endif; ?>

<form action="mailOut_connect.php" method="POST" onsubmit="return showLoading();">
    <div class="dashboard-mailin">
        <div class="form-input">
            <div style="font-size: 32px; margin-top: 12px; font-weight:700">Formulir Surat Keluar</div>
            <p>Masukkan sesuai dengan ketentuan yang berlaku</p>
            <div class="input-mail">
                <input type="date" name="tanggal" class="list-input" required>

                <select name="jumlah_surat" class="list-input" required>
                    <option value="" disabled selected hidden>Pilih Jumlah Surat</option>
                    <?php for ($i = 1; $i <= 10; $i++): ?>
                        <option value="<?= $i ?>"><?= $i ?></option>
                    <?php endfor; ?>
                </select>

                <select name="pengirim" class="list-input" required>
                    <option value="" disabled selected hidden>Pilih Pengirim</option>
                    <option value="OPS">Operasional</option>
                    <option value="HC">Human Capital</option>
                    <option value="LOG">Logistik</option>
                    <option value="ADK">Administrasi Keuangan</option>
                    <option value="RMFT">RMFT</option>
                </select>

                <input type="text" name="tujuan_surat" class="list-input" placeholder="Tujuan Surat" required>
                <textarea name="perihal" class="list-input" placeholder="Perihal Surat" required></textarea>

                <div>
                    <button type="submit" id="submitBtn" class="button-send">Kirim</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    function showLoading() {
        Swal.fire({
            title: 'Menyimpan...',
            text: 'Mohon tunggu.',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
        return true; // Lanjut submit
    }
</script>