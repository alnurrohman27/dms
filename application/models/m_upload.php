<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_upload extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}
	
	public function insertDocument($nama_file, $ukuran_file, $tipe_file, $target_file)
	{
		$this->db->set('nama_file', $nama_file);
		$this->db->set('ukuran', $ukuran_file);
		$this->db->set('tipe', $tipe_file);
		$this->db->set('path', $target_file);
		$this->db->insert('file');
	}
}
?>