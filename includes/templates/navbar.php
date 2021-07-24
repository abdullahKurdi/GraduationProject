<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
<a class="navbar-brand" href="index.php">
      <img src="layout/Img/logo2.png" alt="" width="40" height="30" class="d-inline-block align-right logo">
      <?php echo lang('Arab-Auctions');?>
    </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav <?php if($_SESSION['LANG']=='english') {echo 'ml-auto';}else{echo 'mr-auto';}?>">
      <li class="nav-item ">
        <a class="nav-link" href="index.php"><i class="fa fa-home"></i> <?php echo lang('Home');?><span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="manual.php"><i class="fa fa-folder"></i> <?php echo lang('manual');?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="privacy.php"><i class="fa fa-bookmark"></i> <?php echo lang('privacy policy');?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contact.php"><i class="fa fa-comment"></i> <?php echo lang('Contact Us');?></a>
      </li>
    </ul>
  </div>
</nav>
