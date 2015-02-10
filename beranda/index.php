<?php
	include "../config/koneksi.php";
    include "../config/pukul.php";
    //include "../config/function.php";
    @session_start();
	if(isset($_SESSION['NIP_PEGAWAI']) && !empty($_SESSION['NIP_PEGAWAI'])) {
		$query = oci_parse($koneksi, "SELECT * FROM PEGAWAI INNER JOIN LEVEL_LOGIN ON (PEGAWAI.ID_LEVEL = LEVEL_LOGIN.ID_LEVEL)
										INNER JOIN JABATAN ON (PEGAWAI.ID_JABATAN = JABATAN.ID_JABATAN)
            							WHERE PEGAWAI.NIP_PEGAWAI = $_SESSION[NIP_PEGAWAI]");
  		$data = oci_execute($query);
  		$row = oci_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <title>New Comando Fitness Center</title>

        <meta name="description" content="Common form elements and layouts" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <!--page specific plugin styles-->
        <link rel="shortcut icon" href="../assets/img/favicon.png">
        <!--sweet alert-->
        <script src="../assets/frontend/js/sweet-alert.js"></script>
        <link rel="stylesheet" href="../assets/frontend/css/sweet-alert.css" />
        <!-- iCheck for checkboxes and radio inputs -->
        <link href="../assets/css/iCheck/all.css" rel="stylesheet" type="text/css" />
        <!--colorbox-->
        <link rel="stylesheet" href="../assets/css/colorbox/colorbox.css" type="text/css" />
        <!-- bootstrap 3.0.2 -->
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="../assets/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- daterange picker -->
        <link href="../assets/css/datepicker.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="../assets/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../assets/css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <style type="text/css" media="screen">
            .footer {
                position: relative;
                padding: 15px;
                background: #FFF;
                color: #000;
            }
        </style>
        
        <!--inline styles related to this page-->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="index" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                New Comando Fitness
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-toggle="tooltip" title="<?php echo $emp_[0]+$mem_[0]; ?> Pemberitahuan">
                                <i class="fa fa-warning"></i>
                                <span class="label label-danger"><?php echo $emp_[0]+$mem_[0]; ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">Kamu memiliki <?php echo $emp_[0]+$mem_[0]; ?> pemberitahuan</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                    <?php 
                                        while($emp = oci_fetch_array($notif_pegawai)){ 
                                    ?>
                                        <li><!-- start message -->
                                            <a href="index?fold=user&page=user_profile&id=<?php echo $emp[0]; ?>">
                                                <div class="pull-left">
                                                    <?php 
                                                        if(!empty($emp[3])){
                                                            echo "<img src='../assets/img/pegawai/$emp[3]' class='img-circle'/>";
                                                        }else{
                                                            echo "<img src='../assets/img/pegawai/empty.gif' class='img-circle'/>";
                                                        }
                                                    ?>
                                                </div>
                                                <h4> 
                                                    <?php 
                                                        $nama_ = $emp[1]; $nama = explode(' ',trim($nama_));
                                                        echo $nama[0]." ".$nama[1];
                                                    ?>
                                                    <small><i class="fa fa-clock-o"></i> <?php echo $emp[4]; ?></small>
                                                </h4>
                                                <p><?php 
                                                        if($emp[2] == 1){
                                                            echo "Telah terjadi penambahan data pegawai.";
                                                        }else{
                                                            echo "Telah terjadi perubahan data pegawai";
                                                        }
                                                    ?></p>
                                            </a>
                                        </li><!-- end message -->
                                    <?php 
                                        } 
                                    ?>
                                    <?php 
                                        while($mem = oci_fetch_array($notif_member)){ 
                                    ?>
                                        <li><!-- start message -->
                                            <a href="index?fold=ang&page=anggota_profile&id=<?php echo $mem[0]; ?>">
                                                <div class="pull-left">
                                                    <?php 
                                                        if(!empty($mem[3])){
                                                            echo "<img src='../assets/img/member/$mem[3]' class='img-circle'/>";
                                                        }else{
                                                            echo "<img src='../assets/img/pegawai/empty.gif' class='img-circle'/>";
                                                        }
                                                    ?>
                                                </div>
                                                <h4>
                                                    <?php 
                                                        $nama_ = $mem[1]; $nama = explode(' ',trim($nama_));
                                                        echo $nama[0]." ".$nama[1];
                                                    ?>
                                                    <small><i class="fa fa-clock-o"></i> <?php echo $mem[4]; ?></small>
                                                </h4>
                                                <p><?php 
                                                        if($mem[2] == 1){
                                                            echo "Telah terjadi penambahan member baru.";
                                                        }else{
                                                            echo "Telah terjadi perubahan data member.";
                                                        }
                                                    ?></p>
                                            </a>
                                        </li><!-- end message -->
                                    <?php 
                                        } 
                                    ?>
                                    </ul>
                                </li>
                                <li class="footer"><a href="index?fold=notif&page=index">Lihat Semua Pemberitahuan</a></li>
                            </ul>
                        </li>
                        
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo $row['NM_PEGAWAI']; ?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="../assets/img/pegawai/<?php echo $row['FOTO_PEGAWAI']; ?>" class="img-circle" alt="User Image" />
                                    <p>
                                        <?php echo $row['NM_PEGAWAI']." - ".$row['NM_JABATAN']; ?>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="index?fold=user&page=user_profile&id=<?php echo $row[NIP_PEGAWAI]; ?>" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="../config/signout" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="../assets/img/pegawai/<?php echo $row['FOTO_PEGAWAI']; ?>" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                        <?php $nama = $row['NM_PEGAWAI']; $first_nama = explode(' ',trim($nama)); ?>
                            <p>Hello, <?php echo $first_nama[0]; ?></p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form -->
                    <div align="center">
                        <script>
                            var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                            var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
                            var date = new Date();
                            var day = date.getDate();
                            var month = date.getMonth();
                            var thisDay = date.getDay(),
                                    thisDay = myDays[thisDay];
                            var yy = date.getYear();
                            var year = (yy < 1000) ? yy + 1900 : yy;
                            document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);
                        </script>
                        <p>Pukul <span id="clock"></span></p>
                    </div>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <?php include "../template/sidebar.php"; ?>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <?php 
                    if(!empty($_GET['fold']) && !empty($_GET['page'])){
                        if(file_exists("../content/$_GET[fold]/$_GET[page].php")){
                            include("../content/$_GET[fold]/$_GET[page].php");
                        }else{
                ?>
                            <script type="text/javascript">
                                setTimeout(function() {
                                    swal({
                                          title:"Oopss!",   
                                          text: "Maaf, halaman tidak tersedia !!.",   
                                          type: "warning",
                                          showCancelButton: false
                                    }, function(){
                                        document.location = 'index';
                                    })
                                }, 200);
                            </script>
                <?php
                        }
                    }else if(!empty($_GET['page'])){
                        if(file_exists("../content/$_GET[page].php")){
                            include("../content/$_GET[page].php");
                        }else{
                ?>
                          <script type="text/javascript">
                            setTimeout(function() {
                                swal({
                                      title:"Oopss!",   
                                      text: "Maaf, halaman tidak tersedia !!.",   
                                      type: "warning",
                                      showCancelButton: false
                                }, function(){
                                    document.location = 'index';
                                })
                            }, 200);
                          </script>
                            <!--<br>
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <p>Maaf, halaman tidak tersedia !!.</p>
                                    </div>
                                </div>
                            </div>-->
                <?php
                        }
                    }else{
                        include "../content/index.php"; 
                    }
                ?>
                <footer>
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6 text-center">
                            <div class="text-muted">
                                <small>Copyright 2014 | All Rights Reserved <cite title="Source Title">New Comando Fitness Center </cite>- Surabaya</small>
                            </div>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </footer>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <?php include "../template/footer.php"; ?>
    </body>
</html>
<?php 
	}else if(isset($_SESSION['ID_MEMBER']) && !empty($_SESSION['ID_MEMBER'])){
        $query = oci_parse($koneksi, "SELECT ID_MEMBER, NM_MEMBER, NONAKTIF_MEMBER - AKTIF_MEMBER as sel, 
                                    AKTIF_MEMBER, NONAKTIF_MEMBER, nonaktif_member-current_date as selisih, FOTO_MEMBER 
                                    FROM MEMBER, LEVEL_LOGIN, dual WHERE MEMBER.ID_LEVEL = LEVEL_LOGIN.ID_LEVEL AND MEMBER.ID_MEMBER = '$_SESSION[ID_MEMBER]'");
        $data = oci_execute($query);
        $row = oci_fetch_array($query);
        $aktif=strtotime($row[AKTIF_MEMBER]); $nonaktif=strtotime($row[NONAKTIF_MEMBER]);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <title>New Comando Fitness Center</title>

        <meta name="description" content="Common form elements and layouts" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <!--page specific plugin styles-->
        <link rel="shortcut icon" href="../assets/img/favicon.png">
        <!--sweet alert-->
        <script src="../assets/frontend/js/sweet-alert.js"></script>
        <link rel="stylesheet" href="../assets/frontend/css/sweet-alert.css" />
        <!-- iCheck for checkboxes and radio inputs -->
        <link href="../assets/css/iCheck/all.css" rel="stylesheet" type="text/css" />
        <!--colorbox-->
        <link rel="stylesheet" href="../assets/css/colorbox/colorbox.css" type="text/css" />
        <!-- bootstrap 3.0.2 -->
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="../assets/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- daterange picker -->
        <link href="../assets/css/datepicker.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="../assets/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../assets/css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <style type="text/css" media="screen">
            .footer {
                position: relative;
                padding: 15px;
                background: #FFF;
                color: #000;
            }
        </style>
        
        <!--inline styles related to this page-->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="index" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                New Comando Fitness
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope"></i>
                                <span class="label label-success">4</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 4 messages</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li><!-- start message -->
                                            <a href="#">
                                                <div class="pull-left">
                                                    <?php if(!empty($row['FOTO_MEMBER'])){ ?>
                                                    <img src="../assets/img/member/<?php echo $row['FOTO_MEMBER']; ?>" class="img-circle" alt="User Image"/>
                                                    <?php }else{ ?>
                                                    <img src="../assets/img/pegawai/empty.gif" class="img-circle" alt="User Image"/>
                                                    <?php } ?>
                                                </div>
                                                <h4>
                                                    Support Team
                                                    <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li><!-- end message -->
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="../assets/img/avatar2.png" class="img-circle" alt="user image"/>
                                                </div>
                                                <h4>
                                                    AdminLTE Design Team
                                                    <small><i class="fa fa-clock-o"></i> 2 hours</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="../assets/img/avatar.png" class="img-circle" alt="user image"/>
                                                </div>
                                                <h4>
                                                    Developers
                                                    <small><i class="fa fa-clock-o"></i> Today</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="../assets/img/avatar2.png" class="img-circle" alt="user image"/>
                                                </div>
                                                <h4>
                                                    Sales Department
                                                    <small><i class="fa fa-clock-o"></i> Yesterday</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="../assets/img/avatar.png" class="img-circle" alt="user image"/>
                                                </div>
                                                <h4>
                                                    Reviewers
                                                    <small><i class="fa fa-clock-o"></i> 2 days</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">See All Messages</a></li>
                            </ul>
                        </li>
                        
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <?php $nama = $row['NM_MEMBER']; $first_nama = explode(' ',trim($nama)); ?>
                                <span><?php echo $first_nama[0]." ".$first_nama[1]; ?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <?php if(!empty($row['FOTO_MEMBER'])){ ?>
                                    <img src="../assets/img/member/<?php echo $row['FOTO_MEMBER']; ?>" class="img-circle" alt="User Image"/>
                                    <?php }else{ ?>
                                    <img src="../assets/img/pegawai/empty.gif" class="img-circle" alt="User Image"/>
                                    <?php } ?>
                                    <p>
                                        <?php  echo $first_nama[0]." ".$first_nama[1]." - Member NCF"; ?>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="index?fold=ang&page=anggota_profile&id=<?php echo $row[ID_MEMBER]; ?>" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="../config/signout" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <?php if(!empty($row['FOTO_MEMBER'])){ ?>
                            <img src="../assets/img/member/<?php echo $row['FOTO_MEMBER']; ?>" class="img-circle" alt="User Image"/>
                            <?php }else{ ?>
                            <img src="../assets/img/pegawai/empty.gif" class="img-circle" alt="User Image"/>
                            <?php } ?>
                        </div>
                        <div class="pull-left info">
                            <p>Hello, <?php echo $first_nama[0]; ?></p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form -->
                    <div align="center">
                        <script>
                            var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                            var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
                            var date = new Date();
                            var day = date.getDate();
                            var month = date.getMonth();
                            var thisDay = date.getDay(),
                                    thisDay = myDays[thisDay];
                            var yy = date.getYear();
                            var year = (yy < 1000) ? yy + 1900 : yy;
                            document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);
                        </script>
                        <p>Pukul <span id="clock"></span></p>
                    </div>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <?php include "../template/sidebar.php"; ?>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <?php 
                    if(!empty($_GET['fold']) && !empty($_GET['page'])){
                        if(file_exists("../content/$_GET[fold]/$_GET[page].php")){
                            include("../content/$_GET[fold]/$_GET[page].php");
                        }else{
                ?>
                            <script type="text/javascript">
                                setTimeout(function() {
                                    swal({
                                          title:"Oopss!",   
                                          text: "Maaf, halaman tidak tersedia !!.",   
                                          type: "warning",
                                          showCancelButton: false
                                    }, function(){
                                        document.location = 'index';
                                    })
                                }, 200);
                            </script>
                <?php
                        }
                    }else if(!empty($_GET['page'])){
                        if(file_exists("../content/$_GET[page].php")){
                            include("../content/$_GET[page].php");
                        }else{
                ?>
                          <script type="text/javascript">
                            setTimeout(function() {
                                swal({
                                      title:"Oopss!",   
                                      text: "Maaf, halaman tidak tersedia !!.",   
                                      type: "warning",
                                      showCancelButton: false
                                }, function(){
                                    document.location = 'index';
                                })
                            }, 200);
                          </script>
                <?php
                        }
                    }else{
                        include "../content/index.php"; 
                    }
                ?>
                <footer>
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6 text-center">
                            <div class="text-muted">
                                <small>Copyright 2014 | All Rights Reserved <cite title="Source Title">New Comando Fitness Center </cite>- Surabaya</small>
                            </div>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </footer>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <?php include "../template/footer.php"; ?>
    </body>
</html>
<?php
    }else if(empty($_SESSION['NIP_PEGAWAI']) || empty($_SESSION['ID_MEMBER'])){
		header("Location: ../index");
	}
?>