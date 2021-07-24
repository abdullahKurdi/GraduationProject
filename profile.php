<?php
    ob_start("ob_gzhandler");
    session_start();
    $pageTitle = 'Profile Page';
    $paypal = 'on';
    $activelANG1='';
    include 'init.php';
    $aaa ="<?php done_paypal();?>";
    if($userStatus==0){
    if(isset($_SESSION['user'])){
        $getUser = getUserInfo($_SESSION['u_id']);
        $do = isset($_GET['do']) ? $_GET['do'] : 'Proflie';
        if($do == 'Proflie'){
        ?>
        <div class="profile">
            <div class="container">
                <div class="information">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-user"></i> <?php echo lang('My Information');?>
                            <a href="profile.php?do=Edit_Profile" class="proifie_edit btn btn-success"><i class="fa fa-edit"></i> <?php echo lang('Edit Info');?></a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                            <div class="myImag col-12 col-sm-12 col-md-4 col-lg-3">
                            <img src="controlPanel/uploads/profile_pic/<?php echo $getUser['ProfilePic'];?>"/>
                            </div>
                            <div class=" list col-12 col-sm-12 col-md-8 col-lg-9">
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span class="col-3 col-sm-3 col-md-2"><i class="fa fa-user"></i> <?php echo lang('Name');?></span><span class="col-1 col-sm-1 col-md-1">:-</span> <span class="col-8 col-sm-8 col-md-9"><?php echo $getUser['FullName'];?></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span class="col-3 col-sm-3 col-md-2"><i class="fa fa-unlock-alt"></i> <?php echo lang('login Name');?></span><span class="col-1 col-sm-1 col-md-1">:-</span> <span class="col-8 col-sm-8 col-md-9"><?php echo $getUser['Username'];?></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span class="col-3 col-sm-3 col-md-2"><i class="fa fa-envelope"></i> <?php echo lang('Email');?></span><span class="col-1 col-sm-1 col-md-1">:-</span> <span class="col-8 col-sm-8 col-md-9"><?php echo $getUser['Email'];?></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span class="col-3 col-sm-3 col-md-2"><i class="fa fa-phone"></i> <?php echo lang('Phone');?></span><span class="col-1 col-sm-1 col-md-1">:-</span> <span class="col-8 col-sm-8 col-md-9">0<?php echo $getUser['PhoneNumber'];?></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span class="col-3 col-sm-3 col-md-2"><i class="fa fa-map-marker"></i> <?php echo lang('Address');?></span><span class="col-1 col-sm-1 col-md-1">:-</span> <span class="col-8 col-sm-8 col-md-9"><?php echo $getUser['Address'];?></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span class="col-3 col-sm-3 col-md-2"><?php echo lang('Registration');?></span><span class="col-1 col-sm-1 col-md-1">:-</span> <span class="col-8 col-sm-8 col-md-9"><?php echo $getUser['RegisteredDate'];?></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-7 col-lg-8 Credit Information">
                    <div class="card">
                        <div class="card-header">
                        <i class="fa fa-info"></i> <?php echo lang('Credit Information');?>
                        </div>
                        <div class="card-body">
                            <div class=" list col-12">
                                <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <?php echo lang('Balance');?>
                                        <span class="badge badge-primary badge-pill"><?php echo $getUser['Balance'];?> USD</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <?php echo lang('Selling Points');?>
                                        <span class="badge badge-primary badge-pill"><?php echo $getUser['SellingPoint'];?></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <?php echo lang('Bidding Points And Buyer Points');?>
                                        <span id ="aaa"class="badge badge-primary badge-pill"><?php echo $getUser['BidPoint'];?></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-lg-4 Credit Information">
                    
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                <div class="card-body">
                                    
                                    <p class="card-text"><?php echo lang('Credit 10 USD To Your Balance');?></p>
                                    <div id="paypal-payment-button"></div>
                                </div>
                                </div>
                           
                        </div>
                    </div>
                </div>
            </div>
                <div class="Credit Information">
                    <div class="card">
                        <div class="card-header">
                        <i class="fa fa-info"></i> <?php echo lang('Bid and purchase points package');?>

                        </div>
                        <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo lang('[3 Point] package');?></h5>
                                    <p class="card-text"><?php echo lang('Convert this package at a price of 2 USD.');?></p>
                                    <a href="profile.php?do=Convert&package=3" class="btn btn-primary"><?php echo lang('Convert');?></a>
                                </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo lang('[10 Point] package');?></h5>
                                    <p class="card-text"><?php echo lang('Convert this package at a price of 5 USD.');?></p>
                                    <a href="profile.php?do=Convert&package=10" class="btn btn-primary"><?php echo lang('Convert');?></a>
                                </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo lang('[15 Point] package');?></h5>
                                    <p class="card-text"><?php echo lang('Convert this package at a price of 7 USD.');?></p>
                                    <a href="profile.php?do=Convert&package=15" class="btn btn-primary"><?php echo lang('Convert');?></a>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="Credit Information">
                    <div class="card">
                        <div class="card-header">
                        <i class="fa fa-info"></i> <?php echo lang('Package Selling Points');?>

                        </div>
                        <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo lang('[2 Point] package');?></h5>
                                    <p class="card-text"><?php echo lang('Convert this package at a price of 2 USD.');?></p>
                                    <a href="profile.php?do=Convert&package=2" class="btn btn-primary"><?php echo lang('Convert');?></a>
                                </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo lang('[5 Point] package');?></h5>
                                    <p class="card-text"><?php echo lang('Convert this package at a price of 4 USD.');?></p>
                                    <a href="profile.php?do=Convert&package=5" class="btn btn-primary"><?php echo lang('Convert');?></a>
                                </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo lang('[8 Point] package');?></h5>
                                    <p class="card-text"><?php echo lang('Convert this package at a price of 6 USD.');?></p>
                                    <a href="profile.php?do=Convert&package=8" class="btn btn-primary"><?php echo lang('Convert');?></a>
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
        }elseif($do == 'Edit_Profile'){
            //************************************** */
            //Protaction page
            //and chech if userid is numeric and get the integer value of it 
            $userid = isset($_SESSION['u_id']) && is_numeric($_SESSION['u_id']) ? intval($_SESSION['u_id']) :0;
            //select all data that have relation of this this userid 
            $stmt = $con->prepare(" SELECT * FROM users WHERE UserID = ? LIMIT 1");
            $stmt->execute(array($userid));
            $row = $stmt ->fetch();
            $count = $stmt->rowCount();
            if($count > 0){ ?>
            <!-- .....................start html tags...................-->  
            <div class="container-fluid">
                <h1 class="text-center"><?php echo '<div class="row alert alert-dark">';echo lang('Edit My Information'); echo'</div>';?></h1>
            </div>
                    <br>
                    <div class="Edit_INFO container">
                    <form class="form-horizontal" action="?do=Update" method="POST" enctype="multipart/form-data">
                        <!-- <input type="hidden" name="userid" value=""/> -->
                        <div class="form-group row">
                            <!--Start Username -->
                            <label class="col-md-2 form-label"><?php echo lang('Username');?></label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" value ="<?php echo $row['Username']?>" name="username" required = "required" placeholder="Enter Username"> 
                            </div>
                            <!--End Username -->
                            <!--Start Password -->
                            <label class="col-md-2 form-label"><?php echo lang('Password');?></label>
                            <div class="col-md-4">
                                <input type="hidden" name="old-password" value="<?php echo $row['Password'];?>">
                                <input type="password" class="password form-control" name="new-password" autocomplete="new-password" placeholder="<?php echo lang('Leave Blank If You Dont Want To Change');?>"> 
                            </div>
                            <!--End Password -->
                        </div>
                        <div class="form-group row">
                            <!--Start FullName -->
                            <label class="col-md-2 form-label"><?php echo lang('FullName');?></label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="fullname" value ="<?php echo $row['FullName']?>" required = "required" placeholder="Enter Full Name"> 
                            </div>
                            <!--End FullName -->
                            <!--Start Address -->
                            <label class="col-md-2 form-label"><?php echo lang('Address');?></label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="address" value ="<?php echo $row['Address']?>" required = "required" placeholder="Enter Address">
                            </div>
                            <!--End Address -->
                        </div>
                        <div class="form-group row">
                            <!-- Start Email -->
                            <label class="col-md-2 form-label"><?php echo lang('Profile Picture');?></label>
                            <div class="col-md-4">
                                <input type="file" class="form-control" name="profilePic"> 
                            </div>
                            <!--End email -->
                            <!-- Start Phone -->
                            <label class="col-md-2 form-label"><?php echo lang('PhoneNumber');?></label>
                            <div class="col-md-4">
                                <input type="tel" class="form-control" name="phone" pattern="07[7-9]{1}[0-9]{7}" value ="<?php echo '0' . $row['PhoneNumber']?>" required = "required" placeholder="Ex: 0775772008"> 
                            </div>
                            <!--End Phone -->
                        </div>
                        <!--Start Save -->
                        <div class="form-group row">
                            <div class="col-md-3 col-lg-3 offset-md-2 offset-lg-2">
                                <input type="submit" value="<?php echo lang('Edit Member');?>" class="btn btn-warning"/>
                            </div>
                        </div>
                        <!--End Save -->
                    </form>
                </div> 
                <!-- .....................end html tags...................-->  
        <?php
            }else{
                echo "<div class='container'>" . "</br>";
                $alertMsg = '<div class="alert alert-warning" role="alert">There Is No Such ID</div>';
                redirctAlert($alertMsg);
                echo "</div>";
            }
            
        }elseif($do == 'Update'){// update page
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    ?>
                       <h1 class="text-center border-bottom">Update</h1>
                    <?php

                    echo "<div class='container'>";
                    
                    $profilePic_name    = $_FILES['profilePic']['name'];
                    $profilePic_size    = $_FILES['profilePic']['size'];
                    $profilePic_tmp     = $_FILES['profilePic']['tmp_name'];
                    $profilePic_type    = $_FILES['profilePic']['type'];
                    // list of allowed pic type
                    $profilePicAllowExtention = array("jpeg","jpg","png","gif");
                    $t=explode('.',$profilePic_name);
                    $profilePicExtention = strtolower(end($t));

                    //get variables 
                    $id = $_SESSION['u_id'];
                    $username = filter_var($_POST['username'],FILTER_SANITIZE_STRING);
                    $fullname = filter_var($_POST['fullname'],FILTER_SANITIZE_STRING);;
                    $address = filter_var($_POST['address'],FILTER_SANITIZE_STRING);;
                    $phone = filter_var($_POST['phone'],FILTER_SANITIZE_NUMBER_INT);
                    //password trick
                    $pass = empty($_POST['new-password']) ? $_POST['old-password'] : sha1($_POST['new-password']);

                    /*$pass = '';
                    if(empty($_POST['new-password'])){
                        $pass = $_POST['old-password'];
                    }else{
                        $pass = sha1($_POST['new-password']);
                    }*/

                    //validate the form
                    $formErrors = array();
                    if(empty($username)){
                        $formErrors[] = 'Username can\'t be <strong>empty</strong></div>';
                    }
                    if(strlen($username) < 3){
                        $formErrors[] = 'Username can\'t be less than <strong>3 characters</strong>';
                    }
                    if(strlen($username) > 20){
                        $formErrors[] = 'Username can\'t be more than <strong>20 characters</strong>';
                    }
                    if(empty($fullname)){
                        $formErrors[] =  'Full name can\'t be <strong>empty</strong>';
                    }
                    if(empty($address)){
                        $formErrors[] = 'Address can\'t be <strong>empty</strong>';
                    }
                   
                    if(empty($phone)){
                        $formErrors[] = 'Phone number can\'t be <strong>empty</strong>';
                    }
                    if (!empty($profilePic_name) && ! in_array($profilePicExtention,$profilePicAllowExtention)){
                        $formErrors[] = 'This Extintion Is <strong>Worng</strong>';
                    }
                    //loop into errors message
                    foreach($formErrors as $error){
                        $alertMsg='<div class="alert alert-danger" role="alert">' . $error . '</div>';
                        redirctAlert($alertMsg,'back');
                    }

                    //check if there is no error 
                    if (empty($formErrors)){
                        $stmt3 = $con->prepare("SELECT *  FROM users WHERE UserID = ?");
                        $stmt3 ->execute(array($id));
                        $res = $stmt3->fetchAll();
                        $count2 = $stmt3->rowCount();
                        if ($count2 > 0){
                            $Profile_Pic= $res[0]['ProfilePic'];
                            if(!empty($profilePic_name)){
                                $Profile_Pic = rand(0,100000000).'_'.$profilePic_name;
                                move_uploaded_file($profilePic_tmp,"controlPanel\uploads\profile_pic\\".$Profile_Pic);
                            }
                            // update the database with this information
                            $stmt = $con->prepare("UPDATE users SET Username = ? ,FullName = ?  ,PhoneNumber = ? , Address = ?, Password = ?, ProfilePic= ? WHERE UserID =  ? ");
                            $stmt->execute(array($username , $fullname , $phone , $address , $pass,$Profile_Pic , $id ));
                            $_SESSION['user'] = $username;
                            //echo sucsses message 
                            $alertMsg= '<div class="alert alert-success" role="alert">' .  $stmt ->rowCount() . ' Record Updated</div>';
                            redirctAlert($alertMsg,'back');
                            echo "</div>";
                        }else{
                            echo "<div class='container'>" . "</br>";
                            $alertMsg='<div class="alert alert-danger" role="alert"><strong> You Cant Edit UserName</strong></div>';
                            redirctAlert($alertMsg,'back');
                            echo "</div>";
                        }
                    }
                }else{
                    echo "<div class='container'>" . "</br>";
                    echo '<div class="alert alert-danger" role="alert"><strong>Sorry You Can\'t Browse This Page Direct</strong></div>';
                    redirctAlert($alertMsg,'back');
                    echo "</div>";
                }
        }elseif($do == 'Convert'){
            $package = isset($_GET['package']) && is_numeric($_GET['package']) ? intval($_GET['package']) :0;
            if($package==2){
                if($getUser['Balance']>=2){
                    $stmt = $con->prepare("UPDATE users SET Balance = Balance-2 , SellingPoint=SellingPoint+2  WHERE UserID =  ? ");
                            $stmt->execute(array($getUser['UserID']));
                            //echo sucsses message 
                            $alertMsg= '<div class="container"><div class="alert alert-success" role="alert">Thank You For Convert package</div></div>';
                            redirctAlert($alertMsg,'back');
                }else{
                    $alertMsg= '<div class="container"><div class="alert alert-success" role="alert">Sorry You Don\'t Have Balance</div></div>';
                    redirctAlert($alertMsg,'back');
                }
            }
            else if($package==5){
                if($getUser['Balance']>=5){
                    $stmt = $con->prepare("UPDATE users SET Balance = Balance-4 , SellingPoint=SellingPoint+5  WHERE UserID =  ? ");
                            $stmt->execute(array($getUser['UserID']));
                            //echo sucsses message 
                            $alertMsg= '<div class="container"><div class="alert alert-success" role="alert">Thank You For Convert package</div></div>';
                            redirctAlert($alertMsg,'back');
                }else{
                    $alertMsg= '<div class="container"><div class="alert alert-success" role="alert">Sorry You Don\'t Have Balance</div></div>';
                    redirctAlert($alertMsg,'back');
                }
            }
            else if($package==8){
                if($getUser['Balance']>=6){
                    $stmt = $con->prepare("UPDATE users SET Balance = Balance-6 , SellingPoint=SellingPoint+8  WHERE UserID =  ? ");
                            $stmt->execute(array($getUser['UserID']));
                            //echo sucsses message 
                            $alertMsg= '<div class="container"><div class="alert alert-success" role="alert">Thank You For Convert package</div></div>';
                            redirctAlert($alertMsg,'back');
                }else{
                    $alertMsg= '<div class="container"><div class="alert alert-success" role="alert">Sorry You Don\'t Have Balance</div></div>';
                    redirctAlert($alertMsg,'back');
                }
            }
            else if($package==3){
                if($getUser['Balance']>=2){
                    $stmt = $con->prepare("UPDATE users SET Balance = Balance-2 , BidPoint=BidPoint+3  WHERE UserID =  ? ");
                            $stmt->execute(array($getUser['UserID']));
                            //echo sucsses message 
                            $alertMsg= '<div class="container"><div class="alert alert-success" role="alert">Thank You For Convert package</div></div>';
                            redirctAlert($alertMsg,'back');
                }else{
                    $alertMsg= '<div class="container"><div class="alert alert-success" role="alert">Sorry You Don\'t Have Balance</div></div>';
                    redirctAlert($alertMsg,'back');
                }
            }
            else if($package==10){
                if($getUser['Balance']>=5){
                    $stmt = $con->prepare("UPDATE users SET Balance = Balance-4 , BidPoint=BidPoint+10  WHERE UserID =  ? ");
                            $stmt->execute(array($getUser['UserID']));
                            //echo sucsses message 
                            $alertMsg= '<div class="container"><div class="alert alert-success" role="alert">Thank You For Convert package</div></div>';
                            redirctAlert($alertMsg,'back');
                }else{
                    $alertMsg= '<div class="container"><div class="alert alert-success" role="alert">Sorry You Don\'t Have Balance</div></div>';
                    redirctAlert($alertMsg,'back');
                }
            }
            else if($package==15){
                if($getUser['Balance']>=7){
                    $stmt = $con->prepare("UPDATE users SET Balance = Balance-7 , BidPoint=BidPoint+15  WHERE UserID =  ? ");
                            $stmt->execute(array($getUser['UserID']));
                            //echo sucsses message 
                            $alertMsg= '<div class="container"><div class="alert alert-success" role="alert">Thank You For Convert package</div></div>';
                            redirctAlert($alertMsg,'back');
                }else{
                    $alertMsg= '<div class="container"><div class="alert alert-success" role="alert">Sorry You Don\'t Have Balance</div></div>';
                    redirctAlert($alertMsg,'back');
                }
            }else{
                $alertMsg= '<div class="container"><div class="alert alert-success" role="alert">Sorry This Package Does Not Availible</div></div>';
                redirctAlert($alertMsg,'back');
            }
        }else{
            header('Location:profile.php'); // redirect to dashboard page
            exit();
        }
    }else{
        header('Location:index.php'); // redirect to dashboard page
        exit();
    }
}else{
    header('Location:index.php'); // redirect to dashboard page
    exit();
}
    include $temp . 'footer.php';
    ob_end_flush();
?>