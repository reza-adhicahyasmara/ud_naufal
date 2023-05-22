<?php 
defined('BASEPATH') || exit('No direct script access allowed');

class Penawaran extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('Mod_master');
        $this->load->model('Mod_transaksi');
    }

    function index() {
        $id_karyawan = $this->session->userdata('ses_id_karyawan');  
        $hak_akses = $this->session->userdata('ses_akses');  

        if($id_karyawan != null && $hak_akses == 'Pemilik'){
            $data['pageTitle'] = "Data Penawaran";

            $data['penawaran'] = $this->Mod_master->get_all_penawaran_distributor();
            $this->load->view("backend/pemilik/penawaran/body",$data);
        }  
        else{ 
            redirect('login');
        }  
    }

    //PENAWARAN
    function load_data_penawaran(){
        $data['penawaran'] = $this->Mod_master->get_all_penawaran_distributor();
        $this->load->view('backend/pemilik/penawaran/load_penawaran', $data);
    }

    function form_produk(){
        $aaa = explode("|",$this->input->post('aaa'));
        
        $data['kode_penawaran'] = $aaa[0];
        $data['berkas_penawaran'] = $aaa[1];
        
        $data['produk'] = $this->Mod_master->get_all_produk($aaa[0]);
        $this->load->view("backend/pemilik/penawaran/form_produk", $data);
    }

}
