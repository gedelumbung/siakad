<link href="<?php echo base_url(); ?>asset/css/jquery.fancybox-1.3.4.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>asset/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>asset/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>asset/js/jquery.fancybox-1.3.4.pack.js"></script>
<script type="text/javascript">
		$(document).ready(function() {
			$("a[rel=example_group]").fancybox({
				'height'			: '50%',
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
	<h1>Daftar Dosen Sistem Informasi Akademik Online</h1>

	<div id="body">
		<?php
			echo $bio;
			echo $menu;
		?>
		<div class="cleaner_h10"></div>
		
		
	<table border="1" width="100%" style="border-collapse: collapse; font-size:12px;" cellpadding="5">

	<td colspan="12" align="center" bgcolor="#fff" style="text-transform:uppercase;"><strong>DAFTAR DOSEN</strong></td>
	</tr>
	<tr>
	<td align="center">Kode Dosen</td>
	<td align="center">NIDN</td>
	<td align="center">Nama Dosen</td>	
	<td align="center" colspan="3" width="50">
	<?php
		echo '<a href="'.base_url().'admin/tambah_dosen" rel="example_group" class="link" style="float:left;">Tambah Dosen</a>';
	?>
	</td>
	</tr>
	
	<?php
		foreach($dosen->result_array() as $d)
		{
		?>
			<tr>
			<td align="center"><?php echo $d['kd_dosen']; ?></td>
			<td align="center"><?php echo $d['nidn']; ?></td>
			<td align="center"><?php echo $d['nama_dosen']; ?></td>	
			<?php 
			echo '<td align="center" width="10"><a href="'.base_url().'admin/dosen_mk/'.$d['kd_dosen'].'" class="link" style="float:left;">MK</a></td>
			<td align="center" width="10"><a href="'.base_url().'admin/edit_dosen/'.$d['kd_dosen'].'" rel="example_group" class="link" 
			style="float:left;">Edit</a>
			</td>
			<td align="center" width="10">
			<a href="'.base_url().'admin/hapus_dosen/'.$d['kd_dosen'].'"
			onClick=\'return confirm("Anda yakin...??")\' class="link" style="float:left;">Hapus</a>
			</td>';
			?>
			</tr>
		<?php
		}
	?>
	
	</table>


	</div>
