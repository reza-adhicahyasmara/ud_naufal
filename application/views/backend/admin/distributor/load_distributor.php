<table style="width:100%" id="data_table_distributor" class="table table-bordered table-striped">
    <caption></caption>
    <thead>
        <tr>
            <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Foto</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Nama Distributor</th>
            <th id="" style="text-align: center; vertical-align: middle; ">PIC</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Alamat</th>
            <th id="" style="text-align: center; vertical-align: middle; ">No. Telp / HP</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Username</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Password</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $no = 1;
            foreach($distributor->result() as $row) {
        ?>
        <tr>
            <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
            <td style="text-align: center; vertical-align: middle;">
                <?php if($row->foto_distributor != "") { ?>
                    <div class="d-flex justify-content-center">
                        <div class=" img-circle elevation-1" style="width: 80px; height: 80px; border:1px solid #ced4da;">
                            <img src="<?php echo base_url('assets/img/distributor/'.$row->foto_distributor);?>" alt="Image" class="img-circle elevation-1" style="width:80px; height:80px; object-fit:cover; background:white;">
                        </div>
                    </div>
                <?php }else{ ?>
                    <div class="d-flex justify-content-center">
                        <div class=" img-circle elevation-1" style="width: 80px; height: 80px; border:1px solid #ced4da;">
                            <img src="<?php echo base_url('assets/img/banner/image_alt.svg');?>" alt="Image" alt="Image" style="width:60px; height:60px; margin-top: 9px; object-fit:cover;">
                        </div>
                    </div>
                <?php } ?>
            </td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_distributor;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->pic_distributor;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->alamat_distributor;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->kontak_distributor;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->username_distributor;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->password_distributor;?></td>
            <td style="text-align: center; vertical-align: middle;" >
                <a class='btn btn-info btn-sm btn-rounded btn_edit_distributor' id_distributor = "<?php echo $row->id_distributor; ?>" ><span class="bx bx-fw bx-pencil"></span></a>
                <a class='btn btn-danger btn-sm btn-rounded btn_hapus_distributor' nama_distributor="<?php echo $row->nama_distributor; ?>" id_distributor="<?php echo $row->id_distributor; ?>"><span class="bx bx-fw bx-trash"></span></a>
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
        $("#data_table_distributor").DataTable({
        "responsive": true,
        "autoWidth": false,
        });
    });
</script>