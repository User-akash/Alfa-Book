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

                $sql2 = "SELECT * FROM books WHERE id=?";
                $statement2 = $con->prepare($sql2);
                $statement2->execute([$id]);
                $the_book = $statement2->fetch();

                if($statement2->rowCount() > 0){
                    $sql = "DELETE FROM books WHERE id=?";
                    $statement = $con->prepare($sql);
                    $res = $statement->execute([$id]);

                    if($res){
                        $cover = $the_book['cover'];
                        $file = $the_book['file'];
                        $cover_book_path = "../uploads/cover/$cover";
                        $file_book_path = "../uploads/files/$cover";

                        unlink($cover_book_path);
                        unlink($file_book_path);
                    }

    
                    if ($res){
                        $sm = "Success Up To rm";
                        header("Location: ../admin.php?success=$sm");
                        exit;
                    }else{
                        $em = "re com";
                        header("Location: ../admin.php?error=$em");
                        exit;
                    }
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