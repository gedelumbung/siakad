<link href="<?php echo base_url(); ?>asset/css/jquery.fancybox-1.3.4.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>asset/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>asset/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>asset/js/jquery.fancybox-1.3.4.pack.js"></script>
<script type="text/javascript">
		$(document).ready(function() {
			$("a[rel=example_group]").fancybox({
				'height'			: '95%',
				'width'				: '70%',
				'transitionIn'		: 'fade',
				'transitionOut'		: 'fade',
				'overlayColor'		: '#000',
				'overlayOpacity'	: 0.9,
				'type'              : 'iframe',
				'showNavArrows'   : false,
				'hideOnOverlayClick': false,
				'onClosed'          : function() {
									  parent.location.reload(true);
									  }
			});});
</script>
<div id="container">
	<h1>Nilai - Kartu Hasil Studi - Sistem Informasi Akademik Online</h1>

	<div id="body">
		<?php
			echo $bio;
			echo $menu;
		?>
		<div class="cleaner_h10"></div>
		
		
			<table border="1" width="100%" style="border-collapse: collapse; font-size:12px;" cellpadding="5">

	<td colspan="12" align="center" bgcolor="#fff" style="text-transform:uppercase;"><strong>Mata Kuliah Yang Akan Diinputkan Nilainya :</strong></td>
	</tr>
	<tr style="background-color:#000; color:#FFFFFF;">
	<td align="center">Kode MK</td>
	<td align="center">Mata Kuliah</td>
	<td align="center">Smstr</td>	
	<td align="center">SKS</td>
	<td align="center">Dosen</td>
	<td align="center">Kelas</td>
	<td align="center">Jadwal</td>
	<td align="center">Quota</td>
	<td align="center">Peserta</td>
	<td align="center">*</td>
	<?php
	if($status=='0')
	{
		echo '<td align="center">Batalkan</td>';
	}
	?>
	</tr>


<?php
	$no=1;
	$tot_sks = 0;
	foreach ($detailfrs->result_array() as $value) 
	{
	$tot_sks += $value['jum_sks'];
		
		echo '<tr class="content">
				<td>'.$value['kd_mk'].'</td>
				<td>'.$value['nama_mk'].'</td>
				<td>'.$value['semester'].'</td>
				<td>'.$value['jum_sks'].'</td>';
				
		echo '<td>'.$value['nama_dosen'].'</td>
				<td align="center">'.$value['kelas'].'</td>
				<td align="center">'.$value['jadwal'].'</td>
				<td align="center">'.$value['kapasitas'].'</td>
				<td align="center">'.$value['Peserta'].'</td>
				<td align="center"><a href="'.base_url().'admin/form_input_nilai/'.$value['nim'].'/'.$value['kd_jadwal'].'" class="link"
				rel="example_group">Input</a></td>';
			if($status=='0')
			{
				echo '<td align="center">
				<a class="delbutton" id="'.$value['nim'].'|'.$value['kd_jadwal'].'" href="#"><div id="box-link">Batalkan</div></a>
				</td>';
			}
	}
	echo '<tr><td colspan=3>Total SKS Yang Akan Ditempuh :</td><td colspan=8 id="jmlcart"><b>'.$tot_sks.' SKS</b></td></tr>';
?>
	</table>
		
		
		<div class="cleaner_h40"></div>
		<?php 
		$temp='';
		$rows=array();
		$totalNH=0;	
		$totalSKS=0;
		$no=1;
		?>
		<table border="1" width="100%" style="border-collapse: collapse;" cellpadding="5">
		<tr><td colspan="12" align="center" bgcolor="#fff" style="text-transform:uppercase;"><strong>Mata Kuliah yang Tersimpan :</strong></td></tr>
		<tr style="background-color:#000; color:#FFFFFF;">
		<td align="center">No</td>
		<td align="center">Kode Mata Kuliah</td>
		<td align="center">Mata Kuliah</td>
		<td align="center">Semester</td>
		<td align="center">SKS</td>
		<td align="center">Nilai</td>	
		<td align="center">Bobot</td>
		<td align="center">SKS x Bobot</td>
		<td colspan="2">Aksi</td>
		</tr>
		<?php
		foreach($khs->result_array() as $value)
		{
			if($temp=='')
			{
				$rows[]='<tr>
				<td colspan="10" bgcolor="#fff"><strong>Semester : '.$value['semester_ditempuh'].'</strong></td>
				</tr>';
				$rows[]='<tr>
				<td>'. $no.'</td>
				<td>'. $value['kd_mk'].'</td>
				<td>&nbsp;'. $value['nama_mk'].'</td>
				<td align="center">'. $value['semester_ditempuh'].'</td>
				<td align="center">'. $value['jum_sks'].'&nbsp;</td>
				<td align="center">'. $value['grade'].'</td>
				<td align="center">'. $value['bobot'].'</td>
				<td align="center">'. $value['NxH'].'</td>
				<td align="center"><a href="'.base_url().'admin/edit_nilai/'.$value['nim'].'/'.$value['kd_mk'].'" class="link"
				rel="example_group">Edit</a></td>
				<td align="center"><a href="'.base_url().'admin/hapus_nilai/'.$value['nim'].'/'.$value['kd_mk'].'" class="link"
				onClick=\'return confirm("Anda yakin...??")\'>Hapus</a></td>';
				$no++;
				$totalNH=0;
				$totalSKS=0;
			}
			else if($value['semester_ditempuh']!=$temp)
			{
				$ip = 0;
				if($totalNH !=0)			
					$ip = round($totalNH/$totalSKS, 2);			
				$rows[]='<tr>
				<td colspan="6"><strong>Jumlah SKS : '.$totalSKS.'</strong></td>
				<td colspan="6"><strong>IP Semester : '.$ip.'</strong></td>';
	
				$rows[]='<tr>
				<td colspan="10" bgcolor="#fff"><strong>Semester : '.$value['semester_ditempuh'].'</strong></td>
				</tr>';
	
				$rows[]='<tr>
				<td>'. $no.'</td>
				<td>'. $value['kd_mk'].'</td>
				<td>&nbsp;'. $value['nama_mk'].'</td>
				<td align="center">'. $value['semester_ditempuh'].'</td>
				<td align="center">'. $value['jum_sks'].'&nbsp;</td>
				<td align="center">'. $value['grade'].'</td>
				<td align="center">'. $value['bobot'].'</td>
				<td align="center">'. $value['NxH'].'</td>
				<td align="center"><a href="'.base_url().'admin/edit_nilai/'.$value['nim'].'/'.$value['kd_mk'].'" class="link"
				rel="example_group">Edit</a></td>
				<td align="center"><a href="'.base_url().'admin/hapus_nilai/'.$value['nim'].'/'.$value['kd_mk'].'" class="link"
				onClick=\'return confirm("Anda yakin...??")\'>Hapus</a></td>
			</tr>';
			$no++;
			
				$totalNH =0;
				$totalSKS=0;
			}		
			else 
			{ 
				$rows[]='<tr>
				<td>'. $no.'</td>
				<td>'. $value['kd_mk'].'</td>
				<td>&nbsp;'. $value['nama_mk'].'</td>
				<td align="center">'. $value['semester_ditempuh'].'</td>
				<td align="center">'. $value['jum_sks'].'</td>
				<td align="center">'. $value['grade'].'</td>
				<td align="center">'. $value['bobot'].'</td>
				<td align="center">'. $value['NxH'].'</td>
				<td align="center"><a href="'.base_url().'admin/edit_nilai/'.$value['nim'].'/'.$value['kd_mk'].'" class="link"
				rel="example_group">Edit</a></td>
				<td align="center"><a href="'.base_url().'admin/hapus_nilai/'.$value['nim'].'/'.$value['kd_mk'].'" class="link"
				onClick=\'return confirm("Anda yakin...??")\'>Hapus</a></td>
			</tr>';
			$no++;
						
			}
			if($value['grade'] != 'T') {
				$totalNH +=$value['NxH'];
				$totalSKS+=$value['jum_sks'];
			}
			$temp=$value['semester_ditempuh'];	
		}
		$ip = 0;
		if($totalNH !=0)			
			$ip = round($totalNH/$totalSKS, 2);
		$rows[]='
				<tr>
				<td colspan="6"><strong>Jumlah SKS : '.$totalSKS.'</strong></td>
				<td colspan="6"><strong>IP Semester : '.$ip.'</strong></td>
				</tr>';
	
		foreach($rows as $row)
		{
			echo $row;
		}
		?>
		</table>
		</table>
		
	</div>
