<?php 
defined('BASEPATH') || exit('No direct script access allowed');

class Penawaran extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('Mod_master');
        $this->load->model('Mod_transaksi');
    }

    function index() {
        $id_karyawan = $this->session->userdata('ses_id_karyawan');  
        $hak_akses = $this->session->userdata('ses_akses');  

        if($id_karyawan != null && $hak_akses == 'Admin'){
            $data['pageTitle'] = "Data Penawaran";

            $data['penawaran'] = $this->Mod_master->get_all_penawaran_distributor();
            $this->load->view("backend/admin/penawaran/body",$data);
        }  
        else{ 
            redirect('login');
        }  
    }

    //PENAWARAN
    function load_data_penawaran(){
        $data['penawaran'] = $this->Mod_master->get_all_penawaran_distributor();
        $this->load->view('backend/admin/penawaran/load_penawaran', $data);
    }

    function form_produk(){
        $aaa = explode("|",$this->input->post('aaa'));
        
        $data['kode_penawaran'] = $aaa[0];
        $data['berkas_penawaran'] = $aaa[1];
        
        $data['produk'] = $this->Mod_master->get_all_produk($aaa[0]);
        $this->load->view("backend/admin/penawaran/form_produk", $data);
    }
    
    function update_produk(){
        $aaa = explode("|",$this->input->post('status_penawaran_produk'));
        $kode_produk = $aaa[0];
        $status_penawaran_produk = $aaa[1];
        echo $status_penawaran_produk;  

        $save  = array( 
            'kode_produk'                => $kode_produk,
            'status_penawaran_produk'    => $status_penawaran_produk,
            'tanggal_produk'             => date('Y-m-d'),
            'perubahan_produk'           => 'Baru',

        );

        $this->Mod_master->update_produk($kode_produk, $save);    
    }

    function update_penawaran(){
        $kode_penawaran = $this->input->post('kode_penawaran');
        $status_penawaran = 2;
        
        $cek_item1 = $this->Mod_master->cek_produk_penawaran($kode_penawaran);
        if($cek_item1->num_rows() > 0){ 
            echo "Ada item yang belum diproses";
        } else {
            
            echo 1;
            $save  = array(
                'kode_penawaran'         => $kode_penawaran, 
                'status_penawaran'       => $status_penawaran
            );
            $this->Mod_master->update_penawaran($kode_penawaran, $save);  
        }
                    
    }
}
