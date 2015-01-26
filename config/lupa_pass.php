<?php
$koneksi = oci_connect("andriyan","andriyan","//localhost/XE");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>New Comando Fitness Center</title>

        <meta name="description" content="Common form elements and layouts" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <!--page specific plugin styles-->
        <link rel="shortcut icon" href="../../assets/img/favicon.png">

        <!--ace styles-->
        <script src="../assets/frontend/js/sweet-alert.js"></script>
        <link rel="stylesheet" href="../assets/frontend/css/sweet-alert.css" />

        <!--inline styles related to this page-->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    <body>
<?php
    if($_POST['lupa_kirim'] == 'Send'){
        $lupa_ortu = $_POST['lupa_ortu'];
        $lupa_nip = $_POST['lupa_nip'];

        $cek = oci_parse($koneksi, "SELECT * FROM PEGAWAI WHERE NIP_PEGAWAI = $lupa_nip");
        if(oci_execute($cek)){
            while($row = oci_fetch_array($cek)){
                $db_lupa = $row['ASK_PEGAWAI'];
                $db_nip = $row['NIP_PEGAWAI'];
            }
            if(($lupa_ortu == $db_lupa) && ($lupa_nip == $db_nip)){
                echo "sama";
            }else{
                ?>
                  <script type="text/javascript">
                    setTimeout(function() {
                        swal({
                              title:"Oopss!",   
                              text: "Maaf jawaban Anda salah! Silahkan mencoba kembali.",   
                              type: "warning",
                              showCancelButton: false
                        }, function(){
                            document.location = '../index';
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
                          text: "Maaf data Anda tidak ditemukan. Silahkan menghubungi Admin !",   
                          type: "warning",
                          showCancelButton: false
                    }, function(){
                        document.location = '../index';
                    })
                }, 200);
              </script>
            <?php
        }
    }
?>
    </body>
</html>