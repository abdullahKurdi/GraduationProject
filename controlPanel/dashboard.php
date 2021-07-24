<?php
    ob_start("ob_gzhandler");// output buffering start
    session_start();
    if(isset($_SESSION['Username'])){
        $pageTitle = 'Dashboard';
        include 'init.php';
        $latestFiveDashboard=4;
        $latest =getLatest('*','users','UserID',$latestFiveDashboard ,'WHERE GroupID = 0');
        $latest2 =getLatest('*','items','Item_ID',$latestFiveDashboard);
        ?>
        <!-- *******************start dashboard******************* -->
        <div class="container dash">
            <h1 class="text-center border-bottom"><?php echo lang('Home');?></h1>
            <div class="row">
                <div class="col-md-3">  
                    <div class="stat st-member text-center">
                        <i class="iconfa fa fa-users"></i>
                        <div class="info">Total Members
                            <a href= "members.php">
                                <span><?php echo countItem('UserID' , 'users');?></span>
                            </a>    
                        </div>
                    </div>
                </div>
                <div class="col-md-3">  
                    <div class="stat st-pending text-center">
                        <i class="iconfa2 fa fa-cogs"></i> 
                        <div class="info">Pending Members
                            <a href= "members.php?do=Manage&page=pending">
                                <span><?php echo checkItem("RegStatus" , "users", 0);?></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">  
                    <div class="stat st-item text-center">
                        <i class="iconfa3 fa fa-tag"></i>
                        <div class="info">Total Items
                            <a href= "items.php">
                                <span><?php echo countItem2('Item_ID' , 'items');?></span>
                            </a>  
                        </div>
                    </div>
                </div>
                <div class="col-md-3">  
                    <div class="stat st-comment text-center">
                        <i class="iconfa4 fa fa-comments"></i>
                        <div class="info">Total Notification
                            <a href= "notifications.php">
                                <span><?php echo countItem2('C_ID' , 'notifications');?></span>
                            </a>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container latest">
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-users"></i> Latest <?php echo $latestFiveDashboard;?> Registered Users
                            <span class="toggle-info pull-right">
                                <i class="fa fa-minus fa-lg"></i>
                            </span>
                        </div>
                        <div class="panel-body">
                            <ul class="list-group list-group-flush">
                                 <?php
                                 if(!empty ($latest)){
                                    foreach($latest as $users){
                                        echo '<li class="list-group-item">' . $users['Username']; 
                                        echo "<a href='members.php?do=Edit&userid=" . $users['UserID'] . "'class='latestbtn btn btn btn-warning btn-sm pull-right'><i class='fa fa-edit'></i>Edit</a>";
                                        echo "<a href='members.php?do=Delete&userid=" . $users['UserID'] . "'class='latestbtn btn btn btn-danger btn-sm pull-right'><i class='fa fa-close'></i>Delete</a>";
                                        if ($users['RegStatus']== 0){ 
                                            echo "<a href='members.php?do=active&userid=" . $users['UserID'] . "' class='latestbtn btn btn btn-success btn-sm pull-right'><i class='fa fa-check'></i>Approve</a>";
                                        }    
                                    echo "</li>";
                                  }
                                }else{
                                    echo '<div class="container">';
                                        echo '<div class="nice-message2">There\'s No Record To Show</div>';
                                    echo '</div>';;
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-tag"></i> Latest <?php echo $latestFiveDashboard;?> Items
                            <span class="toggle-info pull-right">
                                <i class="fa fa-minus fa-lg"></i>
                            </span>
                        </div>
                        <div class="panel-body">
                            <ul class="list-group list-group-flush">
                                 <?php
                                 if(!empty ($latest2)){
                                    foreach($latest2 as $items){
                                        echo '<li class="list-group-item">' . $items['Name']; 
                                        echo "<a href='items.php?do=Edit&item_id=" . $items['Item_ID'] . "'class='latestbtn btn btn btn-warning btn-sm pull-right'><i class='fa fa-edit'></i>Edit</a>";
                                        echo "<a href='items.php?do=Delete&item_id=" . $items['Item_ID'] . "'class='latestbtn btn btn btn-danger btn-sm pull-right'><i class='fa fa-close'></i>Delete</a>";
                                        echo "<a href='items.php?do=Show&item_id=" . $items['Item_ID'] . "' class='latestbtn btn btn btn-info btn-sm pull-right'>Comments</a>";
                                    if ($items['Active']== 0){ 
                                        echo "<a href='items.php?do=Active&item_id=" . $items['Item_ID'] . "' class='latestbtn btn btn btn-primary btn-sm pull-right'><i class='fa fa-check'></i>Active</a>";
                                        }    
                                    echo "</li>";
                                  }
                                }else{
                                    echo '<div class="container">';
                                      echo '<div class="nice-message2">There\'s No Record To Show</div>';
                                    echo '</div>';                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-comments"></i> Latest <?php echo $latestFiveDashboard;?> Comments
                            <span class="toggle-info pull-right">
                                <i class="fa fa-minus fa-lg"></i>
                            </span>
                        </div>
                        <div class="panel-body">
                        <?php
                            $stmt= $con->prepare("SELECT 
                                            notifications.*,users.Username 
                                                 FROM 
                                                     notifications
                                    
                                                 INNER JOIN
                                                     users
                                                 ON 
                                                     users.UserID = notifications.User_ID 
                                                 WHERE  Bidding_Status = 0 AND Buyer_Status = 0
                                                 ORDER BY C_ID DESC
                                                 LIMIT $latestFiveDashboard");

                            $stmt->execute();
                            $comments= $stmt->fetchAll();
                            if(!empty ($comments)){
                                foreach ($comments as $comment){
                                    echo '<div class="comment-box">';
                                        echo '<p class="member-n">' . $comment['Username'] . '</p>';
                                        echo '<p class="member-c">' . $comment['Comment'] . '</p>';
                                    echo '</div>';
                                }
                            }else{
                                echo '<div class="container">';
                                    echo '<div class="nice-message2">There\'s No Record To Show</div>';
                                echo '</div>';
                             }
                        ?>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <!-- *******************end dashboard******************* -->
        <?php
        include $temp .'footer.php';
    }else{
        header('Location:index.php');
        exit();
    }
    ob_end_flush();
?>