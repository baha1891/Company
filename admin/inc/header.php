<?php 
session_start();
require('handel/connection.php');



$lang='en';

if (isset($_SESSION['lang'])) {
    $lang=$_SESSION['lang'];
}

if ($lang=='en') {
    require_once("handel/lang/en-lang.php");
}else{
    require_once("handel/lang/ar-lang.php");
}

?>

<!DOCTYPE html>
<html lang="<?= $lang ?>" dir=<?=$message['dir']?>>


<head>
    <meta charset=" UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Append | Dashboard</title>

    <?php 
    if($lang=='en'):?>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <?php else:?>
    <link rel="stylesheet" href="assets/css/rtl_bootstrap.min.css">

    <?php endif?>
    <link rel=" stylesheet" href="assets/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php"><?=$message['dash']?></a>
        <button class=" navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="admins.php?page=1"><?=$message['Admins']?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="prouducts.php"><?=$message['Prouducts']?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><?=$message['Orders']?></a>
                </li>

            </ul>
            <ul class="navbar-nav ml-auto mr-5">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?=$message['Lang']?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class=" dropdown-item" href="handel/admin/change-lang.php?lang=en">en</a>
                        <a class=" dropdown-item" href="handel/admin/change-lang.php?lang=ar">ar</a>
                    </div>
                </li>

                <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?= isset($_SESSION['name']) ? $_SESSION['name'] : "AdminName"; ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                        <a class=" dropdown-item" href="#"><?=$message['Profile']?></a>
                        <a class="dropdown-item" href="handel/admin/logout-admin.php"><?=$message['Logout']?></a>
                    </div>
                </li>

            </ul>
        </div>
    </nav>