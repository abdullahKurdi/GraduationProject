<?php
    session_start();
    $pageTitle = 'My Items';
    $activelANG2='';
    include 'init.php';
    if($userStatus==0){
    date_default_timezone_set('Asia/Amman');
    if(isset($_SESSION['user'])){
        ?>
        <div class="profile">
            <div class="container">
                <div class="adverties">
                    <div class="card">
                        <div class="card-header">
                            <?php echo lang('My Items');?>
                        </div>
                        <div class="card-body">
                            <?php
                                    $limit =3;
                                    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']): 1 ;
                                    $start = ($page - 1) * $limit;
                                    $items = getItem2('Member_ID',$_SESSION['u_id'] , $start , $limit,1);
                                    $countITEM = getItemCount2('Member_ID',$_SESSION['u_id']);
                                    $total = $countITEM['id'];
                                    $pages = ceil($total/$limit);
                                    $Previous = $page - 1 ;
                                    $Next = $page + 1;
                                     if (!empty($items)){
                                        echo'<div class="row">';
                                         foreach($items as $item){
                                            $imgs = explode('|',$item['Image']);
                                            $img_count=count($imgs);
                                             $COUNT =0;
                                             echo'<div class="adv col-12 col-xs-12 col-sm-12 col-md-6 col-lg-4">
                                                     <div class="card " style="">';
                                                    if($item['Active']==0){echo '<span class="Approval">Waiting Approval</span>';}
                                                    echo'<span class="price-tag">$'.$item['Price'].'</span>
                                                         <img class="card-img-top" src="controlPanel/uploads/item_pic/'. $imgs[0] .'" height="300px" width="280"alt="Card image cap">
                                                         <div class="card-body">
                                                             <h5 class="card-title">'.$item['Name']  .'</h5>
                                                             <p class="card-text">'.substr($item['Description'],0,25).lang('...etc').'</p>
                                                         </div>
                                                         <ul class="list-group list-group-flush">
                                                            
                                                            <li class="list-group-item text-center">';
                                                            $start = strtotime($item['startBidding']);
                                                            $strdate = strtotime(date('Y-m-d H:i:s'));
                                                            $end = strtotime($item['endBidding']);
                                                            if(($start <= $strdate) && ($end > $strdate)){
                                                                echo time_elapsed_A($end-$strdate,$COUNT);
                                                            }else if (($start > $strdate ) && ($start !==0) && ($end > $strdate)){
                                                                echo lang('Will Be Start At ').' <strong>' . date('Y-m-d',$start).'</strong>' ;
                                                            }else if($strdate>=$end && $start!=$end){
                                                                echo lang('The Auction Is Ended');
                                                            }else if($start == strtotime('0000-00-00 00:00:00') && ($end == strtotime('0000-00-00 00:00:00'))){
                                                                echo lang('This Item Not For Bindding');
                                                            }echo '</li>';
                                                            ++$COUNT;
                                                            echo'    
                                                        </ul>
                                                         <div class="card-body adsw">';
                                                         if($item['Active']==1){echo '<a href="item.php?item_id='.$item['Item_ID'].'" class="card-link btn btn-info" >'.lang('Show').'</a>';}
                                                         echo '<span class="Add_Date">'.$item['Add_Date'].'</span>
                                                         </div>
                                                     </div>
                                                 </div>'; 
                                         }
                                         echo'</div>';
                                         echo '<div class="navigation row">
                                                        <nav aria-label="Page navigation example">
                                                        <ul class="pagination justify-content-center">
                                                        <li class="page-item ';if($page==1){echo 'disabled';}echo' ">
                                                            <a class="page-link" href="myItems.php'.'?page='.$Previous.'" tabindex="-1">'.lang('Previous').'</a>
                                                        </li>
                                                        ';
                                                        for($i = 1 ; $i <= $pages ; $i++){
                                                        echo '<li class="page-item"><a class="page-link" href="myItems.php'.'?page='.$i.'">'.$i.'</a></li>';
                                    }
                                                        echo '<li class="page-item ';if($page==$pages){echo 'disabled';}echo'">
                                                            <a class="page-link" href="myItems.php'.'?page='.$Next.'">'.lang('Next').'</a>
                                                        </li>
                                                        </ul>
                                                    </nav>
                                            </div>';
                                     }else{
                                         echo '<div class="alert alert-danger"><strong>'.lang('there is no category in this id').'</strong></div>';
                                     }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }else{
        header('Location:index.php'); // redirect to dashboard page
        exit();
    }
}else{
    header('Location:index.php'); // redirect to dashboard page
    exit();
}
    include $temp . 'footer.php';

?>