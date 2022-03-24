<?php
    session_start();

    $database = new mysqli("localhost", "root", "root", "jedi_encrypted_email");

    if($database->connect_error){
        die("Error: " . $database->connect_errno . "<br>" . $database->connect_error);
    }
?>