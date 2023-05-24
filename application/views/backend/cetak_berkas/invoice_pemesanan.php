<?php $this->load->view('backend/partials/head.php'); ?>
<section id="portfolio-details" class="portfolio-details">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="d-flex justify-content-center ">
            <img src="<?php echo base_url('assets/img/banner/logo.jpg'); ?>" class="brand-image" alt="Image" style="height: 70px;">
            <!-- <h1 class="text-bold ml-2 mt-3">UD Naufal</h1> -->
        </div>
        <div>
            <span class="text-bold fs-4">Invoice</span>
            <span class="text-bold fs-6"><?php echo $data_detail['kode_pembelian']; ?></span>
        </div>
    </div>
    <hr>
    <div class="row mb-3">
        <div class="col-6 mb-3">
            <span class="text-bold fs-6">Diterbitkan Oleh</span>
            <table class="table-borderless">
                <caption></caption>
                <tr>
                    <th id="" style="width: 30%; vertical-align: top;"><small>Penjual</small></th>
                    <td style="width: 5%; vertical-align: top;"><small>:</small></td>
                    <td style="vertical-align: top;"><small><?php echo $data_detail['nama_distributor']; ?></small></td>
                </tr>
                <tr>
                    <th id="" style="width: 30%; vertical-align: top;"><small>No. Kontak</small></th>
                    <td style="width: 5%; vertical-align: top;"><small>:</small></td>
                        <td style="vertical-align: top;"><small><?php echo $data_detail["kontak_distributor"]." (".$data_detail['pic_distributor'].")";?></small></td>
                </tr>
                <tr>
                    <th id="" style="width: 30%; vertical-align: top;"><small>Alamat</small></th>
                    <td style="width: 5%; vertical-align: top;"><small>:</small></td>
                    <td style="vertical-align: top;"><small><?php echo $data_detail['alamat_distributor']; ?></small></td>
                </tr>
            </table>
        </div>
        <div class="col-6 mb-3">
            <span class="text-bold fs-6">Untuk</span>
            <table class="table-borderless">
                <caption></caption>
                <thead>
                    <tr>
                        <th id="" style="width: 30%; vertical-align: top;"><small>Pembeli</small></th>
                        <td style="width: 5%; vertical-align: top;"><small>:</small></td>
                        <td style="vertical-align: top;"><small>UD Naufal</small></td>
                    </tr>
                    <tr>
                        <th id="" style="width: 30%; vertical-align: top;"><small>Tanggal Pembelian</small></th>
                        <td style="width: 5%; vertical-align: top;"><small>:</small></td>
                        <td style="vertical-align: top;"><small><?php echo $data_detail['tanggal_pengajuan_pembelian']; ?></small></td>
                    </tr>
                    <tr>
                        <th id="" style="width: 30%; vertical-align: top;"><small>No. Kontak</small></th>
                        <td style="width: 5%; vertical-align: top;"><small>:</small></td>
                    <td style="vertical-align: top;"><small>087744233339 -  08977011090</small></td>
                    </tr>
                    <tr>
                        <th id="" style="width: 30%; vertical-align: top;"><small>Alamat</small></th>
                        <td style="width: 5%; vertical-align: top;"><small>:</small></td>
                        <td style="vertical-align: top;"><small>Jl. Raya Garawangi, desa Purwasari kecamatan Garawangi kabupaten Kuningan 45571</small>
                        </td>
                    </tr>
                    
                </thead>
            </table>
        </div>
    </div>
    <table style="width:100%" id="datatable_admin" class="table">
        <caption></caption>
        <thead>
            <tr>
                <th id="" style="text-align: center; vertical-align: middle; "><strong>Nama Produk</strong></th>
                <th id="" style="text-align: center; vertical-align: middle; "><strong>Jumlah</strong></th>
                <th id="" style="text-align: center; vertical-align: middle; "><strong>Harga Satuan</strong></th>
                <th id="" style="text-align: center; vertical-align: middle; "><strong>Total Harga</strong></th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $jumlah_produk = 0;
                $total_pby_pembelian = 0;
                foreach($list_produk->result() as $item){
                    if($item->status_ipembelian > 1 ){
            ?>
            <tr>
                <td class="text-sm" style="text-align: left; vertical-align: middle;"><?php echo $item->nama_produk;?></td>
                <td class="text-sm" style="text-align: right; vertical-align: middle;"><?php echo number_format($item->qty_ipembelian, 0, ".", ".")." ".$item->satuan_produk;?></td>
                <td class="text-sm" style="text-align: right; vertical-align: middle;"><?php echo "Rp ".number_format($item->harga_ipembelian, 0, ".", ".");?></td>
                <td class="text-sm" style="text-align: right; vertical-align: middle;"><?php echo "Rp ".number_format($item->subtotal_ipembelian, 0, ".", ".");?></td>
            </tr>
            <?php      
                        $jumlah_produk += 1; 
                    } 
                }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="1"></td>
                <td colspan="2" class="text-sm" style="text-align: left; vertical-align: middle;"><strong>Total Harga (<?php echo $jumlah_produk; ?> Produk) </strong></td>
                <td class="text-sm" style="text-align: right; vertical-align: middle;"><?php echo "Rp ".number_format($data_detail['total_pby_pembelian'], 0, ".", ".");?></td>
            </tr>
        </tfoot>
    </table>
    <hr>
    
    <div class="row mb-3">
        <div class="col-6 mb-3">
            <span class="text-bold fs-6">Info Pemabayaran</span>
            <table class="table-borderless">
                <caption></caption>
                <thead>
                    <tr>
                        <th id="" style="width: 35%; vertical-align: top;"><small>No Rekening</small></th>
                        <td style="width: 5%; vertical-align: top;"><small>:</small></td>
                        <td style="vertical-align: top;"><small><?php echo $data_detail['no_rekening']; ?></td>
                    </tr>
                    <tr>
                        <th id="" style="width: 35%; vertical-align: top;"><small>Bank</small></th>
                        <td style="width: 5%; vertical-align: top;"><small>:</small></td>
                        <td style="vertical-align: top;"><small><?php echo $data_detail['nama_bank']; ?></td>
                    </tr>
                    <tr>
                        <th id="" style="width: 35%; vertical-align: top;"><small>Atas Nama</small></th>
                        <td style="width: 5%; vertical-align: top;"><small>:</small></td>
                        <td style="vertical-align: top;"><small><?php echo $data_detail['an_rekening']; ?></td>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="col-6 mb-3 text-center p-2">
            <h4>Status Pembayaran</h4>
            <h2 class="text-bold"><?php echo $data_detail['status_pby_pembelian'];?></h2>
        </div>
    </div>
</section>

<?php $this->load->view('backend/partials/footer.php') ?>
<?php $this->load->view('backend/partials/script.php') ?>

<!-----------------------FUNGSI----------------------->
<script>
    window.print();
    $("nav").remove(".main-header");
    $("aside").remove(".main-sidebar");
    $("div").remove(".preloader");
</script>

</body>
</html>
