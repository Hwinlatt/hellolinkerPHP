<?php
if ($_SESSION['role'] != 'admin') {
    url('index.php');
}
?>