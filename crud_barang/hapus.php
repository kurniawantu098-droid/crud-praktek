<?php
/**
 * File        : hapus.php
 * Deskripsi   : Menghapus data barang berdasarkan ID
 * Fungsi      : Delete (Menghapus Data)
 */

include "koneksi.php";

// Validasi ID dari URL
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if (!$id || $id < 1) {
    die("ID tidak valid. Silakan kembali ke <a href='index.php'>halaman utama</a>.");
}

// Menghapus data barang menggunakan Prepared Statement
$stmt = $koneksi->prepare("DELETE FROM barang WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    // Jika berhasil, redirect ke halaman index
    header("Location: index.php");
    exit;
} else {
    // Jika gagal
    echo "Gagal menghapus data barang. Silakan kembali ke <a href='index.php'>halaman utama</a>.";
}

// Menutup prepared statement & koneksi
$stmt->close();
$koneksi->close();
?>
