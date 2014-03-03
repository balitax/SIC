<?php
class C_ukm extends CI_Controller {
	function __construct() {
		parent::__construct();
		
		if($this->session->userdata('login') != TRUE){
			redirect('');
		}
		
		$this->load->model('M_ukm');
	}
	
	function index(){
		$sesinya	= $this->session->userdata('login');
		
		if($sesinya['level'] != 'ukm'){
			$data = array (
					'title' 	=> "Kesalahan Hak Akses",
					'isi'		=> "Anda tidak diperkenankan mengakses halaman ini karena anda bukan UKM. <br />
									Halaman akan redirect otomatis dalam 5 detik.",
					'url'		=> base_url(),
					'judul'		=> "Kesalahan Hak Akses",
				);
				$this->load->view('ukm/salah', $data);
		}
		else {
		$sesinya	= $this->session->userdata('login');
		$ambil_user = $this->M_ukm->getuser('where nama_lengkap = "'.$sesinya['nama_lengkap'].'" and level = "ukm"')->result_array();
		$data	= array(
			'title'	=> 'Selamat Datang UKM',
			'nama'	=> $sesinya['nama_lengkap'],
			'foto'	=> $ambil_user[0]['foto'],
			'level'	=> $ambil_user[0]['level']
		);
		$this->load->view('ukm/head',$data);
		$this->load->view('ukm/index');
		$this->load->view('ukm/footer');	
		}
		
	}
		
	function proposal(){
		
		$sesinya		= $this->session->userdata('login');
		$user			= $this->M_ukm->getuser('where nama_lengkap = "'.$sesinya['nama_lengkap'].'" and 
		level = "ukm"')->result_array();
		$idukm			= $this->db->query("select * from ukm where nama = '".$sesinya['nama_lengkap']."'");
		$ukmku			= $idukm->num_rows();
		
		if($ukmku > 0){
			
			$ukmid	= $this->db->query("select * from ukm where nama = '".$sesinya['nama_lengkap']."'")->result_array();
			$printidukm		= $this->db->query("select * from proposal where 
			id_ukm = '".$ukmid[0]['id_ukm']."'")->result_array();
		
		
			$data			= array(
				'title'			=> 'Pengajuan Proposal UKM',
				'nama'			=> $sesinya['nama_lengkap'],
				'tampil'		=> $printidukm,
				'foto'			=> $user[0]['foto'],
				'level'			=> $user[0]['level'],
			);
			$this->load->view('ukm/head',$data);
			$this->load->view('ukm/proposal');
			$this->load->view('ukm/footer');
		
		}
		else {
			$data = array (
					'title' 	=> "Kesalahan Input Proposal",
					'isi'		=> "Anda tidak diperkenankan input proposal dikarenakan anda belum
									mengupdate data struktur UKM anda. <br />
									Halaman akan redirect otomatis dalam 5 detik.",
					'url'		=> base_url().'ukm/struktur',
					'judul'	=> "Kesalahan Input Proposal",
				);
				$this->load->view('ukm/salah', $data);
		}
	}
	
	function tambah_proposal(){
		
		$sesinya	= $this->session->userdata('login');
		$user		= $this->M_ukm->getuser('where nama_lengkap = "'.$sesinya['nama_lengkap'].'" 
		and level = "ukm"')->result_array();
		$ukm		= $this->db->query("select * from ukm where nama = '".$sesinya['nama_lengkap']."'")->result_array();
		$kegiatan 	= $this->db->query("select id_kegiatan,judul_kegiatan from kegiatan where id_ukm = '".$ukm[0]['id_ukm']."' 
		and id_kegiatan not in (select id_kegiatan from proposal)")->result_array();
		
		$idukm		= $this->db->query("select * from ukm where nama = '".$sesinya['nama_lengkap']."'");
		$ukmku		= $idukm->num_rows();
		
		
		
		if ($ukmku > 0 ) {
			$data	= array(
				'title'				=> 'Tambah Proposal',
				'nama'				=> $sesinya['nama_lengkap'],
				'foto'				=> $user[0]['foto'],
				'level'				=> $user[0]['level'],
				'status'			=> 'baru',
				'kode'				=> '',
				'judul'				=> '',
				'tg_mulai'			=> '',
				'tg_selesai'		=> '',
				'berkas'			=> '',
				'kegiatan'			=> $kegiatan,
			);
			$this->load->view('ukm/head',$data);
			$this->load->view('ukm/tambah_proposal');
			$this->load->view('ukm/footer');
			
			}
			else {
				$data = array (
					'title' 		=> "Kesalahan Input Proposal",
					'isi'		=> "Anda tidak diperkenankan input proposal dikarenakan anda belum
									mengupdate data struktur UKM anda. <br />
									Halaman akan redirect otomatis dalam 5 detik.",
					'url'		=> base_url().'ukm/struktur',
					'judul'	=> "Kesalahan Input Proposal",
				);
				$this->load->view('ukm/salah', $data);
			}
	}
	
	function tambah_pro(){
		if($_POST){
			
			$sesinya		= $this->session->userdata('login');
			$uk				= $sesinya['nama_lengkap'];
			$d				= $this->db->query("select id_ukm from ukm where nama =  '".$uk."' ")->result_array();
			$judul			= $this->input->post('kegiatan');
			$id				= $this->db->query("select id_kegiatan from kegiatan where judul_kegiatan = '".$judul."'")->result_array();
			$mulai			= new DateTime($this->input->post('tgl_mulai'));
			$tgl_mulai		= $mulai->format('Y-m-d');
			$selesai		= new DateTime($this->input->post('tgl_selesai'));
			$tgl_selesai	= $selesai->format('Y-m-d');
			$kode		 	= $this->input->post('kode');
			$status		 	= $this->input->post('status');
			
			
			$liatuser		= $this->db->query("select * from ukm where nama = '".$uk."'");
			$ukm			= $liatuser->num_rows();
			if($ukm > 0){
				
			if($status == 'baru'){
				
				if($_FILES['berkas']['name'] != ""){
			    $config['upload_path'] = 'assets/proposal';
			    $config['allowed_types'] = 'pdf|docx|doc';
			    $config['max_size'] = '10000';
			    $config['remove_spaces'] = true;
			    $config['overwrite'] = false;
			    $config['encrypt_name'] = true;
			    $config['max_width']  = '';
			    $config['max_height']  = '';
			    $this->load->library('upload', $config);
			    $this->upload->initialize($config);            
			    if (!$this->upload->do_upload('berkas'))
			    {
			        $error = "Tipe file tidak diperbolehkan. Hanya berkas berupa pdf dan doc saja untuk upload berkas proposal";
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
		        $berkas = $data['file1'];
		    }
			}
				
					$data = array(
					'judul'				=> $judul,
					'tanggal_mulai'	=> $tgl_mulai,
					'tanggal_selesai'	=> $tgl_selesai,
					'berkas'				=> $berkas,
					'status'				=> 'diproses',
					'id_ukm'			=> $d[0]['id_ukm'],
					'id_kegiatan'		=> $id[0]['id_kegiatan'],
				);
				$tambah= $this->M_ukm->simpan('proposal',$data);
				redirect("ukm/proposal");
			}
			else {
				
				$this->db->where('id_proposal',$kode);
				$query 	= $this->db->get('proposal');
				$row	= $query->row();
				
				unlink("./assets/proposal/$row->berkas");
				
				if($_FILES['berkas']['name'] != ""){
			    $config['upload_path'] = 'assets/proposal';
			    $config['allowed_types'] = 'pdf|docx|doc';
			    $config['max_size'] = '10000';
			    $config['remove_spaces'] = true;
			    $config['overwrite'] = false;
			    $config['encrypt_name'] = true;
			    $config['max_width']  = '';
			    $config['max_height']  = '';
			    $this->load->library('upload', $config);
			    $this->upload->initialize($config);            
			    if (!$this->upload->do_upload('berkas'))
			    {
			        $error = "Tipe file tidak diperbolehkan. Hanya berkas berupa pdf dan doc saja untuk upload berkas proposal";
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
		        $berkas = $data['file1'];
		    }
			}
				
				$data = array(
					'judul'				=> $kegiatan,
					'tanggal_mulai'	=> $tgl_mulai,
					'tanggal_selesai'	=> $tgl_selesai,
					'berkas'				=> $berkas,
					'status'				=> 'diproses',
					'id_ukm'			=> $d[0]['id_ukm'],
					'id_kegiatan'		=> $kegiatan,
				);
				$update = $this->M_ukm->updatedata('proposal',$data, array('id_proposal' => $kode));
				redirect('ukm/proposal');
			}
			}
			else {
				$data = array (
					'title' 	=> "Kesalahan Input Proposal",
					'isi'		=> "Anda tidak diperkenankan input proposal dikarenakan anda belum
									mengupdate data struktur UKM anda. <br />
									Halaman akan redirect otomatis dalam 5 detik.",
					'url'		=> base_url().'ukm/struktur',
					'judul'	=> "Kesalahan Input Proposal",
				);
				$this->load->view('ukm/salah', $data);
			} 	
		}
		else {
			echo "HALAMAN NGGA ADA";
		}
	}
		
	function editpro($kode =0){
		
		$sesinya		= $this->session->userdata('login');
		$user			= $this->M_ukm->getuser('where nama_lengkap = "'.$sesinya['nama_lengkap'].'" 
		and level = "ukm"')->result_array();
		$tampil			= $this->db->query("select * from proposal where id_proposal = '$kode' ")->result_array();
		$ukm			= $this->db->query("select * from ukm where nama = '".$sesinya['nama_lengkap']."'")->result_array();
		$kegiatan 		= $this->db->query("select * from kegiatan where id_ukm = '".$ukm[0]['id_ukm']."'")->result_array();
		
		$data	= array(
			'title'			=> 'Edit Proposal',
			'nama'		=> $sesinya['nama_lengkap'],
			'foto'			=> $user[0]['foto'],
			'level'			=> $user[0]['level'],
			'status'		=> 'edit',
			'kode'		=> $tampil[0]['id_proposal'],
			'judul'		=> $tampil[0]['judul'],
			'tg_mulai'	=> $tampil[0]['tanggal_mulai'],
			'tg_selesai'=> $tampil[0]['tanggal_selesai'],
			'berkas'		=> $tampil[0]['berkas'],
			'kegiatan'	=> $kegiatan,
		);
		$this->load->view('ukm/head',$data);
		$this->load->view('ukm/tambah_proposal');
		$this->load->view('ukm/footer');
	}
	
	function hapuspro($kode = 0){
		
		$this->db->where('id_proposal',$kode);
		$query 	= $this->db->get('proposal');
		$row	= $query->row();
		
		unlink("./assets/proposal/$row->berkas");
		
		$hasil	= $this->M_ukm->hapuspro('proposal',array('id_proposal' => $kode));
		redirect("ukm/proposal");
	}

	function prin_proposal(){
		$sesinya		= $this->session->userdata('login');
		$user			= $this->M_ukm->getuser('where nama_lengkap = "'.$sesinya['nama_lengkap'].'" and 
		level = "ukm"')->result_array();
		
		$ukmid	= $this->db->query("select * from ukm where nama = '".$sesinya['nama_lengkap']."'")->result_array();
		$proposal	= $this->db->query("select * from proposal where 
			id_ukm = '".$ukmid[0]['id_ukm']."'")->result_array();
		

		$this->load->library('fpdf');
		
        /* setting zona waktu */ 
		date_default_timezone_set('Asia/Jakarta');

		$this->fpdf->FPDF("L","cm","A4");
		$this->fpdf->SetMargins(1,1,1);
		$this->fpdf->AliasNbPages();
		$this->fpdf->AddPage();
		$this->fpdf->SetFont('Times','B',12);
		
		$this->fpdf->Ln();
		$this->fpdf->Image('http://localhost/elektabilitas/assets/back/images/uin.png',4,0.5);
		$this->fpdf->Ln();
		
		$this->fpdf->Ln();
		$this->fpdf->Cell(27,0.7,'LAPORAN ELEKABILITAS UKM UIN MAULANA MALIK IBRAHIM MALANG',0,0,'C');
		$this->fpdf->Ln();
		$this->fpdf->SetFont('helvetica','',10);
		$this->fpdf->Cell(27,0.5,'Jalan Gajayana No. 50 Malang Telp: +62 341 551354',0,0,'C');

		$this->fpdf->Ln();
		$this->fpdf->Cell(27,0.5,'homepage : www.uin-malang.ac.id  email : info@uin-malang.ac.id',0,0,'C');
		
		
		$this->fpdf->Ln(1);
		$this->fpdf->Ln(1);
		$this->fpdf->SetFont('Times','B',12);
		$tahun = date('Y');
		$this->fpdf->Cell(26,1,'DAFTAR PROPOSAL UKM "'.$sesinya['nama_lengkap'].'"  PERIODE "'.$tahun.'"',0,0,'C');
		

		/* Fungsi Line untuk membuat garis */
		$this->fpdf->Line(1,3.5,29,3.5);


		/* setting header table */
		$this->fpdf->Ln(1);
		$this->fpdf->SetFont('Times','B',12);
		$this->fpdf->Cell(2  , 1, 'No.'           , 1, 'LR', 'L');
		$this->fpdf->Cell(10 , 1, 'JUDUL PROPOSAL' , 1, 'LR', 'L');
		$this->fpdf->Cell(6 , 1, 'TANGGAL MULAI' , 1, 'LR', 'L');
		$this->fpdf->Cell(6 , 1, 'TANGGAL SELESAI' , 1, 'LR', 'L');
		$this->fpdf->Cell(4 , 1, 'STATUS' , 1, 'LR', 'L');
		
		$no = 1;
		foreach($proposal as $a){

			$this->fpdf->Ln();
		    $this->fpdf->SetFont('Times','',12);
			$this->fpdf->Cell(2,0.7,$no++,1,'LR','L');
			$this->fpdf->Cell(10,0.7,$a['judul'],1,'LR','L');
			$this->fpdf->Cell(6,0.7,$a['tanggal_mulai'],1,'LR','L');
			$this->fpdf->Cell(6,0.7,$a['tanggal_selesai'],1,'LR','L');
			$this->fpdf->Cell(4,0.7,$a['status'],1,'LR','L');
		}
			
		
		$this->fpdf->SetY(-3);

		/* setting font untuk footer */
		$this->fpdf->SetFont('Times','',10);
		/* setting cell untuk page number */
		$this->fpdf->Cell(9.5, 0.5, 'Halaman '.$this->fpdf->PageNo().'/{nb}',0,0,'L');

		/* generate pdf jika semua konstruktor, data yang akan ditampilkan, dll sudah selesai */
		$this->fpdf->Output("data_proposal_UKM.pdf","I");
	}
	
	function logout(){
		$this->session->sess_destroy();
		session_destroy();
		redirect('');
	}
	
	function setting(){
		
		$sesinya	= $this->session->userdata('login');
		$ambil_user = $this->M_ukm->getuser('where nama_lengkap = "'.$sesinya['nama_lengkap'].'" 
		and level = "ukm"')->result_array();
		
		$data = array(
			'title'			=> 'Setting Profil',
			'kode'			=> $ambil_user[0]['id'],
			'nama'			=> $sesinya['nama_lengkap'],
			'namalengkap'	=> $ambil_user[0]['nama_lengkap'],
			'username'		=> $ambil_user[0]['username'],
			'password'		=> $ambil_user[0]['password'],
			'foto'			=> $ambil_user[0]['foto'],
		);
		
		$this->load->view('ukm/head',$data);
		$this->load->view('ukm/setting');
		$this->load->view('ukm/footer');
	}
	
	function save_setting(){
		if($_POST){
			
			
			$kode		 	 		= $this->input->post('kode');
			$nama 		 			= $this->input->post('nama');
			$username 			= $this->input->post('username');
			$password			= $this->encrypt->sha1($this->input->post('password'));
			
			$this->db->where('id',$kode);
			$query 	= $this->db->get('users');
			$row	= $query->row();
			
			unlink("./assets/foto_user/$row->foto");
			
			
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
					'password'			=> $password,
					'foto'					=> $product_image,
				);
				
				
				$hasil = $this->M_ukm->updatedata('users',$data,array('id' => $kode));
				redirect("ukm/setting");
			
			} 
		else {
			echo "HALAMAN TIDAK ADA 404";
		}
	}
	
	function lpj(){
		$sesinya	= $this->session->userdata('login');
		$ambil_user = $this->M_ukm->getuser('where nama_lengkap = "'.$sesinya['nama_lengkap'].'" 
		and level = "ukm"')->result_array();
		$cariidukm	= $this->db->query("select * from ukm where nama = '".$sesinya['nama_lengkap']."'")->result_array();
		$cekpropo = $this->db->query("select * from proposal where id_ukm = '".$cariidukm[0]['id_ukm']."'");
		$propo		= $cekpropo->num_rows();
		
		if($propo > 0){
		
		$ambilljp	= $this->db->query("select * from lpj where id_ukm = '".$cariidukm[0]['id_ukm']."'")->result_array();
			$data	= array(
			'title'	=> 'Pengajuan LPJ',
			'nama'	=> $sesinya['nama_lengkap'],
			'foto'	=> $ambil_user[0]['foto'],
			'level'	=> $ambil_user[0]['level'],
			'lpj'	=> $ambilljp,
			);
			$this->load->view('ukm/head',$data);
			$this->load->view('ukm/lpj');
			$this->load->view('ukm/footer');
		}
		else {
			redirect('ukm/salah');
		}
		
	}

	function lpj_add(){
		
	$sesinya	= $this->session->userdata('login');
	$user 		= $this->M_ukm->getuser('where nama_lengkap = "'.$sesinya['nama_lengkap'].'" and level = "ukm"')->result_array();
	$cariidukm= $this->db->query("select * from ukm where nama = '".$sesinya['nama_lengkap']."'")->result_array();
	$proposal	= $this->db->query("select id_proposal,judul from proposal where id_ukm = '".$cariidukm[0]['id_ukm']."' and id_proposal not in (select id_proposal from lpj) and status='diterima'")->result_array();
	$kegiatan	= $this->db->query("select * from kegiatan where id_ukm = '".$cariidukm[0]['id_ukm']."'")->result_array();
		
		$datax		= array (
			'title'		=> 'Tambah LPJ',
			'nama'	=> $sesinya['nama_lengkap'],
			'foto'		=> $user[0]['foto'],
			'level'		=> $user[0]['level'],
			'status'	=> 'baru',
			'kode'		=> '',
			'nama_p'	=> '',
			'tgl'		=> '',
			'proposal'	=> $proposal,
			);
			$this->load->view('ukm/head',$datax);
			$this->load->view('ukm/lpj_add');
			$this->load->view('ukm/footer');
			
	}
	
	function lpj_edit($kode=0){
	$sesinya	= $this->session->userdata('login');
	$user 		= $this->M_ukm->getuser('where nama_lengkap = "'.$sesinya['nama_lengkap'].'" 
	and level = "ukm"')->result_array();
	$cariidukm	= $this->db->query("select * from ukm where nama = '".$sesinya['nama_lengkap']."'")->result_array();
	$proposal	= $this->db->query("select * from proposal where id_ukm = '".$cariidukm[0]['id_ukm']."'")->result_array();
	$kegiatan	= $this->db->query("select * from kegiatan where id_ukm = '".$cariidukm[0]['id_ukm']."'")->result_array();
	$lpj		= $this->db->query("select * from lpj where id_ukm = '".$cariidukm[0]['id_ukm']."'")->result_array();
		
		$datax		= array (
			'title'		=> 'Tambah LPJ',
			'nama'		=> $sesinya['nama_lengkap'],
			'foto'		=> $user[0]['foto'],
			'level'		=> $user[0]['level'],
			'status'	=> 'edit',
			'kode'		=> $lpj[0]['id_lpj'],
			'nama_p'	=> $lpj[0]['nama_lpj'],
			'tgl'		=> $lpj[0]['tanggal'],
			'proposal'	=> $proposal,
			'kegiatan'	=> $kegiatan,
			);
			$this->load->view('ukm/head',$datax);
			$this->load->view('ukm/lpj_add');
			$this->load->view('ukm/footer');
	}
	
	function lpj_save(){
		
		if($_POST){
			
			$sesinya	= $this->session->userdata('login');
			$uk			= $sesinya['nama_lengkap'];
			$d			= $this->db->query("select id_ukm from ukm where nama =  '".$uk."' ")->result_array();
			
			$kode		= $this->input->post('kode');
			$status		= $this->input->post('status');
			$nama_p	= $this->input->post('nama');
			$proposal	= $this->db->query("select * from proposal where id_ukm = '".$d[0]['id_ukm']."' and judul = '".$nama_p."'")->result_array();
	
				
		if($status == 'baru'){
				
				if($_FILES['berkas_lpj']['name'] != ""){
			    $config['upload_path'] = 'assets/lpj';
			    $config['allowed_types'] = 'pdf';
			    $config['max_size'] = '5000';
			    $config['remove_spaces'] = true;
			    $config['overwrite'] = false;
			    $config['encrypt_name'] = true;
			    $config['max_width']  = '';
			    $config['max_height']  = '';
			    $this->load->library('upload', $config);
			    $this->upload->initialize($config);            
			    if (!$this->upload->do_upload('berkas_lpj'))
			    {
			        echo "Data yang anda upload tidak diperbolehkan";
			    }
			    else
			    {
		        $image = $this->upload->data();
		        if ($image['file_name'])
		        {
		            $data['file1'] = $image['file_name'];
		        }        
		        $berkas_lpj = $data['file1'];
		    }
			}
			
			$data = array(
				'nama_lpj'		=> $nama_p,
				'tanggal'		=> date('Y-m-d'),
				'berkas'		=> $berkas_lpj,
				'id_proposal'	=> $proposal[0]['id_proposal'],
				'id_ukm'		=> $d[0]['id_ukm'],
				'status'			=> 'diproses',
				'status_penilaian' => 'belum',
			);
			
				$masuk = $this->M_ukm->simpan('lpj',$data);
				redirect("ukm/lpj");
				
			}
			else {
				
				
				$this->db->where('id_lpj',$kode);
				$query 	= $this->db->get('lpj');
				$row	= $query->row();
				
				unlink("./assets/prestasi/$row->berkas");
				
				if($_FILES['berkas_lpj']['name'] != ""){
			    $config['upload_path'] = 'assets/lpj';
			    $config['allowed_types'] = 'pdf|docx';
			    $config['max_size'] = '5000';
			    $config['remove_spaces'] = true;
			    $config['overwrite'] = false;
			    $config['encrypt_name'] = true;
			    $config['max_width']  = '';
			    $config['max_height']  = '';
			    $this->load->library('upload', $config);
			    $this->upload->initialize($config);            
			    if (!$this->upload->do_upload('berkas_lpj'))
			    {
			        echo "Data yang anda upload tidak diperbolehkan";
			    }
			    else
			    {
		        $image = $this->upload->data();
		        if ($image['file_name'])
		        {
		            $data['file1'] = $image['file_name'];
		        }        
		        $berkas_lpj = $data['file1'];
		    }
			}
				
				$data = array(
				'nama_lpj'		=> $nama_p,
				'tanggal'		=> date('Y-m-d'),
				'berkas'			=> $berkas_lpj,
				'id_proposal'	=> $proposal[0]['id_proposal'],
				'id_ukm'		=> $d[0]['id_ukm'],
			);
			
			$update = $this->M_ukm->updatedata('lpj',$data,array('id_lpj'=> $kode));
			redirect("ukm/lpj");
			
			}
			
		}
		else {
			echo "HALAMAN TIDAK ADA";
		}
		
	}

	function lpj_del($kode=0){
		$this->db->where('id_lpj',$kode);
		$query 	= $this->db->get('lpj');
		$row	= $query->row();
		
		unlink("./assets/lpj/$row->berkas");
		
		
		
		$hasil	= $this->M_ukm->hapuspro('lpj',array('id_lpj' => $kode));
		redirect("ukm/lpj");
	}

	function lpj_print(){
		$sesinya		= $this->session->userdata('login');
		$user			= $this->M_ukm->getuser('where nama_lengkap = "'.$sesinya['nama_lengkap'].'" and 
		level = "ukm"')->result_array();
		
		$cariidukm	= $this->db->query("select * from ukm where nama = '".$sesinya['nama_lengkap']."'")->result_array();
		$lpj	= $this->db->query("select * from lpj where id_ukm = '".$cariidukm[0]['id_ukm']."'")->result_array();
		

		$this->load->library('fpdf');
		
        /* setting zona waktu */ 
		date_default_timezone_set('Asia/Jakarta');

		$this->fpdf->FPDF("L","cm","A4");
		$this->fpdf->SetMargins(1,1,1);
		$this->fpdf->AliasNbPages();
		$this->fpdf->AddPage();
		$this->fpdf->SetFont('Times','B',12);
		
		$this->fpdf->Ln();
		$this->fpdf->Image('http://localhost/elektabilitas/assets/back/images/uin.png',4,0.5);
		$this->fpdf->Ln();
		
		$this->fpdf->Ln();
		$this->fpdf->Cell(27,0.7,'LAPORAN ELEKABILITAS UKM UIN MAULANA MALIK IBRAHIM MALANG',0,0,'C');
		$this->fpdf->Ln();
		$this->fpdf->SetFont('helvetica','',10);
		$this->fpdf->Cell(27,0.5,'Jalan Gajayana No. 50 Malang Telp: +62 341 551354',0,0,'C');

		$this->fpdf->Ln();
		$this->fpdf->Cell(27,0.5,'homepage : www.uin-malang.ac.id  email : info@uin-malang.ac.id',0,0,'C');
		
		
		$this->fpdf->Ln(1);
		$this->fpdf->Ln(1);
		$this->fpdf->SetFont('Times','B',12);
		$tahun = date('Y');
		$this->fpdf->Cell(26,1,'DAFTAR LPJ UKM "'.$sesinya['nama_lengkap'].'"  PERIODE "'.$tahun.'"',0,0,'C');
		

		/* Fungsi Line untuk membuat garis */
		$this->fpdf->Line(1,3.5,29,3.5);


		/* setting header table */
		$this->fpdf->Ln(1);
		$this->fpdf->SetFont('Times','B',12);
		$this->fpdf->Cell(2  , 1, 'No.'           , 1, 'LR', 'L');
		$this->fpdf->Cell(8 , 1, 'NAMA LPJ' , 1, 'LR', 'L');
		$this->fpdf->Cell(4 , 1, 'TANGGAL' , 1, 'LR', 'L');
		$this->fpdf->Cell(10 , 1, 'BERKAS' , 1, 'LR', 'L');
		$this->fpdf->Cell(3 , 1, 'STATUS' , 1, 'LR', 'L');
		
		$no = 1;
		foreach($lpj as $a){

			$this->fpdf->Ln();
		    $this->fpdf->SetFont('Times','',12);
			$this->fpdf->Cell(2,0.7,$no++,1,'LR','L');
			$this->fpdf->Cell(8,0.7,$a['nama_lpj'],1,'LR','L');
			$this->fpdf->Cell(4,0.7,$a['tanggal'],1,'LR','L');
			$this->fpdf->Cell(10,0.7,$a['berkas'],1,'LR','L');
			$this->fpdf->Cell(3,0.7,$a['status'],1,'LR','L');
		}
			
		
		$this->fpdf->SetY(-3);

		/* setting font untuk footer */
		$this->fpdf->SetFont('Times','',10);
		/* setting cell untuk page number */
		$this->fpdf->Cell(9.5, 0.5, 'Halaman '.$this->fpdf->PageNo().'/{nb}',0,0,'L');

		/* generate pdf jika semua konstruktor, data yang akan ditampilkan, dll sudah selesai */
		$this->fpdf->Output("data_lpj_UKM.pdf","I");
	}

	function salah_lpj(){
		$data = array (
					'title' 	=> "Kesalahan Input LPJ",
					'isi'		=> "Anda tidak diperkenankan input lpj dikarenakan anda belum
									pernah menginputkan data proposal sebelumnya. <br />
									Halaman akan redirect otomatis dalam 5 detik.",
					'url'		=> base_url().'ukm/proposal',
					'judul'	=> "Kesalahan Input LPJ",
				);
				$this->load->view('ukm/salah', $data);
	}
	
	function kegiatan() {
		
		$sesinya	= $this->session->userdata('login');
		$ambil_user = $this->M_ukm->getuser('where nama_lengkap = "'.$sesinya['nama_lengkap'].'" and level = "ukm"')->result_array();
		$cariidukm	= $this->db->query("select * from ukm where nama = '".$sesinya['nama_lengkap']."'")->result_array();
		$idukm			= $this->db->query("select * from ukm where nama = '".$sesinya['nama_lengkap']."'");
		$ukmku			= $idukm->num_rows();
		
		if ($ukmku > 0 ) {	
			$tampilkg1	= $this->db->query("select * from kegiatan where id_ukm = '".$cariidukm[0]['id_ukm']."'")->result_array();
			$tampilkg	= $this->db->query("select * from kegiatan where id_ukm = '".$cariidukm[0]['id_ukm']."'");
		$data		= array (

			'title'	=> 'Daftar Kegiatan UKM',
			'nama'	=> $sesinya['nama_lengkap'],
			'foto'	=> $ambil_user[0] ['foto'],
			'level'	=> $ambil_user[0] ['level'],
			'tampilkg1'	=> $tampilkg1,
			'tampil'=> $tampilkg->num_rows(),
			);
			$this->load->view('ukm/head',$data);
			$this->load->view('ukm/kegiatan');
			$this->load->view('ukm/footer');
		}
			else {
				$data = array (
					'title' 	=> "Kesalahan Input Kegiatan",
					'isi'		=> "Anda tidak diperkenankan input kegiatan dikarenakan anda belum
									mengupdate data struktur UKM anda. <br />
									Halaman akan redirect otomatis dalam 5 detik.",
					'url'		=> base_url().'ukm/struktur',
					'judul'	=> "Kesalahan Input Kegiatan",
				);
				$this->load->view('ukm/salah', $data);
			}
		
	}
	
	function kegiatan_add(){
		$sesinya	= $this->session->userdata('login');
		$ambil_user = $this->M_ukm->getuser('where nama_lengkap = "'.$sesinya['nama_lengkap'].'" and level = "ukm"')->result_array();
		
		$data		= array (
				'title'	=> 'Daftar Kegiatan UKM',
				'nama'	=> $sesinya['nama_lengkap'],
				'foto'	=> $ambil_user[0] ['foto'],
				'level'	=> $ambil_user[0] ['level'],
				'status'=> 'baru',
				'kode'	=> '',
				'judul'	=> '',
				);
				$this->load->view('ukm/head',$data);
				$this->load->view('ukm/add_kegiatan');
				$this->load->view('ukm/footer');
	}
	
	function kegiatan_edit($kode=0){
		$sesinya		= $this->session->userdata('login');
		$user			= $this->M_ukm->getuser('where nama_lengkap = "'.$sesinya['nama_lengkap'].'" 	and level = "ukm"')->result_array();
		$tampil			= $this->db->query("select * from kegiatan where id_kegiatan = '$kode' ")->result_array();
		
		$uk				= $sesinya['nama_lengkap'];
		$id_ukm		= $this->db->query("select id_ukm from ukm where nama =  '".$uk."'")->result_array();
		$proposal	= $this->db->query("select * from proposal where id_ukm =  '".$id_ukm[0]['id_ukm']."'")->result_array();
		
		$data		= array (
			'title'	=> 'Edit Kegiatan UKM',
			'nama'	=> $sesinya['nama_lengkap'],
			'foto'	=> $user[0] ['foto'],
			'level'	=> $user[0] ['level'],
			'status'=> 'baru',
			'kode'	=> $tampil[0]['id_kegiatan'],
			'judul'	=> $tampil[0]['judul_kegiatan'],
			'status'=> 'edit',
			);
			$this->load->view('ukm/head',$data);
			$this->load->view('ukm/add_kegiatan');
			$this->load->view('ukm/footer');	
	}
	
	function kegiatan_save(){
		if($_POST){
			$sesinya		= $this->session->userdata('login');
			$uk				= $sesinya['nama_lengkap'];
			$d				= $this->db->query("select id_ukm from ukm where nama =  '".$uk."' ")->result_array();
			
			$nama 		= $this->input->post('judul');
			
			$sesinya	= $this->session->userdata('login');
			$ukmku		= $this->db->query("select * from ukm where nama = '".$sesinya['nama_lengkap']."' ")->result_array();
			
			$kode		= $this->input->post('kode');
			$status		= $this->input->post('status');
			
			if($status == 'baru'){
				$data = array(
				'judul_kegiatan'		=> $nama,
				'id_ukm'					=> $d[0]['id_ukm'],
				);
				$hasil = $this->M_ukm->simpan('kegiatan',$data);
				redirect("ukm/kegiatan");
			}
			else {
				$data = array(
				'judul_kegiatan'		=> $nama,
				'id_ukm'					=> $d[0]['id_ukm'],
				);
				$hasil = $this->M_ukm->updatedata('kegiatan',$data,array('id_kegiatan' => $kode));
				redirect("ukm/kegiatan");
			}
			
			
		}
		else{
			echo "Halaman Tidak Ada";
		}
	}
	
	function kegiatan_del($kode=0){
		$this->db->where('id_kegiatan',$kode);
		$query 	= $this->db->get('kegiatan');
		$row	= $query->row();		
		
		$hasil	= $this->M_ukm->hapuspro('kegiatan',array('id_kegiatan' => $kode));
		redirect("ukm/kegiatan");
	}

	function kegiatan_print(){
		
		$sesinya	= $this->session->userdata('login');
		$ambil_user = $this->M_ukm->getuser('where nama_lengkap = "'.$sesinya['nama_lengkap'].'" 
		and level = "ukm"')->result_array();
		$cariidukm	= $this->db->query("select * from ukm where nama = '".$sesinya['nama_lengkap']."'")->result_array();
		$kegiatan	= $this->db->query("select * from kegiatan where id_ukm = '".$cariidukm[0]['id_ukm']."'")->result_array();
		
		
		$this->load->library('fpdf');
		
        /* setting zona waktu */ 
		date_default_timezone_set('Asia/Jakarta');

		$this->fpdf->FPDF("P","cm","A4");
		$this->fpdf->SetMargins(1,1,1);
		$this->fpdf->AliasNbPages();
		$this->fpdf->AddPage();
		$this->fpdf->SetFont('Times','B',12);
		
		
		$this->fpdf->Ln();
		$this->fpdf->Cell(19,0.7,'LAPORAN ELEKABILITAS UKM UIN MAULANA MALIK IBRAHIM MALANG',0,0,'C');
		$this->fpdf->Ln();
		$this->fpdf->SetFont('helvetica','',10);
		$this->fpdf->Cell(19,0.5,'Jalan Gajayana No. 50 Malang Telp: +62 341 551354',0,0,'C');

		$this->fpdf->Ln();
		$this->fpdf->Cell(17,0.5,'homepage : www.uin-malang.ac.id  email : info@uin-malang.ac.id',0,0,'C');
		
		
		$this->fpdf->Ln(1);
		$this->fpdf->Ln(1);
		$this->fpdf->SetFont('Times','B',12);
		$tahun = date('Y');
		$this->fpdf->Cell(19,1,'DAFTAR KEGIATAN UKM "'.$sesinya['nama_lengkap'].'"  PERIODE "'.$tahun.'"',0,0,'C');
		

		/* Fungsi Line untuk membuat garis */
		$this->fpdf->Line(1,3.5,20,3.5);


		/* setting header table */
		$this->fpdf->Ln(1);
		$this->fpdf->SetFont('Times','B',12);
		$this->fpdf->Cell(2  , 1, 'No.'           , 1, 'LR', 'L');
		$this->fpdf->Cell(17 , 1, 'NAMA KEGIATAN' , 1, 'LR', 'L');
		
		$no = 1;
		foreach($kegiatan as $a){

			$this->fpdf->Ln();
		    $this->fpdf->SetFont('Times','',12);
			$this->fpdf->Cell(2,0.7,$no++,1,'LR','L');
			$this->fpdf->Cell(17,0.7,$a['judul_kegiatan'],1,'LR','L');
		}
			
		
		$this->fpdf->SetY(-3);

		/* setting font untuk footer */
		$this->fpdf->SetFont('Times','',10);
		/* setting cell untuk page number */
		$this->fpdf->Cell(9.5, 0.5, 'Halaman '.$this->fpdf->PageNo().'/{nb}',0,0,'L');

		/* generate pdf jika semua konstruktor, data yang akan ditampilkan, dll sudah selesai */
		$this->fpdf->Output("data_prestasi_UKM.pdf","I");
	}
	
	function prestasi() {
		
		$sesinya	= $this->session->userdata('login');
		$ambil_user = $this->M_ukm->getuser('where nama_lengkap = "'.$sesinya['nama_lengkap'].'" and level = "ukm"')->result_array();
		$cariidukm	= $this->db->query("select * from ukm where nama = '".$sesinya['nama_lengkap']."'")->result_array();
		$idukm		= $this->db->query("select * from ukm where nama = '".$sesinya['nama_lengkap']."'");
		$ukmku		= $idukm->num_rows();	
		
		
		if ($ukmku > 0 ) {
		$tampilpr1	= $this->db->query("select * from prestasi where id_ukm = '".$cariidukm[0]['id_ukm']."'")->result_array();
		$tampilpr	= $this->db->query("select * from prestasi where id_ukm = '".$cariidukm[0]['id_ukm']."'");
				
			$data		= array (
				'title'			=> 'Daftar Prestasi UKM ',
				'nama'			=> $sesinya['nama_lengkap'],
				'foto'			=> $ambil_user[0] ['foto'],
				'level'			=> $ambil_user[0] ['level'],
				'tampilpr1'		=> $tampilpr1,
				'tampilpr'		=> $tampilpr->num_rows(),
				);
				
				$this->load->view('ukm/head',$data);
				$this->load->view('ukm/prestasi');
				$this->load->view('ukm/footer');
			}
		else {
					$data = array (
					'title' 	=> "Kesalahan Input Prestasi",
					'isi'		=> "Anda tidak diperkenankan input prestasi dikarenakan anda belum
									mengupdate data struktur UKM anda. <br />
									Halaman akan redirect otomatis dalam 5 detik.",
					'url'		=> base_url().'ukm/struktur',
					'judul'	=> "Kesalahan Input Prestasi",
				);
				$this->load->view('ukm/salah', $data);
				}		
			
	}
	
	function prestasi_add(){
		$sesinya		= $this->session->userdata('login');
		$ambil_user 	= $this->M_ukm->getuser('where nama_lengkap = "'.$sesinya['nama_lengkap'].'"and level = "ukm"')->result_array();
	
	
			$data		= array (
				'title'			=> 'Tambah Prestasi ',
				'nama'			=> $sesinya['nama_lengkap'],
				'foto'			=> $ambil_user[0] ['foto'],
				'level'			=> $ambil_user[0] ['level'],
				'kode'			=> '',
				'nama_p'		=> '',
				'tgl'			=> '',
				'status'		=> 'baru',
			);
				$this->load->view('ukm/head',$data);
				$this->load->view('ukm/prestasi_add');
				$this->load->view('ukm/footer');
	}
	
	function prestasi_edit($kode=0){
		$sesinya	= $this->session->userdata('login');
		$ambil_user = $this->M_ukm->getuser('where nama_lengkap = "'.$sesinya['nama_lengkap'].'"
		and level = "ukm"')->result_array();
		
		$ambilprestasi = $this->db->query("select * from prestasi where id_prestasi = '".$kode."'")->result_array();
		$data		= array (
			'title'			=> 'Tambah Prestasi ',
			'nama'			=> $sesinya['nama_lengkap'],
			'foto'			=> $ambil_user[0] ['foto'],
			'level'			=> $ambil_user[0] ['level'],
			'kode'			=> $ambilprestasi[0]['id_prestasi'],
			'status'		=> 'edit',
			'nama_p'		=> $ambilprestasi[0]['nama_prestasi'],
			'tgl'			=> $ambilprestasi[0]['tanggal'],
			);
			$this->load->view('ukm/head',$data);
			$this->load->view('ukm/prestasi_add');
			$this->load->view('ukm/footer');
	}
	
	function prestasi_save(){
		if($_POST){			
			
			$sesinya		= $this->session->userdata('login');
			$uk				= $sesinya['nama_lengkap'];
			$d				= $this->db->query("select id_ukm from ukm where nama =  '".$uk."' ")->result_array();
			
			$kode		= $this->input->post('kode');
			$status		= $this->input->post('status');
			$nama		= $this->input->post('nama');
			$tingkat	= $this->input->post('tingkat');
			$tanggal	= new DateTime($this->input->post('tgl'));
			$tgl		= $tanggal->format('Y-m-d');
			$berkas		= $this->input->post('berkas');
			$poin		= $this->input->post('poin');
			
			if($status == 'baru'){
				
				if($_FILES['berkas']['name'] != ""){
			    $config['upload_path'] = 'assets/prestasi';
			    $config['allowed_types'] = 'pdf|jpg|png';
			    $config['max_size'] = '5000';
			    $config['remove_spaces'] = true;
			    $config['overwrite'] = false;
			    $config['encrypt_name'] = true;
			    $config['max_width']  = '';
			    $config['max_height']  = '';
			    $this->load->library('upload', $config);
			    $this->upload->initialize($config);            
			    if (!$this->upload->do_upload('berkas'))
			    {
			        echo "Data yang anda upload tidak diperbolehkan";
			    }
			    else
			    {
		        $image = $this->upload->data();
		        if ($image['file_name'])
		        {
		            $data['file1'] = $image['file_name'];
		        }        
		        $berkas_pres = $data['file1'];
		    }
			}
			
			$data = array(
				'nama_prestasi'		=> $nama,
				'tingkat'			=> $tingkat,
				'tanggal'			=> $tgl,
				'berkas'			=> $berkas_pres,
				'id_ukm'			=> $d[0]['id_ukm'],
				);
				$masuk 	= $this->M_ukm->simpan('prestasi',$data);
				redirect("ukm/prestasi");
			}
			else {
				
				$this->db->where('id_prestasi',$kode);
				$query 	= $this->db->get('prestasi');
				$row	= $query->row();
				
				unlink("./assets/prestasi/$row->berkas");
				
				if($_FILES['berkas']['name'] != ""){
			    $config['upload_path'] = 'assets/prestasi';
			    $config['allowed_types'] = 'pdf|jpg|png';
			    $config['max_size'] = '5000';
			    $config['remove_spaces'] = true;
			    $config['overwrite'] = false;
			    $config['encrypt_name'] = true;
			    $config['max_width']  = '';
			    $config['max_height']  = '';
			    $this->load->library('upload', $config);
			    $this->upload->initialize($config);            
			    if (!$this->upload->do_upload('berkas'))
			    {
			        echo "Data yang anda upload tidak diperbolehkan";
			    }
			    else
			    {
		        $image = $this->upload->data();
		        if ($image['file_name'])
		        {
		            $data['file1'] = $image['file_name'];
		        }        
		        $berkas_pres = $data['file1'];
		    }
			}
				$data = array(
				'nama_prestasi'		=> $nama,
				'tingkat'			=> $tingkat,
				'tanggal'			=> $tgl,
				'berkas'			=> $berkas_pres,
				'id_ukm'			=> $d[0]['id_ukm'],
			);
			$update = $this->M_ukm->updatedata('prestasi',$data,array('id_prestasi'=> $kode));
			redirect("ukm/prestasi");
			}
			
		}
		else {
			echo "HALAMAN TIDAK ADA";
		}
	}
	
	function prestasi_delete($kode=0){
		$this->db->where('id_prestasi',$kode);
		$query 	= $this->db->get('prestasi');
		$row	= $query->row();
				
		unlink("./assets/prestasi/$row->berkas");
		
		$hasil	= $this->M_ukm->hapuspro('prestasi',array('id_prestasi' => $kode));
		redirect("ukm/prestasi");
		
	}

	function prestasi_print(){
		$sesinya		= $this->session->userdata('login');
		$cariidukm	= $this->db->query("select * from ukm where nama = '".$sesinya['nama_lengkap']."'")->result_array();
		$tampilpr1	= $this->db->query("select * from prestasi where id_ukm = '".$cariidukm[0]['id_ukm']."'")->result_array();
		

		$this->load->library('fpdf');
		
        /* setting zona waktu */ 
		date_default_timezone_set('Asia/Jakarta');

		$this->fpdf->FPDF("L","cm","A4");
		$this->fpdf->SetMargins(1,1,1);
		$this->fpdf->AliasNbPages();
		$this->fpdf->AddPage();
		$this->fpdf->SetFont('Times','B',12);
		
		$this->fpdf->Ln();
		$this->fpdf->Image('http://localhost/elektabilitas/assets/back/images/uin.png',4,0.5);
		$this->fpdf->Ln();
		
		$this->fpdf->Ln();
		$this->fpdf->Cell(27,0.7,'LAPORAN ELEKABILITAS UKM UIN MAULANA MALIK IBRAHIM MALANG',0,0,'C');
		$this->fpdf->Ln();
		$this->fpdf->SetFont('helvetica','',10);
		$this->fpdf->Cell(27,0.5,'Jalan Gajayana No. 50 Malang Telp: +62 341 551354',0,0,'C');

		$this->fpdf->Ln();
		$this->fpdf->Cell(27,0.5,'homepage : www.uin-malang.ac.id  email : info@uin-malang.ac.id',0,0,'C');
		
		
		$this->fpdf->Ln(1);
		$this->fpdf->Ln(1);
		$this->fpdf->SetFont('Times','B',12);
		$tahun = date('Y');
		$this->fpdf->Cell(26,1,'DAFTAR PRESTASI UKM "'.$sesinya['nama_lengkap'].'"  PERIODE "'.$tahun.'"',0,0,'C');
		

		/* Fungsi Line untuk membuat garis */
		$this->fpdf->Line(1,3.5,29,3.5);


		/* setting header table */
		$this->fpdf->Ln(1);
		$this->fpdf->SetFont('Times','B',12);
		$this->fpdf->Cell(2  , 1, 'No.'           , 1, 'LR', 'L');
		$this->fpdf->Cell(8 , 1, 'NAMA PRESTASI' , 1, 'LR', 'L');
		$this->fpdf->Cell(4 , 1, 'TINGKAT' , 1, 'LR', 'L');
		$this->fpdf->Cell(4 , 1, 'TANGGAL' , 1, 'LR', 'L');
		$this->fpdf->Cell(10 , 1, 'BERKAS' , 1, 'LR', 'L');
		
		$no = 1;
		foreach($tampilpr1 as $a){

			$this->fpdf->Ln();
		    $this->fpdf->SetFont('Times','',12);
			$this->fpdf->Cell(2,0.7,$no++,1,'LR','L');
			$this->fpdf->Cell(8,0.7,$a['nama_prestasi'],1,'LR','L');
			$this->fpdf->Cell(4,0.7,$a['tingkat'],1,'LR','L');
			$this->fpdf->Cell(4,0.7,$a['tanggal'],1,'LR','L');
			$this->fpdf->Cell(10,0.7,$a['berkas'],1,'LR','L');
		}
			
		
		$this->fpdf->SetY(-3);

		/* setting font untuk footer */
		$this->fpdf->SetFont('Times','',10);
		/* setting cell untuk page number */
		$this->fpdf->Cell(9.5, 0.5, 'Halaman '.$this->fpdf->PageNo().'/{nb}',0,0,'L');

		/* generate pdf jika semua konstruktor, data yang akan ditampilkan, dll sudah selesai */
		$this->fpdf->Output("data_prestasi_UKM.pdf","I");
	}
	
	function anggota() {
		
		$sesinya	= $this->session->userdata('login');
		$ambil_user = $this->M_ukm->getuser('where nama_lengkap = "'.$sesinya['nama_lengkap'].'" 
		and level = "ukm"')->result_array();
		$id			= $this->db->query("select * from ukm where nama = '".$sesinya['nama_lengkap']."'")->result_array();
		
		$idukm			= $this->db->query("select * from ukm where nama = '".$sesinya['nama_lengkap']."'");
		$ukmku			= $idukm->num_rows();
		
		if ($ukmku > 0 ) {	
		$liatdata1	= $this->db->query('select * from anggota where id_ukm = "'.$id[0]['id_ukm'].'" ')->result_array();
		$liatdata	= $this->db->query('select * from anggota where id_ukm = "'.$id[0]['id_ukm'].'" ');
		$data		= array (
				'title'	=> 'Tabel anggota',
				'nama'	=> $sesinya['nama_lengkap'],
				'foto'	=> $ambil_user[0] ['foto'],
				'level'	=> $ambil_user[0] ['level'],
				'liat1'	=> $liatdata1,
				'liat'	=> $liatdata->num_rows(),
		);
			$this->load->view('ukm/head',$data);
			$this->load->view('ukm/anggota');
			$this->load->view('ukm/footer');	
		}
		else {
			$data = array (
					'title' 	=> "Kesalahan Input Anggota",
					'isi'		=> "Anda tidak diperkenankan input anggota dikarenakan anda belum
									mengupdate data struktur UKM anda. <br />
									Halaman akan redirect otomatis dalam 5 detik.",
					'url'		=> base_url().'ukm/struktur',
					'judul'	=> "Kesalahan Input Anggota",
				);
				$this->load->view('ukm/salah', $data);
		}
			
			
	}
	
	function anggota_add(){
		$sesinya	= $this->session->userdata('login');
		$ambil_user = $this->M_ukm->getuser('where nama_lengkap = "'.$sesinya['nama_lengkap'].'" and level = "ukm"')->result_array();
		$idukm		= $this->db->query("select * from ukm where nama = '".$sesinya['nama_lengkap']."'");
		$ukmku		= $idukm->num_rows();
		
		if ($ukmku > 0 ) {	
			$data		= array (
				'title'			=> 'Tambah Anggota',
				'nama'			=> $sesinya['nama_lengkap'],
				'foto'			=> $ambil_user[0] ['foto'],
				'level'			=> $ambil_user[0] ['level'],
				'jumlah'		=> '',
				'thn_p'			=> '',
				'status'		=> 'baru',
				'kode'			=> '',
				);
				$this->load->view('ukm/head',$data);
				$this->load->view('ukm/add_anggota');
				$this->load->view('ukm/footer');
			}
			else {
				$data = array (
					'title' 	=> "Kesalahan Input Anggota",
					'isi'		=> "Anda tidak diperkenankan input anggota dikarenakan anda belum
									mengupdate data struktur UKM anda. <br />
									Halaman akan redirect otomatis dalam 5 detik.",
					'url'		=> base_url().'ukm/struktur',
					'judul'	=> "Kesalahan Input Anggota",
				);
				$this->load->view('ukm/salah', $data);
			}
	}
	
	function anggota_edit($kode=0){
		
		$sesinya	= $this->session->userdata('login');
		$ambil_user = $this->M_ukm->getuser('where nama_lengkap = "'.$sesinya['nama_lengkap'].'" 
		and level = "ukm"')->result_array();
		
		$tampilagt	= $this->db->query('select * from anggota where id_anggota = "'.$kode.'"')->result_array();
		
		
		$data		= array (
			'title'			=> 'Edit Anggota',
			'nama'			=> $sesinya['nama_lengkap'],
			'foto'			=> $ambil_user[0] ['foto'],
			'level'			=> $ambil_user[0] ['level'],
			'jumlah'		=> $tampilagt[0]['jumlah_anggota'],
			'thn_p'			=> $tampilagt[0]['tahun_periode'],
			'status'		=> 'edit',
			'kode'			=> $tampilagt[0]['id_anggota'],
			);
			$this->load->view('ukm/head',$data);
			$this->load->view('ukm/add_anggota');
			$this->load->view('ukm/footer');
			
	}
	
	function anggota_save(){
		if($_POST){
			
			$sesinya	= $this->session->userdata('login');
			$nama		= $this->db->query("select * from ukm where nama = '".$sesinya['nama_lengkap']."'")->result_array();
			
			$kode		= $this->input->post('kode');
			$status		= $this->input->post('status');
			$jumlah		= $this->input->post('jumlah');
			$thn_p		= $this->input->post('thn_periode');
			$semester	= $this->input->post('semester');
			$berkas		= $this->input->post('berkas_agt');
			
			if($status == 'baru'){
				
				if($_FILES['berkas_agt']['name'] != ""){
			    $config['upload_path'] = 'assets/anggota';
			    $config['allowed_types'] = 'pdf';
			    $config['max_size'] = '5000';
			    $config['remove_spaces'] = true;
			    $config['overwrite'] = false;
			    $config['encrypt_name'] = true;
			    $config['max_width']  = '';
			    $config['max_height']  = '';
			    $this->load->library('upload', $config);
			    $this->upload->initialize($config);            
			    if (!$this->upload->do_upload('berkas_agt'))
			    {
			        echo "Data yang anda upload tidak diperbolehkan";
			    }
			    else
			    {
		        $image = $this->upload->data();
		        if ($image['file_name'])
		        {
		            $data['file1'] = $image['file_name'];
		        }        
		        $berkas_agt = $data['file1'];
		    }
			}
				
				$data	= array(
					'jumlah_anggota'	=> $jumlah,
					'tahun_periode'		=> date('Y'),
					'berkas'			=> $berkas_agt,
					'id_ukm'			=> $nama[0]['id_ukm'],
				);
				
				$masuk = $this->M_ukm->simpan('anggota',$data);
				redirect("ukm/anggota");
			}
			else {
				
				$this->db->where('id_anggota',$kode);
				$query 	= $this->db->get('anggota');
				$row	= $query->row();
				
				unlink("./assets/anggota/$row->berkas");
				
				
				if($_FILES['berkas_agt']['name'] != ""){
			    $config['upload_path'] = 'assets/anggota';
			    $config['allowed_types'] = 'pdf';
			    $config['max_size'] = '5000';
			    $config['remove_spaces'] = true;
			    $config['overwrite'] = false;
			    $config['encrypt_name'] = true;
			    $config['max_width']  = '';
			    $config['max_height']  = '';
			    $this->load->library('upload', $config);
			    $this->upload->initialize($config);            
			    if (!$this->upload->do_upload('berkas_agt'))
			    {
			        echo "Data yang anda upload tidak diperbolehkan";
			    }
			    else
			    {
		        $image = $this->upload->data();
		        if ($image['file_name'])
		        {
		            $data['file1'] = $image['file_name'];
		        }        
		        $berkas_agt = $data['file1'];
		    }
			}
				
				$data	= array(
					'jumlah_anggota'	=> $jumlah,
					'tahun_periode'		=> date('Y'),
					'berkas'			=> $berkas_agt,
					'id_ukm'			=> $nama[0]['id_ukm'],
				);
				
				$update	= $this->M_ukm->updatedata('anggota',$data,array('id_anggota' => $kode));
				redirect("ukm/anggota");
			}
			
		}
		else {
			echo "HALAMAN TIDA ADA";
		}
	}
	
	function struktur(){
		
		
		$sesinya	= $this->session->userdata('login');
		$ambil_user = $this->M_ukm->getuser('where nama_lengkap = "'.$sesinya['nama_lengkap'].'" 
		and level = "ukm"')->result_array();
		
		$ambilukm1	= $this->db->query("select * from ukm where nama = '".$sesinya['nama_lengkap']."'")->result_array();
		$ambilukm	= $this->db->query("select * from ukm where nama = '".$sesinya['nama_lengkap']."'");
		$imgstr		= $ambilukm->num_rows();
		$link 		= "<img src=''" .base_url('assets/struktur/');
		if($imgstr>0){
			$imgstr = "<img src=".base_url()."assets/struktur/".$ambilukm1[0]['struktur']." />";
		}
		else {
			$imgstr = "<br /><span>Tidak Ada Preview Struktur Tersimpan</span>";
		}
		
		$data	= array(
			'title'		=> 'Skruktur UKM',
			'kode'  	=> $ambil_user[0]['id'],
			'nama'		=> $sesinya['nama_lengkap'],
			'foto'		=> $ambil_user[0]['foto'],
			'level'		=> $ambil_user[0]['level'],
			'imgstr'	=> $imgstr,
		);
		$this->load->view('ukm/head',$data);
		$this->load->view('ukm/struktur');
		$this->load->view('ukm/footer');
	}
	
	function struktur_save(){
		if($_POST){
			
			$sesinya	= $this->session->userdata('login');
			$kode		= $this->input->post('kode');
			$nama 		= $this->input->post('nama');
			$struktur 	= $this->input->post('b_struktur');
			
			if($_FILES['b_struktur']['name'] != ""){
			    $config['upload_path'] = 'assets/struktur';
			    $config['allowed_types'] = 'gif|jpg|png|jpeg';
			    $config['max_size'] = '5000';
			    $config['remove_spaces'] = true;
			    $config['overwrite'] = false;
			    $config['encrypt_name'] = true;
			    $config['max_width']  = '';
			    $config['max_height']  = '';
			    $this->load->library('upload', $config);
			    $this->upload->initialize($config);            
			    if (!$this->upload->do_upload('b_struktur'))
			    {
			        echo "Data yang anda upload tidak diperbolehkan";
			    }
			    else
			    {
		        $image = $this->upload->data();
		        if ($image['file_name'])
		        {
		            $data['file1'] = $image['file_name'];
		        }        
		        $product_struk = $data['file1'];
		    }
			}
			
			$data = array(
				'nama'		=> $nama,
				'struktur'	=> $product_struk,
			);
			
			$liatukm	= $this->db->query("select * from ukm where nama = '".$sesinya['nama_lengkap']."'");
			
			$num = $liatukm->num_rows();
			if($num>0){
				$hasil = $this->M_ukm->updatedata('ukm',$data,array('nama' => $sesinya['nama_lengkap']));
				redirect("ukm/struktur");
			}
			else {
				$hasil2 = $this->M_ukm->simpan('ukm',$data);
				redirect("ukm/struktur");
			}
			
		}
		else{
			echo "Halaman Tidak Ada";
		}
	}
	
	function alur_berkas(){
		
		$sesinya	= $this->session->userdata('login');
		$ambil_user = $this->M_ukm->getuser('where nama_lengkap = "'.$sesinya['nama_lengkap'].'" 
		and level = "ukm"')->result_array();
		
		$idukm			= $this->db->query("select * from ukm where nama = '".$sesinya['nama_lengkap']."'")->result_array();
		
		$alur			= $this->db->query("select a.judul_kegiatan,b.judul , b.berkas b_prp ,c.nama_lpj , c.berkas b_lpj from kegiatan a, proposal 	b, lpj c where a.id_ukm = b.id_ukm and a.id_kegiatan = b.id_kegiatan and b.id_proposal = c.id_proposal and a.id_ukm =  '".$idukm[0]['id_ukm']."'")->result_array();
		
		
		$data	= array(
			'title'		=> 'Alur Berkas UKM',
			'kode'  	=> $ambil_user[0]['id'],
			'nama'		=> $sesinya['nama_lengkap'],
			'foto'		=> $ambil_user[0]['foto'],
			'level'		=> $ambil_user[0]['level'],
			'alur'		=> $alur,
		);
		$this->load->view('ukm/head',$data);
		$this->load->view('ukm/alur_berkas');
		$this->load->view('ukm/footer');
		
	}

	function alurberkas_print(){
		$sesinya	= $this->session->userdata('login');
		$ambil_user = $this->M_ukm->getuser('where nama_lengkap = "'.$sesinya['nama_lengkap'].'" 
		and level = "ukm"')->result_array();
		$idukm			= $this->db->query("select * from ukm where nama = '".$sesinya['nama_lengkap']."'")->result_array();
		$alur			= $this->db->query("select a.judul_kegiatan,b.judul , b.berkas b_prp ,c.nama_lpj , c.berkas b_lpj 
		from kegiatan a, proposal 	b, lpj c where a.id_ukm = b.id_ukm and a.id_kegiatan = b.id_kegiatan and b.id_proposal 
		= c.id_proposal and a.id_ukm =  '".$idukm[0]['id_ukm']."'")->result_array();
		
		

		$this->load->library('fpdf');
		
        /* setting zona waktu */ 
		date_default_timezone_set('Asia/Jakarta');

		$this->fpdf->FPDF("L","cm","A4");
		$this->fpdf->SetMargins(1,1,1);
		$this->fpdf->AliasNbPages();
		$this->fpdf->AddPage();
		$this->fpdf->SetFont('Times','B',12);
		
		$this->fpdf->Ln();
		$this->fpdf->Image('http://localhost/elektabilitas/assets/back/images/uin.png',4,0.5);
		$this->fpdf->Ln();
		
		$this->fpdf->Ln();
		$this->fpdf->Cell(27,0.7,'LAPORAN ELEKABILITAS UKM UIN MAULANA MALIK IBRAHIM MALANG',0,0,'C');
		$this->fpdf->Ln();
		$this->fpdf->SetFont('helvetica','',10);
		$this->fpdf->Cell(27,0.5,'Jalan Gajayana No. 50 Malang Telp: +62 341 551354',0,0,'C');

		$this->fpdf->Ln();
		$this->fpdf->Cell(27,0.5,'homepage : www.uin-malang.ac.id  email : info@uin-malang.ac.id',0,0,'C');
		
		
		$this->fpdf->Ln(1);
		$this->fpdf->Ln(1);
		$this->fpdf->SetFont('Times','B',12);
		$tahun = date('Y');
		$this->fpdf->Cell(26,1,'ALUR BERKAS UKM "'.$sesinya['nama_lengkap'].'"  PERIODE "'.$tahun.'"',0,0,'C');
		

		/* Fungsi Line untuk membuat garis */
		$this->fpdf->Line(1,3.5,29,3.5);


		/* setting header table */
		$this->fpdf->Ln(1);
		$this->fpdf->SetFont('Times','B',12);
		$this->fpdf->Cell(2  , 1, 'No.'           , 1, 'LR', 'L');
		$this->fpdf->Cell(8 , 1, 'NAMA KEGIATAN' , 1, 'LR', 'L');
		$this->fpdf->Cell(8 , 1, 'PROPOSAL' , 1, 'LR', 'L');
		$this->fpdf->Cell(9.5 , 1, 'LPJ' , 1, 'LR', 'L');
		
		$no = 1;
		foreach($alur as $a){

			$this->fpdf->Ln();
		    $this->fpdf->SetFont('Times','',12);
			$this->fpdf->Cell(2,0.7,$no++,1,'LR','L');
			$this->fpdf->Cell(8,0.7,$a['judul_kegiatan'],1,'LR','L');
			$this->fpdf->Cell(8,0.7,$a['judul'],1,'LR','L');
			$this->fpdf->Cell(9.5,0.7,$a['nama_lpj'],1,'LR','L');
		}
			
		
		$this->fpdf->SetY(-3);

		/* setting font untuk footer */
		$this->fpdf->SetFont('Times','',10);
		/* setting cell untuk page number */
		$this->fpdf->Cell(9.5, 0.5, 'Halaman '.$this->fpdf->PageNo().'/{nb}',0,0,'L');

		/* generate pdf jika semua konstruktor, data yang akan ditampilkan, dll sudah selesai */
		$this->fpdf->Output("data_lpj_UKM.pdf","I");
	}
	
	function nilaimu(){
		
		$sesinya	= $this->session->userdata('login');
		$ambil_user = $this->M_ukm->getuser('where nama_lengkap = "'.$sesinya['nama_lengkap'].'" and level = "ukm"')->result_array();
		$a_nama		= $this->db->query("select * from ukm where nama = '".$sesinya['nama_lengkap']."'")->result_array();
		$points		= $this->db->query("select year(periode) as tahun, a.point,a.id_ukm, b.nama from elektabilitas a,ukm b where b.id_ukm = ".$a_nama[0]['id_ukm']." and a.id_ukm = b.id_ukm")->result_array();
		
		$data	= array(
			'title'			=> 'Nilai Elektabilitas UKM ',
			'kode'  		=> $ambil_user[0]['id'],
			'nama'		=> $sesinya['nama_lengkap'],
			'foto'		=> $ambil_user[0]['foto'],
			'level'		=> $ambil_user[0]['level'],
			'namax'	=> $ambil_user,
			'nilai'		=> $points,
		);
		$this->load->view('ukm/head',$data);
		$this->load->view('ukm/nilaimu');
		$this->load->view('ukm/footer');
		
	}
	
	function grafik_ukm(){
		
		$sesinya			= $this->session->userdata('login');
		$ambil_user    = $this->M_ukm->getuser('where nama_lengkap = "'.$sesinya['nama_lengkap'].'" and level = "ukm"')->result_array();
		$a_nama			= $this->db->query("select * from ukm where nama = '".$sesinya['nama_lengkap']."'")->result_array();
		$id					= $a_nama[0]['id_ukm'];
		$graph1			= $this->M_ukm->creategraph($id);
		
		
		$data	= array(
			'title'			=> 'Grafik Elektabilitas UKM',
			'kode'  		=> $ambil_user[0]['id'],
			'nama'		=> $sesinya['nama_lengkap'],
			'foto'		=> $ambil_user[0]['foto'],
			'level'		=> $ambil_user[0]['level'],
			'graph'		=> $graph1,
		);
		$this->load->view('ukm/head',$data);
		$this->load->view('ukm/grafik');
		$this->load->view('ukm/footer');
		
	}
	
	function nilai_akhir_ukm(){
		$sesinya			= $this->session->userdata('login');
		$ambil_user    = $this->M_ukm->getuser('where nama_lengkap = "'.$sesinya['nama_lengkap'].'" and 
		level = "ukm"')->result_array();
		$graph1			= $this->M_ukm->buatgraf();
		
		$elekta 		= $this->db->query("select a.id_ukm, a.nama, b.point,b.id_ukm from ukm a,elektabilitas b 
		where a.id_ukm = b.id_ukm")->result_array();
		
		$data	= array(
			'title'		=> 'Laporan Akhir Penilaian Elektabilitas UKM UIM Malang',
			'kode'  	=> $ambil_user[0]['id'],
			'nama'		=> $sesinya['nama_lengkap'],
			'foto'		=> $ambil_user[0]['foto'],
			'level'		=> $ambil_user[0]['level'],
			'graph'		=> $graph1,
			'elekta'	=> $elekta,
		);
		$this->load->view('ukm/nilaiakhir',$data);
		
	}
	
}
?>