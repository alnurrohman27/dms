<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Beranda extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url', 'form'));
		$this->load->model('M_upload');
		$this->load->model('M_dokumen');
		$this->load->model('M_select2');
		$this->load->model('M_profil');

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

		$this->load->library('upload', $config);
	    $this->upload->initialize($config); 
	}

	public function index()
	{
		$data['sesi'] = $this->session_checking();
		$data['menu'] = 'beranda';
		if($data['sesi']){
			$data['username'] = $this->session_name();
		}
		$this->load->view('v_beranda', $data);
		$this->load->view('v_footer');
	}

	public function session_checking(){
		session_start();
		if(isset($_SESSION['username'])){
			$sesi = true;
			return $sesi;
		}
		else{
			return false;
		}
	}

	public function session_name() {
		return $_SESSION['nama'];
	}

	public function manajemen_dokumen(){
		$data['sesi'] = $this->session_checking();
		$valid = $data['sesi'];
		$data['username'] = $this->session_name();
		if($valid && $_SESSION['hak_akses'] == 'write' || $valid && $_SESSION['hak_akses'] == 'admin'){
			$data['kategori_dokumen'] = $this->M_select2->ambilKategoriDokumen();
			$data['context'] = $this->M_select2->ambilContextDiagram();
			$data['lokasi'] = $this->M_select2->ambilLokasi();

			$data['menu'] = 'manajemen_dokumen';
			$this->load->view('v_manajemen_dokumen', $data);
			$this->load->view('v_footer');
		}
		else if($_SESSION['hak_akses'] == 'read'){
			header("Location: ../starting");
		}
		else{
			session_start();
			$_SESSION['menu'] = 'beranda/manajemen_dokumen';
			header("Location: ../login");
		}
	}

	public function berbagi(){
		$data['sesi'] = $this->session_checking();
		$valid = $data['sesi'];
		$data['username'] = $this->session_name();
		if($valid && $_SESSION['hak_akses'] == 'write' || $valid && $_SESSION['hak_akses'] == 'admin'){
			$data['dokumen'] = $this->M_select2->ambilSemuaDokumen($_SESSION['username']);
			$data['menu'] = 'berbagi_dokumen';
			$this->load->view('v_berbagi', $data);
			$this->load->view('v_footer');
		}
		else if($_SESSION['hak_akses'] == 'read'){
			header("Location: ../starting");
		}
		else{
			session_start();
			$_SESSION['menu'] = 'beranda/berbagi';
			header("Location: ../login");
		}
	}

	public function pencarian(){
		$data['sesi'] = $this->session_checking();
		$valid = $data['sesi'];
		$data['username'] = $this->session_name();
		$result_1 = $this->M_dokumen->ambilSemuaDokumen($_SESSION['username']);
		$result_2 = $this->M_dokumen->ambilDokumenBerbagi($_SESSION['username']);
		$result_3 = $this->M_dokumen->ambilRevisiDokumen($_SESSION['username']);
		$data['i'] = 0;
		$data['x'] = 0;
		if($valid){
			if($result_1 > 0){
				foreach ($result_1 as $row) {
					$data['id_dokumen'][$data['i']] = $row['id_dokumen'];
					$data['id_file'][$data['i']] = $row['id_file'];
					$data['no_dokumen'][$data['i']] = $row['nomor_dokumen'];
					$data['id_kategori_dokumen'][$data['i']] = $row['id_kategori_dokumen'];
					$data['kode_context'][$data['i']] = $row['kode_context'];
					$data['nama'][$data['i']] = $row['nama_dokumen'];
					$data['no_edisi'][$data['i']] = $row['no_edisi'];
					$data['no_revisi'][$data['i']] = $row['no_revisi'];
					$data['tanggal_rilis'][$data['i']] = $row['tanggal_rilis'];
					$data['path'][$data['i']] = $row['path'];
					$data['i'] += 1;
				}
			}
			if($result_2 > 0){
				foreach ($result_2 as $row) {
					$data['id_dokumen'][$data['i']] = $row['id_dokumen'];
					$data['id_file'][$data['i']] = $row['id_file'];
					$data['no_dokumen'][$data['i']] = $row['nomor_dokumen'];
					$data['id_kategori_dokumen'][$data['i']] = $row['id_kategori_dokumen'];
					$data['kode_context'][$data['i']] = $row['kode_context'];
					$data['nama'][$data['i']] = $row['nama_dokumen'];
					$data['no_edisi'][$data['i']] = $row['no_edisi'];
					$data['no_revisi'][$data['i']] = $row['no_revisi'];
					$data['tanggal_rilis'][$data['i']] = $row['tanggal_rilis'];
					$data['path'][$data['i']] = $row['path'];
					$data['i'] += 1;
				}
			}
			if($result_3 > 0){
				foreach ($result_3 as $row) {
					$data['rev_id_revisi'][$data['x']] = $row['id_revisi'];
					$data['rev_id_file'][$data['x']] = $row['id_file'];
					$data['rev_no_dokumen'][$data['x']] = $row['nomor_dokumen'];
					$data['rev_id_kategori_dokumen'][$data['x']] = $row['id_kategori_dokumen'];
					$data['rev_kode_context'][$data['x']] = $row['kode_context'];
					$data['rev_nama'][$data['x']] = $row['nama_dokumen'];
					$data['rev_no_edisi'][$data['x']] = $row['no_edisi'];
					$data['rev_no_revisi'][$data['x']] = $row['no_revisi'];
					$data['rev_tanggal_rilis'][$data['x']] = $row['tanggal_rilis'];
					$data['rev_path'][$data['x']] = $row['path'];
					$data['x'] += 1;
				}
			}
			$data['menu'] = 'pencarian';
			$this->load->view('v_pencarian', $data);
			$this->load->view('v_footer');
		}
		else{
			session_start();
			$_SESSION['menu'] = 'beranda/pencarian';
			header("Location: ../login");
		}
	}

	public function profil(){
		$data['sesi'] = $this->session_checking();
		$valid = $data['sesi'];
		$data['username'] = $this->session_name();
		if($valid){
			$data['menu'] = 'profil';
			$this->load->view('v_profil', $data);
			$this->load->view('v_footer');
		}
		else{
			session_start();
			$_SESSION['menu'] = 'beranda/profil';
			header("Location: ../login");
		}
	}

	public function ubah_profil(){
		session_start();
		$old_username = $_SESSION['username'];
		$username = strtolower($this->input->post('username'));
		$name = ucwords($this->input->post('name'));
		$email = strtolower($this->input->post('email'));
		$old = $this->input->post('old_password');
		$new = $this->input->post('new_password');
		$validation = $this->M_profil->password_validation($old_username, $old);
		if($validation){
			$result = $this->M_profil->change_profile($old_username, $username, $name, $email, $new);
			if($result){
				$_SESSION['username'] = $username;
				$_SESSION['nama'] = $name;
				$_SESSION['email'] = $email;
				echo 'Data berhasil diubah';
			}
			else{
				echo 'Data gagal diubah';
			}
		}
		else{
			echo 'Password lama tidak cocok';
		}
	}

	public function setKomentar(){
		session_start();
		$url = $_GET['doc'];
		$id = $_GET['id'];
		$result = (explode("/", $url));
		$fix = $result[2].'/'.$result[3];
		$list_komentar = $this->M_dokumen->getKomentar($id);
		$detail_revisi = $this->M_dokumen->getDetailRevisi($id);
		$keterangan_revisi = $this->M_dokumen->getKeteranganRevisi($id);
		echo '<div class="row">';
		echo '<div class="col-md-8">';
        echo '<iframe src="'.base_url().'ViewerJS/#../'.$fix.'" width="100%" height="400px" allowfullscreen="" webkitallowfullscreen></iframe>';
		echo '</div>';
		echo '<div class="col-md-4" >';
		echo '<h3>Detail Revisi</h3>';
		echo '<label>Halaman yang direvisi:</label><br>';
		echo '<textarea id="list_halaman_detail_revisi" rows="1" cols="35" readonly>'.$detail_revisi.'</textarea><br>';
		echo '<label>Keterangan Revisi:</label><br>';
		echo '<textarea id="keterangan_revisi" rows="9" cols="35" readonly>'.$keterangan_revisi.'</textarea><br>';
		echo '</div>';
        echo '</div>';
        echo '<div class="row">';
        echo '<div class="col-lg-8">';
        echo '<h3>Diskusi</h3>';
        echo '<table id="daftar_komentar" class="display" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Diskusi</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>';
        if($list_komentar){
        	foreach ($list_komentar as $row) {
	        	echo '<tr>';
	        	echo '<td>'.$row["nama"].'</td>';
	        	echo '<td>'.$row["nama_jabatan"].'</td>';
	        	echo '<td>'.$row["komentar"].'</td>';
	        	echo '<td>'.$row["tanggal"].'</td>';
	        	echo '</tr>';
	        }
        }
        echo '</tbody>
            <tfoot>
                <tr>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Komentar</th>
                    <th>Tanggal</th>
                </tr>
            </tfoot>
        </table>';
        echo '</div>';
        echo '<div class="col-lg-4">';
        echo '<br>';
        if(strpos($_SESSION['jabatan'], 'Manager') OR strpos($_SESSION['jabatan'], 'Director')){
			echo '<div class="col-md-12">';
			echo '<form name="inputKomentar" id="inputKomentar" action="javascript:inputKomentar()" method="GET" required>
	            <div class="control-group form-group">
	                <div class="controls">
	                	<label>Silahkan diskusi terkait dokumen. Isi disini:</label>
	                    <textarea id="komentar" style="width: 100%" name="komentar" rows="3" cols="35" placeholder="Masukkan diskusi disini" maxLength="500" required></textarea>
	                    <p class="help-block"></p>
	                </div>
	            </div>
	            <input name="id_file" id="id_file" type="number" style="display: none;" value="'.$id.'"/>
	            <div id="success"></div>
	            <button id="submit_komentar" type="submit" class="btn btn-primary">Kirim Diskusi</button>
	        </form>';
	        echo '</div>';
		}
        echo '</div>';
        echo '</div>';
	}

	public function getDocumentProcedure(){
		$id_context = $_GET['context'];
		$result = $this->M_select2->ambilProsedurDokumen($id_context);
		if($result) {
			echo '<option value="">Pilih Prosedur Dokumen (NN)</option>';
			foreach ($result as $row) {
				echo '<option value="'.$row["nomor_urut"].'">'.$row["nomor_urut"].' - ';
                echo $row['nama'];
                echo '</option>';
			}
		}
	}

	public function update_document(){
		$id = $_GET['id'];
		echo $id;
	}

	public function update_edition(){
		$id = $_GET['id'];
		$id_edisi = $this->M_dokumen->cari_data('edisi', 'id_edisi', 'id_dokumen', $id);
		$keterangan_lama = 'Edisi lama (Revisi-revisi sebelumnya): &#10;&#13'.$this->M_dokumen->cari_data('revisi', 'keterangan', 'id_edisi', $id_edisi);
		echo '<div class="controls">
            <label>Keterangan Edisi Sebelumnya:</label>
            <textarea class="form-control" name="keterangan_lama" id="keterangan_lama" maxLength="10000" rows="5" cols="100" readonly required>'.$keterangan_lama.'</textarea> 
            <p class="help-block"></p>
            <input style="display: none;" name="id_doc" id="id_doc" value="'.$id.'">
        </div>';
	}
}
?>