<?php
    session_start();

    if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])){

        include "./data_connection.php";

        if (isset($_POST['category'])){
            $name = $_POST['category'];
            if (empty($name)){
                $em = "The category name is required";
                header("Location: ../add_category.php?error=$em");
                exit;
            }else{
                $sql = "INSERT INTO category (name) VALUES (?)";
                $statement = $con->prepare($sql);
                $res = $statement->execute([$name]);

                if ($res){
                    $sm = "Completed Make";
                    header("Location: ../add_category.php?success=$sm");
                    exit;
                }else{
                    $em = "The category name is required";
                    header("Location: ../add_category.php?error=$em");
                    exit;
                }
            }
        }else{
            header("Location: ../admin.php");
            exit;
        }
    }else{
        header("Location: login.php");
        exit;
    }
?>