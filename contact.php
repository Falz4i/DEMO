<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Diterima - NexusHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white flex items-center justify-center h-screen">
    <div class="bg-gray-800 p-8 rounded-lg shadow-lg text-center max-w-md">
        <h1 class="text-3xl font-bold text-purple-400 mb-4 font-orbitron">Terima Kasih!</h1>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nama = htmlspecialchars($_POST["nama"]);
            $email = htmlspecialchars($_POST["email"]);
            $pesan = htmlspecialchars($_POST["pesan"]);

            echo "<p class='text-gray-300 mb-4'>Pesan Anda telah kami terima.</p>";
            echo "<div class='text-left text-gray-400 mb-6'>";
            echo "<p><strong>Nama:</strong> $nama</p>";
            echo "<p><strong>Email:</strong> $email</p>";
            echo "<p><strong>Pesan:</strong> $pesan</p>";
            echo "</div>";
        } else {
            echo "<p class='text-red-400'>Tidak ada data yang dikirim.</p>";
        }
        ?>

        <a href="index.html"
           class="inline-block bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded-full transition duration-300">
           Kembali ke Beranda
        </a>
    </div>
</body>
</html>
