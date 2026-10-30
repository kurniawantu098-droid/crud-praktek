<?php
/**
 * File        : index.php
 * Deskripsi   : Menampilkan seluruh data siswa dalam bentuk tabel
 * Fungsi      : Read (Menampilkan Data)
 */

include "koneksi.php";

/**
 * Fungsi untuk mencegah XSS (Cross Site Scripting)
 * @param string $teks
 * @return string
 */
function aman($teks)
{
    return htmlspecialchars((string)$teks, ENT_QUOTES, 'UTF-8');
}

// Mengambil seluruh data siswa diurutkan berdasarkan ID terbaru
$query = "SELECT * FROM siswa ORDER BY id DESC";
$data  = $koneksi->query($query);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa RPL | CRUD PHP</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background-color: #f1f5f9;
            margin: 30px;
        }

        header {
            margin-bottom: 20px;
        }

        header h2 {
            color: #0f766e;
            text-transform: uppercase;
        }

        .btn-tambah {
            display: inline-block;
            background-color: #0f766e;
            color: #ffffff;
            padding: 10px 16px;
            text-decoration: none;
            border-radius: 6px;
            margin: 15px 0;
            transition: 0.3s ease;
        }

        .btn-tambah:hover {
            background-color: #115e59;
        }

        .table-container {
            overflow-x: auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table thead tr {
            background-color: #0f766e;
            color: #ffffff;
        }

        table th,
        table td {
            padding: 12px 16px;
            text-align: left;
            border: 1px solid #e5e7eb;
            vertical-align: top;
        }

        table tbody tr:nth-child(even) {
            background-color: #f8fafc;
        }

        table tbody tr:hover {
            background-color: #f1f5f9;
        }

        .aksi {
            display: flex;
            align-items: center;
            gap: 10px;
            white-space: nowrap;
        }

        .btn-edit {
            color: #2563eb;
            text-decoration: none;
            font-weight: bold;
        }

        .btn-edit:hover {
            text-decoration: underline;
        }

        .btn-hapus {
            color: #dc2626;
            text-decoration: none;
            font-weight: bold;
        }

        .btn-hapus:hover {
            text-decoration: underline;
        }

        .garis {
            color: #9ca3af;
        }

        .kosong {
            text-align: center;
            padding: 20px;
            color: #6b7280;
        }
    </style>
</head>

<body>
    <header>
        <h2>Data Siswa RPL</h2>
    </header>

    <a class="btn-tambah" href="tambah.php">+ Tambah Siswa</a>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama Siswa</th>
                    <th>Jurusan</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                if ($data->num_rows > 0) {
                    while ($siswa = $data->fetch_assoc()) {
                ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= aman($siswa['nis']); ?></td>
                            <td><?= aman($siswa['nama']); ?></td>
                            <td><?= aman($siswa['jurusan']); ?></td>
                            <td><?= nl2br(aman($siswa['alamat'])); ?></td>
                            <td>
                                <div class="aksi">
                                    <a class="btn-edit" href="edit.php?id=<?= (int)$siswa['id']; ?>">Edit</a>
                                    <span class="garis">|</span>
                                    <a class="btn-hapus" href="hapus.php?id=<?= (int)$siswa['id']; ?>" onclick="return confirm('Yakin ingin menghapus data <?= aman(addslashes($siswa['nama'])); ?>?')">Hapus</a>
                                </div>
                            </td>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="6" class="kosong">Belum ada data siswa yang tersimpan.</td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
<?php
// Menutup koneksi database
$koneksi->close();
?>
