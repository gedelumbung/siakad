
   <!-- /navbar -->
   <!-- /header -->

   <div data-role="content">
   <ul data-role="listview" data-inset="true" data-theme="c" data-dividertheme="a"> 
			<li data-role="list-divider">Selamat Datang</li> 
			<li>Nama : <?php echo $nama; ?></li>
			<li>NIM : <?php echo $nim; ?></li>
			<li>Prodi : <?php echo $jurusan; ?></li>
			<li data-role="list-divider"></li>
	</ul>
	<?php echo $pesan; ?>
   	<form method="post" action="<?php echo base_url(); ?>web_mobile/simpan_akun">
	
		<div data-role="fieldcontain">
		<label for="name">Password Lama :</label>
		<input type="password" name="pass_lama" id="name"  />
    	<label for="password">Password Baru :</label>
    	<input type="password" name="pass_baru" id="password" />
    	<label for="password">Ulangi Password :</label>
    	<input type="password" name="ulangi_pass" id="password" />
		<fieldset class="ui-grid-a">
		<div class="ui-block-a"><input type="submit" value="Ganti" data-icon="arrow-r" data-theme="a"></div>
		<div class="ui-block-b"><input type="reset" value="Hapus" data-icon="delete" data-theme="c"></div>	   
	</fieldset>
		
		</div>	
	</form>
		<ul data-role="listview" data-inset="true" data-theme="c" data-dividertheme="a"> 
			<li data-role="list-divider">Bantuan / Support</li> 
			<li>NB : Hubungi bagian SISFO Kampus jika mengalami kesulitan proses log in atau permasalahan teknis lainnya</li> 
			<li>Kecepatan akses {elapsed_time} detik</li>
			<li data-role="list-divider"></li>
		</ul> 
   </div>

   <footer data-role="footer" data-theme="a">
   <div data-role="navbar" data-theme="a">
		<ul>
			<li><a href="<?php echo base_url(); ?>web_mobile/transkrip" data-role="button" data-theme="a" data-icon="home">Transkrip</a></li>
			<li><a href="<?php echo base_url(); ?>web_mobile/khs" data-role="button" data-theme="a" data-icon="grid">KHS</a></li>
			<li><a href="<?php echo base_url(); ?>web_mobile/logout" data-role="button" data-theme="a" data-icon="delete">Log Out</a></li>
		</ul>
	</div>
      <h1>SIAKAD STIKOM PGRI Banyuwangi - 2012</h1>
   </footer>

 </div>
 <!-- /page -->
</body>
</html>

