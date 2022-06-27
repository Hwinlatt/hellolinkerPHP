<?php 
include('../../function.php');
if (ip('lEmail') && ip('lPassword')) {
    $email = $_POST['lEmail'];
    $password = $_POST['lPassword'];
    $user = selectQuery('users','email',$email);
    if (password_verify($password,$user[0]['password']) == 1){
        echo $_SESSION['id'] = $user[0]['id'];
        echo $_SESSION['role'] = $user[0]['userRole'];
        echo $_SESSION['email'] = $user[0]['email'];
        if ($user[0]['userRole'] == 'admin') {
          url('admin/dashboard.php');
        }else{
         url('index.php');}
    }else{
		echo "<script>alert('Check Password');window.location.href='../../login.php';</script>";
    }
}else{
		echo "<script>alert('Check email and password');window.location.href='../../login.php';</script>";
}
?>