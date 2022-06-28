<!-- Link Model -->
<?php 
if ($_SESSION['role'] == "member" || $_SESSION['role'] == "admin") {
$links = selectQuery('linksinformation');
}else{
  $links = mysqli_query($conn,"SELECT * FROM linksinformation WHERE type ='free'");
}
while($link = mysqli_fetch_assoc($links)) {?>
<div class="modal fade mb-5" id="linkInfo<?php echo $link['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo $link['title'] ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p><?php echo $link['detail'] ?></p>
      </div>
      <div class="modal-footer">
        <span class="modalnotiArea"></span>
        <button type="button" id="<?php echo $link['id'] ?>" class="btn btn-warning reportLinkBtn"><i class="fa-solid fa-triangle-exclamation"></i> Report</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <a href="<?php echo $link['link'] ?> " class=""><i class="fa-solid fa-link"></i> Get Link</a>
      </div>
        <!-- -- Comments --  -->
      <div class="border-top pt-2">
        <div class="d-flex justify-content-between px-2">
          <textarea type="text" class="form-control commentInput<?php echo  $link['id']  ?>" rows="4"></textarea>
          <div class="d-flex align-items-center">
            <button userId='<?php echo $user[0]['id'] ?>' linkId="<?php echo $link['id'] ?>" class="btn btn-outline-secondary mx-2 commentSubmit"><i class="fa-solid fa-comment"></i>
          </button></div>
        </div>
        <h6 class="opacity-75 text-center mt-2">Comments (<span class="commentCount<?php echo  $link['id'] ?>"><?php echo countQuery('comment','link_id',$link['id']) ?></span>)</h6>
        <div class="commentTable">
        <table class="table">
          <tbody class="tableBodyComment<?php echo  $link['id'] ?>">
          <?php $comments = selectQuery('comment','cmt_user','id','users','link_id',$link['id'],'cmt_id',"DESC") ;
         while ($comment = mysqli_fetch_assoc($comments)) { ?>
            <tr>
                <td><img src="" alt="" width="50" height="50" class="rounded-circle"></td>
                <td><small>Name <span class="text-secondary"><?php echo $comment['userName'] ?></span></small>
                <?php if($comment['cmt_user']== $_SESSION['id']){ echo '<i linkId="'.$link['id'].'" id="'.$comment['cmt_id'].'" class="fa-solid fa-trash text-danger delCommentBtn"></i>';} ?>
                <p><?php echo $comment['cmt_text']; ?></p></td>
            </tr>
            <?php } ?>  
            </tbody>
        </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?php } ?>