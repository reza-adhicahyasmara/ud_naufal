<?php 
defined('BASEPATH') || exit('No direct script access allowed');

class Produk extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Mod_master');
        $this->load->model('Mod_transaksi');
    }

    function index() {
        $id_karyawan = $this->session->userdata('ses_id_karyawan');  
        $hak_akses = $this->session->userdata('ses_akses');  

        if($id_karyawan != null && $hak_akses == 'Admin'){
            $data['pageTitle'] = "Data Produk";

            $this->load->view("backend/admin/produk/body",$data);
        }
        else{ 
            redirect('login');
        }  
    }

    function load_data_produk(){
        $data['produk'] = $this->Mod_master->get_all_produk();
        $this->load->view('backend/admin/produk/load_produk', $data);
    }
    
    function form_tambah_produk(){
        $data['kategori'] = $this->Mod_master->get_all_kategori();
        $data['distributor'] = $this->Mod_master->get_all_distributor();
        $this->load->view("backend/admin/produk/form_tambah_produk", $data);
    }

    function form_edit_produk(){
        $kode_produk = $this->input->post('kode_produk');
        $data['kategori'] = $this->Mod_master->get_all_kategori();
        $data['distributor'] = $this->Mod_master->get_all_distributor();
		$data['edit'] = $this->Mod_master->get_produk($kode_produk)->row_array();
		$this->load->view("backend/admin/produk/form_edit_produk", $data);
    }
    
    function tambah_edit_produk(){ 
        $kode_produk = $this->input->post('kode_produk');
        $limit_tok_produk = $this->input->post('limit_tok_produk');
        $harga_jual_produk = $this->input->post('harga_jual_produk');
        $d_produk = $this->input->post('d_produk');
        $h_produk = $this->input->post('h_produk');
        $lt_produk = $this->input->post('lt_produk');
        $ss_produk = $this->input->post('ss_produk');
        $tahun = 317;
        $au_produk = (float)$d_produk / (float)$tahun;

        echo 1;     
        $data_edit  = array( 
            'kode_produk'           => $kode_produk,
            'limit_tok_produk'      => $limit_tok_produk,
            'harga_jual_produk'     => $harga_jual_produk,
            'd_produk'              => $d_produk,
            'h_produk'              => $h_produk,
            'lt_produk'             => $lt_produk,
            'ss_produk'             => $ss_produk,
            'au_produk'             => $au_produk
        );

        $this->Mod_master->update_produk($kode_produk, $data_edit);       
               
    }
    
}
