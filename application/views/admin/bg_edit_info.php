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
font-family:Arial;
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
<form method="post" action="<?php echo base_url(); ?>admin/simpan_info">
<table>
<?php
	foreach($info->result_array() as $i)
	{
?>
<tr>
<td width="180">Judul</td>
<td width="50">:</td>
<td><input type="text" name="judul" size="50" class="input-read-only" value="<?php echo $i['judul']; ?>" /></td>
</tr>

<tr>
<td width="180" valign="top">Isi</td>
<td width="50" valign="top">:</td>
<td>
<textarea name="isi" class="input-read-only" rows="12"><?php echo $i['isi']; ?></textarea>
</td>
</tr>

<tr>
<td width="180"></td>
<td width="50"></td>
<td>
<input type="submit" value="Simpan Data" class="btn-kirim">
<input type="reset" value="Batal" class="btn-kirim">
<input type="hidden" name="kd_info" value="<?php echo $i['kd_info']; ?>">
<input type="hidden" name="stts" value="edit"></td>
</tr>
<?php
	}
?>
</table>

</form>