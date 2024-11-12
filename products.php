<?php
include './include/config.php';
$crud = new Database();
$products = $crud->read('sf_products', array(), array(), 'order by id', '');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Our Products</title>
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
                        <h1>Our Products</h1>
                    </div>
                    <ul class="bread-crumb">
                        <li><a href="./">Home</a></li>
                        <li>Our Products</li>
                    </ul>
                </div>                    
            </div>
        </div>
    </section>
    <!-- Page Title -->

    <?php if($products && count($products)>0){?>
    <section class="shop-section">
        <div class="auto-container">
            <div class="row">
                <?php foreach($products as $product){?>
                <div class="col-lg-3 col-md-6 col-sm-6 shop-block">
                    <div class="inner-box">
                        <div class="image"><a href="product-details.php?id=<?php echo $product['id'];?>"><img src="upload/products/<?php echo $product['image']."?".time();?>" alt=""></a></div>
                        <div class="content-upper">
                            <div class="price"><b><?php if($product['amount']>0) echo "&#8377; ".$product['amount']?></b></div>
                            <h4><a href="product-details.php?id=<?php echo $product['id'];?>"><?php echo $product['name']?></a></h4>
                        </div>
                        <!--<div class="bottom-content">-->
                        <!--    <div class="cart"><i class="fa fa-eye" aria-hidden="true"></i> Quick View</div>-->
                        <!--    <div class="link"><a href="cart.html"><i class="fa fa-arrow-left"></i></a></div>-->
                        <!--</div>-->
                    </div>
                </div>
                <?php }?>
            </div>
        </div>
    </section>
    <?php } ?>

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
<style>
    .image img {height: 350px;}
    @media only screen and (min-device-width : 320px) and (max-device-width : 480px) {
        .image img {height: 200px;}
    }

</style>