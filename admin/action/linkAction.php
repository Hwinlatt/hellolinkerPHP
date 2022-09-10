<?php
include('../../function.php');

//Add Link
if (ip('addLinkLink') && ip('addLinkTitle')) {
    $link = $_POST['addLinkLink'];
    $title = $_POST['addLinkTitle'];
    $img_link = $_POST['addLinkImg'];
    $detail = $_POST['addLinkDetail'];
    $category = $_POST['addLinkCategory'];
    $type = $_POST['addLinkType'];
    $trailer = $_POST['addLinkTrailer'];
    mysqli_query($conn, "INSERT INTO linksinformation (title,link_img,detail,link,type,category,link_trailer) 
    VALUES ('$title','$img_link','$detail','$link','$type','$category','$trailer')");
    url('admin/section/linksAdmin.php');
    return;
}

// Delete Link 
if (ig('delid')) {
    deleteQuery('linksinformation', 'id', $_GET['delid']);
    url('admin/section/linksAdmin.php');
    return;
}
//Edit Link
if (ip('editId')) {
    $id = $_POST['editId'];
    $retrun = json_encode(selectQuery('linksinformation', 'id', $id));
    echo $retrun;
    return;
}

//Update Link
if (ip('updateLinkLink') && ip('updateLinkTitle')) {
    $id = $_POST['updateLinkId'];
    $link = $_POST['updateLinkLink'];
    $title = $_POST['updateLinkTitle'];
    $img_link = $_POST['updateLinkImg'];
    $detail = $_POST['updateLinkDetail'];
    $type = $_POST['updateLinkType'];
    $trailer = $_POST['updateLinkTrailer'];
    mysqli_query($conn, "UPDATE linksinformation SET title='$title',link_img='$img_link',detail='$detail',link='$link',type='$type',link_trailer='$trailer' WHERE id='$id'");
    url('admin/section/linksAdmin.php');
};

//Search Link
if(ip('searchKey')){
    $key = $_POST['searchKey'];
    $links = selectQuery('linksinformation', 'category', "category_id WHERE linksinformation.detail LIKE '%$key%' ORDER BY linksinformation.id DESC", 'categorys');
    $retrun = '';
    if (mysqli_num_rows($links) == 0) {
        echo '<h3 class="text-center">There is nothint to show links<span class="text-danger">% '.$key.' %</span></h3><img src="../../img/thinkemoji.png" class="w-50" alt="...">';
        return;
    }
    while($link = mysqli_fetch_array($links)){
        $retrun.='
        <tr>
        <td>'.$link['id'].'</td>
        <td>'.$link['title'];'';
        if ($link['type'] == 'premium') {
            $retrun.=' <i class="fa-solid fa-crown text-warning"></i></td>';
        }
        $retrun.='<td>'.$link['view'].'</td>
        <td>'.$link['name'].'</td>
        <td>
            <button class="btn btn-outline-secondary editLink" linkId="'.$link['id'].'">Edit</button>
            <a href="action/linkAction.php?delid='.$link['id'].'" onclick="return confirm(`Are you sure to delete this folder`)" class="btn btn-outline-danger">Delete</a>
        </td>
    </tr>';
    };
    echo $retrun;
     return;
}

//report Link
if(ip('reportLink')){
    $id=$_POST['reportLink'];
    $problem = "link dead";
    if (countQuery('report','resolved_by','none','rep_link_id',$id) < 1) {
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
