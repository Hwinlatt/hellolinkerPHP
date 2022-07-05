<div class="ms-0 leftMenuBar">
<h5 class="mt-1 text-center">Admin Dashboard</h5>
<div class="line-mf mb-2 "></div>
<ul class="list-group">
<a class="list-group-item linkSection" href="<?php herf('admin/section/linksAdmin.php') ?>"><i class="fa-solid fa-link"></i> Links</a>
  <a class="list-group-item userSection" href="<?php herf('admin/section/usersAdmin.php') ?>"><i class="fa-solid fa-users"></i> Users</a>
  <a class="list-group-item reportLinkSection" href="<?php herf('admin/section/reportLinks.php') ?>"><i class="fa-solid fa-triangle-exclamation"></i> Report Links <span class="badge text-bg-danger"><?php echo countQuery('report','resolved_by','none') ?></span></a>
</ul>
</div>