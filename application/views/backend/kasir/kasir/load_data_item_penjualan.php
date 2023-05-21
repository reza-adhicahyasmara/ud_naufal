<table style="width:100%" id="dataTable11" class="table table-bordered table-striped">
    <caption></caption>
    <thead>
        <tr>
            <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
            <th id="" style="text-align: center; vertical-align: middle;">Gambar</th>
            <th id="" style="text-align: center; vertical-align: middle;">Kode</th>
            <th id="" style="text-align: center; vertical-align: middle;">Produk</th>
            <th id="" style="text-align: center; vertical-align: middle;">Kategori</th>
            <th id="" style="text-align: center; vertical-align: middle;">Harga (Rp.)</th>
            <th id="" style="text-align: center; vertical-align: middle;">Qty</th>
            <th id="" style="text-align: center; vertical-align: middle;">Subtotal (Rp.)</th>
            <th id="" style="text-align: center; vertical-align: middle;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $total_penjualan = 0;
            $no = 1;
            $subtotal_ipenjualan = 0;
            foreach($list_produk->result() as $row) {
                if($row->status_ipenjualan == 0){
        ?>
        <tr>
            <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
            <td style="text-align: center; vertical-align: middle;">
                <?php if($row->gambar_produk != "") { ?>
                    <div class="d-flex justify-content-center">
                        <div class=" elevation-1" style="width: 80px; height: 80px; border:1px solid #ced4da;">
                            <img src="<?php echo base_url('assets/img/produk/'.$row->gambar_produk);?>" alt="Image" class="elevation-1" style="width:80px; height:80px; object-fit:cover; background:white;">
                        </div>
                    </div>
                <?php }else{ ?>
                    <div class="d-flex justify-content-center">
                        <div class=" elevation-1" style="width: 80px; height: 80px; border:1px solid #ced4da;">
                            <img src="<?php echo base_url('assets/img/banner/box.svg');?>" alt="Image" alt="Image" style="width:60px; height:60px; margin-top: 9px; object-fit:cover;">
                        </div>
                    </div>
                <?php } ?>
            </td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->kode_produk;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_produk;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_kategori;?></td>
            <td style="text-align: right; vertical-align: middle;"><?php echo number_format($row->harga_ipenjualan, 0, ".", ".");?></td>
            <td style="text-align: right; vertical-align: middle;"><?php echo number_format($row->qty_ipenjualan, 0, ".", ".")." ".$row->satuan_produk;?></td>
            <td style="text-align: right; vertical-align: middle;"><?php echo number_format($subtotal_ipenjualan += $row->subtotal_ipenjualan, 0, ".", ".");?></td>
            <td style="text-align: center; vertical-align: middle;">
                <a class='btn btn-danger btn-sm btn-rounded btn_hapus_item_penjualan' kode_ipenjualan="<?php echo $row->kode_ipenjualan; ?>"><i class="bx bx-fw bx-trash"></i></a>
            </td>
        </tr>
            <?php 
                        $total_penjualan += $row->subtotal_ipenjualan;
                        $no++; 
                    }
                }
            ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="7" style="text-align: right; vertical-align: middle;">Total</td>
            <td style="text-align: right; vertical-align: middle;">
                <?php echo number_format($subtotal_ipenjualan, 2, ",", "."); ?>
                <input type="hidden"  id="total_penjualan" value="<?php echo $total_penjualan; ?>" >
            </td>
        </tr>
    </tfoot>
</table>

<?php if($total_penjualan != 0){?>
    <div class="panel-footer" alignment="right"><button id="btn_checkout" class="btn btn-info"><i class="bx bx-fw bx-check"></i> Selesai</button></div>
<?php } ?>


<form role="form" id="form_bank" method="post">
    <div id="modal_pemesanan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <strong><span class="modal-title text-lg" id="myModalLabel"></span></strong>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="form_tagihan" style="width: 100%;">
                        <caption></caption>
                        <th></th>
                        <tr>
                            <td style="width: 50%; text-align:left">Total Yang Harus Dibayarkan</td>
                            <td class="text-lg" style="width: 50%; text-align:right">Rp. <label id="text_total_penjualan"></label></td>
                        </tr>
                        <tr>
                            <td style="width: 50%; text-align:left">Uang diterima (Rp)</td>
                            <td class="text-lg" style="width: 50%; text-align:right"><input type="text" class="form-control" name="cash_penjualan" id="cash_penjualan" onkeypress="return /[0-9]/i.test(event.key)" placeholder="Rp"></td>
                        </tr>
                        <tr>
                            <td style="width: 50%; text-align:left">Nama Konsumen</td>
                            <td class="text-lg" style="width: 50%; text-align:right"><input type="text" class="form-control" name="nama_penjualan" id="nama_penjualan" placeholder="Nama"></td>
                        </tr>
                        <tr>
                            <td style="width: 50%; text-align:left">Keterangan</td>
                            <td class="text-lg" style="width: 50%; text-align:right"><textarea type="text" class="form-control" name="keterangan_penjualan" id="keterangan_penjualan" placeholder="Keterangan" style="height:100px;"></textarea></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class="bx bx-fw bx-x"></span> Batal</button>
                    <button type="button" id="btn_simpan_checkout" class="btn btn-info"><span class="bx bx-fw bx-save"></span> Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>



<script>

$('button#btn_checkout').on("click",function(){
    var total_penjualan = $('#total_penjualan').val();
    $('label#text_total_penjualan').text(new Number(total_penjualan).toLocaleString("id-ID"));
    $('#total_penjualan').val(total_penjualan);

    $('#modal_pemesanan').modal('show');
    $('.modal-title').text('Checkout');
    
});

    $(document).ready(function() {
        $('#btn_simpan_checkout').on("click",function(){
            var cash_penjualan = $('#cash_penjualan').val();
            var nama_penjualan = $('#nama_penjualan').val();
            var total_penjualan = $('#total_penjualan').val();
            var keterangan_penjualan = $('#keterangan_penjualan').val();
            $.ajax({
                url : '<?php echo base_url('kasir/kasir/insert_penjualan'); ?>',
                method: 'POST',
                data : {
                    cash_penjualan:cash_penjualan,
                    nama_penjualan:nama_penjualan,
                    total_penjualan:total_penjualan,
                    keterangan_penjualan:keterangan_penjualan,
                },
                success: function(response){
                    if(response==1){
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Data telah ditambahkan',
                            showConfirmButton: true,
                            confirmButtonColor: '#17a2b8',
                            timer: 3000
                        }).then(function(){
                            window.location.replace(url_outlet);
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: response,
                            showConfirmButton: true,
                            confirmButtonColor: '#17a2b8',
                            timer: 3000
                        })
                    }
                }
            }); 
        });
    });

</script>