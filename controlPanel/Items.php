<?php
    ob_start("ob_gzhandler");// output buffering start
    // manage members page you can add delete edit from here 
    session_start();
    $pageTitle = 'Items';
    if(isset($_SESSION['Username'])){
        $countries = array('Choose...','Egypt','Saudi','Libya','Morocco','Algeria' ,'Jordan','Palestine','Bahrain','Qatar' ,'Somalia','Iraq','Lebanon','Syria','مصر','السعوديه','ليبيا','المغرب','الجزائر' ,'البحرين','قطر' ,'الصومال','الأردن','فلسطين','العراق','لبنان','سوريا');
        $cities=array('Choose...','Irbid','Ajloun','Jerash','Mafraq',
        'Balqa','Amman','Zarqa','Madaba','Karak','Tafilah','Maan','Aqaba',
        'Cairo','Alexandria','Giza','Shubra El-Kheima','Port Said','Suez',
        'El-Mahalla El-Kubra','Luxor','Mansoura','Tanta','Riyadh','Jeddah',
        'Mecca','Medina','Al-Ahsa','Taif','Dammam','Buraidah','Khobar',
        'الرياض','جدة','مكة','المدينه المنوره','الأحسا','الطائف','الدمام','بريدة','الخبر','تبوك',
        'Tabuk','Tripoli','Misurata','Sirte', 'Al-Batnan', 'Benghazi',
        'Al-Jabal Al-Akhdar', 'Al-Jabal Al-Gharbi', 'Al-Jufra','Casablanca', 'Rabat', 'Fez', 'Marrakesh',
        'الدار البيضاء', 'الرباط', 'فاس', 'مراكش', 'طنجه', 'سيفرو','بنجر', 'طنطن', 'أوزاني', 'غيرسيف', 'ورزازات', 'الحكمة',
        'Tangier', 'Sefrou','Benjrir', 'Tan-Tan', 'Ouezzane', 'Guercif',
        'Ouarzazate', 'Al Hoceima',
        'Adrar', 'Chlef', 'Laghouat', 'Oum El Bouaghi', 'Batna', 'Bejaia', 'Biskra',
        'درار', 'كليف', 'لاغوات', 'أم البواغي', 'باتنا', 'بجاية', 'بسكرة'
        ,'اربد','عجلون','جرش','المفرق','البلقا','عمان','الزرقاء','مادبا','الكرك','طفيلة','معان','العقبه'
        ,'اختر...','القاهرة','الإسكندرية','الجيزه','شبرا الخيمة','بورسعيد','السويس','المحلة الكبرى','الاقصر','المنصورة','الكثير');
        $STATUSS = array('New', 'Like New','Used' , 'Old');
        $TRADING = array('Supply','Demand');  
        include 'init.php';
        date_default_timezone_set('Asia/Amman');
        $next3month = time() + (3*30*24*60*60);
        $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

        if($do == 'Manage'){
           /* echo date('Y-m-d H:i:s' , $next3month);
            echo '</br>';
            echo date('Y-m-d H:i:s');
            echo '</br>';
            if (date('Y-m-d H:i:s')<='2021-03-17 00:13:35'){
                echo 'yes';
            }else{
                echo 'no';
            }
            */
            $limit =6;
            $page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']): 1 ;
            $start = ($page - 1) * $limit;
            $stmt= $con->prepare("SELECT items.* ,categories.CatName as categoryName , users.Username as memberName 
                                  FROM items INNER JOIN categories on categories.CatID = items.Cat_ID
                                             INNER JOIN users ON users.UserID = items.Member_ID
                                            ORDER BY Item_ID DESC LIMIT $start , $limit");
            $stmt->execute();
            $items= $stmt->fetchAll();
            $total = getItemCount('Item_ID','items');
            $pages = ceil($total[0]/$limit);
            $Previous = $page - 1 ;
            $Next = $page + 1;
            if(!empty($items)){?>
                <h1 class="text-center border-bottom"><?php echo lang('items page');?></h1>
                <div class="container-fluid">
                    <div class="scroll table-responsive">
                        <table class="table text-center table-light table-hover table-striped">
                            <thead>
                                <tr class="table-dark">
                                    <td>ID</td>
                                    <td>Name</td>
                                    <td>Description</td>
                                    <td>Price</td>
                                    <td>Start Bidding</td>
                                    <td>End Bidding</td>
                                    <td>Country</td>
                                    <td>Status</td>
                                    <td>Category</td>
                                    <td>Member</td>
                                    <td>Adding Date</td>
                                    <td class="contr" >Control</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($items as $item){
                                        echo "<tr>";
                                            echo "<td>" . $item['Item_ID'] . "</td>";
                                            echo "<td>" . $item['Name'] . "</td>";
                                            echo "<td>" . $item['Description'] . "</td>";
                                            echo "<td>" . $item['Price'] . "</td>";
                                            echo "<td>" . $item['startBidding'] . "</td>";
                                            echo "<td>" . $item['endBidding'] . "</td>";
                                            echo "<td>" . $item['Country_Made'] . "</td>";
                                            echo "<td>" . $item['Status'] . "</td>";
                                            echo "<td>" . $item['categoryName'] . "</td>";
                                            echo "<td>" . $item['memberName'] . "</td>";
                                            echo "<td>" . $item['Add_Date'] . "</td>";
                                            echo "<td>
                                                    <a href='items.php?do=Edit&item_id=" . $item['Item_ID'] . "' class='tbtn btn btn btn-warning btn-sm'><i class='fa fa-edit'></i>Edit</a>
                                                    <a href='items.php?do=Delete&item_id=" . $item['Item_ID'] . "' class='tbtn confirm btn btn-danger btn-sm'><i class='fa fa-close'></i>Delete</a>
                                                    <a href='items.php?do=Show&item_id=" . $item['Item_ID'] . "' class='tbtnw btn btn btn-info btn-sm'>Comments</a>";
                                                    if ($item['Active']== 0){ 
                                                        echo " <a href='items.php?do=Active&item_id=" . $item['Item_ID'] . "' class='tbtnw btn btn btn-primary btn-sm'><i class='fa fa-check'></i>Active</a>";
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
                    <a href="items.php?do=Add" class="btn btn-primary"><i class="fa fa-plus"></i> Add New Item</a>
                </div>
            <?php 
            }else {
                echo '<div class="container">';
                    echo '<div class="nice-message">There\'s No Record To Show</div>';
                    echo '<a href="items.php?do=Add" class="btn btn-primary"><i class="fa fa-plus"></i> Add New Item</a>';
                 echo '</div>';   
            } 
                ?>
    <?php
        }elseif($do == 'Add'){
            //Add page?>

            <h1 class="text-center border-bottom"><?php echo lang('additem');?></h1>
                <div class="container">
                <form class="form-horizontal" action="?do=Insert" method="POST" enctype="multipart/form-data">
                        <div class="form-group row">
                            <!--Start name -->
                            <label class="col-md-3 col-lg-2 form-label">Name :</label>
                            <div class="col-md-6 col-lg-5">
                                    <input 
                                        type="text" 
                                        class="form-control"  
                                        name="Name" 
                                        required="required" 
                                        placeholder="Name of The Item"> 
                            </div>
                            <!--End name -->
                        </div>  
                        <div class="form-group row">
                            <!--Start Description -->
                            <label class="col-md-3 col-lg-2 form-label">Description :</label>
                            <div class="col-md-6 col-lg-5">
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        name="Description"  
                                        required="required"
                                        placeholder="Description The Item"> 
                            </div> 
                        </div>
                        <div class="form-group row">
                            <!--Start Description -->
                            <label class="col-md-3 col-lg-2 form-label">Select Picture :</label>
                            <div class="col-md-6 col-lg-5">
                                    <input 
                                        type="file" 
                                        class="form-control" 
                                        name="itemPic[]"  
                                        multiple="multiple"> 
                            </div> 
                        </div>
                        <div class="form-group row">
                            <!--Start Price-->
                            <label class="col-md-3 col-lg-2 form-label">Price</label>
                            <div class="col-md-6 col-lg-5">
                                <input 
                                    type="number" 
                                    class="form-control"  
                                    name="Price" 
                                    required="required" 
                                    placeholder="Price of The Item"
                                    autocomplete="off">  
                            </div>
                            <!--End Price -->
                        </div>
                        <div class="form-group row">
                            <!--Start Price-->
                            <label class="col-md-3 col-lg-2 form-label">Auction Start Price</label>
                            <div class="col-md-6 col-lg-5">
                                <input 
                                    type="number" 
                                    class="form-control"  
                                    name="startprice"
                                    required="required" 
                                    placeholder="Price of The Item"
                                    autocomplete="off">  
                            </div>
                            <!--End Price -->
                        </div>
                        <div class="form-group row">
                            <!--Start startbidding -->
                            <label class="col-md-3 col-lg-2 form-label">Start Bidding :</label>
                            <div class="col-md-6 col-lg-5">
                                    <input 
                                        type="datetime-local" 
                                        class="form-control" 
                                        name="Start"  
                                        >
                            </div> 
                        </div>
                        <!-- end startbidding-->
                        <div class="form-group row">
                            <!--Start endbidding -->
                            <label class="col-md-3 col-lg-2 form-label">End Bidding :</label>
                            <div class="col-md-6 col-lg-5">
                                    <input 
                                        type="datetime-local" 
                                        class="form-control" 
                                        name="End"  
                                        > 
                            </div> 
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-lg-2 form-label">Member :</label>
                            <div class="col-md-6 col-lg-5">
                                <select class="form-control" name="member">
                                    <Option value="no">...</Option>
                                    <?php
                                        $stmt = $con->prepare("SELECT * FROM users");
                                        $stmt->execute();
                                        $users = $stmt->fetchAll();
                                        foreach ($users as $user){
                                            echo "<option value ='" . $user['UserID'] . "'>" . $user['Username'] . "</option>";
                                        }

                                    ?>
                                </select>
                                <!--End Description -->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-lg-2 form-label">Category :</label>
                            <div class="col-md-6 col-lg-5">
                                <select class="form-control" name="category">
                                    <Option value="no">...</Option>
                                    <?php
                                        $stmt2 = $con->prepare("SELECT * FROM categories where Parent=0");
                                        $stmt2->execute();
                                        $cats = $stmt2->fetchAll();
                                        foreach ($cats as $cat){
                                            echo "<option value ='" . $cat['CatID'] . "'>" . $cat['CatName'] . "</option>";
                                        }

                                    ?>
                                </select>
                                <!--End Description -->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-lg-2 form-label">Sub Caregory :</label>
                            <div class="col-md-6 col-lg-5">
                                <select class="form-control" name="subcategory">
                                    <Option value="no">...</Option>
                                    <?php
                                        $stmt2 = $con->prepare("SELECT * FROM categories where Parent!=0");
                                        $stmt2->execute();
                                        $cats = $stmt2->fetchAll();
                                        foreach ($cats as $cat){
                                            echo "<option value ='" . $cat['CatID'] . "'>" . $cat['CatName'] . "</option>";
                                        }

                                    ?>
                                </select>
                                <!--End Description -->
                            </div>
                        </div>
                        <!--end endbidding -->
                        <div class="form-group row">
                            <!--Start country -->
                            <label class="col-md-3 col-lg-2 form-label">Country :</label>
                            <div class="col-md-6 col-lg-5">
                                <select class="form-control" name="Country">
                                <Option value="no">...</Option>
                                <?php foreach($countries as $country){echo '<Option value="'. $country.'">'.$country.'</Option>';}?>
                                </select>
                            </div> 
                            <!--End country -->
                        </div> 
                        <div class="form-group row">
                            <!--Start country -->
                            <label class="col-md-3 col-lg-2 form-label">City:</label>
                            <div class="col-md-6 col-lg-5">
                                <select class="form-control" name="City">
                                <Option value="no">...</Option>
                                <?php foreach($cities as $citie){echo '<Option value="'. $citie.'">'.$citie.'</Option>';}?>
                                </select>
                            </div> 
                            <!--End country -->
                        </div> 
                        <div class="form-group row">
                            <!--Start country -->
                            <label class="col-md-3 col-lg-2 form-label">Type Of Auction :</label>
                            <div class="col-md-6 col-lg-5">
                                <select class="form-control" name="Type">
                                <Option value="no">...</Option>
                                <?php foreach($TRADING as $type){echo '<Option value="'.$type.'">'.$type.'</Option>';} ?>
                                </select>
                            </div> 
                            <!--End country -->
                        </div> 
                        <div class="form-group row">
                            <label class="col-md-3 col-lg-2 form-label">Status :</label>
                            <div class="col-md-6 col-lg-5">
                                <select class="form-control" name="Status">
                                    <Option value="no">...</Option>
                                    <?php foreach ($STATUSS as $Status){echo '<Option value="'.$Status.'">'.$Status.'</Option>';} ?>
                                </select>
                                <!--End Description -->
                            </div>
                        </div>
                            <!--Start Save -->
                        <div class="form-group row">
                            <div class="col-md-4 col-lg-3 offset-md-3 offset-lg-2">
                                <input type="submit" value="Add New Item" class="btn btn-success"/>
                            </div>
                        </div>
                            <!--End Save -->
                        </form>
                    </div> 
            <?php
        }elseif($do == 'Insert'){//insert page
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                ?>
                <h1 class="text-center border-bottom"><?php echo lang('insertit');?></h1>
                <?php
                echo "<div class='container'>";
                //get variables 
                $next3month = time() + (3*30*24*60*60);
            $uploadsFiles    = $_FILES['itemPic'];
            $itemPic_name    = $uploadsFiles['name'];
            $itemPic_size    = $uploadsFiles['size'];
            $itemPic_tmp     = $uploadsFiles['tmp_name'];
            $itemPic_type    = $uploadsFiles['type'];
            // list of allowed pic type
            $itemPicAllowExtention = array("jpeg","jpg","png","gif");
            $files_count = count($itemPic_name);
            $all_imgs = array();
                
                $name           =   $_POST['Name'];
                $description    =   $_POST['Description'];
                $price          =   $_POST['Price'];
                $startprice     = $_POST['startprice'];
                $startbidding   =   $_POST['Start'];
                $endbidding     =   $_POST['End'];
                $country        =   $_POST['Country'];
                $status         =   $_POST['Status'];
                $member         =   $_POST['member'];
                $category       =   $_POST['category'];
                $subcategory    = $_POST['subcategory'];
                $City           = $_POST['City'];
                $Type           =$_POST['Type'];

                //validate the form
                $formErrors = array();
                if(empty($name)){
                    $formErrors[] = 'name can\'t be <strong>empty</strong></div>';
                }
                if(strlen($name) < 2){
                    $formErrors[] = 'name can\'t be less than <strong>2 characters</strong>';
                }
                if(strlen($name) > 20){
                    $formErrors[] = 'name can\'t be more than <strong>20 characters</strong>';
                }
                if(empty($description)){
                    $formErrors[] =  'description can\'t be <strong>empty</strong>';
                }
                if(strlen($description) < 1){
                    $formErrors[] = 'description can\'t be <strong>less than 1 characters</strong>';
                }
                if(empty($price)){
                    $formErrors[] = 'price can\'t be <strong>empty</strong>';
                }
                if(($member) == 0){
                    $formErrors[] = 'member can\'t be <strong>empty</strong>';
                }
                if(($category) == 0){
                    $formErrors[] = 'category can\'t be <strong>empty</strong>';
                }
                if($startbidding != '' xor $endbidding != ''){
                    $formErrors[] ='Start bidding or end biideng can\'t be <strong> '. 'empty' .'</strong>';
                }
                
                if(($startbidding) <= date('Y-m-d H:i:s')){
                    if ($startbidding != ''){
                    $formErrors[] ='Start bidding can\'t be <strong>less than '. date('Y-m-d H:i:s') .'</strong>';
                    }
                }
                if(empty($City)){
                    $formErrors[] = 'City can\'t be empty';
                }
                if(($endbidding) >= date('Y-m-d H:i:s' , $next3month)){
                    if($endbidding != ''){
                    $formErrors[] ='End bidding can\'t be <strong>more than '. date('Y-m-d H:i:s' , $next3month) .'</strong>';
                    }
                }
                if(strlen($price) <= 0){
                    $formErrors[] = 'price  can\'t be <strong>less than 1</strong>';
                }
                if(($country) == 'no'){
                    $formErrors[] = 'country can\'t be <strong>empty</strong>';
                }
                if(($status) == 'no'){
                    $formErrors[] = 'status can\'t be <strong>empty</strong>';
                }
                if(empty($Type)){
                    $formErrors[] = 'Trading Type\'t be empty';
                }
                for($i = 0 ; $i < $files_count ; $i++){
                    $t[$i]=explode('.',$itemPic_name[$i]);
                    $itemPicExtention[$i] = strtolower(end($t[$i]));
                 if (!empty($itemPic_name[$i]) && ! in_array($itemPicExtention[$i],$itemPicAllowExtention)){
                     $formErrors[] = 'Item Pictuer Extintion Is <strong>Worng</strong>';
                 }
                 if (empty($itemPic_name[$i])){
                      $formErrors[] = 'Item Pictuer can\'t be <strong>Empty</strong>';
                 }
                }
                //loop into errors message
                foreach($formErrors as $error){
                    $alertMsg ='<div class="alert alert-danger" role="alert">' . $error . '</div>';
                    redirctAlert($alertMsg,'back');
                }

                //check if there is no error 
                if (empty($formErrors)){

                    for($i = 0 ; $i < $files_count  ; $i++){
                        $itemPic[$i] = rand(0,10000000000000).'_'.$itemPic_name[$i];
                        move_uploaded_file($itemPic_tmp[$i],"uploads\item_pic\\".$itemPic[$i]);
                        $all_imgs[$i]= $itemPic[$i];
                     }
                     $db_imgs =implode('|',$all_imgs);
                        // insert Member into the database with this information
                        $stmt = $con->prepare("INSERT INTO 
                                                items (Name, Description , Price , startBidding, endBidding, Country_Made, City_Made, Status, TypeOfAuction, AuctionStart, Add_Date, Image, Cat_ID ,Member_ID) 
                                                VALUES(:auser, :dess, :pric, :star, :ends ,:addres ,:city, :sta, :typeof, :auctionstart, now(),:img , :category , :member)");
                        $stmt->execute(array(
                //             $name           =   $_POST['Name'];
                // $description    =   $_POST['Description'];
                // $price          =   $_POST['Price'];
                // $startprice     = $_POST['startprice'];
                // $startbidding   =   $_POST['Start'];
                // $endbidding     =   $_POST['End'];
                // $country        =   $_POST['Country'];
                // $status         =   $_POST['Status'];
                // $member         =   $_POST['member'];
                // $category       =   $_POST['category'];
                // $subcategory    = $_POST['subcategory'];
                // $city           = $_POST['City'];
                // $Type           =$_POST['Type'];
                            'auser'         => $name,
                            'dess'          => $description,
                            'pric'          => $price,
                            'star'          => $startbidding,
                            'ends'          => $endbidding,
                            'addres'        => $country,
                            'city'          => $City,
                            'sta'           => $status,
                            'typeof'        => $Type,
                            'auctionstart'  => $startprice,
                            'img'           =>$db_imgs,
                            'category'      => $subcategory,
                            'member'        => $member,
                        ));
                    
                        $alertMsg='<div class="alert alert-success" role="alert">' .  $stmt ->rowCount() . ' record inserted</div>';
                        redirctAlert($alertMsg,'back');
                    
                }
            }else{
                echo "<div class='container'>" . "</br>";
                $alertMsg = "<div class='alert alert-danger' role='alert'>Sorry You Can't Browse This Page Directly</div>";
                redirctAlert($alertMsg , 'back');
                echo "</div>";
                }
            echo "</div>";

        }elseif($do == 'Edit'){// edit page

            //Protaction page
            //and chech if userid is numeric and get the integer value of it 
            $item_id = isset($_GET['item_id']) && is_numeric($_GET['item_id']) ? intval($_GET['item_id']) :0;
            //select all data that have relation of this this userid 
            $stmt = $con->prepare(" SELECT * FROM items WHERE Item_ID = ? LIMIT 1");
            $stmt->execute(array($item_id));
            $item = $stmt ->fetch();
            $count = $stmt->rowCount();
            if($count > 0){ ?>
            <!-- .....................start html tags...................-->  
                <h1 class="text-center border-bottom"><?php echo lang('editItem');?></h1>
                <div class="container">
                    <form class="form-horizontal" action="?do=Update" method="POST">
                        <input type="hidden" name="item_id" value="<?php echo $item_id ;?>"/>
                        <div class="form-group row">
                            <!--Start name -->
                            <label class="col-md-3 col-lg-2 form-label">Name :</label>
                            <div class="col-md-6 col-lg-5">
                                    <input 
                                        type="text" 
                                        class="form-control"  
                                        name="Name" 
                                        required="required" 
                                        value ="<?php echo $item['Name'] ?>"
                                        placeholder="Name of The Item"> 
                            </div>
                            <!--End name -->
                        </div>  
                        <div class="form-group row">
                            <!--Start Description -->
                            <label class="col-md-3 col-lg-2 form-label">Description :</label>
                            <div class="col-md-6 col-lg-5">
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        name="Description"  
                                        required="required"
                                        value ="<?php echo $item['Description'] ?>"
                                        placeholder="Description The Item"> 
                            </div> 
                        </div>
                        <div class="form-group row">
                            <!--Start Price-->
                            <label class="col-md-3 col-lg-2 form-label">Price</label>
                            <div class="col-md-6 col-lg-5">
                                <input 
                                    type="number" 
                                    class="form-control"  
                                    name="Price" 
                                    required="required" 
                                    value ="<?php echo $item['Price'] ?>"
                                    placeholder="Price of The Item"
                                    autocomplete="off">  
                            </div>
                            <!--End Price -->
                        </div>
                        <div class="form-group row">
                            <!--Start startbidding -->
                            <label class="col-md-3 col-lg-2 form-label">Start Bidding :</label>
                            <div class="col-md-6 col-lg-5">
                                    <input 
                                        type="datetime-local" 
                                        class="form-control" 
                                        name="Start" 
                                        value ="<?php echo $item['startBidding'] ?>" 
                                        >
                            </div> 
                        </div>
                        <!-- end startbidding-->
                        <div class="form-group row">
                            <!--Start endbidding -->
                            <label class="col-md-3 col-lg-2 form-label">End Bidding :</label>
                            <div class="col-md-6 col-lg-5">
                                    <input 
                                        type="datetime-local" 
                                        class="form-control" 
                                        name="End"  
                                        value ="<?php echo $item['endBidding'] ?>"
                                        > 
                            </div> 
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-lg-2 form-label">Member :</label>
                            <div class="col-md-6 col-lg-5">
                                <select class="form-control" name="member">
                                    <Option value="no">...</Option>
                                    <?php
                                        $stmt = $con->prepare("SELECT * FROM users");
                                        $stmt->execute();
                                        $users = $stmt->fetchAll();
                                        foreach ($users as $user){
                                            echo "<option value ='" . $user['UserID'] . "'";if ($item['Member_ID'] == $user['UserID']){echo 'selected';} echo">" . $user['Username'] . "</option>";
                                        }

                                    ?>
                                </select>
                                <!--End Description -->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-lg-2 form-label">Category :</label>
                            <div class="col-md-6 col-lg-5">
                                <select class="form-control" name="category">
                                    <Option value="no">...</Option>
                                    <?php
                                        $stmt2 = $con->prepare("SELECT * FROM categories");
                                        $stmt2->execute();
                                        $cats = $stmt2->fetchAll();
                                        foreach ($cats as $cat){
                                            echo "<option value ='" . $cat['CatID'] . "'"; if ($item['Cat_ID'] == $cat['CatID']){echo 'selected';} echo">" . $cat['CatName'] . "</option>";
                                        }

                                    ?>
                                </select>
                                <!--End Description -->
                            </div>
                        </div>
                        <!--end endbidding -->
                        <div class="form-group row">
                            <!--Start country -->
                            <label class="col-md-3 col-lg-2 form-label">Country :</label>
                            <div class="col-md-6 col-lg-5">
                                <select class="form-control" name="Country">
                                    <Option value="no">...</Option>
                                    <Option value="Amman" <?php if ($item['Country_Made'] == 'Amman'){echo 'selected';}?>>Amman</Option>
                                    <Option value="Salt" <?php if ($item['Country_Made'] == 'Salt'){echo 'selected';}?>>Salt</Option>
                                    <Option value="Irbid" <?php if ($item['Country_Made'] == 'Irbid'){echo 'selected';}?>>Irbid</Option>
                                    <Option value="Ajloun" <?php if ($item['Country_Made'] == 'Ajloun'){echo 'selected';}?>>Ajloun</Option>
                                    <Option value="Jersh" <?php if ($item['Country_Made'] == 'Jersh'){echo 'selected';}?>>Jersh</Option>
                                    <Option value="Aqaba"  <?php if ($item['Country_Made'] == 'Aqaba'){echo 'selected';}?>>Aqaba</Option>
                                </select>
                            </div> 
                            <!--End country -->
                        </div> 
                        <div class="form-group row">
                            <label class="col-md-3 col-lg-2 form-label">Status :</label>
                            <div class="col-md-6 col-lg-5">
                                <select class="form-control" name="Status">
                                    <Option value="no">...</Option>
                                    <Option value="New" <?php if ($item['Status'] == 'New'){echo 'selected';}?>>New</Option>
                                    <Option value="Like New" <?php if ($item['Status'] == 'Like New'){echo 'selected';}?>>Like New</Option>
                                    <Option value="Used" <?php if ($item['Status'] == 'Used'){echo 'selected';}?>>Used</Option>
                                    <Option value="Old" <?php if ($item['Status'] == 'Old'){echo 'selected';}?>>Old</Option>
                                </select>
                                <!--End Description -->
                            </div>
                        </div>
                            <!--Start Save -->
                        <div class="form-group row">
                            <div class="col-md-3 col-lg-3 offset-md-2 offset-lg-2">
                                <input type="submit" value="Edit Item" class="btn btn-warning"/>
                            </div>
                        </div>
                            <!--End Save -->
                        </form>
                    </div> 
            <?php
            }else{
                echo "<div class='container'>" . "</br>";
                $alertMsg = '<div class="alert alert-warning" role="alert">There Is No Such ID</div>';
                redirctAlert($alertMsg);
                echo "</div>";
            }
            

        }elseif($do == 'Update'){
            // update page
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                ?>
                   <h1 class="text-center border-bottom"><?php echo lang('updateitem');?></h1>
                <?php

                echo "<div class='container'>";
                //get variables 
                $name           =   $_POST['Name'];
                $description    =   $_POST['Description'];
                $price          =   $_POST['Price'];
                $startbidding   =   $_POST['Start'];
                $endbidding     =   $_POST['End'];
                $country        =   $_POST['Country'];
                $status         =   $_POST['Status'];
                $member         =   $_POST['member'];
                $category       =   $_POST['category'];
                $id             =   $_POST['item_id'];
                
                $formErrors = array();
                if(empty($name)){
                    $formErrors[] = 'name can\'t be <strong>empty</strong></div>';
                }
                if(strlen($name) < 2){
                    $formErrors[] = 'name can\'t be less than <strong>2 characters</strong>';
                }
                if(strlen($name) > 20){
                    $formErrors[] = 'name can\'t be more than <strong>20 characters</strong>';
                }
                if(empty($description)){
                    $formErrors[] =  'description can\'t be <strong>empty</strong>';
                }
                if(strlen($description) < 1){
                    $formErrors[] = 'description can\'t be <strong>less than 1 characters</strong>';
                }
                if(empty($price)){
                    $formErrors[] = 'Email can\'t be <strong>empty</strong>';
                }
                // if(empty($subcategory)){
                //     $formErrors[] = 'Sub Category Not Founded';
                // }
                if(($member) == 0){
                    $formErrors[] = 'member can\'t be <strong>empty</strong>';
                }
                if(($category) == 0){
                    $formErrors[] = 'category can\'t be <strong>empty</strong>';
                }
                if($startbidding != '' xor $endbidding != ''){
                    $formErrors[] ='Start bidding or end biideng can\'t be <strong> '. 'empty' .'</strong>';
                }
                
                if(($startbidding) <= date('Y-m-d H:i:s')){
                    if ($startbidding != ''){
                    $formErrors[] ='Start bidding can\'t be <strong>less than '. date('Y-m-d H:i:s') .'</strong>';
                    }
                }
                if(($endbidding) >= date('Y-m-d H:i:s' , $next3month)){
                    if($endbidding != ''){
                    $formErrors[] ='End bidding can\'t be <strong>more than '. date('Y-m-d H:i:s' , $next3month) .'</strong>';
                    }
                }
                if(strlen($price) <= 0){
                    $formErrors[] = 'price  can\'t be <strong>less than 1</strong>';
                }
                if(($country) == 'no'){
                    $formErrors[] = 'country can\'t be <strong>empty</strong>';
                }
                if(($status) == 'no'){
                    $formErrors[] = 'status can\'t be <strong>empty</strong>';
                }
                //loop into errors message
                foreach($formErrors as $error){
                    $alertMsg ='<div class="alert alert-danger" role="alert">' . $error . '</div>';
                    redirctAlert($alertMsg,'back');
                }
             //check if there is no error 
                     //check if there is no error 
                     if (empty($formErrors)){
                        // update the database with this information
                        
                    $stmt = $con->prepare("UPDATE items SET Name = ? ,Description = ? ,Price = ? ,startBidding = ? , endBidding = ? ,Country_Made = ?, Status=?, Add_Date= now(), Cat_ID = ? , Member_ID = ? WHERE Item_ID =  ? ");
                    $stmt->execute(array($name , $description , $price , $startbidding , $endbidding , $country , $status  , $category, $member ,$id));
                    //echo sucsses message 
                    $alertMsg= '<div class="alert alert-success" role="alert">' .  $stmt ->rowCount() . ' Record Updated</div>';
                    redirctAlert($alertMsg,'back');
                    echo "</div>";
                    }
                }else{
                    echo "<div class='container'>" . "</br>";
                    $alertMsg='<div class="alert alert-danger" role="alert"><strong>Sorry You Can\'t Browse This Page Direct</strong></div>';
                    redirctAlert($alertMsg,'back');
                    echo "</div>";
                }

        }elseif($do == 'Delete'){//delete members
            ?>
                <h1 class="text-center border-bottom"><?php echo lang('deleteitem');?></h1>
            <?php

                echo "<div class='container'>";
            //Protaction page
            //and chech if userid is numeric and get the integer value of it 
            $item_id = isset($_GET['item_id']) && is_numeric($_GET['item_id']) ? intval($_GET['item_id']) :0;
            //select all data that have relation of this this userid with my function
            $check = checkItem('Item_ID' , 'items' ,$item_id);
            /*
            select all data that have relation of this this userid 
            $stmt = $con->prepare(" SELECT * FROM users WHERE UserID = ? LIMIT 1");
            $stmt->execute(array($userid));
            $count = $stmt->rowCount();
            */
            if($check > 0){
                $stmt = $con->prepare("DELETE FROM items WHERE Item_ID =:ITEMID");
                $stmt->bindParam(':ITEMID',$item_id);
                $stmt->execute();
                $alertMsg='<div class="alert alert-success" role="alert">' .  $stmt ->rowCount() . ' Record Deleted</div>';
                redirctAlert($alertMsg,'back');
            }else{
                $alertMsg='<div class="alert alert-warning" role="alert">This ID is not exist</div>';
                redirctAlert($alertMsg);
            }
            echo "</div>";

        }elseif($do == 'Show'){
            $item_id = isset($_GET['item_id']) && is_numeric($_GET['item_id']) ? intval($_GET['item_id']) :0;
            //select all data that have relation of this this userid with my function
            $stmt= $con->prepare("SELECT 
                                        notifications.*,users.Username 
                                  FROM 
                                        notifications
                                
                                  INNER JOIN
                                        users
                                  ON 
                                        users.UserID = notifications.User_ID 
                                  WHERE Item_ID = ? AND Bidding_Status = 0 AND Buyer_Status = 0");

            $stmt->execute(array($item_id));
            $rows= $stmt->fetchAll();
            if(!empty($rows)){
        ?>
            <h1 class="text-center border-bottom">Comments</h1>
            <div class="container-fluid">
                <div class="scroll table-responsive">
                    <table class="table text-center table-dark table-hover table-striped">
                        <thead>
                            <tr>
                                <td>User Name</td>
                                <td>Comment</td>
                                <td>Add Date</td>
                                <td class="contr" >Control</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($rows as $row){
                                    echo "<tr>";
                                        echo "<td>" . $row['Username'] . "</td>";
                                        echo "<td>" . $row['Comment'] . "</td>";
                                        echo "<td>" . $row['C_Date'] . "</td>";
                                        if ($row['Comment'] != '0' ){ 
                                            echo "<td>
                                                 <a href='notifications.php?do=Edit&notid=" . $row['C_ID'] . "' class='tbtn btn btn btn-warning btn-sm'><i class='fa fa-edit'></i>Edit</a>
                                                 <a href='notifications.php?do=Delete&notid=" . $row['C_ID'] . "' class='tbtn confirm btn btn-danger btn-sm'><i class='fa fa-close'></i>Delete</a>";
                                                if ($row['C_Status']== 0 && $row['Bidding_Status']==0 && $row['Buyer_Staus']==0){ 
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
            </div>
            <?php 
            }else {
                echo '<div class="container">';
                    echo '<div class="nice-message">There\'s No Record To Show</div>';
                 echo '</div>';   
            } 
                ?>
    <?php
        }elseif($do == 'Active'){
            ?>
                <h1 class="text-center border-bottom"><?php echo lang('activeitem');?></h1>
            <?php
            echo "<div class='container'>";
            $item_id= isset($_GET['item_id']) && is_numeric($_GET['item_id'])? intval($_GET['item_id']) : 0;
            $check = checkItem('Item_ID' , 'items' , $item_id);
            if($check > 0){
                $stmt = $con->prepare("UPDATE items SET Active=1 WHERE Item_ID=?");
                $stmt->execute(array($item_id));
                $alertMsg='<div class="alert alert-success" role="alert">' .  $stmt ->rowCount() . ' Record Active</div>';
                redirctAlert($alertMsg,'back');
            }else{
                $alertMsg='<div class="alert alert-warning" role="alert">This ID is not exist</div>';
                redirctAlert($alertMsg);
            }
            echo "</div>";
        }

        include $temp .'footer.php';
    }   else{
            header('Location:index.php');
            exit();
        }
    ob_end_flush();
?>