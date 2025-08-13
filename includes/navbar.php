<div id="navv">
    <div id="isinavbar">
        <!-- Bagian Kiri -->
        <div class="nav-left">
            <h3 class="nav-title">Dashboard</h3>
        </div>

        <!-- Bagian Kanan -->
        <div class="nav-right">
            <div class="button-signin">
                <!-- <button>Sign in</button> -->
                <a href="index.php?page=signin" onclick="return loadingLink(this, event)">Surat Masuk</a>
            </div>
            <div class="nav-right dropdown">
                <button class="button-dropdown dropdown-toggle" onclick="toggleDropdown('dropdownContent')">
                    Tulis Surat
                </button>
                <div class="dropdown-content" id="dropdownContent">
                    <a href="index.php?page=form-mail-in" onclick="return loadingLink(this, event)">Surat Masuk</a>
                    <a href="index.php?page=form-mail-out" onclick="return loadingLink(this, event)">Surat Keluar</a>
                </div>
            </div>

            <!-- Dropdown Barang -->
            <div class="nav-right dropdown">
                <button class="button-dropdown dropdown-toggle" onclick="toggleDropdown('dropdownContentLogistic')">
                    Tulis Barang
                </button>
                <div class="dropdown-content" id="dropdownContentLogistic">
                    <a href="index.php?page=stock-in" onclick="return loadingLink(this, event)">Barang Masuk</a>
                    <a href="index.php?page=stock-out" onclick="return loadingLink(this, event)">Barang Keluar</a>
                </div>
            </div>
            <!-- <a href="index.php?page=formInMail" class="menu-item">Tulis Surat Masuk</a>
            <a href="index.php?page=formOutMail" class="menu-item">Tulis Surat Keluar</a> -->
            <!-- <button id="signinbutton">Sign in</button> -->
        </div>
    </div>
</div>