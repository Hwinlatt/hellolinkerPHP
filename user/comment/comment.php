<?php 
include('../../function.php');
include('../../protected/Auth.php');
if (ip('commentCount')) {
    $link_id = $_POST['likeId'];
    echo countQuery('comment','link_id',$link_id);
}
if (ip('commentText') && ip('linkId')) {
    $text = $_POST['commentText'];
    $link_id = $_POST['linkId'];
    $user_id = $_POST['userId'];
    mysqli_query($conn,"INSERT INTO comment (link_id,cmt_user,cmt_text) VALUES ('$link_id','$user_id','$text')");
    echo "commented";
    return;
}
if (ip('delId')) {
    $id = $_POST['delId'];
    deleteQuery('comment','cmt_id',$id);
    if (countQuery('comment','cmt_id',$id) < 1) {
       echo "Successfully delete Comment";
       return;
    }else {
        "Unsuccessful delete comment";
        return;
    }
}
if (ip('selId')) {
    $startPoint = $_POST['startPoint'];
    $start = 0;
    $limit = 6;
    if ($startPoint > 1) {
        $start = $startPoint*$limit;
    }
    $id = $_POST['selId'];
    $return = '';

    $comments = selectQuery('comment','cmt_user','id','users','link_id',$id,'cmt_id',"DESC LIMIT $start,$limit") ;
    while ($comment = mysqli_fetch_assoc($comments)) {
        $return.='
        <tr>
                <td><img src="" alt="" width="50" height="50" class="rounded-circle"></td>
                <td><small>Name <span class="text-secondary">'. $comment['userName'].'</span></small>';
                if($comment['cmt_user']== $_SESSION['id']){
                    $return.='<i linkId="'.$id.'" id="'.$comment['cmt_id'].'" class="fa-solid fa-trash text-danger delCommentBtn"></i>';
                }
                $return.='<p>'. $comment['cmt_text'].'</p></td>
                </tr>';
    }
    echo $return;
    return;
}

?>