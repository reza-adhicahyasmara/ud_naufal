<input type="hidden" name="jenis" id="jenis" value="Tambah">
<span id="alert"></span>
<div class="row">
    <div class="col-4">
        <h6 class="text-bold pt-2 float-right">Bank</h6>
    </div>
    <div class="col-8">
        <div class="form-group">
            <select class="form-control kode_bank" name="kode_bank" id="kode_bank">
                <option value="">Pilih</option>
                <?php foreach($bank->result() as $row){ ?>
                <option value="<?php echo $row->kode_bank; ?>"><?php echo $row->nama_bank; ?></option>
                <?php } ?> 
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <h6 class="text-bold pt-2 float-right">Atas Nama</h6>
    </div>
    <div class="col-8">
        <div class="form-group">
            <input type="text" class="form-control" name="an_rekening" id="an_rekening" placeholder="Atas Nama">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <h6 class="text-bold pt-2 float-right">No. Rekening</h6>
    </div>
    <div class="col-8">
        <div class="form-group">
            <input type="text" class="form-control" name="no_rekening" id="no_rekening" onkeypress="return /[0-9]/i.test(event.key)" placeholder="No. Rekening">
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('.kode_bank').select2({
            theme: 'bootstrap4',
        })
    });
</script>