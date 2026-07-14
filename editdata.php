<?php
// ============================================
// FILE: editdata.php
// FUNGSI: Form edit data mahasiswa
// ============================================

require 'fungsi.php';
cek_login();
$id  = (int) $_GET['id'];
$mhs = tampildata("SELECT * FROM mahasiswa WHERE id = $id")[0];

if (isset($_POST['submit'])) {
    if (editdata($_POST) > 0) {
        echo "<script>
                alert('✅ Data berhasil diupdate!');
                document.location.href = 'mahasiswa.php';
              </script>";
    } else {
        echo "<script>
                alert('❌ Data gagal diupdate!');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Mahasiswa - Informatika</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-edit"></i> EDIT DATA MAHASISWA</h1>
            <p>Silakan ubah data di bawah ini</p>
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
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $mhs['id']; ?>">
                    <input type="hidden" name="foto_lama" value="<?= $mhs['foto']; ?>">

                    <div class="form-row">
                        <div class="form-group">
                            <label><i class="fas fa-user"></i> Nama Lengkap <span class="required">*</span></label>
                            <input type="text" name="nama" id="nama" required value="<?= htmlspecialchars($mhs['nama']); ?>">
                        </div>

                        <div class="form-group">
                            <label><i class="fas fa-image"></i> Ganti Foto</label>
                            <input type="file" name="foto" id="foto" accept="image/*">
                            <small><i class="fas fa-info-circle"></i> Kosongkan jika tidak ingin mengganti foto</small>
                            <div style="margin-top: 10px;">
                                <?php if ($mhs['foto'] && file_exists("assets/images/" . $mhs['foto'])): ?>
                                    <img src="assets/images/<?= $mhs['foto']; ?>" style="width: 80px; height: 80px; border-radius: 10px; object-fit: cover;">
                                <?php else: ?>
                                    <img src="assets/images/default.png" style="width: 80px; height: 80px; border-radius: 10px; object-fit: cover;">
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label><i class="fas fa-file-alt"></i> UTS <span class="required">*</span></label>
                            <input type="number" name="uts" id="uts" required value="<?= $mhs['uts']; ?>">
                        </div>

                        <div class="form-group">
                            <label><i class="fas fa-file-alt"></i> UAS <span class="required">*</span></label>
                            <input type="number" name="uas" id="uas" required value="<?= $mhs['uas']; ?>">
                        </div>

                        <div class="form-group">
                            <label><i class="fas fa-file-alt"></i> Tugas <span class="required">*</span></label>
                            <input type="number" name="tugas" id="tugas" required value="<?= $mhs['tugas']; ?>">
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" name="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Data
                        </button>
                        <a href="mahasiswa.php" class="btn btn-cancel">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>