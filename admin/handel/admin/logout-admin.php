<?php
session_start();


unset($_SESSION['AdminId']);
unset($_SESSION['name']);
header('location:../../login.php');
exit();
?>