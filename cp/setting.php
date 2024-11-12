<?php 
session_start();
ob_start();
include '../include/config.php';
include "template/chklogin.php";
$crud = new Database();
include '../include/constant.php';
$sucess = '';
$delete = 0;


if (isset($_POST['edit_Settings'])) {
    // echo "<pre>"; print_r($_POST); echo "</pre>";
    // echo "<pre>"; print_r($_FILES); echo "</pre>";
    if ($_FILES['image']['size'] == 0) {
        $data = array();
        $data['email']      =   $_POST['email'];
        $data['phone']      =   $_POST['phone'];
        $data['phone2']     =   $_POST['phone2'];
        $data['whatsapp']   =   $_POST['whatsapp'];
        $data['address']    =   addslashes($_POST['location']);
        $data['facebook']   =   $_POST['facebook'];
        $data['instagram']  =   $_POST['instagram'];
        $data['linkedin']   =   $_POST['linkedin'];
        $data['twitter']    =   $_POST['twitter'];
        $data['youtube']    =   $_POST['youtube'];
        $data['footer_about']  =   addslashes($_POST['footer_about']);
        $data['map']        =   addslashes($_POST['map']);
        $update = $crud->dbRowUpdate('sf_settings', $data, 'id', '1');
        $sucess=4;
    } 
    else {
            $errors = '';
            $extension = array("jpeg", "jpg", "png", "gif",'JPEG','JPG','PNG','GIF');
            $UploadFolder = "../assets/images/";
            $temp = $_FILES["image"]["tmp_name"];
            $name = $_FILES["image"]["name"];
            $name = uniqid() . $name;
            $ext = pathinfo($name, PATHINFO_EXTENSION);
            if (in_array($ext, $extension) == TRUE) {
                if (move_uploaded_file($temp, $UploadFolder . "/" . $name)) {
                    $data = array();
                    $data['email']      =   $_POST['email'];
                    $data['phone']      =   $_POST['phone'];
                    $data['phone2']     =   $_POST['phone2'];
                    $data['whatsapp']   =   $_POST['whatsapp'];
                    $data['address']    =   addslashes($_POST['location']);
                    $data['facebook']   =   $_POST['facebook'];
                    $data['instagram']  =   $_POST['instagram'];
                    $data['linkedin']   =   $_POST['linkedin'];
                    $data['twitter']    =   $_POST['twitter'];
                    $data['youtube']    =   $_POST['youtube'];
                    $data['footer_about']  =   addslashes($_POST['footer_about']);
                    $data['map']        =   addslashes($_POST['map']);
                    $data['image']      =   $name;
                    $update = $crud->dbRowUpdate('sf_settings', $data, 'id', '1');
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

if($sucess==2){?>
    <script>alert('Unable to upload logo');</script>
<?php } else if($sucess==3){?>
    <script>alert('Image extension not allowed, please upload in JPEG, JPG, PNG, GIF');</script>
<?php } else if($sucess==4){ ?>
    <script>alert('setting updated successfully'); window.location.replace("setting.php");</script>
<?php }

$setting = $crud->singleRead('sf_settings', array(), 'id', '1');
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <title><?php echo WEBNAME;?> Manage settings option</title>
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
        <!--<link rel="stylesheet" href="dist/vendors/datatable/css/dataTables.bootstrap4.min.css" />-->
        <!--<link rel="stylesheet" href="dist/vendors/datatable/buttons/css/buttons.bootstrap4.min.css"/>-->
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
                <div class="row">
                    <div class="col-lg-6 col-sm-12 mt-3">
                        <div class="card">
                            <div class="card-header">                               
                                <h4 class="card-title main_card_title">Contact Info</h4>                                
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">                                           
                                        <div class="col-12">
                                            <form method="post" id="home_slider1" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label for="image">Change Logo</label>                                                  
                                                    <input type="file" class="form-control" id="image" name="image" accept="image/*" required="" <?php if(isset($setting['image']) && !empty($setting['image']))  echo "disabled";?>>
                                                    <?php if(isset($setting['image']) && !empty($setting['image'])) {?>
                                                    <i class="fas fa-trash-alt hidden_cls" style="color: red;margin-left: 10%;cursor: pointer;margin-top: 20px;font-size: 30px;" onclick="deleteSectionImage('<?php echo $setting['image'];?>')"></i><br>
                                                    <img src="../assets/images/<?php echo $setting['image'];?>" class="rounded img-thumbnail hidden_cls" style="width: 50%;margin-top: 15px;">
                                                    <?php } ?>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" class="form-control" id="email" name="email" value="<?php if(isset($setting) && count($setting)>0) echo $setting['email'];?>" placeholder="Enter Email">
                                                </div>
                                                <div class="form-group">
                                                    <label for="phone">Phone Number 1</label>
                                                    <input type="text" class="form-control" id="phone" name="phone" value="<?php if(isset($setting) && count($setting)>0) echo $setting['phone'];?>" placeholder="Enter Phone Number" maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                                                </div>
                                                <div class="form-group">
                                                    <label for="phone2">Phone Number 2 (Optional)</label>
                                                    <input type="text" class="form-control" id="phone2" name="phone2" value="<?php if(isset($setting) && count($setting)>0) echo $setting['phone2'];?>" placeholder="Enter Phone Number" maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                                                </div>
                                                <div class="form-group">
                                                    <label for="whatsapp">Whatsapp Number</label>
                                                    <input type="text" class="form-control" id="whatsapp" name="whatsapp" value="<?php if(isset($setting) && count($setting)>0) echo $setting['whatsapp'];?>" placeholder="Enter whatsapp Number" maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                                                </div>
                                                <div class="form-group">
                                                    <label for="location">Location</label>
                                                    <input type="text" class="form-control" id="location" name="location" value="<?php if(isset($setting) && count($setting)>0) echo $setting['address'];?>" placeholder="Enter location">
                                                </div>
                                                <div class="card-header">                               
                                                    <h4 class="card-title main_card_title">Social Media</h4>
                                                </div>
                                                <div class="form-group">
                                                    <label for="facebook">Facebook</label>
                                                    <input type="text" class="form-control" id="facebook" name="facebook" value="<?php if(isset($setting) && count($setting)>0) echo $setting['facebook'];?>" placeholder="Enter Facebook URL">
                                                </div>
                                                <div class="form-group">
                                                    <label for="instagram">Instagram</label>
                                                    <input type="text" class="form-control" id="instagram" name="instagram" value="<?php if(isset($setting) && count($setting)>0) echo $setting['instagram'];?>" placeholder="Enter Instagram URL">
                                                </div>
                                                <div class="form-group">
                                                    <label for="linkedin">Linkedin</label>
                                                    <input type="text" class="form-control" id="linkedin" name="linkedin" value="<?php if(isset($setting) && count($setting)>0) echo $setting['linkedin'];?>" placeholder="Enter Linkedin URL">
                                                </div>
                                                <div class="form-group">
                                                    <label for="twitter">Twitter</label>
                                                    <input type="text" class="form-control" id="twitter" name="twitter" value="<?php if(isset($setting) && count($setting)>0) echo $setting['twitter'];?>" placeholder="Enter Twitter URL">
                                                </div>
                                                <div class="form-group">
                                                    <label for="youtube">Youtube</label>
                                                    <input type="text" class="form-control" id="youtube" name="youtube" value="<?php if(isset($setting) && count($setting)>0) echo $setting['youtube'];?>" placeholder="Enter Youtube URL">
                                                </div>
                                                <div class="form-group">
                                                    <label for="map">Map</label>
                                                    <textarea class="form-control" id="map" rows="6" name="map" required><?php if(isset($setting) && count($setting)>0) echo $setting['map'];?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="footer_about">Footer About Us</label>
                                                    <textarea class="form-control" id="footer_about" rows="6" name="footer_about" placeholder="Enter Footer About us text" maxlength="500" required><?php if(isset($setting) && count($setting)>0) echo $setting['footer_about'];?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <input type="submit" class="btn btn-primary" name="edit_Settings" value="Update Settings">
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
            </div>
        </main>

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
            function deleteSectionImage(image_name){
                if (confirm("Are you sure delete this image?")) {
                   $('#overlay').show();
                   $.ajax({
                        url:"action.php",
                        type:"POST",
                        data:'action=deletelogo&image_name='+image_name,
                        processData: false,
                        success: function (data) {
                            $('#overlay').hide();
                            $('.hidden_cls').hide();
                            $('#image').prop("disabled", false);
                            $("#image").prop('required',true);
                        },
                    })
                } else {
                    return false;
                }
            }
        </script>
    </body>
</html>