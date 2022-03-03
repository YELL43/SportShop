<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<?php include "Backend/conn.php"; ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Mazer Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="assets/css/pages/auth.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

    <?php
    if (@$_GET['do'] == 'error') {
        echo '<script type="text/javascript">
					Swal.fire(
						"",
						"ชื่อผู้ใช้ หรือ รหัสผ่านไม่ถูกต้อง",
						"error"
					  )
                </script>';
        echo '<meta http-equiv="refresh" content="2;url=login.php" />';
    }

    ?>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <!-- <div class="auth-logo">
                        <a href="index.html"><img src="assets/images/logo/logo.png" alt="Logo"></a>
                    </div> -->
                    <br><br>
                    <p class="auth-subtitle mb-5" style="color:black;">ฮาซิมสปอร์ต (HASIM SPORT)</p><br>
                    <form method="post">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl" name="user_username" placeholder="Username">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left">
                            <input type="password" class="form-control form-control-xl" name="user_password" placeholder="Password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>


                        <button type="submit" name="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">เข้าสู่ระบบ</button>
                        <a href="register.php" class="btn btn-primary btn-block btn-lg shadow-lg mt-2">สมัครสมาชิก</a>

                        <!-- <p align=center style="margin-top: 5px;"><a href="register.php" style="color:orange">สมัครสมาชิก</a></p> -->


                    </form>


                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">

                <img src="login_v2/images/388356.jpg" class="img-fluid" id="auth-right" />

                </img>
            </div>
        </div>

    </div>
    <?php
    if (isset($_POST['submit'])) {
        $user_username = mysqli_real_escape_string($conn, $_POST['user_username']);
        $user_password = mysqli_real_escape_string($conn, $_POST['user_password']);
        $sql = "SELECT * FROM tb_user WHERE user_username = '$user_username' and user_password = '$user_password'";
        $query = $conn->query($sql);
        if ($query->num_rows >= 1) {
            while ($row = mysqli_fetch_array($query)) {
                $user_id = $row['user_id'];
                $user_fullname = $row['user_firstname'] . ' ' . $row['user_lastname'];
                $user_status = $row['user_status'];

                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_fullname'] = $user_fullname;
                $_SESSION['user_status'] = $user_status;
            }
            if ($_SESSION["user_status"] == "admin") {
                header("location:Backend/index.php");
            } else if ($_SESSION["user_status"] == "employer") {
                header("location:Backend/Employee/index.php");
            } else if ($_SESSION["user_status"] == "member") {
                header("location:frontend/index.php");
            }
        } else {
            echo '<script>';
            echo "window.location='login.php?do=error';";
            echo '</script>';
        }
    }
    ?>
</body>

</html>