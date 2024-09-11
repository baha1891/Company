<?php require('inc/header.php');
session_start();
 ?>


<?php

require('handel/connection.php');
$query = "SELECT * FROM admins";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    $admins = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $msg = "no data found";
}

?>
<div class="container-fluid py-5">
    <div class="row">

        <div class="col-md-10 offset-md-1">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>All Admins</h3>


                <a href="add-admin.php" class="btn btn-success">add admin</a>


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
                    </tr>
                </thead>
                <tbody>

                    <?php
                    if (!empty($admins)):
                        foreach ($admins as $index => $admin): ?>
                    <tr>
                        <th scope="row"><?= $index + 1 ?></th>
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
                            <a class="btn btn-sm btn-info" href="edit-admin.php?id=<?=$admin['id']?>">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a class="btn btn-sm btn-danger" href="handel/admin/delete-admin.php?id=<?=$admin['id']?>">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
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
</div>
<?php require('inc/footer.php'); ?>