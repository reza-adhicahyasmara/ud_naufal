<?php 
    $notifikasi = 0;
    


    //PRODUK
    $limit_tok_produk = 0; 
    $limit_dis_produk = 0; 
    foreach($this->Mod_master->get_all_produk()->result() as $row) {
        if($row->stok_tok_produk <= $row->limit_tok_produk && $row->status_penawaran_produk == "Diterima"){
            $limit_tok_produk += 1;
        }

        if($this->session->userdata('ses_akses') =='Distributor'){
            if($row->stok_dis_produk <= $row->limit_dis_produk && $row->ID == $this->session->userdata('ses_id_distributor')){
                $limit_dis_produk += 1;
            }
        }
    }    


    //PENAWARAN
    $total_penawaran_tok = 0; 
    foreach($this->Mod_master->get_all_penawaran_distributor()->result() as $row) {
        if($row->status_penawaran == "1"){
            $total_penawaran_tok += 1;
        }
    }


    //PEMESANAN
    $total_pemesanan_tok = 0;
    $total_pemesanan_dis = 0;
    foreach($this->Mod_transaksi->get_all_pemesanan()->result() as $row) {
        if($row->status_pembelian <= 4){
            $total_pemesanan_tok += 1;
        }elseif($row->status_pembelian == 7){
            $total_pemesanan_tok += 1;
        }

        if($this->session->userdata('ses_akses') =='Distributor'){
            if($row->id_distributor == $this->session->userdata('ses_id_distributor')){
                if($row->status_pembelian <= 4){
                    $total_pemesanan_dis += 1;
                }
                elseif($row->status_pembelian == 7){
                    $total_pemesanan_dis += 1;
                }
            }
        }
    }


    //DISTRIBUTOR
    if($this->session->userdata('ses_akses') =='Distributor'){
        $data_distributor = $this->Mod_master->get_distributor($this->session->userdata('ses_id_distributor'))->row_array();
        $url_foto = base_url('assets/img/distributor/'.$data_distributor['foto_distributor']);


        $notifikasi = $limit_dis_produk + $total_pemesanan_dis;

    }


    //KARYAWAN
    if($this->session->userdata('ses_akses') =='Admin'){
        $data_karyawan = $this->Mod_master->get_karyawan($this->session->userdata('ses_id_karyawan'))->row_array();
        $url_foto = base_url('assets/img/karyawan/'.$data_karyawan['foto_karyawan']);

        $notifikasi = $limit_tok_produk + $total_pemesanan_tok;

    }

    if($this->session->userdata('ses_akses') =='Kasir'){
        $data_karyawan = $this->Mod_master->get_karyawan($this->session->userdata('ses_id_karyawan'))->row_array();
        $url_foto = base_url('assets/img/karyawan/'.$data_karyawan['foto_karyawan']);
    }

    if($this->session->userdata('ses_akses') =='Pemilik'){
        $data_karyawan = $this->Mod_master->get_karyawan($this->session->userdata('ses_id_karyawan'))->row_array();
        $url_foto = base_url('assets/img/karyawan/'.$data_karyawan['foto_karyawan']);

        $notifikasi = $limit_tok_produk + $total_pemesanan_tok;

    }
    $url_gambar_profil = base_url('assets/img/banner/user.svg');
?>  


<!DOCTYPE html>
<html lang="en">

<!--  

    PPPPPPPP    RRRRRRRR    II      AA            II  DDDDDDD         AA      MMMM        MMMM      AA      NNNN        NN        MMMM        MMMM  EEEEEEEEEE  RRRRRRRR    TTTTTTTTTT  UU      UU      AA
    PP     PP   RR     RR   II     AAAA           II  DD    DD       AAAA     MM MM      MM MM     AAAA     NN NN       NN        MM MM      MM MM  EE          RR     RR       TT      UU      UU     AAAA 
    PP      PP  RR      RR  II    AA  AA          II  DD     DD     AA  AA    MM  MM    MM  MM    AA  AA    NN  NN      NN        MM  MM    MM  MM  EE          RR      RR      TT      UU      UU    AA  AA
    PP     PP   RR     RR   II   AA    AA         II  DD      DD   AA    AA   MM   MM  MM   MM   AA    AA   NN   NN     NN        MM   MM  MM   MM  EE          RR     RR       TT      UU      UU   AA    AA
    PPPPPPPP    RRRRRRRR    II  AAAAAAAAAA        II  DD      DD  AAAAAAAAAA  MM    MMMM    MM  AAAAAAAAAA  NN    NN    NN        MM    MMMM    MM  EEEEEE      RRRRRRRR        TT      UU      UU  AAAAAAAAAA
    PP          RR     RR   II  AA      AA        II  DD      DD  AA      AA  MM            MM  AA      AA  NN     NN   NN        MM            MM  EE          RR     RR       TT      UU      UU  AA      AA
    PP          RR      RR  II  AA      AA        II  DD     DD   AA      AA  MM            MM  AA      AA  NN      NN  NN        MM            MM  EE          RR      RR      TT      UU      UU  AA      AA
    PP          RR      RR  II  AA      AA        II  DD    DD    AA      AA  MM            MM  AA      AA  NN       NN NN        MM            MM  EE          RR      RR      TT       UU    UU   AA      AA
    PP          RR      RR  II  AA      AA        II  DDDDDDD     AA      AA  MM            MM  AA      AA  NN        NNNN        MM            MM  EEEEEEEEEE  RR      RR      TT        UUUUUU    AA      AA

by exitus
-->
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="shortcut icon" href="<?php echo base_url('assets/img/banner/package_regular.png'); ?>" color="#000000"></link>
    <title><?php if($notifikasi != 0){echo "(".$notifikasi.") ";} echo $pageTitle; ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/boxicons/css/boxicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/chart.js/Chart.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datetimepicker/jquery.datetimepicker.css"/>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/dropzone/dropzone.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/floating-labels/floating-labels.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/jqvmap/jqvmap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/lightbox/src/css/lightbox.css"> 
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/sweetalert2/sweetalert2.min.css">
    
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/backend/css/adminlte.min.css">



    <!-- Rating Star -->
    <style>
        .star-rating {
            font-size: 0;
            white-space: nowrap;
            display: inline-block;
            /* width: 250px; remove this */
            height: 50px;
            overflow: hidden;
            position: relative;
            background: url('data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IiB3aWR0aD0iMjBweCIgaGVpZ2h0PSIyMHB4IiB2aWV3Qm94PSIwIDAgMjAgMjAiIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDIwIDIwIiB4bWw6c3BhY2U9InByZXNlcnZlIj48cG9seWdvbiBmaWxsPSIjREREREREIiBwb2ludHM9IjEwLDAgMTMuMDksNi41ODMgMjAsNy42MzkgMTUsMTIuNzY0IDE2LjE4LDIwIDEwLDE2LjU4MyAzLjgyLDIwIDUsMTIuNzY0IDAsNy42MzkgNi45MSw2LjU4MyAiLz48L3N2Zz4=');
            background-size: contain;
        }
        .star-rating i {
            opacity: 0;
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            /* width: 20%; remove this */
            z-index: 1;
            background: url('data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IiB3aWR0aD0iMjBweCIgaGVpZ2h0PSIyMHB4IiB2aWV3Qm94PSIwIDAgMjAgMjAiIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDIwIDIwIiB4bWw6c3BhY2U9InByZXNlcnZlIj48cG9seWdvbiBmaWxsPSIjRkZERjg4IiBwb2ludHM9IjEwLDAgMTMuMDksNi41ODMgMjAsNy42MzkgMTUsMTIuNzY0IDE2LjE4LDIwIDEwLDE2LjU4MyAzLjgyLDIwIDUsMTIuNzY0IDAsNy42MzkgNi45MSw2LjU4MyAiLz48L3N2Zz4=');
            background-size: contain;
        }
        .star-rating input {
            -moz-appearance: none;
            -webkit-appearance: none;
            opacity: 0;
            display: inline-block;
            /* width: 20%; remove this */
            height: 100%;
            margin: 0;
            padding: 0;
            z-index: 2;
            position: relative;
        }
        .star-rating input:hover + i,
        .star-rating input:checked + i {
            opacity: 1;
        }
        .star-rating i ~ i {
            width: 40%;
        }
        .star-rating i ~ i ~ i {
            width: 60%;
        }
        .star-rating i ~ i ~ i ~ i {
            width: 80%;
        }
        .star-rating i ~ i ~ i ~ i ~ i {
            width: 100%;
        }
        /* *::after,
        *::before {
            height: 100%;
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            text-align: center;
            vertical-align: middle;
        } */

        .star-rating.star-5 {width: 250px;}
        .star-rating.star-5 input,
        .star-rating.star-5 i {width: 20%;}
        .star-rating.star-5 i ~ i {width: 40%;}
        .star-rating.star-5 i ~ i ~ i {width: 60%;}
        .star-rating.star-5 i ~ i ~ i ~ i {width: 80%;}
        .star-rating.star-5 i ~ i ~ i ~ i ~i {width: 100%;}

        .checked {
            color: orange;
        }

        
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
        }

        /* Firefox */
        input[type=number] {
        -moz-appearance: textfield;
        }
        
        .rating_pemesanan {
            font-family: 'FontAwesome';
            color: orange;
        }

        .rating_ipemesanan {
            font-family: 'FontAwesome';
            color: orange;
        }

        .toolbar_pemesanan {
            float: right;
        }

        .toolbar_ipemesanan {
            float: right;
        }
    </style>
  
    <style>
        input#warna_produk {
            transform: scale(2);
        }
    </style>

    
    <style>
        /* COLOR CUSTOM */
        .page-item.active .page-link {
            z-index: 3;
            color: #fff;
            background-color: #17a2b8;
            border-color: #17a2b8;
        }
        .page-link {
            position: relative;
            display: block;
            padding: .5rem .75rem;
            margin-left: -1px;
            line-height: 1.25;
            color: #17a2b8;
            background-color: #fff;
            border: 1px solid #dee2e6;
        }
        a {
            color: #17a2b8;
            text-decoration: none;
            background-color: transparent;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed text-sm">
    <div class="preloader flex-column justify-content-center align-items-center bg-white">
        <img class="animation__shake" src="<?php echo base_url('assets/img/banner/package_regular.png'); ?>" alt="AdminLTELogo" height="80" width="80">
    </div>
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-info navbar-light text-sm" aria-label="">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><span class="bx bx-fw bx-menu"></span></a>
                </li>
            </ul>
        </nav>
        
        <aside class="main-sidebar sidebar-light-info elevation-4 text-sm">
            <a href="" class="brand-link">
                <img src="<?php echo base_url('assets/img/banner/package_regular.png'); ?>" class="brand-image" style="opacity: .8" alt="Image" style="width: 50px;">
                <span class="brand-text font-weight"><strong class="text-md">UD Naufal</strong></span>
            </a>
            <div class="sidebar">
                <nav class="mt-2" aria-label="">
                    <ul class="nav nav-pills nav-sidebar nav-compact flex-column nav-child-indent" data-widget="treeview" role="menu">
                        <?php if($this->session->userdata('ses_akses') =='Admin'){?>
                            <li class="nav-item has-treeview"> 
                                <a href="#" class="nav-link">
                                    <?php if($data_karyawan['foto_karyawan'] != "") { ?>
                                        <img src="<?php echo $url_foto; ?>" class="img-circle elevation-1" style="margin-left: -4px; width:37px; height:37px; object-fit: cover;" alt="Image">
                                    <?php }else{ ?>
                                        <img src="<?php echo $url_gambar_profil; ?>" class="img-circle elevation-1" style="margin-left: -4px; width:37px; height:37px; object-fit: cover; background-color:white; border:1px solid #ced4da;" alt="Image">
                                    <?php } ?> 
                                    <p class="text-md" style="margin-left:10px; vertical-align: middle;"><?php echo $data_karyawan['nama_karyawan']; ?></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item"><a href="<?php echo base_url('profil_karyawan'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-user"></i><p>Profil</p></a></li>
                                    <li class="nav-item"><a href="<?php echo base_url('profil_karyawan/ubah_password'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-lock"></i><p>Ubah Password</p></a></li>
                                </ul>
                            </li>
                            <li class="nav-item"><hr style="margin-top: 0.4rem"></li>
                            <li class="nav-item"><a href="<?php echo base_url('admin/dashboard'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-home"></i><p>Dashboard</p></a></li>
                            <li class="nav-item"><a href="<?php echo base_url('admin/penawaran'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-calendar-check"></i><p>Penawaran<?php if($total_penawaran_tok != 0){ ?><span class="badge badge-danger right"> <?php echo $total_penawaran_tok; ?></span><?php } ?></p></a></li>

                            <li class="nav-header text-bold">Transaksi</li>   
                            <li class="nav-item"><a href="<?php echo base_url('admin/pemesanan'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-book"></i><p>Pembelian<?php if($total_pemesanan_tok != 0){ ?><span class="badge badge-danger right"> <?php echo $total_pemesanan_tok; ?></span><?php } ?></p></a></li>
                            <li class="nav-item"><a href="<?php echo base_url('admin/penjualan'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-book"></i><p>Penjualan</p></a></li>

                            <li class="nav-header text-bold">Arus Produk</li>  
                            <li class="nav-item"><a href="<?php echo base_url('admin/produk_masuk'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-down-arrow-alt"></i><p>Stok Masuk</p></a></li>
                            <li class="nav-item"><a href="<?php echo base_url('admin/produk_keluar'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-up-arrow-alt"></i><p>Stok Keluar</p></a></li>

                            <li class="nav-header text-bold">Master Data</li>      
                            <li class="nav-item"><a href="<?php echo base_url('admin/distributor'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bxs-truck"></i><p>Distributor </p></a></li>
                            <li class="nav-item"><a href="<?php echo base_url('admin/produk'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-package nav-icon"></i><p>Produk <?php if($limit_tok_produk != 0){ ?><span class="badge badge-danger right"> <?php echo $limit_tok_produk; ?></span><?php } ?></p></a></li>
                            <li class="nav-item"><a href="<?php echo base_url('admin/kategori'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-bookmark"></i><p>Kategori</p></a></li>
                            <li class="nav-item"><a href="<?php echo base_url('admin/karyawan'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-user"></i><p>Karyawan</p></a></li>
                            <li class="nav-item"><a href="<?php echo base_url('admin/rekening'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-credit-card"></i><p>Rekening Perusahaan</p></a></li>
                                

                        <?php }elseif($this->session->userdata('ses_akses') =='Pemilik'){?>
                            <li class="nav-item has-treeview"> 
                                <a href="#" class="nav-link">
                                    <?php if($data_karyawan['foto_karyawan'] != "") { ?>
                                        <img src="<?php echo $url_foto; ?>" class="img-circle elevation-1" style="margin-left: -4px; width:37px; height:37px; object-fit: cover;" alt="Image">
                                    <?php }else{ ?>
                                        <img src="<?php echo $url_gambar_profil; ?>" class="img-circle elevation-1" style="margin-left: -4px; width:37px; height:37px; object-fit: cover; background-color:white; border:1px solid #ced4da;" alt="Image">
                                    <?php } ?> 
                                    <p class="text-md" style="margin-left:10px; vertical-align: middle;"><?php echo $data_karyawan['nama_karyawan']; ?></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item"><a href="<?php echo base_url('profil_karyawan'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-user"></i><p>Profil</p></a></li>
                                    <li class="nav-item"><a href="<?php echo base_url('profil_karyawan/ubah_password'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-lock"></i><p>Ubah Password</p></a></li>
                                </ul>
                            </li>
                            <li class="nav-item"><hr style="margin-top: 0.4rem"></li>
                            <li class="nav-item"><a href="<?php echo base_url('pemilik/dashboard'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-home"></i><p>Dashboard</p></a></li>
                            <li class="nav-item"><a href="<?php echo base_url('pemilik/penawaran'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-calendar-check"></i><p>Penawaran<?php if($total_penawaran_tok != 0){ ?><span class="badge badge-danger right"> <?php echo $total_penawaran_tok; ?></span><?php } ?></p></a></li>

                            <li class="nav-header text-bold">Transaksi</li>   
                            <li class="nav-item"><a href="<?php echo base_url('pemilik/pemesanan'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-book"></i><p>Pembelian<?php if($total_pemesanan_tok != 0){ ?><span class="badge badge-danger right"> <?php echo $total_pemesanan_tok; ?></span><?php } ?></p></a></li>
                            <li class="nav-item"><a href="<?php echo base_url('pemilik/penjualan'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-book"></i><p>Penjualan</p></a></li>

                            <li class="nav-header text-bold">Arus Produk</li>  
                            <li class="nav-item"><a href="<?php echo base_url('pemilik/produk_masuk'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-down-arrow-alt"></i><p>Stok Masuk</p></a></li>
                            <li class="nav-item"><a href="<?php echo base_url('pemilik/produk_keluar'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-up-arrow-alt"></i><p>Stok Keluar</p></a></li>

                            <li class="nav-header text-bold">Master Data</li>      
                            <li class="nav-item"><a href="<?php echo base_url('pemilik/distributor'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bxs-truck"></i><p>Distributor </p></a></li>
                            <li class="nav-item"><a href="<?php echo base_url('pemilik/produk'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-package nav-icon"></i><p>Produk <?php if($limit_tok_produk != 0){ ?><span class="badge badge-danger right"> <?php echo $limit_tok_produk; ?></span><?php } ?></p></a></li>
                            <li class="nav-item"><a href="<?php echo base_url('pemilik/karyawan'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-user"></i><p>Karyawan</p></a></li>
                                

                            <?php }elseif($this->session->userdata('ses_akses') =='Kasir'){?>
                                <li class="nav-item has-treeview"> 
                                    <a href="#" class="nav-link">
                                        <?php if($data_karyawan['foto_karyawan'] != "") { ?>
                                            <img src="<?php echo $url_foto; ?>" class="img-circle elevation-1" style="margin-left: -4px; width:37px; height:37px; object-fit: cover;" alt="Image">
                                        <?php }else{ ?>
                                            <img src="<?php echo $url_gambar_profil; ?>" class="img-circle elevation-1" style="margin-left: -4px; width:37px; height:37px; object-fit: cover; background-color:white; border:1px solid #ced4da;" alt="Image">
                                        <?php } ?> 
                                        <p class="text-md" style="margin-left:10px; vertical-align: middle;"><?php echo $data_karyawan['nama_karyawan']; ?></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item"><a href="<?php echo base_url('profil_karyawan'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-user"></i><p>Profil</p></a></li>
                                        <li class="nav-item"><a href="<?php echo base_url('profil_karyawan/ubah_password'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-lock"></i><p>Ubah Password</p></a></li>
                                    </ul>
                                </li>
                                <li class="nav-item"><hr style="margin-top: 0.4rem"></li>
                                <li class="nav-item"><a href="<?php echo base_url('kasir/kasir'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-calculator"></i><p>Kasir</p></a></li>
                                <li class="nav-item"><a href="<?php echo base_url('kasir/penjualan'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-book"></i><p>Penjualan</p></a></li>
                    
                            
                        <?php }elseif($this->session->userdata('ses_akses') =='Distributor'){?>
                            <li class="nav-item has-treeview"> 
                                <a href="#" class="nav-link">
                                    <?php if($data_distributor['foto_distributor'] != "") { ?>
                                        <img src="<?php echo $url_foto; ?>" class="img-circle elevation-1" style="margin-left: -4px; width:37px; height:37px; object-fit: cover;" alt="Image">
                                    <?php }else{ ?>
                                        <img src="<?php echo $url_gambar_profil; ?>" class="img-circle elevation-1" style="margin-left: -4px; width:37px; height:37px; object-fit: cover; background-color:white; border:1px solid #ced4da;" alt="Image">
                                    <?php } ?> 
                                    <p class="text-md" style="margin-left:10px; vertical-align: middle;"><?php echo $data_distributor['nama_distributor']; ?></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item"><a href="<?php echo base_url('distributor/profil'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-user"></i><p>Profil</p></a></li>
                                    <li class="nav-item"><a href="<?php echo base_url('distributor/profil/ubah_password'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-lock"></i><p>Ubah Password</p></a></li>
                                </ul>
                            </li>
                            <li class="nav-item"><hr style="margin-top: 0.4rem"></li>
                            <li class="nav-item"><a href="<?php echo base_url('distributor/dashboard'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-home"></i><p>Dashboard</p></a></li>
                            <li class="nav-item"><a href="<?php echo base_url('distributor/produk'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-package"></i><p>Produk <?php if($limit_dis_produk != 0){ ?><span class="badge badge-danger right"> <?php echo $limit_dis_produk; ?></span><?php } ?></p></a></li>
                            <li class="nav-item"><a href="<?php echo base_url('distributor/penawaran'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-calendar-check"></i><p>Penawaran</p></a></li>
                            <li class="nav-item"><a href="<?php echo base_url('distributor/pemesanan'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-book"></i><p>Pemesanan <?php if($total_pemesanan_dis != 0){ ?><span class="badge badge-danger right"> <?php echo $total_pemesanan_dis; ?></span><?php } ?></p></a></li>
                            <li class="nav-item"><a href="<?php echo base_url('distributor/rekening'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-credit-card"></i><p>Rekening Perusahaan</p></a></li>
                        <?php } ?> 
                    </ul>
                    <ul class="nav nav-pills nav-sidebar nav-compact flex-column nav-child-indent" style="position: absolute; bottom: 10px;">
                        <li class="nav-item"><a href="<?php echo base_url('login/logout'); ?>" class="nav-link bg-danger"><i class="nav-icon bx bx-fw bx-log-out"></i><p>Logout</p></a></li>
                    </ul>
                </nav>
            </div>
        </aside>