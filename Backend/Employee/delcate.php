<?php
include "conn.php";

if (isset($_GET['cate_id'])) {
    $category_name = $_GET['cate_id'];
    function deletefile($path)
    {
        if ($handle = opendir($path)) {
            $array = array();
            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != "..") {

                    if (is_dir($path . $file)) {
                        if (!@rmdir($path . $file)) // Empty directory? Remove it
                        {
                        }
                    } else {
                        @unlink($path . $file);
                    }
                }
            }
            closedir($handle);

            @rmdir($path);
        }
    }
    $sql = "DELETE FROM product_category  WHERE category_name = '$category_name'";
    $resulchk = $conn->query($sql);
    if ($resulchk) {
        $path = "../upload/type_sport/" . $category_name . "/";
        deletefile($path);

            echo '<script>';
            echo "window.location='add_categ.php?do=delete';";
            echo '</script>';
        


    }
}
