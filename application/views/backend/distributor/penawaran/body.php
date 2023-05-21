<?php $this->load->view('backend/partials/head.php') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-1 text-dark"><span class="nav-icon bx bx-fw bxs-offer"></span>Data Penawaran</h1>
                </div>
                <div class="col-sm-6 float-sm-right">
                    <ol class="breadcrumb float-sm-right m-2">
                        <button type="button" class="btn btn-info" id="btn_tambah_penawaran"><span class="bx bx-fw bx-plus"></span> Tambah Data </button>
                    </ol>
                </div>  
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-info card-outline">
                <div class="card-body">
                    <div id="content_penawaran">
                        <!--LOAD DATA-->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div id="modal_penawaran" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <strong><span class="modal-title text-lg" id="myModalLabel"></span></strong>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- FORM -->
            </div>
        </div>
    </div>
</div>

<div id="modal_view_pdf" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <!-- FORM -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class="bx bx-fw bx-x"></span> Tutup</button>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('backend/partials/footer.php') ?>
<?php $this->load->view('backend/partials/script.php') ?>

<!-----------------------FUNGSI----------------------->
<script type="text/javascript">
    var url_penawaran =  "<?php echo base_url('distributor/penawaran'); ?>";
    var url = url_penawaran ;
    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).addClass('active ');
    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
</script>

<!-----------------------PENAWARAN----------------------->
<script type="text/javascript">

    load_data_penawaran();
	function load_data_penawaran(){
		$.ajax({
			method : "GET",
			url : '<?php echo base_url('distributor/penawaran/load_data_penawaran'); ?>',
			beforeSend : function(){
				$('#content_penawaran').html('<div style="text-align:center"><i class="fa fa-refresh fa-3x fa-spin" style="margin-top: 30px; margin-bottom: 30px;" aria-hidden="true"></i></div>');
			},
			success : function(response){
				$('#content_penawaran').html(response);
			}
		});
    };

    $('#btn_tambah_penawaran').on("click",function(){
        var url = "<?php echo base_url('distributor/penawaran/form_tambah_penawaran'); ?>";

        $('#modal_penawaran').modal('show');
        $('.modal-title').text('Tambah Penawaran');
        $('.modal-body').load(url);
    });
</script>

</body>
</html>

