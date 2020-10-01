<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
  
<!-- Mirrored from pixinvent.com/bootstrap-admin-template/robust/html/ltr/vertical-overlay-menu-template/ by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 16 Jun 2019 01:01:47 GMT -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Robust admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template.">
    <meta name="keywords" content="admin template, robust admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
    <meta name="author" content="PIXINVENT">
    <title><?=$this->info['title']?> | Majoo Teknologi Indonesia </title>
    <link rel="apple-touch-icon" href="<?= base_url() ?>assets/template_b/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?=base_url('assets/logo-icon.png')?>">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CMuli:300,400,500,700" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/template_b/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/template_b/vendors/css/charts/jquery-jvectormap-2.0.3.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/template_b/vendors/css/charts/morris.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/template_b/vendors/css/extensions/unslider.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/template_b/vendors/css/weather-icons/climacons.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url() ?>assets/template_b/vendors/css/tables/datatable/datatables.min.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url() ?>assets/template_b/fonts/simple-line-icons/style.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url() ?>assets/template_b/vendors/css/cryptocoins/cryptocoins.css" />
    <!-- <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/template_b/js/scripts/datatables/datatables.min.css" /> -->
    <!-- END VENDOR CSS-->
    <!-- BEGIN ROBUST CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/template_b/css/app.min.css">
    
    <link rel="shortcut icon" href="<?=base_url('assets/image/logo.png')?>" /> 
    <!-- END ROBUST CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/template_b/css/core/menu/menu-types/vertical-overlay-menu.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/template_b/css/core/colors/palette-gradient.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/template_b/css/plugins/calendars/clndr.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/template_b/css/plugins/forms/checkboxes-radios.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/template_b/css/plugins/animate/animate.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/template_b/css/core/colors/palette-climacon.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/template_b/css/pages/users.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/template_b/js/scripts/bootstrap-switch/css/bootstrap-switch.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/template_b/js/scripts/select2/css/select2.min.css" />
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/template_b/js/scripts/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/template_b/js/scripts/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/template_b/js/scripts/bootstrap-summernote/summernote.css"  />


    

    
    <!-- <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/template_b/vendors/js/bootstrap/css/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/template_b/js/scripts/datatables/plugins/bootstrap/datatables.bootstrap.css" /> -->
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/template_b/css/style.css">
    <!-- END Custom CSS-->

    <!-- BEGIN Head script -->
    <script src="<?=base_url()?>assets/template_b/js/jquery-2.2.4.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>assets/template_b/js/bootstrap.js" type="text/javascript"></script>
    
    <script src="<?= base_url() ?>assets/template_b/vendors/js/bootstrap/js/bootstrap.min.js"></script>

    <script>
      function imgError(image) {
        image.onerror = "";
        image.src = "<?=base_url('assets/image')?>img_not_available.png";
        return true;
      }
    </script>    
    <!-- END Head  script --> 
  </head>
  <body class="vertical-layout vertical-overlay-menu 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-overlay-menu" data-col="2-columns">

    <!-- fixed-top-->
    <?= $_header ?>

    <!-- ////////////////////////////////////////////////////////////////////////////-->

    <?= $_sidebar?>

    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body"><!-- project stats -->
            <?= $_view ?>
            
        </div>
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->

    <?php if(!empty(@$this->session->flashdata('msg'))){ ?>
      <div class="col-md-4 col-sm-12" style="position:absolute ; top : 100px ; left 25px;">
          <div class="card cardAnimation box-shadow-0" data-appear="appear" data-animation="zoomIn">
            <?= @$this->session->flashdata('msg') ?>
              
          </div>
      </div>
    <?php } ?>
    
      

    </div>
    <div class="modal fade bs-modal-sm" id="small" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <div class="col-md-12">
              <h3>Perhatian <i class="fa fa-warning"></i> 
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              </h3>
              <br/>
              <span >Menghapus data ini mungkin akan berpengaruh ke beberapa data. Apakah anda yakin akan menghapus data ini?</span>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-cyan" data-dismiss="modal">Batal</button>
            <a href="#" id="linkHapus" class="btn btn-danger">Hapus Data</a>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>

    <?= $_footer ?>

    <!-- BEGIN VENDOR JS-->
    <script src="<?= base_url() ?>assets/template_b/vendors/js/vendors.min.js"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="<?= base_url() ?>assets/template_b/vendors/js/extensions/jquery.knob.min.js"></script>
    <script src="<?= base_url() ?>assets/template_b/vendors/js/charts/raphael-min.js"></script>
    <script src="<?= base_url() ?>assets/template_b/vendors/js/charts/morris.min.js"></script>
    <script src="<?= base_url() ?>assets/template_b/vendors/js/charts/chartist.min.js"></script>
    <script src="<?= base_url() ?>assets/template_b/vendors/js/charts/chartist-plugin-tooltip.js"></script>
    <script src="<?= base_url() ?>assets/template_b/vendors/js/charts/chart.min.js"></script>
    <script src="<?= base_url() ?>assets/template_b/vendors/js/charts/jquery.sparkline.min.js"></script>
    <script src="<?= base_url() ?>assets/template_b/vendors/js/extensions/moment.min.js"></script>
    <script src="<?= base_url() ?>assets/template_b/vendors/js/extensions/underscore-min.js"></script>
    <script src="<?= base_url() ?>assets/template_b/vendors/js/extensions/clndr.min.js"></script>
    <script src="<?= base_url() ?>assets/template_b/vendors/js/extensions/unslider-min.js"></script>
    
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN ROBUST JS-->
    <script src="<?= base_url() ?>assets/template_b/js/core/app-menu.min.js"></script>
    <script src="<?= base_url() ?>assets/template_b/js/core/app.min.js"></script>
    <script src="<?= base_url() ?>assets/template_b/js/scripts/customizer.min.js"></script>
    <script src="<?= base_url() ?>assets/template_b/js/datatable.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/template_b/js/scripts/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/template_b/js/scripts/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/template_b/js/scripts/select2/js/select2.full.min.js" type="text/javascript"></script>
    
    
  
    <script src="<?=base_url()?>assets/template_b/js/scripts/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <script src="<?=base_url()?>assets/template_b/js/scripts/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="<?=base_url()?>assets/template_b/js/scripts/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
    <script src="<?=base_url()?>assets/template_b/js/scripts/bootstrap-summernote/summernote.min.js" type="text/javascript"></script>

    <script type="text/javascript" src="<?= base_url() ?>assets/template_b/vendors/js/animation/jquery.appear.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/template_b/js/scripts/animation/animation.js"></script>

    


    <!-- END ROBUST JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <!-- <script src="<?= base_url() ?>assets/template_b/js/scripts/pages/dashboard-project.min.js"></script> -->
    <!-- END PAGE LEVEL JS-->
  </body>

    <script>
      $(function(){
        
        $('.select2').select2({width: '100%'});
        $('.datePicker').datepicker({
            autoclose: true,
            format: "dd-mm-yyyy",
            immediateUpdates: true,
            todayHighlight: true
        }).datepicker();
        $('.datePickercustom').datepicker({
            autoclose: true,
            format: "dd",
            immediateUpdates: true,
            todayHighlight: true
        }).datepicker();


        $('.reload').click(function(){
          $('#tabel').DataTable().ajax.reload();
        });

        
        // $('.cardAnimation').appear();
        setTimeout(function(){
          $('.cardAnimation').addClass('show');
        },
        1000)
        
      });

      
      function hapus(uri){
          $('#linkHapus').attr('href',uri);
          $('#small').modal();
      }

      

      $('.make-switch').bootstrapSwitch();
        function reloadbutton(){
            $('.tombolEdit').each(function(){
                var id = $(this).data('id');
                // alert(id);
                encodedString = btoa(id).replace('==','').replace('=','');
                // alert(encodedString);
                var link = $(this).attr('href');
                $(this).attr('href', link+'/'+encodedString);
            });


            $('.tombolHapus').each(function(){
                var id = $(this).data('id');
                //alert(id);
                encodedString = btoa(id).replace('==','').replace('=','');
                var link = "<?=site_url($this->cname . '/hapus');?>";
                $(this).attr('onclick', "hapus('"+link+'/'+encodedString+"');");
            });
        }
    </script>


</html>