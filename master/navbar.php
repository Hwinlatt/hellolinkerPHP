<?php 
$user = selectQuery('users', 'email', $_SESSION['email']); ?>
<nav class="navbar bg-light shadow ">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="<?php herf('img/linklogo.jpg') ?>" alt="" width="30" height="24" class="d-inline-block align-text-top">
      Hello Linker  
    </a>
  
    <div class="searchContainer" role="search position-sticky sticky-top">
      <input class="form-control searchInputLinks" placeholder="Search...">
      <select class="rounded border-silver text-center" name="addLinkCategory" aria-label="Default select example">
        <option value="all">All</option>
        <?php $categories = selectQuery('categorys');
        while ($category = mysqli_fetch_assoc($categories)) { ?>
          <option value="<?php echo $category['category_id'] ?>"><?php echo  $category['name'] ?></option>
        <?php } ?>
      </select>
    </div>
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
        <?php }else{ ?>
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
        <div class="d-flex" role="search position-sticky sticky-top">
      <input class="form-control searchInputLinks" placeholder="Search...">
      <select class="rounded border-silver text-center" name="addLinkCategory" aria-label="Default select example">
        <option value="all">All</option>
        <?php $categories = selectQuery('categorys');
        while ($category = mysqli_fetch_assoc($categories)) { ?>
          <option value="<?php echo $category['category_id'] ?>"><?php echo  $category['name'] ?></option>
        <?php } ?>
      </select>
    </div>
        </li>
      </ul>
  </div>
</nav>