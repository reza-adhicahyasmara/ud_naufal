<?php 
defined('BASEPATH') || exit('No direct script access allowed');

class Profil extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('Mod_master');
        $this->load->model('Mod_transaksi');
    }

    function index(){
        $id_distributor = $this->session->userdata('ses_id_distributor');   
        $hak_akses = $this->session->userdata('ses_akses');  

        if($id_distributor != null && $hak_akses == 'Distributor'){
            $data['pageTitle'] = "Profil Saya";
 
		    $data['edit'] = $this->Mod_master->get_distributor($id_distributor)->row_array();

            $this->load->view("backend/distributor/profil/body_profil",$data);
        } 
        else{ 
            redirect('login');
        }   
    }

    function ubah_password(){
        $id_distributor = $this->session->userdata('ses_id_distributor');   
        $hak_akses = $this->session->userdata('ses_akses');  

        if($id_distributor != null && $hak_akses == 'Distributor'){
            $data['pageTitle'] = "Ubah Password";
 
		    $data['edit'] = $this->Mod_master->get_distributor($id_distributor)->row_array();

            $this->load->view("backend/distributor/profil/body_password",$data);
        }  
        else{ 
            redirect('login');
        }   
    }

    function edit_distributor(){
        $id_distributor = $this->input->post('id_distributor');
        $pic_distributor = $this->input->post('pic_distributor');
        $alamat_distributor = $this->input->post('alamat_distributor');
        $kontak_distributor = $this->input->post('kontak_distributor');
        $username_distributor_baru = $this->input->post('username_distributor_baru');
        $username_distributor = $this->input->post('username_distributor');
        
        $config['upload_path'] = './assets/img/distributor/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['image_library'] = 'gd2';
        $config['maintain_ratio'] = TRUE;
        $config['width'] = 500;

        $this->upload->initialize($config);
        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
              
        if($username_distributor_baru == $username_distributor){
            if($this->upload->do_upload('file')){      
                $foto_distributor_lama = $this->input->post('foto_distributor_lama'); 
                if($foto_distributor_lama != NULL){ 
                    unlink('assets/img/distributor/'.$foto_distributor_lama);
                }
    
                $data = array('upload_data' => $this->upload->data());
                $foto_distributor = $data['upload_data']['file_name'];
            }else{
                $foto_distributor = $this->input->post('foto_distributor_lama');
            }

            echo 1;
            $data  = array( 
                'id_distributor'           => $id_distributor,
                'pic_distributor'          => $pic_distributor,
                'alamat_distributor'       => $alamat_distributor,
                'kontak_distributor'       => $kontak_distributor,
                'username_distributor'     => $username_distributor_baru,
                'foto_distributor'         => $foto_distributor
            );
            $this->Mod_master->update_distributor($id_distributor, $data);        

        }elseif($username_distributor_baru != $username_distributor){
            $cek_username = $this->Mod_master->get_username_distributor($username_distributor);
            if($cek_username->num_rows() > 0){
                echo "Username sudah digunakan";
            }else{
                if($this->upload->do_upload('file')){      
                    $foto_distributor_lama = $this->input->post('foto_distributor_lama'); 
                    if($foto_distributor_lama != NULL){ 
                        unlink('assets/img/distributor/'.$foto_distributor_lama);
                    }
        
                    $data = array('upload_data' => $this->upload->data());
                    $foto_distributor = $data['upload_data']['file_name'];
                }else{
                    $foto_distributor = $this->input->post('foto_distributor_lama');
                }
                
                echo 1;
                $data  = array( 
                    'id_distributor'           => $id_distributor,
                    'pic_distributor'          => $pic_distributor,
                    'alamat_distributor'       => $alamat_distributor,
                    'kontak_distributor'       => $kontak_distributor,
                    'username_distributor'     => $username_distributor_baru,
                    'foto_distributor'         => $foto_distributor
                );
                $this->Mod_master->update_distributor($id_distributor, $data);      
            }
        }
        
    }
    
    function reset_password(){
        $nikuser = $this->input->post('username_distributor');
        $id_distributor = $this->input->post('id_distributor');
        $password = $this->input->post('password_lama');
        $password_baru_1 = $this->input->post('password_baru_1');
        $password_baru_2 = $this->input->post('password_baru_2');

        $cek_password = $this->Mod_master->auth_distributor($nikuser, $password);
        if($cek_password->num_rows() > 0){

            echo 1;
            $data  = array(
                'id_distributor'              => $id_distributor,
                'password_distributor'        => $password_baru_2
            );    
            $this->Mod_master->update_distributor($id_distributor, $data);

        } else {
            
            echo "Password lama salah..!";
        }
    }
}