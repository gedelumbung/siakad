<body>
 <div data-role="page">
   <header data-role="header" data-theme="a">
     <h1>
       <img src="<?php echo base_url();?>asset/images/title-stikom.png" alt="STIKOM PGRI Banyuwangi" />
     </h1>
	 <div data-role="navbar" data-theme="a">
		<ul>
			<li><a href="<?php echo base_url(); ?>web_mobile/login" data-role="button" data-icon="home">Beranda</a></li>
			<li><a href="#" data-role="button" data-icon="refresh">Refresh</a></li>
		</ul>
	</div>
   </header>
   <!-- /header -->

   <div data-role="content">
  	<?php echo $pesan; ?>
	<?php echo form_open('web_mobile/loginact'); ?>
	
		<div data-role="fieldcontain">
		
		<label for="name">Username :</label>
		<?php echo form_input($username); ?>
		<label for="password">Password :</label>
		<?php echo form_input($password); ?>
		
		<fieldset class="ui-grid-a">
		<div class="ui-block-a"><?php echo form_submit('submit', 'Log In', ' data-icon="arrow-r" data-theme="a"');?></div> 
		<div class="ui-block-b"><?php echo form_reset('submit', 'Hapus',' data-icon="delete" data-theme="c"');?></div>
		</fieldset>
		
		</div>	
	
		<?php echo form_close(); ?>	
		<ul data-role="listview" data-inset="true" data-theme="c" data-dividertheme="a"> 
			<li data-role="list-divider">Bantuan / Support</li> 
			<li>NB : Hubungi bagian SISFO Kampus jika mengalami kesulitan proses log in atau permasalahan teknis lainnya</li> 
			<li>Kecepatan akses {elapsed_time} detik</li>
			<li data-role="list-divider"></li>
		</ul> 
   </div>

   <footer data-role="footer" data-theme="a">
      <h1>SIAKAD STIKOM PGRI Banyuwangi - 2012</h1>
   </footer>

 </div>
 <!-- /page -->
</body>
</html>

