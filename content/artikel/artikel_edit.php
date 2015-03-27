<?php
	@session_start();
    if($_SESSION[ID_LEVEL]==1 || $_SESSION[ID_LEVEL]==2) {
        $select = oci_parse($koneksi, "SELECT ID_ARTIKEL, JD_ARTIKEL, URL, NM_VIDEO, TO_CHAR(DATE_POSTING, 'MM/DD/YYYY') as tanggal, TO_CHAR(DATE_POSTING, 'HH:MI AM') as jam FROM ARTIKEL WHERE ID_ARTIKEL = '$_GET[id]'");
        oci_execute($select);
        $db = oci_fetch_array($select);
        $array_hr = array(1 => "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu");
        $array_bln = array(1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
        $db[TANGGAL] = strtotime($db[TANGGAL]);
        $hr = $array_hr[date('N', $db[TANGGAL])];$bln = $array_bln[date('n', $db[TANGGAL])];
?>
<section class="content-header">
    <h1>
        Edit Artikel
        <small>Overview</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Dashboard</li>
		<li class="active">Artikel</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title"><i class="fa fa-file-o"></i>&nbsp;Edit Artikel dan Video</h3>
                </div><!-- /.box-header -->
                
                <form action="index?fold=artikel&page=artikel_save" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                Berikut ini adalah halaman penambahan artikel dan video kesehatan <b>Sistem Informasi New Comando Fitness Center</b>.
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                              <div class="col-md-10"></div>
                              <div class="col-md-2 pull-right">
                                <a href="index?fold=artikel&page=artikel_daftar" class="btn btn-block btn-primary" data-toggle="tooltip" title="Daftar Artikel"><i class="fa fa-archive"></i>&nbsp;&nbsp;Daftar Artikel</a>
                              </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">ID Artikel:</label>
                                        <input class="form-control" name="id" value="<?php echo $db[ID_ARTIKEL]; ?>" readonly />
                                    </div> 
                                </div>
                                <div class="col-md-8"></div>
                            </div>
                            <div class="col-md-12">                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Judul Artikel:</label>
                                        <input class="form-control" name="judul" placeholder="Judul Artikel" value="<?php echo $db[JD_ARTIKEL]; ?>" />
                                    </div>    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="pull-left">Tanggal Posting: </label>
                                        <input class="form-control" value="<?php echo $hr.', '.date('d', $db[TANGGAL]).' '.$bln.' '.date('Y', $db[TANGGAL]).' '.$db[JAM]; ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Url Artikel atau Url Video:</label>
                                        <input id="url" class="form-control" name="artikel" placeholder="http://..." value="<?php echo $db[URL]; ?>" />
                                        <div class="urlive-container"> 
                                            <span class="loading">Loading...</span>
                                        </div>
                                    </div>    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Upload Video&nbsp;<span class="text-red"><b>**</b></span>:</label>
                                        <input type="file" name="vid_artikel" class="filestyle" data-buttonName="bg-blue" />
                                        <input type="hidden" name="vid_artikel_lama" value="<?php echo $db[NM_VIDEO]; ?>"/>
                                        <input name="MAX_FILE_SIZE" value="50000000" type="hidden"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--<div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="form-group">
                                    <label>Tulis Artikel: </label>
                                    <textarea class="form-control wysihtml5" name="tul_artikel" rows="10" placeholder="Silahkan menulikan artikel Anda di sini..."><?php //echo $db[CONTENT]; ?></textarea>
                                </div>
                            </div>
                        </div>-->
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">Note: &nbsp;<span class="text-red"><b>**</b></span></label><br>
                                <ol>
                                    <li>Format Video yang diperbolehkan .mp4, .3gp, .mkv, .flv</li>
                                    <li>Ukuran video maksimal 50MB.</li>
                                </ol> 
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