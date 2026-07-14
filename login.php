<?php
// ============================================
// FILE: login.php
// FUNGSI: Halaman login pengguna
// ============================================

require 'fungsi.php';

// Mulai session jika belum
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Redirect jika sudah login
if (isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

// Proses login
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string(koneksi(), $_POST['username']);
    $password = $_POST['password'];
    
    if (empty($username) || empty($password)) {
        $error = "Username dan password harus diisi!";
    } else {
        $conn = koneksi();
        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $query);
        
        if (mysqli_num_rows($result) === 1) {
            $user = mysqli_fetch_assoc($result);
            
            if (password_verify($password, $user['password'])) {
                // Set session
                $_SESSION['login'] = true;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                
                header("Location: index.php");
                exit;
            } else {
                $error = "Password salah!";
            }
        } else {
            $error = "Username tidak ditemukan!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Informatika</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container" style="max-width: 500px;">
        <div class="header">
            <h1><i class="fas fa-sign-in-alt"></i> LOGIN</h1>
            <p>Masuk ke sistem</p>
        </div>

        <!-- NAVIGASI -->
        <div class="navbar">
            <a href="index.php"><i class="fas fa-home"></i> Home</a>
            <a href="profile.php"><i class="fas fa-user-graduate"></i> Profile</a>
            <a href="contact.php"><i class="fas fa-envelope"></i> Contact</a>
            <a href="mahasiswa.php"><i class="fas fa-table"></i> Data Mahasiswa</a>
        </div>

        <div class="content">
            <div class="form-card">
                <?php if (isset($error)): ?>
                    <div class="alert alert-error">
                        <i class="fas fa-exclamation-circle"></i> <?= $error ?>
                    </div>
                <?php endif; ?>

                <form action="" method="post">
                    <div class="form-group">
                        <label><i class="fas fa-user"></i> Username <span class="required">*</span></label>
                        <input type="text" name="username" required placeholder="Masukkan username" value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>">
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-lock"></i> Password <span class="required">*</span></label>
                        <input type="password" name="password" required placeholder="Masukkan password">
                    </div>

                    <div class="form-actions" style="flex-direction: column; gap: 15px;">
                        <button type="submit" name="login" class="btn btn-primary" style="width: 100%;">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </button>
                        <p style="text-align: center; margin: 0;">
                            Belum punya akun? <a href="register.php" style="color: #667eea; font-weight: 600;">Daftar disini</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>