<table style="width:100%" id="dataTablePenawaran" class="table table-bordered table-striped">
    <caption></caption>
    <thead>
        <tr>
            <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Tanggal</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Nama Distributor</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Penawaran</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Berkas</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $no = 1;
            foreach($penawaran->result() as $row) {
                if($row->id_distributor != ""){
        ?>
        <tr>
            <td style="text-align: center; vertical-align: middle;"><?php echo $no;?>
            <td style="text-align: left; vertical-align: middle;">
                <?php 
                    echo $row->tanggal_penawaran; 
                    if($row->status_penawaran == 1){
                        echo " <span class='badge rounded-pill bg-danger text-sm'>Baru</span>";
                    }
                ?>
            </td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_distributor;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_penawaran;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->berkas_penawaran;?></td>
            <td style="text-align: center; vertical-align: middle;" >
                <a class='btn btn-primary btn-sm btn-rounded btn_produk'kode_penawaran="<?php echo $row->kode_penawaran; ?>" berkas_penawaran="<?php echo $row->berkas_penawaran; ?>"><span class="bx bx-fw bxl-dropbox"></span></a>
            </td>
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
        $("#dataTablePenawaran").DataTable({
        "responsive": true,
        "autoWidth": false,
        });
    });
    
    $('.btn_produk').on("click",function(){
        var kode_penawaran = $(this).attr("kode_penawaran");
        var berkas_penawaran = $(this).attr("berkas_penawaran");
        var aaa = kode_penawaran + "|" + berkas_penawaran;
        var url = "<?php echo base_url('admin/penawaran/form_produk'); ?>";

        $('#modal_produk').modal('show');
        $('.modal-title').text('Daftar Penawaran Produk');
        $('.modal-body').load(url, {aaa:aaa});
    });

</script>