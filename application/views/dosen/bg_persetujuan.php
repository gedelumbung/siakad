<link href="<?php echo base_url(); ?>asset/css/jquery.fancybox-1.3.4.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>asset/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>asset/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>asset/js/jquery.fancybox-1.3.4.pack.js"></script>
<script type="text/javascript">
		$(document).ready(function() {
			$("a[rel=example_group]").fancybox({
				'height'			: '95%',
				'width'				: '70%',
				'transitionIn'		: 'fade',
				'transitionOut'		: 'fade',
				'overlayColor'		: '#000',
				'overlayOpacity'	: 0.9,
				'type'              : 'iframe',
				'showNavArrows'   : false,
				'hideOnOverlayClick': false,
				'onClosed'          : function() {
									  parent.location.reload(true);
									  }
			});});
</script>
<div id="container">
	<h1>Persetujuan KRS - Sistem Informasi Akademik Online</h1>

	<div id="body">
		<?php
			echo $bio;
			echo $menu;
		?>
		<div class="cleaner_h10"></div>
		<table border="1" cellpadding="5" cellspacing="0" width="100%" style="border-collapse: collapse;">
		<tr bgcolor="#FFFFFF" align="center">
		<td height=27>No.</td><td>NIM</td><td>Nama Mahasiswa</td><td>Jurusan</td><td>Program Kelas</td><td>Status Persetujuan</td><td>SKS</td><td width=75>Detail KRS</td>
		</tr>
		<?php
			$no=1;
			foreach($mhs->result_array() as $k)
			{
					$st = "";
					if($k['status']=='0'){ 
						$st = "Belum Disetujui"; 
						$warna = "#ccc";
						$link = base_url().'dosen/detail_krs/'.$k['nim'].'/'.$k['status'];
						$cf = "example_group";
					} 
					else if($k['status']=='1') {
						$st = "Sudah Disetujui"; 
						$warna = "";
						$link = base_url().'dosen/detail_krs/'.$k['nim'].'/'.$k['status'];
						$cf = "example_group";
					}
					else if($k['status']==NULL) {
						$st = "Belum KRS"; 
						$warna = "#999";
						$link = '#';
						$cf = "";
					}
					echo'<tr bgcolor="'.$warna.'">
					<td align="center">'.$no.'</td><td>'.$k['nim'].'</td><td>'.$k['nama_mahasiswa'].'</td><td>'.$k['jurusan'].'</td><td align="center">
					'.$k['kelas_program'].'</td><td align="center">'.$st.'</td>';
		
					echo'<td>'.$k['j_sks'].'</td><td>
					<a class="link" href="'.$link.'" title="Detail Kartu Rencana Studi - '.$k[
					'nama_mahasiswa'].'" rel="'.$cf.'">Cek Detail</a></td>
					</tr>';
					$no++;
			}
		?>
		</table>
		
	</div>
