<?php 
defined('BASEPATH') || exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mod_master');
        $this->load->model('Mod_transaksi');
    }

    function index() {
        $id_distributor = $this->session->userdata('ses_id_distributor');   
        $hak_akses = $this->session->userdata('ses_akses');  

        if($id_distributor != null && $hak_akses == 'Distributor'){

            $data['produk'] = $this->Mod_master->get_all_produk();
           
            $data['pageTitle'] = "Dashboard";
            $this->load->view("backend/distributor/dashboard/body",$data);
        }
        else{ 
            redirect('login');
        }  
    }
}