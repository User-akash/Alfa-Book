<?php
    function is_empty($var, $text, $location, $msg, $data){
        if (empty($var)){
            $error_msg = "The ".$text."is required";
            header("Location: $location?$msg=$error_msg&$data");
            exit;
        }
        return 0;
    }
?>