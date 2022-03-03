<?php error_reporting(0); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <?php include('header.php'); ?>
</head>
<?php include('menubar_user.php'); ?>
<?php include "../Backend/conn.php"; ?>
<?php

$user_id = $_SESSION['user_id'];

?>

<body>
    <?php


    $sql = "SELECT * FROM tb_user WHERE user_id = '$user_id'";
    $query = $conn->query($sql);
    while ($row = mysqli_fetch_array($query)) {
        $user_username = $row['user_username'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_address = $row['user_address'];
        $user_phone = $row['user_phone'];
        $user_email = $row['user_email'];
    }
    ?>
    <div id="main">
        <div class="page-heading">
            <h3>ข้อมูลส่วนตัว</h3>
            <!--end navbar-right -->
        </div>

        <div class="page-content">
            <section class="row">
                <div class="col-12 col-lg-6 ">
                    <div class="card">

                        <div class="card-body">
                            <h5 class="card-title border-bottom border-2 mb-4">Profile</h5>
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label">User Name</label>
                                        <input type="text" class="form-control" disabled readonly value="<?= $user_username ?>">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Phone</label>
                                        <input type="text" class="form-control" disabled readonly value="<?= $user_phone ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label">First Name</label>
                                        <input type="text" class="form-control" disabled readonly value="<?= $user_firstname ?>">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Last Name</label>
                                        <input type="text" class="form-control" disabled readonly value="<?= $user_lastname ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">E-mail</label>
                                <input type="text" class="form-control" disabled readonly value="<?= $user_email ?>">
                            </div>


                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" disabled readonly><?= $user_address ?> </textarea>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Edit Profile</button>
                            </div>

                            <!--  modal edit -->
                            <div class="modal fade " id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Edit Profile</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form method="POST">
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">User Name</label>
                                                            <input type="text" class="form-control" name="user_username" disabled readonly value="<?= $user_username ?>">
                                                        </div>
                                                    </div>
                                                    <div class=" col-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">Phone</label>
                                                            <input type="text" class="form-control" name="user_phone" value="<?= $user_phone ?>">
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">First Name</label>
                                                            <input type="text" class="form-control" name="user_firstname" value="<?= $user_firstname ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">Last Name</label>
                                                            <input type="text" class="form-control" name="user_lastname" value="<?= $user_lastname ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">E-mail</label>
                                                    <input type="text" class="form-control" name="user_email" value="<?= $user_email ?>">
                                                </div>


                                                <div class="mb-3">
                                                    <label class="form-label">Address</label>
                                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="user_address"><?= $user_address ?></textarea>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" name="submit" class="btn btn-primary">บันทึก</button>

                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--  End modal edit -->

                        </div>
                    </div>
                </div>
            </section>

        </div>


    </div>

    <?php include('script.php'); ?>
</body>
<?php
if (isset($_POST['submit'])) {
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_address = $_POST['user_address'];
    $user_phone = $_POST['user_phone'];
    $user_email = $_POST['user_email'];
    $sql = "UPDATE tb_user SET  user_firstname = '$user_firstname' , user_lastname = '$user_lastname', user_address = '$user_address' , user_phone = '$user_phone' , user_email = '$user_email' WHERE user_username = '$user_username'";
    $query = $conn->query($sql);
    echo "<script>                                       
    window.location.href='profile.php';
 </script>";
}
?>


<!--เมนูแนะนำ-->
<style>
    /*slider Menu*/


    .clearfix:before,
    .clearfix:after {
        content: "";
        display: table;
    }

    .clearfix:after {
        clear: both;
    }

    .carousel {
        width: 1150px;
        margin: 30px auto;
    }


    .carousel .box {
        float: left;
        width: 33%;
    }

    /* prev -- next */
    .slick-prev,
    .slick-next {
        background: url(../arrows.png);

        width: 22px;
        height: 33px;
        position: absolute;
        top: 50%;
        display: block;
        padding: 0;
        cursor: pointer;

        color: transparent;
        border: none;
        outline: none;
        z-index: 100;
    }

    .slick-prev {
        background-position: 0px;
        left: 0px;
    }

    .slick-next {
        background-position: -22px;
        right: 0px;
    }



    @media only screen and (max-width: 1180px) {
        .carousel {
            width: 90%;
        }
    }

    /* MENU NEW */
    .box .card {
        margin: 15px;
        margin-left: 70px;
        margin-bottom: 70px;
        width: 250px;
        height: 350px;
        box-shadow: 0 5px 10px 1px;
        border-radius: 8px;
        overflow: hidden;
        transition: 0.2s linear;
        background-color: white;
    }

    .box .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 10px 1px;
    }

    .box .card .image {
        overflow: hidden;
        margin: auto;
        width: 200px;
        height: 290px;
        padding: 0;
        background-position: center;
        background-size: cover;
    }

    .product {
        display: flex;
        justify-content: space-between;
        align-items: center;
        height: 30px;
    }

    .product .product-name {
        padding-left: 10px;
        font-weight: bold;
    }

    .product .product-author {
        padding-right: 10px;
        font-size: 0.8rem;
        font-style: italic;
        color: grey;
        cursor: pointer;
    }

    .product .product-author:hover {
        text-decoration: underline;
    }

    .card .product-rating {
        display: flex;
        justify-content: flex-start;
        align-items: center;
        height: 20px;
    }

    .card .product-rating i:nth-child(1) {
        padding-left: 10px;
    }

    .card .product-rating i:nth-child(-n+4) {
        color: red;
    }



    .card .description p {
        display: flex;
        align-items: center;
        margin: 0;
        padding: 5px 10px 0 10px;
        font-size: 0.8rem;
        height: 50px;
    }

    .card .price {
        display: flex;
        justify-content: space-between;
        align-items: center;
        height: 50px;
    }



    .card .price div .now-price {
        margin-left: 10px;
        padding: 5px 10px;
        font-weight: bold;
        background-color: red;
        color: white;
        border-radius: 5px;
    }

    .card .price button {
        margin-bottom: 3px;
        margin-right: 10px;
        padding: 2px 10px;
        border: 1px solid green;
        border-radius: 5px;
        background-color: green;
        color: white;
        box-shadow: 0 0 2px 1px green;
        transition: 0.25s;
    }

    .card .price button:hover {
        box-shadow: 0 0 10px 1px skyblue;
    }


    @media only screen and (max-width: 900px) {
        .box {
            flex-wrap: wrap;
        }
    }

    @media only screen and (max-width: 600px) {
        .box .card {
            margin: 10px;
            width: 170px;
            height: 250px;

            border-radius: 8px;
            overflow: hidden;
            font-size: 12px;
            margin-top: 10px;
            margin-bottom: 50px;
        }

        .box .card .image {
            overflow: hidden;
            margin: auto;
            width: 170px;
            height: 200px;
            padding: 0;
            background-position: center;
            background-size: cover;
        }

        .card .price {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 50px;

        }

        .card .price div .now-price {
            margin-left: 10px;
            padding: 5px;
            font-weight: bold;
            background-color: red;
            color: white;
            border-radius: 5px;
            font-size: 12px;
        }

        .card .price button {
            margin-bottom: 3px;
            margin-right: 10px;
            padding: 5px 10px;
            border: 1px solid black;
            border-radius: 5px;
            background-color: black;
            color: white;
            box-shadow: 0 0 2px 1px black;
            transition: 0.25s;
        }


    }
</style>
<!--Search-->
<style>
    .field-container {
        position: relative;
        padding: 0;
        margin: 0;
        border: 0;
        width: 330px;
        height: 40px;
    }

    .icons-container {
        position: absolute;
        top: 5px;
        right: -2px;
        width: 35px;
        height: 35px;
        overflow: hidden;
    }

    .icon-close {
        position: absolute;
        top: 2px;
        left: 2px;
        width: 75%;
        height: 75%;
        opacity: 0;
        cursor: pointer;
        transform: translateX(-200%);
        border-radius: 50%;
        transition: opacity 0.25s ease, transform 0.43s cubic-bezier(0.694, 0.048, 0.335, 1);
    }

    .icon-close:before {
        content: "";
        border-radius: 50%;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        border: 2px solid transparent;
        border-top-color: #6078EA;
        border-left-color: #6078EA;
        border-bottom-color: #6078EA;
        transition: opacity 0.2s ease;
    }

    .icon-close .x-up {
        position: relative;
        width: 100%;
        height: 50%;
    }

    .icon-close .x-up:before {
        content: "";
        position: absolute;
        bottom: 2px;
        left: 3px;
        width: 50%;
        height: 2px;
        background-color: #6078EA;
        transform: rotate(45deg);
    }

    .icon-close .x-up:after {
        content: "";
        position: absolute;
        bottom: 2px;
        right: 0px;
        width: 50%;
        height: 2px;
        background-color: #6078EA;
        transform: rotate(-45deg);
    }

    .icon-close .x-down {
        position: relative;
        width: 100%;
        height: 50%;
    }

    .icon-close .x-down:before {
        content: "";
        position: absolute;
        top: 5px;
        left: 4px;
        width: 50%;
        height: 2px;
        background-color: #6078EA;
        transform: rotate(-45deg);
    }

    .icon-close .x-down:after {
        content: "";
        position: absolute;
        top: 5px;
        right: 1px;
        width: 50%;
        height: 2px;
        background-color: #6078EA;
        transform: rotate(45deg);
    }

    .is-type .icon-close:before {
        opacity: 1;
        -webkit-animation: spin 0.85s infinite;
        animation: spin 0.85s infinite;
    }

    .is-type .icon-close .x-up:before,
    .is-type .icon-close .x-up:after {
        -webkit-animation: color-1 0.85s infinite;
        animation: color-1 0.85s infinite;
    }

    .is-type .icon-close .x-up:after {
        -webkit-animation-delay: 0.3s;
        animation-delay: 0.3s;
    }

    .is-type .icon-close .x-down:before,
    .is-type .icon-close .x-down:after {
        -webkit-animation: color-1 0.85s infinite;
        animation: color-1 0.85s infinite;
    }

    .is-type .icon-close .x-down:before {
        -webkit-animation-delay: 0.2s;
        animation-delay: 0.2s;
    }

    .is-type .icon-close .x-down:after {
        -webkit-animation-delay: 0.1s;
        animation-delay: 0.1s;
    }

    .icon-search {
        position: relative;
        top: 5px;
        left: 8px;
        width: 50%;
        height: 50%;
        opacity: 1;
        border-radius: 50%;
        border: 3px solid #c7d0f8;
        transition: opacity 0.25s ease, transform 0.43s cubic-bezier(0.694, 0.048, 0.335, 1);
    }

    .icon-search:after {
        content: "";
        position: absolute;
        bottom: -9px;
        right: -2px;
        width: 4px;
        border-radius: 3px;
        transform: rotate(-45deg);
        height: 10px;
        background-color: #c7d0f8;
    }

    .field {
        border: 0;
        width: 100%;
        height: 100%;
        padding: 10px 20px;
        background: white;
        border-radius: 3px;
        box-shadow: 0px 8px 15px rgba(75, 72, 72, 0.1);
        transition: all 0.4s ease;
    }

    .field:focus {
        outline: none;
        box-shadow: 0px 9px 20px rgba(75, 72, 72, 0.3);
    }

    .field:focus+.icons-container .icon-close {
        opacity: 1;
        transform: translateX(0);
    }

    .field:focus+.icons-container .icon-search {
        opacity: 0;
        transform: translateX(200%);
    }
</style>



</html>