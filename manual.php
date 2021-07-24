<?php
ob_start("ob_gzhandler");
    session_start();
    $pageTitle = 'manual';
    $activelANG3='';
    include 'init.php';?>
    <div class="manual">
    <div class="accordion" id="accordionExample">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <?php echo lang ('Signup In Arab Auctions');?>
        </button>
      </h2>
    </div>
    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
        <div class="card mb-3">
            <img src="layout/Img/<?php if ( $_SESSION['LANG']=='arabic'){echo 'f1.png';}else{echo 'f2.png';}?>" height="350px" width="150px" class="col-12 col-sm-6 card-img-top" alt="...">
            <div class="card-body">
                <p class="card-text"><?php echo lang ('Click on a signup to start registering on the site');?></p>
            </div>
        </div>
        <div class="card mb-3">
            <img src="layout/Img/<?php if ( $_SESSION['LANG']=='arabic'){echo 'f3.png';}else{echo 'f4.png';}?>" height="350px" width="150px" class="col-12 col-sm-6 card-img-top" alt="...">
            <div class="card-body">
                <p class="card-text"><?php echo lang ('Then fill out the options.');?></p>
            </div>
        </div>
        <div class="card mb-3">
            <img src="layout/Img/<?php if ( $_SESSION['LANG']=='arabic'){echo 'f5.png';}else{echo 'f6.png';}?>" height="350px" width="150px" class="col-12 col-sm-6 card-img-top" alt="...">
            <div class="card-body">
                <p class="card-text"><?php echo lang ('Then enter the verification code ');?></p>
            </div>
        </div>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            <?php echo lang ('Edit Profile');?>
        </button>
      </h2>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body">
        <div class="card mb-3">
            <img src="layout/Img/<?php if ( $_SESSION['LANG']=='arabic'){echo 'f8.png';}else{echo 'f7.png';}?>" height="350px" width="150px" class="col-12 col-sm-6  card-img-top" alt="...">
            <div class="card-body">
                <p class="card-text"><?php echo lang ('Click on my profile');?></p>
            </div>
        </div>
        <div class="card mb-3">
            <img src="layout/Img/<?php if ( $_SESSION['LANG']=='arabic'){echo 'f10.png';}else{echo 'f9.png';}?>" height="350px" width="150px" class="col-12 col-sm-6 card-img-top" alt="...">
            <div class="card-body">
                <p class="card-text"><?php echo lang ('To edit the information click edit information');?></p>
            </div>
        </div>
        <div class="card mb-3">
            <img src="layout/Img/<?php if ( $_SESSION['LANG']=='arabic'){echo 'f14.png';}else{echo 'f13.png';}?>" height="350px" width="150px" class="col-12 col-sm-6 card-img-top" alt="...">
            <div class="card-body">
                <p class="card-text"><?php echo lang ('To recharge points, you must have a balance, and these points enable you to bid or add a product');?></p>
            </div>
        </div>
        <div class="card mb-3">
            <img src="layout/Img/<?php if ( $_SESSION['LANG']=='arabic'){echo 'f12.png';}else{echo 'f11.png';}?>" height="350px" width="150px" class="col-12 col-sm-6 card-img-top" alt="...">
            <div class="card-body">
                <p class="card-text"><?php echo lang ('From here, the balance can be transferred to points for bidding or buying and points of sale');?></p>
            </div>
        </div>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingThree">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
           <?php echo lang ('Add Item');?>
        </button>
      </h2>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
      <div class="card-body">
        <div class="card mb-3">
            <img src="layout/Img/<?php if ( $_SESSION['LANG']=='arabic'){echo 'f8.png';}else{echo 'f7.png';}?>" height="350px" width="150px" class="col-12 col-sm-6 card-img-top" alt="...">
            <div class="card-body">
                <p class="card-text"><?php echo lang ('To add an item, click Add Item');?></p>
            </div>
        </div>
        <div class="card mb-3">
            <img src="layout/Img/<?php if ( $_SESSION['LANG']=='arabic'){echo 'f15.png';}else{echo 'f16.png';}?>" height="350px" width="150px" class="col-12 col-sm-6 card-img-top" alt="...">
            <div class="card-body">
                <p class="card-text"><?php echo lang ('Then, in order to complete the process, you must have the points of sale. Also, if you want to sell the product without the bidder, leave the start and end fields for the auction.');?></p>
            </div>
        </div>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingThr">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThr" aria-expanded="false" aria-controls="collapseThr">
           <?php echo lang ('Participation in the auction');?>
        </button>
      </h2>
    </div>
    <div id="collapseThr" class="collapse" aria-labelledby="headingThr" data-parent="#accordionExample">
      <div class="card-body">
        <div class="card mb-3">
            <img src="layout/Img/<?php if ( $_SESSION['LANG']=='arabic'){echo 'f18.png';}else{echo 'f17.png';}?>" height="350px" width="150px" class="col-12 col-sm-6 card-img-top" alt="...">
            <div class="card-body">
                <p class="card-text"><?php echo lang ('To bid or buy an item, click on View Item');?></p>
            </div>
        </div>
      </div>
        <div class="card mb-3">
            <img src="layout/Img/<?php if ( $_SESSION['LANG']=='arabic'){echo 'f19.png';}else{echo 'f20.png';}?>" height="350px" width="150px" class="col-12 col-sm-6 card-img-top" alt="...">
            <div class="card-body">
                <p class="card-text"><?php echo lang ('From here you can buy or bid the product as requested by the seller');?></p>
            </div>
        </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTw">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTw" aria-expanded="false" aria-controls="collapseTw">
            <?php echo lang ('Add Ads');?>
        </button>
      </h2>
    </div>
    <div id="collapseTw" class="collapse" aria-labelledby="headingTw" data-parent="#accordionExample">
      <div class="card-body">
        <div class="card mb-3">
            <img src="layout/Img/<?php if ( $_SESSION['LANG']=='arabic'){echo 'f21.png';}else{echo 'f22.png';}?>" height="50px" width="150px" class="col-12 col-sm-6 card-img-top" alt="...">
            <div class="card-body">
                <p class="card-text"><?php echo lang ('Add an advertisement on the Arab Auctions site, click on Add Ad or Contact Us');?></p>
            </div>
        </div>
        <div class="card mb-3">
            <img src="layout/Img/<?php if ( $_SESSION['LANG']=='arabic'){echo 'f24.png';}else{echo 'f23.png';}?>" height="350px" width="150px" class="col-12 col-sm-6 card-img-top" alt="...">
            <div class="card-body">
                <p class="card-text"><?php echo lang ('Thank You');?></p>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

    </div>
    <?php 
    include $temp . 'footer.php';
    ob_end_flush();
    ?>