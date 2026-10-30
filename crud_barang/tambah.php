<?php include "koneksi.php"; $pesan="";
if($_SERVER["REQUEST_METHOD"]==="POST"){
 $kb=trim($_POST["kode_barang"]??""); $nb=trim($_POST["nama_barang"]??""); $h=(int)($_POST["harga"]??""); $s=(int)($_POST["stok"]??"");
 if($kb===""||$nb===""||$h<0||$s<0){ $pesan="Semua kolom wajib diisi!"; }
 else {
   $st=$koneksi->prepare("INSERT INTO barang (kode_barang,nama_barang,harga,stok) VALUES (?,?,?,?)");
   $st->bind_param("ssii",$kb,$nb,$h,$s);
   if($st->execute()){ header("Location: index.php"); exit; } else { $pesan="Gagal menyimpan."; }
   $st->close();
 }
}
?>
<!DOCTYPE html><html lang="id"><head><meta charset="UTF-8"><title>Tambah Barang</title>
<style>*{margin:0;padding:0;box-sizing:border-box;font-family:Arial}body{background:#f1f5f9;padding:30px}.card{max-width:500px;margin:0 auto;background:#fff;padding:30px;border-radius:10px;box-shadow:0 4px 12px rgba(0,0,0,.05)}h2{color:#0f766e;margin-bottom:20px}.form-group{margin-bottom:18px}label{display:block;margin-bottom:8px;font-weight:bold}input{width:100%;padding:10px 12px;border:1px solid #d1d5db;border-radius:6px}button{background:#0f766e;color:#fff;border:none;padding:10px 18px;border-radius:6px;cursor:pointer}.alert{background:#fef2f2;color:#dc2626;padding:12px;border-radius:6px;margin-bottom:20px;border:1px solid #fecaca}</style></head><body><div class="card"><h2>Tambah Barang</h2>
<?php if($pesan!==""){?><div class="alert"><?=htmlspecialchars($pesan)?></div><?php } ?>
<form method="post"><div class="form-group"><label>Kode Barang</label><input name="kode_barang" required></div>
<div class="form-group"><label>Nama Barang</label><input name="nama_barang" required></div>
<div class="form-group"><label>Harga</label><input type="number" name="harga" min="0" required></div>
<div class="form-group"><label>Stok</label><input type="number" name="stok" min="0" required></div>
<button type="submit">Simpan</button> <a href="index.php">Kembali</a></form></div></body></html>
<?php $koneksi->close(); ?>