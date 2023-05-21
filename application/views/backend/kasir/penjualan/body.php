<?php $this->load->view('backend/partials/head.php'); ?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-1 text-dark"><i class="nav-icon bx bx-fw bx-book"></i> Penjualan</h1>
                </div>
                <div class="col-sm-6 float-sm-right">
                    <ol class="breadcrumb float-sm-right m-2">
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-info card-outline">
                <div class="card-body">
                    <table style="width:100%;" id="dataTable1" class="table table-bordered table-striped">
                        <caption></caption>
                        <thead>
                            <tr>
                                <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
                                <th id="" style="text-align: center; vertical-align: middle; ">Tanggal</th>
                                <th id="" style="text-align: center; vertical-align: middle; ">Konsumen</th>
                                <th id="" style="text-align: center; vertical-align: middle; ">Total Belanjaan (Rp.)</th>
                                <th id="" style="text-align: center; vertical-align: middle; ">Pembayaran Tunai (Rp.)</th>
                                <th id="" style="text-align: center; vertical-align: middle; ">Kembalian (Rp.)</th>
                                <th id="" style="text-align: center; vertical-align: middle; ">Keterangan</th>
                                <th id="" style="text-align: center; vertical-align: middle; width:5%">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $no = 1;
                                foreach($data_penjualan->result() as $row) {
                            ?>
                            <tr>
                                <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
                                <td style="text-align: left; vertical-align: middle;"><?php echo $row->tanggal_penjualan;?></td>
                                <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_penjualan;?></td>
                                <td style="text-align: left; vertical-align: middle;"><?php echo number_format($row->total_penjualan,2, ",", ".");?></td>
                                <td style="text-align: left; vertical-align: middle;"><?php echo number_format($row->cash_penjualan,2, ",", ".");?></td>
                                <td style="text-align: Right; vertical-align: middle;"><?php echo number_format($row->cash_penjualan - $row->total_penjualan,2, ",", ".");?></td>
                                <td style="text-align: left; vertical-align: middle;"><?php echo $row->keterangan_penjualan;?></td>
                                <td style="text-align: center; vertical-align: middle;" >
                                    <a class='btn btn-info btn-sm btn-rounded' href="<?php echo base_url('kasir/penjualan/detail/'.$row->kode_penjualan); ?>"><i class="bx bx-fw bx-show-alt"></i></a>
                                </td>
                            </tr>
                            <?php 
                                    $no++;
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<?php $this->load->view('backend/partials/footer.php') ?>
<?php $this->load->view('backend/partials/script.php') ?>


<!-----------------------FUNGSI----------------------->
<script type="text/javascript">
    var url_outlet =  "<?php echo base_url('kasir/penjualan'); ?>";
    var url = url_outlet ;
    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).addClass('active ');
    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');

    $(function () {
        $("#dataTable1").DataTable({
        "responsive": true,
        "autoWidth": true,
        });
    });

</script>

