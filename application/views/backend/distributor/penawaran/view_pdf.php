<h4>Proposal</h4>
<object data="<?php echo base_url('assets/berkas/'.$berkas_penawaran);?>" type="application/pdf" width="100%" height="850px" style=" display:inline-block;"></object>
<br>
<hr>
<br>
<h4>Daftar Produk</h4>
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
        </tr>
        <?php
                    $no++;
                } 
            }
        ?>
    </tbody>
</table>