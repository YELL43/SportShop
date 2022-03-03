<!DOCTYPE html>
<html lang="en">

<?php include('header.php'); ?>
<?php

if ($_SESSION["user_status"] != 'employer'){  //check session

    Header("Location: ../../error-404.php"); //ไม่พบผู้ใช้กระโดดกลับไปหน้า login form 
    
}else{ ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<title>employee</title>
</head>
<?php include('menubar.php'); ?>

<body></body>
<?php
if (@$_GET['do'] == 'success') {
    echo '<script type="text/javascript">
					Swal.fire(
						"",
						"ลบข้อมูลเรียบร้อย",
						"success"
					  )
                </script>';
    echo '<meta http-equiv="refresh" content="2;url=show_product.php" />';
} elseif (@$_GET['do'] == 'error') {
    echo '<script type="text/javascript">
					Swal.fire(
						"",
						"ลบข้อมูลไม่สำเร็จ",
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
    <?php include "conn.php"; ?>

    <div class="page-heading">
        <h3>จัดการสินค้า</h3>
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
                                <div style="margin-right: 30px;" align='right'>
                                    <a class="btn btn-success" href="insert_product.php" role="button"><span class="glyphicon glyphicon-plus"></span>เพิ่มสินค้าใหม่</a>


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
                                                    <th>จัดการ</th>

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
                                                    $product_id = $row['product_id'];
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
                                                            <!-- <img src="../upload/Product/<?php echo $product_img ?>" width="100px" height="auto"></img> -->
                                                            <img src="../upload/type_sport/<?php echo $category_name ?>/<?php echo $product_img ?>" width="100px" height="auto"></img>

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
                                                        <td>
                                                            <!-- <div class="row">
                                                            <a href="#" type="button" class="btn btn-outline-primary">เพิ่ม</a>
                                                                <a href="#" type="button" class="btn btn-outline-warning">แก้ไข</a>
                                                                <a href="#" type="button" class="btn btn-outline-danger">ลบ</a>


                                                            </div> -->
                                                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                                <a href="add_product.php?id=<?php echo $product_id ?>" class="btn btn-outline-primary">เพิ่ม</a>
                                                                <a href="update_product.php?id=<?php echo $product_id ?>" class="btn btn-outline-warning">แก้ไข</a>
                                                                <a href="show_product.php?delete=<?php echo $product_id ?>&category_name=<?php echo $category_name ?>&product_img=<?php echo $product_img ?>" type="button" class="btn btn-outline-danger" onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่?')">ลบ</a>
                                                            </div>

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

                <?php

                if (isset($_GET['delete'])) {
                    $id = $_GET['delete'];
                    $category_name = $_GET['category_name'];
                    $product_img = $_GET['product_img'];
                    unlink("../upload/type_sport/$category_name/" . $product_img);
                    $sqldelete = "DELETE FROM tb_product WHERE product_id = $id ";
                    $query = $conn->query($sqldelete);


                    if ($query) {
                        echo '<script>';
                        echo "window.location='show_product.php?do=success';";
                        echo '</script>';
                    } else {
                        echo '<script>';
                        echo "window.location='show_product.php?do=error';";
                        echo '</script>';
                    }
                }

                ?>

        </section>
    </div>
    <?php include('script.php'); ?>
    </body>

</html>
<?php } ?>