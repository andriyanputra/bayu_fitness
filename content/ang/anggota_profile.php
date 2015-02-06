<?php
	@session_start();
    if($_SESSION[ID_LEVEL]==1 || $_SESSION[ID_LEVEL]==2 || $_SESSION[ID_LEVEL]==3) {
        $cek = oci_parse($koneksi, "SELECT ID_MEMBER,NM_MEMBER, ALAMAT_MEMBER, TELP_MEMBER, JK_KELAMIN, FOTO_MEMBER, PERPANJANG, AKTIF_MEMBER, NONAKTIF_MEMBER,
														Months_between(NONAKTIF_MEMBER, PERPANJANG) BULAN, ASK_MEMBER,
														NONAKTIF_MEMBER - AKTIF_MEMBER as sel, NONAKTIF_MEMBER - PERPANJANG AS beda,
														nonaktif_member-current_date as selisih,
														FOTO_MEMBER FROM MEMBER, LEVEL_LOGIN, dual where MEMBER.ID_LEVEL = LEVEL_LOGIN.ID_LEVEL AND MEMBER.ID_MEMBER = '$_GET[id]'");
        oci_execute($cek);
        $db = oci_fetch_array($cek);
        $db[AKTIF_MEMBER]=strtotime($db[AKTIF_MEMBER]); $db[NONAKTIF_MEMBER]=strtotime($db[NONAKTIF_MEMBER]);
        /* script menentukan hari */
        $array_hr= array(1=>"Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu");
        $array_bln = array(1=>"Jan","Feb","Mar", "Apr", "Mei","Jun","Jul","Agt","Sep","Okt", "Nov","Des");
        $hr_a = $array_hr[date('N', $db[AKTIF_MEMBER])];$bln_a = $array_bln[date('n', $db[AKTIF_MEMBER])];
        $hr_n = $array_hr[date('N', $db[NONAKTIF_MEMBER])];$bln_n = $array_bln[date('n', $db[NONAKTIF_MEMBER])];
?>
<section class="content-header">
    <h1>
        Daftar Member
        <small>Profile Member</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Dashboard</li>
        <li class="active">Data Member</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Data Member <?php echo $db['NM_MEMBER']; ?></h3>
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
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label for="">ID Member : </label>
                                <label class="form-control" id="id_member"><?php echo $db[ID_MEMBER]; ?></label>
                            </div>
                            <div class="form-group">
                                <label for="">Nama Lengkap:</label>
                                <label class="form-control" id="nm_member"><?php echo $db[NM_MEMBER]; ?></label>
                            </div>
                            <div class="form-group">
                                <label for="">No. Telp:</label>
                                <label class="form-control" id="telp_member"><?php echo $db[TELP_MEMBER]; ?></label>
                            </div>
                            <div class="form-group">
                                <label for="">Alamat:</label>
                                <textarea class="form-control" id="alamat_member" readonly required><?php echo $db[ALAMAT_MEMBER]; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Jenis Kelamin&nbsp;<span class="text-red"><b>*</b></span>:</label>
                                <?php if($db[JK_KELAMIN] == 'Laki-laki'){ ?>
                                <label class="form-control">Laki-laki</label>
                                <?php }else{ ?>
                                <label class="form-control">Perempuan</label>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label for="">Member Sejak: </label>
                                <label class="form-control" ><?php echo $hr_a.", ".date('d', $db[AKTIF_MEMBER])." ".$bln_a." ".date('Y', $db[AKTIF_MEMBER]); ?></label>
                            </div>
                            <div class="form-group">
                                <label for="">Tanggal Habis: </label>
                                <label class="form-control"><?php echo $hr_n.", ".date('d', $db[NONAKTIF_MEMBER])." ".$bln_n." ".date('Y', $db[NONAKTIF_MEMBER]); ?></label>
                            </div>
                            <div class="form-group">
                                <label for="">Masa Aktif:</label><?php $selisih = $db[SELISIH]; if($selisih>31){ $selisih_ = $selisih-1;?>
                                <?php if((round($selisih_) <= 4) && (round($selisih_) > 0)){ ?>
                                <label class="form-control text-yellow"><?php echo 'Kurang '.round($selisih_).' hari.'; ?></label>
                                <?php }else if((round($selisih_) <= 0) && round($selisih_) >= -7){ ?>
                                <script type="text/javascript">
                                  setTimeout(function() {
                                    swal("Important!", "Member lewat masa tenggang. Segera lakukan tindakan administratif !", "warning")
                                  }, 200);
                                </script>
                                <label class="form-control text-red"><?php echo 'Lewat '.abs(round($selisih_)).' hari.'; ?></label>
                                <?php }else{ ?>
                                <label class="form-control text-green"><?php echo 'Kurang '.abs(round($selisih_)).' hari.'; ?></label>
                                <?php } } else{ ?>
                                <?php if((round($selisih) <= 4) && (round($selisih) > 0)){ ?>
                                <label class="form-control text-yellow"><?php echo 'Kurang '.round($selisih).' hari.'; ?></label>
                                <?php }else if((round($selisih) <= 0) && round($selisih) >= -7){ ?>
                                <script type="text/javascript">
                                  setTimeout(function() {
                                    swal("Important!", "Member lewat masa tenggang. Segera lakukan tindakan administratif !", "warning")
                                  }, 200);
                                </script>
                                <label class="form-control text-red"><?php echo 'Lewat '.abs(round($selisih)).' hari.'; ?></label>
                                <?php }else{ ?>
                                <label class="form-control text-green"><?php echo 'Kurang '.abs(round($selisih)).' hari.'; ?></label>
                                <?php } } ?>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label for="preview_gambar">Foto Member:</label>
                                <?php if(!empty($db[FOTO_MEMBER])){ ?>
                                <img src="../assets/img/member/<?php echo $db[FOTO_MEMBER]; ?>" width="200" alt="" />
                                <?php }else{ ?>
                                <img src="../assets/img/pegawai/empty.gif" width="200" alt="" />
                                <?php } ?>
                            </div><br><br>
                            <div class="form-group">
                                <label for="">Level User:</label>
                                <label class="form-control">Member</label>
                            </div>
                            <label for="">QR Code:</label><br>
                            <img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $db[ID_MEMBER];?>&choe=UTF-8" title="<?php echo $db[ID_MEMBER];?>" />
                        </div>
                    </div>
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <div class="text-left">
                        <button class="btn btn-primary" onclick="window.history.back();" data-toggle="tooltip" title="Kembali">Kembali</button>
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
