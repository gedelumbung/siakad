
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
	<div data-role="collapsible-set" data-theme="a" data-content-theme="c">
   	<?php
	foreach($jadwal->result_array() as $d)
	{

		echo '<div data-role="collapsible">
		<h3>'.$d['nama_mk'].'</h3>
		<p>
		<table>
			<tr valign="top"><td width=100>Kode MK</td><td width=10> : </td><td>'.$d['kd_mk'].'</td></tr>
			<tr valign="top"><td>Mata Kuliah</td><td> : </td><td>'.$d['nama_mk'].'</td></tr>
			<tr valign="top"><td>Nama Dosen</td><td> : </td><td>'.$d['nama_dosen'].'</td></tr>
			<tr valign="top"><td>Kode Dosen</td><td> : </td><td>'.$d['kd_dosen'].'</td></tr>
			<tr valign="top"><td>Semester</td><td> : </td><td>'.$d['semester'].'</td></tr>
			<tr valign="top"><td>Jumlah SKS</td><td> : </td><td>'.$d['jum_sks'].'</td></tr>
			<tr valign="top"><td>Jadwal</td><td> : </td><td>'.$d['jadwal'].'</td></tr>
			</table>
		</p>
		</div>';
	}
	?>
	</div>
	<br />
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
			<li><a href="<?php echo base_url(); ?>web_mobile/home" data-role="button" data-theme="a" data-icon="home">Beranda</a></li>
			<li><a href="<?php echo base_url(); ?>web_mobile/jadwal" data-role="button" data-theme="a" data-icon="grid">Jadwal Kuliah</a></li>
			<li><a href="<?php echo base_url(); ?>web_mobile/logout" data-role="button" data-theme="a" data-icon="delete">Log Out</a></li>
		</ul>
	</div>
      <h1>SIAKAD STIKOM PGRI Banyuwangi - 2012</h1>
   </footer>

 </div>
 <!-- /page -->
</body>
</html>

