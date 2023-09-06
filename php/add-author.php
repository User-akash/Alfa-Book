<?php
    session_start();

    if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])){

        include "./data_connection.php";

        if (isset($_POST['author_name'])){
            $name = $_POST['author_name'];
            if (empty($name)){
                $em = "The author name is required";
                header("Location: ../add_author.php?error=$em");
                exit;
            }else{
                $sql = "INSERT INTO author (name) VALUES (?)";
                $statement = $con->prepare($sql);
                $res = $statement->execute([$name]);

                if ($res){
                    $sm = "Completed Make";
                    header("Location: ../add_author.php?success=$sm");
                    exit;
                }else{
                    $em = "The author name is required";
                    header("Location: ../add_author.php?error=$em");
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