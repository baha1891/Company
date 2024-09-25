<?php
require('inc/header.php');

if (!$_SESSION['AdminId']) {
    header('location:login.php');
    exit();
}
?>
<?php

$query="SELECT count(id) as admincounts from admins";
$result=mysqli_query($conn,$query);
$adminsCount=mysqli_fetch_assoc($result);
?>
<div class="container py-5">
    <div class="row">

        <div class="col-md-4">
            <div class="card text-white bg-info mb-3">
                <div class="card-header">Admins</div>
                <div class="card-body">
                    <div class="card-text d-flex justify-content-between align-items-center">
                        <h5>
                            <?=$adminsCount['admincounts']?>
                        </h5>
                        <a href="admins.php" class="btn btn-light">Show</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-danger mb-3">
                <div class="card-header">Prouducts</div>
                <div class="card-body">
                    <div class="card-text d-flex justify-content-between align-items-center">
                        <h5>5</h5>
                        <a href="#" class="btn btn-light">Show</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Orders</div>
                <div class="card-body">
                    <div class="card-text d-flex justify-content-between align-items-center">
                        <h5>1120</h5>
                        <a href="#" class="btn btn-light">Show</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?php require('inc/footer.php');?>