<?php  

    $this->load->view('backend/partials/head.php');

    $menunggu_pembayaran = 0;
    $verfikasi_pemabayaran = 0;
    $proses_produk = 0;
    $proses_pengiriman = 0;

    foreach($data_pemesanan->result() as $data1){
            if($data1->status_pembelian == "1"){
                $menunggu_pembayaran = $menunggu_pembayaran + 1;
            }
            else if($data1->status_pembelian == "2"){
                $verfikasi_pemabayaran = $verfikasi_pemabayaran + 1;
            }
            else if($data1->status_pembelian == "3"){
                $proses_produk = $proses_produk + 1;
            }
            else if($data1->status_pembelian == "4"){
                $proses_pengiriman = $proses_pengiriman + 1;
            }
        }
        
  ?>
  <div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-1 text-dark"><i class="nav-icon bx bx-fw bx-calendar-check"></i> Pemesanan</h1>
                </div>
                <div class="col-sm-6 float-sm-right">
                    <ol class="breadcrumb float-sm-right m-2">
                        <span class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a></span>
                        <span class="breadcrumb-item active">Pemesanan</span>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-info card-outline card card-tabs">
                <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Pengajuan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id=" custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages1" role="tab" aria-controls="custom-tabs-one-messages1" aria-selected="false">Menunggu Pembayaran <?php if($menunggu_pembayaran != 0){ ?><span class="badge badge-danger right"> <?php echo $menunggu_pembayaran; ?></span><?php } ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id=" custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages2" role="tab" aria-controls="custom-tabs-one-messages2" aria-selected="false">Verifikasi Pembayaran <?php if($verfikasi_pemabayaran != 0){ ?><span class="badge badge-danger right"> <?php echo $verfikasi_pemabayaran; ?></span><?php } ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id=" custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages3" role="tab" aria-controls="custom-tabs-one-messages3" aria-selected="false">Diproses <?php if($proses_produk != 0){ ?><span class="badge badge-danger right"> <?php echo $proses_produk; ?></span><?php } ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id=" custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages4" role="tab" aria-controls="custom-tabs-one-messages4" aria-selected="false">Dikirim <?php if($proses_pengiriman != 0){ ?><span class="badge badge-danger right"> <?php echo $proses_pengiriman; ?></span><?php } ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id=" custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages5" role="tab" aria-controls="custom-tabs-one-messages5" aria-selected="false">Selesai </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id=" custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages6" role="tab" aria-controls="custom-tabs-one-messages6" aria-selected="false">Dibatalkan </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-one-tabContent">
                        <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">    
                            <div class="card card">
                                <div class="card-body">
                                    <h4>Daftar Produk</h4>
                                    <div class="row">
                                        <div class="col-1">
                                            <h6 class="text-bold pt-2">Distributor</h6>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <select class="form-control id_distributor" name="id_distributor" id="id_distributor">
                                                    <option value="">Pilih</option>
                                                    <?php foreach($distributor->result() as $row){ ?>
                                                        <option value="<?php echo $row->id_distributor; ?>"><?php echo $row->nama_distributor; ?></option>
                                                    <?php } ?> 
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="content_produk">
                                        <!--LOAD DATA-->
                                    </div>
                                </div>   
                            </div>
                            <br>
                            <div class="card card">
                                <div class="card-body">
                                    <h4>Daftar Keranjang</h4>
                                    <div id="content_item_pemesanan">
                                        <!--LOAD DATA-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-one-messages1" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                            <table style="width:100%;" id="dataTable3" class="table table-bordered table-striped">
                                <caption></caption>
                                <thead>
                                    <tr>
                                        <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Tanggal</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Distributor</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">PIC</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">No. Kontak</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Total Harga (Rp.)</th>
                                        <th id="" style="text-align: center; vertical-align: middle; width:5%">Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no = 1;
                                        foreach($data_pemesanan->result() as $row) {
                                            if($row->status_pembelian == "1"){
                                    ?>
                                    <tr>
                                        <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->tanggal_pengajuan_pembelian;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_distributor;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->pic_distributor;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->kontak_distributor;?></td>
                                        <td style="text-align: Right; vertical-align: middle;"><?php echo number_format($row->total_pby_pembelian,2, ",", ".");?></td>
                                        <td style="text-align: center; vertical-align: middle;" >
                                            <a class='btn btn-info btn-sm btn-rounded' href="<?php echo base_url('admin/pemesanan/detail/'.$row->kode_pembelian); ?>"><i class="bx bx-fw bx-show-alt"></i></a>
                                        </td>
                                    </tr>
                                    <?php 
                                            $no++;
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-one-messages2" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                            <table style="width:100%" id="dataTable4" class="table table-bordered table-striped">
                                <caption></caption>
                                <thead>
                                    <tr>
                                        <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Tanggal</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Distributor</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">PIC</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">No. Kontak</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Total Harga (Rp.)</th>
                                        <th id="" style="text-align: center; vertical-align: middle; width:5%">Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no = 1;
                                        foreach($data_pemesanan->result() as $row) {
                                            if($row->status_pembelian == "2"){
                                    ?>
                                    <tr>
                                        <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->tanggal_pengajuan_pembelian;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_distributor;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->pic_distributor;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->kontak_distributor;?></td>
                                        <td style="text-align: Right; vertical-align: middle;"><?php echo number_format($row->total_pby_pembelian,2, ",", ".");?></td>
                                        <td style="text-align: center; vertical-align: middle;" >
                                            <a class='btn btn-info btn-sm btn-rounded' href="<?php echo base_url('admin/pemesanan/detail/'.$row->kode_pembelian); ?>"><i class="bx bx-fw bx-show-alt"></i></a>
                                        </td>
                                    </tr>
                                    <?php 
                                            $no++;
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-one-messages3" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                            <table style="width:100%" id="dataTable5" class="table table-bordered table-striped">
                                <caption></caption>
                                <thead>
                                    <tr>
                                        <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Tanggal</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Distributor</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">PIC</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">No. Kontak</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Total Harga (Rp.)</th>
                                        <th id="" style="text-align: center; vertical-align: middle; width:5%">Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no = 1;
                                        foreach($data_pemesanan->result() as $row) {
                                            if($row->status_pembelian == "3"){
                                    ?>
                                    <tr>
                                        <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->tanggal_pengajuan_pembelian;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_distributor;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->pic_distributor;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->kontak_distributor;?></td>
                                        <td style="text-align: Right; vertical-align: middle;"><?php echo number_format($row->total_pby_pembelian,2, ",", ".");?></td>
                                        <td style="text-align: center; vertical-align: middle;" >
                                            <a class='btn btn-info btn-sm btn-rounded' href="<?php echo base_url('admin/pemesanan/detail/'.$row->kode_pembelian); ?>"><i class="bx bx-fw bx-show-alt"></i></a>
                                        </td>
                                    </tr>
                                    <?php 
                                            $no++;
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-one-messages4" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                            <table style="width:100%" id="dataTable6" class="table table-bordered table-striped">
                                <caption></caption>
                                <thead>
                                    <tr>
                                        <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Tanggal</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Distributor</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">PIC</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">No. Kontak</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Total Harga (Rp.)</th>
                                        <th id="" style="text-align: center; vertical-align: middle; width:5%">Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no = 1;
                                        foreach($data_pemesanan->result() as $row) {
                                            if($row->status_pembelian == "4"){
                                    ?>
                                    <tr>
                                        <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->tanggal_pengajuan_pembelian;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_distributor;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->pic_distributor;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->kontak_distributor;?></td>
                                        <td style="text-align: Right; vertical-align: middle;"><?php echo number_format($row->total_pby_pembelian,2, ",", ".");?></td>
                                        <td style="text-align: center; vertical-align: middle;" >
                                            <a class='btn btn-info btn-sm btn-rounded' href="<?php echo base_url('admin/pemesanan/detail/'.$row->kode_pembelian); ?>"><i class="bx bx-fw bx-show-alt"></i></a>
                                        </td>
                                    </tr>
                                    <?php 
                                            $no++;
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-one-messages5" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                            <table style="width:100%" id="dataTable7" class="table table-bordered table-striped">
                                <caption></caption>
                                <thead>
                                    <tr>
                                        <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Tanggal</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Distributor</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">PIC</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">No. Kontak</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Total Harga (Rp.)</th>
                                        <th id="" style="text-align: center; vertical-align: middle; width:5%">Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no = 1;
                                        foreach($data_pemesanan->result() as $row) {
                                            if($row->status_pembelian == "5"){
                                    ?>
                                    <tr>
                                        <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->tanggal_pengajuan_pembelian;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_distributor;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->pic_distributor;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->kontak_distributor;?></td>
                                        <td style="text-align: Right; vertical-align: middle;"><?php echo number_format($row->total_pby_pembelian,2, ",", ".");?></td>
                                        <td style="text-align: center; vertical-align: middle;" >
                                            <a class='btn btn-info btn-sm btn-rounded' href="<?php echo base_url('admin/pemesanan/detail/'.$row->kode_pembelian); ?>"><i class="bx bx-fw bx-show-alt"></i></a>
                                        </td>
                                    </tr>
                                    <?php 
                                            $no++;
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-one-messages6" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                            <table style="width:100%" id="dataTable8" class="table table-bordered table-striped">
                                <caption></caption>
                                <thead>
                                    <tr>
                                        <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Tanggal</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Distributor</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">PIC</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">No. Kontak</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Total Harga (Rp.)</th>
                                        <th id="" style="text-align: center; vertical-align: middle; width:5%">Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no = 1;
                                        foreach($data_pemesanan->result() as $row) {
                                            if($row->status_pembelian == "6"){
                                    ?>
                                    <tr>
                                        <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->tanggal_pengajuan_pembelian;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_distributor;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->pic_distributor;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->kontak_distributor;?></td>
                                        <td style="text-align: Right; vertical-align: middle;"><?php echo number_format($row->total_pby_pembelian,2, ",", ".");?></td>
                                        <td style="text-align: center; vertical-align: middle;" >
                                            <a class='btn btn-info btn-sm btn-rounded' href="<?php echo base_url('admin/pemesanan/detail/'.$row->kode_pembelian); ?>"><i class="bx bx-fw bx-show-alt"></i></a>
                                        </td>
                                    </tr>
                                    <?php 
                                            $no++;
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-one-messages7" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                            <table style="width:100%" id="dataTable9" class="table table-bordered table-striped">
                                <caption></caption>
                                <thead>
                                    <tr>
                                        <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Tanggal</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Distributor</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">PIC</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">No. Kontak</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Total Harga (Rp.)</th>
                                        <th id="" style="text-align: center; vertical-align: middle; width:5%">Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no = 1;
                                        foreach($data_pemesanan->result() as $row) {
                                            if($row->status_pembelian == "7"){
                                    ?>
                                    <tr>
                                        <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->tanggal_pengajuan_pembelian;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_distributor;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->pic_distributor;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->kontak_distributor;?></td>
                                        <td style="text-align: Right; vertical-align: middle;"><?php echo number_format($row->total_pby_pembelian,2, ",", ".");?></td>
                                        <td style="text-align: center; vertical-align: middle;" >
                                            <a class='btn btn-info btn-sm btn-rounded' href="<?php echo base_url('admin/pemesanan/detail/'.$row->kode_pembelian); ?>"><i class="bx bx-fw bx-show-alt"></i></a>
                                        </td>
                                    </tr>
                                    <?php 
                                            $no++;
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<form role="form" id="form_item_pemesanan" method="post" aria-label="">
    <div id="modal_item_pemesanan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-body pt-5">
                    <div class="isi_item">
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class="bx bx-fw bx-x"></span> Batal</button>
                    <button type="button" id="btn_tambah_item_pemesanan" class="btn bg-info"><span class="bx bx-fw bxs-cart-add"></span> Tambah</button>
                </div>
            </div>
        </div>
    </div>
</form>

<?php $this->load->view('backend/partials/footer.php') ?>
<?php $this->load->view('backend/partials/script.php') ?>


<!-----------------------FUNGSI----------------------->
<script type="text/javascript">
    var url_outlet =  "<?php echo base_url('admin/pemesanan'); ?>";
    var url = url_outlet ;
    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).addClass('active ');
    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');

    $(document).ready(function() {
        $('.id_distributor').select2({
            theme: 'bootstrap4',
        })
    });

    $(document).ready(function() {
        $('.kode_produk').select2({
            theme: 'bootstrap4',
        })
    });

    $(function () {
        $("#dataTable1").DataTable({
        "responsive": true,
        "autoWidth": true,
        });
    });

    $(function () {
        $("#dataTable2").DataTable({
        "responsive": true,
        "autoWidth": true,
        });
    });

    $(function () {
        $("#dataTable3").DataTable({
        "scrollX": false,
        "autoWidth": true,
        });
    });

    $(function () {
        $("#dataTable4").DataTable({
        "scrollX": false,
        "autoWidth": true,
        });
    });

    $(function () {
        $("#dataTable5").DataTable({
        "scrollX": false,
        "autoWidth": true,
        });
    });

    $(function () {
        $("#dataTable6").DataTable({
        "scrollX": false,
        "autoWidth": true,
        });
    });

    $(function () {
        $("#dataTable7").DataTable({
        "scrollX": false,
        "autoWidth": true,
        });
    });

    $(function () {
        $("#dataTable8").DataTable({
        "scrollX": false,
        "autoWidth": true,
        });
    });

    $(function () {
        $("#dataTable9").DataTable({
        "scrollX": false,
        "autoWidth": true,
        });
    });
</script>



<!-----------------------KERANJANG PRODUK----------------------->
<script type="text/javascript">
    $(document).ready(function(){
        $("#id_distributor").change(function() {
            var id_distributor = $(this).val();

            $.ajax({
                url : '<?php echo base_url('admin/pemesanan/load_data_produk'); ?>',
                method: 'POST',
                data: {id_distributor:id_distributor},
                async : false,
                beforeSend : function(){
                    $('#content_produk').html('<div style="text-align:center"><i class="fa fa-refresh fa-3x fa-spin" style="margin-top: 30px; margin-bottom: 30px;" aria-hidden="true"></i></div>');
                },
                success: function(response){
                    load_data_produk();
                    load_data_item_produk();
                }
            });     
        });    
    }); 

    load_data_produk();
	function load_data_produk(){
        var id_distributor = $('#id_distributor').val();
		$.ajax({
			url : '<?php echo base_url('admin/pemesanan/load_data_produk'); ?>',
            method: 'POST',
            data: {id_distributor:id_distributor},
            async : false,
			beforeSend : function(){
				$('#content_produk').html('<div style="text-align:center"><i class="fa fa-refresh fa-3x fa-spin" style="margin-top: 30px; margin-bottom: 30px;" aria-hidden="true"></i></div>');
			},
			success : function(response){
				$('#content_produk').html(response);
			}
		});
    };

    load_data_item_produk();
	function load_data_item_produk(){
        var id_distributor = $('#id_distributor').val();
		$.ajax({
			url : '<?php echo base_url('admin/pemesanan/load_data_item_produk'); ?>',
            method: 'POST',
            data: {id_distributor:id_distributor},
            async : false,
			beforeSend : function(){
				$('#content_item_pemesanan').html('<div style="text-align:center"><i class="fa fa-refresh fa-3x fa-spin" style="margin-top: 30px; margin-bottom: 30px;" aria-hidden="true"></i></div>');
			},
			success : function(response){
				$('#content_item_pemesanan').html(response);
			}
		});
    };

    $(document).on('click', '.btn_keranjang', function() {
        var kode_produk = $(this).attr("kode_produk");
        var url = "<?php echo base_url('admin/pemesanan/form_tambah'); ?>";

        $('#modal_item_pemesanan').modal('show');
        $('.modal-title').text('Tambah Daftar');
        $('.isi_item').load(url,{kode_produk : kode_produk});
    }); 

    $(document).ready(function() {
        $('#btn_tambah_item_pemesanan').on("click",function(){
            $.ajax({
                url : '<?php echo base_url('admin/pemesanan/insert_item_pemesanan'); ?>',
                method : 'POST',
                data: $('#form_item_pemesanan').serialize(),
                success: function(response){
                    if(response==1){            
                        load_data_item_produk();
                        $('#modal_item_pemesanan').modal('hide');
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: response,
                            showConfirmButton: true,
                            timer: 3000
                        })
                    }
                }
            })
        })
    })

    $('body').on('click', '.btn_hapus_item_pemesanan', function(){
        var kode_ipembelian = $(this).attr('kode_ipembelian');
        $.ajax({
            url : '<?php echo base_url('admin/pemesanan/delete_item_pemesanan'); ?>',
            method : 'POST',
            data: {kode_ipembelian : kode_ipembelian},
            cache:false,
            success:function(hasil){
                load_data_item_produk();
            }
        })   
    }); 
</script>

</body>
</html>