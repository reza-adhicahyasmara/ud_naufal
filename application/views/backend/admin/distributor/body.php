<?php $this->load->view('backend/partials/head.php') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-1 text-dark"><span class="nav-icon bx bx-fw bxs-truck"></span>Data Distributor</h1>
                </div>
                <div class="col-sm-6 float-sm-right">
                    <ol class="breadcrumb float-sm-right m-2">
                        <button type="button" class="btn btn-info" id="btn_tambah_distributor"><span class="bx bx-fw bx-plus"></span> Tambah Data </a>
                    </ol>
                </div>  
            </div>
        </div>
    </div>
    
    <section class="content">
        <div class="container-fluid">
            <div class="card card-info card-outline">
                <div class="card-body">
                    <div id="content_distributor">
                        <!--LOAD DATA-->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<form role="form" id="form_distributor" method="post">
    <div id="modal_distributor" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
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
                    <button type="submit" id="btn_simpan_distributor" class="btn btn-info"><span class="bx bx-fw bx-save"></span> Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>

<?php $this->load->view('backend/partials/footer.php') ?>
<?php $this->load->view('backend/partials/script.php') ?>

<!-----------------------FUNGSI----------------------->
<script type="text/javascript">
    var url_distributor =  "<?php echo base_url('admin/distributor'); ?>";
    var url = url_distributor ;
    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).addClass('active ');
    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
</script>

<script type="text/javascript">
    load_data_distributor();
	function load_data_distributor(){
		$.ajax({
			method : "GET",
			url : '<?php echo base_url('admin/distributor/load_data_distributor'); ?>',
			beforeSend : function(){
				$('#content_distributor').html('<div style="text-align:center"><i class="fa fa-refresh fa-3x fa-spin" style="margin-top: 30px; margin-bottom: 30px;" aria-hidden="true"></i></div>');
			},
			success : function(response){
				$('#content_distributor').html(response);
			}
		});
    };

    $('#btn_tambah_distributor').on("click",function(){
        var url = "<?php echo base_url('admin/distributor/form_tambah_distributor'); ?>";

        $('#modal_distributor').modal('show');
        $('.modal-title').text('Tambah Distributor');
        $('.modal-body').load(url);
    });

    $(document).on('click', '.btn_edit_distributor', function(e) {
        var id_distributor = $(this).attr("id_distributor");
        var url = "<?php echo base_url('admin/distributor/form_edit_distributor'); ?>";

        $('#modal_distributor').modal('show');
        $('.modal-title').text('Edit Distributor');
        $('.modal-body').load(url,{id_distributor : id_distributor});
    });  

    $(document).ready(function() {
        $('#btn_simpan_distributor').on("click",function(e){
            $('#form_distributor').validate({
                rules: {
                    nama_distributor: {
                        required: true,
                    },
                    pic_distributor: {
                        required: true,
                    },
                    kontak_distributor: {
                        required: true,
                        minlength: 11,
                        maxlength: 15,

                    },
                    alamat_distributor: {
                        required: true,
                    },
                    username_distributor_baru: {
                        required: true,
                        minlength: 5,
                    },
                    ongkir_distributor: {
                        required: true,
                        minlength: 5,
                    },
                    berat_ongkir_distributor: {
                        required: true,
                    },
                    password_distributor: {
                        required: true,
                        minlength: 5,
                    },
                },
                messages: {
                    nama_distributor: {
                        required: "Harus diisi",
                    },
                    pic_distributor: {
                        required: "Harus diisi",
                    },
                    kontak_distributor: {
                        required: "Harus diisi",
                        minlength: "Minimal 11 karakter",
                        maxlength: "Maksimal 15 karakter",
                    },
                    alamat_distributor: {
                        required: "Harus diisi",
                    },
                    username_distributor_baru: {
                        required: "Harus diisi",
                        minlength: "Minimal 5 karakter",
                    },
                    password_distributor: {
                        required: "Harus diisi",
                        minlength: "Minimal 5 karakter",
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
                    $("#form_distributor").load('submit', function(e){
                        $.ajax({
                            url : '<?php echo base_url('admin/distributor/tambah_edit_distributor'); ?>',
                            method: 'POST',
                            data: new FormData(this),
                            contentType: false,
                            cache: false,
                            processData:false, 
                            success: function(response){
                                if(response==1){
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil Disimpan!',
                                        showConfirmButton: true,
                                        confirmButtonColor: '#17a2b8',
                                        timer: 3000
                                    }).then(function(){
                                        load_data_distributor();
                                        $('#modal_distributor').modal('hide');
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Gagal!',
                                        text: response,
                                        showConfirmButton: true,
                                        confirmButtonColor: '#17a2b8',
                                        timer: 3000
                                    })
                                }
                            }
                        }); 
                    });
                }
            });
        });
    });

    $(document).on('click', '.btn_hapus_distributor', function(e) {
        var id_distributor = $(this).attr("id_distributor");
        var nama_distributor = $(this).attr("nama_distributor");
        
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: 'Akan menghapus data"' + nama_distributor + '"!',
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
                        url: '<?php echo base_url('admin/distributor/hapus_distributor'); ?>',
                        method: 'POST',
                        data: {
                            id_distributor:id_distributor                     
                        },                
                    })
                    .done(function(response) {
                        load_data_distributor();
                        $('#modal_distributor').modal('hide');
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