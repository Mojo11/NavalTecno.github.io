<?php 
session_start();
include '../include/config.php';
include "template/chklogin.php";
$crud = new Database();
include '../include/constant.php';
if(isset($_POST['change_password'])){
    $seller = $crud->runSingleQuery("select * from sf_manage where id='".$_SESSION['ADMIN']['id']."' and email='".$_POST['email']."'");
    if($seller && count($seller)>0){
        if($_POST['password']==$_POST['repassword']){
            $crud->updateUsingQuery("update sf_manage set password='".md5($_POST['password'])."' where id='".$_SESSION['ADMIN']['id']."'");
            $sucess='1';
        } else {
            $passwordNotMatch='1';
        }
    } else {
            $emailError=1;
        }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <title>Change Password | <?php echo WEBNAME;?> </title>
        <link rel="shortcut icon" href="../assets/images/favicon.jpg" type="image/x-icon">
        <meta name="viewport" content="width=device-width,initial-scale=1"> 

        <!-- START: Template CSS-->
        <link rel="stylesheet" href="dist/vendors/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="dist/vendors/jquery-ui/jquery-ui.min.css">
        <link rel="stylesheet" href="dist/vendors/jquery-ui/jquery-ui.theme.min.css">
        <link rel="stylesheet" href="dist/vendors/simple-line-icons/css/simple-line-icons.css">        
        <link rel="stylesheet" href="dist/vendors/flags-icon/css/flag-icon.min.css"> 
        <!--<link rel="stylesheet" href="dist/vendors/flag-select/css/flags.css">-->
        <!-- END Template CSS-->      
        
        <!-- START: Page CSS-->
        <link rel="stylesheet" href="dist/vendors/datatable/css/dataTables.bootstrap4.min.css" />
        <link rel="stylesheet" href="dist/vendors/datatable/buttons/css/buttons.bootstrap4.min.css"/>
        <link rel="stylesheet" href="dist/vendors/fontawesome/css/all.min.css"> 
        <!-- END: Page CSS-->

        <!-- START: Custom CSS-->
        <link rel="stylesheet" href="dist/css/main.css">
        <link rel="stylesheet" href="dist/css/custom.css?<?php echo time();?>">
        <!-- END: Custom CSS-->
    </head>
    <!-- END Head-->

    <!-- START: Body-->    
    <body id="main-container" class="default horizontal-menu dark">
        <!-- START: Pre Loader-->
        <div class="se-pre-con">
            <img src="../assets/images/<?php echo $SETTING['image'];?>" alt="logo" width="200" class="img-fluid"/>
        </div>
        <!-- END: Pre Loader-->

        <!-- START: Header-->
        <?php include "template/header.php";?>
        <!-- END: Header-->

        <!-- START: Main Menu-->
        <?php include "template/sidebar.php";?>
        <!-- END: Main Menu-->

        <!-- START: Main Content-->
        <main>
            <div id="overlay" style="display:none;">
                <div class="spinner"></div>
                <br/>
                Please Wait...
            </div>
            <div class="container-fluid">
                <!-- START: Breadcrumbs-->
                <div class="row ">
                    <div class="col-12  align-self-center">
                        <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                            <div class="w-sm-100 mr-auto"><h4 class="mb-0">Change Password</h4></div>
                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                <li class="breadcrumb-item">Home</li>
                                <li class="breadcrumb-item">Change Password</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- END: Breadcrumbs-->

                <!-- START: Card Data-->
                <div class="row">
                    <div class="col-12 col-lg-5 mt-3">
                        <div class="card">
                            <div class="card-header">                               
                                <h4 class="card-title main_card_title">Change Password</h4>                                
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">                                           
                                        <div class="col-12">
                                            <?php if($emailError == 1){?>
                                                <b style="color:red;" class="font-w-600">Email not match, please try again.</b>
                                            <?php } else if($sucess == 1){ ?>
                                                    <b style="color:green;" class="font-w-600">Password Change Successfully.</b>
                                            <?php } if($passwordNotMatch==1){?>
                                                    <b style="color:red;" class="font-w-600">Password Not Match, please try again.</b>
                                            <?php } ?>
                                            <form method="post">
                                                <div class="form-group">
                                                    <label for="email">Email</label>                                                  
                                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email address" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="password">Password</label>                                                  
                                                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="repassword">Re Enter Password</label>                                                  
                                                    <input type="password" class="form-control" name="repassword" id="repassword" placeholder="Repassword" required>
                                                </div>
                                                <div class="form-group">                                                  
                                                    <input type="submit" name="change_password" value="Change Password" class="btn btn-primary">
                                                    <button type="reset" class="btn btn-outline-warning">Reset</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-7 mt-3" id=""></div>
                </div>
            </div>
        </main>
        <!-- END: Content-->

        <!-- START: Footer-->
        <?php include "template/footer.php";?>
        <!-- END: Footer-->

        <!-- START: Back to top-->
        <a href="#" class="scrollup text-center"> 
            <i class="icon-arrow-up"></i>
        </a>
        <!-- END: Back to top-->

        <!-- START: Template JS-->
        <script src="dist/vendors/jquery/jquery-3.3.1.min.js"></script>
        <script src="dist/vendors/jquery-ui/jquery-ui.min.js"></script>
        <script src="dist/vendors/moment/moment.js"></script>
        <script src="dist/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>    
        <script src="dist/vendors/slimscroll/jquery.slimscroll.min.js"></script>
        <script src="dist/vendors/flag-select/js/jquery.flagstrap.min.js"></script> 
        <!-- END: Template JS-->

        <!-- START: APP JS-->
        <script src="dist/js/app.js"></script>
    </body>
    <!-- END: Body-->
</html>