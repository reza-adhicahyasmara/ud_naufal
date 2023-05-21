<table style="width:100%" id="dataTableBahanBaku" class="table table-bordered table-striped">
    <caption></caption>
    <thead>
        <tr>
            <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
            <th id="" style="text-align: center; vertical-align: middle;">Gambar</th>
            <th id="" style="text-align: center; vertical-align: middle;">Kode</th>
            <th id="" style="text-align: center; vertical-align: middle;">Produk</th>
            <th id="" style="text-align: center; vertical-align: middle;">Kategori</th>
            <th id="" style="text-align: center; vertical-align: middle;">Qty Dikirim</th>
            <!-- <th id="" style="text-align: center; vertical-align: middle;">Qty Retur</th> -->
            <!-- <th id="" style="text-align: center; vertical-align: middle;">Keterangan Retur</th> -->
            <!-- <th id="" style="text-align: center; vertical-align: middle;">Gambar Retur</th> -->
            <th id="" style="text-align: center; vertical-align: middle;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $no = 1;
            foreach($pengiriman_produk->result() as $row) {
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
            <td style="text-align: center; vertical-align: middle;"><?php echo number_format($row->qty_ipembelian, 0, ".", ".");?></td>
            <!-- <td style="text-align: center; vertical-align: middle;"><?php echo number_format($row->qty_retur_ipembelian, 0, ".", ".");?></td> -->
            <!-- <td style="text-align: center; vertical-align: middle;"><?php echo $row->keterangan_retur_ipembelian;?></td> -->
            <!-- <td style="text-align: center; vertical-align: middle;"><?php if($row->gambar_retur_ipembelian != ""){echo '<img src="'.base_url('assets/img/retur_produk/').$row->gambar_retur_ipembelian.'" class="product-image" alt="Image" style="width:100px">';}?></td> -->
            <td style="text-align: center; vertical-align: middle;">
                <?php if($row->status_ipembelian == "Dikirim"){ ?>
                    <a class='btn btn-warning btn-sm btn-rounded btn_status_ipesanan_retur' 
                        kode_ipembelian = "<?php echo $row->kode_ipembelian; ?>" 
                        nama_produk = "<?php echo $row->nama_produk; ?>"
                        status_ipembelian = "<?php echo $row->status_ipembelian; ?>" 
                        qty_ipembelian = "<?php echo $row->qty_ipembelian; ?>" 
                        qty_retur_ipembelian = "<?php echo $row->qty_retur_ipembelian; ?>" 
                        keterangan_retur_ipembelian = "<?php echo $row->keterangan_retur_ipembelian; ?>" 
                        gambar_retur_ipembelian = "<?php echo $row->gambar_retur_ipembelian; ?>"  
                        gambar_produk = "<?php echo $row->gambar_produk; ?>" 
                        style="margin:3px">
                        <i class="bx bx-fw bx-box"></i>Dikirim
                    </a>
                <?php }elseif($row->status_ipembelian == "Selesai"){ ?>
                    <a class='btn btn-success btn-sm btn-rounded btn_status_ipesanan_retur' 
                        kode_ipembelian = "<?php echo $row->kode_ipembelian; ?>" 
                        nama_produk = "<?php echo $row->nama_produk; ?>"
                        status_ipembelian = "<?php echo $row->status_ipembelian; ?>" 
                        qty_ipembelian = "<?php echo $row->qty_ipembelian; ?>" 
                        qty_retur_ipembelian = "<?php echo $row->qty_retur_ipembelian; ?>" 
                        keterangan_retur_ipembelian = "<?php echo $row->keterangan_retur_ipembelian; ?>" 
                        gambar_retur_ipembelian = "<?php echo $row->gambar_retur_ipembelian; ?>"  
                        gambar_produk = "<?php echo $row->gambar_produk; ?>" 
                        style="margin:3px">
                        <i class="bx bx-fw bx-check"></i>Selesai
                    </a>
                <?php } ?>
            </td>
        </tr>
        <?php
                    $no++;
                
            } 
        ?>
    </tbody>
</table>
<div class="mt-3">
    <caption>Cek dan pastikan bahan baku yang diterima sesuai dengan bahan baku yang dipesan.</caption>
</div>
<br>
<div class="panel-footer" ><button id="btn_simpan" class="btn btn-info"><i class="bx bx-fw bx-save"></i> Simpan</button></div>

<script>
    $(function () {
        $("#dataTableBahanBaku").DataTable({
        "responsive": true,
        "autoWidth": false,
        });
    });
</script>