<?php 

    error_reporting( ~E_DEPRECATED & ~E_NOTICE );

    $localhost = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "cr11_edinamuray_petadoption";

    $connect = new mysqli($localhost, $username, $password, $dbname);

    if($connect->connect_error) {
        die("connection failed: " . $connect->connect_error);
    } else {
        //echo "Successfully Connected";
    }

?>