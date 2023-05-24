<?php 
defined('BASEPATH') || exit('No direct script access allowed');

require_once('vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
        $kode_pembelian = 'INV-'.date('YmdHms');
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

    function laporan_data_pemesanan(){

        $tanggal_awal = $this->input->post("tanggal_awal");
        $tanggal_akhir = $this->input->post("tanggal_akhir");
        $status_pembelian = $this->input->post("status_pembelian");
        
        if($status_pembelian == "'1'"){
            $status_judul = "Menunggu Pembayaran";
        } elseif($status_pembelian == "'2'"){
            $status_judul = "Validasi Pembayaran";
        } elseif($status_pembelian == "'3'"){
            $status_judul = "Pensanan Diproses";
        } elseif($status_pembelian == "'4'"){
            $status_judul = "Produk Dikirim";
        } elseif($status_pembelian == "'5'"){
            $status_judul = "Pesanan Selesai";
        } elseif($status_pembelian == "'6'"){
            $status_judul = "Pesanan Dibatalkan";
        } else {
            $status_judul = "Semua";
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = [
            'font' => ['bold' => true], // Set font nya jadi bold
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = [
        'alignment' => [
            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
        ],
        'borders' => [
            'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
            'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
            'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
            'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
        ]

        ];
        $sheet->setCellValue('A1', "UD NAUFAL"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $sheet->mergeCells('A1:J1'); // Set Merge Cell pada kolom A1 sampai E1
        $sheet->setCellValue('A2', "LAPORAN PEMESANAN PRODUK"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $sheet->mergeCells('A2:J2'); // Set Merge Cell pada kolom A1 sampai E1
        $sheet->getStyle('A2')->getFont()->setBold(true); // Set bold kolom A1

        $sheet->setCellValue('A3', $tanggal_awal.' s.d. '.$tanggal_akhir ); // Set kolom A1 dengan tulisan "DATA SISWA"
        $sheet->mergeCells('A3:J3'); // Set Merge Cell pada kolom A1 sampai E1
        $sheet->getStyle('A2')->getFont()->setBold(true); // Set bold kolom A1

        $sheet->setCellValue('A4', '(Status Transaksi: '.$status_judul.')' ); // Set kolom A1 dengan tulisan "DATA SISWA"
        $sheet->mergeCells('A4:J4'); // Set Merge Cell pada kolom A1 sampai E1
        $sheet->getStyle('A4')->getFont()->setBold(true); // Set bold kolom A1



        // Buat header tabel nya pada baris ke 3
        $sheet->setCellValue('A6', "NO");
        $sheet->setCellValue('B6', "STATUS"); 
        $sheet->setCellValue('C6', "INVOICE"); 
        $sheet->setCellValue('D6', "TGL PEMBELIAN"); 
        $sheet->setCellValue('E6', "PERUSAHAAN");
        $sheet->setCellValue('F6', "ALAMAT"); 
        $sheet->setCellValue('G6', "KONTAK (PIC)"); 
        $sheet->setCellValue('H6', "KETERANGAN"); 
        $sheet->setCellValue('I6', "STATUS PEMBAYARAN"); 
        $sheet->setCellValue('J6', "TOTAL PEMBAYARAN"); 
        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $sheet->getStyle('A6')->applyFromArray($style_col);
        $sheet->getStyle('B6')->applyFromArray($style_col);
        $sheet->getStyle('C6')->applyFromArray($style_col);
        $sheet->getStyle('D6')->applyFromArray($style_col);
        $sheet->getStyle('E6')->applyFromArray($style_col);
        $sheet->getStyle('F6')->applyFromArray($style_col);
        $sheet->getStyle('G6')->applyFromArray($style_col);
        $sheet->getStyle('H6')->applyFromArray($style_col);
        $sheet->getStyle('I6')->applyFromArray($style_col);
        $sheet->getStyle('J6')->applyFromArray($style_col);
        //Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        
        $data = $this->Mod_transaksi->get_laporan_pemesanan($tanggal_awal, $tanggal_akhir, $status_pembelian)->result();
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 7; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach($data as $row){ // Lakukan looping pada variabel siswa
            if($row->status_pembelian == 1){
                $status_pembelian = "Menunggu Pembayaran";
            } elseif($row->status_pembelian == 2){
                $status_pembelian = "Validasi Pembayaran";
            } elseif($row->status_pembelian == 3){
                $status_pembelian = "Pesanan Diproses";
            } elseif($row->status_pembelian == 4){
                $status_pembelian = "Produk Dikirim";
            } elseif($row->status_pembelian == 5){
                $status_pembelian = "Pesanan Selesai";
            } elseif($row->status_pembelian == 6){
                $status_pembelian = "Pesanan Dibatalkan";
            }
            
            $sheet->setCellValue('A'.$numrow, $no);
            $sheet->setCellValue('B'.$numrow, $status_pembelian);
            $sheet->setCellValue('C'.$numrow, $row->kode_pembelian);
            $sheet->setCellValue('D'.$numrow, $row->tanggal_pengajuan_pembelian);
            $sheet->setCellValue('E'.$numrow, $row->nama_distributor);
            $sheet->setCellValue('F'.$numrow, $row->alamat_distributor);
            $sheet->setCellValue('G'.$numrow, $row->kontak_distributor." (".$row->pic_distributor.")");
            $sheet->setCellValue('H'.$numrow, $row->keterangan_pembelian);
            $sheet->setCellValue('I'.$numrow, $row->status_pby_pembelian);
            $sheet->setCellValue('J'.$numrow, "Rp. ".number_format($row->total_pby_pembelian), 0, ".", ".");
            
            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
                 $sheet->getStyle('B'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('C'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('D'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('E'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('F'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('G'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('H'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('I'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('J'.$numrow)->applyFromArray($style_row);
            
            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }
        
        // Set width kolom
        $sheet->getColumnDimension('A')->setWidth(5); 
        $sheet->getColumnDimension('B')->setWidth(25);
        $sheet->getColumnDimension('C')->setWidth(20);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(20); 
        $sheet->getColumnDimension('F')->setWidth(40); 
        $sheet->getColumnDimension('G')->setWidth(30); 
        $sheet->getColumnDimension('H')->setWidth(40); 
        $sheet->getColumnDimension('I')->setWidth(30); 
        $sheet->getColumnDimension('J')->setWidth(30); 
        
        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $sheet->getDefaultRowDimension()->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        // Set judul file excel nya
        $sheet->setTitle("Laporan Data Pembelian");
        // Proses file excel
        $fileName = 'Laporan Transaksi Pembelian ('.$tanggal_awal.' s.d. '.$tanggal_akhir.').xlsx';  
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");;
        header("Content-Disposition: attachment;filename=Report.xlsx");
        header("Content-Transfer-Encoding: binary ");

// Write file to the browser
        $writer = new Xlsx($spreadsheet);
		$writer->save("assets/berkas/".$fileName);
		header("Content-Type: application/vnd.ms-excel");
        redirect(base_url()."/assets/berkas/".$fileName);
    
    }

}