<?php
    session_start();

    if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])){

        include "./data_connection.php";
        include "validation.php";
        include "file-upload.php";

        if (isset($_POST['book_id'])            &&
            isset($_POST['book_title'])         &&
            isset($_POST['book_description'])   && 
            isset($_POST['book_author'])        &&
            isset($_POST['book_category'])      &&
            isset($_FILES['book_cover'])        &&
            isset($_FILES['file'])              &&
            isset($_POST['current_cover'])      &&
            isset($_POST['current_file']))  {

            $id             = $_POST['book_id'];
            $title          = $_POST['book_title'];
            $description    = $_POST['book_description'];
            $author         = $_POST['book_author'];
            $category       = $_POST['book_category'];


            $current_cover = $_POST['current_cover'];
            $current_file = $_POST['current_file'];


            $text = "Book title";
            $location = "../edit_book.php";
            $msg = "id=$id&error";
            is_empty($title, $text, $location, $msg, "");

            $text = "Book Description";
            $location = "../edit_book.php";
            $msg = "id=$id&error";
            is_empty($description, $text, $location, $msg, "");

            $text = "Book Author";
            $location = "../edit_book.php";
            $msg = "id=$id&error";
            is_empty($author, $text, $location, $msg, "");

            $text = "Book Category";
            $location = "../edit_book.php";
            $msg = "id=$id&error";
            is_empty($category, $text, $location, $msg, "");

            if(!empty($_FILES['book_cover']['name'])){
                if(!empty($_FILES['file']['name'])){
                    $allowed_image_exs = array("jpg", "jpeg", "png");
                    $path = "cover";
                    $book_cover = upload_file($_FILES['book_cover'], $allowed_image_exs, $path);

                    $allowed_file_exs = array("pdf", "docx", "pptx");
                    $path = "files";
                    $file = upload_file($_FILES['file'], $allowed_file_exs, $path);

                    if ($book_cover['status'] == "error" || $file['status'] == "error"){
                        $em = $book_cover['data'];
        
                        header("Location: ../edit_book.php?error=$em&id=$id");
                        exit;
                    }else{
                        $c_p_book_cover = "../uploads/cover/$current_cover";
                        $c_p_file = "../uploads/files/$current_file";

                        unlink($c_p_book_cover);
                        unlink($c_p_file);

                        $file_URL = $file['data'];
                        $book_cover_URL = $book_cover['data'];

                        $sql = "UPDATE books SET title=?, author_id=?, descript=?, category_id=?, cover=?, file=? WHERE id=?";
                        $statement = $con->prepare($sql);
                        $res = $statement->execute([$title, $author, $description, $category, $book_cover_URL, $file_URL, $id]);

                        if ($res){
                            $sm = "Success Up To Date";
                            header("Location: ../edit_book.php?success=$sm&id=$id");
                            exit;
                        }else{
                            $em = "The category name is required";
                            header("Location: ../edit_book.php?error=$em&id=$id");
                            exit;
                        }
                    }
                }else{
                    $allowed_image_exs = array("jpg", "jpeg", "png");
                    $path = "cover";
                    $book_cover = upload_file($_FILES['book_cover'], $allowed_image_exs, $path);

                    if ($book_cover['status'] == "error"){
                        $em = $book_cover['data'];
        
                        header("Location: ../edit_book.php?error=$em&id=$id");
                        exit;
                    }else{
                        $c_p_book_cover = "../uploads/cover/$current_cover";

                        unlink($c_p_book_cover);

                        $book_cover_URL = $book_cover['data'];

                        $sql = "UPDATE books SET title=?, author_id=?, descript=?, category_id=?, cover=? WHERE id=?";
                        $statement = $con->prepare($sql);
                        $res = $statement->execute([$title, $author, $description, $category, $book_cover_URL, $id]);

                        if ($res){
                            $sm = "Success Up To Date";
                            header("Location: ../edit_book.php?success=$sm&id=$id");
                            exit;
                        }else{
                            $em = "The category name is required";
                            header("Location: ../edit_book.php?error=$em&id=$id");
                            exit;
                        }
                    }
                }
            }else if(!empty($_FILES['file']['name'])){
                $allowed_file_exs = array("pdf", "docx", "pptx");
                    $path = "files";
                    $file = upload_file($_FILES['file'], $allowed_file_exs, $path);

                    if ($file['status'] == "error"){
                        $em = $file['data'];
        
                        header("Location: ../edit_book.php?error=$em&id=$id");
                        exit;
                    }else{
                        $c_p_file = "../uploads/files/$current_file";

                        unlink($c_p_file);

                        $file_URL = $file['data'];

                        $sql = "UPDATE books SET title=?, author_id=?, descript=?, category_id=?, file=? WHERE id=?";
                        $statement = $con->prepare($sql);
                        $res = $statement->execute([$title, $author, $description, $category, $file_URL, $id]);

                        if ($res){
                            $sm = "Success Up To Date";
                            header("Location: ../edit_book.php?success=$sm&id=$id");
                            exit;
                        }else{
                            $em = "The category name is required";
                            header("Location: ../edit_book.php?error=$em&id=$id");
                            exit;
                        }
                    }
            }else{
                $sql = "UPDATE books SET title=?, author_id=?, descript=?, category_id=? WHERE id=?";
                $statement = $con->prepare($sql);
                $res = $statement->execute([$title, $author, $description, $category, $id]);

                if ($res){
                    $sm = "Success Up To Date";
                    header("Location: ../edit_book.php?success=$sm&id=$id");
                    exit;
                }else{
                    $em = "The category name is required";
                    header("Location: ../edit_book.php?error=$em&id=$id");
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