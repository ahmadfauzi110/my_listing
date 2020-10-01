<div class="row dashboard" >
    <div class="col-md-12">
        <div class="col-md-4 float-md-left  ">
            <div class="card col-md-12">
                <div class="card-content pb-1">
                
                    <div class="clearfix">
                        <i class="fa fa-list bg-grey bg-lighten-2 round font-large-1 blue float-left mt-1"></i>
                        <span class="font-large-2 text-bold-300 info float-right total_produk">0</span>
                    </div>
                    
                    <a href="#">
                        <div class="clearfix border-top-blue-grey bg-grey bg-lighten-5 border-top-lighten-3 elipsis" style="padding : 10px">
                            <span class="font-medium-1 blue">TOTAL PRODUK</span>
                            <i class="icon-arrow-right font-medium-1 blue-grey float-right"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4 float-md-left  ">
            <div class="card col-md-12">
                <div class="card-content pb-1">
                    <div class="clearfix">
                        <i class="icon-calendar bg-grey bg-lighten-2 round  font-large-1 warning float-left mt-1"></i>
                        <span class="font-large-2 text-bold-300 warning float-right penjualan_hari_ini">0</span>
                    </div>
                    
                    <a href="#">
                        <div class="clearfix border-top-blue-grey bg-grey bg-lighten-5 border-top-lighten-3 elipsis" style="padding : 10px">
                            <span class="font-medium-1 warning ">PENJUALAN HARI INI</span>
                            <i class="icon-arrow-right font-medium-1 blue-grey float-right"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 float-md-left  ">
            <div class="card col-md-12">
                <div class="card-content pb-1">
                    <div class="clearfix">
                        <i class="icon-pie-chart bg-grey bg-lighten-2 round font-large-1 purple float-left mt-1"></i>
                        <span class="font-large-2 text-bold-300 purple float-right total_penjualan">0</span>
                    </div>
                    <a href="#">
                        <div class="clearfix border-top-blue-grey bg-grey bg-lighten-5 border-top-lighten-3 elipsis" style="padding : 10px">
                            
                                <span class="font-medium-1 purple ">TOTAL PENJUALAN</span>
                                <i class="icon-arrow-right font-medium-2 blue-grey float-right"></i>
                            
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function(){
        function get_statistik(){
            $.get('<?= base_url($this->cname.'/get_statistik')?>', function(response){
                data = response.data

                $('.total_produk').text(data.total_produk);
                $('.penjualan_hari_ini').text(data.penjualan_hari_ini);
                $('.total_penjualan').text(data.total_penjualan);
            },'json')
        }

        get_statistik();

        setInterval(() => {
            
            get_statistik();
        }, 15000);
    })
</script>