<?php
	@session_start();
    if($_SESSION[ID_LEVEL]==1) {
?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box">
                <div class="box-header">
                  	<h3 class=" text-center">Laporan Daftar Member</h3>
                    <h5 class=" text-center">New Comando Gym<br>Jl. Raya Mastrip 185 Jajartunggal<br>Surabaya</h5>
                </div><!-- /.box-header -->
                <div class="box-body">
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
                                      <th>Masa Aktif</th>
                                  </tr>
                              </thead>
                              <tbody>
                              <?php
                                /* script menentukan hari */
                                $array_hr= array(1=>"Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu");
                                $array_bln = array(1=>"Jan","Feb","Mar", "Apr", "Mei","Jun","Jul","Agt","Sep","Okt", "Nov","Des");

                                $select = oci_parse($koneksi, "SELECT ID_MEMBER, PERPANJANG, NM_MEMBER, ALAMAT_MEMBER, 
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
																				
                                          <?php $selisih = round($data[SELISIH]);
                                            if($selisih > 31){ $selisih = $selisih_ = $selisih - 1; //hal ini dilakukan untuk mengantisipasi jika terdapat hasil pengurangan lebih dari 31
                                              if((round($selisih_) < 5) && (round($selisih_) > 0)){
                                                echo "<td class='text-yellow'><b>Kurang ".round($selisih_)." hari.</b></td>";
                                              }else if((round($selisih_) <= 0) && (round($selisih_) > -32)){ ?>
                                                <script type="text/javascript">
                                                  setTimeout(function() {
                                                    swal("Important!", "Salah satu/beberapa member lewat masa tenggang. Segera lakukan tindakan administratif !", "warning")
                                                  }, 200);
                                                </script>
                                                <td class="text-red"><?php echo "<b>Lewat ".abs(round($selisih_))." hari.</b>"; ?></td>
                                          <?php
                                              }else if(round($selisih_) <= -31){
                                                echo "<td class='text-red'><b>Lebih dari 31 hari.</b></td>";
                                              }else{
                                                echo "<td class='text-green'><b>Kurang ".round($selisih_)." hari.</b></td>";
                                              }
                                            }else{
                                              if((round($selisih) < 5) && (round($selisih) > 0)){
                                                echo "<td class='text-yellow'><b>Kurang ".round($selisih)." hari.</b></td>";
                                              }else if((round($selisih) <= 0) && (round($selisih) > -32)){ ?>
                                                <script type="text/javascript">
                                                  setTimeout(function() {
                                                    swal("Important!", "Salah satu/beberapa member lewat masa tenggang. Segera lakukan tindakan administratif !", "warning")
                                                  }, 200);
                                                </script>
                                                <td class="text-red"><?php echo "<b>Lewat ".abs(round($selisih))." hari.</b>"; ?></td>
                                          <?php
                                              }else if(round($selisih) <= -31){
                                                echo "<td class='text-red'><b>Lebih dari 31 hari.</b></td>";
                                              }else{
                                                echo "<td class='text-green'><b>Kurang ".round($selisih)." hari.</b></td>";
                                              }
                                            }
                                          ?>
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
                          </table><br>
	                      	<p align="right"><?php echo "Surabaya, ".date('j - n - Y'); ?></p>
	                        <br>
	                        <br>
	                        <p align="right"><u>Bayu Anggoro Priyambodho</u><br>NIP. 115623210</p>
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
<script>
  window.print();
</script>
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