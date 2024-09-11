<?php
session_start();

require('../connection.php');
if (isset($_GET['id'])){
    $id = (int)$_GET['id'];
    $query="SELECT * FROM admins WHERE id=$id";
    $result=mysqli_query($conn,$query);
    
    if (mysqli_num_rows($result)==1) {
        $admin=mysqli_fetch_assoc($result);
        $img=$admin['img'];
        if ($img !== 'default.jpeg') {
            // حذف الصورة من المجلد
            unlink("../upload/$img");
        }
        
        $query = "DELETE FROM admins where id=$id";
        $result = mysqli_query($conn, $query);
        $_SESSION['success'] = 'admin deleted successfully';
        header('location:../../admins.php');
        exit();
    } else {
        $_SESSION['error'] = 'the delete action do not accepted';
        header('location:../../admins.php');
        exit();
    }

    
}else{
    header('location:../../admins.php');
    exit();
}