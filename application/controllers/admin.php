<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	 * @author : Gede Lumbung
	 * @web : http://gedelumbung.com
	 * @keterangan : Controller untuk halaman khusus admin
	 */
	
	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$d['judul'] = "Beranda - Sistem Informasi Akademik Online";
			
			$bc['nama'] = $this->session->userdata('nama');
			$bc['status'] = $this->session->userdata('stts');
			$bc['username'] = $this->session->userdata('username');
			$bc['menu'] = $this->load->view('admin/menu', '', true);
			$bc['bio'] = $this->load->view('admin/bio', $bc, true);
			
			$this->load->view('global/bg_top',$d);
			$this->load->view('admin/bg_home',$bc);
			$this->load->view('global/bg_footer',$d);
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function tampil_jadwal()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$d['judul'] = "Manajemen Jadwal - Sistem Informasi Akademik Online";
			
			$bc['nama'] = $this->session->userdata('nama');
			$bc['status'] = $this->session->userdata('stts');
			$bc['username'] = $this->session->userdata('username');
			$bc['menu'] = $this->load->view('admin/menu', '', true);
			$bc['bio'] = $this->load->view('admin/bio', $bc, true);
			$bc['jadwal'] = $this->web_app_model->getSemuaJadwal();
			
			$this->load->view('global/bg_top',$d);
			$this->load->view('admin/bg_jadwal',$bc);
			$this->load->view('global/bg_footer',$d);
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function hapus_jadwal()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$id = $this->uri->segment(3);
			$hapus = array('kd_jadwal' => $id);
			$this->web_app_model->deleteData('tbl_jadwal',$hapus);
			header('location:'.base_url().'admin/tampil_jadwal');
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
		if(!empty($cek) && $stts=='admin')
		{
			$d = explode("_",$this->uri->segment(3));
			$bc['peserta'] = $this->web_app_model->getPeserta($d[0],$d[1]);
			
			$this->load->view('admin/bg_peserta',$bc);
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function edit_jadwal()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$bc['mata_kuliah'] = $this->web_app_model->getAllData('tbl_mk');
			$bc['dosen'] = $this->web_app_model->getAllData('tbl_dosen');
			$bc['tahun_ajaran'] = $this->web_app_model->getSelectedData('tbl_thn_ajaran','stts',1);
			$bc['edit'] = $this->web_app_model->getEditJadwal($this->uri->segment('3'));
			
			$this->load->view('admin/bg_edit_jadwal',$bc);
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function tambah_jadwal()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$bc['mata_kuliah'] = $this->web_app_model->getAllData('tbl_mk');
			$bc['dosen'] = $this->web_app_model->getAllData('tbl_dosen');
			$bc['tahun_ajaran'] = $this->web_app_model->getSelectedData('tbl_thn_ajaran','stts',1);
			
			$this->load->view('admin/bg_tambah_jadwal',$bc);
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function simpan_jadwal()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$st = $this->input->post("stts");
			
			$hari = $this->input->post('hari');
			$mulai = clear($this->input->post('jam_mulai'));
			$akhir = clear($this->input->post('jam_akhir'));
			$ruangan = clear($this->input->post('ruang'));
			$jadwal = $hari.' / '.$mulai.'-'.$akhir.' / '.$ruangan;
			
			$simpan["kd_mk"] = $this->input->post("kd_mk");
			$simpan["kd_dosen"] = $this->input->post("kd_dosen");
			$simpan["kd_tahun"] = $this->input->post("kd_tahun");
			$simpan["jadwal"] = $jadwal;
			$simpan["kapasitas"] = $this->input->post("kapasitas");
			$simpan["kelas_program"] = $this->input->post("kelas_program");
			$simpan["kelas"] = $this->input->post("kelas");
			
			if($st=="edit")
			{
				$kd_jadwal = $this->input->post('kd_jadwal');
				$where = array('kd_jadwal'=>$kd_jadwal);
				$this->web_app_model->updateDataMultiField("tbl_jadwal",$simpan,$where);
				?>
					<script>
					window.parent.location.reload(true);
					</script>
				<?php
			}
			else if($st=="tambah")
			{
				$this->web_app_model->insertData('tbl_jadwal',$simpan);
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
	
	public function dosen()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$d['judul'] = "Daftar Dosen - Sistem Informasi Akademik Online";
			
			$bc['nama'] = $this->session->userdata('nama');
			$bc['status'] = $this->session->userdata('stts');
			$bc['username'] = $this->session->userdata('username');
			$bc['menu'] = $this->load->view('admin/menu', '', true);
			$bc['bio'] = $this->load->view('admin/bio', $bc, true);
			$bc['dosen'] = $this->web_app_model->getAllData('tbl_dosen');
			
			$this->load->view('global/bg_top',$d);
			$this->load->view('admin/bg_dosen',$bc);
			$this->load->view('global/bg_footer',$d);
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function tambah_dosen()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$this->load->view('admin/bg_tambah_dosen');
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function edit_dosen()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$bc['dosen'] = $this->web_app_model->getSelectedData('tbl_dosen','kd_dosen',$this->uri->segment(3));
			
			$this->load->view('admin/bg_edit_dosen',$bc);
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function simpan_dosen()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$st = $this->input->post("stts");
			
			$simpan["nidn"] = $this->input->post("nidn");
			$simpan["nama_dosen"] = $this->input->post("nama_dosen");
			
			if($st=="edit")
			{
				$kd_dosen = $this->input->post('kd_dosen');
				$where = array('kd_dosen'=>$kd_dosen);
				$this->web_app_model->updateDataMultiField("tbl_dosen",$simpan,$where);
				?>
					<script>
					window.parent.location.reload(true);
					</script>
				<?php
			}
			else if($st=="tambah")
			{
				$simpan["kd_dosen"] = $this->input->post("kd_dosen");
				if($this->web_app_model->cekKodeDosenMax($simpan["kd_dosen"])==0)
				{
					$this->web_app_model->insertData('tbl_dosen',$simpan);
					$lg['username'] = $this->input->post("kd_dosen");
					$lg['password'] = md5($lg['username']);
					$lg['stts'] = "dosen";
					$this->web_app_model->insertData('tbl_login',$lg);
				?>
					<script>
					window.parent.location.reload(true);
					</script>
				<?php
				}
				else
				{
					$this->session->set_flashdata("save_dosen","
					<p style='padding:10px; background-color:#0BE0F6; text-align:center; margin:0px;'>
					Kode Dosen Telah Terpakai</p>");
				header('location:'.base_url().'admin/tambah_dosen');
				}
			}
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function hapus_dosen()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$id = $this->uri->segment(3);
			$hapus = array('kd_dosen' => $id);
			$hapus2 = array('username' => $id);
			$this->web_app_model->deleteData('tbl_dosen',$hapus);
			$this->web_app_model->deleteData('tbl_dosen_wali',$hapus);
			$this->web_app_model->deleteData('tbl_login',$hapus2);
			header('location:'.base_url().'admin/dosen');
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function dosen_mk()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$d['judul'] = "Daftar Dosen - Mata Kuliah - Sistem Informasi Akademik Online";
			
			$bc['nama'] = $this->session->userdata('nama');
			$bc['status'] = $this->session->userdata('stts');
			$bc['username'] = $this->session->userdata('username');
			$bc['menu'] = $this->load->view('admin/menu', '', true);
			$bc['bio'] = $this->load->view('admin/bio', $bc, true);
			$bc['dosen_mk'] = $this->web_app_model->getDosenMk($this->uri->segment(3));
			
			$this->load->view('global/bg_top',$d);
			$this->load->view('admin/bg_dosen_mk',$bc);
			$this->load->view('global/bg_footer',$d);
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function mk()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$d['judul'] = "Daftar Mata Kuliah - Sistem Informasi Akademik Online";
			
			$bc['nama'] = $this->session->userdata('nama');
			$bc['status'] = $this->session->userdata('stts');
			$bc['username'] = $this->session->userdata('username');
			$bc['menu'] = $this->load->view('admin/menu', '', true);
			$bc['bio'] = $this->load->view('admin/bio', $bc, true);
			$bc['mk'] = $this->web_app_model->getAllData('tbl_mk');
			
			$this->load->view('global/bg_top',$d);
			$this->load->view('admin/bg_mk',$bc);
			$this->load->view('global/bg_footer',$d);
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function tambah_mk()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$this->load->view('admin/bg_tambah_mk');
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function edit_mk()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$bc['mk'] = $this->web_app_model->getSelectedData('tbl_mk','kd_mk',$this->uri->segment(3));
			$this->load->view('admin/bg_edit_mk',$bc);
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function simpan_mk()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$st = $this->input->post("stts");
			
			$simpan["nama_mk"] = $this->input->post("nama_mk");
			$simpan["jum_sks"] = $this->input->post("jum_sks");
			$simpan["semester"] = $this->input->post("semester");
			$simpan["prasyarat_mk"] = $this->input->post("prasyarat_mk");
			$simpan["kode_jur"] = $this->input->post("kode_jur");
			
			if($st=="edit")
			{
				$kd_mk = $this->input->post('kd_mk');
				$where = array('kd_mk'=>$kd_mk);
				$this->web_app_model->updateDataMultiField("tbl_mk",$simpan,$where);
				?>
					<script>
					window.parent.location.reload(true);
					</script>
				<?php
			}
			else if($st=="tambah")
			{
				$simpan["kd_mk"] = $this->input->post("kd_mk");
				if($this->web_app_model->cekKodeMkMax($simpan["kd_mk"])==0)
				{
					$this->web_app_model->insertData('tbl_mk',$simpan);
				?>
					<script>
					window.parent.location.reload(true);
					</script>
				<?php
				}
				else
				{
					$this->session->set_flashdata("save_mk","
					<p style='padding:10px; background-color:#0BE0F6; text-align:center; margin:0px;'>
					Kode Mata Kuliah Telah Terpakai</p>");
				header('location:'.base_url().'admin/tambah_mk');
				}
			}
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function hapus_mk()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$id = $this->uri->segment(3);
			$hapus = array('kd_mk' => $id);
			$this->web_app_model->deleteData('tbl_mk',$hapus);
			$this->web_app_model->deleteData('tbl_jadwal',$hapus);
			header('location:'.base_url().'admin/mk');
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function mk_dosen()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$d['judul'] = "Daftar Mata Kuliah - Dosen - Sistem Informasi Akademik Online";
			
			$bc['nama'] = $this->session->userdata('nama');
			$bc['status'] = $this->session->userdata('stts');
			$bc['username'] = $this->session->userdata('username');
			$bc['menu'] = $this->load->view('admin/menu', '', true);
			$bc['bio'] = $this->load->view('admin/bio', $bc, true);
			$bc['mk_dosen'] = $this->web_app_model->getMkDosen($this->uri->segment(3));
			
			$this->load->view('global/bg_top',$d);
			$this->load->view('admin/bg_mk_dosen',$bc);
			$this->load->view('global/bg_footer',$d);
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function mahasiswa()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$d['judul'] = "Daftar Mahasiswa - Sistem Informasi Akademik Online";

			$page=$this->uri->segment(3);
			$limit=20;
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;	
		
			$bc['nama'] = $this->session->userdata('nama');
			$bc['status'] = $this->session->userdata('stts');
			$bc['username'] = $this->session->userdata('username');
			$bc['menu'] = $this->load->view('admin/menu', '', true);
			$bc['bio'] = $this->load->view('admin/bio', $bc, true);
			
			$tot_hal = $this->web_app_model->getAllData("tbl_mahasiswa");
			$config['base_url'] = base_url() . 'admin/mahasiswa/';
			$config['total_rows'] = $tot_hal->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
			$config['first_link'] = 'Awal';
			$config['last_link'] = 'Akhir';
			$config['next_link'] = 'Selanjutnya';
			$config['prev_link'] = 'Sebelumnya';
			$this->pagination->initialize($config);
			$bc["paginator"] =$this->pagination->create_links();
			
			$bc['mahasiswa'] = $this->web_app_model->getAllDataLimited('tbl_mahasiswa',$offset,$limit);
			
			$this->load->view('global/bg_top',$d);
			$this->load->view('admin/bg_mahasiswa',$bc);
			$this->load->view('global/bg_footer',$d);
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function edit_mahasiswa()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$bc['dosen'] = $this->web_app_model->getAllData('tbl_dosen');
			$bc['mahasiswa'] = $this->web_app_model->getEditMahasisiwa($this->uri->segment(3));
			$this->load->view('admin/bg_edit_mahasiswa',$bc);
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function tambah_mahasiswa()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$bc['dosen'] = $this->web_app_model->getAllData('tbl_dosen');
			$this->load->view('admin/bg_tambah_mahasiswa',$bc);
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function simpan_mahasiswa()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$st = $this->input->post("stts");
			
			$simpan["nama_mahasiswa"] = $this->input->post("nama_mahasiswa");
			$simpan["angkatan"] = $this->input->post("angkatan");
			$simpan["jurusan"] = $this->input->post("jurusan");
			$simpan["kelas_program"] = $this->input->post("kelas_program");
			$simpan2["kd_dosen"] = $this->input->post("kd_dosen");
			
			if($st=="edit")
			{
				$nim = $this->input->post('nim');
				$where = array('nim'=>$nim);
				$this->web_app_model->updateDataMultiField("tbl_mahasiswa",$simpan,$where);
				$this->web_app_model->updateDataMultiField("tbl_dosen_wali",$simpan2,$where);
				?>
					<script>
					window.parent.location.reload(true);
					</script>
				<?php
			}
			else if($st=="tambah")
			{
				$simpan["nim"] = $this->input->post("nim");
				$simpan2["nim"] = $this->input->post("nim");
				$simpan2["kd_dosen"] = $this->input->post("kd_dosen");
				$simpan3["username"] = $this->input->post("nim");
				$simpan3["password"] = md5($this->input->post("nim"));
				$simpan3["stts"] = "mahasiswa";
				if($this->web_app_model->cekNimMax($simpan["nim"])==0)
				{
					$this->web_app_model->insertData('tbl_mahasiswa',$simpan);
					$this->web_app_model->insertData('tbl_dosen_wali',$simpan2);
					$this->web_app_model->insertData('tbl_login',$simpan3);
				?>
					<script>
					window.parent.location.reload(true);
					</script>
				<?php
				}
				else
				{
					$this->session->set_flashdata("save_mahasiswa","
					<p style='padding:10px; background-color:#0BE0F6; text-align:center; margin:0px;'>
					NIM Telah Terpakai</p>");
				header('location:'.base_url().'admin/tambah_mahasiswa');
				}
			}
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function hapus_mahasiswa()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$id = $this->uri->segment(3);
			$hapus = array('nim' => $id);
			$hapus2 = array('username' => $id);
			$this->web_app_model->deleteData('tbl_mahasiswa',$hapus);
			$this->web_app_model->deleteData('tbl_login',$hapus2);
			$this->web_app_model->deleteData('tbl_dosen_wali',$hapus);
			header('location:'.base_url().'admin/mahasiswa');
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function info()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$d['judul'] = "Info Kampus - Sistem Informasi Akademik Online";
		
			$bc['nama'] = $this->session->userdata('nama');
			$bc['status'] = $this->session->userdata('stts');
			$bc['username'] = $this->session->userdata('username');
			$bc['menu'] = $this->load->view('admin/menu', '', true);
			$bc['bio'] = $this->load->view('admin/bio', $bc, true);
			
			$page=$this->uri->segment(3);
			$limit=5;
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;
			$bc['info'] = $this->web_app_model->getAllDataLimited('tbl_info',$offset,$limit);
			$tot_hal =  $this->web_app_model->getAllData('tbl_info');
			$config['base_url'] = base_url() . 'admin/info/';
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
			$this->load->view('admin/bg_info',$bc);
			$this->load->view('global/bg_footer',$d);
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function edit_info()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$bc['info'] = $this->web_app_model->getSelectedData('tbl_info','kd_info',$this->uri->segment(3));
			$this->load->view('admin/bg_edit_info',$bc);
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function tambah_info()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$this->load->view('admin/bg_tambah_info');
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function hapus_info()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$id = $this->uri->segment(3);
			$hapus = array('kd_info' => $id);
			$this->web_app_model->deleteData('tbl_info',$hapus);
			header('location:'.base_url().'admin/info');
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
	
	public function simpan_info()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$st = $this->input->post("stts");
			
			$simpan["judul"] = $this->input->post("judul");
			$simpan["isi"] = $this->input->post("isi");
			
			if($st=="edit")
			{
				$kd_info = $this->input->post('kd_info');
				$where = array('kd_info'=>$kd_info);
				$this->web_app_model->updateDataMultiField("tbl_info",$simpan,$where);
				?>
					<script>
					window.parent.location.reload(true);
					</script>
				<?php
			}
			else if($st=="tambah")
			{
				$simpan["waktu_post"] = strtotime(date('Y-m-d H:i:s'));
				$this->web_app_model->insertData('tbl_info',$simpan);
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
	
	public function akun()
	{
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$d['judul'] = "Info Kampus - Sistem Informasi Akademik Online";
		
			$bc['nama'] = $this->session->userdata('nama');
			$bc['status'] = $this->session->userdata('stts');
			$bc['username'] = $this->session->userdata('username');
			$bc['menu'] = $this->load->view('admin/menu', '', true);
			$bc['bio'] = $this->load->view('admin/bio', $bc, true);
			
			$this->load->view('global/bg_top',$d);
			$this->load->view('admin/bg_akun',$bc);
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
		if(!empty($cek) && $stts=='admin')
		{
			$username = $this->session->userdata('username');
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
					header('location:'.base_url().'admin/akun');
				}
				else
				{
					$this->session->set_flashdata("save_akun","
					<p style='padding:10px; background-color:#0BE0F6; text-align:center; margin:0px;'>
					Password Tidak Sama</p>");
					header('location:'.base_url().'admin/akun');
				}
			}
			else
			{
				$this->session->set_flashdata("save_akun","
				<p style='padding:10px; background-color:#0BE0F6; text-align:center; margin:0px;'>
				Password Lama Salah</p>");
				header('location:'.base_url().'admin/akun');
			}
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
		if(!empty($cek) && $stts=='admin')
		{
			$d['judul'] = "Input Nilai Mahasiswa - Sistem Informasi Akademik Online";
		
			$bc['nama'] = $this->session->userdata('nama');
			$bc['status'] = $this->session->userdata('stts');
			$bc['username'] = $this->session->userdata('username');
			$bc['menu'] = $this->load->view('admin/menu', '', true);
			$bc['bio'] = $this->load->view('admin/bio', $bc, true);
			
			$page=$this->uri->segment(3);
			$limit=5;
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;
			$tot_hal =  $this->web_app_model->getAllData('tbl_info');
			$config['base_url'] = base_url() . 'admin/info/';
			$config['total_rows'] = $tot_hal->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
			$config['first_link'] = 'Awal';
			$config['last_link'] = 'Akhir';
			$config['next_link'] = 'Selanjutnya';
			$config['prev_link'] = 'Sebelumnya';
			$this->pagination->initialize($config);
			$bc["paginator"] =$this->pagination->create_links();
			$bc['mhs'] = $this->web_app_model->getDaftarMahasiswa($offset,$limit);
			
			$this->load->view('global/bg_top',$d);
			$this->load->view('admin/bg_daftar_mahasiswa',$bc);
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
		if(!empty($cek) && $stts=='admin')
		{
			$d['judul'] = "Input Nilai Mahasiswa - Sistem Informasi Akademik Online";
			
			$bc['nama'] = $this->session->userdata('nama');
			$bc['status'] = $this->session->userdata('stts');
			$bc['username'] = $this->session->userdata('username');
			$bc['menu'] = $this->load->view('admin/menu', '', true);
			$bc['bio'] = $this->load->view('admin/bio', $bc, true);
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
			$this->load->view('admin/bg_input_nilai',$bc);
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
		if(!empty($cek) && $stts=='admin')
		{
			$nim = $this->uri->segment(3);
			$kd_mk = $this->uri->segment(4);
			$bc['edit'] = $this->web_app_model->getEditDetailNilai($nim,$kd_mk);
			
			$this->load->view('admin/bg_edit_nilai',$bc);
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
		if(!empty($cek) && $stts=='admin')
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
			
			$this->load->view('admin/bg_form_input_nilai',$bc);
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
		if(!empty($cek) && $stts=='admin')
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
		if(!empty($cek) && $stts=='admin')
		{
			$dl['nim'] = $this->uri->segment(3);
			$dl['kd_mk'] = $this->uri->segment(4);
			$this->web_app_model->deleteData('tbl_nilai',$dl);
			header('location:'.base_url().'admin/input_nilai/'.$dl['nim']);
		}
		else
		{
			header('location:'.base_url().'web');
		}
	}
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */