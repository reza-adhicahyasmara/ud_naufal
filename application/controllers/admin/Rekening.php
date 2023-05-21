<?php 
defined('BASEPATH') || exit('No direct script access allowed');

class Rekening extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('Mod_master');
        $this->load->model('Mod_transaksi');
    }

    function index() {
        $id_karyawan = $this->session->userdata('ses_id_karyawan');  
        $hak_akses = $this->session->userdata('ses_akses');  

        if($id_karyawan != null && $hak_akses == 'Admin'){
            $data['pageTitle'] = "Data Rekening";

            $this->load->view("backend/admin/rekening/body",$data);
        }  
        else{ 
            redirect('login');
        }  
    }

    function load_data_rekening(){
        $data['rekening'] = $this->Mod_master->get_all_rekening();
        $this->load->view('backend/admin/rekening/load_rekening', $data);
    }

    function form_tambah_rekening(){
        $data['bank'] = $this->Mod_master->get_all_bank();
        $this->load->view("backend/admin/rekening/form_tambah_rekening", $data);
    }

    function form_edit_rekening(){
        $kode_rekening = $this->input->post('kode_rekening');
        $data['bank'] = $this->Mod_master->get_all_bank();
		$data['edit'] = $this->Mod_master->get_rekening($kode_rekening)->row_array();
        $this->load->view("backend/admin/rekening/form_edit_rekening", $data);
    }

    function tambah_edit_rekening(){
        $jenis = $this->input->post('jenis');
        $kode_rekening = $this->input->post('kode_rekening');
        $kode_bank = $this->input->post('kode_bank');  
        $an_rekening = $this->input->post('an_rekening');
        $no_rekening = $this->input->post('no_rekening');
        
        $data  = array(
            'kode_rekening'     => $kode_rekening,
            'id_distributor'    => "",
            'kode_bank'         => $kode_bank,
            'an_rekening'       => $an_rekening,        
            'no_rekening'       => $no_rekening,        
        );

        if($jenis == "Tambah"){
            echo 1;     
            $this->Mod_master->insert_rekening($data);  
        }  

        elseif($jenis == "Edit"){
            echo 1;
            $this->Mod_master->update_rekening($kode_rekening, $data);   
        }  
    }

    function hapus_rekening(){
        $kode_rekening = $this->input->post('kode_rekening');
        $this->Mod_master->delete_rekening($kode_rekening);
    } 
}
