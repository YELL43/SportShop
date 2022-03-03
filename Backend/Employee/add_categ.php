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
                    "บันทึกข้อมูลเรียบร้อย",
                    "success"
                  )
            </script>';
        echo '<meta http-equiv="refresh" content="1;url=add_categ.php" />';
    } elseif (@$_GET['do'] == 'delete') {
        echo '<script type="text/javascript">
                Swal.fire(
                    "",
                    "ลบข้อมูลเรียบร้อย",
                    "success"
                  )
            </script>';
        echo '<meta http-equiv="refresh" content="1;url=add_categ.php" />';
    } elseif (@$_GET['do'] == 'update') {
        echo '<script type="text/javascript">
                Swal.fire(
                    "",
                    "แก้ไขข้อมูลเรียบร้อย",
                    "success"
                  )
            </script>';
        echo '<meta http-equiv="refresh" content="1;url=add_categ.php" />';
    }

    ?>

    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <h3>เพิ่มประเภทสินค้า</h3>
        </div>
        <div class="page-content">
            <section class="row">
                <div class="col-12 col-lg-12">
                    <div class="row">
                        <div class="col-12 col-lg-4 col-md-12">
                            <div class="card">
                                <div class="card-body px-3 py-4-5">

                                    <form method="post" action="addcate.php">
                                        <div class="mb-3">
                                            <label class="form-label">ชื่อประเภทสินค้า</label>
                                            <input type="text" name="category_name" class="form-control">
                                        </div>
                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                            <button class="btn btn-primary" type="submit" name="submit">บันทึก</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-8 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>ข้อมูลประเภทสินค้า</h4>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-lg">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>ประเภท</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <?php
                                            $sql = "SELECT * FROM product_category";
                                            $query = $conn->query($sql);
                                            while ($row = mysqli_fetch_array($query)) {
                                                $category_name = $row['category_name'];
                                                $category_id = $row['category_id'];
                                            ?>
                                                <tbody>

                                                    <tr>
                                                        <td class="col-auto">
                                                            <p class=" mb-0"><?php echo $category_id ?></p>
                                                        </td>
                                                        <td class="col-auto">
                                                            <p class=" mb-0"><?php echo $category_name ?></p>
                                                        </td>

                                                        <td class="col-auto">
                                                            <button type="button" class="btn btn-warning me-1 mb-1" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $category_id ?>"> แก้ไข</button>
                                                            <a class="btn btn-outline-danger" href="delcate.php?cate_id=<?php echo $category_name ?>" onclick="return confirm('คุณต้องการออกจากระบบใช่หรือไม่')">ลบ</a>
                                                        </td>

                                                    </tr>
                                                    <div class="modal fade" id="exampleModal<?php echo $category_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูล</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form method="post">

                                                                        <div class="mb-2">
                                                                            <label for="recipient-name" class="col-form-label">รหัสประเภท:</label>
                                                                            <input type="text" class="form-control" name="category_id" value="<?php echo $category_id ?>" readonly>
                                                                        </div>
                                                                        <div class="mb-2">
                                                                            <label for="recipient-name" class="col-form-label">ชื่อประเภท:</label>
                                                                            <input type="text" class="form-control" name="category_name" value="<?php echo $category_name ?>">
                                                                        </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
                                                                    <input type="hidden" name="oldcategory_name" value="<?php echo $category_name ?>" />
                                                                    <input type="submit" name="submit" class="btn btn-primary" value="บันทึกข้อมูล"></input>
                                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</button>

                                                                </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="modal fade" id="exampleModal<?php echo $category_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">ตรวจสอบการสั่งซื้อ</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <form method="POST" action="add_categ.php">
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="row">
                                                                                <div class="col-6">
                                                                                    <span>รหัสประเภทสินค้า</span>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                    <input type="text" name="category_id" value="<?php echo $category_id ?>" readonly="readonly"></input>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-6">
                                                                                    <span>ชื่อประเภทสินค้า</span>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                    <span>ชื่อเก่าประเภทสินค้า</span>
                                                                                    <input type="text" name="oldcategory_name" value="<?php echo $category_name ?>" readonly="readonly" />
                                                                                    <span>ชื่อใหม่ประเภทสินค้า</span>
                                                                                    <input type="text" name="category_name" value="<?php echo $category_name ?>"></input>
                                                                                </div>
                                                                            </div>
                                                                            <div class=" col-6">
                                                                                <input type="submit" name="submit"></input>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                </tbody>
                                            <?php } ?>
                                        </table>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>


                </div>

            </section>
        </div>

        <?php

        if (isset($_POST['submit'])) {
            $category_id = $_POST['category_id'];
            $category_namenew = $_POST['category_name'];
            $oldcategory_name = $_POST['oldcategory_name'];
            $chk = "SELECT * FROM product_category WHERE category_name = '$category_namenew'";
            $query = $conn->query($chk);
            if ($query->num_rows <= 0) {
                $sql = "UPDATE product_category set category_name = '$category_namenew' WHERE category_id = '$category_id'";
                $resulchk = $conn->query($sql);

                $oldname = "../upload/type_sport/" . $oldcategory_name . "";
                $newname = "../upload/type_sport/" . $category_namenew . "";
                rename($oldname, $newname);

                echo '<script>';
                echo "window.location='add_categ.php?do=update';";
                echo '</script>';
            } else {
                echo ('มีชื่อนี้อยู่แล้ว');
            }
        }
        ?>

        <?php include('script.php'); ?>
</body>

</html>
<?php } ?>