<?php
    ob_start("ob_gzhandler");
    session_start();
    $pageTitle = 'Logistics';
    if(isset($_SESSION['Username'])){
        include 'init.php';
/**********************************************************************************/
        $do = isset($_GET['do']) ? $_GET['do'] : 'ManageAdver';
        /********************Start Managa Bidding Page**************************/
        if($do == 'ManageBidding'){ 
            /************Get Orders Record From Database*********/
            $stmt= $con->prepare("SELECT 
                                        Orders.* , users.UserID AS ItemTo , items.Item_ID AS ItemName , items.Member_ID AS ItemFrom
                                  FROM 
                                        orders
                                  INNER JOIN
                                        items
                                  ON
                                        orders.Item_ID = items.Item_ID
                                  INNER JOIN
                                        users
                                  ON 
                                        orders.Member_id = users.UserID
                                  where
                                    OrderType = 0
                                  ORDER BY Orders.Order_id DESC");
            $stmt->execute();
            $rows= $stmt->fetchAll();
            $count=$stmt->rowCount();
            if ($count>0){?>
                <h1 class="text-center border-bottom">Logistics Page</h1>
                <div class="container-fluid">
                    <table class="table table-sm">
                        <caption>Orders of Bidding</caption>
                        <thead>
                            <tr class="table-dark">
                                <th class="table-dark" scope="col">Item Name</th>
                                <th class="c1 table-dark" class="Control-Orders table-dark" scope="col">Control</th>
                                <th class="table-secondary" scope="col">Item From</th>
                                <th class="c2 table-secondary" class="Control-Orders table-dark" scope="col">Control</th>
                                <th class="table-light" scope="col">Item To</th>
                                <th class="c3 table-light" class="Control-Orders table-dark" scope="col">Control</th>
                            </tr>
                        </thead>
                        <tbody class="table-secondary">
                        <?php foreach ($rows as $row){
                                $item1       = getItem('Name,Item_ID','items','WHERE Item_ID ='.$row['ItemName']);
                                $member_from  = getItem('Username,UserID','users','WHERE UserID ='.$row['ItemFrom']);
                                $member_to  = getItem('Username,UserID','users','WHERE UserID ='.$row['ItemTo']);?>
                                <tr>
                                    <th class="table-dark" scope="row"><?php echo $item1[0]['Name'];?></th>
                                    <td class="Control-info table-dark" >
                                        <a href="logistics.php?do=Item_Control&Item_ID=<?php echo $item1[0]['Item_ID'];?>" class="c_control btn btn-primary">Show And Control</a>
                                    </td>
                                    <td class="table-secondary"><?php echo $member_from[0]['Username'];?></td>
                                    <td class="Control-info table-secondary" >
                                        <a href="logistics.php?do=UsersFrom&Item_From=<?php echo $member_from[0]['UserID'];?>" class="c_control btn btn-warning">Show Information</a>
                                    </td>
                                    <td class="table-light"><?php echo $member_to[0]['Username'];?></td>
                                    <td class="Control-Orders table-light" >
                                        <a href="logistics.php?do=Users&Item_To=<?php echo $member_to[0]['UserID'];?>" class="c_control btn btn-warning">Show Information</a>
                                    </td>
                                </tr>
                            <?php }?>
                        </tbody>
                    </table>
                    <div class="agree">
                    <?php foreach ($rows as $row){
                        if($row['AgreeOrder']==1){
                            $item1       = getItem('Name,Item_ID','items','WHERE Item_ID ='.$row['ItemName']);
                            $member_from  = getItem('Username,UserID','users','WHERE UserID ='.$row['ItemFrom']);
                            $member_to  = getItem('Username,UserID','users','WHERE UserID ='.$row['ItemTo']);
                            ?>
                            <div class="alert alert-info">
                                <a href="logistics.php?do=Users&Item_To=<?php echo $member_to[0]['UserID'];?>"><?php echo $member_to[0]['Username'];?></a> is Agree on This Item (<a href="logistics.php?do=Item_Control&Item_ID=<?php echo $item1[0]['Item_ID'];?>"><?php echo $item1[0]['Name'];?></>) 
                            </div>
                            <?php
                            }
                    }?>
                    </div>
                </div>
                <?php
            }else{
                echo '<div class="container">';
                echo '<div class="nice-message">There\'s No Record To Show</div>';
                echo '</div>'; 
            }
        /********************End Managa Bidding Page**************************/
        /********************Start Managa Buyer Page**************************/
        }else if($do == 'ManageBuyer'){
            /************Get Orders Record From Database*********/
            $stmt= $con->prepare("SELECT 
                                    Orders.* , users.UserID AS ItemTo , items.Item_ID AS ItemName , items.Member_ID AS ItemFrom
                                FROM 
                                    orders
                                INNER JOIN
                                    items
                                ON
                                    orders.Item_ID = items.Item_ID
                                INNER JOIN
                                    users
                                ON 
                                    orders.Member_id = users.UserID
                                where
                                    OrderType = 1
                                ORDER BY Orders.Order_id DESC");
            $stmt->execute();
            $rows= $stmt->fetchAll();
            $count=$stmt->rowCount();
            if ($count>0){?>
                <h1 class="text-center border-bottom">Logistics Page</h1>
                <div class="container-fluid">
                    <table class="table table-sm">
                        <caption>Orders of Buyer</caption>
                        <thead>
                            <tr class="table-dark">
                                <th class="table-dark" scope="col">Item Name</th>
                                <th class="c1 table-dark" class="Control-Orders table-dark" scope="col">Control</th>
                                <th class="table-info" scope="col">Item From</th>
                                <th class="c2 table-info" class="Control-Orders table-dark" scope="col">Control</th>
                                <th class="table-danger" scope="col">Item To</th>
                                <th class="c3 table-danger" class="Control-Orders table-dark" scope="col">Control</th>
                            </tr>
                        </thead>
                        <tbody class="table-light">
                            <?php foreach ($rows as $row){
                                $item1       = getItem('Name,Item_ID','items','WHERE Item_ID ='.$row['ItemName']);
                                $member_from  = getItem('Username,UserID','users','WHERE UserID ='.$row['ItemFrom']);
                                $member_to  = getItem('Username,UserID','users','WHERE UserID ='.$row['ItemTo']);?>
                                <tr>
                                    <th class="table-dark" scope="row"><?php echo $item1[0]['Name'];?></th>
                                    <td class="Control-info table-dark" >
                                        <a href="logistics.php?do=Item_Control&Item_ID=<?php echo $item1[0]['Item_ID'];?>" class="c_control btn btn-primary">Show And Control</a>
                                    </td>
                                    <td class="table-info"><?php echo $member_from[0]['Username'];?></td>
                                    <td class="Control-info table-info" >
                                        <a href="logistics.php?do=UsersFrom&Item_From=<?php echo $member_from[0]['UserID'];?>" class="c_control btn btn-warning">Show Information</a>
                                    </td>
                                    <td class="table-danger"><?php echo $member_to[0]['Username'];?></td>
                                    <td class="Control-Orders table-danger" >
                                        <a href="logistics.php?do=Users&Item_To=<?php echo $member_to[0]['UserID'];?>" class="c_control btn btn-warning">Show Information</a>
                                    </td>
                                </tr>
                            <?php }?>
                        </tbody>
                    </table>
                    <div class="agree">
                    <?php foreach ($rows as $row){
                        if($row['AgreeOrder']==1){
                            $item1       = getItem('Name,Item_ID','items','WHERE Item_ID ='.$row['ItemName']);
                            $member_from  = getItem('Username,UserID','users','WHERE UserID ='.$row['ItemFrom']);
                            $member_to  = getItem('Username,UserID','users','WHERE UserID ='.$row['ItemTo']);
                            ?>
                            <div class="alert alert-info">
                                <a href="logistics.php?do=Users&Item_To=<?php echo $member_to[0]['UserID'];?>"><?php echo $member_to[0]['Username'];?></a> is Agree on This Item (<a href="logistics.php?do=Item_Control&Item_ID=<?php echo $item1[0]['Item_ID'];?>"><?php echo $item1[0]['Name'];?></>) 
                            </div>
                            <?php
                            }
                    }?>
                    </div>
                </div>
            <?php
            }else{
                echo '<div class="container">';
                echo '<div class="nice-message">There\'s No Record To Show</div>';
                echo '</div>'; 
            }
            /********************End Managa Buyer Page**************************/
        }else if($do == 'Users'){
            $user  = isset($_GET['Item_To']) ? $_GET['Item_To'] : '0';
            $check = checkItem('Member_id','Orders',$user);
            if($check >0){
                $UserInformaion= getItem('*','users','WHERE UserID='.$user);?>
                    <div class="UsersLog container">
                    <div class="card " >
                        <div class="row">
                            <div class="ar col-lg-4">
                                <img src="../controlPanel/uploads/profile_pic/<?php echo $UserInformaion[0]['ProfilePic'];?>" alt="...">
                            </div>
                            <div class="col-lg-8">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $UserInformaion[0]['FullName'];?></h5>
                                    <ul class="list-group">
                                        <li class="list-group-item"><span>Email : </span><span class="pull-right"><?php echo $UserInformaion[0]['Email'];?></span></li>
                                        <li class="list-group-item">Phone : <span class="pull-right">0<?php echo $UserInformaion[0]['PhoneNumber'];?></span></li>
                                        <li class="list-group-item">Address : <span class="pull-right"><?php echo $UserInformaion[0]['Address'];?></span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                <?php 
            }else{
                echo '<div class="container">';
                echo '<div class="nice-message">There\'s No Record In Orders In This ID</div>';
                echo '</div>';
                header('Refresh:5; url=logistics.php');
                exit();
            }
        }else if($do == 'UsersFrom'){
            $user  = isset($_GET['Item_From']) ? $_GET['Item_From'] : '0';
            // $UserItem = getItem('Item_ID','items','WHERE Member_ID='.$user);
            // if (isset($UserItem[0]['Item_ID'] )){
            //     $check = checkItem('Item_id','Orders',$UserItem[0]['Item_ID']);
                    $check = checkItem('UserID','users',$user);
                if($check > 0){
                    $UserInformaion= getItem('*','users','WHERE UserID='.$user);?>
                    <div class="UsersLog container">
                    <div class="card " >
                        <div class="row">
                            <div class="ar col-lg-4">
                                <img src="../controlPanel/uploads/profile_pic/<?php echo $UserInformaion[0]['ProfilePic'];?>" alt="...">
                            </div>
                            <div class="col-lg-8">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $UserInformaion[0]['FullName'];?></h5>
                                    <ul class="list-group">
                                        <li class="list-group-item"><span>Email : </span><span class="pull-right"><?php echo $UserInformaion[0]['Email'];?></span></li>
                                        <li class="list-group-item">Phone : <span class="pull-right">0<?php echo $UserInformaion[0]['PhoneNumber'];?></span></li>
                                        <li class="list-group-item">Address : <span class="pull-right"><?php echo $UserInformaion[0]['Address'];?></span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                <?php 
                }else{
                    echo '<div class="container">';
                    echo '<div class="nice-message">There\'s No Record In Orders In This ID</div>';
                    echo '</div>';
                    header('Refresh:5; url=logistics.php');
                    exit();
                }
            // }else{
            //     echo '<div class="container">';
            //     echo '<div class="nice-message">There\'s No Record In Orders In This ID</div>';
            //     echo '</div>';
            //     header('Refresh:5; url=logistics.php');
            //     exit();
            // }
        }elseif($do == 'Item_Control'){
            $itemid = isset($_GET['Item_ID']) ? $_GET['Item_ID'] : '0';
            $check = checkItem('Item_id','Orders',$itemid);
            if($check > 0){
                $ItemInformaion= getItem('*','items','WHERE Item_ID='.$itemid);
                $imgs = explode('|',$ItemInformaion[0]['Image']);
                $img_count=count($imgs);
                // print_r($ItemInformaion);?>
                <div class="ItemShow container">
                    <div class="row ItemPic">
                        <div id="carouselExampleInterval" class="carousel slide" data-ride="carousel" data-touch="false" data-interval="false">
                            <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="../controlPanel/uploads/item_pic/<?php echo $imgs[0];?>" class="d-block img_item" alt="...">
                            </div>
                                <?php for($t = 1 ; $t < $img_count ; $t++){?>
                                <div class="carousel-item" data-interval="10000">
                                    <img src="../controlPanel/uploads/item_pic/<?php echo $imgs[$t];?>" class="d-block w-100" alt="...">
                                </div>
                                <?php }?>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                    <div class="info row">
                        <div class="item col-lg-7">
                            <ul class="list-group">
                                <li class="list-group-item">Item ID : <span class="pull-right"><?php echo $ItemInformaion[0]['Item_ID'];?></span></li>
                                <li class="list-group-item">Item Name :<span class="pull-right"><?php echo $ItemInformaion[0]['Name'];?></span></li>
                                <li class="list-group-item">Item Price :<span class="pull-right"><?php echo $ItemInformaion[0]['Price'];?></span></li>
                                <li class="list-group-item">Item Country :<span class="pull-right"><?php echo $ItemInformaion[0]['Country_Made'];?></span></li>
                                <li class="list-group-item">Item City :<span class="pull-right"><?php echo $ItemInformaion[0]['City_Made'];?></span></li>
                                <li class="list-group-item">Item Status :<span class="pull-right"><?php echo $ItemInformaion[0]['Status'];?></span></li>
                            </ul>
                        </div>
                        <div class="item2 col-lg-4 ml-md-auto">
                            <ul class="list-group">
                            <h5 class="card-title">Description</h5>
                                <li class="list-group-item"><?php echo $ItemInformaion[0]['Description'];?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="control">
                       <?php 
                            $contrl = getItemgg('*','Orders','WHERE Item_id='.$itemid);
                            $check = checkItem('Item_id','Orders',$itemid);
                            if ($check >=1){?>
                            <form class="row" action="<?php echo $_SERVER['PHP_SELF'].'?do=Control&Item_ID='.$itemid;?>" method="post">
                                <?php 
                                $count =0; 
                                foreach ($contrl as $evaluation) {
                                    if ($evaluation['OrderStatus'] == 0){
                                        $count = $count + 1;
                                        // echo $evaluation['OrderStatus'] . "</br>";
                                    }
                                }
                                    if($count !=0){
                                ?>
                                <div class="col-lg-8 rang">
                                    <div class="form-group">
                                        <label for="formControlRange">Rate</label>
                                        <input type="range" name="rate" class="form-control-range" id="formControlRange">
                                    </div>
                                    </br>
                                    <div class="form-group"><input type="submit" class="btn confirm btn-danger" name="Dont_get" value="I didn't get the product"></div>
                                    </br>
                                    <div class="form-group"><input type="submit" class="btn confirm btn-success" name="Sending" value="Sending the evaluation"></div>
                                    </br>
                                </div>
                                <?php }else{?>
                                    <div class="col-lg-8 rang">
                                    <h5 class="alert alert-info">This Item Has Been Evaluated</h5>
                                    <div class="form-group"><input type="submit" class="btn confirm btn-danger" name="Dontbe2" value="He doesn't want to get it."></div>
                                    </br>
                                    <div class="form-group"><input type="submit" class="btn confirm btn-primary" name="DoneItem" value="Sold"></div>
                                    </br>
                                </div>
                                <?php }?>
                                <div class="col-lg-4 Form">
                                <ul class="list-group">
                                <?php foreach ($contrl as $item){
                                    if ($item['OrderType'] == 0){
                                        $userinfo = getItem('*','users','where UserID='.$item['Member_id']);
                                        ?>
                                        <li class="win list-group-item">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="Bidding" id="exampleRadios1" value="<?php echo $userinfo[0]['UserID'];?>" checked>
                                                <label class="form-check-label" for="exampleRadios1">
                                                <?php echo '<a href="logistics.php?do=Users&Item_To='.$userinfo[0]['UserID'].'">'.$userinfo[0]['FullName'];?></a> Is Win Auction                                        
                                            </label>
                                            </div>
                                        </li>
                                <?php }elseif($item['OrderType'] == 1){
                                        $userinfo = getItem('*','users','where UserID='.$item['Member_id']);
                                    ?>
                                        <li class="buy list-group-item">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="Buyer[]" id="Radios1" value="<?php echo $userinfo[0]['UserID'];?>" >
                                            <label class="form-check-label" for="exampleRadios1">
                                                <?php echo '<a href="logistics.php?do=Users&Item_To='.$userinfo[0]['UserID'].'">'.$userinfo[0]['FullName'];?></a> Is Wan't Buy It 
                                            </label>
                                        </div>
                                        </li>
                                <?php }
                                }
                                ?>
                                </ul>
                                </div>
                                </form>
                            <?php }
                       ?>
                    </div>
                </div>
            <?php }else{
                echo '<div class="container">';
                echo '<div class="nice-message">There\'s No Record In Orders In This ID</div>';
                echo '</div>';
                header('Refresh:5; url=logistics.php');
                exit();
            }

        }elseif($do=='Control'){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                if(isset($_POST['Dont_get'])){
                    // $rate = $_POST['rate'];
                    $itemid = isset($_GET['Item_ID']) ? $_GET['Item_ID'] : '0'; 
                    if (isset($_POST['Bidding'])){
                        $winner = $_POST['Bidding'];
                        $SUm = $con->prepare('SELECT SUM(Bidding_Status) FROM `notifications` WHERE User_ID=?');
                        $SUm ->execute(array($winner));
                        $result = $SUm->fetch();
                        // echo $result[0];
                        // print_r ($result);
                        $stmt = $con->prepare("UPDATE users SET BidPoint = BidPoint+$result[0] WHERE UserID =  ? ");
                        $stmt->execute(array($winner));
                    }
                    if (isset($_POST['Buyer'])){
                        $buyer = $_POST['Buyer'];
                        foreach($buyer as $buy){
                            $stmt = $con->prepare("UPDATE users SET BidPoint = BidPoint+1 WHERE UserID = ?");
                            $stmt->execute(array($buy));
                        }
                    }
                    $BlackList  = getItem('Member_ID','items','WHERE Item_ID ='.$itemid);
                    $BlackList = $BlackList[0]['Member_ID'];
                    $stmt4 = $con->prepare("UPDATE users SET TrustStatus = 1 WHERE UserID =  ? ");
                    $stmt4->execute(array($BlackList));
                    $stmt2 = $con->prepare("DELETE FROM items WHERE Item_ID =:DID");
                    $stmt2->bindParam(':DID',$itemid);
                    $stmt2->execute();
                    echo '<div class="container">';
                    echo '<div class="nice-message">This Item Will Be Deleted And Everyone who bids or buys has got their points back</div>';
                    echo '</div>';
                    header('Refresh:5; url=logistics.php');
                    exit();
                }elseif(isset($_POST['Sending'])){
                    $rate='';
                    if (isset($_POST['rate'])){$rate = $_POST['rate'];}
                    $itemid = isset($_GET['Item_ID']) ? $_GET['Item_ID'] : '0';
                    if ($rate > 30){
                        $stmt4 = $con->prepare("UPDATE Orders SET OrderStatus = ? WHERE Item_id =  ? ");
                        $stmt4->execute(array($rate,$itemid));
                        echo '<div class="container">';
                        echo '<div class="nice-message">This Item Will Be Evaluat '.$rate.'% And This evaluated will be Sent To Winner</div>';
                        echo '</div>';
                        header('Refresh:5; url=logistics.php');
                        exit();
                        // echo $rate;
                    }elseif ($rate <30 ){
                        if (isset($_POST['Bidding'])){
                            $winner = $_POST['Bidding'];
                            $SUm = $con->prepare('SELECT SUM(Bidding_Status) FROM `notifications` WHERE User_ID=?');
                            $SUm ->execute(array($winner));
                            $result = $SUm->fetch();
                            // echo $result[0];
                            // print_r ($result);
                            $stmt = $con->prepare("UPDATE users SET BidPoint = BidPoint+$result[0] WHERE UserID =  ? ");
                            $stmt->execute(array($winner));
                        }
                        if (isset($_POST['Buyer'])){
                            $buyer = $_POST['Buyer'];
                            foreach($buyer as $buy){
                                $stmt = $con->prepare("UPDATE users SET BidPoint = BidPoint+1 WHERE UserID =  ? ");
                                $stmt->execute(array($buy));
                            }
                        }
                        $BlackList  = getItem('Member_ID','items','WHERE Item_ID ='.$itemid);
                        $BlackList = $BlackList[0]['Member_ID'];
                        $stmt4 = $con->prepare("UPDATE users SET TrustStatus = 1 WHERE UserID =  ? ");
                        $stmt4->execute(array($BlackList));
                        $stmt2 = $con->prepare("DELETE FROM items WHERE Item_ID =:DID");
                        $stmt2->bindParam(':DID',$itemid);
                        $stmt2->execute();
                        echo '<div class="container">';
                        echo '<div class="nice-message">This Item Will Be Deleted And Everyone who bids or buys has got their points back</div>';
                        echo '</div>';
                        header('Refresh:5; url=logistics.php');
                        exit();
                    }else{
                        echo '<div class="container">';
                        echo '<div class="nice-message">You Cant Sent With Out Evaluat</div>';
                        echo '</div>';
                        header('Refresh:5; url=logistics.php');
                    }
                }elseif(isset($_POST['Dontbe2'])){
                    $itemid = isset($_GET['Item_ID']) ? $_GET['Item_ID'] : '0';
                    $rate = getItemgg('OrderStatus','orders','where Item_id='.$itemid);
                    $rate= $rate[0]['OrderStatus'];
                    // print_r ($rate);
                    //   echo $rate;
                    // echo  $_POST['Bidding'];
                     if ($rate >30 && $rate <90){
                        // echo $rate;
                        // echo  $_POST['Bidding'];
                        if(isset($_POST['Bidding']) || isset($_POST['Buyer'])){
                        if (isset($_POST['Bidding'])){
                            $winner = $_POST['Bidding'];
                            // echo $winner;
                            $SUm = $con->prepare('SELECT SUM(Bidding_Status) FROM `notifications` WHERE User_ID=?');
                            $SUm ->execute(array($winner));
                            $result = $SUm->fetch();
                            // echo $result[0];
                            // print_r ($result);
                            $stmt = $con->prepare("UPDATE users SET BidPoint = BidPoint+$result[0] WHERE UserID =  ? ");
                            $stmt->execute(array($winner));
                            $stmt2 = $con->prepare("DELETE FROM orders WHERE Item_ID =? AND Member_id =?");
                            $stmt2->execute(array($itemid,$winner));
                            $NOTI = $con->prepare(" SELECT C_ID FROM `notifications` WHERE Item_ID =? AND  User_ID=? AND Bidding_Status=1  LIMIT 1");
                            $NOTI->execute(array($itemid,$winner));
                            $result = $NOTI->fetchAll();
                            $Noti = $result[0]['C_ID'];
                            // echo $Noti;
                            $stmt2 = $con->prepare("DELETE FROM notifications WHERE C_ID=?");
                            $stmt2->execute(array($Noti));
                           

                        }
                        if (isset($_POST['Buyer'])){
                            $buyer = $_POST['Buyer'];
                            foreach($buyer as $buy){
                                $stmt = $con->prepare("UPDATE users SET BidPoint = BidPoint+1 WHERE UserID =  ? ");
                                $stmt->execute(array($buy));
                                $stmt3 = $con->prepare("DELETE FROM orders WHERE Item_ID =? AND Member_id =?");
                                $stmt3->execute(array($itemid,$buy));
                                $NOTI = $con->prepare("SELECT C_ID FROM `notifications` WHERE Item_ID =? AND User_ID=? AND Buyer_Status=1 LIMIT 1");
                                $NOTI->execute(array($itemid,$buy));
                                $result = $NOTI->fetchAll();
                                $Noti = $result[0]['C_ID'];
                                // echo $Noti;
                                $stmt2 = $con->prepare("DELETE FROM notifications WHERE C_ID=?");
                                $stmt2->execute(array($Noti));
                            }
                        }
                        echo '<div class="container">';
                        echo '<div class="nice-message">Bidding user or buyer didn\'t accept the evaluated</div>';
                        echo '</div>';
                        header('Refresh:5; url=logistics.php');
                    }else{
                        echo '<div class="container">';
                        echo '<div class="nice-message">You Should checked at least one</div>';
                        echo '</div>';
                        header('Refresh:5; url=logistics.php');
                    }
                     }elseif($rate >89){
                        if (isset($_POST['Bidding'])){
                            $winner = $_POST['Bidding'];
                            $stmt4 = $con->prepare("UPDATE users SET TrustStatus=1 WHERE UserID = ?");
                            $stmt4->execute(array($winner));
                            $stmt2 = $con->prepare("DELETE FROM orders WHERE Item_ID =? AND Member_id =?");
                            $stmt2->execute(array($itemid,$winner));
                            $next7 = time() + (7*24*60*60);
                            $date = date('Y-m-d H:i:s' , $next7);
                            // echo $date;
                            $stmt4 = $con->prepare("UPDATE items SET EndStatus = 0, endBidding = ? WHERE Item_ID =  ? ");
                            $stmt4->execute(array($date,$itemid));
                            $NOTI = $con->prepare(" SELECT C_ID FROM `notifications` WHERE Item_ID =? AND Bidding_Status=1 ORDER BY C_ID DESC LIMIT 1");
                            $NOTI->execute(array($itemid));
                            $result = $NOTI->fetchAll();
                            $Noti = $result[0]['C_ID'];
                            $stmt2 = $con->prepare("DELETE FROM notifications WHERE C_ID=?");
                            $stmt2->execute(array($Noti));
                        }
                        if (isset($_POST['Buyer'])){
                            $buyer = $_POST['Buyer'];
                            foreach($buyer as $buy){
                                $stmt = $con->prepare("UPDATE users SET TrustStatus=1 WHERE UserID = ?");
                                $stmt->execute(array($buy));
                                $stmt3 = $con->prepare("DELETE FROM orders WHERE Item_ID =? AND Member_id =?");
                                $stmt3->execute(array($itemid,$buy));
                                $NOTI = $con->prepare(" SELECT C_ID FROM `notifications` WHERE Item_ID =? AND User_ID=? AND Buyer_Status=1 LIMIT 1");
                                $NOTI->execute(array($itemid,$buy));
                                $result = $NOTI->fetchAll();
                                $Noti = $result[0]['C_ID'];
                                $stmt2 = $con->prepare("DELETE FROM notifications WHERE C_ID=?");
                                $stmt2->execute(array($Noti));
                            }
                        echo '<div class="container">';
                        echo '<div class="nice-message">Bidding user or buyer didn\'t accept the evaluated</div>';
                        echo '</div>';
                        header('Refresh:5; url=logistics.php');
                        }else{
                            echo '<div class="container">';
                            echo '<div class="nice-message">You Should checked at least one</div>';
                            echo '</div>';
                            header('Refresh:5; url=logistics.php');
                        }
                     }
                }elseif(isset($_POST['DoneItem'])){
                    $itemid = isset($_GET['Item_ID']) ? $_GET['Item_ID'] : '0';
                    if(isset($_POST['Bidding']) || isset($_POST['Buyer'])){
                    if (isset($_POST['Bidding'])){
                        $winner = $_POST['Bidding'];
                        $SUm = $con->prepare('SELECT SUM(Bidding_Status) FROM `notifications` WHERE User_ID=?');
                        $SUm ->execute(array($winner));
                        $result = $SUm->fetch();
                        $stmt = $con->prepare("UPDATE users SET BidPoint = BidPoint+$result[0] WHERE UserID = ?");
                        $stmt->execute(array($winner));
                        
                    }
                    if (isset($_POST['Buyer'])){
                        $buyer = $_POST['Buyer'];
                        foreach($buyer as $buy){
                            $stmt = $con->prepare("UPDATE users SET BidPoint = BidPoint+1 WHERE UserID =  ? ");
                            $stmt->execute(array($buy));
                        }
                    }
                    $stmt2 = $con->prepare("DELETE FROM items WHERE Item_ID =:DID");
                    $stmt2->bindParam(':DID',$itemid);
                    $stmt2->execute();
                    echo '<div class="container">';
                    echo '<div class="nice-message">Item Sold</div>';
                    echo '</div>';
                    header('Refresh:5; url=logistics.php');
                    }
                }

            }else{
                header('Location:index.php');
                exit();
            }
        }elseif($do == 'ManageAdver'){
            $stmt= $con->prepare("SELECT * FROM ads");
            $stmt->execute();
            $rows= $stmt->fetchAll();
            if(!empty($rows)){?>
            <div class="container">
                <h1 class="text-center border-bottom">Manage Ads</h1>
                <table class="table">
                    <thead class="thead-light">
                        <tr class="table-dark">
                        <th scope="col">Ads ID</th>
                        <th scope="col">Company Name & Page</th>
                        <th scope="col">Company Email</th>
                        <th scope="col">Company Phone</th>
                        <th scope="col">Control</th>
                        </tr>
                    </thead>    
                    <tbody>
                    <?php
                    foreach($rows as $row){
                        echo "<tr>";
                            echo "<td>" . $row['Company_ID'] . "</td>";
                            echo "<td><a href='".$row['Company_Link']."'>" . $row['Company_Name'] . "</a></td>";
                            echo "<td>" . $row['Company_Email'] . "</td>";
                            echo "<td>0" . $row['Company_Phone'] . "</td>";
                            echo "<td>
                                    <a href='logistics.php?do=EditAds&adsid=" . $row['Company_ID'] . "' class='tbtn btn btn btn-warning btn-sm'><i class='fa fa-edit'></i>Edit</a>
                                    <a href='logistics.php?do=DeleteAds&adsid=" . $row['Company_ID'] . "' class='tbtn confirm btn btn-danger btn-sm'><i class='fa fa-close'></i>Delete</a>
                                   <td>";
                        echo "</tr>"; } ?>
                    </tbody>
                </table>
                <a href="logistics.php?do=AddAds" class="btn btn-primary"><i class="fa fa-plus"></i> Add New Ads</a>
            </div>
            <?php }else{
                echo '<div class="container">';
                echo '<div class="nice-message">There Is No Ads To Show</div>';?>
                <a href="logistics.php?do=AddAds" class="btn btn-primary"><i class="fa fa-plus"></i> Add New Ads</a>
               <?php echo '</div>';
                }
        }elseif ($do =='AddAds'){?>
            <div class="container">
                <h1 class="text-center border-bottom">Add Ads</h1>
                <form class="form-horizontal" action="?do=InsertAds" method="POST" enctype="multipart/form-data">
                    <h4 class="text-center border-bottom">About Company</h4>
                    </br>
                    <div class="form-group row">
                        <!--Start name -->
                        <label class="col-md-2 form-label">Name :</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control"  name="Name" required = "required" placeholder="Enter Company Name"> 
                        </div>
                        <!--End name -->
                        <!--Start link -->
                        <label class="col-md-2 form-label">Link :</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="Link" required = "required"  placeholder="Enter Company Link"> 
                        </div>
                        <!--End link -->
                        <!--Start email -->
                        <label class="col-md-2 form-label">Email :</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control"  name="Email" required = "required" placeholder="Enter Company email"> 
                        </div>
                        <!--End email -->
                        <!--Start phone -->
                        <label class="col-md-2 form-label">Phone :</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="Phone" required = "required"  placeholder="Enter Company phone"> 
                        </div>
                        <!--End phone -->
                        <!-- Start ads -->
                        <label class="col-md-2 form-label">Pictuer Ads :</label>
                            <div class="col-md-4">
                                <input type="file" class="form-control" name="AdsPic"> 
                            </div>
                        <!--End ads -->
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 col-lg-3 offset-md-2 offset-lg-2">
                            <input type="submit" value="Add New Ads" class="btn btn-success"/>
                        </div>
                    </div>
                </form>
            </div>
        <?php }elseif($do == 'InsertAds'){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                echo "<div class='container'>";
                ?>
                <h1 class="text-center border-bottom">Insert Ads</h1>
                <?php
                $Pic_name    = $_FILES['AdsPic']['name'];
                $Pic_size    = $_FILES['AdsPic']['size'];
                $Pic_tmp     = $_FILES['AdsPic']['tmp_name'];
                $Pic_type    = $_FILES['AdsPic']['type'];
                $PicAllowExtention = array("jpeg","jpg","png","gif");
                $t=explode('.',$Pic_name);
                $PicExtention = strtolower(end($t));
                //************ */
                $name = $_POST['Name'];
                $link = $_POST['Link'];
                $email = $_POST['Email'];
                $phone = $_POST['Phone'];

                $formErrors = array();
                if(empty($name)){
                    $formErrors[] = 'name can\'t be <strong>empty</strong>';
                }
                if(strlen($name) < 3){
                    $formErrors[] = 'name can\'t be less than <strong>3 characters</strong>';
                }
                if(strlen($name) > 20){
                    $formErrors[] = 'name can\'t be more than <strong>20 characters</strong>';
                }
                if(empty($link)){
                    $formErrors[] = 'link can\'t be <strong>empty</strong></div>';
                }
                if(empty($email)){
                    $formErrors[] =  'Email name can\'t be <strong>empty</strong>';
                }
                if(empty($phone)){
                    $formErrors[] = 'Phone number can\'t be <strong>empty</strong>';
                }
                if (!empty($Pic_name) && ! in_array($PicExtention,$PicAllowExtention)){
                    $formErrors[] = 'This Extintion Is <strong>Worng</strong>';
                }
                if (empty($Pic_name)){
                    $formErrors[] = 'Pictuer can\'t be <strong>Empty</strong>';
                }
                foreach($formErrors as $error){
                    $alertMsg ='<div class="alert alert-danger" role="alert">' . $error . '</div>';
                    redirctAlert($alertMsg,'back');
                }
                if (empty($formErrors)){
                    $Ads_Pic = rand(0,100000000).'_'.$Pic_name;
                    move_uploaded_file($Pic_tmp,"../controlPanel/uploads\Ads_pic\\".$Ads_Pic);
                    $stmt = $con->prepare("INSERT INTO 
                                                    ads (Company_Name, Company_Link, Company_Email, Company_Phone, Company_Ads) 
                                                    VALUES(:n, :l, :e, :p, :a )");
                    $stmt->execute(array(
                        'n'  => $name,
                        'l'  => $link,
                        'e'  => $email,
                        'p'  => $phone,
                        'a' => $Ads_Pic,
                    ));
                    $alertMsg='<div class="alert alert-success" role="alert">' .  $stmt ->rowCount() . ' record inserted</div>';
                    redirctAlert($alertMsg,'back');
                }
                echo '</div>';
            }else{
                echo "<div class='container'>" . "</br>";
                $alertMsg = "<div class='alert alert-danger' role='alert'>Sorry You Can't Browse This Page Directly</div>";
                redirctAlert($alertMsg , 'back');
                echo "</div>";
                }
        }elseif($do =='EditAds'){
            $Adsid = isset($_GET['adsid']) && is_numeric($_GET['adsid']) ? intval($_GET['adsid']) :0;
            $stmt = $con->prepare(" SELECT * FROM ads WHERE Company_ID = ? LIMIT 1");
            $stmt->execute(array($Adsid));
            $row = $stmt ->fetch();
            $count = $stmt->rowCount();
            if($count > 0){ ?>
            <div class="container">
                <h1 class="text-center border-bottom">Edit Ads</h1>
                <form class="form-horizontal" action="?do=UpdateAds" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="Adsid" value="<?php echo $Adsid ;?>"/>
                        <div class="form-group row">
                            <!--Start name -->
                            <label class="col-md-2 form-label">Name :</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" value ="<?php echo $row['Company_Name']?>" name="Name" required = "required" placeholder="Enter Company Name"> 
                            </div>
                            <!--End name -->
                            <!--Start link -->
                            <label class="col-md-2 form-label">Link :</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="Link" value ="<?php echo $row['Company_Link']?>" required = "required"  placeholder="Enter Company Link"> 
                            </div>
                            <!--End link -->
                            <!--Start email -->
                            <label class="col-md-2 form-label">Email :</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  name="Email" value ="<?php echo $row['Company_Email']?>" required = "required" placeholder="Enter Company email"> 
                            </div>
                            <!--End email -->
                            <!--Start phone -->
                            <label class="col-md-2 form-label">Phone :</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="Phone" value ="0<?php echo $row['Company_Phone']?>" required = "required"  placeholder="Enter Company phone"> 
                            </div>
                            <!--End phone -->
                            <!-- Start ads -->
                            <label class="col-md-2 form-label">Pictuer Ads :</label>
                            <div class="col-md-4">
                                <input type="file" class="form-control" name="AdsPic"> 
                            </div>
                        </div>
                        <!--Start Save -->
                        <div class="form-group row">
                            <div class="col-md-3 col-lg-3 offset-md-2 offset-lg-2">
                                <input type="submit" value="Edit Ads" class="btn btn-warning"/>
                            </div>
                        </div>
                        <!--End Save -->
                </form>
            </div>
            <?php }else{
                echo "<div class='container'>" . "</br>";
                $alertMsg = '<div class="alert alert-warning" role="alert">There Is No Such ID</div>';
                redirctAlert($alertMsg);
                echo "</div>";
            }
        }elseif($do =='UpdateAds'){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                echo "<div class='container'>";?>
                <h1 class="text-center border-bottom">Update</h1>
                <?php
                $Pic_name    = $_FILES['AdsPic']['name'];
                $Pic_size    = $_FILES['AdsPic']['size'];
                $Pic_tmp     = $_FILES['AdsPic']['tmp_name'];
                $Pic_type    = $_FILES['AdsPic']['type'];
                $PicAllowExtention = array("jpeg","jpg","png","gif");
                $t=explode('.',$Pic_name);
                $PicExtention = strtolower(end($t));
                //************ */
                $id =$_POST['Adsid'];
                $name = $_POST['Name'];
                $link = $_POST['Link'];
                $email = $_POST['Email'];
                $phone = $_POST['Phone'];

                $formErrors = array();
                if(empty($name)){
                    $formErrors[] = 'name can\'t be <strong>empty</strong>';
                }
                if(strlen($name) < 3){
                    $formErrors[] = 'name can\'t be less than <strong>3 characters</strong>';
                }
                if(strlen($name) > 20){
                    $formErrors[] = 'name can\'t be more than <strong>20 characters</strong>';
                }
                if(empty($link)){
                    $formErrors[] = 'link can\'t be <strong>empty</strong></div>';
                }
                if(empty($email)){
                    $formErrors[] =  'Email name can\'t be <strong>empty</strong>';
                }
                if(empty($phone)){
                    $formErrors[] = 'Phone number can\'t be <strong>empty</strong>';
                }
                if (!empty($Pic_name) && ! in_array($PicExtention,$PicAllowExtention)){
                    $formErrors[] = 'This Extintion Is <strong>Worng</strong>';
                }
                foreach($formErrors as $error){
                    $alertMsg='<div class="alert alert-danger" role="alert">' . $error . '</div>';
                    redirctAlert($alertMsg,'back');
                }
                if (empty($formErrors)){
                    if(!empty($Pic_name)){
                        $Ads_Pic = rand(0,100000000).'_'.$Pic_name;
                        move_uploaded_file($Pic_tmp,"../controlPanel/uploads\Ads_pic\\".$Ads_Pic);
                        $stmt = $con->prepare("UPDATE ads SET Company_Name=?, Company_Link=?, Company_Email=?, Company_Phone=? ,Company_Ads=? WHERE Company_ID = ?");
                        $stmt->execute(array($name , $link , $email , $phone, $Ads_Pic , $id ));
                    }else{
                        $stmt = $con->prepare("UPDATE ads SET Company_Name=?, Company_Link=?, Company_Email=?, Company_Phone=?  WHERE Company_ID = ?");
                        $stmt->execute(array($name , $link , $email , $phone , $id ));
                    }
                    $alertMsg= '<div class="alert alert-success" role="alert">' .  $stmt ->rowCount() . ' Record Updated</div>';
                    redirctAlert($alertMsg,'back');
                }
                echo "</div>";
            }else{
                echo "<div class='container'>" . "</br>";
                $alertMsg= '<div class="alert alert-danger" role="alert"><strong>Sorry You Can\'t Browse This Page Direct</strong></div>';
                redirctAlert($alertMsg,'back');
                echo "</div>";
            }
        }elseif($do == 'DeleteAds'){
            echo "<div class='container'>";
            ?>
                <h1 class="text-center border-bottom">Delete</h1>
            <?php
            $Adsid = isset($_GET['adsid']) && is_numeric($_GET['adsid']) ? intval($_GET['adsid']) :0;
            $check = checkItem('Company_ID' , 'ads' ,$Adsid);
            if($check > 0){
                $stmt = $con->prepare("DELETE FROM ads WHERE Company_ID =:ID");
                $stmt->bindParam(':ID',$Adsid);
                $stmt->execute();
                $alertMsg='<div class="alert alert-success" role="alert">' .  $stmt ->rowCount() . ' Record Deleted</div>';
                redirctAlert($alertMsg,'back');
            }else{
                $alertMsg='<div class="alert alert-warning" role="alert">This ID is not exist</div>';
                redirctAlert($alertMsg);
            }
            echo "</div>";
        }
/**********************************************************************************/
        include $temp .'footer.php';
    }else{
        header('Location:index.php');
        exit();
    }
    ob_end_flush();
?>