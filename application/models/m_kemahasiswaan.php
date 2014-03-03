<?php
class M_kemahasiswaan extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	function ambiluser(){
		return $this->db->query("select * from users");
	}
	
	function getuser($where = ''){
		return $this->db->query("select * from users $where;");
	}
	
	function updatedata($tabel,$data,$where){
		return $this->db->update($tabel,$data,$where);
	}
	
	function simpandata($tabel,$data){
		return $this->db->insert($tabel,$data);
	}
	
	function creategraph(){
	$this->load->library('graph');
	$data['nama'] = $this->db->query("select * from ukm order by id_ukm")->result_array();
        foreach($data['nama'] as $j)
        {
            $nama[] = $j['nama'];
        }
	$elektabilitas['point'] = $this->db->query("select * from elektabilitas order by id_ukm")->result_array();
     foreach($elektabilitas['point'] as $p)
        {
            $data_1[] = $p['point'];
        }
	
    $ff = new graph();
    $ff->set_data( $data_1 );
	$ff->title("Elektabilitas UKM Kampus Berdasarkan Data Kuantitatif Kemahasiswaan",'{font-size: 18px; color: #800000}');
	$ff->bar_glass( 55, '#FF9900', '#C31812', 'Tingkat Perbandingan Polling', 11  );
	$ff->line_hollow( 3, 5, '#79B900', 'Grafik Polling', 11 );
	$ff->set_x_labels($nama);
	$ff->set_tool_tip( '#x_label# : #val#');
	$ff->set_x_label_style( 10, '0×°00000', 0 );
	$ff->set_y_max( 100 );
	$ff->set_x_label_style( 10, '0×000000', 0 );
	$ff->set_y_max( 100 );
	$ff->width=800;
	$ff->height=400;
	$ff->y_label_steps( 10 );
	$ff->bg_colour='#ffffff';
	$ff->set_x_legend( 'Nama UKM', 14, '#736AFF' );
	$ff->set_y_legend( 'Points Elektabilitas', 14, '#736AFF' );
	$ff->set_output_type("js");
    return $ff->render();
		
	}
		
}
?>