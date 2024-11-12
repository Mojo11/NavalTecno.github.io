<?php
include './include/config.php';
$crud = new Database();
$service_details = $crud->singleRead('sf_manage_services', array(), 'id', $_REQUEST['id']);
//$servcieDesc = $crud->runSingleQuery("select * from sf_manage_services where id='".$_REQUEST['id']."'");
//echo "<pre>"; print_r($service_details); echo "</pre>";
if(isset($_POST['send'])){
    $data = array();
    $data['name']       =   addslashes($_POST['name']);
    $data['email']      =   addslashes($_POST['email']);
    $data['subject']    =   $_REQUEST['service'];
    $data['contact']    =   $_POST['phone'];
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
<title>Navaltecno | Service</title>
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
<?php if($service_details && count($service_details)>0){?>
    <!-- Page Title -->
    <section class="page-title" style="background-image: url(upload/<?php echo $headerBanner['image'];?>);">
        <div class="auto-container">
            <div class="content-box">
                <div class="content-wrapper">
                    <div class="title">
                        <h1><?php echo $_REQUEST['service'];?></h1>
                    </div>
                    <ul class="bread-crumb">
                        <li><a href="./">Home</a></li>
                        <li>Services</li>
                        <li><?php echo $_REQUEST['service'];?></li>
                    </ul>
                </div>                    
            </div>
        </div>
    </section>
    <!-- Page Title -->

    <!-- Service Details -->
    <section class="services-details">
        <div class="auto-container">
            <div class="row">
                <!--<div class="col-lg-8 content-side order-lg-2">-->
                <div class="col-lg-8 content-side">
                    <div class="image mb-40"><img src="upload/services/<?php echo $service_details['image'];?>" alt=""></div>
                    <h2><?php echo $_REQUEST['service'];?></h2>
                    <div class="text"><?php echo $service_details['description'];?></div>
                </div>
                <aside class="col-lg-4 sidebar">
                    <div class="service-sidebar">                     
                        <div class="widget contact-widget style-two">
                            <div class="widget-content">
                                <h3 class="widget-title">Get in touch</h3>
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
                            </div>
                        </div>
                        <div class="widget widget_contact-form">
                            <h3 class="widget-title">Request a Free Quote</h3>
                            <div class="text">Fill-in the form & send for a quick estimate</div>
                            <form class="" method="post">
                                <div class="form-group">
                                    <input placeholder="name" name="name" type="text" required="required">
                                </div>
                                <div class="form-group">
                                    <input placeholder="Email" name="email" type="email" required="required">
                                </div>
                                <div class="form-group">
                                    <input placeholder="Phone" name="phone" type="text" required="required" maxlength="10">
                                </div>
                                <div class="form-group">
                                    <textarea name="message" placeholder="Message" required="required" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <!--<button type="submit" class="theme-btn btn-style-one w-100"><span>Submit Now</span></button>-->
                                    <input type="submit" class="theme-btn btn-style-one w-100" name="send" value="Submit Now"></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>
<?php } else{ ?>
     <section class="services-details1">
        <div class="auto-container">
            <div class="row">
                <div class="col-lg-12 text-center" style="color:red;margin-top: 50px;margin-bottom: 50px;font-size: 30px;">No Record Found</div>
            </div>
        </div>
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