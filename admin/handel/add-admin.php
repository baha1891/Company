<?php

session_start();

if (isset($_POST['submit'])) {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));
    $status = htmlspecialchars(trim($_POST['status']));
    $errors = [];

    if (empty($name)) {
        $errors[] = "Name is required";
    } elseif (is_numeric($name)) {
        $errors[] = 'name must be string';
    } elseif (strlen($name) > 100) {
        $errors[] = 'name size must be lower than 100 character';
    }

    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $errors[] = 'email is invalid';
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
    

    if (!in_array($status, [0, 1])) {
        $errors[] = 'status must be active or not active';
    }


    if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
        $img = $_FILES['img'];
        $name = $img['name'];
        $tmp_name = $img['tmp_name'];
        $random = hexdec(uniqid());
        $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
        $newName = "$random.$ext";

        // قائمة الامتدادات المسموح بها
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];

        // التحقق من الامتداد
        if (in_array($ext, $allowed_extensions)) {
            // التأكد من وجود المجلد، إذا لم يكن موجودًا، يتم إنشاؤه
            if (!file_exists('../upload')) {
                mkdir('../upload', 0777, true);
            }

            $target_path = '../upload/' . $newName;

            // محاولة نقل الملف
            if (move_uploaded_file($tmp_name, $target_path)) {
                echo "File uploaded successfully to $target_path";
            } else {
                echo 'Failed to move the uploaded file.';
            }
        } else {
            echo 'Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.';
        }
    } else {
        // معالجة الأخطاء المحتملة أثناء رفع الملف
        switch ($_FILES['img']['error']) {
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                echo 'The uploaded file exceeds the allowed size.';
                break;
            case UPLOAD_ERR_PARTIAL:
                echo 'The file was only partially uploaded.';
                break;
            case UPLOAD_ERR_NO_FILE:
                echo 'No file was uploaded.';
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                echo 'Missing a temporary folder.';
                break;
            case UPLOAD_ERR_CANT_WRITE:
                echo 'Failed to write file to disk.';
                break;
            case UPLOAD_ERR_EXTENSION:
                echo 'A PHP extension stopped the file upload.';
                break;
            default:
                echo 'Unknown error occurred while uploading the file.';
                break;
        }
    }


    if (empty($errors)) {
        // header("location:../admins.php");
    } else {
        $_SESSION['errors'] = $errors;
        header('location:../add-admin.php');
    }
} else {
    header("location:../admins.php");
    exit();
}