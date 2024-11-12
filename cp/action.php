<?php
session_start();
include '../include/config.php';
include "template/chklogin.php";
$crud = new Database();
include '../include/constant.php';
if(isset($_POST['action']) && $_POST['action'] == 'deleteSectionImage'){
    $crud->updateUsingQuery("update sf_header_banner set image=''");
    $image_name = $_POST['image_name'];
    unlink("../upload/$image_name");
    exit();
}
if(isset($_POST['action']) && $_POST['action'] == 'deleteProductImage'){
    $crud->updateUsingQuery("update sf_products set image='' where id='".$_POST['id']."'");
    $image_name = $_POST['image_name'];
    unlink("../upload/products/$image_name");
    exit();
}
if(isset($_POST['action']) && $_POST['action'] == 'deleteVisionImage'){
    $crud->updateUsingQuery("update sf_about_us set our_vision_icon='' where id='".$_POST['id']."'");
    $image_name = $_POST['image_name'];
    unlink("../upload/$image_name");
    exit();
}
if(isset($_POST['action']) && $_POST['action'] == 'deleteMissionImage'){
    $crud->updateUsingQuery("update sf_about_us set our_mission_icon='' where id='".$_POST['id']."'");
    $image_name = $_POST['image_name'];
    unlink("../upload/images/$image_name");
    exit();
}
if(isset($_POST['action']) && $_POST['action'] == 'deleteStatisticsImage'){
    $crud->updateUsingQuery("update sf_statistics set image='' where id='".$_POST['id']."'");
    $image_name = $_POST['image_name'];
    unlink("../upload/statistics/$image_name");
    exit();
}
if(isset($_POST['action']) && $_POST['action'] == 'deleteSliderImage'){
    $crud->updateUsingQuery("update sf_home_slider set image='' where id='".$_POST['id']."'");
    $image_name = $_POST['image_name'];
    unlink("../upload/slider/$image_name");
    exit();
}
if(isset($_POST['action']) && $_POST['action'] == 'deleteTestimonialImage'){
    $crud->updateUsingQuery("update sf_testimonials set image='' where id='".$_POST['id']."'");
    $image_name = $_POST['image_name'];
    unlink("../upload/testimonial/$image_name");
    exit();
}
if(isset($_POST['action']) && $_POST['action'] == 'deleteProjectImage'){
    $crud->updateUsingQuery("update sf_projects set image='' where id='".$_POST['id']."'");
    $image_name = $_POST['image_name'];
    unlink("../upload/projects/$image_name");
    exit();
}
if(isset($_POST['action']) && $_POST['action'] == 'deletelogo'){
    $crud->updateUsingQuery("update sf_settings set image=''");
    $image_name = $_POST['image_name'];
    unlink("../assets/images/$image_name");
    exit();
}
if(isset($_POST['action']) && $_POST['action'] == 'deleteSingleServiceImage'){
    $crud->updateUsingQuery("update sf_manage_services set image='' where id='".$_POST['id']."'");
    $image_name = $_POST['image_name'];
    unlink("../upload/services/$image_name");
    exit();
}
if(isset($_POST['action']) && $_POST['action'] == 'deleteServiceImage'){
    $crud->updateUsingQuery("update sf_services set image='' where id='".$_POST['id']."'");
    $image_name = $_POST['image_name'];
    unlink("../upload/services/$image_name");
    exit();
}
?>