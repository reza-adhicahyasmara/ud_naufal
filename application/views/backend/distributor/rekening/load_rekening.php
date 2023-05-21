<table style="width:100%" id="dataTableRekeningBank" class="table table-bordered table-striped">
    <caption></caption>
    <thead>
        <tr>
            <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Bank</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Atas Nama</th>
            <th id="" style="text-align: center; vertical-align: middle; ">No. Rekening</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $no = 1;
            foreach($rekening->result() as $row) {
                if($row->id_distributor == $this->session->userdata('ses_id_distributor')){
        ?>
        <tr>
            <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_bank;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->an_rekening;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->no_rekening;?></td>
            <td style="text-align: center; vertical-align: middle;" >
                <a class='btn btn-info btn-sm btn-rounded btn_edit_rekening' kode_rekening="<?php echo $row->kode_rekening; ?>"><span class="bx bx-fw bx-pencil"></span></a>
                <a class='btn btn-danger btn-sm btn-rounded btn_hapus_rekening' no_rekening="<?php echo $row->no_rekening; ?>" kode_rekening="<?php echo $row->kode_rekening; ?>"><span class="bx bx-fw bx-trash"></span></a>
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
        $("#dataTableRekeningBank").DataTable({
        "responsive": true,
        "autoWidth": false,
        });
    });
</script>