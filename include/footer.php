<footer class="main-footer">
    <div class="auto-container">
        <!--Widgets Section-->
        <div class="widgets-section">
            <div class="row clearfix">
                <!--Column-->
                <div class="column col-lg-3 col-md-6">
                    <div class="widget about-widget">
                        <div class="logo"><a href="./"><img src="assets/images/<?php echo $settings['image'];?>" alt=""></a></div>
                        <div class="text"><?php echo $settings['footer_about'];?></div>
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
                
                <!--Column-->
                <div class="column col-lg-3 col-md-6">
                    <div class="widget links-widget">
                        <h3 class="widget-title">Our Services</h3>
                        <div class="widget-content">
                            <ul>
                                <?php 
                                if($services && count($services)>0){
                                    foreach($services as $service){
                                ?>
                                <li><a href="?id=<?php echo $service['id'];?>&service=<?php echo $service['name'];?>"><?php echo ucfirst($service['name']);?></a></li>
                                <?php } }?>
                            </ul>
                        </div>
                    </div>
                </div>

                <!--Column-->
                <div class="column col-lg-3 col-md-6">
                    <div class="widget links-widget">
                        <h3 class="widget-title">Quick links</h3>
                        <div class="widget-content">
                            <ul>
                                <li><a href="about.php">About us</a></li>
                                <li><a href="service.php">Our Services</a></li>
                                <li><a href="products.php">Our Projects</a></li>
                                <li><a href="our-projects.php">Our Products</a></li>
                                <li><a href="contact.php">Contact Us</a></li>
                            </ul>                                        
                        </div>
                    </div>
                </div>
                
                <!--Column-->
                <div class="column col-lg-3 col-md-6">
                    <div class="widget contact-widget">
                        <h3 class="widget-title">Get in touch</h3>
                        <div class="widget-content">
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
                </div>
                
            </div>
        </div>
    </div>
</footer>