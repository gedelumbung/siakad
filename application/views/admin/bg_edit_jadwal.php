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
<form method="post" action="<?php echo base_url(); ?>admin/simpan_jadwal">
<?php
	foreach($edit->result_array() as $e)
	{
		$jdw = explode(" / ",$e['jadwal']);
		$jam = explode("-",$jdw[1]);
?>
<table>

<tr>
<td width="180">Mata Kuliah</td>
<td width="50">:</td>
<td>
<select name="kd_mk" class="input-read-only">
	<?php
		foreach($mata_kuliah->result_array() as $mk)
		{
			$pilih = '';
			if($e['kd_mk']==$mk['kd_mk']) $pilih="selected='selected'";
	?>
	<option value="<?php echo $mk['kd_mk']; ?>" <?php echo $pilih; ?>><?php echo $mk['kd_mk']." - ".$mk['nama_mk']; ?></option>
	<?php
		}
	?>
</select>
</td>
</tr>

<tr>
<td width="180">Nama Dosen</td>
<td width="50">:</td>
<td>
<select name="kd_dosen" class="input-read-only">
	<?php
		foreach($dosen->result_array() as $d)
		{
			$pilih = '';
			if($e['kd_dosen']==$d['kd_dosen']) $pilih="selected='selected'";
	?>
	<option value="<?php echo $d['kd_dosen']; ?>" <?php echo $pilih; ?>><?php echo $d['kd_dosen']." - ".$d['nama_dosen']; ?></option>
	<?php
		}
	?>
</select>
</td>
</tr>

<tr>
<td width="180">Hari</td>
<td width="50">:</td>
<td>
<select name="hari" class="input-read-only">
<?php
	if($jdw[0]=="Senin")
	{
		$senin="selected='selected'"; $selasa=""; $rabu=""; $kamis=""; $jumat="";
	}
	else if($jdw[0]=="Selasa")
	{
		$senin=""; $selasa="selected='selected'"; $rabu=""; $kamis=""; $jumat="";
	}
	else if($jdw[0]=="Rabu")
	{
		$senin=""; $selasa=""; $rabu="selected='selected'"; $kamis=""; $jumat="";
	}
	else if($jdw[0]=="Kamis")
	{
		$senin=""; $selasa=""; $rabu=""; $kamis="selected='selected'"; $jumat="";
	}
	else if($jdw[0]=="Jumat")
	{
		$senin=""; $selasa=""; $rabu=""; $kamis=""; $jumat="selected='selected'";
	}
?>
	<option value="Senin" <?php echo $senin; ?>>Senin</option>
	<option value="Selasa" <?php echo $selasa; ?>>Selasa</option>
	<option value="Rabu" <?php echo $rabu; ?>>Rabu</option>
	<option value="Kamis" <?php echo $kamis; ?>>Kamis</option>
	<option value="Jumat" <?php echo $jumat; ?>>Jumat</option>
</select>
</td>
</tr>

<tr>
<td width="180">Jam Mulai</td>
<td width="50">:</td>
<td><input type="text" name="jam_mulai" size="50" class="input-read-only" value="<?php echo $jam[0]; ?>" /></td>
</tr>

<tr>
<td width="180">Jam Berakhir</td>
<td width="50">:</td>
<td><input type="text" name="jam_akhir" size="50" class="input-read-only" value="<?php echo $jam[1]; ?>" /></td>
</tr>

<tr>
<td width="180">Ruangan</td>
<td width="50">:</td>
<td><input type="text" name="ruang" size="50" class="input-read-only" value="<?php echo $jdw[2]; ?>" /></td>
</tr>

<tr>
<td width="180">Tahun Ajaran</td>
<td width="50">:</td>
<td>
<select name="kd_tahun" class="input-read-only">
	<?php
		foreach($tahun_ajaran->result_array() as $ta)
		{
			$pilih = '';
			if($e['kd_tahun']==$ta['kd_tahun']) $pilih="selected";
	?>
	<option value="<?php echo $ta['kd_tahun']; ?>" <?php echo $pilih; ?>><?php echo $ta['keterangan']; ?></option>
	<?php
		}
	?>
</select>
</td>
</tr>

<tr>
<td width="180">Kapasitas Kelas</td>
<td width="50">:</td>
<td><input type="text" name="kapasitas" size="50" class="input-read-only" value="<?php echo $e['kapasitas']; ?>" /></td>
</tr>

<tr>
<td width="180">Kelas Program</td>
<td width="50">:</td>
<td>
<select name="kelas_program" class="input-read-only">
<?php
	if($e['kelas_program']=="pagi")
	{
		?>
		<option value="pagi" selected>Pagi</option>
		<option value="sore">Sore</option>
		<?php
	}
	else if($e['kelas_program']=="sore")
	{
		?>
		<option value="pagi">Pagi</option>
		<option value="sore" selected>Sore</option>
		<?php
	}
?>
</select>
</td>
</tr>

<tr>
<td width="180">Kelas</td>
<td width="50">:</td>
<td><input type="text" name="kelas" size="50" class="input-read-only" value="<?php echo $e['kelas']; ?>" /></td>
</tr>

<tr>
<td width="180"></td>
<td width="50"></td>
<td>
<input type="submit" value="Simpan Nilai" class="btn-kirim">
<input type="reset" value="Batal" class="btn-kirim">
<input type="hidden" name="kd_jadwal" value="<?php echo $e['kd_jadwal']; ?>">
<input type="hidden" name="stts" value="edit"></td>
</tr>

</table>

<?php } ?>

</form>