<?php
// ============================================
// FILE: index.php
// FUNGSI: Halaman utama / Homepage
// ============================================

require 'fungsi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Informatika</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-graduation-cap"></i> INFORMATIKA 2026</h1>
            <p>Program Studi Teknik Informatika</p>
        </div>

        <!-- NAVIGASI -->
        <div class="navbar">
            <a href="index.php"><i class="fas fa-home"></i> Home</a>
            <a href="profile.php"><i class="fas fa-user-graduate"></i> Profile</a>
            <a href="contact.php"><i class="fas fa-envelope"></i> Contact</a>
            <a href="mahasiswa.php"><i class="fas fa-table"></i> Data Mahasiswa</a>
            <!-- Di bagian header, tambahkan user info -->
<div class="header">
    <h1><i class="fas fa-graduation-cap"></i> INFORMATIKA 2026</h1>
    <p>Program Studi Teknik Informatika</p>
    

    <div style="margin-top: 15px;">
        <?php if (isset($_SESSION['login'])): ?>
            <span style="background: rgba(255,255,255,0.2); padding: 8px 20px; border-radius: 20px;">
                <i class="fas fa-user"></i> <?= htmlspecialchars($_SESSION['username']) ?>
                <a href="logout.php" style="color: white; margin-left: 15px; text-decoration: none; background: rgba(255,0,0,0.3); padding: 4px 12px; border-radius: 12px;">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </span>
        <?php else: ?>
            <a href="login.php" style="color: white; background: rgba(255,255,255,0.2); padding: 8px 20px; border-radius: 20px; text-decoration: none;">
                <i class="fas fa-sign-in-alt"></i> Login
            </a>
            <a href="register.php" style="color: white; background: rgba(255,255,255,0.2); padding: 8px 20px; border-radius: 20px; text-decoration: none; margin-left: 10px;">
                <i class="fas fa-user-plus"></i> Register
            </a>
        <?php endif; ?>
    </div>
</div>
        </div>

        <div class="content">
            <!-- SAMBUTAN KAPRODI -->
<div class="card">
    <h2><i class="fas fa-chalkboard-user"></i> Sambutan Kaprodi</h2>
    <div class="profile-section">
        <img src="aset/beruang.jpg" class="profile-img" alt="Kaprodi">
        <div class="sambutan">
            <p>Beruang adalah mamalia karnivora dari keluarga Ursidae. Meskipun termasuk dalam ordo karnivora (pemakan daging), sebagian besar spesies beruang adalah omnivora yang mengonsumsi berbagai jenis makanan seperti buah-buahan, madu, serangga, hingga ikan atau mamalia kecil.</p>
        </div>
    </div>
</div>

            <!-- DAFTAR PRESTASI -->
            <div class="card">
                <h2><i class="fas fa-trophy"></i> Daftar Prestasi</h2>
                <ul>
                    <li>Juara Kaprodi Sedunia
                        <ul>
                            <li>Kaprodi tercepat sedunia</li>
                            <li>Jurnal Terbanyak sedunia</li>
                            <li>Artikel terbagus sedunia</li>
                        </ul>
                    </li>
                    <li>Juara Artikel Sedunia</li>
                    <li>Best Artikel Sedunia</li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>