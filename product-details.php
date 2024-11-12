<?php
include './include/config.php';
$crud = new Database();
$product = $crud->singleRead('sf_products', array(), 'id', $_REQUEST['id']);
if($product && count($product)>0){ }
else {
    header("location:products.php");
}
$sucess = "0";
if(isset($_POST['send'])){
    $data = array();
    $data['name']       =   addslashes($_POST['name']);
    $data['email']      =   addslashes($_POST['email']);
    $data['subject']    =   $product['name'];
    $data['contact']    =   $_POST['contact'];
    $data['message']    =   $_POST['message'];
    $data['date']       =   date('Y-m-d H:i:s');
    if($crud->saveRecords('sf_contact', $data))
    {
        $sucess=1;
        $to = 'mkbkit@gmail.com';
        $subject = "New Inquiry";
        $message = "Dear Admin, <br><br>We a new inquiry<br><br>
        Please check with these details<br>
        NAME :- ".$_POST['name']." <br>
        EMAIL :- ".$_POST['email']." <br>
        PHONE :- ".$_POST['contact']." <br>
        PRODUCT :- ".$product['name']." <br>
        MESSAGE :- ".$_POST['message']." <br>
        <br><br> Kind Regards<br> Team Navaltecno";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: Navaltecno<no-reply@navaltecno.in>' . "\r\n";
        mail($to,$subject,$message,$headers);
        header('Location:thankyou.php');
    } else {
        $sucess=2;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Navaltecno | <?php echo $product['name'];?></title>
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
    <!-- Main Header -->
    <?php include "include/header.php";?>
    <!-- End Main Header -->
    <!-- Page Title -->
    <section class="page-title" style="background-image: url(upload/<?php echo $headerBanner['image'];?>);">
        <div class="auto-container">
            <div class="content-box">
                <div class="content-wrapper">
                    <div class="title">
                        <h1>Product Detail</h1>
                    </div>
                    <ul class="bread-crumb">
                        <li><a href="./">Home</a></li>
                        <li>Products</li>
                        <li><?php echo $product['name'];?></li>
                    </ul>
                </div>                    
            </div>
        </div>
    </section>
    <!-- Page Title -->
    
    <section class="shop-details">
        <div class="auto-container">
            <div class="product-details-content">
                <div class="row clearfix">
                    <div class="col-lg-6">
                        <div class="products-carousel">
                            <div class="single-product-view">
                                <div class="image">
                                    <img src="upload/products/<?php echo $product['image']."?".time();?>" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 content-column">
                        <div class="product-details">
                            <div class="title-box">
                                <h3><?php echo ucfirst($product['name']);?></h3>
                                <div class="customer-review clearfix">
                                    <ul class="rating-box clearfix">
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                    </ul>
                                    <a href="javascript:void(0)">[Customer Reviews]</a>
                                </div>
                                <h4><?php if($product['amount']>0) echo "&#8377; ".$product['amount']?></h4>
                            </div>
                            <div class="text">
                                <p><?php echo ucfirst($product['short_description']);?></p>
                            </div>
                            <div class="addto-cart-box">
                                <ul class="clearfix">
                                    <li class="cart-btn mt-2"><button type="button" data-toggle="modal" data-target="#myModalTest">Send Enquiry</button></li>
                                    <li class="cart-btn mt-2">
                                        <a href="https://web.whatsapp.com/send?phone=<?php echo $settings['whatsapp'];?>&text=Hi admin, I need this <?php echo $product['name'];?> product.&app_absent=0" target="_blank">
                                            <button type="button" style="background: #25D366;color: #fff;"><i class="fab fa-whatsapp"></i> Whatsapp</button>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-discription">
                <div class="tabs-box">
                    <div class="tab-btn-box">
                        <ul class="tab-btns tab-buttons centred clearfix">
                            <li class="tab-btn active-btn" data-tab="#tab-1">Description</li>
                            <!--<li class="tab-btn" data-tab="#tab-2">Reviews - 2</li>-->
                        </ul>
                    </div>
                    <div class="tabs-content">
                        <div class="tab active-tab" id="tab-1">
                            <div class="text">
                                <p><?php echo ucfirst($product['description']);?></p>
                            </div>
                        </div>
                        <!--<div class="tab" id="tab-2">-->
                        <!--    <div class="reviews-box">-->
                        <!--        <div class="row">-->
                        <!--            <div class="theme_carousel owl-theme owl-carousel owl-loaded owl-drag" data-options="{&quot;loop&quot;: true, &quot;center&quot;: false, &quot;margin&quot;: 0, &quot;autoheight&quot;:true, &quot;lazyload&quot;:true, &quot;nav&quot;: true, &quot;dots&quot;: true, &quot;autoplay&quot;: true, &quot;autoplayTimeout&quot;: 6000, &quot;smartSpeed&quot;: 1000, &quot;responsive&quot;:{ &quot;0&quot; :{ &quot;items&quot;: &quot;1&quot; }, &quot;600&quot; :{ &quot;items&quot; : &quot;1&quot; }, &quot;868&quot; :{ &quot;items&quot; : &quot;2&quot; } , &quot;992&quot;:{ &quot;items&quot; : &quot;2&quot; }, &quot;1200&quot;:{ &quot;items&quot; : &quot;2&quot; }}}">-->
                                        
                                        
                        <!--            <div class="owl-stage-outer"><div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s;"><div class="owl-item"><div class="col-lg-12 single-column">-->
                        <!--                    <div class="single-review-box">-->
                        <!--                        <figure class="image-box"><img src="assets/images/shop/image-10.jpg" alt=""></figure>-->
                        <!--                        <ul class="rating-box clearfix">-->
                        <!--                            <li><i class="fas fa-star"></i></li>-->
                        <!--                            <li><i class="fas fa-star"></i></li>-->
                        <!--                            <li><i class="fas fa-star"></i></li>-->
                        <!--                            <li><i class="fas fa-star"></i></li>-->
                        <!--                            <li><i class="fas fa-star"></i></li>-->
                        <!--                        </ul>-->
                        <!--                        <h5>Steven Rich, <span>November 10, 2020:</span></h5>-->
                        <!--                        <p>Indignation and dislike men who are so beguiled and demoralized by the charms of pleasure.</p>-->
                        <!--                    </div>-->
                        <!--                </div></div><div class="owl-item"><div class="col-lg-12 single-column">-->
                        <!--                    <div class="single-review-box">-->
                        <!--                        <figure class="image-box"><img src="assets/images/shop/image-11.jpg" alt=""></figure>-->
                        <!--                        <ul class="rating-box clearfix">-->
                        <!--                            <li><i class="fas fa-star"></i></li>-->
                        <!--                            <li><i class="fas fa-star"></i></li>-->
                        <!--                            <li><i class="fas fa-star"></i></li>-->
                        <!--                            <li><i class="fas fa-star"></i></li>-->
                        <!--                            <li><i class="fas fa-star"></i></li>-->
                        <!--                        </ul>-->
                        <!--                        <h5>William Cobus, <span>November 08, 2020:</span></h5>-->
                        <!--                        <p>We denounce with righteous indignation &amp; who are so beguiled demoralized.</p>-->
                        <!--                    </div>-->
                        <!--                </div></div></div></div><div class="owl-nav disabled"><button type="button" role="presentation" class="owl-prev"><span aria-label="Previous">‹</span></button><button type="button" role="presentation" class="owl-next"><span aria-label="Next">›</span></button></div><div class="owl-dots disabled"><button role="button" class="owl-dot active"><span></span></button></div></div>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--    <div class="comment-form">-->
                        <!--        <div class="title-box">-->
                        <!--            <h3>Add Your Comments</h3>-->
                        <!--            <p>Your email address will not be published. Required fields are marked *</p>-->
                        <!--        </div>-->
                        <!--        <form action="javascript:void(0)" method="post" class="default-form">-->
                        <!--            <div class="row clearfix">-->
                        <!--                <div class="col-lg-12 col-md-12 col-sm-12">-->
                        <!--                    <div class="form-group">-->
                        <!--                        <label>Comments</label>-->
                        <!--                        <textarea name="message"></textarea>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--                <div class="col-lg-4 col-md-6 col-sm-12">-->
                        <!--                    <div class="form-group">-->
                        <!--                        <label>Name*</label>-->
                        <!--                        <input type="text" name="name" required="">-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--                <div class="col-lg-4 col-md-6 col-sm-12">-->
                        <!--                    <div class="form-group">-->
                        <!--                        <label>Email*</label>-->
                        <!--                        <input type="email" name="email" required="">-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--                <div class="col-lg-4 col-md-12 col-sm-12">-->
                        <!--                    <div class="form-group">-->
                        <!--                        <label>Website</label>-->
                        <!--                        <input type="text" name="url" required="">-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--                <div class="col-lg-12 col-md-12 col-sm-12">-->
                        <!--                    <div class="rating-box clearfix">-->
                        <!--                        <p>Your Review</p>-->
                        <!--                        <ul class="rating clearfix">-->
                        <!--                            <li><i class="far fa-star"></i></li>-->
                        <!--                            <li><i class="far fa-star"></i></li>-->
                        <!--                            <li><i class="far fa-star"></i></li>-->
                        <!--                            <li><i class="far fa-star"></i></li>-->
                        <!--                            <li><i class="far fa-star"></i></li>-->
                        <!--                        </ul>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--                <div class="col-lg-12 col-md-12 col-sm-12">-->
                        <!--                    <div class="message-btn">-->
                        <!--                        <button type="submit" class="theme-btn"><span>Submit Now</span></button>-->
                        <!--                        <div class="custom-controls-stacked">-->
                        <!--                            <label class="custom-control material-checkbox">-->
                        <!--                                <input type="checkbox" class="material-control-input">-->
                        <!--                                <span class="material-control-indicator"></span>-->
                        <!--                                <span class="text">Save my name, email, and website in this browser for the next time I comment.</span>-->
                        <!--                            </label>-->
                        <!--                        </div>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--        </form>-->
                        <!--    </div>-->
                        <!--</div>-->
                    </div>
                </div>
            </div>
        </div>
    </section>
    
<div class="modal fade" id="myModalTest" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-full" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Send Enquiry</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body p-4" id="result">
                <div class="row">
                    <div class="col-sm-12 col-lg-12"> 
                        <form class="contact-form" id="contact-form1" method="post">
                            <div class="form-group">
                                <input placeholder="name" name="name" type="text" required="required">
                            </div>
                            <div class="form-group">
                                <input placeholder="Email" name="email" type="email" required="required">
                            </div>
                            <div class="form-group">
                                <input placeholder="Phone Number" name="contact" type="text" required="required">
                            </div>
                            <div class="form-group">
                                <textarea name="message" placeholder="Message" required="required" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <!--<button type="submit" class="theme-btn btn-style-one w-100"><span>Submit Now</span></button>-->
                                <input type="submit" class="theme-btn btn-style-one w-100" name="send" value="Send Message"></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
    
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
    .shop-details {
    position: relative;
    padding: 120px 0px 92px 0px;
}
.product-details-content {
    position: relative;
    display: block;
    margin-bottom: 96px;
}
.swiper-container {
    margin: 0 auto;
    position: relative;
    overflow: hidden;
    list-style: none;
    padding: 0;
    z-index: 1;
}
.swiper-wrapper {
    position: relative;
    width: 100%;
    height: 100%;
    z-index: 1;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-transition-property: -webkit-transform;
    transition-property: -webkit-transform;
    -o-transition-property: transform;
    transition-property: transform;
    transition-property: transform,-webkit-transform;
    -webkit-box-sizing: content-box;
    box-sizing: content-box;
}
.product-details-content .product-details {
    position: relative;
    margin-top: -7px;
}
.product-details-content .product-details .title-box {
    border-top: 6px solid #f7c212;
}

.product-details-content .product-details .title-box {
    position: relative;
    padding: 24px 30px;
    box-shadow: 0px 0px 50px 0px rgb(0 0 0 / 10%);
    margin-bottom: 35px;
}
.product-details-content .product-details .title-box h3 {
    position: relative;
    display: block;
    font-size: 30px;
    line-height: 30px;
    color: #212121;
    margin-bottom: 8px;
}
.product-details-content .product-details .title-box .customer-review {
    position: relative;
    margin-bottom: 1px;
}

.product-details-content .product-details .title-box .customer-review .rating-box {
    position: relative;
    float: left;
    margin-right: 10px;
    font-size: 14px;
    color: #f7c212;
}
.product-details-content .product-details .title-box .customer-review .rating-box li {
    position: relative;
    display: inline-block;
    font-size: 15px;
    font-weight: 700;
}
.product-details-content .product-details .title-box .customer-review a {
    position: relative;
    display: inline-block;
    float: left;
    font-size: 17px;
    color: #a3a3a3;
    font-weight: 700;
}
.product-details-content .product-details .title-box h4 {
    display: block;
    text-transform: uppercase;
    font-size: 30px;
    font-weight: 600;
    position: absolute;
    top: 38px;
    right: 30px;
}
.product-details-content .product-details 
{
    margin-bottom: 34px;
}

.text {
    font-size: 17px;
    line-height: 27px;
    font-weight: 400;
    color: #4a4a4a;
    margin: 0px 0px 15px;
}
.product-details-content .product-details .text .category {
    margin-bottom: 17px;
}
.product-details-content .product-details .text .category li {
    position: relative;
    display: inline-block;
    font-size: 17px;
    color: #a3a3a3;
    margin-right: 5px;
}
.product-details-content .product-details .text .category li a {
    display: inline-block;
}
.product-details-content .product-details .text .category li a:before {
    position: absolute;
    content: ',';
    top: 0;
    right: -4px;
}
.product-details-content .product-details .product-info {
    position: relative;
    display: block;
    padding: 10px 0px;
    border-top: 1px solid #e3e3e3;
    border-bottom: 1px solid #e3e3e3;
    margin-bottom: 25px;
}
.product-details-content .product-details .product-info li {
    position: relative;
    display: inline-block;
    float: left;
    width: 33.333%;
    font-size: 17px;
    line-height: 30px;
    color: #212121;
    padding-left: 25px;
    font-weight: 500;
}
.product-details-content .addto-cart-box {
    margin-bottom: 28px;
}
.product-details-content .product-details .addto-cart-box p {
    display: block;
    margin-bottom: 9px;
}
.addto-cart-box .clearfix li {
    position: relative;
    display: inline-block;
    float: left;
}
.addto-cart-box .cart-btn button {
    background: #f7c212;
}

.addto-cart-box .cart-btn button {
    position: relative;
    display: inline-block;
    font-size: 17px;
    line-height: 26px;
    color: #212121;
    font-weight: 500;
    text-align: center;
    padding: 17px 63px;
    cursor: pointer;
    margin-right: 20px;
    transition: all 500ms ease;
}
.product-details-content .product-details .share-option p {
    position: relative;
    display: block;
    color: #a3a3a3;
    margin-bottom: 9px;
    font-size: 17px;
}
.product-details-content .product-details .share-option .social-links li {
    position: relative;
    display: inline-block;
    float: left;
    margin-right: 10px;
}
.product-details-content .product-details .share-option .social-links li:first-child a {
    background: #3b5998;
}

.product-details-content .product-details .share-option .social-links li:first-child a {
}
.product-details-content .product-details .share-option .social-links li a {
    position: relative;
    display: inline-block;
    font-size: 15px;
    color: #ffffff;
    width: 50px;
    height: 50px;
    line-height: 50px;
    text-align: center;
}
.product-discription .tab-btn-box {
    position: relative;
    display: block;
    margin-bottom: 42px;
}
.product-discription .tab-btn-box:before {
    position: absolute;
    content: '';
    background: #e3e3e3;
    width: 100%;
    height: 1px;
    left: 0px;
    top: 28px;
}
.product-discription .tab-btn-box .tab-buttons {
    text-align: center;
}
.product-discription .tab-btn-box .tab-buttons li.active-btn {
    box-shadow: 0px 0px 50px 0px rgb(0 0 0 / 10%);
}
.product-discription .tab-btn-box .tab-buttons li {
    position: relative;
    display: inline-block;
    font-size: 20px;
    line-height: 26px;
    color: #212121;
    font-weight: 600;
    border: 1px solid #e3e3e3;
    background: #ffffff;
    text-align: center;
    padding: 13px 30px;
    cursor: pointer;
    margin: 0px 8px;
    transition: all 500ms ease;
    font-family: 'Mukta', sans-serif;
}
.tabs-box .tab.active-tab {
    transform: scale(1) translateY(0px);
}
.tabs-box .tab.active-tab {
    display: block;
}

.tabs-box .tab {
    transform: scale(0.9,0.9) translateY(0px);
}
.tabs-box .tab {
    position: relative;
    display: none;
    transition: all 900ms ease;
    -moz-transition: all 900ms ease;
    -webkit-transition: all 900ms ease;
    -ms-transition: all 900ms ease;
    -o-transition: all 900ms ease;
}
.product-discription .tabs-content .text p {
    position: relative;
    margin-bottom: 17px;
}
.product-discription .tabs-content .reviews-box {
    margin-bottom: 65px;
}
.product-discription .tabs-content .comment-form .title-box {
    position: relative;
    margin-bottom: 27px;
}
.product-discription .tabs-content .comment-form .title-box h3 {
    display: block;
    font-size: 24px;
    line-height: 30px;
    font-weight: 600;
    margin-bottom: 6px;
}
.product-discription .tabs-content .comment-form .form-group {
    margin-bottom: 22px;
}
.product-discription .tabs-content .comment-form .form-group label {
    position: relative;
    display: block;
    margin-bottom: 9px;
}
.comment-form .form-group textarea {
    height: 120px;
}
.comment-form .form-group input[type="text"]{
    border: 1px solid #e3e3e3;
}
.modal-backdrop.show {
    opacity: 0;
    z-index:0;
}
.modal{
    /*margin-top: 100px;*/
    z-index: 9999999999;
}
.contact-form .form-group input {height: 50px;}
</style>