<?php 
session_start();
include '../include/config.php';
include "template/chklogin.php";
$crud = new Database();
include '../include/constant.php';
$crud = new Database();
$sucess = '';
$delete = 0;
if (isset($_POST['edit_privacy_policy'])) {
    $data = array();
    $data['content']   =   addslashes($_POST['content']);
    $update = $crud->dbRowUpdate('sf_service_content', $data, 'id', '1');
    $sucess=4;
}
if($sucess==4){ ?>
    <script>alert('Section content updated successfully'); window.location.replace("service_content.php");</script>
<?php }

$section_content = $crud->singleRead('sf_service_content', array(), 'id', '1');
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <title><?php echo WEBNAME;?> Service</title>
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
        <link rel="stylesheet" href="dist/vendors/fontawesome/css/all.min.css"> 
        <!-- END: Page CSS-->

        <!-- START: Custom CSS-->
        <link rel="stylesheet" href="dist/css/main.css">
        <link rel="stylesheet" href="dist/css/custom.css?<?php echo time();?>">
        <!-- END: Custom CSS-->
        <script type="text/javascript" src="dist/ckeditor/ckeditor.js?<?php //echo time();?>"></script>
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
                            <div class="w-sm-100 mr-auto"><h4 class="mb-0">Manage Service</h4></div>

                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                <li class="breadcrumb-item">Home</li>
                                <li class="breadcrumb-item">Service</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- END: Breadcrumbs-->

                <!-- START: Card Data-->
                <div class="row">
                    <div class="col-lg-12 col-sm-12 mt-3">
                        <div class="card">
                            <div class="card-header">                               
                                <h4 class="card-title main_card_title">Service</h4>                                
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">                                           
                                        <div class="col-12">
                                            <form method="post" id="home_slider1" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label for="content">Content</label>
                                                    <textarea rows="6" class="form-control boxed" style="width: 90%;" id="content" name="content" required=""><?php if(isset($section_content) && count($section_content)>0) echo $section_content['content'];?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <input type="submit" class="btn btn-primary" name="edit_privacy_policy" value="Update Service Tab Content">
                                                    <!--<button type="reset" class="btn btn-outline-warning">Reset</button>-->
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Card DATA-->
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
        <script src="dist/js/app.js?t=<?php echo time();?>"></script>
        <script>
            CKEDITOR.replace('content', { height: 700 });
            
            CKEDITOR.config.extraPlugins='colorbutton';
        </script>
    </body>
    <!-- END: Body-->
</html>