<?php
if (!isset($_SESSION['user'])) {
    header("Location: index.php"); // Redirect ke index jika belum login
    exit();
}
?>
