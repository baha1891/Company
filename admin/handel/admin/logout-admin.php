<?php
session_start();


unset($_SESSION['AdminId']);
unset($_SESSION['name']);
unset($_SESSION['lang']);
unset($_SESSION['role']);
header('location:../../login.php');
exit();
?>