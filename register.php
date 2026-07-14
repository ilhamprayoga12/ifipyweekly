<?php
// ============================================
// FILE: register.php
// FUNGSI: Halaman registrasi pengguna
// ============================================

require 'fungsi.php';

// Redirect jika sudah login
if (isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

// Proses registrasi
if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string(koneksi(), $_POST['username']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Validasi
    if (empty($username) || empty($password) || empty($confirm_password)) {
        $error = "Semua field harus diisi!";
    } elseif ($password !== $confirm_password) {
        $error = "Password dan konfirmasi password tidak cocok!";
    } elseif (strlen($password) < 6) {
        $error = "Password minimal 6 karakter!";
    } else {
        // Cek username sudah terdaftar
        $conn = koneksi();
        $check = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
        
        if (mysqli_num_rows($check) > 0) {
            $error = "Username sudah terdaftar!";
        } else {
            // Hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            // Insert user
            $query = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";
            
            if (mysqli_query($conn, $query)) {
                $success = "Registrasi berhasil! Silakan login.";
            } else {
                $error = "Registrasi gagal!";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Informatika</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container" style="max-width: 500px;">
        <div class="header">
            <h1><i class="fas fa-user-plus"></i> REGISTER</h1>
            <p>Buat akun baru</p>
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
                
                <?php if (isset($success)): ?>
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i> <?= $success ?>
                    </div>
                <?php endif; ?>

                <form action="" method="post">
                    <div class="form-group">
                        <label><i class="fas fa-user"></i> Username <span class="required">*</span></label>
                        <input type="text" name="username" required placeholder="Masukkan username" value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>">
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-lock"></i> Password <span class="required">*</span></label>
                        <input type="password" name="password" required placeholder="Minimal 6 karakter">
                        <small><i class="fas fa-info-circle"></i> Password minimal 6 karakter</small>
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-lock"></i> Konfirmasi Password <span class="required">*</span></label>
                        <input type="password" name="confirm_password" required placeholder="Ulangi password">
                    </div>

                    <div class="form-actions" style="flex-direction: column; gap: 15px;">
                        <button type="submit" name="register" class="btn btn-primary" style="width: 100%;">
                            <i class="fas fa-user-plus"></i> Daftar
                        </button>
                        <p style="text-align: center; margin: 0;">
                            Sudah punya akun? <a href="login.php" style="color: #667eea; font-weight: 600;">Login disini</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>