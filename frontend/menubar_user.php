<div id="app">
    <div id="sidebar" class="active">
        <div class="sidebar-wrapper active">
            <div class="sidebar-header">
                <div class="d-flex justify-content-between">
                    <div class="logo" style="margin-left:30px">
                        <a href="index.html"><img style="height: 150px; width: auto;" src="assets/images/logo/logo.png" alt="Logo"></a>
                    </div>
                    <div class="toggler">
                        <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                    </div>
                </div>
            </div>
            <div class="sidebar-menu">
                <ul class="menu">
                    <li class="sidebar-item">
                        <a href="index.php" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>หน้าหลัก</span>
                        </a>
                    </li>
                    <li class="sidebar-item  has-sub">
                        <a href="#" class="sidebar-link">
                            <i class="bi bi-map-fill"></i>
                            <span>ประเภทสินค้า</span>
                        </a>
                        <ul class="submenu">
                            <?php
                            $sql = "SELECT * FROM product_category";
                            $query = $conn->query($sql);
                            while ($row = mysqli_fetch_array($query)) {
                                $category_name = $row['category_name'];
                                $category_id = $row['category_id'];
                            ?>
                                <li class="submenu-item ">
                                    <a href="type_product.php?id=<?php echo $category_id ?>&typename=<?php echo $category_name ?>"><?php echo $category_name ?></a>
                                </li>
                            <?php } ?>

                        </ul>
                    </li>
                    <?php if ($user_id != "") { ?>

                        <li class="sidebar-item">
                            <a href="profile.php" class='sidebar-link'>
                                <i class="bi bi-person"></i>
                                <span>โปรไฟล์</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="user_cart.php" class='sidebar-link'>
                                <i class="bi bi-cart-fill"></i>
                                <span>สถานะการสั่งซื้อ</span>
                            </a>

                        </li>

                        <li class="sidebar-item clearfix mb-0 ">
                            <a class='sidebar-link' data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="bi bi-box-arrow-in-right"></i>
                                <span>ออกจากระบบ</span>
                            </a>
                        </li>


                    <?php } ?>


                </ul>
            </div>
        </div>
    </div>

</div>