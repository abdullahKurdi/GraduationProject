<?php
    session_start();
    $pageTitle = 'Orders';
    include 'init.php';
    echo '<div class="ordersaaa container">';
    if ($_SERVER['REQUEST_METHOD']=='POST'){
        if(isset($_POST['s1'])){
            $orderid = $_POST['order'];
            $item =$_POST['item'];
            $SUm = $con->prepare('SELECT SUM(Bidding_Status) FROM `notifications` WHERE User_ID=?');
            $SUm ->execute(array($_SESSION['u_id']));
            $result = $SUm->fetch();
            $stmt = $con->prepare("UPDATE users SET BidPoint = BidPoint+$result[0] WHERE UserID =  ? ");
            $stmt->execute(array($_SESSION['u_id']));
            $stmt2 = $con->prepare("DELETE FROM orders WHERE Order_id=?");
            $stmt2->execute(array($orderid));
            $NOTI = $con->prepare("DELETE FROM notifications WHERE Item_ID =? AND  User_ID=? AND Bidding_Status=1");
            $NOTI->execute(array($item,$_SESSION['u_id']));
            echo '<div class="container">';
            echo '<div class="nice-message">'.lang('You dont want item').'</div>';
            echo '</div>';
            header('Refresh:5; url=orders.php');
        }
        if(isset($_POST['s2'])){
            $orderid = $_POST['order'];
            $item =$_POST['item'];
            $stmt = $con->prepare("UPDATE orders SET  OrderStatus= 100 , AgreeOrder=1 WHERE Order_id  =  ? ");
            $stmt->execute(array($orderid));
            echo '<div class="container">';
            echo '<div class="nice-message">'.lang('Thank You For Agree').'</div>';
            echo '</div>';
            header('Refresh:5; url=orders.php');
        }
        if(isset($_POST['s3'])){
            $orderid = $_POST['order'];
            $item =$_POST['item'];
            $stmt = $con->prepare("UPDATE users SET BidPoint = BidPoint+1 WHERE UserID =  ? ");
            $stmt->execute(array($_SESSION['u_id']));
            $stmt3 = $con->prepare("DELETE FROM orders WHERE Order_id=?");
            $stmt3->execute(array($orderid));
            $NOTI = $con->prepare("DELETE FROM notifications WHERE Item_ID =? AND User_ID=? AND Buyer_Status=1");
            $NOTI->execute(array($item,$_SESSION['u_id']));
            // echo $Noti;
            echo '<div class="container">';
            echo '<div class="nice-message">'.lang('You dont want item').'</div>';
            echo '</div>';
            header('Refresh:5; url=orders.php');
        }
        
    }
    ?>
    <?php
        $stmt1 = $con->prepare(" SELECT * FROM orders WHERE Member_id = ? AND OrderStatus > 30 AND OrderType = 0");
        $stmt1->execute(array($_SESSION['u_id']));
        $get1 = $stmt1->fetchAll();
        $count = $stmt1->rowCount();
        if ($count >0){?>
        <div class="orders">
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr >
                        <th  scope="col"><?php echo lang('Item');?></th>
                        <th  scope="col"><?php echo lang('Rating');?></th>
                        <th  scope="col"><?php echo lang('Control');?></th>
                    </tr>
                </thead>
                <?php foreach ($get1 as $order1){ ?>
                    <?php $item1 =getItemgg('Item_ID , Name', 'items','WHERE Item_ID ='.$order1['Item_id']);?>
                    <tr class="table-active">
                        <td  scope="col"><a href="item.php?item_id=<?php echo $item1['Item_ID']; ?>"><?php echo $item1['Name'];?></a></td>
                        <td  scope="col"><?php echo $order1['OrderStatus'];?></td>
                        <td  scope="col"><?php if ($order1['OrderStatus']<90){?>
                            <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                            <input type ="hidden" name='order' value="<?php echo $order1['Order_id'];?>">
                            <input type ="hidden" name='item' value="<?php echo $item1['Item_ID'];?>">
                            <input type="submit" class="btn btn-info" name="s2" value="<?php echo lang('I Agree');?>">
                            <input type="submit" class="btn btn-danger" name="s1" value="<?php echo lang('I don\'t Agree');?>">
                            </form>
                        <?php }?></td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
        </div>
        <?php }else{
            echo '<div class="orders">';
            echo '<div class="alert alert-danger">'.lang('There\'s no auction winner request.').'</div>';
            echo '</div>';
        }
    ?>
    
    <?php
        $stmt = $con->prepare(" SELECT * FROM orders WHERE Member_id = ? AND OrderStatus > 30 And OrderType = 1");
        $stmt->execute(array($_SESSION['u_id']));
        $get = $stmt->fetchAll();
        $count = $stmt->rowCount();
        if ($count >0){?>
        <div class="order">
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr >
                    <th  scope="col"><?php echo lang('Item');?></th>
                        <th  scope="col"><?php echo lang('Rating');?></th>
                        <th  scope="col"><?php echo lang('Control');?></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($get as $order){ ?>
                    <?php $item =getItemgg('Item_ID , Name', 'items','WHERE Item_ID ='.$order['Item_id']);?>
                    <tr class="table-active">
                        <td  scope="col"><a href="item.php?item_id=<?php echo $item['Item_ID']; ?>"><?php echo $item['Name'];?></a></td>
                        <td  scope="col"><?php echo $order['OrderStatus'];?></td>
                        <td  scope="col"><?php if ($order['OrderStatus']<90){?>
                            <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                            <input type ="hidden" name='order' value="<?php echo $order['Order_id'];?>">
                            <input type ="hidden" name='item' value="<?php echo $item['Item_ID'];?>">
                            <input type="submit" class="btn btn-danger" name="s2" value="<?php echo lang('I Agree');?>">
                            <input type="submit" class="btn btn-info" name="s3" value="<?php echo lang('I don\'t Agree');?>">
                            </form>
                        <?php }?></td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
        </div>
        <?php }else{
            echo '<div class="order">';
            echo '<div class="alert alert-danger">'.lang('There is no order').'</div>';
            echo '</div>';
        }
        echo '</div>';
    include $temp . 'footer.php';
?>