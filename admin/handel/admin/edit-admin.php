<?php

session_start();
require("../connection.php");



if (isset($_POST['submit'])) {
    $id=(int)$_POST['id'];

    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $status = htmlspecialchars(trim($_POST['status']));
    $errors = [];
    
    $query="SELECT * FROM admins WHERE id=$id";
    $result=mysqli_query($conn,$query);
    $admin=mysqli_fetch_assoc($result);




    
    if (empty($name)) {
        $errors[] = "Name is required";
    } elseif (is_numeric($name)) {
        $errors[] = 'Name must be a string';
    } elseif (strlen($name) > 100) {
        $errors[] = 'Name size must be less than 100 characters';
    }

    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email is invalid';
    }

    

    if (!in_array($status, [0, 1])) {
        $errors[] = 'Status must be active or not active';
    }

    // إذا كانت هناك أخطاء في بيانات النموذج، قم بإعادة توجيه المستخدم إلى صفحة النموذج
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        
        header('location:../../edit-admin.php');
        exit();
    }
    $img = $admin['img']; // استخدام الصورة القديمة كقيمة افتراضية

    if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
        $uploadedImg = $_FILES['img'];
        $imgName = $uploadedImg['name'];
        $tmp_name = $uploadedImg['tmp_name'];
        $random = hexdec(uniqid());
        $ext = strtolower(pathinfo($imgName, PATHINFO_EXTENSION));
        $newName = "$random.$ext";

        // قائمة الامتدادات المسموح بها
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];

        // التحقق من الامتداد
        if (in_array($ext, $allowed_extensions)) {
            // التأكد من وجود المجلد، إذا لم يكن موجودًا، يتم إنشاؤه
            if (!file_exists('../../upload')) {
                mkdir('../../upload', 0777, true);
            }

            $target_path = '../../upload/' . $newName;

            // محاولة نقل الملف
            if (move_uploaded_file($tmp_name, $target_path)) {
                // إذا تم تحميل صورة جديدة، قم بتحديث الصورة و احذف القديمة إذا لم تكن الصورة الافتراضية
                if ($admin['img'] !== 'default.jpeg') {
                    unlink('../../upload/' . $admin['img']);
                }
                $img = $newName; // تحديث الصورة الجديدة
            } else {
                $errors[] = 'Failed to move the uploaded file.';
            }
        } else {
            $errors[] = 'Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.';
        }
    }


    // تحديث البيانات في قاعدة البيانات
    if (empty($errors)) {
        $query = "UPDATE admins SET name='$name', email='$email', status='$status', img='$img' WHERE id=$id";
        if (mysqli_query($conn, $query)) {
            $_SESSION['success'] = 'Admin updated successfully';
            header("location:../../admins.php");
            exit();
        } else {
            $errors[] = 'Failed to update admin.';
        }
    }

    $_SESSION['errors'] = $errors;
    header("location:../../update-admin.php?id=$id");
    exit();
}
?>