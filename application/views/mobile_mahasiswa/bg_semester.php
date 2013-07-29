
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
	<br>
	<ul data-role="listview" data-theme="c" data-dividertheme="a"> 
	<?php
	$st='';
	$tot_nxb=0;	
	$tot_sks=0;
	$no=1;
	foreach($khs->result_array() as $value)
	{
		echo '<li data-theme="a"><a href="'.base_url().'web_mobile/detail_transkrip/'.$value['semester_ditempuh'].'">Semester '.$value['semester_ditempuh'].'</a></li> ';
	}
	
	?>
	<li data-role="list-divider"></li>
	</ul>
	<br>
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

