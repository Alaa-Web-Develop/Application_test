<?php

include '../../views/Layout/header.php';
include '../models/User.php';
include '../requests/Validation.php';



//print_r($_POST);die;
//insure you come from post request
if(!isset($_POST['login_submit'])){
    header('location:../../views/Layout/error.php');exit;
}else{

    
//Generate csrf token for prevent bad request outside server
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
$_SESSION['csrf_token_expire'] = time() + 3600; //expire after 1 hour from now


// Validation Email:

$user_nameValidation = new Validation('user_name',$_POST['user_name']);
$user_nameRequiredResult = $user_nameValidation->required();

$passwordValidation = new Validation('password',$_POST['password']);
$passwordRequiredResult = $passwordValidation->required();
$passwordPattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,15}$/";

$passwordRegularExpResult = $passwordValidation->regex($passwordPattern);


$cityValidation = new Validation('city',$_POST['city']);
$cityRequiredResult = $cityValidation->required();

$genderValidation = new Validation('gender',$_POST['gender']);
$genderRequiredResult = $genderValidation->required();

//if server validation with no errors : insert user in db - generate random token 
if(empty($user_nameRequiredResult) 
&& empty($passwordRequiredResult) 
&& empty($cityRequiredResult) 
&& empty($genderRequiredResult)
&& empty($passwordRegularExpResult)
&& empty($genderRequiredResult)

){
     // generate user token
     $userObj = new User;

     //xss : cross site script by insert scripts in any input types , dsabled it by encode data before inser in db
     $user_name_encode =htmlspecialchars($_POST['user_name']);
     $password_encode = htmlspecialchars ($_POST['password']);
     $city_encode = htmlspecialchars ($_POST['city']);
     $gender_encode = htmlspecialchars ($_POST['gender']);
     $message_encode = htmlspecialchars ($_POST['message']);
    

     $userObj->setUser_name($user_name_encode);
     $userObj->setPassword($password_encode);
     $userObj->setCity($city_encode);
     $userObj->setGender($gender_encode);
     $userObj->setMessage($message_encode);


     //Generate user token : random_bytes generate random bytes then convert it to asci string
     $userToken=bin2hex(random_bytes(32));
     $userObj->setToken($userToken);
     $userObj->setStatus(1); // after user token usr status is 1=verified;

//print_r($userObj);die;

// insert user in db

$result = $userObj->create();
if($result){
//Save user in cookie to save his details in browser and don't need to login again:
setcookie('remember_me',$userToken,time()+(24*60*60)*30*12 , "/");

header('location:../../views/Home.php');die;
}

}
else{
    echo "<div class='alert alert-warning'>Please check your inputs validation..</div>";
}
}

?>

<?php
include '../../views/Layout/footer.php';

?>