<?php
session_start();
include 'checkAuth.php';
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_POST['id']) || empty($_POST['id'])) {
        $_SESSION['error'] = [
            "title" => "Hapus Buku",
            "content" => "Buku tidak ditemukan!",
        ];
        header("Location: index.php");
        exit();
    }

    $id = intval($_POST['id']);

    $query = "DELETE FROM tb_buku WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $_SESSION['success'] = [
            "title" => "Hapus Buku",
            "content" => "Berhasil menghapus buku!",
        ];
    } else {
        $_SESSION['error'] = [
            "title" => "Hapus buku!",
            "content" => "Terjadi kesalahan pada sistem!",
        ];
    }
    header("Location: index.php");
    exit();
} else {
    $_SESSION['error'] = [
        "title" => "Hapus Buku",
        "content" => "Terjadi kesalahan!",
    ];
    header("Location: index.php");
    exit();
}
?>
