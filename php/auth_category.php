<?php
    function get_all_category($con){
        $sql = "SELECT * FROM category";
        $statement = $con->prepare($sql);
        $statement->execute();

        if($statement->rowCount() > 0){
            $category = $statement->fetchAll();
        }else{
            $category = 0;
        }
        return $category;
    }



    function get_category($con, $id){
        $sql = "SELECT * FROM category WHERE id=?";
        $statement = $con->prepare($sql);
        $statement->execute([$id]);

        if($statement->rowCount() > 0){
            $category = $statement->fetch();
        }else{
            $category = 0;
        }
        return $category;
    }
?>