<table style="width:100%" id="dataTable" class="table table-bordered table-striped">
    <caption></caption>
    <thead>
        <tr>
            <th rowspan="2" id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
            <th rowspan="2" id="" style="text-align: center; vertical-align: middle; ">Gambar</th>
            <th rowspan="2" id="" style="text-align: center; vertical-align: middle; ">Kode</th>
            <th rowspan="2" id="" style="text-align: center; vertical-align: middle; ">Nama</th>
            <th rowspan="2" id="" style="text-align: center; vertical-align: middle; ">Kategori</th>
            <th rowspan="2" id="" style="text-align: center; vertical-align: middle; ">Harga</th>
            <th colspan="3" id="" style="text-align: center; vertical-align: middle; ">Stok UD Naufal</th>
            <th colspan="3" id="" style="text-align: center; vertical-align: middle; ">Stok Distributor</th>
            <th rowspan="2" id="" style="text-align: center; vertical-align: middle; ">Status<br>Penawaran</th>
            <th rowspan="2" id="" style="text-align: center; vertical-align: middle; ">Aksi</th>
        </tr>
        <tr>
            <th id="" style="text-align: center; vertical-align: middle; ">Gudang</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Limit</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Status</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Gudang</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Limit</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Status</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $no = 1;
            foreach($produk->result() as $row) {
                if($row->ID == $this->session->userdata('ses_id_distributor')){
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
            <td style="text-align: right; vertical-align: middle;"><?php echo "Rp. ".number_format($row->harga_beli_produk,0, ",", ".")." / ".$row->satuan_produk;?></td>
            <td style="text-align: right; vertical-align: middle;"><?php echo number_format($row->stok_tok_produk,0, ",", ".")." ".$row->satuan_produk;?></td>
            <td style="text-align: right; vertical-align: middle;"><?php echo number_format($row->limit_tok_produk,0, ",", ".")." ".$row->satuan_produk;?></td>
            <td style="text-align: center; vertical-align: middle;">
                <?php 
                    if($row->stok_tok_produk <= $row->limit_tok_produk){
                        echo "<span class='badge rounded-pill bg-danger text-sm'>Limit</span>";
                    }elseif($row->stok_tok_produk > $row->limit_tok_produk){
                        echo "<span class='badge rounded-pill bg-success text-sm'>Aman</span>";
                    }
                ?>
            </td>
            <td style="text-align: right; vertical-align: middle;"><?php echo number_format($row->stok_dis_produk,0, ",", ".")." ".$row->satuan_produk;?></td>
            <td style="text-align: right; vertical-align: middle;"><?php echo number_format($row->limit_dis_produk,0, ",", ".")." ".$row->satuan_produk;?></td>
            <td style="text-align: center; vertical-align: middle;">
                <?php 
                    if($row->stok_dis_produk <= $row->limit_dis_produk){
                        echo "<span class='badge rounded-pill bg-danger text-sm'>Limit</span>";
                    }elseif($row->stok_dis_produk > $row->limit_dis_produk){
                        echo "<span class='badge rounded-pill bg-success text-sm'>Aman</span>";
                    }
                ?>
            </td>
            <td style="text-align: center; vertical-align: middle;">
                <?php
                    if($row->status_penawaran_produk == "Baru"){
                        echo "<span class='badge rounded-pill bg-info text-sm'>".$row->status_penawaran_produk."</span>";
                    }elseif($row->status_penawaran_produk== "Ditawarkan"){
                        echo "<span class='badge rounded-pill bg-info text-sm'>".$row->status_penawaran_produk."</span>";
                    }elseif($row->status_penawaran_produk== "Diterima"){
                        echo "<span class='badge rounded-pill bg-success text-sm'>".$row->status_penawaran_produk."</span>";
                    }elseif($row->status_penawaran_produk== "Ditolak"){
                        echo "<span class='badge rounded-pill bg-danger text-sm'>".$row->status_penawaran."</span>";
                    }
                ?>
            </td>
            <td style="text-align: center; vertical-align: middle;" >
                <a class='btn btn-info btn-sm btn-rounded btn_edit_produk' kode_produk="<?php echo $row->kode_produk; ?>"><span class="bx bx-fw bx-pencil"></span></a>
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
        $("#dataTable").DataTable({
        "responsive": true,
        "autoWidth": false,
        });
    });
</script>