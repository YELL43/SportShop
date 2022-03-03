<!DOCTYPE html>
<html lang="en">

<?php include('header.php'); ?>
<?php

if ($_SESSION["user_status"] != 'admin') {  //check session

    Header("Location: ../error-404.php"); //ไม่พบผู้ใช้กระโดดกลับไปหน้า login form 

} else { ?>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>employee</title>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <?php include "conn.php"; ?>
    </head>
    <?php include('menubar.php'); ?>


    <body>


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
                    <div class="col-12 col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>ข้อมูลสินค้า</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>ลำดับ</th>
                                                <th>รหัสการสั่งซื้อ</th>
                                                <th>รหัสการชำระ</th>
                                                <th>ที่อยู่</th>
                                                <th>ชื่อลูกค้า</th>
                                                <th>สถานะ</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT tb_orderdetail.payment_status,tb_delivery.payment_id,tb_orderdetail.order_no,tb_delivery.delivery_id,tb_user.user_username,tb_user.user_address FROM tb_delivery
                                        INNER JOIN tb_orderdetail ON tb_delivery.order_id = tb_orderdetail.order_no 
                                        INNER JOIN tb_user ON tb_orderdetail.user_id = tb_user.user_id
                                        INNER JOIN tb_payment ON	tb_payment.order_no = tb_orderdetail.order_no GROUP BY tb_orderdetail.order_no ORDER BY `tb_orderdetail`.`payment_status` ASC";
                                            $query = $conn->query($sql);
                                            $i = 1;
                                            while ($row = mysqli_fetch_array($query)) {
                                                $delivery_id = $row['delivery_id'];
                                                $user_username = $row['user_username'];
                                                $user_address = $row['user_address'];
                                                $order_no = $row['order_no'];
                                                $payment_status = $row['payment_status'];
                                                $payment_id = $row['payment_id'];
                                            ?>
                                                <tr>
                                                    <td><?php echo $i++ ?></td>
                                                    <td><?php echo $order_no ?></td>
                                                    <td><?php echo $payment_id ?></td>
                                                    <td><?php echo $user_address ?></td>
                                                    <td><?php echo $user_username ?></td>
                                                    <td><?php echo $payment_status ?></td>
                                                </tr>



                                            <?php   } ?>

                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

        </div>
        </div>
        </div>
        </section>
        </div>
        <?php include('script.php'); ?>
    </body>







 


</html>
<?php } ?>