<?php include "koneksi.php";function aman($t){return htmlspecialchars((string)$t,ENT_QUOTES,'UTF-8');}
$pesan="";$id=filter_input(INPUT_GET,"id",FILTER_VALIDATE_INT);
if(!$id||$id<1)die("ID tidak valid.");
$st=$koneksi->prepare("SELECT * FROM barang WHERE id=?");$st->bind_param("i",$id);$st->execute();$r=$st->get_result();$b=$r->fetch_assoc();$st->close();
if(!$b)die("Data tidak ditemukan.");
if($_SERVER["REQUEST_METHOD"]==="POST"){
 $nb=trim($_POST["nama_barang"]??"");$h=(int)($_POST["harga"]??"");$s=(int)($_POST["stok"]??"");
 if($nb===""||$h<0||$s<0){$pesan="Semua kolom wajib diisi!";}
 else{
  $u=$koneksi->prepare("UPDATE barang SET nama_barang=?,harga=?,stok=? WHERE id=?");
  $u->bind_param("siii",$nb,$h,$s,$id);
  if($u->execute()){header("Location: index.php");exit;}else{$pesan="Gagal update.";}
  $u->close();
 }
}
?>
<!DOCTYPE html><html lang="id"><head><meta charset="UTF-8"><title>Edit Barang</title>
<style>*{margin:0;padding:0;box-sizing:border-box;font-family:Arial}body{background:#f1f5f9;padding:30px}.card{max-width:500px;margin:0 auto;background:#fff;padding:30px;border-radius:10px;box-shadow:0 4px 12px rgba(0,0,0,.05)}h2{color:#0f766e;margin-bottom:20px}.form-group{margin-bottom:18px}label{display:block;margin-bottom:8px;font-weight:bold}input{width:100%;padding:10px 12px;border:1px solid #d1d5db;border-radius:6px}button{background:#0f766e;color:#fff;border:none;padding:10px 18px;border-radius:6px;cursor:pointer}.alert{background:#fef2f2;color:#dc2626;padding:12px;border-radius:6px;margin-bottom:20px;border:1px solid #fecaca}</style></head><body><div class="card"><h2>Edit Barang</h2>
<?php if($pesan!==""){?><div class="alert"><?=aman($pesan)?></div><?php}?>
<form method="post"><div class="form-group"><label>Kode Barang</label><input value="<?=aman($b['kode_barang'])?>" disabled></div>
<div class="form-group"><label>Nama Barang</label><input name="nama_barang" value="<?=aman($b['nama_barang'])?>" required></div>
<div class="form-group"><label>Harga</label><input type="number" name="harga" value="<?=$b['harga']?>" min="0" required></div>
<div class="form-group"><label>Stok</label><input type="number" name="stok" value="<?=$b['stok']?>" min="0" required></div>
<button type="submit">Simpan</button> <a href="index.php">Kembali</a></form></div></body></html>
<?php $koneksi->close();?>