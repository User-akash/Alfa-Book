<?php
    session_start();

    if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])){

        include "./data_connection.php";

        if (isset($_GET['id']))
            {
            $id = $_GET['id'];

            if (empty($id)){
                $em = "What the Fucked";
                header("Location: ../admin.php?error=$em");
                exit;
            }else{
                    $sql = "DELETE FROM category WHERE id=?";
                    $statement = $con->prepare($sql);
                    $res = $statement->execute([$id]);
    
                    if ($res){
                        $sm = "Success Up To rm";
                        header("Location: ../admin.php?success=$sm");
                        exit;
                    
                }else{
                    $em = "What the Fucked";
                    header("Location: ../admin.php?error=$em");
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