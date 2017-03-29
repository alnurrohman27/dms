<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dokumen extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url', 'form'));
		$this->load->model('M_dokumen');

		ini_set( 'memory_limit', '200M' );
		ini_set('upload_max_filesize', '200M');  
		ini_set('post_max_size', '200M');  
		ini_set('max_input_time', 3600);  
		ini_set('max_execution_time', 3600);

	    $config['upload_path'] = './document/';
	    $config['allowed_types'] = 'pdf';
	    $config['max_size'] = '1000000';
		$config['max_width']  = '1024000';
		$config['max_height']  = '768000';
		$config['encrypt_name'] = true;

		if(!is_dir($config['upload_path']))
		{
			mkdir($config['upload_path']);
		}
		$this->load->library('upload', $config);
	    $this->upload->initialize($config); 
	}

	public function manajemen_dokumen()
	{
		if(isset($_POST['search']['value'])){
			$key = $_POST['search']['value'];
			$draw = $_POST['draw'];
		}
		else{
			$key = NULL;
			$draw = NULL;
		}
		$result = $this->M_dokumen->manajemen_dokumen($key, $draw);
		echo json_encode($result);
	}

	public function insertDokumen()
	{
		$kategori_dokumen = $_POST['kategori_dokumen'];
		$nama_dokumen = $_POST['nama_dokumen'];
		if($kategori_dokumen == "SP" ){
			$yyy = $_POST['yyy'];
			$nn = $_POST['nn'];
			$check_nn = is_numeric($nn);
			$nd = null;
			$ll = null;
			$dd = null;
			$nomor_dokumen = $kategori_dokumen.'-'.$yyy.'-'.$nn;
		}
		else if($kategori_dokumen == "WI" || $kategori_dokumen == "SOP"){
			$yyy = $_POST['yyy'];
			$nn = $_POST['nn'];
			$check_nn = is_numeric($nn);
			$nd = $_POST['nd'];
			$check_nd = is_numeric($nd);
			$ll = $_POST['ll'];
			$dd = null;
			$nomor_dokumen = $kategori_dokumen.'-'.$yyy.'-'.$nn.'-'.$nd.'-'.$ll;
		}
		else if($kategori_dokumen == 'SM'){
			$yyy = null;
			$nn = null;
			$nd = null;
			$ll = null;
			$dd = null;
			$nomor_dokumen = $kategori_dokumen;
		}
		else {
			$yyy = $_POST['yyy'];
			$nn = $_POST['nn'];
			$check_nn = is_numeric($nn);
			$nd = $_POST['nd'];
			$check_nd = is_numeric($nd);
			$ll = $_POST['ll'];
			$dd = $_POST['dd'];
			$check_dd = is_numeric($dd);
			$nomor_dokumen = $kategori_dokumen.'-'.$yyy.'-'.$nn.'-'.$nd.'-'.$ll.'-'.$dd;
		}
		$cek = $this->M_dokumen->cek_no_dokumen($nomor_dokumen);
		$nama_file = basename($_FILES['file_dokumen']['name']);
		$path = 'document/'.basename($_FILES['file_dokumen']['name']);
		$ukuran_file = $_FILES['file_dokumen']['size'];
		$tipe_file = pathinfo($path,PATHINFO_EXTENSION);
		$tmp_file = $_FILES['file_dokumen']['tmp_name'];

		if($cek == 'Nomor dokumen telah terpakai') 
		{
			$message = 'Cek Nomor Dokumen';
            echo $message;
		}
		else if(isset($check_nn) && !$check_nn){
			echo 'Cek Kode Prosedur Dokumen';
		}
		else if(isset($check_nd) && !$check_nd){
			echo 'Cek Kode Dokumen WI/SOP';
		}
		else if(isset($check_dd) && !$check_dd){
			echo 'Cek Urutan Dokumen';
		}
	    else if(!$this->upload->do_upload('file_dokumen'))
	    {
	    	if(file_exists($path)){
	    		echo 'Gagal Upload. Nama dokumen sama.';
	    	}
	    	else{
	    		echo 'Gagal Upload. Dokumen terlalu besar atau tipe tidak diperbolehkan.';
	    	}
	    }                            
	    else
	    {
			if($tipe_file == 'pdf') 
			{
	    		$data = array('upload_data' => $this->upload->data());  
	    		$target_file="/dms/document/".$this->upload->data('file_name');
	    		$this->M_dokumen->uploadDokumen($nama_file,$ukuran_file,$tipe_file,$target_file);
	    		$id_file = $this->M_dokumen->cari_id_terakhir('file');
	    		$message = $this->M_dokumen->insertDokumen($kategori_dokumen, $yyy, $nn, $nomor_dokumen, $nama_dokumen, $ll, $nd);
	    		$id_dokumen = $this->M_dokumen->cari_id_terakhir('dokumen');
	    		$message = $this->M_dokumen->insertEdisi($id_dokumen);
	    		$id_edisi = $this->M_dokumen->cari_id_terakhir('edisi'); 
	    		$message = $this->M_dokumen->insertRevisi($id_edisi, $id_file);
	      		echo $message;
			}
			else
			{
				echo 'Tipe file harus pdf';
			}
	    }
	}

	public function berbagiDokumen() 
	{
		$id = $_POST['no_dokumen'];
		foreach ($_POST['tujuan'] as $tujuan) {
			$message = $this->M_dokumen->berbagiDokumenAjax($id, $tujuan);
		}
		echo $message;
	}

	public function setKomentar()
	{
		session_start();
		$komentar = $_GET['komentar'];
		$id = $_GET['id'];
		$username = $_SESSION['username'];
		$result = $this->M_dokumen->setKomentar($komentar, $id, $username);
		if($result){
			echo json_encode($result, JSON_FORCE_OBJECT);
		}
		else{
			echo 'Komentar Gagal';
		}
	}

	public function getKomentar()
	{
		$id = $_GET['id'];
		$result = $this->M_dokumen->getKomentar($id);
		echo $result;
	}

	public function setRevisi()
	{
		$id = $_POST['id_edisi'];
		$keterangan = $_POST['keterangan'];
		$nama_file = basename($_FILES['file_revisi']['name']);
		$path = 'document/'.basename($_FILES['file_revisi']['name']);
		$ukuran_file = $_FILES['file_revisi']['size'];
		$tipe_file = pathinfo($path,PATHINFO_EXTENSION);
		$tmp_file = $_FILES['file_revisi']['tmp_name'];
		if(!$this->upload->do_upload('file_revisi'))
	    {
	    	if(file_exists($path)){
	    		echo 'Gagal Upload. Nama dokumen sama.';
	    	}
	    	else{
	    		echo 'Gagal Upload. Dokumen terlalu besar atau tipe tidak diperbolehkan.';
	    	}
	    }                            
	    else
	    {
			if($tipe_file == 'pdf') 
			{
	    		$data = array('upload_data' => $this->upload->data());  
	    		$target_file="/dms/document/".$this->upload->data('file_name');
	    		$this->M_dokumen->uploadDokumen($nama_file,$ukuran_file,$tipe_file,$target_file);
	    		$no_revisi = $this->M_dokumen->riwayat_revisi($id)+1;
	    		$id_file = $this->M_dokumen->cari_id_terakhir('file');
	    		$result = $this->M_dokumen->insertRevisi($id, $id_file);
	    		$id_revisi = $this->M_dokumen->cari_id_terakhir('revisi');
	    		if($result){
	    			$this->M_dokumen->update_data('revisi', 'id_edisi', 'keterangan', $id, $keterangan);
	    			$this->M_dokumen->update_data('revisi', 'id_edisi', 'no_revisi', $id, $no_revisi);

	    			foreach ($_POST['hal'] as $halaman) {
						$this->M_dokumen->insertDetailRevisi($id_revisi, $halaman);
					}
	    			echo 'Revisi berhasil dimasukkan';
	    		}
	    		else{
	    			echo 'Gagal mengunggah revisi';
	    		}
			}
			else
			{
				echo 'Tipe file harus pdf';
			}
	    }
	}

	public function setEdisi()
	{
		$id = $_POST['id_doc'];
		$keterangan = $_POST['keterangan_lama'].'&#10;&#13;Keterangan Edisi Baru: '.$_POST['keterangan_baru'];
		$nama_file = basename($_FILES['file_revisi']['name']);
		$path = 'document/'.basename($_FILES['file_revisi']['name']);
		$ukuran_file = $_FILES['file_revisi']['size'];
		$tipe_file = pathinfo($path,PATHINFO_EXTENSION);
		$tmp_file = $_FILES['file_revisi']['tmp_name'];
		if(!$this->upload->do_upload('file_revisi'))
	    {
	    	if(file_exists($path)){
	    		echo 'Gagal Upload. Nama dokumen sama.';
	    	}
	    	else{
	    		echo 'Gagal Upload. Dokumen terlalu besar atau tipe tidak diperbolehkan.';
	    	}
	    }                            
	    else
	    {
			if($tipe_file == 'pdf') 
			{
	    		$data = array('upload_data' => $this->upload->data());  
	    		$target_file="/dms/document/".$this->upload->data('file_name');
	    		$this->M_dokumen->uploadDokumen($nama_file,$ukuran_file,$tipe_file,$target_file);
	    		$no_edisi = $this->M_dokumen->riwayat_edisi($id)+1;
	    		$result = $this->M_dokumen->insertEdisi($id);
	    		$id_edisi = $this->M_dokumen->cari_id_terakhir('edisi');
	    		$id_file = $this->M_dokumen->cari_id_terakhir('file');
	    		$result = $this->M_dokumen->insertRevisi($id_edisi, $id_file);
	    		if($result){
	    			$this->M_dokumen->update_data('revisi', 'id_edisi', 'keterangan', $id_edisi, $keterangan);
	    			$this->M_dokumen->update_data('edisi', 'id_dokumen', 'no_edisi', $id, $no_edisi);
	    			echo 'Edisi berhasil dimasukkan';
	    		}
	    		else{
	    			echo 'Gagal mengunggah revisi';
	    		}
			}
			else
			{
				echo 'Tipe file harus pdf';
			}
	    }
	}
}
?>
