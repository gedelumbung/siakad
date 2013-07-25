<!DOCTYPE html>
<style>
a{
text-decoration:none;
color:#fff;
padding:5px;
border:1px solid #333333;
float:left;
background-color:#000;
}
a:hover{
text-decoration:none;
color:#fff;
padding:5px;
border:1px solid #333333;
float:left;
background-color:#666666;
}
body{
font-size:12px;
font-family:Tahoma,Arial;
margin:30px;
}
.input-read-only {
border: 1px solid #D0D0D0;
padding: 10px;
width:500px;
}
.btn-kirim {
font-size: 12px;
background-color: #f9f9f9;
border: 1px solid #D0D0D0;
padding: 9px 10px 9px 10px;
color:#000;
cursor:pointer; 
-moz-border-radius: 6px; 
border-radius: 6px;
}
</style>
<form method="post" action="<?php echo base_url(); ?>admin/simpan_mahasiswa">
<table>
<?php
	foreach($mahasiswa->result_array() as $m)
	{
?>
<tr>
<td width="180">Nama Mahasiswa</td>
<td width="50">:</td>
<td><input type="text" name="nama_mahasiswa" size="50" class="input-read-only" value="<?php echo $m['nama_mahasiswa']; ?>" /></td>
</tr>

<tr>
<td width="180">Angkatan</td>
<td width="50">:</td>
<td><input type="text" name="angkatan" size="50" class="input-read-only" value="<?php echo $m['angkatan']; ?>" /></td>
</tr>

<tr>
<td width="180">Jurusan</td>
<td width="50">:</td>
<td><input type="text" name="jurusan" size="50" class="input-read-only" value="<?php echo $m['jurusan']; ?>" /></td>
</tr>

<tr>
<td width="180">Kelas Program</td>
<td width="50">:</td>
<td>
<select name="kelas_program" class="input-read-only">
	<?php
		$pagi = '';
		$sore = '';
		if($m['kelas_program']=="pagi")
		{
			$pagi = 'selected="selected"';
			$sore = '';
		}
		else if($m['kelas_program']=="sore")
		{
			$pagi = '';
			$sore = 'selected="selected"';
		}
	?>
	<option value="pagi" <?php echo $pagi; ?>>Pagi</option>
	<option value="sore" <?php echo $sore; ?>>Sore</option>
</select>
</td>
</tr>

<tr>
<td width="180">Dosen Wali</td>
<td width="50">:</td>
<td>

<select name="kd_dosen" class="input-read-only">
<?php
	foreach($dosen->result_array() as $d)
	{
	$selected = '';
	if($d['kd_dosen']==$m['kd_dosen'])
	{
		$selected = 'selected="selected"';
	}
	?>
	<option value="<?php echo $d['kd_dosen']; ?>" <?php echo $selected; ?>><?php echo $d['kd_dosen'].' - '.$d['nama_dosen']; ?></option>
	<?php
	}
?>
</select>
</td>
</tr>

<tr>
<td width="180"></td>
<td width="50"></td>
<td>
<input type="submit" value="Simpan Data" class="btn-kirim">
<input type="reset" value="Batal" class="btn-kirim">
<input type="hidden" name="nim" value="<?php echo $m['nim']; ?>">
<input type="hidden" name="stts" value="edit"></td>
</tr>
<?php
	}
?>
</table>

</form>