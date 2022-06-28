<?php include('../../function.php'); ?>
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
        <thead>
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