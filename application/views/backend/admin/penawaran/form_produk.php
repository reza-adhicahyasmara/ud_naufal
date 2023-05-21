<h4>Proposal</h4>
<object data="<?php echo base_url('assets/berkas/'.$berkas_penawaran);?>" type="application/pdf" width="100%" height="500px" style=" display:inline-block;"></object>
<br>
<hr>
<br>
<input type="hidden" id="kode_penawaran" value="<?php echo $kode_penawaran;?>">

<table style="width:100%" id="dataTable" class="table table-bordered table-striped">
    <caption></caption>
    <thead>
        <tr>
            <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Kode</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Nama</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Kategori</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Harga</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Status</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $no = 1;
            $haha = 0;
            foreach($produk->result() as $row) {
                if($row->kode_penawaran == $kode_penawaran){
        ?>
        <tr>
            <td style="text-align: center; vertical-align: middle;"><?php echo $haha += $no;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->kode_produk;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_produk;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_kategori;?></td>
            <td style="text-align: right; vertical-align: middle;"><?php echo "Rp ".number_format($row->harga_beli_produk, 0, ".", ".")." / ".$row->satuan_produk;?></td>
            <?php if($row->status_penawaran == "1" && $row->kode_penawaran == $kode_penawaran){?>
                <td style="text-align: center; vertical-align: middle;" >
                    <select class="form-control status_penawaran_produk" name="status_penawaran_produk" id="status_penawaran_produk">
                        <option value="<?php echo $row->kode_produk.'|Ditawarkan';?>" <?php if($row->status_penawaran_produk == "Ditawarkan"){echo "selected";} ?>>Penawaran</option>
                        <option value="<?php echo $row->kode_produk.'|Diterima';?>" <?php if($row->status_penawaran_produk == "Diterima"){echo "selected";} ?>>Diterima</option>
                        <option value="<?php echo $row->kode_produk.'|Ditolak';?>" <?php if($row->status_penawaran_produk == "Ditolak"){echo "selected";} ?>>Ditolak</option>
                    </select>
                </td>
            <?php } else { ?> 
                <td style="text-align: center; vertical-align: middle;"><?php echo $row->status_penawaran_produk;?></td>
            <?php } ?>        </tr>
        <?php
                    $no++;
                }
            } 
        ?>
    </tbody>
</table>

<script>
    $(function () {
        $("#dataTable").DataTable({
        "responsive": true,
        "autoWidth": false,
        });
    });
</script>

<!-----------------------PENAWARAN PRODUK----------------------->
<Script type="text/javascript">
    $(".status_penawaran_produk").change(function(e) {
        var status_penawaran_produk = this.value;;
        console.log(status_penawaran_produk);
        $.ajax({
            url : '<?php echo base_url('admin/penawaran/update_produk'); ?>',
            method: 'POST',
            data : {status_penawaran_produk:status_penawaran_produk},
        }); 
    });
</Script>




<!-----------------------UPDATE PENAWARAN----------------------->
<Script type="text/javascript">
    $(document).on('click', '#btn_update_penawaran', function(e) {
        var kode_penawaran = $('#kode_penawaran').val();
        Swal.fire({
            title: 'Pastikan penawaran produk telah dikonfirmasi!',
            type: 'warning',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#17a2b8',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Ya',
            cancelButtonText: "Tidak",
            showLoaderOnConfirm: true,
            customClass: 'animated tada',
            preConfirm: function() {
                return new Promise(function(response) {
                    $.ajax({
                        url: '<?php echo base_url('admin/penawaran/update_penawaran'); ?>',
                        method: 'POST',
                        data: {
                            kode_penawaran:kode_penawaran
                        },   
                        success: function(response){
                            if(response==1){
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: 'Data telah update',
                                    showConfirmButton: true,
                                    confirmButtonColor: '#17a2b8',
                                    timer: 3000
                                }).then(function(){
                                    window.location.reload();
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
                    })
                   
                });
            },
        });
    }); 
</Script>