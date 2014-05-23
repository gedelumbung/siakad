<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

	/**
	 * @author : Gede Lumbung
	 * @web : http://gedelumbung.com
	 * @keterangan : Controller untuk halaman khusus mahasiswa
	 */
	
	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='mahasiswa')
		{
			$d['judul'] = "Beranda - Sistem Informasi Akademik Online";
			
			$bc['nama'] = $this->session->userdata('nama');
			$bc['status'] = $this->session->userdata('stts');
			$bc['nim'] = $this->session->userdata('nim');
			$bc['menu'] = $this->load->view('mahasiswa/menu', '', true);
			$bc['bio'] = $this->load->view('mahasiswa/bio', $bc, true);
			
			$this->load->view('global/bg_top',$d);
			$this->load->view('mahasiswa/bg_home',$bc);
			$this->load->view('global/bg_footer',$d);
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function krs()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='mahasiswa')
		{
			$d['judul'] = "Kartu Rencana Studi - Sistem Informasi Akademik Online";
			
			
			
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
			$bc['menu'] = $this->load->view('mahasiswa/menu', '', true);
			$bc['bio'] = $this->load->view('mahasiswa/bio', $bc, true);
			
			$kls = $this->session->userdata('program');
			$bc['jadwal'] = $this->web_app_model->getJadwal($bc['nim'],$kls);
			$bc['detailfrs'] = $this->web_app_model->getDetailKrsPersetujuan($bc['nim'],$bc['program']);
			
			$st = '';
			$cek = $this->web_app_model->getSelectedData('tbl_perwalian_header','nim',$bc['nim']);
			foreach($cek->result() as $c)
			{
				$st = $c->status;
			}
			
			$this->load->view('global/bg_top',$d);
			
			if($st==0)
			{
				$this->load->view('mahasiswa/bg_jadwal',$bc);
			}
			else if($st==1)
			{
				$this->load->view('mahasiswa/bg_detail_krs',$bc);
			}
			
			$this->load->view('global/bg_footer',$d);
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function khs()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='mahasiswa')
		{
			$d['judul'] = "Kartu Hasil Studi - Sistem Informasi Akademik Online";
				
			$bc['nama'] = $this->session->userdata('nama');
			$bc['status'] = $this->session->userdata('stts');
			$bc['nim'] = $this->session->userdata('nim');
			$bc['menu'] = $this->load->view('mahasiswa/menu', '', true);
			$bc['bio'] = $this->load->view('mahasiswa/bio', $bc, true);
			$bc['khs'] = $this->web_app_model->getNilai($bc['nim']);
			
			$this->load->view('global/bg_top',$d);
			$this->load->view('mahasiswa/bg_nilai',$bc);
			$this->load->view('global/bg_footer',$d);
		}
		else
		{
			header('location:'.base_url().'web');
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
				$this->session->set_flashdata('save_krs', '<p style="padding:10px; background-color:#0BE0F6; text-align:center; margin:0px;">Kartu Rencana Studi berhasil disimpan...!!! Silahkan menghubungi bagian administrasi untuk melakukan pembayaran.</p>');
				header('location:'.base_url().'mahasiswa/krs');
			}
			else{
				$this->web_app_model->deleteKrs($nim,$smt);
				header('location:'.base_url().'mahasiswa/krs');
			}
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function peserta()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='mahasiswa')
		{
			$d = explode("_",$this->uri->segment(3));
			$bc['peserta'] = $this->web_app_model->getPeserta($d[0],$d[1]);
			
			$this->load->view('mahasiswa/bg_peserta',$bc);
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function info_kampus()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='mahasiswa')
		{
			$d['judul'] = "Info Kampus - Sistem Informasi Akademik Online";
				
			$bc['nama'] = $this->session->userdata('nama');
			$bc['status'] = $this->session->userdata('stts');
			$bc['nim'] = $this->session->userdata('nim');
			$bc['menu'] = $this->load->view('mahasiswa/menu', '', true);
			$bc['bio'] = $this->load->view('mahasiswa/bio', $bc, true);
			
			$page=$this->uri->segment(3);
			$limit=5;
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;
			$bc['info'] = $this->web_app_model->getAllDataLimited('tbl_info',$offset,$limit);
			$tot_hal =  $this->web_app_model->getAllData('tbl_info');
			$config['base_url'] = base_url() . 'mahasiswa/info_kampus/';
			$config['total_rows'] = $tot_hal->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
			$config['first_link'] = 'Awal';
			$config['last_link'] = 'Akhir';
			$config['next_link'] = 'Selanjutnya';
			$config['prev_link'] = 'Sebelumnya';
			$this->pagination->initialize($config);
			$bc["paginator"] =$this->pagination->create_links();
			
			$this->load->view('global/bg_top',$d);
			$this->load->view('mahasiswa/bg_info',$bc);
			$this->load->view('global/bg_footer',$d);
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function akun()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='mahasiswa')
		{
			$d['judul'] = "Info Kampus - Sistem Informasi Akademik Online";
		
			$bc['nama'] = $this->session->userdata('nama');
			$bc['status'] = $this->session->userdata('stts');
			$bc['nim'] = $this->session->userdata('nim');
			$bc['menu'] = $this->load->view('mahasiswa/menu', '', true);
			$bc['bio'] = $this->load->view('mahasiswa/bio', $bc, true);
			
			$this->load->view('global/bg_top',$d);
			$this->load->view('mahasiswa/bg_akun',$bc);
			$this->load->view('global/bg_footer',$d);
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function simpan_akun()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='mahasiswa')
		{
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
					$this->session->set_flashdata("save_akun","
					<p style='padding:10px; background-color:#0BE0F6; text-align:center; margin:0px;'>
					Berhasil mengubah password</p>");
					header('location:'.base_url().'mahasiswa/akun');
				}
				else
				{
					$this->session->set_flashdata("save_akun","
					<p style='padding:10px; background-color:#0BE0F6; text-align:center; margin:0px;'>
					Password Tidak Sama</p>");
					header('location:'.base_url().'mahasiswa/akun');
				}
			}
			else
			{
				$this->session->set_flashdata("save_akun","
				<p style='padding:10px; background-color:#0BE0F6; text-align:center; margin:0px;'>
				Password Lama Salah</p>");
				header('location:'.base_url().'mahasiswa/akun');
			}
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
}

/* End of file mahasiswa.php */
/* Location: ./application/controllers/mahasiswa.php */