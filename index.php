<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Linker</title>
  <?php include('master/cdnTop.php'); ?>
  <link rel="stylesheet" href="style.css">
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4030503828225282" crossorigin="anonymous"></script>
</head>

<body>
  <?php
  include('function.php');
  // <!-- Security  -->
  include('protected/Auth.php');
  // <!-- endSecurity -->
  include('master/navbar.php');
  include('user/modals.php');
  ?>
  <div class="container-fluid">
    <div class="row" style="background:#E5E6E7;">
      <div class="col-md-2">
        <div class="AdsContainerTopLeft">
        <div class="w-100 AdsArea"></div>
        </div>
      </div>
      <!-- -- Links --  -->
      <div class="col-md-8">
        <?php
        $limit = 14;
        $pages = ceil(countQuery('linksinformation') / $limit);
        if (ig('p')) {
          $id = $_GET['p'];
          $start = ($id - 1) * $limit;
        } else {
          $start = 1;
          $id = 1;
        }
        $key = '';
        $links = selectQuery('linksinformation', 'category', 'category_id ORDER BY linksinformation.id DESC LIMIT ' . $start . ',' . $limit . '', 'categorys');

        if (ig('k')) {
          $key = $_GET['k'];
          $pages = ceil(countQuery("linksinformation WHERE detail LIKE '%" . $key . "%'") / $limit);
          if ($pages == 0) {
            echo '<h3 class="text-center">There is nothint to show links<span class="text-danger">% ' . $key . ' %</span></h3><img src="img/thinkemoji.png" class="w-50" alt="...">';
          }
          $links = selectQuery('linksinformation', 'category', "category_id WHERE detail LIKE '%" . $key . "%' ORDER BY linksinformation.id DESC LIMIT " . $start . "," . $limit . "", 'categorys');
        }
        ?>

        <h5 class="mt-3 text-center">Enjoy Links</h5>
        <div class="line-mf"></div>
        <div class="paginationTop mt-2">
        </div>
        <!-- //Links Cardss -->
        <div class="linkContainer d-flex justify-content-evenly flex-wrap">
          <?php
          while ($link = mysqli_fetch_assoc($links)) {
            $premium = '';
            if ($link['type'] == 'premium') {
              $premium = '<i class="fa-solid fa-crown text-warning"></i>';
            } ?>
            <div class="card m-1" style="width: 10rem;">
              <img src="<?php echo $link['link_img']  ?>" class="card-img-top" style="height: 8rem;" alt="...">
              <div class="card-body">
                <div class="">
                  <h6 class="card-title">
                    <?php echo $link['title'];
                    echo $premium; ?></h6> <small class="fs-smallest opacity-75"><?php echo $link['name'] ?></small>
                </div>
                <a class="btn btn-sm mt-1 btn-primary pointer" href="user/view/selectPatch.php?linkPatch=<?php echo $link['title'] ?> & linkId=<?php echo $link['id'] ?>">More <i class="fa-solid fa-circle-arrow-right"></i></a>
              </div>
            </div>
          <?php } ?>
        </div>

        <!-- Pagination  -->
        <div class="paginationBottom">
          <nav aria-label="Page navigation example">
            <ul class="pagination d-flex justify-content-center mt-5">
              <?php if ($id > 1) {
                $prev = $id - 1;
                if (ig('k')) {
                  echo '<li class="page-item"><a class="page-link" href="?k=' . $key . '&p=' . $prev . '">Previous</a></li>';
                } else {
                  echo '<li class="page-item"><a class="page-link" href="?p=' . $prev . '">Previous</a></li>';
                }
              } ?>
              <!-- Pagination Number Start -->
              <?php for ($i = 1; $i < $pages + 1; $i++) {
                $pag = '<li class="page-item ';
                if ($id - $i > 3 || $id - $i < -3) {
                  $pag .= 'd-none ';
                }
                if ($id == $i) {
                  $pag .= 'active';
                }
                if (ig('k')) {
                  $pag .= '"><a class="page-link" href="?k=' . $key . '&p=' . $i . '">' . $i . '</a></li>';
                } else {
                  $pag .= '"><a class="page-link" href="?p=' . $i . '">' . $i . '</a></li>';
                }
                // echo $id-$i;
                echo $pag;
              } ?>
              <!-- Pagination Number End -->
              <?php if ($id < $pages) {
                $next = $id + 1;
                if (ig('k')) {
                  echo '<li class="page-item"><a class="page-link" href="?k=' . $key . '&p=' . $next . '">Next</a></li>';
                } else {
                  echo '<li class="page-item"><a class="page-link" href="?p=' . $next . '">Next</a></li>';
                }
              } ?>
            </ul>
          </nav>
        </div>
      </div>
      <div class="col-md-2"></div>
    </div>
  </div>


  <?php include('master/cdnBotton.php'); ?>
  <script src="script.js"></script>
  <script>
    // ----- show link in index ---

    $('.searchInputLinks').attr('disabled', 'true');
    $('.navSearchBtn').html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="visually-hidden">Loading...</span>`);

    $('.clearInput').click(function() {
      $('.navSearchBtn').attr('href', `index.php`);
      localStorage.removeItem('searchInput');
    })

    fetch("http://localhost/Linker/master/apilink.php")
      .then(result => result.json())
      .then(links => {
        $(document).ready(function() {
          $('.searchInputLinks').removeAttr('disabled');
          $('.navSearchBtn').html(`<i class="fa-solid fa-magnifying-glass"></i>`);

          if (localStorage.getItem('searchInput')) {
            let search = localStorage.getItem('searchInput');
            $('.navSearchBtn').attr('href', `?k=${search}&p=1`);
            $('.searchInputLinks').val(search);
          }

        });
        $('.searchInputLinks').keyup(function() {
          let key = $(this).val().toLowerCase();

          let searchResult = links.filter(e => {
            return e.detail.toLowerCase().includes(key);
          })
          if (key.length > 0) {
            $('.navSearchBtn').attr('href', `?k=${key}&p=1`);
            localStorage.setItem('searchInput', key)
            let resultList = "";
            searchResult.forEach(element => {
              resultList += `<a onclick="return localStorage.setItem('searchInput',${element.title})" href="?k=${element.title}&p=1"  class="list-group-item bg-silver">${element.title}</a>`;
            });
            $('.searchResult').html(resultList);
            $('.searchResult').css({
              'height': '50vh'
            });
          } else {
            $('.navSearchBtn').attr('href', `index.php`);
            localStorage.removeItem('searchInput');
            $('.searchResult').html('index.php');
            $('.searchResult').css({
              'height': '0vh'
            });
          }
        })
      })
  </script>
</body>

</html>