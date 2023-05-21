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

        if($id_karyawan != null && $hak_akses == 'Admin'){
            $data['pageTitle'] = "Stok Produk Masuk";

            $data['aaa'] = $this->Mod_transaksi->get_all_pemesanan();
            $this->load->view("backend/admin/produk_masuk/body",$data);
        }  
        else{ 
            redirect('login');
        }
    }

    function load_data_pengiriman_produk(){
        $kode_pembelian = $this->input->post('kode_pembelian');
        $data['kode_pembelian'] = $this->input->post('kode_pembelian');
        $data['pengiriman_produk'] = $this->Mod_transaksi->get_item_pemesanan($kode_pembelian);
        $this->load->view('backend/admin/produk_masuk/load_pengiriman_produk', $data);
    }

    function load_data_produk_masuk(){
        $data['produk_masuk'] = $this->Mod_transaksi->get_all_item_pemesanan();
        $this->load->view('backend/admin/produk_masuk/load_produk_masuk', $data);
    }

    function update_status_ipembelian(){
        $kode_ipembelian = $this->input->post('kode_ipembelian');
        $status_ipembelian = $this->input->post('status_ipembelian');
        $qty_ipembelian = $this->input->post('qty_ipembelian');
        $qty_retur_ipembelian = $this->input->post('qty_retur_ipembelian');
        $keterangan_retur_ipembelian = $this->input->post('keterangan_retur_ipembelian');
        $gambar_retur_ipembelian = $this->input->post('gambar_retur_ipembelian');

        $config['upload_path'] = './assets/img/retur_produk';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['image_library'] = 'gd2';
        $config['maintain_ratio'] = TRUE;
        $config['width'] = 500;
        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
        $this->upload->initialize($config);

        if($status_ipembelian == "Retur"){
            if($qty_retur_ipembelian <= $qty_ipembelian){
                if($this->upload->do_upload('file')){  
                    if( $gambar_retur_ipembelian != ""){
                        unlink('assets/img/retur_produk/'.$gambar_retur_ipembelian);
                    }
    
                    $data = array('upload_data' => $this->upload->data());
                    $gambar_retur_ipembelian = $data['upload_data']['file_name'];
                    echo 1;
                    $data1 = array(
                        'kode_ipembelian'                 => $kode_ipembelian,
                        'tanggal_retur_ipembelian'        => date("Y-m-d H:m:s"),
                        'status_ipembelian'               => $status_ipembelian,
                        'qty_retur_ipembelian'            => $qty_retur_ipembelian,
                        'keterangan_retur_ipembelian'     => $keterangan_retur_ipembelian,
                        'gambar_retur_ipembelian'         => $gambar_retur_ipembelian,
                        'status_retur_ipembelian'         => "Retur"
                    );
    
                    $this->Mod_transaksi->update_item_pemesanan($kode_ipembelian, $data1); 
                }else{
                    echo "Gambar harus diisi.";
                }
            }else{
                echo "Melebihi qty pembelian";
            }
        }else{
            
            if($gambar_retur_ipembelian != ""){
                unlink('assets/img/retur_produk/'.$gambar_retur_ipembelian);
                $gambar_retur_ipembelian = "";
                $keterangan_retur_ipembelian = "";
            }

            echo 1;
            $data1 = array(
                'kode_ipembelian'                 => $kode_ipembelian,
                'status_ipembelian'               => $status_ipembelian,
                'qty_retur_ipembelian'            => $qty_retur_ipembelian,
                'keterangan_retur_ipembelian'     => $keterangan_retur_ipembelian,
                'gambar_retur_ipembelian'         => $gambar_retur_ipembelian
            );

            $this->Mod_transaksi->update_item_pemesanan($kode_ipembelian, $data1); 

        }
    }
    
    function update_pemesanan(){
        $kode_pembelian = $this->input->post('kode_pembelian');
        $status_pembelian = 5;
        $tanggal_masuk = date("Y-m-d H:m:s");

        $cek_kirim_item = $this->Mod_transaksi->cek_item_produk_kirim($kode_pembelian);

        
        if($cek_kirim_item->num_rows() > 0){
            echo "Pastikan item sudah diproses";
        }else{

            echo 1;         
            $save  = array( 
                'kode_pembelian'                  => $kode_pembelian,
                'tanggal_penerimaan_pembelian'    => $tanggal_masuk,
                'status_pembelian'                => $status_pembelian
            );
                        
            $this->Mod_transaksi->update_pemesanan($kode_pembelian, $save);        

            $item = $this->Mod_transaksi->get_item_pemesanan($kode_pembelian)->result();

            //PENAMBAHAN SESUAI DENGAN STOK SDENGAN STATUS ipembelian SELESAI
            foreach($item as $row){

                $kode_produk = $row->kode_produk;

                $currentStok = $this->Mod_transaksi->getValueOfTable("produk","stok_tok_produk",array("kode_produk" => $kode_produk));

                $data_update_stok[] = array(
                    "kode_produk" => $kode_produk,
                    "stok_tok_produk" => $currentStok + $row->qty_ipembelian - $row->qty_retur_ipembelian
                );

                $data_update_status[] = array(
                    "kode_ipembelian" => $row->kode_ipembelian,
                    "tanggal_masuk_ipembelian" =>  $tanggal_masuk
                );

                $this->db->update_batch("produk",$data_update_stok,"kode_produk");
                $this->db->update_batch("ipembelian",$data_update_status,"kode_ipembelian");
                
            }
        }
    }

}
