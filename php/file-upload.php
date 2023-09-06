<?php

function upload_file($files, $allowed_exs, $path){
    $file_name = $files['name'];
    $tmp_name = $files['tmp_name'];
    $error = $files['error'];


    if ($error === 0){
        $file_extn = pathinfo($file_name, PATHINFO_EXTENSION);
        $file_extn_lc = strtolower($file_extn);

        if (in_array($file_extn_lc, $allowed_exs)){
            $new_file_name = uniqid("",true).'.'.$file_extn_lc;
            $file_upload_path = '../uploads/'.$path.'/'.$new_file_name;
            move_uploaded_file($tmp_name, $file_upload_path);

            $sm['status'] = 'success';
            $sm['data'] = $new_file_name;


            return $sm;
        }else{
            $em['status'] = 'error';
            $em['data'] = "You can't upload file this Type";


            return $em;
        }
    }else{
        $em['status'] = 'error';
        $em['data'] = 'Error occurred while uploading';


        return $em;
    }
}