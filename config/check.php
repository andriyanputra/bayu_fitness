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
            <link rel="shortcut icon" href="../assets/img/favicon.png">

            <!--ace styles-->
            <script src="../assets/frontend/js/sweet-alert.js"></script>
            <link rel="stylesheet" href="../assets/frontend/css/sweet-alert.css" />

            <!--inline styles related to this page-->
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        </head>
    <body>
<?php
@session_start();
if($_POST['signin'] == 'Sign In'){
  $nip = $_POST['nip'];
  $pass = md5($_POST['pass']);

  //Pengecekan jika yang login member
  if(!is_numeric($nip)){
    $cek = oci_parse($koneksi, "SELECT * FROM MEMBER INNER JOIN LEVEL_LOGIN ON (MEMBER.ID_LEVEL = LEVEL_LOGIN.ID_LEVEL)
            WHERE MEMBER.ID_MEMBER='$nip'");
    oci_execute($cek, OCI_DEFAULT);
    $row = oci_fetch_array($cek);
    $db_id = $row['ID_MEMBER']; $bln = date('m');
    $row[AKTIF_MEMBER]=strtotime($row[AKTIF_MEMBER]); $row[NONAKTIF_MEMBER]=strtotime($row[NONAKTIF_MEMBER]);
    if($bln > date('m', $row[NONAKTIF_MEMBER])){//jika lewat masa aktif, member tidak bisa login
      ?>
        <script type="text/javascript">
          setTimeout(function() {
              swal({
                    title:"Oopss!",   
                    text: "Maaf masa aktif member Anda jatuh tempo, silahkan perpanjang dan menghubingi Admin !",   
                    type: "warning",
                    showCancelButton: false
              }, function(){
                  document.location = '../index';
              })
          }, 200);
        </script>
      <?php
    }else{
      if($nip == $db_id){
        $db_password = $row['PASS_MEMBER']; //this will store that password on a variable
        $db_level = $row['ID_LEVEL'];
        //echo $nip."<br>".$db_level."<br> sukses";
        if ($pass == $db_password) {   
          //echo $db_nip."<br>".$nip;
          if($db_level == 3){
            $_SESSION["ID_MEMBER"]=$nip;
            $_SESSION["ID_LEVEL"]=$db_level;
            //$_SESSION["NIP_PEGAWAI"]=$nip;
            ?>
              <script type="text/javascript">
                setTimeout(function() {
                    swal({
                          title:"Good job!",   
                          text: "Selamat Datang di Sistem Informasi New Comando Fitness",   
                          type: "success",
                          showCancelButton: false
                    }, function(){
                        document.location = '../beranda/index?msg=log_in&id=<?php echo $_SESSION[ID_LEVEL]; ?>';
                    })
                }, 200);
              </script>
            <?php
          }
        } else if ($pass != $db_password) {
            ?>
              <script type="text/javascript">
                setTimeout(function() {
                    swal({
                          title:"Oopss!",   
                          text: "Maaf PASSWORD Anda salah. Silahkan untuk mengulangi !",   
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
  }
  //Pengecekan jika yang login pegawai
  else{
    $hasil = oci_parse($koneksi, "SELECT * FROM PEGAWAI INNER JOIN LEVEL_LOGIN ON (PEGAWAI.ID_LEVEL = LEVEL_LOGIN.ID_LEVEL)
            WHERE PEGAWAI.NIP_PEGAWAI=$nip");
    $data_2 = oci_execute($hasil, OCI_DEFAULT);
    $row_2 = oci_fetch_array($hasil);
    $db_nip2 = $row_2['NIP_PEGAWAI'];
    $db_status = $row_2['STATUS_PEGAWAI'];
    if($db_status == 0){
      ?>
        <script type="text/javascript">
          setTimeout(function() {
              swal({
                    title:"Oopss!",   
                    text: "Masa aktif Anda telah habis. Silahkan menghubungi Administrator sistem!",   
                    type: "warning",
                    showCancelButton: false
              }, function(){
                  document.location = '../index';
              })
          }, 200);
        </script>
      <?php
    }else{
      if($nip == $db_nip2){
        $db_password = $row_2['PASS_PEGAWAI']; //this will store that password on a variable
        $db_level = $row_2['ID_LEVEL'];
        //echo $nip."<br>".$db_level."<br> sukses";
        if ($pass == $db_password) {   
          //echo $db_nip."<br>".$nip;
          if($db_level == 1){
            $_SESSION["NIP_PEGAWAI"]=$nip;
            $_SESSION["ID_LEVEL"]=$db_level;
            //$_SESSION["NIP_PEGAWAI"]=$nip;
            ?>
              <script type="text/javascript">
                setTimeout(function() {
                    swal({
                          title:"Good job!",   
                          text: "Selamat Datang di Sistem Informasi New Comando Fitness",   
                          type: "success",
                          showCancelButton: false
                    }, function(){
                        document.location = '../beranda/index?msg=log_in&id=<?php echo $_SESSION[ID_LEVEL]; ?>';
                    })
                }, 200);
              </script>
            <?php
          }else{
            $_SESSION["NIP_PEGAWAI"]=$nip;
            $_SESSION["ID_LEVEL"]=$db_level;
            ?>
              <script type="text/javascript">
                setTimeout(function() {
                    swal({
                          title:"Good job!",   
                          text: "Selamat Datang di Sistem Informasi New Comando Fitness",   
                          type: "success",
                          showCancelButton: false
                    }, function(){
                        document.location = '../beranda/index?msg=log_in&id=<?php echo $_SESSION[ID_LEVEL]; ?>';
                    })
                }, 200);
              </script>
            <?php
          }
        } else if ($pass != $db_password) {
            ?>
              <script type="text/javascript">
                setTimeout(function() {
                    swal({
                          title:"Oopss!",   
                          text: "Maaf PASSWORD Anda salah. Silahkan untuk mengulangi !",   
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
  } 
}
?>
</body>
</html>