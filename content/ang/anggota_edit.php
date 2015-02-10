<?php
@session_start();
if ($_SESSION[ID_LEVEL] == 1 || $_SESSION[ID_LEVEL] == 3) {
    $cek = oci_parse($koneksi, "SELECT ID_MEMBER, PERPANJANG, Months_between(NONAKTIF_MEMBER, PERPANJANG) BULAN, TELP_MEMBER, JK_KELAMIN, FOTO_MEMBER,
				NM_MEMBER, ALAMAT_MEMBER, NONAKTIF_MEMBER - AKTIF_MEMBER as sel, NONAKTIF_MEMBER - PERPANJANG AS beda,
				AKTIF_MEMBER, NONAKTIF_MEMBER, nonaktif_member-current_date as selisih, ASK_MEMBER,
				FOTO_MEMBER FROM MEMBER, LEVEL_LOGIN, dual where MEMBER.ID_LEVEL = LEVEL_LOGIN.ID_LEVEL AND MEMBER.ID_MEMBER = '$_GET[id]'");
    oci_execute($cek);
    $db = oci_fetch_array($cek);
    $db[AKTIF_MEMBER] = strtotime($db[AKTIF_MEMBER]);
    $db[NONAKTIF_MEMBER] = strtotime($db[NONAKTIF_MEMBER]);
    $db[PERPANJANG] = strtotime($db[PERPANJANG]);
    /* script menentukan hari */
    $array_hr = array(1 => "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu");
    $array_bln = array(1 => "Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agt", "Sep", "Okt", "Nov", "Des");
    $hr_a = $array_hr[date('N', $db[AKTIF_MEMBER])];
    $bln_a = $array_bln[date('n', $db[AKTIF_MEMBER])];
    $hr_n = $array_hr[date('N', $db[NONAKTIF_MEMBER])];
    $bln_n = $array_bln[date('n', $db[NONAKTIF_MEMBER])];
    $hr_p =$array_hr[date('N', $db[PERPANJANG])];
    $bln_p =$array_bln[date('n', $db[PERPANJANG])];
    ?>
    <section class="content-header">
        <h1>
            Daftar Member
            <small>Update Data Member</small>
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
                        <h3 class="box-title">Pembaharuan Data Member <?php echo $db['NM_MEMBER']; ?></h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="index?fold=ang&page=anggota_save" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    Untuk melakukan pembaharuan, silahkan isi pada kolom yang disediakan.
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="">ID Member : </label>
                                        <input type="text" class="form-control" name="id_member" id="id_member" readonly value="<?php echo $db[ID_MEMBER]; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Nama Lengkap&nbsp;<span class="text-red"><b>*</b></span>:</label>
                                        <input type="text" class="form-control" name="nm_member" id="nm_member" placeholder="Nama Lengkap" required value="<?php echo $db[NM_MEMBER]; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="">No. Telp&nbsp;<span class="text-red"><b>*</b></span>:</label>
                                        <input type="text" class="form-control" name="telp_member" id="telp_member" pattern="\d+" title="Harus Angka" placeholder="No Telepon" required value="<?php echo $db[TELP_MEMBER]; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Alamat&nbsp;<span class="text-red"><b>*</b></span>:</label>
                                        <textarea class="form-control" name="alamat_member" id="alamat_member" placeholder="Alamat" required><?php echo $db[ALAMAT_MEMBER]; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Jenis Kelamin&nbsp;<span class="text-red"><b>*</b></span>:</label>
                                        <div class="form_control">
                                            <label><?php if ($db[JK_KELAMIN] == 'Laki-laki') { ?>
                                                    <input type="radio" name="jk_kelamin" class="flat-blue" value="Laki-laki" checked />
                                                    Laki-laki&nbsp;
                                                    <input type="radio" name="jk_kelamin" class="flat-blue" value="Perempuan"/>
                                                    Perempuan
                                                    <?php } else { ?>
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
                                        <input type="text" name="ask_member" class="form-control" placeholder="Siapa nama orang tua (Laki-laki) Anda ?" required value="<?php echo $db[ASK_MEMBER]; ?>">
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="">Member Sejak: </label>
                                        <input class="form-control" type="text" readonly value="<?php echo $hr_a . ", " . date('d', $db[AKTIF_MEMBER]) . " " . $bln_a . " " . date('Y', $db[AKTIF_MEMBER]); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Tanggal Memperpanjang: </label><?php if ($db[PERPANJANG] == '') {
                                            $perpanjang = '-';
                                        } else {
                                            $perpanjang = $hr_p . ", " . date('d', $db[PERPANJANG]) . " " . $bln_p . " " . date('Y', $db[PERPANJANG]);;
                                        } ?>
                                        <input class="form-control" type="text" readonly value="<?php echo $perpanjang; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Tanggal Habis: </label>
                                        <input class="form-control" type="text" readonly value="<?php echo $hr_n . ", " . date('d', $db[NONAKTIF_MEMBER]) . " " . $bln_n . " " . date('Y', $db[NONAKTIF_MEMBER]); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Masa Aktif:</label><?php $selisih = $db[SELISIH];
                                            if ($selisih > 31) {
                                                $selisih_ = $selisih - 1; ?>
                                            <?php if ((round($selisih_) <= 4) && (round($selisih_) > 0)) { ?>
                                                <label class="form-control text-yellow"><?php echo 'Kurang ' . round($selisih_) . ' hari.'; ?></label>
                                            <?php } else if ((round($selisih_) <= 0) && round($selisih_) >= -7) { ?>
                                                <script type="text/javascript">
                                                    setTimeout(function () {
                                                        swal("Important!", "Member lewat masa tenggang. Segera lakukan tindakan administratif !", "warning")
                                                    }, 200);
                                                </script>
                                                <label class="form-control text-red"><?php echo 'Lewat ' . abs(round($selisih_)) . ' hari.'; ?></label>
                                                <?php } else { ?>
                                                <label class="form-control text-green"><?php echo 'Kurang ' . abs(round($selisih_)) . ' hari.'; ?></label>
                                            <?php }
                                        } else { ?>
                                            <?php if ((round($selisih) <= 4) && (round($selisih) > 0)) { ?>
                                                <label class="form-control text-yellow"><?php echo 'Kurang ' . round($selisih) . ' hari.'; ?></label>
                                        <?php } else if ((round($selisih) <= 0) && round($selisih) >= -7) { ?>
                                                <script type="text/javascript">
                                                    setTimeout(function () {
                                                        swal("Important!", "Member lewat masa tenggang. Segera lakukan tindakan administratif !", "warning")
                                                    }, 200);
                                                </script>
                                                <label class="form-control text-red"><?php echo 'Lewat ' . abs(round($selisih)) . ' hari.'; ?></label>
                                                <?php } else { ?>
                                                <label class="form-control text-green"><?php echo 'Kurang ' . abs(round($selisih)) . ' hari.'; ?></label>
                                                <?php }
                                            } ?>
                                    </div>
                                    <?php if ($_SESSION[ID_LEVEL] == 1) {
                                        if ((round($selisih) > 8 || round($selisih_) > 8)) {
                                            ?>
                                            <div class="form-group">
                                                <label for="">Perpanjang Masa Aktif:</label>
                                                <select class="form-control" name="perpanjang" disabled>
                                                    <option value="">Pilih Lama</option>
                                                    <?php $i = 0;
                                                    while ($i < 12) {
                                                        $i++; ?>
                                                        <option value="<?php echo $i ?>"><?php echo $i . " bulan" ?></option>
                                            <?php } ?>
                                                </select>
                                            </div>
                                            <?php } else if ((round($selisih) <= 0 || round($selisih_) >= -7)) { ?>
                                            <div class="form-group">
                                                <label for="">Perpanjang Masa Aktif&nbsp;<span class="text-red"><b>*</b></span>:</label>
                                                <select class="form-control" name="perpanjang" required>
                                                    <option value="">Pilih Lama</option>
                                                    <?php $i = 0;
                                                    while ($i < 12) {
                                                        $i++; ?>
                                                        <option value="<?php echo $i ?>"><?php echo $i . " bulan" ?></option>
                                                        <?php } ?>
                                                </select>
                                            </div>
                                            <?php }
                                        }
                                        ?>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="preview_gambar">Foto Member&nbsp;<span class="text-red"><b>**</b></span>:</label>
                                        <input type="file" name="ft_member_baru" id="preview_gambar" class="filestyle" data-buttonName="bg-blue">
                                    </div>
                                    <?php if (!empty($db[FOTO_MEMBER])) { ?>
                                        <input type="hidden" name="ft_member_lama" value="<?php echo $db[FOTO_MEMBER]; ?>">
                                        <img src="../assets/img/member/<?php echo $db[FOTO_MEMBER]; ?>" id="gambar_nodin" width="200" alt="" />
                                        <?php } else { ?>
                                        <input type="hidden" name="ft_member_lama" value="">
                                        <img src="../assets/img/pegawai/empty.gif" id="gambar_nodin" width="200" alt="" />
                                        <?php } ?><br><br>

                                    <div class="form-group">
                                        <label for="">Ganti Password ? Klik <a href="javascript:hideshow(document.getElementById('pass'))">Disini</a></label>
                                    </div>
                                    <div id="pass" style="display: none">
                                        <div class="form-group">
                                            <label for="">New Password&nbsp;<span class="text-red"><b>*</b></span>:</label>
                                            <input type="password" id="password" name="pass_member_baru" placeholder="Password"  class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Confirm Password&nbsp;<span class="text-red"><b>*</b></span>:</label>
                                            <input type="password" id="conf_password" placeholder="Confirm Password" class="form-control" onselectstart="return false" onpaste="return false;" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Level User:</label>
                                        <input type="text" class="form-control" readonly value="Member">
                                    </div>
                                    <label for="">QR Code:</label><br>
                                    <img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $db[ID_MEMBER]; ?>&choe=UTF-8" title="<?php echo $db[ID_MEMBER]; ?>" />
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
                                <button class="btn btn-primary" onclick="window.history.back();">Kembali</button>&nbsp;&nbsp;
                                <input type="submit" name="update" class="btn btn-primary" value="Update" />
                            </div>
                        </div>
                    </form>
                </div><!-- /.box -->
            </div>
        </div>
    </section>

    <?php
} else {
    ?>
    <script type="text/javascript">
        setTimeout(function () {
            swal({
                title: "Oopss!",
                text: "Restricted Page !",
                type: "warning",
                showCancelButton: false
            }, function () {
                window.history.back();
            })
        }, 200);
    </script>
    <?php
}
?>
