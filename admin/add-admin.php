<?php require('inc/header.php');
session_start(); ?>
<div class="container py-5">
    <div class="row">

        <div class="col-md-6 offset-md-3">
            <h3 class="mb-3">Add Admin</h3>
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


                    <form method="post" action="handel/admin/add-admin.php" enctype="multipart/form-data">

                        <div class=" form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" value="<?php

                                                                                        if (isset($_SESSION['name'])):
                                                                                            echo $_SESSION['name'];
                                                                                        endif;
                                                                                        unset($_SESSION['name']); ?>">
                        </div>

                        <div class=" form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" value="<?php
                                                                                            if (isset($_SESSION['email'])) {
                                                                                                echo $_SESSION['email'];
                                                                                            }
                                                                                            unset($_SESSION['email']);
                                                                                            ?>">
                        </div>
                        <div class=" form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>


                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="status">
                                <option value="1">active</option>
                                <option value="0">not active</option>

                            </select>
                        </div>

                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name="img">
                            <label class="custom-file-label" for="customFile">Choose Image</label>
                        </div>

                        <div class="text-center mt-5">
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                            <a class="btn btn-dark" href="#">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<?php require('inc/footer.php'); ?>