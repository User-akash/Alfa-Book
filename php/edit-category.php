<?php
    session_start();

    if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])){

        include "./data_connection.php";

        if (isset($_POST['category_name']) &&
            isset($_POST['category_id']))
            {
            $name = $_POST['category_name'];
            $id = $_POST['category_id'];
            if (empty($name)){
                $em = "The category name is required";
                header("Location: ../edit_category.php?error=$em&id=$id");
                exit;
            }else{
                $sql = "UPDATE category SET name=? WHERE id=?";
                $statement = $con->prepare($sql);
                $res = $statement->execute([$name, $id]);

                if ($res){
                    $sm = "Success Up To Date";
                    header("Location: ../edit_category.php?success=$sm&id=$id");
                    exit;
                }else{
                    $em = "The category name is required";
                    header("Location: ../edit_category.php?error=$em&id=$id");
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