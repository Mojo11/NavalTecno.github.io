<?php
include './include/config.php';
$crud = new Database();
$sucess = "0";
if(isset($_POST['send'])){
    $data = array();
    $data['name']       =   addslashes($_POST['name']);
    $data['email']      =   addslashes($_POST['email']);
    $data['subject']    =   $_POST['service'];
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
        SERVICE :- ".$_POST['service']." <br>
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
<title>Contact Us</title>
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
                        <h1>Contact Us</h1>
                    </div>
                    <ul class="bread-crumb">
                        <li><a href="./">Home</a></li>
                        <li>Contact</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- Page Title -->

    <!-- Map Section -->
    <section class="map-section" style="margin-top: 50px;margin-bottom: 50px;">
        <div class="contact-map">
            <?php echo $settings['map'];?>
        </div>
    </section>
    
    <!-- Contact Section -->
    <section class="contact-section">
        <div class="auto-container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="contact-info-area mb-30">
                        <div class="sec-title mb-30">
                            <h2><strong>Contact Us</strong></h2>
                        </div>
                        <ul class="contact-info">
                            <li>
                                <div style="display: flex;">
                                    <div class="icon"><span class="flaticon-gps"></span></div>
                                    <div class="text"><?php echo $settings['address'];?></div>
                                </div>
                            </li>
                            <li>
                                <div class="icon"><span class="flaticon-phone"></span></div>
                                <div class="text">
                                    <a href="tel:+91 <?php echo $settings['phone'];?>"><?php echo "+91 ".$settings['phone'];?></a> 
                                    <?php if($settings['phone2']){?><br>
                                    <a href="tel:+91 <?php echo $settings['phone2'];?>">+91 <?php echo $settings['phone2'];?></a>
                                    <?php } ?>
                                </div>
                            </li>
                            <li>
                                <div class="icon"><span class="flaticon-comment"></span></div>
                                <div class="text">
                                    <a href="mailto:<?php echo $settings['email'];?>"><?php echo $settings['email'];?></a>
                                </div>
                            </li>
                        </ul>
                        <ul class="social-links">
                            <?php if($settings && $settings['facebook']){?>
                            <li><a href="<?php echo $settings['facebook'];?>" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                            <?php } if($settings && $settings['twitter']){?>
                            <li><a href="<?php echo $settings['twitter'];?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
                            <?php } if($settings && $settings['instagram']){?>
                            <li><a href="<?php echo $settings['instagram'];?>" target="_blank"><i class="fab fa-instagram"></i></a></li>
                            <?php } if($settings && $settings['linkedin']){?>
                            <li><a href="<?php echo $settings['linkedin'];?>" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                            <?php } if($settings && $settings['youtube']){?>
                            <li><a href="<?php echo $settings['youtube'];?>" target="_blank"><i class="fab fa-youtube"></i></a></li>
                            <?php }?>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="contact-form-area mb-30">
                        <!--<div class="sec-title mb-30">-->
                        <!--    <h2><strong>Get Free Consultation</strong></h2>-->
                        <!--</div>-->
                        <!--<form action="" class="contact-form" id="contact-form" method="post">-->
                        <!--    <div class="row">-->
                        <!--        <div class="form-group col-lg-6">-->
                        <!--            <input name="name" required="required" placeholder="name" type="text" class="form-control">-->
                        <!--        </div>-->
                        <!--        <div class="form-group col-lg-6">-->
                        <!--            <input name="email" required="required" placeholder="Email" type="email" class="form-control">-->
                        <!--        </div>-->
                        <!--        <div class="form-group col-lg-12">-->
                        <!--            <input name="contact" required="required" placeholder="Phone Number" type="text" class="form-control">-->
                        <!--        </div>-->
                        <!--        <div class="form-group col-lg-12">-->
                        <!--            <select class="form-control" name="service">-->
                        <!--                <option value="0">Select Service</option>-->
                        <!--                <option value="1">Roof Maintenance</option>-->
                        <!--            </select>-->
                        <!--        </div>-->
                        <!--        <div class="form-group col-lg-12">-->
                        <!--            <textarea name="message" placeholder="Message" required="required" class="form-control"></textarea>-->
                        <!--        </div>-->
                        <!--        <div class="form-group col-lg-12">-->
                        <!--            <input class="theme-btn btn-style-one w-100" type="submit" name="submit" value="Send Message">-->
                        <!--        </div>-->
                        <!--    </div>                                -->
                        <!--</form>-->
                        <form class="contact-form" id="contact-form1" method="post">
                                <div class="form-group">
                                    <input placeholder="Name" name="name" type="text" required="required">
                                </div>
                                <div class="form-group">
                                    <input placeholder="Email" name="email" type="email" required="required">
                                </div>
                                <div class="form-group">
                                    <input placeholder="Phone Number" name="contact" type="text" required="required">
                                </div>
                                <div class="form-group col-lg-12">
                                    <select class="form-control" name="service">
                                        <option value="0">Select Service</option>
                                        <?php if($services && count($services)>0){
                                            foreach($services as $service){
                                            ?>
                                        <option value="<?php echo $service['name']?>"><?php echo $service['name']?></option>
                                        <?php } } ?>
                                    </select>
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
<script src="assets/js/validate.js"></script>

<script src="assets/js/script.js"></script>

</body>
</html>