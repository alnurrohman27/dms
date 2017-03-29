<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_select2 extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}

	public function ambilKategoriDokumen()
    {
        $result = $this->db->select('id_kategori_dokumen, nama_kategori_dokumen')->get('kategori_dokumen');
        if($result->num_rows() > 0){
            return $result->result_array();
        }
    }

    public function ambilContextDiagram()
    {
        $result = $this->db->select('id_context, nama_context')->get('context_diagram');
        if($result->num_rows() > 0){
            return $result->result_array();
        }
    }

    public function ambilLokasi()
    {
        $result = $this->db->select('id_lokasi, nama_lokasi')->get('lokasi');
        if($result->num_rows() > 0){
            return $result->result_array();
        }
    }

    public function ambilSemuaDokumen($username) {
        $result = $this->db->query('SELECT b.id_dokumen, b.id_kategori_dokumen, b.kode_context, b.nomor_dokumen, b.nama_dokumen FROM dokumen b WHERE b.pembuat = "'. $username.'"');
        if($result->num_rows() > 0){
            return $result->result_array();
        }
    }

    public function ambilSemuaTujuan($username) {
        $result = $this->db->query('SELECT j.nama_jabatan, j.id_jabatan FROM jabatan j, user u WHERE u.username = "'. $username.'" AND u.id_jabatan != j.id_jabatan');
        if($result->num_rows() > 0){
            return $result->result_array();
        }
    }

    public function ambilProsedurDokumen($context) {
        $result = $this->db->query('SELECT id_procedure, nomor_urut, nama FROM document_procedure WHERE id_context = "'. $context.'"');
        if($result->num_rows() > 0){
            return $result->result_array();
        }
    }

    public function checkSharingDocument($id) {
        session_start();
        $result = $this->db->query('SELECT j.nama_jabatan, j.id_jabatan FROM jabatan j, user u WHERE j.id_jabatan NOT IN (SELECT b.id_jabatan FROM berbagi b WHERE b.id_dokumen = '.$id.') AND u.username = "'.$_SESSION['username'].'" AND j.id_jabatan != u.id_jabatan GROUP BY id_jabatan');
        if($result->num_rows() > 0){
            return $result->result_array();
        }
        else{
            return null;
        }
    }
}
?>