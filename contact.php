<?php
ob_start("ob_gzhandler");
    session_start();
    $pageTitle = 'Contact Us';
    include 'init.php';
    if ($_SERVER['REQUEST_METHOD']=='POST'){
        //CHECK FILTER POST ATTR
        $usern = filter_var($_POST['username'],FILTER_SANITIZE_STRING);
        $email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
        $phone= filter_var($_POST['phone'],FILTER_SANITIZE_NUMBER_INT);
        $message = filter_var($_POST['message'],FILTER_SANITIZE_STRING);
        // SHECK ERRORS
        $formErrors = array();
        if(empty($usern)){
            $formErrors[] = 'Username can\'t be empty';
        }
        if(strlen($usern) < 3){
            $formErrors[] = 'Username can\'t be less than 3 characters';
        }
        if(strlen($usern) > 30){
            $formErrors[] = 'Username can\'t be more than 20 characters';
        }

        if(filter_var($email,FILTER_VALIDATE_EMAIL) != true){
            $formErrors[] = 'This Email Is Not Validate';
        }
        
        if(strlen($phone) != 10){
            $formErrors[] = 'Phone can\'t be more and less than 10 number';
        }
        if(empty($message)){
            $formErrors[] = 'Message  can\'t be  empty';
        }
        if(strlen($message) < 10){
            $formErrors[] = 'Message  can\'t be less than 10 characters';
        }
        // $header  = 'From: ' . $email .'\r\n';
        // $myMail  = 'kurdi313@gmail.com';
        $subject = 'Contact Form';
        if (empty($formErrors)){
            $body = '<div>From : '.$email.'</div><br><div>Phone : '.$phone.'</div><br><div>Message : '.$message.'</div><br>';
            // mail($myMail,$subject,$message,$header);
            require_once 'app\mail.php';
                        $mail->setFrom($email,$usern);
                        $mail->addAddress('arabaucuion@gmail.com');
                    //  $mail->addCC('academyshiyar@gmail.com');
                        $mail->Subject = $subject;
                        $mail->Body    =  $body;
                        $mail->send();
            $success='<div class="alert alert-success">Thank You '.$usern.' We Have Recived Your Message</div>';
            $usern='';
            $email='';
            $phone='';
            $message='';
            header("refresh:5;url='contact.php'");
            
        }
    }
    ?>
    <!--**************************start contact us************************-->
    <div class="container contact_form">
        <h1 class="header text-center"><?php echo lang('Contact Us')?></h1>
    <form class="contact" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
    <?php 
        if(!empty($formErrors)){
            foreach($formErrors as $error){
                echo '<div class="row alert alert-danger">'.
                $error . "<br>".
                '</div>';
            }
        }
        if(isset($success)){echo '<div class="row">'.$success .'</div>';}
    ?>
        <div class="row">
            <div class="col">
                <input type="text" class="form-control username" placeholder="<?php echo lang('Type Your Name or UserName')?>" name="username" value="<?php if (isset($usern)){echo $usern;}?>">
                <i class="fa fa-user"></i>
                <div class="alert alert-danger custom-alert">
                    <?php echo lang('Username Must Be Larger Than 3 Characters')?> 
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <input type="text" class="form-control email" placeholder="<?php echo lang('Please Type a Valid Email')?>" name="email" value="<?php if (isset($email)){echo $email;}?>">
                <i class="fa fa-envelope"></i>
                <div class="alert alert-danger custom-alert">
                    <?php echo lang('Email Cant Be Empty')?> 
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <input type="text" class="form-control phone" placeholder="<?php echo lang('Type Your Cell Phone')?>" name="phone" value="<?php if (isset($phone)){echo $phone;}?>">
                <i class="fa fa-phone"></i>
                <div class="alert alert-danger custom-alert">
                    <?php echo lang('Phone Cant Be Empty')?>
                </div>
            </div>
        </div>
        <div class="textarea-message row">
            <div class="col">
                <textarea class="form-control message" placeholder="<?php echo lang('Enter Your Message Please')?>" name="message"><?php if (isset($message)){echo $message;}?></textarea>
                <i class="fa fa-comment"></i>
                <div class="alert alert-danger custom-alert">
                    <?php echo lang('Message Must Be Larger Than 10 Characters')?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="send col">
                <input type="submit" class="btn btn-success" value="<?php echo lang('Send Message')?>"/>
                <i class="fa fa-paper-plane"></i>
            </div>
        </div>
    </form>
    </div>
 <!--**************************end contact us************************-->
    <?php
    include $temp . 'footer.php';
ob_end_flush();
?>