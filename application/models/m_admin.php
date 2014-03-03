<?php
class M_admin extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	function ambiluser(){
		return $this->db->query("select * from users");
	}
	
	
	function ambilpoints(){
		return $this->db->query("select * from points");
	}
	
	function getuser($where = ''){
		return $this->db->query("select * from users $where;");
	}
	
	function masukandata($tabel, $data){
		return $this->db->insert($tabel,$data);
	}
	
	function hapusdata($tabel,$where){
		return $this->db->delete($tabel,$where);
	}
	
	function updatedata($tabel,$data,$where){
		return $this->db->update($tabel,$data,$where);
	}
	
	function updatepoints($tabel,$data){
		return $this->db->update($tabel,$data);
	}
	
	function update_setperiode($tabel,$data){
		return $this->db->update($tabel,$data);
	}
}
?>