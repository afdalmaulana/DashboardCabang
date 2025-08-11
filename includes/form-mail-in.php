<?php if (isset($_GET['status'])): ?>
    <script src="../js/sweetalert.all.min.js"></script>
    <script>
        <?php if ($_GET['status'] === 'success'): ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Data berhasil disimpan!'
            });
        <?php elseif ($_GET['status'] === 'error'): ?>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Terjadi kesalahan saat menyimpan data.'
            });
        <?php elseif ($_GET['status'] === 'invalidfile'): ?>
            Swal.fire({
                icon: 'warning',
                title: 'File tidak valid',
                text: 'Hanya file JPG, JPEG, PNG, GIF yang diperbolehkan.'
            });
        <?php elseif ($_GET['status'] === 'uploadfail'): ?>
            Swal.fire({
                icon: 'error',
                title: 'Gagal Upload',
                text: 'Gagal meng-upload gambar.'
            });
        <?php elseif ($_GET['status'] === 'incomplete'): ?>
            Swal.fire({
                icon: 'warning',
                title: 'Data tidak lengkap',
                text: 'Harap lengkapi semua form.'
            });
        <?php endif; ?>
    </script>
<?php endif; ?>

<form action="mailIn_connect.php" method="POST" enctype="multipart/form-data" onsubmit="return showLoading()">
    <div class="dashboard-mailin">
        <div class="form-input">
            <div style="font-size: 32px; margin-top: 12px; font-weight:700;">Formulir Surat Masuk</div>
            <p>Masukkan sesuai dengan ketentuan yang berlaku</p>
            <div class="input-mail">
                <input type="date" name="tanggal" class="list-input" placeholder="Tanggal Surat" style="border-radius: 10px;">
                <select name="pengirim" class="list-input" required>
                    <option value="" disabled selected hidden>Pilih Pengirim</option>
                    <option value="OPS">Operasional</option>
                    <option value="HC">Human Capital</option>
                    <option value="LOG">Logistik</option>
                    <option value="ADK">Administrasi Keuangan</option>
                    <option value="RMFT">RMFT</option>
                </select>
                <input type="text" name="tujuan_surat" class="list-input" placeholder="Tujuan Surat" required>
                <input type="file" name="gambar" class="list-input" accept="image/*" style="margin-top: 10px;">
                <textarea name="perihal" placeholder="Perihal Surat" class="list-input" required></textarea>
                <div>
                    <button type="submit" id="submitBtn" class="button-send">Kirim</button>
                </div>
            </div>
        </div>
    </div>
</form>