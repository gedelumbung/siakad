
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
		if($st=='')
		{
			$simpan[]='<li data-theme="a">Semester '.$value['semester_ditempuh'].'<span class="ui-li-count">NILAI-SKS-SMT</span></li> <li>'. $value['nama_mk'].'
			<span class="ui-li-count">'. $value['grade'].' ----- '.$value['semester_ditempuh'].' ----- 
			'. $value['jum_sks'].'</span></li>';
			$no++;
			$tot_nxb=0;
			$tot_sks=0;
		}
		else if($value['semester_ditempuh']!=$st)
		{
			$ip = 0;
			if($tot_nxb !=0)			
				$ip = round($tot_nxb/$tot_sks, 2);			
			$simpan[]='<li data-role="list-divider"> SKS : '.$tot_sks.' - IP Semester : '.$ip.'</li>
			<li></li>';

			$simpan[]='<li data-theme="a">Semester '.$value['semester_ditempuh'].'<span class="ui-li-count">NILAI-SKS-SMT</span></li> <li>'. $value['nama_mk'].'
			<span class="ui-li-count">'. $value['grade'].' ----- '.$value['semester_ditempuh'].' ----- 
			'. $value['jum_sks'].'</span></li>';
			$no++;
			$tot_nxb =0;
			$tot_sks=0;
		}		
		else 
		{ 
			$simpan[]='<li>'. $value['nama_mk'].'
			<span class="ui-li-count">'. $value['grade'].' ----- '.$value['semester_ditempuh'].' ----- 
			'. $value['jum_sks'].'</span></li>';
			$no++;
					
		}
		if($value['grade'] != 'T') 
		{
			$tot_nxb +=$value['NxH'];
			$tot_sks+=$value['jum_sks'];
		}
		$st=$value['semester_ditempuh'];	
	}
	$ip = 0;
	if($tot_nxb !=0)			
		$ip = round($tot_nxb/$tot_sks, 2);
	$simpan[]='<li data-role="list-divider"> SKS : '.$tot_sks.' - IP Semester : '.$ip.'</li>
			<li></li>';

	foreach($simpan as $tampil)
	{
		echo $tampil;
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

