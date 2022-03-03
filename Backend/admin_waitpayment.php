<?php include('header.php'); ?>
<?php

if ($_SESSION["user_status"] != 'admin') {  //check session

    Header("Location: ../error-404.php"); //ไม่พบผู้ใช้กระโดดกลับไปหน้า login form 

} else { ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin</title>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <?php include "conn.php"; ?>
    </head>
    <?php include('menubar.php'); ?>


    <body>


        <?php
        if (@$_GET['do'] == 'success') {
            echo '<script type="text/javascript">
					Swal.fire(
						"",
						"ตรวจสอบเรียบร้อย",
						"success"
					  )
                </script>';
            echo '<meta http-equiv="refresh" content="2;url=admin_waitpayment.php" />';
        } elseif (@$_GET['do'] == 'error') {
            echo '<script type="text/javascript">
					Swal.fire(
						"",
						"บันทึกข้อมูลไม่สำเร็จ",
						"error"
					  )
                </script>';
            echo '<meta http-equiv="refresh" content="2;url=show_product.php" />';
        }

        ?>

        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <h3>จัดการข้อมูลการสั่งซื้อ</h3>
            </div>
            <div class="card-body px-3">
                <div>
                    <a class="btn btn-outline-primary" href="admin_waitpayment.php">รอตรวจสอบ</a>
                    <a class="btn btn-outline-primary" href="admin_checkedpayment.php">ตรวจสอบเเล้ว</a>
                    <a class="btn btn-outline-primary" href="order_success.php">ทำรายการสำเร็จ</a>

                </div>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="col-12 col-lg-12">
                        <div class="row">
                            <div class="col-md-12 col-12">
                                <?php
                                $order = "SELECT DISTINCT tb_orderdetail.orderde_id,
                            tb_orderdetail.order_no,
                            sum(tb_orderdetail.total_price * tb_orderdetail.order_amount) as total_price,
                            tb_orderdetail.order_date,
                            tb_orderdetail.payment_status,
                            tb_orderdetail.order_img,
                            tb_user.user_username,
                            sum(tb_orderdetail.order_amount) as order_amount
                            FROM `tb_orderdetail`INNER JOIN tb_user ON tb_orderdetail.user_id=tb_user.user_id WHERE payment_status = 'รอตรวจสอบ' GROUP BY order_no  ORDER BY `tb_orderdetail`.`orderde_id` desc;";
                                $queryorder = $conn->query($order);
                                while ($row = mysqli_fetch_array($queryorder)) {
                                    $orderde_id = $row['orderde_id'];
                                    $order_no = $row['order_no'];
                                    $total_price = $row['total_price'];
                                    $order_date = $row['order_date'];
                                    $payment_status = $row['payment_status'];
                                    $order_img = $row['order_img'];
                                    $user_id = $row['user_username'];
                                    $order_amount = $row['order_amount'];
                                ?>

                                    <div class="card">
                                        <div class="card-header  ">
                                            <div class="row">
                                                <div class="col-6">
                                                    <h4 class="card-title">การสั่งซื้อ </h4>
                                                </div>
                                                <div class="col-6 text-end">
                                                    <label class="text-dark">สถานะ</label>
                                                    <span class="badge bg-secondary"><?php echo  $payment_status ?></span>

                                                </div>
                                            </div>
                                        </div>
                                        <span class="border-bottom border-info m-2"></span>

                                        <div class="card-content">
                                            <div class="card-body">
                                                <form class="form form-horizontal">
                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="col-md-3 ">
                                                                <label class="text-dark">รหัสการสั่งซื้อ</label>
                                                            </div>
                                                            <div class="col-md-3 ">
                                                                <label><?php echo  $orderde_id ?></label>
                                                            </div>
                                                            <div class="col-md-3 ">
                                                                <label class="text-dark">ชื่อผู้ใช้</label>
                                                            </div>
                                                            <div class="col-md-3 ">
                                                                <label><?php echo  $user_id ?></label>
                                                            </div>


                                                            <div class="col-md-3">
                                                                <label class="text-dark">เลขใบสั่งซื้อ</label>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label><?php echo  $order_no ?></label>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <label class="text-dark">จำนวนสินค้า</label>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label> <?php echo  $order_amount ?></label>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="text-dark">วันที่สั่งซื้อ</label>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label><?php echo  $order_date ?></label>
                                                            </div>

                                                            <div class="col-md-3 ">
                                                                <label class="text-danger">ราคารวม</label>
                                                            </div>
                                                            <div class="col-md-3 ">
                                                                <label><?php echo  $total_price ?> บาท</label>
                                                            </div>

                                                            <div class="col-sm-12 d-flex justify-content-end">

                                                                <button type="button" class="btn btn-success me-1 mb-1" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $order_no ?>">ตรวจสอบ</button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </form>

                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal<?php echo $order_no ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <?php
                                                        $payment = "SELECT * FROM tb_payment where order_no = '$order_no'";
                                                        $query = $conn->query($payment);
                                                        while ($row = mysqli_fetch_array($query)) {
                                                            $payment_id = $row['payment_id'];
                                                            $user_id = $row['user_id'];
                                                            $order_no = $row['order_no'];
                                                            $payament_datetime =  $row['payament_datetime'];
                                                            $total_payment = $row['total_payment'];
                                                            $payment_img = $row['payment_img'];
                                                        ?>
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">ตรวจสอบการสั่งซื้อ</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <form action="admin_waitpayment.php" method="POST">
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-6 border-end">
                                                                                <div class="row">
                                                                                    <div class="col-6">
                                                                                        <span>payment ID</span>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <p><?php echo $payment_id ?></p>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-6">
                                                                                        <span>User ID</span>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <p><?php echo $user_id ?></p>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-6">
                                                                                        <span>Order ID</span>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <p><?php echo $order_no  ?></p>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-6">
                                                                                        <span>Date</span>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <p><?php echo  $payament_datetime ?></p>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-6">
                                                                                        <span>Total</span>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <p><?php echo  $total_payment ?> บาท</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-6">
                                                                                <div class="row">
                                                                                    <div class="col-12">
                                                                                        <?php if ($payment_img == "Not Upload") { ?>

                                                                                            <span class="badge rounded-pill bg-danger">ยังไม่ได้อัปโหลดสลิป</span>

                                                                                        <?php } else { ?>

                                                                                            <img src="upload/payment/<?php echo  $payment_img ?>" width="300px" height="300px" alt="">
                                                                                        <?php } ?>

                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <input type="hidden" name="order_no" value="<?php echo $order_no ?>">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                                                        <button type="submit" name="submit" class="btn btn-primary">อนุมัติ</button>
                                                                    </div>
                                                                </form>


                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>

                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <?php include('script.php'); ?>
    </body>

    <?php
    if (isset($_POST['submit'])) {

        $order_no = $_POST['order_no'];

        $update = "UPDATE tb_orderdetail set payment_status = 'ตรวจสอบแล้ว' WHERE order_no = '$order_no'";
        $query = $conn->query($update);

        if ($query) {
            echo '<script>';
            echo "window.location='admin_waitpayment.php?do=success';";
            echo '</script>';
        } else {
            echo '<script>';
            echo "window.location='admin_waitpayment.php?do=error';";
            echo '</script>';
        }
    }
    ?>

    <style>
        @media screen and (max-width: 600px) {
            img {
                width: 100%;
                height: auto;
            }
        }

        @media screen and (max-width: 1000px) {
            img {
                width: 100%;
                height: auto;
            }
        }
    </style>



    </html>
<?php } ?>