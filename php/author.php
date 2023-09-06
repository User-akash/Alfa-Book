<?php
    function get_all_author($con){
        $sql = "SELECT * FROM author";
        $statement = $con->prepare($sql);
        $statement->execute();

        if($statement->rowCount() > 0){
            $author = $statement->fetchAll();
        }else{
            $author = 0;
        }
        return $author;
    }



    function get_author($con, $id){
        $sql = "SELECT * FROM author WHERE id=?";
        $statement = $con->prepare($sql);
        $statement->execute([$id]);

        if($statement->rowCount() > 0){
            $author = $statement->fetch();
        }else{
            $author = 0;
        }
        return $author;
    }
?>