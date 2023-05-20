<?php 
defined('BASEPATH') || exit('No direct script access allowed');

class Kategori extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('Mod_master');
        $this->load->model('Mod_transaksi');
    }

    function index() {
        $id_karyawan = $this->session->userdata('ses_id_karyawan');  
        $hak_akses = $this->session->userdata('ses_akses');  

        if($id_karyawan != null && $hak_akses == 'Admin'){
            $data['pageTitle'] = "Kategori";
            $this->load->view("backend/admin/kategori/body",$data);
        }
        else{ 
            redirect('login');
        }  
    }

    function load_data_kategori(){
        $data['kategori'] = $this->Mod_master->get_all_kategori();
        $this->load->view('backend/admin/kategori/load_kategori', $data);
    }
    
    function form_tambah_kategori(){
        $this->load->view("backend/admin/kategori/form_tambah_kategori", NULL);
    }

    function form_edit_kategori(){
        $kode_kategori = $this->input->post('kode_kategori');
		$data['edit'] = $this->Mod_master->get_kategori($kode_kategori)->row_array();
		$this->load->view("backend/admin/kategori/form_edit_kategori", $data);
    }

    function tambah_edit_kategori(){ 
        $jenis = $this->input->post('jenis');
        $kode_kategori_baru = $this->input->post('kode_kategori_baru');
        $kode_kategori_lama = $this->input->post('kode_kategori_lama');
        $nama_kategori = $this->input->post('nama_kategori');

        $cek_kode = $this->Mod_master->get_kategori($kode_kategori_baru);

        if($jenis == "Tambah"){
            
            if($cek_kode->num_rows() > 0){
                echo "Kode kategori sudah ada..!!";
            }
            else{
                echo 1;    
                $data  = array(
                    'kode_kategori'             => $kode_kategori_baru,
                    'nama_kategori'             => $nama_kategori,         
                );      
                $this->Mod_master->insert_kategori($data);      
            }            
        }

        elseif($jenis == "Edit"){
            
            if($kode_kategori_baru == $kode_kategori_lama){

                echo 1;
                $data  = array(
                    'kode_kategori'             => $kode_kategori_baru,
                    'nama_kategori'             => $nama_kategori,         
                );  
                $this->Mod_master->update_kategori($kode_kategori_lama, $data); 
            }else{
                
                if($cek_kode->num_rows() > 0){
                    echo "Kode kategori sudah ada..!!";
                }else{
                    echo 1;
                    $data  = array(
                        'kode_kategori'             => $kode_kategori_baru,
                        'nama_kategori'             => $nama_kategori,         
                    );  
                    $this->Mod_master->update_kategori($kode_kategori_lama, $data); 
                }
            }
        }
    }

    function hapus_kategori(){
        $kode_kategori = $this->input->post('kode_kategori');
        $this->Mod_master->delete_kategori($kode_kategori);
    } 

}
