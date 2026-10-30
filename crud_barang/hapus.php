<?php include "koneksi.php";
$id=filter_input(INPUT_GET,"id",FILTER_VALIDATE_INT);
if(!$id||$id<1)die("ID tidak valid.");
$st=$koneksi->prepare("DELETE FROM barang WHERE id=?");$st->bind_param("i",$id);
if($st->execute()){header("Location: index.php");exit;}else{echo "Gagal hapus.";}
$st->close();$koneksi->close();