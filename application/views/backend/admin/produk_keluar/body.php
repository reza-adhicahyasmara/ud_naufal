<?php $this->load->view('backend/partials/head.php'); ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-1 text-dark"><span class="nav-icon bx bx-fw bx-up-arrow-alt"></span> Stok Produk Keluar</h1>
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
                    <div id="content_data_produk_keluar">
                        <!--LOAD DATA-->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<?php $this->load->view('backend/partials/footer.php') ?>
<?php $this->load->view('backend/partials/script.php') ?>


<!-----------------------FUNGSI----------------------->
<script type="text/javascript">
    var url_produk_keluar =  "<?php echo base_url('admin/produk_keluar'); ?>";
    var url = url_produk_keluar ;
    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).addClass('active ');
    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
</script>


<script type="text/javascript">

    load_data_produk_keluar();
	function load_data_produk_keluar(){
		$.ajax({
			method : "GET",
			url : '<?php echo base_url('admin/produk_keluar/load_data_produk_keluar'); ?>',
			beforeSend : function(){
				$('#content_data_produk_keluar').html('<div style="text-align:center"><i class="fa fa-refresh fa-3x fa-spin" style="margin-top: 30px; margin-bottom: 30px;" aria-hidden="true"></i></div>');
			},
			success : function(response){
				$('#content_data_produk_keluar').html(response);
			}
		});
    };

</script>

</body>
</html>
