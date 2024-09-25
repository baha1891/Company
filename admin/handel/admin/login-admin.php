<?php
session_start();
require("../connection.php");




if (isset($_POST['login'])){

    $email=htmlspecialchars(trim($_POST['email'])) ;
    $password=htmlspecialchars(trim($_POST['password']));
    $errors=[];

    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email is invalid';
    }

    if (empty($password)) {
        $errors[] = "Password is required";
    } elseif (!preg_match("#[0-9]+#", $password)) {
        $errors[] = 'Password must have at least 1 number';
    } elseif (!preg_match("#[A-Z]+#", $password)) {
        $errors[] = 'Password must have at least 1 capital letter';
    } elseif (!preg_match("#[a-z]+#", $password)) {
        $errors[] = 'Password must have at least 1 lowercase letter';
    } elseif (strlen($password) > 30 || strlen($password) < 8) {
        $errors[] = 'Password must be between 8 and 30 characters';
    }


    if (empty($errors)) {
        // إصلاح الاستعلام بإضافة علامات الاقتباس الفردية للبريد الإلكتروني
        $sql = "SELECT * FROM admins WHERE email='$email'";
        $query = mysqli_query($conn, $sql);

        // التحقق مما إذا كانت هناك نتائج
        if (mysqli_num_rows($query) > 0 ) {
            $admin = mysqli_fetch_assoc($query);
            $adminpass=password_verify($password,$admin['password']);
            if ($adminpass) {
                $_SESSION['AdminId']=$admin['id'];
                $_SESSION['name'] = $admin['name'];
                $_SESSION['role']= $admin['role'];
                $_SESSION['status']= $admin['status'];
                header('location:../../admins.php?page=1');
                exit();
            } else {
                $errors[] = 'Invalid password';
                $_SESSION['errors'] = $errors;
                header('location:../../login.php');
                exit();
            }

        } else {
            $errors[] = 'Invalid email ';
            $_SESSION['errors'] = $errors;
            header('location:../../login.php');
            exit();
        }
    } else {
        $_SESSION['errors'] = $errors;
        header('location:../../login.php');
        exit();
    }
}else {
    header("location:../../login.php");
    exit();
}
?>