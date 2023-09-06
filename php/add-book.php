<?php
    session_start();

    if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])){

        include "./data_connection.php";
        include "validation.php";
        include "file-upload.php";

        if (isset($_POST['book_title'])         &&
            isset($_POST['book_description'])   && 
            isset($_POST['book_author'])        &&
            isset($_POST['book_category'])      &&
            isset($_FILES['book_cover'])        &&
            isset($_FILES['file']) ) {


            $title          = $_POST['book_title'];
            $description    = $_POST['book_description'];
            $author         = $_POST['book_author'];
            $category       = $_POST['book_category'];


            $user_input = 'title='.$title.'&category='.$category.'&description='.$description.'&author_id='.$author;


            $text = "Book title";
            $location = "../add_book.php";
            $msg = "id=$id&error";
            is_empty($title, $text, $location, $msg, $user_input);

            $text = "Book Description";
            $location = "../add_book.php";
            $msg = "error";
            is_empty($description, $text, $location, $msg, $user_input);

            $text = "Book Author";
            $location = "../add_book.php";
            $msg = "error";
            is_empty($author, $text, $location, $msg, $user_input);

            $text = "Book Category";
            $location = "../add_book.php";
            $msg = "error";
            is_empty($category, $text, $location, $msg, $user_input);


            $allowed_image_exs = array("jpg", "jpeg", "png");
            $path = "cover";
            $book_cover = upload_file($_FILES['book_cover'], $allowed_image_exs, $path);

            if ($book_cover['status'] == "error"){
                $em = $book_cover['data'];

                header("Location: ../add_book.php?error=$em&$user_input");
            }else{
                $allowed_file_exs = array("pdf", "docx", "pptx");
                $path = "files";
                $file = upload_file($_FILES['file'], $allowed_file_exs, $path);


                if ($file['status'] == "error"){
                    $em = $file['data'];
    
                    header("Location: ../add_book.php?error=$em&$user_input");
                    exit;
                }else{
                    $file_URL = $file['data'];
                    $book_cover_URL = $book_cover['data'];
                    // this will remove
                    
                    
                    $sql = "INSERT INTO books (title, author_id, descript, category_id, cover, file) VALUES(?,?,?,?,?,?)";
                    $statement = $con->prepare($sql);
                    $res = $statement->execute([$title, $author, $description, $category, $book_cover_URL, $file_URL]);


                    if ($res){
                        $sm = "The Book Completed Make Created";
                        header("Location: ../add_book.php?success=$sm");
                        exit;
                    }else{
                        $em = "The author name is required";
                        header("Location: ../add_book.php?error=$em");
                        exit;
                    }
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