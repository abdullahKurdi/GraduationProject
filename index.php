<?php
    session_start();
    $pageTitle = 'Home Page';
    $under="";
    include 'init.php';
    echo'<div class="category-container container-fluid">';
    echo '<div class="row alert alert-dark">'.lang('Home Page').'</div>';
    $limit =6;
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']): 1 ;
    $start = ($page - 1) * $limit;
    $items = getItem3($_SESSION['TypeOfAuction'],$start , $limit);
    $countITEM = getItemCount3($_SESSION['TypeOfAuction']);
    $total = $countITEM['id'];
    $pages = ceil($total/$limit);
    $Previous = $page - 1 ;
    $Next = $page + 1;
        if (!empty($items)){
            
            echo'<div class="row">
                    <div class="right-cat col-12 col-sm-12 col-lg-9">
                    <div class="row">';
                    $COUNT=0;
            foreach($items as $item){
                $imgs = explode('|',$item['Image']);
                $img_count=count($imgs);
                echo'<div class="item col-12 col-xs-12 col-sm-6 col-md-6 col-lg-4">
                        <div class="card " style="">
                            <span class="price-tag">$'.$item['Price'].'</span>
                            <img class="card-img-top" src="controlPanel/uploads/item_pic/'. $imgs[0] .'" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">'.$item['Name']  .'</h5>
                                <p class="card-text">'.substr($item['Description'],0,20).lang('...etc').'</p>
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
                            <div class="card-body">
                                <a href="item.php?item_id='.$item['Item_ID'].'" class="card-link btn btn-info" >'.lang('Show').'</a>
                                <span class="Add_Date">'.$item['Add_Date'].'</span>
                            </div>
                        </div>
                    </div>'; 
            }echo '</div>
                </div>
                <div class="left-cat col-0 col-sm-0 col-lg-3">';
                $stmt10 = $con->prepare("SELECT * FROM ads order by Company_ID DESC");
                $stmt10->execute();
                $result = $stmt10->fetchAll();
                // print_r($result);
                $first = $result[0]['Company_ID'];
                if(!empty($result)){
                ?>
                <div id="carousel" class="carousel slide Ads" data-ride="carousel">
                <div class="carousel-inner Ads">
                    <?php foreach ($result as $ads){
                        // echo $ads['Company_ID'];
                        ?>
                        <div class="ads carousel-item <?php if($ads['Company_ID']==$first ){echo 'active';}?>">
                        <a href="<?php echo $ads['Company_Link'];?>"><img src="controlPanel/uploads/Ads_pic/<?php echo $ads['Company_Ads'];?>" height="500px" width ="50px" class="Ads d-block w-100" alt="..."></a>
                        <div class="carousel-caption d-none d-md-block">
                        <h5><?php echo $ads['Company_Name'];?></h5>
                        </div>    
                        </div>
                        <?php
                    }?>
                </div>
                <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
                </div>
                <?php
                echo '<a href="contact.php" class="Ads_NEW btn btn-primary">'.lang('Add Ads').'</a>
                '; }
                echo '</div></div>';
                echo '<div class="navigation row">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center">
                                <li class="page-item ';if($page==1){echo 'disabled';}echo' ">
                                    <a class="page-link" href="index.php?page='.$Previous.'" tabindex="-1">'.lang('Previous').'</a>
                                </li>
                                ';
                                for($i = 1 ; $i <= $pages ; $i++){
                                echo '<li class="page-item"><a class="page-link" href="index.php?page='.$i.'">'.$i.'</a></li>';
                                    }
                                echo '<li class="page-item ';if($page==$pages){echo 'disabled';}echo'">
                                    <a class="page-link" href="index.php?page='.$Next.'">'.lang('Next').'</a>
                                </li>
                                </ul>
                            </nav>
                        </div>
                </div>';
        }else{
            echo '<div class="ABCDEF alert alert-info"><strong>'.lang('There Is No Items').'</strong></div></div>';
        }


    include 'includes/templates/footer.php';
?>