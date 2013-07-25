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
<form method="post" action="<?php echo base_url(); ?>admin/simpan_nilai">
<?php
	foreach($input->result_array() as $e)
	{
?>
<table>

<tr>
<td width="180">NIM</td>
<td width="50">:</td>
<td><input type="text" name="nim" size="50" class="input-read-only" value="<?php echo $e['nim']; ?>" readonly="true" /></td>
</tr>

<tr>
<td width="180">Nama Mahasiswa</td>
<td width="50">:</td>
<td><input type="text" size="50" class="input-read-only" value="<?php echo $e['nama_mahasiswa']; ?>" /></td>
</tr>

<tr>
<td width="180">Kode Mata Kuliah</td>
<td width="50">:</td>
<td><input type="text" name="kd_mk" size="50" class="input-read-only" value="<?php echo $e['kd_mk']; ?>" readonly="true" /></td>
</tr>

<tr>
<td width="180">Mata Kuliah</td>
<td width="50">:</td>
<td><input type="text" size="50" class="input-read-only" value="<?php echo $e['nama_mk']; ?>" /></td>
</tr>

<tr>
<td width="180">Kode Dosen</td>
<td width="50">:</td>
<td><input type="text" name="kd_dosen" size="50" class="input-read-only" value="<?php echo $e['kd_dosen']; ?>" /></td>
</tr>

<tr>
<td width="180">Nama Dosen</td>
<td width="50">:</td>
<td><input type="text" size="50" class="input-read-only" value="<?php echo $e['nama_dosen']; ?>" /></td>
</tr>

<tr>
<td width="180">Kode Tahun Ajaran</td>
<td width="50">:</td>
<td><input type="text" name="kd_tahun" size="50" class="input-read-only" value="<?php echo $e['kd_tahun']; ?>" /></td>
</tr>

<tr>
<td width="180">Semester Ditempuh</td>
<td width="50">:</td>
<td><input type="text" name="semester_ditempuh" size="50" class="input-read-only" value="<?php echo $smt; ?>" /></td>
</tr>

<tr>
<td width="180">Nilai</td>
<td width="50">:</td>
<td><input type="text" name="grade" size="50" class="input-read-only" /></td>
</tr>

<tr>
<td width="180"></td>
<td width="50"></td>
<td>
<input type="submit" value="Simpan Nilai" class="btn-kirim">
<input type="reset" value="Batal" class="btn-kirim">
<input type="hidden" name="stts" value="tambah"></td>
</tr>

</table>

<?php } ?>

</form>