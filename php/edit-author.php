<?php
    session_start();

    if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])){

        include "./data_connection.php";

        if (isset($_POST['author_name']) &&
            isset($_POST['author_id']))
            {
            $name = $_POST['author_name'];
            $id = $_POST['author_id'];
            if (empty($name)){
                $em = "The author name is required";
                header("Location: ../edit_auths.php?error=$em&id=$id");
                exit;
            }else{
                $sql = "UPDATE author SET name=? WHERE id=?";
                $statement = $con->prepare($sql);
                $res = $statement->execute([$name, $id]);

                if ($res){
                    $sm = "Success Up To Date";
                    header("Location: ../edit_auths.php?success=$sm&id=$id");
                    exit;
                }else{
                    $em = "The author name is required";
                    header("Location: ../edit_auths.php?error=$em&id=$id");
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