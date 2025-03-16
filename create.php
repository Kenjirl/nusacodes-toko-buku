<?php
session_start();
require 'checkAuth.php';
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul          = trim($_POST['judul']);
    $penulis        = trim($_POST['penulis']);
    $sinopsis       = trim($_POST['sinopsis']);
    $tanggal_terbit = trim($_POST['tanggal_terbit']);
    $harga          = trim($_POST['harga']);

    $requiredFields = [$judul, $penulis, $sinopsis, $tanggal_terbit, $harga];

    if (array_filter($requiredFields, 'strlen')) {
        $stmt = $conn->prepare("INSERT INTO tb_buku (judul, penulis, sinopsis, tanggal_terbit, harga) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssd", $judul, $penulis, $sinopsis, $tanggal_terbit, $harga);

        if ($stmt->execute()) {
            $_SESSION['success'] = [
                "title" => "Tambah Buku",
                "content" => "Berhasil menambahkan buku!",
            ];
        } else {
            $_SESSION['error'] = [
                "title" => "Tambah Buku",
                "content" => "Terjadi kesalahan pada sistem!",
            ];
        }

        $stmt->close();
    } else {
        $_SESSION['error'] = [
            "title" => "Tambah Buku",
            "content" => "Harap masukkan data dengan benar!",
        ];
    }

    header("Location: index.php");
    exit();
}
?>
