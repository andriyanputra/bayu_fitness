<?php
	@session_start();
    $array_hr= array(1=>"Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu");
    $array_bln = array(1=>"Januari","Februari","Maret", "April", "Mei","Juni","Juli","Agustus","Septemper","Oktober", "November","Desember");
    $hr = $array_hr[date('N')];$bln = $array_bln[date('n')];
    if($_SESSION[ID_LEVEL]==1 || $_SESSION[ID_LEVEL]==2) {
?>
<section class="content-header">
    <h1>
        Tambah Artikel
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
                  <h3 class="box-title"><i class="fa fa-file-o"></i>&nbsp;Tambah Artikel dan Video</h3>
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
                                    <?php
                                        $hitung = oci_parse($koneksi, "SELECT COUNT(*) FROM ARTIKEL"); oci_execute($hitung);
                                        $count = oci_fetch_array($hitung); $cek_ = oci_parse($koneksi, "SELECT ID_ARTIKEL FROM ARTIKEL");
                                        oci_execute($cek_);
                                        if($count[0] != 0){
                                            $no = 0;
                                                while($db = oci_fetch_array($cek_)){
                                                    $no++; $id_ = $db['ID_ARTIKEL']; $id_sub = substr($id_, 1, -4);
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
                                        <label for="">ID Artikel:</label>
                                        <input class="form-control" name="id" value="<?php echo '0'.$id.'-NCF'; ?>" readonly />
                                    </div> 
                                </div>
                                <div class="col-md-8"></div>
                            </div>
                            <div class="col-md-12">                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Judul Artikel:</label>
                                        <input class="form-control" name="judul" placeholder="Judul Artikel" />
                                    </div>    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="pull-left">Tanggal Posting: </label>
                                        <input class="form-control" value="<?php echo $hr.', '.date('d').' '.$bln.' '.date('Y').'  '.date('h:i:s A'); ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Url Artikel atau Url Video:</label>
                                        <input id="url" class="form-control" name="artikel" placeholder="http://..." />
                                        <div class="urlive-container"> 
                                            <span class="loading">Loading...</span>
                                        </div>
                                    </div>    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Upload Video&nbsp;<span class="text-red"><b>**</b></span>:</label>
                                        <input type="file" name="vid_artikel" class="filestyle" data-buttonName="bg-blue">
                                        <input name="MAX_FILE_SIZE" value="50000000" type="hidden"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="form-group">
                                    <label>Tulis Artikel: </label>
                                    <textarea class="form-control wysihtml5" name="tul_artikel" rows="10" placeholder="Silahkan menulikan artikel Anda di sini..."></textarea>
                                </div>
                            </div>
                        </div>
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