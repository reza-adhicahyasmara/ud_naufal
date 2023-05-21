<input type="hidden" name="jenis" id="jenis" value="Edit">
<div class="row">
    <div class="form-group col-12 col-md-6">
        <h4>Informasi Produk</h4>
        <div class="row">
            <div class="col-4">
                <h6 class="text-bold pt-2 float-right">Kode Produk</h6>
            </div>
            <div class="col-8">
                <div class="form-group">
                    <input type="text" class="form-control" name="kode_produk_baru" id="kode_produk_baru" value="<?php echo $edit['kode_produk']; ?>" placeholder="Kode Produk" readonly>
                    <input type="hidden" class="form-control" name="kode_produk_lama" id="kode_produk_lama" value="<?php echo $edit['kode_produk']; ?>" placeholder="Kode Produk" readonly>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <h6 class="text-bold pt-2 float-right">Nama Produk</h6>
            </div>
            <div class="col-8">
                <div class="form-group">
                    <input type="text" class="form-control" name="nama_produk" id="nama_produk" value="<?php echo $edit['nama_produk']; ?>" placeholder="Nama / Merek Produk">
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
                            <option value="<?php echo $row->kode_kategori; ?>" <?php if($edit['kode_kategori'] == $row->kode_kategori){echo "selected";} ?>><?php echo $row->nama_kategori; ?></option>
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
                        <option value="Botol" <?php if($edit['satuan_produk'] == "Botol"){echo "selected";} ?>>Botol</option>
                        <option value="Dus" <?php if($edit['satuan_produk'] == "Dus"){echo "selected";} ?>>Dus</option>
                        <option value="Pack" <?php if($edit['satuan_produk'] == "Pack"){echo "selected";} ?>>Pack</option>
                        <option value="PCS" <?php if($edit['satuan_produk'] == "PCS"){echo "selected";} ?>>PCS</option>
                        <option value="Renceng" <?php if($edit['satuan_produk'] == "Renceng"){echo "selected";} ?>>Renceng</option>
                        <option value="Sachet" <?php if($edit['satuan_produk'] == "Sachet"){echo "selected";} ?>>Sachet</option>
                        <option value="Unit" <?php if($edit['satuan_produk'] == "Unit"){echo "selected";} ?>>Unit</option>
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
                    <input type="text" class="form-control" name="harga_beli_produk_baru" id="harga_beli_produk_baru" onkeypress="return /[0-9]/i.test(event.key)" value="<?php echo $edit['harga_beli_produk']; ?>" placeholder="Rupiah">
                    <input type="hidden" class="form-control" name="harga_beli_produk_lama" id="harga_beli_produk_lama" onkeypress="return /[0-9]/i.test(event.key)" value="<?php echo $edit['harga_beli_produk']; ?>" placeholder="Rupiah">
                    <input type="hidden" class="form-control" name="tanggal_produk" id="tanggal_produk" value="<?php echo $edit['tanggal_produk']; ?>" placeholder="Rupiah">
                    <input type="hidden" class="form-control" name="perubahan_produk" id="perubahan_produk" value="<?php echo $edit['perubahan_produk']; ?>" placeholder="Rupiah">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <h6 class="text-bold pt-2 float-right">Stok Limit</h6>
            </div>
            <div class="col-8">
                <div class="form-group">
                    <input type="text" class="form-control" name="limit_dis_produk" id="limit_dis_produk" onkeypress="return /[0-9.]/i.test(event.key)" value="<?php echo $edit['limit_dis_produk']; ?>" placeholder="Batasan jika stok akan habis">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <h6 class="text-bold pt-2 float-right">Stok Gudang</h6>
            </div>
            <div class="col-8">
                <div class="form-group">
                    <input type="text" class="form-control" name="stok_dis_produk" id="stok_dis_produk" onkeypress="return /[0-9.]/i.test(event.key)" value="<?php echo $edit['stok_dis_produk']; ?>" placeholder="Batasan jika stok akan habis">
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
                        <?php if($edit['gambar_produk'] != "") { ?>
                            <img id="blah" src="<?php echo base_url('assets/img/produk/'.$edit['gambar_produk']);?>" class="product-image" alt="Gambar Promo" style="border-radius: 3px; width:180px; height:180px; object-fit: cover; ">  
                        <?php }else{ ?>
                            <img id="blah" src="<?php echo base_url('assets/img/banner/box.svg');?>" class="product-image" alt="Gambar Promo" style="border-radius: 3px; width:180px; height:180px; object-fit: cover; ">  
                        <?php } ?> 
                    </div>
                    <input class="text" accept="image/*" type="file" id="gambar_produk" name="file" style="display: none;" />
                    <input class="text" type="text" id="gambar_produk_lama" name="gambar_produk_lama" value="<?php echo $edit['gambar_produk']; ?>" style="display: none;" />
                </label>
            </div>
        </div>
    </div>
</div>

<caption>
    Catatan
    <ul>
        <li>Pastikan update selalu stok gudang dan harga jual. Agar tidak terjadi kendala pada saat pabrik memesan produk</li>
    </ul>
</caption>

<!-----------------------FUNGSI----------------------->
<script type="text/javascript">
	gambar_produk.onchange = evt => {
		const [file] = gambar_produk.files
		if (file) {
			blah.src = URL.createObjectURL(file)
		}
	}

    $(document).ready(function() {
        $('.kode_kategori').select2({
            theme: 'bootstrap4',
        })
    });
    
    $(document).ready(function() {
        $('.kode_satuan').select2({
            theme: 'bootstrap4',
        })
    });
</script>