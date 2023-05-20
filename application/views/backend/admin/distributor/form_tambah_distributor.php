<input type="hidden" name="jenis" id="jenis" value="Tambah">
<div class="form-group">
    <div class="d-flex justify-content-center">
        <div class="form-group text-center mb-3">
            <div class="form-control" style="padding: 0px; width:180px; height: 180px;">
                <img id="blah" src="<?php echo base_url('assets/img/banner/image_alt.svg');?>" class="product-image" alt="Gambar Promo" style="border-radius: 3px; width:180px; height:180px; object-fit: cover; ">  
            </div>
            <input class="hidden" accept="image/*" type="file" id="foto_distributor" name="file" style="display: none;" />
            <label class="btn btn-primary btn-sm" for="foto_distributor">Pilih Gambar</label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <h6 class="text-bold pt-2 float-right">Nama Distributor</h6>
    </div>
    <div class="col-8">
        <div class="form-group">
            <input type="text" class="form-control" name="nama_distributor" id="nama_distributor" placeholder="Nama Distributor">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <h6 class="text-bold pt-2 float-right">PIC</h6>
    </div>
    <div class="col-8">
        <div class="form-group">
            <input type="text" class="form-control" name="pic_distributor" id="pic_distributor" onkeypress="return /[a-z A-Z]/i.test(event.key)" placeholder="PIC / Sales">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <h6 class="text-bold pt-2 float-right">Alamat</h6>
    </div>
    <div class="col-8">
        <div class="form-group">
            <textarea type="text" class="form-control" name="alamat_distributor" id="alamat_distributor" placeholder="Alamat" style="height:100px;"></textarea>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <h6 class="text-bold pt-2 float-right">No. Telepon / HP</h6>
    </div>
    <div class="col-8">
        <div class="form-group">
            <input type="text" class="form-control" name="kontak_distributor" id="kontak_distributor" onkeypress="return /[0-9]/i.test(event.key)" placeholder="No. Telepon / HP">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <h6 class="text-bold pt-2 float-right">Username</h6>
    </div>
    <div class="col-8">
        <div class="form-group">
            <input type="text" class="form-control" name="username_distributor_baru" id="username_distributor_baru" placeholder="Username">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <h6 class="text-bold pt-2 float-right">Password</h6>
    </div>
    <div class="col-8">
        <div class="form-group">
            <input type="text" class="form-control" name="password_distributor" id="password_distributor" placeholder="Password">
        </div>
    </div>
</div>

<script type="text/javascript">
	foto_distributor.onchange = evt => {
		const [file] = foto_distributor.files
		if (file) {
			blah.src = URL.createObjectURL(file)
		}
	}
</script>