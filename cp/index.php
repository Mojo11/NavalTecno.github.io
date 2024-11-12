<?php 
session_start();
include '../include/config.php';
include "template/chklogin.php";
$crud = new Database();
include '../include/constant.php';
if(isset($_REQUEST['did']) && !empty($_REQUEST['did']) && $_REQUEST['action']=='reject'){
    $update = $crud->dbRowUpdate('sf_contact', array('status'=>'2'), 'id', $_REQUEST['did']); ?>
    <script>alert('enquiry rejected successfully'); window.location.replace("index.php");</script>
<?php
}
if(isset($_REQUEST['did']) && !empty($_REQUEST['did']) && $_REQUEST['action']=='accept'){
    $update = $crud->dbRowUpdate('sf_contact', array('status'=>'1'), 'id', $_REQUEST['did']); ?>
    <script>alert('enquiry accepted successfully'); window.location.replace("index.php");</script>
<?php
}
if(isset($_REQUEST['did']) && !empty($_REQUEST['did']) && $_REQUEST['action']=='delete'){
    $crud->delete($_REQUEST['did'], 'sf_contact'); ?>
    <script>alert('enquiry deleted successfully'); window.location.replace("index.php");</script>
<?php
}
$acceptLead =  $pendingLead = $rejectLead = 0;
$enquirys = $crud->read('sf_contact', array(), array(), 'order by id desc', '');
$acceptLead =  $pendingLead = $rejectLead = 0;
if($enquirys && count($enquirys)>0){
    foreach($enquirys as $enquiry){
        if($enquiry['status'] ==0){
            $pendingLead++;
        }
        if($enquiry['status'] ==1){
            $acceptLead++;
        }
        if($enquiry['status'] ==2){
            $rejectLead++;
        }
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
        <link rel="stylesheet" href="dist/vendors/morris/morris.css"> 
        <!--<link rel="stylesheet" href="dist/vendors/weather-icons/css/pe-icon-set-weather.min.css"> -->
        <!--<link rel="stylesheet" href="dist/vendors/chartjs/Chart.min.css"> -->
        <!--<link rel="stylesheet" href="dist/vendors/starrr/starrr.css"> -->
        <!--<link href="dist/vendors/bootstrap-tour/css/bootstrap-tour-standalone.min.css" rel="stylesheet"> -->
        <link rel="stylesheet" href="dist/vendors/fontawesome/css/all.min.css">
        <link rel="stylesheet" href="dist/vendors/ionicons/css/ionicons.min.css"> 
        <link rel="stylesheet" href="dist/vendors/datatable/css/dataTables.bootstrap4.min.css" />
        <link rel="stylesheet" href="dist/vendors/datatable/buttons/css/buttons.bootstrap4.min.css"/>
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
            <div class="container-fluid">
                <!-- START: Breadcrumbs-->
                <div class="row">
                    <div class="col-12  align-self-center">
                        <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                            <div class="w-sm-100 mr-auto"><h4 class="mb-0">Hello <?php echo ucfirst($_SESSION['ADMIN']['name']);?>,</h4> <b>Welcome to <?php echo WEBNAME;?> admin panel</b></div>

                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- END: Breadcrumbs-->

                <!-- START: Card Data-->
                <div class="row">
                    <div class="col-12 col-sm-6 col-xl-3 mt-3">
                        <div class="card">
                            <div class="card-body pull-up">
                                <i class="fa fa-calendar float-right" style="font-size: 30px;color: #7c71f1;"></i>
                                <h6 class="card-title font-weight-bold">TOTAL LEADS</h6>
                                <h2><?php echo count($enquirys);?> </h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-3 mt-3">
                        <div class="card pull-up">
                            <div class="card-body">
                                <i class="fas fa-calendar float-right" style="font-size: 30px;color: green;"></i> 
                                <h6 class="card-title font-weight-bold">ACCEPTED LEADS</h6>
                                <h2><?php echo $acceptLead;?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-3 mt-3">
                        <div class="card pull-up">
                            <div class="card-body">
                                <i class="fa fa-calendar float-right" style="font-size: 30px;color: #7c71f1;"></i> 
                                <h6 class="card-title font-weight-bold">PENDING LEADS</h6>
                                <h2><?php echo $pendingLead;?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-3 mt-3">
                        <div class="card">
                            <div class="card-body pull-up">
                                <i class="fa fa-calendar float-right" style="font-size: 30px;color: #crimson;"></i> 
                                <h6 class="card-title font-weight-bold">REJECTED LEADS</h6>
                                <h2><?php echo $rejectLead;?></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-12 mt-3" id="">
                        <div class="card">
                            <div class="card-header justify-content-between align-items-center">                               
                                <h4 class="card-title">enquiry list</h4> 
                            </div>
                            <div class="card-body">
                                <div class="table-responsive table_refresh">
                                    <table id="example" class="display table dataTable table-striped table-bordered" >
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Service/Product</th>
                                                <th>Contact</th>
                                                <th>Message</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            if($enquirys && count($enquirys)>0){ $i=0;
                                            foreach($enquirys as $enquiry){ $i++;
                                            ?>
                                            <tr>
                                                <td><?php echo $i;?></td>
                                                <td><?php echo $enquiry['name'];?></td>
                                                <td><?php echo $enquiry['email'];?></td>
                                                <td><?php echo $enquiry['subject'];?></td>
                                                <td><?php echo $enquiry['contact'];?></td>
                                                <td><?php echo $enquiry['message'];?></td>
                                                <td>
                                                    <?php if($enquiry['status'] == '0'){?>
                                                    <b style="color:#fca200;">Pending</b>
                                                    <?php } else if($enquiry['status'] == '2'){?>
                                                    <b style="color:red;">Rejected</b>
                                                    <?php } else if($enquiry['status'] == '1'){?>
                                                    <b style="color:#fff;">Accepted</b>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <a href="index.php?did=<?php echo $enquiry['id'];?>&action=delete" style="color: red;padding: 5px;border: 1px solid #fff;margin-left:10px" onclick="return confirm('Are you sure you want to delete this enquiry?');">Delete</a>
                                                    <?php if($enquiry['status']=='0'){?>
                                                    <a href="index.php?did=<?php echo $enquiry['id'];?>&action=accept" style="color: #fff;padding: 5px;border: 1px solid #fff;" onclick="return confirm('Are you sure you want to accept this enquiry?');">Accept</a>
                                                    <a href="index.php?did=<?php echo $enquiry['id'];?>&action=reject" style="color: red;padding: 5px;border: 1px solid #fff;margin-left:10px" onclick="return confirm('Are you sure you want to reject this enquiry?');">Reject</a>
                                                    <?php } ?>
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
        <script src="dist/js/app.js?<?php echo time();?>"></script>
        <!-- END: APP JS-->

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
        <style>
        .dt-buttons.btn-group.flex-wrap {
            display: none;
        }
    </style>
    </body>
    <!-- END: Body-->
</html>
