<input type="hidden" name="jenis" id="jenis" value="Edit">
<div class="form-group">
    <div class="d-flex justify-content-center">
        <div class="form-group text-center">
            <label class="btn" for="foto_karyawan">
                <div class="form-control" style="border-radius: 50%; padding: 0px; width:180px; height: 180px;">
                    <?php if($data_karyawan['foto_karyawan'] != "") { ?>
                        <img id="blah" src="<?php echo base_url('assets/img/karyawan/'.$data_karyawan['foto_karyawan']);?>" class="product-image" alt="Gambar Profil" style="border-radius: 50%; width:180px; height:180px; object-fit: cover; ">  
                    <?php }else{ ?>
                        <img id="blah" src="<?php echo base_url('assets/img/banner/user_solid.png');?>" class="product-image" alt="Gambar Profil" style="border-radius: 50%; width:180px; height:180px; object-fit: cover; ">  
                    <?php } ?> 
                </div>
                <input class="text" accept="image/*" type="file" id="foto_karyawan" name="file" style="display: none;" />
                <input class="text" type="text" id="foto_karyawan_lama" name="foto_karyawan_lama" value="<?php echo $data_karyawan['foto_karyawan']; ?>" style="display: none;" />
            </label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <h6 class="text-bold pt-2 float-right">ID</h6>
    </div>
    <div class="col-8">
        <div class="form-group">
            <input type="text" class="form-control" name="id_karyawan" id="id_karyawan" value="<?php echo $data_karyawan['id_karyawan']; ?>" placeholder="ID" readonly>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <h6 class="text-bold pt-2 float-right">Level</h6>
    </div>
    <div class="col-8">
        <div class="form-group">
            <select type="text" class="form-control" name="level_karyawan" id="level_karyawan" placeholder="Nama Lengkap" readonly>
                <option value="Admin" <?php if($data_karyawan['level_karyawan'] == "Admin"){echo "selected";} ?>>Admin</option>
                <option value="Kasir" <?php if($data_karyawan['level_karyawan'] == "Kasir"){echo "selected";} ?>>Kasir</option>
                <option value="Pemilik" <?php if($data_karyawan['level_karyawan'] == "Pemilik"){echo "selected";} ?>>Pemilik</option>
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <h6 class="text-bold pt-2 float-right">Nama</h6>
    </div>
    <div class="col-8">
        <div class="form-group">
            <input type="text" class="form-control" name="nama_karyawan" id="nama_karyawan" value="<?php echo $data_karyawan['nama_karyawan']; ?>" onkeypress="return /[a-z A-Z]/i.test(event.key)" placeholder="Nama">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <h6 class="text-bold pt-2 float-right">Alamat</h6>
    </div>
    <div class="col-8">
        <div class="form-group">
            <textarea type="text" class="form-control" name="alamat_karyawan" id="alamat_karyawan" placeholder="Alamat" style="height:100px;"><?php echo $data_karyawan['alamat_karyawan']; ?></textarea>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <h6 class="text-bold pt-2 float-right">Kontak</h6>
    </div>
    <div class="col-8">
        <div class="form-group">
            <input type="text" class="form-control" name="kontak_karyawan" id="kontak_karyawan" value="<?php echo $data_karyawan['kontak_karyawan']; ?>" onkeypress="return /[0-9]/i.test(event.key)" placeholder="No. Telepon / No. Handphone">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <h6 class="text-bold pt-2 float-right">Username</h6>
    </div>
    <div class="col-8">
        <div class="form-group" >
            <input type="text" class="form-control" name="" id="username_karyawan_baru" value="<?php echo $data_karyawan['username_karyawan']; ?>" placeholder="Password">
            <input type="hidden" class="form-control" name="username_karyawan_lama" id="username_karyawan_lama" value="<?php echo $data_karyawan['username_karyawan']; ?>" placeholder="Password">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <h6 class="text-bold pt-2 float-right">Password</h6>
    </div>
    <div class="col-8">
        <div class="form-group">
            <input type="text" class="form-control" name="password_karyawan" id="password_karyawan" value="<?php echo $data_karyawan['password_karyawan']; ?>" placeholder="Password">
        </div>
    </div>
</div>


<!-----------------------FUNGSI----------------------->
<script type="text/javascript">
	foto_karyawan.onchange = evt => {
		const [file] = foto_karyawan.files
		if (file) {
			blah.src = URL.createObjectURL(file)
		}
	}
</script>