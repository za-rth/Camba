<?php
include 'config.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (isset($_POST['login'])) {


        if (empty($email) && empty($password)) {
            echo "<script>alert('Insert Registered Credentials')</script>";

        } else {
            
            $sql = $connection->prepare("SELECT EMAIL FROM `user_account` WHERE `EMAIL` = ? AND `PASSWORD` = ?");
            $sql->bind_param("ss", $email, $password);
            $sql->execute();
            echo "<script>alert('Login Successful')</script>";
            header("Location: buyerPage.php");
            $sql->close();
        }


    }
 
}

