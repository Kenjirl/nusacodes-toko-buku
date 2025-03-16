<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#DCD7C9" />
    <meta
        name="description"
        content="Toko Buku."
    />

    <link rel="icon" type="image/x-icon" href="./img/icon.ico">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <script src="https://kit.fontawesome.com/5b8fa639bb.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />
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

    <title>Toko Buku</title>
</head>
<body>
    <div class="min-h-screen mx-auto bg-linear-to-br from-purple via-lavender via-pink to-yellow font-montserrat">
        <header class="w-full max-w-[1600px] mx-auto border-b border-white">
            <nav class="w-full p-8 flex items-center justify-between transition-shadow">
                <div class="w-full"></div>

                <div class="w-full flex items-center justify-center">
                    <a class="w-fit flex items-center justify-center gap-4"
                        href="./index.php" id="logo">
                        <img class="size-10"
                            src="./img/icon.ico" alt="Logo">
                        <h2 class="text-[20px] md:text-[2.5rem]/7 text-white drop-shadow-lg font-bold uppercase">
                            Toko Buku
                        </h2>
                    </a>
                </div>

                <div class="w-full flex items-center justify-end">
                    <?php if (isset($_SESSION['user'])): ?>
                        <a class="w-fit px-4 py-2 flex items-center justify-center gap-2 border border-white font-medium rounded-full text-white
                            hover:bg-white hover:text-[#ff6f91] focus:bg-white focus:text-[#ff6f91] transition-colors"
                            href="./logout.php">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            Logout
                        </a>
                    <?php else: ?>
                        <button class="w-fit px-4 py-2 flex items-center justify-center gap-2 border border-white font-medium rounded-full text-white
                            hover:bg-white hover:text-[#ff6f91] focus:bg-white focus:text-[#ff6f91] transition-colors"
                            id="openLoginBtn">
                            <i class="fa-solid fa-arrow-right-to-bracket"></i>
                            Login
                        </button>
                    <?php endif; ?>
                </div>
            </nav>
        </header>

        <!-- TABLE -->
        <section class="w-full min-h-screen py-10 flex items-start justify-center">
            <div class="w-full max-w-[1200px] p-4 rounded-lg bg-white/50">
                <div class="w-full mb-4 flex items-center justify-end gap-2">
                    <?php if (!isset($_SESSION['user'])): ?>
                        <a class="w-12 px-4 aspect-square flex items-center justify-center rounded-sm bg-blue-500 text-white
                            hover:bg-blue-400 focus:bg-blue-400 active:bg-blue-600 transition-colors"
                            href="./index.php">
                            <i class="fa-solid fa-book-open"></i>
                        </a>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['user'])): ?>
                        <a class="w-12 px-4 aspect-square flex items-center justify-center rounded-sm bg-green-500 text-white
                            hover:bg-green-400 focus:bg-green-400 active:bg-green-600 transition-colors"
                            href="./createForm.php">
                            <i class="fa-solid fa-plus"></i>
                        </a>
                    <?php endif; ?>
                </div>

                <div class="w-full p-8 rounded-md bg-white">
                    <table class="w-full table" id="bookTable">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Penulis</th>
                                <th>Tanggal Terbit</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                include 'config.php';
                                $result = $conn->query("SELECT * FROM tb_buku");
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($row['judul']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['penulis']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['tanggal_terbit']) . "</td>";
                                        echo "<td class='text-end'>Rp " . number_format($row['harga'], 2, ',', '.') . "</td>";
                                        echo '<td><div class="flex items-center justify-end gap-2">';
                                        // Tombol "Lihat Detail" selalu tersedia
                                        echo '<a class="detail-btn w-10 px-4 aspect-square flex items-center justify-center rounded-sm border border-blue-500 text-blue-500
                                                    hover:bg-blue-500 hover:text-white focus:bg-blue-500 focus:text-white active:bg-blue-700 transition-colors"
                                                    href="./read.php?id=' . $row['id'] . '">
                                                    <i class="fa-solid fa-book-open"></i>
                                                </a>';
                                        // Cek apakah pengguna sudah login
                                        if (isset($_SESSION['user'])) {
                                            // Tombol "Edit"
                                            echo '<a class="w-10 px-4 aspect-square flex items-center justify-center rounded-sm border border-green-500 text-green-500
                                                        hover:bg-green-500 hover:text-white focus:bg-green-500 focus:text-white active:bg-green-700 transition-colors"
                                                        href="./updateForm.php?id=' . $row['id'] . '">
                                                        <i class="fa-regular fa-pen-to-square"></i>
                                                    </a>';
                                            // Tombol "Hapus"
                                            echo '
                                                <form action="./delete.php" method="POST">
                                                    <input type="hidden" name="id" value="'.$row['id'].'">
                                                    <button class="delete-btn w-10 px-4 aspect-square flex items-center justify-center rounded-sm border border-red-500 text-red-500
                                                        hover:bg-red-500 hover:text-white focus:bg-red-500 focus:text-white active:bg-red-700 transition-colors"
                                                        type="submit">
                                                        <i class="fa-regular fa-trash-can"></i>
                                                    </button>
                                                </form>';
                                        }
                                        echo '</div></td>';

                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr>
                                        <td></td>
                                        <td></td>
                                        <td>Belum ada data buku</td>
                                        <td></td>
                                        <td></td>
                                        </tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- LOGIN FORM -->
        <?php if (!isset($_SESSION['user'])): ?>
            <section class="fixed top-0 left-full w-full h-screen flex items-center justify-center bg-linear-to-br from-purple via-lavender via-pink to-yellow transition-all duration-[400ms]"
                id="loginForm">
                <div class="absolute top-0 left-0 w-full p-8 flex items-center justify-end transition-shadow">
                    <button class="w-fit px-4 py-2 flex items-center justify-center gap-2 border border-white font-medium rounded-full text-white
                        hover:bg-white hover:text-[#ff6f91] focus:bg-white focus:text-[#ff6f91] transition-colors"
                        id="closeLoginBtn">
                        <i class="fa-solid fa-arrow-left"></i>
                        Back
                    </button>
                </div>

                <form action="./login.php" method="post">
                    <div class="w-[400px] rounded-lg bg-white">
                        <div class="w-full py-4 bg-linear-to-br from-purple via-lavender via-pink to-yellow text-transparent bg-clip-text border-b border-pink">
                            <h2 class="w-fit mx-auto text-[2.5rem] font-semibold">Login</h2>
                        </div>
                        <div class="w-full p-4">
                            <div class="w-full mb-4">
                                <label class="block mb-2 font-semibold" for="username">Username</label>
                                <input class="w-full p-2 rounded-md border border-slate-300 outline-purple" 
                                    type="text" name="username" id="username" placeholder="username" required>
                            </div>
                            <div class="w-full mb-4">
                                <label class="block mb-2 font-semibold" for="password">Password</label>
                                <div class="w-full flex items-center justify-center">
                                    <input class="flex-1 p-2 rounded-l-md border border-slate-300 border-r-0 outline-purple" 
                                        type="password" name="password" id="password" placeholder="password" required>
                                    <button class="w-[41.6px] aspect-square flex items-center justify-center rounded-r-md border border-slate-500 bg-slate-500 text-white
                                        hover:bg-slate-400 focus:bg-slate-400 active:bg-slate-600 transition-colors"
                                        type="button" id="togglePasswordBtn">
                                        <div class="">
                                            <i class="fa-regular fa-eye"></i>
                                        </div>
                                        <div class="hidden">
                                            <i class="fa-regular fa-eye-slash"></i>
                                        </div>
                                    </button>
                                </div>
                            </div>
                            <button class="w-full p-2 border border-purple text-purple font-semibold rounded-lg hover:bg-purple hover:text-white focus:bg-purple focus:text-white active:bg-purple-700 transition-colors "
                                type="submit">
                                Login
                            </button>
                        </div>
                    </div>
                </form>
            </section>
        <?php endif; ?>

        <footer class="w-full mt-20 p-4 bg-dark-green text-fur-white text-center text-white">
            <p>
                <a class="underline" href="https://kenjirl.github.io" target="_blank">
                    Kencong
                </a>
            </p>
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {
            let table = new DataTable('#bookTable', {
                responsive: true
            });

            // LOGIN
            $("#openLoginBtn").click(function () {
                $("#loginForm").removeClass("left-full").addClass("left-0");
            });

            $("#closeLoginBtn").click(function () {
                $("#loginForm").removeClass("left-0").addClass("left-full");
            });

            $("#togglePasswordBtn").click(function () {
                let passwordInput = $("#password");
                let eyeIcon = $(this).find(".fa-eye");
                let eyeSlashIcon = $(this).find(".fa-eye-slash");

                if (passwordInput.attr("type") === "password") {
                    passwordInput.attr("type", "text");
                    eyeIcon.addClass("hidden");
                    eyeSlashIcon.removeClass("hidden");
                } else {
                    passwordInput.attr("type", "password");
                    eyeIcon.removeClass("hidden");
                    eyeSlashIcon.addClass("hidden");
                }
            });

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

            <?php if (isset($_SESSION['success'])): ?>
                Swal.fire({
                    icon: "success",
                    title: "<?php echo $_SESSION['success']['title']; ?>",
                    text: "<?php echo $_SESSION['success']['content']; ?>",
                    showConfirmButton: false,
                    timer: 1500
                });
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
                Swal.fire({
                    icon: "error",
                    title: "<?php echo $_SESSION['error']['title']; ?>",
                    text: "<?php echo $_SESSION['error']['content']; ?>",
                    showConfirmButton: false,
                    timer: 1500
                });
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>
        });
    </script>
</body>
</html>