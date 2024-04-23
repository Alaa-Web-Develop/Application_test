<?php
$title = " Update User";

include_once __DIR__ . '\Layout\header.php';
include '../app/models/User.php';

//print_r($_GET['id']);die;
if($_GET){
    //get cuurrent user from db
$User = new User;
$User->setId($_GET['id']);
$UserResult = $User->getUserById();
if($UserResult)
$currentUser = $UserResult->fetch_object();
}else{
    header('location:Layout/error.php');
}
?>

<div class="container mt-4 border p-4 shadow">

    <div class="row">
        <div class="offset-3 col-6">
            <h1 class="text-center text-success mb-4">Update User</h1>
            <form action="../app/posts/updatePost.php" method="post">

                <!-- create app token (csrf sent with the form) -->
                <input type="hidden" name="form_csrf" value="<?= isset($_SESSION['csrf_token']) ? $_SESSION['csrf_token'] : '' ?>">
                <div class="form-group">
                    <input type="hidden" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                </div>

                <input type="hidden" name="id_user" value="<?=$currentUser->id ?>">

                <div class="form-row">
                    <div class="form-group col">
                        <label for="inputEmail4">User Name</label>
                        <input type="text" name="user_name" value="<?=$currentUser->user_name ?>" class="form-control" placeholder="Enter Your Name...!" id="inputEmail4">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col">
                        <label for="inputPassword4">Password</label>
                        <input type="password" name="password" value="<?=$currentUser->password ?>" class="form-control" id="inputPassword4">
                    </div>
                </div>

                
                <div class="form-row">
                    <div class="form-group col">
                        <label for="city">City</label>
                        <select id="city" name="city" class="form-control">
                            
                            <option <?=$currentUser->city == 'cairo' ?'selected':'' ?> value="cairo">Cairo</option>
                            <option <?=$currentUser->city == 'Alex' ?'selected':'' ?> value="Alex">Alexandria</option>
                            <option <?=$currentUser->city == 'Luxor' ?'selected':'' ?> value="Luxor">Luxor</option>

                        </select>
                    </div>
                    </div>
                    <div class="form-row my-2">
<label for="" class="ms-3">Choose your gender :</label>
                        <div class="custom-control custom-radio mx-2">
                            <input type="radio" id="customRadio1" name="gender" class="custom-control-input" value="m" <?=$currentUser->gender == 'm' ?'checked':'' ?>>
                            <label class="custom-control-label" for="customRadio1">Male</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio2" name="gender" class="custom-control-input" value="f" <?=$currentUser->gender == 'f' ?'checked':'' ?>>
                            <label class="custom-control-label" for="customRadio2">Female</label>
                        </div>
                    </div>

                


                <div class="form-row">
                    <textarea name="message" id="message" class="form-control" cols="30" rows="3"><?=$currentUser->message ?></textarea>
                </div>

                <div class="form-row mt-3">
                    <button type="submit" name="update_submit" class="btn btn-primary">update</button>
                </div>
            </form>

        </div>
    </div>
</div>

<?php
include_once __DIR__ . '\Layout\footer.php';
?>