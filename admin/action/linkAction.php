<?php
include('../../function.php');
if (ip('addLinkLink') && ip('addLinkTitle')) {
    $link = $_POST['addLinkLink'];
    $title = $_POST['addLinkTitle'];
    $img_link = $_POST['addLinkImg'];
    $detail = $_POST['addLinkDetail'];
    $category = $_POST['addLinkCategory'];
    $type = $_POST['addLinkType'];
    mysqli_query($conn, "INSERT INTO linksinformation (title,link_img,detail,link,type,category) 
    VALUES ('$title','$img_link','$detail','$link','$type','$category')");
    url('admin/dashboard.php');
    return;
}

// Delete Link 
if (ig('delid')) {
    deleteQuery('linksinformation', 'id', $_GET['delid']);
    url('admin/dashboard.php');
    return;
}
//Edit Link
if (ip('editId')) {
    $id = $_POST['editId'];
    $retrun = json_encode(selectQuery('linksinformation', 'id', $id));
    echo $retrun;
    return;
}
if (ip('updateLinkLink') && ip('updateLinkTitle')) {
    $id = $_POST['updateLinkId'];
    $link = $_POST['updateLinkLink'];
    $title = $_POST['updateLinkTitle'];
    $img_link = $_POST['updateLinkImg'];
    $detail = $_POST['updateLinkDetail'];
    $type = $_POST['updateLinkType'];
    mysqli_query($conn, "UPDATE linksinformation SET title='$title',link_img='$img_link',detail='$detail',link='$link',type='$type' WHERE id='$id'");
    url('admin/dashboard.php');
};

//report Link
if(ip('reportLink')){
    $id=$_POST['reportLink'];
    $problem = "link dead";
    if (countQuery('report','rep_user',$_SESSION['email'],'rep_link_id',$id) < 1) {
        mysqli_query($conn,"INSERT INTO report (rep_user,rep_link_id,problem) VALUES ('".$_SESSION['email']."','$id','$problem')");
        echo "Report successfull.";
    return;
    }else{
        echo "Already Reported!";
    }

    
}
else{
    echo "outside isset";
}
