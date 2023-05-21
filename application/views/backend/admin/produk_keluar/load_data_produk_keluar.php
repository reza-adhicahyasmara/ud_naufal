<table style="width:100%" id="dataTablePenyesuaianStokBB" class="table table-bordered table-striped">
    <caption></caption>
    <thead>
        <tr>
            <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Tanggal Keluar</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Transaksi</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Kode Produk</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Produk</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Kategori</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Harga Jual</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Stok Keluar</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Keterangan</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $no = 1;
            foreach($produk_keluar->result() as $row) {
                if($row->status_ipenjualan == "1"){
        ?>
        <tr>
            <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->tanggal_ipenjualan;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo "<a href='".base_url("admin/penjualan/detail/").$row->kode_penjualan."'>".$row->kode_penjualan."</a>";?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->kode_produk;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_produk;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_kategori;?></td>
            <td style="text-align: right; vertical-align: middle;"><?php echo "Rp. ".number_format($row->harga_ipenjualan,0, ",", ".");?></td>
            <td style="text-align: right; vertical-align: middle;"><?php echo number_format($row->qty_ipenjualan,0, ",", ".")." ".$row->satuan_produk;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->keterangan_ipenjualan;?></td>
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
        $("#dataTablePenyesuaianStokBB").DataTable({
        "responsive": true,
        "autoWidth": false,
        });
    });
</script>