<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_login');
	}

	public function index()
	{
		$this->load->view('v_login');
	}

	public function login_validation()
	{
		$data['username'] = $this->input->post('username');
		$data['password'] = $this->input->post('password');
		$return_data = $this->M_login->login_validation($data['username'], $data['password']);
		$status = $return_data->num_rows();
		if($status > 0){
			session_start();
			$_SESSION['username'] = $data['username'];
			foreach ($return_data->result_array() as $row) {
				$_SESSION['jabatan'] = $row['nama_jabatan'];
				$_SESSION['hak_akses'] = $row['id_hak'];
				$_SESSION['nama'] = $row['nama'];
				$_SESSION['email'] = $row['email'];
			}
			$this->M_login->logon($_SESSION['username']);
			header("Location: ../".$_SESSION['menu']);
		}
		else
		{
			echo '<script>alert("Login Gagal")</script>';
			echo '<script type="text/javascript">location.href = "../";</script>';
		}
	}

	public function logout()
	{
		session_start();
		$this->M_login->logout($_SESSION['username']);
		session_unset();
		session_destroy();
		header("Location: ../starting");
	}

	public function sign_up()
	{
		$data['username'] = strtolower($this->input->post('username'));
		$data['password'] = $this->input->post('password');
		$data['nama'] = ucwords($this->input->post('nama'));
		$data['email'] = strtolower($this->input->post('email'));
		$status = $this->M_login->sign_up($data);

		if($status <= 0){
			echo '<script>alert("Pendaftaran Gagal")</script>';
			echo '<script type="text/javascript">location.href = "../";</script>';
		}
		else
		{
			echo '<script>alert("Pendaftaran Berhasil")</script>';
			echo '<script type="text/javascript">location.href = "../";</script>';
		}
	}

	public function lupa()
	{
		$this->load->view('v_forget');
	}

	public function reset_password()
	{
		$data['username'] = $this->input->post('username');
		$data['password'] = $this->input->post('password');
		$data['email'] = $this->input->post('email');
	}
}
?>
