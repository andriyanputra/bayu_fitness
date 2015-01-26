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
            session_start(); //start session
            session_unset();
            session_destroy();
        ?>
          <script type="text/javascript">
            setTimeout(function() {
                swal({
                      title:"Good bye!",   
                      text: "Terima kasih atas kerja samanya",   
                      imageUrl: '../assets/img/bye.gif',
                      //imageSize: '215 x 215',
                      showCancelButton: false
                }, function(){
                    document.location = '../index';
                })
            }, 200);
          </script>
    </body>
</html>