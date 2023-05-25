<?php

use App\Database\Models\User;
use App\Mails\VerificationCode;
use App\Http\Requests\Validation;

$title = "Register";
include "layouts/header.php";
include "App/Http/Middlewares/Guest.php";
include "layouts/navbar.php";
include "layouts/breadcrumb.php";

$validation = new Validation;
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $validation->setInput('first_name')->setValue($_POST['first_name'])->required()->min(2)->max(32);
    $validation->setInput('last_name')->setValue($_POST['last_name'])->required()->min(2)->max(32);
    $validation->setInput('email')->setValue($_POST['email'])->required()->regex('/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/')->unique('users', 'email');
    $validation->setInput('phone')->setValue($_POST['phone'])->required()->regex('/^01[0125][0-9]{8}$/')->unique('users', 'phone');
    $validation->setInput('password')->setValue($_POST['password'])->required()->regex('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,32}$/', 'mini 8 chars max 32 ,mini one number , one character , one uppercase letter , one lowercase letter , one specidal char')->confirmed($_POST['password_confirmation']);
    $validation->setInput('password_confirmation')->setValue($_POST['password_confirmation'])->required();
    $validation->setInput('gender')->setValue($_POST['gender'])->required()->in(['m', 'f']);

    if (empty($validation->getErrors())) {

        $verificationCode = rand(10000, 99999);
        $user = new User;
        $user->setFirst_name($_POST['first_name'])->setLast_name($_POST['last_name'])
            ->setEmail($_POST['email'])->setPassword($_POST['password'])->setPhone($_POST['phone'])
            ->setGender($_POST['gender'])->setVerification_code($verificationCode);
        if ($user->create()) {

            $verificationCodeMail = new VerificationCode;
            $subject = "Account Verification Code";
            $body = "<p>Hello {$_POST['first_name']}</p>
            <p>Your Verification Code Is : <b style='color:blue;'>{$verificationCode}</b></p>
            <p>Thank You.</p>";
            if ($verificationCodeMail->send($_POST['email'], $subject, $body)) {
                $_SESSION['email'] = $_POST['email'];
                header('location:check-verification-code.php?page=register');
                die;
            } else {
                $error = "<div class='alert alert-danger text-center'> Please Try Again Later </div>";
            }
        } else {
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
                        <a class="active" data-toggle="tab" href="#lg2">
                            <h4> register </h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div id="lg2" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <?= $error ?? "" ?>
                                    <form method="post" action="">
                                        <input type="text" name="first_name" placeholder="First Name" value="<?= $validation->getOldValue('first_name') ?>">
                                        <?= $validation->getMessage('first_name') ?>
                                        <input type="text" name="last_name" placeholder="Last Name" value="<?= $validation->getOldValue('last_name') ?>">
                                        <?= $validation->getMessage('last_name') ?>
                                        <input type="email" name="email" placeholder="Email Address" value="<?= $validation->getOldValue('email') ?>">
                                        <?= $validation->getMessage('email') ?>
                                        <input type="tel" name="phone" placeholder="Phone" value="<?= $validation->getOldValue('phone') ?>">
                                        <?= $validation->getMessage('phone') ?>
                                        <input type="password" name="password" placeholder="Password">
                                        <?= $validation->getMessage('password') ?>
                                        <input type="password" name="password_confirmation" placeholder="Password Confirmation">
                                        <?= $validation->getMessage('password_confirmation') ?>
                                        <select name="gender" class="form-control my-3" id="">
                                            <option <?= $validation->getOldValue('gender') == 'm' ? 'selected' : '' ?> value="m">Male</option>
                                            <option <?= $validation->getOldValue('gender') == 'f' ? 'selected' : '' ?> value="f">Female</option>
                                        </select>
                                        <?= $validation->getMessage('gender') ?>

                                        <div class="button-box">
                                            <button type="submit"><span>Register</span></button>
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