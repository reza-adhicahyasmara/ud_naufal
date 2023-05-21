<table style="width:100%" id="" class="table table-bordered table-striped">
    <caption></caption>
    <thead>
        <tr>
            <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Gambar</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Kode</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Nama</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Kategori</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Harga (Rp.)</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Stok Gudang</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Stok Limit</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $no = 1;
            $haha = 0;
            foreach($produk->result() as $row) {
                if($row->ID == $this->session->userdata('ses_id_distributor') && $row->status_penawaran_produk == "Ditawarkan"){
        ?>
        <tr>
            <td style="text-align: center; vertical-align: middle;"><?php echo $haha += $no;?></td>
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
            <td style="text-align: right; vertical-align: middle;"><?php echo number_format($row->harga_beli_produk,0, ",", ".");?></td>
            <td style="text-align: right; vertical-align: middle;"><?php echo number_format($row->stok_dis_produk,0, ",", ".")." ".$row->satuan_produk;?></td>
            <td style="text-align: right; vertical-align: middle;"><?php echo number_format($row->limit_dis_produk,0, ",", ".")." ".$row->satuan_produk;?></td>
            <td style="text-align: center; vertical-align: middle;" >
                <a class='btn btn-danger btn-sm btn-rounded btn_hapus_produk' nama_produk="<?php echo $row->nama_produk; ?>" kode_produk="<?php echo $row->kode_produk; ?>" style="margin:3px"><span class="bx bx-fw bx-trash"></span></a>
            </td>
        </tr>
        <?php
                    $no++;
                }
            } 
        ?>
    </tbody>
</table>

<?php if($haha != 0){?>
    <div class="panel-footer float-right">
        <button type="button" id="btn_simpan_penawaran" class="btn btn-info"><span class="bx bx-fw bx-save"></span> Simpan</button>
    </div>
<?php } ?>

<script>
    $(function () {
        $("#dataTable").DataTable({
        "responsive": true,
        "autoWidth": false,
        });
    });
</script>

<!-----------------------PENAWARAN----------------------->
<Script type="text/javascript">
    $(document).ready(function() {  
        $('#btn_simpan_penawaran').on("click",function(){
            $("#form_penawaran").load('submit', function(e){
                $.ajax({
                    url : '<?php echo base_url('distributor/penawaran/tambah_penawaran'); ?>',
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false, 
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
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: response,
                                showConfirmButton: true,
                                confirmButtonColor: '#17a2b8',
                                timer: 3000
                            })
                        }
                    }
                }); 
            }); 
        });
    });
</Script>