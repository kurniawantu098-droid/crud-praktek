<?php include "koneksi.php";function aman($t){return htmlspecialchars((string)$t,ENT_QUOTES,'UTF-8');}
$q=$koneksi->query("SELECT * FROM nilai_siswa ORDER BY id DESC");
?>
<!DOCTYPE html><html lang="id"><head><meta charset="UTF-8"><title>Data Nilai Siswa</title>
<style>*{margin:0;padding:0;box-sizing:border-box;font-family:Arial}body{background:#f1f5f9;margin:30px}h2{color:#0f766e}table{width:100%;border-collapse:collapse;background:#fff;border-radius:8px;overflow:hidden;box-shadow:0 4px 10px rgba(0,0,0,.05)}.btn{display:inline-block;background:#0f766e;color:#fff;padding:10px 16px;border-radius:6px;text-decoration:none;margin:15px 0}th,td{padding:12px 16px;border:1px solid #e5e7eb;text-align:left}thead tr{background:#0f766e;color:#fff}tbody tr:nth-child(even){background:#f8fafc}.aksi a{margin:0 4px;text-decoration:none;font-weight:bold}.edit{color:#2563eb}.hapus{color:#dc2626}.kosong{text-align:center;padding:20px;color:#6b7280}.lulus{color:#16a34a;font-weight:bold}.belum{color:#dc2626;font-weight:bold}</style></head><body>
<h2>Data Nilai Siswa RPL</h2>
<a class="btn" href="tambah.php">+ Tambah Nilai</a>
<table><thead><tr><th>No</th><th>NIS</th><th>Nama</th><th>Kelas</th><th>Nilai Prog</th><th>Nilai Web</th><th>Rata-rata</th><th>Keterangan</th><th>Aksi</th></tr></thead><tbody>
<?php $no=1;if($q->num_rows>0){while($n=$q->fetch_assoc()){
 $rata=($n['nilai_pemrograman']+$n['nilai_web'])/2;
 $ket=$rata>=75?'Lulus':'Belum Lulus';
?>
<tr><td><?=$no++?></td><td><?=aman($n['nis'])?></td><td><?=aman($n['nama'])?></td><td><?=aman($n['kelas'])?></td><td><?=aman($n['nilai_pemrograman'])?></td><td><?=aman($n['nilai_web'])?></td><td><?=number_format($rata,2)?></td><td class="<?= $ket=='Lulus'?'lulus':'belum'?>"><?=$ket?></td>
<td class="aksi"><a class="edit" href="edit.php?id=<?=(int)$n['id']?>">Edit</a> | <a class="hapus" href="hapus.php?id=<?=(int)$n['id']?>" onclick="return confirm('Yakin hapus?')">Hapus</a></td></tr>
<?php } } else { ?><tr><td colspan="9" class="kosong">Belum ada data.</td></tr><?php } ?>
</tbody></table></body></html>
<?php $koneksi->close();?>