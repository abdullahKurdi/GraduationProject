<?php
    ob_start("ob_gzhandler");
    session_start();
    $pageTitle = 'Show Item';
    $import="";
    include 'init.php';
        //Protaction page
        //and chech if userid is numeric and get the integer value of it 
        $item_id = isset($_GET['item_id']) && is_numeric($_GET['item_id']) ? intval($_GET['item_id']) :0;
        //select all data that have relation of this this userid 
        $stmt = $con->prepare("SELECT items.* ,categories.Visibility,categories.CatName as catname,users.Username as username FROM items inner join users on users.UserID=items.Member_ID inner join categories on categories.CatID=Cat_ID WHERE Item_ID = ? and categories.Visibility = 0  and Active=1 LIMIT 1");
        $stmt->execute(array($item_id));
        $item = $stmt ->fetch();
        $count = $stmt->rowCount();
        if ($_SERVER['REQUEST_METHOD']=='POST'){
            if(isset($_POST['bid'])){
                $bidNumber = filter_var($_POST['bidNumber'],FILTER_SANITIZE_NUMBER_INT);
                $formErrors = array();
                if(empty($bidNumber)){
                    $formErrors[] = 'bidNumber can\'t be empty';
                }
                if (empty($formErrors)){
                    $stmtuser = $con->prepare("select BidPoint from users where UserID =?");
                    $stmtuser->execute(array($_SESSION['u_id']));
                    $result=$stmtuser->fetch();
                     if($result['BidPoint'] > 0){
                        $stmtBid = $con->prepare("INSERT INTO notifications (Bidding_Status, countBid ,C_Date ,Item_ID ,User_ID)VALUES(1 , :bidNum ,now(), :Items_id , :member)");
                        $stmtBid->execute(array('bidNum'=> $bidNumber,'Items_id'=>$item_id,'member'=> $_SESSION['u_id']));
                        $stmtbidpoint =$con->prepare("UPDATE users SET BidPoint = (BidPoint-1) where UserID = ?"); 
                        $stmtbidpoint->execute(array($_SESSION['u_id']));
                        if($stmtBid){
                            echo "<div class='container'>";
                            echo '<div class="nice-message2">'.lang('Thank You For Bidding').'</div>';
                            echo "</div>";
                            header("refresh:3;url=item.php?item_id="."$item_id"); // redirect to dashboard page
                            }    
                        }else{
                                echo "<div class='container'>";
                                echo '<div class="nice-message2">'.lang('You Dont Have BidPoint You Will buy It Now').'</div>';
                                echo "</div>";
                                header("refresh:4;url=profile.php");
                            }         
                }else{
                    foreach($formErrors as $error){
                        echo "<div class='container'>";
                        echo '<div class="nice-message2">' . $error . '</div>';
                        echo "</div>";
                    }
                }
            }else if(isset($_POST['buy'])){
                $stmtuser = $con->prepare("select BidPoint from users where UserID =?");
                $stmtuser->execute(array($_SESSION['u_id']));
                $result=$stmtuser->fetch();
                if($result['BidPoint'] > 0){
                    $stmtBid = $con->prepare("INSERT INTO notifications (Buyer_Status ,C_Date ,Item_ID ,User_ID)VALUES(1 , now(), :Items_id , :member)");
                    $stmtBid->execute(array('Items_id'=>$item_id,'member'=> $_SESSION['u_id']));
                    $stmtbidpoint =$con->prepare("UPDATE users SET BidPoint = (BidPoint-1) where UserID = ?"); 
                    $stmtbidpoint->execute(array($_SESSION['u_id']));
                    $stmtBid2 = $con->prepare("INSERT INTO orders (OrderType ,Item_id  ,Member_id )VALUES(1 ,  :Items_id , :member)");
                    $stmtBid2->execute(array('Items_id'=>$item_id,'member'=> $_SESSION['u_id']));
                    if($stmtBid){
                        echo "<div class='container'>";
                        echo '<div class="nice-message2">'.lang('Thank You For Buy This Item').'</div>';
                        echo "</div>";
                        header("refresh:4;url=item.php?item_id="."$item_id"); // redirect to dashboard page
                        }    
                    }else{
                            echo "<div class='container'>";
                            echo '<div class="nice-message2">'.lang('You Dont Have BidPoint You Will buy It Now').'</div>';
                            echo "</div>";
                            header("refresh:4;url=profile.php");
                        }    
            }
        }
            if($count > 0){
                $imgs = explode('|',$item['Image']);
                $img_count=count($imgs);
                ?>
<!- ******************start item information********************** -->                
<div class="container">
    <div class="row show-item">
        <div class="item_pic col-xs-12 col-sm-12 col-md-7 col-lg-8">
            <div id="carouselExampleControlsNoTouching" h class="col-12 carousel slide" data-touch="false" data-interval="false">
                <div class="row">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="controlPanel/uploads/item_pic/<?php echo $imgs[0];?>" class="d-block img_item" alt="...">
                        </div>
                        <?php for($t = 1 ; $t < $img_count ; $t++){?>
                        <div class="carousel-item">
                            <img src="controlPanel/uploads/item_pic/<?php echo $imgs[$t];?>" class="d-block  img_item" alt="...">
                        </div>
                        <?php }?>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControlsNoTouching" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon next-prev" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControlsNoTouching" role="button" data-slide="next">
                        <span class="carousel-control-next-icon next-prev" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <div class="row carousel">
                <?php for($t = 0 ; $t < $img_count ; $t++){?>
                    <img class="col-4 col-md-3 col-lg-2" src="controlPanel/uploads/item_pic/<?php echo $imgs[$t];?>" height="30px" width="30px" data-target="#carouselExampleControlsNoTouching" data-slide-to="<?php echo $t;?>" class="active">
                    <?php }?>
                </div>
            </div>
            <div> 
                <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="card border-dark mb-3">
                        <h5 class="card-header"><i class="fa fa-book"></i> <?php echo lang('Description')?></h5>
                        <div class="card-body text-dark">
                            <p class="card-text"><?php echo $item['Description'];?></p>
                        </div>
                    </div>
                </div>
                </div>
                <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="card  border-dark mb-3">
                        <h5 class="card-header"><i class="fa fa-comments"></i> <?php echo lang('Comments');?></h5>
                        <div class="card-body text-dark">
                        <ul class="list-group list-group-flush">
                        <?php
                            $stmt = $con->prepare("SELECT notifications.*,ProfilePic ,users.Username as username FROM notifications inner join users on users.UserID=notifications.User_ID  WHERE notifications.C_Status = 1 and notifications.Item_ID = ? and Bidding_Status=0 and Buyer_Status=0 and C_Status=1");
                            $stmt->execute(array($item_id));
                            $notefi = $stmt ->fetchAll();
                            $count = $stmt->rowCount();
                                if($count > 0){ 
                                    foreach($notefi as $comment){?>
                                    <li class="list-group-item">
                                        <div class="media">
                                            <img src="controlPanel/uploads/profile_pic/<?php echo $comment['ProfilePic'];?>" height="50px" width="50px" class="align-self-start mr-3" alt="...">
                                            <div class="media-body">
                                                <h5 class="mt-0"><?php echo $comment['username'];?></h5>
                                                <p><?php echo $comment['Comment'];?></p>
                                                <h6><span>
                                                   <!-- <a href="#" class="btn btn-danger">Delete</a> -->
                                                </span><span class="pull-right"><?php echo $comment['C_Date'];?></span></h6>
                                            </div>
                                        </div>
                                    </li>
                                 <?php }
                                }else{
                                    echo '<div class="nice-message2">'.lang('There is no comments').'</div>';
                                }?>
                                <?php if(isset($_SESSION['user'])){
                                    $stmtg = $con->prepare("SELECT 	Item_id ,categories.Parent From items JOIN categories ON categories.CatID = items.Cat_ID WHERE Item_ID=? and AllowComment = 0");
                                    $stmtg->execute(array($item_id));
                                    $countss = $stmtg->rowCount();
                                    $result = $stmtg->fetch();
                                    // echo $result['Parent'];
                                    if($countss>0){
                                        $parentCat=getCat('where CatID ='.$result['Parent']);
                                    if (!empty($parentCat) && $parentCat[0]['AllowComment']==0){
                                    ?>
                                 <form method="post" action="<?php echo $_SERVER['PHP_SELF'].'?item_id='.$item_id;?>">
                                    <li class="list-group-item">
                                        <textarea class="form-control" placeholder="<?php echo lang('Comment')?>" name="comment" required></textarea>
                                        <br>
                                        <input type="submit" class="btn btn-warning" value="<?php echo lang('cAA')?>" name="com">
                                    </li>
                                </form>
                                <?php }} 
                                    if ($_SERVER['REQUEST_METHOD']=='POST'){
                                        if(isset($_POST['com'])){
                                            $comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);
                                            if (!empty($comment)){
                                            $stmtCOM = $con->prepare("INSERT INTO notifications (Comment, C_Status ,C_Date ,Item_ID ,User_ID)VALUES(:com , 1 ,now(), :Items_id , :member)");
                                            $stmtCOM->execute(array('com'=> $comment,'Items_id'=>$item_id,'member'=> $_SESSION['u_id']));
                                            header("location:item.php?item_id="."$item_id");
                                            }
                                        }
                                    }
                                }?>
                        </ul>
                        </div>
                    </div>
                </div>
                </div>
                                        
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-4 item_infromation">
            <div class="card border-dark mb-3">
                <div class="card-header"><h4><i class="fa fa-question-circle"></i>  <?php echo lang('Item Information')?></h4></div>
                <div class="card-body text-dark">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><span><i class="fa fa-user"></i> <?php echo lang('Name')?> : </span> <span><?php echo $item['Name'];?></span></li>
                    <?php $cat2 = getCat('where CatID='.$item['Cat_ID']); $cat3 = getCat('where CatID='.$cat2[0]['Parent']); ?>
                    <li class="list-group-item"><span><i class="fa fa-tags"></i> <?php echo lang('Category')?> : </span><?php echo lang($cat3[0]['CatName']);?></span></li>
                    <li class="list-group-item"><span><i class="fa fa-tags"></i> <?php echo lang('SubCategory')?> : </span><?php echo lang($item['catname']);?></span></li>
                    <li class="list-group-item"><span><i class="fa fa-calendar"></i> <?php echo lang('Add By')?> : </span><?php echo $item['username'];?></span></li>
                    <li class="list-group-item"><span><i class="fa fa-bullhorn"></i> <?php echo lang('Trading Type')?> : </span><?php  if($item['TypeOfAuction']=='Demand'){echo lang('Demand');}else{echo lang('Supply');}?></span></li>
                    <li class="list-group-item"><span><i class="fa fa-map-marker"></i> <?php echo lang('Country')?> : </span><?php echo lang($item['Country_Made']);?></span></li>
                    <li class="list-group-item"><span><i class="fa fa-map"></i> <?php echo lang('City')?> : </span><?php echo lang($item['City_Made']);?></span></li>
                    <li class="list-group-item"><span><i class="fa fa-battery-half"></i> <?php echo lang('Status')?> : </span><?php echo lang($item['Status']);?></span></li>
                    <li class="list-group-item"><span><i class="fa fa-hourglass-half"></i> <?php echo lang('Add Date')?> : </span><?php echo $item['Add_Date'];?></span></li>
                    </ul>
                </div>
            </div>
            <div class="card border-dark mb-3">
                <div class="card-header"><h4><i class="fa fa-bell"></i> <?php echo lang('Bidding information')?></h4></div>
                <div class="card-body text-dark">
                <ul class="list-group list-group-flush">
                    <li class="aann list-group-item"><i class="fa fa-money"></i><?php echo lang('Selling Price')?> : <?php echo '<span class="pull-right">'. $item['Price'].'$</span>';?></li>
                    <?php   $COUNT=0;
                            $start = strtotime($item['startBidding']);
                            $strdate = strtotime(date('Y-m-d H:i:s'));
                            $end = strtotime($item['endBidding']);
                            if(isset($_SESSION['u_id'])){$active =getUserInfo($_SESSION['u_id']);}
                                if(($start <= $strdate) && ($end > $strdate)){
                                    $stmt = $con->prepare("SELECT COUNT(Bidding_Status) AS numberOfbidding, sum(countBid) sumBidding FROM notifications   WHERE Item_ID=? AND Bidding_Status=1");
                                    $stmt->execute(array($item_id));
                                    $infoBid = $stmt ->fetch();?>
                    <li class="aann list-group-item"><span><?php echo lang('Number Of Bidding')?> :</span><span class="pull-right"><?php echo $infoBid['numberOfbidding'];?></span></li>
                    <li class="aann list-group-item"><?php echo lang('Current Value')?> :<span class="pull-right"><?php if($item['TypeOfAuction']=='Supply'){echo $infoBid['sumBidding'] + $item['AuctionStart'];}else{echo $item['AuctionStart']-$infoBid['sumBidding'];}?>$</span></li>
                    <li class="list-group-item text-center"><?php echo time_elapsed_A($end-$strdate,$COUNT);?></li>
                    <?php if(isset($_SESSION['user'])){ 
                   } 
                    if(isset($_SESSION['user']) && $active['RegStatus']==1 && $active['TrustStatus'] !=1){?>
                    
                    <form method="post" action='<?php echo $_SERVER['PHP_SELF'].'?item_id='.$item_id;?>'>
                    <li class="aann list-group-item"><input type="number" class="form-control" placeholder="<?php echo lang('Number Of Bidding')?>" name="bidNumber"></li>
                    <li class="aann list-group-item"><input type="submit" class="confirm btn btn-primary" value="<?php echo lang('Bid Now')?>" name="bid">
                        <input type="submit" class="avs confirm btn btn-success <?php if($_SESSION['LANG']=='english'){echo 'pull-right';} ?>" value="<?php echo lang('Buy Now')?>" name="buy">
                    </li>
                    </form>
                    <?php }elseif(isset($_SESSION['user'])&& $active['TrustStatus'] !=1){
                        ?>
                        <li class="list-group-item">
                            <div class="login-sign">
                                <a href="validateEmail.php" class="btn btn-info">
                                    <span class="log-text"><?php echo lang('Active My Acount')?></span> 
                                </a>
                            </div>
                        </li>
                        <?php
                    }elseif(isset($_SESSION['user'])&& $active['TrustStatus'] ==1){
                        ?>
                        <li class="list-group-item">
                            <div class="login-sign">
                                <span class="log-text"><?php echo lang('You Are Blocked')?></span> 
                            </div>
                        </li>
                        <?php
                    }else{?>
                        <li class="list-group-item">
                            <div class="login-sign ">
                                <a  href="login.php">
                                    <span class="log-text"><?php echo lang('login')?></span> 
                                </a>
                                |
                                <a  href="signup.php">
                                    <span class="sing-text"><?php echo lang('signup')?></span>
                                </a>
                            </div>
                        </li>
                    <?php }?>      
                          <?php }else if (($start > $strdate ) && ($start !==0) && ($end > $strdate)){?>
                    <li class="list-group-item text-center"><?php echo lang('Start At').' : ' . date('Y-m-d',$start) ;?></li>
                    <?php if(isset($_SESSION['user']) && $active['RegStatus']==1&& $active['TrustStatus'] !=1){?>
                    
                    <form method="post" action='<?php echo $_SERVER['PHP_SELF'].'?item_id='.$item_id;?>'>
                    
                    <li class="list-group-item">
                        <input type="submit" class="confirm btn btn-success pull-right" value="<?php echo lang('Buy Now')?>" name="buy">
                    </li>
                    </form>
                    <?php }elseif(isset($_SESSION['user'])&& $active['TrustStatus'] !=1){
                        ?>
                        <li class="list-group-item">
                            <div class="login-sign ">
                                <a  href="validateEmail.php" class="btn btn-info">
                                    <span class="log-text"><?php echo lang('Active My Acount')?></span> 
                                </a>
                        </li>
                        <?php
                    }elseif(isset($_SESSION['user'])&& $active['TrustStatus'] ==1){
                        ?>
                        <li class="list-group-item">
                            <div class="login-sign">
                                <span class="log-text"><?php echo lang('You Are Blocked')?></span> 
                            </div>
                        </li>
                        <?php    
                    }else{?>
                        <li class="list-group-item">
                            <div class="login-sign ">
                                <a  href="login.php">
                                    <span class="log-text"><?php echo lang('login')?></span> 
                                </a>
                                |
                                <a  href="signup.php">
                                    <span class="sing-text"><?php echo lang('signup')?></span>
                                </a>
                            </div>
                        </li>
                    <?php }?>
                          <?php }else if($strdate>=$end && $start!=$end){?>
                    <li class="list-group-item text-center"><?php echo lang('The Auction Is Ended');?></li>
                          <?php }else if($start == strtotime('0000-00-00 00:00:00') && ($end == strtotime('0000-00-00 00:00:00'))){?>
                    <li class="list-group-item text-center">   <?php echo lang('This Item Not For Bindding');?></li> 
                    <?php if(isset($_SESSION['user'])&& $active['RegStatus']==1&& $active['TrustStatus'] !=1){?>
                    
                    <form method="post" action='<?php echo $_SERVER['PHP_SELF'].'?item_id='.$item_id;?>'>
                    
                    <li class="list-group-item">
                        <input type="submit" class="confirm btn btn-success pull-right" value="<?php echo lang('Buy Now')?>" name="buy">
                    </li>
                    </form>
                    <?php }elseif(isset($_SESSION['user'])&& $active['TrustStatus'] !=1){
                        ?>
                        <li class="list-group-item">
                            <div class="login-sign ">
                                <a href="validateEmail.php" class="btn btn-info">
                                    <span class="log-text"><?php echo lang('Active My Acount')?></span> 
                                </a>
                        </li>
                        <?php
                    }elseif(isset($_SESSION['user'])&& $active['TrustStatus'] ==1){
                        ?>
                        <li class="list-group-item">
                            <div class="login-sign">
                                <span class="log-text"><?php echo lang('You Are Blocked')?></span> 
                            </div>
                        </li>
                        <?php    
                    }else{?>
                        <li class="list-group-item">
                            <div class="login-sign ">
                                <a  href="login.php">
                                    <span class="log-text"><?php echo lang('login')?></span> 
                                </a>
                                |
                                <a  href="signup.php">
                                    <span class="sing-text"><?php echo lang('signup')?></span>
                                </a>
                            </div>
                        </li>
                    <?php }?>
                        <?php }?>
                    
                    </ul>
                </div>
        </div>
    </div>
</div>
</div>
<!- ******************end item information************************ -->
            <?php
            }else{
                echo  "</br>";
                $alertMsg = '<div class="container"><div class="alert alert-warning" role="alert">'.lang('There Is No Such ID Or This Waiting Approval').'</div></div>';
                redirctAlert($alertMsg);
               
            }
    include $temp . 'footer.php';
    ob_end_flush();
?>