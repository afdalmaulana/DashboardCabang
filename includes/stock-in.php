<?php if (isset($_GET['status'])): ?>
    <script src="../js/sweetalert.all.min.js"></script>
    <script>
        <?php if ($_GET['status'] === 'success'): ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Data Berhasil disimpan'
            });
        <?php elseif ($_GET['status'] === 'error'): ?>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Terjadi kesalahan dalam form, mohon di ulangi'
            })
        <?php elseif ($_GET['status'] === 'incomplete'): ?>
            Swal.fire({
                icon: 'warning',
                title: 'Data tidak lengkap',
                text: 'Harap lengkapi semua form.'
            });
        <?php endif; ?>
    </script>
<?php endif; ?>

<form action="stockIn_connect.php" method="POST" onsubmit="return showLoading()">
    <div class="dashboard-mailin">
        <div class="form-input">
            <div style="display: flex; flex-direction:row; justify-content:space-between;">
                <div style="font-size: 32px; margin-top: 12px; font-weight:700">Formulir Barang Masuk</div>
                <a href="index.php?page=log-stock-in" class="button-log">
                    <i class="fa fa-trash-o" aria-hidden="true"></i> Lihat Log
                </a>
            </div>
            <p>Masukkan sesuai dengan ketentuan yang berlaku</p>
            <div class="input-mail">
                <input type="date" name="tanggal" class="list-input" placeholder="Tanggal" style="border-radius: 10px;">
                <input type="text" name="nomor_register" class="list-input" placeholder="Nomor Register" style="border-radius: 10px;">
                <input type="text" name="nama_barang" class="list-input" placeholder="Nama Barang" style="border-radius: 10px;">
                <input type="text" name="jumlah" class="list-input" placeholder="Jumlah" style="border-radius: 10px;">
                <div class="">
                    <button type="submit" id="submitBtn" class="button-send">Kirim</button>
                </div>
            </div>
        </div>
</form>