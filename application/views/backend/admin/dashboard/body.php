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
                            <span>Penawaran Produk</span>
                            <br>
                            <span class="text-lg text-bold"><?php echo number_format($total_penawaran_produk, 0, ".", "."); ?> Produk</span>
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
                            <span>Pembelanjaan</span>
                            <br>
                            <span class="text-lg text-bold">Rp. <?php echo number_format($total_pembelian, 0, ".", "."); ?></span>
                        </div>
                        <div class="icon">
                            <i class="bx bx-md bx-money"></i>
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

            <div class="card card-outline card-info">
                <div class="card-body"> 
                    <h4>Perubahan Harga Produk 1 Minggu Terakhir</h4>
                    <br>
                    <table style="width:100%" id="dataTable" class="table table-bordered table-striped">
                        <caption></caption>
                        <thead>
                            <tr>
                                <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
                                <th id="" style="text-align: center; vertical-align: middle; width:7%">Gambar</th>
                                <th id="" style="text-align: center; vertical-align: middle; ">Kode</th>
                                <th id="" style="text-align: center; vertical-align: middle; ">Nama</th>
                                <th id="" style="text-align: center; vertical-align: middle; ">Kategori</th>
                                <th id="" style="text-align: center; vertical-align: middle; ">Distributor</th>
                                <th id="" style="text-align: center; vertical-align: middle; ">Harga Beli (Rp.)</th>
                                <th id="" style="text-align: center; vertical-align: middle; ">Harga Jual (Rp.)</th>
                                <th id="" style="text-align: center; vertical-align: middle; ">Perubahan Harga (Rp.)</th>
                                <th id="" style="text-align: center; vertical-align: middle; ">Stok Gudang (PCS)</th>
                                <th id="" style="text-align: center; vertical-align: middle; ">Stok Limit (PCS)</th>
                                <th id="" style="text-align: center; vertical-align: middle; ">Update Data</th>
                                <th id="" style="text-align: center; vertical-align: middle; ">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $no = 1;
                                foreach($data_produk->result() as $row) {
                                    if($row->status_penawaran_produk == "Diterima" && date('Y-m-d', strtotime($row->tanggal_produk. ' + 7 days')) >= date("Y-m-d") && $row->tanggal_produk <= date('Y-m-d', strtotime('+7 days'))){
                            ?>
                            <tr>
                                <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
                                <td style="text-align: center; vertical-align: middle;">
                                    <div class="position-relative">
                                        <?php if($row->gambar_produk != ""){ ?>
                                            <img src="<?php echo base_url('assets/img/produk/'.$row->gambar_produk);?>" alt="Image" class="img-fluid" style="width:80px; height:80px; object-fit:cover; background:white;">
                                        <?php }else{ ?>
                                            <img src="<?php echo base_url('assets/img/banner/box.svg');?>" alt="Image" alt="Image" style="width:60px; height:60px; margin-top: 9px; object-fit:cover;">
                                        <?php } ?>
                                        <div class="ribbon-wrapper">
                                            <div class="ribbon <?php if($row->perubahan_produk == "Baru"){ echo "bg-warning";}elseif($row->perubahan_produk == "Harga Turun"){ echo "bg-success";}elseif($row->perubahan_produk == "Harga Naik"){ echo "bg-danger";}?>">
                                                <?php echo $row->perubahan_produk;?>
                                            </div>
                                        </div>
                                    </div>        
                                </td>
                                <td style="text-align: left; vertical-align: middle;"><?php echo $row->kode_produk;?></td>
                                <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_produk;?></td>
                                <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_kategori;?></td>
                                <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_distributor;?></td>
                                <td style="text-align: right; vertical-align: middle;"><?php echo number_format($row->harga_beli_produk, 0, ".", ".");?></td>
                                <td style="text-align: right; vertical-align: middle;"><?php echo number_format($row->harga_jual_produk, 0, ".", ".");?></td>
                                <td style="text-align: right; vertical-align: middle;"><?php echo number_format($row->perubahan_harga_produk, 0, ".", ".");?></td>
                                <td style="text-align: right; vertical-align: middle;"><?php echo number_format($row->stok_dis_produk, 0, ",", ".");?></td>
                                <td style="text-align: right; vertical-align: middle;"><?php echo number_format($row->limit_dis_produk,0, ",", ".");?></td>
                                <td style="text-align: left; vertical-align: middle;"><?php echo $row->tanggal_produk;?></td>
                                <td style="text-align: center; vertical-align: middle;">
                                    <?php 
                                        if($row->stok_dis_produk <= $row->limit_dis_produk){
                                            echo "<span class='badge rounded-pill bg-danger text-sm'>Limit</span>";
                                        }elseif($row->stok_dis_produk > $row->limit_dis_produk){
                                            echo "<span class='badge rounded-pill bg-success text-sm'>Aman</span>";
                                        }
                                    ?>
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
    $(function () {
        $("#dataTable").DataTable({
        "responsive": true,
        "autoWidth": false,
        });
    });
</script>


</body>
</html>
