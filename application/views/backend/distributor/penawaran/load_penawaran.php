<table style="width:100%" id="dataTablePenawaran" class="table table-bordered table-striped">
    <caption></caption>
    <thead>
        <tr>
            <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Tanggal</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Penawaran</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Berkas</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $no = 1;
            foreach($penawaran->result() as $row) {
        ?>
        <tr>
            <td style="text-align: center; vertical-align: middle;"><?php echo $no;?>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->tanggal_penawaran;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_penawaran;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->berkas_penawaran;?></td>
            <td style="text-align: center; vertical-align: middle;" >
                <a class='btn btn-primary btn-sm btn-rounded view_pdf_penawaran' berkas_penawaran="<?php echo $row->berkas_penawaran; ?>" kode_penawaran="<?php echo $row->kode_penawaran; ?>"><span class="bx bx-fw bxs-file-pdf"></span></a>
            </td>
        </tr>
        <?php
                $no++;
            } 
        ?>
    </tbody>
</table>

<script>
    $(function () {
        $("#dataTablePenawaran").DataTable({
            responsive: true,
        });
    });
    
    $('.view_pdf_penawaran').on("click",function(){ 
        var kode_penawaran = $(this).attr("kode_penawaran");
        var berkas_penawaran = $(this).attr("berkas_penawaran");
        var aaa = kode_penawaran + "|" + berkas_penawaran;
        var url = '<?php echo base_url('distributor/penawaran/view_pdf_penawaran'); ?>';

        $('#modal_view_pdf').modal('show');
        $('.modal-title').text('PDF');
        $('.modal-body').load(url, {aaa:aaa});

        load_data_penawaran();
    });

</script>