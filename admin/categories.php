<?php 

require('inc/header.php');?>

<div class="container-fluid py-5">
    <div class="row">

        <div class="col-md-10 offset-md-1">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>All Products</h3>
                <a href="#" class="btn btn-success">
                    Add new
                </a>
            </div>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Img</th>
                        <th scope="col">Update</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Lenove ideapad</td>

                        <td>
                            <img src="https://via.placeholder.com/40" alt="">
                        </td>

                        <td>

                            <a class="btn btn-sm btn-info" href="#">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a class="btn btn-sm btn-danger" href="#">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</div>










<?php require('inc/footer.php'); ?>