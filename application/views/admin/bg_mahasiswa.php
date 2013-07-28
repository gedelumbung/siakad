<link href="<?php echo base_url(); ?>asset/css/jquery.fancybox-1.3.4.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>asset/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>asset/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>asset/js/jquery.fancybox-1.3.4.pack.js"></script>
<script type="text/javascript">
		$(document).ready(function() {
			$("a[rel=example_group]").fancybox({
				'height'			: '75%',
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
	<h1>Daftar Mahasiswa Sistem Informasi Akademik Online</h1>

	<div id="body">
		<?php
			echo $bio;
			echo $menu;
		?>
		<div class="cleaner_h10"></div>
		
		
	<table border="1" width="100%" style="border-collapse: collapse; font-size:12px;" cellpadding="5">

	<td colspan="12" align="center" bgcolor="#fff" style="text-transform:uppercase;"><strong>DAFTAR MAHASISWA</strong></td>
	</tr>
	<tr>
	<td align="center">NIM</td>
	<td align="center">Nama Mahasiswa</td>
	<td align="center">Angkatan</td>	
	<td align="center">Jurusan</td>	
	<td align="center">Kelas Program</td>
	<td align="center" colspan="2">
	<?php
		echo '<a href="'.base_url().'admin/tambah_mahasiswa" rel="example_group" class="link" style="float:left;">Tambah Mahasiswa</a>';
	?>
	</td>
	</tr>
	
	<?php
		foreach($mahasiswa->result_array() as $d)
		{
		?>
			<tr>
			<td align="center"><?php echo $d['nim']; ?></td>	
			<td align="center"><?php echo $d['nama_mahasiswa']; ?></td>
			<td align="center"><?php echo $d['angkatan']; ?></td>
			<td align="center"><?php echo $d['jurusan']; ?></td>
			<td align="center"><?php echo $d['kelas_program']; ?></td>	
			<td align="center" width="60">
			<?php
			echo '<a href="'.base_url().'admin/edit_mahasiswa/'.$d['nim'].'" rel="example_group" class="link" style="float:left;">Edit</a>
				</td>
				<td align="center" width="60">
				<a href="'.base_url().'admin/hapus_mahasiswa/'.$d['nim'].'"
				onClick=\'return confirm("Anda yakin...??")\' class="link" style="float:left;">Hapus</a>';
			?>
			</td>	
			</tr>
		<?php
		}
	?>
	
	</table>
	<?php
		echo $paginator;
	?>


	</div>
