<?php $this->load->view('backend/partials/head.php') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-1 text-dark"><span class="nav-icon bx bx-fw bx-package"></span>Produk</h1>
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
            <div class="card card-outline card-info">
                <div class="card-body">
                    <div id="content_produk">
                        <!--LOAD DATA-->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<form role="form" id="form_produk" method="post">
    <div id="modal_produk" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
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
                    <button type="submit" id="btn_simpan_produk" class="btn btn-info"><span class="bx bx-fw bx-save"></span> Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form> 

<?php $this->load->view('backend/partials/footer.php') ?>
<?php $this->load->view('backend/partials/script.php') ?>

<!-----------------------FUNGSI----------------------->
<script type="text/javascript">
    var url_produk =  "<?php echo base_url('admin/produk'); ?>";
    var url = url_produk ;
    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).addClass('active ');
    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
</script>

<script type="text/javascript">
    load_data_produk();
	function load_data_produk(){
		$.ajax({
			method : "GET",
			url : '<?php echo base_url('admin/produk/load_data_produk'); ?>',
			beforeSend : function(){
				$('#content_produk').html('<div style="text-align:center"><i class="fa fa-refresh fa-3x fa-spin" style="margin-top: 30px; margin-bottom: 30px;" aria-hidden="true"></i></div>');
			},
			success : function(response){
				$('#content_produk').html(response);
			}
		});
    };

    $(document).on('click', '.btn_edit_produk', function(e) {
        var kode_produk=$(this).attr("kode_produk");
        var url = "<?php echo base_url('admin/produk/form_edit_produk'); ?>";

        $('#modal_produk').modal('show');
        $('.modal-title').text('Edit Produk');
        $('.modal-body').load(url,{kode_produk : kode_produk});
    });  

    $(document).ready(function() {
        $('#btn_simpan_produk').on("click",function(){
            $('#form_produk').validate({
                rules: {
                    harga_jual_produk: {
                        required: true,
                        minlength: 4,
                    },
                    limit_tok_produk: {
                        required: true,
                    },
                },
                messages: {
                    harga_jual_produk: {
                        required: "Harus diisi",
                        minlength: "Minimal 4 Digit",
                    },
                    limit_tok_produk: {
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
                        url : '<?php echo base_url('admin/produk/tambah_edit_produk'); ?>',
                        method: 'POST',
                        data : $('#form_produk').serialize(),
                        success: function(response){
                            if(response==1){
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: 'Data telah disimpan',
                                    showConfirmButton: true,
                                    confirmButtonColor: '#17a2b8',
                                    timer: 3000
                                }).then(function(){
                                    load_data_produk();
                                    $('#modal_produk').modal('hide');
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

</script>

</body>
</html>