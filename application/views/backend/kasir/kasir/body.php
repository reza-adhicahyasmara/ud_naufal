<?php $this->load->view('backend/partials/head.php'); ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-1 text-dark"><span class="nav-icon bx bx-fw bx-calculator"></span> Kasir</h1>
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
            <div class="card card-info card-outline card-outline-tabs">
                <div class="card-body">
                    <table style="width:100%" id="dataTable" class="table table-bordered table-striped">
                        <caption></caption>
                        <thead>
                            <tr>
                                <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
                                <th id="" style="text-align: center; vertical-align: middle; width:7%">Gambar</th>
                                <th id="" style="text-align: center; vertical-align: middle; ">Kode</th>
                                <th id="" style="text-align: center; vertical-align: middle; ">Produk</th>
                                <th id="" style="text-align: center; vertical-align: middle; ">Kategori</th>
                                <th id="" style="text-align: center; vertical-align: middle; ">Harga (Rp.)</th>
                                <th id="" style="text-align: center; vertical-align: middle; ">Stok Gudang</th>
                                <th id="" style="text-align: center; vertical-align: middle; ">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $no = 1;
                                foreach($produk as $row) {
                                    if($row->status_penawaran_produk == "Diterima"){
                            ?>
                            <tr>
                                <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
                                <td style="text-align: center; vertical-align: middle;">   
                                    <?php if(date('Y-m-d', strtotime($row->tanggal_produk. ' + 7 days')) >= date("Y-m-d") && $row->tanggal_produk <= date('Y-m-d', strtotime('+7 days'))){ ?>
                                        <div class="position-relative">
                                            <?php if($row->gambar_produk != ""){ ?>
                                                <img src="<?php echo base_url('assets/img/produk/'.$row->gambar_produk);?>" alt="Image" class="img-fluid" style="width:80px; height:80px; object-fit:cover; background:white;">
                                            <?php }else{ ?>
                                                <img src="<?php echo base_url('assets/img/banner/box.svg');?>" alt="Image" alt="Image" style="width:60px; height:60px; margin-top: 9px; object-fit:cover;">
                                            <?php } ?>
                                        </div>                 
                                    <?php
                                        }else{ 
                                            if($row->gambar_produk != ""){
                                    ?>
                                            <img src="<?php echo base_url('assets/img/produk/'.$row->gambar_produk);?>" alt="Image" class="img-fluid" style="width:80px; height:80px; object-fit:cover; background:white;">
                                        <?php }else{ ?>
                                            <img src="<?php echo base_url('assets/img/banner/box.svg');?>" alt="Image" alt="Image" style="width:60px; height:60px; margin-top: 9px; object-fit:cover;">
                                    <?php 
                                            } 
                                        }
                                    ?>
                                </td>
                                <td style="text-align: left; vertical-align: middle;"><?php echo $row->kode_produk;?></td>
                                <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_produk;?></td>
                                <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_kategori;?></td>
                                <td style="text-align: right; vertical-align: middle;"><?php echo number_format($row->harga_jual_produk, 0, ".", ".");?></td>
                                <td style="text-align: right; vertical-align: middle;"><?php echo number_format($row->stok_tok_produk,0,",",".");?></td>
                                <td style="text-align: center; vertical-align: middle;" >
                                    <a class='btn btn-info btn-sm btn-rounded btn_keranjang' kode_produk = <?php echo $row->kode_produk;?>><i class="bx bx-fw bxs-cart-add"></i></a>
                                </td>
                            </tr>
                            <?php
                                        $no++;
                                    }
                                } 
                            ?>
                        </tbody>
                    </table>
                    <br>
                    <hr>
                    <br>
                    <h4>Daftar Produk</h4>
                    <div id="content_item_penjualan">
                        <!--LOAD DATA-->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<form role="form" id="form_item_penjualan" method="post" aria-label="">
    <div id="modal_item_penjualan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-body pt-5">
                    <div class="isi_item">
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class="bx bx-fw bx-x"></span> Batal</button>
                    <button type="button" id="btn_tambah_item_penjualan" class="btn bg-info"><span class="bx bx-fw bxs-cart-add"></span> Tambah</button>
                </div>
            </div>
        </div>
    </div>
</form>

<?php $this->load->view('backend/partials/footer.php') ?>
<?php $this->load->view('backend/partials/script.php') ?>


<!-----------------------FUNGSI----------------------->
<script type="text/javascript">
    var url_kasir =  "<?php echo base_url('kasir/kasir'); ?>";
    var url = url_kasir ;
    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).addClass('active ');
    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
</script>


<script type="text/javascript">

    load_data_item_penjualan();
	function load_data_item_penjualan(){
		$.ajax({
			url : '<?php echo base_url('kasir/kasir/load_data_item_penjualan'); ?>',
            method: 'GET',
			beforeSend : function(){
				$('#content_item_penjualan').html('<div style="text-align:center"><i class="fa fa-refresh fa-3x fa-spin" style="margin-top: 30px; margin-bottom: 30px;" aria-hidden="true"></i></div>');
			},
			success : function(response){
				$('#content_item_penjualan').html(response);
			}
		});
    };
    
    $(document).on('click', '.btn_keranjang', function() {
        var kode_produk = $(this).attr("kode_produk");
        var url = "<?php echo base_url('kasir/kasir/form_tambah_produk'); ?>";

        $('#modal_item_penjualan').modal('show');
        $('.modal-title').text('Tambah Daftar');
        $('.isi_item').load(url,{kode_produk : kode_produk});
    }); 

    $(document).ready(function() {
        $('#btn_tambah_item_penjualan').on("click",function(){
            $.ajax({
                url : '<?php echo base_url('kasir/kasir/insert_item_penjualan'); ?>',
                method : 'POST',
                data: $('#form_item_penjualan').serialize(),
                success: function(response){
                    if(response==1){            
                        load_data_item_penjualan();
                        $('#modal_item_penjualan').modal('hide');
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
        })
    })

    $('body').on('click', '.btn_hapus_item_penjualan', function(){
        var kode_ipenjualan = $(this).attr('kode_ipenjualan');
        $.ajax({
            url : '<?php echo base_url('kasir/kasir/delete_item_penjualan'); ?>',
            method : 'POST',
            data: {kode_ipenjualan : kode_ipenjualan},
            cache:false,
            success:function(hasil){
                load_data_item_penjualan();
            }
        })   
    }); 

</script>


<script type="text/javascript">






</script>

</body>
</html>
