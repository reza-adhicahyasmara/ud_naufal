<table style="width:100%" id="dataTable" class="table table-bordered table-striped">
    <caption></caption>
    <thead>
        <tr>
            <th rowspan="2" id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
            <th rowspan="2" id="" style="text-align: center; vertical-align: middle; ">Gambar</th>
            <th rowspan="2" id="" style="text-align: center; vertical-align: middle; ">Kode</th>
            <th rowspan="2" id="" style="text-align: center; vertical-align: middle; ">Nama</th>
            <th rowspan="2" id="" style="text-align: center; vertical-align: middle; ">Kategori</th>
            <th rowspan="2" id="" style="text-align: center; vertical-align: middle; ">Distributor</th>
            <th colspan="3" id="" style="text-align: center; vertical-align: middle; ">Harga</th>
            <th colspan="3" id="" style="text-align: center; vertical-align: middle; ">Stok</th>
            <th colspan="5" id="" style="text-align: center; vertical-align: middle; ">EOQ & ROP</th>
            <th rowspan="2" id="" style="text-align: center; vertical-align: middle; ">Update Data</th>
            <th rowspan="2" id="" style="text-align: center; vertical-align: middle; ">Aksi</th>
        </tr>
        <tr>
            <th id="" style="text-align: center; vertical-align: middle; ">Harga Beli</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Harga Jual</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Perubahan<br>Harga</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Stok Gudang</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Stok Limit</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Status</th>
            <th id="" style="text-align: center; vertical-align: middle; ">D</th>
            <th id="" style="text-align: center; vertical-align: middle; ">H</th>
            <th id="" style="text-align: center; vertical-align: middle; ">LT</th>
            <th id="" style="text-align: center; vertical-align: middle; ">SS</th>
            <th id="" style="text-align: center; vertical-align: middle; ">AU</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $no = 1;
            foreach($produk->result() as $row) {
                if($row->status_penawaran_produk == "Diterima"){
        ?>
        <tr>
            <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
            <td style="text-align: center; vertical-align: middle;">
                <?php if(date('Y-m-d', strtotime($row->tanggal_produk. ' + 7 days')) >= date("Y-m-d") && $row->tanggal_produk <= date('Y-m-d', strtotime('+7 days'))){ ?>
                        <div class="position-relative">
                            <?php if($row->gambar_produk != ""){ ?>
                                <img src="<?php echo base_url('assets/img/produk/'.$row->gambar_produk);?>" alt="Image" class="img-fluid" style="width:80px; height:80px; object-fit:cover; background:white;">
                            <?php }else{ ?>
                                <img src="<?php echo base_url('assets/img/banner/box.svg');?>" alt="Image" alt="Image" style="width:60px; height:60px; margin-top: 9px; object-fit:cover;">
                            <?php } ?>
                            <div class="ribbon-wrapper">
                                <div class="ribbon <?php if($row->perubahan_produk == "Baru"){ echo "bg-warning";}elseif($row->perubahan_produk == "Harga Turun"){ echo "bg-success";}elseif($row->perubahan_produk == "Harga Naik"){ echo "bg-danger";}?>">
                                    <?php echo $row->perubahan_produk;?>
                                </div>
                            </div>
                        </div>                 
                <?php
                    }else{ 
                        if($row->gambar_produk != ""){
                ?>
                        <img src="<?php echo base_url('assets/img/produk/'.$row->gambar_produk);?>" alt="Image" class="img-fluid" style="width:80px; height:80px; object-fit:cover; background:white;">
                    <?php }else{ ?>
                        <img src="<?php echo base_url('assets/img/banner/box.svg');?>" alt="Image" alt="Image" style="width:60px; height:60px; margin-top: 9px; object-fit:cover;">
                <?php 
                        } 
                    }
                ?>
            </td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->kode_produk;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_produk;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_kategori;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_distributor;?></td>
            <td style="text-align: right; vertical-align: middle;"><?php echo "Rp. ".number_format($row->harga_beli_produk, 0, ".", ".")." / ".$row->satuan_produk;?></td>
            <td style="text-align: right; vertical-align: middle;"><?php echo "Rp. ".number_format($row->harga_jual_produk, 0, ".", ".")." / ".$row->satuan_produk;?></td>
            <td style="text-align: right; vertical-align: middle;"><?php echo "Rp. ".number_format($row->perubahan_harga_produk, 0, ".", ".")." / ".$row->satuan_produk;?></td>
            <td style="text-align: right; vertical-align: middle;"><?php echo number_format($row->stok_tok_produk, 0, ",", ".")." ".$row->satuan_produk;?></td>
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
            <td style="text-align: left; vertical-align: middle;"><?php echo number_format($row->d_produk,0, ",", ".")." ".$row->satuan_produk;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo "Rp. ".number_format($row->h_produk,0, ",", ".");?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo number_format($row->lt_produk,0, ",", ".")." Hari";?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo number_format($row->ss_produk,0, ",", ".")." ".$row->satuan_produk;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo number_format($row->au_produk,2, ",", ".")." ".$row->satuan_produk;;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->tanggal_produk;?></td>
            <td style="text-align: center; vertical-align: middle;" >
                <a class='btn btn-info btn-sm btn-rounded btn_edit_produk' kode_produk="<?php echo $row->kode_produk; ?>"><span class="bx bx-fw bx-pencil" style="margin:3px"></span></a>
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