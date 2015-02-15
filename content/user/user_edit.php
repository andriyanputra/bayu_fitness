<?php
	@session_start();
    if($_SESSION[ID_LEVEL]==1 || $_SESSION[ID_LEVEL]==2) {
        $cek = oci_parse($koneksi, "SELECT * FROM PEGAWAI INNER JOIN JABATAN ON (PEGAWAI.ID_JABATAN = JABATAN.ID_JABATAN) INNER JOIN LEVEL_LOGIN ON (PEGAWAI.ID_LEVEL = LEVEL_LOGIN.ID_LEVEL) WHERE PEGAWAI.NIP_PEGAWAI = $_GET[id]");
        oci_execute($cek);
        $db = oci_fetch_array($cek);
        $db[DATE_AKTIF]=strtotime($db[DATE_AKTIF]); $db[DATE_NONAKTIF]=strtotime($db[DATE_NONAKTIF]);
        $array_hr= array(1=>"Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu");
        $array_bln = array(1=>"Jan","Feb","Mar", "Apr", "Mei","Jun","Jul","Agt","Sep","Okt", "Nov","Des");
        $hr = $array_hr[date('N', $db[DATE_AKTIF])]; $bln = $array_bln[date('n', $db[DATE_AKTIF])];

?>
<section class="content-header">
    <h1>
        User Management
        <small>Update Data User</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Dashboard</li>
		<li class="active">User Management</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Pembaharuan Biodata <?php echo $db['NM_PEGAWAI']; ?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="index?fold=user&page=user_save" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                Untuk melakukan pembaharuan, silahkan isi pada kolom yang disediakan.
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                  <label for="">NIP Pegawai&nbsp;<span class="text-red"><b>*</b></span>: </label>
                                      <input type="text" class="form-control" name="nip_pegawai" id="nip_pegawai" value="<?php echo $db[NIP_PEGAWAI]; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama&nbsp;<span class="text-red"><b>*</b></span>:</label>
                                    <input type="text" class="form-control" name="nm_pegawai" id="nm_pegawai" placeholder="Nama Pegawai" value="<?php echo $db[NM_PEGAWAI]; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="">No. Telp&nbsp;<span class="text-red"><b>*</b></span>:</label>
                                    <input type="text" class="form-control" name="telp_pegawai" id="telp_pegawai" pattern="\d+" title="Harus Angka" placeholder="No Telepon" value="<?php echo $db[TELP_PEGAWAI]; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Alamat&nbsp;<span class="text-red"><b>*</b></span>:</label>
                                    <textarea class="form-control" name="alamat_pegawai" id="alamat_pegawai" placeholder="Alamat" required><?php echo $db[ALAMAT_PEGAWAI]; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Jenis Kelamin&nbsp;<span class="text-red"><b>*</b></span>:</label>
                                    <div class="form_control">
                                      <label><?php if($db[JK_PEGAWAI] == 'Laki-laki'){ ?>
                                      <input type="radio" name="jk_kelamin" class="flat-blue" value="Laki-laki" checked />
                                      Laki-laki&nbsp;
                                      <input type="radio" name="jk_kelamin" class="flat-blue" value="Perempuan"/>
                                      Perempuan
                                      <?php }else{ ?>
                                      <input type="radio" name="jk_kelamin" class="flat-blue" value="Laki-laki"/>
                                      Laki-laki&nbsp;
                                      <input type="radio" name="jk_kelamin" class="flat-blue" value="Perempuan" checked />
                                      Perempuan
                                      <?php } ?>
                                      </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                  <label for="">Pertanyaan Keamanan&nbsp;<span class="text-red"><b>*</b></span>:</label>
                                  <input type="text" name="ask_pegawai" class="form-control" placeholder="Siapa nama orang tua (Laki-laki) Anda ?" required value="<?php echo $db[ASK_PEGAWAI]; ?>">
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="preview_gambar">Foto Pegawai&nbsp;<span class="text-red"><b>**</b></span>:</label>
                                    <input type="file" name="ft_pegawai_baru" id="preview_gambar" class="filestyle" data-buttonName="bg-blue">
                                </div>
                                <?php if(!empty($db[FOTO_PEGAWAI])){ ?>
                                <input type="hidden" name="ft_pegawai_lama" value="<?php echo $db[FOTO_PEGAWAI]; ?>">
                                <img src="../assets/img/pegawai/<?php echo $db[FOTO_PEGAWAI]; ?>" id="gambar_nodin" width="200" alt="" />
                                <?php }else{ ?>
                                <img src="../assets/img/pegawai/empty.gif" id="gambar_nodin" width="200" alt="" />
                                <?php } ?><br><br>
                                <div class="form-group">
                                    <label for="">Jabatan&nbsp;<span class="text-red"><b>*</b></span>:</label>
                                    <select name="jabatan" class="form-control" id="jabatan" onchange="showDiv(this)" required>
                                        <option value="">Pilih Jabatan</option>
                                        <?php $selected = $db[ID_JABATAN];
                                        $jab = oci_parse($koneksi, "SELECT * FROM JABATAN ORDER BY ID_JABATAN ASC");
                                        oci_execute($jab); while ($jbt = oci_fetch_array($jab)) {
                                        if($jbt[ID_JABATAN] == $selected){
                                            echo "<option selected=selected value=\"$jbt[ID_JABATAN]\"/>$db[NM_JABATAN]";
                                        }else{
                                            echo "<option value=\"$jbt[ID_JABATAN]\"/>$jbt[NM_JABATAN]";
                                        }
                                      } ?>
                                        <option value="tambah">Tambah Jabatan</option>
                                    </select>
                                    <br>
                                    <input type="text" name="jabatan_baru" class="form-control" style="display:none" id="jabatan_baru" placeholder="Jabatan Baru">
                                </div>
                                <div class="form-group">
                                    <label for="">Ganti Password ? Klik <a href="javascript:hideshow(document.getElementById('pass'))">Disini</a></label>
                                    <!--<input type="checkbox" name="check" class="form-control" id="show_pass" onclick="showMe('password')">-->
                                </div>
                                <div id="pass" style="display: none">
                                    <div class="form-group">
                                        <label for="">New Password&nbsp;<span class="text-red"><b>*</b></span>:</label>
                                        <input type="password" id="password" name="pass_pegawai_baru" placeholder="Password"  class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Confirm Password&nbsp;<span class="text-red"><b>*</b></span>:</label>
                                        <input type="password" id="conf_password" placeholder="Confirm Password" class="form-control" onselectstart="return false" onpaste="return false;" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off>
                                    </div>
                                </div>
                              <div class="form-group">
                                <label for="">Level User&nbsp;<span class="text-red"><b>*</b></span>:</label>
                                <select name="level" class="form-control" id="level" required>
                                    <option value="">Pilih Level</option>
                                    <?php $db_lvl = $db[ID_LEVEL];
                                    $lvl = oci_parse($koneksi, "SELECT * FROM LEVEL_LOGIN ORDER BY ID_LEVEL ASC");
                                      oci_execute($lvl); while ($lvl_ = oci_fetch_array($lvl)) {
                                        if($db_lvl == $lvl_[ID_LEVEL]){
                                            echo "<option selected=selected value=\"$lvl_[ID_LEVEL]\"/>$lvl_[NAMA_LEVEL]";
                                        }else{
                                            echo "<option value=\"$lvl_[ID_LEVEL]\"/>$lvl_[NAMA_LEVEL]";
                                        }
                                      } ?>
                                </select>
                              </div>
                              <?php if($_SESSION[ID_LEVEL] == 1){ $db_sts = $db[STATUS_PEGAWAI];?>
                              <div class="form-group">
                                <label for="">Status Pegawai&nbsp;<span class="text-red"><b>*</b></span>:</label><br>
                                <input type="hidden" name="date" value="<?php echo $db[DATE_AKTIF]; ?>">
                                <?php if($db_sts == 1){echo "Aktif";}else{echo "Tidak Aktif";} ?> tanggal: &nbsp;<?php echo $hr.", ".date('d', $db[DATE_AKTIF])." ".$bln." ".date('Y', $db[DATE_AKTIF]);?>
                                <select name="status" class="form-control" id="status" required>
                                    <option value="">Pilih Status</option>
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                              </div>
                              <?php } ?>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <span class="text-red"><b>*</b></span>&nbsp;Tidak boleh kosong.<br>
                                <span class="text-red"><b>**</b></span>&nbsp;Ukuran foto maksimal 2MB.
                            </div>
                        </div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <div class="text-right">
                            <input type="submit" name="update" class="btn btn-primary" value="Update" />
                        </div>
                    </div>
                </form>
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