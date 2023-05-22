<?php 
defined('BASEPATH') || exit('No direct script access allowed');

class Produk_masuk extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('Mod_master');
        $this->load->model('Mod_transaksi');
    }

    function index() {
        $id_karyawan = $this->session->userdata('ses_id_karyawan');  
        $hak_akses = $this->session->userdata('ses_akses');  

        if($id_karyawan != null && $hak_akses == 'Pemilik'){
            $data['pageTitle'] = "Stok Produk Masuk";

            $data['aaa'] = $this->Mod_transaksi->get_all_pemesanan();
            $this->load->view("backend/pemilik/produk_masuk/body",$data);
        }  
        else{ 
            redirect('login');
        }
    }

    function load_data_produk_masuk(){
        $data['produk_masuk'] = $this->Mod_transaksi->get_all_item_pemesanan();
        $this->load->view('backend/pemilik/produk_masuk/load_produk_masuk', $data);
    }
}