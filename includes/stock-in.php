<form action="connect_barangMasuk.php" method="POST">

    <div class="dashboard-mailin">
        <div class="form-input">
            <div style="display: flex; flex-direction:row; justify-content:space-between;">
                <div style="font-size: 32px; margin-top: 12px; font-weight:700">Formulir Barang Masuk</div>
                <a href="index.php?page=logLogisticIn" class="button-ryc">
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