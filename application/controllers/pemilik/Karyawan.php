<?php 
defined('BASEPATH') || exit('No direct script access allowed');

class Karyawan extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('Mod_master');
        $this->load->model('Mod_transaksi');
    }

    function index(){
        $id_karyawan = $this->session->userdata('ses_id_karyawan');  
        $hak_akses = $this->session->userdata('ses_akses');  

        if($id_karyawan != null && $hak_akses == 'Pemilik'){
            $data['pageTitle'] = "karyawan";
            $this->load->view("backend/pemilik/karyawan/body",$data);
        }
        else{ 
            redirect('login');
        }  
    }

    function load_data_admin(){
        $data['admin'] = $this->Mod_master->get_all_karyawan();
        $this->load->view('backend/pemilik/karyawan/load_admin', $data);
    }

    function load_data_kasir(){
        $data['kasir'] = $this->Mod_master->get_all_karyawan();
        $this->load->view('backend/pemilik/karyawan/load_kasir', $data);
    }

    function load_data_pemilik(){
        $data['pemilik'] = $this->Mod_master->get_all_karyawan();
        $this->load->view('backend/pemilik/karyawan/load_pemilik', $data);
    }
}
