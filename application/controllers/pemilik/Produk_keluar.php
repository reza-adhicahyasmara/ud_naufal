<?php 
defined('BASEPATH') || exit('No direct script access allowed');

class Produk_keluar extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Mod_master');
        $this->load->model('Mod_transaksi');
    }

    function index() {
        $id_karyawan = $this->session->userdata('ses_id_karyawan');  
        $hak_akses = $this->session->userdata('ses_akses');  

        if($id_karyawan != null && $hak_akses == 'Pemilik'){
            $data['pageTitle'] = "Stok Produk Keluar";

            $this->load->view("backend/pemilik/produk_keluar/body",$data);
        }
        else{ 
            redirect('login');
        }  
    }

    function load_data_produk_keluar(){
        $data['produk_keluar'] = $this->Mod_transaksi->get_all_item_penjualan();
        $this->load->view('backend/pemilik/produk_keluar/load_data_produk_keluar', $data);
    }
    
}
