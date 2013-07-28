<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dosen extends CI_Controller {

	/**
	 * @author : Gede Lumbung
	 * @web : http://gedelumbung.com
	 * @keterangan : Controller untuk halaman khusus dosen
	 */
	
	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='dosen')
		{
			$d['judul'] = "Beranda - Sistem Informasi Akademik Online";
			
			$bc['nama'] = $this->session->userdata('nama');
			$bc['status'] = $this->session->userdata('stts');
			$bc['kd_dosen'] = $this->session->userdata('kd_dosen');
			$bc['menu'] = $this->load->view('dosen/menu', '', true);
			$bc['bio'] = $this->load->view('dosen/bio', $bc, true);
			
			$this->load->view('global/bg_top',$d);
			$this->load->view('dosen/bg_home',$bc);
			$this->load->view('global/bg_footer',$d);
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function persetujuan()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='dosen')
		{
			$d['judul'] = "Persetujuan KRS - Sistem Informasi Akademik Online";
			
			$bc['nama'] = $this->session->userdata('nama');
			$bc['status'] = $this->session->userdata('stts');
			$bc['kd_dosen'] = $this->session->userdata('kd_dosen');
			$bc['menu'] = $this->load->view('dosen/menu', '', true);
			$bc['bio'] = $this->load->view('dosen/bio', $bc, true);
			$bc['mhs'] = $this->web_app_model->getMahasiswaBimbingan($bc['kd_dosen']);
			
			$this->load->view('global/bg_top',$d);
			$this->load->view('dosen/bg_persetujuan',$bc);
			$this->load->view('global/bg_footer',$d);
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function detail_krs()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='dosen')
		{
			$bc['nim'] = $this->uri->segment(3);
			$bc['status'] = $this->uri->segment(4);
			$bc['smt_skr'] = $this->web_app_model->getSemesterMax($bc['nim']);
			$bc['ipk'] = $this->web_app_model->getIpk($bc['nim'],$bc['smt_skr']-1);
			$bc['dosen_wali'] = $this->web_app_model->getDosenWali($bc['nim']);
			$bc['tahun_ajaran'] = $this->web_app_model->getTahunAjaran();
			$bc['beban_studi'] = beban_studi($bc['ipk']);
			$dt_mhs = $this->web_app_model->getSelectedData("tbl_mahasiswa","nim",$bc['nim']);
			foreach($dt_mhs->result() as $dm)
			{
				$bc['nama_mhs'] = $dm->nama_mahasiswa;
				$bc['program'] = $dm->kelas_program;
				$bc['jurusan'] = $dm->jurusan;
				$bc['kelas_program'] = $dm->kelas_program;
			}
			
			$bc['detailfrs'] = $this->web_app_model->getDetailKrsPersetujuan($bc['nim'],$bc['kelas_program']);
			
			$this->load->view('dosen/bg_detail_krs',$bc);
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function hapus_krs()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='dosen')
		{
			$dt_mentah = $this->input->post('id');
			$dt = explode("|",$dt_mentah);
			$data['nim'] = $dt[0];
			$data['kd_jadwal'] = $dt[1];
			$this->web_app_model->deleteData("tbl_perwalian_detail",$data);
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	function setuju_krs()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='dosen')
		{
			$data_update['nim'] = $this->input->post('nim');
			$data_update['status'] = '1';
			$data_update['tgl_persetujuan'] = date("Y-m-d"); 
			$this->web_app_model->updateData('tbl_perwalian_header',$data_update,$data_update['nim'],'nim');
			echo "<div style='width:95%; position:absolute; text-align:center; color:#fff; padding:10px; background-color:red;'>
			Kartu Rencana Studi berhasil disetujui...!!!
			</div>";
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	function batal_krs()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='dosen')
		{
			$data_update['nim'] = $this->input->post('nim');
			$data_update['status'] = '0';
			$data_update['tgl_persetujuan'] = ""; 
			$this->web_app_model->updateData('tbl_perwalian_header',$data_update,$data_update['nim'],'nim');
			echo "<div style='width:95%; position:absolute; text-align:center; color:#fff; padding:10px; background-color:red;'>
			Kartu Rencana Studi berhasil dibatalkan...!!!
			</div>";
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function nilai()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='dosen')
		{
			$d['judul'] = "Input Nilai Mahasiswa - Sistem Informasi Akademik Online";
			
			$bc['nama'] = $this->session->userdata('nama');
			$bc['status'] = $this->session->userdata('stts');
			$bc['kd_dosen'] = $this->session->userdata('kd_dosen');
			$bc['menu'] = $this->load->view('dosen/menu', '', true);
			$bc['bio'] = $this->load->view('dosen/bio', $bc, true);
			$bc['mhs'] = $this->web_app_model->getDaftarMahasiswaNilai($bc['kd_dosen']);
			
			$this->load->view('global/bg_top',$d);
			$this->load->view('dosen/bg_daftar_mahasiswa',$bc);
			$this->load->view('global/bg_footer',$d);
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function input_nilai()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='dosen')
		{
			$d['judul'] = "Input Nilai Mahasiswa - Sistem Informasi Akademik Online";
			
			$bc['nama'] = $this->session->userdata('nama');
			$bc['status'] = $this->session->userdata('stts');
			$bc['kd_dosen'] = $this->session->userdata('kd_dosen');
			$bc['menu'] = $this->load->view('dosen/menu', '', true);
			$bc['bio'] = $this->load->view('dosen/bio', $bc, true);
			$nim = $this->uri->segment(3);
			
			$dt_mhs = $this->web_app_model->getSelectedData("tbl_mahasiswa","nim",$nim);
			foreach($dt_mhs->result() as $dm)
			{
				$bc['nama_mhs'] = $dm->nama_mahasiswa;
				$bc['program'] = $dm->kelas_program;
				$bc['jurusan'] = $dm->jurusan;
				$bc['kelas_program'] = $dm->kelas_program;
			}
			
			$bc['detailfrs'] = $this->web_app_model->getDetailKrsPersetujuan($nim,$bc['kelas_program']);
			$bc['khs'] = $this->web_app_model->getNilai($nim);
			
			$this->load->view('global/bg_top',$d);
			$this->load->view('dosen/bg_input_nilai',$bc);
			$this->load->view('global/bg_footer',$d);
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function edit_nilai()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='dosen')
		{
			$nim = $this->uri->segment(3);
			$kd_mk = $this->uri->segment(4);
			$bc['edit'] = $this->web_app_model->getEditDetailNilai($nim,$kd_mk);
			
			$this->load->view('dosen/bg_edit_nilai',$bc);
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function form_input_nilai()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='dosen')
		{
			$nim = $this->uri->segment(3);
			$kd_jdw = $this->uri->segment(4);
			$cek_smt = $this->web_app_model->getSelectedData('tbl_perwalian_header','nim',$nim);
			$bc['smt'] = "";
			foreach($cek_smt->result() as $c)
			{
				$bc['smt'] = $c->semester;
			}
			$bc['input'] = $this->web_app_model->getInputDetailNilai($nim,$kd_jdw);
			
			$this->load->view('dosen/bg_form_input_nilai',$bc);
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function simpan_nilai()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='dosen')
		{
			$st = $this->input->post('stts');
			
			if($st=='edit')
			{
				//$di['nim'] = $this->input->post('nim');
				//$di['kd_mk'] = $this->input->post('kd_mk');
				$nim = $this->input->post('nim');
				$kd_mk = $this->input->post('kd_mk');
				$di['kd_dosen'] = $this->input->post('kd_dosen');
				$di['kd_tahun'] = $this->input->post('kd_tahun');
				$di['semester_ditempuh'] = $this->input->post('semester_ditempuh');
				$di['grade'] = $this->input->post('grade');
				$this->web_app_model->updateDataMultiField('tbl_nilai',$di,array('nim'=>$nim, 'kd_mk'=>$kd_mk));
				?>
					<script>
					window.parent.location.reload(true);
					</script>
				<?php
			}
			
			else if($st=='tambah')
			{
				$di['nim'] = $this->input->post('nim');
				$di['kd_mk'] = $this->input->post('kd_mk');
				$di['kd_dosen'] = $this->input->post('kd_dosen');
				$di['kd_tahun'] = $this->input->post('kd_tahun');
				$di['semester_ditempuh'] = $this->input->post('semester_ditempuh');
				$di['grade'] = $this->input->post('grade');
				$this->web_app_model->insertData('tbl_nilai',$di);
				?>
					<script>
					window.parent.location.reload(true);
					</script>
				<?php
			}
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function hapus_nilai()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='dosen')
		{
			$dl['nim'] = $this->uri->segment(3);
			$dl['kd_mk'] = $this->uri->segment(4);
			$this->web_app_model->deleteData('tbl_nilai',$dl);
			header('location:'.base_url().'dosen/input_nilai/'.$dl['nim']);
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
		if(!empty($cek) && $stts=='dosen')
		{
			$d['judul'] = "Info Kampus - Sistem Informasi Akademik Online";
		
			$bc['nama'] = $this->session->userdata('nama');
			$bc['status'] = $this->session->userdata('stts');
			$bc['kd_dosen'] = $this->session->userdata('kd_dosen');
			$bc['menu'] = $this->load->view('dosen/menu', '', true);
			$bc['bio'] = $this->load->view('dosen/bio', $bc, true);
			
			$this->load->view('global/bg_top',$d);
			$this->load->view('dosen/bg_akun',$bc);
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
		if(!empty($cek) && $stts=='dosen')
		{
			$username = $this->session->userdata('kd_dosen');
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
					header('location:'.base_url().'dosen/akun');
				}
				else
				{
					$this->session->set_flashdata("save_akun","
					<p style='padding:10px; background-color:#0BE0F6; text-align:center; margin:0px;'>
					Password Tidak Sama</p>");
					header('location:'.base_url().'dosen/akun');
				}
			}
			else
			{
				$this->session->set_flashdata("save_akun","
				<p style='padding:10px; background-color:#0BE0F6; text-align:center; margin:0px;'>
				Password Lama Salah</p>");
				header('location:'.base_url().'dosen/akun');
			}
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
}

/* End of file dosen.php */
/* Location: ./application/controllers/dosen.php */