<?php
/**
 * File        : edit.php
 * Deskripsi   : Menampilkan form edit data barang & memperbarui ke database
 * Fungsi      : Update (Mengubah Data)
 */

include "koneksi.php";

/**
 * Fungsi untuk mencegah XSS (Cross Site Scripting)
 * @param string $teks
 * @return string
 */
function amanEdit($teks)
{
    return htmlspecialchars((string)$teks, ENT_QUOTES, 'UTF-8');
}

$pesan = "";

// Validasi ID dari URL
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if (!$id || $id < 1) {
    die("ID tidak valid. Silakan kembali ke <a href='index.php'>halaman utama</a>.");
}

// Mengambil data barang berdasarkan ID
$stmt = $koneksi->prepare("SELECT * FROM barang WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$barang  = $result->fetch_assoc();

// Jika data tidak ditemukan
if (!$barang) {
    $stmt->close();
    $koneksi->close();
    die("Data barang tidak ditemukan. Silakan kembali ke <a href='index.php'>halaman utama</a>.");
}
$stmt->close();

// Proses update data ketika form dikirim dengan metode POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Mengambil dan membersihkan data input
    $nama_barang = trim($_POST["nama_barang"] ?? "");
    $harga       = (int)($_POST["harga"] ?? 0);
    $stok        = (int)($_POST["stok"] ?? 0);

    // Validasi: pastikan semua field terisi
    if ($nama_barang === "" || $harga < 0 || $stok < 0) {
        $pesan = "Semua kolom wajib diisi!";
    } else {
        // Menggunakan Prepared Statement untuk update data
        $update = $koneksi->prepare("UPDATE barang SET nama_barang = ?, harga = ?, stok = ? WHERE id = ?");
        $update->bind_param("siii", $nama_barang, $harga, $stok, $id);

        // Eksekusi query dan cek keberhasilan
        if ($update->execute()) {
            // Jika berhasil, redirect ke halaman index
            header("Location: index.php");
            exit;
        } else {
            $pesan = "Gagal mengubah data. Silakan coba kembali.";
        }

        // Menutup prepared statement
        $update->close();
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Barang | CRUD PHP</title>
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
        input[type="number"] {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 14px;
            outline: none;
            transition: 0.2s ease;
        }

        input[type="text"]:focus,
        input[type="number"]:focus {
            border-color: #0f766e;
            box-shadow: 0 0 0 2px rgba(15, 118, 110, 0.1);
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
            <h2>Edit Data Barang</h2>
        </div>

        <?php if ($pesan !== "") : ?>
            <div class="alert">
                <?= amanEdit($pesan); ?>
            </div>
        <?php endif; ?>

        <form method="post" action="">
            <div class="form-group">
                <label for="kode_barang">Kode Barang</label>
                <input type="text" id="kode_barang" value="<?= amanEdit($barang['kode_barang']); ?>" disabled>
            </div>

            <div class="form-group">
                <label for="nama_barang">Nama Barang</label>
                <input type="text" id="nama_barang" name="nama_barang" value="<?= amanEdit($barang['nama_barang']); ?>" autocomplete="off" required>
            </div>

            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="number" id="harga" name="harga" value="<?= (int)$barang['harga']; ?>" min="0" required>
            </div>

            <div class="form-group">
                <label for="stok">Stok</label>
                <input type="number" id="stok" name="stok" value="<?= (int)$barang['stok']; ?>" min="0" required>
            </div>

            <div class="btn-group">
                <button type="submit" class="btn-simpan">Simpan Perubahan</button>
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
