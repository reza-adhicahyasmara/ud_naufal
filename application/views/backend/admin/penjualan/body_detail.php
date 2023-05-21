<?php $this->load->view('backend/partials/head.php'); ?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-1 text-dark"><i class="nav-icon bx bx-fw bx-book"></i> Detail Penjualan</h1>
                </div>
                <div class="col-sm-6 float-sm-right">
                    <ol class="breadcrumb float-sm-right m-2">
                    </ol>
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
                                </div>
                                <table style="width:100%" class="table table-borderless">
                                    <caption></caption>
                                    <tr>
                                        <td style="width:10%">Invoice</td>
                                        <td style="width:1%"> :</td>
                                        <td style="width:70%"><?php echo $data_detail['kode_penjualan'];?></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal</td>
                                        <td>:</td>
                                        <td><?php echo nice_date($data_detail['tanggal_penjualan'],'d-m-Y H:m:s') ?></td>
                                    </tr>
                                    <tr>
                                        <td>Konsumen</td>
                                        <td>:</td>
                                        <td><?php echo $data_detail['nama_penjualan']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Keterangan</td>
                                        <td>:</td>
                                        <td><?php echo $data_detail['keterangan_penjualan'] ?></td>
                                    </tr>
                                </table>
                                <hr>
                                <br>
                                <h4>Data Pembayaran</h4>
                                <table style="width:100%" class="table table-borderless">
                                    <caption></caption>
                                    <tr>
                                        <td style="width:10%">Total Belanjaan</td>
                                        <td style="width:1%"> :</td>
                                        <td style="width:70%">Rp. <?php echo number_format($data_detail['total_penjualan'], 2, ",", ".");?></td>
                                    </tr>
                                    <tr>
                                        <td>Pembyaran Tunai</td>
                                        <td>:</td>
                                        <td>Rp. <?php echo number_format($data_detail['cash_penjualan'], 2, ",", ".");?></td>
                                    </tr>
                                    <tr>
                                        <td>Kembalian</td>
                                        <td>:</td>
                                        <td>Rp. <?php echo number_format($data_detail['cash_penjualan'] - $data_detail['total_penjualan'], 2, ",", ".");?></td>
                                    </tr>
                                </table>
                                <hr>
                                <br>
                                <h4>Daftar Produk</h4>
                                <div id="content_item_penjualan">
                                    <!--LOAD DATA-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>


    
<?php $this->load->view('backend/partials/footer.php') ?>
<?php $this->load->view('backend/partials/script.php') ?>

    
<!-----------------------FUNGSI----------------------->
<script type="text/javascript">
    var url_outlet =  "<?php echo base_url('admin/penjualan'); ?>";
    var url = url_outlet ;
    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).addClass('active ');
    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
</script>


<script type="text/javascript">
    load_data_item_penjualan();
    function load_data_item_penjualan(){
        var kode_penjualan = "<?php echo $this->uri->segment(4); ?>";

        $.ajax({
            url : '<?php echo base_url('admin/penjualan/load_data_item_penjualan');?>',
            method : "POST",
            data : {
                kode_penjualan:kode_penjualan,
            },
            beforeSend : function(){
                $('#content_item_penjualan').html('<div style="text-align:center"><i class="bx bx-loader-alt bx-md bx-spin" style="margin-top: 30px; margin-bottom: 30px;" aria-hidden="true"></i></div>');
            },
            success : function(response){
                $('#content_item_penjualan').html(response);
            }
        });
    };
</script>

</body>
</html>