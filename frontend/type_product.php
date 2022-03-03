<?php error_reporting(0); ?>
<!DOCTYPE html>
<html lang="en">

<head>

     <?php include('header.php'); ?>
</head>
<?php include('menubar_user.php'); ?>
<?php include "../Backend/conn.php"; ?>

<body>
     <?php
     if (@$_GET['status'] == 'yes') {
          echo '<script type="text/javascript">
					Swal.fire(
						"",
						"เพิ่มสินค้าลงในตะกร้าเรียบร้อย",
						"success"
					  )
                </script>';
          echo '<meta http-equiv="refresh" content="2;url=type_product.php?id=' . $_GET['id'] . '&typename=' . $_GET['typename'] . '"/>';
     } else if (@$_GET['status'] == 'no') {

          echo '<script type="text/javascript">
					Swal.fire(
						"",
						"มีสินค้าในตะกร้าอยู่แล้ว",
						"warning"
					  )
                </script>';
          echo '<meta http-equiv="refresh" content="2;url=type_product.php?id=' . $_GET['id'] . '&typename=' . $_GET['typename'] . '"/>';
     } else if (@$_GET['status'] == 'login') {

          echo '<script type="text/javascript">
					Swal.fire(
						"",
						"กรุณา Login เข้าสู่ระบบ",
						"warning"
					  )
                </script>';
          echo '<meta http-equiv="refresh" content="2;url=../login.php"/>';
     }

     ?>



     <div id="main">

          <div class="page-content">
               <section class="row">
                    <div class="col-12 col-lg-12 ">
                         <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                              <ol class="carousel-indicators">
                                   <li data-bs-target="#carouselExampleFade" data-bs-slide-to="0" class="active"></li>
                                   <li data-bs-target="#carouselExampleFade" data-bs-slide-to="1"></li>
                                   <li data-bs-target="#carouselExampleFade" data-bs-slide-to="2"></li>
                              </ol>
                              <div class="carousel-inner">
                                   <div class="carousel-item active">
                                        <img src="img/bg1.jpg" class="d-block w-100" alt="...">
                                        <!-- <div class="carousel-caption d-none d-md-block">
                                    <h5>First slide label</h5>
                                    <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                                </div> -->
                                   </div>
                                   <div class="carousel-item">
                                        <img src="img/bg2.jpg" class="d-block w-100" alt="...">
                                        <!-- <div class="carousel-caption d-none d-md-block">
                                    <h5>Second slide label</h5>
                                    <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                                </div> -->
                                   </div>
                                   <div class="carousel-item">
                                        <img src="img/bg3.jpg" class="d-block w-100" alt="...">
                                        <!-- <div class="carousel-caption d-none d-md-block">
                                    <h5>Third slide label</h5>
                                    <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                                </div> -->
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



                         <nav aria-label="breadcrumb">
                              <ol class="breadcrumb">
                                   <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                   <li class="breadcrumb-item active" aria-current="page"> <?php echo $_GET['typename']; ?></li>
                              </ol>
                         </nav>



                         <div class="row">
                              <div align="center" class="col-12">
                                   <div class="badge bg-primary text-wrap fs-4 mb-4" style="width: 14rem;">
                                        <?php echo $_GET['typename']; ?>
                                   </div>
                              </div>
                         </div>
                         <div class="row">
                              <?php
                              if (isset($_GET['id'])) {
                                   $typeid = $_GET['id'];



                                   $sql = "SELECT * FROM tb_product  LEFT JOIN product_category  ON tb_product.category_id = product_category.category_id where tb_product.category_id=$typeid";
                                   $query = $conn->query($sql);
                                   while ($row = mysqli_fetch_array($query)) {
                                        $product_id = $row['product_id'];
                                        $product_name = $row['product_name'];
                                        $product_price = $row['product_price'];
                                        $product_inventories = $row['product_inventories'];
                                        $product_details = $row['product_details'];
                                        $product_img = $row['product_img'];
                                        $category_name = $row['category_name'];


                              ?>

                                        <div class="col-lg-3 col-md-6  col-6">
                                             <div class="card px-1 shadow-lg">
                                                  <div class="card-body  d-flex justify-content-center">
                                                       <img src="../Backend/upload/type_sport/<?php echo $category_name ?>/<?php echo $product_img ?>" width="auto" height="180px">
                                                  </div>
                                                  <small class="fw-light text-end "> <?php if ($product_inventories <= 0 || "") {
                                                                                          echo "<span class='text-danger'>สินค้าหมดชั่วคราว!!</span>";
                                                                                     } else {
                                                                                          echo "คงเหลือ ";
                                                                                          echo $product_inventories;
                                                                                          echo " ชิ้น";
                                                                                     } ?></small>
                                                  <div class="card-footer">
                                                       <div class="row">
                                                            <div class="col-6 text-start">
                                                                 <h6 style="font-size:15px"><?php echo $product_name ?></h6>
                                                            </div>
                                                            <div class="col-6 text-end">
                                                                 <span class="badge bg-danger mb-2 text-start"><?php echo $product_price ?> ฿</span>
                                                            </div>
                                                            <?php if ($product_inventories <= 0 || "") { ?>
                                                                 <button type="button" class="btn btn-secondary " disabled><i class="bi bi-cart4"></i>&nbsp;สินค้าหมด</button>

                                                            <?php } else { ?>
                                                                 <a href="dataadd_cart.php?p_id=<?php echo  $product_id ?>" type="button" class="btn btn-success"><i class="bi bi-cart4"></i>&nbsp;ซื้อสินค้า</a>
                                                            <?php   } ?>

                                                       </div>
                                                  </div>
                                             </div>
                                        </div>

                                        <!-- <div class="col-6 col-lg-3 col-md-3">
                                             <div class="card border shadow p-6 mb-6">
                                                  <div class="card-body px-3 py-4-5">
                                                       <div class="row">
                                                            <img src="../Backend/upload/type_sport/<?php echo $category_name ?>/<?php echo $product_img ?>" width="200px" height="220px">
                                                       </div>
                                                       


                                                  </div>
                                             </div>
                                        </div> -->
                                   <?php
                                   }
                                   ?>
                         </div>
                    <?php } else { ?>
                         <div class="row">

                              <div style="margin-left: 20px;" class="alert alert-danger col-12 lg-12" role="alert">
                                   ไม่มีสินค้า
                              </div>

                         </div>




                    <?php    } ?>



                    </div>

               </section>
          </div>

     </div>

     <?php include('script.php'); ?>
</body>



<!--เมนูแนะนำ-->
<style>
     /*slider Menu*/


     .clearfix:before,
     .clearfix:after {
          content: "";
          display: table;
     }

     .clearfix:after {
          clear: both;
     }

     .carousel {
          width: 1150px;
          margin: 30px auto;
     }


     .carousel .box {
          float: left;
          width: 33%;
     }

     /* prev -- next */
     .slick-prev,
     .slick-next {
          background: url(../arrows.png);

          width: 22px;
          height: 33px;
          position: absolute;
          top: 50%;
          display: block;
          padding: 0;
          cursor: pointer;

          color: transparent;
          border: none;
          outline: none;
          z-index: 100;
     }

     .slick-prev {
          background-position: 0px;
          left: 0px;
     }

     .slick-next {
          background-position: -22px;
          right: 0px;
     }



     @media only screen and (max-width: 1180px) {
          .carousel {
               width: 90%;
          }
     }

     /* MENU NEW */
     .box .card {
          margin: 15px;
          margin-left: 70px;
          margin-bottom: 70px;
          width: 250px;
          height: 350px;
          box-shadow: 0 5px 10px 1px;
          border-radius: 8px;
          overflow: hidden;
          transition: 0.2s linear;
          background-color: white;
     }

     .box .card:hover {
          transform: translateY(-5px);
          box-shadow: 0 8px 10px 1px;
     }

     .box .card .image {
          overflow: hidden;
          margin: auto;
          width: 200px;
          height: 290px;
          padding: 0;
          background-position: center;
          background-size: cover;
     }

     .product {
          display: flex;
          justify-content: space-between;
          align-items: center;
          height: 30px;
     }

     .product .product-name {
          padding-left: 10px;
          font-weight: bold;
     }

     .product .product-author {
          padding-right: 10px;
          font-size: 0.8rem;
          font-style: italic;
          color: grey;
          cursor: pointer;
     }

     .product .product-author:hover {
          text-decoration: underline;
     }

     .card .product-rating {
          display: flex;
          justify-content: flex-start;
          align-items: center;
          height: 20px;
     }

     .card .product-rating i:nth-child(1) {
          padding-left: 10px;
     }

     .card .product-rating i:nth-child(-n+4) {
          color: red;
     }



     .card .description p {
          display: flex;
          align-items: center;
          margin: 0;
          padding: 5px 10px 0 10px;
          font-size: 0.8rem;
          height: 50px;
     }

     .card .price {
          display: flex;
          justify-content: space-between;
          align-items: center;
          height: 50px;
     }



     .card .price div .now-price {
          margin-left: 10px;
          padding: 5px 10px;
          font-weight: bold;
          background-color: red;
          color: white;
          border-radius: 5px;
     }

     .card .price button {
          margin-bottom: 3px;
          margin-right: 10px;
          padding: 2px 10px;
          border: 1px solid green;
          border-radius: 5px;
          background-color: green;
          color: white;
          box-shadow: 0 0 2px 1px green;
          transition: 0.25s;
     }

     .card .price button:hover {
          box-shadow: 0 0 10px 1px skyblue;
     }


     @media only screen and (max-width: 900px) {
          .box {
               flex-wrap: wrap;
          }
     }

     @media only screen and (max-width: 600px) {
          .box .card {
               margin: 10px;
               width: 170px;
               height: 250px;

               border-radius: 8px;
               overflow: hidden;
               font-size: 12px;
               margin-top: 10px;
               margin-bottom: 50px;
          }

          .box .card .image {
               overflow: hidden;
               margin: auto;
               width: 170px;
               height: 200px;
               padding: 0;
               background-position: center;
               background-size: cover;
          }

          .card .price {
               display: flex;
               justify-content: space-between;
               align-items: center;
               height: 50px;

          }

          .card .price div .now-price {
               margin-left: 10px;
               padding: 5px;
               font-weight: bold;
               background-color: red;
               color: white;
               border-radius: 5px;
               font-size: 12px;
          }

          .card .price button {
               margin-bottom: 3px;
               margin-right: 10px;
               padding: 5px 10px;
               border: 1px solid black;
               border-radius: 5px;
               background-color: black;
               color: white;
               box-shadow: 0 0 2px 1px black;
               transition: 0.25s;
          }


     }
</style>
<!--Search-->
<style>
     .field-container {
          position: relative;
          padding: 0;
          margin: 0;
          border: 0;
          width: 330px;
          height: 40px;
     }

     .icons-container {
          position: absolute;
          top: 5px;
          right: -2px;
          width: 35px;
          height: 35px;
          overflow: hidden;
     }

     .icon-close {
          position: absolute;
          top: 2px;
          left: 2px;
          width: 75%;
          height: 75%;
          opacity: 0;
          cursor: pointer;
          transform: translateX(-200%);
          border-radius: 50%;
          transition: opacity 0.25s ease, transform 0.43s cubic-bezier(0.694, 0.048, 0.335, 1);
     }

     .icon-close:before {
          content: "";
          border-radius: 50%;
          position: absolute;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          opacity: 0;
          border: 2px solid transparent;
          border-top-color: #6078EA;
          border-left-color: #6078EA;
          border-bottom-color: #6078EA;
          transition: opacity 0.2s ease;
     }

     .icon-close .x-up {
          position: relative;
          width: 100%;
          height: 50%;
     }

     .icon-close .x-up:before {
          content: "";
          position: absolute;
          bottom: 2px;
          left: 3px;
          width: 50%;
          height: 2px;
          background-color: #6078EA;
          transform: rotate(45deg);
     }

     .icon-close .x-up:after {
          content: "";
          position: absolute;
          bottom: 2px;
          right: 0px;
          width: 50%;
          height: 2px;
          background-color: #6078EA;
          transform: rotate(-45deg);
     }

     .icon-close .x-down {
          position: relative;
          width: 100%;
          height: 50%;
     }

     .icon-close .x-down:before {
          content: "";
          position: absolute;
          top: 5px;
          left: 4px;
          width: 50%;
          height: 2px;
          background-color: #6078EA;
          transform: rotate(-45deg);
     }

     .icon-close .x-down:after {
          content: "";
          position: absolute;
          top: 5px;
          right: 1px;
          width: 50%;
          height: 2px;
          background-color: #6078EA;
          transform: rotate(45deg);
     }

     .is-type .icon-close:before {
          opacity: 1;
          -webkit-animation: spin 0.85s infinite;
          animation: spin 0.85s infinite;
     }

     .is-type .icon-close .x-up:before,
     .is-type .icon-close .x-up:after {
          -webkit-animation: color-1 0.85s infinite;
          animation: color-1 0.85s infinite;
     }

     .is-type .icon-close .x-up:after {
          -webkit-animation-delay: 0.3s;
          animation-delay: 0.3s;
     }

     .is-type .icon-close .x-down:before,
     .is-type .icon-close .x-down:after {
          -webkit-animation: color-1 0.85s infinite;
          animation: color-1 0.85s infinite;
     }

     .is-type .icon-close .x-down:before {
          -webkit-animation-delay: 0.2s;
          animation-delay: 0.2s;
     }

     .is-type .icon-close .x-down:after {
          -webkit-animation-delay: 0.1s;
          animation-delay: 0.1s;
     }

     .icon-search {
          position: relative;
          top: 5px;
          left: 8px;
          width: 50%;
          height: 50%;
          opacity: 1;
          border-radius: 50%;
          border: 3px solid #c7d0f8;
          transition: opacity 0.25s ease, transform 0.43s cubic-bezier(0.694, 0.048, 0.335, 1);
     }

     .icon-search:after {
          content: "";
          position: absolute;
          bottom: -9px;
          right: -2px;
          width: 4px;
          border-radius: 3px;
          transform: rotate(-45deg);
          height: 10px;
          background-color: #c7d0f8;
     }

     .field {
          border: 0;
          width: 100%;
          height: 100%;
          padding: 10px 20px;
          background: white;
          border-radius: 3px;
          box-shadow: 0px 8px 15px rgba(75, 72, 72, 0.1);
          transition: all 0.4s ease;
     }

     .field:focus {
          outline: none;
          box-shadow: 0px 9px 20px rgba(75, 72, 72, 0.3);
     }

     .field:focus+.icons-container .icon-close {
          opacity: 1;
          transform: translateX(0);
     }

     .field:focus+.icons-container .icon-search {
          opacity: 0;
          transform: translateX(200%);
     }
</style>



</html>