<?php $this->load->view('backend/partials/head.php') ?>

<form role="form" id="form_distributor" method="post">
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-1 text-dark"><span class="nav-icon bx bx-fw bxs-truck"></span>Profil</h1>
                </div>
                <div class="col-sm-6 float-sm-right">
                    <ol class="breadcrumb float-sm-right m-2">
                        <span class="breadcrumb-item"><a href="<?php echo base_url('distributor/dashboard'); ?>">Dashboard</a></span>
                        <span class="breadcrumb-item active">Profil</span>
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
                            <input type="hidden" id="jenis" value="Edit">
                            <div class="form-group">
                                <div class="d-flex justify-content-center">
                                    <div class="form-group text-center">
                                        <label class="btn" for="foto_distributor">
                                            <div class="form-control" style="border-radius: 50%; padding: 0px; width:180px; height: 180px;">
                                                <?php if($edit['foto_distributor'] != "") { ?>
                                                <img id="blah" src="<?php echo base_url('assets/img/distributor/'.$edit['foto_distributor']);?>" class="product-image" alt="Gambar Promo" style="border-radius: 50%; width:180px; height:180px; object-fit: cover; ">  
                                                <?php }else{ ?>
                                                    <img id="blah" src="<?php echo base_url('assets/img/banner/image_alt.svg');?>" class="product-image" alt="Gambar Promo" style="border-radius: 50%; width:180px; height:180px; object-fit: cover; ">  
                                                <?php } ?> 
                                            </div>
                                            <input class="text" accept="image/*" type="file" id="foto_distributor" name="file" style="display: none;" />
                                            <input class="text" type="text" id="foto_distributor_lama" name="foto_distributor_lama" value="<?php echo $edit['foto_distributor']; ?>" style="display: none;" />
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Nama distributor</label>
                                <input type="hidden" class="form-control" name="id_distributor" id="id_distributor" value="<?php echo $edit['id_distributor']; ?>" placeholder="NIK" readonly>
                                <input type="text" class="form-control" name="nama_distributor" id="nama_distributor" value="<?php echo $edit['nama_distributor']; ?>" placeholder="Nama distributor" readonly>
                            </div>
                            <div class="form-group">
                                <label>PIC</label>
                                <input type="text" class="form-control" name="pic_distributor" id="pic_distributor" value="<?php echo $edit['pic_distributor']; ?>" placeholder="PIC distributor">
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea type="text" class="form-control" name="alamat_distributor" id="alamat_distributor" placeholder="Alamat" style="height:100px;"><?php echo $edit['alamat_distributor']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>No. Telepon / HP</label>
                                <input type="text" class="form-control" name="kontak_distributor" id="kontak_distributor" value="<?php echo $edit['kontak_distributor']; ?>" placeholder="No. Telepon / HP">
                            </div>
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" name="username_distributor_baru" id="username_distributor_baru" value="<?php echo $edit['username_distributor']; ?>" placeholder="Username">
                                <input type="hidden" class="form-control" name="username_distributor_lama" id="username_distributor_lama" value="<?php echo $edit['username_distributor']; ?>" placeholder="Username">
                            </div>
                            </br>
                            <div class="form-group" style="text-align:center">
                                <button type="submit" class="btn btn-info" id="btn_simpan_distributor" style="margin-right:5px"><i class="bx bx-fw bx-save"></i> Simpan</button>
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
    $(document).ready(function() {
        $('#btn_simpan_distributor').on("click",function(e){
            $('#form_distributor').validate({
                rules: {
                    pic_distributor: {
                        required: true,
                    },
                    alamat_distributor: {
                        required: true,
                    },
                    kontak_distributor: {
                        required: true,
                        minlength: 11,
                        maxlength: 15,

                    },
                    password_distributor: {
                        required: true,
                        minlength: 5,
                    },
                    username_distributor_baru: {
                        required: true,
                    },
                },
                messages: {
                    pic_distributor: {
                        required: "Harus diisi",
                    },
                    alamat_distributor: {
                        required: "Harus diisi",
                    },
                    kontak_distributor: {
                        required: "Harus diisi",
                        minlength: "Minimal 11 karakter",
                        maxlength: "Maksimal 15 karakter",
                    },
                    password_distributor: {
                        required: "Harus diisi",
                        minlength: "Minimal 5 karakter",
                    },
                    username_distributor_baru: {
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
                            url : '<?php echo base_url('distributor/profil/edit_distributor'); ?>',
                            method: 'POST',
                            data: new FormData(this),
                            contentType: false,
                            cache: false,
                            processData:false, 
                            success: function(response){
                                if(response==1){
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil!',
                                        text: 'Data telah diedit',
                                        showConfirmButton: true,
                                        confirmButtonColor: '#007bff',
                                        timer: 3000
                                    }).then(function(){
                                        window.location.replace("<?php echo base_url('login/logout'); ?>");
                                    });
                                }else{
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal!',
                                        text: 'Response',
                                        showConfirmButton: true,
                                        confirmButtonColor: '#007bff',
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
</script>

</body>
</html>