<?php
function url($url){
    header("location:http://localhost/Linker/".$url."");
};
function herf($url){
   echo "http://localhost/Linker/".$url."";
}
$conn = mysqli_connect('localhost','root','','linker');
session_start();
date_default_timezone_set('Asia/Yangon');

function ip($value){
    return isset($_POST[$value]);
}

function ig($value){
    return isset($_GET[$value]);
}

function countQuery(){
    global $conn;
    $table = func_get_arg(0);
    if (func_num_args() == 1) {
        $sql = mysqli_query($conn,"SELECT * FROM $table");
        return mysqli_num_rows($sql);
    }
    if (func_num_args() == 3){
        $key = func_get_arg(1);
        $value = func_get_arg(2);
        $sql =  mysqli_query($conn,"SELECT * FROM $table WHERE $key='$value'");
        return mysqli_num_rows($sql);
    }
    if (func_num_args() == 5){
        $key = func_get_arg(1);
        $value = func_get_arg(2);
        $key2 = func_get_arg(3);
        $value2 = func_get_arg(4);
        $sql =  mysqli_query($conn,"SELECT * FROM $table WHERE $key='$value' AND $key2='$value2'");
        return mysqli_num_rows($sql);
    }
}

function selectQuery() {
    global $conn;
    $table = func_get_arg(0);
    if (func_num_args() == 1) {
        $retrun = array();
        return mysqli_query($conn,"SELECT * FROM $table");
    }
    if (func_num_args() == 3){
        $key = func_get_arg(1);
        $value = func_get_arg(2);
        $datas = mysqli_query($conn,"SELECT * FROM $table WHERE $key='$value'");
        $retrun = array();
        while ($data = mysqli_fetch_assoc($datas)) {
            array_push($retrun,$data);
        }
        return $retrun;

    }
    if (func_num_args() == 4) {
        $key = func_get_arg(1);
        $value = func_get_arg(2);
        $table2 = func_get_arg(3);
        return mysqli_query($conn,"SELECT $table.*,$table2.* FROM $table INNER JOIN $table2 ON $table.$key=$table2.$value");
    };
    //order join 2 table desc
    if (func_num_args() == 8) {
        $key = func_get_arg(1);
        $value = func_get_arg(2);
        $table2 = func_get_arg(3);
        $key2 = func_get_arg(4);
        $value2 = func_get_arg(5);
        $order = func_get_arg(6);
        $by = func_get_arg(7);
        return mysqli_query($conn,"SELECT $table.*,$table2.* FROM $table INNER JOIN $table2 ON $table.$key=$table2.$value WHERE $table.$key2=$value2 ORDER BY $table.$order $by");
    };
}

function deleteQuery(){
    global $conn;
    $table = func_get_arg(0);
    if (func_num_args()==1) {
        return mysqli_query($conn,"DELETE FROM $table");
    }
    if (func_num_args()==3) {
        $key = func_get_arg(1);
        $value = func_get_arg(2);
        return mysqli_query($conn,"DELETE FROM $table WHERE $key='$value'");
    }
}

