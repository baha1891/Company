<?php

// session_start();
// require("connection.php");

// if (isset($_POST['submit'])) {
//     $name = htmlspecialchars(trim($_POST['name']));
//     $email = htmlspecialchars(trim($_POST['email']));
//     $password = htmlspecialchars(trim($_POST['password']));
//     $status = htmlspecialchars(trim($_POST['status']));
//     $errors = [];

//     if (empty($name)) {
//         $errors[] = "Name is required";
//     } elseif (is_numeric($name)) {
//         $errors[] = 'Name must be a string';
//     } elseif (strlen($name) > 100) {
//         $errors[] = 'Name size must be less than 100 characters';
//     }

//     if (empty($email)) {
//         $errors[] = "Email is required";
//     } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//         $errors[] = 'Email is invalid';
//     }

//     if (empty($password)) {
//         $errors[] = "Password is required";
//     } elseif (!preg_match("#[0-9]+#", $password)) {
//         $errors[] = 'Password must have at least 1 number';
//     } elseif (!preg_match("#[A-Z]+#", $password)) {
//         $errors[] = 'Password must have at least 1 capital letter';
//     } elseif (!preg_match("#[a-z]+#", $password)) {
//         $errors[] = 'Password must have at least 1 lowercase letter';
//     } elseif (strlen($password) > 30 || strlen($password) < 8) {
//         $errors[] = 'Password must be between 8 and 30 characters';
//     }

//     if (!in_array($status, [0, 1])) {
//         $errors[] = 'Status must be active or not active';
//     }

//     // إذا كانت هناك أخطاء في بيانات النموذج، قم بإعادة توجيه المستخدم إلى صفحة النموذج
//     if (!empty($errors)) {
//         $_SESSION['errors'] = $errors;
//         $_SESSION['name'] = $name;
//         $_SESSION['email'] = $email;
//         header('location:../add-admin.php');
//         exit();
//     }

//     // تحقق من رفع الصورة إذا كانت البيانات صحيحة
//     if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
//         $img = $_FILES['img'];
//         $imgName = $img['name'];
//         $tmp_name = $img['tmp_name'];
//         $random = hexdec(uniqid());
//         $ext = strtolower(pathinfo($imgName, PATHINFO_EXTENSION));
//         $newName = "$random.$ext";

//         // قائمة الامتدادات المسموح بها
//         $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];

//         // التحقق من الامتداد
//         if (in_array($ext, $allowed_extensions)) {
//             // التأكد من وجود المجلد، إذا لم يكن موجودًا، يتم إنشاؤه
//             if (!file_exists('../upload')) {
//                 mkdir('../upload', 0777, true);
//             }

//             $target_path = '../upload/' . $newName;

//             // محاولة نقل الملف
//             if (!move_uploaded_file($tmp_name, $target_path)) {
//                 $errors[] = 'Failed to move the uploaded file.';
//             }
//         } else {
//             $errors[] = 'Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.';
//         }
//     } else {
//         // معالجة الأخطاء المحتملة أثناء رفع الملف
//         if ($_FILES['img']['error'] != UPLOAD_ERR_NO_FILE) {
//             switch ($_FILES['img']['error']) {
//                 case UPLOAD_ERR_INI_SIZE:
//                 case UPLOAD_ERR_FORM_SIZE:
//                     $errors[] = 'The uploaded file exceeds the allowed size.';
//                     break;
//                 case UPLOAD_ERR_PARTIAL:
//                     $errors[] = 'The file was only partially uploaded.';
//                     break;
//                 case UPLOAD_ERR_NO_TMP_DIR:
//                     $errors[] = 'Missing a temporary folder.';
//                     break;
//                 case UPLOAD_ERR_CANT_WRITE:
//                     $errors[] = 'Failed to write file to disk.';
//                     break;
//                 case UPLOAD_ERR_EXTENSION:
//                     $errors[] = 'A PHP extension stopped the file upload.';
//                     break;
//                 default:
//                     $errors[] = 'Unknown error occurred while uploading the file.';
//                     break;
//             }
//         }
//     }

//     // إذا كانت هناك أخطاء، قم بإعادة توجيه المستخدم إلى صفحة النموذج
//     if (!empty($errors)) {
        
//         $_SESSION['errors'] = $errors;
//         $_SESSION['name'] = $name;
//         $_SESSION['email'] = $email;

//         header('location:../add-admin.php');
//         exit();
//     }

//     // إذا كانت جميع العمليات ناجحة، قم بإعادة توجيه المستخدم إلى صفحة الإدارة
//     $query = "INSERT INTO admins(`name`, `email`, `status`, `password`, `img`, `created_at`) VALUES ('$name','$email',$status,'$password','$newName', NOW())";
//     $result = mysqli_query($conn, $query);
//     $_SESSION['success'] = 'admin added successfully';
//     header("location:../admins.php");
// } else {
//     header("location:../add-admin.php");
//     exit();
// }
?>


<?php
session_start();
require("../connection.php");

if (isset($_POST['submit'])) {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));
    $status = htmlspecialchars(trim($_POST['status']));
    $errors = [];

    // Define the default image name
    $defaultImage = 'default.jpeg';
    
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
        $errors[] = 'Status must be active or not active';
    }

    // Handle image upload or set default image
    $img = $_FILES['img'];
    $newName = $defaultImage; // Set default image name

    if (isset($img) && $img['error'] === UPLOAD_ERR_OK) {
        $imgName = $img['name'];
        $tmp_name = $img['tmp_name'];
        $random = hexdec(uniqid());
        $ext = strtolower(pathinfo($imgName, PATHINFO_EXTENSION));
        $newName = "$random.$ext";

        // Allowed extensions
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];

        // Check extension
        if (in_array($ext, $allowed_extensions)) {
            // Create the upload directory if it doesn't exist
            if (!file_exists('../../upload')) {
                mkdir('../../upload', 0777, true);
            }

            $target_path = '../../upload/' . $newName;

            // Try to move the uploaded file
            if (!move_uploaded_file($tmp_name, $target_path)) {
                $errors[] = 'Failed to move the uploaded file.';
                // Reset to default image in case of failure
                $newName = $defaultImage;
            }
        } else {
            $errors[] = 'Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.';
            // Reset to default image if invalid type
            $newName = $defaultImage;
        }
    } else {
        // Handle any other file upload errors except "no file uploaded"
        if ($img['error'] != UPLOAD_ERR_NO_FILE) {
            switch ($img['error']) {
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    $errors[] = 'The uploaded file exceeds the allowed size.';
                    break;
                case UPLOAD_ERR_PARTIAL:
                    $errors[] = 'The file was only partially uploaded.';
                    break;
                case UPLOAD_ERR_NO_TMP_DIR:
                    $errors[] = 'Missing a temporary folder.';
                    break;
                case UPLOAD_ERR_CANT_WRITE:
                    $errors[] = 'Failed to write file to disk.';
                    break;
                case UPLOAD_ERR_EXTENSION:
                    $errors[] = 'A PHP extension stopped the file upload.';
                    break;
                default:
                    $errors[] = 'Unknown error occurred while uploading the file.';
                    break;
            }
        }
    }

    // Check for errors and redirect if there are any
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        header('location:../../add-admin.php');
        exit();
    }

    // If all operations are successful, redirect to the admin page
    $query = "INSERT INTO admins(`name`, `email`, `status`, `password`, `img`, `created_at`) 
              VALUES ('$name','$email',$status,'$password','$newName', NOW())";
    $result = mysqli_query($conn, $query);
    $_SESSION['success'] = 'Admin added successfully';
    header("location:../../admins.php");
} else {
    header("location:../../add-admin.php");
    exit();
}
?>