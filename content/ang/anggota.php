<?php
	@session_start();
    if($_SESSION[ID_LEVEL]==1) {
?>
<section class="content-header">
    <h1>
        Daftar Member
        <small>Overview</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Dashboard</li>
		<li class="active">Data Member</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title"><i class="fa fa-users"></i>&nbsp;Daftar Member</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            Berikut ini adalah daftar member <b>New Comando Fitness Center</b>.
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                          <div class="col-md-10"></div>
                          <div class="col-md-2 pull-right">
                            <a href="#" data-toggle="modal" data-target="#add_member" class="btn btn-block btn-primary" data-toggle="tooltip" title="Tambah Member"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah Member</a>
                          </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-md-12">
                          <table id="anggota" class="table table-bordered table-striped">
                              <thead>
                                  <tr>
                                      <th>No.</th>
                                      <th>ID Member</th>
                                      <th>Nama</th>
                                      <th>Alamat</th>
                                      <th>Tgl Daftar</th>
                                      <th>Tgl Habis</th>
                                      <th>Masa Aktif</th>
                                      <th>Foto</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                              <?php
                                /* script menentukan hari */
                                $array_hr= array(1=>"Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu");
                                $array_bln = array(1=>"Jan","Feb","Mar", "Apr", "Mei","Jun","Jul","Agt","Sep","Okt", "Nov","Des");

                                $select = oci_parse($koneksi, "SELECT ID_MEMBER, PERPANJANG, Months_between(NONAKTIF_MEMBER, PERPANJANG) BULAN,
																 										NM_MEMBER, ALAMAT_MEMBER, NONAKTIF_MEMBER - AKTIF_MEMBER as sel, NONAKTIF_MEMBER - PERPANJANG AS beda,
																										AKTIF_MEMBER, NONAKTIF_MEMBER, nonaktif_member-current_date as selisih,
																										FOTO_MEMBER FROM MEMBER, LEVEL_LOGIN, dual where MEMBER.ID_LEVEL = LEVEL_LOGIN.ID_LEVEL");
                                oci_execute($select); $bulan = date('m');
                                $no = 0;
                                while ($data=oci_fetch_array($select)) {
                                	$no++;
                                  $aktif=strtotime($data[AKTIF_MEMBER]); $nonaktif=strtotime($data[NONAKTIF_MEMBER]); $perpanjang=strtotime($data[PERPANJANG]);
                                  $hr = $array_hr[date('N', $aktif)];$bln = $array_bln[date('n', $aktif)];
                                  $h = $array_hr[date('N', $nonaktif)];$b = $array_bln[date('n', $nonaktif)];
                                ?>
                                    <tr>
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo $data[ID_MEMBER]; ?></td>
                                        <td><?php echo $data[NM_MEMBER]; ?></td>
                                        <td><?php echo $data[ALAMAT_MEMBER]; ?></td>
                                        <td><?php echo $hr.", ".date('d', $aktif)." ".$bln." ".date('Y', $aktif); ?></td>
                                        <td><?php echo $h.", ".date('d', $nonaktif)." ".$b." ".date('Y', $nonaktif); ?></td>
																				<?php
																				if(!empty($data[PERPANJANG]) && round($data[BULAN]) != 1){ $selisih = $data[BULAN];
																					echo "<td class='text-green'><b>Kurang ".round($selisih)." bulan.</b></td>";
																				}else if((empty($data[PERPANJANG]) || round($data[BULAN]) == 1)){ $selisih = $data[SELISIH];
                                         if($bulan == date('m', $nonaktif) || $bulan == date('m', $aktif) || $bulan == date('m', $perpanjang)){
																					if($selisih>31){ $selisih_ = $selisih-1;
																						if((round($selisih_) <= 4) && (round($selisih_) > 0)){
                                              echo "<td class='text-yellow'><b>Kurang ".round($selisih_)." hari.</b></td>";
                                            }else if((round($selisih_) <= 0) && round($selisih_) > -7){ ?>
                                              <script type="text/javascript">
                                                setTimeout(function() {
                                                  swal("Important!", "Salah satu/beberapa member lewat masa tenggang. Segera lakukan tindakan administratif !", "warning")
                                                }, 200);
                                              </script>
                                              <td class="text-red"><?php echo "<b>Lewat ".abs(round($selisih_))." hari.</b>"; ?></td>
                                            <?php }else{
                                              			echo "<td class='text-green'><b>Kurang ".round($selisih_)." hari.</b></td>";
                                             			}
                                          } else {
                                            if((round($selisih) <= 4) && (round($selisih) > 0)){
                                            	echo "<td class='text-yellow'><b>Kurang ".round($selisih)." hari.</b></td>";
                                            } else if((round($selisih) <= 0) && round($selisih) > -7){ ?>
                                              <script type="text/javascript">
                                                setTimeout(function() {
                                                  swal("Important!", "Salah satu/beberapa member lewat masa tenggang. Segera lakukan tindakan administratif !", "warning")
                                                }, 200);
                                              </script>
                                              <td class="text-red"><?php echo "<b>Lewat ".abs(round($selisih))." hari.</b>"; ?></td>
                                      <?php }else{
                                              echo "<td class='text-green'><b>Kurang ".round($selisih)." hari.</b></td>";
                                             } }
                                        }else if($bulan > date('m', $nonaktif)){
                                          echo "<td class='text-red'><b>Jatuh Tempo (-31)</b></td>";
                                        }else if($data[SEL] > 31){ $selisih = $data[BEDA];
                                          echo "<td class='text-green'><b>Kurang ".$selisih." hari.</b></td>";
                                        }else{ $selisih = $data[SEL];
																					echo "<td class='text-green'><b>Kurang ".$selisih." hari.</b></td>";
																				}
																				} ?>
                                        <td>
                                          <?php if(!empty($data[FOTO_MEMBER])){ ?>
                                            <a href="../assets/img/member/<?php echo $data[FOTO_MEMBER]; ?>" class="lihat" title="<?php echo $data[NM_MEMBER]; ?>"><i class="fa fa-picture-o"></i></a>
                                          <?php }else{ ?>
                                            <a href="../assets/img/pegawai/empty.gif" class="lihat" title="<?php echo $data[NM_MEMBER]; ?>"><i class="fa fa-picture-o"></i></a>
                                          <?php } ?>
                                        </td>
                                        <td>
                                            <a href="index?fold=ang&page=anggota_profile&id=<?php echo $data[ID_MEMBER]; ?>" data-toggle="tooltip" title="Lihat Profile"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;
                                            <a href="index?fold=ang&page=anggota_edit&id=<?php echo $data[ID_MEMBER]; ?>" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                                            <a href="javascript:confirmDelete('index?fold=ang&page=anggota_hapus&id=<?php echo $data[ID_MEMBER]; ?>')" data-toggle="tooltip" title="Hapus"><i class="fa fa-trash-o"></i></a>&nbsp;&nbsp;
                                            <a href="index?fold=ang&page=anggota_cetak&id=<?php echo $data[ID_MEMBER]; ?>" data-toggle="tooltip" title="Cetak Kartu Member"><i class="fa fa-print"></i></a>
                                        </td>
                                    </tr>
                                <?php
                                    }
                                ?>
                                <script type="text/javascript">
                                    function confirmDelete(delUrl) {
                                        setTimeout(function() {
                                            swal({
                                                title: "Apakah Anda yakin?",
                                                text: "Anda tidak akan bisa mengembalikan data yang telah terhapus!",
                                                type: "warning",
                                                showCancelButton: true,
                                                confirmButtonColor: "#DD6B55",
                                                confirmButtonText: "Yes, delete it!"
                                            },
                                            function(){
                                                document.location = delUrl;
                                            });
                                        }, 200);
                                    }
                                </script>
                              </tbody>
                          </table>
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

<div class="modal fade" id="add_member" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="myModalLabel">
  <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h3 class="modal-title"><i class="fa fa-user"></i>&nbsp;Tambah Member</h3>
        </div>
        <form action="index?fold=ang&page=anggota_save" method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="row">
                <div class="col-xs-6">
	                <?php
	                	$hitung = oci_parse($koneksi, "SELECT COUNT(*) FROM MEMBER"); oci_execute($hitung);
	                	$count = oci_fetch_array($hitung); $cek_ = oci_parse($koneksi, "SELECT ID_MEMBER FROM MEMBER");
                    oci_execute($cek_);
	                	if($count[0] != 0){
                      $no = 0;
                      while($db = oci_fetch_array($cek_)){
                        $no++; $id_ = $db['ID_MEMBER']; $id_sub = substr($id_, 1, -12);
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
                      <label for="">ID Member : </label>
                          <input type="text" class="form-control" name="id_member" id="id_member" readonly value="<?php echo "0".$id."-NCF-".date('Hi-s').""; ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Nama Lengkap&nbsp;<span class="text-red"><b>*</b></span>:</label>
                        <input type="text" class="form-control" name="nm_member" id="nm_member" placeholder="Nama Lengkap" required>
                    </div>
                    <div class="form-group">
                        <label for="">No. Telp&nbsp;<span class="text-red"><b>*</b></span>:</label>
                        <input type="text" class="form-control" name="telp_member" id="telp_member" pattern="\d+" title="Harus Angka" placeholder="No Telepon" required>
                    </div>
                    <div class="form-group">
                        <label for="">Alamat&nbsp;<span class="text-red"><b>*</b></span>:</label>
                        <textarea class="form-control" name="alamat_member" id="alamat_member" placeholder="Alamat" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Jenis Kelamin&nbsp;<span class="text-red"><b>*</b></span>:</label>
                        <div class="form_control">
                          <label><input type="radio" name="jk_kelamin" class="flat-blue" value="Laki-laki" required/>
                          Laki-laki&nbsp;
                          <input type="radio" name="jk_kelamin" class="flat-blue" value="Perempuan" required/>
                          Perempuan</label>
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="">Pertanyaan Keamanan&nbsp;<span class="text-red"><b>*</b></span>:</label>
                      <input type="text" name="ask_member" class="form-control" placeholder="Siapa nama orang tua (Laki-laki) Anda ?" required>
                    </div>
                </div>
                <div class="col-xs-6">
                	<div class="form-group">
                		<label for="">Tanggal Mendaftar :</label><?php $hr = $array_hr[date('N')]; $bln = $array_bln[date('n')]; ?>
                		<input type="text" readonly value="<?php echo $hr.', '.date('j').' '.$bln.' '.date('Y'); ?>" name="date" class="form-control">
                	</div>
                  	<div class="form-group">
	                    <label for="preview_gambar">Foto Member&nbsp;<span class="text-red"><b>**</b></span>:</label>
	                    <input type="file" name="ft_member" id="preview_gambar" class="filestyle" data-buttonName="bg-blue">
	                 </div>
                  	<img src="" id="gambar_nodin" width="200" alt="" />
                  	<div class="form-group">
                    	<label for="">Password&nbsp;<span class="text-red"><b>*</b></span>:</label>
                      	<input type="password" id="password" name="pass_member" placeholder="Password" required class="form-control">
                  	</div>
                  	<div class="form-group">
                    	<label for="">Confirm Password&nbsp;<span class="text-red"><b>*</b></span>:</label>
                      	<input type="password" id="conf_password" placeholder="Confirm Password" required class="form-control" onselectstart="return false" onpaste="return false;" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off>
                  	</div>
                  	<div class="form-group">
                    	<label for="">Level User :</label>
                    	<input type="text" id="level_user" name="level_member" class="form-control" value="Member" readonly>
                  	</div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <span class="text-red"><b>*</b></span>&nbsp;Tidak boleh kosong.<br>
                    <span class="text-red"><b>**</b></span>&nbsp;Ukuran foto maksimal 2MB.
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <input type="submit" class="btn btn-primary" name="simpan" value="Simpan">
            <!--<button type="button" class="btn btn-primary">Sign In</button>-->
          </div>
        </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
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
