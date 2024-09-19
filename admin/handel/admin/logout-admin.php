<?php
session_start();


unset($_SESSION['AdminId']);
header('location:../../login.php');
exit();
?>