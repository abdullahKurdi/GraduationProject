<?php
    ob_start("ob_gzhandler");// output buffering start
    // manage members page you can add delete edit from here 
    session_start();
    $pageTitle = 'Members';
    if(isset($_SESSION['Username'])){
        include 'init.php';
        //*******************start members page ********************
        $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
        // start manage page
        if($do == 'Manage'){//manage page 
            $Query='';
            if(isset($_GET['page']) && $_GET['page']=='pending'){
                $Query='AND RegStatus = 0';
            }
            $limit =8;
            $page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']): 1 ;
            $start = ($page - 1) * $limit;
            $stmt= $con->prepare("SELECT * FROM users WHERE GroupID = 0 $Query ORDER BY UserID DESC LIMIT $start , $limit");
            $stmt->execute();
            $rows= $stmt->fetchAll();
            $total = getItemCount('UserID','users');
            
            $pages = ceil(($total[0]-2)/$limit);
            $Previous = $page - 1 ;
            $Next = $page + 1;
            if(!empty($rows)){?>
            <h1 class="text-center border-bottom"><?php echo lang('manage');?></h1>
            <div class="container-fluid manage-members">
                <div class="scroll table-responsive">
                    <table class="table text-center table-light table-hover table-striped">
                        <thead>
                            <tr class="table-dark">
                                <td>ID</td>
                                <td>Profile pic</td>
                                <td>Username</td>
                                <td>Full Name</td>
                                <td>Phone Number</td>
                                <td>Email</td>
                                <td>Address</td>
                                
                                <td>Bid Point</td>
                                <td>Selling Point</td>
                                <td>balance</td>
                                <td>Registered Date</td>
                                <td class="contr" >Control</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($rows as $row){
                                    echo "<tr>";
                                        echo "<td>" . $row['UserID'] . "</td>";
                                        echo "<td><img src='uploads/profile_pic/" . $row['ProfilePic'] . "' alt='profile pictuer'/></td>";
                                        echo "<td>" . $row['Username'] . "</td>";
                                        echo "<td>" . $row['FullName'] . "</td>";
                                        echo "<td>" . "0" . $row['PhoneNumber'] . "</td>";
                                        echo "<td>" . $row['Email'] . "</td>";
                                        echo "<td>" . $row['Address'] . "</td>";
                                        echo "<td>" . $row['BidPoint'] . "</td>";
                                        echo "<td>" . $row['SellingPoint'] . "</td>";
                                        echo "<td>" . $row['Balance'] . "</td>";
                                        echo "<td>" . $row['RegisteredDate'] . "</td>";
                                        echo "<td>
                                                 <a href='members.php?do=Edit&userid=" . $row['UserID'] . "' class='tbtn btn btn btn-warning btn-sm'><i class='fa fa-edit'></i>Edit</a>
                                                 <a href='members.php?do=Delete&userid=" . $row['UserID'] . "' class='tbtn confirm btn btn-danger btn-sm'><i class='fa fa-close'></i>Delete</a>";
                                                 if ($row['RegStatus']== 0){ 
                                                    echo " <a href='members.php?do=active&userid=" . $row['UserID'] . "' class='tbtnw btn btn btn-success btn-sm'><i class='fa fa-check'></i>Approve</a>";
                                                    }
                                        echo    "</td>";
                                    echo "</tr>";
                                } 
                            ?>
                            </tr>
                        </tbody>
                        </div>
                    </table>
                </div>
                <?php echo '<div class="row">
                                <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center">
                                <li class="page-item ';if($page==1){echo 'disabled';}echo' ">
                                    <a class="page-link" href="?page='.$Previous.'" tabindex="-1">Previous</a>
                                </li>
                                ';
                                for($i = 1 ; $i <= $pages ; $i++){
                                echo '<li class="page-item"><a class="page-link" href="?page='.$i.'">'.$i.'</a></li>';
                                }
                                echo '<li class="page-item ';if($page==$pages){echo 'disabled';}echo'">
                                    <a class="page-link" href="?page='.$Next.'">Next</a>
                                </li>
                                </ul>
                            </nav>
                    </div>';?>
                <a href="members.php?do=Add" class="btn btn-primary"><i class="fa fa-plus"></i> Add New Members</a>
            </div>
            <?php 
            }else {
                echo '<div class="container">';
                    echo '<div class="nice-message">There\'s No Record To Show</div>';
                    echo '<a href="members.php?do=Add" class="btn btn-primary"><i class="fa fa-plus"></i> Add New Members</a>';
                 echo '</div>';   
            } 
                ?>
    <?php
        }else if($do == 'Add'){//add memberspage?>
            <h1 class="text-center border-bottom"><?php echo lang('add');?></h1>
            <div class="container">
                    <form class="form-horizontal" action="?do=Insert" method="POST" enctype="multipart/form-data">
                        <div class="form-group row">
                            <!--Start Username -->
                            <label class="col-md-2 form-label">Username</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  name="username" required = "required" placeholder="Username to log into auction"> 
                            </div>
                            <!--End Username -->
                            <!--Start Password -->
                            <label class="col-md-2 form-label">Password</label>
                            <div class="col-md-4">
                                <input type="password" class="password form-control" name="password" required = "required" autocomplete="new-password" placeholder="Password must be hard and complex"> 
                                <i class="show-pass fa fa-eye"></i>
                            </div>
                            <!--End Password -->
                        </div>
                        <div class="form-group row">
                            <!--Start FullName -->
                            <label class="col-md-2 form-label">FullName</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="fullname"  required = "required" placeholder="Full name appear in your profile page"> 
                            </div>
                            <!--End FullName -->
                            <!--Start Address -->
                            <label class="col-md-2 form-label">Address</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="address"  required = "required" placeholder="Address appear in your profile page">
                            </div>
                            <!--End Address -->
                        </div>
                        <div class="form-group row">
                            <!-- Start Email -->
                            <label class="col-md-2 form-label">Email</label>
                            <div class="col-md-4">
                                <input type="email" class="form-control" name="email" required = "required"  placeholder="Ex: abc@info.com"> 
                            </div>
                            <!--End email -->
                            <!-- Start Phone -->
                            <label class="col-md-2 form-label">PhoneNumber</label>
                            <div class="col-md-4">
                                <input type="tel" class="form-control" name="phone" pattern="07[7-9]{1}[0-9]{7}" required = "required" placeholder="Ex: 07x-xxx-xxxx"> 
                            </div>
                            <!--End Phone -->
                        </div>
                        <div class="form-group row">
                            <!-- Start Email -->
                            <label class="col-md-2 form-label">Profile Pictuer</label>
                            <div class="col-md-4">
                                <input type="file" class="form-control" name="profilePic"> 
                            </div>
                            <!--End email -->
                        </div>
                        
                        <!--Start Save -->
                        <div class="form-group row">
                            <div class="col-md-3 col-lg-3 offset-md-2 offset-lg-2">
                                <input type="submit" value="Add New Member" class="btn btn-success"/>
                            </div>
                        </div>
                        <!--End Save -->
                    </form>
                </div> 
                <!-- .....................end html tags...................-->  
            <?php
            }else if($do == 'Insert'){//insert page
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    ?>
                    <h1 class="text-center border-bottom"><?php echo lang('insert');?></h1>
                    <?php
                    echo "<div class='container'>";
                    //get variables 
                    //***************** */
                    // $profilePic_name = $_FILES['profilePic'];
                    // print_r ($profilePic_name);
                    $profilePic_name    = $_FILES['profilePic']['name'];
                    $profilePic_size    = $_FILES['profilePic']['size'];
                    $profilePic_tmp     = $_FILES['profilePic']['tmp_name'];
                    $profilePic_type    = $_FILES['profilePic']['type'];
                    // list of allowed pic type
                    $profilePicAllowExtention = array("jpeg","jpg","png","gif");
                    $t=explode('.',$profilePic_name);
                    $profilePicExtention = strtolower(end($t));
                    
                    //***************** */
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $hashPass = sha1($_POST['password']) ;
                    $fullname = $_POST['fullname'];
                    $address = $_POST['address'];
                    $email = $_POST['email'];
                    $phone = $_POST['phone'];

                    //validate the form
                    $formErrors = array();
                    if(empty($username)){
                        $formErrors[] = 'Username can\'t be <strong>empty</strong>';
                    }
                    if(strlen($username) < 3){
                        $formErrors[] = 'Username can\'t be less than <strong>3 characters</strong>';
                    }
                    if(strlen($username) > 20){
                        $formErrors[] = 'Username can\'t be more than <strong>20 characters</strong>';
                    }
                    if(empty($password)){
                        $formErrors[] = 'Password can\'t be <strong>empty</strong></div>';
                    }
                    if(empty($fullname)){
                        $formErrors[] =  'Full name can\'t be <strong>empty</strong>';
                    }
                    if(empty($address)){
                        $formErrors[] = 'Address can\'t be <strong>empty</strong>';
                    }
                    if(empty($email)){
                        $formErrors[] = 'Email can\'t be <strong>empty</strong>';
                    }
                    if(empty($phone)){
                        $formErrors[] = 'Phone number can\'t be <strong>empty</strong>';
                    }
                    if (!empty($profilePic_name) && ! in_array($profilePicExtention,$profilePicAllowExtention)){
                        $formErrors[] = 'This Extintion Is <strong>Worng</strong>';
                    }
                    // if (empty($profilePic_name)){
                    //     $formErrors[] = 'Profile pictuer can\'t be <strong>Empty</strong>';
                    // }
                    // if ($profilePic_size > 4194304){
                    //     $formErrors[] = 'Profile pictuer can\'t Be Larger Than <strong>4MB</strong>';
                    // }
                    //loop into errors message
                    foreach($formErrors as $error){
                        $alertMsg ='<div class="alert alert-danger" role="alert">' . $error . '</div>';
                        redirctAlert($alertMsg,'back');
                    }

                    //check if there is no error 
                    if (empty($formErrors)){
                        $Profile_Pic="def-pic.png";
                        if(!empty($profilePic_name)){
                        $Profile_Pic = rand(0,100000000).'_'.$profilePic_name;
                        move_uploaded_file($profilePic_tmp,"uploads\profile_pic\\".$Profile_Pic);}

                        if(checkItem('Username','users',$username) != 1){
                           // insert Member into the database with this information
                            $stmt = $con->prepare("INSERT INTO 
                                                    users (Username, Password, Email, FullName, PhoneNumber, Address ,RegStatus, RegisteredDate,ProfilePic) 
                                                    VALUES(:auser, :apass, :amail, :aname, :aphone ,:aaddress , 1, now(),:apic)");
                            $stmt->execute(array(
                                'auser'  => $username,
                                'apass'  => $hashPass,
                                'amail'  => $email,
                                'aname'  => $fullname,
                                'aphone' => $phone,
                                'aaddress' => $address,
                                'apic'=>$Profile_Pic,
                            ));
                        
                            $alertMsg='<div class="alert alert-success" role="alert">' .  $stmt ->rowCount() . ' record inserted</div>';
                            redirctAlert($alertMsg,'back');
                        }else{
                            $alertMsg ='<div class="alert alert-danger" role="alert">Sorry This Username Is Exist</div>';
                            redirctAlert($alertMsg,'back');
                         }
                    }
                }else{
                    echo "<div class='container'>" . "</br>";
                    $alertMsg = "<div class='alert alert-danger' role='alert'>Sorry You Can't Browse This Page Directly</div>";
                    redirctAlert($alertMsg , 'back');
                    echo "</div>";
                    }
                echo "</div>";
            }else if($do == 'Edit'){// edit page

            //Protaction page
            //and chech if userid is numeric and get the integer value of it 
            $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) :0;
            //select all data that have relation of this this userid 
            $stmt = $con->prepare(" SELECT * FROM users WHERE UserID = ? LIMIT 1");
            $stmt->execute(array($userid));
            $row = $stmt ->fetch();
            $count = $stmt->rowCount();
            if($count > 0){ ?>
            <!-- .....................start html tags...................-->  
                <h1 class="text-center border-bottom"><?php echo lang('edit profile');?></h1>
                <div class="container">
                    <form class="form-horizontal" action="?do=Update" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="userid" value="<?php echo $userid ;?>"/>
                        <div class="form-group row">
                            <!--Start Username -->
                            <label class="col-md-2 form-label">Username</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" value ="<?php echo $row['Username']?>" name="username" required = "required" placeholder="Enter Username"> 
                            </div>
                            <!--End Username -->
                            <!--Start Password -->
                            <label class="col-md-2 form-label">Password</label>
                            <div class="col-md-4">
                                <input type="hidden" name="old-password" value="<?php echo $row['Password'];?>">
                                <input type="password" class="password form-control" name="new-password" autocomplete="new-password" placeholder="Leave Blank If You Don't Want To Change">
                                <i class="show-pass fa fa-eye"></i> 
                            </div>
                            <!--End Password -->
                        </div>
                        <div class="form-group row">
                            <!--Start FullName -->
                            <label class="col-md-2 form-label">FullName</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="fullname" value ="<?php echo $row['FullName']?>" required = "required" placeholder="Enter Full Name"> 
                            </div>
                            <!--End FullName -->
                            <!--Start Address -->
                            <label class="col-md-2 form-label">Address</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="address" value ="<?php echo $row['Address']?>" required = "required" placeholder="Enter Address">
                            </div>
                            <!--End Address -->
                        </div>
                        <div class="form-group row">
                            <!-- Start Email -->
                            <label class="col-md-2 form-label">Email</label>
                            <div class="col-md-4">
                                <input type="email" class="form-control" name="email" value ="<?php echo $row['Email']?>" required = "required" placeholder="Ex: abc@info.com"> 
                            </div>
                            <!--End email -->
                            <!-- Start Phone -->
                            <label class="col-md-2 form-label">PhoneNumber</label>
                            <div class="col-md-4">
                                <input type="tel" class="form-control" name="phone" pattern="07[7-9]{1}[0-9]{7}" value ="<?php echo '0' . $row['PhoneNumber']?>" required = "required" placeholder="Ex: 0775772008"> 
                            </div>
                            <!--End Phone -->
                        </div>
                        <div class="form-group row">
                            <!-- Start Email -->
                            <label class="col-md-2 form-label">Profile Pictuer</label>
                            <div class="col-md-4">
                                <input type="file" class="form-control" name="profilePic"> 
                            </div>
                            <!--End email -->
                        </div>
                        <!--Start Save -->
                        <div class="form-group row">
                            <div class="col-md-3 col-lg-3 offset-md-2 offset-lg-2">
                                <input type="submit" value="Edit Member" class="btn btn-warning"/>
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
                       <h1 class="text-center border-bottom"><?php echo lang('update');?></h1>
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
                    $id = $_POST['userid'];
                    $username = $_POST['username'];
                    $fullname = $_POST['fullname'];
                    $address = $_POST['address'];
                    $email = $_POST['email'];
                    $phone = $_POST['phone'];
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
                    if(empty($email)){
                        $formErrors[] = 'Email can\'t be <strong>empty</strong>';
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
                        
                        $stmt2 = $con->prepare("SELECT * FROM users WHERE Username =? AND UserID != ?");
                        $stmt2 ->execute(array($username, $id));
                        $count2 = $stmt2->rowCount();
                        if ($count2 == 1){
                            echo "<div class='container'>" . "</br>";
                            $alertMsg='<div class="alert alert-danger" role="alert"><strong>Sorry This User Is Exsit</strong></div>';
                            redirctAlert($alertMsg,'back');
                            echo "</div>";
                        }else{
                            $Profile_Pic="def-pic.png";
                            if(!empty($profilePic_name)){
                                $Profile_Pic = rand(0,100000000).'_'.$profilePic_name;
                                move_uploaded_file($profilePic_tmp,"uploads\profile_pic\\".$Profile_Pic);
                            }

                            // update the database with this information
                            $stmt = $con->prepare("UPDATE users SET Username = ? ,FullName = ? ,Email = ? ,PhoneNumber = ? , Address = ?, Password = ?, ProfilePic= ? WHERE UserID =  ? ");
                            $stmt->execute(array($username , $fullname , $email , $phone , $address , $pass ,$Profile_Pic , $id ));
                            //echo sucsses message 
                            $alertMsg= '<div class="alert alert-success" role="alert">' .  $stmt ->rowCount() . ' Record Updated</div>';
                            redirctAlert($alertMsg,'back');
                            echo "</div>";
                        }
                    }
                }else{
                    echo "<div class='container'>" . "</br>";
                    $alertMsg= '<div class="alert alert-danger" role="alert"><strong>Sorry You Can\'t Browse This Page Direct</strong></div>';
                    redirctAlert($alertMsg,'back');
                    echo "</div>";
                }
        }elseif($do == 'Delete'){
            //delete members
            ?>
                <h1 class="text-center border-bottom"><?php echo lang('delete');?></h1>
            <?php

                echo "<div class='container'>";
            //Protaction page
            //and chech if userid is numeric and get the integer value of it 
            $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) :0;
            //select all data that have relation of this this userid with my function
            $check = checkItem('UserID' , 'users' ,$userid);
            /*
            select all data that have relation of this this userid 
            $stmt = $con->prepare(" SELECT * FROM users WHERE UserID = ? LIMIT 1");
            $stmt->execute(array($userid));
            $count = $stmt->rowCount();
            */
            if($check > 0){
                $stmt = $con->prepare("DELETE FROM users WHERE UserID =:DID");
                $stmt->bindParam(':DID',$userid);
                $stmt->execute();
                $alertMsg='<div class="alert alert-success" role="alert">' .  $stmt ->rowCount() . ' Record Deleted</div>';
                redirctAlert($alertMsg,'back');
            }else{
                $alertMsg='<div class="alert alert-warning" role="alert">This ID is not exist</div>';
                redirctAlert($alertMsg);
            }
            echo "</div>";
        }else if($do == 'active'){
            ?>
                <h1 class="text-center border-bottom"><?php echo lang('Approval Members');?></h1>
            <?php
            echo "<div class='container'>";
            $userid= isset($_GET['userid']) && is_numeric($_GET['userid'])? intval($_GET['userid']) : 0;
            $check = checkItem('UserID' , 'users' , $userid);
            if($check > 0){
                $stmt = $con->prepare("UPDATE users SET RegStatus=1 WHERE UserID=?");
                $stmt->execute(array($userid));
                $alertMsg='<div class="alert alert-success" role="alert">' .  $stmt ->rowCount() . ' Record Approve</div>';
                redirctAlert($alertMsg,'back');
            }else{
                $alertMsg='<div class="alert alert-warning" role="alert">This ID is not exist</div>';
                redirctAlert($alertMsg);
            }
            echo "</div>";
        }
        //*******************end members page ********************
        include $temp .'footer.php';
    }else{
        header('Location:index.php');
        exit();
    }
    ob_end_flush();
?>