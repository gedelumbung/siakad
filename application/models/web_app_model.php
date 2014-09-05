<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Web_App_Model extends CI_Model {

	/**
	 * @author : Gede Lumbung
	 * @web : http://gedelumbung.com
	 * @keterangan : Model untuk menangani semua query database aplikasi web
	 **/
	 
	//query otomatis dengan active record
	public function getAllData($table)
	{
		return $this->db->get($table);
	}
	
	public function getAllDataLimited($table,$offset,$limit)
	{
		return $this->db->get($table,$limit,$offset);
	}
	
	public function getSelectedData($table,$key,$value)
	{
		$this->db->where($key, $value); 
		return $this->db->get($table);
	}
	
	public function getSelectedDataMultiple($table,$data)
	{
		return $this->db->get_where($table, $data);
	}
	
	function deleteData($table,$data)
	{
		$this->db->delete($table, $data);
	}
	
	function updateData($table,$data,$field,$key)
	{
		$this->db->where($key,$field);
		$this->db->update($table,$data);
	}
	
	function updateDataMultiField($table,$data,$field_key)
	{
		$this->db->update($table,$data,$field_key);
	}
	
	function insertData($table,$data)
	{
		$this->db->insert($table,$data);
	}
	
	
	//query login
	public function getLoginData($usr,$psw)
	{
		$u = mysql_real_escape_string($usr);
		$p = md5(mysql_real_escape_string($psw));
		$q_cek_login = $this->db->get_where('tbl_login', array('username' => $u, 'password' => $p));
		if(count($q_cek_login->result())>0)
		{
			foreach($q_cek_login->result() as $qck)
			{
				if($qck->stts=='mahasiswa')
				{
					$q_ambil_data = $this->db->get_where('tbl_mahasiswa', array('nim' => $u));
					foreach($q_ambil_data ->result() as $qad)
					{
						$sess_data['logged_in'] = 'yes';
						$sess_data['nim'] = $qad->nim;
						$sess_data['nama'] = $qad->nama_mahasiswa;
						$sess_data['angkatan'] = $qad->angkatan;
						$sess_data['jurusan'] = $qad->jurusan;
						$sess_data['stts'] = 'mahasiswa';
						$sess_data['program'] = $qad->kelas_program;
						$this->session->set_userdata($sess_data);
					}
					header('location:'.base_url().'mahasiswa');
				}
				else if($qck->stts=='dosen')
				{
					$q_ambil_data = $this->db->get_where('tbl_dosen', array('kd_dosen' => $u));
					foreach($q_ambil_data ->result() as $qad)
					{
						$sess_data['logged_in'] = 'yes';
						$sess_data['kd_dosen'] = $qad->kd_dosen;
						$sess_data['nidn'] = $qad->nidn;
						$sess_data['nama'] = $qad->nama_dosen;
						$sess_data['stts'] = 'dosen';
						$this->session->set_userdata($sess_data);
					}
					header('location:'.base_url().'dosen');
				}
				else if($qck->stts=='admin')
				{
					$q_ambil_data = $this->db->get_where('tbl_admin', array('username' => $u));
					foreach($q_ambil_data ->result() as $qad)
					{
						$sess_data['logged_in'] = 'yes';
						$sess_data['username'] = $qad->username;
						$sess_data['nama'] = $qad->nama_lengkap;
						$sess_data['stts'] = 'admin';
						$this->session->set_userdata($sess_data);
					}
					header('location:'.base_url().'admin');
				}
			}
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	//query transkrip nilai
	public function getNilai($nim)
	{
		return $this->db->query('SELECT t_n.nim, tbl_mahasiswa.nama_mahasiswa, t_n.kd_mk, t_n.nama_mk, t_n.semester_ditempuh, 
		t_n.jum_sks, t_n.grade, tbl_bobot.bobot, (
		t_n.jum_sks * tbl_bobot.bobot) AS NxH FROM
		(SELECT tbl_nilai.nim, tbl_nilai.kd_mk, tbl_mk.nama_mk, tbl_mk.jum_sks, tbl_nilai.semester_ditempuh, tbl_nilai.grade
		FROM tbl_nilai LEFT JOIN tbl_mk ON tbl_nilai.kd_mk= tbl_mk.kd_mk
		WHERE tbl_nilai.nim = "'.$nim.'") as t_n
		LEFT JOIN tbl_bobot ON tbl_bobot.nilai = t_n.grade
		LEFT JOIN tbl_mahasiswa ON t_n.nim = tbl_mahasiswa.nim
		ORDER BY t_n.semester_ditempuh');
	}
	
	//query transkrip nilai
	public function getNilaiTranskrip($nim,$semester)
	{
		return $this->db->query('SELECT t_n.nim, tbl_mahasiswa.nama_mahasiswa, t_n.kd_mk, t_n.nama_mk, t_n.semester_ditempuh, 
		t_n.jum_sks, t_n.grade, tbl_bobot.bobot, (
		t_n.jum_sks * tbl_bobot.bobot) AS NxH FROM
		(SELECT tbl_nilai.nim, tbl_nilai.kd_mk, tbl_mk.nama_mk, tbl_mk.jum_sks, tbl_nilai.semester_ditempuh, tbl_nilai.grade
		FROM tbl_nilai LEFT JOIN tbl_mk ON tbl_nilai.kd_mk= tbl_mk.kd_mk
		WHERE tbl_nilai.nim = "'.$nim.'" and semester_ditempuh="'.$semester.'") as t_n
		LEFT JOIN tbl_bobot ON tbl_bobot.nilai = t_n.grade
		LEFT JOIN tbl_mahasiswa ON t_n.nim = tbl_mahasiswa.nim
		ORDER BY t_n.semester_ditempuh');
	}
	
	//query transkrip nilai
	public function getSemester($nim)
	{
		return $this->db->query('SELECT tbl_nilai.nim, tbl_nilai.kd_mk, tbl_mk.nama_mk, tbl_mk.jum_sks, tbl_nilai.semester_ditempuh, tbl_nilai.grade
		FROM tbl_nilai LEFT JOIN tbl_mk ON tbl_nilai.kd_mk= tbl_mk.kd_mk
		WHERE tbl_nilai.nim = "'.$nim.'" group by semester_ditempuh');
	}
	
	//query mengambil jumlah ipk
	public function getIpk($nim,$smt_terakhir)
	{
		$query = $this->db->query("select round(SUM((tbl_bobot.bobot * tbl_mk.jum_sks))/ SUM(tbl_mk.jum_sks), 2) as IPK 
		FROM tbl_nilai LEFT JOIN (tbl_mk,tbl_bobot) ON tbl_nilai.kd_mk=tbl_mk.kd_mk
		and tbl_bobot.nilai = tbl_nilai.grade
 		WHERE tbl_nilai.nim='".$nim."' AND tbl_nilai.semester_ditempuh='".$smt_terakhir."' AND tbl_nilai.grade NOT IN('T')");
 		$ipk=0.0;
		foreach($query->result() as $value){
			$ipk = $value->IPK;
		}
		return $ipk;
	}
	
	//query mengambil jumlah ipk
	public function getDosenWali($nim)
	{
		$q = $this->db->query("select nama_dosen from tbl_dosen_wali left join tbl_dosen on
		tbl_dosen_wali.kd_dosen=tbl_dosen.kd_dosen where tbl_dosen_wali.nim='".$nim."'");
 		$nama_dosen="";
		foreach($q->result() as $value){
			$nama_dosen = $value->nama_dosen;
		}
		return $nama_dosen;
	}
	
	//query mengambil keterangan tahun ajaran
	public function getTahunAjaran()
	{
		$q = $this->db->query("select keterangan from tbl_thn_ajaran where stts='1'");
 		$ket="";
		foreach($q->result() as $value){
			$ket = $value->keterangan;
		}
		return $ket;
	}
	
	//query mengambil id tahun ajaran
	public function getKdTahunAjaran()
	{
		$q = $this->db->query("select kd_tahun from tbl_thn_ajaran where stts='1'");
 		$ket="";
		foreach($q->result() as $value){
			$ket = $value->kd_tahun;
		}
		return $ket;
	}
	
	//query untuk mengambil semester maksimal
	public function getSemesterMax($nim)
	{
		$query = $this->db->query("select max(tbl_nilai.semester_ditempuh) semester_terakhir
		FROM tbl_nilai
		WHERE (tbl_nilai.nim='".$nim."')");
		$t='0';
		foreach($query->result() as $value){
			$t= $value->semester_terakhir+1;
		}
		return $t;
	}
	
	//query untuk mengambil detail krs
	public function getDetailKrs($nim, $kd_tahun)
	{
		$q = $this->db->query("SELECT a.nim,hasil.kapasitas,hasil.semester,hasil.kelas,
		hasil.kd_mk,hasil.jum_sks,hasil.kd_jadwal,c.nama_mahasiswa,hasil.nama_mk,hasil.nama_dosen,hasil.jadwal,
		SUM(CASE status WHEN 1 THEN 1 ELSE 0 END ) AS Peserta, 
		SUM(CASE status WHEN 0 THEN 1 ELSE 0 END ) AS CalonPeserta from tbl_perwalian_header a 
		left join 
		(select det.kelas, det.kd_tahun,
		det.semester,det.kapasitas,det.kd_mk,det.jum_sks,det.kd_jadwal,det.nama_mk,det.nama_dosen,det.jadwal,k.nim from tbl_perwalian_detail k 
		left join 
		(select w.kelas,x.semester,w.kapasitas,x.kd_mk,x.jum_sks,w.kd_jadwal,x.nama_mk,y.nama_dosen,w.jadwal,w.kd_tahun from tbl_jadwal w 
		left join tbl_mk x on w.kd_mk=x.kd_mk 
		left join tbl_dosen y on  w.kd_dosen=y.kd_dosen) as det 
		on k.kd_jadwal=det.kd_jadwal) as hasil on a.nim=hasil.nim
		left join tbl_mahasiswa c on a.nim=c.nim
		where a.nim='".$nim."' and hasil.kd_tahun='".$kd_tahun."' group by hasil.kd_jadwal");
		return $q;
	}
	
	//query jadwal
	public function getJadwal($nim,$kelas_program,$semester)
	{
		return $this->db->query('SELECT 
		a.kd_jadwal,b.nama_mk,b.kd_mk,b.semester,b.jum_sks,a.kapasitas,a.kelas,c.kd_dosen,a.jadwal,d.Peserta,d.CalonPeserta,c.nama_dosen, d.kd_tahun FROM 
		`tbl_jadwal` a 
		left join tbl_mk b on a.kd_mk=b.kd_mk 
		left join tbl_dosen c on a.kd_dosen=c.kd_dosen 
		left join (
		SELECT kd_jadwal,detail.kelas_program, detail.kd_tahun,
		SUM(CASE status WHEN 1 THEN 1 ELSE 0 END ) AS Peserta, 
		SUM(CASE status WHEN 0 THEN 1 ELSE 0 END ) AS CalonPeserta
		FROM tbl_perwalian_header
		LEFT JOIN 
		(select k.kd_jadwal,l.kelas_program,l.kd_mk,k.nim, l.kd_tahun from tbl_perwalian_detail k left join tbl_jadwal l on k.kd_jadwal=l.kd_jadwal)  as detail
		ON tbl_perwalian_header.nim = detail.nim group by kd_jadwal
		) as d
		on a.kd_jadwal=d.kd_jadwal order by b.kd_mk, b.semester ASC');
	}
	
	//query untuk mengambil semua jadwal dari admin
	public function getSemuaJadwal()
	{
		return $this->db->query('SELECT 
		a.kd_jadwal,b.nama_mk,b.kd_mk,b.semester,b.jum_sks,a.kapasitas,a.kelas,c.kd_dosen,a.jadwal,d.Peserta,d.CalonPeserta,c.nama_dosen FROM 
		`tbl_jadwal` a 
		left join tbl_mk b on a.kd_mk=b.kd_mk 
		left join tbl_dosen c on a.kd_dosen=c.kd_dosen 
		left join (
		SELECT kd_jadwal,detail.kelas_program,
		SUM(CASE status WHEN 1 THEN 1 ELSE 0 END ) AS Peserta, 
		SUM(CASE status WHEN 0 THEN 1 ELSE 0 END ) AS CalonPeserta
		FROM tbl_perwalian_header
		LEFT JOIN 
		(select k.kd_jadwal,l.kelas_program,l.kd_mk,k.nim from tbl_perwalian_detail k left join tbl_jadwal l on k.kd_jadwal=l.kd_jadwal)  as detail
		ON tbl_perwalian_header.nim = detail.nim group by kd_jadwal
		) as d
		on a.kd_jadwal=d.kd_jadwal');
	}
	
	//query untuk mengambil salah satu detail jadwal
	public function getEditJadwal($kd_jadwal)
	{
		return $this->db->query("SELECT a.kd_jadwal,a.jadwal, b.kd_mk, b.nama_mk, c.kd_dosen, c.nama_dosen, d.kd_tahun, a.kapasitas, a.kelas_program, 
		a.kelas FROM tbl_jadwal a 
		left join tbl_mk b on a.kd_mk=b.kd_mk
		left join tbl_dosen c on a.kd_dosen=c.kd_dosen
		left join tbl_thn_ajaran d on a.kd_tahun=d.kd_tahun where a.kd_jadwal='".$kd_jadwal."'");
	}
	
	//query simpan krs
	function insertKrs($data_head,$data) 
	{
		$this->db->trans_start();
		$this->db->insert('tbl_perwalian_header',$data_head);			
		foreach($data as $value) {			
			$this->db->insert('tbl_perwalian_detail',$value);
		}
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
		{
    		echo "Error entry data";
		} 
	}
	
	//query hapus data krs lama/sebelumnya
	function deleteKrs($nim, $smt)
	{
		$this->db->trans_start();
		$tempwhere_head ="(nim='".$nim."') AND (semester='".$smt."')";
		$tempwhere_detail ="(nim='".$nim."')";
		$this->db->delete('tbl_perwalian_header',$tempwhere_head);
		$this->db->delete('tbl_perwalian_detail',$tempwhere_detail);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
		{
    		echo "Error delete data";
		}
	}
	
	//query mengambil peserta kuliah pada masing-masing mata kuliah
	function getPeserta($kd_jadwal,$status) {
		$q = $this->db->query("select nama_mahasiswa,jurusan,tbl_perwalian_detail.nim,status from tbl_perwalian_detail 
		left join tbl_perwalian_header on tbl_perwalian_detail.nim=tbl_perwalian_header.nim 
		left join tbl_mahasiswa on tbl_perwalian_detail.nim=tbl_mahasiswa .nim 
		where kd_jadwal='".$kd_jadwal."' and status='".$status."'");
		return $q;
	}
	
	//query mengambil mahasiswa yang diampu oleh dosen beserta jumlah sks yang diambil
	function getMahasiswaBimbingan($kd_dosen,$kd_tahun) {
		$q = $this->db->query("SELECT a.nim,b.nama_mahasiswa,c.j_sks,b.jurusan,b.kelas_program,e.status from tbl_dosen_wali a 
		left join tbl_mahasiswa b on a.nim=b.nim
		left join 
		(select k.nim,k.kd_jadwal,SUM(l.jum_sks) as j_sks from tbl_perwalian_detail k left join 
		(select x.kd_jadwal, y.jum_sks from tbl_jadwal x left join tbl_mk y on x.kd_mk=y.kd_mk)
		as l on k.kd_jadwal=l.kd_jadwal) c on a.nim=c.nim
		left join tbl_perwalian_header e on a.nim=e.nim
		where a.kd_dosen='".$kd_dosen."' and e.kd_tahun='".$kd_tahun."' group by a.nim");
		return $q;
	}
	
	//query menampilkan daftar mahasiswa yang akan diinputkan nilainya
	function getDaftarMahasiswa($offset,$limit) {
		$q = $this->db->query("SELECT * FROM tbl_perwalian_header a left join tbl_mahasiswa b on a.nim=b.nim left join tbl_dosen_wali c on a.nim=c.nim 
		where a.status='1' LIMIT ".$offset.",".$limit."");
		return $q;
	}
	
	//query menampilkan daftar mahasiswa yang akan diinputkan nilainya
	function getDaftarMahasiswaNilai($kd_dosen) {
		$q = $this->db->query("SELECT a.nim,b.nama_mahasiswa,c.j_sks,b.jurusan,b.kelas_program,e.status from tbl_dosen_wali a 
		left join tbl_mahasiswa b on a.nim=b.nim
		left join 
		(select k.nim,k.kd_jadwal,SUM(l.jum_sks) as j_sks from tbl_perwalian_detail k left join 
		(select x.kd_jadwal, y.jum_sks from tbl_jadwal x left join tbl_mk y on x.kd_mk=y.kd_mk)
		as l on k.kd_jadwal=l.kd_jadwal) c on a.nim=c.nim
		left join tbl_perwalian_header e on a.nim=e.nim
		where a.kd_dosen='".$kd_dosen."' and e.status=1 group by a.nim");
		return $q;
	}
	
	//query menampilkan daftar mahasiswa yang akan diinputkan nilainya
	function getEditDetailNilai($nim,$kd_mk) {
		$q = $this->db->query("SELECT * FROM tbl_nilai a 
		left join tbl_mahasiswa b on a.nim=b.nim 
		left join tbl_mk c on a.kd_mk=c.kd_mk
		left join tbl_dosen d on a.kd_dosen=d.kd_dosen
		where a.nim='".$nim."' and a.kd_mk='".$kd_mk."'");
		return $q;
	}
	
	//query untuk mengambil salah satu mata kuliah yang akan diinputkan nilainya
	function getInputDetailNilai($nim,$kd_jadwal) {
		$q = $this->db->query("SELECT a.nim, c.nama_mahasiswa, b.kd_mk, b.nama_mk, b.kd_dosen, b.nama_dosen, b.kd_tahun,b.kd_jadwal FROM 
		tbl_perwalian_detail a left join 
		(select k.kd_jadwal, k.kd_mk, l.nama_mk, k.kd_dosen, m.nama_dosen, k.kd_tahun from tbl_jadwal k left join tbl_mk l on k.kd_mk=l.kd_mk left 
		join tbl_dosen m on k.kd_dosen=m.kd_dosen) b on a.kd_jadwal=b.kd_jadwal
		left join tbl_mahasiswa c on a.nim=c.nim
		where a.nim='".$nim."' and b.kd_jadwal='".$kd_jadwal."'");
		return $q;
	}
	
	//query mengambil detail krs untuk disetujui
	function getDetailKrsPersetujuan($nim,$program,$kd_tahun) {
		$q = $this->db->query("SELECT kd_jadwal,
		kd_mk,
		nama_mk,
		b.semester,
		jum_sks,
		nama_dosen,
		kd_dosen,
		b.kelas,
		b.jadwal,
		b.kapasitas,
		a.nim,
		Peserta,
		CalonPeserta,
		status
		 FROM tbl_perwalian_header a left join 
		(select det.kd_jadwal,x.nim,det.nama_dosen,det.kd_dosen,det.nama_mk,det.jum_sks,det.kd_mk,det.semester,det.kelas,det.jadwal,det.kapasitas,det.Peserta,det.CalonPeserta from tbl_perwalian_detail x left join
		 
		(select k.kd_jadwal,m.nama_dosen,m.kd_dosen,l.nama_mk,l.jum_sks,l.kd_mk,l.semester,k.kelas,k.jadwal,k.kapasitas,d.Peserta,d.CalonPeserta from tbl_jadwal k left join tbl_mk l on k.kd_mk=l.kd_mk left join tbl_dosen m on k.kd_dosen=m.kd_dosen
		
		left join
		(select o.nim,p.kd_jadwal,
				SUM(CASE status WHEN 1 THEN 1 ELSE 0 END ) AS Peserta, 
				SUM(CASE status WHEN 0 THEN 1 ELSE 0 END ) AS CalonPeserta from tbl_perwalian_header o left join tbl_perwalian_detail p on o.nim=p.nim group by p.kd_jadwal) d on k.kd_jadwal=d.kd_jadwal
		) det
		on x.kd_jadwal=det.kd_jadwal
		) b on a.nim=b.nim
		
		left join tbl_mahasiswa c on a.nim=c.nim
		where a.nim='".$nim."' and a.kd_tahun='".$kd_tahun."' and kd_mk NOT IN (select kd_mk from tbl_nilai where nim='".$nim."')
		group by kd_jadwal");
		return $q;
	}
	
	//query mengambil detail krs untuk diinputkan nilainya
	function getDetailKrsDisetujui($nim,$program,$kd_tahun) {
		$q = $this->db->query("SELECT kd_jadwal,
		kd_mk,
		nama_mk,
		b.semester,
		jum_sks,
		nama_dosen,
		kd_dosen,
		b.kelas,
		b.jadwal,
		b.kapasitas,
		a.nim,
		Peserta,
		CalonPeserta,
		status
		 FROM tbl_perwalian_header a left join 
		(select det.kd_jadwal,x.nim,det.nama_dosen,det.kd_dosen,det.nama_mk,det.jum_sks,det.kd_mk,det.semester,det.kelas,det.jadwal,det.kapasitas,det.Peserta,det.CalonPeserta from tbl_perwalian_detail x left join
		 
		(select k.kd_jadwal,m.nama_dosen,m.kd_dosen,l.nama_mk,l.jum_sks,l.kd_mk,l.semester,k.kelas,k.jadwal,k.kapasitas,d.Peserta,d.CalonPeserta from tbl_jadwal k left join tbl_mk l on k.kd_mk=l.kd_mk left join tbl_dosen m on k.kd_dosen=m.kd_dosen
		
		left join
		(select o.nim,p.kd_jadwal,
				SUM(CASE status WHEN 1 THEN 1 ELSE 0 END ) AS Peserta, 
				SUM(CASE status WHEN 0 THEN 1 ELSE 0 END ) AS CalonPeserta from tbl_perwalian_header o left join tbl_perwalian_detail p on o.nim=p.nim group by p.kd_jadwal) d on k.kd_jadwal=d.kd_jadwal
		) det
		on x.kd_jadwal=det.kd_jadwal
		) b on a.nim=b.nim
		
		left join tbl_mahasiswa c on a.nim=c.nim
		where a.nim='".$nim."'
		group by kd_jadwal");
		return $q;
	}
	
	//query untuk mengecek kode dosen yang sudah ada
	function cekKodeDosenMax($kd) {
		$q = $this->db->query("select * from tbl_dosen where kd_dosen='".$kd."'");
		$hasil = 0;
		if($q->num_rows()>0)
		{
			$hasil = 1;
		}
		return $hasil;
	}
	
	//query untuk mengecek kode mk yang sudah ada
	function cekKodeMkMax($kd) {
		$q = $this->db->query("select * from tbl_mk where kd_mk='".$kd."'");
		$hasil = 0;
		if($q->num_rows()>0)
		{
			$hasil = 1;
		}
		return $hasil;
	}
	
	//query untuk mengecek nim yang sudah ada
	function cekNimMax($nim) {
		$q = $this->db->query("select * from tbl_mahasiswa where nim='".$nim."'");
		$hasil = 0;
		if($q->num_rows()>0)
		{
			$hasil = 1;
		}
		return $hasil;
	}
	
	//query untuk mengambil daftar mata kuliah yang dipegang oleh dosen bersangkutan
	function getDosenMk($kd) {
		return $this->db->query("SELECT a.kd_dosen, a.nama_dosen,b.nama_mk,b.kd_mk,b.jadwal FROM tbl_dosen a left join
		(select y.kd_mk,x.kd_dosen, y.nama_mk,x.jadwal from tbl_jadwal x left join tbl_mk y on x.kd_mk=y.kd_mk) b
		on a.kd_dosen=b.kd_dosen where a.kd_dosen='".$kd."' and b.kd_mk!=''");
	}
	
	//query untuk mengambil daftar dosen yang memegang mata kuliah bersangkutan
	function getMkDosen($kd) {
		return $this->db->query("SELECT a.kd_mk, a.nama_mk,b.nama_dosen,b.kd_dosen,b.jadwal FROM tbl_mk a left join
		(select x.kd_mk,y.kd_dosen, y.nama_dosen,x.jadwal from tbl_jadwal x left join tbl_dosen y on x.kd_dosen=y.kd_dosen) b
		on a.kd_mk=b.kd_mk where a.kd_mk='".$kd."' and b.kd_dosen!=''");
	}
	
	//query untuk mengambil detail mahasiswa untuk diedit
	function getEditMahasisiwa($nim) {
		return $this->db->query("SELECT a.nim, a.nama_mahasiswa, a.angkatan, a.jurusan, a.kelas_program, b.kd_dosen FROM tbl_mahasiswa a left join 
		tbl_dosen_wali b on a.nim=b.nim where a.nim='".$nim."'");
	}
}

/* End of file web_app_model.php */
/* Location: ./application/models/web_app_model.php */