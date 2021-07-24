<nav class="navbar navbar-expand-md navbar-dark bg-dark">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto  mb-lg-0">
      <li class="nav-item">
          <a class="nav-link" href="logistics.php?do=ManageAdver">Ads</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logistics.php?do=ManageBidding">Bidding Logistics</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logistics.php?do=ManageBuyer">Buyer Logistics</a>
        </li>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php echo $_SESSION['Username']; ?>
          </a>
          <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
            <li><a class="dropdown-item" href="../index.php" target="_blank">Vist Shop</a></li>
            <div class="dropdown-divider"></div>
            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
          </ul>
          </ul>
    </div>
  </div>
</nav>