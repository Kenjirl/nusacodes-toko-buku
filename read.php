<?php
session_start();
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

$stmt = $conn->prepare("SELECT * FROM tb_buku WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $buku = $result->fetch_assoc();
} else {
    $_SESSION['error'] = [
        "title" => "Buku",
        "content" => "Buku tidak ditemukan!",
    ];
    header("Location: index.php");
    exit();
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#DCD7C9" />
    <meta name="description" content="Toko Buku." />

    <link rel="icon" type="image/x-icon" href="./img/icon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

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

    <title>Detail | <?php echo htmlspecialchars($buku['judul']); ?></title>
</head>
<body>
    <div class="min-h-screen mx-auto bg-linear-to-br from-purple via-lavender via-pink to-yellow font-montserrat">
        <!-- READ FORM -->
        <section class="fixed top-0 left-0 w-full h-screen flex items-center justify-center bg-linear-to-br from-purple via-lavender via-pink to-yellow transition-all duration-[400ms]"
            id="readForm">
            <div class="absolute top-0 left-0 w-full p-8 flex items-center justify-end transition-shadow">
                <a class="w-fit px-4 py-2 flex items-center justify-center gap-2 border border-white font-medium rounded-full text-white
                    hover:bg-white hover:text-[#ff6f91] focus:bg-white focus:text-[#ff6f91] transition-colors"
                    href="./index.php">
                    <i class="fa-solid fa-arrow-left"></i>
                    Back
                </a>
            </div>

            <div class="w-[600px] rounded-lg bg-white">
                <div class="w-full py-4 bg-linear-to-br from-purple via-lavender via-pink to-yellow text-transparent bg-clip-text">
                    <h2 class="w-fit mx-auto text-[2.5rem] font-semibold">Toko Buku</h2>
                </div>
                <div class="w-full max-h-[60vh] p-4 border-y border-pink overflow-y-auto">
                    <div class="w-full flex items-start justify-center gap-4">
                        <div class="w-full">
                            <h3 class="text-[1.3rem]/5 font-semibold"><?php echo htmlspecialchars($buku['judul']); ?></h3>
                        </div>
                        <div>
                            <div class="size-[50px] flex items-center justify-center rounded-md bg-pink text-white text-[1.5rem]">
                                <i class="fa-solid fa-book"></i>
                            </div>
                        </div>
                    </div>

                    <div class="w-full my-2 py-2 flex items-center justify-center gap-2 border-y border-pink">
                        <span class="block w-fit px-2 py-1 rounded-full bg-pink font-light text-white text-sm">
                            <?php echo ucwords(htmlspecialchars($buku['penulis'])); ?>
                        </span>
                        <span class="block w-fit px-2 py-1 rounded-full bg-pink font-light text-white text-sm">
                            <?php echo htmlspecialchars($buku['tanggal_terbit']); ?>
                        </span>
                        <span class="block w-fit px-2 py-1 rounded-full bg-pink font-light text-white text-sm">
                            Rp <?php echo number_format($buku['harga'], 0, ',', '.'); ?>
                        </span>
                    </div>

                    <div class="w-full min-h-[20vh]">
                        <span class="font-semibold italic">Sinopsis</span>
                        <p class="italic text-slate-500"><?php echo nl2br(htmlspecialchars($buku['sinopsis'])); ?></p>
                    </div>
                </div>
                <div class="w-full p-2 flex items-center justify-center gap-2">
                    <?php if (isset($_SESSION['user'])): ?>
                        <a class="w-full py-2 flex items-center justify-center rounded-sm border border-green-500 text-green-500
                            hover:bg-green-500 hover:text-white focus:bg-green-500 focus:text-white active:bg-green-700 transition-colors"
                            href="./updateForm.php?id=<?php echo ucwords(htmlspecialchars($buku['id'])); ?>">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </a>
                        <form class="w-full" action="./delete.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo ucwords(htmlspecialchars($buku['id'])); ?>">
                            <button class="delete-btn w-full py-2 flex items-center justify-center rounded-sm border border-red-500 text-red-500
                                hover:bg-red-500 hover:text-white focus:bg-red-500 focus:text-white active:bg-red-700 transition-colors"
                                type="submit">
                                <i class="fa-regular fa-trash-can"></i>
                            </button>
                        </form>
                    <?php endif; ?>
                    <?php if (!isset($_SESSION['user'])): ?>
                        <button class="bookmark-btn w-full p-2 flex items-center justify-center gap-2 border border-purple text-purple font-semibold rounded-lg hover:bg-purple hover:text-white focus:bg-purple focus:text-white active:bg-purple-700 transition-colors ">
                            <i class="fa-regular fa-bookmark"></i>
                            Bookmark Buku
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {
            $('.delete-btn').on('click', function (e) {
                e.preventDefault();

                Swal.fire({
                    title: "Yakin menghapus buku?",
                    text: "Buku ini tidak akan dapat dikembalikan!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, hapus!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).closest('form').submit();
                    }
                });
            });
        });
    </script>
</body>
</html>
