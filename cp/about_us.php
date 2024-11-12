<?php 
session_start();
include '../include/config.php';
include "template/chklogin.php";
$crud = new Database();
include '../include/constant.php';
$sucess = '';
$delete = 0;
if (isset($_POST['edit_about_us'])) {
    $data = array();
    $data['heading']  =   addslashes($_POST['heading']);
    $data['about_us']   =   addslashes($_POST['about_us']);
    $data['heading2'] =   addslashes($_POST['heading2']);
    $data['description'] =   addslashes($_POST['description']);
    $update = $crud->dbRowUpdate('sf_about_us', $data, 'id', '1');
    $sucess=4;
}

if (isset($_POST['edit_our_mission'])) {
    if ($_FILES['our_mission_icon']['size'] == 0) {
        $data = array();
        $data['our_mission_heading']  =   addslashes($_POST['our_mission_heading']);
        $data['our_mission']  =  addslashes($_POST['our_mission']);
        $update = $crud->dbRowUpdate('sf_about_us', $data, 'id', '1');
        $sucess=4;
    } 
    else {
            $errors = '';
            $extension = array("jpeg", "jpg", "png", "gif",'JPEG','JPG','PNG','GIF');
            $UploadFolder = "../upload";
            $temp = $_FILES["our_mission_icon"]["tmp_name"];
            $name = $_FILES["our_mission_icon"]["name"];
            $name = uniqid() . $name;
            $ext = pathinfo($name, PATHINFO_EXTENSION);
            if (in_array($ext, $extension) == TRUE) {
                if (move_uploaded_file($temp, $UploadFolder . "/" . $name)) {
                    $data = array();
                    $data['our_mission_heading']  =   addslashes($_POST['our_mission_heading']);
                    $data['our_mission']  =  addslashes($_POST['our_mission']);
                    $data['our_mission_icon']  =  $name;
                    $update = $crud->dbRowUpdate('sf_about_us', $data, 'id', '1');
                    $sucess=4;
                }
                else {
                    // $error = "Unable to upload image";
                    $sucess=2;
                }
            } else {
                //$error = "Image extension not allowed, please upload in JPEG, JPG, PNG, GIF";
                $sucess=3;
        }
    }
}

if (isset($_POST['edit_our_vision'])) {
    if ($_FILES['our_vision_icon']['size'] == 0) {
        $data = array();
        $data['our_vision_heading']  =   addslashes($_POST['our_vision_heading']);
        $data['our_vision']  =  addslashes($_POST['our_vision']);
        $update = $crud->dbRowUpdate('sf_about_us', $data, 'id', '1');
        $sucess=4;
    } 
    else {
            $errors = '';
            $extension = array("jpeg", "jpg", "png", "gif",'JPEG','JPG','PNG','GIF');
            $UploadFolder = "../upload";
            $temp = $_FILES["our_vision_icon"]["tmp_name"];
            $name = $_FILES["our_vision_icon"]["name"];
            $name = uniqid() . $name;
            $ext = pathinfo($name, PATHINFO_EXTENSION);
            if (in_array($ext, $extension) == TRUE) {
                if (move_uploaded_file($temp, $UploadFolder . "/" . $name)) {
                    $data = array();
                    $data['our_vision_heading']  =   addslashes($_POST['our_vision_heading']);
                    $data['our_vision']  =  addslashes($_POST['our_vision']);
                    $data['our_vision_icon']  =  $name;
                    $update = $crud->dbRowUpdate('sf_about_us', $data, 'id', '1');
                    $sucess=4;
                }
                else {
                    // $error = "Unable to upload image";
                    $sucess=2;
                }
            } else {
                //$error = "Image extension not allowed, please upload in JPEG, JPG, PNG, GIF";
                $sucess=3;
        }
    }
}

if($sucess==1){ ?>
    <script>alert('Content added successfully'); window.location.replace("about_us.php");</script>
<?php } else if($sucess==2){?>
    <script>alert('Unable to upload image');</script>
<?php } else if($sucess==3){?>
    <script>alert('Image extension not allowed, please upload in JPEG, JPG, PNG, GIF');</script>
<?php } else if($sucess==4){ ?>
    <script>alert('Content updated successfully'); window.location.replace("about_us.php");</script>
<?php }


$our_school = $crud->singleRead('sf_about_us', array(), 'id', '1');
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <title><?php echo WEBNAME;?> About Us</title>
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
        <script type="text/javascript" src="dist/ckeditor/ckeditor.js?<?php echo time();?>"></script>
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
                            <div class="w-sm-100 mr-auto"><h4 class="mb-0">About Us</h4></div>

                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                <li class="breadcrumb-item">Home</li>
                                <li class="breadcrumb-item">About Us</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- END: Breadcrumbs-->

                <!-- START: Card Data-->
                <div class="row">
                    <div class="col-12 col-lg-12 mt-3">
                        <div class="card">
                            <div class="card-header">                               
                                <h4 class="card-title main_card_title">Manage About Us</h4>                                
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">                                           
                                        <div class="col-12">
                                            <form method="post" id="home_slider1" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label for="heading">Heading</label>                                                  
                                                    <input type="text" class="form-control" id="heading" name="heading" value="<?php if(isset($our_school) && count($our_school)>0) echo $our_school['heading'];?>" placeholder="Enter Heading" required="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="category">About Us</label>                                                  
                                                    <textarea rows="3" class="form-control boxed" style="width: 90%;" id="about_us" name="about_us" required=""><?php if(isset($our_school) && count($our_school)>0) echo $our_school['about_us'];?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="heading2">Heading</label>                                                  
                                                    <input type="text" class="form-control" id="heading2" name="heading2" value="<?php if(isset($our_school) && count($our_school)>0) echo $our_school['heading2'];?>" placeholder="Enter Founder Message Heading" required="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="description">Founder's Message</label>                                                  
                                                    <textarea rows="3" class="form-control boxed" style="width: 90%;" id="description" name="description" required=""><?php if(isset($our_school) && count($our_school)>0) echo $our_school['description'];?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <input type="submit" class="btn btn-primary" name="edit_about_us" value="Update About Us">
                                                    <!--<button type="reset" class="btn btn-outline-warning">Reset</button>-->
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-5 col-sm-12 mt-3">
                        <div class="card">
                            <div class="card-header">                               
                                <h4 class="card-title main_card_title">Our Mission</h4>                                
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">                                           
                                        <div class="col-12">
                                            <form method="post" id="home_slider1" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label for="our_mission_heading">Heading</label>                               
                                                    <input type="text" class="form-control" id="our_mission_heading" name="our_mission_heading" value="<?php if(isset($our_school) && count($our_school)>0) echo $our_school['our_mission_heading'];?>" placeholder="Enter Heading" required="" maxlength="50">
                                                </div>
                                                <div class="form-group">
                                                    <label for="our_mission_icon">Section icon</label>
                                                    <input type="file" class="form-control" id="our_mission_icon" name="our_mission_icon" accept="image/*" required="" <?php if($our_school['our_mission_icon']) echo "disabled";?>>
                                                    <?php if($our_school['our_mission_icon']) {?>
                                                    <i class="fas fa-trash-alt hidden_one_cls" style="color: red;margin-left: 4%;cursor: pointer;margin-top: 20px;font-size: 30px;" onclick="deleteMissionImage(<?php echo $our_school['id'];?>,'<?php echo $our_school['our_mission_icon'];?>')"></i><br>
                                                    <img src="../upload/<?php echo $our_school['our_mission_icon'];?>" class="rounded img-thumbnail hidden_one_cls" style="margin-top: 15px;background: #002a0f;">
                                                    <?php } ?>
                                                </div>
                                                <div class="form-group">
                                                    <label for="our_mission">Description</label>
                                                    <textarea rows="8" class="form-control boxed" style="width: 90%;" id="our_mission" name="our_mission" required=""><?php if(isset($our_school) && count($our_school)>0) echo $our_school['our_mission'];?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <input type="submit" class="btn btn-primary" name="edit_our_mission" value="Update Our Mission Statement">
                                                    <!--<button type="reset" class="btn btn-outline-warning">Reset</button>-->
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-5 col-sm-12 mt-3">
                        <div class="card">
                            <div class="card-header">                               
                                <h4 class="card-title main_card_title">Vision Section</h4>                                
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">                                           
                                        <div class="col-12">
                                            <form method="post" id="home_slider1" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label for="our_vision_heading">Heading</label>                               
                                                    <input type="text" class="form-control" id="our_vision_heading" name="our_vision_heading" value="<?php if(isset($our_school) && count($our_school)>0) echo $our_school['our_vision_heading'];?>" placeholder="Enter Section Heading" required="" maxlength="50">
                                                </div>
                                                <div class="form-group">
                                                    <label for="our_vision_icon">Section icon</label>
                                                    <input type="file" class="form-control" id="our_vision_icon" name="our_vision_icon" accept="image/*" required="" <?php if($our_school['our_vision_icon']) echo "disabled";?>>
                                                    <?php if($our_school['our_vision_icon']) {?>
                                                    <i class="fas fa-trash-alt hidden_vision_cls" style="color: red;margin-left: 4%;cursor: pointer;margin-top: 20px;font-size: 30px;" onclick="deleteVisionImage(<?php echo $our_school['id'];?>,'<?php echo $our_school['our_vision_icon'];?>')"></i><br>
                                                    <img src="../upload/<?php echo $our_school['our_vision_icon'];?>" class="rounded img-thumbnail hidden_vision_cls" style="margin-top: 15px;background: #002a0f;">
                                                    <?php } ?>
                                                </div>
                                                <div class="form-group">
                                                    <label for="category">Description</label>
                                                    <textarea rows="8" class="form-control boxed" style="width: 90%;" id="our_vision" name="our_vision" required=""><?php if(isset($our_school) && count($our_school)>0) echo $our_school['our_vision'];?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <input type="submit" class="btn btn-primary" name="edit_our_vision" value="Update Our Vision Statement">
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
        <!-- START: Page Vendor JS-->
        <script src="dist/vendors/datatable/js/jquery.dataTables.min.js"></script> 
        <script src="dist/vendors/datatable/js/dataTables.bootstrap4.min.js"></script>
        <script src="dist/vendors/datatable/jszip/jszip.min.js"></script>
        <script src="dist/vendors/datatable/pdfmake/pdfmake.min.js"></script>
        <script src="dist/vendors/datatable/pdfmake/vfs_fonts.js"></script>
        <script src="dist/vendors/datatable/buttons/js/dataTables.buttons.min.js"></script>
        <script src="dist/vendors/datatable/buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="dist/vendors/datatable/buttons/js/buttons.colVis.min.js"></script>
        <script src="dist/vendors/datatable/buttons/js/buttons.flash.min.js"></script>
        <script src="dist/vendors/datatable/buttons/js/buttons.html5.min.js"></script>
        <script src="dist/vendors/datatable/buttons/js/buttons.print.min.js"></script>
        <!-- END: Page Vendor JS-->

        <!-- START: Page Script JS-->        
        <script src="dist/js/datatable.script.js"></script>
        <!-- END: Page Script JS-->
        <script>
            function deleteVisionImage(id,image_name){
                if (confirm("Are you sure delete this image?")) {
                   $('#overlay').show();
                   $.ajax({
                        url:"action.php",
                        type:"POST",
                        data:'action=deleteVisionImage&id='+id+'&image_name='+image_name,
                        processData: false,
                        success: function (data) {
                            $('#overlay').hide();
                            $('.hidden_vision_cls').hide();
                            $('#our_vision_icon').prop("disabled", false);
                            $("#our_vision_icon").prop('required',true);
                        },
                    })
                } else {
                    return false;
                }
            }
            function deleteMissionImage(id,image_name){
                if (confirm("Are you sure delete this image?")) {
                   $('#overlay').show();
                   $.ajax({
                        url:"action.php",
                        type:"POST",
                        data:'action=deleteMissionImage&id='+id+'&image_name='+image_name,
                        processData: false,
                        success: function (data) {
                            $('#overlay').hide();
                            $('.hidden_one_cls').hide();
                            $('#our_mission_icon').prop("disabled", false);
                            $("#our_mission_icon").prop('required',true);
                        },
                    })
                } else {
                    return false;
                }
            }
            CKEDITOR.replace('about_us', { height: 200 });
            
            CKEDITOR.replace('description', { height: 300 });
            
            CKEDITOR.config.extraPlugins='colorbutton';
        </script>
    </body>
    <!-- END: Body-->
    <style>
        .dt-buttons.btn-group.flex-wrap {
            display: none;
        }
    </style>
</html>