<?php
@session_start();
unset($_SESSION["NIP_PEGAWAI"]);
if (ISSET($_SESSION["NIP_PEGAWAI"]))
{
header ("location:index.php");
}
?>
<!doctype html>
<!--[if IE 7 ]>    <html lang="en-gb" class="isie ie7 oldie no-js"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en-gb" class="isie ie8 oldie no-js"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en-gb" class="isie ie9 no-js"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="en-gb" class="no-js">
<!--<![endif]-->
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<!--[if lt IE 9]> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <![endif]-->
<title>New Comando Fitness Center</title>
<meta name="description" content="">
<meta name="author" content="WebThemez">
<!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
<!--[if lte IE 8]>
		<script type="text/javascript" src="http://explorercanvas.googlecode.com/svn/trunk/excanvas.js"></script>
	<![endif]--> 
  <link rel="shortcut icon" href="assets/img/favicon.png"> 
<link rel="stylesheet" href="assets/frontend/css/sweet-alert.css" />
<link rel="stylesheet" href="assets/frontend/css/bootstrap.css" />
<link rel="stylesheet" href="assets/frontend/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="assets/frontend/css/isotope.css" media="screen" />
<link rel="stylesheet" href="assets/frontend/js/fancybox/jquery.fancybox.css" type="text/css" media="screen" />
<link href="assets/frontend/css/animate.css" rel="stylesheet" media="screen">
<link href="assets/frontend/flexslider/flexslider.css" rel="stylesheet" />
<link href="assets/frontend/js/owl-carousel/owl.carousel.css" rel="stylesheet">
<link rel="stylesheet" href="assets/frontend/css/styles.css" />
<!-- Font Awesome -->
<link href="assets/frontend/font/css/font-awesome.min.css" rel="stylesheet">
</head>

<body>
<header class="header">
  <div class="container">
    <nav class="navbar navbar-inverse" role="navigation">
      <div class="navbar-header">
        <button type="button" id="nav-toggle" class="navbar-toggle" data-toggle="collapse" data-target="#main-nav"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        <a href="#" class="navbar-brand scroll-top logo  animated bounceInLeft"><b><i>New Comando Fitness Center</i></b></a> </div>
      <!--/.navbar-header-->
      <div id="main-nav" class="collapse navbar-collapse">
        <ul class="nav navbar-nav" id="mainNav">
          <li class="active" id="firstLink"><a href="#home" class="scroll-link">Home</a></li>
          <li><a href="#services" class="scroll-link">Services</a></li>
          <li><a href="#aboutUs" class="scroll-link">About Us</a></li>
          <li><a href="#work" class="scroll-link">Gallery</a></li>
          <li><a href="#plans" class="scroll-link">Plans</a></li>
          <li><a href="#team" class="scroll-link">Team</a></li>
          <li><a href="#contactUs" class="scroll-link">Contact Us</a></li>
          <li><a href="#signIn" data-toggle="modal" role="button">Sign in</a></li>
        </ul>
      </div>
      <!--/.navbar-collapse--> 
    </nav>
    <!--/.navbar--> 
  </div>
  <!--/.container--> 
</header>
<!--/.header-->
<div id="#top"></div>
<section id="home">
  <div class="banner-container"> 
  <!-- Slider -->
        <div id="main-slider" class="flexslider">
            <ul class="slides">
              <li>
                <img src="assets/frontend/images/slides/1.jpg" alt="" />
                <div class="flex-caption">
                    <h3>Awesome Design</h3> 
					<p>Doloribus omnis minus temporibus perferendis ipsa architecto non, magni quam</p>  
                </div>
              </li>
              <li>
                <img src="assets/frontend/images/slides/2.jpg" alt="" />
                <div class="flex-caption">
                    <h3>Fully Responsive</h3> 
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elitincidunt eius magni provident.</p>  
                </div>
              </li>
              <li>
                <img src="assets/frontend/images/slides/3.jpg" alt="" />
                <div class="flex-caption">
                    <h3>Multi-purpose Theme</h3> 
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit donec mer lacinia.</p>  
                </div>
              </li>
            </ul>
        </div>
	<!-- end slider -->
  </div>
  <div class="container hero-text2">
  <h3>Lorem ipsum dolor sit amet, ea eum labitur scsstie percipitoleat<br/> fabulas complectitur deterruisset at pro</h3>
  </div>
</section>
<section id="services" class="page-section colord">
  <div class="container">
    <div class="row"> 
      <!-- item -->
      <div class="col-md-3 text-center"> <i class="circle"><img src="assets/frontend/images/clock.png" alt="" /></i>
        <h3>CARDIO</h3>
        <p>Nullam ac rhoncus sapien, non gravida purus. Alinon elit imperdiet congue. Integer elit imperdiet congue.</p>
      </div>
      <!-- end: --> 
      
      <!-- item -->
      <div class="col-md-3 text-center"><i class="circle"> <img src="assets/frontend/images/eye.png" alt="" /></i>
        <h3>SHOULDER</h3>
        <p>Nullam ac rhoncus sapien, non gravida purus. Alinon elit imperdiet congue. Integer elit imperdiet congue.</p>
      </div>
      <!-- end: --> 
      
      <!-- item -->
      <div class="col-md-3 text-center"><i class="circle"> <img src="assets/frontend/images/cart.png" alt="" /></i>
        <h3>AEROBICS</h3>
        <p>Nullam ac rhoncus sapien, non gravida purus. Alinon elit imperdiet congue. Integer ultricies sed elit impe.</p>
      </div>
      <!-- end: --> 
      
      <!-- item -->
      <div class="col-md-3 text-center"><i class="circle"> <img src="assets/frontend/images/heart.png" alt="" /></i>
        <h3>AB CHRUNCH</h3>
        <p>Nullam ac rhoncus sapien, non gravida purus. Alinon elit imperdiet congue. Integer elit imperdiet conempus.</p>
      </div>
      <!-- end:--> 
    </div>
  </div>
  <!--/.container--> 
</section>
<section id="aboutUs">
  <div class="container">
    <div class="heading text-center"> 
      <!-- Heading -->
      <h2>About Us</h2>
      <p>At lorem Ipsum available, but the majority have suffered alteration in some form by injected humour.</p>
    </div>
    <div class="row feature design">
      <div class="area1 columns right">
        <h3>Clean and Modern Design.</h3>
        <p>Lorem ipsum dolor sit amet, ea eum labitur scsstie percipitoleat fabulas complectitur deterruisset at pro. Odio quaeque reformidans est eu, expetendis intellegebat has ut, viderer invenire ut his. Has molestie percipit an. Falli volumus efficiantur sed id, ad vel noster propriae. Ius ut etiam vivendo, graeci iudicabit constituto at mea. No soleat fabulas prodesset vel, ut quo solum dicunt.
          Nec et jority have suffered alteration. </p>
        <p>Odio quaeque reformidans est eu, expetendis intellegebat has ut, viderer invenire ut his. Has molestie percipit an. Falli volumus efficiantur sed id, ad vel noster propriae. Ius ut etiam vivendo, graeci iudicabit constituto at mea. No soleat fabulas prodesset vel, ut quo solum dicunt.
          Nec et amet vidisse mentitumsstie percipitoleat fabulas. </p>
          <a href="#" class="btn">Read More</a> 
      </div>
      <div class="area2 columns feature-media left"> <img src="assets/frontend/images/feature-img-1.png" alt="" width="100%"> </div>
    </div>
    <div class="row dataTxt">	
						<div class="col-md-4 col-sm-6">
							<h4>What We Do?</h4>
							<p>Lorem ipsum dolor consectetursit amet, consectetur adipiscing elit consectetur euismod </p>
                            <p>Lorem ipsum dolor sit amet, ea eum labitur scsstie percipitoleat fabulas complectitur deterruisset at pro. Odio quaeque reformidans est eu, expetendis intellegebat has ut, viderer invenire ut his. Has molestie percipit an. Falli volumus efficiantur sed id, ad vel noster propriae. Ius ut etiam vivendo, graeci iudicabit constituto at mea.</p>
							
							<br>
						</div>
						
						<div class="col-md-4 col-sm-6">
							
							<h4>Why Choose Us?</h4>
							<p>Lorem ipsum dolor consectetursit amet, consectetur adipiscing elit consectetur euismod </p>
                            <ul class="listArrow">
								<li>Lorem ipsum dolor consectetursit amet, consectet</li>
								<li>Has molestie percipit an. Falli volumus efficiantur</li>
								<li>Falli volumus efficiantur sed id, ad vel noster</li>
								<li>Lorem ipsum dolor consectetursit amet, consectetur</li>
								<li>Ius ut etiam vivendo, graeci iudicabit constitutoa</li>
							</ul>
							<!-- Accordion starts -->
							</div>
						
						<div class="col-md-4 col-sm-6">
							<h4>Our Expertise</h4>
							<p>Lorem ipsum dolor consectetursit amet, consectetur adipiscing elit consectetur euismod.</p>
							<h6>Web Designing</h6>
							<div class="progress pb-sm"> 
							  <div class="progress-bar progress-bar-red" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
								 <span class="sr-only">40% Complete (success)</span>
							  </div>
							</div>
							<h6>Responsive Design</h6>
							<div class="progress pb-sm">
							  <div class="progress-bar progress-bar-red" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
								 <span class="sr-only">40% Complete (success)</span>
							  </div>
							</div>
							<h6>Browser Compatability</h6>
							<div class="progress pb-sm">
							  <div class="progress-bar progress-bar-red" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
								 <span class="sr-only">40% Complete (success)</span>
							  </div>
							</div>
						</div>
						
					</div>
  </div>
</section>
<section id="clients">
  <div id="demo" class="clients">
    <div class="container">
      <div class="heading text-center">
        <h2>Clients</h2>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="customNavigation"> <a class="prev"><i class="fa fa-chevron-circle-left"></i></a> <a class="next"><i class="fa fa-chevron-circle-right"></i></a> </div>
          <div id="owl-demo" class="owl-carousel">
            <div class="item"> <span class="helper"> <img src="assets/frontend/images/clients/client-1.png" alt="client" /></span> </div>
            <div class="item"> <span class="helper"> <img src="assets/frontend/images/clients/client-2.png" alt="client" /></span> </div>
            <div class="item"> <span class="helper"> <img src="assets/frontend/images/clients/client-3.png" alt="client" /></span> </div>
            <div class="item"> <span class="helper"> <img src="assets/frontend/images/clients/client-4.png" alt="client" /></span> </div>
            <div class="item"> <span class="helper"> <img src="assets/frontend/images/clients/client-5.png" alt="client" /></span> </div>
            <div class="item"> <span class="helper"> <img src="assets/frontend/images/clients/client-6.png" alt="client" /></span> </div>
            <div class="item"> <span class="helper"> <img src="assets/frontend/images/clients/client-7.png" alt="client" /></span> </div>
            <div class="item"> <span class="helper"> <img src="assets/frontend/images/clients/client-8.png" alt="client" /></span> </div>
            <div class="item"> <span class="helper"> <img src="assets/frontend/images/clients/client-9.png" alt="client" /></span> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section id="work" class="page-section page">
  <div class="container text-center">
    <div class="heading">
      <h2>Our Gallery</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa, alias enim placeat earum quos ab.</p>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div id="portfolio">
          <ul class="filters list-inline">
            <li> <a class="active" data-filter="*" href="#">All</a> </li>
            <li> <a data-filter=".photography" href="#">GYM</a> </li>
            <li> <a data-filter=".branding" href="#">AEROBICS</a> </li>
            <li> <a data-filter=".web" href="#">CARDIO</a> </li>
          </ul>
          <ul class="items list-unstyled clearfix animated fadeInRight showing" data-animation="fadeInRight" style="position: relative; height: 438px;">
            <li class="item branding" style="position: absolute; left: 0px; top: 0px;"> <a href="assets/frontend/images/work/1.jpg" class="fancybox"> <img src="assets/frontend/images/work/1.jpg" alt="">
              <div class="overlay"> <span>Etiam porta</span> </div>
              </a> </li>
            <li class="item photography" style="position: absolute; left: 292px; top: 0px;"> <a href="assets/frontend/images/work/2.jpg" class="fancybox"> <img src="assets/frontend/images/work/2.jpg" alt="">
              <div class="overlay"> <span>Lorem ipsum</span> </div>
              </a> </li>
            <li class="item branding" style="position: absolute; left: 585px; top: 0px;"> <a href="assets/frontend/images/work/3.jpg" class="fancybox"> <img src="assets/frontend/images/work/3.jpg" alt="">
              <div class="overlay"> <span>Vivamus quis</span> </div>
              </a> </li>
            <li class="item photography" style="position: absolute; left: 877px; top: 0px;"> <a href="assets/frontend/images/work/4.jpg" class="fancybox"> <img src="assets/frontend/images/work/4.jpg" alt="">
              <div class="overlay"> <span>Donec ac tellus</span> </div>
              </a> </li>
            <li class="item photography" style="position: absolute; left: 0px; top: 219px;"> <a href="assets/frontend/images/work/5.jpg" class="fancybox"> <img src="assets/frontend/images/work/5.jpg" alt="">
              <div class="overlay"> <span>Etiam volutpat</span> </div>
              </a> </li>
            <li class="item web" style="position: absolute; left: 292px; top: 219px;"> <a href="assets/frontend/images/work/6.jpg" class="fancybox"> <img src="assets/frontend/images/work/6.jpg" alt="">
              <div class="overlay"> <span>Donec congue </span> </div>
              </a> </li>
            <li class="item photography" style="position: absolute; left: 585px; top: 219px;"> <a href="assets/frontend/images/work/7.jpg" class="fancybox"> <img src="assets/frontend/images/work/7.jpg" alt="">
              <div class="overlay"> <span>Nullam a ullamcorper diam</span> </div>
              </a> </li>
            <li class="item web" style="position: absolute; left: 877px; top: 219px;"> <a href="assets/frontend/images/work/8.jpg" class="fancybox"> <img src="assets/frontend/images/work/8.jpg" alt="">
              <div class="overlay"> <span>Etiam consequat</span> </div>
              </a> </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
<section id="plans" class="page-section">
  <div class="container">
    <div class="heading text-center"> 
      <!-- Heading -->
      <h2>Our Plans</h2>
      <p>At lorem Ipsum available, but the majority have suffered alteration in some form by injected humour.</p>
    </div>
    <div class="row flat">
      <div class="col-lg-3 col-md-3 col-xs-12">
        <ul class="plan plan1">
          <li class="plan-name">Basic </li> 
          <li> <strong>400GB</strong> Bandwidth </li>
          <li> <strong>10</strong> Email Address </li>
          <li> <strong>Forum</strong> Support </li>
          <li class="plan-action"> <a href="#" class="btn btn-danger btn-lg">Signup</a> </li>
        </ul>
      </div>
      <div class="col-lg-3 col-md-3 col-xs-12">
        <ul class="plan plan2 featured">
          <li class="plan-name">Standard </li> 
          <li> <strong>400GB</strong> Bandwidth </li>
          <li> <strong>10</strong> Email Address </li>
          <li> <strong>Forum</strong> Support </li>
          <li class="plan-action"> <a href="#" class="btn btn-danger btn-lg">Signup</a> </li>
        </ul>
      </div>
      <div class="col-lg-3 col-md-3 col-xs-12">
        <ul class="plan plan3">
          <li class="plan-name">Advanced </li> 
          <li> <strong>1024GB</strong> Bandwidth </li>
          <li> <strong>Unlimited</strong> Email Address </li>
          <li> <strong>Forum</strong> Support </li>
          <li class="plan-action"> <a href="#" class="btn btn-danger btn-lg">Signup</a> </li>
        </ul>
      </div>
      <div class="col-lg-3 col-md-3 col-xs-12">
        <ul class="plan plan4">
          <li class="plan-name">Mighty </li> 
          <li> <strong>1024GB</strong> Bandwidth </li>
          <li> <strong>Unlimited</strong> Email Address </li>
          <li> <strong>Forum</strong> Support </li>
          <li class="plan-action"> <a href="#" class="btn btn-danger btn-lg">Signup</a> </li>
        </ul>
      </div>
    </div>
  </div>
</section>
<section id="team" class="page-section">
  <div class="container">
    <div class="heading text-center"> 
      <!-- Heading -->
      <h2>Team</h2>
      <p>At variations of passages of Lorem Ipsum available, but the majority have suffered alteration..</p>
    </div>
    <!-- Team Member's Details -->
    <div class="team-content">
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-6"> 
          <!-- Team Member -->
          <div class="team-member pDark"> 
            <!-- Image Hover Block -->
            <div class="member-img"> 
              <!-- Image  --> 
              <img class="img-responsive" src="assets/frontend/images/photo-1.jpg" alt=""> </div>
            <!-- Member Details -->
            <h4>John Doe</h4>
            <!-- Designation --> 
            <span class="pos">CEO</span>
            <div class="team-socials"> <a href="#"><i class="fa fa-facebook"></i></a> <a href="#"><i class="fa fa-google-plus"></i></a> <a href="#"><i class="fa fa-twitter"></i></a> </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-6"> 
          <!-- Team Member -->
          <div class="team-member pDark"> 
            <!-- Image Hover Block -->
            <div class="member-img"> 
              <!-- Image  --> 
              <img class="img-responsive" src="assets/frontend/images/photo-2.jpg" alt=""> </div>
            <!-- Member Details -->
            <h4>Larry Doe</h4>
            <!-- Designation --> 
            <span class="pos">Art Director</span>
            <div class="team-socials"> <a href="#"><i class="fa fa-facebook"></i></a> <a href="#"><i class="fa fa-google-plus"></i></a>  </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-6"> 
          <!-- Team Member -->
          <div class="team-member pDark"> 
            <!-- Image Hover Block -->
            <div class="member-img"> 
              <!-- Image  --> 
              <img class="img-responsive" src="assets/frontend/images/photo-3.jpg" alt=""> </div>
            <!-- Member Details -->
            <h4>Ranith Kays</h4>
            <!-- Designation --> 
            <span class="pos">Manager</span>
            <div class="team-socials"> <a href="#"><i class="fa fa-facebook"></i></a> <a href="#"><i class="fa fa-google-plus"></i></a> <a href="#"><i class="fa fa-twitter"></i></a> </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-6"> 
          <!-- Team Member -->
          <div class="team-member pDark"> 
            <!-- Image Hover Block -->
            <div class="member-img"> 
              <!-- Image  --> 
              <img class="img-responsive" src="assets/frontend/images/photo-4.jpg" alt=""> </div>
            <!-- Member Details -->
            <h4>Joan Ray</h4>
            <!-- Designation --> 
            <span class="pos">Creative</span>
            <div class="team-socials"> <a href="#"><i class="fa fa-facebook"></i></a> <a href="#"><i class="fa fa-google-plus"></i></a> <a href="#"><i class="fa fa-twitter"></i></a> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/.container--> 
</section>
<section id="contactUs" class="contact-parlex">
  <div class="parlex-back">
    <div class="container">
      <div class="row">
        <div class="heading text-center"> 
          <!-- Heading -->
          <h2>Contact Us</h2>
          <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered.</p>
        </div>
      </div>
      <div class="row mrgn30">
        <form method="post" action="" id="contactfrm" role="form">
          <div class="col-sm-12">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" title="Please enter your name (at least 2 characters)">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" title="Please enter a valid email address">
            </div>
            <div class="form-group">
              <label for="comments">Comments</label>
              <textarea name="comment" class="form-control" id="comments" cols="3" rows="5" placeholder="Enter your message…" title="Please enter your message (at least 10 characters)"></textarea>
              <button name="submit" type="submit" class="btn btn-lg btn-primary" id="submit">Submit</button>
            </div>
            <div class="result"></div>
          </div>
        </form>
      </div>
    </div>
    <!--/.container-->
  </div>
</section>

<div class="modal fade" id="signIn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title"><div align="center">Sistem Informasi New Comando Fitness</div></h4>
        </div>
        <form action="config/check.php" method="post">
          <div class="modal-body">
            <h2 class="form-signin-heading">Please sign in</h2>
            <input type="text" autocomplete="off" name="nip" class="form-control" placeholder="Nomor Induk Pegawai" required pattern="[0-9]{9}">
            <input type="password" autocomplete="off" name="pass" class="form-control" placeholder="Password" required >
            <h3>Lupa password ?</h3>
            <p>no worries, klik <a href="#lupaPass" id="lupa" data-toggle="modal" role="button">disini</a> untuk reset passwordmu.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <input type="submit" class="btn btn-primary" name="signin" value="Sign In">
            <!--<button type="button" class="btn btn-primary">Sign In</button>-->
          </div>
        </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal" id="lupaPass" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h3 class="modal-title">Lupa Password</h3>
        </div>
        <form action="config/lupa_pass.php" method="post">
          <div class="modal-body">
            <h4 class="form-signin-heading">Mohon untuk mengisi pertanyaan berikut</h4>
            <p>Siapakah nama orang tua (Laki-laki) Anda ?</p>
            <input type="text" autocomplete="on" name="lupa_ortu" class="form-control" required >
            <p>Nomor Induk Pegawai: </p>
            <input type="text" autocomplete="on" name="lupa_nip" class="form-control" required pattern="[0-9]{9}">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <input type="submit" class="btn btn-primary" name="lupa_kirim" value="Send">
            <!--<button type="button" class="btn btn-primary">Sign In</button>-->
          </div>
        </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--/.page-section-->
<section class="copyright">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 text-center"> Copyright 2014 | All Rights Reserved -- New Comando Fitness Center - Surabaya </div>
    </div>
    <!-- / .row --> 
  </div>
</section>
<a href="#top" class="topHome"><i class="fa fa-chevron-up fa-2x"></i></a> 

<!--[if lte IE 8]><script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script><![endif]--> 
<script src="assets/frontend/js/modernizr-latest.js"></script> 
<script src="assets/frontend/js/jquery-1.8.2.min.js" type="text/javascript"></script>
<script src="assets/frontend/js/bootstrap.min.js" type="text/javascript"></script> 
<script src="assets/frontend/js/modal.js" type="text/javascript"></script> 
<script src="assets/frontend/js/jquery.isotope.min.js" type="text/javascript"></script> 
<script src="assets/frontend/js/fancybox/jquery.fancybox.pack.js" type="text/javascript"></script> 
<script src="assets/frontend/js/jquery.nav.js" type="text/javascript"></script> 
<script src="assets/frontend/js/jquery.fittext.js"></script> 
<script src="assets/frontend/js/waypoints.js"></script> 
<script src="assets/frontend/flexslider/jquery.flexslider.js"></script>
<script src="assets/frontend/js/custom.js" type="text/javascript"></script> 
<script src="assets/frontend/js/owl-carousel/owl.carousel.js"></script>
<script src="assets/frontend/js/sweet-alert.js"></script>

<script type="text/javascript">
  function showDialog2() {
    $("#signIn").removeClass("fade").modal("hide");
    $("#dialog2").modal("show").addClass("fade");
  }

  $(function () {
     $('#signIn').modal('hide');
  });

  $("#lupa").on("click", function () {
    showDialog2();
  });

</script>
</body>
</html>
