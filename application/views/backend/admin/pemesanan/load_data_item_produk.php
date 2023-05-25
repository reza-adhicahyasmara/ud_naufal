<table style="width:100%;" id="tbl_item_toko" class="table table-bordered table-striped">
<caption></caption>
    <thead>
        <tr>
            <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
            <th id="" style="text-align: center; vertical-align: middle; width:7%">Gambar</th>
            <th id="" style="text-align: center; vertical-align: middle;">Kode</th>
            <th id="" style="text-align: center; vertical-align: middle;">Produk</th>
            <th id="" style="text-align: center; vertical-align: middle;">Kategori</th>
            <th id="" style="text-align: center; vertical-align: middle;">Harga (Rp.)</th>
            <th id="" style="text-align: center; vertical-align: middle;">Qty</th>
            <th id="" style="text-align: center; vertical-align: middle;">Subtotal (Rp.)</th>
            <th id="" style="text-align: center; vertical-align: middle; width:7%">Aksi</th>
        </tr>
    </thead>
    <?php
        $total_pby_pembelian = 0;
        $total_berat = 0;
        $no = 1;
        foreach($tmp->result() as $tmp){
            if($tmp->status_ipembelian == "Keranjang"){
    ?>
    <tr>
        <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
        <td style="text-align: center; vertical-align: middle;">     
            <?php if(date('Y-m-d', strtotime($tmp->tanggal_produk. ' + 7 days')) >= date("Y-m-d") && $tmp->tanggal_produk <= date('Y-m-d', strtotime('+7 days'))){ ?>
                    <div class="position-relative">
                        <?php if($tmp->gambar_produk != ""){ ?>
                            <img src="<?php echo base_url('assets/img/produk/'.$tmp->gambar_produk);?>" alt="Image" class="img-fluid" style="width:80px; height:80px; object-fit:cover; background:white;">
                        <?php }else{ ?>
                            <img src="<?php echo base_url('assets/img/banner/box.svg');?>" alt="Image" alt="Image" style="width:60px; height:60px; margin-top: 9px; object-fit:cover;">
                        <?php } ?>
                        <div class="ribbon-wrapper">
                            <div class="ribbon <?php if($tmp->perubahan_produk == "Baru"){ echo "bg-warning";}elseif($tmp->perubahan_produk == "Harga Turun"){ echo "bg-success";}elseif($tmp->perubahan_produk == "Harga Naik"){ echo "bg-danger";}?>">
                                <?php echo $tmp->perubahan_produk;?>
                            </div>
                        </div>
                    </div>                 
            <?php
                }else{ 
                    if($tmp->gambar_produk != ""){
            ?>
                    <img src="<?php echo base_url('assets/img/produk/'.$tmp->gambar_produk);?>" alt="Image" class="img-fluid" style="width:80px; height:80px; object-fit:cover; background:white;">
                <?php }else{ ?>
                    <img src="<?php echo base_url('assets/img/banner/box.svg');?>" alt="Image" alt="Image" style="width:60px; height:60px; margin-top: 9px; object-fit:cover;">
            <?php 
                    } 
                }
            ?>
        </td>
        <td style="text-align: left; vertical-align: middle;"><?php echo $tmp->kode_produk;?></td>
        <td style="text-align: left; vertical-align: middle;"><?php echo $tmp->nama_produk;?></td>
        <td style="text-align: left; vertical-align: middle;"><?php echo $tmp->nama_kategori;?></td>
        <td style="text-align: right; vertical-align: middle;"><?php echo number_format($tmp->harga_ipembelian, 0, ".", ".");?></td>
        <td style="text-align: right; vertical-align: middle;"><?php echo number_format($tmp->qty_ipembelian, 0, ".", ".")." ".$tmp->satuan_produk;?></td>
        <td style="text-align: right; vertical-align: middle;"><?php echo number_format($tmp->subtotal_ipembelian, 0, ".", ".");?></td>
        <td style="text-align: center; vertical-align: middle;">
            <a class='btn btn-danger btn-sm btn-rounded btn_hapus_item_pemesanan' kode_ipembelian="<?php echo $tmp->kode_ipembelian; ?>"><i class="bx bx-fw bx-trash"></i></a>
        </td>
    </tr>
    <?php
                $total_pby_pembelian += $tmp->subtotal_ipembelian;
                $no++;
            }
        }
    ?>
    <tr>
        <td colspan="7"><b style="text-align: right;">Total</b></td>
        <td colspan="1"><input type="text" style="text-align: right;" readonly="readonly" value="<?php echo number_format($total_pby_pembelian, 0, ".", "."); ?>" class="form-control"></td>
            <input type="hidden" style="text-align: right;" id="total_pby_pembelian" readonly="readonly" value="<?php echo $total_pby_pembelian; ?>" class="form-control">
        <td><input type="hidden" readonly class="form-control"></td>
    </tr>
</table>

<?php if($total_pby_pembelian != 0){?>
<div class="panel-footer" alignment="right"><button id="btn_checkout" class="btn btn-info"><i class="bx bx-fw bx-check"></i> Ajukan</button></div>
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
                    <div class="form-group">
                        <label>Rekning Distributor</label>
                        <select class="form-control kode_rekening" name="kode_rekening" id="kode_rekening"></select>
                    </div>
                    <br>
                    <table id="form_tagihan" style="width: 100%;">
                    <caption></caption>
                    <th></th>
                        <tr><td style="width: 50%; text-align:left">Total Yang Harus Dibayarkan</td><td class="text-lg" style="width: 50%; text-align:right">Rp. <label id="text_total_pby_pembelian"></label></td></tr>
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

<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<script>

    $('button#btn_checkout').on("click",function(){
        var id_distributor = $('#id_distributor').val();
        var total_pby_pembelian = $('#total_pby_pembelian').val();
        $('label#text_total_pby_pembelian').text(new Number(total_pby_pembelian).toLocaleString("id-ID"));
        $('#total_pby_pembelian').val(total_pby_pembelian);

        if(id_distributor == ""){
            Swal.fire({
                icon: 'error',
                title: 'distributor Kosong',
                showConfirmButton: true,
                timer: 3000
            })
        }else{
            $.ajax({
                url : '<?php echo base_url('admin/pemesanan/select_rekening'); ?>',
                method: 'POST',
                data: {id_distributor:id_distributor},
                async : false,
                dataType : 'json',
                success: function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        html += '<option value='+data[i].kode_rekening+'>'+data[i].nama_bank+' | '+data[i].no_rekening+' | '+data[i].an_rekening+'</option>';
                    }
                    $('#kode_rekening').html(html);
                }
            });     

            $('#modal_pemesanan').modal('show');
            $('.modal-title').text('Checkout');
        }
    });


    $(document).ready(function() {
        $('#btn_simpan_checkout').on("click",function(){
            var id_distributor = $('#id_distributor').val();
            var kode_rekening = $('.kode_rekening').val();
            var total_pby_pembelian = $('#total_pby_pembelian').val();
            $.ajax({
                url : '<?php echo base_url('admin/pemesanan/insert_pemesanan'); ?>',
                method: 'POST',
                data : {
                    id_distributor:id_distributor,
                    kode_rekening:kode_rekening,
                    total_pby_pembelian:total_pby_pembelian
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