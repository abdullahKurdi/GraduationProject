<?php
    ob_start("ob_gzhandler");// output buffering start
    // manage members page you can add delete edit from here 
    session_start();
    $pageTitle = 'Categories';
    if(isset($_SESSION['Username'])){
        include 'init.php';

        //*******************start categories page ********************
        $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
        if($do == 'Manage'){
            // Manage page
                
            $sort="ASC";
            $sort_array = array('DESC','ASC');
            if(isset($_GET['sort']) && in_array($_GET['sort'], $sort_array )){
                $sort = $_GET['sort'];
            }
            $stmt = $con->prepare("SELECT * FROM categories where Parent = 0 ORDER BY Ordering $sort");
            $stmt->execute();
            $categories = $stmt->fetchAll();
            if(!empty($categories)){?>
                <h1 class="text-center border-bottom"><?php echo lang('manageCategories')?></h1>
                <div class="container category">
                    <div class="catpan panel panel-default">
                        <div class="panel-heading ">
                            <h5><i class='fa fa-tasks'></i> <?php echo lang('manageCategories')?></h5>
                            <div class="ordering ">
                                <i class='fa fa-sort'></i> Ordering :
                                [<a class="<?php if($sort == 'ASC'){echo 'active';}?>" href="?sort=ASC">Asc</a> |
                                <a class="<?php if($sort == 'DESC'){echo 'active';}?>" href="?sort=DESC">Desc</a>]
                                <p class='view'> <i class='fa fa-eye'></i> View : </p> 
                                [<span class="active" data-view="Full">Full</span> |
                                <span data-view="Classic">Classic</span>]
                            </div>
                        </div>
                        <div class="panel-body">
                            <?php
                                foreach ($categories as $cat){                                        
                                    echo '<div class="cat">';
                                        echo "<div class=' btnt'>";
                                            echo "<a href='categories.php?do=Edit&catid=".$cat['CatID'] ."'  class='btn btn-primary btn-xs'><i class='fa fa-edit'></i>Edit</a>";
                                            echo "<a href='categories.php?do=Delete&catid=".$cat['CatID'] ."' class='btn btn-danger btn-xs'><i class='fa fa-close'></i>Delete</a>";
                                        echo "</div>";
                                        echo "<h3>" . $cat['CatName'] . "</h3>" ;
                                        echo "<div class='full-view'";
                                            echo "<p>"; 
                                            if($cat['description'] == ""){
                                                echo 'There Is No Description';
                                            } else{
                                                echo $cat['description'];
                                            }
                                            echo "</p>";
                                            echo "<div class='row'>";
                                                if($cat['Visibility'] == 0){ echo "<span class='col-sm-6 col-md-2 col-lg-2 col-xl-1 visibile'><i class='fa fa-eye'></i> Visibile". "</span>" ;}else{echo "<span class='col-sm-6 col-md-2 col-lg-2 col-xl-1 Hidden'><i class='fa fa-eye-slash'></i> Hidden". "</span>" ;}
                                                if($cat['AllowComment'] == 0){ echo "<span class='col-sm-6 col-md-3 col-lg-3 col-xl-2 Comment'><i class='fa fa-check'></i> Allow Comment". "</span>" ;}else{echo "<span class='col-sm-6 col-md-3 col-lg-2.2 col-xl-2 Comment2'><i class='fa fa-close'></i> Comment Disabled". "</span>" ;}
                                                if($cat['AllowAds'] == 0){ echo "<span class='col-sm-6 col-md-3 col-lg-3 col-xl-2 Adst'><i class='fa fa-check'></i> Allow Adverties". "</span>" ;}else{echo "<span class='col-sm-6 col-md-3 col-lg-3 col-xl-2 Adst2'><i class='fa fa-close'></i> Adverties Disabled". "</span>" ;}
                                                // if($cat['Parent'] == 0){ echo "<span class='col-sm-6 col-md-3 col-lg-3 col-xl-2 Adst'> Parent Category". "</span>" ;}else{echo "<span class='col-sm-6 col-md-3 col-lg-3 col-xl-2 Adst2'> Child Category". "</span>" ;}
                                            echo "</div>";
                                        
                                    $stmt2 = $con->prepare("SELECT * FROM categories where Parent = ? ORDER BY Ordering $sort");
                                    $stmt2->execute(array($cat['CatID']));
                                    $subCat = $stmt2->fetchAll();
                                    if(!empty($subCat)){
                                    echo '<div class="container-fluid"><h5>Child Category</h5> <ul>';
                                    foreach ($subCat as $sub){
                                        echo "<div>
                                        
                                        <div><li>". $sub['CatName'] ." 
                                        [ <a href='categories.php?do=Edit&catid=".$sub['CatID'] ."'  class=''><i class='fa fa-edit'></i> Edit</a> | "
                                        ."<a href='categories.php?do=Delete&catid=".$sub['CatID'] ."' class=''><i class='fa fa-close'></i> Delete</a>".
                                        " ]</li></div>
                                        </div>";
                                    }
                                    echo '</ul></br></div>';
                                }
                                echo "</div>";
                                    echo '</div>';
                                    echo "<hr/>";
                                }
                            ?>
                        </div>
                    </div>
                    <a href="categories.php?do=Add" class="btn btn-primary"><i class="fa fa-plus"></i> Add New Category</a>
                </div>
                <?php 
            }else {
                echo '<div class="container">';
                    echo '<div class="nice-message">There\'s No Record To Show</div>';
                    echo '<a href="categories.php?do=Add" class="btn btn-primary"><i class="fa fa-plus"></i> Add New Category</a>';
                 echo '</div>';   
            } 
                ?>
            <?php

            //end manage page
        }elseif($do == 'Add'){
            //Add page?>

            <h1 class="text-center border-bottom"><?php echo lang('addcat');?></h1>
            <div class="container">
                    <form class="form-horizontal" action="?do=Insert" method="POST">
                        <div class="form-group row">
                            <!--Start name -->
                            <label class="col-md-3 col-lg-2 form-label">Name:</label>
                            <div class="col-md-6 col-lg-5">
                                <input type="text" class="form-control"  name="Name" required="required" placeholder="Name The Catgory"> 
                            </div>
                            <!--End name -->
                        </div>   
                        <div class="form-group row">
                            <!--Start Description -->
                            <label class="col-md-3 col-lg-2 form-label">Description:</label>
                            <div class="col-md-6 col-lg-5">
                                <input type="text" class="form-control" name="Description"  placeholder="Description The Category"> 
                            </div>    
                            <!--End Description -->
                        </div>    
                        <div class="form-group row">
                            <!--Start Ordering -->
                            <label class="col-md-3 col-lg-2 form-label">Ordering:</label>
                            <div class="col-md-6 col-lg-5">
                                <input type="number" class="form-control" name="Ordering"  placeholder="Category Ordering"> 
                            </div>
                            <!--End Ordering -->
                        </div>
                        <div class="form-group row">
                            <!--Start Parent -->
                            <label class="col-md-3 col-lg-2 form-label">Parent:</label>
                            <div class="col-md-6 col-lg-5">
                                <select class="form-control" name="Parent">
                                <option value="0">none</option>
                                    <?php 
                                        $subCat = getCat('WHERE Parent = 0');
                                        foreach ($subCat as $sub){
                                            echo '<option value="'.$sub['CatID'].'">' . $sub['CatName'] . '</option>';}
                                    ?>
                                </select>
                            </div>
                            <!--End Parent -->
                        </div>
                        <div class="form-group row">
                            <!--Start Visibility -->
                            <label class="col-md-3 col-lg-2 form-label">Visibile:</label>
                            <div class="col-md-5 col-lg-5">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="Visibile" id="v1" value="0" checked>
                                    <label class="form-check-label" for="v1">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="Visibile" id="v2" value="1">
                                    <label class="form-check-label" for="v2">No</label>
                                </div>
                            </div>
                            <!--End Visibility -->
                        </div>
                        <div class="form-group row">
                            <!--Start Commenting -->
                            <label class="col-md-3 col-lg-2 form-label">Commenting:</label>
                            <div class="col-md-5 col-lg-5">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="Commenting" id="c1" value="0" checked>
                                    <label class="form-check-label" for="c1">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="Commenting" id="c2" value="1">
                                    <label class="form-check-label" for="c2">No</label>
                                </div>
                            </div>
                            <!--End Commenting -->
                        </div>
                        <div class="form-group row">
                            <!--Start Ads -->
                            <label class="col-md-3 col-lg-2 form-label">Adsense:</label>
                            <div class="col-md-4">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="Ads" id="a1" value="0" checked>
                                    <label class="form-check-label" for="a1">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="Ads" id="a2" value="1">
                                    <label class="form-check-label" for="a2">No</label>
                                </div>
                            </div>
                            <!--End Ads -->
                        </div>
                        </br>
                        <!--Start Save -->
                        <div class="form-group row">
                            <div class="col-md-4 col-lg-3 offset-md-3 offset-lg-2">
                                <input type="submit" value="Add New Category" class="btn btn-success"/>
                            </div>
                        </div>
                        <!--End Save -->
                    </form>
                </div> 

        <?php
        }elseif($do == 'Insert'){//Insert page

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                ?>
                <h1 class="text-center border-bottom"><?php echo lang('insertcat');?></h1>
                <?php
                echo "<div class='container'>";
                //get variables 
                
                $name = $_POST['Name'];
                $description = $_POST['Description'];
                $order = $_POST['Ordering'];
                $Parent = $_POST['Parent'];
                $visible = $_POST['Visibile'];
                $comment = $_POST['Commenting'];
                $ads = $_POST['Ads'];

                //validate the form
                $formErrors = array();
                if(empty($name)){
                    $formErrors[] = 'Name can\'t be <strong>empty</strong></div>';
                }
                if(strlen($name) < 2){
                    $formErrors[] = 'Name can\'t be less than <strong>3 characters</strong>';
                }
                if(strlen($name) > 40){
                    $formErrors[] = 'Name can\'t be more than <strong>20 characters</strong>';
                }
                //loop into errors message
                foreach($formErrors as $error){
                    $alertMsg ='<div class="alert alert-danger" role="alert">' . $error . '</div>';
                    redirctAlert($alertMsg,'back');
                }

                //check if there is no error 
                if (empty($formErrors)){

                    // if(checkItem('CatName','categories',$name) != 1){
                        // insert Member into the database with this information
                        $stmt = $con->prepare("INSERT INTO 
                                                categories(CatName, description, Ordering,Parent, Visibility, AllowComment, AllowAds ) 
                                                VALUES(:anamecat, :ades, :aord, :Parent , :avis, :acom ,:aads )");
                        $stmt->execute(array(
                            'anamecat'  => $name,
                            'ades'  => $description,
                            'aord'  => $order,
                            'Parent'=>$Parent,
                            'avis'  => $visible,
                            'acom' => $comment,
                            'aads' => $ads,
                        ));
                    
                        $alertMsg='<div class="alert alert-success" role="alert">' .  $stmt ->rowCount() . ' record inserted</div>';
                        redirctAlert($alertMsg,'back');
                    // }else{
                    //     $alertMsg ='<div class="alert alert-danger" role="alert">Sorry This Name Is Exist</div>';
                    //     redirctAlert($alertMsg,'back');
                    // }
                }
            }else{
                echo "<div class='container'>" . "</br>";
                $alertMsg = "<div class='alert alert-danger' role='alert'>Sorry You Can't Browse This Page Directly</div>";
                redirctAlert($alertMsg , 'back');
                echo "</div>";
                }
            echo "</div>";

        }elseif($do == 'Edit'){//Edit page

            //Protaction page
            //and chech if catid is numeric and get the integer value of it 
            $catid = isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']) :0;
            //select all data that have relation of this this userid 
            $stmt = $con->prepare(" SELECT * FROM categories WHERE CatID = ? LIMIT 1");
            $stmt->execute(array($catid));
            $cat = $stmt ->fetch();
            $count = $stmt->rowCount();
            if($count > 0){ ?>
            <!-- .....................start html tags...................-->  
            <h1 class="text-center border-bottom"><?php echo lang('editcat');?></h1>
            <div class="container">
                    <form class="form-horizontal" action="?do=Update" method="POST">
                        <input type="hidden" name="catid" value="<?php echo $catid ;?>"/>
                        <div class="form-group row">
                            <!--Start name -->
                            <label class="col-md-3 col-lg-2 form-label">Name:</label>
                            <div class="col-md-6 col-lg-5">
                                <input type="text" class="form-control"  name="Name" required="required" value="<?php echo $cat['CatName'];?>" placeholder="Name The Catgory"> 
                            </div>
                            <!--End name -->
                        </div>   
                        <div class="form-group row">
                            <!--Start Description -->
                            <label class="col-md-3 col-lg-2 form-label">Description:</label>
                            <div class="col-md-6 col-lg-5">
                                <input type="text" class="form-control" name="Description" value="<?php echo $cat['description'];?>"  placeholder="Description The Category"> 
                            </div>    
                            <!--End Description -->
                        </div>    
                        <div class="form-group row">
                            <!--Start Ordering -->
                            <label class="col-md-3 col-lg-2 form-label">Ordering:</label>
                            <div class="col-md-6 col-lg-5">
                                <input type="number" class="form-control" name="Ordering" value="<?php echo $cat['Ordering'];?>" placeholder="Category Ordering"> 
                            </div>
                            <!--End Ordering -->
                        </div>
                        <div class="form-group row">
                            <!--Start Parent -->
                            <label class="col-md-3 col-lg-2 form-label">Parent:</label>
                            <div class="col-md-6 col-lg-5">
                                <select class="form-control" name="Parent">
                                <option value="0">none</option>
                                    <?php 
                                        $subCat = getCat('WHERE Parent = 0');
                                        $subCat2 = getCat('WHERE CatID = '.$catid);
                                        
                                        foreach ($subCat as $sub){
                                            foreach ($subCat2 as $sub2){if($sub2 ['Parent'] != $sub ['CatID']) { $same= '';}else{$same= 'selected';}}
                                            echo '<option value="'.$sub['CatID'].'"'.$same.'>' . $sub['CatName'] . '</option>';}
                                    ?>
                                </select>
                            </div>
                            <!--End Parent -->
                        </div>
                        <div class="form-group row">
                            <!--Start Visibility -->
                            <label class="col-md-3 col-lg-2 form-label">Visibile:</label>
                            <div class="col-md-5 col-lg-5">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="Visibile" id="v1" value="0" <?php if($cat['Visibility'] == 0){ echo "checked";}?>>
                                    <label class="form-check-label" for="v1">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="Visibile" id="v2" value="1" <?php if($cat['Visibility'] == 1){ echo "checked";}?>>
                                    <label class="form-check-label" for="v2">No</label>
                                </div>
                            </div>
                            <!--End Visibility -->
                        </div>
                        <div class="form-group row">
                            <!--Start Commenting -->
                            <label class="col-md-3 col-lg-2 form-label">Commenting:</label>
                            <div class="col-md-5 col-lg-5">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="Commenting" id="c1" value="0" <?php if($cat['AllowComment'] == 0){ echo "checked";}?>>
                                    <label class="form-check-label" for="c1">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="Commenting" id="c2" value="1" <?php if($cat['AllowComment'] == 1){ echo "checked";}?>>
                                    <label class="form-check-label" for="c2">No</label>
                                </div>
                            </div>
                            <!--End Commenting -->
                        </div>
                        <div class="form-group row">
                            <!--Start Ads -->
                            <label class="col-md-3 col-lg-2 form-label">Adsense:</label>
                            <div class="col-md-4">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="Ads" id="a1" value="0" <?php if($cat['AllowAds'] == 0){ echo "checked";}?>>
                                    <label class="form-check-label" for="a1">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="Ads" id="a2" value="1" <?php if($cat['AllowAds'] == 1){ echo "checked";}?>>
                                    <label class="form-check-label" for="a2">No</label>
                                </div>
                            </div>
                            <!--End Ads -->
                        </div>
                        </br>
                        <!--Start Save -->
                        <div class="form-group row">
                            <div class="col-md-4 col-lg-3 offset-md-3 offset-lg-2">
                                <input type="submit" value="Edit Category" class="btn btn-warning"/>
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
        
        }elseif($do == 'Update'){//Update page
        
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                ?>
                   <h1 class="text-center border-bottom"><?php echo lang('updatecat');?></h1>
                <?php

                echo "<div class='container'>";
                //get variables 
                $id = $_POST['catid'];
                $name = $_POST['Name'];
                $Description = $_POST['Description'];
                $Ordering = $_POST['Ordering'];
                $Parent = $_POST['Parent'];
                $Visibile = $_POST['Visibile'];
                $Commenting = $_POST['Commenting'];
                $Ads = $_POST['Ads'];
                
                //validate the form
                $formErrors = array();
                if(empty($name)){
                    $formErrors[] = 'Name can\'t be <strong>empty</strong></div>';
                }
                if(strlen($name) < 2){
                    $formErrors[] = 'Name can\'t be less than <strong>3 characters</strong>';
                }
                if(strlen($name) > 40){
                    $formErrors[] = 'Name can\'t be more than <strong>20 characters</strong>';
                }
                //loop into errors message
                foreach($formErrors as $error){
                    $alertMsg ='<div class="alert alert-danger" role="alert">' . $error . '</div>';
                    redirctAlert($alertMsg,'back');
                }

                //check if there is no error 
                if (empty($formErrors)){
                    // update the database with this information
                if ($Parent ==0){
                    $stmt = $con->prepare("UPDATE categories SET Visibility = ? , AllowComment = ?, AllowAds = ? WHERE Parent = ?");
                    $stmt->execute(array($Visibile , $Commenting , $Ads  , $id));
                }
                $stmt = $con->prepare("UPDATE categories SET CatName = ? ,description = ? ,Ordering = ? , Parent=? ,Visibility = ? , AllowComment = ?, AllowAds = ? WHERE CatID =  ? ");
                $stmt->execute(array($name , $Description , $Ordering ,$Parent , $Visibile , $Commenting , $Ads  , $id ));
                //echo sucsses message 
                $alertMsg= '<div class="alert alert-success" role="alert">' .  $stmt ->rowCount() . ' Record Updated</div>';
                redirctAlert($alertMsg);
                echo "</div>";
                }
            }else{
                echo "<div class='container'>" . "</br>";
                $alertMsg='<div class="alert alert-danger" role="alert"><strong>Sorry You Can\'t Browse This Page Direct</strong></div>';
                redirctAlert($alertMsg,'back');
                echo "</div>";
            }

        }elseif($do == 'Delete'){//Delete page
        
            ?>
                <h1 class="text-center border-bottom"><?php echo lang('deletecat');?></h1>
            <?php

                echo "<div class='container'>";
            //Protaction page
            //and chech if userid is numeric and get the integer value of it 
            $catid = isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']) :0;
            //select all data that have relation of this this userid with my function
            $check = checkItem('CatID' , 'categories' ,$catid);
            /*
            select all data that have relation of this this userid 
            $stmt = $con->prepare(" SELECT * FROM users WHERE UserID = ? LIMIT 1");
            $stmt->execute(array($userid));
            $count = $stmt->rowCount();
            */
            if($check > 0){
                $stmt = $con->prepare("DELETE FROM categories WHERE CatID =:DcID or Parent=:DcID");
                $stmt->bindParam(':DcID',$catid);
                $stmt->execute();
                $alertMsg='<div class="alert alert-success" role="alert">' .  $stmt ->rowCount() . ' Record Deleted</div>';
                redirctAlert($alertMsg,'back');
            }else{
                $alertMsg='<div class="alert alert-warning" role="alert">This ID is not exist</div>';
                redirctAlert($alertMsg);
            }
            echo "</div>";

        }
        //*******************end categories page ********************

        include $temp .'footer.php';
    }else{
        header('Location:index.php');
        exit();
    }
    ob_end_flush();
?>