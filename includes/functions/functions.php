<?php
function swapLang(){
    if(isset($_POST['arabic'])){
        $_SESSION['LANG']='arabic';
    }elseif(isset($_POST['english'])){
        $_SESSION['LANG']='english';
    }else{
        $_SESSION['LANG']='arabic';
    }
}
function endAuction(){
    global $con;
    $stmt = $con->prepare("SELECT * FROM items where EndStatus = 0");
    $stmt->execute();
    $result = $stmt->fetchAll();
    foreach($result as $row){
        // echo $row['endBidding'];
         $date = date('Y-m-d H:i:s');
        // echo $date;
        // echo $row['Item_ID'];
        if($row['endBidding']<$date && $row['endBidding'] != '0000-00-00 00:00:00'){
            // echo "hi";
             $NOTIfi = $con->prepare("SELECT User_ID FROM `notifications` WHERE Item_ID =? AND Bidding_Status=1 ORDER BY C_ID DESC LIMIT 1");
             $NOTIfi->execute(array($row['Item_ID']));
             $result2 = $NOTIfi->fetchAll();
             if(count($result2)>0){
                // print_r($result2); 
                $member = $result2[0]['User_ID'];  
                $stmtBid2 = $con->prepare("INSERT INTO orders (OrderType ,Item_id  ,Member_id )VALUES(0 ,  :Items_id , :member)");
                $stmtBid2->execute(array('Items_id'=>$row['Item_ID'],'member'=> $member));
                
            }
            $stmt42 = $con->prepare("UPDATE items SET EndStatus = 1  WHERE Item_ID =  ? ");
            $stmt42->execute(array($row['Item_ID']));
        }
         
    }
}
//this function can get categories from database
function getCat($WHERE=null){
    global $con;
    $stmt = $con->prepare("SELECT * From categories $WHERE ORDER BY Ordering asc");
    $stmt->execute();
    $cats = $stmt->fetchAll();
    return $cats;
}
//this function can get items from database
//*****************for page gategory**********

function getItem($Parent,$where  , $value , $Type ,$start ,$limit, $acative =Null){
    global $con;
    if ($acative == Null){
        $SQL= 'and Active=1';
    }else{
        $SQL= Null;
    }
    if($Parent==0){
        $stmt = $con->prepare("SELECT items.*  From items JOIN categories ON categories.CatID = items.Cat_ID  WHERE (items.$where=? OR categories.Parent=?) AND items.TypeOfAuction=?  $SQL and Visibility = 0 ORDER BY Item_ID DESC limit $start, $limit");
        $stmt->execute(array($value,$value,$Type));
    }else{
        $stmt = $con->prepare("SELECT * From items JOIN categories ON categories.CatID = items.Cat_ID where Visibility = 0 and $where = ? and TypeOfAuction = ? $SQL  ORDER BY Item_ID DESC limit $start, $limit");
        $stmt->execute(array($value,$Type));
    }
    
    $items = $stmt->fetchAll();
    return $items;
}
function getItemCount($Parent,$where , $value, $Type ){
    global $con;
    if($Parent==0){
        $stmt2= $con->prepare("SELECT count(Item_ID)  as id From items JOIN categories ON categories.CatID = items.Cat_ID where (items.$where=? OR categories.Parent=?) AND items.TypeOfAuction=? and Active=1 and Visibility = 0");
        $stmt2->execute(array($value,$value,$Type));
    }else{
        $stmt2 = $con->prepare("SELECT count(Item_ID)  as id From items JOIN categories ON categories.CatID = items.Cat_ID where ($where = ? and TypeOfAuction = ? and Active=1)and Visibility = 0");
        $stmt2->execute(array($value,$Type));
    }
    $count = $stmt2->fetch();
    return $count;
}
//*****************for page gategory**********
//*****************for page my items**********
function getItem2($where  , $value ,$start ,$limit, $acative =Null){
    global $con;
    if ($acative == Null){
        $SQL= 'and Active=1';
    }else{
        $SQL= Null;
    }
    
    $stmt = $con->prepare("SELECT * From items where $where = ? $SQL ORDER BY Item_ID DESC limit $start, $limit");
    $stmt->execute(array($value));
    $items = $stmt->fetchAll();
    return $items;
}
function getItemCount2($where , $value ){
    global $con;
    $stmt2 = $con->prepare("SELECT count(Item_ID)  as id From items where $where = ?");
    $stmt2->execute(array($value));
    $count = $stmt2->fetch();
    return $count;
}
//*****************for page my items**********
//*****************for page index**********
function getItem3($Type ,$start ,$limit){
    global $con;
    $stmt = $con->prepare("SELECT * From items JOIN categories ON categories.CatID = items.Cat_ID where TypeOfAuction = ? and Active=1 and Visibility = 0 ORDER BY Item_ID DESC limit $start, $limit");
    $stmt->execute(array($Type)); 
    $items = $stmt->fetchAll();
    return $items;
}
function getItemCount3($Type){
    global $con;
    $stmt2 = $con->prepare("SELECT count(Item_ID)  as id From items JOIN categories ON categories.CatID = items.Cat_ID where TypeOfAuction = ? and Active=1 and Visibility = 0");
    $stmt2->execute(array($Type));
    $count = $stmt2->fetch();
    return $count;
}
//*****************for page index**********
function getItemgg($What ,$select,$WHERE=null){
    global $con;
    $stmt = $con->prepare("SELECT $What From $select $WHERE LIMIT 1");
    $stmt->execute();
    $result = $stmt->fetch();
    return $result;
}
//this function can get userinfo from database
function getUserInfo($user){
    global $con;
    $stmt = $con->prepare("SELECT * From users where UserID=?");
    $stmt->execute(array($user));
    $user = $stmt->fetch();
    return $user;
}

    // function that echo the page title from variables name pageTitle and it echo title for all pages
    function getTitle(){
        global $pageTitle;
        if(isset($pageTitle)){
            echo lang($pageTitle);
        }else{
            echo 'Default';
        }
    }
    //check if user is not actaive
    function checkUserActive($user){
        global $con;
        $stmt = $con->prepare(" SELECT 
                                    Username 
                                FROM 
                                    users 
                                WHERE 
                                    (Username = ?
                                OR
                                    Email = ?)
                                AND
                                    RegStatus = 0
                                ");
        $stmt->execute(array($user,$user));
        $count = $stmt->rowCount();
        return $count;
    }

    // redirct alert masseage to home
    function redirctAlert($alertMsg , $url = null ,$seconds = 5){
        if($url === null){
            $url = 'index.php';
            $LINK = 'Home Page' ;
        }else{
            if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== ''){
                $url = $_SERVER['HTTP_REFERER'];
                $LINK ='Previous Page';
            }else{
                $url = 'index.php';
                $LINK = 'Home Page' ;
            }
            
        }
        echo $alertMsg ;
        echo '<div class="container"><div class="alert alert-info" role="alert">You Will Be Redirected To ' .$LINK . ' After '.$seconds . ' Seconds</div></div>';
        header("refresh:$seconds;url=$url");
        exit();
    }


    //check item for all dashboard
    function checkItem($select , $from , $value){
        global $con ;
        $statment = $con->prepare("SELECT $select FROM $from WHERE $select = ?");
        $statment ->execute(array($value));
        $count = $statment->rowCount();
        return $count;
    } 

    //count number for all dashboard items
    function countItem($select , $table){
        global $con;
        $stmt = $con->prepare("SELECT COUNT($select) FROM $table WHERE GroupID = 0");
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    function countItem2($select , $table){
        global $con;
        $stmt = $con->prepare("SELECT COUNT($select) FROM $table");
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    //this function can get latest item from database
    function getLatest($select , $table , $order ,$limit =3 ,$WHERE=""){
        global $con;
        $stmt = $con->prepare("SELECT $select FROM $table $WHERE ORDER BY $order DESC LIMIT $limit");
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }
    function time_elapsed_A($secs,$COUNT){
        $bit = array(
            'w' => $secs / 604800 % 52,
            'd' => $secs / 86400 % 7,
            'H' => $secs / 3600 % 24,
            'm' => $secs / 60 % 60,
            's' => $secs % 60
            );
           
        foreach($bit as $k => $v)
            if($v >= 0)$ret[] = '<strong id="'.$COUNT.'" class="'.$k.$COUNT.'">'.$v.'</strong>' . $k;
           
        return join(' ', $ret);
        }
?>