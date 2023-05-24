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
                        <button type="button" class="btn btn-info btn_laporan" style="width: 100%;"  target="_blank"><span class="bx bx-fw bx-file"></span> Buat Laporan </button>
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
                                    <a class='btn btn-info btn-sm btn-rounded' href="<?php echo base_url('admin/penjualan/detail/'.$row->kode_penjualan); ?>"><i class="bx bx-fw bx-show-alt"></i></a>
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

<form role="form" id="form_laporan" method="post" aria-label="">
    <div id="modal_laporan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <strong><span class="modal-title text-lg" id="myModalLabel"></span></strong>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tanggal</label>
                        <div class="row">
                            <div class="col-6">
                                <input type="text" class="form-control" id="tanggal_awal" name="tanggal_awal" placeholder="Tanggal Awal">
                            </div>
                            <div class="col-6">      
                                <input type="text" class="form-control" id="tanggal_akhir" name="tanggal_akhir" placeholder="Tanggal Akhir">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class="bx bx-fw bx-x"></span> Batal</button>
                    <button type="submit" id="btn_buat_laporan" class="btn bg-info"><span class="bx bx-fw bxs-file-export"></span> Ekspor Excel</button>
                </div>
            </div>
        </div>
    </div>
</form>

<?php $this->load->view('backend/partials/footer.php') ?>
<?php $this->load->view('backend/partials/script.php') ?>


<!-----------------------FUNGSI----------------------->
<script type="text/javascript">
    var url_outlet =  "<?php echo base_url('admin/penjualan'); ?>";
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


<!-----------------------LAPORAN TRANSAKSI----------------------->
<script type="text/javascript">
    $(document).on('click', '.btn_laporan', function() {
        $('#modal_laporan').modal('show');
        $('.modal-title').text('Buat Laporan');
    }); 

    $(document).ready(function(){   
        $('#tanggal_awal').datetimepicker({
            //inline:true,
            autoclose: true,
            timepicker:false,
            format:'Y-m-d'
        });
    });

    $(document).ready(function(){   
        $('#tanggal_akhir').datetimepicker({
            //inline:true,
            autoclose: true,
            timepicker:false,
            format:'Y-m-d'
        });
    });

    $(document).ready(function() {
        $('#btn_buat_laporan').on("click",function(){
            $("#form_laporan").valid();
        });

        $('#form_laporan').validate({
            rules: {
                tanggal_awal: {
                    required: true,
                },
                tanggal_akhir: {
                    required: true,
                },
            },
            messages: {
                tanggal_awal: {
                    required: "Harus diisi",
                },
                tanggal_akhir: {
                    required: "Harus diisi",
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function() {
                var tanggal_awal = $('#tanggal_awal').val();
                var tanggal_akhir = $('#tanggal_akhir').val();

                $.ajax({
                    url : "<?php echo base_url('admin/penjualan/laporan_data_penjualan'); ?>",
                    method: 'POST',
                    data: {
                        tanggal_awal:tanggal_awal,
                        tanggal_akhir:tanggal_akhir
                    },
                    success: function(response){ 
                        Swal.fire({
                            icon: 'success',
                            title: 'Data telah disimpan!',
                            text: 'Folder Penyimpanan C://xampp/htdocs/ud_naufal/assets/berkas',
                            showConfirmButton: true,
                            confirmButtonColor: '#ffc107',
                        }).then(function(){
                            window.open("file:///C:/");
                        })
                    }
                }); 
            }
        });
    });
</script>
