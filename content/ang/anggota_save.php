<?php
	@session_start();
    if($_SESSION[ID_LEVEL]==1) {

        if($_POST['simpan'] == 'Simpan'){
            $cek_id = oci_parse($koneksi, "SELECT ID_MEMBER FROM MEMBER WHERE ID_MEMBER = '$_POST[id_member]'"); 
            oci_execute($cek_id);
            $db = oci_fetch_array($cek_id);
            if($db['ID_MEMBER'] == $_POST['id_member']){
              ?>
                <script type="text/javascript">
                  setTimeout(function() {
                      swal({
                            title:"Oopss!",   
                            text: "ID Member sama. Mohon untuk refresh halaman !",   
                            type: "error",
                            showCancelButton: false
                      }, function(){
                          document.location = 'index?fold=ang&page=anggota';
                      })
                  }, 200);
                </script>
              <?php
            }else{
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
            if(!empty($_FILES['ft_member'] ['name'])){
              $foto = $id."_".$_FILES['ft_member'] ['name']; // Mendapatkan nama gambar
              $type = $_FILES['ft_member']['type'];
              $ukuran = $_FILES['ft_member']['size'];
              $target_dir = "../assets/img/member/";
              $target_file = $target_dir . basename($foto);
              $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
              $check = @getimagesize($_FILES["ft_member"]["tmp_name"]);//Cek type file
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
              if($_FILES['ft_member']['size'] > 2097152){
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

              if(move_uploaded_file($_FILES["ft_member"]["tmp_name"], $target_file)){
                $insert = oci_parse($koneksi, "INSERT INTO MEMBER VALUES ('$id', '$nm', '$alamat', '$telp', TO_DATE('$date_dftr', 'MM/DD/YYYY'), TO_DATE('$tgl_habis', 'MM/DD/YYYY'), '$pass', '$jk', '$ask', '$foto', $level)");
                if(oci_execute($insert)){
                  ?>
                    <script type="text/javascript">
                      setTimeout(function() {
                          swal({
                                title:"Success!",   
                                text: "Data member berhasil disimpan. Mohon untuk cetak kartu member.",   
                                type: "success",
                                showCancelButton: false
                          }, function(){
                              document.location = 'index?fold=ang&page=anggota';
                          })
                      }, 200);
                    </script>
                  <?php
                }else{
                  ?>
                    <script type="text/javascript">
                      setTimeout(function() {
                          swal({
                                title:"Oopss!",   
                                text: "Data member gagal tersimpan. Mohon untuk diulang !",   
                                type: "error",
                                showCancelButton: false
                          }, function(){
                              document.location = 'index?fold=ang&page=anggota';
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
                            document.location = 'index?fold=user&page=iindex';
                        })
                    }, 200);
                  </script>
                <?php
              }
              
              //echo "ID:".$id."<br>Nama:".$nm."<br>Telp:".$telp."<br>Alamat:".$alamat."<br>Jenis Kelamin:".$jk."<br>Ask:".$ask."<br>Tanggal Daftar(save):".date('d/m/Y H:i:s')."<br>Tanggal Daftar(post):".$date_dftr."<br>Pass:".$pass."<br>Level:".$level."<br>Foto:".$foto."<br>1bulan kedepan:".$tgl_habis;
            }else{
              $insert = oci_parse($koneksi, "INSERT INTO MEMBER VALUES ('$id', '$nm', '$alamat', '$telp', TO_DATE('$date_dftr', 'mm/dd/yyyy hh24:mi:ss'), TO_DATE('$tgl_habis', 'mm/dd/yyyy hh24:mi:ss'), '$pass', '$jk', '$ask', '', $level)");
              if(oci_execute($insert)){
                ?>
                  <script type="text/javascript">
                    setTimeout(function() {
                        swal({
                              title:"Success!",   
                              text: "Data member berhasil disimpan. Mohon untuk cetak kartu member.",   
                              type: "success",
                              showCancelButton: false
                        }, function(){
                            document.location = 'index?fold=ang&page=anggota';
                        })
                    }, 200);
                  </script>
                <?php
              }else{
                ?>
                  <script type="text/javascript">
                    setTimeout(function() {
                        swal({
                              title:"Oopss!",   
                              text: "Biodata user gagal tersimpan !",   
                              type: "error",
                              showCancelButton: false
                        }, function(){
                            document.location = 'index?fold=ang&page=anggota';
                        })
                    }, 200);
                  </script>
                <?php
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