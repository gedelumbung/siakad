<div id="container">
	<h1>Nilai - Kartu Hasil Studi - Sistem Informasi Akademik Online</h1>

	<div id="body">
		<?php
			echo $bio;
			echo $menu;
		?>
		<div class="cleaner_h10"></div>
		<?php 
		$temp='';
		$rows=array();
		$totalNH=0;	
		$totalSKS=0;
		$no=1;
		?>
		<table border="1" width="100%" style="border-collapse: collapse;" cellpadding="5">
		<tr style="background-color:#000; color:#FFFFFF;">
		<td align="center">No</td>
		<td align="center">Kode Mata Kuliah</td>
		<td align="center">Mata Kuliah</td>
		<td align="center">Semester</td>
		<td align="center">SKS</td>
		<td align="center">Nilai</td>	
		<td align="center">Bobot</td>
		<td align="center">SKS x Bobot</td>
		</tr>
		<?php
		foreach($khs->result_array() as $value)
		{
			if($temp=='')
			{
				$rows[]='<tr>
				<td colspan="8" bgcolor="#fff"><strong>Semester : '.$value['semester_ditempuh'].'</strong></td>
				</tr>';
				$rows[]='<tr>
				<td>'. $no.'</td>
				<td>'. $value['kd_mk'].'</td>
				<td>&nbsp;'. $value['nama_mk'].'</td>
				<td align="center">'. $value['semester_ditempuh'].'</td>
				<td align="center">'. $value['jum_sks'].'&nbsp;</td>
				<td align="center">'. $value['grade'].'</td>
				<td align="center">'. $value['bobot'].'</td>
				<td align="center">'. $value['NxH'].'</td>';
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
				<td colspan="4"><strong>Jumlah SKS : '.$totalSKS.'</strong></td>
				<td colspan="4"><strong>IP Semester : '.$ip.'</strong></td>';
	
				$rows[]='<tr>
				<td colspan="8" bgcolor="#fff"><strong>Semester : '.$value['semester_ditempuh'].'</strong></td>
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
				<td colspan="4"><strong>Jumlah SKS : '.$totalSKS.'</strong></td>
				<td colspan="4"><strong>IP Semester : '.$ip.'</strong></td>
				</tr>';
	
		foreach($rows as $row)
		{
			echo $row;
		}
		?>
		</table>
		</table>
		
	</div>
