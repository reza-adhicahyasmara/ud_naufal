<?php 
defined('BASEPATH') || exit('No direct script access allowed');

class Pemesanan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mod_master');
        $this->load->model('Mod_transaksi');
    }

    function index() {
        $id_distributor = $this->session->userdata('ses_id_distributor');   
        $hak_akses = $this->session->userdata('ses_akses');  

        if($id_distributor != null && $hak_akses == 'Distributor'){
            $data['pageTitle'] = "Pemesanan";

            $data['data_pemesanan'] = $this->Mod_transaksi->get_pemesanan_distributor($id_distributor);
            $this->load->view("backend/distributor/pemesanan/body",$data);
        }  
        else{ 
            redirect('login');
        }  
    }

    function detail($kode_pembelian){
        $id_distributor = $this->session->userdata('ses_id_distributor');   
        $hak_akses = $this->session->userdata('ses_akses');  

        if($id_distributor != null && $hak_akses == 'Distributor'){
            $data['pageTitle'] = "Detail Pemesanan";
            
            $data['data_detail'] = $this->Mod_transaksi->get_pemesanan($kode_pembelian)->row_array();
            $data['list_produk'] = $this->Mod_transaksi->get_item_pemesanan($kode_pembelian);

            $this->load->view("backend/distributor/pemesanan/body_detail",$data);
        }
        else{ 
            redirect('login');
        }  
    }

    function invoice($kode_pembelian){
        $id_distributor = $this->session->userdata('ses_id_distributor');   
        $hak_akses = $this->session->userdata('ses_akses');  

        if($id_distributor != null && $hak_akses == 'Distributor'){
            $data['pageTitle'] = "Invoice";
            
            $data['data_detail'] = $this->Mod_transaksi->get_pemesanan($kode_pembelian)->row_array();
            $data['list_produk'] = $this->Mod_transaksi->get_item_pemesanan($kode_pembelian);

            $this->load->view("backend/cetak_berkas/body_invoice_pemesanan",$data);
        }
        else{ 
            redirect('login');
        }  

    }

    function load_data_item_pemesanan(){
        $kode_pembelian = $this->input->post('kode_pembelian');
        $data['total_pby_pembelian'] = $this->input->post('total_pby_pembelian');
        $data['status_pembelian'] = $this->input->post('status_pembelian');
        $data['list_produk'] = $this->Mod_transaksi->get_item_pemesanan($kode_pembelian);
        $this->load->view('backend/distributor/pemesanan/load_data_item_pemesanan', $data);
    }

    function update_status_ipemesanan(){
        $kode_ipembelian = $this->input->post('kode_ipembelian');
        $status_ipembelian = "Siap Kirim";

        echo 1;         

        $save  = array( 
            'kode_ipembelian'                   => $kode_ipembelian,
            'status_ipembelian'                 => $status_ipembelian
        );
                    
        $this->Mod_transaksi->update_item_pemesanan($kode_ipembelian, $save);       
    }

    function update_pemesanan(){
        $kode_pembelian = $this->input->post('kode_pembelian');
        $status_pembelian = $this->input->post('status_pembelian');
        $status_pby_pembelian = $this->input->post('status_pby_pembelian');
        $keterangan_pembelian = $this->input->post('keterangan_pembelian');

        $cek_status_item = $this->Mod_transaksi->cek_item_produk_retur($kode_pembelian);  

        if($status_pembelian == 4){
            
            $cek_status = $this->Mod_transaksi->cek_proses_packing($kode_pembelian);
            if($cek_status->num_rows() > 0){
                echo "Pastikan status produk dan ketersediaan produk sudah dipersiapkan dengan baik";
            }else{
                
                echo 1;       
                $save  = array( 
                    'kode_pembelian'           => $kode_pembelian,
                    'status_pembelian'         => $status_pembelian,
                    'status_pby_pembelian'     => $status_pby_pembelian,
                    'keterangan_pembelian'     => $keterangan_pembelian
                );
                $this->Mod_transaksi->update_pemesanan($kode_pembelian, $save);  

                $item1 = $this->Mod_transaksi->get_item_pemesanan($kode_pembelian)->result();
                foreach($item1 as $row){
                    $kode_produk = $row->kode_produk;
                    $qty_ipembelian = $row->qty_ipembelian;

                    $currentStok = $this->Mod_transaksi->getValueOfTable("produk","stok_dis_produk",array("kode_produk" => $kode_produk));

                    $data_update_stok[] = array(
                        "kode_produk" => $kode_produk,
                        "stok_dis_produk" => $currentStok - $qty_ipembelian
                    );

                    $this->db->update_batch("produk",$data_update_stok,"kode_produk");
                }

                $item2 = $this->Mod_transaksi->get_all_item_pemesanan()->result();
                foreach($item2 as $row){
                    if($row->kode_pembelian == $kode_pembelian && "Siap Kirim" ){
                        $kode_ipembelian = $row->kode_ipembelian;
                        
                        $data = array(
                            'kode_ipembelian'         => $kode_ipembelian,
                            'status_ipembelian'       => 'Dikirim'
                        );
                        
                        $this->Mod_transaksi->update_item_pemesanan($kode_ipembelian, $data); 
                    }
                }
            }
        }
        elseif($status_pembelian == 7){
            if($cek_status_item->num_rows() > 0){  
                echo "Pastikan item sudah diretur";   
            }else{
                echo 1;         
                $save  = array( 
                    'kode_pembelian'          => $kode_pembelian,
                    'status_pembelian'        => "4"
                );   
                $this->Mod_transaksi->update_pemesanan($kode_pembelian, $save);  
            }             
        }else{
            echo 1;  
            $save  = array( 
                'kode_pembelian'              => $kode_pembelian,
                'status_pembelian'            => $status_pembelian,
                'status_pby_pembelian'        => $status_pby_pembelian,
                'keterangan_pembelian'        => $keterangan_pembelian
            );    
            $this->Mod_transaksi->update_pemesanan($kode_pembelian, $save);  
        }
          
    }
}