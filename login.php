<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Linker</title>
    <?php include('master/cdnTop.php'); ?>
    <link rel="stylesheet" href="style.css">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4030503828225282"
     crossorigin="anonymous"></script>
</head>

<body class="LoginBody" style="background: #E8EAED;">
    <?php
    include('function.php');
    include('protected/isAuth.php');
    ?>
    <div class="container-fluid">
        <div class="row d-flex align-items-center  justify-content-evenly" style="height: 100vh;">
            <div class="col-md-4">
                <h1 class="">Welcome From <span class="text-primary fw-bolder">HELLO LINKER</span></h1>
                <form class="loginForm margin-auto" action="user/auth/login.php" method="POST">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" name="lEmail" class="lEmail form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="lPassword" class="lPassword form-control" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input remember" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Remember Password</label>
                    </div>
                    <button type="button" class="btn btn-primary login">Login</button> <a class="btn btn-secondary">Gust</a>
                    <small class="loginCheckMessage text-danger"></small><br>
                    <small>If You Don't have accout<button type="button" class="btn btn-link goRegister">register here</button></small>
                </form>
                <!-- --------Register Form ------------ -->
                <form class="registerFrom" action="user/auth/register.php" method="POST" style="display: none;">
                    <small>Email</small>
                    <input required type="email" name="rEmail" class="form-control" placeholder="Enter Email">
                    <small>Name</small>
                    <input required type="text" name="rName" class="form-control" placeholder="Enter YourName">
                    <small>Password</small>
                    <input required type="password" name="rPassword" class="form-control" placeholder="New Password">
                    <small>ComfirmPassword</small>
                    <input required type="password" name="rCpassword" class="form-control mb-3" placeholder="Comfirm Password">
                    <button type="submit" class="btn btn-primary">Register</button>
                    <button class="btn btn-link backLogin" type="button"><i class="fa-solid fa-arrow-left"></i> Back to Login</button>
                </form>
            </div>
            <div class="col-md-6 "><img src="img/linksvgbackground.svg" alt="" class="w-100 h-100" srcset=""></div>
        </div>
    </div>


    <?php include('master/cdnBotton.php'); ?>
    <script>
        $('.login').click(function() {
            $('.login').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Login');
            $message = "";
            if ($('.lEmail').val().length == 0) {
                $message += "Check Email"
                $('.login').html('Login');
            }
            if ($('.lPassword').val().length == 0){
                $message += " Check Passord";
                $('.login').html('Login');
            }
            $('.loginCheckMessage').html($message);
            if ($('.lEmail').val().length != 0 && $('.lPassword').val().length != 0) {
               if ($('.remember').is(":checked")) {
                   localStorage.setItem("email",$('.lEmail').val());
                   localStorage.setItem("password",$('.lPassword').val());
               }
               setTimeout(() => {
                $('.login').html('Login');
                    $('.loginForm').submit();
                   }, 500);
                  
            }
        })
        $(document).ready(function() {
            if (localStorage.getItem('email') || localStorage.getItem('password')) {
                $('.lEmail').val(localStorage.getItem('email'));
                $('.lPassword').val(localStorage.getItem('password'));
                $('.remember').attr('checked','true')
            }
        })
        $('.backLogin').click(function() {
            $('.registerFrom').hide();
            $('.loginForm').show(1000);
        })
        $('.goRegister').click(function() {
            $('.loginForm').hide();
            $('.registerFrom').show(1000);
        })
    </script>
</body>

</html>