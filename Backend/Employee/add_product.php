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
						"เพิ่มสินค้าในสต็อกเรียบร้อย",
						"success"
					  )
                </script>';
        echo '<meta http-equiv="refresh" content="2;url=show_product.php" />';
    } elseif (@$_GET['do'] == 'error') {
        echo '<script type="text/javascript">
					Swal.fire(
						"",
						"เพิ่มสินค้าในสต็อกไม่สำเร็จ",
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
            <h3>เพิ่มจำนวนสินค้าในสต็อก</h3>
        </div>
        <div class="page-content">
            <section class="row">
                <div class="col-12 col-lg-5">
                    <p id="demo"></p>
                    <?php
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        $sql = "SELECT * FROM tb_product LEFT JOIN product_category 
                        ON tb_product.category_id = product_category.category_id WHERE tb_product.product_id=$id";
                        $query = $conn->query($sql);
                        while ($row = mysqli_fetch_array($query)) {
                            $product_id = $row['product_id'];
                            $product_name = $row['product_name'];
                            $product_price = $row['product_price'];
                            $product_inventories = $row['product_inventories'];
                            $product_details = $row['product_details'];
                            $product_img = $row['product_img'];
                            $category_name = $row['category_name'];
                            $category_id = $row['category_id'];
                        }


                    ?>
                        <form method="post">
                            <div class="row">
                                <div class="col-12 col-lg-12 col-md-12">
                                    <div class="card">
                                        <div class="card-body px-3 py-4-5 border border-2 border-primary" style="border-radius: 20px;">
                                            <div align="center" class="col-md-12  mb-3">
                                                <img src="../upload/type_sport/<?php echo $category_name ?>/<?php echo $product_img ?>" height="250px" width="250px">
                                            </div>
                                            <div class="row">

                                                <div class="col-md-6 mb-4">
                                                    <h6 class="text-muted font-semibold">ชื่อสินค้า</h6>
                                                    <input class="form-control" type="text" name="product_name" required="" value="<?php echo $product_name ?>" readonly>
                                                </div>
                                                <div class="col-md-6 mb-4">
                                                    <h6 class="text-muted font-semibold">จำนวนสินค้า</h6>
                                                    <input class="form-control" type="number" name="product_inventories" required value="1">
                                                </div>


                                                <div class="row text-end">
                                                    <div align='right' style="margin-left: 24px;">
                                                        <input type="hidden" name="product_id" value="<?php echo $product_id ?>">
                                                        <input type="hidden" name="product_inventories2" value="<?php echo $product_inventories ?>">
                                                        <input type="submit" name='submit' value="บันทึก" class="btn btn-outline-success"></input>
                                                        <button onclick="window.history.go(-1); return false;" class="btn btn-outline-danger">ยกเลิก</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    <?php
                    }

                    ?>
                </div>
            </section>
        </div>
    </div>

    <?php
    if (isset($_POST['submit'])) {

        $product_id = $_POST['product_id'];
        $product_inventories = $_POST['product_inventories'];
        $product_inventories2 = $_POST['product_inventories2'];
        $inventoriesnew = ($product_inventories + $product_inventories2);




        $update = "UPDATE  tb_product set  
                    product_inventories = '$inventoriesnew'
                    WHERE product_id = $product_id";
        $query = $conn->query($update);

        if ($query) {
            echo '<script>';
            echo "window.location='add_product.php?do=success';";
            echo '</script>';
        } else {
            echo '<script>';
            echo "window.location='add_product.php?do=error';";
            echo '</script>';
        }
    }

    ?>

    <?php include('script.php'); ?>
</body>

</html>
<?php } ?>