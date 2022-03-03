<?php include('header.php'); ?>
<?php

if ($_SESSION["user_status"] != 'admin') {  //check session

    Header("Location: ../error-404.php"); //ไม่พบผู้ใช้กระโดดกลับไปหน้า login form 

} else { ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin</title>
        <?php include "conn.php"; ?>
    </head>
    <?php include('menubar.php'); ?>
    <?php
    $countemp = "SELECT count('user_status')  FROM `tb_user` WHERE user_status = 'employer'";
    $querycountemp = $conn->query($countemp);
    $countemp2 = mysqli_fetch_array($querycountemp);


    $countmember = "SELECT count('user_status')  FROM `tb_user` WHERE user_status = 'member'";
    $querycountmember = $conn->query($countmember);
    $countmember2 = mysqli_fetch_array($querycountmember);


    $allcount = "SELECT count('user_status')  FROM `tb_user` WHERE user_status != 'admin'";
    $queryallcount = $conn->query($allcount);
    $allcount2 = mysqli_fetch_array($queryallcount);

    ?>

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
            echo '<meta http-equiv="refresh" content="2;url=admin_userlist.php" />';
        } elseif (@$_GET['do'] == 'error') {
            echo '<script type="text/javascript">
					Swal.fire(
						"",
						"บันทึกข้อมูลไม่สำเร็จ",
						"error"
					  )
                </script>';
            echo '<meta http-equiv="refresh" content="2;url=admin_userlist.php" />';
        }

        ?>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <h3>ข้อมูลผู้ใช้</h3>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="col-12 col-lg-12">
                        <div class="row">
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon purple">
                                                    <i class="iconly-boldShow"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">ผู้ใช้งานทั้งหมด</h6>
                                                <h6 class="font-extrabold mb-0"><?php echo  $allcount2[0] ?> คน</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon blue">
                                                    <i class="iconly-boldProfile"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">ลูกค้า</h6>
                                                <h6 class="font-extrabold mb-0"><?php echo  $countmember2[0] ?> คน</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon green">
                                                    <i class="iconly-boldProfile"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">พนักงาน</h6>
                                                <h6 class="font-extrabold mb-0"><?php echo  $countemp2[0] ?> คน</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-3">
                            <div><a class="btn btn-outline-primary" href="admin_employerlist.php">พนักงาน</a>
                                <a class="btn btn-outline-primary" href="admin_userlist.php">ลูกค้า</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-xl-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>ข้อมูลผู้ใช้งาน</h4>
                                    </div>

                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-lg">
                                                <thead>
                                                    <tr>
                                                        <th>ชื่อผู้ใช้</th>
                                                        <th>ชื่อ</th>
                                                        <th>นามสกุล</th>
                                                        <th>เบอร์โทร</th>
                                                        <th>ที่อยู่</th>
                                                        <th>สถานะ</th>
                                                    </tr>
                                                </thead>
                                                <?php
                                                $sql = "SELECT * FROM tb_user WHERE  user_status = 'employer'";
                                                $query = $conn->query($sql);
                                                while ($row = mysqli_fetch_array($query)) {
                                                    $user_username = $row['user_username'];
                                                    $user_firstname = $row['user_firstname'];
                                                    $user_lastname = $row['user_lastname'];
                                                    $user_phone = $row['user_phone'];
                                                    $user_status = $row['user_status'];
                                                    $user_address = $row['user_address'];
                                                    $user_id = $row['user_id'];
                                                ?>
                                                    <tbody>
                                                        <tr>
                                                            <td class="col-auto">
                                                                <p class=" mb-0"><?php echo  $user_username ?></p>
                                                            </td>
                                                            <td class="col-auto">
                                                                <p class=" mb-0"><?php echo  $user_firstname ?></p>
                                                            </td>
                                                            <td class="col-auto">
                                                                <p class=" mb-0"><?php echo  $user_lastname ?></p>
                                                            </td>
                                                            <td class="col-auto">
                                                                <p class=" mb-0"><?php echo  $user_phone ?></p>
                                                            </td>
                                                            <td class="col-auto">
                                                                <p class=" mb-0"><?php echo  $user_address ?></p>
                                                            </td>
                                                            <td class="col-auto">
                                                                <p class=" mb-0"><?php echo  $user_status ?></p>
                                                            </td>
                                                            <td class="col-auto">
                                                                <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $user_id ?>" data-bs-whatever="@fat">แก้ไข</button>
                                                            </td>
                                                        </tr>


                                                        <div class="modal fade" id="exampleModal<?php echo $user_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูล</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form method="post">
                                                                            <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
                                                                            <div class="mb-2">
                                                                                <label for="recipient-name" class="col-form-label">ชื่อผู้ใช้:</label>
                                                                                <input type="text" class="form-control" id="user_username" value="<?php echo $user_username ?>" readonly>
                                                                            </div>

                                                                            <div class="mb-2">
                                                                                <label for="recipient-name" class="col-form-label">ชื่อ:</label>
                                                                                <input type="text" class="form-control" id="user_firstname" value="<?php echo $user_firstname ?>" readonly>
                                                                            </div>
                                                                            <div class="mb-2">
                                                                                <label for="recipient-name" class="col-form-label">นามสกุล:</label>
                                                                                <input type="text" class="form-control" id="user_lastname" value="<?php echo $user_lastname ?>" readonly>
                                                                            </div>
                                                                            <div class="mb-2">
                                                                                <label for="message-text" class="col-form-label">เบอร์โทร:</label>
                                                                                <input type="text" class="form-control" id="user_phone" value="<?php echo $user_phone ?>" readonly>

                                                                                <!-- <textarea class="form-control" id="message-text"></textarea> -->
                                                                            </div>
                                                                            <div class="mb-2">
                                                                                <label for="message-text" class="col-form-label">ที่อยู่:</label>
                                                                                <textarea class="form-control" id="message-text" name="user_address" readonly><?php echo $user_address ?>"</textarea>
                                                                            </div>
                                                                            <div class="mb-2">
                                                                                <label for="message-text" class="col-form-label">สถานะ:</label>
                                                                                <select class="form-select" name="user_status">
                                                                                    <option value="<?php echo $user_status ?>" selected><?php echo $user_status ?></option>
                                                                                    <option value="">------เลือกสถานนะ------</option>
                                                                                    <option value="member">member</option>
                                                                                    <option value="employer">employer</option>
                                                                                </select>
                                                                            </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <input type="submit" name="submit" class="btn btn-primary" value="บันทึกข้อมูล"></input>
                                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</button>

                                                                    </div>
                                                                    </form>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </tbody>
                                                <?php   } ?>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <?php

                    if (isset($_POST['submit'])) {
                        $user_id = $_POST['user_id'];
                        $user_status = $_POST['user_status'];



                        $update = "UPDATE tb_user set user_status = '$user_status' WHERE user_id = '$user_id'";
                        $query = $conn->query($update);

                        if ($query) {
                            echo '<script>';
                            echo "window.location='admin_userlist.php?do=success';";
                            echo '</script>';
                        } else {
                            echo '<script>';
                            echo "window.location='admin_userlist.php?do=error';";
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