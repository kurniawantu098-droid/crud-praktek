<?php include "koneksi.php";function aman($t){return htmlspecialchars((string)$t,ENT_QUOTES,'UTF-8');}
$pesan="";$id=filter_input(INPUT_GET,"id",FILTER_VALIDATE_INT);
if(!$id||$id<1)die("ID tidak valid.");
$st=$koneksi->prepare("SELECT * FROM nilai_siswa WHERE id=?");$st->bind_param("i",$id);$st->execute();$r=$st->get_result();$n=$r->fetch_assoc();$st->close();
if(!$n)die("Data tidak ditemukan.");
if($_SERVER["REQUEST_METHOD"]==="POST"){
 $nama=trim($_POST["nama"]??"");$kelas=trim($_POST["kelas"]??"");
 $np=(int)($_POST["nilai_pemrograman"]??"");$nw=(int)($_POST["nilai_web"]??"");
 if($nama===""||$kelas===""||$np<0||$np>100||$nw<0||$nw>100){$pesan="Data tidak valid!";}
 else{
  $u=$koneksi->prepare("UPDATE nilai_siswa SET nama=?,kelas=?,nilai_pemrograman=?,nilai_web=? WHERE id=?");
  $u->bind_param("ssiii",$nama,$kelas,$np,$nw,$id);
  if($u->execute()){header("Location: index.php");exit;}else{$pesan="Gagal update.";}
  $u->close();
 }
}
?>
<!DOCTYPE html><html lang="id"><head><meta charset="UTF-8"><title>Edit Nilai</title>
<style>*{margin:0;padding:0;box-sizing:border-box;font-family:Arial}body{background:#f1f5f9;padding:30px}.card{max-width:500px;margin:0 auto;background:#fff;padding:30px;border-radius:10px;box-shadow:0 4px 12px rgba(0,0,0,.05)}h2{color:#0f766e;margin-bottom:20px}.form-group{margin-bottom:18px}label{display:block;margin-bottom:8px;font-weight:bold}input{width:100%;padding:10px 12px;border:1px solid #d1d5db;border-radius:6px}button{background:#0f766e;color:#fff;border:none;padding:10px 18px;border-radius:6px;cursor:pointer}.alert{background:#fef2f2;color:#dc2626;padding:12px;border-radius:6px;margin-bottom:20px;border:1px solid #fecaca}</style></head><body><div class="card"><h2>Edit Nilai Siswa</h2>
<?php if($pesan!==""){?><div class="alert"><?=aman($pesan)?></div><?php}?>
<form method="post"><div class="form-group"><label>NIS</label><input value="<?=aman($n['nis'])?>" disabled></div>
<div class="form-group"><label>Nama</label><input name="nama" value="<?=aman($n['nama'])?>" required></div>
<div class="form-group"><label>Kelas</label><input name="kelas" value="<?=aman($n['kelas'])?>" required></div>
<div class="form-group"><label>Nilai Pemrograman</label><input type="number" name="nilai_pemrograman" value="<?=$n['nilai_pemrograman']?>" min="0" max="100" required></div>
<div class="form-group"><label>Nilai Web</label><input type="number" name="nilai_web" value="<?=$n['nilai_web']?>" min="0" max="100" required></div>
<button type="submit">Simpan</button> <a href="index.php">Kembali</a></form></div></body></html>
<?php $koneksi->close();?>