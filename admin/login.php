<?php require('inc/header.php');
session_start();
 ?>


<div class="container py-5">
    <div class="row">
        <h2 class="m-auto">Append Company</h2>
        <div class="col-md-6 offset-md-3">
            <ul>
                <?php
            if (isset($_SESSION["errors"])):
                foreach ($_SESSION['errors'] as $error): ?>


                <li class="alert alert-danger">

                    <?= $error ?>
                </li>



                <?php endforeach;
            endif;
            unset($_SESSION['errors']);
            ?>
            </ul>

            <?php
                if (isset($_SESSION['error']) && !empty($_SESSION['error'])) : 
            ?>
            <div class="alert alert-danger">
                <ul>
                    <?php 
                        // إذا كانت الأخطاء عبارة عن مصفوفة، نعرض كل رسالة على حدة
                        if (is_array($_SESSION['error'])) {
                            foreach ($_SESSION['error'] as $error) {
                                echo "<li>{$error}</li>";
                            }
                        } else {
                            echo $_SESSION['error'];
                        }
                        ?>
                </ul>
            </div>
            <?php 
                endif; 
                unset($_SESSION['error']);  // إزالة الأخطاء بعد عرضها
            ?>

            <div class="card">
                <div class="card-body p-5">
                    <form method="post" action="handel/admin/login-admin.php">
                        <div class="form-group">
                            <label>Email</label>
                            <input name="email" type="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input name="password" type="password" class="form-control">
                        </div>
                        <div class="text-center mt-5">
                            <button type="submit" name="login" class=" btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
<?php require('inc/footer.php')?>