<link href="<?php echo base_url(); ?>asset/css/jquery.fancybox-1.3.4.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>asset/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>asset/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>asset/js/jquery.fancybox-1.3.4.pack.js"></script>
<script type="text/javascript">
		$(document).ready(function() {
			$("a[rel=example_group]").fancybox({
				'height'			: '70%',
				'width'				: '70%',
				'transitionIn'		: 'fade',
				'transitionOut'		: 'fade',
				'overlayColor'		: '#000',
				'overlayOpacity'	: 0.9,
				'type'              : 'iframe',
				'showNavArrows'   : false
			});});
</script>
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
	if(parseInt(document.getElementById(idSKS).innerHTML)>0)
		document.datafrs.tombolsimpan.disabled=false;
	else
		document.datafrs.tombolsimpan.disabled=true;
}
</script>
<div id="container">
	<h1>Kartu Rencana Studi - Sistem Informasi Akademik Online</h1>

	<div id="body">
		<?php
			echo $bio;
			echo $menu;
		?>
		<div class="cleaner_h10"></div>
		<?php echo $this->session->flashdata('save_krs'); ?>
<form name="datafrs" id="datafrs" method="POST" action="<?php echo base_url(); ?>mahasiswa/simpan_krs">

	<table border="0" width="100%" cellpadding="7" cellspacing="0" style="border-collapse: collapse;">
	<tr>
		<td>NIM</td>
		<td><input name="nim" value="<?php echo $nim; ?>" type="text" readonly="readonly"  size="35" class="input-read-only"/></td>
		<td>Semester, Tahun Ajaran</td>
		<td><input name="smstr_thn_ajaran" value="<?php echo $tahun_ajaran; ?>" type="text" readonly="readonly"  size="35" class="input-read-only" /></td>
	</tr>
	<tr>
		<td>Nama</td>
		<td><input name="nama_mhs" value="<?php echo $nama; ?>" type="text" readonly="readonly"   size="35" class="input-read-only"/></td>
		<td>IP Semester Lalu/Beban Study Maks</td>
		<td><input name="ip" value="<?php echo $ipk; ?>" type="text" size="10" readonly="readonly" class="input-read-only" />
		/ <input name="beban_study" value="<?php echo $beban_studi; ?>" type="text" size="10" readonly="readonly" class="input-read-only" />
		</td>
				
	</tr>
	<tr>
		<td>Jurusan</td>
		<td><input name="jurusan" value="<?php echo $jurusan; ?>" type="text" readonly="readonly"  size="35" class="input-read-only" /></td>

		<td>Program Kelas</td>
		<td><input name="program" value="<?php echo $program; ?>" type="text" readonly="readonly"  size="35" class="input-read-only" />		
		</td>		
		
	</tr>
		<tr>
		<td>Dosen Wali</td>
		<td>	
		<input name="dosen_wali" value="<?php echo $dosen_wali; ?>" type="text" readonly="readonly"  size="35" class="input-read-only" />
		</td>

		<td>Semester yang akan ditempuh (*)</td>
		<td><input name="semester" value="<?php echo $smt_skr; ?>" type="text"  readonly="readonly"  size="35" class="input-read-only"/>
		</td>
	</tr>
	</table>
		<table border="1" width="100%" style="border-collapse: collapse;" cellpadding="5">
		<td colspan="12" align="center" bgcolor="#fff" style="text-transform:uppercase;"><strong>Mata Kuliah yang Akan Ditempuh Pada Semester Ini :</strong></td>
		</tr>
		<th align="center">Kode MK</th>
		<th align="center">Mata Kuliah</th>
		<th align="center">Smstr</th>	
		<th align="center">SKS</th>
		<th align="center" colspan="2">Dosen</th>
		<th align="center">Kelas</th>
		<th align="center">Jadwal</th>
		<th align="center">Quota</th>
		<th align="center">Peserta</th>
		<th align="center">Calon Peserta</th>
		<th align="center">*</th>
			<?php Tampilkan_Mata_Kuliah($jadwal); ?>
		</table>
		<?php Tampilkan_Detail_Frs($detail_krs); ?>	
		<p><input name="tombolsimpan" class="btn-kirim-login" type="submit" value="Simpan Data Kartu Rencana Studi" disabled=true; /></p>	
		</form>
	</div>
	
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
	<strong>Total Beban Study yang Akan Ditempuh </strong>
	<input id="idJumlahSKS" name="jumlahsks" value="'.$totalsks.'" type="text" size="2" style="background-color: #fff;" readonly="readonly"/>	
	<strong>SKS</strong>	
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
		if(($temp=='') || ($value['kd_mk']!=$temp)) {			
			$rows[$index] = '<tr>
				<td align="center" rowspan="1">'.$value['kd_mk'].'</td>
				<td rowspan="1" id="'.'nama_'.$value['kd_mk'].'">'.$value['nama_mk'].'</td>
				<td align="center" rowspan="1">'.$value['semester'].'</td>
				<td align="center" rowspan="1" id="id'.$value['kd_mk'].'">'.$value['jum_sks'].'</td>';
				
				$rowspan=1;				
				$acuan=$index;
			}else if($value['kd_mk']==$temp) {
				$rows[$index] = '<tr>';
				$rowspan++;
			}

			$rows[$acuan]=str_replace('rowspan="'.($rowspan-1).'"', 'rowspan="'.$rowspan.'"', $rows[$acuan]);
			$peserta = isset($value['Peserta']) ? $value['Peserta']:'0';
			$calonpeserta = isset($value['CalonPeserta']) ? $value['CalonPeserta']:'0';
		
			$disabled ='';
			if($peserta >= $value['kapasitas'])
				$disabled ='disabled="disabled"';
			
			$linkpeserta = $peserta;
			if($peserta >0)
			$linkpeserta = '<a href="'.base_url().'mahasiswa/peserta/'.$value['kd_jadwal'].'_1
			/" title="Daftar Peserta Mata Kuliah '.$value['nama_mk'].'  -  Dosen '.$value['nama_dosen'].'" rel="example_group" class="link2">'
				.$peserta.'</a>';
				
			$linkcalonpeserta = $calonpeserta;
			if($calonpeserta >0)
			$linkcalonpeserta = '<a href="'.base_url().'mahasiswa/peserta/'.$value['kd_jadwal'].'_0
			/" title="Daftar Calon Peserta Mata Kuliah '.$value['nama_mk'].'  -  Dosen '.$value['nama_dosen'].'" rel="example_group" class="link2">	
			'.$calonpeserta.'</a>';
						
			$rows[$index] .='<td id="'.'cell_'.$value['kd_mk'].'_'.$value['kelas'].'">'.$value['kd_dosen'].'</td><td>'.$value['nama_dosen'].'</td>
				<td align="center">'.$value['kelas'].'</td>
				<td align="center" id="jdwl_'.$value['kd_jadwal'].'">'.$value['jadwal'].'</td>
				<td align="center">'.$value['kapasitas'].'</td>
				<td align="center">'.$linkpeserta.'</td>
				<td align="center">'.$linkcalonpeserta.'</td>
				<td align="center">
				<input type="checkbox" name="chk_'.$value['kd_mk'].'_'.$value['kd_jadwal'].'" value="ON" onchange="javascript:PilihMataKuliah(this);" '.$disabled.'/></td></tr>';
			$index++;
			$temp=$value['kd_mk'];
	}		
	foreach($rows as $row)
	{
		echo str_replace('rowspan="1"', '', $row);
	}
}
?>
