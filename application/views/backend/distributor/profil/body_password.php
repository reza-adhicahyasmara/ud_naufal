<?php $this->load->view('backend/partials/head.php') ?>

<form role="form" id="form_password" method="post">
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-1 text-dark"><span class="nav-icon bx bx-fw bxs-lock"></span>Ubah Password</h1>
                </div>
                <div class="col-sm-6 float-sm-right">
                    <ol class="breadcrumb float-sm-right m-2">
                        <span class="breadcrumb-item"><a href="<?php echo base_url('distributor/dashboard'); ?>">Dashboard</a></span>
                        <span class="breadcrumb-item active">Ubah Password</span>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
    <section class="content">
        <div class="container-fluid">
            <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><span class="icon fas fa-exclamation-triangle"></span> PERINGATAN!</h5>
                    Setelah data disimpan, secara otomatis akun akan melakukan logout.
            </div>
            <div class="row justify-content-md-center">
                <div class="col-lg-4 col-12">
                    <div class="card card-info card-outline">
                        <div class="card-body">
                            <div id="alert_edit"></div>
                            <input type="hidden" id="jenis" value="Edit">
                            <div class="form-group">
                                <label>Password Lama</label>
                                <input type="hidden" class="form-control" name="id_distributor" id="id_distributor" value="<?php echo $edit['id_distributor']; ?>" placeholder="NIK" readonly>
                                <input type="hidden" class="form-control" name="username_distributor" id="username_distributor" value="<?php echo $edit['username_distributor']; ?>" placeholder="NIK" readonly>
                                <input type="password" class="form-control" name="password_lama" id="password_lama" placeholder="Password Lama">
                            </div>
                            <div class="form-group">
                                <label>Password Baru</label>
                                <input type="password" class="form-control" name="password_baru_1" id="password_baru_1" placeholder="Masukkan Password Baru">
                            </div>
                            <div class="form-group">
                                <label>Verifikasi Password Baru</label>
                                <input type="password" class="form-control" name="password_baru_2" id="password_baru_2"  placeholder="Verifikasi Password Baru">
                            </div>
                            </br>
                            <div class="form-group" style="text-align:center">
                                <button type="submit" class="btn btn-info" id="btn_simpan_password" style="margin-right:5px"><i class="bx bx-fw bx-save"></i> Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</form>

<?php $this->load->view('backend/partials/footer.php') ?>
<?php $this->load->view('backend/partials/script.php') ?>

<!-----------------------FUNGSI----------------------->
<script type="text/javascript">
       
    var url = window.location;
    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).addClass('active ');
    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');

	foto_distributor.onchange = evt => {
		const [file] = foto_distributor.files
		if (file) {
			blah.src = URL.createObjectURL(file)
		}
	}
</script>

<script type="text/javascript">
     $('#btn_simpan_password').on("click",function(){
        $('#form_password').validate({
            rules: {
                password_lama: {
                    required: true,
                    minlength: 5,
                },
                password_baru_1: {
                    required: true,
                    minlength: 5
                },
                password_baru_2: {
                    required: true,
                    minlength: 5,
                    equalTo: password_baru_1,
                },
            },
            messages: {
                password_lama: {
                    required: "Harus diisi",
                    minlength: "Minimal 5 karakter",
                },
                password_baru_1: {
                    required: "Harus diisi",
                    minlength: "Minimal 5 karakter"
                },
                password_baru_2: {
                    required: "Harus diisi",
                    minlength: "Minimal 5 karakter",
                    equalTo: "Password harus sama"
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
                    url : '<?php echo base_url('distributor/profil/reset_password'); ?>',
                    method: 'POST',
                    data: $('#form_password').serialize(),
                    success: function(response){
                        if(response==1){
                            Swal.fire({
                                icon: 'success',
                                title: 'Password berhasil diganti..!!',
                                showConfirmButton: true,
                                confirmButtonColor: '#007bff',
                                timer: 3000
                            }).then(function(){
                                window.location.replace("<?php echo base_url('login/logout'); ?>");
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: response,
                                showConfirmButton: true,
                                confirmButtonColor: '#007bff',
                                timer: 3000
                            })
                        }
                    }
                });    
            }
        });
    });
</script>

</body>
</html>