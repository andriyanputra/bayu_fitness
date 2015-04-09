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
                  <h3 class="box-title"><i class="fa fa-file-o"></i>&nbsp;Tambah Event</h3>
                </div><!-- /.box-header -->
                
                <form action="index?fold=event&page=event_save" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                Berikut ini adalah halaman penambahan event <b>New Comando Fitness Center</b>.
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
                                        $hitung = oci_parse($koneksi, "SELECT COUNT(*) FROM EVENT"); oci_execute($hitung);
                                        $count = oci_fetch_array($hitung); $cek_ = oci_parse($koneksi, "SELECT ID_EVENT FROM EVENT");
                                        oci_execute($cek_);
                                        if($count[0] != 0){
                                            $no = 0;
                                                while($db = oci_fetch_array($cek_)){
                                                    $no++; $id_ = $db['ID_EVENT']; $id_sub = substr($id_, 1, -10);
                                                    if($id_sub != $no){
                                                      $id = $no;
                                                    }else{
                                                      $id = $id_sub + 1;
                                                    }
                                                }
                                        }else{
                                          $id = $count[0]+1;
                                        }
                                    ?>
                                    <div class="form-group">
                                        <label for="">ID Event&nbsp;<span class="text-red"><b>*</b></span>:</label>
                                        <input class="form-control" name="id" value="<?php echo '0'.$id.'-NCF-Event'; ?>" readonly />
                                    </div> 
                                </div>
                                <div class="col-md-8"></div>
                            </div>
                            <div class="col-md-12">                            
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Nama Event:</label>
                                        <input class="form-control" name="nm_event" placeholder="Nama Event" required/>
                                    </div>    
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Tanggal Mulai:&nbsp;<span class="text-red"><b>*</b></span></label>
			                                <div class="input-group date" data-date="" data-date-format="mm/dd/yyyy">
			                                    <input class="form-control" type="text" name="date_start" placeholder="Pilih Tanggal" value="" required>
			                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
			                                </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
			                            <label for="">Tanggal Selesai:&nbsp;<span class="text-red"><b>*</b></span></label>
		                                <div class="input-group date" data-date="" data-date-format="mm/dd/yyyy">
		                                    <input class="form-control" type="text" name="date_end" placeholder="Pilih Tanggal" value="" required>
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
	                                    <input type="file" name="ft_event" id="preview_gambar" class="form-control filestyle" data-buttonName="bg-blue" required>
	                                    <br><img src="" id="gambar_nodin" width="200" alt="" />
                                    </div>
                                </div>                            
                                <div class="col-md-6">
                                	<div class="form-group">
	                                    <label for="">Deskripsi&nbsp;<span class="text-red"><b>*</b></span>:</label>
	                                    <textarea class="form-control" rows="3" name="ket_event" id="ket_beli" placeholder="Deskripsi singkat event" required></textarea>
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
                            <input type="submit" name="simpan" class="btn btn-primary" value="Simpan" data-toggle="tooltip" title="Simpan"/>
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