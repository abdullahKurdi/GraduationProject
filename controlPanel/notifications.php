<?php
    ob_start("ob_gzhandler");// output buffering start
    // manage members page you can add delete edit from here 
    session_start();
    $pageTitle = 'Notifications';
    if(isset($_SESSION['Username'])){
        include 'init.php';
        //*******************start members page ********************

        $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
        // start manage page
        if($do == 'Manage'){//manage page 
            $limit =15;
            $page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']): 1 ;
            $start = ($page - 1) * $limit;
            $stmt= $con->prepare("SELECT 
                                        notifications.*, items.Name ,users.Username 
                                  FROM 
                                        notifications
                                  INNER JOIN
                                        items
                                  ON 
                                        items.Item_ID = notifications.Item_ID 
                                  INNER JOIN
                                        users
                                  ON 
                                        users.UserID = notifications.User_ID 
                                  ORDER BY C_id DESC LIMIT $start , $limit");
            $stmt->execute();
            $rows= $stmt->fetchAll();
            $total = getItemCount('C_ID','notifications');
            $pages = ceil($total[0]/$limit);
            $Previous = $page - 1 ;
            $Next = $page + 1;
            if(!empty($rows)){
        ?>
            <h1 class="text-center border-bottom"><?php echo lang('managenot');?></h1>
            <div class="container-fluid">
                <div class="scroll table-responsive">
                    <table class="table text-center table-light table-hover table-striped">
                        <thead>
                            <tr>
                                <td class="table-dark">ID</td>
                                <td>Item Name</td>
                                <td>User Name</td>
                                <td>Comment</td>
                                <td>Buyer</td>
                                <td>Bidding</td>
                                <td>Add Date</td>
                                <td class="contr" >Control</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($rows as $row){
                                    echo "<tr>";
                                        echo "<td>" . $row['C_ID'] . "</td>";
                                        echo "<td>" . $row['Name'] . "</td>";
                                        echo "<td>" . $row['Username'] . "</td>";
                                        echo "<td>" . $row['Comment'] . "</td>";
                                        echo "<td>" . $row['Buyer_Status'] . "</td>";
                                        echo "<td>" . $row['Bidding_Status'] . "</td>";
                                        echo "<td>" . $row['C_Date'] . "</td>";
                                        if ($row['Comment'] != '0' ){ 
                                            echo "<td>
                                                 <a href='notifications.php?do=Edit&notid=" . $row['C_ID'] . "' class='tbtn btn btn btn-warning btn-sm'><i class='fa fa-edit'></i>Edit</a>
                                                 <a href='notifications.php?do=Delete&notid=" . $row['C_ID'] . "' class='tbtn confirm btn btn-danger btn-sm'><i class='fa fa-close'></i>Delete</a>";
                                                if ($row['C_Status']== 0 && $row['Bidding_Status']==0 && $row['Buyer_Status']==0){ 
                                                    echo " <a href='notifications.php?do=Approve&notid=" . $row['C_ID'] . "' class='tbtnw btn btn btn-success btn-sm'><i class='fa fa-check'></i>Approve</a>";
                                                    }
                                                }else{
                                                    echo "<td>" . "</td>";
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
            </div>
            <?php 
            }else {
                echo '<div class="container">';
                    echo '<div class="nice-message">There\'s No Record To Show</div>';
                 echo '</div>';   
            } 
                ?>
    <?php
        
            }else if($do == 'Edit'){// edit page

            //Protaction page
            //and chech if userid is numeric and get the integer value of it 
            $notid = isset($_GET['notid']) && is_numeric($_GET['notid']) ? intval($_GET['notid']) :0;
            //select all data that have relation of this this userid 
            $stmt = $con->prepare(" SELECT * FROM notifications WHERE C_ID = ? LIMIT 1");
            $stmt->execute(array($notid));
            $row = $stmt ->fetch();
            $count = $stmt->rowCount();
            if($count > 0){ ?>
            <!-- .....................start html tags...................-->  
                <h1 class="text-center border-bottom"><?php echo lang('editcom');?></h1>
                <div class="container">
                    <form class="form-horizontal" action="?do=Update" method="POST">
                        <input type="hidden" name="notid" value="<?php echo $notid ;?>"/>
                        <div class="form-group row">
                            <!--Start comment -->
                            <label class="col-md-2 form-label">Comment</label>
                            <div class="col-md-4">
                                <textarea class="form-control" name="comment"><?php echo $row['Comment']?></textarea>
                            </div>
                            <!--end comment-->
                        <!--Start Save -->
                        <div class="form-group row">
                            <div class="col-md-3 col-lg-3 offset-md-2 offset-lg-2">
                                <input type="submit" value="Edit Comment" class="btn btn-warning"/>
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
                       <h1 class="text-center border-bottom"><?php echo lang('updatecom');?></h1>
                    <?php

                    echo "<div class='container'>";
                    //get variables 
                    $notid = $_POST['notid'];
                    $comment = $_POST['comment'];
                   

                    // update the database with this information
                    $stmt = $con->prepare("UPDATE notifications SET Comment = ?  WHERE C_ID =  ? ");
                    $stmt->execute(array($comment ,$notid ));
                    //echo sucsses message 
                    $alertMsg= '<div class="alert alert-success" role="alert">' .  $stmt ->rowCount() . ' Record Updated</div>';
                    redirctAlert($alertMsg,'back');
                    echo "</div>";
                    
                }else{
                    echo "<div class='container'>" . "</br>";
                    $alertMsg='<div class="alert alert-danger" role="alert"><strong>Sorry You Can\'t Browse This Page Direct</strong></div>';
                    redirctAlert($alertMsg,'back');
                    echo "</div>";
                }
        }elseif($do == 'Delete'){
            //delete members
            ?>
                <h1 class="text-center border-bottom"><?php echo lang('deleteCOM');?></h1>
            <?php

                echo "<div class='container'>";
            //Protaction page
            //and chech if userid is numeric and get the integer value of it 
            $notid = isset($_GET['notid']) && is_numeric($_GET['notid']) ? intval($_GET['notid']) :0;
            //select all data that have relation of this this userid with my function
            $check = checkItem('C_ID' , 'notifications' ,$notid);
            /*
            select all data that have relation of this this userid 
            $stmt = $con->prepare(" SELECT * FROM users WHERE UserID = ? LIMIT 1");
            $stmt->execute(array($userid));
            $count = $stmt->rowCount();
            */
            if($check > 0){
                $stmt = $con->prepare("DELETE FROM notifications WHERE C_ID =:DID");
                $stmt->bindParam(':DID',$notid);
                $stmt->execute();
                $alertMsg='<div class="alert alert-success" role="alert">' .  $stmt ->rowCount() . ' Record Deleted</div>';
                redirctAlert($alertMsg,'back');
            }else{
                $alertMsg='<div class="alert alert-warning" role="alert">This ID is not exist</div>';
                redirctAlert($alertMsg);
            }
            echo "</div>";
        }else if($do == 'Approve'){
            ?>
                <h1 class="text-center border-bottom"><?php echo lang('Approval Comment');?></h1>
            <?php
            echo "<div class='container'>";
            $notid= isset($_GET['notid']) && is_numeric($_GET['notid'])? intval($_GET['notid']) : 0;
            $check = checkItem('C_ID' , 'notifications' , $notid);
            if($check > 0){
                $stmt = $con->prepare("UPDATE notifications SET C_Status=1 WHERE C_ID=?");
                $stmt->execute(array($notid));
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