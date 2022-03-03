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

<script>
    function previewFile() {
        const preview = document.querySelector('img');
        const file = document.querySelector('input[type=file]').files[0];
        const reader = new FileReader();

        reader.addEventListener("load", function() {
            // convert image file to base64 string
            preview.src = reader.result;
        }, false);

        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>

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
            <h3>เพิ่มข้อมูลสินค้า</h3>
        </div>
        <div class="page-content">
            <section class="row">
                <div class="col-12 col-lg-12">
                    <p id="demo"></p>
                    <form method="post" enctype="multipart/form-data">
                        <center>
                            </centerE>
                            <div id="wan"></div>
                        </center>
                        <div class="row">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-3 mb-4">
                                                <h6 class="text-muted font-semibold">ชื่อสินค้า</h6>
                                                <input class="form-control" type="text" name="product_name" required="">
                                            </div>
                                            <?php $sql = "SELECT * FROM product_category";
                                            $query = $conn->query($sql); ?>
                                            <div class="col-md-3 mb-4">
                                                <h6 class="text-muted font-semibold">ประเภทสินค้า</h6>
                                                <select class="form-select" aria-label="Default select example" name="category_id">
                                                    <option value="" disabled selected>เลือกประเภทสินค้า</option>
                                                    <?php while ($row2 = mysqli_fetch_array($query)) { ?>
                                                        <option value="<?php echo $row2['category_id'] ?>"><?php echo $row2['category_name'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-md-3 mb-4">
                                                <h6 class="text-muted font-semibold">ราคาสินค้า</h6>
                                                <input class="form-control" type="text" name="product_price" required>
                                            </div>
                                            <div class="col-md-3 mb-4">
                                                <h6 class="text-muted font-semibold">จำนวนสินค้า</h6>
                                                <input class="form-control" type="number" name="product_inventories" required value="1">
                                            </div>
                                            <div class="col-md-5 mb-4">
                                                <h6 class="text-muted font-semibold">รายละเอียดสินค้า</h6>
                                                <textarea class="form-control" name="product_details" required></textarea>
                                            </div>
                                            <div class="col-md-4 mb-4">
                                                <h6 class="text-muted font-semibold">รูปสินค้า</h6>
                                                <input class="form-control" type="file" id="formFile" onchange="previewFile()" name="product_img">
                                            </div>
                                            <div class="row text-end">
                                                <div align='right'>
                                                    <input type="submit" name='submit' value="บันทึก" class="btn btn-outline-success"></input>
                                                    <button type="reset" class="btn btn-outline-danger">ยกเลิก</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                </form>
        </div>
        </section>

        <?php if (isset($_POST['submit'])) {
            $product_name = $_POST['product_name'];
            $category_id = $_POST['category_id'];
            $product_price = $_POST['product_price'];
            $product_inventories = $_POST['product_inventories'];
            $product_details = $_POST['product_details'];
            $product_img = "";

            if ($_FILES["product_img"]["name"] != "") {
                $sqlcate = "SELECT category_name FROM product_category WHERE category_id = $category_id";
                $chk = $conn->query($sqlcate);
                $fetcate = mysqli_fetch_array($chk);
                $category_name = $fetcate['category_name'];
                $datetime = date("dmYHis");
                $file_name = substr($_FILES['product_img']['name'], -4);
                $product_img = $datetime . '_Product' . $file_name;
                move_uploaded_file($_FILES["product_img"]["tmp_name"], "../upload/type_sport/$category_name/" . $product_img);
            }

            $sql = "INSERT INTO tb_product(product_name,category_id,product_price,product_inventories,product_details,product_img)
            VALUES('$product_name','$category_id','$product_price','$product_inventories','$product_details','$product_img')";
            $query = $conn->query($sql);
            if ($query) {
                echo '<script>';
                echo "window.location='insert_product.php?do=success';";
                echo '</script>';
            } else {
                echo '<script>';
                echo "window.location='insert_product.php?do=error';";
                echo '</script>';
            }
        }

        ?>
    </div>
    </div>



    <?php include('script.php'); ?>
</body>

</html>
<?php } ?>