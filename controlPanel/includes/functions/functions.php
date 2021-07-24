<?php
    // function that echo the page title from variables name pageTitle and it echo title for all pages
    function getTitle(){
        global $pageTitle;
        if(isset($pageTitle)){
            echo $pageTitle;
        }else{
            echo 'Default';
        }
    }

    // redirct alert masseage to home
    function redirctAlert($alertMsg , $url = null ,$seconds = 3){
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
        echo '<div class="alert alert-info" role="alert">You Will Be Redirected To ' .$LINK . ' After '.$seconds . ' Seconds</div>';
        header("refresh:$seconds;url=$url");
        exit();
    }
    function getCat($WHERE=null){
        global $con;
        $stmt = $con->prepare("SELECT * From categories $WHERE ORDER BY Ordering asc");
        $stmt->execute();
        $cats = $stmt->fetchAll();
        return $cats;
    }
    function getItem($What ,$select,$WHERE=null){
        global $con;
        $stmt = $con->prepare("SELECT $What From $select $WHERE limit 1");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    function getItemgg($What ,$select,$WHERE=null){
        global $con;
        $stmt = $con->prepare("SELECT $What From $select $WHERE");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    function getItemCount($count , $from){
        global $con;
        $stmt2 = $con->prepare("SELECT count($count) From $from");
        $stmt2->execute(array($count, $from));
        $count = $stmt2->fetch();
        return $count;
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
?>