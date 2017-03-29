<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Starting extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		session_start();
		$_SESSION['menu'] = 'beranda';
	}

	public function index()
	{
		header("Location: beranda");
	}
}
