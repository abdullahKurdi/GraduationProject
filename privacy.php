<?php
ob_start("ob_gzhandler");
    session_start();
    $pageTitle = 'privacy policy';
    $activelANG3='';
    include 'init.php';?>
<div class="privacy">
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><?php echo lang ('To the buyer');?></a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><?php echo lang ('To the seller');?></a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
  <p>
        <?php echo lang ('Tseller1');?>
     </p>
     <p>
        <?php echo lang ('Tseller2');?>
     </p>
     <p>
        <?php echo lang ('Tseller3');?>
     </p>
     <p>
        <?php echo lang ('Tseller4');?>
     </p>
     <p>
        <?php echo lang ('Tseller5');?>
     </p>

</div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
  <p>
        <?php echo lang ('Tseller6');?>
     </p>
     <p>
        <?php echo lang ('Tseller7');?>
     </p>
     <p>
        <?php echo lang ('Tseller8');?>
     </p>
     <p>
        <?php echo lang ('Tseller9');?>
     </p>
  
  </div>
</div>
</div>

    <?php include $temp . 'footer.php';
ob_end_flush();
?>