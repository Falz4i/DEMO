// fetch_games.js

// 🚨 GANTI INI DENGAN API KEY ANDA SENDIRI 🚨
// fetch_games.js

// 🚨 GANTI INI DENGAN API KEY ANDA SENDIRI 🚨
const RAWG_API_KEY = "3a21c71ec6c74a718207337fd9c245d7"; // Ganti nama variabel menjadi lebih jelas
const GAMES_ENDPOINT = `https://api.rawg.io/api/games?key=${RAWG_API_KEY}&dates=2019-01-01,2025-10-22&ordering=-popularity&page_size=10&platforms=4`;

// ... sisanya sama

// Fungsi untuk membuat elemen HTML (card game)
function createGameCard(game) {
    // Memastikan judul tidak terlalu panjang
    const title = game.name.length > 25 ? game.name.substring(0, 25) + '...' : game.name;
    const releaseYear = game.released ? new Date(game.released).getFullYear() : 'N/A';
    const genres = game.genres.map(g => g.name).slice(0, 2).join(', ');
    const rating = game.rating.toFixed(1);
    const background_image = game.background_image || 'https://via.placeholder.com/400x225?text=No+Image';

    return `
        <a href="https://rawg.io/games/${game.slug}" target="_blank" class="block">
            <div class="game-card bg-gray-700 rounded-lg transform hover:-translate-y-2 transition duration-300 overflow-hidden shadow-lg hover:shadow-2xl">
                <div class="relative h-48">
                    <img src="${background_image}" alt="${game.name}" class="game-poster w-full h-full object-cover">
                    <span class="absolute top-2 right-2 bg-blue-500 text-white text-xs font-bold px-2 py-1 rounded-full">⭐ ${rating}</span>
                </div>
                <div class="p-4 text-left">
                    <h3 class="font-bold text-lg mb-1 hover:text-purple-400 transition">${title}</h3>
                    <p class="text-sm text-gray-400">Rilis: ${releaseYear}</p>
                    <p class="text-xs text-purple-300 mt-1 truncate">${genres}</p>
                </div>
            </div>
        </a>
    `;
}

/**
 * Fungsionalitas Utama: Mengambil data game dari RAWG API
 * dan menampilkannya secara dinamis menggunakan async/await.
 * Method yang digunakan: GET.
 */
async function fetchAndDisplayGames() {
    const container = $('#games-container');
    container.html('<p class="text-gray-400 text-lg col-span-full">Memuat game terpopuler...</p>'); // Loading state

    try {
        // 1. Lakukan request GET menggunakan fetch API
        const response = await fetch(GAMES_ENDPOINT);

        // 2. Cek status response
        if (!response.ok) {
            // Jika status bukan 200-299, lempar error
            throw new Error(`HTTP error! Status: ${response.status}`);
        }

        // 3. Ubah response menjadi objek JavaScript (JSON)
        const data = await response.json();

        // Bersihkan loading state
        container.empty();
        
        // 4. Proses dan tampilkan data
        if (data.results && data.results.length > 0) {
            data.results.forEach(game => {
                const cardHTML = createGameCard(game);
                container.append(cardHTML); // Tampilkan secara dinamis
            });
        } else {
            container.html('<p class="text-red-400 text-lg col-span-full">Tidak ada data game ditemukan.</p>');
        }

    } catch (error) {
        // Tangani error (misalnya: gagal koneksi, API Key salah)
        console.error('Gagal mengambil data dari RAWG API:', error);
        container.html('<p class="text-red-400 text-lg col-span-full">❌ Gagal memuat data game. Cek API Key atau koneksi Anda.</p>');
    }
}

// Jalankan fungsi saat dokumen siap
$(document).ready(() => {
    fetchAndDisplayGames();
});