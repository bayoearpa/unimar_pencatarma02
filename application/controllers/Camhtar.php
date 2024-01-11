<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Camhtar extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_registrasi');
		$this->load->helper('url');
		$this->load->helper('captcha');
		$this->load->helper('download');
		$this->load->helper('judul_seo');
		$this->load->library('m_pdf');
	}

	public function index()
	{
		$this->load->view('camahatar/login');
	}
	 function logout(){
		$this->session->sess_destroy();
		redirect(base_url().'masuk?pesan=logout');
	}
	public function loginp()
	{
		# code...
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$this->form_validation->set_rules('username','Username','trim|required');
		$this->form_validation->set_rules('password','Password','trim|required');
		if($this->form_validation->run() != false){
			$where = array(
				'username' => $username,
				'password' => md5($password)			
			);
			$data = $this->m_registrasi->get_data($where, 'tbl_catar_2024');
			$d = $this->m_registrasi->get_data($where, 'tbl_catar_2024')->row();
			$cek = $data->num_rows();
			if($cek > 0){
				$session = array(
					'username'=> $d->username,
					'no'=> $d->no,
					'nama'=> $d->nama,
					'jalur'=> $d->jalur,
					'status' => 'login'
				);
				$this->session->set_userdata($session);
				redirect(base_url().'biodata');
			}else{
				redirect(base_url().'masuk?pesan=gagal');			
			}
		}else{
			redirect(base_url().'masuk');
		}
	}
	public function daftar()
	{
		$this->load->view('camahatar/daftar');
		$this->load->view('camahatar/daftar_js');
	}
	public function cek_user()
	{
		# code...
		if ($this->input->post('username')) {
            $username = $this->input->post('username');
            $is_available = $this->m_registrasi->cek_user($username);

            if ($is_available) {
                echo "available"; // Username tersedia
            } else {
                echo "unavailable"; // Username sudah digunakan
            }
        }
	}
	public function daftarp()
	{
		if ($this->input->post()) {
            $nama = $this->input->post('nama');
            $username = $this->input->post('username');
            $password = md5($this->input->post('password'));
            $jalur = $this->input->post('jalur');

            // Lakukan validasi data yang diterima jika diperlukan

            // Simpan data pendaftaran ke dalam tabel "tbl_catar_2024"
            $data = array(
                'nama' => $nama,
                'username' => $username,
                'password' => $password,
                'jalur' => $jalur
                // Tambahkan kolom lain sesuai dengan struktur tabel
            );

            $insert_result = $this->m_registrasi->input_data($data,'tbl_catar_2024');

            if ($insert_result) {
               echo "error";
            } else {
                 echo "success";
            }
        }
	}
	public function informasi($id)
	{
		# code...
		switch ($id) {

				// registrasi
					case '1':
						$pick = "Senior / Kakak kelas";
					break;
					case '2' :
						$pick = "Sosial Media";
					break;
					case '3' :
						$pick = "Keluarga / Saudara / teman";
					break;
					case '4' :
						$pick = "Alumni";
					break;
					case '5':
						$pick = "Brosur";
					break;
					case '6':
						$pick = "Expo";
					break;
					case '7':
						$pick = "Sekolah / Guru";
					break;
					
				}
				return $pick;
	}
	public function getGelombang($id)
	{
		# code...
		# code...
		//get nama
		$where = array(
			'id_gelombang' => $id,			       
        );
		$getP = $this->m_registrasi->get_data($where,'tbl_gelombang')->result();
		foreach ($getP as $p) {
			# code...
			//$data['nama'] = $n->Nama_mahasiswa ;
			return $p->gelombang;
		}
	}
	public function getProvinsi($id)
	{
		# code...
		# code...
		//get nama
		$where = array(
			'id_wil' => $id,			       
        );
		$getP = $this->m_registrasi->get_data($where,'tbl_propinsi')->result();
		foreach ($getP as $p) {
			# code...
			//$data['nama'] = $n->Nama_mahasiswa ;
			return $p->nm_wil;
		}
	}
	public function getKotaKab($id)
	{
		# code...
		# code...
		//get nama
		$where = array(
			'id_wil' => $id,			       
        );
		$getP = $this->m_registrasi->get_data($where,'tbl_kabkota')->result();
		foreach ($getP as $p) {
			# code...
			//$data['nama'] = $n->Nama_mahasiswa ;
			return $p->nm_wil;
		}
	}
	public function getProdi($prodi)
	{
		# code...
		//get nama
		$where = array(
			'id_prodi' => $prodi,			       
        );
		$getP = $this->m_registrasi->get_data($where,'tbl_prodi')->result();
		foreach ($getP as $p) {
			# code...
			//$data['nama'] = $n->Nama_mahasiswa ;
			return $p->prodi;
		}
	}
	public function biodata()
	{
		# code...
		$data['jurusan'] = $this->m_registrasi->get_data_all('tbl_jurusan')->result();
		$data['provinsi'] = $this->m_registrasi->get_data_all('tbl_propinsi')->result();

		$no = $this->session->userdata('no');
		$where = array(
				'no' => $no,
			);
		$data['catar'] = $this->m_registrasi->get_data($where, 'tbl_catar_2024')->result();

		foreach ($data['catar'] as $key) {
			# code...
			$data['getprovinsi'] = $this->getProvinsi($key->provinsi);
			$data['getktkb'] = $this->getKotaKab($key->ktkb);
			$data['informasi'] = $this->informasi($key->informasi);
			$data['nmprodi'] = $this->getProdi($key->prodi);
			$data['nmprodi2'] = $this->getProdi($key->prodi2);
			$data['gel'] = $this->getGelombang("1");
		}

		$this->load->view('camahatar/header',$data);
        $this->load->view('camahatar/biodata',$data);
        $this->load->view('camahatar/footer');
        $this->load->view('camahatar/biodata_js');

	}
	public function get_kabkota(){
        $id=$this->input->post('id');
        $data=$this->m_registrasi->get_kabkota($id);
        echo json_encode($data);
    }
	 public function getTglSelAktif(){
	    $whereta = array(
			'aktif' => '1'		
		);
		$ta = $this->m_registrasi->get_data($whereta,'tbl_tgl_seleksi')->result();
			foreach ($ta as $t) {
			# code...
			//$data['nama'] = $n->Nama_mahasiswa ;
			return $t->id_tgl_seleksi;
		}
	}
	public function insertReg()
	{
		# code...
		$nama = $this->input->post('nama');
		$nik = $this->input->post('nik');
		$namafil = addslashes($nama);
		$tl = $this->input->post('tl');
		$tgl_l = $this->input->post('tgl_l');
		$agama = $this->input->post('agama');
		$jk = $this->input->post('jk');
		$bb = $this->input->post('bb');
		$tb = $this->input->post('tb');
		$email = $this->input->post('email');
		$alamat = $this->input->post('alamat');
		$ktkb = $this->input->post('ktkb');
		$provinsi = $this->input->post('provinsi');
		$telp = $this->input->post('telp');
		$kategori_sek = $this->input->post('kategori_sek');
		$prodi_lama = $this->input->post('prodi_lama');
		$thn_lulus = $this->input->post('thn_lulus');
		$asek = $this->input->post('asek');
		$alamat_sek = $this->input->post('alamat_sek');
		$nama_a = $this->input->post('nama_a');
		$nama_afill = addslashes($nama_a);
		$nama_i = $this->input->post('nama_i');
		$nama_ifill = addslashes($nama_i);
		$alamat_ortu = $this->input->post('alamat_ortu');
		$telp_ortu = $this->input->post('telp_ortu');
		$informasi = $this->input->post('informasi');
		$prodi = $this->input->post('prodi');
		$prodi2 = $this->input->post('prodi2');
		$gelombang = $this->input->post('gelombang');
		$jalur = $this->input->post('jalur');
		$ref_radio = $this->input->post('ref_radio');
		$ref = $this->input->post('ref');
		$thn_pel="2024";
		$periode=date('n');
 		$id_tgl_seleksi = $this->getTglSelAktif();
		
		
		// $namagabungan1 = judul_seo("ijasah".$nama." ".$prodi." ".$tgl_l);
		// $namagabungan2 = judul_seo("sk".$nama." ".$prodi." ".$tgl_l);
		// $nmfile1 = $namagabungan1.".pdf";
		// $nmfile2 = $namagabungan2.".pdf";
        #upload file1
  //       $config['upload_path'] = FCPATH.'assets/upload';
		// $config['allowed_types'] = 'pdf';
		// $config['max_size']  = '5024';
		// $config['max_width']  = '1024';
		// $config['max_height']  = '768';

     //    if($_FILES["ijasah"]["name"]){
     //    $config["file_name"] = $nmfile1;
     //    $this->load->library('upload', $config);
     //    $abstrak = $this->upload->do_upload('ijasah');
     //    if (!$abstrak){
     //        $error = array('error' => $this->upload->display_errors());
     //        // $this->session->set_flashdata("error", ".");
     //    }else{
     //        $abstrak = $this->upload->data("file_name");
     //        $data = array('upload_data' => $this->upload->data());
     //        // $this->session->set_flashdata("success", ".");
     //    	}
        	
    	// }

    	// if($_FILES["sk"]["name"]){
        // $config["file_name"] = $nmfile2;
        // $this->upload->initialize($config);// untuk upload set nama file kedua
        // $biaya = $this->upload->do_upload('sk');
        // if (!$biaya){
        //     $error = array('error' => $this->upload->display_errors());
        //     // $this->session->set_flashdata("error", ".");
        // }else{
        //     $biaya = $this->upload->data("file_name");
        //     $data = array('upload_data' => $this->upload->data());
        //     // $this->session->set_flashdata("success", ".");
        // 	}
    	// }

 		
 			//////////////// proses biasa//////////////////////////////////////
 				$where = array(
					'no' => $this->session->userdata('no')		
				);
				$data = array(
					'nama' => $namafil,
					'nik' => $nik,
					'tl' => $tl,
					'tgl_l' => $tgl_l,
					'agama' => $agama,
					'jk' => $jk,
					'alamat'=> $alamat,
					'ktkb' => $ktkb,
					'provinsi' => $provinsi,
					'telp' => $telp,
					'kategori_sek' => $kategori_sek,
					'prodi_lama' => $prodi_lama,
					'thn_lulus' => $thn_lulus,
					'asek' => $asek,
					'alamat_sek' => $alamat_sek,
					'nama_a' => $nama_afill,
					'nama_i' => $nama_ifill,
					'alamat_ortu' => $alamat_ortu,
					'telp_ortu' => $telp_ortu,
					'informasi' => $informasi,
					'prodi' => $prodi,
					'gelombang' => $gelombang,
					'periode' => $periode,
					// 'ijasah' => $nmfile1,
					// 'sk' => $nmfile2,
					'thn_pel' => $thn_pel,
					'bb' => $bb,
					'tb' => $tb,
					'email' => $email,
					'prodi2' => $prodi2,
					'jalur' => $jalur,
					'id_tgl_seleksi' => $id_tgl_seleksi
					);
				
				
				$proses_insert = $this->m_registrasi->update_data($where,$data,'tbl_catar_2024');
				// $lastid = $this->db->insert_id();
				// $where = array('no' => $lastid);
				// $data['catar'] = $this->m_registrasi->get_data($where,'tbl_catar_2023')->result();
				// foreach ($data['catar'] as $key) {
				// 	# code...
				// 	$po = $key->ktkb;
				// 	$where_prov = array('tbl_kabkota.id_wil' => $po);
				// }
				// $provinsi_get = $this->m_registrasi->get_data_wilayah($where_prov)->result();
				// foreach ($provinsi_get as $keyp) {
				// 	# code...
				// 	$data['kabkota'] = $keyp->kabkota;
				// 	$data['provinsi'] = $keyp->provinsi;
				// }
				// $this->load->view('cetakReg',$data);

				// //pdf
				// $pdfFilePath="cetak_registrasi_".$namafil."_2023.pdf";
				// $html=$this->load->view('cetakReg',$data, TRUE);
				// $pdf = $this->m_pdf->load();
		 
		  //       $pdf->AddPage('P');
		  //       $pdf->WriteHTML($html);
		  //       $pdf->Output($pdfFilePath, "D");
		  //       exit();
				if ($proses_insert) {
					# code...
					redirect("biodata?pesan=succsess");
				}
				redirect("biodata?pesan=error");

				//////////////// .proses biasa//////////////////////////////////////
 	
	}

	public function pembayaran()
	{
		# code...
		$no = $this->session->userdata('no');
		$where = array(
				'no' => $no,
			);
		$data['catar'] = $this->m_registrasi->get_data($where, 'tbl_catar_2024')->result();
		foreach ($data['catar'] as $key) {
			# code...
			$data['nik'] = $key->nik;
		}

		$this->load->view('camahatar/header',$data);
        $this->load->view('camahatar/pembayaran',$data);
        $this->load->view('camahatar/footer');
	}
	public function validasi()
	{
		# code...
		$no = $this->session->userdata('no');
		$where = array(
				'no' => $no,
			);
		$data['catar'] = $this->m_registrasi->get_data($where, 'tbl_catar_2024')->result();
		foreach ($data['catar'] as $key) {
			# code...
			$data['nik'] = $key->nik;
			$programStudi = $key->prodi;
		}
		$data['prodi'] = $this->getProdi($programStudi);

		$data['validasi'] = $this->m_registrasi->get_data($where, 'tbl_catar_validasi_2024')->num_rows();

		$this->load->view('camahatar/header',$data);
        $this->load->view('camahatar/validasi',$data);
        $this->load->view('camahatar/footer');
         $this->load->view('camahatar/validasi_js');
	}
	public function upload_bukti_bayar()
	{
		# code...
		// Tangani unggahan file
		$no = $this->session->userdata('no');
		$where = array(
	        'no' => $no,
	    );

        $config['upload_path'] = './assets/upload/2024/bukti_bayar';
        $config['max_size'] = 1048;
        $config['allowed_types'] = 'pdf'; // Sesuaikan dengan jenis file yang diizinkan
        $config['file_name'] = $no.'_bukti_bayar'; // Nama file yang diunggah sesuai NIM
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('bukti_bayar')) {
            // Jika unggahan berhasil
            $upload_data = $this->upload->data();
            $file_name = $upload_data['file_name'];

            // Simpan data ke database (contoh)
            $data = array(
                'bukti_bayar' => $file_name
            );
            $this->m_registrasi->update_data($where,$data,'tbl_catar_2024');

            ($this->session->userdata('jalur') == "fasttrack") ? redirect(base_url().'validasi') : redirect(base_url().'pembayaran');
        } else {
            ($this->session->userdata('jalur') == "fasttrack") ? redirect(base_url().'validasi') : redirect(base_url().'pembayaran');
        }
	}
	public function download($no)
	{
		# code...
		$where = array('no' => $no);
		$data['catar'] = $this->m_registrasi->get_data($where,'tbl_catar_2024')->result();
		foreach ($data['catar'] as $key) {
			# code...
			$po = $key->ktkb;
			$where_prov = array('tbl_kabkota.id_wil' => $po);
		}
		$provinsi_get = $this->m_registrasi->get_data_wilayah($where_prov)->result();
		foreach ($provinsi_get as $keyp) {
			# code...
			$data['kabkota'] = $keyp->kabkota;
			$data['provinsi'] = $keyp->provinsi;
		}
		$this->load->view('cetakReg',$data);

		//pdf
		$pdfFilePath="form_pendaftaran.pdf";
		$html=$this->load->view('cetakReg',$data, TRUE);
		$pdf = $this->m_pdf->load();
 		ob_clean();
        $pdf->AddPage('P');
        $pdf->WriteHTML($html);
        $pdf->Output($pdfFilePath, "D");
        exit();
		redirect("validasi");

	}
	public function down_suket()
	{
		# code...
		force_download('assets/download/surat_keterangan_siswa.docx',NULL);
		redirect(base_url());
	}
	public function down_supersehat()
	{
		# code...
		force_download('assets/download/surat_pernyataan_sehat_tf.docx',NULL);
		redirect(base_url());
	}
	public function down_supersehatreg()
	{
		# code...
		force_download('assets/download/surat_pernyataan_sehat_reg.docx',NULL);
		redirect(base_url());
	}
	public function seleksigdr1()
	{
		# code...
		$no = $this->session->userdata('no');
		$where = array(
				'no' => $no,
			);
		$data['catar'] = $this->m_registrasi->get_data($where, 'tbl_catar_2024')->result();
		foreach ($data['catar'] as $key) {
			# code...
			$data['nik'] = $key->nik;
		}
		$data['validasi'] = $this->m_registrasi->get_data($where, 'tbl_catar_validasi_2024')->num_rows();
		$data['seleksi'] = $this->m_registrasi->get_data($where, 'tbl_seleksi_2024')->num_rows();
		$data['seleksi_data'] = $this->m_registrasi->get_data($where, 'tbl_seleksi_2024')->result();

		$this->load->view('camahatar/header',$data);
        $this->load->view('camahatar/seleksigdr1',$data);
        $this->load->view('camahatar/footer');
	}
	public function seleksigdr2()
	{
		# code...
		$no = $this->session->userdata('no');
		$where = array(
				'no' => $no,
			);
		$data['catar'] = $this->m_registrasi->get_data($where, 'tbl_catar_2024')->result();
		foreach ($data['catar'] as $key) {
			# code...
			$data['nik'] = $key->nik;
		}
		$data['validasi'] = $this->m_registrasi->get_data($where, 'tbl_catar_validasi_2024')->num_rows();

		$this->load->view('camahatar/header',$data);
        $this->load->view('camahatar/seleksigdr2',$data);
        $this->load->view('camahatar/footer');
        $this->load->view('camahatar/seleksigdr2_js');
	}
	public function seleksigdr2p()
	{
		# code...
		$no = $this->session->userdata('no');
		$where = array(
	        'no' => $no,
	    );

		    // Konfigurasi upload file Ijasah D3
	    $config_ijasah_d3['upload_path'] = './assets/upload/2024/upload_ijasah_d3/';
	    $config_ijasah_d3['allowed_types'] = 'pdf';
	    $config_ijasah_d3['max_size'] = 1048; // Ukuran maksimum file (dalam kilobyte)
	    $config_ijasah_d3['file_name'] = $no.'_ijasah_D3'; // Nama file yang diunggah sesuai NIM

	    // $this->load->library('upload', $config_ijasah_d3, 'upload_ijd3');
	    $this->load->library('upload');
    	$this->upload->initialize($config_ijasah_d3);

	    // Jika upload berhasil
	    if ($this->upload->do_upload('upload_ijd3')) {
	        $upload_data = $this->upload->data();

	        // Update data pada database
	        $update_data = array(
	            'upload_ijd3' => $upload_data['file_name'],
	            // Tambahkan field lain sesuai kebutuhan
	        );

	        $this->m_registrasi->update_data($where,$update_data,'tbl_catar_2024');
	    } else {
	        // Jika upload gagal, tampilkan pesan kesalahan
	        $error = array('error' => $this->upload_ijasah_d3->display_errors());
	       	$this->session->set_flashdata('error', $error);
			redirect(base_url('seleksi_geldini_tf'));
	    }


	       // Konfigurasi upload file Transkip D3
	    $config_transkip_d3['upload_path'] = './assets/upload/2024/upload_transkip_d3/';
	    $config_transkip_d3['allowed_types'] = 'pdf';
	    $config_transkip_d3['max_size'] = 1048; // Ukuran maksimum file (dalam kilobyte)
	    $config_transkip_d3['file_name'] = $no.'_Transkip_D3'; // Nama file yang diunggah sesuai NIM

	    $this->load->library('upload');
	    $this->upload->initialize($config_transkip_d3);
	    // Jika upload berhasil
	    if ($this->upload->do_upload('upload_transd3')) {
	        $upload_data = $this->upload->data();

	        // Update data pada database
	        $update_data = array(
	            'upload_transd3' => $upload_data['file_name'],
	            // Tambahkan field lain sesuai kebutuhan
	        );

	        $this->m_registrasi->update_data($where,$update_data,'tbl_catar_2024');
	    } else {
	        // Jika upload gagal, tampilkan pesan kesalahan
	        $error = array('error' => $this->upload_transkip_d3->display_errors());
	       	$this->session->set_flashdata('error', $error);
			redirect(base_url('seleksi_geldini_tf'));
	    }

	      // Konfigurasi upload file Surat Pernyataan Sehat
	    $config_supersehat['upload_path'] = './assets/upload/2024/upload_surat_pernyataan_sehat/';
	    $config_supersehat['allowed_types'] = 'pdf';
	    $config_supersehat['max_size'] = 1048; // Ukuran maksimum file (dalam kilobyte)
	    $config_supersehat['file_name'] = $no.'_Surat_Pernyataan_sehat'; // Nama file yang diunggah sesuai NIM

	    $this->load->library('upload');
	    $this->upload->initialize($config_supersehat);
	    // Jika upload berhasil
	    if ($this->upload->do_upload('upload_supersehat')) {
	        $upload_data = $this->upload->data();

	        // Update data pada database
	        $update_data = array(
	            'upload_supersehat' => $upload_data['file_name'],
	            // Tambahkan field lain sesuai kebutuhan
	        );

	        $this->m_registrasi->update_data($where,$update_data,'tbl_catar_2024');
	    } else {
	        // Jika upload gagal, tampilkan pesan kesalahan
	        $error = array('error' => $this->upload_supersehat->display_errors());
	       	$this->session->set_flashdata('error', $error);
			redirect(base_url('seleksi_geldini_tf'));
	    }
	    // Lakukan hal yang sama untuk file-file lainnya
	    // ...
	    redirect(base_url('seleksi_geldini_tf'));

	    // Jika Anda memiliki lebih banyak jenis file yang diupload, lakukan hal yang sama untuk konfigurasi upload dan proses uploadnya
	}

	public function proses_seleksi_gdr1()
	{
		# code...
		$link_ktp = $this->input->post('link_ktp');
		$link_ijasah = $this->input->post('link_ijasah');
		$link_rapor = $this->input->post('link_rapor');
		$link_kesehatan = $this->input->post('link_kesehatan');
		$link_supersehat = $this->input->post('link_supersehat');
		$link_prestasi = $this->input->post('link_prestasi');
		$link_pushup = $this->input->post('link_pushup');
		$link_shitup = $this->input->post('link_shitup');
		$link_pullup = $this->input->post('link_pullup');
		$link_shuttle = $this->input->post('link_shuttle');

		$data = array(
					'no'=> $this->session->userdata('no'),
					'link_ktp' => $link_ktp,
					'link_ijasah' => $link_ijasah,
					'link_rapor' => $link_rapor,
					'link_kesehatan' => $link_kesehatan,
					'link_supersehat' => $link_supersehat,
					'link_prestasi' => $link_prestasi,
					'link_video_pushup' => $link_video_pushup,
					'link_video_shitup' => $link_video_shitup,
					'link_video_pullup' => $link_video_pullup,
					'link_video_shuttle' => $link_video_shuttle,
					);
		$proses_insert = $this->m_registrasi->input_data($data,'tbl_seleksi_2024');
				if ($proses_insert) {
					# code...
					redirect("seleksi_geldini_reguler?pesan=succsess");
				}
				redirect("seleksi_geldini_reguler?pesan=error");		
	}
	public function getdataeditseleksigdr1($no)
	{
		# code...
		// Ambil data berdasarkan ID dari model Anda
		$where = array(
	        'no' => $no,
	    );
        $data = $this->m_portal->get_data($where, 'tbl_seleksi_2024')->result(); // Gantilah 'get_data_by_id' dengan metode yang sesuai dalam model Anda

        // Konversi data ke format JSON dan kirimkan ke view
        echo json_encode($data);
	}
	public function proses_seleksi_edit_gdr1()
	{
		# code...
		$id_link = $this->input->post('id_link');
		$no = $this->input->post('no');
		$link_ktp = $this->input->post('link_ktp');
		$link_ijasah = $this->input->post('link_ijasah');
		$link_rapor = $this->input->post('link_rapor');
		$link_kesehatan = $this->input->post('link_kesehatan');
		$link_supersehat = $this->input->post('link_supersehat');
		$link_prestasi = $this->input->post('link_prestasi');
		$link_pushup = $this->input->post('link_pushup');
		$link_shitup = $this->input->post('link_shitup');
		$link_pullup = $this->input->post('link_pullup');
		$link_shuttle = $this->input->post('link_shuttle');

		$where = array(
	        'id_link' => $id_link,
	    );		

		$update_data = array(
					'no'=> $no,
					'link_ktp' => $link_ktp,
					'link_ijasah' => $link_ijasah,
					'link_rapor' => $link_rapor,
					'link_kesehatan' => $link_kesehatan,
					'link_supersehat' => $link_supersehat,
					'link_prestasi' => $link_prestasi,
					'link_video_pushup' => $link_video_pushup,
					'link_video_shitup' => $link_video_shitup,
					'link_video_pullup' => $link_video_pullup,
					'link_video_shuttle' => $link_video_shuttle,
					);
		$proses_insert = $this->m_registrasi->update_data($where,$update_data,'tbl_seleksi_2024');
				if ($proses_insert) {
					# code...
					redirect("seleksi_geldini_reguler?pesan=succsess");
				}
				redirect("seleksi_geldini_reguler?pesan=error");		
	}

}

/* End of file camahatar.php */
/* Location: ./application/controllers/camahatar.php */