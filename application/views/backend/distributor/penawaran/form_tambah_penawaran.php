<form role="form" id="form_penawaran" method="post" aria-label="">
    <input type="hidden" name="jenis" id="jenis" value="Tambah">
    <h4>Data penawaran</h4>
    <div class="row">
        <div class="col-3">
            <h6 class="text-bold pt-2 float-right">Nama Penawaran</h6>
        </div>
        <div class="col-9">
            <div class="form-group">
                <input type="text" class="form-control" name="nama_penawaran" id="nama_penawaran" placeholder="Nama Penawaran">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-3">
            <h6 class="text-bold pt-2 float-right">Berkas Penawaran (.pdf)</h6>
        </div>
        <div class="col-9">
            <div class="form-group">
                <input class="form-control-file" accept=".pdf" type="file" id="customFile" name="file" />
            </div>
        </div>
    </div>
</form>
<br>
<hr>
<br>
<h4>Daftar Produk</h4>
<div class="row">
    <div class="col-11">
        <div class="form-group produk">
            <select class="form-control kode_produk" name="kode_produk" id="kode_produk">
                <option value="">Pilih</option>
                <?php 
                    foreach($produk->result() as $row){
                        if($row->ID == $this->session->userdata('ses_id_distributor') && $row->status_penawaran_produk == "Baru" || $row->ID == $this->session->userdata('ses_id_distributor') && $row->status_penawaran_produk == "Ditolak"){
                ?>
                    <option value="<?php echo $row->kode_produk; ?>"><?php echo $row->kode_produk." - ".$row->nama_produk; ?></option>
                <?php } } ?> 
            </select>
        </div>
    </div>
    <div class="col-1">
        <button type="button" id="btn_tamabah_produk" class="btn btn-info"><span class="bx bx-fw bx-plus"></span></button>
    </div>
</div>
<br>
<div id="content_produk">
    <!--LOAD DATA-->
</div>


<!-----------------------PENAWARAN----------------------->
<Script type="text/javascript">
    load_data_produk();
	function load_data_produk(){
		$.ajax({
			method : "GET",
			url : '<?php echo base_url('distributor/penawaran/load_data_produk'); ?>',
			beforeSend : function(){
				$('#content_produk').html('<div style="text-align:center"><i class="fa fa-refresh fa-3x fa-spin" style="margin-top: 30px; margin-bottom: 30px;" aria-hidden="true"></i></div>');
			},
			success : function(response){
				$('#content_produk').html(response);
			}
		});
    };

    $('#btn_tamabah_produk').on("click",function(){
        var kode_produk = $('#kode_produk').find(":selected").val();
        var status_penawaran_produk = "Ditawarkan";
        $.ajax({
            url : '<?php echo base_url('distributor/penawaran/update_produk'); ?>',
            method: 'POST',
            data: {
                kode_produk:kode_produk,
                status_penawaran_produk:status_penawaran_produk,
            },  
            success: function(response){
                if(response==1){
                    load_data_produk();
                    $("div.produk select").val("").change();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: response,
                        showConfirmButton: true,
                        confirmButtonColor: '#17a2b8',
                        timer: 3000
                    })
                }
            }
        }); 
    });

    $(document).on('click', '.btn_hapus_produk', function(e) {
        var kode_produk = $(this).attr("kode_produk");
        var status_penawaran_produk = "Baru";

        $.ajax({
            url: '<?php echo base_url('distributor/penawaran/update_produk'); ?>',
            method: 'POST',
            data: {
                kode_produk:kode_produk,
                status_penawaran_produk:status_penawaran_produk,
            },   
            success: function(response){
                load_data_produk();
            }          
        })
    });  
</Script>