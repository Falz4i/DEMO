<?php
// Set header agar browser tahu bahwa ini adalah file JSON
header('Content-Type: application/json');

// Baca konten dari file games.json
$jsonData = file_get_contents('games.json');

// Tampilkan konten JSON
echo $jsonData;
?>