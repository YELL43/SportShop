<?php
include "../Backend/conn.php";
function genorder($length = 11)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
$order_no = genorder();
if (isset($_POST['purchase'])) {
    date_default_timezone_set('Asia/Bangkok');
    $u_id = $_POST['purchase'];
    $sql = "SELECT *  FROM tb_order INNER JOIN tb_product ON tb_product.product_id = tb_order.product_id WHERE `user_id` = $u_id AND tb_product.product_inventories !=0 ";
    $querych = $conn->query($sql);

    while ($row = mysqli_fetch_array($querych)) {
        $product_name = $row['product_name'];
        $product_amount = $row['product_amount'];
        $product_price = $row['product_price'];
        $order_category = $row['order_category'];
        $user_id = $row['user_id'];
        $order_img = $row['order_img'];
        $order_date = date("Y-m-d H:i:s");
        $product_id = $row['product_id'];

        $sqli = "INSERT INTO tb_orderdetail  (order_no,product_name,order_category,total_price,order_amount,user_id,order_img,order_date) 
        VALUES
         ('$order_no','$product_name','$order_category','$product_price','$product_amount','$user_id','$order_img','$order_date')";
        $query = $conn->query($sqli);

        $selepro = "SELECT product_inventories FROM tb_product  WHERE product_id = ' $product_id' ";
        $queryselepro = $conn->query($selepro);
        $rowspro = mysqli_fetch_array($queryselepro);

        $prod = $rowspro[0] - $product_amount;
        $updatepro = "UPDATE tb_product SET product_inventories =  $prod WHERE product_id = ' $product_id'";
        $queryupdatepro = $conn->query($updatepro);
    }
    if ($queryupdatepro) {
        $sqlsum = "SELECT sum(tb_order.product_price * tb_order.product_amount)  as sum FROM tb_order  INNER JOIN tb_product ON tb_product.product_id = tb_order.product_id WHERE `user_id` = $u_id AND tb_product.product_inventories !=0";
        $querysum = $conn->query($sqlsum);
        $rows = mysqli_fetch_array($querysum);
        $sql = "INSERT INTO tb_payment (user_id,order_no,total_payment)VALUES('$u_id','$order_no','$rows[0]')";
        $querypay = $conn->query($sql);
        if ($querypay) {

            $sql = "DELETE FROM tb_order WHERE user_id = $u_id";
            $querydel = $conn->query($sql);
            echo "<script>                                       
                window.location.href='user_cart.php';
             </script>";
        }
    }
}
