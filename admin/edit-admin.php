<?php

require('inc/header.php');




if(isset($_GET['id'])) {
    $id=(int)$_GET['id'];
    $admin="SELECT * FROM admins WHERE id=$id";
    $query=mysqli_query($conn,$admin);
    $admin=mysqli_fetch_assoc($query);
    
}
?>
<div class="container py-5">
    <div class="row">

        <div class="col-md-6 offset-md-3">
            <h3 class="mb-3">Edit Admin</h3>
            <?php
            if (isset($_SESSION["errors"])):
                foreach ($_SESSION['errors'] as $error): ?>

            <ul>
                <li class="alert alert-danger">

                    <?= $error ?>
                </li>

            </ul>

            <?php endforeach;
            endif;
            unset($_SESSION['errors']);
            ?>
            <div class="card">
                <div class="card-body p-5">


                    <form method="post" action="handel/admin/edit-admin.php" enctype="multipart/form-data">
                        <input type="hidden" class="form-control" name="id" value=<?=$admin['id']?>>
                        <div class=" form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" value=<?=$admin['name']?>>
                        </div>

                        <div class=" form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" value="<?=$admin['email']?>" ?>
                        </div>

                        <div class=" form-group">
                            <label>Status</label>
                            <select class="form-control" name="status">
                                <option value="1" <?= $admin['status'] == 1 ? 'selected' : '' ?>>active</option>
                                <option value="0" <?= $admin['status'] == 0 ? 'selected' : '' ?>>not active</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <select class="form-control" name="role">
                                <option value="0" <?= $admin['role'] == 0 ? 'selected' : '' ?>>admin</option>
                                <option value="1" <?= $admin['role'] == 1 ? 'selected' : '' ?>>super admin</option>

                            </select>
                        </div>
                        <div class=" form-group">

                            <p>
                            <h5>your img:</h5>
                            </p>
                            <img src="upload/<?=$admin['img']?>" alt="no pic" height="100px" width="100px">
                        </div>
                        <div class=" custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name="img"
                                value="<?=$admin['img']?>">
                            <label class="custom-file-label" for="customFile">Choose Image</label>
                        </div>

                        <div class="text-center mt-5">
                            <button type="submit" name="submit" class="btn btn-primary">update</button>
                            <a class="btn btn-dark" href="#">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<?php require('inc/footer.php'); ?>