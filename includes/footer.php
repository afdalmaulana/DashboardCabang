<script src="../js/sweetalert.all.min.js"></script>
<script src="../js/pengirim.js"></script>

<script>
    function deleteRow(button, id) {
        Swal.fire({
            title: 'Yakin ingin mengedit?',
            text: "Data akan di ubah.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Edit',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                showLoadingDel(button);
                window.location.href = "index.php?page=inMail&delete_id=" + id;
            }
        });
    }

    function editRow(button, id) {
        Swal.fire({
            title: 'Yakin ingin mengedit?',
            text: "Data akan di ubah.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Edit',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                showLoadingDel(button);
                window.location.href = "index.php?page=inMail&edit_id=" + id;
            }
        });
    }

    function toggleSidebar() {
        const body = document.body;

        const isVisible = body.classList.contains("sidebar-visible");

        if (isVisible) {
            body.classList.remove("sidebar-visible");
            body.classList.add("sidebar-hidden");
        } else {
            body.classList.remove("sidebar-hidden");
            body.classList.add("sidebar-visible");
        }
    }

    window.onload = function() {
        const body = document.body;
        body.classList.remove("sidebar-visible");
        body.classList.add("sidebar-hidden");
    };

    function searchTable() {
        const input = document.getElementById("searchInput").value.toLowerCase();
        const table = document.getElementById("dataTable");
        const trs = table.getElementsByTagName("tbody")[0].getElementsByTagName("tr");

        for (let i = 0; i < trs.length; i++) {
            const tds = trs[i].getElementsByTagName("td");
            let match = false;
            for (let j = 0; j < tds.length; j++) {
                if (tds[j].innerText.toLowerCase().includes(input)) {
                    match = true;
                    break;
                }
            }
            trs[i].style.display = match ? "" : "none";
        }
    }

    function toggleDropdown(id) {
        // Tutup semua dropdown dulu
        const dropdowns = document.getElementsByClassName("dropdown-content");
        for (let i = 0; i < dropdowns.length; i++) {
            dropdowns[i].style.display = "none";
        }

        // Toggle dropdown yang diminta
        const dropdown = document.getElementById(id);
        if (dropdown) {
            dropdown.style.display = "block";
        }
    }
    window.onclick = function(event) {
        // Cek apakah klik di luar dropdown
        if (!event.target.closest('.dropdown')) {
            const dropdowns = document.getElementsByClassName("dropdown-content");
            for (let i = 0; i < dropdowns.length; i++) {
                dropdowns[i].style.display = "none";
            }
        }
    };

    // function deleteRow(button, id) {
    //     if (confirm("Apakah Anda yakin ingin menghapus surat ini?")) {
    //         window.location.href = "index.php?page=inMail&delete_id=" + id;
    //     }
    // }

    function showLoading() {
        const btn = document.getElementById("submitBtn");
        btn.disabled = true;
        // btn.textContent = "Mengirim ...";
        btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i>';
        return true;
    }

    function loadingLink(link, event) {
        event.preventDefault(); // Cegah redirect langsung
        const originalText = link.innerHTML;

        link.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Memuat...';
        link.style.pointerEvents = 'none'; // Biar nggak bisa diklik lagi

        // Redirect setelah 500ms agar spinner terlihat
        setTimeout(() => {
            window.location.href = link.href;
        }, 500);

        return false;
    }

    function showLoadingDel(button) {
        button.disabled = true;
        button.innerHTML = '<i class="fa fa-spinner fa-spin"></i>';
        return true; // biar aksi (form submit / link) tetap lanjut
    }

    let currentlyEditingRow = null;

    function editRowInline(button, id) {
        const row = button.closest("tr");

        // Cek apakah sudah ada baris lain yang sedang diedit
        if (currentlyEditingRow && currentlyEditingRow !== row) {
            Swal.fire("Peringatan", "Selesaikan pengeditan sebelumnya dulu.", "warning");
            return;
        }

        currentlyEditingRow = row;

        const pengirimCell = row.children[2];
        const tujuanCell = row.children[3];
        const perihalCell = row.children[4];

        const pengirim = pengirimCell.textContent.trim();
        const tujuan = tujuanCell.textContent.trim();
        const perihal = perihalCell.textContent.trim();

        pengirimCell.innerHTML = `
        <select name="pengirim" required>
            <option value="OPS" ${pengirim === "OPS" ? "selected" : ""}>Operasional</option>
            <option value="HC" ${pengirim === "HC" ? "selected" : ""}>Human Capital</option>
            <option value="LOG" ${pengirim === "LOG" ? "selected" : ""}>Logistik</option>
            <option value="ADK" ${pengirim === "ADK" ? "selected" : ""}>Administrasi Keuangan</option>
            <option value="RMFT" ${pengirim === "RMFT" ? "selected" : ""}>RMFT</option>
        </select>
    `;

        tujuanCell.innerHTML = `<input type="text" name="tujuan_surat" value="${tujuan}" required>`;
        perihalCell.innerHTML = `<input type="text" name="perihal" value="${perihal}" required>`;

        button.innerHTML = 'Simpan <i class="fa fa-save"></i>';
        button.classList.remove("button-trash");
        button.classList.add("button-save");
        button.onclick = function() {
            saveRowInline(this, id);
        };
    }

    function saveRowInline(button, id) {
        const row = button.closest("tr");

        const pengirim = row.children[2].querySelector("select").value;
        const tujuan = row.children[3].querySelector("input").value;
        const perihal = row.children[4].querySelector("input").value;

        button.innerHTML = `<i class="fa fa-spinner fa-spin"></i> Menyimpan...`;
        button.disabled = true;

        fetch("update_surat.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                },
                body: `id=${id}&pengirim=${encodeURIComponent(pengirim)}&tujuan_surat=${encodeURIComponent(tujuan)}&perihal=${encodeURIComponent(perihal)}`
            })
            .then(response => response.text())
            .then(data => {
                row.children[2].textContent = pengirim;
                row.children[3].textContent = tujuan;
                row.children[4].textContent = perihal;

                button.innerHTML = 'Edit <i class="fa fa-pencil-square-o"></i>';
                button.classList.remove("button-save");
                button.classList.add("button-trash");
                button.disabled = false;

                button.onclick = function() {
                    editRowInline(this, id);
                };

                currentlyEditingRow = null;

                Swal.fire('Berhasil!', 'Data berhasil diperbarui.', 'success');
            })
            .catch(error => {
                console.error("Update gagal", error);
                Swal.fire('Gagal!', 'Terjadi kesalahan saat memperbarui data.', 'error');
                button.disabled = false;
            });
    }
</script>