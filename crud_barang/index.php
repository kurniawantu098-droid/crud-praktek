<?php include "koneksi.php";
function aman($t){return htmlspecialchars((string)$t,ENT_QUOTES,'UTF-8');}
$q=$koneksi->query("SELECT * FROM barang ORDER BY id DESC");
?>
<!DOCTYPE html><html lang="id"><head><meta charset="UTF-8"><title>Data Barang</title>
<style>*{margin:0;padding:0;box-sizing:border-box;font-family:Arial}body{background:#f1f5f9;margin:30px}h2{color:#0f766e}table{width:100%;border-collapse:collapse;background:#fff;border-radius:8px;overflow:hidden;box-shadow:0 4px 10px rgba(0,0,0,.05)}.btn{display:inline-block;background:#0f766e;color:#fff;padding:10px 16px;border-radius:6px;text-decoration:none;margin:15px 0}th,td{padding:12px 16px;border:1px solid #e5e7eb;text-align:left}thead tr{background:#0f766e;color:#fff}tbody tr:nth-child(even){background:#f8fafc}.aksi a{margin:0 4px;text-decoration:none;font-weight:bold}.edit{color:#2563eb}.hapus{color:#dc2626}.kosong{text-align:center;padding:20px;color:#6b7280}</style></head><body>
<h2>Data Barang Toko Komputer</h2>
<a class="btn" href="tambah.php">+ Tambah Barang</a>
<table><thead><tr><th>No</th><th>Kode</th><th>Nama Barang</th><th>Harga</th><th>Stok</th><th>Aksi</th></tr></thead><tbody>
<?php $no=1;if($q->num_rows>0){while($b=$q->fetch_assoc()){?>
<tr><td><?=$no++?></td><td><?=aman($b['kode_barang'])?></td><td><?=aman($b['nama_barang'])?></td><td>Rp <?=number_format($b['harga'],0,',','.')?></td><td><?=aman($b['stok'])?></td>
<td class="aksi"><a class="edit" href="edit.php?id=<?=(int)$b['id']?>">Edit</a> | <a class="hapus" href="hapus.php?id=<?=(int)$b['id']?>" onclick="return confirm('Yakin hapus?')">Hapus</a></td></tr>
<?php } } else { ?><tr><td colspan="6" class="kosong">Belum ada data.</td></tr><?php } ?>
</tbody></table></body></html>
<?php $koneksi->close();?>