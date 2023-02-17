<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Laporan</title>
</head>
<body onload="window.print()">
	<?php 
	$nolap = $_GET['nolap'];
	if($nolap=='1'){?>
		<h1>Rekapitulasi Master Petugas</h1>
		<table border="1" width="70%">
			<tr>
				<th>No.</th>
				<th>Nama Petugas</th>
				<th>Username</th>
				<th>Level</th>
			</tr>
			<?php
			include "koneksi.php";
			$no = 1;
			$sql = "SELECT * FROM tbl_petugas";
			$query = mysqli_query($koneksi, $sql);
			while($data = mysqli_fetch_array($query)){?>
				<tr>
					<td align="center" width="5%"><?= $no++;?>.</td>
					<td><?= $data['nama_petugas'];?></td>
					<td><?= $data['username'];?></td>
					<td><?= $data['level'];?></td>
				</tr>
				<?php
			}?>
		</table>
		<?php
	}elseif($nolap=='2'){?>
		<h1>Rekapitulasi Master SPP</h1>
		<table border="1" width="50%">
			<tr>
				<th>No.</th>
				<th>ID SPP</th>
				<th>Tahun</th>
				<th>Nominal</th>
			</tr>
			<?php
			include "koneksi.php";
			$no = 1;
			$sql = "SELECT * FROM tbl_spp";
			$query = mysqli_query($koneksi, $sql);
			while($data = mysqli_fetch_array($query)){?>
				<tr>
					<td align="center" width="5%"><?= $no++;?>.</td>
					<td><?= $data['id_spp'];?></td>
					<td align="center"><?= $data['tahun'];?></td>
					<td align="right"><?= number_format($data['nominal']);?></td>
				</tr>
				<?php
			}?>
	</table>
	<?php
	}elseif($nolap=='3'){?>
		<h1>Rekapiluasi Master Kelas</h1>
		<table border="1" width="50%">
			<tr>
				<th>No.</th>
				<th>ID Kelas</th>
				<th>Nama Kelas</th>
				<th>Wali Kelas</th>
			</tr>
			<?php
			include "koneksi.php";
			$no = 1;
			$sql = "SELECT * FROM tbl_kelas";
			$query = mysqli_query($koneksi, $sql);
			while($data = mysqli_fetch_array($query)){?>
				<tr>
					<td align="center" width="5%"><?= $no++;?>.</td>
					<td><?= $data['id_kelas'];?></td>
					<td><?= $data['nama_kelas'];?></td>
					<td><?= $data['wali_kelas'];?></td>
				</tr>
				<?php
			}?>
		</table>
		<?php 
	}elseif($nolap=='4'){?>	
		<h1>Rekapiluasi Master Siswa</h1>
		<table border="1" width="80%">
			<tr>
				<th>No.</th>
				<th>NISN</th>
				<th>NIS</th>
				<th>Nama</th>
				<th>Nama Kelas</th>
				<th>K. Keahlian</th>
				<th>Alamat</th>
				<th>Telp</th>
			</tr>
			<?php
			include "koneksi.php";
			$no = 1;
			$sql = "SELECT * FROM tb_siswa INNER JOIN tbl_kelas ON tb_siswa.id_kelas=tbl_kelas.id_kelas";
			$query = mysqli_query($koneksi, $sql);
			while($data = mysqli_fetch_array($query)){?>
				<tr>
					<td align="center" width="5%"><?= $no++;?>.</td>
					<td><?= $data['nisn'];?></td>
					<td><?= $data['nis'];?></td>
					<td><?= $data['nama'];?></td>
					<td><?= $data['nama_kelas'];?></td>
					<td><?= $data['kompetensi_keahlian'];?></td>
					<td><?= $data['alamat'];?></td>
					<td><?= $data['no_telepon'];?></td>
				</tr>
				<?php
			}?>
		</table>
		<?php
	}?>
</body>
</html>