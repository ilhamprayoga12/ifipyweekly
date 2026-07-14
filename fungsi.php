<?php
// ============================================
// FILE: fungsi.php
// FUNGSI: Tempat semua fungsi database & CRUD
// ============================================

// ========== SESSION START ==========
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ========== CEK LOGIN ==========
function cek_login() {
    if (!isset($_SESSION['login'])) {
        header("Location: login.php");
        exit;
    }
}

// ========== CEK LOGIN UNTUK HALAMAN TERTENTU ==========
// Tambahkan ini di halaman yang memerlukan login (mahasiswa.php, tambahdata.php, editdata.php, hapusdata.php)
// Gunakan: cek_login();

// ... (kode fungsi lainnya tetap sama)


// ============================================
// FILE: fungsi.php
// FUNGSI: Tempat semua fungsi database & CRUD
// ============================================

// ========== KONEKSI DATABASE ==========
function koneksi() {
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db   = "ifipyweekly";

    $conn = mysqli_connect($host, $user, $pass, $db);

    if (!$conn) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }

    return $conn;
}

// ========== TAMPIL DATA (READ) ==========
function tampildata($query) {
    $conn = koneksi();
    $result = mysqli_query($conn, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

// ========== UPLOAD FOTO ==========
function uploadfoto() {
    $namaFile   = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $error      = $_FILES['foto']['error'];
    $tmpName    = $_FILES['foto']['tmp_name'];

    // Jika tidak upload foto, pakai default
    if ($error === 4) {
        return 'default.png';
    }

    // Cek ekstensi file yang diizinkan
    $ekstensiValid = ['jpg', 'jpeg', 'png', 'gif'];
    $ekstensi = explode('.', $namaFile);
    $ekstensi = strtolower(end($ekstensi));

    if (!in_array($ekstensi, $ekstensiValid)) {
        echo "<script>alert('Format file tidak valid! Gunakan JPG, JPEG, PNG, atau GIF.');</script>";
        return false;
    }

    // Cek ukuran file (max 2MB)
    if ($ukuranFile > 2000000) {
        echo "<script>alert('Ukuran file terlalu besar! Maksimal 2MB.');</script>";
        return false;
    }

    // Buat nama file unik
    $namaFileBaru = uniqid() . '.' . $ekstensi;
    $folderTujuan = 'assets/images/';

    // Buat folder jika belum ada
    if (!is_dir($folderTujuan)) {
        mkdir($folderTujuan, 0777, true);
    }

    // Pindahkan file
    move_uploaded_file($tmpName, $folderTujuan . $namaFileBaru);

    return $namaFileBaru;
}

// ========== TAMBAH DATA (CREATE) ==========
function tambahdata($data) {
    $conn = koneksi();

    $nama = mysqli_real_escape_string($conn, $data['nama']);
    $uts  = (int) $data['uts'];
    $uas  = (int) $data['uas'];
    $tugas = (int) $data['tugas'];

    $foto = uploadfoto();
    if (!$foto) {
        return false;
    }

    $query = "INSERT INTO mahasiswa (nama, foto, uts, uas, tugas)
              VALUES ('$nama', '$foto', $uts, $uas, $tugas)";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

// ========== EDIT DATA (UPDATE) ==========
function editdata($data) {
    $conn = koneksi();

    $id    = (int) $data['id'];
    $nama  = mysqli_real_escape_string($conn, $data['nama']);
    $uts   = (int) $data['uts'];
    $uas   = (int) $data['uas'];
    $tugas = (int) $data['tugas'];
    $fotoLama = $data['foto_lama'];

    // Cek apakah user upload foto baru
    if ($_FILES['foto']['error'] === 4) {
        $foto = $fotoLama;
    } else {
        $foto = uploadfoto();
        if (!$foto) {
            return false;
        }

        if ($fotoLama != 'default.png') {
            $path = 'assets/images/' . $fotoLama;
            if (file_exists($path)) {
                unlink($path);
            }
        }
    }

    $query = "UPDATE mahasiswa SET
              nama = '$nama',
              foto = '$foto',
              uts = $uts,
              uas = $uas,
              tugas = $tugas
              WHERE id = $id";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

// ========== HAPUS DATA (DELETE) ==========
function hapusdata($id) {
    $conn = koneksi();
    $id = (int) $id;

    $query  = "SELECT foto FROM mahasiswa WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $mhs    = mysqli_fetch_assoc($result);

    if ($mhs && $mhs['foto'] != 'default.png') {
        $path = 'assets/images/' . $mhs['foto'];
        if (file_exists($path)) {
            unlink($path);
        }
    }

    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");
    return mysqli_affected_rows($conn);
}

// ========== HITUNG JUMLAH DATA ==========
function hitungdata($table) {
    $conn = koneksi();
    $query = "SELECT COUNT(*) as total FROM $table";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['total'];
}
?>