<?php 
    include 'connect.php';
    $temp = 'includes/templates/';
    $lang = 'includes/languages/';
    $func = 'includes/functions/';
    $css = 'layout/CSS/';
    $js = 'layout/JS/';
    date_default_timezone_set('Asia/Amman');

    // include the impotrtant files
    include $func . 'functions.php';
    include $lang . 'english.php';
    include $temp . 'header.php'; 

    //include navbar on all pages expect the one with $noNavbar variable
    if(!isset($noNavbar)){
        include $temp . 'navbar.php';
    } 
?>    