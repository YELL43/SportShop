<?php
include "../Backend/conn.php";

if (isset($_POST['submit'])) {

    $amount = $_POST['quantity'];
    $order_id = $_POST['submit'];

    $sql = "UPDATE `tb_order` SET `product_amount`=  $amount  WHERE order_id =  $order_id ";
    $stmt = $conn->query($sql);

    echo "<script>                                       
            window.location.href='mycart.php';
         </script>";
}

if (isset($_POST['delc'])) {

    $order_id = $_POST['delc'];

    $sql = "DELETE FROM `tb_order` WHERE  order_id =  $order_id ";
    $stmt = $conn->query($sql);

    echo "<script>                                       
            window.location.href='mycart.php';
         </script>";
}
