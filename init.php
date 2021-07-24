<?php 
    include 'controlPanel/connect.php';
    $temp = 'includes/templates/';
    $lang = 'includes/languages/';
    $func = 'includes/functions/';
    $css = 'layout/CSS/';
    $js = 'layout/JS/';
    date_default_timezone_set('Asia/Amman');
        if(isset($_GET['lang']) && $_GET['lang']=='ar'){
            $_SESSION['LANG']='arabic';
        }
   
        elseif(isset($_GET['lang']) && $_GET['lang']=='en'){
            $_SESSION['LANG']='english';
        }
        else{
            if (!isset($_SESSION['LANG'])){
                    $_SESSION['LANG']='arabic';
                }
            }
            
    $style= '';
    if(isset($_SESSION['LANG']) && $_SESSION['LANG'] == 'arabic'){
        include $lang . 'arabic.php';
        $style = 'arabicStyle.css';
    }elseif(isset($_SESSION['LANG']) && $_SESSION['LANG'] == 'english'){
        include $lang . 'english.php';
        $style = 'style.css';
    }

    
    // include the impotrtant files
    include $func . 'functions.php';
    include $temp . 'header.php';


    if(isset($_GET['TypeOfAuction']) && $_GET['TypeOfAuction']=='Demand'){
        $_SESSION['TypeOfAuction']='Demand';
    }elseif(isset($_GET['TypeOfAuction']) && $_GET['TypeOfAuction']=='Supply'){
        $_SESSION['TypeOfAuction']='Supply';
    }else{
        if (!isset($_SESSION['TypeOfAuction'])){
                $_SESSION['TypeOfAuction']='Supply';
            }
        }
        endAuction();
    if(isset($under)){include $temp . 'under_navbar.php';} 
?>    