<?php 
defined('BASEPATH') || exit('No direct script access allowed');

class Penjualan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mod_master');
        $this->load->model('Mod_transaksi');
    }

    function index() {
        $id_karyawan = $this->session->userdata('ses_id_karyawan');  
        $hak_akses = $this->session->userdata('ses_akses');  

        if($id_karyawan != null && $hak_akses == 'Kasir'){
            $data['pageTitle'] = "Penjualan";

            $data['data_penjualan'] = $this->Mod_transaksi->get_all_penjualan();
            $data['distributor'] = $this->Mod_master->get_all_distributor();
            $this->load->view("backend/kasir/penjualan/body",$data);
        }  
        else{ 
            redirect('login');
        }  
    }

    function detail($kode_penjualan){
        $id_karyawan = $this->session->userdata('ses_id_karyawan');  
        $hak_akses = $this->session->userdata('ses_akses');  

        if($id_karyawan != null && $hak_akses == 'Kasir'){
            $data['pageTitle'] = "Detail Penjualan";
            
            $data['data_detail'] = $this->Mod_transaksi->get_penjualan($kode_penjualan)->row_array();
            $data['list_produk'] = $this->Mod_transaksi->get_item_penjualan($kode_penjualan);

            $this->load->view("backend/kasir/penjualan/body_detail",$data);
        }
        else{ 
            redirect('login');
        }  
    }

    function invoice($kode_penjualan){
        $id_karyawan = $this->session->userdata('ses_id_karyawan');  
        $hak_akses = $this->session->userdata('ses_akses');  

        if($id_karyawan != null && $hak_akses == 'Kasir'){
            $data['pageTitle'] = "Invoice";
            
            $data['data_detail'] = $this->Mod_transaksi->get_penjualan($kode_penjualan)->row_array();
            $data['list_produk'] = $this->Mod_transaksi->get_item_penjualan($kode_penjualan);

            $this->load->view("backend/cetak_berkas/body_invoice_penjualan",$data);
        }
        else{ 
            redirect('login');
        }  

    }

    function load_data_item_penjualan(){
        $kode_penjualan = $this->input->post('kode_penjualan');
        $data['list_produk'] = $this->Mod_transaksi->get_item_penjualan($kode_penjualan);
        $this->load->view('backend/kasir/penjualan/load_data_item_penjualan', $data);
    }
}