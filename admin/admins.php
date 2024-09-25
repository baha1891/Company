<?php 

require('inc/header.php');



if (!$_SESSION['AdminId']) {
    header('location:login.php');
    exit();
}


if(isset($_GET['page'])){
    $page = $_GET['page'];

    // التحقق من أن القيمة موجبة
    if (!is_numeric($page) || $page < 1) {
        
        header("location:admins.php?page=1");
    exit();
    }
} else { 
    header("location:admins.php?page=1");
    exit(); // إذا لم يتم إرسال المتغير، ابدأ من الصفحة 1
}

$sql = "SELECT count('id') as total FROM admins";
$query = mysqli_query($conn, $sql);
$totalcount = mysqli_fetch_assoc($query);
$totalcount = $totalcount['total'];  // تصحيح طريقة الوصول إلى العدد
$limit = 3;
$offset = ($page - 1) * $limit;
$pagesnum = ceil($totalcount / $limit);  // استخدام ceil لضمان عدد صفحات صحيح

if ($page > $pagesnum) {
    header("location:admins.php?page=$pagesnum");
    exit();  // إذا كانت أكبر من عدد الصفحات، اضبطها على آخر صفحة
}

$sql = "SELECT * FROM admins limit $limit offset $offset";
$query = mysqli_query($conn, $sql);  // تصحيح المتغير هنا
if (mysqli_num_rows($query) > 0) {
    $admins = mysqli_fetch_all($query, MYSQLI_ASSOC);
} else {
    $msg = "no data found";
}



?>

<div class="container-fluid py-5">
    <div class="row">

        <div class="col-md-10 offset-md-1">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>All Admins</h3>

                <?php if($_SESSION['role']==1 && $_SESSION['status']==1 ):?>
                <a href="add-admin.php" class="btn btn-success"><?=$message['Add Admin']?></a>

                <?php endif;?>
            </div>

            <table class="table table-hover">
                <?php
                if (isset($_SESSION['success']) && !empty($_SESSION['success'])) :?>
                <div class="alert alert-success">

                    <?= $_SESSION['success'];?>
                </div>

                <?php
                endif;
                unset($_SESSION['success']);  ?>
                <?php
                if (isset($_SESSION['error']) && !empty($_SESSION['error'])) :?>
                <div class="alert alert-success">

                    <?= $_SESSION['error'];?>

                </div>

                <?php
                endif;
                unset($_SESSION['error']);  ?>


                <thead>
                    <tr>
                        <th scope=" col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Img</th>
                        <th scope="col">Actions</th>
                        <th scope="col">Role</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    if (!empty($admins)):
                        foreach ($admins as $index => $admin): ?>
                    <tr>
                        <th scope="row"><?= $offset + $index + 1 ?></th>
                        <td>
                            <?= $admin['name'] ?>
                        </td>
                        <td>
                            <?= $admin['email'] ?>
                        </td>
                        <td>
                            <img src="upload/<?= $admin['img'] ?>" alt="" width="50" height="50">
                        </td>

                        <td>
                            <?php
                                    echo $admin['status'] ? '<span class="badge badge-success"><i class="fas fa-check-circle"></i></span>' : '<span class="badge badge-danger"><i class="fas fa-times-circle"></i></span>'
                                    ?>
                        </td>
                        <td>
                            <?php
                                    echo $admin['role'] ? '<span class="badge badge-success">super admin</span>' : '<span class="badge badge-success">admin</span>'
                                    ?>
                        </td>
                        <?php if($_SESSION['role']==1 && $_SESSION['status']==1):?>
                        <td>
                            <a class="btn btn-sm btn-info" href="edit-admin.php?id=<?=$admin['id']?>">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a class="btn btn-sm btn-danger" href="handel/admin/delete-admin.php?id=<?=$admin['id']?>">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                        <?php endif;?>
                    </tr>

                    <?php
                        endforeach;
                    else:
                        echo $msg;

                    endif;
                    mysqli_close($conn);
                    ?>
                </tbody>
            </table>
        </div>


    </div>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                <a class="page-link" href="admins.php?page=<?= $page-1 ?>">Previous</a>
            </li>

            <!-- Display page numbers -->
            <?php
        for ($i = 1; $i <= $pagesnum; $i++) { ?>
            <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                <a class="page-link" href="admins.php?page=<?= $i ?>"><?= $i ?></a>
            </li>
            <?php } ?>

            <!-- Disable Next link if on the last page -->
            <li class="page-item <?= $page == $pagesnum ? 'disabled' : '' ?>">
                <a class="page-link" href="admins.php?page=<?= $page+1 ?>">Next</a>
            </li>
        </ul>
    </nav>
</div>
<?php require('inc/footer.php'); ?>