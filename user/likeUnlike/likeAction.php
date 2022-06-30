<?php 
include('../../function.php');
if (ip('likeCount')) {
    $likeId = $_POST['likeId'];
    // $check = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM likes WHERE link_id='$likeid''"));
    echo countQuery('likes','link_id',$likeId);
}
if (ip('Like')) {
    $link_id = $_POST['linkId'];
    $check = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM likes WHERE link_id='$link_id' AND user_id='".$_SESSION['id']."'"));
    if ($_SESSION['email']=="gust@gmail.com" || $check == 0) {
        mysqli_query($conn,"INSERT INTO likes (link_id,user_id) VALUES ('$link_id','".$_SESSION['id']."')");
        return;
    }else{
        mysqli_query($conn,"DELETE FROM likes WHERE link_id='$link_id' AND user_id='".$_SESSION['id']."'");
        return;
    }  
}
?>