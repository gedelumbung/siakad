<link href="<?php echo base_url(); ?>asset/css/jquery.fancybox-1.3.4.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>asset/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>asset/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>asset/js/jquery.fancybox-1.3.4.pack.js"></script>
<script type="text/javascript">
		$(document).ready(function() {
			$("a[rel=example_group]").fancybox({
				'height'			: '70%',
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
	<h1>Daftar Mata Kuliah Sistem Informasi Akademik Online</h1>

	<div id="body">
		<?php
			echo $bio;
			echo $menu;
		?>
		<div class="cleaner_h10"></div>
		
		
	<table border="1" width="100%" style="border-collapse: collapse; font-size:12px;" cellpadding="5">

	<td colspan="12" align="center" bgcolor="#fff" style="text-transform:uppercase;"><strong>DAFTAR MATA KULIAH</strong></td>
	</tr>
	<tr>
	<td align="center">Kode MK</td>
	<td align="center">Nama MK</td>
	<td align="center">Jumlah SKS</td>
	<td align="center">Semester</td>	
	<td align="center">Jurusan</td>	
	<td align="center" colspan="3" width="50">
	<?php
		echo '<a href="'.base_url().'admin/tambah_mk" rel="example_group" class="link" style="float:left;">Tambah Mata Kuliah</a>';
	?>
	</td>
	</tr>
	
	<?php
		foreach($mk->result_array() as $d)
		{
		?>
			<tr>
			<td align="center"><?php echo $d['kd_mk']; ?></td>
			<td align="center"><?php echo $d['nama_mk']; ?></td>
			<td align="center"><?php echo $d['jum_sks']; ?></td>
			<td align="center"><?php echo $d['semester']; ?></td>
			<td align="center"><?php echo $d['kode_jur']; ?></td>	
			<?php 
			echo '<td align="center" width="10"><a href="'.base_url().'admin/mk_dosen/'.$d['kd_mk'].'" class="link" style="float:left;">Dosen</a></td>
			<td align="center" width="10"><a href="'.base_url().'admin/edit_mk/'.$d['kd_mk'].'" rel="example_group" class="link" 
			style="float:left;">Edit</a>
			</td>
			<td align="center" width="10">
			<a href="'.base_url().'admin/hapus_mk/'.$d['kd_mk'].'"
			onClick=\'return confirm("Anda yakin...??")\' class="link" style="float:left;">Hapus</a>
			</td>';
			?>
			</tr>
		<?php
		}
	?>
	
	</table>


	</div>
