<?php 
        $conn = new mysqli("localhost","root","","db_sportcart");    

        if ($conn) {
        }else{
            echo "Connection Failed";
            exit();
        }
?>