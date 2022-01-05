<?php 
/**
* 
*/
class m_registrasi extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
	function input_data($data,$table){
		$this->db->insert($table,$data);
	}
	function get_data($where,$table){		
	return $this->db->get_where($table,$where);
	}
	function get_data_all($table){
		return $this->db->get($table);
	}
	function update_data($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}
	function get_data_gelombang($where){		
		   $this->db->select('gelombang');
		   $this->db->from('tbl_gelombang');
	       $this->db->where($where);
	return $this->db->get()->row('gelombang');

	}
	function get_data_tahun($where){		
		   $this->db->select('tahun');
		   $this->db->from('tbl_gelombang');
	       $this->db->where($where);
	return $this->db->get()->row('tahun');

	}
	function delete_data($where,$table){
		$this->db->where($where);
		$this->db->delete($table);
	}
	function get_kabkota($id){
        $hasil=$this->db->query("SELECT * FROM tbl_kabkota WHERE id_induk_wil='$id'");
        return $hasil->result();
    }
	function get_data_ta($where){		
		   $this->db->select('ta');
		   $this->db->from('tbl_gelombang');
	       $this->db->where($where);
	return $this->db->get()->row('ta');

	}
	function get_data_join_all(){
		$this->db->select('tbl_catar_2022.no,
		tbl_catar_2022.nama,
		tbl_catar_2022.tl,
		tbl_catar_2022.tgl_l,
		tbl_catar_2022.agama,
		tbl_catar_2022.jk,
		tbl_catar_2022.alamat,
		tbl_catar_2022.ktkb,
		tbl_catar_2022.provinsi,
		tbl_catar_2022.telp,
		tbl_catar_2022.kategori_sek,
		tbl_catar_2022.prodi_lama,
		tbl_catar_2022.thn_lulus,
		tbl_catar_2022.asek,
		tbl_catar_2022.alamat_sek,
		tbl_catar_2022.nama_a,
		tbl_catar_2022.nama_i,
		tbl_catar_2022.alamat_ortu,
		tbl_catar_2022.telp_ortu,
		tbl_catar_2022.prodi,
		tbl_catar_2022.gelombang,
		tbl_catar_validasi_2022.val_id,
		tbl_catar_validasi_2022.no,
		tbl_catar_validasi_2022.gelombang,
		tbl_catar_validasi_2022.tgl_byr,
		tbl_catar_validasi_2022.prodi,
		tbl_catar_validasi_2022.no_reg,
		tbl_catar_validasi_2022.jml_byr,
		tbl_catar_validasi_2022.aktif');
		$this->db->from('tbl_catar_2021');
		$this->db->join('tbl_catar_validasi_2022','tbl_catar_validasi_2022.no = tbl_catar_2022.no','inner');
		$query=$this->db->get();
		return $query;

		
	}
	function get_data_join_where($where){
		$this->db->select('tbl_catar_2022.no,
		tbl_catar_2022.nama,
		tbl_catar_2022.tl,
		tbl_catar_2022.tgl_l,
		tbl_catar_2022.agama,
		tbl_catar_2022.jk,
		tbl_catar_2022.alamat,
		tbl_catar_2022.ktkb,
		tbl_catar_2022.provinsi,
		tbl_catar_2022.telp,
		tbl_catar_2022.kategori_sek,
		tbl_catar_2022.prodi_lama,
		tbl_catar_2022.thn_lulus,
		tbl_catar_2022.asek,
		tbl_catar_2022.alamat_sek,
		tbl_catar_2022.nama_a,
		tbl_catar_2022.nama_i,
		tbl_catar_2022.alamat_ortu,
		tbl_catar_2022.telp_ortu,
		tbl_catar_2022.prodi,
		tbl_catar_2022.kelas,
		tbl_catar_2022.gelombang,
		tbl_catar_validasi_2022.val_id,
		tbl_catar_validasi_2022.no,
		tbl_catar_validasi_2022.gelombang,
		tbl_catar_validasi_2022.tgl_byr,
		tbl_catar_validasi_2022.prodi,
		tbl_catar_validasi_2022.no_reg,
		tbl_catar_validasi_2022.jml_byr,
		tbl_catar_validasi_2022.aktif as aktif,
		tbl_catar_validasi_2022.thn_pel as thn_pel');
		$this->db->from('tbl_catar_2022');
		$this->db->join('tbl_catar_validasi_2022','tbl_catar_validasi_2022.no = tbl_catar_2022.no','inner');
		$this->db->where($where);
		$this->db->order_by('tbl_catar_validasi_2022.no_reg', "asc");
		$query=$this->db->get();
		return $query;

		
	}

	function get_data_join_where_row($where){
		$this->db->select('tbl_catar_2022.no,
		tbl_catar_2022.nama,
		tbl_catar_2022.tl,
		tbl_catar_2022.tgl_l,
		tbl_catar_2022.agama,
		tbl_catar_2022.jk,
		tbl_catar_2022.alamat,
		tbl_catar_2022.ktkb,
		tbl_catar_2022.provinsi,
		tbl_catar_2022.telp,
		tbl_catar_2022.kategori_sek,
		tbl_catar_2022.prodi_lama,
		tbl_catar_2022.thn_lulus,
		tbl_catar_2022.asek,
		tbl_catar_2022.alamat_sek,
		tbl_catar_2022.nama_a,
		tbl_catar_2022.nama_i,
		tbl_catar_2022.alamat_ortu,
		tbl_catar_2022.telp_ortu,
		tbl_catar_2022.prodi,
		tbl_catar_2022.kelas,
		tbl_catar_2022.gelombang,
		tbl_catar_validasi_2022.val_id,
		tbl_catar_validasi_2022.no,
		tbl_catar_validasi_2022.gelombang,
		tbl_catar_validasi_2022.tgl_byr,
		tbl_catar_validasi_2022.prodi,
		tbl_catar_validasi_2022.no_reg,
		tbl_catar_validasi_2022.jml_byr,
		tbl_catar_validasi_2022.aktif as aktif,
		tbl_catar_validasi_2022.thn_pel as thn_pel');
		$this->db->from('tbl_catar_2022');
		$this->db->join('tbl_catar_validasi_2022','tbl_catar_validasi_2022.no = tbl_catar_2022.no','inner');
		$this->db->where($where);
		// $this->db->order_by('tbl_catar_validasi_2021.no_reg', "asc");
		$query=$this->db->get();
		return $query;

		
	}
	function get_data_statistic(){
		$this->db->select('tbl_catar_2021.provinsi,
		tbl_provinsi.provinsi,
		count(no)');
		$this->db->from('tbl_catar_2021');
		$this->db->join('tbl_provinsi','tbl_catar_2021.provinsi = tbl_provinsi.id_provinsi','inner');
		$this->db->group_by('tbl_catar_2021.provinsi');
		$this->db->order_by('count(*)', 'DESC');
		$query=$this->db->get();
		return $query;
	}
}




 ?>