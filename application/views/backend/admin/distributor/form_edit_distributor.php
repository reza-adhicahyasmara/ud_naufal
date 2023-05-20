<input type="hidden" name="jenis" id="jenis" value="Edit">
<div class="form-group">
    <div class="d-flex justify-content-center">
        <div class="form-group text-center">
            <div class="form-control" style="padding: 0px; width:180px; height: 180px;">
                <?php if($edit['foto_distributor'] != "") { ?>
                    <img id="blah" src="<?php echo base_url('assets/img/distributor/'.$edit['foto_distributor']);?>" class="product-image" alt="Gambar Promo" style="border-radius: 3px; width:180px; height:180px; object-fit: cover; ">  
                <?php }else{ ?>
                    <img id="blah" src="<?php echo base_url('assets/img/banner/image_alt.svg');?>" class="product-image" alt="Gambar Promo" style="border-radius: 3px; width:180px; height:180px; object-fit: cover; ">  
                <?php } ?> 
            </div>
            <input class="text" accept="image/*" type="file" id="foto_distributor" name="file" style="display: none;" />
            <input class="text" type="text" id="foto_distributor_lama" name="foto_distributor_lama" value="<?php echo $edit['foto_distributor']; ?>" style="display: none;" />
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
            <input type="hidden" class="form-control" name="id_distributor" id="id_distributor" value="<?php echo $edit['id_distributor']; ?>">
            <input type="text" class="form-control" name="nama_distributor" id="nama_distributor" value="<?php echo $edit['nama_distributor']; ?>" placeholder="Nama Distributor" >
        </div>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <h6 class="text-bold pt-2 float-right">PIC</h6>
    </div>
    <div class="col-8">
        <div class="form-group">
            <input type="text" class="form-control" name="pic_distributor" id="pic_distributor" value="<?php echo $edit['pic_distributor']; ?>" placeholder="PIC">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <h6 class="text-bold pt-2 float-right">Alamat</h6>
    </div>
    <div class="col-8">
        <div class="form-group">
            <textarea type="text" class="form-control" name="alamat_distributor" id="alamat_distributor" placeholder="Alamat" style="height:100px;"><?php echo $edit['alamat_distributor']; ?></textarea>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <h6 class="text-bold pt-2 float-right">No. Telepon / HP</h6>
    </div>
    <div class="col-8">
        <div class="form-group">
            <input type="text" class="form-control" name="kontak_distributor" id="kontak_distributor" value="<?php echo $edit['kontak_distributor']; ?>" placeholder="No. Telepon / HP">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <h6 class="text-bold pt-2 float-right">Username</h6>
    </div>
    <div class="col-8">
        <div class="form-group">
            <input type="hidden" class="form-control" name="username_distributor_lama" id="username_distributor_lama" value="<?php echo $edit['username_distributor']; ?>" placeholder="Password">
            <input type="text" class="form-control" name="username_distributor_baru" id="username_distributor_baru" value="<?php echo $edit['username_distributor']; ?>" placeholder="Password">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <h6 class="text-bold pt-2 float-right">Password</h6>
    </div>
    <div class="col-8">
        <div class="form-group">
            <input type="text" class="form-control" name="password_distributor" id="password_distributor" value="<?php echo $edit['password_distributor']; ?>" placeholder="Password">
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