<?php
	@session_start();
    if($_SESSION[ID_LEVEL]==1 || $_SESSION[ID_LEVEL]==2) {
?>
<section class="content-header">
    <h1>
        Artikel
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
                                        <input type="file" name="vid_artikel" id="preview_gambar" class="filestyle" data-buttonName="bg-blue">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="form-group">
                                    <label>Tulis Artikel: </label>
                                    <textarea class="form-control wysihtml5" name="tul_artikel" rows="15" placeholder="Silahkan menulikan artikel Anda di sini..."></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">Note:</label><br>
                                <span class="text-red"><b>**</b></span>&nbsp;Ukuran video maksimal 100MB.
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

        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title"><i class="fa fa-file-o"></i>&nbsp;Daftar Artikel dan Video</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            Daftar artikel dan video kesehatan <b>Sistem Informasi New Comando Fitness Center</b>.
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>ID Member</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>Tgl Daftar</th>
                                        <th>Tgl Habis</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!-- /.box-body -->
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