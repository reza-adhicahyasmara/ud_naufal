<?php 
defined('BASEPATH') || exit('No direct script access allowed');
class Distributor extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mod_master');
        $this->load->model('Mod_transaksi');
    }

    function index() {
        $id_karyawan = $this->session->userdata('ses_id_karyawan');  
        $hak_akses = $this->session->userdata('ses_akses');  

        if($id_karyawan != null && $hak_akses == 'Pemilik'){
            $data['pageTitle'] = "Distributor";
            $this->load->view("backend/pemilik/distributor/body",$data);
        }
        else{ 
            redirect('login');
        }  
    }

    function load_data_distributor(){
        $data['distributor'] = $this->Mod_master->get_all_distributor();
        $this->load->view('backend/pemilik/distributor/load_distributor', $data);
    }
    
    
}
