<?php
class C_admin extends CI_Controller {
	function __construct() {
		parent::__construct();
		
		if($this->session->userdata('login') != TRUE){
			redirect('');
		}
		$this->load->model('M_admin');
	}
	
	function index(){
		
		$sesinya	= $this->session->userdata('login');
		
		if($sesinya['level'] != 'admin'){
			$data = array (
					'title' 	=> "Kesalahan Hak Akses",
					'isi'		=> "Anda tidak diperkenankan mengakses halaman ini karena anda bukan <b>Administrator</b>. <br />
									Halaman akan redirect otomatis dalam 5 detik.",
					'url'		=> base_url(),
					'judul'		=> "Kesalahan Hak Akses",
				);
				$this->load->view('admin/salah', $data);
		}
		else {
			$sesinya	= $this->session->userdata('login');
			$user		= $this->M_admin->getuser('where level = "admin" ')->result_array();
			$data	= array(
				'title'	=> 'Selamat Datang Administrator',
				'nama'	=> $sesinya['nama_lengkap'],
				'foto'	=> $user[0]['foto'],
			);
			$this->load->view('admin/head',$data);
			$this->load->view('admin/index');
			$this->load->view('admin/footer');	
		}
		
	}
	
	function users(){
		
		$user		= $this->M_admin->getuser('where level = "admin" ')->result_array();
		$sesinya	= $this->session->userdata('login');
		$data = array(
			'title' => 'Manajemen User',
			'nama'	=> $sesinya['nama_lengkap'],
			'user'	=> $this->M_admin->ambiluser()->result_array(), 
			'kode'	=> $this->input->post('id'),
			'foto'	=> $user[0]['foto'],
		);
		$this->load->view('admin/head',$data);
		$this->load->view('admin/users');
		$this->load->view('admin/footer');
	}
	
	function add_user(){
		
		$user		= $this->M_admin->getuser('where level = "admin" ')->result_array();
		$sesinya	= $this->session->userdata('login');
		$data	= array(
			'title'			=> 'Tambah User',
			'nama'			=> $sesinya['nama_lengkap'],
			'namalengkap'	=> '',
			'username'		=> '',
			'password'		=> '',
			'status'		=> 'baru',
			'kode'			=> '',
			'foto'			=> $user[0]['foto'],
		);
		$this->load->view('admin/head',$data);
		$this->load->view('admin/add_user');
		$this->load->view('admin/footer');
	}
	
	function editsuer($kode =0){
		
		$user		= $this->M_admin->getuser('where level = "admin" ')->result_array();
		$sesinya	= $this->session->userdata('login');
		$data_konten	= $this->M_admin->getuser("where id = '$kode'")->result_array();
		
		$data	= array(
			'title'			=> 'Edit User',
			'nama'			=> $sesinya['nama_lengkap'],
			'namalengkap'	=> $data_konten[0]['nama_lengkap'],
			'username'		=> $data_konten[0]['username'],
			'password'		=> $this->encrypt->sha1($data_konten[0]['password']),
			'status'		=> 'edit',
			'kode'			=> $data_konten[0]['id'],
			'foto'			=> $user[0]['foto'],
		);
		$this->load->view('admin/head',$data);
		$this->load->view('admin/add_user');
		$this->load->view('admin/footer');
	}
	
	function saveuser(){
		if($_POST){
			$kode		 	= $this->input->post('id');
			$nama 		= $this->input->post('nama');
			$username	= $this->input->post('username');
			$password	= $this->encrypt->sha1($this->input->post('password'));
			$level		 	= $this->input->post('level');
			$aktif		 	= $this->input->post('aktif');
			$kode		 	= $this->input->post('kode');
			$status		= $this->input->post('status');
			
			
			if($status == 'baru'){
				
				$data = array(
					'nama_lengkap'	=> $nama,
					'username'		=> $username,
					'password'		=> $password,
					'level'			=> $level,
					'aktif'			=> $aktif,
				);
				
				$hasil = $this->M_admin->masukandata('users',$data);
				redirect("admin/users");
			}
			else{
				$data = array(
					'level'			=> $level,
					'aktif'			=> $aktif,
				);
			}
			$hasil = $this->M_admin->updatedata('users',$data,array('id' => $kode));
			redirect("admin/users");
		}
		else {
			echo "HALAMAN TIDAK ADA 404";
		}
	}
	
	function hapususer($kode = 0){
		$hasil	= $this->M_admin->hapusdata('users',array('id' => $kode));
		redirect("admin/users");
	}
	
	function logout(){
		$this->session->sess_destroy();
		session_destroy();
		redirect('');
	}
	
	function manajemen_point(){
		
		$user		= $this->M_admin->getuser('where level = "admin" ')->result_array();
		$sesinya	= $this->session->userdata('login');
		$muncul		= $this->M_admin->ambilpoints()->result_array();
		$data	= array(
			'title'		=> 'Manajemen Points',
			'nama'		=> $sesinya['nama_lengkap'],
			'status'	=> 'baru',
			'lpj_ad'	=> $muncul[0]['lpj_administrasi'],
			'lpj_ku'	=> $muncul[0]['lpj_keuangan'],
			'lpj_pe'	=> $muncul[0]['lpj_pengesahan'],
			'lpj_pen'	=> $muncul[0]['lpj_pendahuluan'],
			'lpj_str'	=> $muncul[0]['lpj_struktur_kepanitiaan'],
			'lpj_job'	=> $muncul[0]['lpj_job_diskripsi'],
			'lpj_hsl'	=> $muncul[0]['lpj_hasil_pelaksanaan'],
			'lpj_pnp'	=> $muncul[0]['lpj_penutup'],
			'lpj_lmp'	=> $muncul[0]['lpj_lampiran'],
			'pres_kmp'	=> $muncul[0]['pres_antar_kampus'],
			'pres_pvs'	=> $muncul[0]['pres_provinsi'],
			'pres_nsl'	=> $muncul[0]['pres_nasional'],
			'rutin'		=> $muncul[0]['rutin'],
			'anggota'	=> $muncul[0]['anggota'],
			'foto'		=> $user[0]['foto'],
			
		);
		$this->load->view('admin/head',$data);
		$this->load->view('admin/manajemen_point');
		$this->load->view('admin/footer');
	}
	
	function pointsetting(){
		
		$user		= $this->M_admin->getuser('where level = "admin" ')->result_array();
		$sesinya	= $this->session->userdata('login');
		$muncul		= $this->M_admin->ambilpoints()->result_array();
		
		$data	= array(
			'title'			=> 'Manajemen Points',
			'nama'		=> $sesinya['nama_lengkap'],
			'status'		=> 'baru',
			'foto'			=> $user[0]['foto'],
			'lpj_ad'		=> $muncul[0]['lpj_administrasi'],
			'lpj_ku'		=> $muncul[0]['lpj_keuangan'],
			'lpj_pe'		=> $muncul[0]['lpj_pengesahan'],
			'lpj_pen'		=> $muncul[0]['lpj_pendahuluan'],
			'lpj_str'		=> $muncul[0]['lpj_struktur_kepanitiaan'],
			'lpj_job'		=> $muncul[0]['lpj_job_diskripsi'],
			'lpj_hsl'		=> $muncul[0]['lpj_hasil_pelaksanaan'],
			'lpj_pnp'		=> $muncul[0]['lpj_penutup'],
			'lpj_lmp'		=> $muncul[0]['lpj_lampiran'],
			'pres_kmp'	=> $muncul[0]['pres_antar_kampus'],
			'pres_pvs'	=> $muncul[0]['pres_provinsi'],
			'pres_nsl'	=> $muncul[0]['pres_nasional'],
			'e_keu'		=> '',
			'e_keg'		=> '',
			'e_pres'		=> '',
			
			
		);
		$this->load->view('admin/head',$data);
		$this->load->view('admin/pointsetting');
		$this->load->view('admin/footer');
	}
	
	function bobot(){
		$sesinya		= $this->session->userdata('login');
		$ambil_user 	= $this->M_admin->getuser('where level = "admin" ')->result_array();
		$bobot			= $this->db->query("select * from bobot")->result_array();
		$telat			= $this->db->query("select * from telat")->result_array();
		
		$data	= array(
		    'title'				=> 'Setting Bobot',
			'nama'			=> $sesinya['nama_lengkap'],
			'namalengkap'=> $ambil_user[0]['nama_lengkap'],
			'username'	=> $ambil_user[0]['username'],
			'foto'				=> $ambil_user[0]['foto'],
			'kode'			=> $bobot[0]['id_bobot'],
			'lpj'				=> $bobot[0]['lpj'],
			'prestasi'		=> $bobot[0]['prestasi'],
			'kegiatan'		=> $bobot[0]['kegiatan'],
			'anggota'		=> $bobot[0]['anggota'],
			'lpjkeu'			=> $bobot[0]['lpj_keuangan'],
			'lpjkg'			=> $bobot[0]['lpj_kegiatan'],
			'p_hari'			=> $telat[0]['p_hari'],
			'p_points'		=> $telat[0]['p_points'],
			'k_hari'			=> $telat[0]['k_hari'],
			'k_points'		=> $telat[0]['k_points'],
			'ke_hari'		=> $telat[0]['ke_hari'],
			'ke_points'		=> $telat[0]['ke_points'],
			'erorlpjj'			=> '',
			'erorpoints'	=>'',
		
		);
		$this->load->view('admin/head',$data);
		$this->load->view('admin/bobot');
		$this->load->view('admin/footer');
	}
	
	function save_point(){
		if($_POST){
			$user		= $this->M_admin->getuser('where level = "admin" ')->result_array();
			$sesinya	= $this->session->userdata('login');
			$muncul	= $this->M_admin->ambilpoints()->result_array();
			
			$lpj_administrasi	 		= $this->input->post('lpj_administrasi');
			$lpj_keuangan	    		= $this->input->post('lpj_keuangan');
			$lpj_pengesahan	 		= $this->input->post('lpj_pengesahan');
			$lpj_pendahuluan			= $this->input->post('lpj_pendahuluan');
			$lpj_struktur_kepanitiaan= $this->input->post('lpj_struktur_kepanitiaan');
			$lpj_job_diskripsi	 		= $this->input->post('lpj_job_diskripsi');
			$lpj_hasil_pelaksanaan	= $this->input->post('lpj_hasil_pelaksanaan');
			$lpj_penutup	 				= $this->input->post('lpj_penutup');
			$lpj_lampiran	 				= $this->input->post('lpj_lampiran');
			$pres_antar_kampus	 	= $this->input->post('pres_antar_kampus');
			$pres_provinsi	 			= $this->input->post('pres_provinsi');
			$pres_nasional				= $this->input->post('pres_nasional');
			
			$db 			= $this->db->query('select * from bobot')->result_array();
			$a_keu 	= $db[0]['lpj_keuangan'];
			$a_keg 	= $db[0]['lpj_kegiatan'];
			$a_pres	= $db[0]['prestasi'];
			$keu 		= $lpj_administrasi+$lpj_keuangan;
			$keg			= $lpj_pengesahan+$lpj_pendahuluan+$lpj_struktur_kepanitiaan+$lpj_job_diskripsi+$lpj_hasil_pelaksanaan+$lpj_penutup+$lpj_lampiran;
			$pres		= $pres_antar_kampus+$pres_provinsi+$pres_nasional;	
			
			if ($a_keu != $keu) {
			$data	= array(
				    'title'			=> 'Manajemen Points',
					'nama'		=> $sesinya['nama_lengkap'],
					'status'		=> 'baru',
					'foto'			=> $user[0]['foto'],
					'lpj_ad'		=> $muncul[0]['lpj_administrasi'],
					'lpj_ku'		=> $muncul[0]['lpj_keuangan'],
					'lpj_pe'		=> $muncul[0]['lpj_pengesahan'],
					'lpj_pen'		=> $muncul[0]['lpj_pendahuluan'],
					'lpj_str'		=> $muncul[0]['lpj_struktur_kepanitiaan'],
					'lpj_job'		=> $muncul[0]['lpj_job_diskripsi'],
					'lpj_hsl'		=> $muncul[0]['lpj_hasil_pelaksanaan'],
					'lpj_pnp'		=> $muncul[0]['lpj_penutup'],
					'lpj_lmp'		=> $muncul[0]['lpj_lampiran'],
					'pres_kmp'	=> $muncul[0]['pres_antar_kampus'],
					'pres_pvs'	=> $muncul[0]['pres_provinsi'],
					'pres_nsl'	=> $muncul[0]['pres_nasional'],
					'e_keg'		=> '',
					'e_pres'		=> '',
					'e_keu'		=> '
										<div class="alert alert-error">
										  <button data-dismiss="alert" class="close" type="button">×</button>
										  <strong>Jumlah POINT LPJ Keuangan yang dimasukkan harus '.$a_keu.'
										</div>
										',
				);
				$this->load->view('admin/head',$data);
				$this->load->view('admin/pointsetting');
				$this->load->view('admin/footer');
			}
			else if ($a_keg != $keg) {
				$data	= array(
				    'title'			=> 'Manajemen Points',
					'nama'		=> $sesinya['nama_lengkap'],
					'status'		=> 'baru',
					'foto'			=> $user[0]['foto'],
					'lpj_ad'		=> $muncul[0]['lpj_administrasi'],
					'lpj_ku'		=> $muncul[0]['lpj_keuangan'],
					'lpj_pe'		=> $muncul[0]['lpj_pengesahan'],
					'lpj_pen'		=> $muncul[0]['lpj_pendahuluan'],
					'lpj_str'		=> $muncul[0]['lpj_struktur_kepanitiaan'],
					'lpj_job'		=> $muncul[0]['lpj_job_diskripsi'],
					'lpj_hsl'		=> $muncul[0]['lpj_hasil_pelaksanaan'],
					'lpj_pnp'		=> $muncul[0]['lpj_penutup'],
					'lpj_lmp'		=> $muncul[0]['lpj_lampiran'],
					'pres_kmp'	=> $muncul[0]['pres_antar_kampus'],
					'pres_pvs'	=> $muncul[0]['pres_provinsi'],
					'pres_nsl'	=> $muncul[0]['pres_nasional'],
					'e_keu'		=> '',
					'e_pres'		=> '',
					'e_keg'		=> '
										<div class="alert alert-error">
										  <button data-dismiss="alert" class="close" type="button">×</button>
										  <strong>Jumlah POINT LPJ Kegiatan yang dimasukkan harus '.$a_keg.'
										</div>
										',
				);
				$this->load->view('admin/head',$data);
				$this->load->view('admin/pointsetting');
				$this->load->view('admin/footer');
			
			} else if ($a_pres != $pres){
				$data	= array(
				    'title'			=> 'Manajemen Points',
					'nama'		=> $sesinya['nama_lengkap'],
					'status'		=> 'baru',
					'foto'			=> $user[0]['foto'],
					'lpj_ad'		=> $muncul[0]['lpj_administrasi'],
					'lpj_ku'		=> $muncul[0]['lpj_keuangan'],
					'lpj_pe'		=> $muncul[0]['lpj_pengesahan'],
					'lpj_pen'		=> $muncul[0]['lpj_pendahuluan'],
					'lpj_str'		=> $muncul[0]['lpj_struktur_kepanitiaan'],
					'lpj_job'		=> $muncul[0]['lpj_job_diskripsi'],
					'lpj_hsl'		=> $muncul[0]['lpj_hasil_pelaksanaan'],
					'lpj_pnp'		=> $muncul[0]['lpj_penutup'],
					'lpj_lmp'		=> $muncul[0]['lpj_lampiran'],
					'pres_kmp'	=> $muncul[0]['pres_antar_kampus'],
					'pres_pvs'	=> $muncul[0]['pres_provinsi'],
					'pres_nsl'	=> $muncul[0]['pres_nasional'],
					'e_keu'		=> '',
					'e_keg'		=> '',
					'e_pres'		=> '
										<div class="alert alert-error">
										  <button data-dismiss="alert" class="close" type="button">×</button>
										  <strong>Jumlah POINT Prestasi yang dimasukkan harus '.$a_pres.'
										</div>
										',
				);
				$this->load->view('admin/head',$data);
				$this->load->view('admin/pointsetting');
				$this->load->view('admin/footer');
			
			} else {
			$data 		 = array(
					'lpj_administrasi'				=> $lpj_administrasi,
					'lpj_keuangan'				=> $lpj_keuangan,
					'lpj_pengesahan'			=> $lpj_pengesahan,
					'lpj_pendahuluan'			=> $lpj_pendahuluan,
					'lpj_struktur_kepanitiaan'	=> $lpj_struktur_kepanitiaan,
					'lpj_job_diskripsi'			=> $lpj_job_diskripsi,
					'lpj_hasil_pelaksanaan'	=> $lpj_hasil_pelaksanaan,
					'lpj_penutup'					=> $lpj_penutup,
					'lpj_lampiran'					=> $lpj_lampiran,
					'pres_antar_kampus'		=> $pres_antar_kampus,
					'pres_provinsi'				=> $pres_provinsi,
					'pres_nasional'				=> $pres_nasional,
					
			);
			$hasil = $this->M_admin->updatepoints('points',$data);
			redirect("admin/points");
			}
		}
		else{ 
		echo "Halaman Tidak Ketemu";
		}
	}
	
	function updatebobot(){
		if($_POST){
			$sesinya		= $this->session->userdata('login');
			$ambil_user 	= $this->M_admin->getuser('where level = "admin" ')->result_array();
			$bobot			= $this->db->query("select * from bobot")->result_array();
			
			$lpj	 			= $this->input->post('lpj');
			$prestasi	    = $this->input->post('prestasi');
			$kegiatan	 	= $this->input->post('kegiatan');
			$anggota	 	= $this->input->post('anggota');
			$kode			= $this->input->post('kode');
			
			$bobot		= $this->db->query("select * from bobot")->result_array();
			
			if($lpj + $prestasi + $kegiatan + $anggota != 100){
			
				$data	= array(
				    'title'					=> 'Setting Bobot',
					'nama'				=> $sesinya['nama_lengkap'],
					'namalengkap'	=> $ambil_user[0]['nama_lengkap'],
					'username'		=> $ambil_user[0]['username'],
					'foto'					=> $ambil_user[0]['foto'],
					'kode'				=> $bobot[0]['id_bobot'],
					'lpj'					=> $bobot[0]['lpj'],
					'prestasi'			=> $bobot[0]['prestasi'],
					'kegiatan'			=> $bobot[0]['kegiatan'],
					'anggota'			=> $bobot[0]['anggota'],
					'lpjkeu'				=> $bobot[0]['lpj_keuangan'],
					'lpjkg'				=> $bobot[0]['lpj_kegiatan'],
					'erorlpjj'				=> '',
					'erorpoints'		=> '
											<div class="alert alert-error">
				                              <button data-dismiss="alert" class="close" type="button">×</button>
				                              <strong>Jumlah POINT yang dimasukkan harus 100
				                            </div>
											',
		
				);
				$this->load->view('admin/head',$data);
				$this->load->view('admin/bobot');
				$this->load->view('admin/footer');
			}
			else {			
			$data 		 = array(
					'id_bobot'	=> $kode,
					'lpj'			=> $lpj,
					'prestasi'	=> $prestasi,
					'kegiatan'	=> $kegiatan,
					'anggota'	=> $anggota,
					
			);
				$hasil = $this->M_admin->updatepoints('bobot',$data);
				redirect("admin/bobot");
			}
		}
		else{ 
		echo "Halaman Tidak Ketemu";
		}
	}
	
	function updatebblpj(){
		$sesinya		= $this->session->userdata('login');
		$ambil_user 	= $this->M_admin->getuser('where level = "admin" ')->result_array();
		
		if($_POST){
			
			$kode		= $this->input->post('kode');
			$lpjkeu		= $this->input->post('lpjkeu');
			$lpjkg		= $this->input->post('lpjkg');
			
			$bobot		= $this->db->query("select * from bobot")->result_array();
			
			if($lpjkeu + $lpjkg != $bobot[0]['lpj']){
			
				$data	= array(
				    'title'					=> 'Setting Bobot',
					'nama'				=> $sesinya['nama_lengkap'],
					'namalengkap'	=> $ambil_user[0]['nama_lengkap'],
					'username'		=> $ambil_user[0]['username'],
					'foto'					=> $ambil_user[0]['foto'],
					'kode'				=> $bobot[0]['id_bobot'],
					'lpj'					=> $bobot[0]['lpj'],
					'prestasi'			=> $bobot[0]['prestasi'],
					'kegiatan'			=> $bobot[0]['kegiatan'],
					'anggota'			=> $bobot[0]['anggota'],
					'lpjkeu'				=> $bobot[0]['lpj_keuangan'],
					'lpjkg'				=> $bobot[0]['lpj_kegiatan'],
					'erorpoints'		=>'',
					'erorlpjj'				=> '
											<div class="alert alert-error">
				                              <button data-dismiss="alert" class="close" type="button">×</button>
				                              <strong>Jumlah point lpj keuangan dan lpj kegiatan harus sama dengan jumlah LPJ Utama di atas.
				                            </div>
											',
		
				);
				$this->load->view('admin/head',$data);
				$this->load->view('admin/bobot');
				$this->load->view('admin/footer');
			}
			else {
				$data		= array(
				'id_bobot'			=> $kode,
				'lpj_keuangan'	=> $lpjkeu,
				'lpj_kegiatan'		=> $lpjkg,
			);
			$hasil = $this->M_admin->updatedata('bobot',$data);
			redirect("admin/bobot");	
			}
			
		}
		else {
			echo "Halaman tidak ketemu";
		}
	}
	
	function setting(){
		
		$sesinya	= $this->session->userdata('login');
		$ambil_user = $this->M_admin->getuser('where level = "admin" ')->result_array();
		$data = array(
			'title'			=> 'Setting Profil',
			'kode'			=> $ambil_user[0]['id'],
			'nama'			=> $sesinya['nama_lengkap'],
			'namalengkap'	=> $ambil_user[0]['nama_lengkap'],
			'username'		=> $ambil_user[0]['username'],
			'foto'			=> $ambil_user[0]['foto'],
		);
		
		$this->load->view('admin/head',$data);
		$this->load->view('admin/setting');
		$this->load->view('admin/footer');
	}
	
	function save_setting(){
		if($_POST){
			
			$kode		 = $this->input->post('kode');
			$nama 		 = $this->input->post('nama');
			$username	 = $this->input->post('username');
			$password	 = $this->encrypt->sha1($this->input->post('password'));
			$foto		 = $this->input->post('foto');
			
			if($_FILES['foto']['name'] != ""){
			    $config['upload_path'] = 'assets/foto_user';
			    $config['allowed_types'] = 'gif|jpg|png|jpeg';
			    $config['max_size'] = '2000';
			    $config['remove_spaces'] = true;
			    $config['overwrite'] = false;
			    $config['encrypt_name'] = true;
			    $config['max_width']  = '';
			    $config['max_height']  = '';
			    $this->load->library('upload', $config);
			    $this->upload->initialize($config);            
			    if (!$this->upload->do_upload('foto'))
			    {
			        $error = array('error' => $this->upload->display_errors());
			        print_r($error);
			        exit();
			    }
			    else
			    {
		        $image = $this->upload->data();
		        if ($image['file_name'])
		        {
		            $data['file1'] = $image['file_name'];
		        }        
		        $product_image = $data['file1'];
		    }
			}
			
			$data = array(
					'nama_lengkap'	=> $nama,
					'username'		=> $username,
					'password'		=> $password,
					'foto'			=> $product_image,
				);
				
				
				$hasil = $this->M_admin->updatedata('users',$data,array('id' => $kode));
				redirect("admin/users");
			
			} 
		else {
			echo "HALAMAN TIDAK ADA 404";
		}
	}
		
	function telat(){
		$sesinya		= $this->session->userdata('login');
		$ambil_user 	= $this->M_admin->getuser('where level = "admin" ')->result_array();
		
		if($_POST){
			
			$kode		= $this->input->post('kode');
			$tp_hari	= $this->input->post('p_hari');
			$tp_points	= $this->input->post('p_points');
			$tk_hari	= $this->input->post('k_hari');
			$tk_points	= $this->input->post('k_points');
			$tke_hari	= $this->input->post('ke_hari');
			$tke_points	= $this->input->post('ke_points');
			
			$bobot		= $this->db->query("select * from bobot")->result_array();
			$telat		= $this->db->query("select * from telat")->result_array();

			$data		= array(
				'id_telat'		=> $kode,
				'p_hari'		=> $tp_hari,
				'p_points'	=> $tp_points,
				'k_hari'		=> $tk_hari,
				'k_points'	=> $tk_points,
				'ke_hari'	=> $tke_hari,
				'ke_points'	=> $tke_points,
			);
			$hasil = $this->M_admin->updatedata('telat',$data);
			redirect("admin/bobot");	
		}
		else {
			echo "Halaman tidak ketemu";
		}
	}

	function set_periode(){
		$sesinya	= $this->session->userdata('login');
		$ambil_user = $this->M_admin->getuser('where level = "admin" ')->result_array();
		$per1		= $this->db->query("select * from mod_periode")->result_array();
		
		$data = array(
			'title'			=> 'Setting Periode Sistem',
			'kode'			=> $ambil_user[0]['id'],
			'nama'			=> $sesinya['nama_lengkap'],
			'namalengkap'	=> $ambil_user[0]['nama_lengkap'],
			'username'		=> $ambil_user[0]['username'],
			'foto'			=> $ambil_user[0]['foto'],
			'kode'			=> $per1[0]['id'],
		);
		$this->load->view('admin/head',$data);
		$this->load->view('admin/set_periode');
		$this->load->view('admin/footer');
	}
	
	function save_setperiode(){
		if($_POST){
			$sesinya	= $this->session->userdata('login');
			$ambil_user = $this->M_admin->getuser('where level = "admin" ')->result_array();	
			$kode = $this->input->post('kode');
			$periode = $this->input->post('periode');
			
			
			$data = array(
				'periode_set'	=> $periode,
			);
				$hasil = $this->M_admin->updatedata('mod_periode',$data,array('id' => $kode));
				redirect("admin/periode");
			
		}
		else 
		{
			echo "Halaman Tidak Ada";
		}
	}
	
	
}
?>