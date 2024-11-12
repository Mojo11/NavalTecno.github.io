<?php
include './include/config.php';
$crud = new Database();
$sliders = $crud->read('sf_home_slider', array(), array(), '', '');
$projects = $crud->read('sf_projects', array(), array(), 'order by id desc', '8');
$statistics = $crud->read('sf_statistics', array(), array(), '', '');
$testimonials = $crud->read('sf_testimonials', array(), array(), '', '');
$products = $crud->read('sf_products', array(), array(), 'order by id desc', '12');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Navaltecno | Home</title>
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

    <!-- Bnner Section -->
    <?php if($sliders && count($sliders)>0){?>
    <section class="banner-section style-two">
        <div class="swiper-container banner-slider">
            <div class="swiper-wrapper">
                <?php foreach($sliders as $slider){?>
                <!-- Slide Item -->
                <div class="swiper-slide" style="background-image: url(upload/slider/<?php echo $slider['image'];?>);">
                    <div class="content-outer">
                        <div class="content-box">
                            <div class="inner">
                                <h1><?php echo $slider['heading'];?></h1>
                                <!--<div class="text">Eiusmod tempor incididunt labore dolore magna aliqua</div>-->
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <div class="banner-slider-nav">
            <div class="banner-slider-control banner-slider-button-prev"><span><i class="far fa-angle-left"></i></span></div>
            <div class="banner-slider-control banner-slider-button-next"><span><i class="far fa-angle-right"></i></span> </div>
        </div>
    </section>
    <?php } ?>
    <!-- End Bnner Section -->
    
    <!-- Services Section -->
    <?php //if($services && count($services)>0){?>
    <!--<section class="services-section">-->
    <!--    <div class="auto-container">-->
    <!--        <div class="sec-title text-center">-->
    <!--            <h2><strong>Our Services</strong></h2>-->
                <!--<div class="text">Incididunt ut labore et dolore magna aliqua quis nostrud exercitation ullamco laboris <br> nisi ut aliquip ex ea consequat duis aute irure dolor reprehenderit </div>-->
    <!--        </div>-->
    <!--        <div class="row">-->
    <!--            <?php //foreach($services as $service){?>-->
    <!--            <div class="col-lg-4 col-md-6 service-block-one">-->
    <!--                <div class="inner-box">-->
    <!--                    <div class="image">-->
    <!--                        <img src="upload/services/<?php //echo $service['image'];?>" alt="">-->
    <!--                        <div class="overlay">-->
    <!--                            <div class="text"><?php //echo $service['description'];?></div>-->
    <!--                            <a href="single_service.php?id=<?php //echo $service['id'];?>&service=<?php //echo $service['name'];?>" class="read-more-btn">Read More</a>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                    <h4><span><?php //echo $service['name'];?></span></h4>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <?php //} ?>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->
    <?php //} ?>
    
    <?php if($services && count($services)>0){?>
    <section class="services-section-two style-two">
        <div class="auto-container">
            <div class="sec-title text-center">
                <h2><strong>Our Services</strong></h2>
            </div>
            <div class="row">
                <div class="theme_carousel owl-theme owl-carousel" data-options='{"loop": true, "margin": 0, "autoheight":true, "lazyload":true, "nav": true, "dots": true, "autoplay": true, "autoplayTimeout": 6000, "smartSpeed": 300, "responsive":{ "0" :{ "items": "1" }, "600" :{ "items" : "2" }, "768" :{ "items" : "2" } , "992":{ "items" : "3" }, "1200":{ "items" : "3" }}}'>
                    <?php foreach($services as $service){?>
                    <div class="service-block-two col-12">
                        <div class="inner-box">
                            <div class="image">
                                <img src="upload/services/<?php echo $service['image'];?>" alt="">
                                <div class="overlay">
                                    <div class="link-btn"><a href="service-details.php?id=<?php echo $service['id'];?>&service=<?php echo $service['name'];?>"><i class="flaticon-add"></i></a></div>                                
                                </div>
                            </div>
                            <div class="lower-content">
                                <h4><span><a href="service-details.php?id=<?php echo $service['id'];?>&service=<?php echo $service['name'];?>"><?php echo $service['name'];?></a></span></h4>
                                <div class="text"><?php echo $service['description'];?></div>
                                <div class="read-more-btn"><a href="service-details.php?id=<?php echo $service['id'];?>&service=<?php echo $service['name'];?>">Read More</a></div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>
    
    <?php if($products && count($products)>0){?>
    <section class="shop-section style-two">
        <div class="auto-container">
            <div class="sec-title text-center">
                <h2><strong>Our Products</strong></h2>
            </div>
            <div class="row">
                <div class="theme_carousel owl-theme owl-carousel" data-options='{"loop": true, "margin": 0, "autoheight":true, "lazyload":true, "nav": true, "dots": true, "autoplay": true, "autoplayTimeout": 6000, "smartSpeed": 300, "responsive":{ "0" :{ "items": "1" }, "600" :{ "items" : "2" }, "768" :{ "items" : "2" } , "992":{ "items" : "3" }, "1200":{ "items" : "3" }}}'>
                    <?php foreach($products as $product){?>
                    <div class="service-block-two product-block col-lg-12">
                        <div class="inner-box" style="border: 1px solid #e3e3e3;">
                            <div class="image">
                                <a href="product-details.php?id=<?php echo $product['id'];?>"><img src="upload/products/<?php echo $product['image']."?".time();?>" alt=""></a>
                            </div>
                            <div class="lower-content">
                                <h4><span><a href="single_service.php?id=product-details.php?id=<?php echo $product['id'];?>"><?php echo $product['name']?></a></span></h4>
                                <div class="price"><b><?php if($product['amount']>0) echo "&#8377; ".$product['amount']?></b></div>
                                <div class="read-more-btn"><a href="single_service.php?id=product-details.php?id=<?php echo $product['id'];?>">Buy Now</a></div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>
    
    <!-- Products Section -->
    <?php if($products && count($products)>0){?>
    <!--<section class="shop-section">-->
    <!--    <div class="auto-container">-->
    <!--        <div class="sec-title text-center">-->
    <!--            <h2><strong>Our Products</strong></h2>-->
    <!--        </div>-->
    <!--        <div class="row">-->
    <!--            <?php //foreach($products as $product){?>-->
    <!--            <div class="col-lg-3 col-md-6 col-sm-6 shop-block">-->
    <!--                <div class="inner-box">-->
    <!--                    <div class="image"><a href="product-details.php?id=<?php //echo $product['id'];?>"><img src="upload/products/<?php //echo $product['image']."?".time();?>" alt=""></a></div>-->
    <!--                    <div class="content-upper">-->
    <!--                        <div class="price"><b><?php //echo "&#8377; ".$product['amount']?></b></div>-->
    <!--                        <h4><a href="product-details.php?id=<?php //echo $product['id'];?>"><?php //echo $product['name']?></a></h4>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <?php //}?>-->
    <!--        </div>-->
    <!--        <div class="row">-->
    <!--            <div class="col-lg-4 offset-lg-4">-->
    <!--                <div class="load-more text-center mt-40"><a href="products.php" class="theme-btn btn-style-one">View More</a></div>-->
    <!--            </div>-->
                
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->
    <?php } ?>
    
    <?php if($projects && count($projects)>0){?>
    <!-- Portfolio Section -->
    <section class="portfolio-section">
        <div class="auto-container">
            <div class="sec-title text-center">
                <h2><strong>Our Projects</strong></h2>
                <!--<div class="text">Incididunt ut labore et dolore magna aliqua quis nostrud exercitation ullamco laboris <br> nisi ut aliquip ex ea consequat duis aute irure dolor reprehenderit</div>-->
            </div>
            <div class="sortable-masonry">
                <div class="items-container row clearfix">
                    <?php foreach($projects as $project){?>
                    <div class="gallery-block masonry-item all cat-1 col-lg-3 col-md-6">
                        <div class="inner-box">
                            <div class="image">
                                <img src="upload/projects/<?php echo $project['image'];?>" alt="">
                            </div>
                            <div class="overlay-content">
                                <div class="border-one"></div>
                                <div class="border-two"></div>
                                <div>
                                    <h4><?php echo $project['name'];?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <div class="load-more text-center mt-40"><a href="our-projects.php" class="theme-btn btn-style-one">View More</a></div>
            </div>
        </div>
    </section>
    <?php } ?>
    
    <?php if($statistics && count($statistics)>0){?>
    <!-- Funfacts Section -->
    <section class="funfacts-section pt-0 style-two" style="padding: 20px 10px;margin-top: 20px;">
        <div class="auto-container">
            <div class="row">
                <?php foreach($statistics as $sta){ ?>
                <div class="column counter-column col-xl-3 col-lg-6 col-md-6">
                    <div class="inner wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="icon"><img src="upload/statistics/<?php echo $sta['image'];?>" alt=""></div>
                        <div class="content">
                            <div class="count-outer count-box">
                                <span class="count-text" data-speed="3000" data-stop="<?php echo $sta['name'];?>">0</span><span>+</span>
                            </div>
                            <div class="text"><?php echo $sta['heading'];?></div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <?php } ?>
    <?php if($testimonials && count($testimonials)>0){?>
    <section class="testimonials-section">
        <div class="auto-container">
            <div class="sec-title text-center">
                <h2><strong>What Client’s Saying</strong></h2>
                <!--<div class="text">Incididunt ut labore et dolore magna aliqua quis nostrud exercitation ullamco laboris <br> nisi ut aliquip ex ea consequat duis aute irure dolor reprehenderit</div>-->
            </div>
            <div class="theme_carousel owl-theme owl-carousel" data-options='{"loop": true, "margin": 0, "autoheight":true, "lazyload":true, "nav": true, "dots": true, "autoplay": true, "autoplayTimeout": 6000, "smartSpeed": 300, "responsive":{ "0" :{ "items": "1" }, "600" :{ "items" : "2" }, "768" :{ "items" : "2" } , "992":{ "items" : "3" }, "1200":{ "items" : "3" }}}'>
                <?php foreach($testimonials as $testimonial){?>
                <div class="testimonial-block">
                    <div class="inner-box">
                        <div class="author-box">
                            <div class="author-thumb"><img src="upload/testimonial/<?php echo $testimonial['image'];?>" alt=""></div>
                            <div class="content">
                                <h4><?php echo $testimonial['name'];?></h4>
                                <div class="designation"><?php echo $testimonial['position'];?></div>
                                <div class="rating">
                                    <span class="fas fa-star"></span>
                                    <span class="fas fa-star"></span>
                                    <span class="fas fa-star"></span>
                                    <span class="fas fa-star"></span>
                                    <span class="fas fa-star"></span>
                                </div>
                            </div>
                        </div>
                        <div class="text">"<?php echo $testimonial['description'];?>"</div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <?php } ?>
    
    <!-- CTA Section Two -->
    <!--<section class="cta-section-two">-->
    <!--    <div class="auto-container">-->
    <!--        <div class="wrapper-box">-->
    <!--            <h3>Need Roof Service & Maintenance Or Have <br> Any Questions? We are Ready to Help!</h3>-->
    <!--            <div class="link-btn"><a href="#" class="theme-btn btn-style-one style-three"><span>Learn More</span></a></div>-->
    <!--            <div class="icon"><img src="assets/images/icons/icon-12.png" alt=""></div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->

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













