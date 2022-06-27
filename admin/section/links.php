<?php include('../../function.php');
include('../../protected/IsAdmin.php') ?>
<div class="row">
    <div class="col-md-8">
        <table class="table">
            <thead>
                <th>Id</th>
                <th>Title</th>
                <th>view</th>
                <th>Category</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php $links = selectQuery('linksinformation','category','category_id','categorys');
                while ($link = mysqli_fetch_assoc($links)) { ?>
                    <tr>
                        <td><?php echo $link['id'] ?></td>
                        <td><?php echo $link['title'];
                            if ($link['type'] == 'premium') {
                                echo ' <i class="fa-solid fa-crown text-warning"></i>';
                            } ?></td>
                        <td><?php echo $link['view'] ?></td>
                        <td><?php echo $link['name'] ?></td>
                        <td>
                            <button class="btn btn-outline-secondary editLink" linkId="<?php echo $link['id'] ?>">Edit</button>
                            <a href="action/linkAction.php?delid=<?php echo $link['id'] ?>" onclick="return confirm('Are you sure to delete this folder')" class="btn btn-outline-danger">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="col-md-4">
        <div class="p-2 border border-silver shadow rounded-4 bg-silver addForm">
            <h5 class="text-center">Add Link Form</h5>
            <form action="action/linkAction.php" method="post">
                <input required type="text" class="form-control my-1" name="addLinkTitle" placeholder="Enter Title">
                <input required type="url" class="form-control my-1" name="addLinkLink" placeholder="Enter link https://">
                <input required type="text" class="form-control my-1" name="addLinkImg" placeholder="Enter Img Link https://">
                <textarea required name="addLinkDetail" id="" rows="6" class="form-control my-1" placeholder="Enter Detail"></textarea>
                <select class="form-select linkCategory" name="addLinkCategory" aria-label="Default select example">
                    <?php $categories = selectQuery('categorys');
                    while ($category = mysqli_fetch_assoc($categories)) { ?>
                    <option value="<?php echo $category['category_id'] ?>"><?php echo  $category['name'] ?></option>
                    <?php } ?>
                </select>
                <input required type="radio" class="form-check-input required" value="free" name="addLinkType" checked> <label class="form-check-label" for="">Free</label>
                <input required type="radio" class="form-check-input" value="premium" name="addLinkType"> <label class="form-check-label" for="">Premium</label>
                <button type="submit" class="btn btn-primary w-100 mt-2">Add</button>
            </form>
        </div>



        <!-- -- Update Form --  -->
        <div class="p-2 border border-silver shadow rounded-4 bg-silver updateForm" style="display: none;">
            <h5 class="text-center">Update Form</h5>
            <form action="action/linkAction.php" method="post">
                <input type="text" class="d-none updateLinkId" name="updateLinkId">
                <input required type="text" class="updateLinkTitle form-control my-1" name="updateLinkTitle" placeholder="Enter Title">
                <input required type="url" class="updateLinkLink form-control my-1" name="updateLinkLink" placeholder="Enter link https://">
                <small>image</small>
                <input required type="text" class="updateLinkImg form-control my-1" name="updateLinkImg" placeholder="Enter Img Link https://">
                <textarea required name="updateLinkDetail" id="" rows="6" class="form-control my-1 updateLinkDetail" placeholder="Enter Detail"></textarea>
                <select class="form-select" name="updateLinkCategory" aria-label="Default select example">
                    <?php $categories = selectQuery('categorys');
                    while ($category = mysqli_fetch_assoc($categories)) { ?>
                    <option class="categoryOption" value="<?php echo $category['category_id'] ?>"><?php echo  $category['name'] ?></option>
                    <?php } ?>
                </select>
                <input required type="radio" class="form-check-input required updateLinkTypeF" value="free" name="updateLinkType"> <label class="form-check-label" for="">Free</label>
                <input required type="radio" class="form-check-input updateLinkTypeP" value="premium" name="updateLinkType"> <label class="form-check-label" for="">Premium</label>
                <button type="submit" class="btn btn-primary w-100 mt-2">Update</button>
                <button type="button" class="btn btn-secondary w-100 mt-2 cancelUpdate">Cancel</button>
            </form>
        </div>
    </div>
</div>

<!-- Think Rout from dashboard.php  -->
<script>
    $(document).ready(function(){
 
    })
    $('.editLink').click(function() {
        const editId = $(this).attr('linkId');
        $('.addForm').hide();
        $('.updateForm').slideDown(500);
        $.ajax({
            url: "action/linkAction.php",
            type: "POST",
            data: {
                editId
            },
            dataType: "json",
            success: function(data) {
                console.log(data[0]);
                $('.updateLinkTitle').val(data[0].title);
                $('.updateLinkLink').val(data[0].link);
                $('.updateLinkImg').val(data[0].link_img);
                $('.updateLinkDetail').val(data[0].detail);
                $('.updateLinkId').val(data[0].id);
                $('.categoryOption').each(function(){
                    if ($(this).val()==data[0].category) {
                        $(this).attr('selected','true');
                    }
                })
                if (data[0].type == 'premium') {
                    $('.updateLinkTypeP').attr('checked', 'true');
                } else {
                    $('.updateLinkTypeF').attr('checked', 'true')
                }

            },
            error: function(data) {
                console.log(data);
            }
        })
    })
    $('.cancelUpdate').click(function() {
        $('.updateForm').hide();
        $('.addForm').slideDown(500);
        $('.updateForm input , .updateForm textarea').val('')
    })
</script>