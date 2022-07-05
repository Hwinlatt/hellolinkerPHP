<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <?php include('../../master/cdnTop.php') ?>
    <link rel="stylesheet" href="../../style.css">
</head>

<body>
    <?php
    include('../../function.php');
    // ----------Secure Start---------
    include('../../protected/Auth.php');
    include('../../protected/IsAdmin.php');
    // -------- Secure End -----
    include('../../master/navbar.php');
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="m-0 p-0 col-md-2">
                <?php include('../leftMenus.php') ?>
            </div>
            <div class="col-md-10 mt-">
                <h5 class="mt-1 text-center section-header mt-3">Users</h5>
                <section class="sectionShow">
<section class="users">
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="userTableBody">
            <?php $users =  selectQuery('users');
            while ($user = mysqli_fetch_assoc($users)) { ?>
                <tr>
                    <td><?php echo $user['id'] ?></td>
                    <td><?php echo $user['userName'] ?></td>
                    <td><?php echo $user['email'] ?></td>
                    <td><?php echo $user['userRole'] ?></td>
                    <td>
                        <a href="<?php herf('admin/action/userAction.php?edituserid=' . $user['id']); ?>" class="btn btn-link">Edit</a>
                        <a onclick="return confirm('Are your sure to delet this user')" href="<?php herf('admin/action/userAction.php?deluserid=' . $user['id']) ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </thead>
    </table>
    
    </section>
            </div>
        </div>
    </div>




    <?php include('../../master/cdnBotton.php'); ?>
    <script src="../../script.js"></script>
    <script>
        $(document).ready(function() {
            $('.userSection').addClass('text-light bg-primary');
        })
        //Search User
        function search() {
            let searchKey = '';
            $('.searchInputLinks').each(function(){
                searchKey += $(this).val();
            })
            $.ajax({
                url: "../action/userAction.php",
                type: "POST",
                data: {
                    searchKey
                },
                success: function(data) {
                    $('.userTableBody').html(data);
                }
            })
        }

        $('.searchInputLinks').keyup(function() {
            search();
        })

        $('.clearInput').click(function() {
            $('.searchInputLinks').click();
            search();
        })
    </script>
    </body>

</html>