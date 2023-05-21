<input type="hidden" name="jenis" id="jenis" value="Edit">
<h4>Informasi Produk</h4>
<div class="row">
    <div class="col-4">
        <h6 class="text-bold pt-2 float-right">Distributor</h6>
    </div>
    <div class="col-8">
        <div class="form-group">
            <select class="form-control id_distributor" name="id_distributor" id="id_distributor" disabled>
                <option value="">Pilih</option>
                <?php foreach($distributor->result() as $row){ ?>
                <option value="<?php echo $row->id_distributor; ?>" <?php if($edit['id_distributor'] == $row->id_distributor){echo "selected";} ?>><?php echo $row->nama_distributor; ?></option>
                <?php } ?> 
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <h6 class="text-bold pt-2 float-right">Kode Produk</h6>
    </div>
    <div class="col-8">
        <div class="form-group">
            <input type="text" class="form-control" name="kode_produk" id="kode_produk" value="<?php echo $edit['kode_produk']; ?>" placeholder="Kode" readonly>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <h6 class="text-bold pt-2 float-right">Nama Produk</h6>
    </div>
    <div class="col-8">
        <div class="form-group">
            <input type="text" class="form-control" name="nama_produk" id="nama_produk" value="<?php echo $edit['nama_produk']; ?>" placeholder="Nama / Merek Produk" readonly>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <h6 class="text-bold pt-2 float-right">Kategori</h6>
    </div>
    <div class="col-8">
        <div class="form-group">
            <select class="form-control kode_kategori" name="kode_kategori" id="kode_kategori" disabled>
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
        <h6 class="text-bold pt-2 float-right">Harga Distributor (Rp/<?php echo $edit['satuan_produk']; ?>)</h6>
    </div>
    <div class="col-8">
        <div class="form-group">
            <input type="text" class="form-control" name="harga_beli_produk" id="harga_beli_produk" onkeypress="return /[0-9.]/i.test(event.key)" value="<?php echo $edit['harga_beli_produk']; ?>" placeholder="Rp." readonly>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <h6 class="text-bold pt-2 float-right">Harga Toko (Rp/<?php echo $edit['satuan_produk']; ?>)</h6>
    </div>
    <div class="col-8">
        <div class="form-group">
            <input type="text" class="form-control" name="harga_jual_produk" id="harga_jual_produk" onkeypress="return /[0-9.]/i.test(event.key)" value="<?php echo $edit['harga_jual_produk']; ?>" placeholder="Rp.">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <h6 class="text-bold pt-2 float-right">Stok Limit (<?php echo $edit['satuan_produk']; ?>)</h6>
    </div>
    <div class="col-8">
        <div class="form-group">
            <input type="text" class="form-control" name="limit_tok_produk" id="limit_tok_produk" onkeypress="return /[0-9.]/i.test(event.key)" value="<?php echo $edit['limit_tok_produk']; ?>" placeholder="<?php echo $edit['satuan_produk']; ?>">
        </div>
    </div>
</div>
<br>
<hr>
<br>
<h4>Manual EOQ & ROP</h4>
<div class="row">
    <div class="col-4">
        <h6 class="text-bold pt-2 float-right">Permintaan Pertahun (D) <?php echo $edit['satuan_produk']; ?></h6>
    </div>
    <div class="col-8">
        <div class="form-group">
            <input type="text" class="form-control" name="d_produk" id="d_produk" onkeypress="return /[0-9.]/i.test(event.key)" value="<?php echo $edit['d_produk']; ?>" placeholder="<?php echo $edit['satuan_produk']; ?>">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <h6 class="text-bold pt-2 float-right">Biaya Penyimpanan Perunit (H) Rp</h6>
    </div>
    <div class="col-8">
        <div class="form-group">
            <input type="text" class="form-control" name="h_produk" id="h_produk" onkeypress="return /[0-9.]/i.test(event.key)" value="<?php echo $edit['h_produk']; ?>" placeholder="Rp">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <h6 class="text-bold pt-2 float-right">Lead Time (LT) Hari</h6>
    </div>
    <div class="col-8">
        <div class="form-group">
            <input type="text" class="form-control" name="lt_produk" id="lt_produk" onkeypress="return /[0-9.]/i.test(event.key)" value="<?php echo $edit['lt_produk']; ?>" placeholder="Hari">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <h6 class="text-bold pt-2 float-right">Safety Stock (SS) <?php echo $edit['satuan_produk']; ?> </h6>
    </div>
    <div class="col-8">
        <div class="form-group">
            <input type="text" class="form-control" name="ss_produk" id="ss_produk" onkeypress="return /[0-9.]/i.test(event.key)" value="<?php echo $edit['ss_produk']; ?>" placeholder="<?php echo $edit['satuan_produk']; ?>">
        </div>
    </div>
</div>