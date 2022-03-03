<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มประเภทหน่วยงาน</title>
    <?php include('header.php'); ?>
</head>
<?php include('menubar_user.php'); ?>

<body>
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <div class="row">
                <div class="col-md-8 ">
                    <h3>Profile Statistics</h3>
                </div>
                <div class="col-md-4 ">
                    <div class="row">
                        <div class="col-3  ">
                            <div class="stats-icon purple">
                                <i class="bi bi-person-circle"></i>
                            </div>
                        </div>
                        <div class="col-9 ">
                            <h6 class="text-muted font-semibold">Profile Views</h6>
                            <h6 class="font-extrabold mb-0">MR James</h6>
                        </div>
                    </div>

                </div>

            </div>




            <!--end navbar-right -->

            <fieldset class="field-container">
                <input type="text" placeholder="Search..." class="field" />
                <div class="icons-container">
                    <div class="icon-search"></div>
                    <div class="icon-close">
                        <div class="x-up"></div>
                        <div class="x-down"></div>
                    </div>
                </div>
            </fieldset>

        </div>
        <div class="page-content">
            <section class="row">
                <div class="col-12 col-lg-12">

                    <div id="carouselExampleIndicators" class="carousel slide shadow p-3 mb-5 bg-body rounded" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="../bg1.jpg" class="d-block w-100" alt="../bg1.jpg">
                            </div>
                            <div class="carousel-item">
                                <img src="../bg1.jpg" class="d-block w-100" alt="../bg1.jpg">
                            </div>
                            <div class="carousel-item">
                                <img src="../bg1.jpg" class="d-block w-100" alt="../bg1.jpg">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>


                    <div class="row">
                        <div class="col-6 col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body px-3 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="stats-icon purple">
                                                <i class="iconly-boldShow"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <h6 class="text-muted font-semibold">Profile Views</h6>
                                            <h6 class="font-extrabold mb-0">112.000</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body px-3 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="stats-icon blue">
                                                <i class="iconly-boldProfile"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <h6 class="text-muted font-semibold">Followers</h6>
                                            <h6 class="font-extrabold mb-0">183.000</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body px-3 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="stats-icon green">
                                                <i class="iconly-boldAdd-User"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <h6 class="text-muted font-semibold">Following</h6>
                                            <h6 class="font-extrabold mb-0">80.000</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body px-3 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="stats-icon red">
                                                <i class="iconly-boldBookmark"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <h6 class="text-muted font-semibold">Saved Post</h6>
                                            <h6 class="font-extrabold mb-0">112</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>

            </section>
        </div>

        <footer>
            <div class="footer clearfix mb-0 text-muted">
                <div class="float-start">
                    <p>2021 &copy; Mazer</p>
                </div>
                <div class="float-end">
                    <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a href="http://ahmadsaugi.com">A. Saugi</a></p>
                </div>
            </div>
        </footer>
    </div>

    <?php include('script.php'); ?>
</body>


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