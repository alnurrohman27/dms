<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Select2 extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url', 'form'));
		$this->load->model('M_select2');
	}

	public function select2_jenis_dokumen()
	{
	    $results = $this->M_select2->ambilJenisDokumen();
	    return $results;
	}

	public function select2_kode_departemen()
	{
		$search = strip_tags(trim($_POST['d'])); 
	    $results = $this->M_select2->ambilKodeDepartemen($search);
	    $data = json_encode($results);
	    echo $data;
	}
	
	public function getDestination()
	{
		$id = $_GET['id'];
	    $results = $this->M_select2->checkSharingDocument($id);
	    if($results){
	    	foreach ($results as $row) {
				echo '<option value="'.$row["id_jabatan"].'">'.$row["nama_jabatan"].'</option>';
			}
	    }
	}
}
?>