<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url', 'form'));
		$this->load->model('M_upload');
		$this->load->model('M_dokumen');
	}
	public function index()
	{
		$this->load->view('v_beranda');
		$this->load->view('v_footer');
	}
	public function session_checking(){
		session_start();
		if(isset($_SESSION['username']) && isset($_SESSION['password'])){
			$sesi = true;
			return $sesi;
		}
		else{
			return false;
		}
	}
	public function unggah()
	{
		// $data['file'] = $this->input->post('file_upload');
		$path = "./document/";
		if(!is_dir($path))
		{
			mkdir($path);
		}
		$target_dir = $path;
		$target_file = $target_dir . basename($_FILES['file_upload']['name']);
		$flag = 1;
		$extension = pathinfo($target_file, PATHINFO_EXTENSION);

		//Ambil Data dari Form
		$nama_file = basename($_FILES['file_upload']['name']);
		$ukuran_file = $_FILES['file_upload']['size'];
		$tipe_file = pathinfo($target_file,PATHINFO_EXTENSION);
		$tmp_file = $_FILES['file_upload']['tmp_name'];

		// Check if file already exists
	    if (file_exists($target_file)) {
	        echo "Sorry, file already exists.";
	        $flag = 0;
	    }
	    // Check if $uploadOk is set to 0 by an error
	    if ($flag == 0) {
	        echo "Sorry, your file was not uploaded.";
	    // if everything is ok, try to upload file
	    } else {
	        if (move_uploaded_file($_FILES["file_upload"]["tmp_name"], $target_file)) {
	        	session_start();
	        	$_SESSION['upload'] = "Berkas ". $nama_file . " berhasil diunggah.";
	            $this->M_upload->insertDocument($nama_file,$ukuran_file,$tipe_file,$target_file);
	        } else {
	        	session_start();
	        	$_SESSION['upload'] = "Berkas gagal diunggah.";	        }
	    }
	    header("Location: ../beranda");
	}
	public function mengunduh()
	{

	}
	public function keluar()
	{
		session_start();
		session_unset();
		session_destroy();
		header("Location: ../starting");
	}
	public function datatables_dokumen()
	{
		/** AJAX Handle */
    	if(
    		isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
    		!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
    		strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
    		)
    	{
    		
    		/**
    		 * Mengambil Parameter dan Perubahan nilai dari setiap 
    		 * aktifitas pada table
    		 */
            $datatables  = $_POST;
            $datatables['table']    = 'coba_berkas';
    		
            /**
             * Kolom yang ditampilkan
             */
	    	$datatables['col-display'] = array(
            	    		               'no_berkas',
            	    		               'nama_berkas',
            	    		               'pembuat',
            	    		               'no_revisi',
            	    		               'status'
            	    		             );

	    	$this->M_dokumen->ambilDokumen($datatables);
    	}
    	return;
	}
	public function dokumen_masuk(){
		$valid = $this->session_checking();

		if($valid){
			$this->load->view('v_dokumen_masuk');
			$this->load->view('v_footer');
		}
		else{
			session_start();
			$_SESSION['menu'] = 'beranda/dokumen_masuk';
			header("Location: ../login");
		}
	}
	public function persetujuan(){
		$valid = $this->session_checking();

		if($valid){
			$this->load->view('v_persetujuan');
			$this->load->view('v_footer');
		}
		else{
			session_start();
			$_SESSION['menu'] = 'beranda/persetujuan';
			header("Location: ../login");
		}
	}
	public function distribusi(){
		$valid = $this->session_checking();

		if($valid){
			$this->load->view('v_distribusi');
			$this->load->view('v_footer');
		}
		else{
			session_start();
			$_SESSION['menu'] = 'beranda/distribusi';
			header("Location: ../login");
		}
	}

	public function pencarian(){
		$valid = $this->session_checking();

		if($valid){
			$this->load->view('v_pencarian');
			$this->load->view('v_footer');
		}
		else{
			session_start();
			$_SESSION['menu'] = 'beranda/pencarian';
			header("Location: ../login");
		}
	}


}
