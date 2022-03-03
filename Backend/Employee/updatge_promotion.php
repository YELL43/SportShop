<!DOCTYPE html>
<html lang="en">

<?php include('header.php'); ?>
<?php
include('conn.php');
if ($_SESSION["user_status"] != 'employer') {  //check session

    Header("Location: ../../error-404.php"); //ไม่พบผู้ใช้กระโดดกลับไปหน้า login form 

} else { ?>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>employee</title>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <?php include "conn.php"; ?>

    </head>
    <?php include('menubar.php'); ?>

    <script>
        function previewFile1() {
            const preview = document.querySelector('#img1');

            const file = document.querySelector('input[id=formFile1]').files[0];
            const reader = new FileReader();

            reader.addEventListener("load", function() {
                // convert image file to base64 string
                preview.src = reader.result;
            }, false);

            if (file) {
                reader.readAsDataURL(file);
            }
        }

        function previewFile2() {
            const preview = document.querySelector('#img2');
            const file = document.querySelector('input[id=formFile2]').files[0];
            const reader = new FileReader();

            reader.addEventListener("load", function() {
                // convert image file to base64 string
                preview.src = reader.result;
            }, false);

            if (file) {
                reader.readAsDataURL(file);
            }
        }

        function previewFile3() {
            const preview = document.querySelector('#img3');
            const file = document.querySelector('input[id=formFile3]').files[0];
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
            echo '<meta http-equiv="refresh" content="2;url=updatge_promotion.php" />';
        } elseif (@$_GET['do'] == 'error') {
            echo '<script type="text/javascript">
					Swal.fire(
						"",
						"บันทึกข้อมูลไม่สำเร็จ",
						"error"
					  )
                </script>';
            echo '<meta http-equiv="refresh" content="2;url=updatge_promotion.php" />';
        }

        ?>

        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            <div class="page-heading">
                <h3></h3>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="col-12 col-lg-12 ">
                        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-bs-target="#carouselExampleFade" data-bs-slide-to="0" class="active"></li>
                                <li data-bs-target="#carouselExampleFade" data-bs-slide-to="1"></li>
                                <li data-bs-target="#carouselExampleFade" data-bs-slide-to="2"></li>
                            </ol>
                            <?php
                            $sql = "SELECT * FROM tb_image";
                            $query = $conn->query($sql);
                            while ($rows = mysqli_fetch_array($query)) {
                                $img1 = $rows['image_name1'];
                                $img2 = $rows['image_name2'];
                                $img3 = $rows['image_name3'];
                            }

                            ?>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img id="img" src="../../frontend/img/<?= $img1 ?>" class="d-block w-100" alt="...">

                                </div>
                                <div class="carousel-item">
                                    <img id="img" src="../../frontend/img/<?= $img2 ?>" class="d-block w-100" alt="...">

                                </div>
                                <div class="carousel-item">
                                    <img id="img" src="../../frontend/img/<?= $img3 ?>" class="d-block w-100" alt="...">

                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </a>

                        </div>

                    </div>
                    <h5 class="mt-4">แก้ไขรูปโฆษนา </h5>

                    <div class="col-12 col-lg-6">
                        <div class=" card">
                            <div class="row">
                                <form method="post" enctype="multipart/form-data">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label">รูปที่ 1 &nbsp;</label>

                                            <input type="hidden" value="<?= $img1 ?>" name="oldimg1">
                                            <img id="img1" src="../../frontend/img/<?= $img1 ?>" width="300px">


                                            <input class="form-control" onchange="previewFile1()" type="file" id="formFile1" name="image_name1" value="<?= $img1 ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">รูปที่ 2 &nbsp;</label>
                                            <img id="img2" src="../../frontend/img/<?= $img2 ?>" width="300px" height="auto">

                                            <input type="hidden" value="<?= $img2 ?>" name="oldimg2">
                                            <input class="form-control" onchange="previewFile2()" type="file" id="formFile2" name="image_name2" value="<?= $img2 ?>">
                                        </div>
                                        <div class=" mb-3">
                                            <label class="form-label">รูปที่ 3 &nbsp;</label>
                                            <img id="img3" src="../../frontend/img/<?= $img3 ?>" width="300px">

                                            <input type="hidden" value="<?= $img3 ?>" name="oldimg3">

                                            <input class="form-control" onchange="previewFile3()" type="file" id="formFile3" name="image_name3" value="<?= $img3 ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">หมายเหตุ<span style="color:red;">*</span>ขนาดรูปโฆษนา : กว้าง 1930 x สูง 430 px</label>

                                        </div>

                                        <div class=" d-grid gap-2 d-md-flex justify-content-md-end">
                                            <button class="btn btn-primary btn-xl" type="submit" name="submit">SAVE</button>
                                        </div>

                                    </div>
                                </form>
                                <?php if (isset($_POST['submit'])) {

                                    $upload1 = $_FILES['image_name1']['name'];
                                    $upload2 = $_FILES['image_name2']['name'];
                                    $upload3 = $_FILES['image_name3']['name'];
                                    $oldimg1 = $_POST['oldimg1'];
                                    $oldimg2 = $_POST['oldimg2'];
                                    $oldimg3 = $_POST['oldimg3'];
                                    $path = "../../frontend/img/";

                                    if ($upload1 != '') {
                                        $type1 = strrchr($upload1, ".");
                                        $newname1 = $upload1 . $type1;
                                        $path_copy1 = $path . $newname1;
                                        move_uploaded_file($_FILES['image_name1']['tmp_name'], $path_copy1);
                                    } else {
                                        $newname1 = $oldimg1;
                                    }
                                    if ($upload2 != '') {
                                        $type1 = strrchr($upload2, ".");
                                        $newname2 = $upload2 . $type1;
                                        $path_copy2 = $path . $newname2;
                                        move_uploaded_file($_FILES['image_name2']['tmp_name'], $path_copy2);
                                    } else {
                                        $newname2 = $oldimg2;
                                    }
                                    if ($upload3 != '') {
                                        $type3 = strrchr($upload3, ".");
                                        $newname3 = $upload3 . $type3;
                                        $path_copy3 = $path . $newname3;
                                        move_uploaded_file($_FILES['image_name3']['tmp_name'], $path_copy3);
                                    } else {
                                        $newname3 = $oldimg3;
                                    }


                                    $updatepay = "UPDATE tb_image SET image_name1 = '$newname1' , image_name2 = '$newname2' ,image_name3 = '$newname3' WHERE img_id = 1";
                                    $queryup = $conn->query($updatepay);



                                    if ($queryup) {
                                        echo '<script>';
                                        echo "window.location='updatge_promotion.php?do=success';";
                                        echo '</script>';
                                    } else {
                                        echo '<script>';
                                        echo "window.location='updatge_promotion.php?do=error';";
                                        echo '</script>';
                                    }
                                }
                                ?>

                            </div>

                        </div>


                    </div>


                </section>


            </div>
        </div>
        <?php include('script.php'); ?>
    </body>

</html>
<?php } ?>