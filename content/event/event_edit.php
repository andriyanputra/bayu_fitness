<?php 
@session_start();
    if($_SESSION[ID_LEVEL]==1) { 
    	?>
	<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Dashboard</li>
        <li class="active">Event</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title"><i class="fa fa-file-o"></i>&nbsp;Edit Event</h3>
                </div><!-- /.box-header -->
                
                <form action="index?fold=event&page=event_save" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                Berikut ini adalah halaman pembaharuan event <b>New Comando Fitness Center</b>.
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                              <div class="col-md-10"></div>
                              <div class="col-md-2 pull-right">
                                <a href="index?fold=event&page=event_list" class="btn btn-block btn-primary" data-toggle="tooltip" title="Daftar Event"><i class="fa fa-archive"></i>&nbsp;&nbsp;Daftar Event</a>
                              </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <?php
                                        $hitung = oci_parse($koneksi, "SELECT * FROM EVENT WHERE ID_EVENT = '$_GET[id]'"); 
                                        oci_execute($hitung);
                                        $row = oci_fetch_array($hitung);
                                        $tgl_st = $row['TGL_MULAI']; $tgl_s = strtotime($tgl_st); $tgl_start = date('m/d/Y', $tgl_s); 
                                        $tgl_en = $row['TGL_SELESAI']; $tgl_e = strtotime($tgl_en); $tgl_end = date('m/d/Y', $tgl_e);
                                    ?>
                                    <div class="form-group">
                                        <label for="">ID Event&nbsp;<span class="text-red"><b>*</b></span>:</label>
                                        <input class="form-control" name="id" value="<?php echo $row['ID_EVENT']; ?>" readonly />
                                    </div> 
                                </div>
                                <div class="col-md-8"></div>
                            </div>
                            <div class="col-md-12">                            
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Nama Event:</label>
                                        <input class="form-control" name="nm_event" placeholder="Nama Event" value="<?php echo $row['NM_EVENT']; ?>" required/>
                                    </div>    
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Tanggal Mulai:&nbsp;<span class="text-red"><b>*</b></span></label>
			                                <div class="input-group date" data-date="" data-date-format="mm/dd/yyyy">
			                                    <input class="form-control" type="text" name="date_start" placeholder="Pilih Tanggal" value="<?php echo $tgl_start; ?>">
			                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
			                                </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
			                            <label for="">Tanggal Selesai:&nbsp;<span class="text-red"><b>*</b></span></label>
		                                <div class="input-group date" data-date="" data-date-format="mm/dd/yyyy">
		                                    <input class="form-control" type="text" name="date_end" placeholder="Pilih Tanggal" value="<?php echo $tgl_end; ?>">
		                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
		                                </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="preview_gambar">Foto &nbsp;<span class="text-red"><b>**</b></span>:</label>
	                                    <input type="file" name="ft_event" id="preview_gambar" class="form-control filestyle" data-buttonName="bg-blue">
	                                    <br>
                                        <?php if(!empty($row['FOTO_EVENT'])){ ?>
                                        <img src="../assets/img/event/<?php echo $row['FOTO_EVENT']; ?>" width="200" alt="" />
                                        <?php }else{ ?>
                                        <img src="" id="gambar_nodin" width="200" alt="" />
                                        <?php } ?>
                                    </div>
                                </div>                            
                                <div class="col-md-6">
                                	<div class="form-group">
	                                    <label for="">Deskripsi&nbsp;<span class="text-red"><b>*</b></span>:</label>
	                                    <textarea class="form-control" rows="3" name="ket_event" id="ket_beli" placeholder="Deskripsi singkat event" required><?php echo $row['KET_EVENT']; ?></textarea>
	                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <span class="text-red"><b>*</b></span>&nbsp;Tidak boleh kosong.<br>
                                <span class="text-red"><b>**</b></span>&nbsp;Ukuran foto maksimal 2MB.
                            </div>
                        </div>
                    </div>
                    </div><!-- /.box-body -->                
                    <div class="box-footer">
                        <div class="text-right">
                            <button class="btn btn-primary" onclick="window.history.back();" data-toggle="tooltip" title="Kembali">Kembali</button>
                            <input type="submit" name="update" class="btn btn-primary" value="Update" data-toggle="tooltip" title="Update"/>
                        </div>
                    </div>
                </form>
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