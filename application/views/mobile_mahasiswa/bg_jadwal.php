
   <!-- /navbar -->
   <!-- /header -->

	<script languange="javascript">
function PilihMataKuliah(chk) {
	var jumlahSKS=0;	
	var checkboxdipilih = chk.name;
	var beban=document.datafrs.beban_study.value;
	var temp=document.datafrs.jumlahsks.value;
	for(i=0 ; i<document.datafrs.length; i++) 
	{
		if(document.datafrs[i].value=="ON") 
		{
			if(document.datafrs[i].checked==true)
			{
				c1 = checkboxdipilih.split("_");
				c2 = document.datafrs[i].name.split("_");
				g1 = c1[2]+"|"+c1[2];
				g2 = c2[2]+"|"+c2[2];
				if(c1[1]==c2[1])
				{
					if(document.datafrs[i].name !=checkboxdipilih)
						document.datafrs[i].checked=false;
				}
			}
		}
	}

	for(i=0 ; i<document.datafrs.length; i++) 
	{
		if(document.datafrs[i].value=="ON") 
		{
			if(document.datafrs[i].checked==true)
			{
				parseData= document.datafrs[i].name.split("_");
				idSKS = "id"+parseData[1];
				jumlahSKS +=parseInt(document.getElementById(idSKS).innerHTML);
				if(jumlahSKS > beban) {
					chk.checked=false;
					jumlahSKS = temp;
					alert('Jumlah SKS yang anda ambil tidak boleh lebih dari beban maksimal');
				}
			}
		}
	}

	document.datafrs.jumlahsks.value=jumlahSKS;
	var detailfrs="";
	for(i=0 ; i<document.datafrs.length; i++) 
	{
		if(document.datafrs[i].value=="ON") 
		{
			parseData= document.datafrs[i].name.split("_");
			if(document.datafrs[i].checked==true)
			{
				if(detailfrs=="")
					detailfrs = parseData[2];
				else
					detailfrs += "|"+parseData[2];
			}
		}
	}	
	document.datafrs.detailfrs.value=detailfrs;
}
</script>
<form name="datafrs" id="datafrs" method="POST" action="<?php echo base_url(); ?>web_mobile/simpan_krs">
   <div data-role="content">
   <ul data-role="listview" data-inset="true" data-theme="c" data-dividertheme="a"> 
			<li data-role="list-divider">Selamat Datang</li> 
			<li>Nama : <?php echo $nama; ?></li>
			<li>NIM : <?php echo $nim; ?><input name="nim" value="<?php echo $nim; ?>" type="hidden" /></li>
			<li>Semester : <?php echo $smt_skr; ?><input name="semester" value="<?php echo $smt_skr; ?>" type="hidden" /></li>
			<li>Prodi : <?php echo $jurusan; ?></li>
			<li>Beban SKS Maksimal : <?php echo $beban_studi; ?><input name="beban_study" value="<?php echo $beban_studi; ?>" type="hidden" /></li>
			<li>Dosen Wali : <?php echo $dosen_wali; ?></li>
			<li data-role="list-divider"></li>
	</ul>
			<?php Tampilkan_Mata_Kuliah($jadwal); ?>
		<?php Tampilkan_Detail_Frs($detail_krs); ?>	
		<p><input name="tombolsimpan" class="btn-kirim-login" type="submit" value="Simpan Data KRS"/></p>	
		</form>
	
	
<?php
function Tampilkan_Detail_Frs($frsdetail){
	$valuedetailfrs='';
	$checkboxvalue='';
	$totalsks=0;
	foreach($frsdetail->result_array() as $value){
		if($valuedetailfrs == '')
			$valuedetailfrs .= $value['kd_jadwal'];
		else
			$valuedetailfrs .= "|".$value['kd_jadwal'];
		$checkboxvalue .="document.datafrs.chk_".$value['kd_mk']."_".$value['kd_jadwal'].".checked=true;\n";

		$totalsks += $value['jum_sks'];
	}
	echo '<p class="left">
	<strong>Total Beban Study </strong>
	<input id="idJumlahSKS" name="jumlahsks" value="'.$totalsks.'" type="text" size="2" style="background-color: #fff;" readonly="readonly"/>	
	</p>
	<p><input name="detailfrs" type="hidden" size=100 value="'.$valuedetailfrs.'"/></p>
	<script language="javascript">'.$checkboxvalue.'</script>'; 
}

function Tampilkan_Mata_Kuliah($jdwl)
{
	$rows=array();
	$index=0;
	$temp='';
	$acuan=0;
	$rowspan=1;
	foreach ($jdwl->result_array() as $value) 
	{		
			$rows[$index] = '
			
			<ul data-role="listview" data-inset="true" data-theme="c" data-dividertheme="a"><li data-role="list-divider">'.$value['nama_mk'].'</li><li>
			<div>
			<table border=0 cellpadding=0 cellspacing=0>
				<tr valign="top"><td width="90">Kode MK</td><td width="15">:</td><td id="'.'nama_'.$value['kd_mk'].'">'.$value['kd_mk'].'</td></tr>
				<tr valign="top"><td>Semester</td><td width="15">:</td><td>'.$value['semester'].'</td></tr>
				<tr valign="top"><td>SKS</td><td width="15">:</td><td id="id'.$value['kd_mk'].'">'.$value['jum_sks'].'</td></tr>';
				
			$peserta = isset($value['Peserta']) ? $value['Peserta']:'0';
			$calonpeserta = isset($value['CalonPeserta']) ? $value['CalonPeserta']:'0';
		
			$disabled ='';
			if($peserta >= $value['kapasitas'])
				$disabled ='disabled="disabled"';
			
			$linkpeserta = $peserta;
			if($peserta >0)
			$linkpeserta = $peserta;
				
			$linkcalonpeserta = $calonpeserta;
			if($calonpeserta >0)
			$linkcalonpeserta = $calonpeserta;
						
			$rows[$index] .='
				<tr valign="top"><td>Dosen</td><td width="15">:</td><td>'.$value['nama_dosen'].'</td></tr>
				<tr valign="top"><td>Kelas</td><td width="15">:</td><td>'.$value['kelas'].'</td></tr>
				<tr valign="top"><td>Jadwal</td><td width="15">:</td><td id="jdwl_'.$value['kd_jadwal'].'">'.$value['jadwal'].'</td></tr>
				<tr valign="top"><td>Kapasitas</td><td width="15">:</td><td>'.$value['kapasitas'].'</td></tr>
				<tr valign="top"><td>Peserta</td><td width="15">:</td><td>'.$linkpeserta.'</td></tr>
				<tr valign="top"><td>Calon</td><td width="15">:</td><td>'.$linkcalonpeserta.'</td></tr>
				<tr valign="top"><td>Pilih</td><td width="15">:</td><td>
				<input type="checkbox" name="chk_'.$value['kd_mk'].'_'.$value['kd_jadwal'].'" value="ON" onchange="javascript:PilihMataKuliah(this);" '.$disabled.'/>
				
				</td></tr>	
				</table>
				</div>
				</li>
				<li data-role="list-divider"></li>
				</ul>';
			$index++;
			$temp=$value['kd_mk'];
	}		
	foreach($rows as $row)
	{
		echo str_replace('rowspan="1"', '', $row);
	}
}
?>
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

