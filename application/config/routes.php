<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
//registrasi route
// $route['default_controller'] = 'error_ctr';
//dev
// $route['dev'] = 'welcome';

//ditutup karena sudah berakhir
// $route['registrasi'] = 'welcome/registrasi';
// $route['registrasi_d3'] = 'welcome/registrasid3';
// $route['registrasi_eks'] = 'welcome/registrasieks';
// $route['registrasi2'] = 'welcome/registrasi2';

//reg_fastrack
// $route['registrasi_fasttrack'] = 'welcome/registrasi_fasttrack';
// $route['registrasi_d3_fasttrack'] = 'welcome/registrasid3_fasttrack';
// $route['registrasi_eks_fasttrack'] = 'welcome/registrasieks_fasttrack';

//reg_disc
// $route['registrasi_disc'] = 'welcome/registrasi_disc';

//reg_rpl
// $route['registrasi_khusus'] = 'welcome/registrasi_rpl';

//referral page
// $route['referral'] = 'referral';
// $route['referral_access'] = 'referral/login';
// $route['referral_home'] = 'referral/home';

//camahatar
$route['masuk'] = 'camhtar';
$route['keluar'] = 'camhtar/logout';
$route['proses_masuk'] = 'camhtar/loginp';
$route['daftar'] = 'camhtar/daftar';
$route['pendaftaran'] = 'camhtar/daftarp';
$route['cek'] = 'camhtar/cek_user';
$route['biodata'] = 'camhtar/biodata';
$route['proses_biodata'] = 'camhtar/insertReg';
$route['pembayaran'] = 'camhtar/pembayaran';
$route['validasi'] = 'camhtar/validasi';
$route['proses_bukti_bayar'] = 'camhtar/upload_bukti_bayar';
$route['seleksi_geldini_reguler'] = 'camhtar/seleksigdr1';
$route['seleksi_geldini_tf'] = 'camhtar/seleksigdr2';
$route['proses_seleksi_gdtf'] = 'camhtar/seleksigdr2p';
$route['download_suket'] = 'camhtar/down_suket';
$route['download_supersehat'] = 'camhtar/down_supersehat';
$route['download_supersehatreg'] = 'camhtar/down_supersehatreg';
$route['proses_seleksi_gelombangdini_reguler'] = 'camhtar/proses_seleksi_gdr1';
$route['getDataGelombangDiniReguler/(:num)'] = 'camhtar/getdataeditseleksigdr1/$1';
$route['proses_seleksi_gelombangdini_reguler_edit'] = 'camhtar/proses_seleksi_edit_gdr1';
$route['ukurpakaian'] = 'camhtar/ukurpakaian';
$route['prosesukurpakaian'] = 'camhtar/proses_ukurpakaian';
$route['download_tutorial_form_seleksi_gelombang_dini'] = 'camhtar/down_tutorial_form_seleksi_gelombang_dini';
$route['download_panduan_pengisian_form_ukur_pakaian'] = 'camhtar/down_panduan_pengisian_form_ukur_pakaian';
$route['pengumuman_gelombangdini'] = 'camhtar/pengumuman_gd';
$route['download_pengumuman_gelombangdini'] = 'camhtar/down_pengumuman_gd';

$route['seleksi_reguler'] = 'camhtar/seleksigdr1';
$route['seleksi_tf'] = 'camhtar/seleksigdr2';
$route['download_super_asrama'] = 'camhtar/down_super_asrama';
$route['download_super_taat'] = 'camhtar/down_super_taat';
$route['download_super_tidak_menikah'] = 'camhtar/down_super_tidak_menikah';
$route['daftarulang'] = 'camhtar/daful';
$route['proses_bukti_bayar_daful'] = 'camhtar/upload_bukti_bayar_daful';



// $route['cetakRegistrasi'] = 'welcome/insertReg';
// $route['cetakRegistrasi2'] = 'welcome/insertReg2';
// $route['cekstatus'] = 'welcome/cekstatus';
$route['biaya_download'] = 'welcome/biaya_download';
$route['tutorial_download'] = 'welcome/tutorial_download';
// $route['apk_download'] = 'welcome/apk_download';
// $route['cekstatusp'] = 'welcome/cekstatusp';
// $route['cekstatusp/(:num)'] = 'welcome/cekstatusp/$1';
$route['download/(:num)'] = 'camhtar/download/$1';
// $route['voucher/(:num)'] = 'welcome/voucher/$1';

$route['getkabkota'] = 'camhtar/get_kabkota';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
