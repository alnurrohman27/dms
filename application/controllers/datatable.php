<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Datatable extends CI_Controller {
    public function manajemen_dokumen()
    {   
        //Load our library EditorLib 
        $this->load->library('EditorLib');
         
        //`Call the process method to process the posted data
        $out = $this->editorlib->process($_POST);
    }
    public function berbagi_dokumen()
    {   
        //Load our library EditorLib 
        $this->load->library('EditorLib');
         
        //`Call the process method to process the posted data
        $out = $this->editorlib->berbagi($_POST);
    }
}
?>