<?php $this->load->view('backend/partials/head.php') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-1 text-dark"><span class="nav-icon bx bx-fw bx-credit-card"></span>Rekening Perusahaan</h1>
                </div>
                <div class="col-sm-6 float-sm-right">
                    <ol class="breadcrumb float-sm-right m-2">
                        <button type="button" class="btn bg-info" id="btn_tambah_rekening"><span class="bx bx-fw bx-plus"></span> Tambah Data </a>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
    <section class="content">
        <div class="container-fluid">
            <div class="card card-info card-outline">
                <div class="card-body">
                    <div id="content_rekening">
                        <!--LOAD DATA-->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<form role="form" id="form_rekening" method="post" aria-label="">
    <div id="modal_rekening" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <strong><span class="modal-title text-lg" id="myModalLabel"></span></strong>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- FORM -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class="bx bx-fw bx-x"></span> Batal</button>
                    <button type="submit" id="btn_simpan_rekening" class="btn bg-info"><span class="bx bx-fw bx-save"></span> Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>

<?php $this->load->view('backend/partials/footer.php') ?>
<?php $this->load->view('backend/partials/script.php') ?>

<!-----------------------FUNGSI----------------------->
<script type="text/javascript">
    var url_bank =  "<?php echo base_url('admin/rekening'); ?>";
    var url = url_bank ;
    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).addClass('active ');
    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
</script>

<script type="text/javascript">

    load_data_rekening();
	function load_data_rekening(){
		$.ajax({
			method : "GET",
			url : '<?php echo base_url('admin/rekening/load_data_rekening'); ?>',
			beforeSend : function(){
				$('#content_rekening').html('<div style="text-align:center"><i class="fa fa-refresh fa-3x fa-spin" style="margin-top: 30px; margin-bottom: 30px;" aria-hidden="true"></i></div>');
			},
			success : function(response){
				$('#content_rekening').html(response);
			}
		});
    };

    $('#btn_tambah_rekening').on("click",function(){
        var url = "<?php echo base_url('admin/rekening/form_tambah_rekening'); ?>";

        $('#modal_rekening').modal('show');
        $('.modal-title').text('Tambah Rekening Bank');
        $('.modal-body').load(url);
    });

    $(document).on('click', '.btn_edit_rekening', function(e) {
        var kode_rekening=$(this).attr("kode_rekening");
        var url = "<?php echo base_url('admin/rekening/form_edit_rekening'); ?>";

        $('#modal_rekening').modal('show');
        $('.modal-title').text('Edit Rekening Bank');
        $('.modal-body').load(url,{kode_rekening : kode_rekening});
    });  

    $(document).ready(function() {
        $('#btn_simpan_rekening').on("click",function(){
            $('#form_rekening').validate({
                rules: {
                    kode_bank: {
                        required: true,
                    },
                    an_rekening: {
                        required: true,
                    },
                    no_rekening: {
                        required: true,
                    },
                },
                messages: {
                    kode_bank: {
                        required: "Harus diisi",
                    },
                    an_rekening: {
                        required: "Harus diisi",
                    },
                    no_rekening: {
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
                    $.ajax({
                        url : '<?php echo base_url('admin/rekening/tambah_edit_rekening'); ?>',
                        method: 'POST',
                        data: $('#form_rekening').serialize(),
                        success: function(response){
                            if(response==1){
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil Disimpan!',
                                    showConfirmButton: true,
                                    confirmButtonColor: '#17a2b8',
                                    timer: 3000
                                }).then(function(){
                                    load_data_rekening();
                                    $('#modal_rekening').modal('hide');
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal!',
                                    text: response,
                                    showConfirmButton: true,
                                    confirmButtonColor: '#17a2b8',
                                    timer: 3000
                                })
                            }
                        }
                    }); 
                   
                }
            });
        });
    });

    $(document).on('click', '.btn_hapus_rekening', function(e) {
        var kode_rekening=$(this).attr("kode_rekening");
        var no_rekening=$(this).attr("no_rekening");
        
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: 'Akan menghapus data "' + no_rekening + '"!',
            type: 'warning',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#17a2b8',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: "Tidak, batalkan",
            showLoaderOnConfirm: true,
            customClass: 'animated tada',
            preConfirm: function() {
                return new Promise(function(resolve) {
                    $.ajax({
                        url: '<?php echo base_url('admin/rekening/hapus_rekening'); ?>',
                        method: 'POST',
                        data: {kode_rekening : kode_rekening},                
                    })
                    .done(function(response) {
                        load_data_rekening();
                        $('#modal_rekening').modal('hide');
                        Swal.fire({
                            title: 'Data Berhasil Dihapus',
                            icon: 'success',
                            showConfirmButton: true,
                            confirmButtonColor: '#17a2b8',
                        })
                    })
                    .fail(function() {
                        Swal.fire({
                            title: 'Terjadi Kesalahan',
                            icon: 'error',
                            showConfirmButton: true,
                            confirmButtonColor: '#17a2b8',
                        })
                    });
                });
            },
        });
    });  

</script>

</body>
</html>
