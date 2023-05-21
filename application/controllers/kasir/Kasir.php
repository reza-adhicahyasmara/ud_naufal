<?php 
defined('BASEPATH') || exit('No direct script access allowed');

class Kasir extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mod_master');
        $this->load->model('Mod_transaksi');
    }

    function index(){
        $id_karyawan = $this->session->userdata('ses_id_karyawan');  
        $hak_akses = $this->session->userdata('ses_akses');  

        if($id_karyawan != null && $hak_akses == 'Kasir'){
            $data['pageTitle'] = "Kasir";
            $data['produk'] = $this->Mod_master->get_all_produk()->result();

            $this->load->view("backend/kasir/kasir/body",$data);
        }
        else{ 
            redirect('login');
        }  
    }



    //KERANJANG PRODUK

    function load_data_item_penjualan(){
        $data['list_produk'] = $this->Mod_transaksi->get_all_item_penjualan();
        $this->load->view('backend/kasir/kasir/load_data_item_penjualan', $data);
    }

    function form_tambah_produk(){
        $kode_produk = $this->input->post('kode_produk');
        $data['data'] = $this->Mod_master->get_produk($kode_produk)->row_array();
        $this->load->view("backend/kasir/kasir/form_tambah_produk", $data);
    }

    function insert_item_penjualan(){
        $kode_produk = $this->input->post('kode_produk');
        $qty_ipenjualan = $this->input->post('qty_ipenjualan');
        $harga_ipenjualan = $this->input->post('harga_ipenjualan');
        $stok_tok_produk = $this->input->post('stok_tok_produk');
        $subtotal_ipenjualan = $this->input->post('subtotal_ipenjualan');

        $cek_item1 = $this->Mod_transaksi->cek_item_penjualan($kode_produk);
        

        if($cek_item1->num_rows() > 0){ 
            echo "Produk sudah ada";
        }else if($kode_produk == ""){
            echo "Produk tidak boleh kosong";
        }else if($qty_ipenjualan == 0){
            echo "Qty tidak boleh kosong";
        }else if($qty_ipenjualan > $stok_tok_produk){
            echo "Qty melebihi stok gudang";
        }else{
            echo 1;
            $save  = array( 
                'kode_produk'           => $kode_produk,
                'qty_ipenjualan'        => $qty_ipenjualan,
                'harga_ipenjualan'      => $harga_ipenjualan,
                'subtotal_ipenjualan'   => $subtotal_ipenjualan,
                'status_ipenjualan'     => "Keranjang"
            );
            
            $this->Mod_transaksi->insert_item_penjualan($save);  
        }
    }

    function delete_item_penjualan(){
        $kode_ipenjualan = $this->input->post('kode_ipenjualan');
        $this->Mod_transaksi->delete_item_penjualan($kode_ipenjualan);
    } 

    

    //PENJUALAN PRODUK

    function insert_penjualan(){
        $cash_penjualan = $this->input->post('cash_penjualan');
        $nama_penjualan = $this->input->post('nama_penjualan');
        $total_penjualan = $this->input->post('total_penjualan');
        $keterangan_penjualan = $this->input->post('keterangan_penjualan');
        $tanggal_penjualan = date('Y-m-d H:m:s');
        $kode_penjualan = 'PNJ-'.date('YmdHms');
 
        echo 1;         
        $save  = array( 
            'kode_penjualan'            => $kode_penjualan,
            'cash_penjualan'            => $cash_penjualan,
            'nama_penjualan'            => $nama_penjualan,
            'total_penjualan'           => $total_penjualan,
            'tanggal_penjualan'         => $tanggal_penjualan,
            'keterangan_penjualan'      => $keterangan_penjualan
        );
                    
        $this->Mod_transaksi->insert_penjualan($save);        
        
        $item = $this->Mod_transaksi->get_all_item_penjualan()->result();
        

        //PENAMBAHAN SESUAI DENGAN STOK SDENGAN STATUS ipenjualan SELESAI
        foreach($item as $row){

            $kode_produk = $row->kode_produk;

            $currentStok = $this->Mod_transaksi->getValueOfTable("produk","stok_tok_produk",array("kode_produk" => $kode_produk));

            $data_update_stok[] = array(
                "kode_produk" => $kode_produk,
                "stok_tok_produk" => $currentStok - $row->qty_ipenjualan,
            );

            $data_update_status[] = array(
                'kode_ipenjualan'         => $row->kode_ipenjualan,
                'kode_penjualan'          => $kode_penjualan,
                'tanggal_ipenjualan'      => $tanggal_penjualan,
                'status_ipenjualan'       => '1'
            );

            $this->db->update_batch("produk",$data_update_stok,"kode_produk");
            $this->db->update_batch("ipenjualan",$data_update_status,"kode_ipenjualan");
            
        }
        
        
            
        
    }
    
}
