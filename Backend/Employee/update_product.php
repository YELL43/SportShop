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
    <?php include('header.php'); ?>
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
						"บันทึกข้อมูลเรียบร้อย",
						"success"
					  )
                </script>';
        echo '<meta http-equiv="refresh" content="2;url=show_product.php" />';
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
            <h3>แก้ไขข้อมูลสินค้า</h3>
        </div>
        <div class="page-content">
            <section class="row">
                <div class="col-12 col-lg-12">
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
                        <form method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-12 col-lg-12 col-md-12">
                                    <div class="card">
                                        <div class="card-body px-3 py-4-5">
                                            <div class="row">
                                                <div class="col-md-3 mb-4">
                                                    <h6 class="text-muted font-semibold">ชื่อสินค้า</h6>
                                                    <input class="form-control" type="text" name="product_name" required="" value="<?php echo $product_name ?>">
                                                </div>
                                                <?php $select_cate = "SELECT * FROM product_category";
                                                $query = $conn->query($select_cate); ?>
                                                <div class="col-md-3 mb-4">
                                                    <h6 class="text-muted font-semibold">ประเภทสินค้า</h6>
                                                    <select class="form-select" aria-label="Default select example" name="category_id">
                                                        <option value="<?php echo $category_id ?>" selected><?php echo $category_name ?></option>
                                                        <option value="">-----------เลือกประเภท-----------</option>
                                                        <?php while ($row2 = mysqli_fetch_array($query)) { ?>
                                                            <option value="<?php echo $row2['category_id'] ?>"><?php echo $row2['category_name'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-3 mb-4">
                                                    <h6 class="text-muted font-semibold">ราคาสินค้า</h6>
                                                    <input class="form-control" type="text" name="product_price" required value="<?php echo $product_price ?>">
                                                </div>
                                                <div class="col-md-3 mb-4">
                                                    <h6 class="text-muted font-semibold">จำนวนสินค้า</h6>
                                                    <input class="form-control" type="number" name="product_inventories" required value="<?php echo $product_inventories ?>">
                                                </div>
                                                <div class="col-md-5 mb-4">
                                                    <h6 class="text-muted font-semibold">รายละเอียดสินค้า</h6>
                                                    <textarea class="form-control" name="product_details" required><?php echo $product_details ?></textarea>
                                                </div>
                                                <div class="col-md-4 mb-4">
                                                    <h6 class="text-muted font-semibold">รูปสินค้า</h6>
                                                    <input class="form-control" type="file" id="formFile" name="product_img">
                                                </div>
                                                <div class="col-md-2 mb-4">
                                                    <h6 class="text-muted font-semibold">รูปสินค้า</h6>
                                                    <img src="../upload/type_sport/<?php echo $category_name ?>/<?php echo $product_img ?>" height="150px" width="150px">
                                                </div>
                                                <div class="row text-end">
                                                    <div align='right'>
                                                        <input type="hidden" name="product_id" value="<?php echo $product_id ?>">
                                                        <input type="hidden" name="product_img2" value="<?php echo $product_img ?>">
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
                    } else {
                        // echo "ไม่มีข้อมูล";
                    }
                    ?>
                </div>
            </section>
        </div>
    </div>

    <?php
    if (isset($_POST['submit'])) {

        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $category_id = $_POST['category_id'];
        $product_price = $_POST['product_price'];
        $product_img2 = $_POST['product_img2'];
        $product_details = $_POST['product_details'];


        if ($_FILES["product_img"]["name"] != "") {
            $sqlcate = "SELECT category_name FROM product_category WHERE category_id = $category_id";
            $chk = $conn->query($sqlcate);
            $fetcate = mysqli_fetch_array($chk);
            $category_name = $fetcate['category_name'];
            $datetime = date("dmYHis");
            $file_name = substr($_FILES['product_img']['name'], -4);
            $product_img = $datetime . '_Product' . $file_name;
            move_uploaded_file($_FILES["product_img"]["tmp_name"], "../upload/type_sport/$category_name/" . $product_img);
            unlink("../upload/type_sport/$category_name/" . $product_img2);
            $update = "UPDATE  tb_product set  
                    product_name = '$product_name',
                    category_id = '$category_id',
                    product_price = '$product_price',
                    product_img = '$product_img', 
                    product_details = '$product_details'
                    WHERE product_id = $product_id";
            $query = $conn->query($update);

            if ($query) {
                echo '<script>';
                echo "window.location='update_product.php?do=success';";
                echo '</script>';
            } else {
                echo '<script>';
                echo "window.location='update_product.php?do=error';";
                echo '</script>';
            }
        } else {
            $product_img = $product_img2;
            $update = "UPDATE  tb_product set  
                    product_name = '$product_name',
                    category_id = '$category_id',
                    product_price = '$product_price',
                    product_img = '$product_img', 
                    product_details = '$product_details'
                    WHERE product_id = $product_id";
            $query = $conn->query($update);

            if ($query) {
                echo '<script>';
                echo "window.location='update_product.php?do=success';";
                echo '</script>';
            } else {
                echo '<script>';
                echo "window.location='update_product.php?do=error';";
                echo '</script>';
            }
        }
    }
    ?>

    <?php include('script.php'); ?>
</body>

</html>
<?php } ?>