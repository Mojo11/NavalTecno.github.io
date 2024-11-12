<?php
session_start();
include "../include/config.php";
$crud = new Database();
include '../include/constant.php';
$error = $error4 = 0;
if(isset($_SESSION['ADMIN']) && !empty($_SESSION['ADMIN'])){
    header('location:./');
}
if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($crud->mysqli,$_POST['email']);
    $pass = mysqli_real_escape_string($crud->mysqli,$_POST['password']);
    $pass = md5($pass);
    $row = array();
    $row = $crud->fetechRecord('sf_manage', array(), array('email'=>$email,'password'=>$pass));
    //echo "<pre>"; print_r($row); exit();
    if($row && count($row) > 0) {
        $_SESSION['ADMIN'] = $row;
        header('location:./');
    } else {
        $error=1;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <title><?php echo WEBNAME;?> Admin</title>
        <link rel="shortcut icon" href="../assets/images/favicon.jpg" type="image/x-icon">
        <meta name="viewport" content="width=device-width,initial-scale=1"> 

        <!-- START: Template CSS-->
        <link rel="stylesheet" href="dist/vendors/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="dist/vendors/jquery-ui/jquery-ui.min.css">
        <link rel="stylesheet" href="dist/vendors/jquery-ui/jquery-ui.theme.min.css">
        <link rel="stylesheet" href="dist/vendors/simple-line-icons/css/simple-line-icons.css">        
        <link rel="stylesheet" href="dist/vendors/flags-icon/css/flag-icon.min.css"> 
        <link rel="stylesheet" href="dist/vendors/flag-select/css/flags.css">
        <!-- END Template CSS-->     

        <!-- START: Page CSS-->   
        <link rel="stylesheet" href="dist/vendors/social-button/bootstrap-social.css"/>   
        <!-- END: Page CSS-->

        <!-- START: Custom CSS-->
        <link rel="stylesheet" href="dist/css/main.css">
        <link rel="stylesheet" href="dist/css/custom.css?<?php echo time();?>">
        <!-- END: Custom CSS-->
    </head>
    <!-- END Head-->

    <!-- START: Body-->
    <body id="main-container" class="default dark">
        <div class="container">
            <div class="row vh_100 justify-content-between align-items-center">
                <div class="col-12">
                    <form action="" method="post" class="row row-eq-height lockscreen  mt-5 mb-5">
                        <div class="lock-image col-12 col-sm-5"></div>
                        <div class="login-form col-12 col-sm-7">
                            <?php if($error==1){?>
                            <p style="color: red;">Wrong id or password</p>
                            <?php } if($error==2){ ?>
                                <p style="color: red;">Your account is not activated yet</p>
                            <?php } if($error==3){ ?>
                                <p style="color: red;">Your account blocked by admin</p>
                            <?php }?>
                            <div class="form-group mb-3">
                                <label for="emailaddress">Email address</label>
                                <input class="form-control" type="email" name="email" id="emailaddress" required="" placeholder="Enter your email">
                            </div>
                            <div class="form-group mb-3">
                                <label for="password">Password</label>
                                <input class="form-control" type="password" name="password" required="" id="password" placeholder="Enter your password">
                            </div>
                            <!--<div class="form-group mb-3">-->
                            <!--    <div class="custom-control custom-checkbox">-->
                            <!--        <input type="checkbox" class="custom-control-input" id="checkbox-signin" checked="">-->
                            <!--        <label class="custom-control-label" for="checkbox-signin">Remember me</label>-->
                            <!--    </div>-->
                            <!--</div>-->
                            <div class="form-group mb-0">
                                <input type="submit" name="login" class="btn btn-primary" value="Log In">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- START: Template JS-->
        <script src="dist/vendors/jquery/jquery-3.3.1.min.js"></script>
        <script src="dist/vendors/jquery-ui/jquery-ui.min.js"></script>
        <script src="dist/vendors/moment/moment.js"></script>
        <script src="dist/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>    
        <script src="dist/vendors/slimscroll/jquery.slimscroll.min.js"></script>
        <script src="dist/vendors/flag-select/js/jquery.flagstrap.min.js"></script> 
        <!-- END: Template JS-->  
    </body>
    <!-- END: Body-->
</html>
