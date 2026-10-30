<?php
/**
 * File        : index.php
 * Deskripsi   : Menampilkan seluruh data nilai siswa dalam bentuk tabel
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

// Mengambil seluruh data nilai diurutkan berdasarkan ID terbaru
$query = "SELECT * FROM nilai_siswa ORDER BY id DESC";
$data  = $koneksi->query($query);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Nilai Siswa | CRUD PHP</title>
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

        .lulus {
            color: #16a34a;
            font-weight: bold;
        }

        .belum {
            color: #dc2626;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <header>
        <h2>Data Nilai Siswa RPL</h2>
    </header>

    <a class="btn-tambah" href="tambah.php">+ Tambah Nilai</a>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Nilai Prog</th>
                    <th>Nilai Web</th>
                    <th>Rata-rata</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                if ($data->num_rows > 0) {
                    while ($nilai = $data->fetch_assoc()) {
                        $rata = ($nilai['nilai_pemrograman'] + $nilai['nilai_web']) / 2;
                        $ket  = $rata >= 75 ? 'Lulus' : 'Belum Lulus';
                ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= aman($nilai['nis']); ?></td>
                            <td><?= aman($nilai['nama']); ?></td>
                            <td><?= aman($nilai['kelas']); ?></td>
                            <td><?= aman($nilai['nilai_pemrograman']); ?></td>
                            <td><?= aman($nilai['nilai_web']); ?></td>
                            <td><?= number_format($rata, 2); ?></td>
                            <td class="<?= $ket === 'Lulus' ? 'lulus' : 'belum'; ?>"><?= $ket; ?></td>
                            <td>
                                <div class="aksi">
                                    <a class="btn-edit" href="edit.php?id=<?= (int)$nilai['id']; ?>">Edit</a>
                                    <span class="garis">|</span>
                                    <a class="btn-hapus" href="hapus.php?id=<?= (int)$nilai['id']; ?>" onclick="return confirm('Yakin ingin menghapus data <?= aman(addslashes($nilai['nama'])); ?>?')">Hapus</a>
                                </div>
                            </td>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="9" class="kosong">Belum ada data nilai yang tersimpan.</td>
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
