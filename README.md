# CRUD Praktek — Praktik CRUD PHP (LAMP/XAMPP)

Praktik CRUD PHP (LAMP/XAMPP) yang dibuat untuk belajar operasi Create, Read, Update, Delete pada database MySQL/MariaDB.

## Struktur

```
crud_praktek/
├── crud_siswa/
├── crud_barang/
├── crud_nilai/
└── README.md
```

![crud_siswa](assets/crud_siswa.png)

## 1. crud_siswa — Data Siswa RPL

- Database: `db_sekolah`, tabel `siswa` (id, nis, nama, jurusan, alamat)
- File: koneksi.php, index.php, tambah.php, edit.php, hapus.php, db_sekolah.sql

![crud_barang](assets/crud-barang.png)

## 2. crud_barang — Data Barang Toko Komputer

- Database: `db_toko`, tabel `barang` (id, kode_barang, nama_barang, harga, stok)
- File: koneksi.php, index.php, tambah.php, edit.php, hapus.php, db_toko.sql

![crud_nilai](assets/crud-nilai.png)

## 3. crud_nilai — Data Nilai Siswa

- Database: `db_nilai`, tabel `nilai_siswa` (id, nis, nama, kelas, nilai_pemrograman, nilai_web)
- Fitur tambahan: kolom Rata-rata = (Nilai Pemrograman + Nilai Web)/2, Keterangan (Lulus jika ≥75, Belum Lulus jika <75)
- File: koneksi.php, index.php, tambah.php, edit.php, hapus.php, db_nilai.sql

---

## Uji di LAMP (Linux + Apache + MariaDB/MySQL + PHP)

### 1. Prasyarat

```bash
sudo apt update
sudo apt install apache2 mariadb-server php php-mysqli -y
sudo systemctl start apache2 mariadb
```

### 2. Salin project ke web root

```bash
sudo cp -r /home/moon/ian/crud_siswa /home/moon/ian/crud_barang /home/moon/ian/crud_nilai /var/www/html/
sudo chown -R www-data:www-data /var/www/html/crud_*
sudo chmod -R 755 /var/www/html/crud_*
```

### 3. Import database

```bash
sudo mysql < /var/www/html/crud_siswa/db_sekolah.sql
sudo mysql < /var/www/html/crud_barang/db_toko.sql
sudo mysql < /var/www/html/crud_nilai/db_nilai.sql
```

Atau manual via MariaDB:

```bash
sudo mysql
```

```sql
SOURCE /var/www/html/crud_siswa/db_sekolah.sql;
SOURCE /var/www/html/crud_barang/db_toko.sql;
SOURCE /var/www/html/crud_nilai/db_nilai.sql;
```

### 4. Akses di browser

- http://localhost/crud_siswa/
- http://localhost/crud_barang/
- http://localhost/crud_nilai/

### 5. Uji fungsi

1. Tambah data baru
2. Edit data
3. Hapus data
4. Cek perhitungan rata-rata & keterangan (crud_nilai)

### 6. Hapus (cleanup) di LAMP

Hapus database:

```bash
sudo mysql
```

```sql
DROP DATABASE db_sekolah;
DROP DATABASE db_toko;
DROP DATABASE db_nilai;
```

Hapus file project:

```bash
sudo rm -rf /var/www/html/crud_siswa /var/www/html/crud_barang /var/www/html/crud_nilai
```

---

## Uji di XAMPP (Windows)

### 1. Prasyarat

- Install XAMPP dari https://www.apachefriends.org
- Jalankan Apache & MySQL di XAMPP Control Panel

### 2. Salin project

Copy folder `crud_siswa`, `crud_barang`, `crud_nilai` ke:

```
C:\xampp\htdocs\
```

### 3. Import database

1. Buka http://localhost/phpmyadmin
2. Klik "Import"
3. Pilih file `db_sekolah.sql`, `db_toko.sql`, `db_nilai.sql` (satu per satu)
4. Klik "Go"

Atau via SQL tab:

```sql
SOURCE C:/xampp/htdocs/crud_siswa/db_sekolah.sql;
SOURCE C:/xampp/htdocs/crud_barang/db_toko.sql;
SOURCE C:/xampp/htdocs/crud_nilai/db_nilai.sql;
```

### 4. Akses di browser

- http://localhost/crud_siswa/
- http://localhost/crud_barang/
- http://localhost/crud_nilai/

### 5. Uji fungsi

1. Tambah data baru
2. Edit data
3. Hapus data
4. Cek perhitungan rata-rata & keterangan (crud_nilai)

### 6. Hapus (cleanup) di XAMPP

Hapus database di phpMyAdmin:

1. Buka http://localhost/phpmyadmin
2. Pilih `db_sekolah`, `db_toko`, `db_nilai`
3. Tab "Operations" → "Drop the database (DROP)" → OK

Atau via SQL:

```sql
DROP DATABASE db_sekolah;
DROP DATABASE db_toko;
DROP DATABASE db_nilai;
```

Hapus file project:

```
C:\xampp\htdocs\crud_siswa
C:\xampp\htdocs\crud_barang
C:\xampp\htdocs\crud_nilai
```

---

# Referensi

## CRUD
CRUD = **C**reate (tambah), **R**ead (baca/tampil), **U**pdate (ubah), **D**elete (hapus). Pola dasar pengelolaan data pada aplikasi database. [Wikipedia](https://en.wikipedia.org/wiki/Create,_read,_update_and_delete)

## LAMP
Stack gabungan untuk server Linux: [Wikipedia](https://en.wikipedia.org/wiki/LAMP_(software_bundle))
- **L**inux — sistem operasi
- **A**pache — web server [Apache](https://httpd.apache.org)
- **M**ySQL/MariaDB — database [MySQL](https://www.mysql.com) / [MariaDB](https://mariadb.org)
- **P**HP — bahasa pemrograman server-side [PHP](https://www.php.net)

## XAMPP
Paket aplikasi (cross-platform) yang menyediakan: [XAMPP](https://www.apachefriends.org)
- **X** = cross-platform (Windows/Linux/macOS)
- **A**pache — web server [Apache](https://httpd.apache.org)
- **M**ariaDB/MySQL — database [MariaDB](https://mariadb.org) / [MySQL](https://www.mysql.com)
- **P**HP — bahasa pemrograman [PHP](https://www.php.net)
- **P**erl — bahasa pemrograman (opsional)

## Komponen inti
- **Linux/Windows** — sistem operasi host [Linux](https://www.linux.org) / [Windows](https://www.microsoft.com/windows)
- **Apache2** — web server (menjalankan PHP) [Apache](https://httpd.apache.org)
- **MySQL/MariaDB** — penyimpanan data (database) [MySQL](https://www.mysql.com) / [MariaDB](https://mariadb.org)
- **PHP** — bahasa server-side untuk CRUD [PHP](https://www.php.net)
- **phpMyAdmin** — antarmuka web untuk kelola database MySQL/MariaDB [phpMyAdmin](https://www.phpmyadmin.net)
