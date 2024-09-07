<?php

session_start();

if(isset($_POST['submit'])){
     $name = htmlspecialchars(trim($_POST['name']));
     $email = htmlspecialchars(trim($_POST['email']));
     $password = htmlspecialchars(trim($_POST['password']));
     $status = htmlspecialchars(trim($_POST['status']));
    $errors=[];
    
    if(empty($name)){
        $errors[] = "Name is required";
    }elseif(is_numeric($name)){
        $errors[]='name must be string';    
    }elseif(strlen($name)>100){
        $errors[]='name size must be lower than 100 character';
    }

    if(empty($email)){
        $errors[] = "Email is required";
    }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        
        $errors[]='email is invalid';
    }

    if(empty($password)){
        $errors[] = "Password is required";
    }elseif(!preg_match("#[0-9]+#",$password))
    {
        $errors[]='password must be at least have 1 number';
    }elseif(!preg_match("#[A-Z]+#",$password))
    {
        $errors[]='password must be at least have 1 capitel letter';
    }elseif(!preg_match("#[a-z]+#",$password))
    {
        $errors[]='password must be at least have 1 lowercase letter';
    }
    elseif(strlen($password)>30||strlen($password)<8){
        $errors[]='password must be less than 30';
    }

    if (!in_array($status, [0, 1])){
        $errors[]='status must be active or not active'; 
        
    }


    if($_FILES==true){
        $img=$_FILES['img'];
        $name=$img['name'];
        $tmp_name=$img['tmp_name'];
        $random=hexdec(uniqid());
        $ext=pathinfo($name,PATHINFO_EXTENSION);
        $newName="$random.$ext";
        move_uploaded_file($tmp_name,"upload/$newName");
        
    }else{}
    
    if(empty($errors)){
        // header("location:../admins.php");
    }else{
        $_SESSION['errors']=$errors;
        header('location:../add-admin.php');
    }
}
else{
    header("location:../admins.php");
    exit(); 
}
?>