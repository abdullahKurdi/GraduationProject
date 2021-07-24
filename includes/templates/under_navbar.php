<section class="slider">
<!-- <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel"> -->
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
    <img src="layout/Img/2.jfif" height="270px" class="d-block w-100" alt="...">    
  </div>
  </div>
 
  </a>
</div>
  <!-- <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="layout/Img/4.jpg" height="270px" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="layout/Img/5.jpg" height="270px" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="layout/Img/6.jpg" height="270px" class="d-block w-100" alt="...">
      </div>
    </div> -->
  <div class="btn1 btn btn-dark <?php if($_SESSION['TypeOfAuction'] !== 'Supply') {echo 'activeTypeOfAuction';}?>"><a href="index.php?TypeOfAuction=Supply"><?php echo lang('Supply');?></a></div>
  <div class="btn2 btn btn-dark <?php if($_SESSION['TypeOfAuction'] !== 'Demand') {echo 'activeTypeOfAuction';}?>"><a href="index.php?TypeOfAuction=Demand"><?php echo lang('Demand');?></a></div>
<!-- </div> -->
</section>
<section class="gategory">
    <div class="form-group row">
    <?php
    $category = getCat('where Parent = 0 and Visibility = 0');
    if (!empty($category)){
        foreach($category as $cat){
            echo '<div class="col-6 col-md-2 ">
                  <select class="form-control" onchange="if (this.value) window.location.href=this.value">
                  <option class="form-control" "selected>-'; if(lang($cat['CatName'])){echo lang($cat['CatName']);}else{echo $cat['CatName'];} echo '-</option></hr>
                    <option class="form-control" value="Category.php?Catid='.$cat['CatID'].'">'.lang('All'),' ' ; if(lang($cat['CatName'])){echo lang($cat['CatName']);}else{echo $cat['CatName'];} echo'</option>';
                    $SubCategory = getCat('where Visibility = 0 and Parent ='.$cat['CatID']);
                    foreach($SubCategory as $subcat){
                    echo '<option class="form-control" value="Category.php?Catid='.$subcat['CatID'].'">' ; echo lang($subcat['CatName']); echo'</option>';}

                    echo '</select>
                  </div>';
        }
    }else{
        echo "<bold class='col-10 col-sm-6 col-md-5 col-lg-4 alertcat'>We Don't Have Any Category</bold>";
    }
?>
    </div>
</section>
