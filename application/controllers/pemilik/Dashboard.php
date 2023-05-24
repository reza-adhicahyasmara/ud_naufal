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
            $data_produk = $this->Mod_master->get_all_produk();

            $total_penawaran_produk = 0;
            $total_menunggu_pembayaran = 0;
            $total_validasi_pembayaran = 0;
            $total_dalam_pengiriman = 0;
            $total_pembelian = 0;
            $total_penjualan = 0;


            foreach($data_produk->result() as $row) {
                if($row->status_penawaran_produk == "Ditawarkan"){
                    $total_penawaran_produk += 1;
                }
            }

            foreach($this->Mod_transaksi->get_all_pemesanan()->result() as $row) {
                if($row->status_pembelian == 1){
                    $total_menunggu_pembayaran += 1;
                } elseif($row->status_pembelian == 2){
                    $total_validasi_pembayaran += 1;
                } elseif($row->status_pembelian == 4){
                    $total_dalam_pengiriman += 1;
                } elseif($row->status_pembelian == 5){
                    $total_pembelian += $row->total_pby_pembelian;
                }
            }

            foreach($this->Mod_transaksi->get_all_penjualan()->result() as $row) {
                $total_penjualan += $row->total_penjualan;
            }


            $data['data_produk'] = $data_produk;
            $data['total_penawaran_produk'] = $total_penawaran_produk;
            $data['total_menunggu_pembayaran'] = $total_menunggu_pembayaran;
            $data['total_validasi_pembayaran'] = $total_validasi_pembayaran;
            $data['total_dalam_pengiriman'] = $total_dalam_pengiriman;
            $data['total_pembelian'] = $total_pembelian;
            $data['total_penjualan'] = $total_penjualan;

            
           
            $data['pageTitle'] = "Dashboard";
            $this->load->view("backend/admin/dashboard/body",$data);
        }
        else{ 
            redirect('login');
        }  
    }
}