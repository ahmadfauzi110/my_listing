<!-- BEGIN PAGE BASE CONTENT -->
<div class="row">
    <div class="col-md-12 ">
        <div class="col-md-12 content-header box-crumb">
            <div class="content-header-left col-md-12 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block"><i class="<?=$this->info['icon']?> "></i> <?=$this->info['title']?></h3>
                <div class="row breadcrumbs-top d-inline-block">
                  <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?=base_url('dashboard')?>">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <?=$this->info['title']?>
                        </li>
                    </ol>
                  </div>
                </div>
                <div class="com pull-right"><?= $this->button_tambah ?></div>
            </div>
        </div>
        <div class="col-md-12 card">
            <div class="col-md-12">
				<div class="heading-elements float-md-right pt-1">
						<ul class="list-inline mb-0">
							<li><a class="reload"><i class="ft-rotate-cw"></i></a></li>
						</ul>
				</div>
			</div>
            <div class="card-content pr-1 pl-1 pt-2">
                <table class="table table-striped table-bordered table-hover" id="tabel">
                    <thead>
                        <tr>
                            <th>Gambar</th>
                            <th>Nama Produk</th>
                            <th>Deskripsi</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th style="width:125px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
<!-- END PAGE BASE CONTENT -->
<script type="text/javascript">
    function imgError(image) {
        image.onerror = "";
        image.src = "<?=base_url('assets/image')?>img_not_available.png";
        return true;
    }
    $(document).ready(function(){
        var oTable = $('#tabel').dataTable( {
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": '<?php echo base_url($this->info['url'] . "/get_data");?>', //mengambil data ke controller datatable fungsi getdata
            "sPaginationType": "full_numbers",
            "aLengthMenu": [[15, 30, 75, -1], [15, 30, 75, "All"]],
            "iDisplayStart ":15,
            "columns": [
                { "data": "gambar",
                    "render" : function(data, type, row) {
                        return '<img src="<?=base_url('assets/upload/produk').'/'?>'+data+'" class="img" width=" 110px" onerror="imgError(this)" />';
                    }
                },
                { "data": "nama_produk"},
                { "data": "deskripsi"},
                { "data": "harga"},
                { "data": "status",
                    "render": function(data, type, row) {
                        if(data == 'Y'){
                            return '<input type="checkbox" class="make-switch" name="status" checked="" data-on-text="&nbsp;Aktif&nbsp;" data-off-text="&nbsp;Tidak&nbsp;" data-on-color="primary" data-off-color="danger" onchange="ubah_status('+row.id_produk+')">';
                        }
                        else{
                            return '<input type="checkbox" class="make-switch" name="status" data-on-text="&nbsp;Aktif&nbsp;" data-off-text="&nbsp;Tidak&nbsp;" data-on-color="primary" data-off-color="danger" onchange="ubah_status('+row.id_produk+')">';
                        }
                                
                    }
                },
                { "data": "action"}
            ],
             "oLanguage": {
                "sProcessing": '<img class="bg-blue bg-lighten-4 round mb-1" src="<?php echo base_url("assets/image/loading2.gif");?>"><br><p style="margin-top:-5px;">Loading</p>'
            },
            "fnInitComplete": function() {
                     //oTable.fnAdjustColumnSizing();
            },
            'fnServerData': function(sSource, aoData, fnCallback)
            {
              $.ajax
              ({
                'dataType': 'json',
                'type'    : 'POST',
                'url'     : sSource,
                'data'    : aoData,
                'success' : fnCallback
              });
            }

        });
        $('#tabel').on('draw.dt',function(){
            reloadbutton();
            $('.make-switch').bootstrapSwitch();
        });

    });
    function ubah_status(id) {
        console.log(id);
        $.ajax({
            url:"<?= site_url($this->cname.'/ubah_status')  ?>",
            type:"POST",
            data: {id_produk: id},
            dataType: "json",
            cache:false,
            success:function(hasil){
                
            }
        });
    }
</script>