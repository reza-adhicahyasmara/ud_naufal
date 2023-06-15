<?php
    $d_produk = $data['d_produk'];
    $s_produk = $data['harga_beli_produk'];
    $h_produk = $data['h_produk'];
    $lt_produk = $data['lt_produk'];
    $ss_produk = $data['ss_produk'];
    $au_produk = $data['au_produk'];

    //MENGHITUNG EOQ
    $duasd = (2 * $d_produk * $s_produk) / $h_produk;
    $eoq = sqrt($duasd);
    $eoq_pembulatan = round($eoq);
    
    //MENGHITUNG ROP
    $rop = ($lt_produk * $au_produk) + $ss_produk;
    $rop_pembulatan = round($rop);


?>

<input type="hidden" class="form-control" name="id_distributor" id="id_distributor" value="<?php echo $data['id_distributor']; ?>" readonly>
<input type="hidden" class="form-control" name="kode_produk" id="kode_produk" value="<?php echo $data['kode_produk']; ?>" readonly>
<input type="hidden" class="form-control" name="harga_ipembelian" id="harga_ipembelian" value="<?php echo $data['harga_beli_produk']; ?>" readonly>
<input type="hidden" class="form-control" name="subtotal_ipembelian" id="subtotal_ipembelian" readonly>
<input type="hidden" class="form-control" name="stok_dis_produk" id="stok_dis_produk" value="<?php echo $data['stok_dis_produk']; ?>" readonly>

<div class="row">
    <div class="col-6">
        <?php if($data['gambar_produk'] != "") { ?>
            <div class="d-flex justify-content-center">
                <div class="elevation-1" style="width: 150px; height: 150px; border:1px solid #ced4da;">
                    <img src="<?php echo base_url('assets/img/produk/'.$data['gambar_produk']);?>" alt="Image" class="elevation-1" style="width:150px; height:150px; object-fit:cover; background:white;">
                </div>
            </div>
        <?php }else{ ?>
            <div class="d-flex justify-content-center">
                <div class="elevation-1" style="width: 150px; height: 150px; border:1px solid #ced4da;">
                    <img src="<?php echo base_url('assets/img/banner/cake.png');?>" alt="Image" alt="Image" style="width:150px; height:150px; margin-top: 9px; object-fit:cover;">
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="col-6">
        <span class="text-lg"><b><?php echo $data['nama_produk']; ?></b></span>
        <div class="form-group mb-3">
            <span class="text-md">Rp. <?php echo number_format($data['harga_beli_produk'], 0, '.', '.')." / ".$data['satuan_produk']; ?></span>
            <br>
            <span class="text-md">Stok <?php echo number_format($data['stok_dis_produk'], 0, '.', '.');?> </span>    
        </div> 
        <div class="form-group mb-3">
            <div class="row">
                <button type="button" class="btn bg-info" onclick="decrement()" style="width: 25%;"><span class="fa fa-minus"></span></button>
                <input type="number" class="form-control" name="qty_ipembelian" id="qty_ipembelian"min="0" max="1000" value="<?php echo $eoq_pembulatan;?>" style="width: 50%; text-align:center">
                <button type="button" class="btn bg-info" onclick="incerment()" style="width: 25%;"><span class="fa fa-plus"></span></button>
            </div>
        </div>
        <div class="form-group float-right">
            <h5>Subtotal <b>Rp. <span id="subtotal_ipembelian_text">0</span></b></h5>
        </div>
    </div>
</div>
<hr>
<br>

<div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Analisa EOQ</a>
    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Analisa ROP</a>
</div>
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
        <div class="card-body">
            <h5>Analisa EOQ</h5>
            <p>Diketahui</p>
            <h6>
                Biaya Per Pesanan (S) = <b><?php echo "Rp. ".number_format($s_produk,0, ",", "."); ?></b><br>
                Permintaan Pertahun (D) = <b><?php echo number_format($d_produk,0, ",", ".")." ".$data['satuan_produk']; ?></b><br>
                Biaya Penyimpanan (H) = <b><?php echo "Rp. ".number_format($h_produk,0, ",", "."); ?></b><br><br>
            </h6>
            <p>Hitung</p>
            <h6>
                EOQ = &#8730; 2SD / H<br>
                EOQ = &#8730; 2 X <?php echo number_format($s_produk,0, ",", ".")." X ".number_format($d_produk,0, ",", ".")." / ".number_format($h_produk,0, ",", ".");?> <br>
                EOQ = &#8730; <?php echo number_format($duasd,3, ",", ".");?> <br>
                EOQ = <?php echo number_format($eoq,3, ",", ".");?> <br>
                EOQ = Maka dibulatkan menjadi <b><?php echo number_format($eoq_pembulatan,0, ",", ".")." ".$data['satuan_produk'];;?></b>, saran jumlah pemeblian
            </h6>
        </div>
    </div>
    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
        <div class="card-body">
            <h5>Analisa ROP</h5>
            <p>Diketahui</p>
            <h6>
                Lead Time (LT) = <b><?php echo number_format($lt_produk,0, ",", ".")." Hari"; ?></b><br>
                Average Usage (AU) = <b><?php echo number_format($d_produk,0, ",", ".")." ".$data['satuan_produk']; ?> / 317 Hari</b><br>
                Safety Stock (SS) = <b><?php echo number_format($ss_produk,0, ",", ".")." ".$data['satuan_produk']; ?></b><br><br>
            </h6>
            <p>Hitung</p>
            <h6>
                ROP = (LT X AU) + SS <br>
                ROP = <?php echo "(".number_format($lt_produk,2, ",", ".")." X ".number_format($au_produk,2, ",", ".")." ) + ".number_format($ss_produk,2, ",", ".");?> <br>
                ROP = <?php echo number_format($rop,3, ",", ".");?> <br>
                ROP = Maka dibulatkan menjadi <b><?php echo number_format($rop_pembulatan,0, ",", ".")." ".$data['satuan_produk'];;?></b>, yang dapat pemesanan kembali
            </h6>
        </div>
    </div>
</div>

<!-----------------------FUNGSI----------------------->
<script type="text/javascript">
    function incerment() {
        document.getElementById('qty_ipembelian').stepUp();
        hitung();
    }

    function decrement() {
        document.getElementById('qty_ipembelian').stepDown();
        hitung();
    }

    
    $('#qty_ipembelian').keyup(function(){
        hitung();
    })

    hitung();
    function hitung(){
        var harga_ipembelian = $('#harga_ipembelian').val();
        var qty_ipembelian = $('#qty_ipembelian').val();

        var subtotal_ipembelian = harga_ipembelian * qty_ipembelian;

        $('#subtotal_ipembelian').val(subtotal_ipembelian);
        
        $('#subtotal_ipembelian_text').text(new Number(subtotal_ipembelian).toLocaleString("id-ID"));
        $('#jumlah').text(qty_ipembelian);
    }
</script>