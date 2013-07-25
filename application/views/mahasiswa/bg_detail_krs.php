
<div id="container">
	<h1>Kartu Rencana Studi - Sistem Informasi Akademik Online</h1>

	<div id="body">
		<?php
			echo $bio;
			echo $menu;
		?>
		<div class="cleaner_h10"></div>
		<p style="padding:10px; background-color:#0BE0F6; text-align:center; margin:0px;">
				Kartu Rencana Studi anda sudah disetujui. Untuk melakukan perubahan jadwal atau jadwal kuliah, silahkan hubungi dosen wali.</p>
<form name="datafrs" id="datafrs" method="POST" action="<?php echo base_url(); ?>mahasiswa/simpan_krs">

	<table border="0" width="100%" cellpadding="7" cellspacing="0" style="border-collapse: collapse;">
	<tr>
		<td>NIM</td>
		<td><input name="nim" value="<?php echo $nim; ?>" type="text" readonly="readonly"  size="35" class="input-read-only"/></td>
		<td>Semester, Tahun Ajaran</td>
		<td><input name="smstr_thn_ajaran" value="<?php echo $tahun_ajaran; ?>" type="text" readonly="readonly"  size="35" class="input-read-only" /></td>
	</tr>
	<tr>
		<td>Nama</td>
		<td><input name="nama_mhs" value="<?php echo $nama; ?>" type="text" readonly="readonly"   size="35" class="input-read-only"/></td>
		<td>IP Semester Lalu/Beban Study Maks</td>
		<td><input name="ip" value="<?php echo $ipk; ?>" type="text" size="10" readonly="readonly" class="input-read-only" />
		/ <input name="beban_study" value="<?php echo $beban_studi; ?>" type="text" size="10" readonly="readonly" class="input-read-only" />
		</td>
				
	</tr>
	<tr>
		<td>Jurusan</td>
		<td><input name="jurusan" value="<?php echo $jurusan; ?>" type="text" readonly="readonly"  size="35" class="input-read-only" /></td>

		<td>Program Kelas</td>
		<td><input name="program" value="<?php echo $program; ?>" type="text" readonly="readonly"  size="35" class="input-read-only" />		
		</td>		
		
	</tr>
		<tr>
		<td>Dosen Wali</td>
		<td>	
		<input name="dosen_wali" value="<?php echo $dosen_wali; ?>" type="text" readonly="readonly"  size="35" class="input-read-only" />
		</td>

		<td>Semester yang akan ditempuh (*)</td>
		<td><input name="semester" value="<?php echo $smt_skr; ?>" type="text"  readonly="readonly"  size="35" class="input-read-only"/>
		</td>
	</tr>
	</table>
	<table border="1" width="100%" style="border-collapse: collapse; font-size:12px;" cellpadding="5">

	<td colspan="12" align="center" bgcolor="#fff" style="text-transform:uppercase;"><strong>Mata Kuliah yang Akan Ditempuh Pada Semester Ini :</strong></td>
	</tr>
	<tr>
	<td align="center">Kode MK</td>
	<td align="center">Mata Kuliah</td>
	<td align="center">Smstr</td>	
	<td align="center">SKS</td>
	<td align="center">Dosen</td>
	<td align="center">Kelas</td>
	<td align="center">Jadwal</td>
	<td align="center">Quota</td>
	<td align="center">Peserta</td>
	<td align="center">Calon Peserta</td>
	<?php
	if($status=='0')
	{
		echo '<td align="center">Batalkan</td>';
	}
	?>
	</tr>


<?php
	$state_app = 0;
	$no=1;
	$tot_sks = 0;
	foreach ($detailfrs->result_array() as $value) 
	{
	$tot_sks += $value['jum_sks'];
		
		echo '<tr class="content">
				<td>'.$value['kd_mk'].'</td>
				<td>'.$value['nama_mk'].'</td>
				<td>'.$value['semester'].'</td>
				<td>'.$value['jum_sks'].'</td>';
				
		echo '<td>'.$value['nama_dosen'].'</td>
				<td align="center">'.$value['kelas'].'</td>
				<td align="center">'.$value['jadwal'].'</td>
				<td align="center">'.$value['kapasitas'].'</td>
				<td align="center">'.$value['Peserta'].'</td>
				<td align="center">'.$value['CalonPeserta'].'</td>';
			if($status=='0')
			{
				echo '<td align="center">
				<a class="delbutton" id="'.$value['nim'].'|'.$value['kd_jadwal'].'" href="#"><div id="box-link">Batalkan</div></a>
				</td>';
			}
	}
	echo '<tr><td colspan=3>Total SKS Yang Akan Ditempuh :</td><td colspan=8 id="jmlcart"><b>'.$tot_sks.' SKS</b></td></tr>';
?>
	</table>