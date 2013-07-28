<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Web_Mobile extends CI_Controller {

	/**
	 * @author : Gede Lumbung
	 * @web : http://gedelumbung.com
	 * @keterangan : Controller untuk halaman awal ketika aplikasi krs versi mobile/android diakses
	 **/
	public function _construct()
	{
		session_start();
	}
	
	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		if(empty($cek))
		{
			$this->login();
		}
		else
		{
			$this->home();
		}
	}
	
	public function login()
	{
		$cek = $this->session->userdata('logged_in');
		if(empty($cek))
		{
			$d['pesan'] = "Selamat Datang di Sistem Informasi Akademik Online STIKOM PGRI Banyuwangi versi android. 
			Silahkan masukkan username dan password untuk mengakses informasi di Sistem Informasi Akademik STIKOM PGRI Banyuwangi.";
			
			//buat atribut form
			$frm['username'] = array('name' => 'username',
				'id' => 'name',
				'type' => 'text',
				'value' => '',
				'placeholder' => 'Masukkan username.....'
			);
			$frm['password'] = array('name' => 'password',
				'id' => 'password',
				'type' => 'password',
				'value' => '',
				'placeholder' => 'Masukkan password.....'
			);
			
			$this->load->view('mobile_mahasiswa/bg_top',$d);
			$this->load->view('mobile_mahasiswa/bg_login',$frm);
		}
		else
		{
			$this->home();
		}
	}
	
	public function loginact()
	{
		$dl['username'] = mysql_real_escape_string($this->input->post('username'));
		$dl['password']= mysql_real_escape_string(md5($this->input->post('password')));
		$dl['stts']= "mahasiswa";
		
		$hasil = $this->web_app_model->getSelectedDataMultiple('tbl_login',$dl);
		if (count($hasil->result_array())>0){
			$q_ambil_data = $this->web_app_model->getSelectedDataMultiple('tbl_mahasiswa',array('nim' => $dl['username']));
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
			$this->home();
		}
		else{
			$this->login();
		}
	}
	
	public function logout()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek))
		{
			$this->session->sess_destroy();
			$d['pesan'] = "Log Out Sukses....!!!<br>Selamat Datang di Sistem Informasi Akademik Online STIKOM PGRI Banyuwangi versi android. 
			Silahkan masukkan username dan password untuk mengakses informasi di Sistem Informasi Akademik STIKOM PGRI Banyuwangi.";
			
			//buat atribut form
			$frm['username'] = array('name' => 'username',
				'id' => 'name',
				'type' => 'text',
				'value' => '',
				'placeholder' => 'Masukkan username.....'
			);
			$frm['password'] = array('name' => 'password',
				'id' => 'password',
				'type' => 'password',
				'value' => '',
				'placeholder' => 'Masukkan password.....'
			);
			
			$this->load->view('mobile_mahasiswa/bg_top',$d);
			$this->load->view('mobile_mahasiswa/bg_login',$frm);
		}
		else
		{
			$d['pesan'] = "Log Out Sukses....!!!<br>Selamat Datang di Sistem Informasi Akademik Online STIKOM PGRI Banyuwangi versi android. 
			Silahkan masukkan username dan password untuk mengakses informasi di Sistem Informasi Akademik STIKOM PGRI Banyuwangi.";
			
			//buat atribut form
			$frm['username'] = array('name' => 'username',
				'id' => 'name',
				'type' => 'text',
				'value' => '',
				'placeholder' => 'Masukkan username.....'
			);
			$frm['password'] = array('name' => 'password',
				'id' => 'password',
				'type' => 'password',
				'value' => '',
				'placeholder' => 'Masukkan password.....'
			);
			
			$this->load->view('mobile_mahasiswa/bg_top',$d);
			$this->load->view('mobile_mahasiswa/bg_login',$frm);
		}
	}
	
	public function home()
	{
		$cek = $this->session->userdata('logged_in');
		$st = $this->session->userdata('stts');
		if(!empty($cek) && $st=="mahasiswa")
		{
			$bc['nama'] = $this->session->userdata('nama');
			$bc['status'] = $this->session->userdata('stts');
			$bc['nim'] = $this->session->userdata('nim');
			$bc['program'] = $this->session->userdata('program');
			$bc['jurusan'] = $this->session->userdata('jurusan');
			$bc['smt_skr'] = $this->web_app_model->getSemesterMax($bc['nim']);
			$bc['ipk'] = $this->web_app_model->getIpk($bc['nim'],$bc['smt_skr']-1);
			$bc['dosen_wali'] = $this->web_app_model->getDosenWali($bc['nim']);
			$bc['tahun_ajaran'] = $this->web_app_model->getTahunAjaran();
			$bc['detail_krs'] = $this->web_app_model->getDetailKrs($bc['nim']);
			$bc['info'] = $this->web_app_model->getAllData("tbl_info");
			$bc['beban_studi'] = beban_studi($bc['ipk']);
			
			$this->load->view('mobile_mahasiswa/bg_top');
			$this->load->view('mobile_mahasiswa/bg_menu',$bc);
			$this->load->view('mobile_mahasiswa/bg_home');
		}
		else
		{
			$this->login();
		}
	}
	
	public function khs()
	{
		$cek = $this->session->userdata('logged_in');
		$st = $this->session->userdata('stts');
		if(!empty($cek) && $st=="mahasiswa")
		{
			$bc['nama'] = $this->session->userdata('nama');
			$bc['status'] = $this->session->userdata('stts');
			$bc['nim'] = $this->session->userdata('nim');
			$bc['program'] = $this->session->userdata('program');
			$bc['jurusan'] = $this->session->userdata('jurusan');
			$bc['smt_skr'] = $this->web_app_model->getSemesterMax($bc['nim']);
			$bc['ipk'] = $this->web_app_model->getIpk($bc['nim'],$bc['smt_skr']-1);
			$bc['dosen_wali'] = $this->web_app_model->getDosenWali($bc['nim']);
			$bc['tahun_ajaran'] = $this->web_app_model->getTahunAjaran();
			$bc['detail_krs'] = $this->web_app_model->getDetailKrs($bc['nim']);
			$bc['beban_studi'] = beban_studi($bc['ipk']);
			
			$bc['khs'] = $this->web_app_model->getNilai($bc['nim']);
			$this->load->view('mobile_mahasiswa/bg_top');
			$this->load->view('mobile_mahasiswa/bg_menu',$bc);
			$this->load->view('mobile_mahasiswa/bg_khs',$bc);
		}
		else
		{
			$this->login();
		}
	}
	
	public function akun()
	{
		$cek = $this->session->userdata('logged_in');
		$st = $this->session->userdata('stts');
		if(!empty($cek) && $st=="mahasiswa")
		{
			$bc['nama'] = $this->session->userdata('nama');
			$bc['status'] = $this->session->userdata('stts');
			$bc['nim'] = $this->session->userdata('nim');
			$bc['program'] = $this->session->userdata('program');
			$bc['jurusan'] = $this->session->userdata('jurusan');
			$bc['smt_skr'] = $this->web_app_model->getSemesterMax($bc['nim']);
			$bc['ipk'] = $this->web_app_model->getIpk($bc['nim'],$bc['smt_skr']-1);
			$bc['dosen_wali'] = $this->web_app_model->getDosenWali($bc['nim']);
			$bc['tahun_ajaran'] = $this->web_app_model->getTahunAjaran();
			$bc['detail_krs'] = $this->web_app_model->getDetailKrs($bc['nim']);
			$bc['beban_studi'] = beban_studi($bc['ipk']);
			
			$bc['pesan'] = "Pengaturan Akun";
			$this->load->view('mobile_mahasiswa/bg_top');
			$this->load->view('mobile_mahasiswa/bg_menu',$bc);
			$this->load->view('mobile_mahasiswa/bg_akun',$bc);
		}
		else
		{
			$this->login();
		}
	}
	
	public function simpan_akun()
	{
		$cek = $this->session->userdata('logged_in');
		$st = $this->session->userdata('stts');
		if(!empty($cek) && $st=="mahasiswa")
		{
			$bc['nama'] = $this->session->userdata('nama');
			$bc['status'] = $this->session->userdata('stts');
			$bc['nim'] = $this->session->userdata('nim');
			$bc['program'] = $this->session->userdata('program');
			$bc['jurusan'] = $this->session->userdata('jurusan');
			
			$username = $this->session->userdata('nim');
			$pass_lama = $this->input->post('pass_lama');
			$pass_baru = $this->input->post('pass_baru');
			$ulangi_pass = $this->input->post('ulangi_pass');
			
			$data['username'] = $username;
			$data['password'] = md5($pass_lama);
			$cek = $this->web_app_model->getSelectedDataMultiple('tbl_login',$data);
			if($cek->num_rows()>0)
			{
				if($pass_baru==$ulangi_pass)
				{
					$simpan['password'] = md5($pass_baru);
					$where = array('username'=>$username);
					$this->web_app_model->updateDataMultiField("tbl_login",$simpan,$where);
					$bc['pesan'] = "Berhasil mengubah password....";
					$this->load->view('mobile_mahasiswa/bg_top');
					$this->load->view('mobile_mahasiswa/bg_menu',$bc);
					$this->load->view('mobile_mahasiswa/bg_akun',$bc);
				}
				else
				{
					$bc['pesan'] = "Password tidak sama....";
					$this->load->view('mobile_mahasiswa/bg_top');
					$this->load->view('mobile_mahasiswa/bg_menu',$bc);
					$this->load->view('mobile_mahasiswa/bg_akun',$bc);
				}
			}
			else
			{
				$bc['pesan'] = "Password lama salah....";
				$this->load->view('mobile_mahasiswa/bg_top');
				$this->load->view('mobile_mahasiswa/bg_menu',$bc);
				$this->load->view('mobile_mahasiswa/bg_akun',$bc);
			}
			
		}
		else
		{
			$this->login();
		}
	}
	
	public function info()
	{
		$cek = $this->session->userdata('logged_in');
		$st = $this->session->userdata('stts');
		if(!empty($cek) && $st=="mahasiswa")
		{
			$bc['nama'] = $this->session->userdata('nama');
			$bc['status'] = $this->session->userdata('stts');
			$bc['nim'] = $this->session->userdata('nim');
			$bc['program'] = $this->session->userdata('program');
			$bc['jurusan'] = $this->session->userdata('jurusan');
			$bc['smt_skr'] = $this->web_app_model->getSemesterMax($bc['nim']);
			$bc['ipk'] = $this->web_app_model->getIpk($bc['nim'],$bc['smt_skr']-1);
			$bc['dosen_wali'] = $this->web_app_model->getDosenWali($bc['nim']);
			$bc['tahun_ajaran'] = $this->web_app_model->getTahunAjaran();
			$bc['detail_krs'] = $this->web_app_model->getDetailKrs($bc['nim']);
			$bc['beban_studi'] = beban_studi($bc['ipk']);
			
			
			$page=$this->uri->segment(3);
			$limit=5;
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;
			$bc['info'] = $this->web_app_model->getAllDataLimited('tbl_info',$offset,$limit);
			$tot_hal =  $this->web_app_model->getAllData('tbl_info');
			$config['base_url'] = base_url() . 'web_mobile/info/';
			$config['total_rows'] = $tot_hal->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
			$config['first_link'] = '<<';
			$config['last_link'] = '>>';
			$config['next_link'] = '>';
			$config['prev_link'] = '<';
			$this->pagination->initialize($config);
			$bc["paginator"] =$this->pagination->create_links();
			
			$this->load->view('mobile_mahasiswa/bg_top');
			$this->load->view('mobile_mahasiswa/bg_menu',$bc);
			$this->load->view('mobile_mahasiswa/bg_info',$bc);
		}
		else
		{
			$this->login();
		}
	}
	
	public function krs()
	{
		$cek = $this->session->userdata('logged_in');
		$st = $this->session->userdata('stts');
		if(!empty($cek) && $st=="mahasiswa")
		{
			$bc['nama'] = $this->session->userdata('nama');
			$bc['status'] = $this->session->userdata('stts');
			$bc['nim'] = $this->session->userdata('nim');
			$bc['program'] = $this->session->userdata('program');
			$bc['jurusan'] = $this->session->userdata('jurusan');
			$bc['smt_skr'] = $this->web_app_model->getSemesterMax($bc['nim']);
			$bc['ipk'] = $this->web_app_model->getIpk($bc['nim'],$bc['smt_skr']-1);
			$bc['dosen_wali'] = $this->web_app_model->getDosenWali($bc['nim']);
			$bc['tahun_ajaran'] = $this->web_app_model->getTahunAjaran();
			$bc['detail_krs'] = $this->web_app_model->getDetailKrs($bc['nim']);
			$bc['beban_studi'] = beban_studi($bc['ipk']);
			
			$st = '';
			$cek = $this->web_app_model->getSelectedData('tbl_perwalian_header','nim',$bc['nim']);
			foreach($cek->result() as $c)
			{
				$st = $c->status;
			}
			
			if($st==0)
			{
				$bc['jadwal'] = $this->web_app_model->getJadwal($bc['nim'],$bc['program']);
				$bc['detailfrs'] = $this->web_app_model->getDetailKrsPersetujuan($bc['nim'],$bc['program']);
				
				$this->load->view('mobile_mahasiswa/bg_top');
				$this->load->view('mobile_mahasiswa/bg_menu',$bc);
				$this->load->view('mobile_mahasiswa/bg_jadwal',$bc);
			}
			else if($st==1)
			{
				$bc['jadwal'] = $this->web_app_model->getDetailKrsPersetujuan($bc['nim'],$bc['program']);
			
				$this->load->view('mobile_mahasiswa/bg_top');
				$this->load->view('mobile_mahasiswa/bg_menu',$bc);
				$this->load->view('mobile_mahasiswa/jadwal',$bc);
			}
		}
		else
		{
			$this->login();
		}
	}
	
	public function jadwal()
	{
		$cek = $this->session->userdata('logged_in');
		$st = $this->session->userdata('stts');
		if(!empty($cek) && $st=="mahasiswa")
		{
			$bc['nama'] = $this->session->userdata('nama');
			$bc['status'] = $this->session->userdata('stts');
			$bc['nim'] = $this->session->userdata('nim');
			$bc['program'] = $this->session->userdata('program');
			$bc['jurusan'] = $this->session->userdata('jurusan');
			$bc['smt_skr'] = $this->web_app_model->getSemesterMax($bc['nim']);
			$bc['ipk'] = $this->web_app_model->getIpk($bc['nim'],$bc['smt_skr']-1);
			$bc['dosen_wali'] = $this->web_app_model->getDosenWali($bc['nim']);
			$bc['tahun_ajaran'] = $this->web_app_model->getTahunAjaran();
			$bc['detail_krs'] = $this->web_app_model->getDetailKrs($bc['nim']);
			$bc['beban_studi'] = beban_studi($bc['ipk']);
			
			$st = '';
			$cek = $this->web_app_model->getSelectedData('tbl_perwalian_header','nim',$bc['nim']);
			foreach($cek->result() as $c)
			{
				$st = $c->status;
			}
			if($st=="1")
			{
				$bc['jadwal'] = $this->web_app_model->getDetailKrsPersetujuan($bc['nim'],$bc['program']);
				
				$this->load->view('mobile_mahasiswa/bg_top');
				$this->load->view('mobile_mahasiswa/bg_menu',$bc);
				$this->load->view('mobile_mahasiswa/jadwal',$bc);
			}
			else
			{
				$bc['jadwal'] = $this->web_app_model->getJadwal($bc['nim'],$bc['program']);
				
				$this->load->view('mobile_mahasiswa/bg_top');
				$this->load->view('mobile_mahasiswa/bg_menu',$bc);
				$this->load->view('mobile_mahasiswa/bg_jadwal',$bc);
			}
		}
		else
		{
			$this->login();
		}
	}
	
	public function simpan_krs()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='mahasiswa')
		{
			$nim = $this->input->post('nim');
			$smt = $this->input->post('semester');
			$detailfrs = $this->input->post('detailfrs');
			if($detailfrs!="")
			{
				$data_header=array(
					'nim' => $nim ,
					'tgl_perwalian' => date("Y-m-d"),
					'tgl_persetujuan' => "",
					'status' => "0",
					'semester' => $smt);
				$data_detail=array();
				$temp=explode("|", $detailfrs);
				foreach($temp as $value) 
				{
					$data_detail[]=array(
					'nim' => $nim ,
					'kd_jadwal' => $value);
				}
				$this->web_app_model->deleteKrs($nim,$smt);
				$this->web_app_model->insertKrs($data_header,$data_detail);
				$alert = "Kartu rencana studi anda berhasil disimpan.";
				$this->home();
			}
			else{
				$this->web_app_model->deleteKrs($nim,$smt);
				$alert = "Kartu rencana studi anda berhasil disimpan.";
				$this->home($alert);
			}
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
}

/* End of file web_mobile.php */
/* Location: ./application/controllers/web_mobile.php */