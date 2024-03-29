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
                    <h1 class="m-1 text-dark"><i class="nav-icon bx bx-fw bx-book"></i> Pembelian</h1>
                </div>
                <div class="col-sm-6 float-sm-right">
                    <ol class="breadcrumb float-sm-right m-2">
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
                            <a class="nav-link active" id=" custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages1" role="tab" aria-controls="custom-tabs-one-messages1" aria-selected="false">Menunggu Pembayaran <?php if($menunggu_pembayaran != 0){ ?><span class="badge badge-danger right"> <?php echo $menunggu_pembayaran; ?></span><?php } ?></a>
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
                        <div class="tab-pane fade show active" id="custom-tabs-one-messages1" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
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
                                            <a class='btn btn-info btn-sm btn-rounded' href="<?php echo base_url('pemilik/pemesanan/detail/'.$row->kode_pembelian); ?>"><i class="bx bx-fw bx-show-alt"></i></a>
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
                                            <a class='btn btn-info btn-sm btn-rounded' href="<?php echo base_url('pemilik/pemesanan/detail/'.$row->kode_pembelian); ?>"><i class="bx bx-fw bx-show-alt"></i></a>
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
                                            <a class='btn btn-info btn-sm btn-rounded' href="<?php echo base_url('pemilik/pemesanan/detail/'.$row->kode_pembelian); ?>"><i class="bx bx-fw bx-show-alt"></i></a>
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
                                            <a class='btn btn-info btn-sm btn-rounded' href="<?php echo base_url('pemilik/pemesanan/detail/'.$row->kode_pembelian); ?>"><i class="bx bx-fw bx-show-alt"></i></a>
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
                                            <a class='btn btn-info btn-sm btn-rounded' href="<?php echo base_url('pemilik/pemesanan/detail/'.$row->kode_pembelian); ?>"><i class="bx bx-fw bx-show-alt"></i></a>
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
                                            <a class='btn btn-info btn-sm btn-rounded' href="<?php echo base_url('pemilik/pemesanan/detail/'.$row->kode_pembelian); ?>"><i class="bx bx-fw bx-show-alt"></i></a>
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
                                            <a class='btn btn-info btn-sm btn-rounded' href="<?php echo base_url('pemilik/pemesanan/detail/'.$row->kode_pembelian); ?>"><i class="bx bx-fw bx-show-alt"></i></a>
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
    var url_outlet =  "<?php echo base_url('pemilik/pemesanan'); ?>";
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

</body>
</html>