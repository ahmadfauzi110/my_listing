
<link href="<?= base_url('assets/template_b/vendors/js')?>/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
<script src="<?= base_url('assets/template_b/vendors/js')?>/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>

<div class="row">
    <div class="col-md-12 ">
		
		<form action="<?=site_url($this->cname.'/do_tambah')  ?>" class="form-horizontal" method="POST" enctype="multipart/form-data">
			<div class="col-md-12 content-header box-crumb">
				<div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
					<h3 class="content-header-title mb-0 d-inline-block"><i class="<?=$this->info['icon']?> "></i> <?=$this->info['title']?></h3>
					<div class="row breadcrumbs-top d-inline-block">
					  <div class="breadcrumb-wrapper col-12">
					    <ol class="breadcrumb">
							<li class="breadcrumb-item">
							    <a href="<?=base_url('dashboard')?>">Home</a>
							</li>
							<li class="breadcrumb-item">
								<a href="<?=base_url($this->info['url'])?>"><?=$this->info['title']?></a>
							</li>
							<li class="breadcrumb-item">
							    Tambah
							</li>
					    </ol>
					  </div>
					</div>
				</div>
      </div>
	    <div class="card">
			<div class="col-md-12">
				<div class="heading-elements float-md-right pt-1">
						<ul class="list-inline mb-0">
							<li><a data-action="expand"><i class="ft-maximize"></i></a></li>
						</ul>
				</div>
			</div>
            <div class="card-content pr-1 pl-1 pt-2 form">

				<div class="form-body row">
					<div class="col-md-6">
						<h4 class="form-section grey">
							<i class="icon-info"></i>
							Umum
						</h4>
						
						<div class="form-group">
							<label class="control-label col-md-4 float-md-left"><?=ucwords(str_replace('_', ' ', 'nama_produk'))?></label>
							<div class="col-md-8 float-md-left">
								<input class="form-control elipsis" type="text" name="nama_produk" placeholder="<?=ucwords(str_replace('_', ' ', 'nama_produk'))?>" value="<?=@$this->session->flashdata('postdata')->nama_produk?>" required/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-4 float-md-left"><?=ucwords(str_replace('_', ' ', 'Deskripsi'))?></label>
							<div class="col-md-8 float-md-left">
								<textarea class="form-control"  name="deskripsi" placeholder="<?=ucwords(str_replace('_', ' ', 'Deskripsi'))?>" ><?=@$this->session->flashdata('postdata')->alamat?></textarea>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-4 float-md-left"><?=ucwords(str_replace('_', ' ', 'harga'))?></label>
							<div class="col-md-8 float-md-left">
								<input class="form-control elipsis" type="text" name="harga" placeholder="<?=ucwords(str_replace('_', ' ', 'harga'))?>" value="<?=@$this->session->flashdata('postdata')->harga?>" required/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-4 float-md-left"><?=ucwords(str_replace('_', ' ', 'status'))?></label>
							<div class="col-md-8  float-md-left">
								<input type="checkbox" class="make-switch" <?= @$this->session->flashdata('postdata')->status== 'Y' ? 'checked': '' ?>  name="status" data-on-text="&nbsp;Aktif&nbsp;" data-off-text="&nbsp;Tidak Aktif&nbsp;" data-on-color="primary" data-off-color="danger" >
							</div>
						</div>
						
						
					</div>
					<div class="col-md-6">
						<h4 class="form-section grey">
							<i class="icon-picture"></i>
							Gambar
						</h4>
						<div class="form-group">
							<div class="col-md-9 " >
								<div class="col-md-4 " >
									<div class="col-md-12">
										<div class="fileinput fileinput-new" data-provides="fileinput">
											<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"> </div>
											<div>
												<span class="btn red btn-outline btn-file">
													<span class="fileinput-new"> Select File </span>
													<span class="fileinput-exists"> Change </span>
													<input type="file" name="gambar"> </span>
												<a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
												
											</div>
											
										</div>
										
									</div>
								</div>
								
							</div>
						</div>
						
					</div>
				</div>
				<div class="form-actions right">
						<?= $this->button_simpan ?>
				</div>
				
				<!-- END FORM-->
			</div>
		</div>
		</form>
	</div>
</div>

