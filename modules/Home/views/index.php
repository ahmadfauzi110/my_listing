<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk | Majoo Teknologi Indonesia</title>
    
    <link rel="shortcut icon" href="<?=base_url('assets/image/logo.png')?>" /> 

    
    <link rel="stylesheet" href="<?= base_url() ?>assets/Plugin/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/Plugin/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="<?= base_url() ?>assets/Css/styles.css"/>
    
    <script src="<?= base_url() ?>assets/Plugin/jquery-3.5.1.min.js"></script>
    <script src="<?= base_url() ?>assets/Plugin/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
    <div class=" container-new">
        <div class="col-md-12 header">
            <img src="<?=base_url('assets/image/logo.png')?>" class="logo"> 
            <div class="title">
                Majoo Teknologi Indonesia
            </div>
        </div>
        <div class="col-md-12 content">
                <?php
                    if(!empty($produk)){
                        foreach($produk as $key => $value){
                ?>
                        <div class="col-md-3 produk">
                            <img src="<?=base_url('assets/upload/produk/'. $value->gambar)?>" alt="" class=""/>
                            <?= $value->nama_produk?>
                            <div class="harga">
                                <?= toRupiah($value->harga) ?>
                            </div>
                            <div class="deskripsi">
                                <?= $value->deskripsi ?>
                            </div>
                            <div class="action">
                                <button type="button" class="btn btn-primary beli" data-id_produk="<?= $value->id_produk ?>" data-nama_produk="<?= $value->nama_produk ?>">Beli</button>
                            </div>
                        </div>

                <?php
                        }
                    }
                ?>
        </div>
        <div class="col-md-12 footer">
            2020 &copy; PT. Majoo Teknologi Indonesia
        </div>
    </div>
    <div class="modal fade bs-modal-md modal_beli" id="modal_beli" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
            <div class="modal-header">
                
                
                
                <div class="form-body col-md-12">
                    <div class="form-group col-md-12"><h5>KONFIRMASI PEMBELIAN</h5></div> 
                    <input type="hidden" class="id_produk" />
                    <h6><div class="form-group col-md-12 nama_produk"></div> </h6>
                    <div class="form-group col-md-12">
                        <label class="control-label col-md-4 float-md-left"><?=ucwords(str_replace('_', ' ', 'nama_pelanggan'))?></label>
                        
                        <div class="col-md-8 float-md-left">
                            <input class="form-control elipsis nama_pelanggan" type="text" name="nama_pelanggan" placeholder="<?=ucwords(str_replace('_', ' ', 'nama_pelanggan'))?>" value="" required/>
                        </div>
                        
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label col-md-4 float-md-left"><?=ucwords(str_replace('_', ' ', 'no_hp'))?></label>
                        <div class="col-md-8 float-md-left">
                            <input class="form-control elipsis no_hp" type="text" name="no_hp" placeholder="<?=ucwords(str_replace('_', ' ', 'no_hp'))?>" value="" required/>
                        </div>
                        
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label col-md-4 float-md-left"><?=ucwords(str_replace('_', ' ', 'alamat'))?></label>
                        <div class="col-md-8 float-md-left">
                            <input class="form-control elipsis alamat" type="text" name="alamat" placeholder="<?=ucwords(str_replace('_', ' ', 'alamat'))?>" value="" required/>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <div class="col-md-12 float-md-left">
                            <button class="btn btn-success konfirmasi_beli">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-red" data-dismiss="modal">Batal</button>
            </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</body>
</html>

<script>
    $(function(){

        $('body').on('click', '.beli' ,function(){
            var id_produk = $(this).data('id_produk');
            var nama_produk = $(this).data('nama_produk');
            $('.id_produk').val(id_produk);
            $('.nama_produk').text(nama_produk);
            $('.modal_beli').modal()
        })

        $('.konfirmasi_beli').click(function(){
            var input = $('input');

            is_valid = true;

            $.each(input, function(index, value){
                console.log($(value).val())
                if($(value).val() == '' || $(value).val() == null){
                    is_valid= false;
                }
            })

            if(is_valid){
                $.post('<?= base_url($this->cname.'/do_beli') ?>', {
                    id_produk : $('.id_produk').val(),
                    nama_pelanggan : $('.nama_pelanggan').val(),
                    no_hp : $('.no_hp').val(),
                    alamat : $('.alamat').val(),
                }, function(response){
                    if(response.status =='sukses'){
                        alert('Pembelian berhasil');
                        $('input').val('');
                        $('.modal_beli').modal('hide')
                    }else{
                        alert(response.msg);
                    }
                },'json')
            }else{
                alert('Silahkan Isi Semua Data');
            }
        })
    })
</script>