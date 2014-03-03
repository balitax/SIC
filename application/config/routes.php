<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] 	= "c_home";
$route['404_override'] 		= '';
$route['login'] 						= 'c_login';
$route['login/auth'] 				= 'c_login/auth';

// Route Untuk Halaman Administrator
$route['admin/dashboard'] 			= 'c_admin';
$route['admin/users'] 					= 'c_admin/users';
$route['admin/users/new'] 			= 'c_admin/add_user';
$route['admin/users/edit/(:any)']	= 'c_admin/editsuer/$1';
$route['admin/users/save'] 		= 'c_admin/saveuser';
$route['admin/users/saveedit'] 	= 'c_admin/updateuser';
$route['admin/users/del/(:any)'] 	= 'c_admin/hapususer/$1';
$route['admin/logout'] 				= 'c_admin/logout';
$route['admin/setting']				= 'c_admin/setting';
$route['admin/setting/save']		= 'c_admin/save_setting';
$route['admin/points/tambah_p1']= 'c_admin/tambah_points1';
$route['admin/points/tambah_p2']= 'c_admin/tambah_points2';
$route['admin/points/tambah_p3']= 'c_admin/tambah_points3';
$route['admin/points/tambah_p4']= 'c_admin/tambah_points4';
$route['admin/points/tambah_p5']= 'c_admin/tambah_points5';
$route['admin/points'] 				= 'c_admin/pointsetting';
$route['admin/points/save']			= 'c_admin/save_point';
$route['admin/bobot']					= 'c_admin/bobot';
$route['admin/updatebobot']		= 'c_admin/updatebobot';
$route['admin/updatebobotlpj']	= 'c_admin/updatebblpj';
$route['admin/telat']					= 'c_admin/telat';
$route['admin/periode']				= 'c_admin/set_periode';
$route['admin/periode/save']		= 'c_admin/save_setperiode';

// Route Untuk Halaman Kemahasiswaan
$route['kemahasiswaan/dashboard']					= 'c_kemahasiswaan/index';
$route['kemahasiswaan/logout'] 						= 'c_kemahasiswaan/logout';
$route['kemahasiswaan/setting']						= 'c_kemahasiswaan/setting';
$route['kemahasiswaan/setting/save']				= 'c_kemahasiswaan/save_setting';
$route['kemahasiswaan/verifikasi_proposal'] 	= 'c_kemahasiswaan/verifikasi_proposal';
$route['kemahasiswaan/v_proposal/edit/(:any)']= 'c_kemahasiswaan/v_proposal_edit/$1';
$route['kemahasiswaan/v_proposal/save']		= 'c_kemahasiswaan/aksi_v_proposal';
$route['kemahasiswaan/proposal/lama']		 	= 'c_kemahasiswaan/propo_lama';
$route['kemahasiswaan/lpj/lama']		 				= 'c_kemahasiswaan/lpj_lama';
$route['kemahasiswaan/verifikasi_lpj']		 		= 'c_kemahasiswaan/verifikasi_lpj';
$route['kemahasiswaan/v_lpj/edit/(:any)']			= 'c_kemahasiswaan/v_lpj_edit/$1';
$route['kemahasiswaan/v_lpj/save']					= 'c_kemahasiswaan/v_lpj_simpan';
$route['kemahasiswaan/tabel_lpj']						= 'c_kemahasiswaan/tabel_lpj';
$route['kemahasiswaan/v_lpj/nilai']					= 'c_kemahasiswaan/v_lpj_nilai';
$route['kemahasiswaan/penilaian_lpj/(:any)']		= 'c_kemahasiswaan/penilaian_lpj/$1';
$route['kemahasiswaan/alur/berkasukm']			= 'c_kemahasiswaan/alur_berkas';
$route['kemahasiswaan/grafik']							= 'c_kemahasiswaan/grafik';
$route['kemahasiswaan/penilaian_elektabilitas']= 'c_kemahasiswaan/elektabilitas';
$route['kemahasiswaan/grafik']					    	= 'c_kemahasiswaan/grafik';
$route['kemahasiswaan/aksi_elektabilitas/(:any)']= 'c_kemahasiswaan/aksi_elektabilitas/$1';
$route['kemahasiswaan/simpan_elektabilitas']	= 'c_kemahasiswaan/simpan_elektabilitas';
$route['kemahasiswaan/laporan_print']				= 'c_kemahasiswaan/laporan_berkas';
$route['kemahasiswaan/print_proposal_lama']	= 'c_kemahasiswaan/print_propolama';
$route['kemahasiswaan/print_lpj_lama']			= 'c_kemahasiswaan/print_lpjlama';

// Route Untuk Halaman UKM
$route['ukm/dashboard'] 			= 'c_ukm/index';
$route['ukm/logout'] 					= 'c_ukm/logout';
$route['ukm/setting'] 					= 'c_ukm/setting';
$route['ukm/setting/save'] 			= 'c_ukm/save_setting';
$route['ukm/proposal']				= 'c_ukm/proposal';
$route['ukm/proposal/save']		= 'c_ukm/tambah_pro';
$route['ukm/proposal/tambah']	= 'c_ukm/tambah_proposal';
$route['ukm/proposal/del/(:any)'] = 'c_ukm/hapuspro/$1';
$route['ukm/proposal/edit/(:any)']= 'c_ukm/editpro/$1';
$route['ukm/proposal/print']= 'c_ukm/prin_proposal';
$route['ukm/lpj'] 							= 'c_ukm/lpj';
$route['ukm/lpj/save'] 					= 'c_ukm/lpj_save';
$route['ukm/lpj/add'] 					= 'c_ukm/lpj_add';
$route['ukm/lpj/edit/(:any)'] 			= 'c_ukm/lpj_edit/$1';
$route['ukm/lpj/del/(:any)'] 			= 'c_ukm/lpj_del/$1';
$route['ukm/lpj/print'] 					= 'c_ukm/lpj_print';
$route['ukm/kegiatan'] 				= 'c_ukm/kegiatan';
$route['ukm/kegiatan/add'] 			= 'c_ukm/kegiatan_add';
$route['ukm/kegiatan/edit/(:any)']= 'c_ukm/kegiatan_edit/$1';
$route['ukm/kegiatan/save']		= 'c_ukm/kegiatan_save';
$route['ukm/kegiatan/del/(:any)']	= 'c_ukm/kegiatan_del/$1';
$route['ukm/kegiatan/print']			= 'c_ukm/kegiatan_print';
$route['ukm/struktur'] 					= 'c_ukm/struktur';
$route['ukm/struktur/save'] 		= 'c_ukm/struktur_save';
$route['ukm/prestasi'] 				= 'c_ukm/prestasi';
$route['ukm/prestasi/add'] 			= 'c_ukm/prestasi_add';
$route['ukm/prestasi/edit/(:any)'] = 'c_ukm/prestasi_edit/$1';
$route['ukm/prestasi/del/(:any)'] = 'c_ukm/prestasi_delete/$1';
$route['ukm/prestasi/save'] 		= 'c_ukm/prestasi_save';
$route['ukm/prestasi/print'] 		= 'c_ukm/prestasi_print';
$route['ukm/anggota'] 				= 'c_ukm/anggota';
$route['ukm/anggota/add'] 			= 'c_ukm/anggota_add';
$route['ukm/anggota/edit/(:any)'] = 'c_ukm/anggota_edit/$1';
$route['ukm/anggota/save'] 		= 'c_ukm/anggota_save';
$route['ukm/salah']			 			= 'c_ukm/salah_lpj';
$route['ukm/alur/berkas']			= 'c_ukm/alur_berkas';
$route['ukm/alur/berkas/print']	= 'c_ukm/alurberkas_print';
$route['ukm/nilaimu']			 	   	= 'c_ukm/nilaimu';
$route['ukm/grafik_ukm']			= 'c_ukm/grafik_ukm';
$route['ukm/point_akhir']				= 'c_ukm/nilai_akhir_ukm';

/* End of file routes.php */
/* Location: ./application/config/routes.php */