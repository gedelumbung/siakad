<div id="container">
	<h1>Info Kampus - Sistem Informasi Akademik Online</h1>

	<div id="body">
		<?php
			echo $bio;
			echo $menu;
		?>
		<div class="cleaner_h10"></div>
	
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
						<div class="line-dot"></div>
					</td>
				</tr>
			</table>
			<?php
		}
		echo $paginator;
	?>
		
	</div>
