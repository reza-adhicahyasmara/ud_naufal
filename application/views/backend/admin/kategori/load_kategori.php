<table style="width:100%" id="datatable_kategori" class="table table-bordered table-striped">
    <caption></caption>
    <thead>
        <tr>
            <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Kode Kategori</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Keterangan Kategori</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $no = 1;
            foreach($kategori->result() as $row) {
        ?>
        <tr>
            <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->kode_kategori;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_kategori;?></td>
            <td style="text-align: center; vertical-align: middle;" >
                <a class='btn btn-info btn-sm btn-rounded btn_edit_kategori' kode_kategori="<?php echo $row->kode_kategori; ?>"><span class="bx bx-fw bx-pencil"></span></a>
                <a class='btn btn-danger btn-sm btn-rounded btn_hapus_kategori' nama_kategori="<?php echo $row->nama_kategori; ?>" kode_kategori="<?php echo $row->kode_kategori; ?>"><span class="bx bx-fw bxs-trash"></span></a>
            </td>
        </tr>
        <?php
                $no++;
            } 
        ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        var table = $('#datatable_kategori').DataTable( {
            responsive: true
        });
    });
</script>