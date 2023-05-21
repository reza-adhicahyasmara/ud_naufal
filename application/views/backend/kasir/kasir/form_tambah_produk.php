<input type="hidden" class="form-control" name="kode_produk" id="kode_produk" value="<?php echo $data['kode_produk']; ?>" readonly>
<input type="hidden" class="form-control" name="harga_ipenjualan" id="harga_ipenjualan" value="<?php echo $data['harga_jual_produk']; ?>" readonly>
<input type="hidden" class="form-control" name="subtotal_ipenjualan" id="subtotal_ipenjualan" readonly>
<input type="hidden" class="form-control" name="stok_tok_produk" id="stok_tok_produk" value="<?php echo $data['stok_tok_produk']; ?>" readonly>

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
            <span class="text-md">Rp. <?php echo number_format($data['harga_jual_produk'], 0, '.', '.')." / ".$data['satuan_produk']; ?></span>
            <br>
            <span class="text-md">Stok <?php echo number_format($data['stok_tok_produk'], 0, '.', '.');?> </span>    
        </div> 
        <div class="form-group mb-3">
            <div class="row">
                <button type="button" class="btn bg-info" onclick="decrement()" style="width: 25%;"><span class="fa fa-minus"></span></button>
                <input type="number" class="form-control" name="qty_ipenjualan" id="qty_ipenjualan" min="0" max="1000" value="0" style="width: 50%; text-align:center">
                <button type="button" class="btn bg-info" onclick="incerment()" style="width: 25%;"><span class="fa fa-plus"></span></button>
            </div>
        </div>
        <div class="form-group float-right">
            <h5>Subtotal <b>Rp. <span id="subtotal_ipenjualan_text">0</span></b></h5>
        </div>
    </div>
</div>
<hr>
<br>

<!-----------------------FUNGSI----------------------->
<script type="text/javascript">
    function incerment() {
        document.getElementById('qty_ipenjualan').stepUp();
        hitung();
    }

    function decrement() {
        document.getElementById('qty_ipenjualan').stepDown();
        hitung();
    }

    
    $('#qty_ipenjualan').keyup(function(){
        hitung();
    })

    hitung();
    function hitung(){
        var harga_ipenjualan = $('#harga_ipenjualan').val();
        var qty_ipenjualan = $('#qty_ipenjualan').val();

        var subtotal_ipenjualan = harga_ipenjualan * qty_ipenjualan;

        $('#subtotal_ipenjualan').val(subtotal_ipenjualan);
        
        $('#subtotal_ipenjualan_text').text(new Number(subtotal_ipenjualan).toLocaleString("id-ID"));
        $('#jumlah').text(qty_ipenjualan);
    }
</script>