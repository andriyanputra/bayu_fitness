<?php
@session_start();
if ($_SESSION[ID_LEVEL] == 1 || $_SESSION[ID_LEVEL] == 3) {

    if ($_POST['simpan'] == 'Simpan') {
        $cek_id = oci_parse($koneksi, "SELECT ID_MEMBER FROM MEMBER WHERE ID_MEMBER = '$_POST[id_member]'");
        oci_execute($cek_id);
        $db = oci_fetch_array($cek_id);
        if ($db['ID_MEMBER'] == $_POST['id_member']) {
            ?>
            <script type="text/javascript">
                setTimeout(function () {
                    swal({
                        title: "Oopss!",
                        text: "ID Member sama. Mohon untuk refresh halaman !",
                        type: "error",
                        showCancelButton: false
                    }, function () {
                        document.location = 'index?fold=ang&page=anggota';
                    })
                }, 200);
            </script>
            <?php
        } else {
            $id = $_POST['id_member'];
        }
        $nm = $_POST['nm_member'];
        $telp = $_POST['telp_member'];
        $alamat = $_POST['alamat_member'];
        $jk = $_POST['jk_kelamin'];
        $ask = $_POST['ask_member'];
        $date_dftr = date('mdY');
        $pass = md5($_POST['pass_member']);
        $level = 3;
        $tgl_habis = date('mdY', strtotime("+1 month"));
        //foto
        if (!empty($_FILES['ft_member'] ['name'])) {
            $foto = $id . "_" . $_FILES['ft_member'] ['name']; // Mendapatkan nama gambar
            $type = $_FILES['ft_member']['type'];
            $ukuran = $_FILES['ft_member']['size'];
            $target_dir = "../assets/img/member/";
            $target_file = $target_dir . basename($foto);
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
            $check = @getimagesize($_FILES["ft_member"]["tmp_name"]); //Cek type file
            if ($check === false) {
                ?>
                <script type="text/javascript">
                    setTimeout(function () {
                        swal({
                            title: "Oopss!",
                            text: "File is not an image !",
                            type: "error",
                            showCancelButton: false
                        }, function () {
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
                    setTimeout(function () {
                        swal({
                            title: "Oopss!",
                            text: "File already exists! Mohon untuk melakukan update!",
                            type: "error",
                            showCancelButton: false
                        }, function () {
                            document.location = 'index?fold=user&page=index';
                        })
                    }, 200);
                </script>
                <?php
            }
            //cek ukuran gambar
            if ($_FILES['ft_member']['size'] > 2097152) {
                ?>
                <script type="text/javascript">
                    setTimeout(function () {
                        swal({
                            title: "Oopss!",
                            text: "Ukuran foto terlalu besar! Max: 2Mb !",
                            type: "error",
                            showCancelButton: false
                        }, function () {
                            document.location = 'index?fold=user&page=index';
                        })
                    }, 200);
                </script>
                <?php
            }

            if (move_uploaded_file($_FILES["ft_member"]["tmp_name"], $target_file)) {
                $insert = oci_parse($koneksi, "INSERT INTO MEMBER VALUES ('$id', '$nm', '$alamat', '$telp', TO_DATE('$date_dftr', 'MM/DD/YYYY'), TO_DATE('$tgl_habis', 'MM/DD/YYYY'), '$pass', '$jk', '$ask', '$foto', $level,'', 1, current_timestamp)");
                if (oci_execute($insert)) {
                    ?>
                    <script type="text/javascript">
                        setTimeout(function () {
                            swal({
                                title: "Success!",
                                text: "Data member berhasil disimpan. Mohon untuk cetak kartu member.",
                                type: "success",
                                showCancelButton: false
                            }, function () {
                                document.location = 'index?fold=ang&page=anggota';
                            })
                        }, 200);
                    </script>
                    <?php
                } else {
                    ?>
                    <script type="text/javascript">
                        setTimeout(function () {
                            swal({
                                title: "Oopss!",
                                text: "Data member gagal tersimpan. Mohon untuk diulang !",
                                type: "error",
                                showCancelButton: false
                            }, function () {
                                document.location = 'index?fold=ang&page=anggota';
                            })
                        }, 200);
                    </script>
                    <?php
                }
            } else {
                ?>
                <script type="text/javascript">
                    setTimeout(function () {
                        swal({
                            title: "Oopss!",
                            text: "Maaf, terjadi kesalahan unggah foto! Mohon untuk mengulanginya.",
                            type: "error",
                            showCancelButton: false
                        }, function () {
                            document.location = 'index?fold=user&page=iindex';
                        })
                    }, 200);
                </script>
                <?php
            }

            //echo "ID:".$id."<br>Nama:".$nm."<br>Telp:".$telp."<br>Alamat:".$alamat."<br>Jenis Kelamin:".$jk."<br>Ask:".$ask."<br>Tanggal Daftar(save):".date('d/m/Y H:i:s')."<br>Tanggal Daftar(post):".$date_dftr."<br>Pass:".$pass."<br>Level:".$level."<br>Foto:".$foto."<br>1bulan kedepan:".$tgl_habis;
        } else {
            $insert = oci_parse($koneksi, "INSERT INTO MEMBER VALUES ('$id', '$nm', '$alamat', '$telp', TO_DATE('$date_dftr', 'mm/dd/yyyy hh24:mi:ss'), TO_DATE('$tgl_habis', 'mm/dd/yyyy hh24:mi:ss'), '$pass', '$jk', '$ask', '', $level,'', 1, current_timestamp)");
            if (oci_execute($insert)) {
                ?>
                <script type="text/javascript">
                    setTimeout(function () {
                        swal({
                            title: "Success!",
                            text: "Data member berhasil disimpan. Mohon untuk cetak kartu member.",
                            type: "success",
                            showCancelButton: false
                        }, function () {
                            document.location = 'index?fold=ang&page=anggota';
                        })
                    }, 200);
                </script>
                <?php
            } else {
                ?>
                <script type="text/javascript">
                    setTimeout(function () {
                        swal({
                            title: "Oopss!",
                            text: "Biodata user gagal tersimpan !",
                            type: "error",
                            showCancelButton: false
                        }, function () {
                            document.location = 'index?fold=ang&page=anggota';
                        })
                    }, 200);
                </script>
                <?php
            }
        }
    } else if ($_POST['update'] == 'Update') {
        $tgl = date('mdY');
        $id = $_POST['id_member'];
        $nm = $_POST['nm_member'];
        $telp = $_POST['telp_member'];
        $alamat = $_POST['alamat_member'];
        $jk = $_POST['jk_kelamin'];
        $ask = $_POST['ask_member'];

        if(!empty($_FILES['ft_member_baru']['name']) && empty($_POST['ft_member_lama'])){
          if (!empty($_POST['perpanjang'])) {//jika diperpanjang masa aktifnya
            $perpanjang = $_POST['perpanjang'];
            $i = 0;
            while ($i < 12) {
              $i++;
              if ($i == $perpanjang) {
                  $tgl_habis = date('mdY', strtotime("+$i month"));
              }
            }
            if (!empty($_POST['pass_member_baru'])) {
              $pass = md5($_POST['pass_member_baru']);
              $foto = $id . "_" . $_FILES['ft_member_baru'] ['name']; // Mendapatkan nama gambar
              $type = $_FILES['ft_member_baru']['type'];
              $ukuran = $_FILES['ft_member_baru']['size'];
              $target_dir = "../assets/img/member/";
              $target_file = $target_dir . basename($foto);
              $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
              $check = @getimagesize($_FILES["ft_member_baru"]["tmp_name"]); //Cek type file
              if ($check === false) {
                ?>
                  <script type="text/javascript">
                      setTimeout(function () {
                          swal({
                              title: "Oopss!",
                              text: "File is not an image !",
                              type: "error",
                              showCancelButton: false
                          }, function () {
                              document.location = 'index?fold=ang&page=anggota_edit&id=<?php echo $id; ?>';
                          })
                      }, 200);
                  </script>
                <?php
              }
              // Check if file already exists
              if (file_exists($target_file)) {
                ?>
                  <script type="text/javascript">
                      setTimeout(function () {
                          swal({
                              title: "Oopss!",
                              text: "File already exists! Mohon untuk melakukan update!",
                              type: "error",
                              showCancelButton: false
                          }, function () {
                              document.location = 'index?fold=ang&page=anggota_edit&id=<?php echo $id; ?>';
                          })
                      }, 200);
                  </script>
                <?php
              }
              //cek ukuran gambar
              if ($_FILES['ft_member_baru']['size'] > 2097152) {
                ?>
                  <script type="text/javascript">
                      setTimeout(function () {
                          swal({
                              title: "Oopss!",
                              text: "Ukuran foto terlalu besar! Max: 2Mb !",
                              type: "error",
                              showCancelButton: false
                          }, function () {
                              document.location = 'index?fold=ang&page=anggota_edit&id=<?php echo $id; ?>';
                          })
                      }, 200);
                  </script>
                <?php
              }
              if (move_uploaded_file($_FILES['ft_member_baru']['tmp_name'], $target_file)) {
                  $update = oci_parse($koneksi, "UPDATE MEMBER SET
                                                NM_MEMBER = '$nm',
                                                ALAMAT_MEMBER = '$alamat',
                                                TELP_MEMBER = '$telp',
                                                NONAKTIF_MEMBER = TO_DATE('$tgl_habis', 'MM/DD/YYYY'),
                                                PASS_MEMBER = '$pass',
                                                JK_KELAMIN = '$jk',
                                                ASK_MEMBER = '$ask',
                                                FOTO_MEMBER = '$foto',
                                                PERPANJANG = TO_DATE('mdY', 'MM/DD/YYYY'),
                                                NOTIF_MEMBER = 2,
                                                LOG = current_timestamp
                                                WHERE ID_MEMBER = '$id'");
                  if (oci_execute($update)) {//proses update
                      ?>
                        <script type="text/javascript">
                            setTimeout(function () {
                                swal({
                                    title: "Success!",
                                    text: "Data member berhasil diperbaharui",
                                    type: "success",
                                    showCancelButton: false
                                }, function () {
                                    document.location = 'index?fold=ang&page=anggota';
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
                                  text: "Data member gagal diperbaharui !",
                                  type: "error",
                                  showCancelButton: false
                              }, function () {
                                  document.location = 'index?fold=ang&page=anggota_edit&id=<?php echo $id; ?>';
                              })
                          }, 200);
                      </script>
                    <?php
                  }
              } else {//gagal upload
                ?>
                  <script type="text/javascript">
                      setTimeout(function () {
                          swal({
                              title: "Oopss!",
                              text: "Maaf, terjadi kesalahan unggah foto! Mohon untuk mengulanginya.",
                              type: "error",
                              showCancelButton: false
                          }, function () {
                              document.location = 'index?fold=ang&page=anggota_edit&id=<?php echo $id; ?>';
                          })
                      }, 200);
                  </script>
                <?php
              }
            }else{
              $foto = $id . "_" . $_FILES['ft_member_baru'] ['name']; // Mendapatkan nama gambar
              $type = $_FILES['ft_member_baru']['type'];
              $ukuran = $_FILES['ft_member_baru']['size'];
              $target_dir = "../assets/img/member/";
              $target_file = $target_dir . basename($foto);
              $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
              $check = @getimagesize($_FILES["ft_member_baru"]["tmp_name"]); //Cek type file
              if ($check === false) {
                ?>
                  <script type="text/javascript">
                      setTimeout(function () {
                          swal({
                              title: "Oopss!",
                              text: "File is not an image !",
                              type: "error",
                              showCancelButton: false
                          }, function () {
                              document.location = 'index?fold=ang&page=anggota_edit&id=<?php echo $id; ?>';
                          })
                      }, 200);
                  </script>
                <?php
              }
              // Check if file already exists
              if (file_exists($target_file)) {
                ?>
                  <script type="text/javascript">
                      setTimeout(function () {
                          swal({
                              title: "Oopss!",
                              text: "File already exists! Mohon untuk melakukan update!",
                              type: "error",
                              showCancelButton: false
                          }, function () {
                              document.location = 'index?fold=ang&page=anggota_edit&id=<?php echo $id; ?>';
                          })
                      }, 200);
                  </script>
                <?php
              }
              //cek ukuran gambar
              if ($_FILES['ft_member_baru']['size'] > 2097152) {
                ?>
                  <script type="text/javascript">
                      setTimeout(function () {
                          swal({
                              title: "Oopss!",
                              text: "Ukuran foto terlalu besar! Max: 2Mb !",
                              type: "error",
                              showCancelButton: false
                          }, function () {
                              document.location = 'index?fold=ang&page=anggota_edit&id=<?php echo $id; ?>';
                          })
                      }, 200);
                  </script>
                <?php
              }
              if (move_uploaded_file($_FILES['ft_member_baru']['tmp_name'], $target_file)) {
                  $update = oci_parse($koneksi, "UPDATE MEMBER SET
                                                NM_MEMBER = '$nm',
                                                ALAMAT_MEMBER = '$alamat',
                                                TELP_MEMBER = '$telp',
                                                NONAKTIF_MEMBER = TO_DATE('$tgl_habis', 'MM/DD/YYYY'),
                                                JK_KELAMIN = '$jk',
                                                ASK_MEMBER = '$ask',
                                                FOTO_MEMBER = '$foto',
                                                PERPANJANG = TO_DATE('mdY', 'MM/DD/YYYY'),
                                                NOTIF_MEMBER = 2,
                                                LOG = current_timestamp
                                                WHERE ID_MEMBER = '$id'");
                  if (oci_execute($update)) {//proses update
                      ?>
                        <script type="text/javascript">
                            setTimeout(function () {
                                swal({
                                    title: "Success!",
                                    text: "Data member berhasil diperbaharui",
                                    type: "success",
                                    showCancelButton: false
                                }, function () {
                                    document.location = 'index?fold=ang&page=anggota';
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
                                  text: "Data member gagal diperbaharui !",
                                  type: "error",
                                  showCancelButton: false
                              }, function () {
                                  document.location = 'index?fold=ang&page=anggota_edit&id=<?php echo $id; ?>';
                              })
                          }, 200);
                      </script>
                    <?php
                  }
              } else {//gagal upload
                ?>
                  <script type="text/javascript">
                      setTimeout(function () {
                          swal({
                              title: "Oopss!",
                              text: "Maaf, terjadi kesalahan unggah foto! Mohon untuk mengulanginya.",
                              type: "error",
                              showCancelButton: false
                          }, function () {
                              document.location = 'index?fold=ang&page=anggota_edit&id=<?php echo $id; ?>';
                          })
                      }, 200);
                  </script>
                <?php
              }
            }
          }else{//jika tidak perpanjang masa aktif
            if (!empty($_POST['pass_member_baru'])) {
              $pass = md5($_POST['pass_member_baru']);
              $foto = $id . "_" . $_FILES['ft_member_baru'] ['name']; // Mendapatkan nama gambar
              $type = $_FILES['ft_member_baru']['type'];
              $ukuran = $_FILES['ft_member_baru']['size'];
              $target_dir = "../assets/img/member/";
              $target_file = $target_dir . basename($foto);
              $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
              $check = @getimagesize($_FILES["ft_member_baru"]["tmp_name"]); //Cek type file
              if ($check === false) {
                ?>
                  <script type="text/javascript">
                      setTimeout(function () {
                          swal({
                              title: "Oopss!",
                              text: "File is not an image !",
                              type: "error",
                              showCancelButton: false
                          }, function () {
                              document.location = 'index?fold=ang&page=anggota_edit&id=<?php echo $id; ?>';
                          })
                      }, 200);
                  </script>
                <?php
              }
              // Check if file already exists
              if (file_exists($target_file)) {
                ?>
                  <script type="text/javascript">
                      setTimeout(function () {
                          swal({
                              title: "Oopss!",
                              text: "File already exists! Mohon untuk melakukan update!",
                              type: "error",
                              showCancelButton: false
                          }, function () {
                              document.location = 'index?fold=ang&page=anggota_edit&id=<?php echo $id; ?>';
                          })
                      }, 200);
                  </script>
                <?php
              }
              //cek ukuran gambar
              if ($_FILES['ft_member_baru']['size'] > 2097152) {
                ?>
                  <script type="text/javascript">
                      setTimeout(function () {
                          swal({
                              title: "Oopss!",
                              text: "Ukuran foto terlalu besar! Max: 2Mb !",
                              type: "error",
                              showCancelButton: false
                          }, function () {
                              document.location = 'index?fold=ang&page=anggota_edit&id=<?php echo $id; ?>';
                          })
                      }, 200);
                  </script>
                <?php
              }
              if (move_uploaded_file($_FILES['ft_member_baru']['tmp_name'], $target_file)) {
                  $update = oci_parse($koneksi, "UPDATE MEMBER SET
                                                NM_MEMBER = '$nm',
                                                ALAMAT_MEMBER = '$alamat',
                                                TELP_MEMBER = '$telp',
                                                PASS_MEMBER = '$pass',
                                                JK_KELAMIN = '$jk',
                                                ASK_MEMBER = '$ask',
                                                FOTO_MEMBER = '$foto',
                                                NOTIF_MEMBER = 2,
                                                LOG = current_timestamp
                                                WHERE ID_MEMBER = '$id'");
                  if (oci_execute($update)) {//proses update
                      ?>
                        <script type="text/javascript">
                            setTimeout(function () {
                                swal({
                                    title: "Success!",
                                    text: "Data member berhasil diperbaharui",
                                    type: "success",
                                    showCancelButton: false
                                }, function () {
                                    document.location = 'index?fold=ang&page=anggota';
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
                                  text: "Data member gagal diperbaharui !",
                                  type: "error",
                                  showCancelButton: false
                              }, function () {
                                  document.location = 'index?fold=ang&page=anggota_edit&id=<?php echo $id; ?>';
                              })
                          }, 200);
                      </script>
                    <?php
                  }
              } else {//gagal upload
                ?>
                  <script type="text/javascript">
                      setTimeout(function () {
                          swal({
                              title: "Oopss!",
                              text: "Maaf, terjadi kesalahan unggah foto! Mohon untuk mengulanginya.",
                              type: "error",
                              showCancelButton: false
                          }, function () {
                              document.location = 'index?fold=ang&page=anggota_edit&id=<?php echo $id; ?>';
                          })
                      }, 200);
                  </script>
                <?php
              }
            }else{
              $foto = $id . "_" . $_FILES['ft_member_baru'] ['name']; // Mendapatkan nama gambar
              $type = $_FILES['ft_member_baru']['type'];
              $ukuran = $_FILES['ft_member_baru']['size'];
              $target_dir = "../assets/img/member/";
              $target_file = $target_dir . basename($foto);
              $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
              $check = @getimagesize($_FILES["ft_member_baru"]["tmp_name"]); //Cek type file
              if ($check === false) {
                ?>
                  <script type="text/javascript">
                      setTimeout(function () {
                          swal({
                              title: "Oopss!",
                              text: "File is not an image !",
                              type: "error",
                              showCancelButton: false
                          }, function () {
                              document.location = 'index?fold=ang&page=anggota_edit&id=<?php echo $id; ?>';
                          })
                      }, 200);
                  </script>
                <?php
              }
              // Check if file already exists
              if (file_exists($target_file)) {
                ?>
                  <script type="text/javascript">
                      setTimeout(function () {
                          swal({
                              title: "Oopss!",
                              text: "File already exists! Mohon untuk melakukan update!",
                              type: "error",
                              showCancelButton: false
                          }, function () {
                              document.location = 'index?fold=ang&page=anggota_edit&id=<?php echo $id; ?>';
                          })
                      }, 200);
                  </script>
                <?php
              }
              //cek ukuran gambar
              if ($_FILES['ft_member_baru']['size'] > 2097152) {
                ?>
                  <script type="text/javascript">
                      setTimeout(function () {
                          swal({
                              title: "Oopss!",
                              text: "Ukuran foto terlalu besar! Max: 2Mb !",
                              type: "error",
                              showCancelButton: false
                          }, function () {
                              document.location = 'index?fold=ang&page=anggota_edit&id=<?php echo $id; ?>';
                          })
                      }, 200);
                  </script>
                <?php
              }
              if (move_uploaded_file($_FILES['ft_member_baru']['tmp_name'], $target_file)) {
                  $update = oci_parse($koneksi, "UPDATE MEMBER SET
                                                NM_MEMBER = '$nm',
                                                ALAMAT_MEMBER = '$alamat',
                                                TELP_MEMBER = '$telp',
                                                JK_KELAMIN = '$jk',
                                                ASK_MEMBER = '$ask',
                                                FOTO_MEMBER = '$foto',
                                                NOTIF_MEMBER = 2,
                                                LOG = current_timestamp
                                                WHERE ID_MEMBER = '$id'");
                  if (oci_execute($update)) {//proses update
                      ?>
                        <script type="text/javascript">
                            setTimeout(function () {
                                swal({
                                    title: "Success!",
                                    text: "Data member berhasil diperbaharui",
                                    type: "success",
                                    showCancelButton: false
                                }, function () {
                                    document.location = 'index?fold=ang&page=anggota';
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
                                  text: "Data member gagal diperbaharui !",
                                  type: "error",
                                  showCancelButton: false
                              }, function () {
                                  document.location = 'index?fold=ang&page=anggota_edit&id=<?php echo $id; ?>';
                              })
                          }, 200);
                      </script>
                    <?php
                  }
              } else {//gagal upload
                ?>
                  <script type="text/javascript">
                      setTimeout(function () {
                          swal({
                              title: "Oopss!",
                              text: "Maaf, terjadi kesalahan unggah foto! Mohon untuk mengulanginya.",
                              type: "error",
                              showCancelButton: false
                          }, function () {
                              document.location = 'index?fold=ang&page=anggota_edit&id=<?php echo $id; ?>';
                          })
                      }, 200);
                  </script>
                <?php
              }
            }
          }
        }else if(!empty($_FILES['ft_member_baru']['name']) && !empty($_POST['ft_member_lama'])){
          $foto_lama = $_POST['ft_member_lama'];
          if (!empty($_POST['perpanjang'])) {//jika diperpanjang masa aktifnya
            $perpanjang = $_POST['perpanjang'];
            $i = 0;
            while ($i < 12) {
              $i++;
              if ($i == $perpanjang) {
                  $tgl_habis = date('m/d/Y', strtotime("+$i month"));
              }
            }
            if (!empty($_POST['pass_member_baru'])) {
              $pass = md5($_POST['pass_member_baru']);
              $foto = $id . "_" . $_FILES['ft_member_baru'] ['name']; // Mendapatkan nama gambar
              $type = $_FILES['ft_member_baru']['type'];
              $ukuran = $_FILES['ft_member_baru']['size'];
              $target_dir = "../assets/img/member/";
              $target_file = $target_dir . basename($foto);
              $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
              $check = @getimagesize($_FILES["ft_member_baru"]["tmp_name"]); //Cek type file
              if ($check === false) {
                ?>
                  <script type="text/javascript">
                      setTimeout(function () {
                          swal({
                              title: "Oopss!",
                              text: "File is not an image !",
                              type: "error",
                              showCancelButton: false
                          }, function () {
                              document.location = 'index?fold=ang&page=anggota_edit&id=<?php echo $id; ?>';
                          })
                      }, 200);
                  </script>
                <?php
              }
              // Check if file already exists
              if (file_exists($target_file)) {
                ?>
                  <script type="text/javascript">
                      setTimeout(function () {
                          swal({
                              title: "Oopss!",
                              text: "File already exists! Mohon untuk melakukan update!",
                              type: "error",
                              showCancelButton: false
                          }, function () {
                              document.location = 'index?fold=ang&page=anggota_edit&id=<?php echo $id; ?>';
                          })
                      }, 200);
                  </script>
                <?php
              }
              //cek ukuran gambar
              if ($_FILES['ft_member_baru']['size'] > 2097152) {
                ?>
                  <script type="text/javascript">
                      setTimeout(function () {
                          swal({
                              title: "Oopss!",
                              text: "Ukuran foto terlalu besar! Max: 2Mb !",
                              type: "error",
                              showCancelButton: false
                          }, function () {
                              document.location = 'index?fold=ang&page=anggota_edit&id=<?php echo $id; ?>';
                          })
                      }, 200);
                  </script>
                <?php
              }
              if (unlink($target_dir . "" . $foto_lama)) {
                if (move_uploaded_file($_FILES['ft_member_baru']['tmp_name'], $target_file)) {
                    $update = oci_parse($koneksi, "UPDATE MEMBER SET
                                                  NM_MEMBER = '$nm',
                                                  ALAMAT_MEMBER = '$alamat',
                                                  TELP_MEMBER = '$telp',
                                                  NONAKTIF_MEMBER = TO_DATE('$tgl_habis', 'MM/DD/YYYY'),
                                                  PASS_MEMBER = '$pass',
                                                  JK_KELAMIN = '$jk',
                                                  ASK_MEMBER = '$ask',
                                                  FOTO_MEMBER = '$foto',
                                                  PERPANJANG = TO_DATE('mdY', 'MM/DD/YYYY'),
                                                  NOTIF_MEMBER = 2,
                                                  LOG = current_timestamp
                                                  WHERE ID_MEMBER = '$id'");
                    if (oci_execute($update)) {//proses update
                        ?>
                          <script type="text/javascript">
                              setTimeout(function () {
                                  swal({
                                      title: "Success!",
                                      text: "Data member berhasil diperbaharui",
                                      type: "success",
                                      showCancelButton: false
                                  }, function () {
                                      document.location = 'index?fold=ang&page=anggota';
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
                                    text: "Data member gagal diperbaharui !",
                                    type: "error",
                                    showCancelButton: false
                                }, function () {
                                    document.location = 'index?fold=ang&page=anggota_edit&id=<?php echo $id; ?>';
                                })
                            }, 200);
                        </script>
                      <?php
                    }
                } else {//gagal upload
                  ?>
                    <script type="text/javascript">
                        setTimeout(function () {
                            swal({
                                title: "Oopss!",
                                text: "Maaf, terjadi kesalahan unggah foto! Mohon untuk mengulanginya.",
                                type: "error",
                                showCancelButton: false
                            }, function () {
                                document.location = 'index?fold=ang&page=anggota_edit&id=<?php echo $id; ?>';
                            })
                        }, 200);
                    </script>
                  <?php
                }
              } else {//gagal menghapus link gambar lama
                  ?>
                  <script type="text/javascript">
                      setTimeout(function () {
                          swal({
                              title: "Oopss!",
                              text: "Maaf, terjadi kesalahan unggah foto! Mohon untuk mengulanginya.",
                              type: "error",
                              showCancelButton: false
                          }, function () {
                              document.location = 'index?fold=ang&page=anggota_edit&id=<?php echo $id; ?>';
                          })
                      }, 200);
                  </script>
                  <?php
              }
            }else{
              $foto = $id . "_" . $_FILES['ft_member_baru'] ['name']; // Mendapatkan nama gambar
              $type = $_FILES['ft_member_baru']['type'];
              $ukuran = $_FILES['ft_member_baru']['size'];
              $target_dir = "../assets/img/member/";
              $target_file = $target_dir . basename($foto);
              $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
              $check = @getimagesize($_FILES["ft_member_baru"]["tmp_name"]); //Cek type file
              if ($check === false) {
                ?>
                  <script type="text/javascript">
                      setTimeout(function () {
                          swal({
                              title: "Oopss!",
                              text: "File is not an image !",
                              type: "error",
                              showCancelButton: false
                          }, function () {
                              document.location = 'index?fold=ang&page=anggota_edit&id=<?php echo $id; ?>';
                          })
                      }, 200);
                  </script>
                <?php
              }
              // Check if file already exists
              if (file_exists($target_file)) {
                ?>
                  <script type="text/javascript">
                      setTimeout(function () {
                          swal({
                              title: "Oopss!",
                              text: "File already exists! Mohon untuk melakukan update!",
                              type: "error",
                              showCancelButton: false
                          }, function () {
                              document.location = 'index?fold=ang&page=anggota_edit&id=<?php echo $id; ?>';
                          })
                      }, 200);
                  </script>
                <?php
              }
              //cek ukuran gambar
              if ($_FILES['ft_member_baru']['size'] > 2097152) {
                ?>
                  <script type="text/javascript">
                      setTimeout(function () {
                          swal({
                              title: "Oopss!",
                              text: "Ukuran foto terlalu besar! Max: 2Mb !",
                              type: "error",
                              showCancelButton: false
                          }, function () {
                              document.location = 'index?fold=ang&page=anggota_edit&id=<?php echo $id; ?>';
                          })
                      }, 200);
                  </script>
                <?php
              }
              if (unlink($target_dir . "" . $foto_lama)) {
                if (move_uploaded_file($_FILES['ft_member_baru']['tmp_name'], $target_file)) {
                    $update = oci_parse($koneksi, "UPDATE MEMBER SET
                                                  NM_MEMBER = '$nm',
                                                  ALAMAT_MEMBER = '$alamat',
                                                  TELP_MEMBER = '$telp',
                                                  NONAKTIF_MEMBER = TO_DATE('$tgl_habis', 'MM/DD/YYYY'),
                                                  JK_KELAMIN = '$jk',
                                                  ASK_MEMBER = '$ask',
                                                  FOTO_MEMBER = '$foto',
                                                  PERPANJANG = TO_DATE('mdY', 'MM/DD/YYYY'),
                                                  NOTIF_MEMBER = 2,
                                                  LOG = current_timestamp
                                                  WHERE ID_MEMBER = '$id'");
                    if (oci_execute($update)) {//proses update
                        ?>
                          <script type="text/javascript">
                              setTimeout(function () {
                                  swal({
                                      title: "Success!",
                                      text: "Data member berhasil diperbaharui",
                                      type: "success",
                                      showCancelButton: false
                                  }, function () {
                                      document.location = 'index?fold=ang&page=anggota';
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
                                    text: "Data member gagal diperbaharui !",
                                    type: "error",
                                    showCancelButton: false
                                }, function () {
                                    document.location = 'index?fold=ang&page=anggota_edit&id=<?php echo $id; ?>';
                                })
                            }, 200);
                        </script>
                      <?php
                    }
                } else {//gagal upload
                  ?>
                    <script type="text/javascript">
                        setTimeout(function () {
                            swal({
                                title: "Oopss!",
                                text: "Maaf, terjadi kesalahan unggah foto! Mohon untuk mengulanginya.",
                                type: "error",
                                showCancelButton: false
                            }, function () {
                                document.location = 'index?fold=ang&page=anggota_edit&id=<?php echo $id; ?>';
                            })
                        }, 200);
                    </script>
                  <?php
                }
              } else {//gagal menghapus link gambar lama
                  ?>
                  <script type="text/javascript">
                      setTimeout(function () {
                          swal({
                              title: "Oopss!",
                              text: "Maaf, terjadi kesalahan unggah foto! Mohon untuk mengulanginya.",
                              type: "error",
                              showCancelButton: false
                          }, function () {
                              document.location = 'index?fold=ang&page=anggota_edit&id=<?php echo $id; ?>';
                          })
                      }, 200);
                  </script>
                  <?php
              }
            }
          }else{//jika tidak perpanjang masa aktif
            if (!empty($_POST['pass_member_baru'])) {
              $pass = md5($_POST['pass_member_baru']);
              $foto = $id . "_" . $_FILES['ft_member_baru'] ['name']; // Mendapatkan nama gambar
              $type = $_FILES['ft_member_baru']['type'];
              $ukuran = $_FILES['ft_member_baru']['size'];
              $target_dir = "../assets/img/member/";
              $target_file = $target_dir . basename($foto);
              $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
              $check = @getimagesize($_FILES["ft_member_baru"]["tmp_name"]); //Cek type file
              if ($check === false) {
                ?>
                  <script type="text/javascript">
                      setTimeout(function () {
                          swal({
                              title: "Oopss!",
                              text: "File is not an image !",
                              type: "error",
                              showCancelButton: false
                          }, function () {
                              document.location = 'index?fold=ang&page=anggota_edit&id=<?php echo $id; ?>';
                          })
                      }, 200);
                  </script>
                <?php
              }
              // Check if file already exists
              if (file_exists($target_file)) {
                ?>
                  <script type="text/javascript">
                      setTimeout(function () {
                          swal({
                              title: "Oopss!",
                              text: "File already exists! Mohon untuk melakukan update!",
                              type: "error",
                              showCancelButton: false
                          }, function () {
                              document.location = 'index?fold=ang&page=anggota_edit&id=<?php echo $id; ?>';
                          })
                      }, 200);
                  </script>
                <?php
              }
              //cek ukuran gambar
              if ($_FILES['ft_member_baru']['size'] > 2097152) {
                ?>
                  <script type="text/javascript">
                      setTimeout(function () {
                          swal({
                              title: "Oopss!",
                              text: "Ukuran foto terlalu besar! Max: 2Mb !",
                              type: "error",
                              showCancelButton: false
                          }, function () {
                              document.location = 'index?fold=ang&page=anggota_edit&id=<?php echo $id; ?>';
                          })
                      }, 200);
                  </script>
                <?php
              }
              if (unlink($target_dir . "" . $foto_lama)) {
                if (move_uploaded_file($_FILES['ft_member_baru']['tmp_name'], $target_file)) {
                    $update = oci_parse($koneksi, "UPDATE MEMBER SET
                                                  NM_MEMBER = '$nm',
                                                  ALAMAT_MEMBER = '$alamat',
                                                  TELP_MEMBER = '$telp',
                                                  PASS_MEMBER = '$pass',
                                                  JK_KELAMIN = '$jk',
                                                  ASK_MEMBER = '$ask',
                                                  FOTO_MEMBER = '$foto',
                                                  NOTIF_MEMBER = 2,
                                                  LOG = current_timestamp
                                                  WHERE ID_MEMBER = '$id'");
                    if (oci_execute($update)) {//proses update
                        ?>
                          <script type="text/javascript">
                              setTimeout(function () {
                                  swal({
                                      title: "Success!",
                                      text: "Data member berhasil diperbaharui",
                                      type: "success",
                                      showCancelButton: false
                                  }, function () {
                                      document.location = 'index?fold=ang&page=anggota';
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
                                    text: "Data member gagal diperbaharui !",
                                    type: "error",
                                    showCancelButton: false
                                }, function () {
                                    document.location = 'index?fold=ang&page=anggota_edit&id=<?php echo $id; ?>';
                                })
                            }, 200);
                        </script>
                      <?php
                    }
                } else {//gagal upload
                  ?>
                    <script type="text/javascript">
                        setTimeout(function () {
                            swal({
                                title: "Oopss!",
                                text: "Maaf, terjadi kesalahan unggah foto! Mohon untuk mengulanginya.",
                                type: "error",
                                showCancelButton: false
                            }, function () {
                                document.location = 'index?fold=ang&page=anggota_edit&id=<?php echo $id; ?>';
                            })
                        }, 200);
                    </script>
                  <?php
                }
              } else {//gagal menghapus link gambar lama
                  ?>
                  <script type="text/javascript">
                      setTimeout(function () {
                          swal({
                              title: "Oopss!",
                              text: "Maaf, terjadi kesalahan unggah foto! Mohon untuk mengulanginya.",
                              type: "error",
                              showCancelButton: false
                          }, function () {
                              document.location = 'index?fold=ang&page=anggota_edit&id=<?php echo $id; ?>';
                          })
                      }, 200);
                  </script>
                  <?php
              }
            }else{
              $foto = $id . "_" . $_FILES['ft_member_baru'] ['name']; // Mendapatkan nama gambar
              $type = $_FILES['ft_member_baru']['type'];
              $ukuran = $_FILES['ft_member_baru']['size'];
              $target_dir = "../assets/img/member/";
              $target_file = $target_dir . basename($foto);
              $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
              $check = @getimagesize($_FILES["ft_member_baru"]["tmp_name"]); //Cek type file
              if ($check === false) {
                ?>
                  <script type="text/javascript">
                      setTimeout(function () {
                          swal({
                              title: "Oopss!",
                              text: "File is not an image !",
                              type: "error",
                              showCancelButton: false
                          }, function () {
                              document.location = 'index?fold=ang&page=anggota_edit&id=<?php echo $id; ?>';
                          })
                      }, 200);
                  </script>
                <?php
              }
              // Check if file already exists
              if (file_exists($target_file)) {
                ?>
                  <script type="text/javascript">
                      setTimeout(function () {
                          swal({
                              title: "Oopss!",
                              text: "File already exists! Mohon untuk melakukan update!",
                              type: "error",
                              showCancelButton: false
                          }, function () {
                              document.location = 'index?fold=ang&page=anggota_edit&id=<?php echo $id; ?>';
                          })
                      }, 200);
                  </script>
                <?php
              }
              //cek ukuran gambar
              if ($_FILES['ft_member_baru']['size'] > 2097152) {
                ?>
                  <script type="text/javascript">
                      setTimeout(function () {
                          swal({
                              title: "Oopss!",
                              text: "Ukuran foto terlalu besar! Max: 2Mb !",
                              type: "error",
                              showCancelButton: false
                          }, function () {
                              document.location = 'index?fold=ang&page=anggota_edit&id=<?php echo $id; ?>';
                          })
                      }, 200);
                  </script>
                <?php
              }
              if (unlink($target_dir . "" . $foto_lama)) {
                if (move_uploaded_file($_FILES['ft_member_baru']['tmp_name'], $target_file)) {
                    $update = oci_parse($koneksi, "UPDATE MEMBER SET
                                                  NM_MEMBER = '$nm',
                                                  ALAMAT_MEMBER = '$alamat',
                                                  TELP_MEMBER = '$telp',
                                                  JK_KELAMIN = '$jk',
                                                  ASK_MEMBER = '$ask',
                                                  FOTO_MEMBER = '$foto',
                                                  NOTIF_MEMBER = 2,
                                                  LOG = current_timestamp
                                                  WHERE ID_MEMBER = '$id'");
                    if (oci_execute($update)) {//proses update
                        ?>
                          <script type="text/javascript">
                              setTimeout(function () {
                                  swal({
                                      title: "Success!",
                                      text: "Data member berhasil diperbaharui",
                                      type: "success",
                                      showCancelButton: false
                                  }, function () {
                                      document.location = 'index?fold=ang&page=anggota';
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
                                    text: "Data member gagal diperbaharui !",
                                    type: "error",
                                    showCancelButton: false
                                }, function () {
                                    document.location = 'index?fold=ang&page=anggota_edit&id=<?php echo $id; ?>';
                                })
                            }, 200);
                        </script>
                      <?php
                    }
                } else {//gagal upload
                  ?>
                    <script type="text/javascript">
                        setTimeout(function () {
                            swal({
                                title: "Oopss!",
                                text: "Maaf, terjadi kesalahan unggah foto! Mohon untuk mengulanginya.",
                                type: "error",
                                showCancelButton: false
                            }, function () {
                                document.location = 'index?fold=ang&page=anggota_edit&id=<?php echo $id; ?>';
                            })
                        }, 200);
                    </script>
                  <?php
                }
              } else {//gagal menghapus link gambar lama
                  ?>
                  <script type="text/javascript">
                      setTimeout(function () {
                          swal({
                              title: "Oopss!",
                              text: "Maaf, terjadi kesalahan unggah foto! Mohon untuk mengulanginya.",
                              type: "error",
                              showCancelButton: false
                          }, function () {
                              document.location = 'index?fold=ang&page=anggota_edit&id=<?php echo $id; ?>';
                          })
                      }, 200);
                  </script>
                  <?php
              }
            }
          }
        }else {
          //echo "Foto baru kosong, tapi foto lama tidak kosong <br> ATAU <br> Tidak terjadi perubahan terhadap foto";
          if (!empty($_POST['perpanjang'])) {//jika diperpanjang masa aktifnya
            $perpanjang = $_POST['perpanjang'];
            $i = 0;
            while ($i < 12) {
              $i++;
              if ($i == $perpanjang) {
                  $tgl_habis = date('m/d/Y', strtotime("+$i month"));
              }
            }
            //echo $tgl_habis;
            if (!empty($_POST['pass_member_baru'])) {
              $pass = md5($_POST['pass_member_baru']);
              $update = oci_parse($koneksi, "UPDATE MEMBER SET
                                            NM_MEMBER = '$nm',
                                            ALAMAT_MEMBER = '$alamat',
                                            TELP_MEMBER = '$telp',
                                            NONAKTIF_MEMBER = TO_DATE('$tgl_habis', 'MM/DD/YYYY'),
                                            PASS_MEMBER = '$pass',
                                            JK_KELAMIN = '$jk',
                                            ASK_MEMBER = '$ask',
                                            PERPANJANG = TO_DATE('mdY', 'MM/DD/YYYY'),
                                            NOTIF_MEMBER = 2,
                                            LOG = current_timestamp
                                            WHERE ID_MEMBER = '$id'");
              if (oci_execute($update)) {//proses update
                  ?>
                    <script type="text/javascript">
                        setTimeout(function () {
                            swal({
                                title: "Success!",
                                text: "Data member berhasil diperbaharui",
                                type: "success",
                                showCancelButton: false
                            }, function () {
                                document.location = 'index?fold=ang&page=anggota';
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
                              text: "Data member gagal diperbaharui !",
                              type: "error",
                              showCancelButton: false
                          }, function () {
                              document.location = 'index?fold=ang&page=anggota_edit&id=<?php echo $id; ?>';
                          })
                      }, 200);
                  </script>
                <?php
              }
            }else{
              $update = oci_parse($koneksi, "UPDATE MEMBER SET
                                            NM_MEMBER = '$nm',
                                            ALAMAT_MEMBER = '$alamat',
                                            TELP_MEMBER = '$telp',
                                            NONAKTIF_MEMBER = TO_DATE('$tgl_habis', 'MM/DD/YYYY'),
                                            JK_KELAMIN = '$jk',
                                            ASK_MEMBER = '$ask',
                                            PERPANJANG = SYSDATE,
                                            NOTIF_MEMBER = 2,
                                            LOG = current_timestamp
                                            WHERE ID_MEMBER = '$id'");
              if (oci_execute($update)) {//proses update
                  ?>
                    <script type="text/javascript">
                        setTimeout(function () {
                            swal({
                                title: "Success!",
                                text: "Data member berhasil diperbaharui",
                                type: "success",
                                showCancelButton: false
                            }, function () {
                                document.location = 'index?fold=ang&page=anggota';
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
                              text: "Data member gagal diperbaharui !",
                              type: "error",
                              showCancelButton: false
                          }, function () {
                              document.location = 'index?fold=ang&page=anggota_edit&id=<?php echo $id; ?>';
                          })
                      }, 200);
                  </script>
                <?php
              }
            }
          }else{//jika tidak perpanjang masa aktif
            if (!empty($_POST['pass_member_baru'])) {
              $pass = md5($_POST['pass_member_baru']);
              $update = oci_parse($koneksi, "UPDATE MEMBER SET
                                            NM_MEMBER = '$nm',
                                            ALAMAT_MEMBER = '$alamat',
                                            TELP_MEMBER = '$telp',
                                            PASS_MEMBER = '$pass',
                                            JK_KELAMIN = '$jk',
                                            ASK_MEMBER = '$ask',
                                            NOTIF_MEMBER = 2,
                                            LOG = current_timestamp
                                            WHERE ID_MEMBER = '$id'");
              if (oci_execute($update)) {//proses update
                  ?>
                    <script type="text/javascript">
                        setTimeout(function () {
                            swal({
                                title: "Success!",
                                text: "Data member berhasil diperbaharui",
                                type: "success",
                                showCancelButton: false
                            }, function () {
                                document.location = 'index?fold=ang&page=anggota';
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
                              text: "Data member gagal diperbaharui !",
                              type: "error",
                              showCancelButton: false
                          }, function () {
                              document.location = 'index?fold=ang&page=anggota_edit&id=<?php echo $id; ?>';
                          })
                      }, 200);
                  </script>
                <?php
              }
            }else{
              $update = oci_parse($koneksi, "UPDATE MEMBER SET
                                            NM_MEMBER = '$nm',
                                            ALAMAT_MEMBER = '$alamat',
                                            TELP_MEMBER = '$telp',
                                            JK_KELAMIN = '$jk',
                                            ASK_MEMBER = '$ask',
                                            NOTIF_MEMBER = 2,
                                            LOG = current_timestamp
                                            WHERE ID_MEMBER = '$id'");
              if (oci_execute($update)) {//proses update
                  ?>
                    <script type="text/javascript">
                        setTimeout(function () {
                            swal({
                                title: "Success!",
                                text: "Data member berhasil diperbaharui",
                                type: "success",
                                showCancelButton: false
                            }, function () {
                                document.location = 'index?fold=ang&page=anggota';
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
                              text: "Data member gagal diperbaharui !",
                              type: "error",
                              showCancelButton: false
                          }, function () {
                              document.location = 'index?fold=ang&page=anggota_edit&id=<?php echo $id; ?>';
                          })
                      }, 200);
                  </script>
                <?php
              }
            }
          }
        }

        //echo "ID:".$id."<br>Nama:".$nm."<br>Telp:".$telp."<br>Alamat:".$alamat."<br>Jenis Kelamin:".$jk."<br>Ask:".$ask."<br>lama perpanjang:".$perpanjang."<br>Tanggal stlah perpanjang:".$tgl_habis."<br>Pass:".$pass."<br>Level:".$level."<br>Foto:".$foto;
    }
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
