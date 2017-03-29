<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_profil extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}

	public function password_validation($username, $password)
	{
		$result = $this->db->query('SELECT * FROM user u, jabatan j WHERE u.username="'.$username.'" AND u.password="'.$password.'" AND j.id_jabatan = u.id_jabatan');
		if($result->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}

	public function change_profile($old, $username, $name, $email, $new)
	{
		$result = $this->db->set('username', $username)->set('nama', $name)->set('email', $email)->set('password', $new)->where('username', $old)->update('user');
		if($result){
			return true;
		}
		else{
			return false;
		}
	}
}
?>