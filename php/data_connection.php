<?php
    $serverName = "localhost";
    $userName = "root";
    $passwd = "";
    $data_name = "book_data";

    try {
        $con = new PDO("mysql:host=$serverName;dbname=$data_name", $userName, $passwd);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        echo "Connection failed : ". $e->getMessage();
    }
?>