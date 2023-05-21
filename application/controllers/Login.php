<?php 
defined('BASEPATH') || exit('No direct script access allowed');

class Login extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model(array('Mod_master')); 
    }

    public function index(){   
        $this->load->view('backend/login'); 
    }

    
    public function proses(){   
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $auth_karyawan = $this->Mod_master->auth_karyawan($username, $password);
        $auth_distributor = $this->Mod_master->auth_distributor($username, $password);

        if($auth_karyawan->num_rows() > 0){
            $data=$auth_karyawan->row_array();
            $this->session->set_userdata('masuk',TRUE);
            $this->session->set_userdata('ses_akses',$data['level_karyawan']);
            $this->session->set_userdata('ses_id_karyawan',$data['id_karyawan']);
            if($data['level_karyawan']=='Admin'){
                echo "admin/dashboard";
            }
            elseif($data['level_karyawan']=='Pemilik'){ 
                echo "pemilik/dashboard";
            } 
        }  
        elseif($auth_distributor->num_rows() > 0){
            $data=$auth_distributor->row_array();
            $this->session->set_userdata('masuk',TRUE);
            $this->session->set_userdata('ses_akses','Distributor');
            $this->session->set_userdata('ses_id_distributor',$data['id_distributor']);
            $this->session->set_userdata('ses_nama_distributor',$data['nama_distributor']);
            $this->session->set_userdata('ses_alamat_distributor',$data['alamat_distributor']);
            $this->session->set_userdata('ses_kontak_distributor',$data['kontak_distributor']);
            $this->session->set_userdata('ses_foto_distributor',$data['foto_distributor']);
            $this->session->set_userdata('ses_username_distributor',$data['username_distributor']);
            $this->session->set_userdata('ses_password_distributor',$data['password_distributor']);     
            echo "distributor/dashboard";
        }  
        else{
            echo "1";
        }
    }
    
	
    public function logout(){
        $this->session->sess_destroy();
        redirect('login');
    }

}