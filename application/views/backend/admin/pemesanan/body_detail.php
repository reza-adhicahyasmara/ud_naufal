<?php 

    $this->load->view('backend/partials/head.php');
    
    $status_pembelian = $data_detail['status_pembelian'];
    $status_pby_pembelian = $data_detail['status_pby_pembelian'];
?>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-1 text-dark"><i class="nav-icon bx bx-fw bx-calendar-check"></i> Detail Pemesanan</h1>
                    </div>
                    <div class="col-sm-6 float-sm-right">
                        <ol class="breadcrumb float-sm-right m-2">
                        </ol>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="row mb-2">
                        <?php if($status_pembelian == 1){ ?>
                            <div class="form-group">
                                <button class="btn btn-success" id="btn_bukti_pembayaran" style="width:200px; margin-left: 5px;"><i class="bx bx-fw bx-upload"></i> Upload Pembayaran </button> 
                            </div>
                        <?php }else if($status_pembelian > 1){ ?>
                            <div class="form-group">
                                <button class="btn btn-success" id="btn_bukti_pembayaran" style="width:200px; margin-left: 5px;"><i class="bx bx-fw bx-money"></i> Lihat Pembayaran </button>
                            </div>
                        <?php } 
                        if($status_pembelian == 4){ ?>
                            <div class="form-group">
                                <a href="<?php echo base_url('admin/produk_masuk');?>" class="btn btn-primary" style="width:200px; margin-left: 5px;"><i class="bx bx-fw bxl-dropbox"></i> Produk Masuk </a>
                            </div>
                        <?php } ?>
                        <div class="form-group">
                            <a href="<?php echo base_url('admin/pemesanan/invoice/').$data_detail['kode_pembelian'];?>"target="_blank" class="btn btn-warning" style="margin-left: 5px;"><span class="bx bx-fw bx-printer"></span> Print</a>
                        </div>
                    </div>
                </div>
            </div>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h4>Data Transaksi</h4>
                                        </div>  
                                        <div class="col-sm-6">
                                            <div class="float-sm-right">    
                                                <?php
                                                    if($status_pembelian==1){
                                                        echo "<span class='badge badge-warning text-md'>Menunggu Pembayaran</span>";
                                                    } elseif($status_pembelian==2){
                                                        echo "<span class='badge badge-info text-md'>Verifikasi Pembayaran</span>";
                                                    } elseif($status_pembelian==3){
                                                        echo "<span class='badge badge-primary text-md'>Pesanan Diproses</span>";
                                                    } elseif($status_pembelian==4){
                                                        echo "<span class='badge badge-info text-md'>Pesanan Dikirim</span>";
                                                    } elseif($status_pembelian==5){
                                                        echo "<span class='badge badge-success text-md'>Pesanan Selesai</span>";
                                                    } elseif($status_pembelian==6){
                                                        echo "<span class='badge badge-danger text-md'>Pesanan Dibatalkan</span>";
                                                    } 
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <table style="width:100%" class="table table-borderless">
                                        <caption></caption>
                                        <tr>
                                            <td style="width:10%">Invoice</td>
                                            <td style="width:1%"> :</td>
                                            <td style="width:70%"><?php echo $data_detail['kode_pembelian'];?></td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal</td>
                                            <td>:</td>
                                            <td><?php echo nice_date($data_detail['tanggal_pengajuan_pembelian'],'d-m-Y H:m:s') ?></td>
                                        </tr>
                                        <tr>
                                            <td>Nama Distributor</td>
                                            <td>:</td>
                                            <td><?php echo $data_detail['nama_distributor']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Alamat Distributor</td>
                                            <td>:</td>
                                            <td><?php echo $data_detail['alamat_distributor']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>PIC Distributor</td>
                                            <td>:</td>
                                            <td><?php echo $data_detail['pic_distributor']." (".$data_detail['kontak_distributor'].")"; ?></td>
                                        </tr>
                                        <?php if($status_pembelian==6){ ?>
                                            <tr>
                                                <td>Keterangan</td>
                                                <td>:</td>
                                                <td><?php echo $data_detail['keterangan_pembelian'] ?></td>
                                            </tr>
                                        <?php } ?>
                                    </table>
                                    <hr>
                                    <br>
                                    <h4>Data Pembayaran</h4>
                                    <table style="width:100%" class="table table-borderless">
                                        <caption></caption>
                                        <tr>
                                            <td style="width:10%">Transfer</td>
                                            <td style="width:1%">:</td>
                                            <td style="width:70%"><?php echo $data_detail['nama_bank']." | ".$data_detail['no_rekening']." | ".$data_detail['an_rekening'];?></td>
                                        </tr>
                                        <tr>
                                            <td>Total Pembayaran</td>
                                            <td>:</td>
                                            <td>Rp. <?php echo number_format($data_detail['total_pby_pembelian'], 2, ",", ".");?></td>
                                        </tr>
                                        <tr>
                                            <td>Status Pembayaran</td>
                                            <td>:</td>
                                            <td><?php echo $status_pby_pembelian; ?></td>
                                        </tr>
                                    </table>
                                    <hr>
                                    <br>
                                    <h4>Daftar Produk</h4>
                                    <div id="content_item_pembelian">
                                        <!--LOAD DATA-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

            
    <form role="form" class="form_upload_pembayaran" id="form_upload_pembayaran" method="post" aria-label="">
        <div id="modal_bukti_pembayaran" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body"> 
                        <?php if($status_pembelian == 1){ ?>
                            <div class="form-group">
                                <div style="text-align: center;">
                                    <div class="d-flex justify-content-center">
                                        <div class="form-group mb-3 text-center">
                                            <div class="form-control" style="padding: 0px; width:180px; height: 180px;">
                                                <img id="blah" src="<?php echo base_url('assets/img/banner/receipt.svg');?>" class="product-image" alt="Gambar Promo" style="border-radius: 3px; width:180px; height:180px; object-fit: cover; ">  
                                            </div>
                                            <input class="hidden" accept="image/*" type="file" id="bukti_pby_pembelian" name="file" style="display: none;" />
                                            <label class="btn btn-primary btn-sm" for="bukti_pby_pembelian">Pilih Berkas</label>
                                        </div>
                                    </div>
                                    <input type="hidden" name="kode_pembelian" id="kode_pembelian" value="<?php echo $data_detail['kode_pembelian']; ?>"/>
                                </div>
                                <div class="mt-3">
                                    <caption>Upload bukti pembayaran sesuai dengan tagihan dan nomer rekening yang dipili sebelumnya.</caption>    
                                </div>
                            </div>     
                        <?php } else { ?>                      
                        <div class="form-group">
                            <div style="text-align: center;">
                                <div style="border-radius:5px; border:1px solid #ced4da">
                                    <div class="dz-default dz-message" data-dz-message="">
                                        <img src="<?php echo base_url('assets/img/transaksi/').$data_detail['bukti_pby_pembelian'];?>" class="product-image" alt="Image">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class="bx bx-fw bx-x"></span> Batal</button>
                        <?php if($status_pembelian == 1){ ?>
                            <button type="button" id="simpan_upload" class="btn btn-info"><span class="bx bx-fw bx-save"></span> Unggah</button>
                        <?php } ?>
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
</script>


<script type="text/javascript">
    load_data_item_pembelian();
    function load_data_item_pembelian(){
        var kode_pembelian = "<?php echo $this->uri->segment(4); ?>";
        var total_pby_pembelian = "<?php echo $data_detail['total_pby_pembelian'];?>";

        $.ajax({
            url : '<?php echo base_url('admin/pemesanan/load_data_item_pembelian');?>',
            method : "POST",
            data : {
                kode_pembelian:kode_pembelian,
                total_pby_pembelian:total_pby_pembelian
            },
            beforeSend : function(){
                $('#content_item_pembelian').html('<div style="text-align:center"><i class="bx bx-loader-alt bx-md bx-spin" style="margin-top: 30px; margin-bottom: 30px;" aria-hidden="true"></i></div>');
            },
            success : function(response){
                $('#content_item_pembelian').html(response);
            }
        });
    };
</script>


<!-----------------------TRANSAKSI PEMBAYARAN----------------------->
<script type="text/javascript">

    <?php if($data_detail['bukti_pby_pembelian'] == ""){ ?>
        bukti_pby_pembelian.onchange = evt => {
            const [file] = bukti_pby_pembelian.files
            if (file) {
                blah.src = URL.createObjectURL(file)
            }
        } 
    <?php } ?>

    $('#simpan_upload').on("click",function(e){
        $.ajax({
            url : '<?php echo base_url('admin/pemesanan/update_bukti_pembayaran'); ?>',
            method: 'POST',
            data: new FormData($('#form_upload_pembayaran')[0]),
            processData:false,
            contentType:false,
            cache:false,
            async:false,
            success: function(response){
                if(response==1){
                        Swal.fire({
                        icon: 'success',
                        title: 'Berhasil diupload!',
                        showConfirmButton: true,
                        confirmButtonColor: '#17a2b8',
                        timer: 3000
                    }).then(function(){
                        window.location.reload();
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: response,
                        showConfirmButton: true,
                        confirmButtonColor: '#17a2b8',
                        timer: 3000
                    })
                }
            }
        });
    });

    $('#btn_bukti_pembayaran').on("click",function(){
        $('#modal_bukti_pembayaran').modal('show');
        $('.modal-title').text('Bukti Pembayaran');
    });
</script>

</body>
</html>