
<div id="container">
	<h1>Daftar Mata Kuliah Sistem Informasi Akademik Online</h1>

	<div id="body">
		<?php
			echo $bio;
			echo $menu;
		?>
		<div class="cleaner_h10"></div>
	<?php echo $this->session->flashdata('save_akun'); ?>
		
	<form method="post" action="<?php echo base_url(); ?>mahasiswa/simpan_akun">
	<table border="1" width="100%" style="border-collapse: collapse; font-size:12px;" cellpadding="5">

	<tr>
		<td>Password Lama</td>
		<td>:</td>
		<td><input type="text" name="pass_lama" /></td>
	</tr>
	<tr>
		<td>Password Baru</td>
		<td>:</td>
		<td><input type="text" name="pass_baru" /></td>
	</tr>
	<tr>
		<td>Ulangi Password Baru</td>
		<td>:</td>
		<td><input type="text" name="ulangi_pass" /></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td><input type="submit" value="Simpan Data" /></td>
	</tr>
		
	
	</table>
	</form>


	</div>
