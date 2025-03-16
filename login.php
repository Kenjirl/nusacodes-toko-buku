<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM tb_user WHERE username = ? LIMIT 1");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if ($password === $row['password']) {
            $_SESSION['user'] = $row['username'];
            $_SESSION['success'] = [
                "title" => "Login",
                "content" => "Berhasil Login!",
            ];
            header("Location: index.php");
            exit();
        } else {
            $_SESSION['error'] = [
                "title" => "Login",
                "content" => "Password tidak sesuai!",
            ];
        }
    } else {
        $_SESSION['error'] = [
            "title" => "Login",
            "content" => "Username belum terdaftar!",
        ];
    }
    header("Location: index.php");
    exit();
}
?>
