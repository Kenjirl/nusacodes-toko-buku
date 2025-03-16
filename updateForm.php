<?php
session_start();
include 'checkAuth.php';
require 'config.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['error'] = [
        "title" => "Buku",
        "content" => "Buku tidak ditemukan!",
    ];
    header("Location: index.php");
    exit();
}

$id = intval($_GET['id']);

$query = "SELECT * FROM tb_buku WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$book = $result->fetch_assoc();

if (!$book) {
    $_SESSION['error'] = [
        "title" => "Buku",
        "content" => "Buku tidak ditemukan!",
    ];
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#DCD7C9" />
    <meta name="description" content="Toko Buku - Edit Buku">
    
    <link rel="icon" type="image/x-icon" href="./img/icon.ico">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">

    <script src="https://kit.fontawesome.com/5b8fa639bb.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <style type="text/tailwindcss">
        @theme {
            --color-purple: #845ec2;
            --color-lavender: #d65db1;
            --color-pink: #ff6f91;
            --color-yellow: #f9f871;

            --font-montserrat: "Montserrat", "sans-serif";
        }

        a, button {
            outline: none;
            cursor: pointer;
        }
    </style>

    <title>Edit Buku | Toko Buku</title>
</head>
<body>
    <div class="min-h-screen mx-auto bg-linear-to-br from-purple via-lavender via-pink to-yellow font-montserrat">
        <!-- UPDATE FORM -->
        <section class="fixed top-0 left-0 w-full h-screen flex items-center justify-center bg-linear-to-br from-purple via-lavender via-pink to-yellow transition-all duration-[400ms]">
            <div class="absolute top-0 left-0 w-full p-8 flex items-center justify-end">
                <a class="w-fit px-4 py-2 flex items-center justify-center gap-2 border border-white font-medium rounded-full text-white
                    hover:bg-white hover:text-[#ff6f91] focus:bg-white focus:text-[#ff6f91] transition-colors"
                    href="./index.php">
                    <i class="fa-solid fa-arrow-left"></i>
                    Back
                </a>
            </div>

            <form action="./update.php" method="post">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($book['id']); ?>">

                <div class="w-[400px] rounded-lg bg-white">
                    <div class="w-full py-4 bg-linear-to-br from-purple via-lavender via-pink to-yellow text-transparent bg-clip-text">
                        <h2 class="w-fit mx-auto text-[2.5rem] font-semibold">Edit Buku</h2>
                    </div>
                    <div class="w-full max-h-[60vh] p-4 border-y border-pink overflow-y-auto">
                        <div class="w-full mb-4">
                            <label class="block mb-2 font-semibold" for="judul">Judul</label>
                            <input class="w-full p-2 rounded-md border border-slate-300 outline-purple" 
                                type="text" name="judul" id="judul" value="<?php echo htmlspecialchars($book['judul']); ?>" placeholder="judul buku" minlength="3" maxlength="50" required>
                        </div>
                        <div class="w-full mb-4">
                            <label class="block mb-2 font-semibold" for="penulis">Penulis</label>
                            <input class="w-full p-2 rounded-md border border-slate-300 outline-purple" 
                                type="text" name="penulis" id="penulis" value="<?php echo htmlspecialchars($book['penulis']); ?>" placeholder="penulis" minlength="3" maxlength="50" required>
                        </div>
                        <div class="w-full mb-4">
                            <label class="block mb-2 font-semibold" for="sinopsis">Sinopsis</label>
                            <textarea class="w-full p-2 rounded-md border border-slate-300 outline-purple resize-y" 
                                name="sinopsis" id="sinopsis"><?php echo htmlspecialchars($book['sinopsis']); ?></textarea>
                        </div>
                        <div class="w-full mb-4">
                            <label class="block mb-2 font-semibold" for="tanggal_terbit">Tanggal Terbit</label>
                            <input class="w-full p-2 rounded-md border border-slate-300 outline-purple" 
                                type="date" name="tanggal_terbit" id="tanggal_terbit" value="<?php echo htmlspecialchars($book['tanggal_terbit']); ?>" placeholder="tanggal_terbit" required>
                        </div>
                        <div class="w-full mb-4">
                            <label class="block mb-2 font-semibold" for="harga">Harga</label>
                            <input class="w-full p-2 rounded-md border border-slate-300 outline-purple" 
                                type="number" name="harga" id="harga" value="<?php echo htmlspecialchars($book['harga']); ?>" placeholder="harga" min="0" required>
                        </div>
                    </div>
                    <div class="w-full p-2">
                        <button class="w-full p-2 border border-purple text-purple font-semibold rounded-lg hover:bg-purple hover:text-white focus:bg-purple focus:text-white active:bg-purple-700 transition-colors"
                            type="submit">
                            Update Buku
                        </button>
                    </div>
                </div>
            </form>
        </section>
    </div>
    </script>
</body>
</html>
