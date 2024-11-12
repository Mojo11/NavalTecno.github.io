<?php
if(!isset($_SESSION['ADMIN']['email']))
{
    header('Location:login.php');
    exit();
}
?>