<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST['purchase'])) {

        // $Order_Id=mysqli_insert_id($con);
        $query = "INSERT INTO ` ` (`Order_Id`,`Item_Name`,`Price`,`Quantity`) VALUES (,,,)";
        // $stmt=mysqli_prepare($conm $query);
        if ($stmt) {

            mysqli_stmt_bind_param($stmt, "list", $Order_Id, $Item_Name, $Price, $Quantity);
            foreach ($_SESSION['cart'] as $key => $values) {
                $Item_Name = $values['Item_Name'];
                $Price = $values['Price'];
                $Quantity = $values['Quantity'];
                mysqli_stmt_execute($stmt);
            }
            unset($_SESSION['cart']);
            echo "<script>
           alert('SQL Query Prepare Error');
            window.location.href='index.php';
            </script>";
        } else {
        }
    }
}
