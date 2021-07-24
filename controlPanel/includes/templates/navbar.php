<nav class="navbar navbar-expand-md navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php"><?php echo lang('Home');?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto  mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="categories.php"><?php echo lang('Categories');?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="members.php"><?php echo lang('Members');?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Items.php"><?php echo lang('Items');?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="notifications.php"><?php echo lang('Notifications');?></a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Logistics
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDarkDropdownMenu">
            <li><a class="dropdown-item" href="logistics.php?ManageBidding" >Bidding Logistics</a></li>
            <div class="dropdown-divider"></div>
            <li><a class="dropdown-item" href="logistics.php?do=ManageBuyer">Buyer Logistics</a></li>
            <div class="dropdown-divider"></div>
            <li><a class="dropdown-item" href="logistics.php?do=ManageAdver">Ads</a></li>
          </ul>
        </li>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php echo $_SESSION['Username']; ?>
          </a>
          <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
            <li><a class="dropdown-item" href="../index.php" target="_blank"><?php echo lang('Visit Shop');?></a></li>
            <li><a class="dropdown-item" href="members.php?do=Edit&userid=<?php echo $_SESSION['ID']?>"><?php echo lang('Edit');?></a></li>
            <div class="dropdown-divider"></div>
            <li><a class="dropdown-item" href="logout.php"><?php echo lang('Logout');?></a></li>
          </ul>
          </ul>
    </div>
  </div>
</nav>