<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class EditorLib {
    private $CI = null;
     
    function __construct()
    {
        $this->CI = &get_instance();
    }   
 
    public function process($post)
    {   
        // DataTables PHP library
        require dirname(__FILE__).'/editor/php/DataTables.php';
         
        //Load the model which will give us our data
        $this->CI->load->model('M_dokumen');
         
        //Pass the database object to the model
        $this->CI->M_dokumen->init($db);
         
        //Let the model produce the data
        $this->CI->M_dokumen->ambilDokumen($post);
    }

    public function berbagi($post)
    {   
        // DataTables PHP library
        require dirname(__FILE__).'/editor/php/DataTables.php';
         
        //Load the model which will give us our data
        $this->CI->load->model('M_dokumen');
         
        //Pass the database object to the model
        $this->CI->M_dokumen->init($db);
         
        //Let the model produce the data
        $this->CI->M_dokumen->berbagiDokumen($post);
    }
}
?>