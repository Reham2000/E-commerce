<?php

use App\Database\Models\User;

ob_start();
session_start();

include "vendor/autoload.php"; 
include "init.php";

if(isset($_COOKIE['user'])){
    $user = new User;
    $loggedInUser = $user->setEmail($_COOKIE['user'])
    ->getUerByEmail()->fetch_object();
    $_SESSION['user'] = $loggedInUser;
}
?>
<!doctype html>
<html class="no-js" lang="zxx">


<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?= $title; ?></title>
    <meta name="description" content="">
    <meta name="robots" content="noindex, follow" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?= $imagesPath ?>favicon.png">

    <!-- all css here -->
    <link rel="stylesheet" href="<?= $cssPath ?>bootstrap.min.css">
    <link rel="stylesheet" href="<?= $cssPath ?>animate.css">
    <link rel="stylesheet" href="<?= $cssPath ?>owl.carousel.min.css">
    <link rel="stylesheet" href="<?= $cssPath ?>slick.css">
    <link rel="stylesheet" href="<?= $cssPath ?>chosen.min.css">
    <link rel="stylesheet" href="<?= $cssPath ?>font-awesome.min.css">
    <link rel="stylesheet" href="<?= $cssPath ?>themify-icons.css">
    <link rel="stylesheet" href="<?= $cssPath ?>ionicons.min.css">
    <link rel="stylesheet" href="<?= $cssPath ?>jquery-ui.css">
    <link rel="stylesheet" href="<?= $cssPath ?>meanmenu.min.css">
    <link rel="stylesheet" href="<?= $cssPath ?>style.css">
    <link rel="stylesheet" href="<?= $cssPath ?>responsive.css">
    <script src="<?= $jsPath ?>vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <!-- header start -->