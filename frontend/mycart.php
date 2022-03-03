<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการข้อมูลผู้ใช้</title>
    <?php include('header.php'); ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js "></script>
</head>
<?php include('menubar_user.php'); ?>
<?php include "../Backend/conn.php";
$u_id = $user_id;
$sqls = "SELECT sum(tb_order.product_amount * tb_order.product_price) as 'sum' FROM `tb_order` INNER JOIN tb_product ON tb_product.product_id = tb_order.product_id where user_id = $u_id AND tb_product.product_inventories !=0 ";
$querys = $conn->query($sqls);
while ($row = mysqli_fetch_array($querys)) {
    $sumall = $row['sum'];
}

?>

<body>
    <div id="main">

        <div class="page-heading">
            <h3>MY CART</h3>
        </div>
        <div class="page-content">
            <section class="row">
                <div class="col-12 col-lg-12">


                    <div class="row">
                        <div class="col-lg-9 ">
                            <div class="card">
                                <div class="card-header">
                                    <h4>สินค้า</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-lg">
                                            <thead>
                                                <tr>
                                                    <th>Serial No.</th>
                                                    <th>ชื่อสินค้า</th>
                                                    <th>ราคา</th>
                                                    <th>จำนวน</th>
                                                    <th>ราคารวม</th>
                                                    <th>ยกเลิก</th>
                                                    <th></th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = "SELECT *,sum(tb_order.product_amount * tb_order.product_price) as 'sum' FROM `tb_order` INNER JOIN tb_product ON tb_product.product_id = tb_order.product_id where user_id = $u_id AND tb_product.product_inventories !=0 GROUP by `order_id`;";
                                                $query = $conn->query($sql);
                                                while ($row = mysqli_fetch_array($query)) {
                                                    $order_id  = $row['order_id'];
                                                    $user_id = $row['user_id'];
                                                    $product_amount = $row['product_amount'];
                                                    $product_price = $row['product_price'];
                                                    $order_img = $row['order_img'];
                                                    $product_name = $row['product_name'];
                                                    $order_category = $row['order_category'];
                                                    $product_id = $row['product_id'];
                                                    $sum = $row['sum'];
                                                    $stroage = $row['product_inventories'];
                                                ?>
                                                    <tr>
                                                        <td > <img src="../Backend/upload/type_sport/<?php echo $order_category ?>/<?php echo $order_img ?>" width="auto" height="180px"></td>
                                                        <td width="10px" ><?php echo $product_name ?></td>
                                                        <td  width="10px"  ><?php echo $product_price ?></td>
                                                        <td>
                                                            <form action="update_cart.php" method="post">
                                                                <button onclick="this.parentNode.querySelector('input[type=number]').stepDown(); " type="submit" value="<?php echo $order_id ?>" name="submit" class="btn btn-danger btn-sm"><i class="bi bi-dash"></i></button>
                                                                <input class="quantity" min="1" max="<?php echo $stroage ?>" name="quantity" value="<?php echo $product_amount; ?>" type="number" readonly >
                                                                <button onclick="this.parentNode.querySelector('input[type=number]').stepUp(); " type="submit" value="<?php echo $order_id ?>" name="submit" class="btn btn-success btn-sm"><i class="bi bi-plus"></i></button>
                                                        </td>
                                                        <td><?php echo $sum ?></td>
                                                        <td> <button type="submit" value="<?php echo $order_id ?>" name="delc" class="btn btn-danger btn-sm">ลบ</button></td>
                                                        </form>
                                                    </tr>
                                                <?php }  ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="card border border-2">
                                <div class="card-header">
                                    <h4>ราคารวมทั้งหมด</h4>
                                </div>
                                <div class="card-body">
                                    <h5 class="text-end" id="gtotal"><?php echo  $sumall ?> บาท</h5>
                                    <br>

                                    <form action="confirmcart.php" method="POST">
                                        <button onclick="return confirm('ยืนยันการสั่งซื้อหรือไม่')" type="submit" name="purchase" class="btn btn-primary btn-block" value="<?php echo $u_id ?>">ยืนยันการสั่งซื้อ</button>
                                    </form>

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