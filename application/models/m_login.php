<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_login extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}

	public function login_validation($username, $password)
	{
		$result = $this->db->query('SELECT u.id_hak, j.nama_jabatan, u.nama, u.email FROM user u, jabatan j WHERE u.username="'.$username.'" AND u.password="'.$password.'" AND j.id_jabatan = u.id_jabatan');
		return $result;
	}

	public function logon($username)
	{
		$select = $this->db->select('*')->where('username', $username)->where('waktu_logout', NULL)->where('program', 'user')->get('logon')->num_rows();
		if($select <= 0){
			$this->db->set('username', $username);
			$this->db->set('program', 'user');
			$this->db->insert('logon');
		}
	}

	public function logout($username)
	{
		date_default_timezone_set('Asia/Jakarta');
		$date = date_create();
		$logout = date_format($date, 'Y-m-d H:i:s');
		$this->db->set('waktu_logout',$logout);
		$this->db->where('username', $username);
		$this->db->where('waktu_logout', NULL);
		$this->db->where('program', 'user');
		$this->db->update('logon');
	}
}
?>