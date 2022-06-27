<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <?php include('../master/cdnTop.php') ?>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <?php
    include('../function.php');
    // ----------Secure Start---------
    include('../protected/Auth.php');
    include('../protected/IsAdmin.php');
    // -------- Secure End -----
    include('../user/modals.php');
    include('../master/navbar.php');
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="m-0 p-0 col-md-2">
                <h5 class="mt-1 text-center">Admin Dashboard</h5>
                <?php include('leftMenus.php') ?>
            </div>
            <div class="col-md-10 mt-">
                <h5 class="mt-1 text-center section-header"> </h5>
                <section class="sectionShow">
                    <!-- ---- Come From section folder -->
                </section>
            </div>
        </div>
    </div>




    <?php include('../master/cdnBotton.php'); ?>
    <script src="../script.js"></script>
    <script>
        $(document).ready(function(){
            if (localStorage.getItem('select')) {
            $('.'+localStorage.getItem('select')).click();
            }else{
                $('.linkSection').click();
            }
        })

        // ------Change Section Script ----
        $('.linkSection').click(function(){
            $('.sectionShow').load("section/links.php");
            localStorage.setItem('select','linkSection');
            $('.section-header').html($('.linkSection').html());
        })
        $('.userSection').click(function(){
            $('.sectionShow').load("section/users.php");
            localStorage.setItem('select','userSection');
            $('.section-header').html($('.userSection').html());

        })
        // -- Edit Link -- 

    </script>
</body>

</html>