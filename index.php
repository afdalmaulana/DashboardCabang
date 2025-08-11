<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>
<?php include 'includes/navbar.php'; ?>

<div id="main-content">
    <?php
    if (isset($_GET['page'])) {
        $page = $_GET['page'];

        // Tambahkan inMail di sini
        $allowed_pages = ['form-mail-in', 'form-mail-out', 'log-stock-in', 'log-stock-out', 'mail-in', 'mail-out', 'stocks', 'stock-in', 'stock-out'];

        if (in_array($page, $allowed_pages)) {
            include "includes/$page.php";
        } else {
            echo "<h3>Halaman tidak ditemukan.</h3>";
        }
    } else {
        include 'includes/dashboard.php'; // default page
    }
    ?>
</div>

<?php include 'includes/footer.php'; ?>