<?php
$title = "Register User";

include_once __DIR__ . '\Layout\header.php';

//Generate csrf token for prevent bad request outside server
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
$_SESSION['csrf_token_expire'] = time() + 3600; //expire after 1 hour from now

//insure you come from post request
if(!isset($_POST['login_submit'])){
    header('location:Layout/error.php');die;
}

// Validation
//create user with token
?>

<!-- $message,
        $token, // create token to verify user identity(random unique string)
        $status, // verified user or not
        $created_at,
        $updated_at; -->

<div class="container mt-4 border p-4 shadow">

    <div class="row">
        <div class="offset-3 col-6">
            <h1 class="text-center text-success mb-4">Register User</h1>
            <form action="" method="post">

                <!-- create app token (csrf sent with the form) -->
                <input type="hidden" name="form_csrf" value="<?= isset($_SESSION['csrf_token']) ? $_SESSION['csrf_token'] : '' ?>">
                <div class="form-group">
                    <input type="hidden" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                </div>

                <div class="form-row">
                    <div class="form-group col">
                        <label for="inputEmail4">User Name</label>
                        <input type="text" name="user_name" value="" class="form-control" placeholder="Enter Your Name...!" id="inputEmail4">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col">
                        <label for="inputPassword4">Password</label>
                        <input type="password" name="password" value="" class="form-control" id="inputPassword4">
                    </div>
                </div>


                <div class="form-row">
                    <div class="form-group col">
                        <label for="city">City</label>
                        <select id="city" name="city" class="form-control">
                            <option selected>Choose...</option>
                            <option value="c">Cairo</option>
                            <option value="a">Alexandria</option>
                            <option value="l">Luxor</option>

                        </select>
                    </div>
                    </div>
                    <div class="form-row my-2">
<label for="" class="ms-3">Choose your gender :</label>
                        <div class="custom-control custom-radio mx-2">
                            <input type="radio" id="customRadio1" name="gender" class="custom-control-input">
                            <label class="custom-control-label" for="customRadio1">Male</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio2" name="gender" class="custom-control-input">
                            <label class="custom-control-label" for="customRadio2">Female</label>
                        </div>
                    </div>

                


                <div class="form-row">
                    <textarea name="message" id="message" class="form-control" cols="30" rows="3"></textarea>
                </div>

                <div class="form-row mt-3">
                    <button type="submit" name="login_submit" class="btn btn-primary">Sign in</button>

                </div>
            </form>

        </div>
    </div>
</div>

<?php
include_once __DIR__ . '\Layout\footer.php';
?>