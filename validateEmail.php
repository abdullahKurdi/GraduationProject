<?php
    session_start();
    $pageTitle = 'Validate Email Page';
    include 'init.php';
    $stmt = $con->prepare(" SELECT Username,UserID,Email FROM users WHERE Username = ? ");
        $stmt->execute(array($_SESSION['user']));
        $get = $stmt->fetch();
        $count = $stmt->rowCount();
        //check if count > 0 this mean the database contain the record about this user
        if($count > 0){
            $_SESSION['u_id'] = $get['UserID']; //register session ID
                if ($_SERVER['REQUEST_METHOD']=='POST'){
                    $ValidateNumber  = filter_var($_POST['ValidateNumber'],FILTER_SANITIZE_NUMBER_INT);
                    if($ValidateNumber == $_SESSION['valid']){
                        $stmt = $con->prepare("UPDATE users SET RegStatus= ?,BidPoint=3,SellingPoint=1 WHERE UserID =  ? ");
                        $stmt->execute(array(1 , $_SESSION['u_id'])); 
                        header("Location: index.php");
                    }
                    else{
                        echo '<div class="container"><div class="alert alert-success" role="alert">'.lang('The number you entered is incorrect').'</div></br></br></br></br></br></br></br></br></br></br></br></br></br></br></div>';
                        header("refresh:5;url='validateEmail.php'");
                    }
                }else{
                    $ValidNber=rand(100000,999999);
                    $_SESSION['valid']=$ValidNber;
                    require_once 'app\mail.php';
                        $mail->setFrom('arabaucuion@gmail.com', 'Arab Auction');
                        $mail->addAddress($get['Email']);
                    //  $mail->addCC('academyshiyar@gmail.com');
                        $mail->Subject = 'Active Account';
                        $mail->Body    = 'The verification code is : <b>'.$ValidNber.'</b>';
                        $mail->send();
                            ?>
                <!-- *************************************************** -->
                <div class="container login-page">
                    <div class="myCard">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="myLeftCtn">
                                    <form class="myForm text-center" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                                        <div class="form-group">
                                        <i class="fa fa-hourglass-half"></i>
                                        <input class="myInput" type="number" name="ValidateNumber" required placeholder="<?php echo lang('Enter a Valid Number');?>"/>
                                        </div>
                                        <input type="submit" class="butt" name="Validate" value="<?php echo lang('Active');?>">
                                        </br>
                                        <a href="validateEmail.php" class=""><?php echo lang('Resent Number');?></a>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="myRightCtn">
                                    <div class="box">
                                        <header> Validate Your Email <i class="fa fa-sign-in"></i> </header>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    </div>
                </div>
                <!-- *************************************************** -->

                <?php
        }  
    }else{
        header("Location: index.php");
    } 
    include $temp . 'footer.php';
?>