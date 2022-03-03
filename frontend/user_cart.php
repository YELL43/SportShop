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
<?php include "../Backend/conn.php";
date_default_timezone_set('Asia/Bangkok');
$time = $order_date = date("Y-m-d H:i:s");


?>

<body>

    <div id="main">
        <div class="page-heading">
            <h3>สถานะการสั่งซื้อ</h3>
            <!--end navbar-right -->
        </div>

        <div class="page-content">
            <section class="row">
                <div class="col-12 col-lg-12 ">
                    <div class="card ">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 ">
                                    <div class="nav justify-content-center nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                        <a class="nav-link active border border-1 border-primary m-2" id="v-pills-home-tab" data-bs-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">ที่ต้องชำระ</a>
                                        <a class="nav-link border border-1 border-primary m-2" id="v-pills-profile-tab" data-bs-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">สถานะสินค้า</a>
                                        <a class="nav-link border border-1 border-primary m-2" id="v-pills-settings-tab" data-bs-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">สินค้าที่รับเรียบร้อยเเล้ว</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                    <div class="table-responsive">

                                        <table class="table  table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">ลำดับ</th>
                                                    <th scope="col">รหัสการชำระเงิน</th>
                                                    <th scope="col">ราคารวม</th>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                $user_id = $_SESSION['user_id'];
                                                $sqlpayment = "SELECT * FROM tb_payment WHERE user_id = $user_id AND payment_img = 'Not Upload' ";
                                                $querypayment = $conn->query($sqlpayment);
                                                while ($rowpayment = mysqli_fetch_array($querypayment)) {
                                                    $order_no =   $rowpayment['order_no'];
                                                    $total_payment =   $rowpayment['total_payment'];

                                                ?>
                                                    <tr>
                                                        <td><?php echo $i++ ?></td>
                                                        <td scope="row"><?php echo $order_no ?></td>
                                                        <td><?php echo $total_payment ?> บาท</td>
                                                        <td><button type="button" class="btn  btn-primary" <?php echo $order_no ?> data-bs-toggle="modal" data-bs-target="#information1<?php echo $order_no ?>">ดูรายละเอียด</button>
                                                            <button type=" button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#sendproof<?php echo $order_no ?>">ส่งหลักฐานการชำระเงิน</button>

                                                            <div class="modal fade " id="information1<?php echo $order_no ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog  modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">รายละเอียดการสั่งซื้อ</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <table class="table">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>ชื่อสินค้า</th>
                                                                                        <th>จำนวน</th>
                                                                                        <th>ราคา</th>
                                                                                        <th>รูปภาพ</th>

                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <?php
                                                                                    $sql = "SELECT tb_orderdetail.order_category ,tb_orderdetail.total_price,tb_orderdetail.order_img,tb_user.user_username,tb_orderdetail.order_amount,tb_user.user_address,tb_user.user_phone ,tb_orderdetail.product_name FROM `tb_orderdetail`
                                                                    INNER JOIN tb_user ON tb_orderdetail.user_id=tb_user.user_id WHERE payment_status = 'รอตรวจสอบ' AND order_no = '$order_no'  ORDER BY `tb_orderdetail`.`orderde_id` ASC";
                                                                                    $query = $conn->query($sql);
                                                                                    while ($row = mysqli_fetch_array($query)) {
                                                                                        $total_price = $row['total_price'];
                                                                                        $order_img = $row['order_img'];
                                                                                        $order_amount = $row['order_amount'];
                                                                                        $product_name = $row['product_name'];
                                                                                        $order_category = $row['order_category'];
                                                                                    ?>
                                                                                        <tr>
                                                                                            <td><?php echo $product_name ?></td>
                                                                                            <td><?php echo $order_amount ?> ชิ้น</td>
                                                                                            <td><?php echo $total_price ?> บาท</td>
                                                                                            <td> <img src="../Backend/upload/type_sport/<?php echo $order_category ?>/<?php echo  $order_img ?>" width="50px" height="60px" alt="">
                                                                                            </td>
                                                                                        </tr>
                                                                                    <?php } ?>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>














                                                            <!-- Modal 2 ส่งหลักฐานการชำระเงิน-->
                                                            <div class="modal fade" id="sendproof<?php echo $order_no ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <form method="post" enctype="multipart/form-data">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">หลักฐานการชำระ</h5>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="mb-3">
                                                                                    <input class="form-control" type="file" id="formFile" name="payment">
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <input type="hidden" name="or_id" value="<?php echo $order_no ?>">
                                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                                                                <button type="submit" name="uploadd" class="btn btn-primary">ส่ง</button>
                                                                            </div>
                                                                        </div>
                                                                    </form>

                                                                </div>
                                                            </div>
                                                            <!--end Modal 2 ส่งหลักฐานการชำระเงิน-->





                                                        </td>
                                                    </tr>

                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>





                                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                    <div class="table-responsive">

                                        <table class="table  table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">ลำดับ</th>
                                                    <th scope="col">รหัสการสั่งซื้อ </th>
                                                    <th scope="col">ที่อยู่ </th>
                                                    <th>สถานะสินค้า</th>
                                                    <th>สถานะการชำระ</th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                $sqlstate = "SELECT tb_payment.payment_img,tb_orderdetail.payment_status,tb_orderdetail.order_no,tb_user.user_address ,tb_payment.payment_id FROM tb_orderdetail
                                            INNER JOIN tb_user ON tb_orderdetail.user_id = tb_user.user_id
                                            INNER JOIN tb_payment ON	tb_payment.order_no = tb_orderdetail.order_no
                                            WHERE  tb_orderdetail.payment_status != 'ได้รับสินค้าเรียบร้อย' AND tb_orderdetail.user_id = $user_id
                                            GROUP BY tb_orderdetail.order_no ORDER BY `tb_orderdetail`.`payment_status` ASC";
                                                $querysqlstate = $conn->query($sqlstate);
                                                $i = 1;
                                                while ($rowstate = mysqli_fetch_array($querysqlstate)) {
                                                    $payment_status =   $rowstate['payment_status'];
                                                    $order_no =   $rowstate['order_no'];
                                                    $user_address =   $rowstate['user_address'];
                                                    $paymentimage =   $rowstate['payment_img'];

                                                ?>
                                                    <tr>
                                                        <td><?php echo $i++ ?></td>
                                                        <td><?php echo $order_no ?></td>
                                                        <td><?php echo  $user_address ?></td>
                                                        <td>


                                                            <?php if ($payment_status == "รอตรวจสอบ") { ?>

                                                                <span class="badge bg-warning"><?php echo $payment_status ?></span>

                                                            <?php } else if ($payment_status == "ตรวจสอบแล้ว") { ?>

                                                                <span class="badge bg-success"><?php echo $payment_status ?></span>


                                                            <?php } else if ($payment_status == "กำลังจัดส่ง") { ?>
                                                                <span class="badge bg-info text-dark"><?php echo $payment_status ?></span>



                                                            <?php } ?>

                                                        </td>
                                                        <?php if ($paymentimage == 'Not Upload') {

                                                        ?>

                                                            <td><?php echo  'ยังไม่ส่งหลักฐานการชำระเงิน' ?></td>
                                                        <?php } else {
                                                        ?><td><?php echo  'ส่งหลักฐานการชำระเงินแล้ว' ?></td><?php
                                                                                                            } ?>
                                                        <?php
                                                        if ($payment_status == 'กำลังจัดส่ง') {
                                                        ?>
                                                            <form method="post">
                                                                <td><button name="confirm" type="submit" class="btn  btn-danger" value="<?php echo $order_no ?>">ได้รับสินค้าแล้ว</button></td>
                                                            </form>
                                                        <?php
                                                        } else {
                                                        ?><td><button disabled type="button" class="btn  btn-danger">ได้รับสินค้าแล้ว</button></td><?php } ?>
                                                        <td><button type="button" class="btn  btn-primary " data-bs-toggle="modal" data-bs-target="#information2<?php echo $order_no ?>">ดูรายละเอียด</button>
                                                            <div class="modal fade " id="information2<?php echo $order_no ?>" tabindex="-1" aria-labelledby="information2" aria-hidden="true">
                                                                <div class="modal-dialog  modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">รายละเอียดการสั่งซื้อ</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <table class="table">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>ชื่อสินค้า</th>
                                                                                        <th>จำนวน</th>
                                                                                        <th>ราคา</th>
                                                                                        <th>รูปภาพ</th>

                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <?php
                                                                                    $sql = "SELECT tb_orderdetail.order_category ,tb_orderdetail.total_price,tb_orderdetail.order_img,tb_user.user_username,tb_orderdetail.order_amount,tb_user.user_address,tb_user.user_phone ,tb_orderdetail.product_name FROM `tb_orderdetail`
                                                                    INNER JOIN tb_user ON tb_orderdetail.user_id=tb_user.user_id WHERE payment_status != 'ได้รับสินค้าเรียบร้อย' AND order_no = '$order_no'  ORDER BY `tb_orderdetail`.`orderde_id` ASC";
                                                                                    $query = $conn->query($sql);
                                                                                    while ($row = mysqli_fetch_array($query)) {
                                                                                        $total_price = $row['total_price'];
                                                                                        $order_img = $row['order_img'];
                                                                                        $order_amount = $row['order_amount'];
                                                                                        $product_name = $row['product_name'];
                                                                                        $order_category = $row['order_category'];
                                                                                    ?>
                                                                                        <tr>
                                                                                            <td><?php echo $product_name ?></td>
                                                                                            <td><?php echo $order_amount ?> ชิ้น</td>
                                                                                            <td><?php echo $total_price ?> บาท</td>
                                                                                            <td> <img src="../Backend/upload/type_sport/<?php echo $order_category ?>/<?php echo  $order_img ?>" width="50px" height="60px" alt="">
                                                                                            </td>
                                                                                        </tr>
                                                                                    <?php } ?>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <?php $sql = "SELECT sum(total_price * order_amount) as sumprice FROM tb_orderdetail WHERE  order_no = '$order_no' ";
                                                                            $query = $conn->query($sql);
                                                                            $querysum = mysqli_fetch_array($query);

                                                                            ?>
                                                                            <p name="sumprice" value="<?php echo $order_no ?>">ราคารวม: <?php echo $querysum[0] ?> บาท</p>
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>

                                                    </tr>

                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <?php
                                if (isset($_POST['confirm'])) {
                                    $order_no = $_POST['confirm'];
                                    $sqlup = "UPDATE tb_orderdetail set payment_status = 'ได้รับสินค้าเรียบร้อย' WHERE order_no = '$order_no'";
                                    $querysqlup = $conn->query($sqlup);
                                    echo "<script>                                       
                                    window.location.href='user_cart.php';
                                 </script>";
                                }
                                ?>



                                <div class=" tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                                    <div class="table-responsive">

                                        <table class="table  table-hover">
                                            <table class="table  table-hover">
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
                                                    $sql = "SELECT tb_orderdetail.payment_status,tb_delivery.payment_id,tb_orderdetail.order_no,tb_delivery.delivery_id,tb_user.user_username,tb_user.user_address FROM tb_delivery INNER JOIN tb_orderdetail ON tb_delivery.order_id = tb_orderdetail.order_no 
                                                INNER JOIN tb_user ON tb_orderdetail.user_id = tb_user.user_id
                                                INNER JOIN tb_payment ON	tb_payment.order_no = tb_orderdetail.order_no 
                                                WHERE tb_orderdetail.user_id = $user_id AND tb_orderdetail.payment_status = 'ได้รับสินค้าเรียบร้อย' GROUP BY tb_orderdetail.order_no ORDER BY `tb_orderdetail`.`payment_status` ASC";
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
                    </div>
                </div>
            </div>





        </div>


    </div>

    <?php include('script.php'); ?>
</body>

<?php if (isset($_POST['uploadd'])) {
    $idor = $_POST['or_id'];
    $upload = $_FILES['payment']['name'];
    $path = "../Backend/upload/payment/";
    $type = strrchr($upload, ".");
    $newname = $idor . $type;
    $path_copy = $path . $newname;
    move_uploaded_file($_FILES['payment']['tmp_name'], $path_copy);

    $updatepay = "UPDATE tb_payment SET payament_datetime = '$time' , payment_img = '$newname'  WHERE order_no = '$idor'";
    $queryup = $conn->query($updatepay);
    echo "<script>                                       
    window.location.href='user_cart.php';
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