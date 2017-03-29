<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use
    DataTables\Editor,
    DataTables\Editor\Field,
    DataTables\Editor\Format,
    DataTables\Editor\Join,
    DataTables\Editor\Upload,
    DataTables\Editor\Validate;   
class M_dokumen extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}
    private $editorDb = null;
     
    public function init($editorDb)
    {
        $this->editorDb = $editorDb;
    }

    public function manajemen_dokumen($key,$draw)
    {
        session_start();
        if(!$key){
            $result = $this->db->query('SELECT d.id_dokumen, d.id_kategori_dokumen, d.kode_context, d.kode_procedure, d.nomor_dokumen, d.nama_dokumen, d.pembuat, e.id_edisi, e.no_edisi, r.no_revisi, DATE_FORMAT(r.tanggal_rilis, "%d-%m-%Y") as tanggal_rilis FROM dokumen d, edisi e, revisi r WHERE d.id_dokumen = e.id_dokumen AND e.id_edisi = r.id_edisi AND d.pembuat = "'.$_SESSION['username'].'" GROUP BY d.id_dokumen ORDER BY d.nomor_dokumen ASC');
            $i=0;
            $total = $result->num_rows();
            if(!$draw){
                $draw = 1;
            }
            if($total > 0){
                foreach ($result->result_array() as $row) {
                    $string = 'row_';
                    $string = $string.$row['id_dokumen'];
                    $data[$i]['DT_RowId'] = $string;
                    $data[$i]['dokumen']['id_dokumen'] = $row['id_dokumen'];
                    $data[$i]['dokumen']['id_kategori_dokumen'] = $row['id_kategori_dokumen'];
                    $data[$i]['dokumen']['kode_context'] = $row['kode_context'];
                    $data[$i]['dokumen']['kode_procedure'] = $row['kode_procedure'];
                    $data[$i]['dokumen']['nomor_dokumen'] = $row['nomor_dokumen'];
                    $data[$i]['dokumen']['nama_dokumen'] = $row['nama_dokumen'];
                    $data[$i]['dokumen']['pembuat'] = $row['pembuat'];
                    $data[$i]['edisi']['id_edisi'] = $row['id_edisi'];
                    $data[$i]['edisi']['no_edisi'] = $row['no_edisi'];
                    $data[$i]['revisi']['no_revisi'] = $row['no_revisi'];
                    $data[$i]['revisi']['tanggal_rilis'] = $row['tanggal_rilis'];
                    $i++;
                }
                $data_array['data'] = $data;
                $data_array['options'] = array();
                $data_array['files'] = array();
                $data_array['draw'] = $draw;
                $data_array['recordsTotal'] = strval($i);
                $data_array['recordsFiltered'] = strval($i);
            }
            else{
                $data_array['data'] = array();
                $data_array['options'] = array();
                $data_array['files'] = array();
                $data_array['draw'] = $draw;
                $data_array['recordsTotal'] = strval(0);
                $data_array['recordsFiltered'] = strval(0);
            }
            return $data_array;
        }
        else{
            $total = $this->db->query('SELECT d.id_dokumen, d.id_kategori_dokumen, d.kode_context, d.kode_procedure, d.nomor_dokumen, d.nama_dokumen, d.pembuat, e.id_edisi, e.no_edisi, r.no_revisi, DATE_FORMAT(r.tanggal_rilis, "%d-%m-%Y") as tanggal_rilis FROM dokumen d, edisi e, revisi r WHERE d.id_dokumen = e.id_dokumen AND e.id_edisi = r.id_edisi AND d.pembuat = "'.$_SESSION['username'].'" GROUP BY d.id_dokumen ORDER BY d.nomor_dokumen ASC')->num_rows();
            $result = $this->db->query('SELECT d.id_dokumen, d.id_kategori_dokumen, d.kode_context, d.kode_procedure, d.nomor_dokumen, d.nama_dokumen, d.pembuat, e.id_edisi, e.no_edisi, r.no_revisi, DATE_FORMAT(r.tanggal_rilis, "%d-%m-%Y") as tanggal_rilis FROM dokumen d, edisi e, revisi r WHERE d.nomor_dokumen LIKE "%'.$key.'%" AND d.id_dokumen = e.id_dokumen AND e.id_edisi = r.id_edisi AND d.pembuat = "'.$_SESSION['username'].'" OR d.nama_dokumen LIKE "%'.$key.'%" AND d.id_dokumen = e.id_dokumen AND e.id_edisi = r.id_edisi AND d.pembuat = "'.$_SESSION['username'].'" OR e.no_edisi LIKE "%'.$key.'%" AND d.id_dokumen = e.id_dokumen AND e.id_edisi = r.id_edisi AND d.pembuat = "'.$_SESSION['username'].'" OR r.no_revisi LIKE "%'.$key.'%" AND d.id_dokumen = e.id_dokumen AND e.id_edisi = r.id_edisi AND d.pembuat = "'.$_SESSION['username'].'" OR r.tanggal_rilis LIKE "%'.$key.'%" AND d.id_dokumen = e.id_dokumen AND e.id_edisi = r.id_edisi AND d.pembuat = "'.$_SESSION['username'].'" GROUP BY d.id_dokumen ORDER BY d.nomor_dokumen ASC');
            $i=0;
            $filtered = $result->num_rows();
            if($filtered > 0){
                foreach ($result->result_array() as $row) {
                    $string = 'row_';
                    $string = $string.$row['id_dokumen'];
                    $data[$i]['DT_RowId'] = $string;
                    $data[$i]['dokumen']['id_dokumen'] = $row['id_dokumen'];
                    $data[$i]['dokumen']['id_kategori_dokumen'] = $row['id_kategori_dokumen'];
                    $data[$i]['dokumen']['kode_context'] = $row['kode_context'];
                    $data[$i]['dokumen']['kode_procedure'] = $row['kode_procedure'];
                    $data[$i]['dokumen']['nomor_dokumen'] = $row['nomor_dokumen'];
                    $data[$i]['dokumen']['nama_dokumen'] = $row['nama_dokumen'];
                    $data[$i]['dokumen']['pembuat'] = $row['pembuat'];
                    $data[$i]['edisi']['id_edisi'] = $row['id_edisi'];
                    $data[$i]['edisi']['no_edisi'] = $row['no_edisi'];
                    $data[$i]['revisi']['no_revisi'] = $row['no_revisi'];
                    $data[$i]['revisi']['tanggal_rilis'] = $row['tanggal_rilis'];
                    $i++;
                }
                $data_array['data'] = $data;
                $data_array['options'] = array();
                $data_array['files'] = array();
                $data_array['draw'] = $draw+1;
                $data_array['recordsTotal'] = strval($total);
                $data_array['recordsFiltered'] = strval($filtered);
            }
            else{
                $data_array['data'] = array();
                $data_array['options'] = array();
                $data_array['files'] = array();
                $data_array['draw'] = $draw+1;
                $data_array['recordsTotal'] = strval($total);
                $data_array['recordsFiltered'] = strval($filtered);
            }
            return $data_array;
        }
    }

	public function ambilDokumen($post)
    {
        session_start();
        Editor::inst( $this->editorDb, 'dokumen', 'id_dokumen' )
        ->fields(
            Field::inst( 'dokumen.id_dokumen'),
            Field::inst( 'dokumen.id_kategori_dokumen' ),
            Field::inst( 'dokumen.kode_context' ),
            Field::inst( 'dokumen.kode_procedure' ),
            Field::inst( 'dokumen.nomor_dokumen' ),
            Field::inst( 'dokumen.nama_dokumen' ),
            Field::inst( 'dokumen.pembuat' ),
            Field::inst( 'edisi.no_edisi' ),
            Field::inst( 'revisi.no_revisi' ),
            Field::inst( 'revisi.tanggal_rilis' )
            ->validator( 'Validate::dateFormat', array(
                "format"  => Format::DATE_ISO_8601,
                "message" => "Please enter a date in the format yyyy-mm-dd"
            ) )
            ->getFormatter( function ( $val, $data, $opts ) {
                return date( 'd-m-Y', strtotime( $val ) );
            } )
            ->setFormatter( 'Format::date_format_to_sql', Format::DATE_ISO_8601 ),
            Field::inst( 'dokumen.id_lokasi'),
            Field::inst( 'dokumen.nomor_urut'),
            Field::inst( 'edisi.id_edisi' )
        )
        ->where('dokumen.pembuat', $_SESSION['username'])
        ->leftJoin('edisi', 'edisi.id_dokumen', '=', 'dokumen.id_dokumen')
        ->leftJoin('revisi', 'revisi.id_edisi', '=', 'edisi.id_edisi')
        ->process( $post )
        ->json(); 
    }

    public function insertDokumen($kategori_dokumen, $yyy, $nn, $nomor_dokumen, $nama_dokumen, $ll, $nd)
    {
        session_start();
        $tanggal_rilis = date('Y-m-d');
        $this->db->set('id_kategori_dokumen', $kategori_dokumen);
        $this->db->set('kode_context', $yyy);
        $this->db->set('kode_procedure', $nn);
        $this->db->set('nomor_dokumen', $nomor_dokumen);
        $this->db->set('nama_dokumen', $nama_dokumen);
        $this->db->set('pembuat', $_SESSION['username']);
        $this->db->set('id_lokasi', $ll);
        $this->db->set('nomor_urut', $nd);
        $this->db->insert('dokumen');
        $message = 'Data berhasil dimasukkan';
        return $message;
    }

    public function insertEdisi($id_dokumen)
    {
        $this->db->set('id_dokumen', $id_dokumen);
        $this->db->insert('edisi');
        $message = 'Data berhasil dimasukkan';
        return $message;
    }

    public function insertRevisi($id_edisi, $id_file)
    {
        $tanggal_rilis = date('Y-m-d');
        $this->db->set('id_edisi', $id_edisi);
        $this->db->set('id_file', $id_file);
        $this->db->set('tanggal_rilis', $tanggal_rilis);
        $this->db->insert('revisi');
        $message = 'Data berhasil dimasukkan';
        return $message;
    }

    public function insertDetailRevisi($id_revisi, $hal)
    {
        $this->db->set('id_revisi', $id_revisi);
        $this->db->set('halaman', $hal);
        $this->db->insert('detail_revisi');
        $message = 'Data berhasil dimasukkan';
        return $message;
    }

    public function uploadDokumen($nama_file, $ukuran_file, $tipe_file, $target_file)
    {
        $this->db->set('nama_file', $nama_file);
        $this->db->set('ukuran', $ukuran_file);
        $this->db->set('tipe', $tipe_file);
        $this->db->set('path', $target_file);
        $this->db->insert('file');
    }

    public function cari_data($table, $column, $where, $key)
    {
        $result = $this->db->select('*')->where($where, $key)->get($table);
        if($result->num_rows() > 0){
            $data='';
            foreach ($result->result_array() as $row) {
                if($column == "keterangan"){
                    $data = $data.'Revisi ke-'.$row['no_revisi'].'&#10;'.$row[$column].'&#10;&#13;';
                }
                else
                {
                    $data = $row[$column];
                }
            }
            return $data;
        }
    }

    public function cari_id_terakhir($key) {
        $column = 'id_'.$key;
        $result = $this->db->query('SELECT '.$column.' FROM '.$key.' ORDER BY '.$column.' DESC LIMIT 1');
        if($result->num_rows() > 0) {
            foreach ($result->result_array() as $row) {
                $id = $row[$column];
            }
            return $id;
        }
    }

    public function riwayat_revisi($id){
        $result = $this->db->select('no_revisi')->where('id_edisi', $id)->get('revisi');
        if($result->num_rows() > 0){
            foreach ($result->result_array() as $rows) {
                $no = $rows['no_revisi'];
            }
            $this->db->where('id_edisi', $id)->delete('revisi');
            return $no;
        }
    }

    public function riwayat_edisi($id){
        $result = $this->db->select('no_edisi')->where('id_dokumen', $id)->get('edisi');
        if($result->num_rows() > 0){
            foreach ($result->result_array() as $rows) {
                $no = $rows['no_edisi'];
            }
            $this->db->where('id_dokumen', $id)->delete('edisi');
            return $no;
        }
    }

    public function reset_auto_increment_dokumen() {
        $n = $this->db->query('SELECT count(*) as jumlah FROM dokumen');
        if($n->num_rows() > 0){
            foreach ($n->result_array() as $rows) {
                $jumlah = $rows['jumlah'];
            }
        }
        $n = $jumlah+1;
        $query = 'ALTER TABLE dokumen AUTO_INCREMENT='.$n;
        $this->db->query($query);
    }

    public function cek_no_dokumen($nomor_dokumen)
    {
        $result = $this->db->select('nomor_dokumen')->where('nomor_dokumen', $nomor_dokumen)->get('dokumen')->num_rows();
        if($result > 0) {
            $message = 'Nomor dokumen telah terpakai';
        }
        else{
            $message = 'Nomor dokumen belum terpakai';
        }
        return $message;
    }

    public function berbagiDokumen($post)
    {
        session_start();
        Editor::inst( $this->editorDb, 'berbagi', 'id_berbagi' )
        ->fields(
            Field::inst( 'berbagi.id_dokumen' ),
            Field::inst( 'berbagi.id_jabatan'),
            Field::inst( 'dokumen.nomor_dokumen' ),
            Field::inst( 'dokumen.nama_dokumen' ),
            Field::inst( 'jabatan.nama_jabatan')
        )
        ->where('dokumen.pembuat', $_SESSION['username'])
        ->leftJoin('dokumen', 'berbagi.id_dokumen', '=', 'dokumen.id_dokumen')
        ->leftJoin('jabatan', 'berbagi.id_jabatan', '=', 'jabatan.id_jabatan')
        ->process( $post )
        ->json(); 
    }

    public function berbagiDokumenAjax($id, $tujuan) 
    {
        $cek = $this->db->select('id_berbagi')->where('id_dokumen', $id)->where('id_jabatan', $tujuan)->get('berbagi');
        if($cek->num_rows() > 0){
            return 'Dokumen sudah pernah dibagikan';
        } 
        else {
            $this->db->set('id_dokumen', $id);
            $this->db->set('id_jabatan', $tujuan);
            $result = $this->db->insert('berbagi');
            if($result) {
                return 'Dokumen berhasil dibagikan';
            }
            else {
                return 'Dokumen gagal dibagikan';
            }
        }
    }

    public function pencarianDatadokumen($kolom, $id_dokumen)
    {
        $result = $this->db->select($kolom)->where('id_dokumen', $id_dokumen)->get('dokumen')->result();
        if($result > 0) {
            foreach ($result as $row) {
                $ans = $row[$kolom];
            }
            return $ans;
        }
    }

    public function ambilSemuaDokumen($username) {
        $result = $this->db->query('SELECT b.id_dokumen, b.id_kategori_dokumen, b.kode_context, b.nomor_dokumen, b.nama_dokumen, e.no_edisi, r.id_revisi, r.no_revisi,  DATE_FORMAT(r.tanggal_rilis, "%d-%m-%Y") as tanggal_rilis, f.id_file, f.path FROM dokumen b, edisi e, revisi r, file f WHERE b.pembuat = "'. $username.'" AND e.id_dokumen = b.id_dokumen AND e.id_edisi = r.id_edisi AND r.id_file = f.id_file');
        if($result->num_rows() > 0){
            return $result->result_array();
        }
    }

    public function ambilDokumenBerbagi($username) {
        $result = $this->db->query('SELECT b.id_dokumen, b.id_kategori_dokumen, b.kode_context, b.nomor_dokumen, b.nama_dokumen, e.no_edisi, r.id_revisi, r.no_revisi, DATE_FORMAT(r.tanggal_rilis, "%d-%m-%Y") as tanggal_rilis, f.id_file, f.path FROM dokumen b, berbagi p, file f, user u, revisi r, edisi e WHERE b.id_dokumen = p.id_dokumen AND r.id_file = f.id_file AND e.id_dokumen = b.id_dokumen AND r.id_edisi = e.id_edisi AND u.username = "'. $username. '" AND u.id_jabatan = p.id_jabatan GROUP BY id_dokumen ');
        if($result->num_rows() > 0){
            return $result->result_array();
        }
    }

    public function ambilRevisiDokumen($username) {
        $result = $this->db->query('SELECT d.id_dokumen, d.id_kategori_dokumen, d.kode_context, d.nomor_dokumen, d.nama_dokumen, e.no_edisi, r.id_revisi, r.no_revisi, DATE_FORMAT(r.tanggal_rilis, "%d-%m-%Y") as tanggal_rilis, f.id_file, f.path FROM file f, rekaman_revisi r, edisi e, dokumen d WHERE r.id_edisi = e.id_edisi AND e.id_dokumen = d.id_dokumen AND r.id_file = f.id_file AND d.pembuat = "'. $username. '"');
        if($result->num_rows() > 0){
            return $result->result_array();
        }
    }

    public function setKomentar($komentar, $id, $username)
    {
        $this->db->set('id_file', $id);
        $this->db->set('komentar', $komentar);
        $this->db->set('username', $username);
        $this->db->insert('komentar');
        $result = $this->db->query('SELECT u.nama, k.komentar, DATE_FORMAT(k.tanggal, "%d-%m-%Y %H:%i:%s") as tanggal, j.nama_jabatan FROM user u, komentar k, jabatan j WHERE k.username = u.username AND k.username = "'.$username.'" AND j.id_jabatan = u.id_jabatan ORDER BY k.id_komentar DESC LIMIT 1');

        if($result->num_rows() > 0){
            foreach ($result->result_array() as $row) {
                $data['nama'] = $row['nama'];
                $data['komentar'] = $row['komentar'];
                $data['tanggal'] = $row['tanggal'];
                $data['jabatan'] = $row['nama_jabatan'];
            }
            return $data;
        }
    }

    public function getKomentar($id)
    {
        $result = $this->db->query('SELECT k.komentar, DATE_FORMAT(k.tanggal, "%d-%m-%Y %H:%i:%s") as tanggal, j.nama_jabatan, u.nama FROM komentar k, user u, jabatan j WHERE k.username = u.username AND u.id_jabatan = j.id_jabatan AND k.id_file = '.$id.' ORDER BY k.id_komentar ASC');
        if($result->num_rows() > 0){
            return $result->result_array();
        }
    }

    public function getDetailRevisi($id)
    {
        $result = $this->db->query('SELECT d.halaman FROM detail_revisi d, revisi r WHERE d.id_revisi = r.id_revisi AND r.id_file = '.$id.' ORDER BY d.id_detail_revisi ASC');
        if($result->num_rows() > 0){
            $halaman='';
            foreach ($result->result_array() as $row) {
                $halaman = $halaman.$row['halaman'];
                $halaman = $halaman.' ';
            }
            return $halaman;
        }
    }

    public function getKeteranganRevisi($id)
    {
        $result = $this->db->query('SELECT r.keterangan FROM revisi r WHERE r.id_file = '.$id);
        if($result->num_rows() > 0){
            $keterangan ='';
            foreach ($result->result_array() as $row) {
                $keterangan = $row['keterangan'];
                $keterangan = $keterangan.'&#10;&#13;';
            }
            return $keterangan;
        }
    }

    public function update_data($tabel, $key, $kolom, $id, $data)
    {
        $result = $this->db->set($kolom, $data)->where($key, $id)->update($tabel);
        return $result;
    }
}
?>