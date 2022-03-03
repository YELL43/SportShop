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
    <title>Admin</title>
    <?php include('header.php'); ?>
</head>
<?php include('menubar.php'); ?>

<body></body>
<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <h3>จัดการข้อมูลการสั่งซื้อ</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-12">

                <div class="row">
                    <div class="col-12 col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>ข้อมูลการสั่งซื้อ</h4>
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
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="col-auto">
                                                    <p class=" mb-0">กกก</p>
                                                </td>
                                                <td class="col-auto">
                                                    <p class=" mb-0">กกก</p>
                                                </td>
                                                <td class="col-auto">
                                                    <p class=" mb-0">กกก</p>
                                                </td>
                                                <td class="col-auto">
                                                    <p class=" mb-0">กกก</p>
                                                </td>
                                                <td class="col-auto">
                                                    <p class=" mb-0">กกก</p>
                                                </td>
                                                <td class="col-auto">
                                                    <a class="btn btn-outline-warning" href="">แก้ไข</a>
                                                </td>


                                            </tr>

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