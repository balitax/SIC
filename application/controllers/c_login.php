<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_login extends CI_Controller{
	
	function __construct() {
		parent::__construct();
		$this->load->model('M_login');
	}
	
	function index(){
		$data = array(
			'title'	=> '.:: Silahkan Login ::.',
		);
		$this->load->view('login',$data);
	}
	
	function auth(){
		if($_POST){
			
		$this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|xss_clean');
   
   			if($this->form_validation->run() == FALSE){
				redirect('');
			}
			
			$username	= $this->input->post('username');
			$password	= $this->encrypt->sha1($this->input->post('password'));
			$level		= $this->input->post('level');
			
			$temp		= $this->M_login->login("where username = '$username' and password = '$password' 
							and level = '$level' and aktif = 'Y'")->result_array();
			
			if($temp != NULL){
				$data = array(
					'id'					=> $temp[0]['id'],
					'nama_lengkap'			=> $temp[0]['nama_lengkap'],
					'username'				=> $temp[0]['username'],
					'password'				=> $temp[0]['password'],
					'level'					=> $temp[0]['level'],
				);
				$this->session->set_userdata('login',$data);
				if($data["level"] == "admin"){
					redirect("admin/dashboard");
				}
				elseif($data["level"] == "kemahasiswaan"){
					redirect("kemahasiswaan/dashboard");
				}
				elseif($data["level"] == "ukm"){
					
					$periode = $this->db->query("select * from mod_periode")->result_array();
		
						if($periode[0]['periode_set'] == 'ditutup'){
							redirect("ukm/point_akhir");
						}
						else {
							redirect("ukm/dashboard");
						}
					
					//
				}
				else {
					echo "EROR! 404";
				}
				
			}
			else {
				redirect("");
			}
		}
		else {
			redirect("");
		}
	}
	
}