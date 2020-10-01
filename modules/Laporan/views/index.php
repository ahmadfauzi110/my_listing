

<div class="row">
    <div class="col-md-12 ">
        <div class="col-md-12 card pt-1">
            <div class="card-content row">
                <div class="col-md-6 ">
                    <span class="grey font-large-1"><i class="<?=$this->info['icon']?> "></i> <?=$this->info['title']?></span>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="<?=base_url('dashboard')?>">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <?=$this->info['title']?>
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="col-md-6 float-md-right mt-1">
                    
                </div>
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
                <div class="portlet light bordered ">
                    <div class="portlet-title">
                        <h3 class="caption">
                            <i class="fa fa-search"></i><?=ucwords('filter')?>
                        </h3>
                        <div class="tools">
                            <a href="" class="collapse"> </a>
                        </div>
                    </div>
                    <div class="portlet-body form card bg-blue bg-lighten-5 pt-1 " style="margin-left : -1%; margin-right:-1%;">
                        <form role="form" action="<?=site_url($this->cname)?>" method="post">
                            <div class="form-body card-content col-md-12" >
                                <div class="form-group col-md-12 float-md-right pr-1" style="z-index: 1000;">
                                    <label>Tanggal</label>
                                    <div class="input-group input-large date-picker input-daterange" data-date-format="yyyy-mm-dd">
                                        <input type="text" class="form-control" name="tanggal_awal" value="<?=@$filter['tanggal_awal'];?>">
                                        <span class="input-group-addon"> to </span>
                                        <input type="text" class="form-control" name="tanggal_akhir" value="<?=@$filter['tanggal_akhir'];?>"> 
                                    </div>
                                </div>

                                
                                
                                

                                <div class="col-md-5"></div>
                                <div class="form-group col-md-12">
                                    <button type="submit" class="btn btn-blue-2 float-md-right"><i class="fa fa-search"></i> Cari</button>
                                    <a class="btn btn-outline-danger" href="<?=site_url($this->cname.'/reset_filter')?>"><i class="fa fa-refresh"></i> Reset</a>
                                </div>
                                
                            </div>
                        </form>
                    </div>
                </div>
                <table class="table table-striped table-bordered table-hover" id="tabel">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Produk</th>
                            <th>Nama Pelanggan</th>
                            <th>No HP</th>
                            <th>Alamat</th>
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
    $(document).ready(function(){
        var oTable = $('#tabel').dataTable( {
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": '<?php echo site_url($this->cname . "/get_data");?>', //mengambil data ke controller datatable fungsi getdata
            "sPaginationType": "full_numbers",
            "aLengthMenu": [[15, 30, 75, -1], [15, 30, 75, "All"]],
            "iDisplayStart ":15,
            "columns": [
                { "data": "tanggal"},
                { "data": "nama_produk"},
                { "data": "nama_pelanggan"},
                { "data": "no_hp"},
                { "data": "alamat"},
                
            ],
             "oLanguage": {
                "sProcessing": '<img class="bg-blue bg-lighten-5 round mb-1" src="<?php echo base_url("assets/loading2.gif");?>"><br><p style="margin-top:-5px;">Loading</p>'
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
        });
        
        $('.date-picker').datepicker();
    });

</script>