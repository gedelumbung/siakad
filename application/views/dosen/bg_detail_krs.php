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
font-family:Arial;
}
</style>
<script src="<?php echo base_url(); ?>asset/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>asset/js/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#datafrs").validate({
			debug: false,
			rules: {
				carimhs: "required"
			},
			messages: {
				carimhs: "<div style='width:670px; position:absolute; text-align:center; color:#fff; padding:5px; background-color:red;'>Masukkan NIM..!!!</div>",
			},
			submitHandler: function(form) {
				<?php 
					if($status=='0')
					{
						?>
						$.post('<?php echo base_url(); ?>dosen/setuju_krs', $("#datafrs").serialize(), function(data) {
							$('#hasil').html(data);
						});
						<?php
					}
					else
					{
						?>
						$.post('<?php echo base_url(); ?>dosen/batal_krs', $("#datafrs").serialize(), function(data) {
							$('#hasil').html(data);
						});
						<?php
					}
				?>
			}
		});
	});
	</script>
<script type="text/javascript">
	$(document).ready(function() {
		$(".delbutton").click(function(){
		 var element = $(this);
		 var del_id = element.attr("id");
		 var info = 'id=' + del_id;
		 if(confirm("Anda yakin akan menghapus?"))
		 {
			 $.ajax({
			 type: "POST",
			 url : "<?php echo base_url(); ?>dosen/hapus_krs/",
			 data: info,
			 success: function(){
			 }
			 });	
		 $(this).parents(".content").animate({ opacity: "hide" }, "slow");
 			}
		 return false;
		 });
	})
</script>

<?php
	if($status=='1')
	{
		$cls = "disetujui";
		$teks = "<b>Sudah Disetujui</b>";
	}
	else if($status=='0')
	{
		$cls = "";
		$teks = "<b>Belum Disetujui</b>";
	}
	else if($status==NULL)
	{
		$cls = "";
		$teks = "<b>Belum KRS</b>";
	}
?>
	<div id="hasil"></div>
<form name="datafrs" id="datafrs" method="POST" action="">
<table border="0" width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse; font-size:12px;">
	<tr>
		<td width="100">NIM</td>
		<td width="250">:&nbsp;<input name="nim" value="<?php echo $nim; ?>" type="text" readonly="readonly"  size="30" style="font-size:12px;"/></td>
		<td>Semester, Tahun Ajaran</td>
		<td>:&nbsp;<input name="smstr_thn_ajaran" value="<?php echo $tahun_ajaran; ?>" type="text" readonly="readonly"  size="30" style="font-size:12px;" /></td>
	</tr>
	<tr>
		<td>Nama</td>
		<td>:&nbsp;<input name="nama_mhs" value="<?php echo $nama_mhs; ?>" type="text" readonly="readonly"   size="30" style="font-size:12px;"/></td>
		<td>IP Semester Lalu/Beban Study Maks</td>
		<td>:&nbsp;<input name="ip" value="<?php echo $ipk; ?>" type="text" size="10" readonly="readonly" style="font-size:12px;" />
		&nbsp;/&nbsp;<input name="beban_study" value="<?php echo $beban_studi; ?>" type="text" size="10" readonly="readonly" style="font-size:12px;" />
		</td>
				
	</tr>
	<tr>
		<td>Jurusan</td>
		<td>:&nbsp;<input name="jurusan" value="<?php echo $jurusan; ?>" type="text" readonly="readonly"  size="30" style="font-size:12px;" /></td>

		<td>Program Kelas</td>
		<td>:&nbsp;<input name="program" value="<?php echo $program; ?>" type="text" readonly="readonly"  size="30" style="font-size:12px;" />		
		</td>		
		
	</tr>
		<tr>
		<td>Dosen Wali</td>
		
		<td>
		:&nbsp;<input name="dosen_wali" value="<?php echo $dosen_wali; ?>" type="text" readonly="readonly"  size="30" style="font-size:12px;" />
		</td>

		<td>Semester yang akan ditempuh (*)</td>
		<td>:&nbsp;<input name="semester" value="<?php echo $smt_skr; ?>" type="text"  readonly="readonly"  size="30" style="font-size:12px;"/>
		</td>
	</tr>
	</table>
		
<div class="cleaner_h10"></div>
	<table border="1" width="100%" style="border-collapse: collapse; font-size:12px;" cellpadding="5" class="<?php echo $cls; ?>">

	<td colspan="12" align="center" bgcolor="#fff" style="text-transform:uppercase;"><strong>Mata Kuliah yang Akan Ditempuh Pada Semester Ini :</strong></td>
	</tr>
	<tr>
	<td align="center">Kode MK</td>
	<td align="center">Mata Kuliah</td>
	<td align="center">Smstr</td>	
	<td align="center">SKS</td>
	<td align="center">Dosen</td>
	<td align="center">Kelas</td>
	<td align="center">Jadwal</td>
	<td align="center">Quota</td>
	<td align="center">Peserta</td>
	<td align="center">Calon Peserta</td>
	<?php
	if($status=='0')
	{
		echo '<td align="center">Batalkan</td>';
	}
	?>
	</tr>


<?php
	$state_app = 0;
	$no=1;
	$tot_sks = 0;
	foreach ($detailfrs->result_array() as $value) 
	{
	$tot_sks += $value['jum_sks'];
	if($value['kapasitas']==$value['Peserta'])
	{
		$state_app++;
		$color ="red";
	}
	else
	{
		$color ="";
	}
		
		echo '<tr bgcolor="'.$color.'" class="content">
				<td>'.$value['kd_mk'].'</td>
				<td>'.$value['nama_mk'].'</td>
				<td>'.$value['semester'].'</td>
				<td>'.$value['jum_sks'].'</td>';
				
		echo '<td>'.$value['nama_dosen'].'</td>
				<td align="center">'.$value['kelas'].'</td>
				<td align="center">'.$value['jadwal'].'</td>
				<td align="center">'.$value['kapasitas'].'</td>
				<td align="center">'.$value['Peserta'].'</td>
				<td align="center">'.$value['CalonPeserta'].'</td>';
			if($status=='0')
			{
				echo '<td align="center">
				<a class="delbutton" id="'.$value['nim'].'|'.$value['kd_jadwal'].'" href="#"><div id="box-link">Batalkan</div></a>
				</td>';
			}
	}
	echo '<tr><td colspan=3>Total SKS Yang Akan Ditempuh :</td><td colspan=8 id="jmlcart"><b>'.$tot_sks.' SKS</b></td></tr>';
	echo '<tr><td colspan=3>Status Persetujuan KRS :</td><td colspan=8>'.$teks.'</td></tr>';
?>
	</table>
<?php
	if($status=='0')
	{
		if($state_app < 1)
		{
			echo "<br>(+) Jika Anda menyetujui Rencana Study Mahasiswa yang bersangkutan silakan click tombol Setujui di bawah ini
		 <br><br><input type='submit' value='Setujui Kartu Rencana Studi'>";
		}
		else if($state_app > 0)
		{
			echo "<p class='alert'>Anda tidak diperbolehkan menyetujui Kartu Rencana Studi ini, karena ada <b> ".$state_app." </b>mata kuliah yang telah terpenuhi kuotanya...!!!</p>";
		}
	}
	else{
		echo "<br>(+) Jika Anda ingin membatalkan seluruh Rencana Study Mahasiswa yang bersangkutan silakan click tombol Batalkan di bawah ini
		<br><br><input type='submit' value='Batalkan Kartu Rencana Studi' onclick='tb_remove()'>
		";
	}
?>	
	</form>