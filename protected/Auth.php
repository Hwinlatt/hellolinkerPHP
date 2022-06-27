<?php 
if (!$_SESSION['id'] && !$_SESSION['email'] && !$_SESSION['role']) {
    url('login.php');
}

?>