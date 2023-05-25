<?php

use App\Database\Models\User;
use App\Http\Requests\Validation;

$title = "Login";
include "layouts/header.php";
include "App/Http/Middlewares/Guest.php";
include "layouts/navbar.php";
include "layouts/breadcrumb.php";
define('NOT_ACTIVE',0);
define('ACTIVE',1);
$validation = new Validation;

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $validation->setInput('email')->setValue($_POST['email'])->required()->regex('/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/',"Wrong Email Or Password")->exists('users','email');
    $validation->setInput('password')->setValue($_POST['password'])->required()->regex('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,32}$/',"Wrong Email Or Password");
    if(empty($validation->getErrors())){

        $user = new User;
        $result = $user->setEmail($_POST['email'])->getUerByEmail()->fetch_object();
        if(password_verify($_POST['password'],$result->password)){
            if(! is_null($result->email_verified_at)){
                if($result->status == NOT_ACTIVE){
                    $error = "<p class='text-danger font-weight-bold'>Sorry Your Account Has Been Blocked </p>";
                }else{
                    if(isset($_POST['remember_me'])){
                        setcookie('user',$_POST['email'],time() + (365*86400),'/');
                    }
                    $_SESSION['user'] = $result;
                    header('location:index.php');
                    die;
                }
            }else{
                $_SESSION['email'] = $_POST['email'];
                header('location:check-verification-code.php?page=login');
                die;
            }
        }else{
            $error = "<p class='text-danger font-weight-bold'> Wrong Email Or Password </p>";
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
                            <h4> login </h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form action="" method="post">
                                        <input type="email" name="email" placeholder="Email Address" value="<?= $validation->getOldValue('email') ?>">
                                        <?= $validation->getMessage('email') ?>
                                        <?= $error ?? '' ?>
                                        <input type="password" name="password" placeholder="Password">
                                        <?= $validation->getMessage('password') ?>

                                        <div class="button-box">
                                            <div class="login-toggle-btn">
                                                <input type="checkbox" name="remember_me">
                                                <label>Remember me</label>
                                                <a href="forget-password.php">Forgot Password?</a>
                                            </div>
                                            <button type="submit"><span>Login</span></button>
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
include "layouts/footer.php";
include "layouts/scripts.php";
?>