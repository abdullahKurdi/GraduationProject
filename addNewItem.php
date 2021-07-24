<?php
ob_start("ob_gzhandler");
    session_start();
    $pageTitle = 'New Item';
    $activelANG3='';
    include 'init.php';
    if($userStatus==0){
    if(isset($_SESSION['user'])){
        $active =getUserInfo($_SESSION['u_id']);
        if($active['TrustStatus'] !=1){
        $countries = array('Choose...','Egypt','Saudi','Libya','Morocco','Algeria' ,'Jordan','Palestine','Bahrain','Qatar' ,'Somalia','Iraq','Lebanon','Syria');
        if($_SESSION['LANG']=='english'){$countries2 = array('Egypt','Saudi','Libya','Morocco','Algeria' ,'Bahrain','Qatar' ,'Somalia','Jordan','Palestine','Iraq','Lebanon','Syria','Tunisia','Sudan','Mauritania','Oman','Yemen','Kuwait','Djibouti','Comoros','The United Arab Emirates');}else{
            $countries2 = array('مصر','السعوديه','ليبيا','المغرب','الجزائر' ,'البحرين','قطر' ,'الصومال','الأردن','فلسطين','العراق','لبنان','سوريا');
        }
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
        $CATEGORIES=array();
        $sub=array();
        $cSub2=getCat('Where Parent !=0');
        foreach ($cSub2 as $c3){$sub[]=$c3['CatID'];}
        $cS=getCat('Where Parent=0 and AllowAds =0');
                 foreach ($cS as $c){
                    $CATEGORIES[]=$c['CatID'] ;
                    $catName[]=$c['CatName']; ?>
                    <script>
                        <?php 
                            $cSub=getCat('Where AllowAds =0 and Parent='.$c['CatID']);?>
                            var x<?php echo $c['CatID'];?>=[];
                            var y<?php echo $c['CatID'];?>=[];
                            <?php echo 'x'.$c['CatID'];?>.push('Choose...');
                            <?php echo 'y'.$c['CatID'];?>.push('<?php echo lang('Choose...');?>');
                            <?php if(!empty($cSub)){?>
                                <?php foreach ($cSub as $c2){
                                    echo 'y'.$c['CatID'];?>.push("<?php echo lang($c2['CatName']);?>");
                                    <?php
                                    echo 'x'.$c['CatID'];?>.push("<?php echo $c2['CatID'];?>");
                                    <?php }
                                    }?>
                    </script>
                    <?php } ?>
               <script>
              function selectCategory(){
                var x =document.getElementById('inputCategory').value;
                <?php  foreach ($cS as $c){?>
                    if (x === "<?php echo $c['CatID'];?>"){
                       var y = "<?php echo 'x'.$c['CatID'];?>";
                       if(y==="<?php echo 'x'.$c['CatID'];?>"){
                        var array=[];
                            var array = <?php echo 'y'.$c['CatID'];?>;
                            var array2 = <?php echo 'x'.$c['CatID'];?>;
                        }else{
                            var array=['Choose...'];
                            var array2=['Choose...'];
                        }
                    var str='';
                    for(i=0 ; i<array.length ; i++){
                            str+='<option value="'+array2[i]+'">'+array[i]+'</option>'
                        }
                    document.getElementById('subCat').innerHTML=str;
                }
                <?php }?>  
            }
               </script>
               <?php 
        $STATUSS = array('New', 'Like New','Used' , 'Old');
        $TRADING = array('Supply','Demand');  
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            date_default_timezone_set('Asia/Amman');
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
            
            $userid         =   filter_var($_SESSION['u_id'],FILTER_SANITIZE_NUMBER_INT);    
            $name           =   filter_var($_POST['name'],FILTER_SANITIZE_STRING);
            $description    =   filter_var($_POST['Description'],FILTER_SANITIZE_STRING);
            $price          =   filter_var($_POST['Price'],FILTER_SANITIZE_NUMBER_INT);
            $startbidding   =   filter_var($_POST['Start'],FILTER_SANITIZE_STRING);
            $endbidding     =   filter_var($_POST['End'],FILTER_SANITIZE_STRING);
            $country        =   filter_var($_POST['Country'],FILTER_SANITIZE_STRING);
            $city           =   filter_var($_POST['City'],FILTER_SANITIZE_STRING);
            $status         =   filter_var($_POST['Status'],FILTER_SANITIZE_STRING);
            $startprice     =   filter_var($_POST['startprice'],FILTER_SANITIZE_NUMBER_INT);
            $categoryP       =   filter_var($_POST['category'],FILTER_SANITIZE_NUMBER_INT);
            $category       =   filter_var($_POST['SubCat'],FILTER_SANITIZE_NUMBER_INT);
            $typeauction    =   filter_var($_POST['typeauction'],FILTER_SANITIZE_STRING);
            //validate the form
            
            $formErrors = array();
            if(($userid) == 0){
                $formErrors[] = 'member can\'t be empty';
            }
            if(empty($name)){
                $formErrors[] = 'name can\'t be empty</div>';
            }
            if(strlen($name) < 2){
                $formErrors[] = 'name can\'t be less than 2 characters';
            }
            if(strlen($name) > 80){
                $formErrors[] = 'name can\'t be more than 20 characters<';
            }
            if(empty($price)){
                $formErrors[] = 'price can\'t be empty';
            }
            if(strlen($price) <= 0){
                $formErrors[] = 'price  can\'t be less than 1';
            }
            if(($country) == 'Choose...'){
                $formErrors[] = 'country can\'t be empty';
            }
            if(empty($country)){
                $formErrors[] = 'country can\'t be empty';
            }
            if(!in_array($country, $countries2)){
                $formErrors[] = 'country not founded';
            }
            if(!in_array($city, $cities)){
                $formErrors[] = 'City Not Founded';
            }
            if(($city) == 'Choose...'){
                $formErrors[] = 'City can\'t be empty';
            }
            if(empty($city)){
                $formErrors[] = 'City can\'t be empty';
            }
            if(!in_array($categoryP, $CATEGORIES)){
                $formErrors[] = 'Category Not Founded';
            }
            if(($categoryP) == 0){
                $formErrors[] = 'category can\'t be empty';
            }
            if(!in_array($category, $sub)){
                $formErrors[] = 'Sub Category Not Founded';
            }
            if(($category) == 0){
                $formErrors[] = 'sub category can\'t be empty';
            }
            if(empty($status)){
                $formErrors[] = 'status can\'t be empty';
            }
            if(!in_array($status, $STATUSS)){
                $formErrors[] = 'Status Not Founded';
            }
            if($status == 'Choose...'){
                $formErrors[] = 'status can\'t be empty';
            }
            if(!in_array($typeauction, $TRADING)){
                $formErrors[] = 'This Type Not Founded';
            }
            if(empty($typeauction)){
                $formErrors[] = 'Trading Type\'t be empty';
            }
            if($typeauction == 'Choose...'){
                $formErrors[] = 'Trading Type can\'t be empty';
            }
            if($startbidding != '' xor $endbidding != ''){
                $formErrors[] ='Start bidding or end biideng can\'t be '. 'empty';
            }
            
            if(($startbidding) <= date('Y-m-d H:i:s')){
                if ($startbidding != ''){
                $formErrors[] ='Start bidding can\'t be less than '. date('Y-m-d H:i:s') ;
                }
            }
            if(($endbidding) >= date('Y-m-d H:i:s' , $next3month)){
                if($endbidding != ''){
                $formErrors[] ='End bidding can\'t be more than '. date('Y-m-d H:i:s' , $next3month) ;
                }
            }
            if(empty($description)){
                $formErrors[] =  'description can\'t be empty';
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
            if (empty($formErrors)){
                $check = $con->prepare("select SellingPoint from users where UserID =?");
                $check->execute(array($_SESSION['u_id']));
                $result =$check->fetchAll();
                $point= $result[0]['SellingPoint'];
                if ($point>0){
                // if(checkItem('Name','items',$name) != 1){
                     //insert Member into the database with this information
                     for($i = 0 ; $i < $files_count  ; $i++){
                        $itemPic[$i] = rand(0,10000000000000).'_'.$itemPic_name[$i];
                        move_uploaded_file($itemPic_tmp[$i],"controlPanel\uploads\item_pic\\".$itemPic[$i]);
                        $all_imgs[$i]= $itemPic[$i];
                     }
                     $db_imgs =implode('|',$all_imgs);
                    $stmt = $con->prepare("INSERT INTO 
                                            items (Name, Description , Price , startBidding, endBidding, Country_Made, City_Made, Status, TypeOfAuction, AuctionStart, Add_Date, Image, Cat_ID ,Member_ID) 
                                            VALUES(:auser, :dess, :pric, :star, :ends ,:addres ,:city, :sta, :typeof, :auctionstart, now(),:img , :category , :member)");
                    $stmt->execute(array(
                        'auser'         => $name,
                        'dess'          => $description,
                        'pric'          => $price,
                        'star'          => $startbidding,
                        'ends'          => $endbidding,
                        'addres'        => $country,
                        'city'          => $city,
                        'sta'           => $status,
                        'typeof'        => $typeauction,
                        'auctionstart'  => $startprice,
                        'img'           =>$db_imgs,
                        'category'      => $category,
                        'member'        => $userid,
                    ));
                    if($stmt){
                        $point = $point -1;
                        $stmt = $con->prepare("UPDATE users SET  SellingPoint= ? WHERE UserID =  ? ");
                        $stmt->execute(array($point,$userid));
                        $alertMsg='<div class="container"><div class="alert alert-success" role="alert">'.lang('Thank You For Added Item').'</div></div>';
                        redirctAlert($alertMsg,'back');}
                    }else{
                        $alertMsg ='<div class="container"><div class="alert alert-danger" role="alert">'.lang('You Don\'t Have Selling Ponit').'</div></div>';
                        redirctAlert($alertMsg,'back');
                    }
                // }else{
                //     $alertMsg ='<div class="alert alert-danger" role="alert">Sorry This Item Is Exist</div>';
                //     redirctAlert($alertMsg,'back');}
                
            }else{
                foreach($formErrors as $error){
                    echo "<div class='container'>";
                    echo '<div class="nice-message2">' . $error . '</div>';
                    echo "</div>";
                }
                    redirctAlert('','back',10);
                    
            }
        }
    ?>
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <div class="upp">
                <h1 class="display-4"><?php echo lang('Add New Item');?></h1>
                <p class="lead"><?php echo lang('Arab auctions is very good for your buy and sell your products');?></p>
                <hr class="my-4">
                </div>
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
                    <div class='row'>
                        <div class="col-sm-12 col-md-6 col-lg-8">
                            <div class="r1 row">
                                <div class="col-lg-6">
                                <label for="name"><?php echo lang('Item Name');?></label>
                                <input type="text" id="name" name="name" class="form-control live" data-class=".livename" pattern=".{4,}" title="This field require at least 3 charcter" placeholder="<?php echo lang('Ex: MacBook For Sell');?>" required>
                                </div>
                                <div class="col-lg-6">
                                <label for="price"><?php echo lang('Selling Price');?></label>
                                <input type="number" id="price" name="Price" class="form-control live" data-class=".liveselling" placeholder="<?php echo lang('Specific Price Or Put Zero');?>" required>
                            </div>
                            </div>
                            <div class="r1 row">
                                <div class="col-lg-6">
                                <label for="pic"><?php echo lang('Select Picture');?></label>
                                <input type="file" id="pic" name="itemPic[]" multiple="multiple" class="form-control live">
                                </div>
                                <div class="col-lg-6">
                                <label for="price1"><?php echo lang('Auction Start Price');?></label>
                                <input type="number" id="price1" name="startprice" class="form-control live" data-class=".livestart" placeholder="<?php echo lang('The Current Value Of Start Auction');?>" required>
                            </div>
                            </div>
                            <hr class="my-4">
                            <div class="r1 row">
                            <div class="col-lg-6">
                                    <label for="inputCity"><?php echo lang('Country');?></label>
                                    <select id="inputContrychang" onchange="selectCity()" name="Country" class="form-control" required>
                                        <?php foreach($countries as $country){echo '<Option value="'. lang($country).'">'.lang($country).'</Option>';}?>
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <label for="inputCity"><?php echo lang('City');?></label>
                                    <select id="inputCityoption" name="City" class="city form-control" required>
                                        <option value="Choose..." selected><?php echo lang('Choose...');?></option>
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <label for="inputCategory"><?php echo lang('Category');?></label>
                                    <select id="inputCategory" onchange="selectCategory()" name="category" class="form-control" required>
                                        <option value="Choose..."><?php echo lang('Choose...');?></option>
                                        <?php foreach ($cS as $c){echo "<option value ='" . $c['CatID'] . "'>" . lang($c['CatName']) . "</option>";}?>
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <label for="inputCity"><?php echo lang('sub category');?></label>
                                    <select id="subCat" name="SubCat" class="form-control" required>
                                    <option value="Choose..."><?php echo lang('Choose...');?></option>
                                    <!--  -->
                                    </select>
                                </div>
                            </div>
                            <div class="r1 row">
                                <div class="col-lg-6">
                                    <label for="inputState"><?php echo lang('Status');?></label>
                                    <select id="inputState" name="Status" class="form-control" required>
                                        <option value="Choose..."><?php echo lang('Choose...');?></option>
                                        <?php foreach ($STATUSS as $Status){echo '<Option value="'.$Status.'">'.lang($Status).'</Option>';} ?>
                                        </select>
                                </div>
                                <div class="col-lg-6">
                                    <label for="inputType"><?php echo lang('Trading Type');?></label>
                                    <select id="inputType" name="typeauction" class="form-control" required>
                                        <option value="Choose..." selected><?php echo lang('Choose...');?></option>
                                        <?php foreach($TRADING as $type){echo '<Option value="'.$type.'">'.lang($type).'</Option>';} ?>
                                    </select>
                                </div>
                            </div>
                            <hr class="my-4">
                            <div class="r1 row">
                                <div class="col-lg-6">
                                <label for="start"><?php echo lang('Start Bidding');?></label>
                                <input type="datetime-local" name="Start" id="start" class="form-control">
                                </div>
                                <div class="col-lg-6">
                                <label for="price"><?php echo lang('End Bidding');?></label>
                                <input type="datetime-local" id="end" name="End" class="form-control">
                                </div>
                            </div>
                            <hr class="my-4">
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1"><?php echo lang('Description');?></label>
                                <textarea class="form-control live" required name="Description" data-class=".livedes" id="exampleFormControlTextarea1" placeholder="<?php echo lang('description for this product...');?>" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="cardform col-sm-12 col-md-6 col-lg-4">
                        <div class="r1 row liveprev">
                            <div class="card" style="width: 18rem;">
                            <span class="price-tag">$<span class="liveselling">0</span></span>
                                <img class="card-img-top" src="layout/Img/shop.png" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title livename"><?php echo lang('Item title');?></h5>
                                    <p class="card-text livedes"><?php echo lang('Item Description');?></p>
                                </div>
                                <ul class="list-group list-group-flush">
                                        
                                        <li class="list-group-item"><?php echo lang('Display About Auction');?></li>
                                </ul>
                                <input type="submit" class="btn btn-primary" value="<?php echo lang('New Item');?>">
                            </div>
                        </div>
                        <hr class="my-4">
                        </div>
                    </div>   
                </form>
            </div>
        </div>
    <?php
        }else{
            echo "<div class='container'>" . "</br>";
            $alertMsg= '<div class="alert alert-danger" role="alert"><strong>Sorry'.lang('You Are Blocked').'</strong></div>';
            redirctAlert($alertMsg,'back',4);
            echo "</div>";
        }
    }else{
        header('Location:index.php'); // redirect to dashboard page
        exit();}
    }else{header('Location:index.php'); // redirect to dashboard page
        exit();}
    include $temp . 'footer.php';
ob_end_flush();
?>