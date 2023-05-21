<?php 
defined('BASEPATH') || exit('No direct script access allowed');

class Pemesanan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mod_master');
        $this->load->model('Mod_transaksi');
    }

    function index() {
        $id_karyawan = $this->session->userdata('ses_id_karyawan');  
        $hak_akses = $this->session->userdata('ses_akses');  

        if($id_karyawan != null && $hak_akses == 'Admin'){
            $data['pageTitle'] = "Pemesanan";

            $data['data_pemesanan'] = $this->Mod_transaksi->get_all_pemesanan();
            $data['distributor'] = $this->Mod_master->get_all_distributor();
            $this->load->view("backend/admin/pemesanan/body",$data);
        }  
        else{ 
            redirect('login');
        }  
    }

    function detail($kode_pembelian){
        $id_karyawan = $this->session->userdata('ses_id_karyawan');  
        $hak_akses = $this->session->userdata('ses_akses');  

        if($id_karyawan != null && $hak_akses == 'Admin'){
            $data['pageTitle'] = "Detail Pemesanan";
            
            $data['data_detail'] = $this->Mod_transaksi->get_pemesanan($kode_pembelian)->row_array();
            $data['list_produk'] = $this->Mod_transaksi->get_item_pemesanan($kode_pembelian);

            $this->load->view("backend/admin/pemesanan/body_detail",$data);
        }
        else{ 
            redirect('login');
        }  
    }

    function invoice($kode_pembelian){
        $id_karyawan = $this->session->userdata('ses_id_karyawan');  
        $hak_akses = $this->session->userdata('ses_akses');  

        if($id_karyawan != null && $hak_akses == 'Admin'){
            $data['pageTitle'] = "Invoice";
            
            $data['data_detail'] = $this->Mod_transaksi->get_pemesanan($kode_pembelian)->row_array();
            $data['list_produk'] = $this->Mod_transaksi->get_item_pemesanan($kode_pembelian);

            $this->load->view("backend/cetak_berkas/body_invoice_pemesanan",$data);
        }
        else{ 
            redirect('login');
        }  

    }

    function load_data_item_pembelian(){
        $kode_pembelian = $this->input->post('kode_pembelian');
        $data['total_pby_pembelian'] = $this->input->post('total_pby_pembelian');
        $data['list_produk'] = $this->Mod_transaksi->get_item_pemesanan($kode_pembelian);
        $this->load->view('backend/admin/pemesanan/load_data_item_pembelian', $data);
    }



    //KERANJANG PRODUK

    function load_data_produk(){
		$id_distributor = $this->input->post('id_distributor');
        $data['produk'] = $this->Mod_master->get_produk_distributor($id_distributor)->result();
        $this->load->view("backend/admin/pemesanan/load_data_produk",$data);
    }

    function load_data_item_produk(){
        $id_distributor = $this->input->post('id_distributor');
        $data['tmp'] = $this->Mod_transaksi->get_item_pemesanan_distributor($id_distributor);
        $this->load->view('backend/admin/pemesanan/load_data_item_produk', $data);
    }

    function form_tambah(){
        $kode_produk = $this->input->post('kode_produk');
        $data['data'] = $this->Mod_master->get_produk($kode_produk)->row_array();
        $this->load->view("backend/admin/pemesanan/form_tambah_produk", $data);
    }

    function insert_item_pemesanan(){
        $id_distributor = $this->input->post('id_distributor');
        $kode_produk = $this->input->post('kode_produk');
        $qty_ipembelian = $this->input->post('qty_ipembelian');
        $harga_ipembelian = $this->input->post('harga_ipembelian');
        $stok_dis_produk = $this->input->post('stok_dis_produk');
        $subtotal_ipembelian = $this->input->post('subtotal_ipembelian');

        $cek_item1 = $this->Mod_transaksi->cek_item_pemesanan($kode_produk);
        

        if($cek_item1->num_rows() > 0){ 
            echo "Produk sudah ada";
        }else if($harga_ipembelian == 0){
            echo "Harga tidak tercantum, konfirmasi terlebih dahulu kepada distributor";
        }else if($kode_produk == ""){
            echo "Produk tidak boleh kosong";
        }else if($qty_ipembelian == 0){
            echo "Qty tidak boleh kosong";
        }else if($qty_ipembelian > $stok_dis_produk){
            echo "Qty melebihi stok gudang";
        }else{
            echo 1;
            $save  = array( 
                'id_distributor'        => $id_distributor,
                'kode_produk'           => $kode_produk,
                'kode_produk'           => $kode_produk,
                'qty_ipembelian'        => $qty_ipembelian,
                'harga_ipembelian'      => $harga_ipembelian,
                'subtotal_ipembelian'   => $subtotal_ipembelian,
                'status_ipembelian'     => "Keranjang"
            );
            
            $this->Mod_transaksi->insert_item_pemesanan($save);  
        }
    }

    function delete_item_pemesanan(){
        $kode_ipembelian = $this->input->post('kode_ipembelian');
        $this->Mod_transaksi->delete_item_pemesanan($kode_ipembelian);
    } 

    

    //PEMESANAN PRODUK

    function select_rekening(){
		$id_distributor = $this->input->post('id_distributor');
        $data = $this->Mod_master->get_rekening_dis($id_distributor)->result();
        echo json_encode($data);
    }

    function insert_pemesanan(){
        $id_distributor = $this->input->post('id_distributor');
        $kode_rekening = $this->input->post('kode_rekening');
        $total_pby_pembelian = $this->input->post('total_pby_pembelian');
        $tanggal_pengajuan_pembelian = date('Y-m-d H:m:s');
        $kode_pembelian = 'INV-'.date('YmdHms').'-'.$id_distributor;
        $status_pembelian = '1';
        $status_pby_pembelian = 'Belum Dibayarkan';

        if($kode_rekening == ""){
            echo "Rekening bank tidak boleh kosong";
        }else{  
            echo 1;         
            $save  = array( 
                'kode_pembelian'                => $kode_pembelian,
                'id_distributor'                => $id_distributor,
                'kode_rekening'                 => $kode_rekening,
                'tanggal_pengajuan_pembelian'   => $tanggal_pengajuan_pembelian,
                'total_pby_pembelian'           => $total_pby_pembelian,
                'status_pby_pembelian'          => $status_pby_pembelian,
                'status_pembelian'              => $status_pembelian
            );
                        
            $this->Mod_transaksi->insert_pemesanan($save);        
            
            $item = $this->Mod_transaksi->get_all_item_pemesanan()->result();

            foreach($item as $row){
                if($row->kode_pembelian == "" && $row->id_distributor == $id_distributor){
                    $kode_ipembelian = $row->kode_ipembelian;
                    
                    $data = array(
                        'kode_ipembelian'         => $kode_ipembelian,
                        'kode_pembelian'          => $kode_pembelian,
                        'status_ipembelian'       => 'Proses'
                    );
                    
                    $this->Mod_transaksi->update_item_pemesanan($kode_ipembelian, $data); 
                }
            }      
            
        }
    }

    function update_bukti_pembayaran(){
        $kode_pembelian = $this->input->post('kode_pembelian');
        $status_pby_pembelian = "Sudah Ditransfer";
        $status_pembelian = "2";

        $config['upload_path'] = './assets/img/transaksi';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['image_library'] = 'gd2';
        $config['maintain_ratio'] = TRUE;
        $config['width'] = 500;
        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
        $this->upload->initialize($config);

        if($this->upload->do_upload('file')){  
            $data = array('upload_data' => $this->upload->data());
            $bukti_pby_pembelian = $data['upload_data']['file_name'];

            echo 1;         
            $save  = array( 
                'kode_pembelian'          => $kode_pembelian,
                'bukti_pby_pembelian'     => $bukti_pby_pembelian,
                'status_pembelian'        => $status_pembelian,
                'status_pby_pembelian'    => $status_pby_pembelian
            );
                        
            $this->Mod_transaksi->update_pemesanan($kode_pembelian, $save);      
        }else{
            echo "Bukti pembayaran harus diisi";  
        }
    }

}