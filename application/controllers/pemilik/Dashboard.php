<?php 
defined('BASEPATH') || exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mod_master');
        $this->load->model('Mod_transaksi');
    }

    function index() {
        $id_karyawan = $this->session->userdata('ses_id_karyawan');  
        $hak_akses = $this->session->userdata('ses_akses');  

        if($id_karyawan != null && $hak_akses == 'Pemilik'){

            $data['produk'] = $this->Mod_master->get_all_produk();
           
            $data['pageTitle'] = "Dashboard";
            $this->load->view("backend/pemilik/dashboard/body",$data);
        }
        else{ 
            redirect('login');
        }  
    }
}