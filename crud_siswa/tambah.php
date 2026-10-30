<?php
/**
 * File        : tambah.php
 * Deskripsi   : Menampilkan form tambah data siswa & menyimpan ke database
 * Fungsi      : Create (Menambah Data)
 */

include "koneksi.php";

$pesan = "";

// Proses simpan data ketika form dikirim dengan metode POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Mengambil dan membersihkan data input
    $nis     = trim($_POST["nis"] ?? "");
    $nama    = trim($_POST["nama"] ?? "");
    $jurusan = trim($_POST["jurusan"] ?? "");
    $alamat  = trim($_POST["alamat"] ?? "");

    // Validasi: pastikan semua field terisi
    if ($nis === "" || $nama === "" || $jurusan === "" || $alamat === "") {
        $pesan = "Semua kolom wajib diisi!";
    } else {
        // Menggunakan Prepared Statement untuk mencegah SQL Injection
        $stmt = $koneksi->prepare("INSERT INTO siswa (nis, nama, jurusan, alamat) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nis, $nama, $jurusan, $alamat);

        // Eksekusi query dan cek keberhasilan
        if ($stmt->execute()) {
            // Jika berhasil, redirect ke halaman index
            header("Location: index.php");
            exit;
        } else {
            $pesan = "Gagal menyimpan data. Silakan coba kembali.";
        }

        // Menutup prepared statement
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Siswa | CRUD PHP</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background-color: #f1f5f9;
            padding: 30px;
        }

        .card {
            max-width: 500px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .card-header {
            margin-bottom: 25px;
        }

        .card-header h2 {
            color: #0f766e;
        }

        .alert {
            background-color: #fef2f2;
            color: #dc2626;
            padding: 12px 16px;
            border-radius: 6px;
            margin-bottom: 20px;
            border: 1px solid #fecaca;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #1f2937;
        }

        input[type="text"],
        select,
        textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 14px;
            outline: none;
            transition: 0.2s ease;
        }

        input[type="text"]:focus,
        select:focus,
        textarea:focus {
            border-color: #0f766e;
            box-shadow: 0 0 0 2px rgba(15, 118, 110, 0.1);
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        .btn-group {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 25px;
        }

        .btn-simpan {
            background-color: #0f766e;
            color: #ffffff;
            border: none;
            padding: 10px 18px;
            border-radius: 6px;
                        cursor: pointer;
            transition: 0.3s ease;
        }

        .btn-simpan:hover {
            background-color: #115e59;
        }

        .btn-kembali {
            color: #4b5563;
            text-decoration: none;
        }

        .btn-kembali:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="card-header">
            <h2>Tambah Data Siswa</h2>
        </div>

        <?php if ($pesan !== "") : ?>
            <div class="alert">
                <?= htmlspecialchars($pesan, ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php endif; ?>

        <form method="post" action="">
            <div class="form-group">
                <label for="nis">NIS</label>
                <input type="text" id="nis" name="nis" placeholder="Masukkan NIS siswa" autocomplete="off" required>
            </div>

            <div class="form-group">
                <label for="nama">Nama Siswa</label>
                <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap siswa" autocomplete="off" required>
            </div>

            <div class="form-group">
                <label for="jurusan">Jurusan</label>
                <select id="jurusan" name="jurusan" required>
                    <option value="">-- Pilih Jurusan --</option>
                    <option value="RPL">RPL</option>
                    <option value="TKJ">TKJ</option>
                    <option value="DKV">DKV</option>
                </select>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea id="alamat" name="alamat" placeholder="Masukkan alamat lengkap siswa" required></textarea>
            </div>

            <div class="btn-group">
                <button type="submit" class="btn-simpan">Simpan Data</button>
                <a class="btn-kembali" href="index.php">Kembali ke Daftar</a>
            </div>
        </form>
    </div>
</body>

</html>
<?php
// Menutup koneksi database
$koneksi->close();
?>
