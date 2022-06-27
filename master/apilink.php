<?php 
include('../function.php');
$sql = selectQuery('linksinformation','category','category_id','categorys');
$response = array();
header("Content-Type:JSON");
$i = 0;
while($link = mysqli_fetch_assoc($sql)){
    $response[$i]['id'] = $link['id'];
    $response[$i]['title'] = $link['title'];
    $response[$i]['detail'] = $link['detail'];
    $response[$i]['view'] = $link['view'];
    $response[$i]['type'] = $link['type'];
    $response[$i]['link_img']=$link['link_img'];
    $response[$i]['category_id']=$link['category_id'];
    $response[$i]['name']=$link['name'];

    $i++;
}
echo json_encode($response);
?>