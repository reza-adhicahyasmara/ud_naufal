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
            $data_produk = $this->Mod_master->get_produk_distributor($id_distributor);

            $total_proses_penawaran = 0;
            $total_terima_penawaran = 0;
            $total_menunggu_pembayaran = 0;
            $total_validasi_pembayaran = 0;
            $total_dalam_pengiriman = 0;
            $total_penjualan = 0;


            foreach($data_produk->result() as $row) {
                if($row->status_penawaran_produk == "Ditawarkan"){
                    $total_proses_penawaran += 1;
                }
                if($row->status_penawaran_produk == "Diterima"){
                    $total_terima_penawaran += 1;
                }
            }

            foreach($this->Mod_transaksi->get_pemesanan_distributor($id_distributor)->result() as $row) {
                if($row->status_pembelian == 1){
                    $total_menunggu_pembayaran += 1;
                } elseif($row->status_pembelian == 2){
                    $total_validasi_pembayaran += 1;
                } elseif($row->status_pembelian == 4){
                    $total_dalam_pengiriman += 1;
                } elseif($row->status_pembelian == 5){
                    $total_penjualan += $row->total_pby_pembelian;
                }
            }

            $data['data_produk'] = $data_produk;
            $data['total_proses_penawaran'] = $total_proses_penawaran;
            $data['total_terima_penawaran'] = $total_terima_penawaran;
            $data['total_menunggu_pembayaran'] = $total_menunggu_pembayaran;
            $data['total_validasi_pembayaran'] = $total_validasi_pembayaran;
            $data['total_dalam_pengiriman'] = $total_dalam_pengiriman;
            $data['total_penjualan'] = $total_penjualan;
           
            $data['pageTitle'] = "Dashboard";
            $this->load->view("backend/distributor/dashboard/body",$data);
        }
        else{ 
            redirect('login');
        }  
    }
}