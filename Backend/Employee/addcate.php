<?php
include "conn.php";

if (isset($_POST['submit'])) {

    $category_name = $_POST['category_name'];
    $sql = "SELECT * FROM product_category WHERE category_name = '$category_name'";
    $resulchk = $conn->query($sql);
    if ($resulchk->num_rows < 1) {
        if (!is_dir("../upload/type_sport/" . $category_name . "/")) {

            mkdir("../upload/type_sport/" . $category_name . "/");

            $sql = "INSERT INTO product_category (category_name)  VALUES ('" . $category_name . "')";
            $result = $conn->query($sql);
            if ($result) {
                echo '<script>';
                echo "window.location='add_categ.php?do=success';";
                echo '</script>';
            } else {
                echo '<script>';
                echo "window.location='add_categ.php?do=error';";
                echo '</script>';
            }
        }
    } else {
        echo ('หมวดหมู่ซ้ำ');
    }
}
