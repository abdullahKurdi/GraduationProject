<?php
    session_start();
    $pageTitle = 'Signup Page';
    include 'init.php';
    if ($_SERVER['REQUEST_METHOD']=='POST'){
        if(isset($_POST['Signup'])){
        $user = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        $fullname = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
        $phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
        $pass1 = $_POST['pass1'];
        $hashedPass1 = sha1($pass1);
        $pass2 = $_POST['pass2'];
        $hashedPass2 = sha1($pass2);

        $formErrors = array();
        if(empty($user)){
            $formErrors[] = lang('Username can\'t be empty');
        }
        if(strlen($user) < 3){
            $formErrors[] = lang('Username can\'t be less than 3 characters');
        }
        if(strlen($fullname) < 3){
            $formErrors[] = lang('full name can\'t be less than 3 characters');
        }
        if(strlen($user) > 30){
            $formErrors[] = lang('Username can\'t be more than 30 characters');
        }
        if(empty($pass1)){
            $formErrors[] = lang('Password can\'t be empty');
        }
        if(empty($pass2)){
            $formErrors[] = lang('Password can\'t be empty');
        }
        if($pass1 !== $pass2){
            $formErrors[] = lang('Sorry password is not match');
        }
        if(filter_var($email,FILTER_VALIDATE_EMAIL) != true){
            $formErrors[] = lang('This Email Is Not Validate');
        }
        if(empty($address)){
            $formErrors[] = lang('address  can\'t be empty');
        }
        
        if(strlen($phone) != 10){
            $formErrors[] = lang('Phone can\'t be more and less than 10 number');
        }
        if (empty($formErrors)){

            if(checkItem('Username','users',$user) != 1){
                // insert Member into the database with this information
                if(checkItem('Email','users',$email) != 0){
                    $alertMsg ='<div class="container"><div class="alert alert-danger" role="alert">'.lang('Sorry This Email Is Exist').'</div></div>';
                    redirctAlert($alertMsg,'back');
                    
                }else{
                    $stmt = $con->prepare("INSERT INTO 
                    users (Username, Password, Email, FullName, PhoneNumber, Address ,RegStatus, RegisteredDate,ProfilePic) 
                    VALUES(:auser, :apass, :amail, :aname, :aphone ,:aaddress , 0, now(),'def-pic.png')");
                        $stmt->execute(array(
                        'auser'  => $user,
                        'apass'  => $hashedPass1,
                        'amail'  => $email,
                        'aname'  => $fullname,
                        'aphone' => $phone,
                        'aaddress' => $address,
                        ));
                        $_SESSION['user'] = $user; //register session name 
                        echo '<div class="container"><div class="alert alert-success" role="alert">'.lang('Hi') .$fullname. lang('Welcome in Arab Auction We Sent to Your Email Code please  Active Yor Account').'</div></div>';
                        header("refresh:5;url='validateEmail.php'");
                        }
            }else{
                $alertMsg ='<div class="container"><div class="alert alert-danger" role="alert">'.lang('Sorry This Username Is Exist').'</div></div>';
                redirctAlert($alertMsg,'back');
            }
        }
        }
    }
  ?>
    <div class="container login-page">
        <div class="myCard">
            <div class="row">
                <div class="col-md-6">
                    <div class="myLeftCtn">
                        <form class="myForm text-center" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                            
                            <div class="form-group">
                                <i class="fa fa-user"></i>
                                <input class="myInput" type="text" pattern=".{3,20}" title="<?php echo lang('Username must be between 3 and 20  chars');?>" placeholder="<?php echo lang('Username');?>" id="username" name="username" required/>
                            </div>
                            <div class="form-group">
                                <i class="fa fa-user-secret"></i>
                                <input class="myInput" type="text" placeholder="<?php echo lang('FullName');?>" pattern=".{3,}" title="<?php echo lang('FulName must be 3 or more chars');?>" id="name" name="name" required/>
                            </div>
                            <div class="form-group">
                                <i class="fa fa-envelope"></i>
                                <input class="myInput" type="email" placeholder="<?php echo lang('Email');?>" id="email" name="email" required/>
                            </div>
                            <div class="form-group">
                                <i class="fa fa-map-marker"></i>
                                <input class="myInput" type="text" placeholder="<?php echo lang('Address');?>" id="Address" name="address" required/>
                            </div>
                            <div class="form-group">
                                <i class="fa fa-phone"></i>
                                <input class="myInput" type="number" placeholder="<?php echo lang('PhoneNumber');?>" pattern="07[7-9]{1}[0-9]{7}" id="phone" name="phone" required/>
                            </div>
                            <div class="form-group">
                                <i class="fa fa-lock"></i>
                                <input class="myInput" type="password" minlength="4" placeholder="<?php echo lang('Complex Password');?>" id="password" name="pass1" required/>
                            </div>
                            <div class="form-group">
                                <i class="fa fa-lock"></i>
                                <input class="myInput" type="password" minlength="4" placeholder="<?php echo lang('Again Password');?>" id="password2" name="pass2" required/>
                            </div>
                            <div class="form-group">
                            <input class="myagree" type="checkbox" required/><lable> <a href="privacy.php"><?php echo lang('I agree to all the terms of the site')?></a></lable>
                            </div>
                            <input type="submit" class="butt" name="Signup" value="<?php echo lang('CACCOUNT');?>">
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="myRightCtn">
                        <div class="box">
                            <header> <?php echo lang('Create New Account');?></br><i class="fa fa-sign-in"></i> </header>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <?php 
            if ($_SERVER['REQUEST_METHOD']=='POST'){
                if(isset($_POST['Signup'])){
                foreach($formErrors as $error){
                    //echo '<div class="logerror alert alert-danger" role="alert">' . $error . '</div>';
                    echo '<div class="logerror nice-message">'. $error .'</div>';
                       
                  }
                }
                
            }
            ?>
        </div>
    </div>
   
<?php
    include $temp . 'footer.php';
?>