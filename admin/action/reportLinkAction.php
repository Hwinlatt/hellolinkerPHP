<?php 
include('../../function.php');
if(ip('solvedLinkId')){
    $linkId = $_POST['solvedLinkId'];
    $datetime = date('Y-m-d h:i:sa');
    mysqli_query($conn,"UPDATE report SET resolved_by='".$_SESSION['email']."',resolved_date='".$datetime."' WHERE rep_link_id='$linkId'");
    echo 0;
    return;
}
if (ig('undoSolved')) {
   $id = $_GET['undoSolved'];
    mysqli_query($conn,"UPDATE report SET resolved_by='none' WHERE rep_id = $id");
    url('admin/section/reportLinks.php');
}
?>