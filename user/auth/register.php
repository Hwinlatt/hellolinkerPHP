<?php 
include('../../function.php');

if (ip('rName') && ip('rEmail') && ip('rPassword') && ip('rCpassword')) {
    $name = $_POST['rName'];
    $email = $_POST['rEmail'];
    $password = password_hash($_POST['rPassword'],PASSWORD_DEFAULT);
    $rCpassword = $_POST['rCpassword'];
    if (countQuery('users','email',$email)>0) {
		echo "<script>alert('Emial is already registered.Try again!');window.location.href='../../login.php';</script>";
    }elseif (password_verify($rCpassword,$password) == 0) {
		echo "<script>alert('Password does not match!');window.location.href='../../login.php';</script>";
    }else{
        mysqli_query($conn,"INSERT INTO users (userName,email,password,created_at) 
        VALUES ('$name','$email','$password',now())");
		echo "<script>alert('Register Successful!Please Login.');window.location.href='../../login.php';</script>";
    }

}else{
    
}
?>