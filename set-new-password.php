<?php

use App\Database\Models\User;
use App\Http\Requests\Validation;

$title = "Set New Password";
include "layouts/header.php";
include "App/Http/Middlewares/Guest.php";
include "App/Http/Middlewares/NotVerified.php";

if($_SERVER['REQUEST_METHOD'] == "POST"){
    // validation
    $validation = new Validation;
    $validation->setInput('password')->setValue($_POST['password'])->required()
    ->regex('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,32}$/','mini 8 chars max 32 ,mini one number , one character , one uppercase letter , one lowercase letter , one specidal char')
    ->confirmed($_POST['password_confirmation']);
    $validation->setInput('password_confirmation')->setValue($_POST['password_confirmation'])
    ->required();
    if(empty($validation->getErrors())){
        // no validation error
        $user = new User;
        $result = $user->setEmail($_SESSION['email'])
        ->setPassword($_POST['password']);
        if($user->updatePassowrd()){
            unset($_SESSION['email']);
            header('location:login.php');die;
        }else{
            $error = "<div class='alert alert-danger text-center'> Something Went Wrong </div>";
        }
    }
}
?>
<div class="login-register-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="login-register-tab-list nav">
                        <a class="active" data-toggle="tab" href="#lg1">
                            <h4> <?= $title ?></h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form action="" method="post">
                                        <?= $error ?? "" ?>
                                        <?= $success ?? "" ?>
                                        <input type="password"  name="password" placeholder="Password">
                                        <?= isset($validation) ? $validation->getMessage('password') : '' ?>
                                        <input type="password"  name="password_confirmation" placeholder="Password Confirmation">
                                        <?= isset($validation) ? $validation->getMessage('password_confirmation') : '' ?>
                                        <div class="button-box">
                                        <button type="submit"><span>Change</span></button>
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
</div>
<?php 
include "layouts/scripts.php";
?>

