<?php include('header.php'); ?>
<?php

if ($_SESSION["user_status"] != 'admin'){  //check session

Header("Location: ../error-404.php"); //ไม่พบผู้ใช้กระโดดกลับไปหน้า login form 

}else{?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<?php include('menubar.php'); ?>
<?php include "conn.php"; ?>

<?php
$date = date("Y-m-d");
$month = date("m");
$year = date("Y");
$sumdate = "SELECT sum(total_price * order_amount) FROM tb_orderdetail WHERE date(order_date) = '$date' AND payment_status = 'ได้รับสินค้าเรียบร้อย'";
$querysumdate = $conn->query($sumdate);
$querysumdate2 = mysqli_fetch_array($querysumdate);

$summonth = "SELECT sum(total_price * order_amount) FROM tb_orderdetail WHERE month(order_date) = '$month' AND payment_status = 'ได้รับสินค้าเรียบร้อย'";
$querysummonth = $conn->query($summonth);
$querysummonth2 = mysqli_fetch_array($querysummonth);


$sumyear = "SELECT sum(total_price * order_amount) FROM tb_orderdetail WHERE year(order_date) = '$year' AND payment_status = 'ได้รับสินค้าเรียบร้อย'";
$querysumyear = $conn->query($sumyear);
$querysumyear2 = mysqli_fetch_array($querysumyear);

$sumall = "SELECT sum(total_price * order_amount) FROM tb_orderdetail WHERE payment_status = 'ได้รับสินค้าเรียบร้อย'";
$quersumall = $conn->query($sumall);
$quersumall2 = mysqli_fetch_array($quersumall);

?>

<body>

    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <h3>หน้าหลักเเอดมิน</h3>
        </div>
        <div class="page-content">
            <section class="row">
                <div class="col-12 col-lg-12">
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
                                            <h6 class="text-muted font-semibold">รายได้ทั้งหมด</h6>
                                            <h6 class="font-extrabold mb-0"><?php echo $quersumall2[0] ?>บาท</h6>
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
                                            <h6 class="text-muted font-semibold">รายได้ปีนี้</h6>
                                            <h6 class="font-extrabold mb-0"><?php echo $querysumyear2[0] ?>บาท</h6>
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
                                            <h6 class="text-muted font-semibold">รายได้เดือนนี้</h6>
                                            <h6 class="font-extrabold mb-0"><?php echo $querysummonth2[0] ?>บาท</h6>
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
                                            <h6 class="text-muted font-semibold">รายได้วันนี้</h6>
                                            <h6 class="font-extrabold mb-0"><?php echo $querysumdate2[0] ?>บาท</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-3">
                        <div>
                            <a class="btn btn-outline-primary" href="index.php?p=d">รายวัน</a>
                            <a class=" btn btn-outline-primary" href="index.php?p=m">รายเดือน</a>
                            <a class="btn btn-outline-primary" href="index.php?p=y">รายปี</a>
                            <a class="btn btn-outline-primary" href="index.php?p=t">ตามหมวดหมู่ที่ขายออก</a>
                        </div>
                    </div>

                    <?php $p = (isset($_GET['p']) ? $_GET['p'] : '');
                    if ($p == 'd') {
                        include('admin_r_date.php');
                    } elseif ($p == 'm') {
                        include('admin_r_month.php');
                    } elseif ($p == 'y') {
                        include('admin_r_year.php');
                    } elseif ($p == 't') {
                        include('admin_r_type.php');
                    } else {
                        include('admin_r_date.php');
                    }
                    ?>
                </div>

            </section>

        </div>

        <?php include('script.php'); ?>
</body>

</html>
<?php } ?>