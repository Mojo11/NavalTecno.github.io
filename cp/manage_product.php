<?php 
session_start();
include '../include/config.php';
include "template/chklogin.php";
$crud = new Database();
include '../include/constant.php';
$crud = new Database();
if(isset($_POST['add_content'])){
    if($_FILES['image']['error'] == '0'){
        $errors = '';
        $extension = array("jpeg", "jpg", "png", "gif",'JPEG','JPG','PNG','GIF');
        $UploadFolder = "../upload/products";
        $temp = $_FILES["image"]["tmp_name"];
        $name = $_FILES["image"]["name"];
        $name = uniqid() . $name;
        $ext = pathinfo($name, PATHINFO_EXTENSION);
        if (in_array($ext, $extension) == TRUE) {
            if (move_uploaded_file($temp, $UploadFolder . "/" . $name)) {
                $data = array();
                $data['name']               =   $_POST['name'];
                $data['amount']             =   $_POST['amount'];
                $data['image']              =   $name;
                $data['short_description']  =   addslashes($_POST['short_description']);
                $data['description']        =   addslashes($_POST['description']);
                if($crud->saveRecords('sf_products', $data))
                {
                    $sucess=1;
                } else {
                    $sucess=5;
                }
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
    else {
        $sucess=0;
    }
}
if (isset($_POST['edit_content'])) {
    if ($_FILES['image']['size'] == 0) {
        $data = array();
        $data['name']               =   $_POST['name'];
        $data['amount']             =   $_POST['amount'];
        $data['short_description']  =   addslashes($_POST['short_description']);
        $data['description']        =   addslashes($_POST['description']);
        $update = $crud->dbRowUpdate('sf_products', $data, 'id', $_REQUEST['sid']);
        $sucess=4;
    } 
    else {
            $errors = '';
            $extension = array("jpeg", "jpg", "png", "gif",'JPEG','JPG','PNG','GIF');
            $UploadFolder = "../upload/products";
            $temp = $_FILES["image"]["tmp_name"];
            $name = $_FILES["image"]["name"];
            $name = uniqid() . $name;
            $ext = pathinfo($name, PATHINFO_EXTENSION);
            if (in_array($ext, $extension) == TRUE) {
                if (move_uploaded_file($temp, $UploadFolder . "/" . $name)) {
                    $data = array();
                    $data['name']               =   $_POST['name'];
                    $data['amount']             =   $_POST['amount'];
                    $data['image']              =   $name;
                    $data['short_description']  =   addslashes($_POST['short_description']);
                    $data['description']        =   addslashes($_POST['description']);
                    $update = $crud->dbRowUpdate('sf_products', $data, 'id', $_REQUEST['sid']);
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
    <script>alert('Product added successfully'); window.location.replace("manage_product.php");</script>
<?php } else if($sucess==2){?>
    <script>alert('Unable to upload image');</script>
<?php } else if($sucess==3){?>
    <script>alert('Image extension not allowed, please upload in JPEG, JPG, PNG, GIF');</script>
<?php } else if($sucess==4){ ?>
    <script>alert('Product updated successfully'); window.location.replace("manage_product.php");</script>
<?php } else if($sucess==5){ ?>
    <script>alert('Unable to save Image'); window.location.replace("manage_product.php");</script>
<?php }

if(isset($_REQUEST['did']) && !empty($_REQUEST['did'])){
    $crud->delete($_REQUEST['did'], 'sf_products');
    $image_name = $_REQUEST['image'];
    unlink("../upload/products/$image_name"); ?>
    <script>alert('Products deleted successfully'); window.location.replace("manage_product.php");</script>
<?php
}

$products = $crud->read('sf_products', array(), array(), 'order by id desc', '');
if(isset($_REQUEST['sid']) && !empty($_REQUEST['sid'])){
    $product = $crud->singleRead('sf_products', array(), 'id', $_REQUEST['sid']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <title><?php echo WEBNAME;?> Manage Product</title>
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
        <script type="text/javascript" src="dist/ckeditor/ckeditor.js?<?php echo time();?>"></script>
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
                <div class="row ">
                    <div class="col-12  align-self-center">
                        <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                            <div class="w-sm-100 mr-auto"><h4 class="mb-0">Manage Product</h4></div>
                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                <li class="breadcrumb-item">Home</li>
                                <li class="breadcrumb-item">Product</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- END: Breadcrumbs-->

                <!-- START: Card Data-->
                <div class="row">
                    <div class="col-12 col-lg-12 mt-3">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">                                           
                                        <div class="col-12">
                                            <form method="post" id="home_slider1" enctype="multipart/form-data">
                                                
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <label for="name">Product Name</label>
                                                            <input type="text" class="form-control boxed" id="name" name="name" value="<?php if(isset($product) && count($product)>0) echo $product['name'];?>" required="" maxlength="100">
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="amount">Product Amount</label>
                                                            <input type="text" class="form-control boxed" id="amount" name="amount" value="<?php if(isset($product) && count($product)>0) echo $product['amount'];?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="image">Add Image</label>                                                  
                                                    <input type="file" class="form-control" id="image" name="image" placeholder="Enter Slider Heading" accept="image/*" required="" <?php if(isset($product['image']) && !empty($product['image']))  echo "disabled";?>>
                                                    <?php if(isset($product['image']) && !empty($product['image'])) {?>
                                                    <i class="fas fa-trash-alt hidden_cls" style="color: red;margin-left: 10%;cursor: pointer;margin-top: 20px;font-size: 30px;" onclick="deleteProductImage(<?php echo $product['id'];?>,'<?php echo $product['image'];?>')"></i><br>
                                                    <img src="../upload/products/<?php echo $product['image'];?>" class="rounded img-thumbnail hidden_cls" style="width: 25%;margin-top: 15px;">
                                                    <?php } ?>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="short_description">Product Short Description</label>
                                                    <textarea rows="3" class="form-control boxed" style="width: 90%;" id="short_description" name="short_description" maxlenth="500" required=""><?php if(isset($product) && count($product)>0) echo $product['short_description'];?></textarea>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="description">Description</label>
                                                    <textarea rows="3" class="form-control boxed" style="width: 90%;" id="description" name="description" required=""><?php if(isset($product) && count($product)>0) echo $product['description'];?></textarea>
                                                </div>
                                                
                                                <div class="form-group">                                                  
                                                    <?php if(isset($_REQUEST['sid']) && !empty($_REQUEST['sid'])){ ?>
                                                    <input type="submit" class="btn btn-primary" name="edit_content" value="Update Product">
                                                    <?php } else {?>
                                                    <input type="submit" class="btn btn-primary" name="add_content" value="Add Product">
                                                    <button type="reset" class="btn btn-outline-warning">Clear All</button>
                                                    <?php } ?>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-12 mt-3" id="">
                        <div class="card">
                            <div class="card-header justify-content-between align-items-center">                               
                                <h4 class="card-title">Product list</h4> 
                            </div>
                            <div class="card-body">
                                <div class="table-responsive table_refresh">
                                    <table id="example" class="display table dataTable table-striped table-bordered" >
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th>Short <br> Description</th>
                                                <th>Image</th>
                                                <th>Description</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            if($products && count($products)>0){ $i=0;
                                            foreach($products as $ser){ $i++; ?>
                                            <tr>
                                                <td><?php echo $i;?></td>
                                                <td width="20%"><?php echo $ser['name'];?></td>
                                                <td width="10%"><?php echo $ser['amount'];?></td>
                                                <td width="20%"><?php echo $ser['short_description'];?></td>
                                                <td width="20%"><img src="../upload/products/<?php echo $ser['image'];?>" style="width: 70%;"></td>
                                                <td width="30%"><?php echo $ser['description'];?></td>
                                                <td width="10%">
                                                    <a href="manage_product.php?sid=<?php echo $ser['id'];?>&image=<?php echo $ser['image'];?>"><i class="far h5 mr-2 fa-edit"></i></a>
                                                    <a href="manage_product.php?did=<?php echo $ser['id'];?>&image=<?php echo $ser['image'];?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fas h5 mr-2 fa-times"></i></a>
                                                </td>
                                            </tr>
                                            <?php } }?>
                                        </tbody>
                                    </table>
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
            function deleteProductImage(id,image_name){
                if (confirm("Are you sure delete this image?")) {
                   $('#overlay').show();
                   $.ajax({
                        url:"action.php",
                        type:"POST",
                        data:'action=deleteProductImage&id='+id+'&image_name='+image_name,
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
            CKEDITOR.replace('description', {height: 400});
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