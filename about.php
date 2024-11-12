<?php
include './include/config.php';
$crud = new Database();
$aboutUs = $crud->singleRead('sf_about_us', array(), 'id', '1');
//echo "<pre>"; print_r($aboutUs); echo "</pre>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>About Us</title>
<!-- Stylesheets -->
<link href="assets/css/bootstrap.css" rel="stylesheet">
<link href="assets/css/style.css" rel="stylesheet">
<!-- Responsive File -->
<link href="assets/css/responsive.css" rel="stylesheet">
<!-- Color File -->
<link href="assets/css/color.css?<?php echo time();?>" rel="stylesheet">
<link href="assets/css/custom.css?<?php echo time();?>" rel="stylesheet">

<link rel="shortcut icon" href="assets/images/favicon.jpg" type="image/x-icon">
<link rel="icon" href="assets/images/favicon.jpg" type="image/x-icon">

<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
<!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->
</head>

<body>

<div class="page-wrapper">
    <!-- Preloader -->
    <div class="loader-wrap">
        <div class="layer layer-one"><span class="overlay"></span></div>
        <div class="layer layer-two"><span class="overlay"></span></div>        
        <div class="layer layer-three"><span class="overlay"></span></div>        
    </div>

    <!-- Main Header -->
    <?php include "include/header.php";?>
    <!-- End Main Header -->

    <!-- Page Title -->
    <section class="page-title" style="background-image: url(upload/<?php echo $headerBanner['image'];?>);">
        <div class="auto-container">
            <div class="content-box">
                <div class="content-wrapper">
                    <div class="title">
                        <h1>About Us</h1>
                    </div>
                    <ul class="bread-crumb">
                        <li><a href="./">Home</a></li>
                        <li>About Us</li>
                    </ul>
                </div>                    
            </div>
        </div>
    </section>
    <!-- Page Title -->

    <!-- About Section -->
    <section class="about-section-two">
        <div class="auto-container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="content-block">
                        <div class="sec-title">
                            <h2><strong><?php echo $aboutUs['heading'];?></strong></h2>
                        </div>
                        <div class="text">
                            <?php echo $aboutUs['about_us'];?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section Two -->
    <section class="features-section-two">
        <div class="auto-container">
            <div class="single-block">
                <div class="row">
                    <div class="col-lg-6 image-column">
                        <div class="image"><img src="upload/<?php echo $aboutUs['our_mission_icon'];?>" alt=""></div>
                    </div>
                    <div class="col-lg-6">
                        <div class="content">
                            <div class="sec-title">
                                <h2><strong><?php echo $aboutUs['our_mission_heading'];?></strong></h2>
                                <div class="text">
                                   <?php echo $aboutUs['our_mission'];?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="single-block">
                <div class="row">
                    <div class="col-lg-6 image-column">
                        <div class="image"><img src="upload/<?php echo $aboutUs['our_vision_icon'];?>" alt=""></div>
                    </div>
                    <div class="col-lg-6">
                        <div class="content">
                            <div class="sec-title">
                                <h2><strong><?php echo $aboutUs['our_vision_heading'];?></strong></h2>
                                <div class="text">
                                    <?php echo $aboutUs['our_vision'];?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>                
                
        </div>
    </section>
    
    <section class="about-section-two">
        <div class="auto-container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="content-block">
                        <div class="sec-title">
                            <h2><strong><?php echo $aboutUs['heading2'];?></strong></h2>
                        </div>
                        <div class="text">
                            <?php echo $aboutUs['description'];?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Footer -->
    <?php include "include/footer.php";?>
	
</div>
<!--End pagewrapper-->

<!--Scroll to top-->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="flaticon-right-arrow"></span></div>

<script src="assets/js/jquery.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/bootstrap-select.min.js"></script>
<script src="assets/js/jquery.fancybox.js"></script>
<script src="assets/js/isotope.js"></script>
<script src="assets/js/owl.js"></script>
<script src="assets/js/appear.js"></script>
<script src="assets/js/wow.js"></script>
<script src="assets/js/lazyload.js"></script>
<script src="assets/js/scrollbar.js"></script>
<script src="assets/js/TweenMax.min.js"></script>
<script src="assets/js/swiper.min.js"></script>

<script src="assets/js/script.js"></script>


</body>
</html>