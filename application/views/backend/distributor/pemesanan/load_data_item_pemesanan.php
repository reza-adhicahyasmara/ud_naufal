<table style="width:100%" id="dataTable11" class="table table-bordered table-striped">
    <caption></caption>
    <thead>
        <tr>
            <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Gambar</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Kode</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Produk</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Kategori</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Harga (Rp.)</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Qty</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Subtotal (Rp.)</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Status Item</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Aksi</th>
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
            <td style="text-align: center; vertical-align: middle;"><?php echo number_format($row->qty_ipembelian, 0, ".", ".");?></td>
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
            <?php if($status_pembelian == 3 && $row->status_ipembelian == "Proses"){ ?>
                <td style="text-align: center; vertical-align: middle;">
                    <a class='btn btn-success btn-sm btn-rounded btn_edit_item_produk' kode_ipembelian="<?php echo $row->kode_ipembelian; ?>"><span class="bx bx-fw bx-check"></span></a>
                </td>
            <?php }else if($status_pembelian == 4 || $status_pembelian == 7|| $status_pembelian == 6){ ?> 
                <td style="text-align: center; vertical-align: middle;">
                    <?php  if($status_ipembelian == 5){ ?>
                        <a class='btn btn-success btn-sm btn-rounded btn_edit_item_produk_terima_retur' kode_ipembelian="<?php echo $row->kode_ipembelian; ?>" qty_retur_ibb="<?php echo $row->qty_retur_ibb; ?>"  keterangan_retur_ipembelian="<?php echo $row->keterangan_retur_ipembelian; ?>"><span class="bx bx-fw bx-check"></span></a>
                    <?php } ?>
                </td>
            <?php } else { ?>
                <td style="text-align: center; vertical-align: middle;">

                </td>
            <?php } ?>
        </tr>
            <?php $no++; } ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="7" style="text-align: right; vertical-align: middle;">Total</td>
            <td style="text-align: right; vertical-align: middle;"><?php echo number_format($subtotal_ipembelian, 0, ".", "."); ?></td>
        </tr>
    </tfoot>
</table>


<script src="<?php echo base_url(); ?>assets/plugins/datetimepicker/build/jquery.datetimepicker.full.js"></script>
<script>
    $('.btn_edit_item_produk').on("click",function(){
        var kode_ipembelian = $(this).attr("kode_ipembelian");

        Swal.fire({
            title: 'Proses Pakcing',
            text: 'Pastikan produk yang dipesan sudah sesuai.',
            type: 'warning',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#17a2b8',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, simpan',
            cancelButtonText: "Tidak, batalkan",
            showLoaderOnConfirm: true,

            preConfirm: (response) => {                 
                $.ajax({
                    url: '<?php echo base_url('distributor/pemesanan/update_status_ipemesanan'); ?>',
                    method: 'POST',
                    data: {
                        kode_ipembelian:kode_ipembelian
                    },   
                    success: function(response){
                        if(response==1){
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Data telah diupdate',
                                confirmButtonColor: '#17a2b8',
                                showConfirmButton: true,
                                timer: 3000
                            }).then(function(){
                                load_data_item_pemesanan();
                            });
                        }else{
                            Swal.fire({
                                icon: 'warning',
                                title: 'Peringatan',
                                text: response,
                                showConfirmButton: true,
                                confirmButtonColor: '#17a2b8',
                                timer: 3000
                            });
                        }
                    }
                }) 
            }
        });
    });

    $('.btn_edit_item_produk_terima_retur').on("click",function(){
        var kode_ipembelian = $(this).attr("kode_ipembelian");
        var qty_retur_ibb = $(this).attr("qty_retur_ibb");
        var keterangan_retur_ipembelian = $(this).attr("keterangan_retur_ipembelian");
        var status_ipembelian = "3";

        Swal.fire({
            title: 'Kondisi Item Baik',
            text: 'Pastikan item diterima dengan kondisi baik',
            type: 'warning',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#17a2b8',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, simpan',
            cancelButtonText: "Tidak, batalkan",
            showLoaderOnConfirm: true,

            preConfirm: (response) => {       
                $.ajax({
                    url: '<?php echo base_url('gudang/pemesanan/update_status_item_produk'); ?>',
                    method: 'POST',
                    data: {
                        kode_ipembelian:kode_ipembelian,
                        qty_retur_ibb:qty_retur_ibb,
                        keterangan_retur_ipembelian:keterangan_retur_ipembelian,
                        status_ipembelian:status_ipembelian
                    },   
                    success: function(response){ 
                        if(response==1){
                            Swal.fire({
                                icon: 'success',
                                title: 'Data telah diupdate!',
                                showConfirmButton: true,
                                confirmButtonColor: '#17a2b8',
                                timer: 3000
                            }).then(function(){
                                load_data_item_pemesanan();
                            })
                        }else{
                            Swal.fire({
                                icon: 'warning',
                                title: response,
                                showConfirmButton: true,
                                confirmButtonColor: '#17a2b8',
                                timer: 3000
                            })
                        }     
                    }
                })
            },
        });
    });
</script>