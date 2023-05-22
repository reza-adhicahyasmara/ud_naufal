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
            <th id="" style="text-align: center; vertical-align: middle;">Status Item</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $no = 1;
            $subtotal_ipembelian = 0;
            foreach($list_produk->result() as $row) {
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
            <td style="text-align: right; vertical-align: middle;"><?php echo number_format($row->harga_ipembelian, 0, ".", ".");?></td>
            <td style="text-align: right; vertical-align: middle;"><?php echo number_format($row->qty_ipembelian, 0, ".", ".")." ".$row->satuan_produk;?></td>
            <td style="text-align: right; vertical-align: middle;"><?php echo number_format($subtotal_ipembelian += $row->subtotal_ipembelian, 0, ".", ".");?></td>
            <td style="text-align: center; vertical-align: middle;">
                <?php 
                    $status_ipembelian = $row->status_ipembelian;
                    if($status_ipembelian == "Retur"){
                        echo "Retur<br>Jumlah : ".$row->qty_retur_ipembelian."<br>Ket : ".$row->keterangan_retur_ipembelian;
                    }else{
                        echo $status_ipembelian;
                    }
                ?>
            </td>
        </tr>
            <?php $no++; } ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="7" style="text-align: right; vertical-align: middle;">Total</td>
            <td style="text-align: right; vertical-align: middle;"><?php echo number_format($subtotal_ipembelian, 2, ",", "."); ?></td>
            <td></td>
        </tr>
    </tfoot>
</table>

