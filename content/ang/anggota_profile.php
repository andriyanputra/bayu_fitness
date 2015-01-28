<?php
	@session_start();
    if($_SESSION[ID_LEVEL]==1 || $_SESSION[ID_LEVEL]==2) {
        $cek = oci_parse($koneksi, "SELECT * FROM MEMBER INNER JOIN LEVEL_LOGIN ON (MEMBER.ID_LEVEL = LEVEL_LOGIN.ID_LEVEL) WHERE MEMBER.ID_MEMBER = '$_GET[id]'");
        oci_execute($cek);
        $db = oci_fetch_array($cek);
?>
<section class="content-header">
    <h1>
        Daftar Member
        <small>Profile Member</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Dashboard</li>
		<li class="active">Daftar Member</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Biodata <?php echo $db['NM_MEMBER']; ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-10"></div>
                                <div class="col-md-2 pull-right">
                                    <a href="index?fold=ang&page=anggota_edit&id=<?php echo $db[ID_MEMBER]; ?>" class="btn btn-block btn-primary" data-toggle="tooltip" title="Edit Data"><i class="fa fa-edit"></i>&nbsp;&nbsp;Edit Data</a>
                                </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="">ID Member : </label>
                                <label class="form-control"><?php echo $db[ID_MEMBER]; ?></label>
                            </div>
                            <div class="form-group">
                                <label for="">Nama : </label>
                                <label class="form-control"><?php echo $db[NM_MEMBER]; ?></label>
                            </div>
                            <div class="form-group">
                                <label for="">No. Telp : </label>
                                <label class="form-control"><?php echo $db[TELP_MEMBER]; ?></label>
                            </div>
                            <div class="form-group">
                                <label for="">Alamat : </label>
                                <label class="form-control"><?php echo $db[ALAMAT_MEMBER]; ?></label>
                            </div>
                            <div class="form-group">
                                <label for="">Jenis Kelamin : </label>
                                <label class="form-control"><?php echo $db[JK_KELAMIN]; ?></label>
                            </div>
                            <div class="form-group">
                                <label for="">Jabatan : </label>
                                
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <?php if(!empty($db[FOTO_MEMBER])){ ?>
                            <input type="hidden" name="ft_member_lama" value="<?php echo $db[FOTO_MEMBER]; ?>">
                            <img src="../assets/img/member/<?php echo $db[FOTO_MEMBER]; ?>" id="gambar_nodin" width="200" alt="" />
                            <!--<img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?php //echo $db[ID_MEMBER];?>&choe=UTF-8" title="<?php //echo $db[ID_MEMBER];?>" />-->
                            <?php }else{ ?>
                            <img src="../assets/img/pegawai/empty.gif" id="gambar_nodin" width="200" alt="" />
                            <?php } ?>
                            <br><br>
                          <div class="form-group">
                            <label for="">Level User : </label>
                            <label class="form-control"><?php echo $db[NAMA_LEVEL]; ?></label>
                          </div>
                          <?php if($_SESSION[ID_LEVEL] == 1 || $_SESSION[ID_LEVEL] == 2){ $db_sts = $db[STATUS_PEGAWAI];?>
                          <div class="form-group">
                            <label for="">Status Pegawai : </label><br>
                            <?php if($db_sts == 1){echo "Aktif";}else{echo "Tidak Aktif";} ?> tanggal: &nbsp;<?php echo $db[DATE_AKTIF]?>
                          </div>
                          <?php } ?>
                        </div>
                    </div>
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <div class="text-right">
                        <button class="btn btn-primary" onclick="window.history.back();">Kembali</button>
                    </div>
                </div>
            </div><!-- /.box -->
        </div>
    </div>
</section>
<?php }else{ ?>
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
<?php } ?>