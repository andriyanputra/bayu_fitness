<?php
    @session_start();
    if($_SESSION[NIP_PEGAWAI]==115623210) {
      if($_POST['simpan'] == 'Simpan'){
        $id = $_POST['id'];
        $nm_event = $_POST['nm_event'];
        $tgl_mulai = $_POST['date_start']; $tgl_start = strtotime($tgl_mulai); $tgl_s = date('mdY');
        $tgl_selesai = $_POST['date_end']; $tgl_end = strtotime($tgl_selesai);
        $ket_event = $_POST['ket_event'];

        if($tgl_end < $tgl_start){
          ?>
            <script type="text/javascript">
                setTimeout(function () {
                    swal({
                        title: "Oopss!",
                        text: "Terjadi kesalahan pengisian tanggal !",
                        type: "error",
                        showCancelButton: false
                    }, function () {
                        document.location = 'index?fold=event&page=event_list';
                    })
                }, 200);
            </script>
          <?php
        }else{
          if(!empty($_FILES['ft_event'] ['name'])){
            $foto = $id."_".$_FILES['ft_event'] ['name']; // Mendapatkan nama gambar
            $type = $_FILES['ft_event']['type'];
            $ukuran = $_FILES['ft_event']['size'];
            $target_dir = "../assets/img/event/";
            $target_file = $target_dir . basename($foto);
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            $check = @getimagesize($_FILES["ft_event"]["tmp_name"]);//Cek type file
            if($check === false) {
              ?>
              <script type="text/javascript">
                setTimeout(function() {
                    swal({
                          title:"Oopss!",
                          text: "File is not an image !",
                          type: "error",
                          showCancelButton: false
                    }, function(){
                         document.location = 'index?fold=user&page=index';
                    })
                }, 200);
              </script>
              <?php
            }
            // Check if file already exists
            if (file_exists($target_file)) {
              ?>
                <script type="text/javascript">
                  setTimeout(function() {
                      swal({
                            title:"Oopss!",
                            text: "File already exists! Mohon untuk melakukan update!",
                            type: "error",
                            showCancelButton: false
                      }, function(){
                          document.location = 'index?fold=user&page=index';
                      })
                  }, 200);
                </script>
              <?php
            }
            //cek ukuran gambar
            if($_FILES['ft_event']['size'] > 2097152){
              ?>
                <script type="text/javascript">
                  setTimeout(function() {
                      swal({
                            title:"Oopss!",
                            text: "Ukuran foto terlalu besar! Max: 2Mb !",
                            type: "error",
                            showCancelButton: false
                      }, function(){
                           document.location = 'index?fold=user&page=index';
                      })
                  }, 200);
                </script>
              <?php
            }
            if(move_uploaded_file($_FILES["ft_event"]["tmp_name"], $target_file)){
              $insert = oci_parse($koneksi, "INSERT INTO EVENT VALUES ('$id', '$nm_event', TO_DATE('$tgl_mulai', 'MM/DD/YYYY'), TO_DATE('$tgl_selesai', 'MM/DD/YYYY'), '$foto', '$ket_event')");
              if(oci_execute($insert)){
                ?>
                  <script type="text/javascript">
                      setTimeout(function () {
                          swal({
                              title: "Success!",
                              text: "Data event berhasil disimpan",
                              type: "success",
                              showCancelButton: false
                          }, function () {
                              document.location = 'index?fold=event&page=event_list';
                          })
                      }, 200);
                  </script>
                <?php
              }else{
                ?>
                  <script type="text/javascript">
                      setTimeout(function () {
                          swal({
                              title: "Oopss!",
                              text: "Data event gagal disimpan !",
                              type: "error",
                              showCancelButton: false
                          }, function () {
                              document.location = 'index?fold=event&page=event_list';
                          })
                      }, 200);
                  </script>
                <?php
              }
            }else{
              ?>
                <script type="text/javascript">
                  setTimeout(function() {
                      swal({
                            title:"Oopss!",
                            text: "Maaf, terjadi kesalahan unggah foto! Mohon untuk mengulanginya.",
                            type: "error",
                            showCancelButton: false
                      }, function(){
                          document.location = 'index?fold=event&page=index';
                      })
                  }, 200);
                </script>
              <?php
            }
            //echo "ID: ".$id."<br>Foto: ".$foto."<br>Nama: ".$nm_event."<br>tgl mulai: ".$tgl_mulai."<br>tgl selesai: ".$tgl_selesai;
          }else{
            $insert = oci_parse($koneksi, "INSERT INTO EVENT VALUES ('$id', '$nm_event', TO_DATE('$tgl_mulai', 'MM/DD/YYYY'), TO_DATE('$tgl_selesai', 'MM/DD/YYYY'), '', '$ket_event')");
              if(oci_execute($insert)){
                ?>
                  <script type="text/javascript">
                      setTimeout(function () {
                          swal({
                              title: "Success!",
                              text: "Data event berhasil disimpan",
                              type: "success",
                              showCancelButton: false
                          }, function () {
                              document.location = 'index?fold=event&page=event_list';
                          })
                      }, 200);
                  </script>
                <?php
              }else{
                ?>
                  <script type="text/javascript">
                      setTimeout(function () {
                          swal({
                              title: "Oopss!",
                              text: "Data event gagal disimpan !",
                              type: "error",
                              showCancelButton: false
                          }, function () {
                              document.location = 'index?fold=event&page=event_list';
                          })
                      }, 200);
                  </script>
                <?php
              }
            if(oci_execute($insert)){
              ?>
                <script type="text/javascript">
                    setTimeout(function () {
                        swal({
                            title: "Success!",
                            text: "Data event berhasil disimpan",
                            type: "success",
                            showCancelButton: false
                        }, function () {
                            document.location = 'index?fold=event&page=event_list';
                        })
                    }, 200);
                </script>
              <?php
            }else{
              ?>
                <script type="text/javascript">
                    setTimeout(function () {
                        swal({
                            title: "Oopss!",
                            text: "Data event gagal disimpan !",
                            type: "error",
                            showCancelButton: false
                        }, function () {
                            document.location = 'index?fold=event&page=event_list';
                        })
                    }, 200);
                </script>
              <?php
            }
            //echo "ID: ".$id."<br>Nama: ".$nm_event."<br>tgl mulai: ".$tgl_mulai."<br>tgl selesai: ".$tgl_selesai;
          }
        }
      }else if($_POST['update'] == 'Update'){
        $id = $_POST['id'];
        $nm_event = $_POST['nm_event'];
        $tgl_mulai = $_POST['date_start']; $tgl_start = strtotime($tgl_mulai); $tgl_s = date('mdY');
        $tgl_selesai = $_POST['date_end']; $tgl_end = strtotime($tgl_selesai);
        $ket_event = $_POST['ket_event'];
        //echo $tgl_start." - ".$tgl_end;
        if($tgl_end < $tgl_start){
          ?>
            <script type="text/javascript">
                setTimeout(function () {
                    swal({
                        title: "Oopss!",
                        text: "Terjadi kesalahan pengisian tanggal !",
                        type: "error",
                        showCancelButton: false
                    }, function () {
                        document.location = 'index?fold=event&page=event_list';
                    })
                }, 200);
            </script>
          <?php
        }else{
          $cek =oci_parse($koneksi, "SELECT * FROM EVENT WHERE ID_EVENT = '$id'"); oci_execute($cek);
          $db = oci_fetch_array($cek);
          $foto_lama = $db[FOTO_EVENT];
          
          $foto = $id."_".$_FILES['ft_event'] ['name']; // Mendapatkan nama gambar
          $type = $_FILES['ft_event']['type'];
          $ukuran = $_FILES['ft_event']['size'];
          $target_dir = "../assets/img/event/";
          $target_file = $target_dir . basename($foto);
          $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
          $check = @getimagesize($_FILES["ft_event"]["tmp_name"]);//Cek type file
          if($check === false) {
            ?>
            <script type="text/javascript">
              setTimeout(function() {
                  swal({
                        title:"Oopss!",
                        text: "File is not an image !",
                        type: "error",
                        showCancelButton: false
                  }, function(){
                       document.location = 'index?fold=user&page=index';
                  })
              }, 200);
            </script>
            <?php
          }
          // Check if file already exists
          if (file_exists($target_file)) {
            ?>
              <script type="text/javascript">
                setTimeout(function() {
                    swal({
                          title:"Oopss!",
                          text: "File already exists! Mohon untuk melakukan update!",
                          type: "error",
                          showCancelButton: false
                    }, function(){
                        document.location = 'index?fold=user&page=index';
                    })
                }, 200);
              </script>
            <?php
          }
          //cek ukuran gambar
          if($_FILES['ft_event']['size'] > 2097152){
            ?>
              <script type="text/javascript">
                setTimeout(function() {
                    swal({
                          title:"Oopss!",
                          text: "Ukuran foto terlalu besar! Max: 2Mb !",
                          type: "error",
                          showCancelButton: false
                    }, function(){
                         document.location = 'index?fold=user&page=index';
                    })
                }, 200);
              </script>
            <?php
          }

          if(!empty($_FILES['ft_event'] ['name'])){
            if (unlink($target_dir . "" . $foto_lama)) {
              if (move_uploaded_file($_FILES['ft_event']['tmp_name'], $target_file)) {
                $update = oci_parse($koneksi, "UPDATE EVENT SET
                                              NM_EVENT = '$nm_event',
                                              TGL_MULAI = TO_DATE('$tgl_mulai', 'MM/DD/YYYY'),
                                              TGL_SELESAI = TO_DATE('$tgl_selesai', 'MM/DD/YYYY'),
                                              FOTO_EVENT = '$foto',
                                              KET_EVENT = '$ket_event'
                                              WHERE ID_EVENT = '$id'");
                if (oci_execute($update)) {//proses update
                    ?>
                      <script type="text/javascript">
                          setTimeout(function () {
                              swal({
                                  title: "Success!",
                                  text: "Data event berhasil diperbaharui",
                                  type: "success",
                                  showCancelButton: false
                              }, function () {
                                  document.location = 'index?fold=event&page=event';
                              })
                          }, 200);
                      </script>
                    <?php
                } else {//gagal update
                  ?>
                    <script type="text/javascript">
                        setTimeout(function () {
                            swal({
                                title: "Oopss!",
                                text: "Data event gagal diperbaharui !",
                                type: "error",
                                showCancelButton: false
                            }, function () {
                                document.location = 'index?fold=event&page=event_edit&id=<?php echo $id; ?>';
                            })
                        }, 200);
                    </script>
                  <?php
                }
              }else{//gagal update
                ?>
                  <script type="text/javascript">
                      setTimeout(function () {
                          swal({
                              title: "Oopss!",
                              text: "Data event gagal diperbaharui !",
                              type: "error",
                              showCancelButton: false
                          }, function () {
                              document.location = 'index?fold=event&page=event_edit&id=<?php echo $id; ?>';
                          })
                      }, 200);
                  </script>
                <?php
              }
            }else{
              ?>
                <script type="text/javascript">
                    setTimeout(function () {
                        swal({
                            title: "Oopss!",
                            text: "Maaf, terjadi kesalahan unggah foto! Mohon untuk mengulanginya.",
                            type: "error",
                            showCancelButton: false
                        }, function () {
                            document.location = 'index?fold=event&page=event_edit&id=<?php echo $id; ?>';
                        })
                    }, 200);
                </script>
              <?php
            }
          }else{
            $update = oci_parse($koneksi, "UPDATE EVENT SET
                                          NM_EVENT = '$nm_event',
                                          TGL_MULAI = TO_DATE('$tgl_mulai', 'MM/DD/YYYY'),
                                          TGL_SELESAI = TO_DATE('$tgl_selesai', 'MM/DD/YYYY'),
                                          KET_EVENT = '$ket_event'
                                          WHERE ID_EVENT = '$id'");
            if (oci_execute($update)) {//proses update
                ?>
                  <script type="text/javascript">
                      setTimeout(function () {
                          swal({
                              title: "Success!",
                              text: "Data event berhasil diperbaharui",
                              type: "success",
                              showCancelButton: false
                          }, function () {
                              document.location = 'index?fold=event&page=event_list';
                          })
                      }, 200);
                  </script>
                <?php
            } else {//gagal update
              ?>
                <script type="text/javascript">
                    setTimeout(function () {
                        swal({
                            title: "Oopss!",
                            text: "Data event gagal diperbaharui !",
                            type: "error",
                            showCancelButton: false
                        }, function () {
                            document.location = 'index?fold=event&page=event_edit&id=<?php echo $id; ?>';
                        })
                    }, 200);
                </script>
              <?php
            }
          }
        }
      }
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