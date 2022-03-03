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
    <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">
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
        echo '<meta http-equiv="refresh" content="1;url=show_customer.php" />';
    } elseif (@$_GET['do'] == 'error') {
        echo '<script type="text/javascript">
					Swal.fire(
						"",
						"บันทึกข้อมูลไม่สำเร็จ",
						"error"
					  )
                </script>';
        echo '<meta http-equiv="refresh" content="1;url=show_customer.php" />';
    } elseif (@$_GET['do'] == 'delete') {
        echo '<script type="text/javascript">
					Swal.fire(
						"",
						"ลบข้อมูลเรียบร้อย",
						"success"
					  )
                </script>';
        echo '<meta http-equiv="refresh" content="1;url=show_customer.php" />';
    } elseif (@$_GET['do'] == 'deleteerror') {
        echo '<script type="text/javascript">
					Swal.fire(
						"",
						"ลบข้อมูลไม่สำเร็จ",
						"error"
					  )
                </script>';
        echo '<meta http-equiv="refresh" content="1;url=show_customer.php" />';
    }

    ?>
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <h3>จัดการข้อมูลลูกค้า</h3>
        </div>
        <div class="page-content">
            <section class="row">
                <div class="col-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>ข้อมูลลูกค้า</h4>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table1">
                                    <thead>
                                        <tr>
                                            <th>ลำดับ</th>
                                            <th>ชื่อ</th>
                                            <th>นามสกุล</th>
                                            <th>ที่อยู่</th>
                                            <th>เบอร์โทร</th>
                                            <th>แก้ไข</th>
                                            <th>ลบ</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM tb_user WHERE  user_status = 'member'";
                                        $query = $conn->query($sql);
                                        $i = 1;
                                        while ($row = mysqli_fetch_array($query)) {
                                            $user_id = $row['user_id'];
                                            $user_username = $row['user_username'];
                                            $user_firstname = $row['user_firstname'];
                                            $user_lastname = $row['user_lastname'];
                                            $user_phone = $row['user_phone'];
                                            $user_status = $row['user_status'];
                                            $user_address = $row['user_address'];
                                        ?>
                                            <tr>
                                                <td><?php echo $i++ ?></td>
                                                <td><?php echo $user_firstname ?></td>
                                                <td><?php echo $user_lastname ?></td>
                                                <td><?php echo $user_phone ?></td>
                                                <td><?php echo $user_address ?></td>
                                                <td><button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $user_id ?>" data-bs-whatever="@fat">แก้ไข</button></td>
                                                <td><a class="btn btn-outline-danger" href="show_customer.php?delete=<?php echo $user_id ?>" role="button" onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่?')"><span class="glyphicon glyphicon-plus" ></span>ลบ</a></td>





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
                                                                    <input type="text" class="form-control" id="user_username" name="user_username" value="<?php echo $user_username ?>" readonly>
                                                                </div>

                                                                <div class="mb-2">
                                                                    <label for="recipient-name" class="col-form-label">ชื่อ:</label>
                                                                    <input type="text" class="form-control" id="user_firstname" name="user_firstname" value="<?php echo $user_firstname ?>">
                                                                </div>
                                                                <div class="mb-2">
                                                                    <label for="recipient-name" class="col-form-label">นามสกุล:</label>
                                                                    <input type="text" class="form-control" id="user_lastname" name="user_lastname" value="<?php echo $user_lastname ?>">
                                                                </div>
                                                                <div class="mb-2">
                                                                    <label for="message-text" class="col-form-label">เบอร์โทร:</label>
                                                                    <input type="text" class="form-control" id="user_phone" name="user_phone" value="<?php echo $user_phone ?>">

                                                                    <!-- <textarea class="form-control" id="message-text"></textarea> -->
                                                                </div>
                                                                <div class="mb-2">
                                                                    <label for="message-text" class="col-form-label">ที่อยู่:</label>
                                                                    <textarea class="form-control" id="message-text" name="user_address"><?php echo $user_address ?></textarea>
                                                                </div>
                                                                <!-- <div class="mb-2">
                                                                    <label for="message-text" class="col-form-label">สถานะ:</label>
                                                                    <select class="form-select" name="user_status">
                                                                        <option value="<?php echo $user_status ?>" selected><?php echo $user_status ?></option>
                                                                        <option value="">------เลือกสถานนะ------</option>
                                                                        <option value="member">member</option>
                                                                        <option value="employer">employer</option>
                                                                    </select>
                                                                </div> -->
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="submit" name="submit" class="btn btn-primary" value="บันทึกข้อมูล"></input>
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</button>

                                                        </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        <?php   } ?>

                                    </tbody>
                                </table>



                                <?php

                                if (isset($_POST['submit'])) {
                                    $user_id = $_POST['user_id'];
                                    $user_username = $_POST['user_username'];

                                    $user_firstname = $_POST['user_firstname'];
                                    $user_lastname = $_POST['user_lastname'];
                                    $user_phone = $_POST['user_phone'];
                                    $user_address = $_POST['user_address'];


                                    $update = "UPDATE tb_user set 
                                    user_username = '$user_username',
                                    user_firstname = '$user_firstname',
                                    user_lastname = '$user_lastname',
                                    user_phone = '$user_phone',
                                    user_address = '$user_address' 

                                    WHERE user_id = '$user_id'";
                                    $query = $conn->query($update);

                                    if ($query) {
                                        echo '<script>';
                                        echo "window.location='show_customer.php?do=success';";
                                        echo '</script>';
                                    } else {
                                        echo '<script>';
                                        echo "window.location='show_customer.php?do=error';";
                                        echo '</script>';
                                    }
                                }

                                ?>

                                <?php

                                if (isset($_GET['delete'])) {
                                    $id = $_GET['delete'];
                                    $sqldelete = "DELETE FROM tb_user WHERE user_id = $id ";
                                    $query = $conn->query($sqldelete);


                                    if ($query) {
                                        echo '<script>';
                                        echo "window.location='show_customer.php?do=delete';";
                                        echo '</script>';
                                    } else {
                                        echo '<script>';
                                        echo "window.location='show_customer.php?do=deleteerror';";
                                        echo '</script>';
                                    }
                                }

                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>







    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script>
        const dataTable = new simpleDatatables.DataTable("#table1", {
            "paging": false,

        })
    </script>
    <?php include('script.php'); ?>
</body>

</html>
<?php } ?>