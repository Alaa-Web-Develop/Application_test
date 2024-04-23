<?php

include '../../views/Layout/header.php';
include '../models/User.php';
include '../requests/Validation.php';

//print_r($_POST);die;
if($_GET){
       //get cuurrent user from db
$User = new User;
$User->setId($_GET['id']);
$UserResult = $User->delete();
if($UserResult)
header('location:../../views/Home.php');

}else{
    header('location:Layout/error.php');
}

?>


<?php
include '../../views/Layout/footer.php';

?>