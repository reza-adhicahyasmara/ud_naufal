<?php $this->load->view('backend/partials/head.php'); ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><span class="nav-icon bx bx-fw bx-home"></span>Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
    <section class="content">
        <div class="container-fluid">
            <div class="row">    
                <div class="col-md-2 col-6">
                    <div class="small-box bg-white">
                        <div class="inner">
                            <span>Penerimaan Penawaran Produk</span>
                            <br>
                            <span class="text-lg text-bold"><?php echo number_format($total_proses_penawaran, 0, ".", "."); ?> Produk</span>
                        </div>
                        <div class="icon">
                            <i class="bx bx-md bx-news"></i>
                        </div>
                    </div>
                </div>          
                <div class="col-md-2 col-6">
                    <div class="small-box bg-white">
                        <div class="inner">
                            <span>Proses Penawaran Produk</span>
                            <br>
                            <span class="text-lg text-bold"><?php echo number_format($total_terima_penawaran, 0, ".", "."); ?> Produk</span>
                        </div>
                        <div class="icon">
                            <i class="bx bx-md bx-news"></i>
                        </div>
                    </div>
                </div>          
                <div class="col-md-2 col-6">
                    <div class="small-box bg-white">
                        <div class="inner">
                            <span>Menunggu Pembayaran</span>
                            <br>
                            <span class="text-lg text-bold"><?php echo number_format($total_menunggu_pembayaran, 0, ".", "."); ?> Transaksi</span>
                        </div>
                        <div class="icon">
                            <i class="bx bx-md bx-refresh"></i>
                        </div>
                    </div>
                </div>      
                <div class="col-md-2 col-6">
                    <div class="small-box bg-white">
                        <div class="inner">
                            <span>Validasi Pembayaran</span>
                            <br>
                            <span class="text-lg text-bold"><?php echo number_format($total_validasi_pembayaran, 0, ".", "."); ?> Transaksi</span>
                        </div>
                        <div class="icon">
                            <i class="bx bx-md bx-check-square"></i>
                        </div>
                    </div>
                </div>          
                <div class="col-md-2 col-6">
                    <div class="small-box bg-white">
                        <div class="inner">
                            <span>Dalam Pengiriman</span>
                            <br>
                            <span class="text-lg text-bold"><?php echo number_format($total_dalam_pengiriman, 0, ".", "."); ?> Transaksi</span>
                        </div>
                        <div class="icon">
                            <i class="bx bx-md bxs-truck"></i>
                        </div>
                    </div>
                </div>         
                <div class="col-md-2 col-6">
                    <div class="small-box bg-white">
                        <div class="inner">
                            <span>Penjualan</span>
                            <br>
                            <span class="text-lg text-bold">Rp. <?php echo number_format($total_penjualan, 0, ".", "."); ?></span>
                        </div>
                        <div class="icon">
                            <i class="bx bx-md bx-money"></i>
                        </div>
                    </div>
                </div>                             
            </div> 
        </div>
    </section>   
</div> 

<?php $this->load->view('backend/partials/footer.php') ?>
<?php $this->load->view('backend/partials/script.php') ?>

<script language="JavaScript">

    var url = window.location;
    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).addClass('active ');
    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');

</script>



<script>
    $(document).ready(function() {
        $('.kode_produk').select2({
            theme: 'bootstrap4',
        })
    });
</script>


</body>
</html>
