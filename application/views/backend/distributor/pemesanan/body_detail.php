<?php 

    $this->load->view('backend/partials/head.php');

    $status_pembelian = $data_detail['status_pembelian'];
    $status_pby_pembelian = $data_detail['status_pby_pembelian'];
?>

    <input type="hidden" id="status_pembelian" value="<?php echo $data_detail['status_pembelian'];?>" />
    <input type="hidden" id="total_pby_pembelian" value="<?php echo $data_detail['total_pby_pembelian'];?>" />
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-1 text-dark"><i class="nav-icon bx bx-fw bxs-calendar-check"></i> Detail Pemesanan</h1>
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
                                <button class="btn btn-danger" id="btn_pembatalan_pemesanan" style="width:200px; margin-left:5px;"><i class="bx bx-fw bx-x"></i> Batalkan Pemesanan</button>
                            </div>
                        <?php }elseif($status_pembelian > 1){ ?>
                            <div class="form-group">
                                <button class="btn btn-success" id="btn_bukti_pembayaran" style="width:200px; margin-left:5px;"><i class="bx bx-fw bx-money"></i> Lihat Pembayaran </button>
                            </div>
                        <?php if($status_pembelian == 2){ ?>
                            <div class="form-group">
                                <button class="btn btn-primary" id="btn_verifikasi_pembayaran" style="width:200px; margin-left:5px;"><i class="bx bx-fw bx-check"></i> Verifikasi Pembayaran</button>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-danger" id="btn_pembatalan_pembayaran" style="width:200px; margin-left:5px;"><i class="bx bx-fw bx-x"></i> Batalkan Pembayaran</button>
                            </div>
                        <?php } else if($status_pembelian == 3){ ?>
                            <div class="form-group">
                                <button class="btn btn-primary" id="btn_pengiriman" style="width:200px; margin-left:5px;"><i class="fa fa-truck"></i> Kirim</button>
                            </div>
                        <?php } else if($status_pembelian == 7){ ?>
                            <div class="form-group">
                                <button class="btn btn-primary" id="btn_pengiriman_retur" style="width:200px; margin-left:5px;"><i class="fa fa-truck"></i> Kirim Retur</button>
                            </div>
                        <?php
                                }    
                            }
                        ?>
                        <div class="form-group">
                            <a href="<?php echo base_url('distributor/pemesanan/invoice/').$data_detail['kode_pembelian'];?>"target="_blank" class="btn btn-warning" style="margin-left: 5px;"><span class="bx bx-fw bx-printer"></span> Print</a>
                        </div>
                    </div>
                </div>
            </div>
            <section class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h4>Data Pemesanan</h4>
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
                                            } elseif($status_pembelian==7){
                                                echo "<span class='badge badge-danger text-md'>Diretur</span>";
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
                            <br>
                            <br>
                            <h4>Daftar Produk</h4>
                            <div id="content_item_pemesanan">
                                <!--LOAD DATA-->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    <form>        
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
                        <div id="alert_edit"></div>                               
                        <div class="form-group">
                            <div style="text-align: center;">
                                <div style="border-radius:5px; border:1px solid #ced4da">
                                    <div class="dz-default dz-message" data-dz-message="">
                                        <img src="<?php echo base_url('assets/img/transaksi/').$data_detail['bukti_pby_pembelian'];?>" class="product-image" alt="Image">
                                    </div>
                                </div>
                            <input type="hidden" name="kode_pembelian" id="kode_pembelian" value="<?php echo $data_detail['kode_pembelian']; ?>"/>
                            <input type="hidden" name="bukti_pby_pembelian" id="bukti_pby_pembelian"/>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="bx bx-fw bx-x"></span> Batal</button>
                    </div>
                </div>
            </div>
        </div>       
    </form>

    
    <?php $this->load->view('backend/partials/footer.php') ?>
    <?php $this->load->view('backend/partials/script.php') ?>


<!-----------------------FUNGSI----------------------->
<script type="text/javascript">
    var url_outlet =  "<?php echo base_url('distributor/pemesanan'); ?>";
    var url = url_outlet ;
    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).addClass('active ');
    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
</script>


<script type="text/javascript">
    load_data_item_pemesanan();
    function load_data_item_pemesanan(){
        var kode_pembelian = "<?php echo $this->uri->segment(4); ?>";
        var total_pby_pembelian = $('#total_pby_pembelian').val();
        var status_pembelian = $('#status_pembelian').val();

        $.ajax({
            method : "POST",
            url : '<?php echo base_url('distributor/pemesanan/load_data_item_pemesanan');?>',
            data : {
                kode_pembelian:kode_pembelian,
                total_pby_pembelian:total_pby_pembelian,
                status_pembelian:status_pembelian
            },
            beforeSend : function(){
                $('#content_item_pemesanan').html('<div style="text-align:center"><i class="bx bx-loader-alt bx-md bx-spin" style="margin-top: 30px; margin-bottom: 30px;" aria-hidden="true"></i></div>');
            },
            success : function(response){
                $('#content_item_pemesanan').html(response);
            }
        });
    };
</script>


<!-----------------------KONFIRMASI PEMBAYARAN----------------------->
<script>
    $('#btn_bukti_pembayaran').on("click",function(){
        $('#modal_bukti_pembayaran').modal('show');
        $('.modal-title').text('Bukti Pembayaran');
    });

    var url_global = '<?php echo base_url('distributor/pemesanan/update_pemesanan'); ?>';
    
    $('#btn_verifikasi_pembayaran').on("click",function(){
        var kode_pembelian = $('#kode_pembelian').val();
        var status_pembelian = "3";
        var status_pby_pembelian = "Lunas";

        Swal.fire({
            title: 'Verifikasi Pembayaran',
            text: 'Apakah anda yakin memverifikasi pembayaran ini',
            type: 'warning',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#17a2b8',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, simpan',
            cancelButtonText: "Tidak, batalkan",
            showLoaderOnConfirm: true,

            preConfirm: (response) => {       
                $.ajax({
                    url: url_global,
                    method: 'POST',
                    data: {
                        kode_pembelian:kode_pembelian,
                        status_pembelian:status_pembelian,
                        status_pby_pembelian:status_pby_pembelian
                    },   
                    success: function(response){ 
                        if(response==1){
                            Swal.fire({
                                icon: 'success',
                                title: 'Data telah diupdate!',
                                showConfirmButton: true,
                                confirmButtonColor: '#17a2b8',
                                timer: 3000
                            }).then(function(){
                                window.location.reload();
                            })
                        }     
                    }
                })
            },
        });
    });

    $('#btn_pembatalan_pembayaran').on("click",function(){
        var kode_pembelian = $('#kode_pembelian').val();
        var status_pembelian = "6";
        var status_pby_pembelian = "Dana Dikembalikan";

        Swal.fire({
            title: 'Verifikasi Pembatalan Pembayaran',
            type: 'warning',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#17a2b8',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, simpan',
            cancelButtonText: "Tidak, batalkan",
            showLoaderOnConfirm: true,
            html: `<textarea type="text" id="keterangan_pembelian" class="swal2-input" placeholder="Keterangan" style="height:100px"></textarea>`,

            preConfirm: (response) => {                 
                const keterangan_pembelian = Swal.getPopup().querySelector('#keterangan_pembelian').value
                if(response==1){
                    if (!keterangan_pembelian) {
                        Swal.showValidationMessage('Keterangan tidak boleh kosong')
                    }else{
                        $.ajax({
                            url: url_global,
                            method: 'POST',
                            data: {
                                kode_pembelian:kode_pembelian,
                                keterangan_pembelian:keterangan_pembelian,
                                status_pembelian:status_pembelian,
                                status_pby_pembelian:status_pby_pembelian
                            },   
                            success: function(response){ 
                                if(response==1){
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Data telah diupdate!',
                                        showConfirmButton: true,
                                        confirmButtonColor: '#17a2b8',
                                        timer: 3000
                                    }).then(function(){
                                        window.location.reload();
                                    })
                                }     
                            }
                        })
                    }
                }
            }
        })
    });
</script>


<!-----------------------KONFIRMASI PENGIRIMAN----------------------->
<script>
    $('#btn_pengiriman').on("click",function(){
        var kode_pembelian = $('#kode_pembelian').val();
        var status_pembelian = "4";
        var status_pby_pembelian = "Lunas";

        Swal.fire({
            title: 'Verifikasi Pengiriman',
            text: 'Pastikan pengiriman sesuai dengan pemesanan',
            type: 'warning',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#17a2b8',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, simpan',
            cancelButtonText: "Tidak, batalkan",
            showLoaderOnConfirm: true,

            preConfirm: (response) => {       
                $.ajax({
                    url: url_global,
                    method: 'POST',
                    data: {
                        kode_pembelian:kode_pembelian,
                        status_pembelian:status_pembelian,
                        status_pby_pembelian:status_pby_pembelian
                    },   
                    success: function(response){ 
                        if(response==1){
                            Swal.fire({
                                icon: 'success',
                                title: 'Data telah diupdate!',
                                showConfirmButton: true,
                                confirmButtonColor: '#17a2b8',
                                timer: 3000
                            }).then(function(){
                                window.location.reload();
                            })
                        }else{
                            Swal.fire({
                                icon: 'warning',
                                title: response,
                                showConfirmButton: true,
                                confirmButtonColor: '#17a2b8',
                                timer: 3000
                            })
                        }     
                    }
                })
            },
        });
    });

</script>


<!-----------------------KONFIRMASI PENGIRIMAN----------------------->
<script>
    $('#btn_pengiriman_retur').on("click",function(){
        var kode_pembelian = $('#kode_pembelian').val();
        var status_pembelian = "7";

        Swal.fire({
            title: 'Verifikasi Pengiriman',
            text: 'Pastikan pengiriman sesuai dengan item yang telah diretur',
            type: 'warning',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#17a2b8',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, simpan',
            cancelButtonText: "Tidak, batalkan",
            showLoaderOnConfirm: true,

            preConfirm: (response) => {       
                $.ajax({
                    url: url_global,
                    method: 'POST',
                    data: {
                        kode_pembelian:kode_pembelian,
                        status_pembelian:status_pembelian
                    },   
                    success: function(response){ 
                        if(response==1){
                            Swal.fire({
                                icon: 'success',
                                title: 'Data telah diupdate!',
                                showConfirmButton: true,
                                confirmButtonColor: '#17a2b8',
                                timer: 3000
                            }).then(function(){
                                window.location.reload();
                            })
                        }else{
                            Swal.fire({
                                icon: 'warning',
                                title: response,
                                showConfirmButton: true,
                                confirmButtonColor: '#17a2b8',
                                timer: 3000
                            })
                        }     
                    }
                })
            },
        });
    });

</script>
    

<!-----------------------KONFIRMASI PEMBATALAN PEMESANAN----------------------->
<script>
    $('#btn_pembatalan_pemesanan').on("click",function(){
        var kode_pembelian = $('#kode_pembelian').val();
        var status_pembelian = "6";
        var status_pby_pembelian = "1";

        Swal.fire({
            title: 'Verifikasi Pembayaran',
            text: 'Apakah anda yakin memverifikasi pembayaran ini',
            type: 'warning',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#17a2b8',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, simpan',
            cancelButtonText: "Tidak, batalkan",
            showLoaderOnConfirm: true,
            html: `<textarea type="text" id="keterangan_pembelian" class="swal2-input" placeholder="Keterangan" style="height:100px"></textarea>`,

            preConfirm: (response) => {                 
                const keterangan_pembelian = Swal.getPopup().querySelector('#keterangan_pembelian').value
                if(response==1){
                    if (!keterangan_pembelian) {
                        Swal.showValidationMessage('Keterangan tidak boleh kosong')
                    }else{
                        $.ajax({
                            url: url_global,
                            method: 'POST',
                            data: {
                                kode_pembelian:kode_pembelian,
                                keterangan_pembelian:keterangan_pembelian,
                                status_pembelian:status_pembelian,
                                status_pby_pembelian:status_pby_pembelian
                            },   
                            success: function(response){ 
                                if(response==1){
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Data telah diupdate!',
                                        showConfirmButton: true,
                                        confirmButtonColor: '#17a2b8',
                                        timer: 3000
                                    }).then(function(){
                                        window.location.reload();
                                    })
                                }     
                            }
                        })
                    }
                }
            }
        })
    });

</script>


</body>
</html>