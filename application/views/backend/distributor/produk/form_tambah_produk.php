<input type="hidden" name="jenis" id="jenis" value="Tambah">
<div class="row">
    <div class="form-group col-12 col-md-6">
        <h4>Informasi Produk</h4>
        <div class="row">
            <div class="col-4">
                <h6 class="text-bold pt-2 float-right">Kode Produk</h6>
            </div>
            <div class="col-8">
                <div class="form-group">
                    <input type="text" class="form-control" name="kode_produk_baru" id="kode_produk_baru" placeholder="Kode">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <h6 class="text-bold pt-2 float-right">Nama Produk</h6>
            </div>
            <div class="col-8">
                <div class="form-group">
                    <input type="text" class="form-control" name="nama_produk" id="nama_produk" placeholder="Nama / Merek Produk">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <h6 class="text-bold pt-2 float-right">Kategori</h6>
            </div>
            <div class="col-8">
                <div class="form-group">
                    <select class="form-control kode_kategori" name="kode_kategori" id="kode_kategori">
                        <option value="">Pilih</option>
                        <?php foreach($kategori->result() as $row){ ?>
                            <option value="<?php echo $row->kode_kategori; ?>"><?php echo $row->nama_kategori; ?></option>
                        <?php } ?> 
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <h6 class="text-bold pt-2 float-right">Satuan</h6>
            </div>
            <div class="col-8">
                <div class="form-group">
                    <select class="form-control satuan_produk" name="satuan_produk" id="satuan_produk">
                        <option value="">Pilih</option>
                        <option value="Botol">Botol</option>
                        <option value="Dus">Dus</option>
                        <option value="Pack">Pack</option>
                        <option value="PCS">PCS</option>
                        <option value="Renceng">Renceng</option>
                        <option value="Sachet">Sachet</option>
                        <option value="Unit">Unit</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    
    <div class="form-group col-12 col-md-6">
        <h4>Harga & Stok</h4>
        <div class="row">
            <div class="col-4">
                <h6 class="text-bold pt-2 float-right">Harga (Rp)</h6>
            </div>
            <div class="col-8">
                <div class="form-group">
                    <input type="text" class="form-control" name="harga_beli_produk_baru" id="harga_beli_produk_baru" onkeypress="return /[0-9]/i.test(event.key)" placeholder="Harga jual distributor">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <h6 class="text-bold pt-2 float-right">Stok Limit</h6>
            </div>
            <div class="col-8">
                <div class="form-group">
                    <input type="text" class="form-control" name="limit_dis_produk" id="limit_dis_produk" onkeypress="return /[0-9.]/i.test(event.key)" placeholder="Batasan jika stok akan habis">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <h6 class="text-bold pt-2 float-right">Stok Gudang</h6>
            </div>
            <div class="col-8">
                <div class="form-group">
                    <input type="text" class="form-control" name="stok_dis_produk" id="stok_dis_produk" onkeypress="return /[0-9.]/i.test(event.key)" placeholder="Batasan jika stok akan habis">
                </div>
            </div>
        </div>
    </div>
    <div class="form-group col-12 col-md-12">
        <h4>Gambar Produk</h4>
        <div class="form-group">
            <div class="d-flex justify-content-center">
                <label class="btn" for="gambar_produk">
                    <div class="form-control" style="padding: 0px; width:180px; height: 180px;">
                        <img id="blah" src="<?php echo base_url('assets/img/banner/package_regular.png');?>" class="product-image" alt="Gambar Profil" style="width:180px; height:180px; object-fit: cover; ">  
                    </div>
                    <input class="hidden" accept="image/*" type="file" id="gambar_produk" name="file" style="display: none;" />
                </label>
            </div>
        </div>
    </div>
</div>


<!-----------------------FUNGSI----------------------->
<script type="text/javascript">
	gambar_produk.onchange = evt => {
		const [file] = gambar_produk.files
		if (file) {
			blah.src = URL.createObjectURL(file)
		}
	}
</script>