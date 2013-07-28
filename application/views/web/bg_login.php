<div id="container">
	<h1>Selamat Datang di Sistem Informasi Akademik Online</h1>

	<div id="body">
		<p>Silahkan login untuk mengakses informasi akademik.</p>
		<?php echo form_open('web/login'); ?>
		<div id="bg-line">
		Username : 
		<?php echo form_input($username); ?>
		Password : 
		<?php echo form_input($password); ?>
		<?php echo form_submit('submit', 'Log In', ' class="btn-kirim-login"');?> 
		<?php echo form_reset('submit', 'Hapus',' class="btn-kirim-login"');?>
		</div>
		<?php echo form_close(); ?>
	</div>
