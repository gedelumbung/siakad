<style>
	.pagingpage-nomor{
		background-color: #fff;
		text-align:center;
		width:20px;
		padding: 8px;
		border: 1px solid #CCCCCC;
		float:left;
		margin:1px;
	}
	.pagingpage-nomor a{
		text-decoration:none;
	}
	.pagingpage-nomor a:hover{
		text-decoration:underline;
	}
	
	.pagingpage{
		background-color: #fff;
		padding: 8px;
		border: 1px solid #CCCCCC;
		float:left;
		margin:1px;
	}
	.pagingpage a{
		text-decoration:none;
	}
	.pagingpage a:hover{
		text-decoration:underline;
	}
</style>
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
	foreach($info->result_array() as $i)
	{

		echo '<div data-role="collapsible">
		<h3>'.$i['judul'].'</h3>
		<p>
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr><td>'.nama_hari($i['waktu_post']).', '.tgl_indo($i['waktu_post']).'</td></tr>
			<tr><td><strong>'.$i['judul'].'</strong></td></tr>
			<tr><td>'.$i['isi'].'</td></tr>
		</table>
		</p>
		</div>';
	}
	echo $paginator;
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

