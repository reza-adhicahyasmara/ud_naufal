<?php $this->load->view('backend/partials/head.php'); ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-1 text-dark"><span class="nav-icon bx bx-fw bx-down-arrow-alt"></span> Stok Produk Masuk</h1>
                </div>
                <div class="col-sm-6 float-sm-right">
                    <ol class="breadcrumb float-sm-right m-2">
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
    <section class="content">
        <div class="container-fluid">
            <div class="card card-outline card-info">
                <div class="card-body">
                    <h4>Pembelian Produk Distributor</h4>
                    <caption>Masukan Invoice Jika Produk Sudah Sampai</caption>
                    <br>
                    <br>
                    <select class="form-control kode_pembelian" name="kode_pembelian" id="kode_pembelian">
                        <option value="">Pilih</option>
                        <?php 
                            foreach($aaa->result() as $row){ 
                                if($row->status_pembelian == 4){
                        ?>

                        <option value="<?php echo $row->kode_pembelian; ?>"><?php echo $row->nama_distributor." | ".$row->kode_pembelian; ?></option>
                        <?php 
                                }
                            } 
                        ?> 
                    </select>
                    <br>
                    <br>
                    <div id="content_pengiriman_produk">
                        <!--LOAD DATA-->
                    </div>
                </div>
            </div>
            <div class="card card-outline card-info">
                <div class="card-body">
                    <div id="content_produk_masuk">
                        <!--LOAD DATA-->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<form role="form" id="form_penerimaan_ipembelian" method="post" aria-label="">
    <div id="modal_penerimaan_ipembelian" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="kode_ipembelian" id="kode_ipembelian" readonly/>
                    <div class="row mb-3">
                        <div class="col-3">
                            <img id="produk" class="product-image produk" src="" alt="Gambar Promo" style="border-radius: 10px; width: 100px; height: 100px;  object-fit: cover;">    
                        </div>
                        <div class="col-9">
                            <span class="text-lg" id="text_nama_produk"></span>
                            <br>
                            <span class="text-md" id="text_qty_ipembelian"></span>
                        </div>
                    </div>
                    <div class="form-group mb-3" id="status">
                        <label>Status</label>
                        <select class="form-control status_ipembelian" name="status_ipembelian" id="status_ipembelian">
                            <option value="Dikirim">Pilih</option>
                            <option value="Selesai">Selesai</option>
                            <!-- <option value="Retur">Retur</option> -->
                        </select>
                    </div>
                    <div class="form-group mb-3" id="retur_keterangan" style="display: none;">
                        <label>Qty Retur</label>
                        <input type="hidden" class="form-control" name="qty_ipembelian" id="qty_ipembelian" onkeypress="return /[0-9.]/i.test(event.key)" placeholder="Qty">
                        <input type="text" class="form-control" name="qty_retur_ipembelian" id="qty_retur_ipembelian" onkeypress="return /[0-9.]/i.test(event.key)" placeholder="Qty">
                    </div>
                    <div class="form-group mb-3" id="retur_keterangan" style="display: none;">
                        <label>Keterangan Retur</label>
                        <textarea class="form-control" name="keterangan_retur_ipembelian" id="keterangan_retur_ipembelian" placeholder="Keterangan"></textarea>
                    </div>
                    <div class="form-group mb-3" id="retur_gambar" style="display: none;">
                        <label>Gambar Retur</label>
                        <div style="text-align: center">
                            <div class="d-flex justify-content-center">
                                <div class="form-group mb-3 text-center">
                                    <div class="form-control" style="padding: 0px; width:180px; height: 180px;">
                                        <img id="gambar_retur1" class="product-image gambar_retur1" src="" alt="Gambar Promo" style="border-radius: 3px; width:180px; height:180px; object-fit: cover; ">  
                                        <img id="gambar_retur2" class="product-image gambar_retur2" src="<?php echo base_url('assets/img/banner/image_add.svg');?>" alt="Gambar Promo" style="border-radius: 3px; width:180px; height:180px; object-fit: cover; ">   
                                    </div>
                                    <input class="text" accept="image/*" type="file" id="gambar_retur_ipembelian" name="file" style="display: none;" />
                                    <label class="btn btn-primary btn-sm" for="gambar_retur_ipembelian">Pilih Gambar</label>
                                    <input type="hidden" id="gambar_retur_ipembelian_lama" name="gambar_retur_ipembelian_lama"  />
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="text" id="btn_simpan_status_ipembelian" class="btn btn-success" style="width:100%">Simpan</button>  
                </div>
            </div>
        </div>
    </div>
</form>


<?php $this->load->view('backend/partials/footer.php') ?>
<?php $this->load->view('backend/partials/script.php') ?>

<!-----------------------FUNGSI----------------------->
<script type="text/javascript">
    var url_produk =  "<?php echo base_url('admin/produk_masuk'); ?>";
    var url = url_produk ;
    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).addClass('active ');
    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');

    $(document).ready(function() {
        $('.kode_pembelian').select2({
            theme: 'bootstrap4',
        })
    });
</script>


<!-----------------------ITEM RETUR----------------------->
<script type="text/javascript">

    gambar_retur_ipembelian.onchange = evt => {
        const [file] = gambar_retur_ipembelian.files
        if (file) {
            gambar_retur1.src = URL.createObjectURL(file);
			gambar_retur2.src = URL.createObjectURL(file);
		}
    }

    $(".status_ipembelian").change(function() {
        var status_ipembelian = $('#status_ipembelian').val();
        if(status_ipembelian == "Retur"){
            $("div#retur_keterangan").show(500);
            $("div#retur_gambar").show(500);
        }else if(status_ipembelian == "Selesai"){
            $("div#retur_keterangan").hide(500);
            $("div#retur_gambar").hide(500);
            
            $("#nama_produk").val("");
            $("#qty_ipembelian").val("");
            $("#qty_retur_ipembelian").val("");
            $("#keterangan_retur_ipembelian").val("");
            $("#gambar_retur_ipembelian").val("");
        }else{
            $("div#retur_keterangan").hide(500);
            $("div#retur_gambar").hide(500);
        }
    });

    function empty_data_ipesanan(){  
        $("#kode_ipembelian").val("");
        $("#nama_produk").val("");
        $("#qty_ipembelian").val("");
        $("#qty_retur_ipembelian").val("");
        $("#keterangan_retur_ipembelian").val("");
        $("#gambar_retur_ipembelian").val("");
    }

    $(document).on('click', '.btn_status_ipesanan_retur', function() {
        var kode_ipembelian = $(this).attr("kode_ipembelian");
        var nama_produk = $(this).attr("nama_produk");
        var qty_ipembelian = $(this).attr("qty_ipembelian");
        var qty_retur_ipembelian = $(this).attr("qty_retur_ipembelian");
        var keterangan_retur_ipembelian = $(this).attr("keterangan_retur_ipembelian");
        var gambar_retur_ipembelian = $(this).attr("gambar_retur_ipembelian");
        var status_ipembelian = $(this).attr("status_ipembelian");
        var gambar_produk = $(this).attr("gambar_produk");

        if(gambar_produk != ""){
            document.getElementById("produk").src = '<?php echo base_url('assets/img/produk/');?>'+gambar_produk;
        }else{
            document.getElementById("produk").src = '<?php echo base_url('assets/img/produk/banner/package_regular.png');?>';
        }

        if(status_ipembelian == "Retur"){
            $("div#retur_keterangan").show(500);
            $("div#retur_gambar").show(500);
        }else if(status_ipembelian == "Selesai"){
            $("div#retur_keterangan").hide(500);
            $("div#retur_gambar").hide(500);
        }else{
            $("div#retur_keterangan").hide(500);
            $("div#retur_gambar").hide(500);
        }

        if(gambar_retur_ipembelian != ""){
            $("img.gambar_retur1").show(500);
            $("img.gambar_retur2").hide(500);
            document.getElementById("gambar_retur1").src = '<?php echo base_url('assets/img/retur_produk/');?>'+gambar_retur_ipembelian;
        }else{
            $("img.gambar_retur1").hide(500);
            $("img.gambar_retur2").show(500);
        }
        
        $('#text_nama_produk').text(nama_produk);
        $('#text_qty_ipembelian').text(qty_ipembelian+" item");

        $('#kode_ipembelian').val(kode_ipembelian);
        $('#qty_ipembelian').val(qty_ipembelian);
        $('#qty_retur_ipembelian').val(qty_retur_ipembelian);
        $('#keterangan_retur_ipembelian').val(keterangan_retur_ipembelian);
        $('#gambar_retur_ipembelian_lama').val(gambar_retur_ipembelian);
        $("div#status select").val(status_ipembelian);
        
        $('#modal_penerimaan_ipembelian').modal('show');
        $('.modal-title').text('Status Penerimaan Produk');
    }); 
    
    $("#btn_simpan_status_ipembelian").click(function(e){
        $('#form_penerimaan_ipembelian').validate({
            rules: {
                status_ipembelian: {
                    required: true,
                },
                qty_retur_ipembelian: {
                    required: true,
                },
                keterangan_retur_ipembelian: {
                    required: true,
                },
            },
            messages: {
                status_ipembelian: {
                    required: "Status harus diisi",
                },
                qty_retur_ipembelian: {
                    required: "Keterangan harus diisi",
                },
                keterangan_retur_ipembelian: {
                    required: "Keterangan harus diisi",
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
                $.ajax({
                    url : '<?php echo base_url('admin/produk_masuk/update_status_ipembelian'); ?>',
                    method : 'POST',
                    data: new FormData($('#form_penerimaan_ipembelian')[0]),
                    processData:false,
                    contentType:false,
                    cache:false,
                    async:false,
                    success: function(response){
                        if(response==1){     
                            load_data_ipembelian();
                            $('#modal_penerimaan_ipembelian').modal('hide');
                            empty_data_ipesanan();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: response,
                                showConfirmButton: true,
                                timer: 3000
                            })
                        }
                    }
                })
            }
        })
    })

	function load_data_ipembelian(){
        var kode_pembelian = $('#kode_pembelian').val();
        $.ajax({
            url : '<?php echo base_url('admin/produk_masuk/load_data_pengiriman_produk'); ?>',
            method: 'POST',
            data: {kode_pembelian:kode_pembelian},
            beforeSend : function(){
                $('#content_pengiriman_produk').html('<div style="text-align:center"><i class="fa fa-refresh fa-3x fa-spin" style="margin-top: 30px; margin-bottom: 30px;" aria-hidden="true"></i></div>');
            },
            success : function(response){
                $('#content_pengiriman_produk').html(response);
            }
        });     
    };  

</script>



<script type="text/javascript">
    load_data_produk_masuk();
	function load_data_produk_masuk(){
		$.ajax({
			method : "GET",
			url : '<?php echo base_url('admin/produk_masuk/load_data_produk_masuk'); ?>',
			beforeSend : function(){
				$('#content_produk_masuk').html('<div style="text-align:center"><i class="fa fa-refresh fa-3x fa-spin" style="margin-top: 30px; margin-bottom: 30px;" aria-hidden="true"></i></div>');
			},
			success : function(response){
				$('#content_produk_masuk').html(response);
			}
		});
    };

    $(document).ready(function(){
        $("#kode_pembelian").change(function() {
            var kode_pembelian = $('#kode_pembelian').val();
            $.ajax({
                url : '<?php echo base_url('admin/produk_masuk/load_data_pengiriman_produk'); ?>',
                method: 'POST',
                data: {kode_pembelian:kode_pembelian},
                beforeSend : function(){
				    $('#content_pengiriman_produk').html('<div style="text-align:center"><i class="fa fa-refresh fa-3x fa-spin" style="margin-top: 30px; margin-bottom: 30px;" aria-hidden="true"></i></div>');
                },
                success : function(response){
                    $('#content_pengiriman_produk').html(response);
                }
            });     
        });    
    });

    $(document).on('click', '#btn_simpan', function(e) {
        var kode_pembelian = $('#kode_pembelian').val();
        
        Swal.fire({
            title: 'Pastikan produk sesuai dengan pesanan!',
            type: 'warning',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#17a2b8',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, simpan',
            cancelButtonText: "Tidak, batalkan",
            showLoaderOnConfirm: true,
            customClass: 'animated tada',
            preConfirm: function() {
                return new Promise(function(resolve) {
                    $.ajax({
                        url: '<?php echo base_url('admin/produk_masuk/update_pemesanan'); ?>',
                        method: 'POST',
                        data: {
                            kode_pembelian:kode_pembelian
                        },       
                        success: function(response){ 
                            if(response==1){
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Data telah diupdate!',
                                    showConfirmButton: true,
                                    confirmButtonColor: '#17a2b8',
                                    timer: 3000
                                }).then(function(){
                                    window.location.reload();
                                })
                            }else{
                                Swal.fire({
                                    icon: 'warning',
                                    title: response,
                                    showConfirmButton: true,
                                    confirmButtonColor: '#17a2b8',
                                    timer: 3000
                                })
                            }     
                        }            
                    })
                });
            },
        });
    });  

</script>

</body>
</html>