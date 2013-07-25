<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Included content</title>
	<style type="text/css">
		p {
			font-family: Arial, sans-serif;
			font-size: 12px;
			margin:0px;
		}
		h3 {
			font-family: Arial;
			color: #666;
			margin:0px auto;
		}
		table {
			font-family: Arial, sans-serif;
			font-size: 12px;
		}
	</style>
</head>
<body style="margin:5px;padding:5px">

<p>
<table border="1" width="100%" style="border-collapse: collapse;" cellpadding="5">
<th align="center">No</th>
<th align="center">NIM</th>
<th align="center">Nama</th>
<th align="center">Jurusan</th>
<th align="center">Status Persetujuan</th>
<?php
$no=1;
foreach($peserta->result_array() as $value){
	if($no % 2 ==0)
		$color ="#7FCDFB";
	else
		$color ="#fff";
	$st = "";
			if($value['status']=='0'){ 
				$st = "Belum Disetujui"; 
			} 
			else {
				$st = "Sudah Disetujui"; 
			}
	echo '<tr>
	<td bgcolor="'.$color.'">'.$no.'</td>
	<td bgcolor="'.$color.'">'.$value['nim'].'</td>
	<td bgcolor="'.$color.'">'.$value['nama_mahasiswa'].'</td>
	<td bgcolor="'.$color.'">'.$value['jurusan'].'</td>
	<td bgcolor="'.$color.'">'.$st.'</td>
	</tr>';
	$no++;
}
?>	
</table>
</p>
</body>
</html>