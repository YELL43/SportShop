<!DOCTYPE html>
<html lang="en">
<?php include "Backend/conn.php"; ?>

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Register</title>

    <!-- Icons font CSS-->
    <link href="register/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="register/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="register/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="register/vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="register/css/main.css" rel="stylesheet" media="all">
    <link rel="stylesheet" type="text/css" href="login_v2/css/util.css">
    <link rel="stylesheet" type="text/css" href="login_v2/css/main.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

    <?php
    if (@$_GET['do'] == 'success') {
        echo '<script type="text/javascript">
					Swal.fire(
						"",
						"สมัครสมาชิกเรียบร้อย",
						"success"
					  )
                </script>';
        echo '<meta http-equiv="refresh" content="2;url=index.php" />';
    } elseif (@$_GET['do'] == 'error') {
        echo '<script type="text/javascript">
					Swal.fire(
						"",
						"ชื่อผู้ใช้ หรือ อีเมลซํ้า",
						"error"
					  )
                </script>';
        echo '<meta http-equiv="refresh" content="2;url=register.php" />';
    }



    ?>



    <div class="container-login100" style="background-image: url('login_v2/images/388356.jpg');">
        <div class="wrapper wrapper--w680">
            <div class="card card-4">
                <div class="card-body">
                    <h2 align=center class="title">ลงทะเบียนสมัครสมาชิก</h2>
                    <form method="POST">
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">ชื่อ</label>
                                    <input class="input--style-4" type="text" name="user_firstname" required>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">นามสกุล</label>
                                    <input class="input--style-4" type="text" name="user_lastname" required>
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">อีเมล</label>
                                    <input class="input--style-4" type="email" name="user_email" required>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">เบอร์โทรศัพท์</label>
                                    <input class="input--style-4" type="text" name="user_phone" required>
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">ชื่อผู้ใช้</label>
                                    <input class="input--style-4" type="text" name="user_username" required>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">รหัสผ่าน</label>
                                    <input class="input--style-4" type="password" name="user_password" required>
                                </div>
                            </div>
                        </div>

                        <div class="input-group">
                            <label class="address">ที่อยู่</label>
                            <input class="input--style-4" type="text" name="user_address" required>
                        </div>

                        <div align=center class="p-t-15">
                            <button class="btn btn--radius-2 btn--blue" type="submit" name="submit">สมัครสมาชิก</button><br>
                            <br>
                            <a href="index.php" style="color:orange">กลับสู่หน้าหลัก</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <?php
    if (isset($_POST['submit'])) {
        echo  $user_firstname = $_POST['user_firstname'];
        echo  $user_lastname = $_POST['user_lastname'];
        echo  $user_email = $_POST['user_email'];
        echo   $user_phone = $_POST['user_phone'];
        echo  $user_username = $_POST['user_username'];
        echo  $user_password = $_POST['user_password'];
        echo  $user_address = $_POST['user_address'];

        $sql = "SELECT * FROM tb_user WHERE user_username = '$user_username' or user_email='$user_email'";
        $query = $conn->query($sql);
        if ($query->num_rows >= 1) {
            echo '<script>';
            echo "window.location='register.php?do=error';";
            echo '</script>';
        } else {

            $sql = "INSERT INTO tb_user(user_firstname,user_lastname,user_email,user_phone,user_username,user_password,user_address)
            VALUES('$user_firstname', '$user_lastname', '$user_email','$user_phone','$user_username', '$user_password','$user_address')";
            $query = $conn->query($sql);
            echo '<script>';
            echo "window.location='register.php?do=success';";
            echo '</script>';
        }
    }
    ?>








    <!-- Jquery JS-->
    <script src="register/vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="register/vendor/select2/select2.min.js"></script>
    <script src="register/vendor/datepicker/moment.min.js"></script>
    <script src="register/vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="register/js/global.js"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->