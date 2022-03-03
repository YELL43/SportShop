<?php
session_start();
include "../Backend/conn.php";


if (isset($_SESSION["user_id"]) != "") {
    $u_id = $_SESSION['user_id'];
} else {
    $u_id = '';
}
$p_id = $_GET['p_id'];


if ($u_id == '') {
    // Header("Location: ../index.php");
    echo "<script>window.location.href='type_product.php?status=login';</script>";
} else { ?>

<?php

    $sql = "SELECT * FROM `tb_product` LEFT JOIN product_category  ON tb_product.category_id = product_category.category_id WHERE product_id = $p_id ";
    $query = $conn->query($sql);

    $p_amount =  1;

    while ($row = mysqli_fetch_array($query)) {
        $product_id = $row['product_id'];
        $product_name = $row['product_name'];
        $product_price = $row['product_price'];
        $product_inventories = $row['product_inventories'];
        $product_details = $row['product_details'];
        $product_img = $row['product_img'];
        $category_name = $row['category_name'];
        $category_id = $row['category_id'];
    }
?>

<?php
    $sql3 = "SELECT * FROM  tb_order where user_id = $u_id  and product_id = $product_id ";
    $stmt3 = $conn->query($sql3);
    if ($stmt3->num_rows <= 0) {
        $sql2 = "INSERT INTO `tb_order`( `product_name`, `product_price`,`order_img`,`user_id`,`product_amount`,`order_category`,`product_id`)
    VALUES ('" . $product_name . "',$product_price,'" . $product_img . "', $u_id , $p_amount ,'" . $category_name . "','" . $product_id . "')";
        $stmt2 = $conn->query($sql2);

        echo "<script>window.location.href='type_product.php?id=$category_id&typename=$category_name&status=yes';</script>";
    } else {
        while ($row = mysqli_fetch_array($stmt3)) {
            // $order_id  = $row['order_id '];
            $user_id = $row['user_id'];
            // $product_amount = $row['product_amount'];
            $product_price = $row['product_price'];
            $order_img = $row['order_img'];
            $product_name2 = $row['product_name'];
            $order_category = $row['order_category'];
            $product_id2 = $row['product_id'];
        }

        if ($u_id !=  $user_id  && $product_id != $product_id2) {

            $sql2 = "INSERT INTO `tb_order`( `product_name`, `product_price`,`order_img`,`user_id`,`product_amount`,`order_category`,`product_id`)
    VALUES ('" . $product_name . "',$product_price,'" . $product_img . "', $u_id , $p_amount ,'" . $category_name . "','" . $product_id . "')";
            $stmt2 = $conn->query($sql2);

            echo "<script>window.location.href='type_product.php?id=$category_id&typename=$category_name&status=yes';</script>";
        } else {
            echo "<script>window.location.href='type_product.php?id=$category_id&typename=$category_name&status=no';</script>";
        }
    }




 


} ?>