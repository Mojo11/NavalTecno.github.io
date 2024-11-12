<?php
include './include/config.php';
$crud = new Database();
$service_content = $crud->singleRead('sf_service_content', array(), 'id', '1'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Navaltecno | Services</title>
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
                        <h1>Our Services</h1>
                    </div>
                    <ul class="bread-crumb">
                        <li><a href="./">Home</a></li>
                        <li>Services</li>
                    </ul>
                </div>                    
            </div>
        </div>
    </section>
    <!-- Page Title -->

    <!-- Services Section Two -->
    <section class="services-section-two">
        <div class="auto-container">
            <div class="row align-items-center justify-content-between m-0" style="display: block;">
                <?php echo $service_content['content'];?>
            </div>
            <div class="row align-items-center justify-content-between m-0 mt-5">
                <div class="sec-title">
                    <h2>Our Services</h2>
                </div>
            </div>
            <div class="row">
                <?php if($services && count($services)>0){
                foreach($services as $service){
                ?>
                <div class="col-lg-4 col-md-6 service-block-two">
                    <div class="inner-box">
                        <div class="image">
                            <img src="upload/services/<?php echo $service['image'];?>" alt="">
                            <div class="overlay">
                                <div class="link-btn"><a href="service-details.php?id=<?php echo $service['id'];?>&service=<?php echo $service['name'];?>"><i class="flaticon-add"></i></a></div>                                
                            </div>
                        </div>
                        <div class="lower-content">
                            <h4><span><?php echo $service['name'];?></span></h4>
                            <div class="text"><?php echo $service['description'];?></div>
                            <div class="read-more-btn"><a href=".php?id=<?php echo $service['id'];?>&name=<?php echo $service['name'];?>">Read More</a></div>
                        </div>
                    </div>
                </div>
                <?php } }?>
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