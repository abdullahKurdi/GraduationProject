<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo $css ;?>font-awesome.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo $css . $style ;?>"/>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Anton&display=swap">
    <link rel="shortcut icon" href="layout/Img/fav.ico" type="image/x-icon">

    <title><?php getTitle();?></title>
  </head>
    <body>
            <div class="upper-bar">
            <div class="lang">
            <a href="<?php if(isset($import)){echo 'index.php';}else{echo $_SERVER['PHP_SELF'];}?>?lang=en" class="btn btn-light <?php if($_SESSION['LANG'] !== 'arabic') {echo 'activelANG';}?>"><?php echo lang('english');?></a>
            <a href="<?php if(isset($import)){echo 'index.php';}else{echo $_SERVER['PHP_SELF'];}?>?lang=ar" class="btn btn-light <?php if($_SESSION['LANG'] !== 'english') {echo 'activelANG';}?>"><?php echo lang('arabic');?></a>
            </div>
                <?php
                    if(isset($_SESSION['user'])){
                        $userStatus = checkUserActive($_SESSION['user']);
                        if($userStatus == 1){;?>
                        <img class="rounded-circle" height="40" width="40" src="controlPanel/uploads/profile_pic/def-pic.png"/>
                        <?php
                            echo '<a href="validateEmail.php" class="dddd btn btn-info">'; echo lang('Validate Email For Active Acount'); echo '</a>';
                            echo ' <a href="logout.php" class="dddd btn btn-danger">';echo lang('logout'); echo '</a>';
                        }else{$getUser = getUserInfo($_SESSION['u_id']);
                            ?>
                            <img class="rounded-circle" height="40" width="40" src="controlPanel/uploads/profile_pic/<?php echo $getUser['ProfilePic'];?>"/>
                            <div class="dropdown upper-bar-drop">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user"></i> <?php echo $_SESSION['user'];?>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="profile.php"><i class="fa fa-home"></i> <?php echo lang('My Profile');?></a>
                                <a class="dropdown-item" href="myItems.php"><i class="fa fa-tags"></i> <?php echo lang('My Items');?></a>
                                <a class="dropdown-item" href="addNewItem.php"><i class="fa fa-plus"></i> <?php echo lang('Add Item');?></a>
                                <a class="dropdown-item" href="orders.php"><i class="fa fa-shopping-cart"></i> <?php echo lang('Orders');?></a>
                                <a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out"></i> <?php echo lang('logout');?></a>
                            </div>
                        </div>
                        <?php }
                    }else{echo '
                    <div class="login-sign ">
                        <a  href="login.php">
                            <span class="log-text">'; echo lang('login'); echo '</span> 
                        </a>
                        |
                        <a  href="signup.php">
                            <span class="sing-text">'; echo lang('signup'); echo '</span>
                        </a>
                    </div>
                    ';}?>
                    
                </div>
    <?php   
       include  'navbar.php';            
    ?>
