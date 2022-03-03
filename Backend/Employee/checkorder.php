<!DOCTYPE html>
<html lang="en">


<?php include('header.php'); ?>
<?php

if ($_SESSION["user_status"] != 'employer') {  //check session

    Header("Location: ../../error-404.php"); //ไม่พบผู้ใช้กระโดดกลับไปหน้า login form 

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
                    <a class="btn btn-outline-primary" href="checkorder.php">รอผู้ดูแลระบบตรวจสอบ</a>
                    <a class="btn btn-outline-primary" href="show_order.php">ผู้ดูแลระบบตรวจสอบเเล้ว</a>
                    <a class="btn btn-outline-primary" href="deliv.php">ข้อมูลการจัดส่ง</a>

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
                            FROM `tb_orderdetail`INNER JOIN tb_user ON tb_orderdetail.user_id=tb_user.user_id WHERE payment_status = 'รอตรวจสอบ' GROUP BY order_no  ORDER BY `tb_orderdetail`.`orderde_id` ASC;";
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

                                                                <button type="button" class="btn btn-success me-1 mb-1" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $order_no ?>">ดูรายละเอียด</button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </form>

                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal<?php echo $order_no ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">

                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">ตรวจสอบการสั่งซื้อ</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="" method="POST">
                                                                <div class="table-responsive">

                                                                    <table class="table table-striped" id="table1">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>ชื่อสินค้า</th>
                                                                                <th>จำนวน</th>
                                                                                <th>ราคา</th>
                                                                                <th>สถานที่จัดส่ง</th>
                                                                                <th>รูปภาพ</th>
                                                                                <th>ชื่อผู้ใช้</th>
                                                                                <th>เบอร์โทร</th>


                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php
                                                                            $sql = "SELECT tb_orderdetail.total_price,tb_orderdetail.order_img,tb_user.user_username,tb_orderdetail.order_amount,tb_user.user_address,tb_user.user_phone ,tb_orderdetail.product_name ,tb_orderdetail.order_category FROM `tb_orderdetail`
                                                                    INNER JOIN tb_user ON tb_orderdetail.user_id=tb_user.user_id WHERE payment_status = 'รอตรวจสอบ' AND order_no = '$order_no'  ORDER BY `tb_orderdetail`.`orderde_id` ASC";
                                                                            $query = $conn->query($sql);
                                                                            while ($row = mysqli_fetch_array($query)) {
                                                                                $total_price = $row['total_price'];
                                                                                $order_img = $row['order_img'];
                                                                                $user_username = $row['user_username'];
                                                                                $order_amount = $row['order_amount'];
                                                                                $user_address = $row['user_address'];
                                                                                $user_phone = $row['user_phone'];
                                                                                $product_name = $row['product_name'];
                                                                                $order_category = $row['order_category'];

                                                                            ?>
                                                                                <tr>
                                                                                    <td><?php echo $product_name ?></td>
                                                                                    <td><?php echo $order_amount ?></td>
                                                                                    <td><?php echo $total_price ?></td>
                                                                                    <td><?php echo $user_address ?></td>
                                                                                    <td> <img src="../upload/type_sport/<?php echo $order_category ?>/<?php echo  $order_img ?>" width="50px" height="60px" alt="">
                                                                                    <td><?php echo $user_username ?></td>
                                                                                    <td><?php echo $user_phone ?></td>
                                                                                </tr>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php   } ?>

                                            </tbody>
                                            </table>
                                            </div>
                                            <div class="modal-footer">
                                                <?php $sql = "SELECT sum(total_price * order_amount) as sumprice FROM tb_orderdetail WHERE  order_no = '$order_no' ";
                                                $query = $conn->query($sql);
                                                $querysum = mysqli_fetch_array($query);

                                                ?>
                                                <p name="sumprice" value="<?php echo $order_no ?>">ราคารวม: <?php echo $querysum[0] ?> บาท</p>
                                                <input type="hidden" name="order_no" value="<?php echo $order_no ?>">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                            </div>


                                        </div>

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





    <script>
        function confirmation() {}
    </script>

</html>
<?php } ?>