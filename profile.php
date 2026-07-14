<?php
// ============================================
// FILE: profile.php
// FUNGSI: Halaman profil prodi
// ============================================

require 'fungsi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Informatika</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-building"></i> PROFILE</h1>
            <p>Program Studi Teknik Informatika</p>
        </div>

        <!-- NAVIGASI -->
        <div class="navbar">
            <a href="index.php"><i class="fas fa-home"></i> Home</a>
            <a href="profile.php"><i class="fas fa-user-graduate"></i> Profile</a>
            <a href="contact.php"><i class="fas fa-envelope"></i> Contact</a>
            <a href="mahasiswa.php"><i class="fas fa-table"></i> Data Mahasiswa</a>
        </div>

        <div class="content">
            <div class="card">
                <h2><i class="fas fa-info-circle"></i> Tentang Kami</h2>
                <p>Halaman profil program studi. Silakan lengkapi bagian ini sesuai kebutuhan tugas Anda.</p>
            </div>
        </div>
    </div>
</body>
</html>