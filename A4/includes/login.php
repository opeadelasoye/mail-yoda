<!-- This code contains code re-used from code for my A3 in this course. This code is used with Prof. Raghav Sampangi's permission. 
This code is used as a starting point for my solution for A4. -->

<?php
    ini_set('display_errors', 1);

    require_once "functions.php";
    require_once "db.php";

    if(isset($_REQUEST["email"]) && isset($_REQUEST["password"])){
        $email = sanitizeData($_POST["email"]);
        $password = sanitizeData($_POST["password"]);

        $sql = "SELECT je_login_email, je_login_password FROM je_login WHERE '$email' = je_login_email;";
        $result = $database->query($sql);
        $row = $result->fetch_assoc();

        if($result->num_rows == 0){
            header("Location: ../index.php");
        }else if(password_verify($password, $row["je_login_password"])){
            $password = $row["je_login_password"];    
        }
        $sql = "SELECT je_user_id, je_user_firstname, je_user_lastname, je_user_role, je_user_suspended, je_login_email, je_login_password
                    FROM je_users
                    JOIN je_login ON (je_user_id = je_login_id)
                    WHERE '$email' = je_login_email && '$password' = je_login_password;";
        $result = $database->query($sql);
    }
    if($result->num_rows > 0){
        session_start();
        $row = $result->fetch_assoc();

        $_SESSION['user-ID'] = $row["je_user_id"];
        $_SESSION['user-firstname'] = $row["je_user_firstname"];
        $_SESSION['user-lastname'] = $row["je_user_lastname"];
        $_SESSION['user-email'] = $row["je_login_email"];
        $_SESSION['user-password'] = $row["je_login_password"];
        $_SESSION['user-role'] = $row["je_user_role"];
        $_SESSSION['user-suspended'] = $row["je_user_suspended"];
    }

    header("Location: ../index.php?view=inbox");
?>