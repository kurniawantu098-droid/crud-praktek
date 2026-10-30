<?php include "koneksi.php"; $pesan="";
if($_SERVER["REQUEST_METHOD"]==="POST"){
 $nis=trim($_POST["nis"]??""); $nama=trim($_POST["nama"]??""); $kelas=trim($_POST["kelas"]??"");
 $np=(int)($_POST["nilai_pemrograman"]??""); $nw=(int)($_POST["nilai_web"]??"");
 if($nis===""||$nama===""||$kelas===""||$np<0||$np>100||$nw<0||$nw>100){
   $pesan="Semua kolom wajib diisi & nilai 0-100!";
 } else {
   $st=$koneksi->prepare("INSERT INTO nilai_siswa (nis,nama,kelas,nilai_pemrograman,nilai_web) VALUES (?,?,?,?,?)");
   $st->bind_param("sssii",$nis,$nama,$kelas,$np,$nw);
   if($st->execute()){ header("Location: index.php"); exit; } else { $pesan="Gagal menyimpan."; }
   $st->close();
 }
}
?>
<!DOCTYPE html><html lang="id"><head><meta charset="UTF-8"><title>Tambah Nilai</title>
<style>*{margin:0;padding:0;box-sizing:border-box;font-family:Arial}body{background:#f1f5f9;padding:30px}.card{max-width:500px;margin:0 auto;background:#fff;padding:30px;border-radius:10px;box-shadow:0 4px 12px rgba(0,0,0,.05)}h2{color:#0f766e;margin-bottom:20px}.form-group{margin-bottom:18px}label{display:block;margin-bottom:8px;font-weight:bold}input{width:100%;padding:10px 12px;border:1px solid #d1d5db;border-radius:6px}button{background:#0f766e;color:#fff;border:none;padding:10px 18px;border-radius:6px;cursor:pointer}.alert{background:#fef2f2;color:#dc2626;padding:12px;border-radius:6px;margin-bottom:20px;border:1px solid #fecaca}</style></head><body><div class="card"><h2>Tambah Nilai Siswa</h2>
<?php if($pesan!==""){?><div class="alert"><?=htmlspecialchars($pesan)?></div><?php } ?>
<form method="post"><div class="form-group"><label>NIS</label><input name="nis" required></div>
<div class="form-group"><label>Nama Siswa</label><input name="nama" required></div>
<div class="form-group"><label>Kelas</label><input name="kelas" required></div>
<div class="form-group"><label>Nilai Pemrograman</label><input type="number" name="nilai_pemrograman" min="0" max="100" required></div>
<div class="form-group"><label>Nilai Web</label><input type="number" name="nilai_web" min="0" max="100" required></div>
<button type="submit">Simpan</button> <a href="index.php">Kembali</a></form></div></body></html>
<?php $koneksi->close(); ?>