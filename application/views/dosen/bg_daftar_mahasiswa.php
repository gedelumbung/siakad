
<div id="container">
	<h1>Input Nilai - Sistem Informasi Akademik Online</h1>

	<div id="body">
		<?php
			echo $bio;
			echo $menu;
		?>
		<div class="cleaner_h10"></div>
		<table border="1" cellpadding="5" cellspacing="0" width="100%" style="border-collapse: collapse;">
		<tr bgcolor="#FFFFFF" align="center">
		<td height=27>No.</td><td>NIM</td><td>Nama Mahasiswa</td><td>Jurusan</td><td>Program Kelas</td><td>Status Persetujuan</td><td width=100>Masukkan Nilai</td>
		</tr>
		<?php
			$no=1;
			foreach($mhs->result_array() as $k)
			{
					$st = "";
					if($k['status']=='1'){ 
						$st = "Sudah Disetujui"; 
						$warna = "#ccc";
						$link = base_url().'dosen/detail_krs/'.$k['nim'].'/'.$k['status'];
						$cf = "example_group";
					} 
					echo'<tr>
					<td align="center">'.$no.'</td><td>'.$k['nim'].'</td><td>'.$k['nama_mahasiswa'].'</td><td>'.$k['jurusan'].'</td><td align="center">
					'.$k['kelas_program'].'</td><td align="center">'.$st.'</td>';
		
					echo'<td>
					<a class="link" href="'.base_url().'dosen/input_nilai/'.$k['nim'].'" title="Masukkan Nilai - '.$k[
					'nama_mahasiswa'].'">Masukkan Nilai</a></td>
					</tr>';
					$no++;
			}
		?>
		</table>
		
	</div>
