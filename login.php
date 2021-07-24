<?php
    session_start();
    $pageTitle = 'Login Page';
    include 'init.php';
    if ($_SERVER['REQUEST_METHOD']=='POST'){
        if(isset($_POST['login'])){
        $user = filter_var($_POST['user'], FILTER_SANITIZE_STRING);
        $pass = $_POST['pass'];
        $hashedPass = sha1($pass);
        // echo $user;
        // check if user exist in database 
        $stmt = $con->prepare(" SELECT 
                                    UserID ,Username, Password, Email 
                                FROM 
                                    users 
                                WHERE 
                                    (Username = ? OR Email = ?)
                                AND 
                                    Password = ? 
                                ");
        $stmt->execute(array($user ,$user , $hashedPass));
        $get = $stmt->fetch();
        $count = $stmt->rowCount();
        //check if count > 0 this mean the database contain the record about this user
        if($count > 0){
            $_SESSION['user'] = $user; //register session name 
            $_SESSION['u_id'] = $get['UserID']; //register session ID
            header('Location:index.php'); // redirect to dashboard page
            exit();
            }
        }
    }
    ?>
  <?php if(isset($_SESSION['user'])){
                header('Location:index.php');}
        else{echo '
    <div class="container login-page">
        <div class="myCard">
            <div class="row">
                <div class="col-md-6">
                    <div class="myLeftCtn">
                        <form class="myForm text-center" action="'; echo $_SERVER['PHP_SELF']; echo '" method="post">
                            <header>'. lang('login').'</header>
                            <div class="form-group">
                                <i class="fa fa-user"></i>
                                <input class="myInput" type="text" name="user" placeholder="'.lang('Username or Email').'" id="username" required/>
                            </div>
                            <div class="form-group">
                                <i class="fa fa-lock"></i>
                                <input class="myInput" type="password" name="pass" placeholder="'.lang('password').'" id="password" required/>
                            </div>
                            <input type="submit" class="butt" name="login" value="'.lang('login').'">
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="myRightCtn">
                        <div class="box">
                            <header>'.lang('Arab Auctions!').'</header>
                            <h4>
                                '.lang('Arab auctions is very good for your buy and sell your products').'
                            </h4>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    ';}?>
  <?php
    include $temp . 'footer.php';
?>