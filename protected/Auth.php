<?php 
if (isset($_SESSION['auth'])) {
    return;
}else {
    $_SESSION['email'] = 'gust@gmail.com';
    $_SESSION['role']  = 'user';
    $_SESSION['id'] = '11';
}
?>