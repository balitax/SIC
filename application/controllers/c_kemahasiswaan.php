<?php
class C_kemahasiswaan extends CI_Controller {
	function __construct() {
		parent::__construct();
		
		if($this->session->userdata('login') != TRUE){
			redirect('');
		}
		
		$this->load->model('M_kemahasiswaan');
	}
	
	function index(){
		
		$sesinya	= $this->session->userdata('login');
		
		if($sesinya['level'] != 'kemahasiswaan'){
			$data = array (
					'title' 	=> "Kesalahan Hak Akses",
					'isi'		=> "Anda tidak diperkenankan mengakses halaman ini karena anda bukan kemahasiswaan. <br />
									Halaman akan redirect otomatis dalam 5 detik.",
					'url'		=> base_url(),
					'judul'		=> "Kesalahan Hak Akses",
				);
				$this->load->view('kemahasiswaan/salah', $data);
		}
		else {
		$ambil_user = $this->M_kemahasiswaan->getuser('where level = "kemahasiswaan" ')->result_array();
		$sesinya	= $this->session->userdata('login');
		$data	= array(
			'title'	=> 'Selamat Datang Kemahasiswaan',
			'nama'	=> $sesinya['nama_lengkap'],
			'foto'	=> $ambil_user[0]['foto'],
		);
		$this->load->view('kemahasiswaan/head',$data);
		$this->load->view('kemahasiswaan/index');
		$this->load->view('kemahasiswaan/footer');		
		}
	
	}
	
	function logout(){
		$this->session->sess_destroy();
		session_destroy();
		redirect('');
	}
	
	function verifikasi_proposal(){
		$ambil_user = $this->M_kemahasiswaan->getuser('where level = "kemahasiswaan"')->result_array();
		$sesinya	= $this->session->userdata('login');
		
		$propo		= $this->db->query("select proposal.id_proposal,proposal.judul,proposal.berkas,proposal.status,ukm.id_ukm,ukm.nama from  proposal,ukm where proposal.id_ukm = ukm.id_ukm and proposal.status = 'diproses' ")->result_array();
		
		$data		= array(
				'title' => 'Selamat Datang Kemahasiswaan',
				'nama'	=> $sesinya ['nama_lengkap'],
				'foto'	=> $ambil_user [0] ['foto'],
				'propo'	=> $propo,
				
		);
		$this->load->view('kemahasiswaan/head',$data);
		$this->load->view('kemahasiswaan/v_proposal');
		$this->load->view('kemahasiswaan/footer');
	}
	
	function v_proposal_edit($kode=0){
		
		$ambil_user = $this->M_kemahasiswaan->getuser('where level = "kemahasiswaan"')->result_array();
		$sesinya	= $this->session->userdata('login');
		
		$propo		= $this->db->query("select proposal.id_proposal,proposal.judul,proposal.berkas,proposal.status,ukm.id_ukm,ukm.nama from  proposal,ukm where proposal.id_ukm = ukm.id_ukm and proposal.status = 'diproses' ")->result_array();
		
		$data		= array(
				'title' => 'Selamat Datang Kemahasiswaan',
				'nama'	=> $sesinya ['nama_lengkap'],
				'foto'		=> $ambil_user [0] ['foto'],
				'nama'	=> $propo[0]['judul'],
				'kode'	=> $propo[0]['id_proposal'],			
			);
		$this->load->view('kemahasiswaan/head',$data);
		$this->load->view('kemahasiswaan/v_edit_proposal');
		$this->load->view('kemahasiswaan/footer');
	}
	
	function aksi_v_proposal(){
		if($_POST){
			$kode	= $this->input->post('kode');
			$status = $this->input->post('status');
			
			$data = array(
				'status'	=> $status,
			);
			$update	= $this->M_kemahasiswaan->updatedata('proposal',$data, array('id_proposal' => $kode));
			redirect("kemahasiswaan/verifikasi_proposal");
		}
		else {
			echo "Tidak Ada Halaman Tersedia";
		}
	}
	
	function propo_lama(){
		$ambil_user = $this->M_kemahasiswaan->getuser('where level = "kemahasiswaan"')->result_array();
		$sesinya		= $this->session->userdata('login');
		$period		= $this->db->query('select * from periode')->result_array();
		$propol		= $this->db->query("select year(tanggal_mulai) as tahun,proposal.id_proposal,proposal.judul,proposal.berkas,proposal.status,ukm.id_ukm,ukm.nama from  proposal,ukm where proposal.id_ukm = ukm.id_ukm and proposal.status = 'diterima' AND YEAR( tanggal_mulai ) =".$period[0]['tahun_periode']."")->result_array();
		
		$data		= array(
				'title' 		=> 'Selamat Datang Kemahasiswaan',
				'nama'	=> $sesinya ['nama_lengkap'],
				'foto'		=> $ambil_user [0] ['foto'],
				'propol'	=> $propol,
				
		);
		$this->load->view('kemahasiswaan/head',$data);
		$this->load->view('kemahasiswaan/propo_lama');
		$this->load->view('kemahasiswaan/footer');	
	}

	function print_propolama(){
		$propolam	= $this->db->query("select proposal.id_proposal,proposal.judul,proposal.berkas,proposal.status,ukm.id_ukm,ukm.nama from  proposal,ukm where proposal.id_ukm = ukm.id_ukm and proposal.status = 'diterima' order by ukm.nama")->result_array();

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
		$this->fpdf->Cell(26,1,'BERKAS PROPOSAL DITERIMA PERIODE 2013',0,0,'C');
		

		/* Fungsi Line untuk membuat garis */
		$this->fpdf->Line(1,3.5,29,3.5);


		/* setting header table */
		$this->fpdf->Ln(1);
		$this->fpdf->SetFont('Times','B',12);
		$this->fpdf->Cell(2  , 1, 'No.'           , 1, 'LR', 'L');
		$this->fpdf->Cell(8 , 1, 'JUDUL PROPOSAL' , 1, 'LR', 'L');
		$this->fpdf->Cell(7 , 1, 'NAMA UKM' , 1, 'LR', 'L');
		$this->fpdf->Cell(11 , 1, 'BERKAS' , 1, 'LR', 'L');
		
		$no = 1;
		foreach($propolam as $a){
			
			if($a['nama'] == $a['nama']){
				$this->fpdf->Ln();
		    $this->fpdf->SetFont('Times','',12);
			$this->fpdf->Cell(2,0.7,$no++,1,'LR','L');
			$this->fpdf->Cell(8,0.7,$a['judul'],1,'LR','L');
			$this->fpdf->Cell(7,0.7,$a['nama'],1,'LR','L');
			$this->fpdf->Cell(11,0.7,$a['berkas'],1,'LR','L');
			}
		}
			
		
		$this->fpdf->SetY(-3);

		/* setting font untuk footer */
		$this->fpdf->SetFont('Times','',10);
		/* setting cell untuk page number */
		$this->fpdf->Cell(9.5, 0.5, 'Halaman '.$this->fpdf->PageNo().'/{nb}',0,0,'L');

		/* generate pdf jika semua konstruktor, data yang akan ditampilkan, dll sudah selesai */
		$this->fpdf->Output("data_proposal_UKM.pdf","I");
	}
	
	function verifikasi_lpj(){
		$ambil_user = $this->M_kemahasiswaan->getuser('where level = "kemahasiswaan"')->result_array();
		$sesinya	= $this->session->userdata('login');
		
		$lpj		= $this->db->query("select a.id_lpj,a.nama_lpj,a.berkas,b.nama from lpj a, ukm b where a.id_ukm=b.id_ukm and a.status='diproses' ")->result_array();
		
		$data		= array(
				'title' => 'Selamat Datang Kemahasiswaan',
				'nama'	=> $sesinya ['nama_lengkap'],
				'foto'	=> $ambil_user [0] ['foto'],
				'lpj'	=> $lpj,
				
		);
		$this->load->view('kemahasiswaan/head',$data);
		$this->load->view('kemahasiswaan/v_lpj');
		$this->load->view('kemahasiswaan/footer');
	}
	
	function v_lpj_edit($kode=0){
		
		$ambil_user = $this->M_kemahasiswaan->getuser('where level = "kemahasiswaan"')->result_array();
		$sesinya	= $this->session->userdata('login');
		
		$lpj		= $this->db->query("select a.id_lpj,a.nama_lpj,a.status,b.nama from lpj a, ukm b where a.id_ukm=b.id_ukm and a.id_lpj = ".$kode."")->result_array();
		
		$data		= array(
				'title' => 'Selamat Datang Kemahasiswaan',
				'nama'	=> $sesinya ['nama_lengkap'],
				'foto'		=> $ambil_user [0] ['foto'],
				'nama'	=> $lpj[0]['nama_lpj'],
				'kode'	=> $lpj[0]['id_lpj'],			
			);
		$this->load->view('kemahasiswaan/head',$data);
		$this->load->view('kemahasiswaan/v_edit_lpj');
		$this->load->view('kemahasiswaan/footer');
	}
	
	function v_lpj_simpan(){
		if($_POST){
			$kode	= $this->input->post('kode');
			$status = $this->input->post('status');
			
			$data = array(
				'status'			=> $status,
				'status_penilaian'	=> 'belum',
			);
			$update	= $this->M_kemahasiswaan->updatedata('lpj',$data, array('id_lpj' => $kode));
			redirect("kemahasiswaan/tabel_lpj");
		}
		else {
			echo "Tidak Ada Halaman Tersedia";
		}
	}
	
	function tabel_lpj(){
		$ambil_user = $this->M_kemahasiswaan->getuser('where level = "kemahasiswaan"')->result_array();
		$sesinya	= $this->session->userdata('login');
		
		$lpj		= $this->db->query("select a.id_lpj,a.nama_lpj,a.berkas,a.status_penilaian,b.nama from lpj a, ukm b where a.id_ukm=b.id_ukm and a.status='diterima' and a.status_penilaian='belum'")->result_array();
		$data		= array(
				'title' => 'Selamat Datang Kemahasiswaan',
				'nama'	=> $sesinya ['nama_lengkap'],
				'foto'	=> $ambil_user [0] ['foto'],
				'lpj'	=> $lpj,
				
		);
		$this->load->view('kemahasiswaan/head',$data);
		$this->load->view('kemahasiswaan/tabel_lpj');
		$this->load->view('kemahasiswaan/footer');
	}
	
	function elektabilitas(){
		$ambil_user = $this->M_kemahasiswaan->getuser('where level = "kemahasiswaan"')->result_array();
		$sesinya	= $this->session->userdata('login');	
		$period		= $this->db->query('select * from periode')->result_array();
		$hasil		= $this->db->query("SELECT a.id_ukm, YEAR( periode ) AS tahun, a.point, b.nama FROM elektabilitas a, ukm b WHERE a.id_ukm = b.id_ukm AND YEAR( periode ) = ".$period[0]['tahun_periode']."")->result_array();

	/*	$tabil 		= $this->db->query("select a.*,b.nama,c.* from nilai_lpj a,ukm b,telat c where a.id_ukm=b.id_ukm order by a.id_ukm")->result_array();
		$ambil 	= $this->db->query('select * from telat')->result_array();
		
		$rata = $this->db->query("select sum(jumlah) as jumlah from nilai_lpj where id_ukm = 2 ")->result_array();
			
		$jum = $this->db->query("select count(id_lpj) as rata from nilai_lpj where id_ukm = 2 group by id_ukm ")->result_array();
		
		$rata2 = $this->db->query("select sum(jumlah) as jumlah from nilai_lpj where id_ukm = 3 ")->result_array();
			
		$jum2 = $this->db->query("select count(id_lpj) as rata from nilai_lpj where id_ukm = 3 
		group by id_ukm  ")->result_array();
		
		// Prestasi Kampus 2
		
			$pointkamp  	= $this->db->query("select count(tingkat) as kampus from prestasi where tingkat = 'kampus' 
			and id_ukm =2")->result_array();
			$pointdaerah  	= $this->db->query("select count(tingkat) as daerah  from prestasi where tingkat = 'daerah'
			and id_ukm =2")->result_array();
			$pointnasio  	= $this->db->query("select count(tingkat) as nasional from prestasi where tingkat = 'nasional'
			and id_ukm =2")->result_array();
			
			$pointkampus 	= $pointkamp[0]['kampus'];
			$pointdaerah 	= $pointdaerah[0]['daerah'];
			$pointnasional 	= $pointnasio[0]['nasional'];
			
			if($pointkampus == 1){
				$kampus = 1;
			}
			else if($pointkampus == 2){
				$kampus = 2;
			}
			else if($pointkampus == 3){
				$kampus = 3;
			}
			else if($pointkampus == 4){
				$kampus = 4;
			}
			else if($pointkampus == 5){
				$kampus = 5;
			}
			else if($pointkampus > 5){
				$kampus = 5;
			}
			else {
				$kampus = 0;
			}
			
			
			if($pointdaerah == 1){
				$daerah = 5;
			}
			else if($pointdaerah == 2){
				$daerah = 10;
			}
			else if($pointdaerah > 2){
				$daerah = 10;
			}
			else {
				$daerah = 0;
			}
			
			if($pointnasional == 1){
				$nasional = 10;
			}
			else if($pointnasional == 2){
				$nasional = 20;
			}
			else if($pointnasional > 2){
				$nasional = 20;
			}
			else {
				$nasional= 0;
			}
			
			$total1 = $kampus + $daerah + $nasional;
			
		// Prestasi Kampus 3
		

			$pointkamp2  	= $this->db->query("select count(tingkat) as kampus from prestasi where tingkat = 'kampus' 
			and id_ukm =3")->result_array();
			$pointdaerah2  	= $this->db->query("select count(tingkat) as daerah  from prestasi where tingkat = 'daerah'
			and id_ukm =3")->result_array();
			$pointnasio2  	= $this->db->query("select count(tingkat) as nasional from prestasi where tingkat = 'nasional'
			and id_ukm =3")->result_array();
			
			$pointkampus2 	= $pointkamp2[0]['kampus'];
			$pointdaerah2 	= $pointdaerah2[0]['daerah'];
			$pointnasional2 = $pointnasio2[0]['nasional'];
			
			if($pointkampus2 == 1){
				$kampus2 = 1;
			}
			else if($pointkampus2 == 2){
				$kampus2 = 2;
			}
			else if($pointkampus2 == 3){
				$kampus2 = 3;
			}
			else if($pointkampus2 == 4){
				$kampus2 = 4;
			}
			else if($pointkampus2 == 5){
				$kampus2 = 5;
			}
			else if($pointkampus2 > 5){
				$kampus2 = 5;
			}
			else {
				$kampus2 = 0;
			}
			
			
			if($pointdaerah2 == 1){
				$daerah2 = 5;
			}
			else if($pointdaerah2 == 2){
				$daerah2 = 10;
			}
			else if($pointdaerah2 > 2){
				$daerah2 = 10;
			}
			else {
				$daerah2 = 0;
			}
			
			if($pointnasional2 == 1){
				$nasional2 = 10;
			}
			else if($pointnasional2 == 2){
				$nasional2 = 20;
			}
			else if($pointnasional2 > 2){
				$nasional2 = 20;
			}
			else {
				$nasional2 = 0;
			}
			
			$total2 = $kampus2 + $daerah2 + $nasional2;
		
		$b 	= $this->db->query('select * from bobot')->result_array();
		$ba 	= $b[0]['anggota'];
			
		$a = $this->db->query("select * from anggota where id_ukm = 2 ")->result_array();
		$anggota = $a[0]['jumlah_anggota'];
		$aa = $this->db->query("select * from anggota where id_ukm = 3 ")->result_array();
		$anggota2 = $aa[0]['jumlah_anggota'];
		
		$jumlaha	=$this->db->query("select * from nilai_lpj where id_ukm = 2")->result_array();
	*/	$jumlahb	=$this->db->query("select * from nilai_lpj where id_ukm = 3")->result_array();
		$data		= array(
				'title' 		=> 'Selamat Datang Kemahasiswaan',
				'nama'		=> $sesinya ['nama_lengkap'],
				'foto'		=> $ambil_user [0] ['foto'],
				'hasil'		=> $hasil,
		/*		'tabil'		=> $tabil,
				'rata'		=> $rata[0]['jumlah'],
				'jumlah'	=> $jum[0]['rata'],
				'rata2'		=> $rata2[0]['jumlah'],
				'jumlah2'	=> $jum2[0]['rata'],
				'prestasi'	=> $total1,
				'prestasi2'=> $total2,
				'bobot'		=> $ba,
				'anggota'	=> $anggota,
				'anggota2'=> $anggota2,
				'jumlaha'	=> $jumlaha,
				'jumlahb'	=> $jumlahb,
		*/		
		);
		$this->load->view('kemahasiswaan/head',$data);
		$this->load->view('kemahasiswaan/elektabilitas');
		$this->load->view('kemahasiswaan/footer');
	}
	
	function penilaian_lpj($kode=0){
		$ambil_user 	= $this->M_kemahasiswaan->getuser('where level = "kemahasiswaan"')->result_array();
		$sesinya		= $this->session->userdata('login');
		$lpj				= $this->db->query("select a.id_lpj,a.nama_lpj,a.id_ukm, b.nama from lpj a,ukm b where a.id_ukm=b.id_ukm and a.id_lpj = ".$kode."")->result_array();
		$points			= $this->db->query('select * from points')->result_array();
		
		$data		= array(
				'title' 				=> 'Selamat Datang Kemahasiswaan',
				'nama'			=> $sesinya ['nama_lengkap'],
				'foto'				=> $ambil_user [0] ['foto'],	
				'kode'			=> $lpj[0]['id_lpj'],
				'id_ukm'		=> $lpj[0]['id_ukm'],
				'administrasi'	=> $points[0]['lpj_administrasi'],
				'keuangan'		=> $points[0]['lpj_keuangan'],
				'pengesahan'	=> $points[0]['lpj_pengesahan'],
				'pendahuluan'	=> $points[0]['lpj_pendahuluan'],
				'kepanitiaan'	=> $points[0]['lpj_struktur_kepanitiaan'],
				'job'				=> $points[0]['lpj_job_diskripsi'],
				'pelaksanaan'	=> $points[0]['lpj_hasil_pelaksanaan'],
				'penutup'		=> $points[0]['lpj_penutup'],
				'lampiran'		=> $points[0]['lpj_lampiran'],
		);
		$this->load->view('kemahasiswaan/head',$data);
		$this->load->view('kemahasiswaan/penilaian_lpj');
		$this->load->view('kemahasiswaan/footer');
	}
	
	function v_lpj_nilai(){
		if($_POST){
			
			$kode		= $this->input->post('kode');
			$adm 		= $this->input->post('administrasi');
			$keu			= $this->input->post('keuangan');
			$peng		= $this->input->post('pengesahan');
			$pend 		= $this->input->post('pendahuluan');
			$str			= $this->input->post('struktur');
			$job			= $this->input->post('job');
			$pel			= $this->input->post('pelaksanaan');
			$pntp 		= $this->input->post('penutup');
			$lamp 		= $this->input->post('lampiran');
			$peng		= $this->input->post('pengesahan');
			$pend 		= $this->input->post('pendahuluan');
			$str			= $this->input->post('struktur');
			$job	 		= $this->input->post('job');
			$pel	 		= $this->input->post('pelaksanaan');
			$pntp 		= $this->input->post('penutup');
			$lamp 		= $this->input->post('lampiran');
			$id_ukm 	= $this->input->post('id_ukm');
			
			$idp 					= $this->db->query('select id_proposal from lpj where id_lpj = '.$kode.'')->result_array();
			$propo_selesai 	= $this->db->query("select tanggal_selesai from proposal where id_ukm = ".$id_ukm." and id_proposal = ".$idp[0]['id_proposal']."")->result_array();
			$lpj_kumpul	   	= $this->db->query("select tanggal from lpj where id_proposal = ".$idp[0]['id_proposal']."")->result_array();
			
			$tgl_propo 	= $propo_selesai[0]['tanggal_selesai'];
			$tgl_lpj 			= $lpj_kumpul[0]['tanggal'];
			
			$telat  			= $this->db->query("select datediff('$tgl_lpj','$tgl_propo') as telat")->result_array();
			$ambil 			= $this->db->query('select * from telat')->result_array();
			
			//$jml = $adm + $keu + $peng + $pend  + $str + $job + $pel + $pntp + $lamp;
			$jml 			= $adm + $keu + $peng + $pend  + $str + $job + $pel + $pntp + $lamp;
			$coba		= $telat[0]['telat'];
			$h_coba 	= $coba-7;
		
			if($h_coba<= $ambil[0]['p_hari']){
				$persen = $ambil[0]['p_points'];
				$hasil	  = $jml - ($jml * ($persen/100));
			} 
			else if($h_coba <= $ambil[0]['k_hari']){
				$persen = $ambil[0]['k_points'];
				$hasil 	  = $jml - ($jml * ($persen/100));
			}
			else if($h_coba> $ambil[0]['ke_hari']){
				$persen = $ambil[0]['ke_points'];
				$hasil 	  = $jml - ($jml * ($persen/100));
			}
		
		$data = array(
				'id_lpj'				=> $kode,
				'administrasi'		=> $adm,
				'keuangan'			=> $keu,
				'pengesahan'		=> $peng,
				'pendahuluan'		=> $pend,
				'struktur'			=> $str,
				'job'					=> $job,
				'hasil'				=> $pel,
				'penutup'			=> $pntp,
				'pendahuluan'		=> $pend,
				'struktur'			=> $str,
				'job'					=> $job,
				'hasil'				=> $pel,
				'penutup'			=> $pntp,
				'lampiran'			=> $lamp,
				'jumlah'				=> $hasil,
				'total_lpj'			=> $jml,
				'telat'					=> $h_coba,
				'jumlah'				=> $hasil,
				'id_ukm'			=> $id_ukm,		
			);
			
			$data2 = array(
				'status_penilaian'			=> 'dinilai',
			);
			
			$simpan	= $this->M_kemahasiswaan->simpandata('nilai_lpj',$data);
			$simpan	= $this->M_kemahasiswaan->updatedata('lpj',$data2,array('id_lpj' => $kode));
			//simpan points elektabilitas//
			//==================Elektabilitas==========================
			$ukm = $this->db->query("select * from ukm where id_ukm = ".$id_ukm ."")->result_array();
			
			$rata = $this->db->query("select sum(jumlah) as hasil from nilai_lpj where id_ukm = ".$id_ukm ."")->result_array();
			
			$jum = $this->db->query("select count(id_lpj) as rata from nilai_lpj where id_ukm = ".$id_ukm ." group by id_ukm ")->result_array();
			
			$jum_lpj = $rata[0]['hasil'];
			$jumlah = $jum[0]['rata'];
			
			$hitung = $jum_lpj / $jumlah + (10/100 * $jumlah * ( $jum_lpj / $jumlah ) )- 10;
			
			$b 	= $this->db->query('select * from bobot')->result_array();
			$ba 	= $b[0]['anggota'];
			
			$a = $this->db->query("select * from anggota where id_ukm = ".$id_ukm."")->result_array();
			$anggota = $a[0]['jumlah_anggota'];
			
			if ($anggota >= 30) {
				$na = $ba;
			} else if ($anggota >15) {
				$na = 50/100 * $ba;
			} else if ($anggota <= 15){
				$na = 1;
			}else if ($anggota <= 5){
				$na = 0;
			}
			
			
			$pointkamp  	= $this->db->query("select count(tingkat) as kampus from prestasi where tingkat = 'kampus' 
			and id_ukm =".$id_ukm ."")->result_array();
			$pointdaerah  	= $this->db->query("select count(tingkat) as daerah  from prestasi where tingkat = 'daerah'
			and id_ukm =".$id_ukm ."")->result_array();
			$pointnasio  	= $this->db->query("select count(tingkat) as nasional from prestasi where tingkat = 'nasional'
			and id_ukm =".$id_ukm ."")->result_array();
			
			$pointkampus 	= $pointkamp[0]['kampus'];
			$pointdaerah 	= $pointdaerah[0]['daerah'];
			$pointnasional 	= $pointnasio[0]['nasional'];
			
			if($pointkampus == 1){
				$kampus = 1;
			}
			else if($pointkampus == 2){
				$kampus = 2;
			}
			else if($pointkampus == 3){
				$kampus = 3;
			}
			else if($pointkampus == 4){
				$kampus = 4;
			}
			else if($pointkampus == 5){
				$kampus = 5;
			}
			else if($pointkampus > 5){
				$kampus = 5;
			}
			else {
				$kampus = 0;
			}
			
			
			if($pointdaerah == 1){
				$daerah = 5;
			}
			else if($pointdaerah == 2){
				$daerah = 10;
			}
			else if($pointdaerah > 2){
				$daerah = 10;
			}
			else {
				$daerah = 0;
			}
			
			if($pointnasional == 1){
				$nasional = 10;
			}
			else if($pointnasional == 2){
				$nasional = 20;
			}
			else if($pointnasional > 2){
				$nasional = 20;
			}
			else {
				$nasional= 0;
			}
			
			$total = $kampus + $daerah + $nasional;
			//penentuan points elektabilitas//
			$nilai_elektabilitas	= $hitung+$na+$total;
			
			$data3 = array(
				'periode'	=> date('Y-m-d'),
				'point'		=> $nilai_elektabilitas,
				'id_ukm'	=> $id_ukm,
			);
			
			$lihat	= $this->db->query("select * from elektabilitas where id_ukm = ".$id_ukm."");
			$num = $lihat->num_rows();
			if($num>0){
				$hasil = $this->M_kemahasiswaan->updatedata('elektabilitas',$data3, array('id_ukm' => $id_ukm));
			}
			else {
				$hasil = $this->M_kemahasiswaan->simpandata('elektabilitas',$data3);
			}
			redirect("kemahasiswaan/tabel_lpj");
		}
		else {
			echo "Tidak Ada Halaman Tersedia";
		}
	}
	
	function setting(){
		
		$sesinya		= $this->session->userdata('login');
		$ambil_user= $this->M_kemahasiswaan->getuser('where level = "kemahasiswaan" ')->result_array();
		$tahun			=  $this->db->query('select distinct(year(tanggal_mulai)) as periode from proposal')->result_array();
		$data = array(
			'title'				=> 'Setting Profil',
			'kode'			=> $ambil_user[0]['id'],
			'nama'			=> $sesinya['nama_lengkap'],
			'namalengkap'=> $ambil_user[0]['nama_lengkap'],
			'username'	=> $ambil_user[0]['username'],
			'password'	=> $ambil_user[0]['password'],
			'foto'			=> $ambil_user[0]['foto'],
			'tahun'			=> $tahun,
		);
		
		$this->load->view('kemahasiswaan/head',$data);
		$this->load->view('kemahasiswaan/setting');
		$this->load->view('kemahasiswaan/footer');
	}
	
	function save_setting(){
		if($_POST){
			
			$kode		 	= $this->input->post('kode');
			$nama 		= $this->input->post('nama');
			$username	= $this->input->post('username');
			$periode		= $this->input->post('periode');
			$password	= $this->encrypt->sha1($this->input->post('password'));
			
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
					'username'			=> $username,
					'password'			=> $password,
					'foto'					=> $product_image,
				);
			
			$data2 = array(
					'tahun_periode'	=> $periode,
			);
			
			$hasil = $this->M_kemahasiswaan->updatedata('users',$data,array('id' => $kode));
			
			$lihat	= $this->db->query("select * from periode ");
			$num = $lihat->num_rows();
				if($num>0){
					$hasil = $this->M_kemahasiswaan->updatedata('periode',$data2, array('tahun_periode' => $periode));
				}
				else {
					$hasil = $this->M_kemahasiswaan->simpandata('periode',$data2);
				}
				
				redirect("kemahasiswaan/setting");
			
			} 
		else {
			echo "HALAMAN TIDAK ADA 404";
		}
	}
	
	function alur_berkas(){
		
		$sesinya	= $this->session->userdata('login');
		$ambil_user = $this->M_kemahasiswaan->getuser('where level = "kemahasiswaan" ')->result_array();
		
		$alur			= $this->db->query("SELECT a.judul_kegiatan, b.judul, b.berkas b_prp, c.nama_lpj, c.berkas b_lpj, d.nama
						FROM kegiatan a, proposal b, lpj c, ukm d WHERE a.id_ukm = b.id_ukm AND a.id_kegiatan = b.id_kegiatan
						AND b.id_proposal = c.id_proposal order by d.nama")->result_array();

		
		$data	= array(
			'title'		=> 'Alur Berkas UKM',
			'kode'  	=> $ambil_user[0]['id'],
			'nama'	=> $sesinya['nama_lengkap'],
			'foto'		=> $ambil_user[0]['foto'],
			'level'		=> $ambil_user[0]['level'],
			'alur'		=> $alur,
		);
		$this->load->view('kemahasiswaan/head',$data);
		$this->load->view('kemahasiswaan/alur_berkas');
		$this->load->view('kemahasiswaan/footer');
		
	}
		
	function grafik(){
		
		$sesinya			= $this->session->userdata('login');
		$ambil_user 	= $this->M_kemahasiswaan->getuser('where level = "kemahasiswaan" ')->result_array();
		
		$graph1			= $this->M_kemahasiswaan->creategraph();
		
		
		$data	= array(
			'title'		=> 'Grafik Elektabilitas UKM',
			'kode'  	=> $ambil_user[0]['id'],
			'nama'		=> $sesinya['nama_lengkap'],
			'foto'		=> $ambil_user[0]['foto'],
			'level'		=> $ambil_user[0]['level'],
			'graph'		=> $graph1,
		);
		$this->load->view('kemahasiswaan/head',$data);
		$this->load->view('kemahasiswaan/grafik');
		$this->load->view('kemahasiswaan/footer');
		
	}
	
	function lpj_lama(){
		$ambil_user = $this->M_kemahasiswaan->getuser('where level = "kemahasiswaan"')->result_array();
		$sesinya		= $this->session->userdata('login');
		$period		= $this->db->query('select * from periode')->result_array();
		$lpj				= $this->db->query("select year(tanggal) as tahun,lpj.id_lpj,lpj.nama_lpj,lpj.berkas,lpj.status,ukm.id_ukm,ukm.nama from  lpj,ukm where lpj.id_ukm = ukm.id_ukm and lpj.status = 'diterima' and lpj.status_penilaian = 'dinilai' and year(tanggal) = ".$period[0]['tahun_periode']."")->result_array();
		
		$data		= array(
				'title' 	=> 'Selamat Datang Kemahasiswaan',
				'nama'		=> $sesinya ['nama_lengkap'],
				'foto'		=> $ambil_user [0] ['foto'],
				'lpj'		=> $lpj,
				
		);
		$this->load->view('kemahasiswaan/head',$data);
		$this->load->view('kemahasiswaan/lpj_lama');
		$this->load->view('kemahasiswaan/footer');
	}

	function print_lpjlama(){
		$lpjlama	= $this->db->query("select lpj.id_lpj,lpj.nama_lpj,lpj.berkas,lpj.status,ukm.id_ukm,ukm.nama from  lpj,ukm 
				where lpj.id_ukm = ukm.id_ukm and lpj.status = 'diterima'")->result_array();

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
		$this->fpdf->Cell(26,1,'DAFTAR LPJ UKM DITERIMA PERIODE 2013',0,0,'C');
		

		/* Fungsi Line untuk membuat garis */
		$this->fpdf->Line(1,3.5,29,3.5);


		/* setting header table */
		$this->fpdf->Ln(1);
		$this->fpdf->SetFont('Times','B',12);
		$this->fpdf->Cell(2  , 1, 'No.'           , 1, 'LR', 'L');
		$this->fpdf->Cell(7 , 1, 'JUDUL LPJ' , 1, 'LR', 'L');
		$this->fpdf->Cell(8 , 1, 'UKM' , 1, 'LR', 'L');
		$this->fpdf->Cell(11 , 1, 'BERKAS' , 1, 'LR', 'L');
		
		$no = 1;
		foreach($lpjlama as $a){
			
			if($a['nama'] == $a['nama']){
				$this->fpdf->Ln();
		    $this->fpdf->SetFont('Times','',12);
			$this->fpdf->Cell(2,0.7,$no++,1,'LR','L');
			$this->fpdf->Cell(7,0.7,$a['nama_lpj'],1,'LR','L');
			$this->fpdf->Cell(8,0.7,$a['nama'],1,'LR','L');
			$this->fpdf->Cell(11,0.7,$a['berkas'],1,'LR','L');
			}
		}
			
		
		$this->fpdf->SetY(-3);

		/* setting font untuk footer */
		$this->fpdf->SetFont('Times','',10);
		/* setting cell untuk page number */
		$this->fpdf->Cell(9.5, 0.5, 'Halaman '.$this->fpdf->PageNo().'/{nb}',0,0,'L');

		/* generate pdf jika semua konstruktor, data yang akan ditampilkan, dll sudah selesai */
		$this->fpdf->Output("data_lpj_UKM.pdf","I");
	}
	
	function laporan_berkas(){
		
		$alur			= $this->db->query("SELECT a.judul_kegiatan, b.judul, b.berkas b_prp, c.nama_lpj, c.berkas b_lpj, d.nama
							FROM kegiatan a, proposal b, lpj c, ukm d
							WHERE a.id_ukm = b.id_ukm
							AND a.id_kegiatan = b.id_kegiatan
							AND b.id_proposal = c.id_proposal")->result_array();
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
		$this->fpdf->Cell(26,1,'LAPORAN ALUR BERKAS UKM PERIODE 2013',0,0,'C');
		

		/* Fungsi Line untuk membuat garis */
		$this->fpdf->Line(1,3.5,29,3.5);


		/* setting header table */
		$this->fpdf->Ln(1);
		$this->fpdf->SetFont('Times','B',12);
		$this->fpdf->Cell(2  , 1, 'No.'           , 1, 'LR', 'L');
		$this->fpdf->Cell(4 , 1, 'NAMA UKM' , 1, 'LR', 'L');
		$this->fpdf->Cell(7 , 1, 'NAMA KEGIATAN' , 1, 'LR', 'L');
		$this->fpdf->Cell(7 , 1, 'JUDUL PROPOSAL' , 1, 'LR', 'L');
		$this->fpdf->Cell(7 , 1, 'JUDUL LPJ' , 1, 'LR', 'L');
		
		$no = 1;
		foreach($alur as $a){
			
			if($a['nama'] == $a['nama']){
				$this->fpdf->Ln();
		    $this->fpdf->SetFont('Times','',12);
			$this->fpdf->Cell(2,0.7,$no++,1,'LR','L');
			$this->fpdf->Cell(4,0.7,$a['nama'],1,'LR','L');
			$this->fpdf->Cell(7,0.7,$a['judul_kegiatan'],1,'LR','L');
			$this->fpdf->Cell(7,0.7,$a['judul'],1,'LR','L');
			$this->fpdf->Cell(7,0.7,$a['nama_lpj'],1,'LR','L');
			}
		}
			
		
		$this->fpdf->SetY(-3);

		/* setting font untuk footer */
		$this->fpdf->SetFont('Times','',10);
		/* setting cell untuk page number */
		$this->fpdf->Cell(9.5, 0.5, 'Halaman '.$this->fpdf->PageNo().'/{nb}',0,0,'L');

		/* generate pdf jika semua konstruktor, data yang akan ditampilkan, dll sudah selesai */
		$this->fpdf->Output("data_alur_UKM.pdf","I");
	}
	
}