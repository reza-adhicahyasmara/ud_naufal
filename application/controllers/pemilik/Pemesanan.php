<?php 
defined('BASEPATH') || exit('No direct script access allowed');

class Pemesanan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mod_master');
        $this->load->model('Mod_transaksi');
    }

    function index() {
        $id_karyawan = $this->session->userdata('ses_id_karyawan');  
        $hak_akses = $this->session->userdata('ses_akses');  

        if($id_karyawan != null && $hak_akses == 'Pemilik'){
            $data['pageTitle'] = "Pemesanan";

            $data['data_pemesanan'] = $this->Mod_transaksi->get_all_pemesanan();
            $data['distributor'] = $this->Mod_master->get_all_distributor();
            $this->load->view("backend/pemilik/pemesanan/body",$data);
        }  
        else{ 
            redirect('login');
        }  
    }

    function detail($kode_pembelian){
        $id_karyawan = $this->session->userdata('ses_id_karyawan');  
        $hak_akses = $this->session->userdata('ses_akses');  

        if($id_karyawan != null && $hak_akses == 'Pemilik'){
            $data['pageTitle'] = "Detail Pemesanan";
            
            $data['data_detail'] = $this->Mod_transaksi->get_pemesanan($kode_pembelian)->row_array();
            $data['list_produk'] = $this->Mod_transaksi->get_item_pemesanan($kode_pembelian);

            $this->load->view("backend/pemilik/pemesanan/body_detail",$data);
        }
        else{ 
            redirect('login');
        }  
    }

    function invoice($kode_pembelian){
        $id_karyawan = $this->session->userdata('ses_id_karyawan');  
        $hak_akses = $this->session->userdata('ses_akses');  

        if($id_karyawan != null && $hak_akses == 'Pemilik'){
            $data['pageTitle'] = "Invoice";
            
            $data['data_detail'] = $this->Mod_transaksi->get_pemesanan($kode_pembelian)->row_array();
            $data['list_produk'] = $this->Mod_transaksi->get_item_pemesanan($kode_pembelian);

            $this->load->view("backend/cetak_berkas/body_invoice_pemesanan",$data);
        }
        else{ 
            redirect('login');
        }  

    }

    function load_data_item_pembelian(){
        $kode_pembelian = $this->input->post('kode_pembelian');
        $data['total_pby_pembelian'] = $this->input->post('total_pby_pembelian');
        $data['list_produk'] = $this->Mod_transaksi->get_item_pemesanan($kode_pembelian);
        $this->load->view('backend/pemilik/pemesanan/load_data_item_pembelian', $data);
    }



}