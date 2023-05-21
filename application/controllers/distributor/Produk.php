<?php 
defined('BASEPATH') || exit('No direct script access allowed');

class Produk extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mod_master');
        $this->load->model('Mod_transaksi');
    }

    function index() {
        $id_distributor = $this->session->userdata('ses_id_distributor');   
        $hak_akses = $this->session->userdata('ses_akses');  

        if($id_distributor != null && $hak_akses == 'Distributor'){
            $data['pageTitle'] = "Produk";

            $this->load->view("backend/distributor/produk/body",$data);
        }
        else{ 
            redirect('login');
        }  
    }

    function load_data_produk(){
        $data['produk'] = $this->Mod_master->get_all_produk();
        $this->load->view('backend/distributor/produk/load_produk', $data);
    }
    
    function form_tambah_produk(){
        $data['kategori'] = $this->Mod_master->get_all_kategori();
        $this->load->view("backend/distributor/produk/form_tambah_produk", $data);
    }

    function form_edit_produk(){
        $kode_produk = $this->input->post('kode_produk');
        
		$data['edit'] = $this->Mod_master->get_produk($kode_produk)->row_array();
        $data['kategori'] = $this->Mod_master->get_all_kategori();
        $this->load->view("backend/distributor/produk/form_edit_produk", $data);
    }

    function tambah_edit_produk(){
        $jenis = $this->input->post('jenis');
        $id_distributor = $this->session->userdata('ses_id_distributor');
        $kode_produk_baru = $this->input->post('kode_produk_baru');
        $kode_produk_lama = $this->input->post('kode_produk_lama');
        $kode_kategori = $this->input->post('kode_kategori');
        $nama_produk = $this->input->post('nama_produk');
        $satuan_produk = $this->input->post('satuan_produk');
        $harga_beli_produk_baru = $this->input->post('harga_beli_produk_baru');
        $harga_beli_produk_lama = $this->input->post('harga_beli_produk_lama');
        $stok_dis_produk = $this->input->post('stok_dis_produk');
        $limit_dis_produk = $this->input->post('limit_dis_produk');
        $tanggal_produk = $this->input->post('tanggal_produk');
        $perubahan_produk = $this->input->post('perubahan_produk');


        $config['upload_path'] = './assets/img/produk/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $this->upload->initialize($config);

        if($harga_beli_produk_lama == ""){
            $tanggal_produk = date('Y-m-d');
            $perubahan_produk = "Baru";
            $perubahan_harga_produk = 0;
        }
        elseif($harga_beli_produk_lama > $harga_beli_produk_baru){
            $tanggal_produk = date('Y-m-d');
            $perubahan_produk = "Harga Naik";
            $perubahan_harga_produk = $harga_beli_produk_lama - $harga_beli_produk_baru;
        }
        elseif($harga_beli_produk_lama < $harga_beli_produk_baru){
            $tanggal_produk = date('Y-m-d');
            $perubahan_produk = "Harga Turun";
            $perubahan_harga_produk = $harga_beli_produk_lama - $harga_beli_produk_baru;
        }
        elseif($harga_beli_produk_lama == $harga_beli_produk_baru){ 
            $tanggal_produk = $this->input->post('tanggal_produk');
            $perubahan_produk = $this->input->post('perubahan_produk');
            $perubahan_harga_produk = $harga_beli_produk_lama;
        }
        
        if($jenis == "Tambah"){
            
            $cek = $this->Mod_master->get_produk($kode_produk_baru);
            if($cek->num_rows() > 0){
                echo "Kode produk sudak ada..!!";
            }else{
                if($this->upload->do_upload('file')){  
                    $data = array('upload_data' => $this->upload->data());
                    $config['image_library'] = 'gd2';
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 500;
        
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();
                    $gambar_produk = $data['upload_data']['file_name'];
                }else{
                    $gambar_produk = NULL;  
                }
                
                echo 1;

                $data  = array( 
                    'id_distributor'            => $id_distributor,
                    'kode_produk'               => $kode_produk_baru,
                    'kode_kategori'             => $kode_kategori,
                    'nama_produk'               => $nama_produk,
                    'satuan_produk'             => $satuan_produk,
                    'harga_beli_produk'         => $harga_beli_produk_baru,
                    'stok_dis_produk'           => $stok_dis_produk,
                    'limit_dis_produk'          => $limit_dis_produk,
                    'gambar_produk'             => $gambar_produk,
                    'tanggal_produk'            => $tanggal_produk,
                    'perubahan_produk'          => $perubahan_produk,
                    'perubahan_harga_produk'    => $perubahan_harga_produk,
                    'status_penawaran_produk'   => "Baru",
                );

                $this->Mod_master->insert_produk($data);   
            }
        }
        elseif($jenis == "Edit"){
            if($this->upload->do_upload('file')){      
                $gambar_produk_lama = $this->input->post('gambar_produk_lama');  
                if($gambar_produk_lama != NULL){
                    unlink('assets/img/karyawan/'.$gambar_produk_lama);
                }

                $data = array('upload_data' => $this->upload->data());
                $config['image_library'] = 'gd2';
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 500;

                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                $gambar_produk = $data['upload_data']['file_name'];
            }else{
                $gambar_produk = $this->input->post('gambar_produk_lama');
            }

            $data  = array( 
                'id_distributor'            => $id_distributor,
                'kode_produk'               => $kode_produk_baru,
                'kode_kategori'             => $kode_kategori,
                'nama_produk'               => $nama_produk,
                'satuan_produk'             => $satuan_produk,
                'harga_beli_produk'         => $harga_beli_produk_baru,
                'stok_dis_produk'           => $stok_dis_produk,
                'limit_dis_produk'          => $limit_dis_produk,
                'gambar_produk'             => $gambar_produk,
                'tanggal_produk'            => $tanggal_produk,
                'perubahan_produk'          => $perubahan_produk,
                'perubahan_harga_produk'    => $perubahan_harga_produk,
            );

            echo 1;
                        
            $this->Mod_master->update_produk($kode_produk_lama, $data);   
        }
    }
    
}
