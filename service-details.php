<?php
include './include/config.php';
$crud = new Database();
$servicesss = $crud->runQuery("select * from sf_manage_services where category='".$_REQUEST['id']."' and heading !='' order by id desc");
$servcieDesc = $crud->runSingleQuery("select * from sf_services where id='".$_REQUEST['id']."'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo $_REQUEST['service'];?> Service Details</title>
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
    <!--<div class="loader-wrap">-->
    <!--    <div class="layer layer-one"><span class="overlay"></span></div>-->
    <!--    <div class="layer layer-two"><span class="overlay"></span></div>        -->
    <!--    <div class="layer layer-three"><span class="overlay"></span></div>        -->
    <!--</div>-->

    <!-- Main Header -->
    <?php include "include/header.php";?>
    <!-- End Main Header -->

    <!-- Page Title -->
    <section class="page-title" style="background-image: url(upload/<?php echo $headerBanner['image'];?>);">
        <div class="auto-container">
            <div class="content-box">
                <div class="content-wrapper">
                    <div class="title">
                        <h1>Our Servcies</h1>
                    </div>
                    <ul class="bread-crumb">
                        <li><a href="./">Home</a></li>
                        <li><?php echo $_REQUEST['service'];?></li>
                    </ul>
                </div>                    
            </div>
        </div>
    </section>
    <!-- Page Title -->
    <section class="ptb50 main-cntnt mt-5 mb-5">
        <div class="container">
            <div class="row mb40">
                <div class="col-md-12">
                    <h1><span><?php echo $_REQUEST['service'];?></span></h1>
                </div>
            </div>
            <div class="row mb30">
                <div class="col-md-12">
                    <p class="mb10"><?php echo $servcieDesc['description'];?></p>
                </div>
            </div>
            <?php if($servicesss && count($servicesss)>0){?>
            <div class="row">
                <?php foreach($servicesss as $servi){ ?>
                <article class="col-md-4 text-center prd-sec">
                    <div class="thumbnail">
                        <div class="ci-img mb30"><a href="single_service.php?id=<?php echo $servi['id'];?>&service=<?php echo $_REQUEST['service'];?>"><img src="upload/services/<?php echo $servi['image'];?>" alt="<?php echo $servi['heading'];?>" class="img-responsive imagePrd"></a>
                        </div>
                        <div class="caption">
                            <h2><?php echo $servi['heading'];?></h2>
                            <a href="single_service.php?id=<?php echo $servi['id'];?>&service=<?php echo $servi['heading'];?>" class="btn btn-md btn-danger btn-blk btn-insde" role="button">View All Details</a>
                        </div>
                    </div>
                </article>
                <?php } ?>
            </div>
            <?php } ?>
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
