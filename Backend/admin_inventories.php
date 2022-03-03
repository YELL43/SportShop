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
</head>
<?php include('menubar.php'); ?>

<body></body>
<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>
    <?php include "conn.php"; ?>

    <div class="page-heading">
        <h3>สินค้าคงเหลือ</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-12">
                <div class="card-body px-3">
                    <div class="card-body px-3">
                        <div> <?php
                                $sql = "SELECT * FROM product_category";
                                $query = $conn->query($sql);
                                while ($row = mysqli_fetch_array($query)) {
                                    $category_name = $row['category_name'];
                                    $category_id = $row['category_id'];
                                ?>
                                <a class="btn btn-outline-primary" href="?category_id=<?php echo $category_id ?>"><?php echo $category_name ?></a>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-xl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>ข้อมูลสินค้า</h4>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-lg">
                                            <thead>
                                                <tr>
                                                    <th>ชื่อสินค้า</th>
                                                    <th>รายละเอียด</th>
                                                    <th>รูปภาพ</th>
                                                    <th>ราคา</th>
                                                    <th>จำนวนคงเหลือ</th>
                                                    <th>หมวดหมู่</th>
                                                    <th>หมายเหตุ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (isset($_GET['category_id'])) {
                                                    $sql = "SELECT * FROM tb_product LEFT JOIN product_category 
                                ON tb_product.category_id = product_category.category_id WHERE tb_product.category_id = " . $_GET['category_id'] . "";
                                                } else {
                                                    $sql = "SELECT * FROM tb_product LEFT JOIN product_category 
                                    ON tb_product.category_id = product_category.category_id";
                                                }
                                                $query = $conn->query($sql);
                                                while ($row = mysqli_fetch_array($query)) {
                                                    $product_name = $row['product_name'];
                                                    $product_price = $row['product_price'];
                                                    $product_inventories = $row['product_inventories'];
                                                    $product_details = $row['product_details'];
                                                    $product_img = $row['product_img'];
                                                    $category_name = $row['category_name'];

                                                ?>
                                                    <tr>
                                                        <td class="col-auto">
                                                            <p class=" mb-0"><?php echo $product_name ?></p>
                                                        </td>
                                                        <td class="col-auto">
                                                            <p class=" mb-0"><?php echo $product_details ?></p>
                                                        </td>
                                                        <td class="col-auto">
                                                            <img src="upload/type_sport/<?php echo $category_name ?>/<?php echo $product_img ?>" width="100px" height="auto"></img>
                                                        </td>
                                                        <td class="col-auto">
                                                            <p class=" mb-0"><?php echo $product_price ?></p>
                                                        </td>
                                                        <td class="col-auto">
                                                            <p class=" mb-0"><?php echo $product_inventories ?></p>
                                                        </td>
                                                        <td class="col-auto">
                                                            <p class=" mb-0"><?php echo $category_name ?></p>
                                                        </td>
                                                        <td class="col-auto">
                                                            <p class=" mb-0">
                                                                <?php if ($product_inventories == 0 || "") {
                                                                ?>
                                                                    <span class="badge bg-danger">สินค้าหมด</span> <?php } else if ($product_inventories <= 10 || "") { ?>
                                                                    <span class="badge bg-warning text-dark">สินค้าใกล้หมด</span><?php } else {
                                                                                                                                    ?>
                                                                    <span class="badge bg-success">จำนวนสินค้าปกติ</span> <?php
                                                                                                                                } ?>
                                                            </p>
                                                        </td>

                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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