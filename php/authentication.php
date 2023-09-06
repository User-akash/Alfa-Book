<?php
    session_start();

    if (isset($_POST['email']) &&
    isset($_POST['password'])){

        include "./data_connection.php";
        include "validation.php";

        $email = $_POST['email'];
        $password = $_POST['password'];

        $text = "Email";
        $location = "../login.php";
        $msg = "error";
        is_empty($email, $text, $location, $msg, "");

        $text = "Password";
        $location = "../login.php";
        $msg = "error";
        is_empty($password, $text, $location, $msg, "");

        $sql = "SELECT * FROM fsociety WHERE email=?";
        $statement = $con->prepare($sql);
        $statement->execute([$email]);

        if ($statement->rowCount() === 1){
            $user = $statement->fetch();
            $user_id = $user['id'];
            $user_email = $user['email'];
            $user_password = $user['password'];
            if ($email === $user_email){
                if(password_verify($password, $user_password)){
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['user_email'] = $user_email;
                    header("Location: ../admin.php");
                }else{
                    $error_message = "Incorrect username or password";
                    header("Location: ../login.php?error=$error_message");
                }
            }else{
                $error_message = "Incorrect username or password";
                header("Location: ../login.php?error=$error_message");
            }
        }else{
            $error_message = "Incorrect username or password";
            header("Location: ../login.php?error=$error_message");
        }
    }else{
        header("Location: ../login.php");
    }
?>