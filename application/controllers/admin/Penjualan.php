<?php 
defined('BASEPATH') || exit('No direct script access allowed');

require_once('vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Penjualan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mod_master');
        $this->load->model('Mod_transaksi');
    }

    function index() {
        $id_karyawan = $this->session->userdata('ses_id_karyawan');  
        $hak_akses = $this->session->userdata('ses_akses');  

        if($id_karyawan != null && $hak_akses == 'Admin'){
            $data['pageTitle'] = "Penjualan";

            $data['data_penjualan'] = $this->Mod_transaksi->get_all_penjualan();
            $data['distributor'] = $this->Mod_master->get_all_distributor();
            $this->load->view("backend/admin/penjualan/body",$data);
        }  
        else{ 
            redirect('login');
        }  
    }

    function detail($kode_penjualan){
        $id_karyawan = $this->session->userdata('ses_id_karyawan');  
        $hak_akses = $this->session->userdata('ses_akses');  

        if($id_karyawan != null && $hak_akses == 'Admin'){
            $data['pageTitle'] = "Detail Penjualan";
            
            $data['data_detail'] = $this->Mod_transaksi->get_penjualan($kode_penjualan)->row_array();
            $data['list_produk'] = $this->Mod_transaksi->get_item_penjualan($kode_penjualan);

            $this->load->view("backend/admin/penjualan/body_detail",$data);
        }
        else{ 
            redirect('login');
        }  
    }

    function invoice($kode_penjualan){
        $id_karyawan = $this->session->userdata('ses_id_karyawan');  
        $hak_akses = $this->session->userdata('ses_akses');  

        if($id_karyawan != null && $hak_akses == 'Admin'){
            $data['pageTitle'] = "Invoice";
            
            $data['data_detail'] = $this->Mod_transaksi->get_penjualan($kode_penjualan)->row_array();
            $data['list_produk'] = $this->Mod_transaksi->get_item_penjualan($kode_penjualan);

            $this->load->view("backend/cetak_berkas/invoice_penjualan",$data);
        }
        else{ 
            redirect('login');
        }  

    }

    function load_data_item_penjualan(){
        $kode_penjualan = $this->input->post('kode_penjualan');
        $data['list_produk'] = $this->Mod_transaksi->get_item_penjualan($kode_penjualan);
        $this->load->view('backend/admin/penjualan/load_data_item_penjualan', $data);
    }
    

    function laporan_data_penjualan(){

        $tanggal_awal = $this->input->post("tanggal_awal");
        $tanggal_akhir = $this->input->post("tanggal_akhir");

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
        $sheet->setCellValue('A2', "LAPORAN PENJUALAN PRODUK"); // Set kolom A1 dengan tulisan "DATA SISWA"
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
        $sheet->setCellValue('B6', "INVOICE"); 
        $sheet->setCellValue('C6', "TGL PENJUALAN"); 
        $sheet->setCellValue('D6', "NAMA");
        $sheet->setCellValue('E6', "TOTAL PEMBAYARAN"); 
        $sheet->setCellValue('F6', "UANG TUNAI"); 
        $sheet->setCellValue('G6', "KEMBALIAN"); 
        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $sheet->getStyle('A6')->applyFromArray($style_col);
        $sheet->getStyle('B6')->applyFromArray($style_col);
        $sheet->getStyle('C6')->applyFromArray($style_col);
        $sheet->getStyle('D6')->applyFromArray($style_col);
        $sheet->getStyle('E6')->applyFromArray($style_col);
        $sheet->getStyle('F6')->applyFromArray($style_col);
        $sheet->getStyle('G6')->applyFromArray($style_col);
        //Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        
        $data = $this->Mod_transaksi->get_laporan_penjualan($tanggal_awal, $tanggal_akhir)->result();
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 7; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach($data as $row){ // Lakukan looping pada variabel siswa
            
            $sheet->setCellValue('A'.$numrow, $no);
            $sheet->setCellValue('B'.$numrow, $row->kode_penjualan);
            $sheet->setCellValue('C'.$numrow, $row->tanggal_penjualan);
            $sheet->setCellValue('D'.$numrow, $row->nama_penjualan);
            $sheet->setCellValue('E'.$numrow, "Rp. ".number_format($row->total_penjualan), 0, ".", ".");
            $sheet->setCellValue('F'.$numrow, "Rp. ".number_format($row->cash_penjualan), 0, ".", ".");
            $sheet->setCellValue('G'.$numrow, "Rp. ".number_format($row->cash_penjualan - $row->total_penjualan), 0, ".", ".");
            
            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $sheet->getStyle('B'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('C'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('D'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('E'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('F'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('G'.$numrow)->applyFromArray($style_row);
            
            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }
        
        // Set width kolom
        $sheet->getColumnDimension('A')->setWidth(5); 
        $sheet->getColumnDimension('B')->setWidth(25);
        $sheet->getColumnDimension('C')->setWidth(20);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(30); 
        $sheet->getColumnDimension('F')->setWidth(30); 
        $sheet->getColumnDimension('G')->setWidth(30); 
        
        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $sheet->getDefaultRowDimension()->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        // Set judul file excel nya
        $sheet->setTitle("Laporan Data Penjualan");
        // Proses file excel
        $fileName = 'Laporan Transaksi Penjualan ('.$tanggal_awal.' s.d. '.$tanggal_akhir.').xlsx';  
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