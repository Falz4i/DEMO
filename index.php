<?php
require_once "App/Config/Database.php";
require_once "App/Core/BaseModel.php";
require_once "App/Models/GameModel.php";
require_once "App/Models/PricingModel.php";

use App\Config\Database;
use App\Models\GameModel;
use App\Models\PricingModel;

$db = (new Database())->connect();
$gameModel = new GameModel($db);
$pricingModel = new PricingModel($db);

$games = $gameModel->getAll();
$packages = $pricingModel->getAll();
$genres = $gameModel->getGenres();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>NexusHub Backend Output</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body class="bg-gray-900 text-white font-sans">

    <div class="container mx-auto px-6 py-12">

        <!-- 🔵 TOMBOL KEMBALI KE DASHBOARD -->
        <a href="index.html"
        class="inline-flex items-center gap-2 mb-10 bg-gradient-to-r from-blue-600 to-purple-600 
               hover:from-blue-700 hover:to-purple-700 text-white font-bold py-3 px-6 
               rounded-full transition duration-300 shadow-lg hover:shadow-purple-500/40">
            ← <span>Kembali ke Dashboard</span>
        </a>

        <!-- JUDUL UTAMA -->
        <h1 class="text-4xl md:text-5xl font-bold text-center mb-12">
            <span class="text-purple-400">NexusHub</span>
            <span class="text-blue-400">Backend Output</span>
        </h1>

        <!-- FILTER GENRE -->
        <div class="mb-12 flex justify-center" data-aos="fade-up">
            <select id="filter-select"
                class="bg-gray-800 border border-gray-700 text-gray-200 px-4 py-2 rounded-lg 
                       focus:outline-none focus:border-purple-500 transition">
                
                <option value="all">Semua Genre</option>

                <?php foreach ($genres as $genre): ?>
                    <option value="<?= strtolower($genre) ?>">
                        <?= htmlspecialchars($genre) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- GAME LIST -->
        <section class="mb-20">
            <h2 class="text-3xl font-bold mb-6 text-purple-400 text-center" data-aos="fade-up">
                Game List
            </h2>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

                <?php $delay = 0; foreach ($games as $g): ?>
                <div 
                    class="game-card p-6 bg-gray-800 rounded-xl border border-gray-700 
                           hover:border-purple-500 transition shadow-lg hover:shadow-purple-400/20 
                           transform hover:-translate-y-2"
                    data-genre="<?= strtolower($g['genre']) ?>"
                    data-aos="zoom-in"
                    data-aos-delay="<?= $delay ?>"
                >
                    <h3 class="text-xl font-bold"><?= htmlspecialchars($g['name']) ?></h3>
                    <p class="text-gray-300 mt-1"><?= htmlspecialchars($g['genre']) ?></p>
                </div>
                <?php $delay += 100; endforeach; ?>

            </div>
        </section>

        <!-- PRICING LIST -->
        <section>
            <h2 class="text-3xl font-bold mb-6 text-blue-400 text-center" data-aos="fade-up">
                Paket Harga
            </h2>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

                <?php $delay = 0; foreach ($packages as $p): ?>
                <div 
                    class="p-6 bg-gray-800/60 backdrop-blur-xl rounded-xl border border-gray-700 
                           hover:border-blue-500 transition shadow-lg hover:shadow-blue-400/20 
                           transform hover:-translate-y-2"
                    data-aos="fade-up"
                    data-aos-delay="<?= $delay ?>"
                >
                    <h3 class="text-2xl font-bold text-white"><?= htmlspecialchars($p['package_name']) ?></h3>

                    <p class="text-3xl font-bold text-blue-400 mt-2">
                        Rp <?= number_format($p['price'], 0, ',', '.') ?>
                    </p>
                </div>
                <?php $delay += 150; endforeach; ?>

            </div>
        </section>

    </div>

    <!-- AOS SCRIPT -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({ duration: 1200 });</script>

    <!-- FILTER SCRIPT -->
    <script>
        document.getElementById('filter-select').addEventListener('change', function() {
            const selected = this.value.toLowerCase();
            const cards = document.querySelectorAll('.game-card');

            cards.forEach(card => {
                const genre = card.dataset.genre;

                if (selected === "all" || genre === selected) {
                    card.style.display = "block";
                } else {
                    card.style.display = "none";
                }
            });
        });
    </script>

</body>
</html>
