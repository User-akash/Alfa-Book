<?php
    function get_all_books($con){
        $sql = "SELECT * FROM books ORDER bY id DESC";
        $statement = $con->prepare($sql);
        $statement->execute();

        if($statement->rowCount() > 0){
            $books = $statement->fetchAll();
        }else{
            $books = 0;
        }
        return $books;
    }



    function get_book($con, $id){
        $sql = "SELECT * FROM books WHERE id=?";
        $statement = $con->prepare($sql);
        $statement->execute([$id]);

        if($statement->rowCount() > 0){
            $book = $statement->fetch();
        }else{
            $book = 0;
        }
        return $book;
    }


    function search_books($con, $key){

        $key = "%{$key}%";

        $sql = "SELECT * FROM books WHERE title LIKE ? OR descript LIKE ?";
        $statement = $con->prepare($sql);
        $statement->execute([$key, $key]);

        if($statement->rowCount() > 0){
            $books = $statement->fetchAll();
        }else{
            $books = 0;
        }
        return $books;
    }


    function get_f_books($con, $id){
        $sql = "SELECT * FROM books WHERE category_id=?";
        $statement = $con->prepare($sql);
        $statement->execute([$id]);

        if($statement->rowCount() > 0){
            $books = $statement->fetchAll();
        }else{
            $books = 0;
        }
        return $books;
    }


    function get_f_author($con, $id){
        $sql = "SELECT * FROM books WHERE author_id=?";
        $statement = $con->prepare($sql);
        $statement->execute([$id]);

        if($statement->rowCount() > 0){
            $books = $statement->fetchAll();
        }else{
            $books = 0;
        }
        return $books;
    }
?>