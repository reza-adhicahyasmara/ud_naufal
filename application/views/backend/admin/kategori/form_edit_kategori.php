<input type="hidden" name="jenis" id="jenis" value="Edit">
<div class="row">
    <div class="col-4">
        <h6 class="text-bold pt-2 float-right">Kode Kategori</h6>
    </div>
    <div class="col-8">
        <div class="form-group">
            <input type="text" class="form-control" name="kode_kategori_baru" id="kode_kategori_baru" value="<?php echo $edit['kode_kategori']; ?>" placeholder="ATK">
            <input type="hidden" class="form-control" name="kode_kategori_lama" id="kode_kategori_lama" value="<?php echo $edit['kode_kategori']; ?>" placeholder="ATK">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <h6 class="text-bold pt-2 float-right">Keterangan Kategori</h6>
    </div>
    <div class="col-8">
        <div class="form-group">
            <input type="text" class="form-control" name="nama_kategori" id="nama_kategori" value="<?php echo $edit['nama_kategori']; ?>" placeholder="Alat Tulis Kantor">
        </div>
    </div>
</div>