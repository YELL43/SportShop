<?php session_start() ?>
<?php include "../Backend/conn.php"; ?>

<?php if (isset($_SESSION["user_id"]) != "") {
    $user_id = $_SESSION['user_id'];
    $user_fullname = $_SESSION["user_fullname"];
    $user_status = $_SESSION["user_status"];


    $sql = "SELECT count(*) as total from tb_order where user_id=$user_id";
    $query = $conn->query($sql);
    while ($row = mysqli_fetch_array($query)) {
        $count = $row['total'];
    }
} else {
    $user_id = "";
    $count = 0;
}


?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasim Sport</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">

    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>
<header>
    <nav class="navbar navbar-expand navbar-light ">
        <div class="container-fluid">
            <a href="#" class="burger-btn d-block">
                <i class="bi bi-justify fs-3"></i>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <?php if ($user_id != "") { ?>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown me-1">
                            <a class="nav-link active" href="mycart.php">
                                <i class='bi bi-cart bi-sub fs-4 text-gray-600  position-relative'>
                                    <h6> <span class="position-absolute top-0 start-100 translate-middle  badge rounded-pill   bg-danger  text-light">
                                            <?php echo $count ?>
                                        </span> </h6>

                                </i>
                            </a>

                        </li>
                        <li class="nav-item dropdown me-3">
                            <a class="nav-link active dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class='bi bi-bell bi-sub fs-4 text-gray-600'></i>
                            </a>

                        </li>
                    </ul>

                    <div class="dropdown">
                        <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="user-menu d-flex">
                                <div class="user-name text-end me-3">
                                    <h6 class="mb-0 text-gray-600"><?php echo $user_fullname ?></h6>
                                    <p class="mb-0 text-sm text-gray-600"><span style="font-size:10px;" class="badge bg-success"><?php echo $user_status ?></span></p>
                                </div>
                                <div class="user-img d-flex align-items-center">
                                    <div class="avatar avatar-md">
                                        <img src="assets/images/faces/1.jpg">
                                    </div>
                                </div>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">

                            <li><a class="dropdown-item" href="profile.php"><i class="icon-mid bi bi-person me-2"></i>จัดการข้อมูลส่วนตัว</a></li>

                            <li><a class="dropdown-item" data-bs-toggle="modal"  data-bs-target="#exampleModal"><i class="icon-mid bi bi-box-arrow-left me-2"></i>ออกจากระบบ</a></li>
                        </ul>
                    </div>
                </div>
             
                <!--  modal logout -->


                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                คุณต้องการออกจากระบบใช่หรือไม่ ?
                            </div>
                            <div class="modal-footer">
                                <a href="logout.php" type="button" class="btn btn-primary">ตกลง</a>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- end modal logout -->

            <?php } else { ?>

                <ul class="nav justify-content-end">
                    <!-- <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form> -->
                    <li class="nav-item">
                        <a class="nav-link" href="#">เกี่ยวกับเรา</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../register.php">สมัครสมาชิก</a>
                    </li>
                    <li class="nav-item">
                        <a href="../login.php" class="btn btn-primary">เข้าสู่ระบบ</a>
                    </li>
                </ul>












            <?php } ?>

        </div>
    </nav>
</header>