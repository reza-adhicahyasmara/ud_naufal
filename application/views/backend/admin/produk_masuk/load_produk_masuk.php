<table style="width:100%" id="dataTableBahanBaku" class="table table-bordered table-striped">
    <caption></caption>
    <thead>
        <tr>
            <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
            <th id="" style="text-align: center; vertical-align: middle;">Gambar</th>
            <th id="" style="text-align: center; vertical-align: middle;">Tanggal Masuk</th>
            <th id="" style="text-align: center; vertical-align: middle;">Distributor</th>
            <th id="" style="text-align: center; vertical-align: middle;">Kode Produk</th>
            <th id="" style="text-align: center; vertical-align: middle;">Produk</th>
            <th id="" style="text-align: center; vertical-align: middle;">Kategori</th>
            <th id="" style="text-align: center; vertical-align: middle;">Stok Masuk</th>
            <!-- <th id="" style="text-align: center; vertical-align: middle;">Status Retur</th> -->
        </tr>
    </thead>
    <tbody>
        <?php 
            $stok_gudang = 0;
            $stok_pcs = 0;
            $no = 1;
            foreach($produk_masuk->result() as $row) {
                if($row->status_ipembelian == "Selesai" || $row->status_ipembelian == "Retur"){
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
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->tanggal_masuk_ipembelian;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_distributor;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->kode_produk;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_produk;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_kategori;?></td>
            <td style="text-align: right; vertical-align: middle;">
                <?php 
                    if($row->status_retur_ipembelian == "Retur"){
                        $stok_gudang = $row->qty_ipembelian - $row->qty_retur_ipembelian;
                    }elseif($row->status_retur_ipembelian == "Selesai" || $row->status_ipembelian == "Selesai"){
                        $stok_gudang = $row->qty_ipembelian;
                    }
                    echo number_format($stok_gudang, 0, ",", ".")." ".$row->satuan_produk;
                ?>
            </td>
            <!-- <td style="text-align: center; vertical-align: middle;">
                <?php
                    if($row->status_retur_ipembelian == ""){
                        echo "-";
                    }else{
                        echo $row->status_retur_ipembelian;
                    }
                ?>
            </td> -->
        </tr>
        <?php
                    $no++;
                }
            } 
        ?>
    </tbody>
</table>

<script>
    $(function () {
        $("#dataTableBahanBaku").DataTable({
        "responsive": true,
        "autoWidth": false,
        });
    });
</script>