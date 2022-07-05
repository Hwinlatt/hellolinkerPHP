<?php
$user = selectQuery('users', 'email', $_SESSION['email']); ?>
<nav class="navbar bg-light shadow position-sticky sticky-top mainNavBar">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="<?php herf('img/linklogo.jpg') ?>" alt="" width="30" height="24" class="d-inline-block align-text-top">
      Hello Linker
    </a>
  <!-- //Search Start -->
    <div class="d-flex flex-column position-relative">
      <div class="searchContainer searchContainerBoth name=k  align-items-center" role="search">
        <input class="form-control searchInputLinks" placeholder="Search..."><i class="fa-solid fa-xmark clearInput"></i>
        <a href="" class="btn btn-outline-primary navSearchBtn"><i class="fa-solid fa-magnifying-glass"></i></a>
      </div>
      <ul class="list-group position-absolute searchResult w-100">
        <!-- <li class="list-group-item bg-silver">An item</li> -->
      </ul>
    </div>
    <!-- Search End -->


    <!-- --Drop Down  -->
    <div class="dropdown me-5">
      <button class="btn btn-light dropdown-toggle" type="button" id="dropDown<?php echo  $user[0]['userName']; ?>" data-bs-toggle="dropdown" aria-expanded="false">
        <?php echo  $user[0]['userName']; ?>
      </button>
      <ul class="dropdown-menu" aria-labelledby="dropDown<?php echo  $user[0]['userName']; ?>">
        <li><span class="dropdown-item"><span class="badge text-bg-primary"><?php echo  $user[0]['userRole']; ?></span></span></li>
        <?php if ($_SESSION['role'] == 'admin') { ?>
          <li><a class="dropdown-item" href="<?php herf('index.php') ?>"><i class="fa-solid fa-binoculars"></i> View as user</a></li>
        <?php } ?>
        <li>
          <hr class="dropdown-divider">
        </li>
        <?php if ($_SESSION['email'] == 'gust@gmail.com') { ?>
          <li><a class="dropdown-item" href="<?php herf('login.php') ?>"><i class="fa-solid fa-right-to-bracket"></i>Login</a></li>
        <?php } else { ?>
          <li><a class="dropdown-item" href="<?php herf('user/auth/logout.php?logout=true') ?>"><i class="fa-solid fa-power-off"></i> Logout</a></li>

        <?php } ?>
      </ul>
    </div>
    <div class="align-items-center menuContainer position-relative">
      <div class="line line-1"></div>
      <div class="line-2 line"></div>
      <div class=" line line-3"></div>
    </div>
  </div>
  <div class="menuForPhone">
    <ul class="d-flex flex-column row text-center fs-small fw-bolder nav-bar" style="list-style:none">
      <li class="col position-relative mb-3">
            <div class="d-flex flex-column position-relative">
      <div class=" searchContainerBoth name=k  align-items-center" role="search">
        <input class="form-control searchInputLinks" placeholder="Search..."><i class="fa-solid fa-xmark clearInput"></i>
        <a href="" class="btn btn-outline-primary navSearchBtn"><i class="fa-solid fa-magnifying-glass"></i></a>
      </div>
      <ul class="list-group position-absolute searchResult w-100">
        <!-- <li class="list-group-item bg-silver">An item</li> -->
      </ul>
    </div>
      </li>
    </ul>
  </div>
</nav>