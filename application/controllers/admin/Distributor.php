<?php 
defined('BASEPATH') || exit('No direct script access allowed');
class Distributor extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mod_master');
        $this->load->model('Mod_transaksi');
    }

    function index() {
        $id_karyawan = $this->session->userdata('ses_id_karyawan');  
        $hak_akses = $this->session->userdata('ses_akses');  

        if($id_karyawan != null && $hak_akses == 'Admin'){
            $data['pageTitle'] = "Distributor";
            $this->load->view("backend/admin/distributor/body",$data);
        }
        else{ 
            redirect('login');
        }  
    }

    function load_data_distributor(){
        $data['distributor'] = $this->Mod_master->get_all_distributor();
        $this->load->view('backend/admin/distributor/load_distributor', $data);
    }
    
    function form_tambah_distributor(){
        $this->load->view("backend/admin/distributor/form_tambah_distributor", NULL);
    }

    function form_edit_distributor(){
        $id_distributor = $this->input->post('id_distributor');
		$data['edit'] = $this->Mod_master->get_distributor($id_distributor)->row_array();
		$this->load->view("backend/admin/distributor/form_edit_distributor", $data);
    }
    
    function tambah_edit_distributor(){ 
        $jenis = $this->input->post('jenis');
        $nama_distributor = $this->input->post('nama_distributor');
        $pic_distributor = $this->input->post('pic_distributor');
        $kontak_distributor = $this->input->post('kontak_distributor');
        $alamat_distributor = $this->input->post('alamat_distributor');
        $username_distributor_baru = $this->input->post('username_distributor_baru');
        $username_distributor_lama = $this->input->post('username_distributor_lama');
        $password_distributor = $this->input->post('password_distributor');

        $config['upload_path'] = './assets/img/distributor/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['image_library'] = 'gd2';
        $config['maintain_ratio'] = TRUE;
        $config['width'] = 500;

        $this->upload->initialize($config);
        $this->load->library('image_lib', $config);
        $this->image_lib->resize();

        $cek_username = $this->Mod_master->get_username_distributor($username_distributor_baru);

        if($jenis == "Tambah"){

            $id_distributor = md5($nama_distributor).date('Ymd');

            if($cek_username->num_rows() > 0){
                echo "Username sudah digunakan";
            }else{          
                echo 1;

                if($this->upload->do_upload('file')){  
                    $data = array('upload_data' => $this->upload->data());
                    $foto_distributor = $data['upload_data']['file_name'];
                }else{
                    $foto_distributor = NULL;  
                }

                $data  = array(
                    'id_distributor'           => $id_distributor,
                    'nama_distributor'         => $nama_distributor,
                    'pic_distributor'          => $pic_distributor,
                    'kontak_distributor'       => $kontak_distributor,
                    'alamat_distributor'       => $alamat_distributor,
                    'foto_distributor'         => $foto_distributor,
                    'username_distributor'     => $username_distributor_baru,
                    'password_distributor'     => $password_distributor            
                );
                            
                $this->Mod_master->insert_distributor($data);  
            }                 
        }
        
        elseif($jenis == "Edit"){
            
            $id_distributor = $this->input->post('id_distributor');

            if($username_distributor_lama == $username_distributor_baru){
                echo 1;         
                    
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

                $data  = array(
                    'id_distributor'           => $id_distributor,
                    'nama_distributor'         => $nama_distributor,
                    'pic_distributor'          => $pic_distributor,
                    'kontak_distributor'       => $kontak_distributor,
                    'alamat_distributor'       => $alamat_distributor,
                    'foto_distributor'         => $foto_distributor,
                    'username_distributor'     => $username_distributor_baru,
                    'password_distributor'     => $password_distributor            
                );
                
                $this->Mod_master->update_distributor($id_distributor, $data);             
            }
            else{
                if($cek_username->num_rows() > 0){
                    echo "Username sudah ada..!!";
                }
                else{
                    echo 1;
                    
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
                    
                    $data  = array(
                        'id_distributor'           => $id_distributor,
                        'nama_distributor'         => $nama_distributor,
                        'pic_distributor'          => $pic_distributor,
                        'kontak_distributor'       => $kontak_distributor,
                        'alamat_distributor'       => $alamat_distributor,
                        'foto_distributor'         => $foto_distributor,
                        'username_distributor'     => $username_distributor_baru,
                        'password_distributor'     => $password_distributor                
                    );

                    $this->Mod_master->update_distributor($id_distributor, $data); 
                }
            }
        }
    }

    function hapus_distributor(){
        $id_distributor = $this->input->post('id_distributor');
        $g = $this->Mod_master->get_distributor($id_distributor)->row_array();
        unlink('assets/img/distributor/'.$g['foto_distributor']);
        $this->Mod_master->delete_distributor($id_distributor);
    } 
    
}
