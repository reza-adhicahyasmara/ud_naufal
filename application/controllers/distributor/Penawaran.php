<?php 
defined('BASEPATH') || exit('No direct script access allowed');

class Penawaran extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('Mod_master');
        $this->load->model('Mod_transaksi');
    }

    function index(){
        $id_distributor = $this->session->userdata('ses_id_distributor');   
        $hak_akses = $this->session->userdata('ses_akses');  

        if($id_distributor != null && $hak_akses == 'Distributor'){
            $data['pageTitle'] = "Data Penawaran";

            $data['penawaran'] = $this->Mod_master->get_all_penawaran_distributor();
            $this->load->view("backend/distributor/penawaran/body",$data);
        }  
        else{ 
            redirect('login');
        }  
    }

    function load_data_penawaran(){
        $id_distributor = $this->session->userdata('ses_id_distributor');  
        $data['penawaran'] = $this->Mod_master->get_penawaran_distributor($id_distributor);
        $this->load->view('backend/distributor/penawaran/load_penawaran', $data);
    }

    function form_tambah_penawaran(){
        $data['produk'] = $this->Mod_master->get_all_produk();
        $this->load->view("backend/distributor/penawaran/form_tambah_penawaran", $data);
    }
    
    function view_pdf_penawaran(){
        $aaa = explode("|",$this->input->post('aaa'));
        
        $data['kode_penawaran'] = $aaa[0];
        $data['berkas_penawaran'] = $aaa[1];
        
        $data['produk'] = $this->Mod_master->get_all_produk($aaa[0]);
        $this->load->view('backend/distributor/penawaran/view_pdf', $data);
    }

    function tambah_penawaran(){  
        $id_distributor = $this->session->userdata('ses_id_distributor'); 
        $nama_penawaran = $this->input->post('nama_penawaran');
        $tanggal_penawaran = date("Y-m-d H:m:s");
        $status_penawaran = 1;
        $kode_penawaran = md5($tanggal_penawaran);

        $config['upload_path'] = './assets/berkas/';
        $config['allowed_types'] = 'pdf';

        $this->upload->initialize($config);
        $this->load->library('image_lib', $config);

        if($nama_penawaran == ""){
            echo "Nama penawaran harus diisi!";
        }
        elseif($this->upload->do_upload('file')){  
            $data = array('upload_data' => $this->upload->data());
            $berkas_penawaran = $data['upload_data']['file_name'];
            echo 1;
                    
            $data  = array(
                'kode_penawaran'            => $kode_penawaran,
                'nama_penawaran'            => $nama_penawaran,
                'tanggal_penawaran'         => $tanggal_penawaran,
                'id_distributor'            => $id_distributor,   
                'berkas_penawaran'          => $berkas_penawaran,  
                'status_penawaran'          => $status_penawaran
            );
                        
            $this->Mod_master->insert_penawaran($data);

            $item = $this->Mod_master->get_all_produk()->result();

            foreach($item as $row){
                if($row->ID == $this->session->userdata('ses_id_distributor') && $row->kode_penawaran == "" && $row->status_penawaran_produk == "Ditawarkan"){
                    $kode_produk = $row->kode_produk;
                    
                    $data = array(
                        'kode_produk'       => $kode_produk,
                        'kode_penawaran'    => $kode_penawaran
                    );
                    
                    $this->Mod_master->update_produk($kode_produk, $data); 
                }
            }
        }else{
            echo "Berkas proposal harus diisi";    
        }        
        
    }


    //LIST PRODUK PENAWARAN
    function load_data_produk(){
        $data['produk'] = $this->Mod_master->get_all_produk();
        $this->load->view('backend/distributor/penawaran/load_produk', $data);
    }

    function update_produk(){ 
        $kode_produk = $this->input->post('kode_produk');
        $status_penawaran_produk = $this->input->post('status_penawaran_produk');   

        if($kode_produk == ""){
            echo "Tidak Boleh Kosong!!!";
        }else{
            $data  = array(
                'kode_produk'               => $kode_produk,
                'status_penawaran_produk'   => $status_penawaran_produk,     
            );
                    
            echo 1;
                        
            $this->Mod_master->update_produk($kode_produk, $data); 
        }     
    }

    function hapus_produk(){
        $kode_produk = $this->input->post('kode_produk');
        $g = $this->Mod_master->get_produk($kode_produk)->row_array();
        unlink('assets/img/produk/'.$g['gambar_produk']);
        $this->Mod_master->delete_produk($kode_produk);
    } 
}
