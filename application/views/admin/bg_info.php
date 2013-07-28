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
	<h1>Info Kampus - Sistem Informasi Akademik Online</h1>

	<div id="body">
		<?php
			echo $bio;
			echo $menu;
		?>
		<div class="cleaner_h10"></div>
	<a href="<?php echo base_url(); ?>admin/tambah_info/" rel="example_group" class="link" style="float:left;">Tambah Info</a>
	<?php
		foreach($info->result_array() as $i)
		{
			?>
			<table border="0" cellpadding="5" cellspacing="0" width="100%">
				<tr>
					<td>
						<h5><?php echo nama_hari($i['waktu_post']).', '.tgl_indo($i['waktu_post']); ?></h5>
						<h4><?php echo $i['judul']; ?></h4>
						<?php echo $i['isi']; ?>
					</td>
				</tr>
				<tr>
					<td>
					<?php
					echo '<a href="'.base_url().'admin/edit_info/'.$i['kd_info'].'" rel="example_group" class="link" style="float:left;">Edit</a>
						<a href="'.base_url().'admin/hapus_info/'.$i['kd_info'].'"
						onClick=\'return confirm("Anda yakin...??")\' class="link" style="float:left;">Hapus</a>';
					?>
						<div class="line-dot"></div>
					</td>
				</tr>
			</table>
			<?php
		}
		echo $paginator;
	?>
		
	</div>
