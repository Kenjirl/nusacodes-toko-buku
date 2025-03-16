<?php
session_start();
// session_destroy();
unset($_SESSION['user']);
$_SESSION['success'] = [
    "title" => "Logout",
    "content" => "Berhasil Logout!",
];
header("Location: index.php");
exit();
?>
