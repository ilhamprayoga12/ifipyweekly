<?php
// ============================================
// FILE: hapusdata.php
// FUNGSI: Proses hapus data mahasiswa
// ============================================

require 'fungsi.php';
cek_login();

$id = (int) $_GET['id'];

if (hapusdata($id) > 0) {
    header("Location: mahasiswa.php?success=Data berhasil dihapus!");
} else {
    header("Location: mahasiswa.php?error=Data gagal dihapus!");
}
?>