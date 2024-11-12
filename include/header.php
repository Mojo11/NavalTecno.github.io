<?php 
$settings = $crud->singleRead('sf_settings', array(), 'id', '1'); //echo "<pre>"; print_r($settings); echo "</pre>";
$services = $crud->read('sf_services', array(), array(), 'order by id desc', '10');
$headerBanner = $crud->singleRead('sf_header_banner', array(), 'id', '1');
?>
<script type="text/javascript">
            (function () {
                var options = {
                    whatsapp: "<?php echo $settings['whatsapp'];?>", // WhatsApp number
                    call_to_action: "Message us", // Call to action
                    button_color: "#f19600", // Color of button
                    position: "left", // Position may be 'right' or 'left'
                    order: "whatsapp", // Order of buttons
                };
                var proto = document.location.protocol, host = "getbutton.io", url = proto + "//static." + host;
                var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
                s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
                var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
            })();
        </script>
<header class="main-header header-style-two">
    <div class="header-top">
        <div class="auto-container">
            <div class="inner-container">
                <div class="left-column">
                    <div class="contact-info">
                        <ul>
                            <li>
                                <a href="tel:+91 <?php echo $settings['phone'];?>">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="phone-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-phone-alt fa-w-16 fa-fw fa-sm"><path fill="currentColor" d="M497.39 361.8l-112-48a24 24 0 0 0-28 6.9l-49.6 60.6A370.66 370.66 0 0 1 130.6 204.11l60.6-49.6a23.94 23.94 0 0 0 6.9-28l-48-112A24.16 24.16 0 0 0 122.6.61l-104 24A24 24 0 0 0 0 48c0 256.5 207.9 464 464 464a24 24 0 0 0 23.4-18.6l24-104a24.29 24.29 0 0 0-14.01-27.6z" class=""></path></svg>
                                     <?php echo '+91 '.$settings['phone'];?>
                                </a>
                            </li>
                            <li>
                                <a href="mailto:<?php echo $settings['email'];?>"><i class="far fa-envelope"></i><?php echo $settings['email'];?></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="right-column">
                    <div class="social-links">
                        <ul>
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
            </div>
        </div>
    </div>

    <!-- Header Upper -->
    <div class="header-upper style-two">
        <div class="auto-container">
            <div class="inner-container">
                <!--Logo-->
                <div class="logo-box">
                    <div class="logo"><a href="./"><img src="assets/images/<?php echo $settings['image'];?>" alt=""></a></div>
                </div>
                <div class="right-column">
                    <!--Nav Box-->
                    <div class="nav-outer">
                        <!--Mobile Navigation Toggler-->
                        <div class="mobile-nav-toggler"><img src="assets/images/icons/icon-bar.png" alt=""></div>

                        <!-- Main Menu -->
                        <nav class="main-menu navbar-expand-md navbar-light">
                            <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                                <ul class="navigation">
                                    <li><a href="./">Home</a></li>
                                    <li><a href="about.php">About Us</a></li>
                                    <li class="dropdown"><a href="service.php">Services</a>
                                        <ul>
                                            <?php if($services && count($services)>0){
                                            foreach($services as $service){
                                            ?>
                                            <!--<li><a href="single_service.php?id=<?php //echo $service['id'];?>&service=<?php //echo $service['name'];?>"><?php //echo $service['name']?></a></li>-->
                                            <li><a href="service-details.php?id=<?php echo $service['id'];?>&service=<?php echo $service['name'];?>"><?php echo $service['name']?></a></li>
                                            <?php } } ?>
                                        </ul>
                                    </li>
                                    <li><a href="products.php">Products</a></li>
                                    <li><a href="our-projects.php">Projects</a></li>
                                    <li><a href="contact.php">Contact</a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <div class="link-btn"><a href="contact.php" class="theme-btn btn-style-one get_a_quote">Get a Quote</a></div>
                </div>                        
            </div>
        </div>
    </div>
    <!--End Header Upper-->

    <!-- Sticky Header  -->
    <div class="sticky-header main-menu">
        <div class="auto-container">
            <div class="inner-container">
                <div class="nav-outer">
                    <!-- Main Menu -->
                    <nav class="main-menu">
                        <!--Keep This Empty / Menu will come through Javascript-->
                    </nav><!-- Main Menu End-->
                    <!-- Main Menu End-->
                    <div class="link-btn"><a href="#" class="theme-btn btn-style-one">Get a Quote</a></div>
                </div>
            </div>
        </div>
    </div><!-- End Sticky Menu -->

    <!-- Mobile Menu  -->
    <div class="mobile-menu">
        <div class="menu-backdrop"></div>
        <div class="close-btn"><span class="icon flaticon-remove"></span></div>
        
        <nav class="menu-box">
            <div class="nav-logo"><a href="./"><img src="assets/images/<?php echo $settings['image'];?>" alt="" title=""></a></div>
            <div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
			<!--Social Links-->
			<div class="social-links">
				<ul class="clearfix">
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
        </nav>
    </div><!-- End Mobile Menu -->

    <div class="nav-overlay">
        <div class="cursor"></div>
        <div class="cursor-follower"></div>
    </div>
</header>