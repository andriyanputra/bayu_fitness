<?php 
	@session_start(); 
	if($_SESSION[ID_LEVEL]==1){ 
?>
<section class="content-header">
    <h1>
        Grafik New Comando Gym
        <small>Overview</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Dashboard</li>
		<li class="active">Grafik</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title"><i class="fa fa-bar-chart-o"></i>&nbsp;Grafik New Comando Gym</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                          <div class="col-md-10"></div>
                          <div class="col-md-2 pull-right">
                            <!--<a href="#" data-toggle="modal" data-target="#add_member" class="btn btn-block btn-primary" data-toggle="tooltip" title="Tambah Member"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah Member</a>-->
                          </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-md-6">
                      	<div id="response" align="text-center"></div>
                      	<p align="center">Jumlah Member New Comando Gym</p>
                      	<div class="chart" id="contoh-chart1" style="height: 250px;"></div>
                      </div>
                      <div class="col-md-6">
                      	<!--<div id="res" align="text-center"></div>
                      	<p align="center">Inventaris New Comando Gym afas</p>
                      	<div class="chart" id="contoh-chart2" style="height: 250px;"></div>-->
                      </div>
                    </div>
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <div class="text-right">
                        <!--<input type="submit" name="simpan" class="btn btn-primary" value="Submit" />-->
                    </div>
                </div>
            </div><!-- /.box -->
        </div>
    </div>
</section>
<?php
	}else{
        ?>
          <script type="text/javascript">
            setTimeout(function() {
                swal({
                      title:"Oopss!",   
                      text: "Restricted Page !",   
                      type: "warning",
                      showCancelButton: false
                }, function(){
                    window.history.back();
                })
            }, 200);
          </script>
        <?php
    }
?>