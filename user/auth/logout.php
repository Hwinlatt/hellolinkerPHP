<?php 
include('../../function.php');
if ($_REQUEST['logout']) {
    // $sessions = ['id','email','role','auth'];
    // for ($i=0; $i < count($sessions) ; $i++) { 
    //     unset($_SESSION[$sessions[$i]]);
    // }
    session_destroy();
    url('login.php');
}
?>