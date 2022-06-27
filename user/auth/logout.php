<?php 
include('../../function.php');
if ($_REQUEST['logout']) {
    $sessions = ['id','email','role'];
    for ($i=0; $i < count($sessions) ; $i++) { 
        unset($_SESSION[$sessions[$i]]);
    }
    url('login.php');
}
?>