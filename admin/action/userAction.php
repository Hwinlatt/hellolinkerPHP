<?php
include('../../function.php');
include('../../protected/IsAdmin.php');

if (ig('deluserid')) {
    $id = $_GET['deluserid'];
    deleteQuery('users', 'id', $id);
    url('admin/dashboard.php');
    return;
};
$color = "text-danger";
$errorPassword = '';
$resetPasword = "";
if(ip('resetPassword')){
    $newPass = $_POST['resetPassword'];
    $id = $_GET['edituserid'];
    $user = selectQuery('users','id',$id);
    $resetPasword = $newPass;
    if ($newPass == '') {
        $errorPassword = "Password is Empty";
    }elseif(password_verify($newPass,$user[0]['password'])){
        $errorPassword = "Old and New Password are same!";
    }else{
        $password = password_hash($newPass,PASSWORD_DEFAULT);
        mysqli_query($conn,"UPDATE users SET password='$password'");
        $errorPassword = "Password reset successful.";
        $color = "text-success";
    }
}

if(ip('updateUserReq')){
    $name = $_POST['upName'];
    $email = $_POST['upEmail'];
    $role = $_POST['upUserRole'];
    $id = $_GET['edituserid'];
    mysqli_query($conn,"UPDATE users SET userName='$name',email='$email',userRole='$role' WHERE id=$id;");
    url('admin/dashboard.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include('../../master/cdnTop.php') ?>
</head>

<body>
    <?php if (ig('edituserid')) { 
        $id = $_GET['edituserid'];
        $user = selectQuery('users','id',$id);
        $role = $user[0]['userRole'];
        ?>
        
        <div class="container mt-3">
            <div class="row">
                <div><a href="<?php herf('admin/dashboard.php') ?>" class="btn btn-outline-primary"><i class="fa-solid fa-arrow-left"></i> Back</a></div>
            </div>
            <div class="row d-flex justify-content-center mt-5">
                <div class="col-md-4 p-2 border rounded">
                    <form action="" method="POST">
                    <small>Username</small>
                    <input type="text" class="form-control" required  name="upName" placeholder="Enter Username" value="<?php echo $user[0]['userName'] ?>">
                    <small>Email</small>
                    <input type="email" class="form-control" required name="upEmail" placeholder="Enter Email" value="<?php echo $user[0]['email'] ; ?>">
                    <small>User role</small>
                    <select name="upUserRole" id="" required class="form-select">
                        <option value="user" <?php if($role == 'user'){ echo 'selected';}; ?>>User</option>
                        <option value="member"  <?php if($role == 'member'){ echo 'selected';}; ?>>Member</option>
                        <option value="admin" <?php if($role == 'admin  '){ echo 'selected';}; ?>>admin</option>
                    </select>
                    <input type="submit" name="updateUserReq" class="btn btn-primary mt-3 w-100" value="Update"></input>
                    </form>
                </div>
                <div class="col-md-4">
                    <h5 class="text-center">Actions</h5><br>
                    <a onclick="return confirm('Are your sure to delet this user')" href="?deluserid="<?php echo $id ?> class="btn btn-danger">Delete</a>
                    <div class="border-bottom border-secondary mt-2 mx-3"></div>
                    <form action="" method="POST" class="">
                        <input type="password"  name="resetPassword"  class="form-control my-2 resetPassword" placeholder="Enter New Password">
                        <small class="<?php echo $color ?>"><?php echo $errorPassword; ?></small><br>
                        <button type="submit" onclick="return confirm('Change password to >'+$('.resetPassword').val())" class="btn btn-warning"><i class="fa-solid fa-key"></i> Reset Password</button>
                    </form>
                </div>
            </div>
        </div>
    <?php } ?>



    <?php include('../../master/cdnBotton.php') ; ?>
</body>

</html>