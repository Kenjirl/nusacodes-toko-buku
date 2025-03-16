<?php
session_start();
require 'checkAuth.php';
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['id']);
    $judul = trim($_POST['judul']);
    $penulis = trim($_POST['penulis']);
    $sinopsis = trim($_POST['sinopsis']);
    $tanggal_terbit = $_POST['tanggal_terbit'];
    $harga = floatval($_POST['harga']);

    $query = "UPDATE tb_buku SET judul=?, penulis=?, sinopsis=?, tanggal_terbit=?, harga=? WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssdi", $judul, $penulis, $sinopsis, $tanggal_terbit, $harga, $id);

    if ($stmt->execute()) {
        $_SESSION['success'] = [
            "title" => "Ubah Buku",
            "content" => "Berhasil memperbarui informasi buku!",
        ];
    } else {
        $_SESSION['error'] = [
            "title" => "Ubah Buku",
            "content" => "Gagal memperbarui informasi buku!",
        ];
    }
    header("Location: index.php");
    exit();
}
?>
