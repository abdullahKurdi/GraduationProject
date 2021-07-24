<?php
    session_start();
    $noNavbar = "" ;
    $pageTitle = 'Login';
    if(isset($_SESSION['Username'])){
        header('Location:logistics.php'); // redirect to dashboard page
    }
    include 'init.php';
    

    // check if user comming from http post request
    if($_SERVER['REQUEST_METHOD']== 'POST'){
        $username = $_POST['user'];
        $password = $_POST['password'];
        $hashedPass = sha1($password);

        // check if user exist in database 
        $stmt = $con->prepare(" SELECT 
                                    UserID, Username, Password 
                                FROM 
                                    users 
                                WHERE 
                                    Username = ? 
                                AND 
                                    Password = ? 
                                AND 
                                    GroupID = 2
                                LIMIT 1");
        $stmt->execute(array($username , $hashedPass));
        $row = $stmt ->fetch();
        $count = $stmt->rowCount();

        //check if count > 0 this mean the database contain the record about this user
        if($count > 0){
            $_SESSION['Username'] = $username; //register session name 
            $_SESSION['ID'] = $row['UserID']; //register session id
            header('Location:logistics.php'); // redirect to dashboard page
            exit();
        }
    }
?>
    <form class="login" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
        <h3 class="text-center">Logistics</h3>
        <input class="form-control" type="text" name="user" placeholder="Username" autocomplete="off"/>
        <input class="form-control" type="password" name="password" placeholder="password" autocomplete="new-password"/>
        <input class="btn btn-dark" type="submit"  value="Login" /> 
    </form>
<?php 
    include $temp . 'footer.php';
?>